<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?if($arResult['ITEMS']):?>
	<?
	$arItem = $arResult['ITEMS'][0];
	?>
	<div class="contacts front contacts_scroll type_1" itemscope itemtype="http://schema.org/Organization">
		<div class="row">
			<div class="col-md-6 item">
				<div class="left_block">
					<div class="top_block">
						<?if($arParams['PAGER_SHOW_ALL']):?>
							<div class="title"><a href="<?=str_replace('#SITE'.'_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL'])?>"><span><?=$arResult['IBLOCK']['NAME'];?></span></a></div>
						<?endif;?>
						<?if(isset($arItem['FIELDS']['NAME']) && strlen($arItem['FIELDS']['NAME'])):?>
							<div class="address">
								<span itemprop="address"><?=$arItem['~NAME'];?></span>
							</div>
						<?endif;?>
					</div>
					<div class="bottom_block">
						<div class="properties">
							<?if(isset($arItem['DISPLAY_PROPERTIES']['METRO']) && strlen($arItem['DISPLAY_PROPERTIES']['METRO']['VALUE'])):?>
								<div class="property metro">
									<div class="title font_upper"><?=$arItem['DISPLAY_PROPERTIES']['METRO']['NAME'];?></div>
									<div class="value"><?=$arItem['DISPLAY_PROPERTIES']['METRO']['VALUE'];?></div>
								</div>
							<?endif;?>
							<?if(isset($arItem['DISPLAY_PROPERTIES']['SCHEDULE']) && strlen($arItem['DISPLAY_PROPERTIES']['SCHEDULE']['VALUE']['TEXT'])):?>
								<div class="property schedule">
									<div class="title font_upper"><?=$arItem['DISPLAY_PROPERTIES']['SCHEDULE']['NAME'];?></div>
									<div class="value" itemprop="openingHours"><?=$arItem['DISPLAY_PROPERTIES']['SCHEDULE']['~VALUE']['TEXT'];?></div>
								</div>
							<?endif;?>
							<?if(isset($arItem['DISPLAY_PROPERTIES']['EMAIL']) && strlen($arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'])):?>
								<div class="property email">
									<div class="title font_upper"><?=$arItem['DISPLAY_PROPERTIES']['EMAIL']['NAME'];?></div>
									<div class="value" itemprop="email"><a class="dark-color" href="mailto:<?=$arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'];?>"><?=$arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'];?></a></div>
								</div>
							<?endif;?>
							<?if(isset($arItem['DISPLAY_PROPERTIES']['PHONE']) && $arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']):?>
								<div class="property phone">
									<div class="title font_upper"><?=$arItem['DISPLAY_PROPERTIES']['PHONE']['NAME'];?></div>
									<?if(is_array($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE'])):?>
										<?foreach($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE'] as $phone):?>
											<div class="value" >
												<a href="tel:+<?=str_replace(array(' ', ',', '-', '(', ')'), '', $phone);?>" class="black" itemprop="telephone"><?=$phone;?></a>
											</div>
										<?endforeach;?>
									<?endif;?>
								</div>
							<?endif;?>
						</div>
						<div class="button"><span class="btn btn-default btn-transparent btn-sm animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question");?>" data-name="question"><?=GetMessage('SEND_MESSAGE_BUTTON');?></span></div>
					</div>
				</div>
			</div>
			<div class="col-md-6 item">
				<div class="right_block">
					<?$APPLICATION->IncludeComponent(
						"bitrix:map.yandex.view",
						"map",
						array(
							"INIT_MAP_TYPE" => "MAP",
							"MAP_DATA" => serialize(array("yandex_lat" => $arResult['PLACEMARKS'][0]['LAT'], "yandex_lon" => $arResult['PLACEMARKS'][0]['LON'], "yandex_scale" => 15, "PLACEMARKS" => $arResult['PLACEMARKS'])),
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
			</div>
		</div>
	</div>
<?endif;?>