<?
CModule::AddAutoloadClasses(
	'aspro.next.b2c',
	array(
		'CNextCacheB2c' => 'classes/general/CNextCacheB2c.php',
		'CNextB2c' => 'classes/general/CNextB2c.php',
		'CNextToolsB2c' => 'classes/general/CNextToolsB2c.php',
		'CNextEventsB2c' => 'classes/general/CNextEventsB2c.php',
		'CNextRegionalityB2c' => 'classes/general/CNextRegionalityB2c.php',
		'CNextConditionB2c' => 'classes/general/CNextConditionB2c.php',
		'CInstargramNextB2c' => 'classes/general/CInstargramNextB2c.php',
		'Aspro\\Solution\\CAsproMarketingB2c' => 'classes/general/CAsproMarketingB2c.php',
		'Aspro\\Functions\\CAsproSkuB2c' => 'lib/functions/CAsproSkuB2c.php', //for general sku functions
		'Aspro\\Functions\\CAsproItemB2c' => 'lib/functions/CAsproItemB2c.php', //for general item functions
		'Aspro\\Functions\\CAsproNextB2c' => 'lib/functions/CAsproNextB2c.php', //for only solution functions
		'Aspro\\Functions\\CAsproNextCustomB2c' => 'lib/functions/CAsproNextCustomB2c.php', //for user custom functions
		'Aspro\\Functions\\CAsproNextReCaptchaB2c' => 'lib/functions/CAsproNextReCaptchaB2c.php', //for google reCaptcha
		'Aspro\\Functions\\CAsproNextCRMB2c' => 'lib/functions/CAsproNextCRMB2c.php', //for integrate crm
		'Aspro\\Next\\SearchQueryB2c' => 'lib/searchqueryB2c.php', //for landings in search
	)
);

/* test events */

/*AddEventHandler('aspro.next.b2c', 'OnAsproRegionalityAddSelectFieldsAndProps', 'OnAsproRegionalityAddSelectFieldsAndPropsHandler'); // regionality
function OnAsproRegionalityAddSelectFieldsAndPropsHandler(&$arSelect){
	if($arSelect)
	{
		// $arSelect[] = 'PROPERTY_TEST';
	}
}*/

/*AddEventHandler('aspro.next.b2c', 'OnAsproRegionalityGetElements', 'OnAsproRegionalityGetElementsHandler'); // regionality
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

// AddEventHandler('aspro.next.b2c', 'OnAsproShowPriceMatrix', array('\Aspro\Functions\CAsproNext', 'OnAsproShowPriceMatrixHandler'));
// function - CNextB2c::showPriceMatrix

// AddEventHandler('aspro.next.b2c', 'OnAsproShowPriceRangeTop', array('\Aspro\Functions\CAsproNext', 'OnAsproShowPriceRangeTopHandler'));
// function - CNextB2c::showPriceRangeTop

// AddEventHandler('aspro.next.b2c', 'OnAsproItemShowItemPrices', array('\Aspro\Functions\CAsproNext', 'OnAsproItemShowItemPricesHandler'));
// function - \Aspro\Functions\CAsproItem::showItemPrices

// AddEventHandler('aspro.next.b2c', 'OnAsproSkuShowItemPrices', array('\Aspro\Functions\CAsproNext', 'OnAsproSkuShowItemPricesHandler'));
// function - \Aspro\Functions\CAsproSku::showItemPrices

// AddEventHandler('aspro.next.b2c', 'OnAsproGetTotalQuantity', array('\Aspro\Functions\CAsproNext', 'OnAsproGetTotalQuantityHandler'));
// function - CNextB2c::GetTotalCount

// AddEventHandler('aspro.next.b2c', 'OnAsproGetTotalQuantityBlock', array('\Aspro\Functions\CAsproNext', 'OnAsproGetTotalQuantityBlockHandler'));
// function - CNextB2c::GetQuantityArray

// AddEventHandler('aspro.next.b2c', 'OnAsproGetBuyBlockElement', array('\Aspro\Functions\CAsproNext', 'OnAsproGetBuyBlockElementHandler'));
// function - CNextB2c::GetAddToBasketArray

?>