<?php

use \Bitrix\Main\Loader,
    \Bitrix\Main\Application,
    \Bitrix\Main\Text\Encoding,
    \Bitrix\Main\SiteTable,
    \Bitrix\Main\Config\Option,
    \Bitrix\Main\Localization\Loc,
    \Bitrix\Main\Result,
    \Bitrix\Main\Error,
    \Bitrix\Main\Web,
    \Bitrix\Sale\PriceMaths,
    \Bitrix\Sale\Notify;

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

/**
 * @var $APPLICATION CMain
 * @var $USER        CUser
 */

Loc::loadMessages(__FILE__);

class ApiBuyoneclickComponent extends \CBitrixComponent
{
    protected $arUser;

    /** @var Result */
    protected $result;

    protected $weightKoef = 0;
    protected $weightUnit = 0;


    public function onPrepareComponentParams($params)
    {
        $this->result = new Result();

        if($this->initComponentTemplate()) {
            Loc::loadMessages($_SERVER['DOCUMENT_ROOT'] . $this->getTemplate()->GetFile());
        }

        $params['SITE_ID']  = ($params['SITE_ID'] ? $params['SITE_ID'] : SITE_ID);
        $params['QUANTITY'] = 1;

        $params['MODAL_HEADER']       = $this->formatText($params['MODAL_HEADER']);
        $params['MODAL_FOOTER']       = $this->formatText($params['MODAL_FOOTER']);
        $params['MODAL_TEXT_BEFORE']  = $this->formatText($params['MODAL_TEXT_BEFORE']);
        $params['MODAL_TEXT_AFTER']   = $this->formatText($params['MODAL_TEXT_AFTER']);
        $params['MODAL_TEXT_BUTTON']  = $this->formatText($params['MODAL_TEXT_BUTTON']);
        $params['MESS_SUCCESS_TITLE'] = $this->formatText($params['MESS_SUCCESS_TITLE']);
        $params['MESS_SUCCESS_INFO']  = $this->formatText($params['MESS_SUCCESS_INFO']);

        $params['IBLOCK_FIELD'] = array_diff((array)$params['IBLOCK_FIELD'], array(''));

        $params['WEIGHT_KOEF'] = htmlspecialcharsbx(Option::get('sale', 'weight_koef', 1, SITE_ID));
        $params['WEIGHT_UNIT'] = htmlspecialcharsbx(Option::get('sale', 'weight_unit', "", SITE_ID));

        $this->weightKoef = $params["WEIGHT_KOEF"];
        $this->weightUnit = $params["WEIGHT_UNIT"];


        if($params['USE_JQUERY'] == 'Y')
            CJSCore::Init(array('jquery2'));

        return $params;
    }

    protected function checkModules()
    {
        if(!Loader::includeModule('api.buyoneclick')) {
            $this->result->addError(new Error(Loc::getMessage('ABOC_INC_MODULE_ERROR')));
            return;
        }
        if(!Loader::includeModule('iblock')) {
            $this->result->addError(new Error(Loc::getMessage('ABOC_INC_IBLOCK_MODULE_ERROR')));
            return;
        }
        if(!Loader::includeModule('sale')) {
            $this->result->addError(new Error(Loc::getMessage('ABOC_INC_SALE_MODULE_ERROR')));
            return;
        }
        if(!Loader::includeModule('catalog')) {
            $this->result->addError(new Error(Loc::getMessage('ABOC_INC_CATALOG_MODULE_ERROR')));
            return;
        }

        if(Loader::includeModule('api.core')) {
            CUtil::InitJSCore('api_form', 'api_message');
        }
    }

    public function formatText($text = '')
    {
        $text = htmlspecialcharsback($text);
        $text = (preg_match('/<[\/\!]*?[^<>]*?>/im' . BX_UTF_PCRE_MODIFIER, $text) ? $text : nl2br($text));

        return $text;
    }

    public function getOrderProps($person_type_id)
    {
        if(!$person_type_id)
            return false;

        $arOrderProps = array();
        $rsOrderProps = Bitrix\Sale\Internals\OrderPropsTable::getList(array(
            'order'  => array('SORT' => 'ASC', 'NAME' => 'ASC'),
            'filter' => array('=ACTIVE' => 'Y', '=PERSON_TYPE_ID' => $person_type_id),
            'select' => array('ID', 'NAME', 'TYPE', 'CODE', 'REQUIRED', 'IS_LOCATION', 'IS_EMAIL', 'IS_ZIP', 'IS_ADDRESS', 'IS_PHONE'),
        ));
        while($row = $rsOrderProps->fetch())
            $arOrderProps[ $row['ID'] ] = $row;


        return $arOrderProps;
    }

