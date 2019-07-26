<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/local/vendor/autoload.php');
define("BX_AGENTS_LOG_FUNCTION", "updateBalance");
define("LOG_FILENAME", "/var/www/bitrix/data/www/defo.ru/log/balance2.log");

if (file_exists(__DIR__ . '/const.php')) {
    require_once __DIR__ . '/const.php';
}
if (file_exists(__DIR__ . '/debug.php')) {
    require_once __DIR__ . '/debug.php';
}
if (file_exists(__DIR__ . '/functions.php')) {
    require_once __DIR__ . '/functions.php';
}
//x5 20190628
\XFive\Events\EventManager::initEvents();

\Bitrix\Main\EventManager::getInstance()->addEventHandler('sale', 'onSaleAdminOrderInfoBlockShow',
    'onSaleAdminOrderInfoBlockShow');// Split delivery in order_view for managers
AddEventHandler("sale", "OnOrderNewSendEmail", "OnOrderNewSendMailHandler");
AddEventHandler("main", "OnBeforeUserLogin", "OnBeforeUserLoginHandler");
AddEventHandler("main", "OnBeforeUserSendPassword", "OnBeforeUserSendPasswordHandler");
AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserRegisterHandler");// Для разделения пользователей по сайтам
AddEventHandler("main", "OnAfterUserRegister", Array("SubscribeMe", "OnAfterUserRegisterHandler"));
AddEventHandler("search", "BeforeIndex", Array("DefoSearcher", "BeforeIndexHandler"));//для поиска по артикулу
AddEventHandler('main', 'OnEpilog', '_Check404Error');
//AddEventHandler('main', 'OnAfterEpilog', array('CBDPEpilogHooks', 'CheckIfModifiedSince'));//Проверка If-Modified-Since и вывод 304 Not Modified
AddEventHandler("main", "OnAfterUserAdd", "OnAfterUserAddHandler");
//AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "OnAfterIBlockElementUpdateHandler");
//AddEventHandler("iblock", "OnAfterIBlockElementAdd", "OnAfterIBlockElementAddHandler");
//AddEventHandler("iblock", "OnAfterIBlockElementDelete", "OnAfterIBlockElementDeleteHandler");
AddEventHandler("catalog", "OnPriceUpdate", Array("MyElement", "OnBeforeIBlockElementUpdateHandler"));
AddEventHandler("catalog", "OnPriceAdd", Array("MyElement", "OnBeforeIBlockElementUpdateHandler"));
AddEventHandler("iblock", "OnAfterIBlockElementDelete", Array("MyElement", "OnAfterIBlockElementDeleteHandler"));
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("MyElement", "OnElementUpdateHandler"));
AddEventHandler("search", "BeforeIndex", "BeforeIndexHandler");
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "dropName");
\Bitrix\Main\EventManager::getInstance()->addEventHandler('', 'PatternReferenceOnAfterAdd',
    'OnAfterAdd');//Событие на добавление новой записи в highloadblock PatternReference
AddEventHandler('main', 'OnBeforeEventSend', Array("EventSend", "my_OnBeforeEventSend"));
AddEventHandler("catalog", "OnSuccessCatalogImport1C", "success1c");
AddEventHandler("catalog", "OnBeforePriceDelete", "savingCurrentPrice");
AddEventHandler("catalog", "OnBeforePriceAdd", "savingCurrentPrice2");
AddEventHandler("catalog", "OnBeforePriceUpdate", "savingCurrentPrice3");
AddEventHandler("catalog", "OnBeforeCatalogStoreDelete", "deleteStore");



function updateBalance($arAgent = false, $state = false, $eval_result = false, $e = false)
{
    //$f = fopen ($_SERVER['DOCUMENT_ROOT']."/bitrix/test333222.log", "a+");
    //fwrite ($f, print_r (array("start" , date ("r")),true));
    //fclose($f);
    AddMessage2Log(array('STATE' => $state, 'AGENT' => $arAgent, 'EVAL' => $eval_result, 'E' => $e));
}


function onSaleAdminOrderInfoBlockShow(\Bitrix\Main\Event $event)
{
    $order = $event->getParameter('ORDER');
    $fields = $order->getFields();
    $additionals = explode(';', $fields->get('ADDITIONAL_INFO'));
    $deliveryCost = $additionals[0];
    $flooringCost = $additionals[1];
    $assemblingCost = $additionals[2];
    $garbageRemovalCost = $additionals[3];
    $ipSession = !empty($additionals[4]) ? $additionals[4] : 'не определен';
    $currency = $fields->get('CURRENCY');

    return new \Bitrix\Main\EventResult(
        \Bitrix\Main\EventResult::SUCCESS,
        array(
            array(
                'TITLE' => 'Доставка',
                'VALUE' => SaleFormatCurrency($deliveryCost, $currency),
                'ID' => 'delivery_cost'
            ),
            array(
                'TITLE' => 'Подъем на этаж',
                'VALUE' => SaleFormatCurrency($flooringCost, $currency),
                'ID' => 'flooring_cost'
            ),
            array(
                'TITLE' => 'Сборка',
                'VALUE' => SaleFormatCurrency($assemblingCost, $currency),
                'ID' => 'assembling_cost'
            ),
            array(
                'TITLE' => 'Вывоз упаковки',
                'VALUE' => SaleFormatCurrency($garbageRemovalCost, $currency),
                'ID' => 'garbage_removal_cost'
            ),
            array(
                'TITLE' => 'IP адрес покупателя',
                'VALUE' => $ipSession,
                'ID' => 'ip_session'
            )
        )
    );
}

// Очистить корзину
if ($_POST["BasketDelete"] and CModule::IncludeModule("sale")) {
    CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
}


