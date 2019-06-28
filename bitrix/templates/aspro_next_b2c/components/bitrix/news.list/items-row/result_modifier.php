<?
if($arResult['ITEMS'])
{
	foreach($arResult['ITEMS'] as $key => $arItem)
	{
		$arResult['ITEMS'][$key]['DETAIL_PAGE_URL'] = CNextB2c::FormatNewsUrl($arItem);
	}
}
?>