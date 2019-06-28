<?
foreach($arResult['ITEMS'] as $key => $arItem){
	CPriority::getFieldImageData($arResult['ITEMS'][$key], array('PREVIEW_PICTURE'));
	
	$arItemsID = array();
	
	if($arItem['IBLOCK_ID'] == CCache::$arIBlocks[SITE_ID]["aspro_priority_form"]["aspro_priority_add_review"][0]){
		$arItemsID[] = $arItem['ID'];
	}
}

if($arItemsID){
	$arItemFilter = array('IBLOCK_ID' => CCache::$arIBlocks[SITE_ID]["aspro_priority_form"]["aspro_priority_add_review"][0], 'ID' => $arItemsID);
	
	$arElement = CCache::CIblockElement_GetList(array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag(CCache::$arIBlocks[SITE_ID]["aspro_priority_form"]["aspro_priority_add_review"][0]), 'MULTI' => 'N', 'GROUP' => 'ID')), $arItemFilter, false, false, array('ID', 'PROPERTY_MESSAGE'));
	
	if($arElement){
		foreach($arResult['ITEMS'] as $key => $arItem){
			$arResult['ITEMS'][$key]['PREVIEW_TEXT'] = $arElement[$arItem['ID']]['PROPERTY_MESSAGE_VALUE']['TEXT'];
		}
	}
}
?>