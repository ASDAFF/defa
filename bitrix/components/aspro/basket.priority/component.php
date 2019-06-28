<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule('iblock')){
	ShowError(GetMessage('IBLOCK_MODULE_NOT_INSTALLED'));
	return;
}
if(!CModule::IncludeModule('aspro.priority')){
	ShowError(GetMessage('ASPRO_PRIORITY_MODULE_NOT_INSTALLED'));
	return;
}

//$this->setFramemode(false);
$arModuleOptions = CPriority::GetFrontParametrsValues(SITE_ID);

if($arModuleOptions['ORDER_VIEW'] === 'Y'){
	if($arParams['CHECK_BASKET_URL'] == 'Y' && (CPriority::IsBasketPage($arModuleOptions["URL_BASKET_SECTION"]) || CPriority::IsOrderPage($arModuleOptions["URL_ORDER_SECTION"])))
	{
		return;
	}
	else
	{
		$arParams['PATH_TO_BASKET'] = (strlen(trim($arModuleOptions['URL_BASKET_SECTION'])) ? trim($arModuleOptions['URL_BASKET_SECTION']) : '');
		$arParams['PATH_TO_ORDER'] = (strlen(trim($arModuleOptions['URL_ORDER_SECTION'])) ? trim($arModuleOptions['URL_ORDER_SECTION']) : '');

		global $USER;
		$userID = CUser::GetID();
		$userID = ($userID > 0 ? $userID : 0);
		
		if(isset($_SESSION[SITE_ID][$userID]['BASKET_ITEMS']) && is_array($_SESSION[SITE_ID][$userID]['BASKET_ITEMS']) && $_SESSION[SITE_ID][$userID]['BASKET_ITEMS']){
			$arResult['ITEMS'] = array();
			$arItems = $_SESSION[SITE_ID][$userID]['BASKET_ITEMS'];
			$allSumm = 0;
			
			foreach($arItems as $arItem){
				$arItem['PICTURE'] = (strlen($arItem['PREVIEW_PICTURE']) ? $arItem['PREVIEW_PICTURE'] : (strlen($arItem['DETAIL_PICTURE']) ? $arItem['DETAIL_PICTURE'] : ''));
				$arItem['PICTURE'] = CFile::GetFileArray($arItem['PICTURE']);
				$arItem['PICTURE']['IMAGE_80'] = CFile::ResizeImageGet($arItem['PICTURE']['ID'], array('width' => 80, 'height' => 80), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true );
				$arItem['PICTURE']['IMAGE_110'] = CFile::ResizeImageGet($arItem['PICTURE']['ID'], array('width' => 110, 'height' => 110), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true );
				$arItem['PROPERTY_STATUS'] = CIBlockPropertyEnum::GetByID($arItem['PROPERTY_STATUS_VALUE']);		
				if(strlen(trim($arItem['PROPERTY_PRICE_VALUE']))){
					$arItem['SUMM'] = CPriority::FormatSumm($arItem['PROPERTY_FILTER_PRICE_VALUE'], $arItem['QUANTITY']);
					$allSumm += floatval(str_replace(' ', '', $arItem['PROPERTY_FILTER_PRICE_VALUE'])) * $arItem['QUANTITY'];
				}
				$arResult['ITEMS'][$arItem['ID']] = $arItem;
			}
			
			$arResult['ALL_SUM'] = CPriority::FormatSumm($allSumm, 1);
			$arResult['ITEMS_COUNT'] = ($arResult['ITEMS'] ? count($arResult['ITEMS']) : 0);
		}
		else{
			$arResult['ITEMS_COUNT'] = 0;
		}
		
		if($arResult['ITEMS']){
			$arResult['IBLOCK_TARIF'] = array();
			$dbRes = CIBlock::GetList(array(), array('ID' => CCache::$arIBlocks[SITE_ID]["aspro_priority_catalog"]["aspro_priority_tarif"][0]));
			if($arRes = $dbRes->Fetch()){
				$arResult['IBLOCK_TARIF'][$arRes['ID']] = $arRes['NAME'];
			}
		}
		
		$this->IncludeComponentTemplate();
	}
}
else{
	if($arParams['NO_REDIRECT'] != 'Y')
		CPriority::goto404Page();
}