<?
CModule::AddAutoloadClasses(
	'aspro.next.b2c',
	array(
		'CNextCacheB2c' => 'classes/general/CNextCache.php',
		'CNextB2c' => 'classes/general/CNext.php',
		'CNextToolsB2c' => 'classes/general/CNextTools.php',
		'CNextEventsB2c' => 'classes/general/CNextEvents.php',
		'CNextRegionalityB2c' => 'classes/general/CNextRegionality.php',
		'CNextConditionB2c' => 'classes/general/CNextCondition.php',
		'CInstargramNextB2c' => 'classes/general/CInstargramNext.php',
		'Aspro\\Solution\\CAsproMarketingB2c' => 'classes/general/CAsproMarketing.php',
		'Aspro\\Functions\\CAsproSkuB2c' => 'lib/functions/CAsproSku.php', //for general sku functions
		'Aspro\\Functions\\CAsproItemB2c' => 'lib/functions/CAsproItem.php', //for general item functions
		'Aspro\\Functions\\CAsproNextB2c' => 'lib/functions/CAsproNext.php', //for only solution functions
		'Aspro\\Functions\\CAsproNextCustomB2c' => 'lib/functions/CAsproNextCustom.php', //for user custom functions
		'Aspro\\Functions\\CAsproNextReCaptchaB2c' => 'lib/functions/CAsproNextReCaptcha.php', //for google reCaptcha
		'Aspro\\Functions\\CAsproNextCRMB2c' => 'lib/functions/CAsproNextCRM.php', //for integrate crm
		'Aspro\\Next\\SearchQueryB2c' => 'lib/searchquery.php', //for landings in search
	)
);
var_dump('AddAutoloadClasses aspro.next.b2c');

/* test events */

/*AddEventHandler('aspro.next', 'OnAsproRegionalityAddSelectFieldsAndProps', 'OnAsproRegionalityAddSelectFieldsAndPropsHandler'); // regionality
function OnAsproRegionalityAddSelectFieldsAndPropsHandler(&$arSelect){
	if($arSelect)
	{
		// $arSelect[] = 'PROPERTY_TEST';
	}
}*/

/*AddEventHandler('aspro.next', 'OnAsproRegionalityGetElements', 'OnAsproRegionalityGetElementsHandler'); // regionality
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

// AddEventHandler('aspro.next', 'OnAsproShowPriceMatrix', array('\Aspro\Functions\CAsproNext', 'OnAsproShowPriceMatrixHandler'));
// function - CNext::showPriceMatrix

// AddEventHandler('aspro.next', 'OnAsproShowPriceRangeTop', array('\Aspro\Functions\CAsproNext', 'OnAsproShowPriceRangeTopHandler'));
// function - CNext::showPriceRangeTop

// AddEventHandler('aspro.next', 'OnAsproItemShowItemPrices', array('\Aspro\Functions\CAsproNext', 'OnAsproItemShowItemPricesHandler'));
// function - \Aspro\Functions\CAsproItem::showItemPrices

// AddEventHandler('aspro.next', 'OnAsproSkuShowItemPrices', array('\Aspro\Functions\CAsproNext', 'OnAsproSkuShowItemPricesHandler'));
// function - \Aspro\Functions\CAsproSku::showItemPrices

// AddEventHandler('aspro.next', 'OnAsproGetTotalQuantity', array('\Aspro\Functions\CAsproNext', 'OnAsproGetTotalQuantityHandler'));
// function - CNext::GetTotalCount

// AddEventHandler('aspro.next', 'OnAsproGetTotalQuantityBlock', array('\Aspro\Functions\CAsproNext', 'OnAsproGetTotalQuantityBlockHandler'));
// function - CNext::GetQuantityArray

// AddEventHandler('aspro.next', 'OnAsproGetBuyBlockElement', array('\Aspro\Functions\CAsproNext', 'OnAsproGetBuyBlockElementHandler'));
// function - CNext::GetAddToBasketArray

?>