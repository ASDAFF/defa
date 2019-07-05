<?
// get all subsections of PARENT_SECTION or root sections
$arSectionsFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y');
$start_level = $arParams['DEPTH_LEVEL'];
$end_level = $arParams['DEPTH_LEVEL']+1;

if($arParams['PARENT_SECTION'])
{
	$arParentSection = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'N')), array('ID' => $arParams['PARENT_SECTION']), false, array('ID', 'IBLOCK_ID', 'LEFT_MARGIN', 'RIGHT_MARGIN'));

	$arSectionsFilter = array_merge($arSectionsFilter, array(/*'SECTION_ID' => $arParams['PARENT_SECTION'],*/'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'], '>DEPTH_LEVEL' => '1'));
	if($arParams['SHOW_CHILD_SECTIONS'] == 'Y')
	{
		$arSectionsFilter['INCLUDE_SUBSECTIONS'] = 'Y';
		$arSectionsFilter['<=DEPTH_LEVEL'] = $end_level;
	}
}
else
{
	if($arParams['SHOW_CHILD_SECTIONS'] == 'Y')
		$arSectionsFilter['<=DEPTH_LEVEL'] = $end_level;
	else
		$arSectionsFilter['DEPTH_LEVEL'] = '1';
}
$arResult['SECTIONS'] = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), $arSectionsFilter, false, array('ID', 'NAME', 'IBLOCK_ID', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL', 'PICTURE', 'DETAIL_PICTURE', 'UF_TOP_SEO', 'DESCRIPTION'));

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
		$bHasSubsections = false;
		foreach($arResult['SECTIONS'] as $arItem)
		{
			if( $arItem['DEPTH_LEVEL'] == $start_level )
			{
				if($arSections[$arItem['ID']])
					$arSections[$arItem['ID']] = array_merge($arItem, $arSections[$arItem['ID']]);
				else
					$arSections[$arItem['ID']] = $arItem;
			}
			elseif( $arItem['DEPTH_LEVEL'] == $end_level )
			{
				$bHasSubsections = true;
				$arSections[$arItem['IBLOCK_SECTION_ID']]['CHILD'][$arItem['ID']] = $arItem;
			}
		}

		$bShowElements = (($arParams['SHOW_ELEMENTS_IN_LAST_SECTION'] != 'Y' || ($arParams['SHOW_ELEMENTS_IN_LAST_SECTION'] == 'Y' && !$bHasSubsections)));
		if($bShowElements)
		{
			// fill elements
			foreach($arSections as $key => $arSection)
			{
				$arItems = CCache::CIBlockElement_GetList(array('SORT' => 'ASC', 'ID' => 'DESC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']))), array_merge($arSectionsFilter, array('SECTION_ID' => $arSection['ID'])), false, false, array('ID', 'NAME', 'IBLOCK_ID', 'DETAIL_PAGE_URL'));
				if($arItems)
				{
					if(!$arSections[$key]['CHILD'])
						$arSections[$key]['CHILD'] = $arItems;
					else
						$arSections[$key]['CHILD'] = array_merge($arSections[$key]['CHILD'], $arItems);
				}
			}
		}
		$arResult['SECTIONS'] = $arSections;
	}
}
?>