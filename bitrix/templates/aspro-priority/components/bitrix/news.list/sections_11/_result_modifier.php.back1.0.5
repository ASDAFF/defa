<?
// get all subsections of PARENT_SECTION or root sections
global $arTheme, $arRegion;

$arSectionsFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y');
$start_level = ($arResult['SECTION']['PATH'][0]['DEPTH_LEVEL'] ? $arResult['SECTION']['PATH'][0]['DEPTH_LEVEL'] : 1);
$end_level = $arParams['DEPTH_LEVEL'];

if($arParams['PARENT_SECTION'])
{
	$arParentSection = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'N')), array('ID' => $arParams['PARENT_SECTION']), false, array('ID', 'IBLOCK_ID', 'LEFT_MARGIN', 'RIGHT_MARGIN'), array('nPageSize' => $arParams['NEWS_COUNT']));

	$arSectionsFilter = array_merge($arSectionsFilter, array(/*'SECTION_ID' => $arParams['PARENT_SECTION'],*/'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'], '>DEPTH_LEVEL' => '1'));

	$arSectionsFilter['INCLUDE_SUBSECTIONS'] = 'Y';
	$arSectionsFilter['<=DEPTH_LEVEL'] = $end_level;

}
else
{
	$arSectionsFilter['<=DEPTH_LEVEL'] = $end_level;
}

$arResult['SECTIONS'] = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), $arSectionsFilter, false, array('ID', 'NAME', 'IBLOCK_ID', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL', 'PICTURE', 'DETAIL_PICTURE', 'UF_TOP_SEO', 'DESCRIPTION', 'UF_ICON'));

if($arResult['SECTIONS'])
{
	$arSections = array();
	foreach($arResult['SECTIONS'] as $key => $arSection)
	{
		$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arSection['IBLOCK_ID'], $arSection['ID']);
		$arResult['SECTIONS'][$key]['IPROPERTY_VALUES'] = $ipropValues->getValues();
		CPriority::getFieldImageData($arResult['SECTIONS'][$key], array('PICTURE'), 'SECTION');
	}
	
	if($arParams['SHOW_CHILD_SECTIONS'] == 'Y')
	{	
		foreach($arResult['SECTIONS'] as $arItem)
		{
			if(!$arSections[$arItem['ID']] && $arItem['DEPTH_LEVEL'] == $start_level){
				$arSections[$arItem['ID']] = $arItem;
			}
		}
		foreach($arResult['SECTIONS'] as $arItem)
		{
			if($arSections[$arItem['IBLOCK_SECTION_ID']] && $arItem['DEPTH_LEVEL'] == $end_level ){
				$arSections[$arItem['IBLOCK_SECTION_ID']]['CHILD'][$arItem['ID']] = $arItem;
			}
		}
	}
	
	if($arRegion && $arTheme['USE_REGIONALITY']['VALUE'] === 'Y' && $arTheme['SHOW_SECTIONS_REGION']['VALUE'] == 'Y' && $arTheme['USE_REGIONALITY']['DEPENDENT_PARAMS']['REGIONALITY_FILTER_ITEM']['VALUE'] === 'Y'){
		foreach($arResult['SECTIONS'] as $arSection){
			$arItems = CCache::CIBlockElement_GetList(array('SORT' => 'ASC', 'ID' => 'DESC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('IBLOCK_SECTION_ID'))), array_merge($arSectionsFilter, array('SECTION_ID' => $arSection['ID'], 'PROPERTY_LINK_REGION' => $arRegion['ID'], 'INCLUDE_SUBSECTIONS' => 'Y')), array(), false, array('ID', 'IBLOCK_SECTION_ID'));
			if(!$arItems){
				unset($arSections[$arSection['ID']]);
			}

		}
	}
		
	$arResult['SECTIONS'] = $arSections;
}

?>