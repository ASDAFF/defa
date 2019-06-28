<?
if($arResult['ITEMS'])
{
	foreach($arResult['ITEMS'] as $i => $arItem){
		CNextB2c::getFieldImageData($arResult['ITEMS'][$i], array('PREVIEW_PICTURE'));
	}
}
?>