    protected function makeOrderProps($buyer, $psId, $deliveryId, $locationId, $personTypeId)
    {
        $psId       = intval($psId);
        $locationId = intval($locationId);

        $arResult = array();

        $arPropFilter = array(
            'PERSON_TYPE_ID' => $personTypeId,
            'ACTIVE'         => 'Y',
        );

        if($psId != 0) {
            $arPropFilter['RELATED']['PAYSYSTEM_ID'] = $psId;
            $arPropFilter['RELATED']['TYPE']         = 'WITH_NOT_RELATED';
        }

        if(strlen($deliveryId) > 0) {
            $arPropFilter['RELATED']['DELIVERY_ID'] = $deliveryId;
            $arPropFilter['RELATED']['TYPE']        = 'WITH_NOT_RELATED';
        }

        $rsProps = CSaleOrderProps::GetList(
            array(),
            $arPropFilter,
            false,
            false,
            array('ID', 'TYPE', 'CODE', 'REQUIRED', 'IS_LOCATION', 'IS_EMAIL', 'IS_ZIP', 'IS_ADDRESS', 'IS_PHONE')
        );

        while($arProp = $rsProps->Fetch()) {
            $propVal = $buyer[ $arProp['ID'] ];

            //--------- Order calculate fields ---------//
            if(($arProp['IS_LOCATION'] == 'Y' || $arProp['CODE'] == 'LOCATION' || $arProp['TYPE'] == 'LOCATION') && !$propVal)
                $propVal = $locationId;

            if(($arProp['IS_PHONE'] == 'Y' || $arProp['CODE'] == 'PHONE') && $propVal) {
                $propVal                    = $this->normalizePhoneNumber($propVal);
                $this->arUser['USER_PHONE'] = $propVal;
            }

            if($arProp['REQUIRED'] == 'Y' && !$propVal)
                $propVal = '-';


            //--------- Event message fields ---------//
            //Фамилия
            if($arProp['CODE'] == 'LAST_NAME') {
                $this->arUser['LAST_NAME'] = $propVal;
            }

            //Имя
            if($arProp['IS_PAYER'] == 'Y' || $arProp['CODE'] == 'NAME') {
                $this->arUser['NAME'] = $propVal;
            }

            //Отчество
            if($arProp['CODE'] == 'MIDDLE_NAME') {
                $this->arUser['MIDDLE_NAME'] = $propVal;
            }

            //Email
            if($arProp['IS_EMAIL'] == 'Y' || $arProp['CODE'] == 'EMAIL') {
                $this->arUser['EMAIL'] = $propVal;
            }

            //Адрес
            if($arProp['IS_ADDRESS'] == 'Y' || $arProp['CODE'] == 'ADDRESS') {
                $this->arUser['ADDRESS'] = $propVal;
            }

            //Индекс
            if($arProp['IS_ZIP'] == 'Y' || $arProp['CODE'] == 'ZIP') {
                $this->arUser['ZIP'] = $propVal;
            }

            $arResult[ $arProp['ID'] ] = $propVal;
        }

        return $arResult;
    }

    protected function getBxUserId()
    {
        return $GLOBALS['USER']->GetId();
    }

    /**
     * Creates new anonymous user with e-mail 'anonymous_some_number@example.com' and returns his ID
     * Used mainly in CRM
     *
     * @return int - new user ID or ID of already existing anonymous user, 0 if error
     */
    protected function getAnonymousUserId()
    {
        $arErrors    = array();
        $bUserExists = false;
        $anonUserID  = intval(Option::get('sale', 'one_click_user_id', 0));

        if($anonUserID > 0) {
            $by     = 'id';
            $order  = 'asc';
            $dbUser = CUser::GetList($by, $order, array('ID_EQUAL_EXACT' => $anonUserID), array('FIELDS' => array('ID')));
            if($arUser = $dbUser->Fetch())
                $bUserExists = true;
        }

        if(!$bUserExists) {
            $anonUserEmail = 'buyOneClick@' . $_SERVER['SERVER_NAME'];
            $anonUserID    = CSaleUser::DoAutoRegisterUser(
                $anonUserEmail,
                array('NAME' => 'buyOneClick'),
                SITE_ID,
                $arErrors,
                array('ACTIVE' => 'N')
            );

            if($anonUserID > 0) {
                Option::set('sale', 'one_click_user_id', $anonUserID);
            }
            else {
                $errorMessage = '';
                if($arErrors) {
                    $arMess = [];
                    foreach($arErrors as $error)
                        $arMess[] = ($error['TEXT'] ? $error['TEXT'] : $error);

                    $errorMessage = join('<br>', $arMess);
                }

                //Loc::getMessage('SU_ANONYMOUS_USER_CREATE', array('#ERROR#' => $errorMessage))
                $GLOBALS['APPLICATION']->ThrowException('ABOC_ANONYMOUS_USER_CREATE_ERROR ' . $errorMessage, 'ABOC_ANONYMOUS_USER_CREATE_ERROR');
                return 0;
            }
        }

        return $anonUserID;
    }

    protected function getUserName()
    {
        global $USER;

        $userName = trim($this->arUser['LAST_NAME'] . ' ' . $this->arUser['NAME'] . ' ' . $this->arUser['MIDDLE_NAME']);

        if(!$userName)
            $userName = trim($this->arUser['PAYER_NAME']);

        if(!$userName && $USER->IsAuthorized())
            $userName = $USER->GetFormattedName(false);

        if(!$userName)
            $userName = '-';

        /*
        $userRes = Main\UserTable::getList(array(
             'select' => array('ID', 'LOGIN', 'NAME', 'LAST_NAME', 'SECOND_NAME', 'EMAIL'),
             'filter' => array('=ID' => $order->getUserId()),
        ));
        if ($userData = $userRes->fetch())
        {
            $userData['PAYER_NAME'] = \CUser::FormatName(\CSite::GetNameFormat(null, SITE_ID), $userData, true);
            $userName = $userData['PAYER_NAME'];
        }*/

        return $userName;
    }

