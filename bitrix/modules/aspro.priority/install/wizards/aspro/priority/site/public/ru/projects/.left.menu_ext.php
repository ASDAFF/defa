<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$aMenuLinksExt = array();

if($arMenuParametrs = CPriority::GetDirMenuParametrs(__DIR__)){
	if($arMenuParametrs['MENU_SHOW_SECTIONS'] == 'Y' || $arMenuParametrs['MENU_SHOW_ELEMENTS'] == 'Y'){
		global $APPLICATION, $arRegion, $arTheme;
	}

	if($arMenuParametrs['MENU_SHOW_SECTIONS'] == 'Y'){
		$arSections = CCache::CIBlockSection_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag(CCache::$arIBlocks[SITE_ID]['aspro_priority_content']['aspro_priority_projects'][0]), 'MULTI' => 'Y')), array('IBLOCK_ID' => CCache::$arIBlocks[SITE_ID]['aspro_priority_content']['aspro_priority_projects'][0], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'), false, array('IBLOCK_ID', 'ID', 'IBLOCK_SECTION_ID', 'NAME', 'SECTION_PAGE_URL', 'PICTURE', 'DEPTH_LEVEL', 'UF_ICON', 'UF_BACKGROUND'));
		$arSectionsByParentSectionID = CCache::GroupArrayBy($arSections, array('MULTI' => 'Y', 'GROUP' => array('IBLOCK_SECTION_ID')));
	}

	if($arMenuParametrs['MENU_SHOW_ELEMENTS'] == 'Y' || $arTheme['SHOW_SECTIONS_REGION']['VALUE'] == 'Y'){
		$arItems = CCache::CIBlockElement_GetList(array('SORT' => 'ASC', 'ID' => 'DESC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag(CCache::$arIBlocks[SITE_ID]['aspro_priority_content']['aspro_priority_projects'][0]), 'MULTI' => 'Y')), array('IBLOCK_ID' => CCache::$arIBlocks[SITE_ID]['aspro_priority_content']['aspro_priority_projects'][0], 'ACTIVE' => 'Y', 'SECTION_GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'INCLUDE_SUBSECTIONS' => 'Y'));
		if($arMenuParametrs['MENU_SHOW_SECTIONS'] == 'Y'){
			$arItemsBySectionID = CCache::GroupArrayBy($arItems, array('MULTI' => 'Y', 'GROUP' => array('IBLOCK_SECTION_ID')));
		}
		else{
			$arItemsRoot = CCache::CIBlockElement_GetList(array('SORT' => 'ASC', 'ID' => 'DESC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag(CCache::$arIBlocks[SITE_ID]['aspro_priority_content']['aspro_priority_projects'][0]), 'MULTI' => 'Y')), array('IBLOCK_ID' => CCache::$arIBlocks[SITE_ID]['aspro_priority_content']['aspro_priority_projects'][0], 'ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'SECTION_ID' => 0));
			$arItems = array_merge((array)$arItems, (array)$arItemsRoot);
		}
		
		if($arItems && $arRegion)
		{
			foreach($arItems as $key => $arItem)
			{
				$arTmpProp = array();
				$rsPropRegion = CIBlockElement::GetProperty($arItem['IBLOCK_ID'], $arItem['ID'], array('sort' => 'asc'), Array('CODE'=>'LINK_REGION'));
				while($arPropRegion = $rsPropRegion->Fetch())
				{
					if($arPropRegion['VALUE'])
						$arTmpProp[] = $arPropRegion['VALUE'];
				}
				$arItems[$key]['LINK_REGION'] = $arTmpProp;
			}
		}
	}

	if($arSections){
		CPriority::getSectionChilds(false, $arSections, $arSectionsByParentSectionID, $arItemsBySectionID, $aMenuLinksExt, CCache::$arIBlocks[SITE_ID]['aspro_priority_content']['aspro_priority_projects'][0]);
	}

	if($arItems && $arMenuParametrs['MENU_SHOW_SECTIONS'] != 'Y'){
		foreach($arItems as $arItem){
			$arExtParam = array('FROM_IBLOCK' => 1, 'DEPTH_LEVEL' => 1);
			if(isset($arItem['LINK_REGION'])){
				$arExtParam['LINK_REGION'] = $arItem['LINK_REGION'];
			}
			
			$aMenuLinksExt[] = array($arItem['NAME'], $arItem['DETAIL_PAGE_URL'], array(), $arExtParam);
		}
	}
}

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>