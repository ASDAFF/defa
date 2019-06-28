<?
foreach($arResult['ITEMS'] as $key => $arItem){
	CNextStock::getFieldImageData($arResult['ITEMS'][$key], array('PREVIEW_PICTURE'));
}
?>