<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die;

if($arResult['DISPLAY_PROPERTIES']){
	$arResult['CHARACTERISTICS'] = array();
	$arResult['VIDEO'] = array();
	$arResult['VIDEO_IFRAME'] = array();
	foreach($arResult['DISPLAY_PROPERTIES'] as $PCODE => $arProp){
		if(!in_array($arProp['CODE'], array('PERIOD', 'PHOTOS', 'PRICE', 'PRICEOLD', 'ARTICLE', 'STATUS', 'DOCUMENTS', 'LINK_GOODS', 'LINK_STAFF', 'LINK_REVIEWS', 'LINK_PROJECTS', 'LINK_SERVICES', 'FORM_ORDER', 'FORM_QUESTION', 'PHOTOPOS')) && ($arProp['PROPERTY_TYPE'] != 'E' && $arProp['PROPERTY_TYPE'] != 'G')){
			if($arProp["VALUE"] || strlen($arProp["VALUE"])){
				if ($arProp['USER_TYPE'] == 'video') {
					if (count($arProp['PROPERTY_VALUE_ID']) >= 1) {
						foreach($arProp['VALUE'] as $val){
							if($val['path']){
								$arResult['VIDEO'][] = $val;
							}
						}
					}
					elseif($arProp['VALUE']['path']){
						$arResult['VIDEO'][] = $arProp['VALUE'];
					}
				}
				elseif($arProp['CODE'] == 'VIDEO_IFRAME'){
					$arResult['VIDEO_IFRAME'] = $arProp["~VALUE"];
				}
				else{
					$arResult['CHARACTERISTICS'][$PCODE] = $arProp;
				}
			}
		}
	}
}
?>