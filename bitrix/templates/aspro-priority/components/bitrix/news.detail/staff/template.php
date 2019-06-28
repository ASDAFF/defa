<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?use \Bitrix\Main\Localization\Loc;?>

<?
$this->setFrameMode(true);

$catalogLinkedTemplate = (isset($arTheme['ELEMENTS_TABLE_TYPE_VIEW']) && $arTheme['ELEMENTS_TABLE_TYPE_VIEW']['VALUE'] == 'catalog_table_2' ? 'catalog_linked_2' : 'catalog_linked');

$templateData = array(
	'LINK_SALE' => $arResult['DISPLAY_PROPERTIES']['LINK_SALE']['VALUE'],
	'LINK_FAQ' => $arResult['DISPLAY_PROPERTIES']['LINK_FAQ']['VALUE'],
	'LINK_PROJECTS' => $arResult['DISPLAY_PROPERTIES']['LINK_PROJECTS']['VALUE'],
	'LINK_SERVICES' => $arResult['DISPLAY_PROPERTIES']['LINK_SERVICES']['VALUE'],
	'LINK_GOODS' => $arResult['DISPLAY_PROPERTIES']['LINK_GOODS']['VALUE'],
	'LINK_PARTNERS' => $arResult['DISPLAY_PROPERTIES']['LINK_PARTNERS']['VALUE'],
	'LINK_SERTIFICATES' => $arResult['DISPLAY_PROPERTIES']['LINK_SERTIFICATES']['VALUE'],
	'LINK_VACANCYS' => $arResult['DISPLAY_PROPERTIES']['LINK_VACANCYS']['VALUE'],
	'LINK_STAFF' => $arResult['DISPLAY_PROPERTIES']['LINK_STAFF']['VALUE'],
	'LINK_REVIEWS' => $arResult['DISPLAY_PROPERTIES']['LINK_REVIEWS']['VALUE'],
	'CATALOG_LINKED_TEMPLATE' => $catalogLinkedTemplate,
);

if($arParams["DISPLAY_PICTURE"] != "N"){
	$picture = ($arResult["FIELDS"]["DETAIL_PICTURE"] ? "DETAIL_PICTURE" : "PREVIEW_PICTURE");
	CPriority::getFieldImageData($arResult, array($picture));
	$arPhoto = $arResult[$picture];
	if($arPhoto){
		$arImgs[] = array(
			'DETAIL' => $arPhoto,
			'PREVIEW' => CFile::ResizeImageGet($arPhoto["ID"], array('width' => 250, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true),
			'TITLE' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arPhoto['TITLE']) ? $arPhoto['TITLE'] : $arResult['NAME'])),
			'ALT' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arPhoto['ALT']) ? $arPhoto['ALT'] : $arResult['NAME'])),
		);
	}
}

