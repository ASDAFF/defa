<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?if($arResult['ITEMS']):?>
	<div class="front_tizers teasers_scroll type_2">
		<div class="maxwidth-theme">
			<div class="props row flexbox props_type_2">
				<?foreach($arResult['ITEMS'] as $arItem):?>
					<?
					$bImage = (isset($arItem['DISPLAY_PROPERTIES']['ICON']) && $arItem['DISPLAY_PROPERTIES']['ICON']['VALUE'] ? true : false);
					?>
					<div class="item-wrap col-md-3 col-sm-6 col-xs-6">
						<div class="item clearfix<?=($bImage ? '' : ' wti')?><?=(isset($arItem['DISPLAY_PROPERTIES']['BACKGROUND']) && $arItem['DISPLAY_PROPERTIES']['BACKGROUND']['VALUE'] == 'Y' ? ' image_bg' : '');?>">
							<?if($bImage):?>
								<?$img = CFile::ResizeImageGet($arItem['DISPLAY_PROPERTIES']['ICON']['VALUE'], array('width' => 60, 'height' => 60), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);?>
								<div class="image"><img src="<?=$img['src'];?>" alt="<?=$arProp['UF_NAME']?>" title="<?=$arProp['UF_NAME']?>" /></div>
							<?endif;?>
							<div class="body-info">
								<?if(isset($arItem['FIELDS']['NAME'])):?>
									<div class="title"><?=$arItem['FIELDS']['NAME'];?></div>
								<?endif;?>
								<?if(isset($arItem['FIELDS']['PREVIEW_TEXT']) && strlen($arItem['FIELDS']['PREVIEW_TEXT'])):?>
									<div class="value font_xs"><?=$arItem['FIELDS']['PREVIEW_TEXT']?></span></div>
								<?endif;?>
							</div>
						</div>
					</div>
				<?endforeach;?>
			</div>
		</div>
	</div>
<?endif;?>