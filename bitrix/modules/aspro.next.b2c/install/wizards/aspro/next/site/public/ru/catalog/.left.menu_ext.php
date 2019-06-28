<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$aMenuLinksExt = array();

if($arMenuParametrs = CNextB2c::GetDirMenuParametrs(__DIR__))
{
	if($arMenuParametrs['MENU_SHOW_SECTIONS'] == 'Y')
	{
		$catalog_id = \Bitrix\Main\Config\Option::get('aspro.next.b2c', 'CATALOG_IBLOCK_ID', CNextCacheB2c::$arIBlocks[SITE_ID]['aspro_next_catalog']['aspro_next_catalog'][0]);
		$arSections = CNextCacheB2c::CIBlockSection_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => CNextCacheB2c::GetIBlockCacheTag($catalog_id), 'MULTI' => 'Y')), array('IBLOCK_ID' => $catalog_id, 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', '<DEPTH_LEVEL' => \Bitrix\Main\Config\Option::get("aspro.next.b2c", "MAX_DEPTH_MENU", 2)));
		$arSectionsByParentSectionID = CNextCacheB2c::GroupArrayBy($arSections, array('MULTI' => 'Y', 'GROUP' => array('IBLOCK_SECTION_ID')));
	}
	if($arSections)
		CNextB2c::getSectionChilds(false, $arSections, $arSectionsByParentSectionID, $arItemsBySectionID, $aMenuLinksExt);
}

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>