    protected function getUserEmail()
    {
        global $USER;

        $userEmail = trim($this->arUser['EMAIL']);

        if(!$userEmail)
            $userEmail = trim($this->arUser['USER_EMAIL']);

        if(!$userEmail && $USER->IsAuthorized())
            $userEmail = $USER->GetEmail();

        if(!$userEmail)
            $userEmail = '-';

        return $userEmail;
    }

    protected function getSaleEmail()
    {

        $arSite    = SiteTable::getRow(array(
            'select' => array('EMAIL'),
            'filter' => array('=LID' => SITE_ID),
        ));
        $saleEmail = $arSite['EMAIL'];

        if(!$saleEmail) {
            $saleEmail = Option::get('sale', 'order_email', 'info@' . SITE_SERVER_NAME);
        }

        return $saleEmail;
    }

    protected function normalizePhoneNumber($phone)
    {
        $phone = preg_replace('/[^\d]/', '', $phone);

        $cleanPhone = \NormalizePhone($phone, 6);

        if(strlen($cleanPhone) == 10) {
            $cleanPhone = '7' . $cleanPhone;
        }

        return $cleanPhone;
    }

    protected function sendEmail($arOrder, $arBasketList)
    {
        global $DB;

        $strOrderList = '';
        $arBasketList = getMeasures($arBasketList);

        if($arBasketList) {
            foreach($arBasketList as $arItem) {
                $measureText = (isset($arItem['MEASURE_TEXT']) && strlen($arItem['MEASURE_TEXT'])) ? $arItem['MEASURE_TEXT'] : GetMessage('SOA_SHT');

                $arItem['DETAIL_PAGE_URL'] = (CMain::IsHTTPS() ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] . $arItem['DETAIL_PAGE_URL'];

                $strOrderList .= '<a href="' . $arItem['DETAIL_PAGE_URL'] . '">' . $arItem['NAME'] . ' - ' . $arItem['QUANTITY'] . ' ' . $measureText . ': ' . SaleFormatCurrency($arItem['PRICE'], $arItem['CURRENCY']) . '</a>';
                $strOrderList .= '<br>';
            }
        }

        $saleEmail = $this->getSaleEmail();

        $arFields = array(
            'ORDER_ID'       => $arOrder['ACCOUNT_NUMBER'],
            'ORDER_REAL_ID'  => $arOrder['ID'],
            //"ORDER_ACCOUNT_NUMBER_ENCODE" => urlencode(urlencode($arOrder['ACCOUNT_NUMBER'])),
            'ORDER_DATE'     => Date($DB->DateFormatToPHP(CLang::GetDateFormat('SHORT', SITE_ID))),
            'ORDER_USER'     => $this->getUserName(),
            'PRICE'          => SaleFormatCurrency($arOrder['ORDER_PRICE'], $arOrder['CURRENCY']),
            'BCC'            => $saleEmail,
            'EMAIL'          => $this->getUserEmail(),
            'ORDER_LIST'     => $strOrderList,
            'SALE_EMAIL'     => $saleEmail,
            'DELIVERY_PRICE' => '',
        );

        /*
        $fields = Array(
             "ORDER_ID" => $entity->getField("ACCOUNT_NUMBER"),
             "ORDER_REAL_ID" => $entity->getField("ID"),
             "ORDER_ACCOUNT_NUMBER_ENCODE" => urlencode(urlencode($entity->getField("ACCOUNT_NUMBER"))),
             "ORDER_DATE" => $entity->getDateInsert()->toString(),
             "ORDER_USER" => static::getUserName($entity),
             "PRICE" => SaleFormatCurrency($entity->getPrice(), $entity->getCurrency()),
             "BCC" => Main\Config\Option::get("sale", "order_email", "order@".$_SERVER["SERVER_NAME"]),
             "EMAIL" => static::getUserEmail($entity),
             "ORDER_LIST" => $basketList,
             "SALE_EMAIL" => Main\Config\Option::get("sale", "order_email", "order@".$_SERVER["SERVER_NAME"]),
             "DELIVERY_PRICE" => $entity->getDeliveryPrice(),
        );
        */

        //$eventName = 'SALE_NEW_ORDER';
        $eventName = Notify::EVENT_ORDER_NEW_SEND_EMAIL_EVENT_NAME;
        $bSend     = true;

        foreach(GetModuleEvents('sale', Notify::EVENT_ON_ORDER_NEW_SEND_EMAIL, true) as $arEvent)
            if(ExecuteModuleEventEx($arEvent, array($arOrder['ID'], &$eventName, &$arFields)) === false)
                $bSend = false;

        if($bSend) {
            $event = new \CEvent;
            $event->Send($eventName, SITE_ID, $arFields, 'N');
        }
    }

