<?
foreach($arResult['ITEMS'] as $key => $arItem)
{
	CPriority::getFieldImageData($arResult['ITEMS'][$key], array('PREVIEW_PICTURE'));
}
$arResult['SECTIONS']['BIG']['ITEMS'] = $arResult['ITEMS'];
unset($arResult['ITEMS']);
if($arParams['IBLOCK_SMALL_BANNERS_ID'])
{
	$arResult['PROPERTY_TEXTCOLOR'] = array();
	$arElements = CCache::CIBLockElement_GetList(array('SORT' => 'ASC', 'ID' => 'DESC', 'CACHE' => array('MULTI' =>'Y', 'TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_SMALL_BANNERS_ID']))), array('IBLOCK_ID' => $arParams['IBLOCK_SMALL_BANNERS_ID'], 'ACTIVE'=>'Y'), false, array('nPageSize' => 2), array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE', 'PROPERTY_LINK', 'PROPERTY_SECTION', 'PROPERTY_TEXTCOLOR'));
	if($arElements)
	{
		$dbRes = CIBlockPropertyEnum::GetList(array(), array('IBLOCK_ID' => $arParams['IBLOCK_SMALL_BANNERS_ID'], 'CODE' => 'TEXTCOLOR'));
		while($arRes = $dbRes->Fetch()){
			$arResult['PROPERTY_TEXTCOLOR'][$arRes['ID']] = $arRes['XML_ID'];
		}
		foreach($arElements as $key => $arItem)
		{
			$arElements[$key]['PREVIEW_PICTURE'] = CFile::GetPath($arItem['PREVIEW_PICTURE']);
		}
	}
	$arResult['SECTIONS']['SMALL']['ITEMS'] = $arElements;
}
?>