?>
<div class="<?=($templateName = $component->{"__parent"}->{"__template"}->{"__name"})?>">
	<div class="top_wrapper clearfix">
		<?// images?>
		<div class="detailimage">
			<?if($arImgs):?>
				<img src="<?=$arImgs[0]["DETAIL"]["SRC"]?>" title="<?=$arImgs[0]["TITLE"]?>" alt="<?=$arImgs[0]["ALT"]?>" class="img-responsive" />
			<?else:?>
				<img src="<?=SITE_TEMPLATE_PATH.'/images/svg/noimage_staff.svg';?>" title="<?=$arImgs[0]["TITLE"]?>" alt="<?=$arImgs[0]["ALT"]?>" class="img-responsive" />
			<?endif;?>
		</div>
		<?// display properties?>
		<?if($arResult["DISPLAY_PROPERTIES"]):?>
			<div class="properties">
				<?if(isset($arResult["DISPLAY_PROPERTIES"]['POST']) && strlen($arResult["DISPLAY_PROPERTIES"]['POST']['DISPLAY_VALUE'])):?>
					<div class="post">
						<div class="prop-title font_upper"><?=$arResult["DISPLAY_PROPERTIES"]['POST']['NAME'];?></div>
						<div class="value"><?=$arResult["DISPLAY_PROPERTIES"]['POST']['DISPLAY_VALUE'];?></div>
					</div>
				<?endif;?>
				<?
				$bFormButton = (isset($arResult['DISPLAY_PROPERTIES']['SEND_MESSAGE_BUTTON']) && $arResult['DISPLAY_PROPERTIES']['SEND_MESSAGE_BUTTON']['VALUE_XML_ID'] == 'Y' ? true : false);
				?>
				<div class="send_message_button<?=(!$bFormButton ? ' wtbutton' : '')?>">
					<?if($bFormButton):?>
						<div class="button">
							<span class="animate-load btn btn-default btn-xs btn-transparent" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question_staff");?>" data-autoload-staff="<?=$arResult['NAME']?>" data-name="question_staff"><?=(strlen($arParams['SEND_MESSAGE_BUTTON_TEXT']) ? $arParams['SEND_MESSAGE_BUTTON_TEXT'] : Loc::getMessage('SEND_MESSAGE_BUTTON_TEXT'))?></span>
						</div>
					<?endif?>												
				</div>
				<div class="props">
					<?foreach($arResult["DISPLAY_PROPERTIES"] as $PCODE => $arProperty):?>
						<?
						if($PCODE == 'POST' || $PCODE == 'SEND_MESSAGE_BUTTON' || $arProperty['PROPERTY_TYPE'] == 'E' || $arProperty['PROPERTY_TYPE'] == 'G' || !strlen($arProperty['DISPLAY_VALUE']))
							continue;
						?>
						<div class="property <?=strtolower($PCODE);?>">
							<div class="prop-title font_upper"><?=$arProperty['NAME']?></div>
							<div class="value">
								<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
									<?$val = implode(",  ", $arProperty["DISPLAY_VALUE"]);?>
								<?else:?>
									<?$val = $arProperty["DISPLAY_VALUE"];?>
								<?endif;?>
								<?if($PCODE == "SITE"):?>
									<!--noindex-->
									<a href="<?=(strpos($arProperty['VALUE'], 'http') === false ? 'http://' : '').$arProperty['VALUE'];?>" rel="nofollow" target="_blank">
										<?=$arProperty['VALUE'];?>
									</a>
									<!--/noindex-->
								<?elseif($PCODE == "EMAIL"):?>
									<a href="mailto:<?=$val?>"><?=$val?></a>
								<?else:?>
									<?=$val?>
								<?endif;?>
							</div>
						</div>
					<?endforeach;?>
				</div>
				<?if(isset($arResult['SOCIAL_PROPS']) && $arResult['SOCIAL_PROPS']):?>
					<div class="bottom-props social_props">
						<!-- noindex -->
							<?foreach($arResult['SOCIAL_PROPS'] as $arProp):?>
								<a href="<?=$arProp['VALUE'];?>" target="_blank" rel="nofollow" class="value <?=strtolower($arProp['CODE']);?>"><?=$arProp['VALUE'];?>
									<?=(isset($arProp['FILE']) && $arProp['FILE'] ? CPriority::showIconSvg($arProp['FILE']) : '');?>
								</a>
							<?endforeach;?>
						<!-- /noindex -->
					</div>
				<?endif;?>
			</div>
		<?endif;?>		
	</div>
	
	<div class="post-content">
		<?if($arParams["DISPLAY_NAME"] != "N" && strlen($arResult["NAME"])):?>
			<h2><?=$arResult["NAME"]?></h2>
		<?endif;?>
		<div class="content">
			<?// text?>
			<?if(strlen($arResult["FIELDS"]["PREVIEW_TEXT"].$arResult["FIELDS"]["DETAIL_TEXT"])):?>
				<div class="text">
					<?if($arResult["PREVIEW_TEXT_TYPE"] == "text"):?>
						<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];?></p>
					<?else:?>
						<?=$arResult["FIELDS"]["PREVIEW_TEXT"];?>
					<?endif;?>
					<?if($arResult["DETAIL_TEXT_TYPE"] == "text"):?>
						<p><?=$arResult["FIELDS"]["DETAIL_TEXT"];?></p>
					<?else:?>
						<?=$arResult["FIELDS"]["DETAIL_TEXT"];?>
					<?endif;?>
				</div>
			<?endif;?>
		</div>
	</div>
</div>