    protected function getQuantity(){

        $quantity = $this->arParams['QUANTITY'];

        $quantityIsFloat = false;
        if(number_format(doubleval($quantity), 2, '.', '') != intval($quantity)) {
            $quantityIsFloat = true;
        }

        $quantity = ($quantityIsFloat === false) ? intval($quantity) : (number_format(doubleval($quantity), 4, '.', '') * 1);

        if(!$quantity)
            $quantity = 1;

        return $quantity;
    }

    protected function getProduct()
    {
        global $USER;


        $iblock_id  = intval($this->arParams['IBLOCK_ID']);
        $element_id = intval($this->arParams['PRODUCT_ID']);
        $quantity   = $this->getQuantity();
        $site_id    = $this->getSiteId();

        $arSelect  = array('IBLOCK_ID', 'ID', 'XML_ID', 'IBLOCK_EXTERNAL_ID', 'PROPERTY_CAPTION');
        $arSelect  = array_unique(array_merge($arSelect, $this->arParams['IBLOCK_FIELD']));
        $arFilter  = array(
            'IBLOCK_ID' => $iblock_id,
            '=ID'       => $element_id,
        );

        $rsElement = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);

        $arProduct = array();
        if($arElement = $rsElement->Fetch()) {

            $arProduct = CCatalogProductProvider::GetProductData(array(
                'PRODUCT_ID'     => $arElement['ID'],
                'RENEWAL'        => 'N',
                "CHECK_QUANTITY" => "Y",
                "CHECK_DISCOUNT" => "Y",
                "CHECK_PRICE"    => "Y",
                'QUANTITY'       => $quantity,
                'SITE_ID'        => $site_id,
                "USER_ID"        => intval($USER->GetID()),
            ));

            if($arProduct) {

                $arProduct['PRODUCT_ID'] = $arElement['ID'];

                $arProduct['MODULE']                 = 'catalog';
                $arProduct['PRODUCT_PROVIDER_CLASS'] = 'CCatalogProductProvider';

                if(strlen($arElement['XML_ID']) > 0)
                    $arProduct['PRODUCT_XML_ID'] = $arElement['XML_ID'];

                if(strlen($arElement['IBLOCK_EXTERNAL_ID']) > 0)
                    $arProduct['CATALOG_XML_ID'] = $arElement['IBLOCK_EXTERNAL_ID'];


                $arProduct['PICTURE'] = array();
                if($arElement['PREVIEW_PICTURE'] || $arElement['DETAIL_PICTURE']) {
                    $pictureId = ($arElement['PREVIEW_PICTURE'] ? $arElement['PREVIEW_PICTURE'] : $arElement['DETAIL_PICTURE']);
                    $arFileTmp = CFile::ResizeImageGet($pictureId, array("width" => 150, "height" => 150));

                    if($arFileTmp['src'])
                        $arFileTmp['src'] = CUtil::GetAdditionalFileURL($arFileTmp['src'], true);

                    $arProduct['PICTURE'] = array_change_key_case($arFileTmp, CASE_UPPER);
                }

                ///////////////////////////////////////////////////
                $allSum      = 0;
                $allWeight   = 0;
                $allVATSum   = 0;
                $allCurrency = Bitrix\Sale\Internals\SiteCurrencyTable::getSiteCurrency(SITE_ID);

                if(!$allCurrency)
                    $allCurrency = $arProduct['CURRENCY'];

                $DISCOUNT_PRICE_ALL = 0;

                $arOrder['BASKET_ITEMS'][] = $arProduct;

                $offer = CCatalogSku::GetProductInfo($element_id);
                $offerId = $offer["ID"];

                $arSelect = Array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "PROPERTY_NOFACTOR");
                $arFilter = Array("IBLOCK_ID"=>16, "ID"=> $offerId);
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                $ob = $res->GetNextElement();
                $arFields = $ob->GetFields();



                //PROPERTY_NOFACTOR_VALUE
                if ($arFields["PROPERTY_NOFACTOR_VALUE"] == "Y"){
                    $factor = 1;
                }else{
                    if ($arFields["IBLOCK_SECTION_ID"] == 20) {
                        $factor = $_SESSION['factor'];
                    } else {
                        $res = CIBlockSection::GetByID($arFields["IBLOCK_SECTION_ID"]);
                        $ar_res = $res->GetNext();

                        if($ar_res['IBLOCK_SECTION_ID'] == 20) {
                            $factor = $_SESSION['factor'];
                        } else {
                            $res2 = CIBlockSection::GetByID($ar_res['IBLOCK_SECTION_ID']);
                            $ar_res2 = $res2->GetNext();
                            if($ar_res2['IBLOCK_SECTION_ID'] == 20) {
                                $factor = $_SESSION['factor'];
                            }
                        }
                    }
                }


                if ($_SESSION['ratio'])
                    $ratio = $_SESSION['ratio'];
                else
                    $ratio = 1;
                foreach($arOrder['BASKET_ITEMS'] as &$arOneItem) {

                    $allWeight += ($arOneItem['WEIGHT'] * $arOneItem['QUANTITY']);
                    $arOneItem["PRICE"] = round(($arOneItem['PRICE'] * ($factor?$factor:$ratio)));
                    $arOneItem["BASE_PRICE"] = $arOneItem["PRICE"];
                    $allSum    += $arOneItem['PRICE'] * $arOneItem['QUANTITY'];

                    $arOneItem['TOTAL_PRICE'] = PriceMaths::roundByFormatCurrency($arOneItem['PRICE']* $arOneItem['QUANTITY'], $arOneItem['CURRENCY']);

                    if(array_key_exists('VAT_VALUE', $arOneItem))
                        $arOneItem['PRICE_VAT_VALUE'] = $arOneItem['VAT_VALUE'];

                    $allVATSum += roundEx($arOneItem['PRICE_VAT_VALUE'] * $arOneItem['QUANTITY'], SALE_VALUE_PRECISION);

                    if($arOneItem['DISCOUNT_PRICE'] > 0) {
                        $arOneItem['FULL_PRICE'] = PriceMaths::roundByFormatCurrency(round($arOneItem['BASE_PRICE'] * ($factor?$factor:$ratio)) * $arOneItem['QUANTITY'], $arOneItem['CURRENCY']);
                        $DISCOUNT_PRICE_ALL      += round($arOneItem['DISCOUNT_PRICE'] * ($factor?$factor:$ratio)) * $arOneItem['QUANTITY'];
                    }
                    else {
                        $arOneItem['FULL_PRICE'] = PriceMaths::roundByFormatCurrency($arOneItem['PRICE']* $arOneItem['QUANTITY'], $arOneItem['CURRENCY']);
                    }

                    if($arOneItem['DISCOUNT_PRICE'] > 0) {
                        if(($arOneItem['DISCOUNT_PRICE'] + $arOneItem['PRICE']) > 0) {
                            $arOneItem['DISCOUNT_PRICE_PERCENT'] = PriceMaths::roundByFormatCurrency(
                                ($arOneItem['DISCOUNT_PRICE'] * 100) / $arOneItem['BASE_PRICE'],
                                $arOneItem['CURRENCY']
                            );
                            //$arOneItem['FULL_PRICE'] = $arOneItem["PRICE"] + $arOneItem["DISCOUNT_PRICE"];
                        }
                    }
                    else {
                        $arOneItem['DISCOUNT_PRICE_PERCENT'] = 0;
                    }

                    //CSaleDiscount::DoProcessOrder($arOrder, $arOptions, $arErrors);
                    //$price = CCatalogProduct::GetOptimalPrice($arOneItem['PRODUCT_ID'], $arOneItem['QUANTITY'], $USER->GetUserGroupArray(), 'N');

                    //Вес товара
                    $arOneItem['WEIGHT_FORMATED'] = roundEx(doubleval(($arOneItem['WEIGHT'] * $arOneItem['QUANTITY']) / $this->weightKoef), SALE_WEIGHT_PRECISION) . ' ' . $this->weightUnit;

                    //Базовая цена (не используется)
                    $arOneItem['PRICE_FORMATED'] = SaleFormatCurrency($arOneItem['PRICE'], $arOneItem['CURRENCY'], true);

                    //Базовая цена с учетом количества (выводится в поле Старая цена)
                    $arOneItem['FULL_PRICE_FORMATED'] = SaleFormatCurrency($arOneItem['FULL_PRICE'], $arOneItem['CURRENCY']);

                    //Цена товара с учетом скидок и количества товара (выводится в поле Цена)
                    $arOneItem['TOTAL_PRICE_FORMATED'] = SaleFormatCurrency($arOneItem['TOTAL_PRICE'], $arOneItem['CURRENCY']);


                    //Скидка в рублях (Экономия)
                    $arOneItem['DISCOUNT_PRICE_FORMATED'] = SaleFormatCurrency($arOneItem['DISCOUNT_PRICE'] * $arOneItem['QUANTITY'], $arOneItem['CURRENCY']);

                    //Скидка в процентах (50%)
                    $arOneItem['DISCOUNT_PRICE_PERCENT_FORMATED'] = CSaleBasketHelper::formatQuantity($arOneItem['DISCOUNT_PRICE_PERCENT']) . '%';
                }

                //TODO: Summ all basket in new versions
                //$arProduct['WEIGHT_FORMATED'] = roundEx(doubleval($allWeight / $this->weightKoef), SALE_WEIGHT_PRECISION) . " " . $this->weightUnit;
                //$arProduct['PRICE_FORMATED']  = PriceMaths::roundByFormatCurrency($allSum, $allCurrency);

                $arProduct = array_merge($arElement, $arOneItem);
                $arProduct["FACTOR"] = $factor;
                $res = CIBlockSection::GetByID($arFields["IBLOCK_SECTION_ID"]);
                $ar_res = $res->GetNext();
                $arProduct["CATEGORY"] = $ar_res["NAME"];
                unset($arElement, $arOneItem);
            }
            else {
                $this->result->addError(new Error(Loc::getMessage('ABOC_CLASS_PRODUCT_NOT_AVAILABLE')));
            }
        }
        else {
            $this->result->addError(new Error(Loc::getMessage('ABOC_CLASS_ELEMENT_ID_ERROR', array('#ID#' => $element_id))));
        }

        
        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_ARTNUMBER","PROPERTY_PATTERN", "CATALOG_GROUP_2");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
        $arFilter = Array("IBLOCK_ID" => 17, 'ID' => $element_id );
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
        $ob = $res->GetNextElement();
        //$ob2 = $res->getNext();
        $arFields = $ob->GetFields();
        $arProps = $ob->GetProperties();



        $newProps[0] = array(
            "ID" => $arProps["ARTNUMBER"]["ID"],
            "NAME" => $arProps["ARTNUMBER"]["NAME"],
            "VALUE" => $arProps["ARTNUMBER"]["VALUE"],
            "CODE" => $arProps["ARTNUMBER"]["CODE"]
        );
        CModule::IncludeModule("highloadblock");
        $hlblock_id = 3; // ID вашего Highload-блока
        $hlblock   = Bitrix\Highloadblock\HighloadBlockTable::getById( $hlblock_id )->fetch(); // получаем объект вашего HL блока
        $entity   = Bitrix\Highloadblock\HighloadBlockTable::compileEntity( $hlblock );  // получаем рабочую сущность
        $entity_data_class = $entity->getDataClass();
        $entity_table_name = $hlblock['TABLE_NAME']; // присваиваем переменной название HL таблицы
        $sTableID = 'tbl_'.$entity_table_name;

        $arFilter = array("UF_XML_ID" => $arProps["PATTERN"]["VALUE"]); // зададим фильтр по ID пользователя
        $arSelect = array('UF_NAME'); // выбираем все поля

        $rsData = $entity_data_class::getList(array(
            "select" => $arSelect,
            "filter" => $arFilter,
            "limit" => '1', //ограничим выборку пятью элементами
            "order" => array()
        ));
        $rsData = new CDBResult($rsData, $sTableID);
        $arRes = $rsData->Fetch();


        $newProps[1] = array(
            "ID" => $arProps["PATTERN"]["ID"],
            "NAME" => $arProps["PATTERN"]["NAME"],
            "VALUE" => $arRes["UF_NAME"],
            "CODE" => $arProps["PATTERN"]["CODE"]
        );

        $arProduct["newProps"] = $newProps;
        $arProduct["OLDPRICE"] = $arFields["CATALOG_PRICE_2"];
        return $arProduct;
    }

    public function saveOrder($postFields, $postComment = '')
    {
        $arReturn = array(
            'ID'         => '',
            'ORDER_ID'   => '',
            'ORDER_DATE' => '',
            'ERROR'      => '',
        );

        $arParams = $this->arParams;
        $arErrors = $arWarnings = $arOptions = $arProducts = $arAdditionalFields = array();

        require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/sale/general/admin_tool.php');

        $site_id          = $this->getSiteId();
        $user_id          = ($arParams['BIND_USER'] == 'Y' ? $this->getBxUserId() : 0);
        $person_type_id   = $arParams['PERSON_TYPE'];
        $delivery_id      = $arParams['DELIVERY_SERVICE'];
        $pay_system_id    = $arParams['PAY_SYSTEM'];
        $location_id      = $_SESSION['location'];//$arParams['LOCATION_ID'];
        $user_description = $postComment;
        //$currency       = CSaleLang::GetLangCurrency($siteId);

        if(!$user_id)
            $user_id = $this->getAnonymousUserId();

        if($arParams['DEBUG_MODE'] == 'Y') {
            $arPrint1 = array(
                '$site_id'          => $site_id,
                '$user_id'          => $user_id,
                '$person_type_id'   => $person_type_id,
                '$delivery_id'      => $delivery_id,
                '$pay_system_id'    => $pay_system_id,
                '$location_id'      => $location_id,
                '$user_description' => $user_description,
                '$postFields'       => $postFields,
                '$postComment'      => $postComment,
            );
            $tttfile  = dirname(__FILE__) . '/debug_1.php';
            file_put_contents($tttfile, '<pre>' . print_r($arPrint1, 1) . '</pre>\n');
        }


        if($arProduct = $this->getProduct()) {

            if($arProduct['CAN_BUY'] == 'Y')
                $arProducts[] = $arProduct;

            $arOrderProductPrice = fGetUserShoppingCart($arProducts, $site_id, 'N');

            $arShoppingCart = CSaleBasket::DoGetUserShoppingCart(
                $site_id,
                $user_id,
                $arOrderProductPrice,
                $arErrors
            );

            $arOrderPropsValues = $this->makeOrderProps(
                $postFields,
                $pay_system_id,
                $delivery_id,
                $location_id,
                $person_type_id
            );

            //$arOptions['CURRENCY'] = CSaleLang::GetLangCurrency($siteId);
            $CSaleOrder = new CSaleOrder();
            $arOrder    = $CSaleOrder->DoCalculateOrder(
                $site_id,
                $user_id,
                $arShoppingCart,
                $person_type_id,
                $arOrderPropsValues,
                $delivery_id,
                $pay_system_id,
                $arOptions,
                $arErrors,
                $arWarnings
            );

            $arOrder['LID'] = $site_id;

            $this->arUser['PAYER_NAME'] = $arOrder['PAYER_NAME'];
            $this->arUser['USER_EMAIL'] = $arOrder['USER_EMAIL'];

            $arAdditionalFields["ADDITIONAL_INFO"] = "0;0;0;0;".$_SESSION["SESS_IP"];
            if($user_description)
                $arAdditionalFields['USER_DESCRIPTION'] = $user_description;
            /* ================================================================================================ */


/* ================================================================================================ */

            $basketItems = $arOrder["BASKET_ITEMS"][0];
            $intElementID = $basketItems["ID"];
            $mxResult = CCatalogSku::GetProductInfo(
                $intElementID
            );

            $newProps = $arProduct["newProps"];
            $factor = $arProduct["FACTOR"];


            $arBasketNew = array(
              "ID" => $mxResult["ID"],
              "MODULE" => "catalog",
              "PRODUCT_ID" => $intElementID,
              "QUANTITY" => $basketItems["QUANTITY"],
                "PRICE" => $basketItems["PRICE"],
                "NAME" => $basketItems["NAME"],
                "CURRENCY" => $basketItems["CURRENCY"],
                "CATALOG_XML_ID" => $basketItems["IBLOCK_EXTERNAL_ID"],
                "VAT_RATE" => $basketItems["VAT_RATE"],
                "NOTES" => $basketItems["PRODUCT_PRICE_ID"],
                "DISCOUNT_PRICE" => $basketItems["DISCOUNT_PRICE"],
                "DIMENSIONS" => $basketItems["DIMENSIONS"],
                "TYPE" => $basketItems["TYPE"],
                "DETAIL_PAGE_URL" => $basketItems["DETAIL_PAGE_URL"],
                "PRICE_FORMATED" => $basketItems["PRICE_FORMATED"],
                    "WEIGHT_FORMATED" => $basketItems["WEIGHT_FORMATED"],
                "PROPS" => $newProps,
                "MEASURE_TEXT" => $basketItems["MEASURE_NAME"],
                "MEASURE" => $basketItems["MEASURE_ID"],
                "PRODUCT_PRICE_ID" =>  $basketItems["PRODUCT_PRICE_ID"],
                "BASE_PRICE" => $basketItems["PRICE"],//$basketItems["BASE_PRICE"]
                "DISCOUNT_PRICE_PERCENT" => $basketItems["DISCOUNT_PRICE_PERCENT"],
                "DISCOUNT_PRICE_PERCENT_FORMATED" => $basketItems["DISCOUNT_PRICE_PERCENT_FORMATED"],
                "PRICE_WITH_QUANTITY" => $basketItems["FULL_PRICE"],
                "SUM" => $basketItems["FULL_PRICE_FORMATED"]
            );


            $arOrderNew = $arOrder;
            unset($arOrderNew["BASKET_ITEMS"]);
            $arOrderNew["BASKET_ITEMS"][0] = $arBasketNew;


            if($orderID = $CSaleOrder->DoSaveOrder($arOrderNew, $arAdditionalFields, 0, $arErrors)) {


                $arOrderInfo = CSaleOrder::GetList(false, array('ID' => $orderID), false, false, array('ID', 'ACCOUNT_NUMBER', 'DATE_INSERT'))->Fetch();

                $this->sendEmail($arOrderInfo, $arShoppingCart, $arOrderPropsValues);

                $arReturn['ID']         = $arOrderInfo['ID'];
                $arReturn['ORDER_ID']   = $arOrderInfo['ACCOUNT_NUMBER'];
                $arReturn['ORDER_DATE'] = $arOrderInfo['DATE_INSERT'];
            }
        }


        $allErrors = array();
        if($arErrors) {
            foreach($arErrors as $error)
                $allErrors[] = (isset($error['TEXT']) ? $error['TEXT'] : $error);
        }

        /*if($arWarnings)
        {
            foreach($arWarnings as $error)
                $allErrors[] = (isset($error['TEXT']) ? $error['TEXT'] : $error);
        }*/

        if($allErrors)
            $arReturn['ERROR'] = join('<br>', $allErrors);


        if($arParams['DEBUG_MODE'] == 'Y') {
            $arPrint2 = array(
                '$arErrors'           => $arErrors,
                '$arWarnings'         => $arWarnings,
                '$arProduct'          => $arProduct,
                '$arShoppingCart'     => $arShoppingCart,
                '$arOrderPropsValues' => $arOrderPropsValues,
                '$arOrder'            => $arOrder,
                '$arOrderInfo'        => $arOrderInfo,
                '$arReturn'           => $arReturn,
            );
            $tttfile  = dirname(__FILE__) . '/debug_2.php';
            file_put_contents($tttfile, '<pre>' . print_r($arPrint2, 1) . '</pre>\n');
        }

        return $arReturn;
    }

    public function formatParams(&$params)
    {
        if($params) {
            foreach($params as $key => $val) {
                if($params[ '~' . $key ]) {
                    $params[ $key ] = $params[ '~' . $key ];
                }
                unset($params[ '~' . $key ]);
            }
        }
    }

    public function executeComponent()
    {
        global $APPLICATION;

        $this->checkModules();

        $arParams = &$this->arParams;
        $this->formatParams($arParams);

        $this->arResult['ID']      = intval($GLOBALS['USER']->GetID());
        $this->arResult['FORM_ID'] = $this->getEditAreaId($this->randString());

        $result = array(
            'FIELDS'     => array(),
            'VALUES'     => array(),
            'ERRORS'     => array(),
            'ORDER'      => array(),
            'PRODUCT'    => array(),
            'IS_SUBMIT'  => false,
            'IS_SUCCESS' => false,
        );

        if($arParams['AJAX'] == 'Y') {
            $context = Bitrix\Main\Application::getInstance()->getContext();
            $request = $context->getRequest();

            $formFields = $this->getOrderProps($arParams['PERSON_TYPE']);
            $postFields = $postErrors = array();

            if($post = $request->get('arPost')) {
                parse_str($post, $arPost);

                if(!Application::isUtfMode())
                    $arPost = Encoding::convertEncoding($arPost, 'UTF-8', $context->getCulture()->getCharset());

                $arParams['QUANTITY'] = htmlspecialcharsbx($arPost['QUANTITY']);

                $postFields  = $arPost['FIELDS'];
                $postSessid  = $arPost['sessid'];
                $postSubmit  = $arPost['ABOC_SUBMIT'] == 'Y';
                $postComment = strip_tags(trim($arPost['ABOC_COMMENT']));

                if($postSubmit && $postSessid == bitrix_sessid()) {
                    $bFoundErrors = false;
                    if($formFields) {
                        foreach($formFields as $fieldId => $arField) {
                            $postFields[ $fieldId ] = strip_tags(trim($postFields[ $fieldId ]));

                            //Validator
                            if($arParams['REQ_FIELDS'] && in_array($fieldId, $arParams['REQ_FIELDS'])) {
                                if(empty($postFields[ $fieldId ])) {
                                    $postErrors[ $fieldId ] = str_replace('#FIELD#', $arField['NAME'], $arParams['MESS_ERROR_FIELD']);
                                }
                                elseif($arField['IS_EMAIL'] == 'Y' && !check_email($postFields[ $fieldId ])) {
                                    $postErrors[ $fieldId ] = Loc::getMessage('ABOC_CP_EMAIL_ERROR');
                                }

                                if($postErrors)
                                    $bFoundErrors = true;
                            }
                        }
                    }

                    if(!$bFoundErrors) {
                        $result['IS_SUCCESS'] = true;
                        $result['ORDER']      = $this->saveOrder($postFields, $postComment);
                    }

                    if($postComment)
                        $postFields['ABOC_COMMENT'] = $postComment;
                }
            }


            $result['FIELDS']    = $formFields;
            $result['VALUES']    = $postFields;
            $result['ERRORS']    = $postErrors;
            $result['IS_SUBMIT'] = $postSubmit;
            $result['PRODUCT']   = $this->getProduct();

            $this->arResult = $result;

            if(!$this->result->isSuccess()) {
                $this->arResult['MESSAGE_DANGER'] = join('<br>', $this->result->getErrorMessages());
            }

            //Disable composite mode when filter checked
            //$this->setFrameMode(false);
            $APPLICATION->RestartBuffer();
            $this->includeComponentTemplate('ajax_template');
            $APPLICATION->FinalActions();
            die();
        }

        $this->includeComponentTemplate();
    }


    /////////////////////////////////////////////////////////
    // Action hanlers
    /////////////////////////////////////////////////////////

    public function executeAction($action, $post)
    {
        global $APPLICATION;

        $arParams = &$this->arParams;

        $arParams['QUANTITY'] = htmlspecialcharsbx($post['QUANTITY']);

        $result = array(
            'DATA'    => '',
            'ERROR'   => '',
            'MESSAGE' => '',
        );

        switch($action) {
            case 'setQuantity' : {

                $product = $this->getProduct();

                $result['DATA'] = $product;

                if(empty($product) || !isset($product['QUANTITY'])) {
                    $result['ERROR'] = Loc::getMessage(
                        'ABOC_CLASS_PRODUCT_NOT_AVAILABLE',
                        array('#NAME#' => $product['NAME'])
                    );
                }
                elseif($arParams['QUANTITY'] > doubleval($product['QUANTITY'])) {
                    $result['ERROR'] = Loc::getMessage(
                        'ABOC_CLASS_PRODUCT_NOT_ENOUGH_QUANTITY',
                        array(
                            '#NUMBER#'   => $arParams['QUANTITY'] . ' ' . $product['MEASURE_NAME'],
                            '#QUANTITY#' => $product['QUANTITY'] . ' ' . $product['MEASURE_NAME'],
                        )
                    );
                }
            }
                break;
        }


        $APPLICATION->RestartBuffer();
        header('Content-Type: application/json');
        echo Web\Json::encode($result);
        die();
    }
}