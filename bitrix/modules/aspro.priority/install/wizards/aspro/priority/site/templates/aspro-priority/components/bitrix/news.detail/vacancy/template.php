<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?
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

$bImage = (isset($arResult["FIELDS"]["DETAIL_PICTURE"]) && strlen($arResult["FIELDS"]["DETAIL_PICTURE"]['SRC']) ? true : false);
?>

<div class="detail vacancy">
	<div class="content">
		<?if($bImage || $arResult["DISPLAY_PROPERTIES"]):?>
			<div class="top_content">
				<?if($bImage):?>
					<div class="image"><img class="img-responsive" src="<?=$arResult["FIELDS"]["DETAIL_PICTURE"]['SRC']?>" alt="<?=($arResult["FIELDS"]["DETAIL_PICTURE"]['ALT'] ? $arResult["FIELDS"]["DETAIL_PICTURE"]['ALT'] : $arResult['NAME']);?>" title="<?=($arResult["FIELDS"]["DETAIL_PICTURE"]['TITLE'] ? $arResult["FIELDS"]["DETAIL_PICTURE"]['TITLE'] : $arResult['NAME']);?>" /></div>
				<?endif;?>
				<?if($arResult["DISPLAY_PROPERTIES"]):?>
					<div class="properties border">
						<div class="row">
							<?$i = 0;?>
							<?foreach($arResult["DISPLAY_PROPERTIES"] as $PCODE => $arProperty):?>
								<?
								if($arProperty['PROPERTY_TYPE'] == 'E' || $arProperty['PROPERTY_TYPE'] == 'G')
									continue;
								?>
								<div class="property <?=strtolower($PCODE);?> col-md-3 col-sm-3 col-xs-6">
									<div class="title-prop font_upper"><?=$arProperty['NAME'];?></div>
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
								<?++$i;?>
							<?endforeach;?>
						</div>
					</div>
				<?endif;?>
			</div>
		<?endif;?>
		<?if(isset($arResult["FIELDS"]["DETAIL_TEXT"]) && strlen($arResult["FIELDS"]["DETAIL_TEXT"])):?>
			<div class="text">
				<?if($arResult["DETAIL_TEXT_TYPE"] == "text"):?>
					<p><?=$arResult["FIELDS"]["DETAIL_TEXT"];?></p>
				<?else:?>
					<?=$arResult["FIELDS"]["DETAIL_TEXT"];?>
				<?endif;?>
			</div>
		<?endif;?>
		<?if($arParams['FORM'] == 'Y'):?>
			<div class="buttons">
				<div class="wrap"><span class="btn btn-default btn-lg animate-load" data-event="jqm" data-name="resume" data-param-id="<?=CPriority::getFormID("aspro_priority_resume");?>" data-autoload-POST="<?=CPriority::formatJsName($arResult['NAME'])?>" data-autohide=""><?=$arParams["FORM_BUTTON_TITLE"];?></span></div>
			</div>
		<?endif;?>
		
	</div>
</div>