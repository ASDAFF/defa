<?
foreach($arResult['ITEMS'] as $key => $arItem){
	if($SID = $arItem['IBLOCK_SECTION_ID']){
		$arSectionsIDs[] = $SID;
	}
	CNextB2c::getFieldImageData($arResult['ITEMS'][$key], array('PREVIEW_PICTURE'));
}
if($arSectionsIDs){
	$arResult['SECTIONS'] = CNextCacheB2c::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CNextCacheB2c::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), array('ID' => $arSectionsIDs));
}
?>