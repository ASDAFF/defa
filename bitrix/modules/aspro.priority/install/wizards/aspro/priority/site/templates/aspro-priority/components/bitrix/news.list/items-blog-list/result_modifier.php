<?
if($arResult['ITEMS'])
{
	foreach($arResult['ITEMS'] as $i => $arItem){
		CPriority::getFieldImageData($arResult['ITEMS'][$i], array('PREVIEW_PICTURE'));
	}
}
?>