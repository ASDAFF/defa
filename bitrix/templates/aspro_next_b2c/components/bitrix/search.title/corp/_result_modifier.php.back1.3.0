<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?use Bitrix\Currency\CurrencyTable;?>

<?
$arResult["ELEMENTS"] = array();
$arResult["SEARCH"] = array();

$arParams["PRICE_VAT_INCLUDE"] = $arParams["PRICE_VAT_INCLUDE"] !== "N";

$arCatalogs = array();
if (CModule::IncludeModule("catalog"))
{
	$rsCatalog = CCatalog::GetList(array(
		"sort" => "asc",
	));
	while ($ar = $rsCatalog->Fetch())
	{
		if ($ar["PRODUCT_IBLOCK_ID"])
			$arCatalogs[$ar["PRODUCT_IBLOCK_ID"]] = 1;
		else
			$arCatalogs[$ar["IBLOCK_ID"]] = 1;
	}
}

foreach($arResult["CATEGORIES"] as $category_id => $arCategory)
{
	foreach($arCategory["ITEMS"] as $i => $arItem)
	{
		if(isset($arItem["ITEM_ID"]))
		{
			$arResult["SEARCH"][] = &$arResult["CATEGORIES"][$category_id]["ITEMS"][$i];
			if($arItem["MODULE_ID"] == "iblock" && (strpos($arItem["ITEM_ID"], "S") === false)){
				$arResult["ELEMENTS"][$arItem["ITEM_ID"]] = $arItem["ITEM_ID"];
				if(array_key_exists($arItem["PARAM2"], $arCatalogs))
					$arResult["CATALOG_ELEMENTS"][$arItem["ITEM_ID"]] = $arItem["ITEM_ID"];
			}
		}
	}
}

