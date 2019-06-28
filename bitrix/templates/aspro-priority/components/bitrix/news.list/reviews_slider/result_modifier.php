<?
foreach($arResult['ITEMS'] as $key => $arItem){
	CMedc2::getFieldImageData($arResult['ITEMS'][$key], array('PREVIEW_PICTURE'));
}
?>