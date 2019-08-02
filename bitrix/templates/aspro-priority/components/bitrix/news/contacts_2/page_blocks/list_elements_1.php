<?
$bUseMap = CPriority::GetFrontParametrValue('CONTACTS_USE_MAP', SITE_ID) != 'N';
$bUseFeedback = CPriority::GetFrontParametrValue('CONTACTS_USE_FEEDBACK', SITE_ID) != 'N';
$arItem = $arItem[0];
$bAlternativeName = ($arItem['PROPERTY_ALTERNATIVE_NAME_VALUE'] ? true : false);

$arPlacemarks = array();
if($bUseMap && $arItem['PROPERTY_MAP_VALUE']){
	$arCoords = explode(',', $arItem['PROPERTY_MAP_VALUE']);

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
		"LAT" => $arCoords[0],
		"LON" => $arCoords[1],
		"TEXT" => $html,
	);
}
?>
<?if($arItem):?>
	<div class="contacts contacts-page-map-inline type_3" itemscope itemtype="http://schema.org/Organization">
		<div class="maxwidth-theme">
			<div class="contacts-wrapper">
				<div class="row">
					<div class="col-md-4">
						<h2><?=($bAlternativeName ? htmlspecialchars_decode($arItem['PROPERTY_ALTERNATIVE_NAME_VALUE']) : htmlspecialchars_decode($arItem['NAME']));?></h2>
					</div>
					<div class="col-md-8">
						<div class="top_block row">
							<div class="col-md-8">
								<div class="properties">
									<div class="property adress item">
										<div class="title font_upper"><?=GetMessage('ADDRESS');?></div>
										<div class="value"><?=$arItem['NAME'];?></div>
									</div>
									<?if(in_array('METRO', $arParams['LIST_PROPERTY_CODE']) && $arItem['PROPERTY_METRO_VALUE']):?>
										<div class="property metro item">
											<div class="title font_upper"><?=$arProperties['METRO']['NAME'];?></div>
											<div class="value"><?=$arItem['PROPERTY_METRO_VALUE'];?></div>
										</div>
									<?endif;?>
									<?if(in_array('SCHEDULE', $arParams['LIST_PROPERTY_CODE']) && $arItem['PROPERTY_SCHEDULE_VALUE']):?>
										<div class="property schedule item">
											<div class="title font_upper"><?=$arProperties['SCHEDULE']['NAME'];?></div>
											<div class="value" itemprop="openingHours"><?=$arItem['PROPERTY_SCHEDULE_VALUE']['TEXT'];?></div>
										</div>
									<?endif;?>
									<?if(in_array('EMAIL', $arParams['LIST_PROPERTY_CODE']) && $arItem['PROPERTY_EMAIL_VALUE']):?>
										<div class="property email item">
											<div class="title font_upper"><?=$arProperties['EMAIL']['NAME'];?></div>
											<div class="value" itemprop="email"><a class="dark-color" href="mailto:<?=$arItem['PROPERTY_EMAIL_VALUE'];?>"><?=$arItem['PROPERTY_EMAIL_VALUE'];?></a></div>
										</div>
									<?endif;?>
									<?if(in_array('PHONE', $arParams['LIST_PROPERTY_CODE']) && $arItem['PROPERTY_PHONE_VALUE']):?>
										<div class="property phone item">
											<div class="title font_upper"><?=$arProperties['PHONE']['NAME'];?></div>
											<?if(is_array($arItem['PROPERTY_PHONE_VALUE'])):?>
												<?foreach($arItem['PROPERTY_PHONE_VALUE'] as $phone):?>
													<div class="value" >
														<a href="tel:<?=str_replace(array(' ', ',', '-', '(', ')'), '', $phone);?>" class="black" itemprop="telephone"><?=$phone;?></a>
													</div>
												<?endforeach;?>
											<?else:?>
												<a href="tel:<?=str_replace(array(' ', ',', '-', '(', ')'), '', $arItem['PROPERTY_PHONE_VALUE']);?>" class="black" itemprop="telephone"><?=$arItem['PROPERTY_PHONE_VALUE'];?></a>
											<?endif;?>
										</div>
									<?endif;?>
								</div>
							</div>
							<div class="col-md-4">
								<div class="social-block">
									<?$APPLICATION->IncludeFile("/include/social.php", Array(), Array("MODE" => "html", "TEMPLATE" => "include_area.php", "NAME" => "Social"));?>
								</div>
							</div>
						</div>
						<div class="bottom_block row">
							<?
							$bPreviewText = (in_array('PREVIEW_TEXT', $arParams['LIST_FIELD_CODE']) && $arItem['PREVIEW_TEXT'] ? true : false);
							?>
							<?if($bPreviewText):?>
								<div class="col-md-<?=($bUseFeedback ? 8 : 12);?>">
									<div class="description"><?=$arItem['PREVIEW_TEXT'];?></div>
								</div>
							<?endif;?>
							<?if($bUseFeedback):?>
								<div class="col-md-<?=($bPreviewText ? 4 : 12);?>">
									<div class="button"><span class="btn btn-default btn-transparent animate-load question" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question")?>" data-name="question"><?=($arParams['TITLE_BUTTON'] ? $arParams['TITLE_BUTTON'] : GetMessage('TITLE_BUTTON'));?></span></div>
								</div>
							<?endif;?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?endif;?>
<?if($bUseMap):?>
	<div class="contacts-page-map type_3">
		<?$APPLICATION->IncludeComponent(
			"bitrix:map.yandex.view",
			"map",
			array(
				"INIT_MAP_TYPE" => "MAP",
				"MAP_DATA" => serialize(array("yandex_lat" => $arCoords[0], "yandex_lon" => $arCoords[1], "yandex_scale" => 16, "PLACEMARKS" => $arPlacemarks)),
				"MAP_WIDTH" => "100%",
				"MAP_HEIGHT" => "650",
				"CONTROLS" => array(
					0 => "ZOOM",
					1 => "TYPECONTROL",
					2 => "SCALELINE",
				),
				"OPTIONS" => array(
					0 => "ENABLE_DBLCLICK_ZOOM",
					1 => "ENABLE_DRAGGING",
				),
				"MAP_ID" => "MAP_v33",
				"COMPONENT_TEMPLATE" => "map"
			),
			false
		);?>
	</div>
<?endif;?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"contacts_2",
	Array(
		"COUNT_IN_LINE" => $arParams["COUNT_IN_LINE"],
		"SHOW_SECTION_PREVIEW_DESCRIPTION" => $arParams["SHOW_SECTION_PREVIEW_DESCRIPTION"],
		"VIEW_TYPE" => $arParams["VIEW_TYPE"],
		"SHOW_TABS" => $arParams["SHOW_TABS"],
		"IMAGE_POSITION" => $arParams["IMAGE_POSITION"],
		"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
		"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
		"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
		"SORT_BY1"	=>	$arParams["SORT_BY1"],
		"SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
		"SORT_BY2"	=>	$arParams["SORT_BY2"],
		"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
		"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
		"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
		"SET_TITLE"	=>	$arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN"	=>	$arParams["ADD_SECTIONS_CHAIN"],
		"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
		"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
		"CACHE_FILTER"	=>	"Y",
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
		"DISPLAY_NAME"	=>	$arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME"	=>	$arParams["FILTER_NAME"],
		"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
		"PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
		"PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
		"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_DETAIL_LINK" => $arParams["SHOW_DETAIL_LINK"],
	),
	$component
);?>