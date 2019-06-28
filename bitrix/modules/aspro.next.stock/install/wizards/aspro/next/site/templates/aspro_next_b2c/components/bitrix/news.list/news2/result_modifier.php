<?
foreach($arResult['ITEMS'] as $key => $arItem){
	if($SID = $arItem['IBLOCK_SECTION_ID']){
		$arSectionsIDs[] = $SID;
	}
	$arResult['ITEMS'][$key]['DETAIL_PAGE_URL'] = CNextStock::FormatNewsUrl($arItem);
	
	if(strlen($arItem['DISPLAY_PROPERTIES']['REDIRECT']['VALUE']))
		unset($arResult['ITEMS'][$key]['DISPLAY_PROPERTIES']['REDIRECT']);

	$arResult['ITEMS'][$key]['PROPS_FORMAT'] = CNextStock::PrepareItemProps($arItem['DISPLAY_PROPERTIES']);
	
	CNextStock::getFieldImageData($arResult['ITEMS'][$key], array('PREVIEW_PICTURE'));
}

if($arSectionsIDs){
	$arResult['SECTIONS'] = CNextCacheStock::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CNextCacheStock::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), array('ID' => $arSectionsIDs));
}
?>