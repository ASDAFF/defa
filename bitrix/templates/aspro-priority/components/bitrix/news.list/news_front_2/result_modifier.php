<?
if($arResult['ITEMS'])
{
	$arSectionsIDs = array();
	
	foreach($arResult['ITEMS'] as $key => $arItem)
	{
		$arResult['ITEMS'][$key]['DETAIL_PAGE_URL'] = CPriority::FormatNewsUrl($arItem);
		CPriority::getFieldImageData($arResult['ITEMS'][$key], array('PREVIEW_PICTURE'));
		if($SID = $arItem['IBLOCK_SECTION_ID'])
		{
			$arSectionsIDs[] = $SID;
		}
	}
	
	if($arSectionsIDs){
		$arResult['SECTIONS'] = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => 'ID', 'MULTI' => 'N')), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => $arSectionsIDs, 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'), false, array('ID', 'NAME'));
	}
	$arResult['COUNT_ELEMENTS'] = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', '!PROPERTY_SHOW_ON_INDEX_PAGE' => false), array());
}
?>