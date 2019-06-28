<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<div class="item-views-wrapper contacts_list">
	<?if($arResult['ITEMS']):?>
		<div class="maxwidth-theme">
			<div class="row contacts-stores margin0 flexbox">
				<?foreach($arResult['ITEMS'] as $i => $arItem):?>
					<?
					// edit/add/delete buttons for edit mode
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					// use detail link?
					$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
					// preview picture
					$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
					$imageSrc = ($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['SRC'] : false);
					$imageDetailSrc = ($bImage ? $arItem['FIELDS']['DETAIL_PICTURE']['SRC'] : false);
					?>
					<div class="item border shadow col-md-4 col-sm-6 col-xs-6 padding0" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
						<?if(isset($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']])):?>
							<div class="section_name"><?=$arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME'];?></div>
						<?endif;?>
						<div class="properties">
							<?if(isset($arItem['FIELDS']['NAME']) && $arItem['FIELDS']['NAME']):?>
								<div class="property address">
									<div class="title-prop font_upper"><?=GetMessage('ADDRESS');?></div>
									<div class="value"><?=$arItem['~NAME'];?></div>
								</div>
							<?endif;?>
							<?if(isset($arItem['DISPLAY_PROPERTIES']['MAP']) && $arItem['DISPLAY_PROPERTIES']['MAP']['VALUE']):?>
								<div class="show_on_map font_upper"><span data-event="jqm" data-param-id="map" data-param-type="map" data-name="map" data-id="<?=$arItem['ID'];?>" data-iblock_id="<?=$arParams['IBLOCK_ID'];?>">
									<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/show_on_map.svg');?>
									<?=GetMessage('SHOW_ON_MAP');?>
								</span></div>
							<?endif;?>
							<?if(isset($arItem['DISPLAY_PROPERTIES']['METRO']) && $arItem['DISPLAY_PROPERTIES']['METRO']['VALUE']):?>
								<div class="property metro">
									<div class="title-prop font_upper"><?=$arItem['DISPLAY_PROPERTIES']['METRO']['NAME'];?></div>
									<div class="value"><?=$arItem['DISPLAY_PROPERTIES']['METRO']['~VALUE'];?></div>
								</div>
							<?endif;?>
							<?if(isset($arItem['DISPLAY_PROPERTIES']['SCHEDULE']) && $arItem['DISPLAY_PROPERTIES']['SCHEDULE']['VALUE']):?>
								<div class="property schedule">
									<div class="title-prop font_upper"><?=$arItem['DISPLAY_PROPERTIES']['SCHEDULE']['NAME'];?></div>
									<div class="value"><?=$arItem['DISPLAY_PROPERTIES']['SCHEDULE']['~VALUE']['TEXT'];?></div>
								</div>
							<?endif;?>
							<?if(isset($arItem['DISPLAY_PROPERTIES']['PHONE']) && $arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']):?>
								<div class="property phone">
									<div class="title-prop font_upper"><?=$arItem['DISPLAY_PROPERTIES']['PHONE']['NAME'];?></div>
									<div class="value">
										<?if(is_array($arItem['PROPERTIES']['PHONE']['VALUE'])):?>
											<?$i = 0;?>
											<?foreach($arItem['PROPERTIES']['PHONE']['VALUE'] as $phone):?>
												<a href="tel:<?=str_replace(array(' ', ',', '-', '(', ')'), '', $phone);?>" class="black"><?=$phone;?><?=(count($arItem['PROPERTIES']['PHONE']['VALUE']) > 1 && $i != count($arItem['PROPERTIES']['PHONE']['VALUE']) - 1 ? '<br>' : '')?></a>
												<?++$i;?>
											<?endforeach;?>
										<?endif;?>
									</div>
								</div>
							<?endif;?>
							<?if(isset($arItem['DISPLAY_PROPERTIES']['EMAIL']) && $arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE']):?>
								<div class="property email">
									<div class="title-prop font_upper"><?=$arItem['DISPLAY_PROPERTIES']['EMAIL']['NAME'];?></div>
									<div class="value"><a class="dark-color" href="mailto:<?=$arItem['DISPLAY_PROPERTIES']['EMAIL']['~VALUE'];?>"><?=$arItem['DISPLAY_PROPERTIES']['EMAIL']['~VALUE'];?></a></div>
								</div>
							<?endif;?>
						</div>
					</div>
				<?endforeach;?>
			</div>
		</div>
	<?endif;?>
</div>