function OnOrderNewSendMailHandler($ID, &$eventName, &$arFields)
{
    $arOrder = CSaleOrder::GetByID($ID);

    // for crm
//	$locationPropertyValue = 617; // saint-petersburg by default for additional bcc emails
    $dbOrderProps = CSaleOrderPropsValue::GetOrderProps($ID);
    while ($arOrderProps = $dbOrderProps->Fetch()) {
        $arOrderPropsValue[] = $arOrderProps;

        // for crm
        /*if ($arOrderProps['TYPE'] === 'LOCATION') {
            $locationPropertyValue = $arOrderProps['VALUE'];
        }*/

        if ($arOrderProps["TYPE"] == "LOCATION" && $arOrderProps["ACTIVE"] == "Y" && $arOrderProps["IS_LOCATION"] == "Y" && in_array($arOrderProps["INPUT_FIELD_LOCATION"],
                $arTownOrderProps)) {
            if (CSaleLocation::isLocationProMigrated()) {
                $arEnableTownProps[$arOrderProps["INPUT_FIELD_LOCATION"]] = true; //CSaleLocation::checkLocationIsAboveCity($arOrderProps["VALUE"]);
            } else {
                $arLocation = CSaleLocation::GetByID($arOrderProps["VALUE"]);
                if (IntVal($arLocation["CITY_ID"]) <= 0) {
                    $arEnableTownProps[$arOrderProps["INPUT_FIELD_LOCATION"]] = true;
                } else {
                    $arEnableTownProps[$arOrderProps["INPUT_FIELD_LOCATION"]] = false;
                }
            }
        }
    }

    // collect emails by selected city choosed in order {[(
    /*$arBccEmails = explode(',', $arFields['BCC']);
    $resCity = CIBlockElement::GetList(	array(),
        array(
            "IBLOCK_ID"=>21, /// cities iblock
            "IBLOCK_ACTIVE"=>"Y",
            "ACTIVE"=>"Y",
            "GLOBAL_ACTIVE"=>"Y",
            "PROPERTY_LOCATION"=>IntVal($locationPropertyValue),
		),
        false,
        array(),
        array('PROPERTY_EMAIL_MANAGER')
	);
    if ($arCity = $resCity->Fetch()) {
    	if (strlen($arCity['PROPERTY_EMAIL_MANAGER_VALUE']) > 0) {
    		$arAdditionalBccEmails = explode(',', $arCity['PROPERTY_EMAIL_MANAGER_VALUE']);
            $arBccEmails = array_merge($arBccEmails, $arAdditionalBccEmails);
        }
    }

    foreach ($arBccEmails as &$email) {
        $email = trim($email);
    }
    // hardcode mails
    $arBccEmails[] = 'ak@defo.ru';
    $arBccEmails[] = 'rsn@defo.ru';

    $arFields['BCC'] = implode(',', $arBccEmails);*/
    // )]}

    $dbBasketTmp = CSaleBasket::GetList(
        array("ID" => "ASC"),
        array("ORDER_ID" => $ID),
        false,
        false,
        array(
            "ID",
            "PRODUCT_ID",
            "PRODUCT_PRICE_ID",
            "PRICE",
            "CURRENCY",
            "WEIGHT",
            "QUANTITY",
            "NAME",
            "MODULE",
            "CALLBACK_FUNC",
            "NOTES",
            "DETAIL_PAGE_URL",
            "DISCOUNT_PRICE",
            "DISCOUNT_VALUE",
            "ORDER_CALLBACK_FUNC",
            "CANCEL_CALLBACK_FUNC",
            "PAY_CALLBACK_FUNC",
            "CATALOG_XML_ID",
            "PRODUCT_XML_ID",
            "VAT_RATE",
            "DISCOUNT_NAME",
            "DISCOUNT_COUPON",
            "PRODUCT_PROVIDER_CLASS",
            "CUSTOM_PRICE",
            "TYPE",
            "SET_PARENT_ID",
            "DIMENSIONS",
            "RECOMMENDATION"
        )
    );
    while ($arBasketTmp = $dbBasketTmp->GetNext()) {
        $arBasketId[] = $arBasketTmp["ID"];
        $arBasketTmp["DIMENSIONS"] = unserialize($arBasketTmp["~DIMENSIONS"]);

        $arBasketItems[] = $arBasketTmp;

        if (CModule::IncludeModule("catalog")) {
            $arParent = CCatalogSku::GetProductInfo($arBasketTmp["PRODUCT_ID"]);
            if ($arParent) {
                $arElementId[] = $arParent["ID"];
                $arSku2Parent[$arBasketTmp["PRODUCT_ID"]] = $arParent["ID"];
            }
        }

        $arElementId[] = $arBasketTmp["PRODUCT_ID"];
        $arBasketPropsValues[$arBasketTmp["PRODUCT_ID"]] = array();

        if (!CSaleBasketHelper::isSetItem($arBasketTmp)) {
            $orderTotalPrice += ($arBasketTmp["PRICE"] + $arBasketTmp["DISCOUNT_PRICE"]) * $arBasketTmp["QUANTITY"];
        }

        if (!CSaleBasketHelper::isSetParent($arBasketTmp)) {
            $orderTotalWeight += floatval($arBasketTmp["WEIGHT"] * $arBasketTmp["QUANTITY"]);
        }

        if (CSaleBasketHelper::isSetParent($arBasketTmp) || CSaleBasketHelper::isSetItem($arBasketTmp)) {
            $parentItemFound = true;
        }
    }
    if ($parentItemFound === true && !empty($arBasketItems) && is_array($arBasketItems)) {
        $arBasketItems = CSaleBasketHelper::reSortItems($arBasketItems);
    }


    $arBasketProps = array();

    $arPropsFilter = array("BASKET_ID" => $arBasketId);
    $dbBasketPropsTmp = CSaleBasket::GetPropsList(
        array("BASKET_ID" => "ASC", "SORT" => "ASC", "NAME" => "ASC"),
        $arPropsFilter,
        false,
        false,
        array("ID", "BASKET_ID", "NAME", "VALUE", "CODE", "SORT")
    );
    while ($arBasketPropsTmp = $dbBasketPropsTmp->Fetch()) {
        $arBasketProps[$arBasketPropsTmp["BASKET_ID"]][] = $arBasketPropsTmp;
    }


    $orderList = '<table cellspacing="0" style="font-size:14px;width:100%;border-collapse:collapse;"><tr style="color:#777;border-bottom:1px solid #ddd;height:40px;"><td>Артикул</td><td style="width:40%;">Наименование</td><td>Количество</td><td>Цена товара</td><td>Сумма</td></tr>';
    //$orderList .= print_r($arBasketItems, true);
    foreach ($arBasketItems as $arItem) {
        $orderList .= '<tr style="border-bottom:1px solid #ddd;height:40px;">' .
            '<td>' . $arBasketProps[$arItem["ID"]][0]["VALUE"] . '</td>' .
            '<td style="font-weight:bold;">' . $arItem["NAME"] . '</td>' .
            '<td>' . $arItem["QUANTITY"] . '</td>' .
            '<td>' . CCurrencyLang::CurrencyFormat($arItem["PRICE"], $arItem["CURRENCY"]) . '</td>' .
            '<td style="font-weight:bold;">' . CCurrencyLang::CurrencyFormat($arItem["PRICE"] * $arItem["QUANTITY"],
                $arItem["CURRENCY"]) . '</td></tr>';
    }
    $orderList .= '</table>';

    $costList = '';
    $deliveryName = '';
    $deliveryInfo = '<table style="font-size:14px;">';
    if ($arOrder["DELIVERY_ID"] == "3") { /// служба доставки
        $deliveryName = 'Доставка';
        $costList = '<table cellspacing="0" style="font-size:14px;display:inline-table;">';

        $arByCodes = array();
        foreach ($arOrderPropsValue as $key => $arProp) {
            if (in_array($arProp["CODE"], array(
                "LOCATION",
                "STREET",
                "HOUSE_NUMBER",
                "HOUSING",
                "FLOOR",
                "ROOM",
                "FLOORING_NEED",
                "SERVICE_LIFT",
                "FURNITURE_ASSEMBLING",
                "GARBAGE_REMOVAL_VAL",
                "ZIP"
            ))) {
                $arByCodes[$arProp["CODE"]] = $arProp["VALUE"];
                unset($arOrderPropsValue[$key]);
            }
        }

        $arAdditionalInfo = explode(';', $arOrder["ADDITIONAL_INFO"]);

        $arByCodes["DELIVERY_COST"] = $arAdditionalInfo[0];
        // override "Да" галок на стоимость услуг
        $arByCodes["FLOORING_COST"] = $arAdditionalInfo[1];
        $arByCodes["ASSEMBLING_COST"] = $arAdditionalInfo[2];
        $arByCodes["GARBAGE_REMOVAL_COST"] = $arAdditionalInfo[3];


        if (isset($arByCodes["LOCATION"])) {
            $arFilter = array(
                "IBLOCK_ID" => 21, /// блок с городами салонов
                "IBLOCK_ACTIVE" => "Y",
                "ACTIVE" => "Y",
                "GLOBAL_ACTIVE" => "Y",
                "PROPERTY_LOCATION" => IntVal($arByCodes["LOCATION"]),
            );
            $rsElements = CIBlockElement::GetList(array(),
                $arFilter,
                false,
                array(),
                array(
                    "NAME",
                    "PROPERTY_PICKUP_PLACE"
                ));
            $city = $rsElements->GetNext();
            //var_dump($city);
            $arByCodes["LOCATION"] = $city["NAME"];
            $arByCodes["PICKUP_PLACE"] = $city["PROPERTY_PICKUP_PLACE_VALUE"];

            $deliveryInfo .= '<tr><td colspan="2" style="color:#777;">Адрес доставки:</td></tr><td colspan="2" style="font-weight:bold;">';
            $deliveryInfo .= isset($arByCodes["LOCATION"]) ? $arByCodes["LOCATION"] . ", " : "";
            $deliveryInfo .= isset($arByCodes["STREET"]) ? $arByCodes["STREET"] : "";
            $deliveryInfo .= isset($arByCodes["HOUSE_NUMBER"]) ? " д." . $arByCodes["HOUSE_NUMBER"] : "";
            $deliveryInfo .= isset($arByCodes["HOUSING"]) ? " к." . $arByCodes["HOUSING"] : "";
            $deliveryInfo .= isset($arByCodes["ROOM"]) ? " кв." . $arByCodes["ROOM"] : "";
            $deliveryInfo .= '</td></tr>';

            if ($arOrder["ADDITIONAL_INFO"] != "") {
                $costList .= '<tr>' .
                    '<td>Стоимость доставки:</td>' .
                    '<td style="text-align:right;font-weight:bold;">' . CCurrencyLang::CurrencyFormat($arByCodes["DELIVERY_COST"],
                        $arOrder["CURRENCY"]) . '</td></tr>';

                if ($arByCodes["FLOORING_NEED"] == "Y") {
                    $costList .= '<tr>' .
                        '<td>Подъем на этаж:</td>' .
                        '<td style="text-align:right;font-weight:bold;">' . CCurrencyLang::CurrencyFormat($arByCodes["FLOORING_COST"],
                            $arOrder["CURRENCY"]) . '</td></tr>';
                }
                if ($arByCodes["FURNITURE_ASSEMBLING"] == "Y") {
                    $costList .= '<tr>' .
                        '<td>Сборка мебели:</td>' .
                        '<td style="text-align:right;font-weight:bold;">' . CCurrencyLang::CurrencyFormat($arByCodes["ASSEMBLING_COST"],
                            $arOrder["CURRENCY"]) . '</td></tr>';
                }
                if ($arByCodes["GARBAGE_REMOVAL_VAL"] == "Y") {
                    $costList .= '<tr>' .
                        '<td>Вывоз упаковки:</td>' .
                        '<td style="text-align:right;font-weight:bold;">' . CCurrencyLang::CurrencyFormat($arByCodes["GARBAGE_REMOVAL_COST"],
                            $arOrder["CURRENCY"]) . '</td></tr>';
                }
            } else {
                if ($arByCodes["FLOORING_NEED"] == "Y") {
                    $costList .= '<tr>' .
                        '<td>Подъем на этаж</td>' .
                        '<td style="text-align:right;font-weight:bold;">Да</td></tr>';
                    if ($arByCodes["SERVICE_LIFT"] == "Y") {
                        $costList .= '<tr>' .
                            '<td>Грузовой лифт:</td>' .
                            '<td style="text-align:right;font-weight:bold;">Да</td></tr>';
                    }
                }
                if ($arByCodes["FURNITURE_ASSEMBLING"] == "Y") {
                    $costList .= '<tr>' .
                        '<td>Сборка мебели:</td>' .
                        '<td style="text-align:right;font-weight:bold;">Да</td></tr>';
                }
                if ($arByCodes["GARBAGE_REMOVAL_VAL"] == "Y") {
                    $costList .= '<tr>' .
                        '<td>Вывоз упаковки:</td>' .
                        '<td style="text-align:right;font-weight:bold;">Да</td></tr>';
                }
                $costList .= '<tr>' .
                    '<td>Стоимость доставки:</td>' .
                    '<td style="text-align:right;font-weight:bold;">' . CCurrencyLang::CurrencyFormat($arResult["ORDER"]["PRICE_DELIVERY"],
                        $arResult["ORDER"]["CURRENCY"]) . '</td></tr>';
            }
        } else {
            $deliveryInfo .= '<tr><td colspan="2" style="color:#777;">Адрес доставки:</td><tr><td colspan="2" style="font-weight:bold;">';
            $deliveryInfo .= isset($arByCodes["LOCATION"]) ? $arByCodes["LOCATION"] . ", " : "";
            $deliveryInfo .= isset($arByCodes["STREET"]) ? $arByCodes["STREET"] : "";
            $deliveryInfo .= isset($arByCodes["HOUSE_NUMBER"]) ? " д." . $arByCodes["HOUSE_NUMBER"] : "";
            $deliveryInfo .= isset($arByCodes["HOUSING"]) ? " к." . $arByCodes["HOUSING"] : "";
            $deliveryInfo .= isset($arByCodes["ROOM"]) ? " кв." . $arByCodes["ROOM"] : "";
            $deliveryInfo .= '</td></tr>';

            $costList .= '<tr>' .
                '<td>Стоимость доставки:</td>' .
                '<td style="text-align:right;font-weight:bold;">Менеджер свяжется с Вами и уточнит стоимость доставки</td></tr>';

            if ($arByCodes["FLOORING_NEED"] == "Y") {
                $costList .= '<tr>' .
                    '<td>Подъем на этаж:</td>' .
                    '<td style="text-align:right;font-weight:bold;">рассчитывается менеджером:</td></tr>';
            }
            if ($arByCodes["FURNITURE_ASSEMBLING"] == "Y") {
                $costList .= '<tr>' .
                    '<td>Сборка мебели:</td>' .
                    '<td style="text-align:right;font-weight:bold;">рассчитывается менеджером</td></tr>';
            }
            if ($arByCodes["GARBAGE_REMOVAL_VAL"] == "Y") {
                $costList .= '<tr>' .
                    '<td>Вывоз упаковки:</td>' .
                    '<td style="text-align:right;font-weight:bold;">рассчитывается менеджером</td></tr>';
            }
        }

        $costList .= '<tr style="font-size:16px;font-weight:bold;">' .
            '<td>Стоимость заказа:</td>' .
            '<td style="text-align:right;">' . $arFields["PRICE"] . '</td></tr></table>';
    } else { /// самовывоз
        $deliveryName = 'Самовывоз';

        $arByCodes = array();
        foreach ($arOrderPropsValue as $key => $arProp) {
            if (in_array($arProp["CODE"],
                array("LOCATION", "STREET", "HOUSE_NUMBER", "HOUSING", "FLOOR", "ROOM", "ZIP"))) {
                $arByCodes[$arProp["CODE"]] = $arProp["VALUE"];
                unset($arOrderPropsValue[$key]);
            }
        }
        if (isset($arByCodes["LOCATION"])) {
            $arFilter = array(
                "IBLOCK_ID" => 21, /// блок с городами салонов
                "IBLOCK_ACTIVE" => "Y",
                "ACTIVE" => "Y",
                "GLOBAL_ACTIVE" => "Y",
                "PROPERTY_LOCATION" => IntVal($arByCodes["LOCATION"]),
            );
            $rsElements = CIBlockElement::GetList(array(),
                $arFilter,
                false,
                array(),
                array(
                    "NAME",
                    "PROPERTY_PICKUP_PLACE"
                ));
            $city = $rsElements->GetNext();
            $arByCodes["LOCATION"] = $city["NAME"];
            $arByCodes["PICKUP_PLACE"] = $city["PROPERTY_PICKUP_PLACE_VALUE"];
        }

        $deliveryInfo .= '<tr><td colspan="2" style="color:#777;">Адрес самовывоза:</td>' .
            '<tr><td colspan="2"  style="font-weight:bold;">' . (isset($arByCodes["PICKUP_PLACE"]) ? htmlspecialchars_decode($arByCodes["PICKUP_PLACE"]) : "") . '</td></tr>';
    }

    $arPaySystem = CSalePaySystem::GetByID($arOrder["PAY_SYSTEM_ID"]);
    $paySystem = '<table style="font-size:14px;">' .
        '<tr><td colspan="2" style="font-weight:bold;">' . $arPaySystem["NAME"] . '</td></tr>';
    if ($arOrder["PAY_SYSTEM_ID"] == 7) {
        foreach ($arOrderPropsValue as $arProp) {
            $paySystem .= '<tr><td style="color:#777;vertical-align:top;">' . $arProp["NAME"] . ':</td>' .
                '<td style="text-align:right;font-weight:bold;vertical-align:top;">' . $arProp["VALUE"] . '</td></tr>';
        }
    } else {
        foreach ($arOrderPropsValue as $arProp) {
            $deliveryInfo .= '<tr><td style="color:#777;vertical-align:top;">' . $arProp["NAME"] . ':</td>' .
                '<td style="text-align:right;font-weight:bold;vertical-align:top;">' . $arProp["VALUE"] . '</td></tr>';
        }
    }
    $paySystem .= '</table>';
    $deliveryInfo .= '</table>';


    $arFields["ORDER_LIST"] = $orderList;
    $arFields["COST_LIST"] = $costList;
    $arFields["DELIVERY_NAME"] = $deliveryName;
    $arFields["DELIVERY_INFO"] = $deliveryInfo;
    $arFields["PAYSYSTEM"] = $paySystem;
    $arFields["COMMENTS"] = $arOrder["USER_DESCRIPTION"] == '' ? '' : 'Комментарий к заказу<br><span style="font-weight:bold;">' . $arOrder["USER_DESCRIPTION"] . '</span>';
}


function OnBeforeUserLoginHandler(&$arFields)
{
    if (SITE_ID == "ro") {
        $filter = Array(
            "EMAIL" => $arFields["LOGIN"],
            "GROUPS_ID" => array(11)
        );
        $resSameUsers = CUser::GetList(
            ($by = "id"),
            ($order = "asc"),
            $filter
        );
        if ($resSameUsers->SelectedRowsCount()) {
            $arSameUsers = $resSameUsers->Fetch();
            if ($arFields["LOGIN"] === $arSameUsers["EMAIL"]) {
                $arFields["LOGIN"] = $arSameUsers["LOGIN"];
            } else {
                $arFields["LOGIN"] = "";
            }
        } else {
            $arFields["LOGIN"] = "";
        }
    }// для Дэфо в /auth/index.php
}


function OnBeforeUserSendPasswordHandler(&$arFields)
{
    if (SITE_ID == "ro") {
        $arFields["LOGIN"] = "";
    }
    if ($arFields["LOGIN"] == "") {
        if (SITE_ID == "ro") {
            $group = 11;
        } else {
            if (SITE_ID == "s1") {
                $group = 5;
            }
        }

        $filter = Array(
            "EMAIL" => $arFields["EMAIL"],
            "GROUPS_ID" => array($group)
        );
        $resSameUsers = CUser::GetList(
            ($by = "id"),
            ($order = "asc"),
            $filter,
            array("LOGIN")
        );
        if ($resSameUsers->SelectedRowsCount()) {
            $arSameUsers = $resSameUsers->Fetch();
            if ($arFields["EMAIL"] === $arSameUsers["EMAIL"]) {
                $arFields["LOGIN"] = $arSameUsers["LOGIN"];
            } else {
                $arFields["LOGIN"] = "";
            }
        } else {
            $arFields["LOGIN"] = "";
        }
        $arFields["EMAIL"] = "";
    }
}


