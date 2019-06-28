<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult['ITEMS']){
	$arResult['IBLOCK']	= CCache::CIBlock_GetList(array($arParams['SORT_BY1'] => $arParams['SORT_ORDER1'], $arParams['SORT_BY2'] => $arParams['SORT_ORDER2'], "CACHE" => array("MULTI" => "N", "TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('TYPE' => $arParams['IBLOCK_TYPE'], 'ID' => $arParams['IBLOCK_ID']));
	
	$arPlacemarks = array();
	foreach($arResult['ITEMS'] as $arItem){
		if(isset($arItem['DISPLAY_PROPERTIES']['MAP']) && $arItem['DISPLAY_PROPERTIES']['MAP']['VALUE']){
			$arCoords = explode(',', $arItem['DISPLAY_PROPERTIES']['MAP']['VALUE']);
			
			$html = '';
			
			$html .= '<div class="title">'.$arItem['NAME'].'</div>';
			
			if(isset($arItem['DISPLAY_PROPERTIES']['SCHEDULE']) && strlen($arItem['DISPLAY_PROPERTIES']['SCHEDULE']['VALUE']['TEXT']) || isset($arItem['DISPLAY_PROPERTIES']['PHONE']) && $arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'] || isset($arItem['DISPLAY_PROPERTIES']['METRO']) && strlen($arItem['DISPLAY_PROPERTIES']['METRO']['VALUE']) || isset($arItem['DISPLAY_PROPERTIES']['EMAIL']) && strlen($arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'])){
				$html .= '<div class="properties">';
					
					$html .= (strlen($arItem['DISPLAY_PROPERTIES']['METRO']['VALUE']) ? '<div class="property metro"><div class="title-prop font_upper">'.$arItem['DISPLAY_PROPERTIES']['METRO']['NAME'].'</div><div class="value font_sm">'.$arItem['DISPLAY_PROPERTIES']['METRO']['VALUE'].'</div></div>' : '');
					$html .= (strlen($arItem['DISPLAY_PROPERTIES']['SCHEDULE']['VALUE']['TEXT']) ? '<div class="property schedule"><div class="title-prop font_upper">'.$arItem['DISPLAY_PROPERTIES']['SCHEDULE']['NAME'].'</div><div class="value font_sm">'.$arItem['DISPLAY_PROPERTIES']['SCHEDULE']['VALUE']['TEXT'].'</div></div>' : '');
					
					if($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']){
						$phone = '';
						if(is_array($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE'])){
							foreach($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE'] as $value){
								$phone .= '<div class="value"><a rel= "nofollow" href="tel:'.str_replace(array(' ', ',', '-', '(', ')'), '', $value).'">'.$value.'</a></div>';
							}
						}
						else{
							$phone = '<div class="value font_sm"><a rel= "nofollow" href="tel:'.str_replace(array(' ', ',', '-', '(', ')'), '', $arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']).'">'.$arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE'].'</a></div>';
						
							
						}
						$html .= '<div class="property phone"><div class="title-prop font_upper">'.$arItem['DISPLAY_PROPERTIES']['PHONE']['NAME'].'</div>'.$phone.'</div>';
					}
				
					$html .= (strlen($arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE']) ? '<div class="property email"><div class="title-prop font_upper">'.$arItem['DISPLAY_PROPERTIES']['EMAIL']['NAME'].'</div><div class="value font_sm"><a href="'.$arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'].'">'.$arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'].'</a></div></div>' : '');
				$html .= '</div>';
			}
			

			$arResult['PLACEMARKS'][] = array(
				"ID" => $arItem["ID"],
				"LAT" => $arCoords[0],
				"LON" => $arCoords[1],
				"TEXT" => $html,
			);
		}
	}
}
?>