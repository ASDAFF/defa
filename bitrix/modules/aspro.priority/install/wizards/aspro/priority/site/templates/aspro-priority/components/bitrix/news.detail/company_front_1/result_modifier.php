<?
CPriority::getFieldImageData($arResult, array('PREVIEW_PICTURE'));
$arResult['BG_VALUE'] = ((isset($arResult['FIELDS']['PREVIEW_PICTURE']) && $arResult['FIELDS']['PREVIEW_PICTURE']) ? $arResult['FIELDS']['PREVIEW_PICTURE'] : (isset($arResult['FIELDS']['DETAIL_PICTURE']) && $arResult['FIELDS']['DETAIL_PICTURE']) );

//regional filter
$arResult['EMPTY_ITEM'] = 'N';
if($arParams['FILTER_NAME'])
{
	if(!is_array($GLOBALS[$arParams['FILTER_NAME']]))
		$GLOBALS[$arParams['FILTER_NAME']] = array();
	$arElement = CCache::CIblockElement_GetList(array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'N')), array_merge(array('ID' => $arResult['ID']), $GLOBALS[$arParams['FILTER_NAME']]), false, false, array('ID'));
	if(!$arElement)
		$arResult['EMPTY_ITEM'] = 'Y';
}
?>