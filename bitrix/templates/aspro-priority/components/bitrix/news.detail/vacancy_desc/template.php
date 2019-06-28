<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?if($arResult):?>
	<?
	$bShowForm = (isset($arResult["DISPLAY_PROPERTIES"]['FORM']) && $arResult["DISPLAY_PROPERTIES"]['FORM']['VALUE_XML_ID'] == 'Y' ? true : false);
	?>
	<div class="vacancy_desc">
		<?if(isset($arResult['DISPLAY_PROPERTIES']['VACANCY_PICTURE']) && strlen($arResult['DISPLAY_PROPERTIES']['VACANCY_PICTURE']['VALUE'])):?>
			<?
			$imagePath = CFile::GetPath($arResult['DISPLAY_PROPERTIES']['VACANCY_PICTURE']['VALUE']);
			?>
			<div class="image">
				<img class="img-responsive" src="<?=$imagePath;?>" alt="<?=($arResult['FIELDS']['DETAIL_PICTURE']['ALT'] ? $arResult['FIELDS']['DETAIL_PICTURE']['ALT'] : $arResult['NAME']);?>" />
			</div>
		<?endif;?>
		
		<?if($arResult["DISPLAY_PROPERTIES"]):?>
			<div class="properties border">
				<?if($bShowForm):?>
					<div class="button pull-left">
						<span class="btn btn-default animate-load" data-event="jqm" data-name="resume" data-param-id="<?=CPriority::getFormID("aspro_priority_resume");?>"><?=($arParams["FORM_BUTTON_TITLE"] ? $arParams["FORM_BUTTON_TITLE"] : GetMessage('FORM_BUTTON_TITLE'));?></span>
					</div>
				<?endif;?>
				<div class="wrap<?=(!$bShowForm ? ' wtform' : '')?>">
					<div class="row">
						<?if(isset($arResult["DISPLAY_PROPERTIES"]['CONTACT']) && $arResult["DISPLAY_PROPERTIES"]['CONTACT']['DISPLAY_VALUE']):?>
							<div class="property item contact col-md-5 col-sm-4 col-xs-6">
								<div class="title-prop font_upper"><?=$arResult["DISPLAY_PROPERTIES"]['CONTACT']['NAME'];?></div>
								<div class="value">
									<?if(is_array($arResult["DISPLAY_PROPERTIES"]['CONTACT']["DISPLAY_VALUE"])):?>
										<?=implode(",  ", $arResult["DISPLAY_PROPERTIES"]['CONTACT']["DISPLAY_VALUE"]);?>
									<?else:?>
										<?=$arResult["DISPLAY_PROPERTIES"]['CONTACT']["DISPLAY_VALUE"];?>
									<?endif;?>
								</div>
							</div>
						<?endif;?>
						<?if(isset($arResult["DISPLAY_PROPERTIES"]['EMAIL']) && $arResult["DISPLAY_PROPERTIES"]['EMAIL']['DISPLAY_VALUE']):?>
							<div class="property item email col-md-4 col-sm-4 col-xs-6">
								<div class="title-prop font_upper"><?=$arResult["DISPLAY_PROPERTIES"]['EMAIL']['NAME'];?></div>
								<div class="value">
									<?if(is_array($arResult["DISPLAY_PROPERTIES"]['EMAIL']["DISPLAY_VALUE"])):?>
										<?$val = implode(",  ", $arResult["DISPLAY_PROPERTIES"]['EMAIL']["DISPLAY_VALUE"]);?>
									<?else:?>
										<?$val = $arResult["DISPLAY_PROPERTIES"]['EMAIL']["DISPLAY_VALUE"];?>
									<?endif;?>
									<?if($arResult["DISPLAY_PROPERTIES"]['EMAIL']['CODE'] == "EMAIL"):?>
										<a class="dark-color" href="mailto:<?=$arResult["DISPLAY_PROPERTIES"]['EMAIL']['DISPLAY_VALUE'];?>"><?=$arResult["DISPLAY_PROPERTIES"]['EMAIL']['DISPLAY_VALUE'];?></a>
									<?else:?>
										<?=$val?>
									<?endif;?>
								</div>
							</div>
						<?endif;?>
						<?if(isset($arResult["DISPLAY_PROPERTIES"]['PHONE']) && $arResult["DISPLAY_PROPERTIES"]['PHONE']['DISPLAY_VALUE']):?>
							<div class="property item phone col-md-3 col-sm-6 col-xs-6">
								<div class="title-prop font_upper"><?=$arResult["DISPLAY_PROPERTIES"]['PHONE']['NAME'];?></div>
								<div class="value">
									<?if(is_array($arResult["DISPLAY_PROPERTIES"]['PHONE']["DISPLAY_VALUE"])):?>
										<?=implode(",  ", $arResult["DISPLAY_PROPERTIES"]['PHONE']["DISPLAY_VALUE"]);?>
									<?else:?>
										<?=$arResult["DISPLAY_PROPERTIES"]['PHONE']["DISPLAY_VALUE"];?>
									<?endif;?>
								</div>
							</div>
						<?endif;?>
					</div>
				</div>
				<?if(isset($arResult['FIELDS']['DETAIL_TEXT']) && strlen($arResult['FIELDS']['DETAIL_TEXT'])):?>
					<div class="detailtext"><?=$arResult['FIELDS']['DETAIL_TEXT'];?></div>
				<?endif;?>
			</div>
		<?endif;?>
	</div>
<?endif;?>