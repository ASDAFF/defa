<?
if($arResult['ITEMS'])
{
	foreach($arResult['ITEMS'] as $i => $arItem){
		CNextStock::getFieldImageData($arResult['ITEMS'][$i], array('PREVIEW_PICTURE'));
	}
}
?>