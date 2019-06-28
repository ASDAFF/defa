<?
	use Bitrix\Main\Localization\Loc;
	use Bitrix\Sale\PriceMaths;
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
\Bitrix\Main\Page\Asset::getInstance()->addCss("/bitrix/themes/.default/sale.css");
	Loc::loadMessages(__FILE__);

	$sum = PriceMaths::roundByFormatCurrency($params['PAYMENT_SHOULD_PAY'], $payment->getField('CURRENCY'));
?>
<?
$entityId = CSalePaySystemAction::GetParamValue("ORDER_PAYMENT_ID");
    list($orderId, $paymentId) = \Bitrix\Sale\PaySystem\Manager::getIdsByPayment($entityId);

if (!$orderId){
    $paymentFields = \Bitrix\Sale\Payment::getList(
        array(
            "filter" => array('ID' => $params['PAYMENT_ID']),
            "select" => array('ORDER_ID')
        )
    )->fetch();
    
    $orderId = $paymentFields["ORDER_ID"];
}

$dbOrderProps = CSaleOrderPropsValue::GetOrderProps($orderId);
while ($arOrderProps = $dbOrderProps->Fetch()){
    if ($arOrderProps["TYPE"] == "LOCATION" && $arOrderProps["ACTIVE"] == "Y" && $arOrderProps["IS_LOCATION"] == "Y" ){
        $delivery_location = $arOrderProps["VALUE"];
    }
    if ($arOrderProps["PROPERTY_NAME"] == "E-Mail"){
        $jparams["customerContact"] = $arOrderProps["VALUE"];
    }
}

$dbBasketTmp = CSaleBasket::GetList(
    array("ID" => "ASC"),
    array("ORDER_ID" => $orderId),
    false,
    false,
    array(
        "ID", "PRODUCT_ID", "PRODUCT_PRICE_ID", "PRICE", "CURRENCY", "WEIGHT",
        "QUANTITY", "NAME", "MODULE", "CALLBACK_FUNC", "NOTES", "DETAIL_PAGE_URL", "DISCOUNT_PRICE",
        "DISCOUNT_VALUE", "ORDER_CALLBACK_FUNC", "CANCEL_CALLBACK_FUNC", "PAY_CALLBACK_FUNC", "CATALOG_XML_ID",
        "PRODUCT_XML_ID", "VAT_RATE", "DISCOUNT_NAME", "DISCOUNT_COUPON", "PRODUCT_PROVIDER_CLASS", "CUSTOM_PRICE",
        "TYPE", "SET_PARENT_ID", "DIMENSIONS", "RECOMMENDATION"
    )
);
while ($arbItem = $dbBasketTmp->GetNext()){
    $items[] = array(
            "quantity" => $arbItem["QUANTITY"],
            "price" => array("amount" => round($arbItem["PRICE"], 2)),
            "tax" => 4,
            "text" => $arbItem["NAME"]
    );
}
$arOrder = CSaleOrder::GetByID($orderId);
if ($arOrder["DELIVERY_ID"] ==3) {
    $arAdditionalInfo = explode(';', $arOrder["ADDITIONAL_INFO"]);

        $arByName = array("DELIVERY_COST" => "Стоимость доставки", "FLOORING_COST" => "Подъем на этаж", "ASSEMBLING_COST" => "Сборка мебели", "GARBAGE_REMOVAL_COST" => "Вывоз упаковки");
        $arByCodes["DELIVERY_COST"] = $arAdditionalInfo[0];
        // override "Да" галок на стоимость услуг
        $arByCodes["FLOORING_COST"] = $arAdditionalInfo[1];
        $arByCodes["ASSEMBLING_COST"] = $arAdditionalInfo[2];
        $arByCodes["GARBAGE_REMOVAL_COST"] = $arAdditionalInfo[3];

    foreach ($arByCodes as $key=>$deliv){
        if ($deliv){
            $items[] = array(
                "quantity" => 1,
                "price" => array("amount" => round($deliv, 2)),
                "tax" => 4,
                "text" => $arByName[$key]
            );
        }
    }
}
$arjson = array(
    "customerContact" => $jparams["customerContact"],
    "taxSystem" => 1,
    "items" => $items
);
$yajson = json_encode($arjson, JSON_UNESCAPED_UNICODE);

