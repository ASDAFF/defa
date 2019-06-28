<?define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");?>
<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<?
$arData =json_decode($_REQUEST['data-trigger']);
$arItemSelect = array('ID', 'NAME', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'PROPERTY_MAP', 'PROPERTY_PHONE', 'PROPERTY_SCHEDULE', 'PROPERTY_METRO', 'PROPERTY_EMAIL');
$arFilterRegion = array();
if(!$arRegion)
	$arRegion = CPriorityRegionality::getCurrentRegion();
if($arRegion && CPriority::GetFrontParametrValue('REGIONALITY_FILTER_ITEM') == 'Y')
	$arFilterRegion['PROPERTY_LINK_REGION'] = $arRegion['ID'];

$arPlacemarks = array();

if(isset($arData->{'data-id'}) && $arData->{'data-id'}){
	$arItem = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arData->{'data-iblock_id'}), 'MULTI' => 'N')), array_merge(array('IBLOCK_ID' => $arData->{'data-iblock_id'}, 'ID' => $arData->{'data-id'}), $arFilterRegion), false, false, $arItemSelect);
	$dbRes = CIBlock::GetProperties($arData->{'data-iblock_id'});

	while($arRes = $dbRes->Fetch()){
		$arProperties[$arRes['CODE']] = $arRes;
	}

	if($arItem['PROPERTY_MAP_VALUE']){
		$arCoordinates = explode(',', $arItem['PROPERTY_MAP_VALUE']);
		$mapLAT += $arCoordinates[0];
		$mapLON += $arCoordinates[1];
		$html = '';
		
		$html .= '<div class="title">'.$arItem['NAME'].'</div>';
		
		if(strlen($arItem['PROPERTY_SCHEDULE_VALUE']['TEXT']) || $arItem['PROPERTY_PHONE_VALUE'] || $arItem['PROPERTY_METRO_VALUE'] || $arItem['PROPERTY_EMAIL_VALUE']){
			$html .= '<div class="properties">';
				
				$html .= (strlen($arItem['PROPERTY_METRO_VALUE']) ? '<div class="property schedule"><div class="title-prop font_upper">'.$arProperties['METRO']['NAME'].'</div><div class="value font_sm">'.$arItem['PROPERTY_METRO_VALUE'].'</div></div>' : '');
				$html .= (strlen($arItem['PROPERTY_SCHEDULE_VALUE']['TEXT']) ? '<div class="property schedule"><div class="title-prop font_upper">'.$arProperties['SCHEDULE']['NAME'].'</div><div class="value font_sm">'.$arItem['PROPERTY_SCHEDULE_VALUE']['TEXT'].'</div></div>' : '');
				
				if($arItem['PROPERTY_PHONE_VALUE']){
					$phone = '';
					if(is_array($arItem['PROPERTY_PHONE_VALUE'])){
						foreach($arItem['PROPERTY_PHONE_VALUE'] as $value){
							$phone .= '<div class="value"><a rel= "nofollow" href="tel:'.str_replace(array(' ', ',', '-', '(', ')'), '', $value).'">'.$value.'</a></div>';
						}
					}
					else{
						$phone = '<div class="value font_sm"><a rel= "nofollow" href="tel:'.str_replace(array(' ', ',', '-', '(', ')'), '', $arItem['PROPERTY_PHONE_VALUE']).'">'.$arItem['PROPERTY_PHONE_VALUE'].'</a></div>';
					
						
					}
					$html .= '<div class="property phone"><div class="title-prop font_upper">'.$arProperties['PHONE']['NAME'].'</div>'.$phone.'</div>';
				}
			
				$html .= (strlen($arItem['PROPERTY_EMAIL_VALUE']) ? '<div class="property email"><div class="title-prop font_upper">'.$arProperties['EMAIL']['NAME'].'</div><div class="value font_sm"><a href="'.$arItem['PROPERTY_EMAIL_VALUE'].'">'.$arItem['PROPERTY_EMAIL_VALUE'].'</a></div></div>' : '');
			$html .= '</div>';
		}
		

		$arPlacemarks[] = array(
			"ID" => $arItem["ID"],
			"LAT" => $arCoordinates[0],
			"LON" => $arCoordinates[1],
			"TEXT" => $html,
			//"HTML" => '<div class="title">'.(strlen($arShop["URL"]) ? '<a href="'.$arShop["URL"].'">' : '').$arShop["ADDRESS"].(strlen($arShop["URL"]) ? '</a>' : '').'</div><div class="info-content">'.($arShop['METRO'] ? $arShop['METRO_PLACEMARK_HTML'] : '').(strlen($arShop['SCHEDULE']) ? '<div class="schedule">'.$arShop['SCHEDULE'].'</div>' : '').$str_phones.(strlen($arShop['EMAIL']) ? '<div class="email"><a rel="nofollow" href="mailto:'.$arShop['EMAIL'].'">'.$arShop['EMAIL'].'</a></div>' : '').'</div>'.(strlen($arShop['URL']) ? '<a rel="nofollow" class="button" href="'.$arShop["URL"].'"><span>'.GetMessage('DETAIL').'</span></a>' : '')
		);
		++$iCountShops;
	}
}
else{
	$arItems = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arData->{'data-iblock_id'}), 'MULTI' => 'Y')), array_merge(array('IBLOCK_ID' => $arData->{'data-iblock_id'}, 'ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'GLOBAL_ACTIVE' => 'Y'), $arFilterRegion), false, false, $arItemSelect);

	if($arItems){
		$dbRes = CIBlock::GetProperties($arData->{'data-iblock_id'});
		while($arRes = $dbRes->Fetch()){
			$arProperties[$arRes['CODE']] = $arRes;
		}

		foreach($arItems as $arItem){
			if($arItem['PROPERTY_MAP_VALUE']){
				$arCoordinates = explode(',', $arItem['PROPERTY_MAP_VALUE']);
				$mapLAT += $arCoordinates[0];
				$mapLON += $arCoordinates[1];
				$html = '';
				
				$html .= '<div class="title">'.$arItem['NAME'].'</div>';
				
				if(strlen($arItem['PROPERTY_SCHEDULE_VALUE']['TEXT']) || $arItem['PROPERTY_PHONE_VALUE'] || $arItem['PROPERTY_METRO_VALUE'] || $arItem['PROPERTY_EMAIL_VALUE']){
					$html .= '<div class="properties">';
						
						$html .= (strlen($arItem['PROPERTY_METRO_VALUE']) ? '<div class="property schedule"><div class="title-prop font_upper">'.$arProperties['METRO']['NAME'].'</div><div class="value font_sm">'.$arItem['PROPERTY_METRO_VALUE'].'</div></div>' : '');
						$html .= (strlen($arItem['PROPERTY_SCHEDULE_VALUE']['TEXT']) ? '<div class="property schedule"><div class="title-prop font_upper">'.$arProperties['SCHEDULE']['NAME'].'</div><div class="value font_sm">'.$arItem['PROPERTY_SCHEDULE_VALUE']['TEXT'].'</div></div>' : '');
						
						if($arItem['PROPERTY_PHONE_VALUE']){
							$phone = '';
							if(is_array($arItem['PROPERTY_PHONE_VALUE'])){
								foreach($arItem['PROPERTY_PHONE_VALUE'] as $value){
									$phone .= '<div class="value"><a rel= "nofollow" href="tel:'.str_replace(array(' ', ',', '-', '(', ')'), '', $value).'">'.$value.'</a></div>';
								}
							}
							else{
								$phone = '<div class="value font_sm"><a rel= "nofollow" href="tel:'.str_replace(array(' ', ',', '-', '(', ')'), '', $arItem['PROPERTY_PHONE_VALUE']).'">'.$arItem['PROPERTY_PHONE_VALUE'].'</a></div>';
							
								
							}
							$html .= '<div class="property phone"><div class="title-prop font_upper">'.$arProperties['PHONE']['NAME'].'</div>'.$phone.'</div>';
						}
					
						$html .= (strlen($arItem['PROPERTY_EMAIL_VALUE']) ? '<div class="property email"><div class="title-prop font_upper">'.$arProperties['EMAIL']['NAME'].'</div><div class="value font_sm"><a href="'.$arItem['PROPERTY_EMAIL_VALUE'].'">'.$arItem['PROPERTY_EMAIL_VALUE'].'</a></div></div>' : '');
					$html .= '</div>';
				}
				

				$arPlacemarks[] = array(
					"ID" => $arItem["ID"],
					"LAT" => $arCoordinates[0],
					"LON" => $arCoordinates[1],
					"TEXT" => $html,
					//"HTML" => '<div class="title">'.(strlen($arShop["URL"]) ? '<a href="'.$arShop["URL"].'">' : '').$arShop["ADDRESS"].(strlen($arShop["URL"]) ? '</a>' : '').'</div><div class="info-content">'.($arShop['METRO'] ? $arShop['METRO_PLACEMARK_HTML'] : '').(strlen($arShop['SCHEDULE']) ? '<div class="schedule">'.$arShop['SCHEDULE'].'</div>' : '').$str_phones.(strlen($arShop['EMAIL']) ? '<div class="email"><a rel="nofollow" href="mailto:'.$arShop['EMAIL'].'">'.$arShop['EMAIL'].'</a></div>' : '').'</div>'.(strlen($arShop['URL']) ? '<a rel="nofollow" class="button" href="'.$arShop["URL"].'"><span>'.GetMessage('DETAIL').'</span></a>' : '')
				);
				++$iCountShops;
			}
		}
		
		$mapLAT = floatval($mapLAT / $iCountShops);
		$mapLON = floatval($mapLON / $iCountShops);
	}
}
?>
<span class="jqmClose top-close fa fa-close"><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/close.svg');?></span>
<?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	"map",
	array(
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => serialize(array("yandex_lat" => $mapLAT, "yandex_lon" => $mapLON, "yandex_scale" => 10, "PLACEMARKS" => $arPlacemarks)),
		"MAP_WIDTH" => "100%",
		"MAP_HEIGHT" => "498",
		"CONTROLS" => array(
			0 => "ZOOM",
			1 => "TYPECONTROL",
			2 => "SCALELINE",
		),
		"OPTIONS" => array(
			0 => "ENABLE_DBLCLICK_ZOOM",
			1 => "ENABLE_DRAGGING",
		),
		"MAP_ID" => "show_contact",
		"COMPONENT_TEMPLATE" => ".default",
		"WAIT_LOAD_FORM" => "Y"
	),
	false
);
?>
<?//if(isset($arData->{'data-map_button'}) && $arData->{'data-map_button'} == 'Y'):?>
<script>
$(document).ready(function(){
	$('.map_frame').prepend('<div class="overlay_form"><div class="loader"><div class="duo duo1"><div class="dot dot-a"></div><div class="dot dot-b"></div></div><div class="duo duo2"><div class="dot dot-a"></div><div class="dot dot-b"></div></div></div></div>')
	$('.map_frame .bx-yandex-map').css('opacity', 0);
	setTimeout(function(){
		<?if(count($arItems) > 1):?>
			map.setBounds(clusterer.getBounds(), {
				checkZoomRange: true
			});
		<?endif;?>
		
		$('.map_frame .overlay_form').remove();
		$('.map_frame .bx-yandex-map').css('opacity', 1);
	}, 1800);
});
</script>
<?//endif;?>