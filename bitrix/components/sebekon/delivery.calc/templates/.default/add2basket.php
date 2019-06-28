<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$CART_ID = 0;
$MAP_ID = intval($_REQUEST["MAP_ID"]);

if(CModule::IncludeModule("sale") && CModule::IncludeModule("iblock") && CModule::IncludeModule('sebekon.deliveryprice') && $MAP_ID){
	
	$dbBasketItems = CSaleBasket::GetList(
        array(),
        array(
			"FUSER_ID" => CSaleBasket::GetBasketUserID(),
			"LID" => SITE_ID,
			"ORDER_ID" => "NULL",
			"MODULE" => "sebekon.deliveryprice"
		)
	);
	while($dbBasketItem = $dbBasketItems->GetNext()){
		CSaleBasket::Delete($dbBasketItem["ID"]);
	}
	
	$arFields = array(
		"PRODUCT_ID"=> $MAP_ID,
		"PRICE" 	=> floatval($_REQUEST["DELIVERY_PRICE"]),
		"CURRENCY" 	=> "RUB",
		"QUANTITY"	=> 1,
		"LID"		=> SITE_ID,
		"NAME"		=> GetMessage("sebekon_DP_MODULE_NAME"),
		"MODULE"	=> "sebekon.deliveryprice",
		"CAN_BUY"	=> "Y",
		"DELAY"		=> "N"
	);
	
	//получаем название способа доставки
	$el = CIBlockElement::GetList(
		array(),
		array(
			"ID" => $MAP_ID
		)
	);
	if($el = $el->GetNext()){
		$arFields["NAME"] = GetMessage("sebekon_DP_DELIVERY_BY")." ".$el["NAME"];
	}
	
	$events = GetModuleEvents("sebekon.deliveryprice", "OnBasketShippingPriceCalculated");
	while ($arEvent = $events->Fetch())
		ExecuteModuleEventEx($arEvent, array(&$arFields));
	
	$CART_ID = CSaleBasket::Add($arFields);
}

echo $CART_ID;

?>