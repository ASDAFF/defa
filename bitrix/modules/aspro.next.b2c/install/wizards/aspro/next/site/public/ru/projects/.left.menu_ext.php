<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$aMenuLinksExt = array();

if($arMenuParametrs = CNextB2c::GetDirMenuParametrs(__DIR__)){
	if($arMenuParametrs['MENU_SHOW_SECTIONS'] == 'Y'){
		$arSections = CNextCacheB2c::CIBlockSection_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => CNextCacheB2c::GetIBlockCacheTag(CNextCacheB2c::$arIBlocks[SITE_ID]['aspro_next_content']['aspro_next_projects'][0]), 'MULTI' => 'Y')), array('IBLOCK_ID' => CNextCacheB2c::$arIBlocks[SITE_ID]['aspro_next_content']['aspro_next_projects'][0], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'));
		$arSectionsByParentSectionID = CNextCacheB2c::GroupArrayBy($arSections, array('MULTI' => 'Y', 'GROUP' => array('IBLOCK_SECTION_ID')));
	}

	if($arMenuParametrs['MENU_SHOW_ELEMENTS'] == 'Y'){
		$arItems = CNextCacheB2c::CIBlockElement_GetList(array('SORT' => 'ASC', 'ID' => 'DESC', 'CACHE' => array('TAG' => CNextCacheB2c::GetIBlockCacheTag(CNextCacheB2c::$arIBlocks[SITE_ID]['aspro_next_content']['aspro_next_projects'][0]), 'MULTI' => 'Y')), array('IBLOCK_ID' => CNextCacheB2c::$arIBlocks[SITE_ID]['aspro_next_content']['aspro_next_projects'][0], 'ACTIVE' => 'Y', 'SECTION_GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'INCLUDE_SUBSECTIONS' => 'Y'));
		if($arMenuParametrs['MENU_SHOW_SECTIONS'] == 'Y'){
			$arItemsBySectionID = CNextCacheB2c::GroupArrayBy($arItems, array('MULTI' => 'Y', 'GROUP' => array('IBLOCK_SECTION_ID')));
		}
		else{
			$arItemsRoot = CNextCacheB2c::CIBlockElement_GetList(array('SORT' => 'ASC', 'ID' => 'DESC', 'CACHE' => array('TAG' => CNextCacheB2c::GetIBlockCacheTag(CNextCacheB2c::$arIBlocks[SITE_ID]['aspro_next_content']['aspro_next_projects'][0]), 'MULTI' => 'Y')), array('IBLOCK_ID' => CNextCacheB2c::$arIBlocks[SITE_ID]['aspro_next_content']['aspro_next_projects'][0], 'ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'SECTION_ID' => 0));
			$arItems = array_merge((array)$arItems, (array)$arItemsRoot);
		}
	}
	
	if($arSections){
		CNextB2c::getSectionChilds(false, $arSections, $arSectionsByParentSectionID, $arItemsBySectionID, $aMenuLinksExt);
	}

	if($arItems && $arMenuParametrs['MENU_SHOW_SECTIONS'] != 'Y'){
		foreach($arItems as $arItem){
			$aMenuLinksExt[] = array($arItem['NAME'], $arItem['DETAIL_PAGE_URL'], array(), array('FROM_IBLOCK' => 1, 'DEPTH_LEVEL' => 1));
		}
	}
}

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>