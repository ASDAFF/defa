<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$aMenuLinksExt = array();

if($arMenuParametrs = CPriority::GetDirMenuParametrs(__DIR__)){
	if($arMenuParametrs['MENU_SHOW_SECTIONS'] == 'Y' || $arMenuParametrs['MENU_SHOW_ELEMENTS'] == 'Y'){
		global $APPLICATION;
	}
	
	if($arMenuParametrs['MENU_SHOW_SECTIONS'] == 'Y'){
		$arSections = CCache::CIBlockSection_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag(CCache::$arIBlocks[SITE_ID]['aspro_priority_content']['aspro_priority_staff'][0]), 'MULTI' => 'Y')), array('IBLOCK_ID' => CCache::$arIBlocks[SITE_ID]['aspro_priority_content']['aspro_priority_staff'][0], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'), false, array('IBLOCK_ID', 'ID', 'IBLOCK_SECTION_ID', 'NAME', 'SECTION_PAGE_URL', 'PICTURE', 'DEPTH_LEVEL', 'UF_ICON'));
		$arSectionsByParentSectionID = CCache::GroupArrayBy($arSections, array('MULTI' => 'Y', 'GROUP' => array('IBLOCK_SECTION_ID')));
	}

	if($arMenuParametrs['MENU_SHOW_ELEMENTS'] == 'Y'){
		$arItems = CCache::CIBlockElement_GetList(array('SORT' => 'ASC', 'ID' => 'DESC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag(CCache::$arIBlocks[SITE_ID]['aspro_priority_content']['aspro_priority_staff'][0]), 'MULTI' => 'Y')), array('IBLOCK_ID' => CCache::$arIBlocks[SITE_ID]['aspro_priority_content']['aspro_priority_staff'][0], 'ACTIVE' => 'Y', 'SECTION_GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'INCLUDE_SUBSECTIONS' => 'Y'));
		if($arMenuParametrs['MENU_SHOW_SECTIONS'] == 'Y'){
			$arItemsBySectionID = CCache::GroupArrayBy($arItems, array('MULTI' => 'Y', 'GROUP' => array('IBLOCK_SECTION_ID')));
		}
		else{
			$arItemsRoot = CCache::CIBlockElement_GetList(array('SORT' => 'ASC', 'ID' => 'DESC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag(CCache::$arIBlocks[SITE_ID]['aspro_priority_content']['aspro_priority_staff'][0]), 'MULTI' => 'Y')), array('IBLOCK_ID' => CCache::$arIBlocks[SITE_ID]['aspro_priority_content']['aspro_priority_staff'][0], 'ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'SECTION_ID' => 0));
			$arItems = array_merge((array)$arItems, (array)$arItemsRoot);
		}
	}

	if($arSections){
		CPriority::getSectionChilds(false, $arSections, $arSectionsByParentSectionID, $arItemsBySectionID, $aMenuLinksExt);
	}

	if($arItems && $arMenuParametrs['MENU_SHOW_SECTIONS'] !== 'Y'){
		foreach($arItems as $arItem){
			$aMenuLinksExt[] = array($arItem['NAME'], $arItem['DETAIL_PAGE_URL'], array(), array('FROM_IBLOCK' => 1, 'DEPTH_LEVEL' => 1));
		}
	}
}

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>