if ($delivery_location > 0){
    $arCFilter = array("IBLOCK_ID" => 21, /// блок с городами салонов
        "IBLOCK_ACTIVE" => "Y",
        "ACTIVE" => "Y",
        "GLOBAL_ACTIVE" => "Y",
        "PROPERTY_LOCATION" => IntVal($delivery_location));
    $rsCElements = CIBlockElement::GetList(array(),
        $arCFilter,
        false,
        array(),
        array("PROPERTY_YAK_SHOPID",
            "PROPERTY_YAK_SCID",
            "PROPERTY_YAK_ISTEST"
        ));
    $arCity = $rsCElements->GetNext();
    if (is_numeric($arCity["PROPERTY_YAK_SHOPID_VALUE"]) && is_numeric($arCity["PROPERTY_YAK_SCID_VALUE"])){//делаем для яндекс-кассы чтобы параметры брались из инфоблока городов
        $params["YANDEX_SHOP_ID"] = $arCity["PROPERTY_YAK_SHOPID_VALUE"];
        $params["YANDEX_SCID"] = $arCity["PROPERTY_YAK_SCID_VALUE"];
        if (is_null($arCity["PROPERTY_YAK_ISTEST_VALUE_ID"])){
            $params["URL"] = "https://money.yandex.ru/eshop.xml";
        }else{
            $params["URL"] = "https://demomoney.yandex.ru/eshop.xml";
        }
    }
}
?>
<div class="sale-paysystem-wrapper">
    <div class="tablebodytext" style="text-align: center; color: #bc0000; font-weight: bold; margin-bottom: 20px;">
        ВАЖНО! Оплату банковской картой можно производить только после подтверждения заказа менеджером!
    </div>
	<span class="tablebodytext">
		<?=Loc::getMessage('SALE_HANDLERS_PAY_SYSTEM_YANDEX_DESCRIPTION');?> <?=SaleFormatCurrency($params['PAYMENT_SHOULD_PAY'], $payment->getField('CURRENCY'));?>
	</span>
	<form name="ShopForm" action="<?=$params['URL'];?>" method="post">

		<input name="ShopID" value="<?=$params['YANDEX_SHOP_ID'];?>" type="hidden">
		<input name="scid" value="<?=$params['YANDEX_SCID'];?>" type="hidden">
		<input name="customerNumber" value="<?=$params['PAYMENT_BUYER_ID'];?>" type="hidden">
		<input name="orderNumber" value="<?=$params['PAYMENT_ID'];?>" type="hidden">
		<input name="Sum" value="<?=number_format($sum, 2, '.', '')?>" type="hidden">
		<input name="paymentType" value="<?=$params['PS_MODE']?>" type="hidden">
		<input name="cms_name" value="1C-Bitrix" type="hidden">
		<input name="BX_HANDLER" value="YANDEX" type="hidden">
		<input name="BX_PAYSYSTEM_CODE" value="<?=$params['BX_PAYSYSTEM_CODE']?>" type="hidden">
        <input name="ym_merchant_receipt" value='<?=$yajson?>' type="hidden"/>
		<div class="sale-paysystem-yandex-button-container">
			<span class="sale-paysystem-yandex-button">
				<input class="sale-paysystem-yandex-button-item" name="BuyButton" value="<?=Loc::getMessage('SALE_HANDLERS_PAY_SYSTEM_YANDEX_BUTTON_PAID')?>" type="submit">
			</span><!--sale-paysystem-yandex-button-->
			<span class="sale-paysystem-yandex-button-descrition"><?=Loc::getMessage('SALE_HANDLERS_PAY_SYSTEM_YANDEX_REDIRECT_MESS');?></span><!--sale-paysystem-yandex-button-descrition-->
		</div><!--sale-paysystem-yandex-button-container-->

		<p>
			<span class="tablebodytext sale-paysystem-description"><?=Loc::getMessage('SALE_HANDLERS_PAY_SYSTEM_YANDEX_WARNING_RETURN');?></span>
		</p>
	</form>
</div><!--sale-paysystem-wrapper-->