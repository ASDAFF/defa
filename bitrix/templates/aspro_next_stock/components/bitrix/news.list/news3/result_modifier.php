<?
foreach($arResult['ITEMS'] as $key => $arItem){
	if($SID = $arItem['IBLOCK_SECTION_ID']){
		$arSectionsIDs[] = $SID;
	}
	CNextStock::getFieldImageData($arResult['ITEMS'][$key], array('PREVIEW_PICTURE'));
}
if($arSectionsIDs){
	$arResult['SECTIONS'] = CNextCacheStock::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CNextCacheStock::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), array('ID' => $arSectionsIDs));
}
?>