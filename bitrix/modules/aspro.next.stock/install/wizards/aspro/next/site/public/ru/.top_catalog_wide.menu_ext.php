<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$aMenuLinksExt = array();

$catalog_id = \Bitrix\Main\Config\Option::get('aspro.next.stock', 'CATALOG_IBLOCK_ID', CNextCacheStock::$arIBlocks[SITE_ID]['aspro_next_catalog']['aspro_next_catalog'][0]);
$arSections = CNextCacheStock::CIBlockSection_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => CNextCacheStock::GetIBlockCacheTag($catalog_id), 'MULTI' => 'Y')), array('IBLOCK_ID' => $catalog_id, 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', '<DEPTH_LEVEL' => \Bitrix\Main\Config\Option::get("aspro.next.stock", "MAX_DEPTH_MENU", 2)));
$arSectionsByParentSectionID = CNextCacheStock::GroupArrayBy($arSections, array('MULTI' => 'Y', 'GROUP' => array('IBLOCK_SECTION_ID')));

if($arSections)
	CNextStock::getSectionChilds(false, $arSections, $arSectionsByParentSectionID, $arItemsBySectionID, $aMenuLinksExt);

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>