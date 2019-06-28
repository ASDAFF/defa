<?
foreach($arResult['ITEMS'] as $key => $arItem){
	CNextB2c::getFieldImageData($arResult['ITEMS'][$key], array('PREVIEW_PICTURE'));
}
?>