if (!empty($arResult["ELEMENTS"]) && CModule::IncludeModule("iblock"))
{
	/*convert currency*/
	$arConvertParams = array();
	if ('Y' == $arParams['CONVERT_CURRENCY'])
	{
		if (!CModule::IncludeModule('currency'))
		{
			$arParams['CONVERT_CURRENCY'] = 'N';
			$arParams['CURRENCY_ID'] = '';
		}
		else
		{
			$currencyIterator = CurrencyTable::getList(array(
				'select' => array('CURRENCY'),
				'filter' => array('=CURRENCY' => $arParams['CURRENCY_ID'])
			));
			if ($currency = $currencyIterator->fetch())
			{
				$arParams['CURRENCY_ID'] = $currency['CURRENCY'];
				$arConvertParams['CURRENCY_ID'] = $currency['CURRENCY'];
			}
			else
			{
				$arParams['CONVERT_CURRENCY'] = 'N';
				$arParams['CURRENCY_ID'] = '';
			}
			unset($currency, $currencyIterator);
		}
	}

	$bHideNotAvailable = (\Bitrix\Main\Config\Option::get('aspro.next', 'SEARCH_HIDE_NOT_AVAILABLE', 'N') == 'Y');

	$strBaseCurrency = '';
	$boolConvert = isset($arConvertParams['CURRENCY_ID']);
	if (!$boolConvert)
		$strBaseCurrency = CCurrency::GetBaseCurrency();
	
	$obParser = new CTextParser;
	
	global $arRegion;
	if($arRegion)
	{
		if($arRegion["LIST_PRICES"] && !in_array('component', $arRegion["LIST_PRICES"]))
			$arParams["PRICE_CODE"] = array_keys($arRegion["LIST_PRICES"]);
	}
	
	if (is_array($arParams["PRICE_CODE"]))
		$arResult["PRICES"] = CIBlockPriceTools::GetCatalogPrices(0, $arParams["PRICE_CODE"]);
	else
		$arResult["PRICES"] = array();
	
	$arSelect = array(
		"ID",
		"IBLOCK_ID",
		"PREVIEW_TEXT",
		"PREVIEW_PICTURE",
		"DETAIL_PICTURE",
		"DETAIL_PAGE_URL",
		"ACTIVE_FROM",
		"PROPERTY_REDIRECT",
	);
	$arFilter = array(
		"IBLOCK_LID" => SITE_ID,
		"IBLOCK_ACTIVE" => "Y",
		"ACTIVE_DATE" => "Y",
		"ACTIVE" => "Y",
		"CHECK_PERMISSIONS" => "Y",
		"MIN_PERMISSION" => "R",
	);

	if($arParams["SHOW_PREVIEW"] == "Y"){
		$arSelect[] = 'PROPERTY_CML2_LINK';
	}

	foreach($arResult["PRICES"] as $value)
	{
		$arSelect[] = $value["SELECT"];
		$arFilter["CATALOG_SHOP_QUANTITY_".$value["ID"]] = 1;
	}

	$arFilter["=ID"] = $arResult["ELEMENTS"];

	$arDeleteIDs = $arUnDeleteIDs = array();

	if($bHideNotAvailable)
	{
		$arFilter["CATALOG_AVAILABLE"] = "Y";
		if($arRegion)
		{
			if($arRegion["LIST_STORES"])
			{
				$arTmpFilter = array();
				foreach($arRegion["LIST_STORES"] as $storeID)
				{
					if($storeID !== 'component'){
						$arTmpFilter[] = array(">CATALOG_STORE_AMOUNT_".$storeID => 0);
					}
				}
				if($arTmpFilter){
					$arTmpFilter["LOGIC"] = "OR";
					$arFilter[] = $arTmpFilter;
				}
			}
		}
	}

	$arOffersWithoutPictureProductsIDs = array();

	$rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	while($arElement = $rsElements->Fetch())
	{
		$arRegionProps = array();
		$rsPropRegion = CIBlockElement::GetProperty($arElement["IBLOCK_ID"], $arElement["ID"], array("sort" => "asc"), Array("CODE"=>"LINK_REGION"));
		while($arPropRegion = $rsPropRegion->Fetch())
		{
			if($arPropRegion['VALUE'])
				$arRegionProps[] = $arPropRegion['VALUE'];
		}
		if($arRegionProps && $arRegion)
		{
			if(!in_array($arRegion['ID'], $arRegionProps))
			{
				$arDeleteIDs[$arElement["ID"]] = $arElement["ID"];
				unset($arResult["ELEMENTS"][$arElement["ID"]]);
				continue;
			}
		}

		if($bHideNotAvailable)
			$arUnDeleteIDs[$arElement["ID"]] = $arElement["ID"];

		if($arParams["SHOW_PREVIEW"] == "Y"){
			if($arElement['PROPERTY_CML2_LINK_VALUE'] && !$arElement['PREVIEW_PICTURE'] && !$arElement['DETAIL_PICTURE']){
				$arOffersWithoutPictureProductsIDs[$arElement["ID"]] = $arElement['PROPERTY_CML2_LINK_VALUE'];
			}
		}

		$arElement["PRICES"] = CIBlockPriceTools::GetItemPrices($arElement["IBLOCK_ID"], $arResult["PRICES"], $arElement, $arParams['PRICE_VAT_INCLUDE'], $arConvertParams);
		
		$arResult["ELEMENTS"][$arElement["ID"]] = $arElement;

		/*offers*/
		$offersFilter = array(
			'IBLOCK_ID' => $arElement['IBLOCK_ID'],
			'HIDE_NOT_AVAILABLE' => "N"
		);
		$arOffers = CIBlockPriceTools::GetOffersArray(
			$offersFilter,
			array($arElement["ID"]),
			array(),
			array("ID"),
			array(),
			10,
			$arResult["PRICES"],
			$arParams['PRICE_VAT_INCLUDE'],
			$arConvertParams
		);
		if($arOffers){
			$arResult["ELEMENTS"][$arElement["ID"]]["OFFERS"]=$arOffers;
			$arResult["ELEMENTS"][$arElement["ID"]]["MIN_PRICE"]=CNext::getMinPriceFromOffersExt(
					$arOffers,
					$boolConvert ? $arConvertParams['CURRENCY_ID'] : $strBaseCurrency
				);
		}
	}

	if($arOffersWithoutPictureProductsIDs){
		$rsElements = CIBlockElement::GetList(array(), array('ID' => array_values($arOffersWithoutPictureProductsIDs)), false, false, array('ID', 'PREVIEW_PICTURE', 'DETAIL_PICTURE'));
		while($arElement = $rsElements->Fetch()){
			if($arOffersIDs = array_keys($arOffersWithoutPictureProductsIDs, $arElement['ID'])){
				foreach($arOffersIDs as $id){
					$arResult["ELEMENTS"][$id]['PREVIEW_PICTURE'] = $arElement['PREVIEW_PICTURE'];
					$arResult["ELEMENTS"][$id]['DETAIL_PICTURE'] = $arElement['DETAIL_PICTURE'];
				}
			}
		}
	}

	// replace year in url
	foreach($arResult["CATEGORIES"] as $category_id => $arCategory)
	{
		foreach($arCategory["ITEMS"] as $i => $arItem)
		{
			if(isset($arItem["ITEM_ID"]))
			{
				if($arResult["ELEMENTS"][$arItem["ITEM_ID"]]["PROPERTY_REDIRECT_VALUE"])
				{
					$arResult["CATEGORIES"][$category_id]["ITEMS"][$i]["URL"] = $arResult["ELEMENTS"][$arItem["ITEM_ID"]]["PROPERTY_REDIRECT_VALUE"];
				}
				elseif(strpos($arItem["URL"], "#YEAR#") !== false)
				{
					if($arResult["ELEMENTS"][$arItem["ITEM_ID"]]["ACTIVE_FROM"])
					{
						if($arDateTime = ParseDateTime($arResult["ELEMENTS"][$arItem["ITEM_ID"]]["ACTIVE_FROM"], FORMAT_DATETIME))
						{
							$url = str_replace("#YEAR#", $arDateTime['YYYY'], $arItem['URL']);
							$arResult["CATEGORIES"][$category_id]["ITEMS"][$i]["URL"] = $url;
						}
					}
				}
				if($bHideNotAvailable)
				{
					if(!$arUnDeleteIDs[$arItem["ITEM_ID"]])
						unset($arResult["CATEGORIES"][$category_id]["ITEMS"][$i]);
				}
				if($arDeleteIDs)
				{
					if($arDeleteIDs[$arItem["ITEM_ID"]])
						unset($arResult["CATEGORIES"][$category_id]["ITEMS"][$i]);
				}
			}
		}
	}
}

foreach($arResult["SEARCH"] as $i=>$arItem)
{
	switch($arItem["MODULE_ID"])
	{
		case "iblock":
			if(array_key_exists($arItem["ITEM_ID"], $arResult["ELEMENTS"]))
			{
				$arElement = &$arResult["ELEMENTS"][$arItem["ITEM_ID"]];
				if ($arParams["SHOW_PREVIEW"] == "Y")
				{
					if ($arElement["PREVIEW_PICTURE"] > 0)
						$arElement["PICTURE"] = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], array("width"=>80, "height"=>80), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					elseif ($arElement["DETAIL_PICTURE"] > 0)
						$arElement["PICTURE"] = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], array("width"=>80, "height"=>80), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				}
			}
			break;
	}
	$arResult["SEARCH"][$i]["ICON"] = true;
	if($arDeleteIDs)
	{
		if($arDeleteIDs[$arItem["ITEM_ID"]])
			unset($arResult["SEARCH"][$i]);
	}
}
if(!$arResult["SEARCH"])
	$arResult["CATEGORIES"] = array();
?>