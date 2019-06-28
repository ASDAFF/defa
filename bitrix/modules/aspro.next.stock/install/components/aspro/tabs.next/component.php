<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?\Bitrix\Main\Loader::includeModule('iblock');
$arTabs = $arShowProp = array();
global $USER;

$arResult["SHOW_SLIDER_PROP"] = false;
if(strlen($arParams["FILTER_NAME"])<=0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
{
	$arrFilter = array();
}
else
{
	$arrFilter = $GLOBALS[$arParams["FILTER_NAME"]];
	if(!is_array($arrFilter))
		$arrFilter = array();
}

$arFilter = array("ACTIVE" => "Y", "IBLOCK_ID" => $arParams["IBLOCK_ID"]);
if($arParams["SECTION_ID"])
	$arFilter[]=array("SECTION_ID" => $arParams["SECTION_ID"], "INCLUDE_SUBSECTIONS" => "Y");
elseif($arParams["SECTION_CODE"])
	$arFilter[]=array("SECTION_CODE" => $arParams["SECTION_CODE"], "INCLUDE_SUBSECTIONS" => "Y");

global $arTheme, $isShowCatalogElements;
$bCatalogIndex = $isShowCatalogElements;


$arParams["USE_PERMISSIONS"] = $arParams["USE_PERMISSIONS"]=="Y";
if(!is_array($arParams["GROUP_PERMISSIONS"]))
	$arParams["GROUP_PERMISSIONS"] = array(1);

$bUSER_HAVE_ACCESS = !$arParams["USE_PERMISSIONS"];
if($arParams["USE_PERMISSIONS"] && isset($GLOBALS["USER"]) && is_object($GLOBALS["USER"]))
{
	$arUserGroupArray = $USER->GetUserGroupArray();
	foreach($arParams["GROUP_PERMISSIONS"] as $PERM)
	{
		if(in_array($PERM, $arUserGroupArray))
		{
			$bUSER_HAVE_ACCESS = true;
			break;
		}
	}
}



if($bCatalogIndex)
{
	$arShowProp = CNextCacheStock::CIBlockPropertyEnum_GetList(Array("sort" => "asc", "id" => "desc", "CACHE" => array("TAG" => CNextCacheStock::GetPropertyCacheTag($arParams["TABS_CODE"]))), Array("ACTIVE" => "Y", "IBLOCK_ID" => $arParams["IBLOCK_ID"], "CODE" => $arParams["TABS_CODE"]));

	if($arShowProp)
	{
		if($arParams['STORES'])
		{
			foreach($arParams['STORES'] as $key => $store)
			{
				if(!$store)
					unset($arParams['STORES'][$key]);
			}
		}
		global $arRegion;
		$arFilterStores = array();
		if($arRegion)
		{
			$arParams['USE_REGION'] = 'Y';
			if($arRegion['LIST_PRICES'])
			{
				if(reset($arRegion['LIST_PRICES']) != 'component')
				{
					$arParams['PRICE_CODE'] = array_keys($arRegion['LIST_PRICES']);
					$arParams['~PRICE_CODE'] = array_keys($arRegion['LIST_PRICES']);
				}
			}
			if($arRegion['LIST_STORES'])
			{
				if(reset($arRegion['LIST_STORES']) != 'component')
				{
					$arParams['STORES'] = $arRegion['LIST_STORES'];
					$arParams['~STORES'] = $arRegion['LIST_STORES'];
				}

				if($arParams["HIDE_NOT_AVAILABLE"] == "Y")
				{
					$arTmpFilter["LOGIC"] = "OR";
					foreach($arParams['STORES'] as $storeID)
					{
						$arTmpFilter[] = array(">CATALOG_STORE_AMOUNT_".$storeID => 0);
					}
					$arFilterStores[] = $arTmpFilter;
				}
			}
		}
		
		foreach($arShowProp as $key => $prop)
		{
			$arItems = array();
			$arFilterProp = array("PROPERTY_".$arParams["TABS_CODE"]."_VALUE" => array($prop));

			$arItems = CNextCacheStock::CIBLockElement_GetList(array('CACHE' => array("MULTI" => "N", "TAG" => CNextCacheStock::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array_merge($arFilter, $arrFilter, $arrFilter, $arFilterProp), false, array("nTopCount" => 1), array("ID"));
			if($arItems)
			{
				$arTabs[$key] = array(
					"TITLE" => $prop,
					"FILTER" => array_merge($arFilterProp, $arFilter, $arrFilter, $arFilterStores)
				);
				$arResult["SHOW_SLIDER_PROP"] = true;
			}
		}
	}
	else
	{
		return;
	}
	$arParams["PROP_CODE"] = $arParams["TABS_CODE"];
	$arResult["TABS"] = $arTabs;

	$this->IncludeComponentTemplate();
}
else
	return;?>