function OnBeforeUserRegisterHandler(&$arFields)
{
    if (SITE_ID == "ro") {
        $arFields["GROUP_ID"] = array();
        $arFields["GROUP_ID"][] = 11;

        $filter = Array(
            "EMAIL" => $arFields["EMAIL"],
            "GROUPS_ID" => $arFields["GROUP_ID"]
        );
        $resSameUsers = CUser::GetList(
            ($by = "id"),
            ($order = "asc"),
            $filter
        );

        if (!$resSameUsers->SelectedRowsCount()) {
            $sMailPrefix = substr($arFields["EMAIL"], 0, strrpos($arFields["EMAIL"], '@'));

            do {
                $sUniqueRandomLogin = $sMailPrefix . "_" . randString(5);
                $filter = Array(
                    "LOGIN" => $sUniqueRandomLogin
                );
                $resSameUsers = CUser::GetList(
                    ($by = "id"),
                    ($order = "asc"),
                    $filter
                );
            } while ($resSameUsers->SelectedRowsCount());
            $arFields["LOGIN"] = $sUniqueRandomLogin;

            COption::SetOptionString("main", "new_user_email_uniq_check", 'N');
        }
    } else {
        if (SITE_ID == "s1") {
            $arFields["GROUP_ID"] = array();
            $arFields["GROUP_ID"][] = 5;

            $filter = Array(
                "EMAIL" => $arFields["EMAIL"],
                "GROUPS_ID" => $arFields["GROUP_ID"]
            );
            $resSameUsers = CUser::GetList(
                ($by = "id"),
                ($order = "asc"),
                $filter
            );

            if (!$resSameUsers->SelectedRowsCount()) {
                COption::SetOptionString("main", "new_user_email_uniq_check", 'N');
            }
            /*if(strlen($arFields['UF_ARCHBAZA']) > 0) {
                $arFields['ACTIVE'] = "N";
            }*/
        }
    }
}


class SubscribeMe
{
    function OnAfterUserRegisterHandler(&$arFields)
    {
        COption::SetOptionString("main", "new_user_email_uniq_check", 'Y');

        if (SITE_ID == "s1") {
            $arEventFields = array(
                "USER_ID" => $arFields['USER_ID'],
                "LOGIN" => $arFields["LOGIN"],
                "NAME" => $arFields["NAME"],
                "LAST_NAME" => $arFields["LAST_NAME"],
                "PASSWORD" => $arFields["PASSWORD"],
                "EMAIL" => $arFields["EMAIL"]
            );
            CModule::IncludeModule('iblock');
            CModule::IncludeModule("subscribe");
            $USER_ID = $arEventFields["USER_ID"];
            $EMAIL = $arEventFields["EMAIL"];
            $arFilter = array(
                "ID" => array(1),
                "LID" => "s1",
            );
            $rsRubrics = CRubric::GetList(array(), $arFilter);
            $arRubrics = array();
            while ($arRubric = $rsRubrics->GetNext()) {
                $arRubrics[] = $arRubric["ID"];
            }
            $obSubscription = new CSubscription;
            $rsSubscription = $obSubscription->GetList(array(), array("USER_ID" => $USER_ID));
            $arSubscription = $rsSubscription->Fetch();
            if (is_array($arSubscription)) {
                $rs = $obSubscription->Update(
                    $arSubscription["ID"],
                    array(
                        "FORMAT" => "html",
                        "RUB_ID" => $arRubrics,
                    ),
                    false
                );
            } else {
                $rs = $obSubscription->Add(array(
                    "USER_ID" => $USER_ID,
                    "ACTIVE" => "Y",
                    "EMAIL" => $EMAIL,
                    "FORMAT" => "html",
                    "CONFIRMED" => "Y",
                    "SEND_CONFIRM" => "N",
                    "RUB_ID" => $arRubrics,
                ), "s1");
            }
        }
    }
}


class DefoSearcher
{
    function BeforeIndexHandler($arFields)
    {
        if (!CModule::IncludeModule("iblock")) {
            return $arFields;
        }
        if ($arFields["MODULE_ID"] == "iblock") {
            $res = CIBlockElement::GetByID($arFields["ITEM_ID"]);
            if ($obRes = $res->GetNextElement()) {
                // if SALE_CITY == Moscow then CONTINUE
                $ar_res = $obRes->GetProperty("CAPTION");
                $arFields['TITLE'] .= ($ar_res["VALUE"] == "") ? "" : " / " . $ar_res["VALUE"];
                $ar_res = $obRes->GetProperty("articul_for_series");
                $arFields['TITLE'] .= ($ar_res['VALUE'] == "") ? "" : "<br />Артикул: " . $ar_res['VALUE'];
            }
        }
        return $arFields;
    }
}

function sendOrdersEmail($dateInsert = null)
{
    $logfile = "/var/www/bitrix/data/www/defo.ru/log/order.log";
    $fp = fopen($logfile, 'a');
    $time = date("d.m.Y H:i:s");
    fwrite($fp, $time . " 1. sendOrdersEmail start\n");

    CModule::IncludeModule("iblock");
    CModule::IncludeModule('sale');

    $arOrdersOfCities = array();

    $arFilter = array(
        "IBLOCK_ID" => 21, /// список городов с email адресами
        "!UF_EMAIL_ORDER" => ""
    );
    $rsElements = CIBlockElement::GetList(
        array(
            "UF_EMAIL_ORDER" => "ASC",
            'SORT' => 'ASC'
        ),
        $arFilter,
        false,
        array(),
        array(
            "PROPERTY_LOCATION",
            "NAME",
            "PROPERTY_EMAIL_SEND_ORDER"
        ));

    fwrite($fp, $time . " 2. test\n");
    $dateInsert = !empty($dateInsert) ? $dateInsert : date('d.m.Y', time() - 86400);
    $arOrder = Array("DATE_INSERT" => "ASC");
    while ($arElements = $rsElements->Fetch()) {
        $arFilter = Array(
            ">=DATE_INSERT" => $dateInsert . ' 00:00:00',
            "<=DATE_INSERT" => $dateInsert . ' 23:59:59',
            "PROPERTY_VAL_BY_CODE_LOCATION" => $arElements["PROPERTY_LOCATION_VALUE"]
        );
        // получить список заказов за вчерашний день
        fwrite($fp, $time . " 3. arFilter: \n");
        fwrite($fp, var_export($arFilter, true));
        $db_salses = CSaleOrder::GetList($arOrder, $arFilter, false, false, array("*"));
        if ($arOrders = $db_salses->Fetch()) {
            $arOrdersOfCities[$arElements["PROPERTY_LOCATION_VALUE"]] = $arElements;
            $arOrdersOfCities[$arElements["PROPERTY_LOCATION_VALUE"]]["ORDERS"][$arOrders["ACCOUNT_NUMBER"]] = $arOrders;
        }
        while ($arOrders = $db_salses->Fetch()) {
            $arOrdersOfCities[$arElements["PROPERTY_LOCATION_VALUE"]]["ORDERS"][$arOrders["ACCOUNT_NUMBER"]] = $arOrders;
        }
    }
    fwrite($fp, $time . " 4. test: \n");
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "Content-type: text/html; charset=utf-8 \r\n";
    $headers .= "From: ishop@defo.ru\r\n"; // от кого
    $headers .= "Bcc: ak@defo.ru\r\n"; // скрытая копия сообщения

    $htmlReport = '<h1>Отчет отправленных писем с заказами руководителям</h1>';
    foreach ($arOrdersOfCities as $idCity => $cityItem) {
        if ($idCity == 617 || $idCity == 671 || $idCity == 697) {
            continue;
        }
        $emailTo = '</br><p>Кому отправлено: ' . $cityItem["PROPERTY_EMAIL_SEND_ORDER_VALUE"] . '</p>';
        $table = getTableOrderbyCity($cityItem, $dateInsert);
        $htmlTable = getHtmlDoc($table);
        $sendMail = mail($cityItem["PROPERTY_EMAIL_SEND_ORDER_VALUE"],
            'Заказ с сайта за ' . $dateInsert . ' - ' . $cityItem["NAME"], $htmlTable, $headers);
        if ($sendMail) {
            $htmlReport .= $emailTo . $table;
        }
    }
    $arDivisions = getOrderDevisionList($arOrdersOfCities);
    $htmlReport .= '<h1>Отчет отправленных писем с заказми дивизионным директорам</h1>';
    foreach ($arDivisions as $item) {
        $emailTo = '</br><p>Кому отправлено: ' . $item["EMAIL"] . '</p>';
        $table = getHtmlDivisionOrder($item, $dateInsert);
        $htmlDivision = getHtmlDoc($table);
        $sendMail = mail($item["EMAIL"], 'Заказ с сайта за ' . $dateInsert, $htmlDivision, $headers);
        if ($sendMail) {
            $htmlReport .= $emailTo . $table;
        }

    }
    fwrite($fp, $time . " 5. pered mail: \n");
    mail('ak@defo.ru, cvo@defo.ru, ka@defo.ru', 'Отчет рассылки с заказами за ' . $dateInsert . ' число',
        getHtmlDoc($htmlReport), $headers);
    fwrite($fp, $time . " 6. posle mail: \n");

    return "sendOrdersEmail();";
}

function getOrderDevisionList($orderList)
{
    $divisionalDirectors = array(
        1 => array(
            "NAME" => "Захарченко Олег",
            "EMAIL" => "zo@defo.ru",
            "LOCATIONS" => array(
                270 => array("NAME" => "Владивосток"),
                469 => array("NAME" => "Иркутск"),
                303 => array("NAME" => "Хабаровск"),
                781 => array("NAME" => "Нижний Новгород"),
                959 => array("NAME" => "Самара"),
                965 => array("NAME" => "Тольятти"),
                1189 => array("NAME" => "Ярославль")
            )
        ),
        2 => array(
            "NAME" => "Кудряшов Евгений",
            "EMAIL" => "uk1@defo.ru",
            "LOCATIONS" => array(
                1009 => array("NAME" => "Екатеринбург"),
                148 => array("NAME" => "Казань"),
                880 => array("NAME" => "Пермь"),
                1215 => array("NAME" => "Сургут"),
                1134 => array("NAME" => "Тюмень"),
                24 => array("NAME" => "Уфа"),
                1147 => array("NAME" => "Челябинск"),

                396 => array("NAME" => "Волгоград"),
                432 => array("NAME" => "Воронеж"),
                219 => array("NAME" => "Краснодар"),
                922 => array("NAME" => "Ростов"),
                971 => array("NAME" => "Саратов"),
                931 => array("NAME" => "Таганрог"),
            )
        ),
        3 => array(
            "NAME" => "Носова Марина",
            "EMAIL" => "nme@defo.ru",
            "LOCATIONS" => array(
                184 => array("NAME" => "Абакан"),
                550 => array("NAME" => "Кемерово"),
                246 => array("NAME" => "Красноярск"),
                553 => array("NAME" => "Новокузнецк"),
                822 => array("NAME" => "Новосибирск"),
                838 => array("NAME" => "Омск"),
                185 => array("NAME" => "Саяногорск")
            )
        ),
    );

    foreach ($divisionalDirectors as $key => $arDirector) {
        foreach ($orderList as $orderItem) {
            if (in_array($orderItem["PROPERTY_LOCATION_VALUE"], array_keys($arDirector["LOCATIONS"]))) {
                $divisionalDirectors[$key]["LOCATIONS"][$orderItem["PROPERTY_LOCATION_VALUE"]]["ORDERS"] = $orderItem["ORDERS"];
//				var_dump($divisionalDirectors[$key]["LOCATIONS"][$orderItem["PROPERTY_LOCATION_VALUE"]]["ORDERS"]);
            }
        }
    }

    return $divisionalDirectors;
}

function getHtmlDoc($htmlTable)
{

    $htmlDoc = <<<HTML
<html>
	<head>
		<title>Тема страницы</title>
	</head>
	<body>{$htmlTable}</body>
</html>
HTML;

    return $htmlDoc;
}

function getHtmlDivisionOrder($arDivision, $dateInsert)
{
    $htmlDivisionOrder = <<<HTML

		<h2>Заказы с сайта за {$dateInsert}</h2>
		<table border="1" cellspacing="0">
			<tr>
				<td style="font-weight: bold; padding: 10px;">Название города</td>
				<td style="font-weight: bold; padding: 10px;">Количество заказов</td>
			</tr>
HTML;
    $htmlDetailOrder = '';
    foreach ($arDivision["LOCATIONS"] as $item) {
        $htmlDivisionOrder .= '<tr>';
        $htmlDivisionOrder .= '<td style=\"padding: 10px;\">' . $item["NAME"] . '</td>';
        if (isset($item["ORDERS"])) {
            $htmlDivisionOrder .= '<td style=\"padding: 10px;\">' . count($item["ORDERS"]) . '</td>';
            $htmlDetailOrder .= getTableOrderbyCity($item, $dateInsert);
        } else {
            $htmlDivisionOrder .= '<td style=\"padding: 10px;\">0</td>';
        }
    }

    $htmlDivisionOrder .= <<<HTML
		</table>

HTML;

    return $htmlDivisionOrder . $htmlDetailOrder;
}

