<?
$bAjaxMode = (isset($_POST["AJAX_POST"]) && $_POST["AJAX_POST"] == "Y");
if($bAjaxMode){
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	global $APPLICATION;
	\Bitrix\Main\Loader::includeModule("aspro.priority");
	
	$arParams = unserialize(urldecode($_POST['AJAX_PARAMS']));
	$arParams['NEWS_COUNT'] = ($arParams['NEWS_COUNT'] + $arParams['ADD_ELEMENT_COUNT'] < $arParams['MAX_COUNT_ELEMENTS_ON_PAGE'] ? $arParams['NEWS_COUNT'] + $arParams['ADD_ELEMENT_COUNT'] : $arParams['MAX_COUNT_ELEMENTS_ON_PAGE']);
	
	$GLOBALS[$arParams['FILTER_NAME']] = array('!PROPERTY_SHOW_ON_INDEX_PAGE' => false);
	
	//region filter
	if(!$arRegion)
		$arRegion = CPriorityRegionality::getCurrentRegion();
	if($arRegion && CPriority::GetFrontParametrValue('REGIONALITY_FILTER_ITEM') == 'Y')
		$GLOBALS[$arParams['FILTER_NAME']]['PROPERTY_LINK_REGION'] = $arRegion['ID'];

	$APPLICATION->IncludeComponent(
		"bitrix:news.list", 
		$_REQUEST['TEMPLATE_NAME'], 
		$arParams,
		false
	);
}
?>