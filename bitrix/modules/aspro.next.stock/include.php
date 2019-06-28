<?
CModule::AddAutoloadClasses(
	'aspro.next.stock',
	array(
		'CNextCacheStock' => 'classes/general/CNextCacheStock.php',
		'CNextStock' => 'classes/general/CNextStock.php',
		'CNextToolsStock' => 'classes/general/CNextToolsStock.php',
		'CNextEventsStock' => 'classes/general/CNextEventsStock.php',
		'CNextRegionalityStock' => 'classes/general/CNextRegionalityStock.php',
		'CNextConditionStock' => 'classes/general/CNextConditionStock.php',
		'CInstargramNextStock' => 'classes/general/CInstargramNextStock.php',
		'Aspro\\Solution\\CAsproMarketingB2c' => 'classes/general/CAsproMarketingB2c.php',
		'Aspro\\Functions\\CAsproSkuStock' => 'lib/functions/CAsproSkuStock.php', //for general sku functions
		'Aspro\\Functions\\CAsproItemStock' => 'lib/functions/CAsproItemStock.php', //for general item functions
		'Aspro\\Functions\\CAsproNextStock' => 'lib/functions/CAsproNextStock.php', //for only solution functions
		'Aspro\\Functions\\CAsproNextCustomStock' => 'lib/functions/CAsproNextCustomStock.php', //for user custom functions
		'Aspro\\Functions\\CAsproNextReCaptchaStock' => 'lib/functions/CAsproNextReCaptchaStock.php', //for google reCaptcha
		'Aspro\\Functions\\CAsproNextCRMStock' => 'lib/functions/CAsproNextCRMStock.php', //for integrate crm
		'Aspro\\Next\\SearchQueryStock' => 'lib/searchqueryB2c.php', //for landings in search
	)
);

/* test events */

/*AddEventHandler('aspro.next.stock', 'OnAsproRegionalityAddSelectFieldsAndProps', 'OnAsproRegionalityAddSelectFieldsAndPropsHandler'); // regionality
function OnAsproRegionalityAddSelectFieldsAndPropsHandler(&$arSelect){
	if($arSelect)
	{
		// $arSelect[] = 'PROPERTY_TEST';
	}
}*/

/*AddEventHandler('aspro.next.stock', 'OnAsproRegionalityGetElements', 'OnAsproRegionalityGetElementsHandler'); // regionality
function OnAsproRegionalityGetElementsHandler(&$arItems){
	if($arItems)
	{
		print_r($arItems);
		foreach($arItems as $key => $arItem)
		{
			$arItems[$key]['TEST'] = CUSTOM_VALUE;
		}
	}
}*/

// AddEventHandler('aspro.next.stock', 'OnAsproShowPriceMatrix', array('\Aspro\Functions\CAsproNext', 'OnAsproShowPriceMatrixHandler'));
// function - CNextStock::showPriceMatrix

// AddEventHandler('aspro.next.stock', 'OnAsproShowPriceRangeTop', array('\Aspro\Functions\CAsproNext', 'OnAsproShowPriceRangeTopHandler'));
// function - CNextStock::showPriceRangeTop

// AddEventHandler('aspro.next.stock', 'OnAsproItemShowItemPrices', array('\Aspro\Functions\CAsproNext', 'OnAsproItemShowItemPricesHandler'));
// function - \Aspro\Functions\CAsproItem::showItemPrices

// AddEventHandler('aspro.next.stock', 'OnAsproSkuShowItemPrices', array('\Aspro\Functions\CAsproNext', 'OnAsproSkuShowItemPricesHandler'));
// function - \Aspro\Functions\CAsproSku::showItemPrices

// AddEventHandler('aspro.next.stock', 'OnAsproGetTotalQuantity', array('\Aspro\Functions\CAsproNext', 'OnAsproGetTotalQuantityHandler'));
// function - CNextStock::GetTotalCount

// AddEventHandler('aspro.next.stock', 'OnAsproGetTotalQuantityBlock', array('\Aspro\Functions\CAsproNext', 'OnAsproGetTotalQuantityBlockHandler'));
// function - CNextStock::GetQuantityArray

// AddEventHandler('aspro.next.stock', 'OnAsproGetBuyBlockElement', array('\Aspro\Functions\CAsproNext', 'OnAsproGetBuyBlockElementHandler'));
// function - CNextStock::GetAddToBasketArray

?>