function getTableOrderbyCity($arCity, $dateInsert)
{

    $htmlOrderTable = <<<HTML

    		<h2>Заказ с сайта за {$dateInsert} число - {$arCity["NAME"]}</h2>
				<table border="1" cellspacing="0">
					<tr>
						<td style="font-weight: bold; padding: 10px;">Id Заказа</td>
						<td style="font-weight: bold; padding: 10px;">Дата создания</td>
						<!--<td style="font-weight: bold; padding: 10px;">!Дата изменения</td>-->
						<td style="font-weight: bold; padding: 10px;">Город</td>
						<td style="font-weight: bold; padding: 10px;">Покупатель</td>
						<td style="font-weight: bold; padding: 10px;">Сумма</td>
						<!--<td style="font-weight: bold; padding: 10px;">!Оплачен</td>-->
						<!--<td style="font-weight: bold; padding: 10px;">!Статус</td>-->
						<!--<td style="font-weight: bold; padding: 10px;">!Отменен</td>-->
						<!--<td style="font-weight: bold; padding: 10px;">!Сайт</td>-->
					</tr>
HTML;


    foreach ($arCity["ORDERS"] as $order) {
        $arSite = CSite::GetByID($order["LID"])->Fetch();
        $htmlOrderTable .= '<tr>';
        $htmlOrderTable .= '<td style="padding: 10px;">' . $order["ID"] . '</td>';
        $htmlOrderTable .= '<td style="padding: 10px;">' . $order["DATE_INSERT"] . '</td>';
//		$htmlOrderTable .= '<td style="padding: 10px;">'.$order["DATE_UPDATE"].'</td>';
        $htmlOrderTable .= '<td style="padding: 10px;">' . $arCity["NAME"] . '</td>';
        $htmlOrderTable .= '<td style="padding: 10px;">' . $order["USER_NAME"] . '</td>';
        $htmlOrderTable .= '<td style="padding: 10px;">' . $order["PRICE"] . '</td>';
//		$htmlOrderTable .= '<td style="padding: 10px;">';
//		$htmlOrderTable .= $order["PAYED"] == 'Y' ? 'да': 'нет';
//		$htmlOrderTable .= '</td>';
//		$htmlOrderTable .= '<td style="padding: 10px;">';
//		$htmlOrderTable .= $order["STATUS_ID"] == 'Y' ? 'да': 'нет';
//		$htmlOrderTable .= '</td>';
//		$htmlOrderTable .= '<td style="padding: 10px;">';
//		$htmlOrderTable .= $order["CANCELED"] == 'Y' ? 'да': 'нет';
//		$htmlOrderTable .= '</td>';
//		$htmlOrderTable .= '<td style="padding: 10px;">'.$arSite["NAME"].'</td>';
//		$htmlOrderTable .= '<tr>';
    }

//	$htmlOrderTable .='</table>';
    $htmlOrderTable .= <<<HTML
			</table>

HTML;

    return $htmlOrderTable;

}

function getInitLocationShopId($locationId)
{
    if (CModule::IncludeModule("iblock")) {
        if ($locationId > 0) {
            $arFilter = array(
                "IBLOCK_ID" => 21, /// блок с городами салонов
                "IBLOCK_ACTIVE" => "Y",
                "ACTIVE" => "Y",
                "GLOBAL_ACTIVE" => "Y",
                "PROPERTY_LOCATION" => IntVal($locationId)
            );
            $rsElements = CIBlockElement::GetList(array(),
                $arFilter,
                false,
                array(),
                array(
                    "PROPERTY_YAK_SHOPID"
                ));
            $arCity = $rsElements->GetNext();
            if (is_numeric($arCity["PROPERTY_YAK_SHOPID_VALUE"])) {//делаем для яндекс-кассы чтобы параметры брались из инфоблока городов
                return $arCity["PROPERTY_YAK_SHOPID_VALUE"];
            }
        }
    }
}


function _Check404Error()
{
    //if (defined('ERROR_404') && ERROR_404=='Y' && !defined('ADMIN_SECTION'))
    if (defined('ERROR_404') && ERROR_404 == 'Y') {
        GLOBAL $APPLICATION;
        //$APPLICATION->RestartBuffer();
        $GLOBALS['APPLICATION']->RestartBuffer();
        include $_SERVER['DOCUMENT_ROOT'] . '/bitrix/templates/' . SITE_TEMPLATE_ID . '/header.php';
        require $_SERVER['DOCUMENT_ROOT'] . '/404.php';
        //include $_SERVER['DOCUMENT_ROOT'].'/bitrix/templates/'.SITE_TEMPLATE_ID.'/footer.php';
    }
}


/*class CBDPEpilogHooks
{
    function CheckIfModifiedSince()
    {
        GLOBAL $lastModified;

        if (!$lastModified)
        	$lastModified = time();
        if ($lastModified)
        {
            header("Cache-Control: public");
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $lastModified) . ' GMT');
            if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $lastModified) {
                $GLOBALS['APPLICATION']->RestartBuffer();
                CHTTP::SetStatus('304 Not Modified');
            }
        }
    }
}*/


function OnAfterUserAddHandler(&$arFields)
{
    if ($arFields["ID"] > 0) {
        if (strlen($arFields["UF_ARCHBAZA"]) > 0) {
            /*$arGroups = CUser::GetUserGroup($arFields["ID"]);
            $arGroups[] = 17; //То добаляем пользователя в группу c ID15
            CUser::SetUserGroup($arFields["ID"], $arGroups);*/
            if ($arFields["PERSONAL_CITY"] and CModule::IncludeModule("iblock")) {
                $dbCity = CIBlockElement::GetList(
                    array(),
                    array('IBLOCK_ID' => 21, 'ACTIVE' => 'Y', 'NAME' => $arFields["PERSONAL_CITY"]),
                    false,
                    false,
                    array('IBLOCK_ID', 'ID', 'PROPERTY_EMAIL_ARCHITECTS')
                );
                if ($arCity = $dbCity->GetNext()) {
                    $arFields["SEND_TO"] = $arCity["PROPERTY_EMAIL_ARCHITECTS_VALUE"];
                }
            }

            //Отправка письма
            $arEventFields = array(
                "EMAIL" => $arFields["EMAIL"],
                "LOGIN" => $arFields["LOGIN"],
                "PERSONAL_NOTES" => $arFields["PERSONAL_NOTES"],
                "PERSONAL_CITY" => $arFields["PERSONAL_CITY"],
                "SEND_TO" => $arFields["SEND_TO"],
                "PERSONAL_PHONE" => $arFields["PERSONAL_PHONE"],
            );

            $idEvent = CEvent::Send("NEW_USER_ARCHITECTS", "s1", $arEventFields);


            if ($idEvent) {
//				LocalRedirect('/architects/after_registration.php');
            }
        }
    }
}


function OnAfterIBlockElementUpdateHandler(&$arFields)
{
    $fp = fopen($_SERVER["DOCUMENT_ROOT"] . '/send.log', 'a');
    $time = date("d.m.Y H:i:s");
    fwrite($fp, "\n--$time-Запуск события!-----------------------------------------------------\n");
    fwrite($fp, var_export($arFields, true));
    fwrite($fp, "\n--$time------------------------------------------------------\n");

    if ($arFields["IBLOCK_ID"] == 20) {
        loadJsonFiles($arFields);
    }
}


function OnAfterIBlockElementAddHandler(&$arFields)
{
    if ($arFields["IBLOCK_ID"] == 20) {
        loadJsonFiles($arFields);
    }
}

function OnAfterIBlockElementDeleteHandler($arFields)
{
    if ($arFields["IBLOCK_ID"] == 20) {
        loadJsonFiles(1, true);
    }
}

function loadJsonFiles($arFields, $delete = false)
{
    if (!$delete) {
        if (CModule::IncludeModule("iblock")) {
            $dbElement = CIBlockElement::GetByID($arFields['ID']);
            if ($arElements = $dbElement->GetNext()) {
                if ($arElements['IBLOCK_CODE'] == 'salon') {
                    if (is_array($arFields['PROPERTY_VALUES'][114])) {
                        $cityId = array_shift($arFields['PROPERTY_VALUES'][114])['VALUE'];
                        $dbCity = CIBlockElement::GetByID($cityId);
                        if ($arCity = $dbCity->GetNext()) {
                            getJsonSalonList($cityId, $arCity['CODE']);
                        }
                    }
                }
            }

        }
    } else {
        getJsonContactList();
    }
}

function getJsonContactList()
{
    if (!CModule::IncludeModule("iblock")) {
        return null;
    }
    $dbCities = CIBlockElement::GetList(
        array(),
        array('IBLOCK_ID' => 21, 'ACITVE' => 'Y'),
        false,
        false,
        array('ID', 'IBLOCK_ID', 'NAME', 'CODE')
    );
    while ($arCity = $dbCities->GetNext()) {
        $arCities[$arCity['ID']] = $arCity;
        $arCities[$arCity['ID']] = getJsonSalonList($arCity['ID'], $arCity['CODE']);
    }
}

