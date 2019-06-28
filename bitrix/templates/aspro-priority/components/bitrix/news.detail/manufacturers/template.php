<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?
$catalogLinkedTemplate = (isset($arTheme['ELEMENTS_TABLE_TYPE_VIEW']) && $arTheme['ELEMENTS_TABLE_TYPE_VIEW']['VALUE'] == 'catalog_table_2' ? 'catalog_linked_2' : 'catalog_linked');

$templateData = array(
	'DOCUMENTS' => $arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['VALUE'],
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
	'BRAND_ITEM' => $arResult['BRAND_ITEM'],
	'GALLERY_BIG' => $arResult['GALLERY_BIG'],
	'VIDEO' => $arResult['VIDEO'],
	'VIDEO_IFRAME' => $arResult['VIDEO_IFRAME'],
	'DETAIL_TEXT' => $arResult['FIELDS']['DETAIL_TEXT'],
	'ORDER' => $bOrderViewBasket,
	'FORM_QUESTION' => $arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']['VALUE'],
	'CATALOG_LINKED_TEMPLATE' => $catalogLinkedTemplate,
);

if($arParams["DISPLAY_PICTURE"] != "N"){
	$picture = ($arResult["FIELDS"]["DETAIL_PICTURE"] ? "DETAIL_PICTURE" : "PREVIEW_PICTURE");
	CPriority::getFieldImageData($arResult, array($picture));
	$arPhoto = $arResult[$picture];
	if($arPhoto){
		$arImgs[] = array(
			'DETAIL' => $arPhoto,
			'PREVIEW' => CFile::ResizeImageGet($arPhoto["ID"], array('width' => 300, 'height' => 300), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true),
			'TITLE' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arPhoto['TITLE']) ? $arPhoto['TITLE'] : $arResult['NAME'])),
			'ALT' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arPhoto['ALT']) ? $arPhoto['ALT'] : $arResult['NAME'])),
		);
	}
}
?>
<div class="detail partners border">
	<article>
		<?// images?>
		<?if($arImgs || $arResult['CHARACTERISTICS']):?>
			<div class="top_content">
				<?if($arImgs):?>
					<div class="image">
						<img src="<?=$arImgs[0]["DETAIL"]["SRC"]?>" title="<?=$arImgs[0]["TITLE"]?>" alt="<?=$arImgs[0]["ALT"]?>" class="img-responsive" />
					</div>
				<?endif;?>
				<?// element display properties?>
				<?if($arResult['CHARACTERISTICS']):?>
					<div class="properties">
						<?foreach($arResult['CHARACTERISTICS'] as $PCODE => $arProperty):?>
							<?if($arProperty['DISPLAY_VALUE']):?>
								<?if(in_array($PCODE, array('PERIOD', 'TITLE_BUTTON', 'LINK_BUTTON'))) continue;?>
								<div class="property <?=strtolower($PCODE);?>">
									<div class="title-prop font_upper"><?=$arProperty['NAME']?></div>
									<div class="value">
										<?if(is_array($arProperty['DISPLAY_VALUE'])):?>
											<?$val = implode('&nbsp;/&nbsp;', $arProperty['DISPLAY_VALUE']);?>
										<?else:?>
											<?$val = $arProperty['DISPLAY_VALUE'];?>
										<?endif;?>
										<?if($PCODE == 'SITE'):?>
											<!--noindex-->
											<a class="dark-color" href="<?=(strpos($arProperty['VALUE'], 'http') === false ? 'http://' : '').$arProperty['VALUE'];?>" rel="nofollow" target="_blank">
												<?=strpos($arProperty['VALUE'], '?') === false ? $arProperty['VALUE'] : explode('?', $arProperty['VALUE'])[0]?>
											</a>
											<!--/noindex-->
										<?elseif($PCODE == 'EMAIL'):?>
											<a href="mailto:<?=$val?>"><?=$val?></a>
										<?elseif($PCODE == 'PHONE'):?>
											<a href="tel:+<?=str_replace(array(' ', ',', '-', '(', ')'), '', $val);?>"><?=$val?></a>
										<?else:?>
											<?=$val?>
										<?endif;?>
									</div>
								</div>
							<?endif;?>
						<?endforeach;?>
					</div>
				<?endif;?>				
			</div>
		<?endif;?>
		<?if($arParams["DISPLAY_NAME"] != "N" && strlen($arResult["NAME"]) || strlen($arResult["FIELDS"]["PREVIEW_TEXT"].$arResult["FIELDS"]["DETAIL_TEXT"])):?>
			<div class="post-content">
				<?if($arParams["DISPLAY_NAME"] != "N" && strlen($arResult["NAME"])):?>
					<h2><?=$arResult["NAME"]?></h2>
				<?endif;?>
				<div class="content">
					<?// text?>
					<?if(strlen($arResult["FIELDS"]["PREVIEW_TEXT"].$arResult["FIELDS"]["DETAIL_TEXT"])):?>
						<div class="text">
							<?if($arResult["DETAIL_TEXT_TYPE"] == "text"):?>
								<p><?=$arResult["FIELDS"]["DETAIL_TEXT"];?></p>
							<?else:?>
								<?=$arResult["FIELDS"]["DETAIL_TEXT"];?>
							<?endif;?>
						</div>
					<?endif;?>
				</div>
			</div>
		<?endif;?>
	</article>
</div>