function getJsonSalonList($cityId, $cityCode = null)
{
    if (!CModule::IncludeModule("iblock")) {
        return null;
    }
    $dbSalons = CIBlockElement::GetList(
        array('SORT' => 'ASC'),
        array("IBLOCK_TYPE" => "cities", 'IBLOCK_ID' => 20, 'ACTIVE' => 'Y', 'PROPERTY_CITY_NAME' => $cityId),
        false,
        false,
        array('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'DETAIL_PAGE_URL', 'PROPERTY_CITY_STREET')
    );
    $count = 0;
    while ($arSalon = $dbSalons->GetNextElement()) {
        $arSalons['SALON_LIST'][$count] = $arSalon->fields;
        $dbProperties = $arSalon->GetProperties();
        $arSalons['SALON_LIST'][$count]['PROPERTIES'] = $dbProperties;
        if (!is_null($dbProperties['station_metro']['VALUE'])) {
            foreach ($dbProperties['station_metro']['VALUE'] as $keyStation => $arStation) {
                $dbStation = CIBlockElement::GetList(
                    array(),
                    array('IBLOCK_ID' => 47, 'ACITVE' => 'Y', "ID" => $arStation),
                    false,
                    false,
                    array('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PROPERTY_METRO_LINE')
                );
                if ($arStation = $dbStation->GetNext()) {
                    $arSalons['SALON_LIST'][$count]['STATION_METRO'][$keyStation] = $arStation;
                    $dbLine = CIBlockElement::GetList(
                        array(),
                        array('IBLOCK_ID' => 46, 'ACITVE' => 'Y', "ID" => $arStation),
                        false,
                        false,
                        array('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PROPERTY_METRO_COLOR_LINE')
                    );
                    if ($arLine = $dbLine->GetNext()) {
                        $arSalons['SALON_LIST'][$count]['STATION_METRO'][$keyStation]['LINE'] = $arLine;
                    }
                }
            }
        }
        $count++;
    }
    if (!empty($arSalons) && !empty($cityCode)) {
        $jsonSalons = json_encode($arSalons);
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/upload/json_salons/' . $cityCode . '.json', $jsonSalons);
    }
    return $arSalons;
}


class MyElement
{
    function OnElementUpdateHandler(&$arFields)
    {
        if ($arFields["IBLOCK_ID"] == 16) {
            $db_props = CIBlockElement::GetProperty(16, $arFields["ID"], array(), Array("CODE" => "M%_PRICE"));
            while ($prop = $db_props->Fetch()) {
                $price[$prop["CODE"]] = $prop["VALUE"];
            }
            $key1 = key($arFields["PROPERTY_VALUES"][393]);
            $key2 = key($arFields["PROPERTY_VALUES"][394]);
            $key3 = key($arFields["PROPERTY_VALUES"][395]);
            if ($price["MINIMUM_PRICE"] != $arFields["PROPERTY_VALUES"][393][$key1]["VALUE"]) {
                $arFields["PROPERTY_VALUES"][393][$key1]["VALUE"] = $price["MINIMUM_PRICE"];
            }
            if ($price["MINIMUM_OLD_PRICE"] != $arFields["PROPERTY_VALUES"][394][$key2]["VALUE"]) {
                $arFields["PROPERTY_VALUES"][394][$key2]["VALUE"] = $price["MINIMUM_OLD_PRICE"];
            }
            if ($price["MAXIMUM_PRICE"] != $arFields["PROPERTY_VALUES"][395][$key3]["VALUE"]) {
                $arFields["PROPERTY_VALUES"][395][$key3]["VALUE"] = $price["MAXIMUM_PRICE"];
            }
        }
    }

    function OnAfterIBlockElementDeleteHandler($arFields)
    {
        if ($arFields["IBLOCK_ID"] == 17) {
            $product_id = CCatalogSku::GetProductInfo($arFields["ID"])["ID"];

            $db_props = CIBlockElement::GetProperty(16, $product_id, array(), Array("CODE" => "M%_PRICE"));
            while ($prop = $db_props->Fetch()) {
                $price[$prop["CODE"]] = $prop["VALUE"];
            }

            $MIN_PRICE_PRODUCT = $price["MINIMUM_PRICE"];
            $MIN_PRICEOLD_PRODUCT = $price["MINIMUM_OLD_PRICE"];
            $MAX_PRICE_PRODUCT = $price["MAXIMUM_PRICE"];
            $arMinPrice = MyElement::get_offer_min_price($product_id);
            $MIN_PRICE = $arMinPrice[1];
            $MIN_PRICE_OLD = $arMinPrice[2];
            $MAX_PRICE = MyElement::get_offer_max_price($product_id);

            if ($MIN_PRICE_PRODUCT != $MIN_PRICE) {
                CIBlockElement::SetPropertyValuesEx($product_id, 16, array('MINIMUM_PRICE' => $MIN_PRICE));
            }
            if ($MIN_PRICEOLD_PRODUCT != $MIN_PRICE_OLD || !$MIN_PRICE_OLD) {
                CIBlockElement::SetPropertyValuesEx($product_id, 16, array('MINIMUM_OLD_PRICE' => $MIN_PRICE_OLD));
            }
            if ($MAX_PRICE_PRODUCT != $MAX_PRICE) {
                CIBlockElement::SetPropertyValuesEx($product_id, 16, array('MAXIMUM_PRICE' => $MAX_PRICE));
            }
        }
    }

    function OnBeforeIBlockElementUpdateHandler($ID, $arFields)
    {
        $product_id = CCatalogSku::GetProductInfo($arFields["PRODUCT_ID"])["ID"];

        $db_props = CIBlockElement::GetProperty(16, $product_id, array(), Array("CODE" => "M%_PRICE"));
        while ($prop = $db_props->Fetch()) {
            $price[$prop["CODE"]] = $prop["VALUE"];
        }

        $MIN_PRICE_PRODUCT = $price["MINIMUM_PRICE"];
        $MIN_PRICEOLD_PRODUCT = $price["MINIMUM_OLD_PRICE"];
        $MAX_PRICE_PRODUCT = $price["MAXIMUM_PRICE"];

        $arMinPrice = MyElement::get_offer_min_price($product_id);
        $MIN_PRICE = $arMinPrice[1];
        $MIN_PRICE_OLD = $arMinPrice[2];
        $MAX_PRICE = MyElement::get_offer_max_price($product_id);
        $offer_id = $arMinPrice[0];

        if ($offer_id != $arFields["PRODUCT_ID"]) {
            CIBlockElement::SetPropertyValuesEx($product_id, 16, array('MINIMUM_PRICE' => $MIN_PRICE));
            CIBlockElement::SetPropertyValuesEx($product_id, 16, array('MINIMUM_OLD_PRICE' => $MIN_PRICE_OLD));
        }
        if ($offer_id == $arFields["PRODUCT_ID"]) {
            CIBlockElement::SetPropertyValuesEx($product_id, 16, array('MINIMUM_PRICE' => $MIN_PRICE));
            if ($arFields["CATALOG_GROUP_ID"] == 1) {
                CIBlockElement::SetPropertyValuesEx($product_id, 16, array('MINIMUM_OLD_PRICE' => ""));
            } else {
                CIBlockElement::SetPropertyValuesEx($product_id, 16, array('MINIMUM_OLD_PRICE' => $MIN_PRICE_OLD));
            }
        }

        if ($MAX_PRICE_PRODUCT != $MAX_PRICE) {
            CIBlockElement::SetPropertyValuesEx($product_id, 16, array('MAXIMUM_PRICE' => $MAX_PRICE));
        }
    }

    public function get_offer_min_price($item_id)
    {
        if ($item_id) {
            $res = CIBlockElement::GetList(Array("CATALOG_PRICE_1" => "asc"),
                array('IBLOCK_ID' => 17, 'ACTIVE' => 'Y', 'PROPERTY_60' => $item_id, "!CATALOG_PRICE_1" => false),
                false,
                false,
                array('ID', 'IBLOCK_ID', 'NAME', 'CATALOG_PRICE_1'))->GetNext();

            if ($res) {
                $ret = GetCatalogProductPrice($res["ID"], 1);
                $retOld = GetCatalogProductPrice($res["ID"], 2);
                if ($ret['PRICE']) {
                    $ret = array($ret["PRODUCT_ID"], $ret['PRICE'], $retOld["PRICE"]);
                }
            }
        }
        return $ret;
    }

    public function get_offer_max_price($item_id)
    {
        $ret = 0;
        if ($item_id) {
            $res = CIBlockElement::GetList(Array("CATALOG_PRICE_1" => "desc"),
                array('IBLOCK_ID' => 17, 'ACTIVE' => 'Y', 'PROPERTY_60' => $item_id, "!CATALOG_PRICE_1" => false),
                false,
                false,
                array('ID', 'IBLOCK_ID', 'NAME', 'CATALOG_PRICE_1'))->GetNext();
            if ($res) {
                $ret = GetCatalogProductPrice($res["ID"], 1);
                if ($ret['PRICE']) {
                    $ret = $ret['PRICE'];
                }
            }
        }
        return $ret;
    }
}


function BeforeIndexHandler($arFields)
{
    $arrIblock = array(16);   //ID инфоблоков, для которых производить модификацию
    if (CModule::IncludeModule('iblock')
        && $arFields["MODULE_ID"] == 'iblock'
        && in_array($arFields["PARAM2"], $arrIblock)
        && intval($arFields["ITEM_ID"]) > 0) {
        $dbElement = CIblockElement::GetByID($arFields["ITEM_ID"]);
        $db_props = CIBlockElement::GetProperty(        // Запросим свойства индексируемого элемента
            $arFields["PARAM2"],         // IBLOCK_ID индексируемого свойства
            $arFields["ITEM_ID"],          // ID индексируемого свойства
            array("sort" => "asc"),         // Сортировка (можно упустить)
            Array("CODE" => "NAME3")); // CODE свойства, по которому нужно
        if ($ar_props = $db_props->Fetch()) {
            $arFields["TITLE"] = $ar_props["VALUE"] . " " . $arFields["TITLE"];
        }   // Добавим свойство в конец заголовка индексируемого элемента
        return $arFields;
    }
}


/*function OnAfterAdd(\Bitrix\Main\Entity\Event $event) {
//id добавляемого элемента
	$id = $event->getParameter("id");

	$f = fopen ($_SERVER['DOCUMENT_ROOT']."/bitrix/testPatternReferenceOnAfterAdd.log", "a+");
	fwrite ($f, print_r (array("start" , date ("r")),true));
	fwrite($f, $id."\n\t");
	$arFields = $event->getParameter("fields");
	fwrite($f, $arFields["UF_XML_ID"]."\n\t");


	try {
		\Defo\Agents\BalanceAgent::updateBalanceById($arFields["UF_XML_ID"]);
	} catch (Exception $e){
		fwrite($f, 'Выброшено исключение: '. $e->getMessage() . "\n\t");
	}
	fclose($f);
}
*/

function dropName(&$arFields)
{
    if (@$_REQUEST['mode'] == 'import') {
        $fp = fopen($_SERVER['DOCUMENT_ROOT'] . '/priceName.log', 'a');
        fwrite($fp, $arFields['CODE'] . " -- " . $arFields['NAME'] . "\n");

        unset($arFields['NAME']);
        unset($arFields['CODE']);
    }
}


use Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem;


class EventSend
{
    //template name list
    private static $arTemplateList = array(
        'SALE_STATUS_CHANGED_S', //заказ подтвержден
        'SALE_STATUS_CHANGED_P', //заказ Оплачен
        'SALE_STATUS_CHANGED_F', //заказ выполнен
        'SALE_STATUS_CHANGED_N', //заказ принят
        'SALE_ORDER_CANCEL', //отмена заказа
    );

    function my_OnBeforeEventSend(&$arFields, &$arTemplate)
    {
        /*$f = fopen($_SERVER['DOCUMENT_ROOT']. '/sale_order_event.log', 'a');
        fwrite($f, var_export($arFields, true));
        fwrite($f, var_export($arTemplate, true));*/

        $orderId = $arFields['ORDER_ID'];
        $arOrderPropsValue = self::getOrderPropsValue($orderId);

        $arCityProps = self::getPropsCityByLocationID($arOrderPropsValue['LOCATION']['VALUE']);
        $arOrderPropsValue['LOCATION']['VALUE'] = $arCityProps['NAME'];

        $arSaleToManager = $arFields;
        $arSaleToManager['SALE_EMAIL'] = $arCityProps['PROPERTY_EMAIL_BACK_CALL_VALUE'];

        //send order info to sale managers
        if ($arTemplate['EVENT_NAME'] == 'SALE_NEW_ORDER') {
            if ($arTemplate['LID'] == 'ro') {
                $arFields = self::getArFieldsOrderSend($orderId, $arFields, $arOrderPropsValue, $arCityProps);
                $arFields['SALE_EMAIL'] = $arCityProps['PROPERTY_EMAIL_BACK_CALL_VALUE'];
                $arFields['EMAIL'] = $arOrderPropsValue['EMAIL']['VALUE'];
                $arSaleToManager = $arFields;
            }
            $arSaleToManager['BCC'] = '';
            /*$fpost = fopen ($_SERVER['DOCUMENT_ROOT']. '/sale_order_event_post.log', 'a');
            fwrite($fpost, '-------');
            fwrite($fpost, var_export($arSaleToManager, true));*/
            CEvent::Send("SALE_NEW_ORDER _MANAGER", $arTemplate['LID'], $arSaleToManager);
        } elseif (in_array($arTemplate['EVENT_NAME'], self::$arTemplateList)) {
            $arFields['SALE_EMAIL'] = $arSaleToManager['SALE_EMAIL'];
            $arFields = self::getArFieldsOrderSend($orderId, $arFields, $arOrderPropsValue, $arCityProps);
        }
    }

    static function getArFieldsOrderSend($orderId, $arFields, $arOrderPropsValue, $arCityProps)
    {
        $arFields['ORDER_LIST'] = $arSaleToManager['ORDER_LIST'] = self::getBasketList($orderId);
        $arOrderProps = self::getOrderParams($arFields["ORDER_ID"]);

        if ($arOrderProps['ADDITIONAL_INFO']) {
            $arFields['ORDER_USER'] = $arOrderPropsValue['FIO']['VALUE'];
            $arAdditionalInfo = explode(';', $arOrderProps['ADDITIONAL_INFO']);

            $arOrderPropsValue["DELIVERY_COST"] = $arAdditionalInfo[0];
            // override "Да" галок на стоимость услуг
            $arOrderPropsValue["FLOORING_COST"] = $arAdditionalInfo[1];
            $arOrderPropsValue["ASSEMBLING_COST"] = $arAdditionalInfo[2];
            $arOrderPropsValue["GARBAGE_REMOVAL_COST"] = $arAdditionalInfo[3];

            $arFields['COST_LIST'] = self::getHtmlAdditionalInfo($arOrderPropsValue, $arOrderProps);

            $arFields['DELIVERY_INFO'] = self::getHtmlDeliveryInfo($arOrderProps['DELIVERY_ID'], $arOrderPropsValue,
                $arCityProps['PROPERTY_PICKUP_PLACE_VALUE']);

            $arFields['PAYSYSTEM'] = self::getPaySystemProps($arOrderProps['PAY_SYSTEM_ID'])['NAME'];
            $arFields['DATE_PAYED'] = $arOrderProps['DATE_PAYED'];
            $arFields['COMMENTS'] = $arOrderProps['COMMENTS'];
            $arFields['PRICE'] = CurrencyFormat($arOrderProps['PRICE'], $arOrderProps['CURRENCY']);
            if (CModule::IncludeModule("sale")) {
                $arFields['DELIVERY_NAME'] = CSaleDelivery::GetByID($arOrderProps['DELIVERY_ID'])['NAME'];
            }
            $arFields['DELIVERY_PRICE'] = CurrencyFormat($arOrderPropsValue["DELIVERY_COST"],
                $arOrderProps['CURRENCY']);
            if ($arOrderProps['PAY_SYSTEM_ID'] == 11) {
                $payLink = 'https://' . $_SERVER['SERVER_NAME'] . '/personal/order/pay?ORDER_ID=' . $orderId;
                $arFields['PAY_ONLINE'] = '<a href="' . $payLink . '" style="text-decoration: none; 
				background-color: #478AB5; color: #fff; border-radius: 4px; font-size: 14px; 
				border-top: 12px solid #478AB5; border-bottom: 12px solid #478AB5; border-left: 33px solid #478AB5; 
				border-right: 33px solid #478AB5; font-weight: bold;">ОПЛАТИТЬ</a>';
            }
            $f = fopen($_SERVER['DOCUMENT_ROOT'] . '/sale_arfields.log', 'a');
            fwrite($f, var_export($arFields, true));
            fwrite($f, var_export($arOrderProps, true));

            return $arFields;
        }
    }

    static function getHtmlAdditionalInfo($arOrderPropsValue, $arOrderProps)
    {
        $htmlAdditionalInfo = '<table cellspacing="0" style="font-size:14px;display:inline-table;"><tbody>';
        if ($arOrderPropsValue['DELIVERY_COST']) {
            $htmlAdditionalInfo .= '<tr><td>Стоимость доставки:</td><td style="text-align:right;font-weight:bold;">' . CCurrencyLang::CurrencyFormat($arOrderPropsValue["DELIVERY_COST"],
                    $arOrderProps['CURRENCY']) . '</td></tr>';
        }

        if ($arOrderPropsValue['FLOORING_COST'] and $arOrderPropsValue['FLOORING_COST'] > 0) {
            $htmlAdditionalInfo .= '<tr><td>Подъем на этаж:</td><td style="text-align:right;font-weight:bold;">' . CCurrencyLang::CurrencyFormat($arOrderPropsValue["FLOORING_COST"],
                    $arOrderProps['CURRENCY']) . '</td></tr>';
        }

        if ($arOrderPropsValue['ASSEMBLING_COST'] and $arOrderPropsValue['ASSEMBLING_COST'] > 0) {
            $htmlAdditionalInfo .= '<tr><td>Сборка мебели:</td><td style="text-align:right;font-weight:bold;">' . CCurrencyLang::CurrencyFormat($arOrderPropsValue["ASSEMBLING_COST"],
                    $arOrderProps['CURRENCY']) . '</td></tr>';
        }
        if ($arOrderPropsValue['GARBAGE_REMOVAL_COST'] and $arOrderPropsValue['GARBAGE_REMOVAL_COST'] > 0) {
            $htmlAdditionalInfo .= '<tr><td>Вывоз упаковки:</td><td style="text-align:right;font-weight:bold;">' . CCurrencyLang::CurrencyFormat($arOrderPropsValue["GARBAGE_REMOVAL_COST"],
                    $arOrderProps['CURRENCY']) . '</td></tr>';
        }
        if ($arOrderPropsValue['ORDER_TOTAL_PRICE_FORMATED']) {
            $htmlAdditionalInfo .= '<tr style="font-size:16px;font-weight:bold;"><td>Стоимость заказа: </td><td style="text-align:right;">' . CCurrencyLang::CurrencyFormat($arOrderProps['PRICE'],
                    $arOrderProps['CURRENCY']) . '</td></tr>';
        }
        $htmlAdditionalInfo .= '</tbody></table>';
        return $htmlAdditionalInfo;
    }

    static function getHtmlDeliveryInfo($deliveryId, $arOrderPropsValue, $pickupPlace)
    {
        unset($arOrderPropsValue["DELIVERY_COST"], $arOrderPropsValue["FLOORING_COST"], $arOrderPropsValue["ASSEMBLING_COST"], $arOrderPropsValue["GARBAGE_REMOVAL_COST"], $arOrderPropsValue['ZIP']);
        $deliveryAddressByService = !empty($arOrderPropsValue["LOCATION"]['VALUE']) ? $arOrderPropsValue["LOCATION"]['VALUE'] . ", " : "";
        $deliveryAddressByService .= !empty($arOrderPropsValue["STREET"]['VALUE']) ? $arOrderPropsValue["STREET"]['VALUE'] . " " : "";
        $deliveryAddressByService .= !empty($arOrderPropsValue["HOUSE_NUMBER"]['VALUE']) ? "д." . $arOrderPropsValue["HOUSE_NUMBER"]['VALUE'] . " " : "";
        $deliveryAddressByService .= !empty($arOrderPropsValue["HOUSING"]['VALUE']) ? "к." . $arOrderPropsValue["HOUSING"]['VALUE'] . " " : "";
        $deliveryAddressByService .= !empty($arOrderPropsValue["FLOOR"]['VALUE']) ? $arOrderPropsValue["FLOOR"]['VALUE'] . " этаж " : "";
        $deliveryAddressByService .= !empty($arOrderPropsValue["ROOM"]['VALUE']) ? "кв." . $arOrderPropsValue["ROOM"]['VALUE'] : "";

        unset($arOrderPropsValue['LOCATION'], $arOrderPropsValue['STREET'], $arOrderPropsValue['HOUSE_NUMBER']);
        unset($arOrderPropsValue['HOUSING'], $arOrderPropsValue['FLOOR'], $arOrderPropsValue['ROOM']);

        $deliveryAddress['TYPE'] = $deliveryId == 3 ? 'Адрес доставки' : 'Адрес самовывоза';
        $deliveryAddress['ADDRESS'] = $deliveryId == 3 ? $deliveryAddressByService : htmlspecialchars_decode($pickupPlace);

        $deliveryInfo = '<table style="font-size:14px;"><tbody>';
        $deliveryInfo .= '<tr><td colspan="2" style="color:#777;">' . $deliveryAddress['TYPE'] . '</td></tr>';
        $deliveryInfo .= '<tr><td colspan="2" style="font-weight:bold;">' . $deliveryAddress['ADDRESS'] . '</td></tr>';
        /*$f = fopen($_SERVER['DOCUMENT_ROOT'].'/sale_delivery_info.log', 'a');
        fwrite ($f, '-----------------------');*/
        foreach ($arOrderPropsValue as $arKey => $arProp) {
            /*fwrite($f, var_export($arKey, true));
            fwrite($f, var_export($arProp, true));*/
            $deliveryInfo .= '<tr><td style="color:#777;vertical-align:top;">' . $arProp["NAME"] . ':</td><td style="text-align:right;font-weight:bold;vertical-align:top;">' . $arProp["VALUE"] . '</td></tr>';
        }
        $deliveryInfo .= '</tbody></table>';

        return $deliveryInfo;
    }

    static function getButtonPayedOnline($orderId)
    {
        Bitrix\Main\Loader::includeModule("sale");
        $order = Sale\Order::load($orderId);
        //var_dump($order);


        //$service = new \Bitrix\Sale\PaySystem\Service(self::getPaySystemProps($order->getPaymentSystemId()));
        //dump($service);

        //if($service) {
        $paymentCollection = $order->getPaymentCollection();
        //dump($paymentCollection);
        foreach ($paymentCollection as $payment) {
            //dump($payment);
            $paymentIdCollection = $payment->getField('ID');
            //var_dump('getPaySystem');
            $service = $payment->getPaySystem();
        }
        //dump($order->getPaymentSystemId());
        if ($paymentCollection) {
            $paymentItem = $paymentCollection->getItemById($paymentIdCollection);
            //var_dump($paymentItem);
            if ($paymentItem && $service) {
                $initResult = $service->initiatePay($paymentItem, null, Sale\PaySystem\BaseServiceHandler::STRING);
                //dump($initResult);
                if ($initResult->isSuccess()) {
                    //var_dump($initResult->getTemplate());
                    return $initResult->getTemplate();
                }
            }
        }
        //}
    }

    static function getPropsCityByLocationID($locationId)
    {
        if (!CModule::IncludeModule("iblock")) {
            return null;
        }
        $dbCity = CIBlockElement::GetList(
            array(),
            array('IBLOCK_ID' => 21, 'PROPERTY_LOCATION' => $locationId, 'ACTIVE' => 'Y'),
            array(
                'IBLOCK_ID',
                'ID',
                'NAME',
                'PROPERTY_LOCATION',
                'PROPERTY_EMAIL_BACK_CALL',
                'PROPERTY_PICKUP_PLACE',
                'PROPERTY_YAK_SHOPID',
                'PROPERTY_YAK_SCID'
            )
        );

        $arCity = $dbCity->Fetch();

        return $arCity;
    }

    static function getOrderPropsValue($orderId)
    {
        if (CModule::IncludeModule("sale")) {

            $dbOrderProps = CSaleOrderPropsValue::GetOrderProps($orderId);
            while ($arOrderProp = $dbOrderProps->Fetch()) {
                $arOrderProps[$arOrderProp['CODE']] = $arOrderProp;
            }

            return $arOrderProps;
        }
    }

    static function getPaySystemProps($payId)
    {
        return CModule::IncludeModule("sale") ? CSalePaySystem::GetByID($payId) : null;
    }

    static function getOrderParams($orderId)
    { // полчуение данных заказа
        $arPropOrderIsNeed = array(
            'PRICE',
            'CURRENCY',
            'ADDITIONAL_INFO',
            'COMMENTS',
            'DELIVERY_ID',
            'PAY_SYSTEM_ID',
            'PAYED',
            'DATE_PAYED',
        );
        if (CModule::IncludeModule("sale")) {
            $dbSale = CSaleOrder::GetList(array(), array("ID" => $orderId));
            while ($arSale = $dbSale->Fetch()) {
                foreach ($arSale as $item => $value) {
                    if (in_array($item, $arPropOrderIsNeed)) {
                        $arSaleCut[$item] = $value;
                    }
                }
            }


        }
    }

    static function getArrayBasketList($orderId)
    {
        if (!CModule::IncludeModule("sale")) {
            return null;
        }
        $arBasketList = array();
        $dbBasketItems = CSaleBasket::GetList(
            array("ID" => "ASC"),
            array("ORDER_ID" => $orderId),
            false,
            false,
            array("ID", "PRODUCT_ID", "NAME", "QUANTITY", "PRICE", "CURRENCY", "TYPE", "SET_PARENT_ID")
        );
        while ($arItem = $dbBasketItems->Fetch()) {
            if (CSaleBasketHelper::isSetItem($arItem)) {
                continue;
            }

            $arBasketList[] = $arItem;
            $arBasketId[] = $arItem["ID"];
        }

        $arBasket["LIST"] = $arBasketList;
        $arBasket["ID"] = $arBasketId;

        return $arBasket;

    }

    static function getBasketList($orderId)
    {
        if (!CModule::IncludeModule("sale")) {
            return null;
        }
        /*$arBasketList = array();
        $dbBasketItems = CSaleBasket::GetList(
            array("ID" => "ASC"),
            array("ORDER_ID" => $orderId),
            false,
            false,
            array("ID", "PRODUCT_ID", "NAME", "QUANTITY", "PRICE", "CURRENCY", "TYPE", "SET_PARENT_ID")
        );
        while ($arItem = $dbBasketItems->Fetch())
        {
            if (CSaleBasketHelper::isSetItem($arItem))
                continue;

            $arBasketList[] = $arItem;
            $arBasketId[] = $arItem["ID"];
        }*/
        $arBasket = self::getArrayBasketList($orderId);
        $arBasketList = $arBasket["LIST"];
        $arBasketId = $arBasket["ID"];

        $arBasketList = getMeasures($arBasketList);

        //select props from basket
        $arPropsFilter = array("BASKET_ID" => $arBasketId);
        //if ($bXmlId == "N")
        $arPropsFilter["!CODE"] = array("PRODUCT.XML_ID", "CATALOG.XML_ID");

        $dbBasketPropsTmp = CSaleBasket::GetPropsList(
            array("BASKET_ID" => "ASC", "SORT" => "ASC", "NAME" => "ASC"),
            $arPropsFilter,
            false,
            false,
            array("ID", "BASKET_ID", "NAME", "VALUE", "CODE", "SORT")
        );
        while ($arBasketPropsTmp = $dbBasketPropsTmp->Fetch()) {
            $arBasketProps[$arBasketPropsTmp["BASKET_ID"]][] = $arBasketPropsTmp;
        }

        if (!empty($arBasketList) && is_array($arBasketList)) {
            $strOrderList = '<table cellspacing="0" style="font-size:14px;width:100%;border-collapse:collapse;"><tbody>';
            $strOrderList .= '<tr style="color:#777;border-bottom:1px solid #ddd;height:40px;"><td>Артикул</td><td style="width:40%;">Наименование</td><td>Количество</td><td>Цена товара</td><td>Сумма</td></tr>';
            foreach ($arBasketList as $arItem) {
                $measureText = (isset($arItem["MEASURE_TEXT"]) && strlen($arItem["MEASURE_TEXT"])) ? $arItem["MEASURE_TEXT"] : GetMessage("SOA_SHT");

                /*$strOrderList .= $arItem["NAME"]." - ".$arItem["QUANTITY"]." ".$measureText.": ".SaleFormatCurrency($arItem["PRICE"], $arItem["CURRENCY"]);
                $strOrderList .= "\n";*/

                $strOrderList .= '<tr style="border-bottom:1px solid #ddd;height:40px;">';
                $strOrderList .= '<td>' . $arBasketProps[$arItem["ID"]][0]["VALUE"] . '</td>';
                $strOrderList .= '<td style="font-weight:bold;">' . $arItem["NAME"] . '</td>';
                $strOrderList .= '<td>' . $arItem["QUANTITY"] . '</td>';
                $strOrderList .= '<td>' . SaleFormatCurrency($arItem["PRICE"], $arItem["CURRENCY"]) . '</td>';
                $strOrderList .= '<td style="font-weight:bold;">' . SaleFormatCurrency($arItem["PRICE"] * intVal($arItem["QUANTITY"]),
                        $arItem["CURRENCY"]) . '</td></tr>';
            }
            $strOrderList .= '</tbody></table>';
        }

        return $strOrderList; // таблица с товарами заказа
    }
}


function success1c($arParams, $arFields)
{
    if (preg_match("/prices__/", $arFields)) {
        //include("changeprice.php");
        $f = fopen($_SERVER['DOCUMENT_ROOT'] . "/bitrix/OnSuccessCatalogImport1C.log", "a+");
        $time = date("d.m.Y H:i:s");
        fwrite($f, $time . " start\n");
        fwrite($f, "\n-------------------------------------------------------------------------------\n");
        fwrite($f, var_export($arParams, true));
        fwrite($f, "\n-------------------------------------------------------------------------------\n");
        fwrite($f, var_export($arFields, true));
        fwrite($f, "\n-------------------------------------------------------------------------------\n");

    } else {
        $f2 = fopen($_SERVER['DOCUMENT_ROOT'] . "/log/OnSuccessCatalogImport1Cnew.log", "a+");
        $time = date("d.m.Y H:i:s");
        fwrite($f2, $time . " start\n");
        fwrite($f2, "\n-------------------------------------------------------------------------------\n");
        fwrite($f2, var_export($arParams, true));
        fwrite($f2, "\n-------------------------------------------------------------------------------\n");
        fwrite($f2, var_export($arFields, true));
        fwrite($f2, "\n-------------------------------------------------------------------------------\n");
    }
}

AddEventHandler("catalog", "OnBeforeCatalogImport1C", "warning1c");
function warning1c($arParams, $arFields)
{
    $f2 = fopen($_SERVER['DOCUMENT_ROOT'] . "/log/OnBeforeCatalogImport1C.log", "a+");
    fwrite($f2, var_export($arFields, true));
    fwrite($f2, "\n");
}


function savingCurrentPrice($ID)
{
    if ($_REQUEST["mode"] == "import" && preg_match("/prices__/", $_REQUEST["filename"])) {
        $f = fopen($_SERVER['DOCUMENT_ROOT'] . "/bitrix/OnBeforePriceDelete.log", "a+");
        fwrite($f, "\n-----------------------------------------------------------------------------------\n");
        fwrite($f, var_export($ID, true));
        $arPrice = CPrice::GetByID($ID);
        fwrite($f, "\n-------arPrice----------------------------------------------------------------------------\n");
        fwrite($f, var_export($arPrice, true));
        fwrite($f,
            "\n---------end arPrice--------------------------------------------------------------------------\n");

        if (in_array($arPrice["CATALOG_GROUP_ID"], array(1, 2, 6, 7))) {
            return false;
        }

    }
}


function savingCurrentPrice2(&$arFields)
{
    $f = fopen($_SERVER['DOCUMENT_ROOT'] . "/bitrix/OnBeforePriceAdd.log", "a+");
    $f2 = fopen($_SERVER['DOCUMENT_ROOT'] . "/log/AcRRcPriceAdd.log", "a+");
    fwrite($f, var_export($_REQUEST, true));
    fwrite($f, var_export($arFields, true));
    if ($_REQUEST["mode"] == "import" && preg_match("/prices__/", $_REQUEST["filename"])) {
        if ($arFields["CATALOG_GROUP_ID"] == 4) {
            $timestamp = ConvertTimeStamp(time(), 'FULL');
            CIBlockElement::SetPropertyValueCode($arFields["PRODUCT_ID"], "TIME_RRC", $timestamp);
            fwrite($f2, "TIME_RRC: $timestamp\n");
        }
        if ($arFields["CATALOG_GROUP_ID"] == 5) {
            $timestamp = ConvertTimeStamp(time(), 'FULL');
            CIBlockElement::SetPropertyValueCode($arFields["PRODUCT_ID"], "TIME_AC", $timestamp);
            fwrite($f2, "TIME_AC : $timestamp\n");
        }
    }


}

function savingCurrentPrice3($ID, &$arFields)
{
    if ($_REQUEST["mode"] == "import" && preg_match("/prices__/", $_REQUEST["filename"])) {
        if ($arFields["CATALOG_GROUP_ID"] == 4) {
            $timestamp = ConvertTimeStamp(time(), 'FULL');
            CIBlockElement::SetPropertyValueCode($arFields["PRODUCT_ID"], "TIME_RRC", $timestamp);
        }
        if ($arFields["CATALOG_GROUP_ID"] == 5) {
            $timestamp = ConvertTimeStamp(time(), 'FULL');
            CIBlockElement::SetPropertyValueCode($arFields["PRODUCT_ID"], "TIME_AC", $timestamp);
        }
    }
}


function deleteStore($id)
{
    $dbResult = CCatalogStore::GetList(
        array(),
        array("ID" => $id),
        array("XML_ID")
    );
    $item = $dbResult->getNext();
    $dbResult = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 50, "XML_ID" => $item["XML_ID"]), false, false,
        array("ID", "IBLOCK_ID"));
    $item = $dbResult->getNext();
    CIBlockElement::Delete($item["ID"]);
}

AddEventHandler("main", "OnAdminTabControlBegin", "MyOnAdminTabControlBegin");
function MyOnAdminTabControlBegin(&$form)
{
    if ($GLOBALS["APPLICATION"]->GetCurPage() == "/bitrix/admin/1c_admin.php") {

        $pricestart = COption::GetOptionString('defo.log1c', 'defo_log_pricestart');
        $priceend = COption::GetOptionString('defo.log1c', 'defo_log_priceend');
        $priceinterval = COption::GetOptionString('defo.log1c', 'defo_log_priceinterval');
        $storestart = COption::GetOptionString('defo.log1c', 'defo_log_storestart');
        $storeend = COption::GetOptionString('defo.log1c', 'defo_log_storeend');
        $storeinterval = COption::GetOptionString('defo.log1c', 'defo_log_storeinterval');
        $historyinterval = COption::GetOptionString('defo.log1c', 'defo_log_historyinterval');
        $emails = COption::GetOptionString('defo.log1c', 'defo_log_emails');

        $form->tabs[] = array(
            "DIV" => "my_edit",
            "TAB" => "Настройка уведомлений об ошибках",
            "ICON" => "main_user_edit",
            "TITLE" => "Настройка уведомлений об ошибках",
            "CONTENT" =>
                '<tr class="heading">
				<td id="td_extended_options" colspan="2">Цены</td>
			</tr>
			<tr valign="top">
				<td>С какого часа проверять выгрузку цен</td>
				<td><input type="text" size="2" name="pricestart" value="' . $pricestart . '"> <small>*. Указывается только час в виде числа, без минут</small></td>
			</tr>
			<tr valign="top">
				<td>До какого часа проверять выгрузку цен</td>
				<td><input type="text" size="2" name="priceend" value="' . $priceend . '"></td>
			</tr>
			<tr valign="top">
				<td>Критическое время для отсутствия цен</td>
				<td><input type="text" size="2" name="priceinterval" value="' . $priceinterval . '"><small> *. В секундах</small></td>
			</tr>
			<tr class="heading">
				<td id="td_extended_options" colspan="2">Остатки</td>
			</tr>
			<tr valign="top">
				<td>С какого часа проверять выгрузку остатков</td>
				<td><input type="text" size="2" name="storestart" value="' . $storestart . '"> <small>*. Указывается только час в виде числа, без минут</small></td>
			</tr>
			<tr valign="top">
				<td>До какого часа проверять выгрузку остатков</td>
				<td><input type="text" size="2" name="storeend" value="' . $storeend . '"></td>
			</tr>
			<tr valign="top">
				<td>Критическое время для отсутствия остатков</td>
				<td><input type="text" size="2" name="storeinterval" value="' . $storeinterval . '"><small> *. В секундах</small></td>
			</tr>
			<tr class="heading">
				<td id="td_extended_options" colspan="2">Общие настройки</td>
			</tr>
			<tr valign="top">
				<td>Сколько времени хранить журнал</td>
				<td><input type="text" size="3" name="historyinterval" value="' . $historyinterval . '"><small> *. В днях</small></td>
			</tr>
			<tr valign="top">
				<td>На какие емейлы отправлять</td>
				<td><input type="text" size="50" name="emails" value="' . $emails . '"><small> *. Список емейлов через запятую</small></td>
			</tr>
'
        );
    }
}

AddEventHandler('main', 'OnBeforeProlog', 'MyOnBeforePrologHandler');
function MyOnBeforePrologHandler()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $GLOBALS['APPLICATION']->GetCurPage() == '/bitrix/admin/1c_admin.php') {
        COption::SetOptionString('defo.log1c', 'defo_log_pricestart', $_REQUEST['pricestart']);
        COption::SetOptionString('defo.log1c', 'defo_log_priceend', $_REQUEST['priceend']);
        COption::SetOptionString('defo.log1c', 'defo_log_priceinterval', $_REQUEST['priceinterval']);
        COption::SetOptionString('defo.log1c', 'defo_log_storestart', $_REQUEST['storestart']);
        COption::SetOptionString('defo.log1c', 'defo_log_storeend', $_REQUEST['storeend']);
        COption::SetOptionString('defo.log1c', 'defo_log_storeinterval', $_REQUEST['storeinterval']);
        COption::SetOptionString('defo.log1c', 'defo_log_historyinterval', $_REQUEST['historyinterval']);
        COption::SetOptionString('defo.log1c', 'defo_log_emails', $_REQUEST['emails']);
    }
}

AddEventHandler("catalog", "OnSuccessCatalogImport1C", "successImport");
function successImport($arParams, $arFields)
{
    \Bitrix\Main\Loader::IncludeModule("defo.log1c");

    $file = file_get_contents($arFields);
    $count = mb_substr_count($file, '<Предложение>');
    $arLog = array(
        "STATUS" => "SUCCESS",
        "AMOUNT" => $count,
        "DATE" => date("Y-m-d H:i:s", time())
    );

    if (preg_match("/prices__/", $arFields)) {
        $arLog["TYPE"] = "prices";
        $arLog["TEXT"] = "Получены цены у $count товаров";
    }
    if (preg_match("/offers__/", $arFields)) {
        $arLog["TYPE"] = "offers";
        $arLog["TEXT"] = "Получены обновления у $count товаров";
    }
    if (preg_match("/rests__/", $arFields)) {
        $arLog["TYPE"] = "rests";
        $arLog["TEXT"] = "Получены остатки у $count товаров";
    }
    if (preg_match("/import__/", $arFields)) {
        $arLog["TYPE"] = "import";
        $arLog["TEXT"] = "Обновлены товары, группы (разделы инфоблока), типы цен и т.д.";
    }
    DLog::add($arLog);


}


AddEventHandler('main', 'OnBeforeEventSend', "OnBeforeEventSendHandle");
function OnBeforeEventSendHandle(&$arFields, &$arTemplate)
{

    $log = fopen($_SERVER['DOCUMENT_ROOT'] . "/log/OnBeforeEventSend.log", "a+");
    fwrite($log, "\n-----------------------------arFields: ------------------------------------\n");
    fwrite($log, var_export($arFields, true));
    fwrite($log, "\n-----------------------------end arFields ---------------------------------\n");
    fwrite($log, "\n-----------------------------arTemplate: ----------------------------------\n");
    fwrite($log, var_export($arTemplate, true));
    fwrite($log, "\n-----------------------------end arTemplate--------------------------------\n");

    if ($arFields["RS_FORM_VARNAME"] or $arTemplate["EVENT_NAME"]) {
        $formName = $arTemplate["EVENT_NAME"];
        if ($arFields["RS_FORM_VARNAME"]) {
            $formName = $arFields["RS_FORM_VARNAME"];
        }
        $regionId = $arFields["REGION_ID"];
	
	CModule::IncludeModule('iblock');
        $fields = CIBlockElement::GetList(array(), array("IBLOCK_ID" => 62, "ACTIVE" => "Y", "CODE" => $formName),
            false, false, array("IBLOCK_ID", "ID", "CODE", "NAME"))->GetNext();
        if ($fields) {
            $res = CIBlockElement::GetList(array(), array(
                "IBLOCK_ID" => 63,
                "ACTIVE" => "Y",
                "PROPERTY_TYPE_ORDER" => $fields["ID"],
                "PROPERTY_REGION" => $regionId,
                "!PROPERTY_EMAIL" => false
            ), false, false, array("IBLOCK_ID", "ID", "NAME", "PROPERTY_*"));
            while ($ob = $res->getNextElement()) {
                $arProps = $ob->GetProperties();
                $emails[] = $arProps["EMAIL"]["VALUE"];
            }
            $emails = implode(",", $emails);
            $arFields["FORM_EMAIL_TO"] = $emails;
        }
        if ($_SERVER['HTTP_REFERER']) {
            $arFields['HTTP_REFERER'] = $_SERVER['HTTP_REFERER'];
        }
    }
    if ($arFields["EMAIL_RAW"]) {
        $arFields["EMAIL"] = $arFields["EMAIL_RAW"];
    }

    fwrite($log, "\n-----------------------------emails: ------------------------------------\n");
    fwrite($log, var_export($emails, true));
    fwrite($log, "\n-----------------------------end emails ---------------------------------\n");
}

AddEventHandler('form', 'onBeforeResultAdd', 'onBeforeResultAddHandle');
function onBeforeResultAddHandle($WEB_FORM_ID, &$arFields, &$arrVALUES)
{
    global $arRegion;

    foreach ($arrVALUES as $key => $item) {
        if (preg_match("/^form_hidden_\d+$/", $key) && $item == "REGION") {
            $arrVALUES[$key] = $arRegion["NAME"];
        }
    }
}

function GetMarks($select = ['*'], $filter = [])
{
    $hl = Bitrix\Highloadblock\HighloadBlockTable::getById(15)->fetch();
    $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hl);
    $entityClass = $entity->getDataClass();
    $res = $entityClass::getList([
        'select' => $select,
        'filter' => $filter,
    ]);
    $tizers = [];
    while ($el = $res->fetch()) {
        $tizers[$el['ID']] =
            [
                'ID' => $el['ID'],
                'NAME' => $el['UF_DESC'],
                'UF_DESCRIPTION' => $el['UF_DESCRIPTION'],
                'TAB_NAME' => $el['UF_NAME'],
                'UF_XML_ID' => $el['UF_XML_ID'],
                'SRC' => CFile::GetPath($el['UF_PICTURE']),
            ];
    }
    return $tizers;

}

function GetGroups($select = ['*'], $filter = [])
{
    $hl = Bitrix\Highloadblock\HighloadBlockTable::getById(17)->fetch();
    $entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hl);
    $entityClass = $entity->getDataClass();
    $res = $entityClass::getList([
        'select' => $select,
        'filter' => $filter,
    ]);
    $tizers = [];
    while ($el = $res->fetch()) {
        $tizers[$el['ID']] =
            [
                'ID' => $el['ID'],
                'NAME' => $el['UF_DESC'],
                'PODBORKI' => $el['UF_PODBORKA'],
                'TAB_NAME' => $el['UF_NAME'],

            ];
    }
    return $tizers;

}

AddEventHandler("sale", "OnOrderAdd", "OnOrderAdd2Quick");
function OnOrderAdd2Quick($intOrderID, $arFields){
    require_once($_SERVER["DOCUMENT_ROOT"] . '/ddsdev/tcpdf/tcpdf.php');
    /**
     * @param $num
     * @return string
     */
    function num2str($num)
    {
        $nul = 'ноль';
        $ten = array(
            array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
            array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
        );
        $a20 = array(
            'десять',
            'одиннадцать',
            'двенадцать',
            'тринадцать',
            'четырнадцать',
            'пятнадцать',
            'шестнадцать',
            'семнадцать',
            'восемнадцать',
            'девятнадцать'
        );
        $tens = array(
            2 => 'двадцать',
            'тридцать',
            'сорок',
            'пятьдесят',
            'шестьдесят',
            'семьдесят',
            'восемьдесят',
            'девяносто'
        );
        $hundred = array(
            '',
            'сто',
            'двести',
            'триста',
            'четыреста',
            'пятьсот',
            'шестьсот',
            'семьсот',
            'восемьсот',
            'девятьсот'
        );
        $unit = array( // Units
            array('копейка', 'копейки', 'копеек', 1),
            array('рубль', 'рубля', 'рублей', 0),
            array('тысяча', 'тысячи', 'тысяч', 1),
            array('миллион', 'миллиона', 'миллионов', 0),
            array('миллиард', 'милиарда', 'миллиардов', 0),
        );
        //
        list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
        $out = array();
        if (intval($rub) > 0) {
            foreach (str_split($rub, 3) as $uk => $v) { // by 3 symbols
                if (!intval($v)) {
                    continue;
                }
                $uk = sizeof($unit) - $uk - 1; // unit key
                $gender = $unit[$uk][3];
                list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2 > 1) {
                    $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3];
                } # 20-99
                else {
                    $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3];
                } # 10-19 | 1-9
                // units without rub & kop
                if ($uk > 1) {
                    $out[] = morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
                }
            } //foreach
        } else {
            $out[] = $nul;
        }
        $out[] = morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
        $out[] = $kop . ' ' . morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
        return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
    }

    /**
     * @param $n
     * @param $f1
     * @param $f2
     * @param $f5
     * @return mixed
     */
    function morph($n, $f1, $f2, $f5)
    {
        $n = abs(intval($n)) % 100;
        if ($n > 10 && $n < 20) {
            return $f5;
        }
        $n = $n % 10;
        if ($n > 1 && $n < 5) {
            return $f2;
        }
        if ($n == 1) {
            return $f1;
        }
        return $f5;
    }

    /**
     * @return string
     */
    function getUrl() {
        $url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
        $url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
        return $url;
    }
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', '', array(0, 64, 255), array(0, 64, 128));
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    $pdf->setPrintFooter(false);
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


    $pdf->SetMargins(20, 25, 20);
    $pdf->SetHeaderMargin(10);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    $pdf->setFontSubsetting(true);
    $pdf->SetFont('dejavusans', '', 14, '', true);
    $pdf->AddPage();


    $basket = Sale\Order::load($intOrderID)->getBasket();
    $basketItems = $basket->getOrderableItems();
    $allVatSum = $basketItems->getVatSum();
    $allSum = $basketItems->getBasePrice();
    $allDiscountSum = $basketItems->getPrice();
    $vatRate = $basketItems->getVatRate();

    $arProductsIDs = [];
    foreach ($basketItems as $basketItem) {
        $mxResult = CCatalogSku::GetProductInfo(
            $basketItem->getProductId()
        );
        if (is_array($mxResult)) {
            $arProductsIDs[$mxResult['ID']] = $mxResult['ID'];
        } else {
            $arProductsIDs[$basketItem->getProductId()] = $basketItem->getProductId();
        }
    }

    if (!empty($arProductsIDs)) {
        $select = Array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_*');
        $filter = Array('IBLOCK_ID' => 17, 'ID' => $arProductsIDs);
        $res = CIBlockElement::GetList(Array(), $filter, false, false, $select);
        while ($ob = $res->GetNextElement()) {
            $fields = $ob->GetFields();
            $fields ['PROPERTIES'] = $ob->GetProperties();
            $arProducts[$fields['ID']] = $fields;
        }
    }
    foreach ($basketItems as $basketItem) {
        $mxResult = CCatalogSku::GetProductInfo(
            $basketItem->getProductId()
        );
        if (is_array($mxResult)) {
            $intProdID = $mxResult['ID'];
        } else {
            $intProdID = $basketItem->getProductId();
        }
        $arBasketItemInfo = $arProducts[$intProdID];

        $arItems[] = [
            'PREVIEW_PICTURE' => ['SRC' => CFile::GetPath($arBasketItemInfo['PREVIEW_PICTURE'])],
            'NAME' => $basketItem->getField('NAME'),
            'PROPERTIES' => [
                'ARTNUMBER' => ['VALUE' => $arBasketItemInfo['PROPERTIES']['CML2_ARTICLE']['VALUE']],
                'CODE' => ['VALUE' => $arBasketItemInfo['PROPERTIES']['CML2_BAR_CODE']['VALUE']],
                'COLOR' => ['VALUE' => $arBasketItemInfo['PROPERTIES']['TEXTURE']['VALUE']],
                'DATE' => ['VALUE' => date("d.m.Y", strtotime(date('d.m.Y') . " +2 day"))],
            ],
            'QUANTITY' => $basketItem->getQuantity(),
            'PRICE' => $basketItem->getBasePrice(),
            'DISCOUNT_PRICE' => floatval($basketItem->getBasePrice()) - floatval($basketItem->getDiscountPrice()),
            'DISCOUNT_PERCENT' => floor($basketItem->getDiscountPrice() / $basketItem->getBasePrice()) * 100
        ];
    }

    $date = date('d.m.Y');
    $intNumber = rand(1,99999999);

    $productsHTML = '<table>';

    foreach ($arItems as $arItem) {
        $productsHTML .= '<tr>
<td style="width: 15%"><img height="70" src="' . $arItem['PREVIEW_PICTURE']['SRC'] . '" alt=""></td>
<td style="width: 45%"><p class="namerd">' . $arItem['NAME'] . '</p>
<p class="namepRopd">';
        if (!empty($arItem['PROPERTIES']['ARTNUMBER']['VALUE'])) {
            $productsHTML .= 'Артикул ' . $arItem['PROPERTIES']['ARTNUMBER']['VALUE'];
        }
        if (!empty($arItem['PROPERTIES']['CODE']['VALUE'])) {
            $productsHTML .= ', код  ' . $arItem['PROPERTIES']['CODE']['VALUE'];
        }
        $productsHTML .= '
<br>';
        if (!empty($arItem['PROPERTIES']['COLOR']['VALUE'])) {
            $productsHTML .= 'Цвет: ' . $arItem['PROPERTIES']['COLOR']['VALUE'];
        }
        $productsHTML .= '

<span class="namepDelvier">
<br>
Дата поставки: ' . $arItem['PROPERTIES']['DATE']['VALUE'] . '
</span>
</p>

</td>
<td style="width: 15%; text-align: center;"><p class="namerd">' . $arItem['QUANTITY'] . ' шт</p></td>
<td style="width: 15%">

<p class="namerd">' . number_format($arItem['PRICE'], 0, ' ', ' ') . ' руб.
<br>';
        if ($arItem['DISCOUNT_PRICE'] != $arItem['PRICE']) {
            $productsHTML .= '<span class="namepRopd">Скидка ' . $arItem['DISCOUNT_PERCENT'] . ' %</span>';
        }
        $productsHTML .= '</p>

</td>';
        if ($arItem['DISCOUNT_PRICE'] != $arItem['PRICE']) {
            $productsHTML .= '<td style="width: 15%"><p style="    text-decoration: line-through;color: #9E9FA2;" class="namerd">' . number_format($arItem['DISCOUNT_PRICE'],
                    0, ' ', ' ') . ' руб.</p></td>';
        }

        $productsHTML .= '</tr>';

    }

    $productsHTML .= '
<tr class="smlPPw" >
<td colspan="3" style="text-align: right">
Итого
</td>
<td>
  ' . number_format($allSum, 0, ' ', ' ') . ' руб
</td>';
    if ($allDiscountSum != $allSum) {
        $productsHTML .= '<td>
   <span style="  text-decoration: line-through;color: #9E9FA2;">' . number_format($allDiscountSum, 0, ' ', ' ') . ' руб</span> 
</td>';
    }
    $productsHTML .= '</tr>

<tr class="smlPPw">
<td colspan="3" style="text-align: right">
в том числе НДС (' . $vatRate . '%)      
</td>
<td  style="text-align: left">
     ' . $allVatSum . ' руб.
</td>
<td>

</td>
</tr>
<tr></tr>
<br>
<tr>
<td class="smlPP" colspan="5" style="text-align: right">
<br>
' . lcfirst(num2str($allDiscountSum)) . ' <br>
в том числе НДС (' . $vatRate . '%) ' . num2str($allVatSum) . '

</td>

</tr>';

    $productsHTML .= '</table>';

    $html = <<<EOD
<style>

.smlPP{
font-size: 8px;
}


.smlPPw{
font-size: 10px;
}

p.namerd{
font-size: 10px;
}



p.namepDelvier, span.namepDelvier{
font-size: 9px;
color: #000000;
}

p.namepRopd, span.namepRopd {
color: #9E9FA2;
font-size: 8px;
}

.tqRequisites p{
color: #9E9FA2;
font-size: 8px;
}
.tqRequisites h1{
color: #9E9FA2;
font-size: 12px;
}
.tqRequisites h2{
color: #9E9FA2;
font-size: 10px;
}
.tqRequisites a{
color: #9E9FA2;
font-size: 8px;
text-decoration: none;
}
.tqFooter p{
color: #9E9FA2;
font-size: 7px;
}
.tqTitle{
margin: 0 auto;
text-align: center;
}
.tqTitle h1{
color: #9E9FA2;
font-size: 18px;
}
.tqTitle p{
color: #9E9FA2;
font-size: 10px;
}

</style>
<div class="tqTitle">
<h1>Коммерческое предложение</h1>
<p>№$intNumber  от $date</p>
</div>


$productsHTML



<div class="tqRequisites">
<p>Ваш персональный специалист</p>
<h1>Трапезникова Татьяна Алексеевна</h1>
<p>(812) 448-8970 (2263)<br/><a href="mailto:tat@defo.ru">tat@defo.ru</a></p>
<br/>
<br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/>

<h2>ООО "ДЭФО-Санкт-Петербург"</h2>
<p>Юридический адрес:</p>
<p>199004, город Санкт-Петербург, линия Кадетская В.О, д. 27/5, лит. А, пом. 1Н</p><br/>
<p>Реквизиты:</p>
<p>ИНН / КПП: 7801512839 / 780101001</p>
<p>ОКТМО 40308000000</p>
<p>р/с 40702810606000028010</p>
<p>СТ-ПЕТЕРБУРГСКИЙ Ф-Л ПАО "ПРОМСВЯЗЬБАНК" в Санкт-Петербург</p>
<p>БИК 044030920</p>
<p>корр.сч. 30101810000000000920</p><br/>
<br/>
<br/>
<br/>
<br/>

</div>
<div class="tqFooter">
<p>Цены указанные в коммерческом предложении действительны в течении 3 (трех) рабочих дней.</p>
<p>Для получение индивидуальной скидки, необходимо обращаться к личному менеджеру либо сотрудникам интернет магазина</p>
</div>
EOD;

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

    $_SESSION['CP_FILE'] = 'offer-' . $intNumber . '.pdf';
    $pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'cpoffers/offer-' . $intNumber . '.pdf', 'F');


    CEvent::Send("SEND_PDF", 's1', $arFields,'Y',123,[$_SERVER['DOCUMENT_ROOT'] . 'cpoffers/offer-' . $intNumber . '.pdf']);

}

?>
