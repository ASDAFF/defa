<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?
global $arTheme;
use \Bitrix\Main\Localization\Loc;

$bOrderViewBasket = $arParams['ORDER_VIEW'];
$basketURL = (isset($arTheme['URL_BASKET_SECTION']) && strlen(trim($arTheme['URL_BASKET_SECTION']['VALUE'])) ? $arTheme['URL_BASKET_SECTION']['VALUE'] : SITE_DIR.'cart/');
$dataItem = ($bOrderViewBasket ? CPriority::getDataItem($arResult) : false);
$bFormQuestion = (isset($arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']) && $arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']['VALUE'] == 'Y');
$catalogLinkedTemplate = (isset($arTheme['ELEMENTS_TABLE_TYPE_VIEW']) && $arTheme['ELEMENTS_TABLE_TYPE_VIEW']['VALUE'] == 'catalog_table_2' ? 'catalog_linked_2' : 'catalog_linked');

/*set array props for component_epilog*/
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
	'LINK_TARIFS' => $arResult['DISPLAY_PROPERTIES']['LINK_TARIFS']['VALUE'],
	'BRAND_ITEM' => $arResult['BRAND_ITEM'],
	'GALLERY_BIG' => $arResult['GALLERY_BIG'],
	'CHARACTERISTICS' => $arResult['CHARACTERISTICS'],
	'VIDEO' => $arResult['VIDEO'],
	'VIDEO_IFRAME' => $arResult['VIDEO_IFRAME'],
	'PREVIEW_TEXT' => $arResult['FIELDS']['PREVIEW_TEXT'],
	'DETAIL_TEXT' => $arResult['FIELDS']['DETAIL_TEXT'],
	'ORDER' => $bOrderViewBasket,
	'TIZERS' => $arResult['TIZERS'],
	'CATALOG_LINKED_TEMPLATE' => $catalogLinkedTemplate,
);
if(isset($arResult['PROPERTIES']['BNR_TOP']) && $arResult['PROPERTIES']['BNR_TOP']['VALUE_XML_ID'] == 'YES')
	$templateData['SECTION_BNR_CONTENT'] = true;
?>
<?// show top banners start?>
<?$bShowTopBanner = (isset($arResult['SECTION_BNR_CONTENT'] ) && $arResult['SECTION_BNR_CONTENT'] == true);?>
<?if($bShowTopBanner):?>
	<?$this->SetViewTarget("section_bnr_content");?>
		<?CPriority::ShowTopDetailBanner($arResult, $arParams);?>
	<?$this->EndViewTarget();?>
<?endif;?>
<?// show top banners end?>

<div class="item_wrap <?=($arResult['GALLERY'] ? '' : ' wg')?>" data-id="<?=$arResult['ID']?>"<?=($bOrderViewBasket ? ' data-item="'.$dataItem.'"' : '')?>>
	<?// element name?>
	<?if($arParams['DISPLAY_NAME'] != 'N' && strlen($arResult['NAME'])):?>
		<h2 itemprop="name"><?=$arResult['NAME']?></h2>
	<?endif;?>
	<div class="head<?=($arResult['GALLERY'] ? '' : ' wti')?>">
		<div class="maxwidth-theme">
			<div class="row">			
				<div class="item col-md-4 col-sm-6<?=(isset($arParams['IMAGE_CATALOG_POSITION']) && $arParams['IMAGE_CATALOG_POSITION'] == 'left' ? ' image_left' : '');?>">
					<div class="info" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
						<?
						$frame = $this->createFrame('info')->begin('');
						$frame->setAnimation(true);
						?>
						<?if($arResult['DISPLAY_PROPERTIES']['STATUS']['VALUE_XML_ID'] || strlen($arResult['DISPLAY_PROPERTIES']['ARTICLE']['VALUE']) || $arResult['BRAND_ITEM']):?>
							<div class="hh">
								<?if(strlen($arResult['DISPLAY_PROPERTIES']['STATUS']['VALUE'])):?>
									<span class="status-icon <?=$arResult['DISPLAY_PROPERTIES']['STATUS']['VALUE_XML_ID']?>" itemprop="availability" href="http://schema.org/InStock"><?=$arResult['DISPLAY_PROPERTIES']['STATUS']['VALUE']?></span>
								<?endif;?>
								<?if(strlen($arResult['DISPLAY_PROPERTIES']['ARTICLE']['VALUE'])):?>
									<span class="article font_upper">
										<?=Loc::getMessage('ARTICLE')?>&nbsp;<span><?=$arResult['DISPLAY_PROPERTIES']['ARTICLE']['VALUE']?></span>
									</span>
								<?endif;?>
								<?if($arResult['BRAND_ITEM']):?>
									<div class="brand">
										<?if(!$arResult["BRAND_ITEM"]["IMAGE"]):?>
											<a href="<?=$arResult["BRAND_ITEM"]["DETAIL_PAGE_URL"]?>"><?=$arResult["BRAND_ITEM"]["NAME"]?></a>
										<?else:?>
											<a class="brand_picture" href="<?=$arResult["BRAND_ITEM"]["DETAIL_PAGE_URL"]?>">
												<img  src="<?=$arResult["BRAND_ITEM"]["IMAGE"]["src"]?>" alt="<?=$arResult["BRAND_ITEM"]["NAME"]?>" title="<?=$arResult["BRAND_ITEM"]["NAME"]?>" />
											</a>
										<?endif;?>
									</div>
									<div class="clearfix"></div>
								<?endif;?>
							</div>
						<?endif;?>
						<div class="bottom-wrapper">
							<?if(strlen($arResult['DISPLAY_PROPERTIES']['PRICE']['VALUE'])):?>
								<div class="price">
									<div class="price_new"><span class="price_val"><?=CPriority::FormatPriceShema($arResult['DISPLAY_PROPERTIES']['PRICE']['VALUE'])?></span></div>
									<?if(strlen($arResult['DISPLAY_PROPERTIES']['PRICEOLD']['VALUE'])):?>
										<div class="price_old"><span class="price_val"><?=$arResult['DISPLAY_PROPERTIES']['PRICEOLD']['VALUE']?></span></div>
									<?endif;?>
								</div>
							<?endif;?>
							<?// element buy block?>
							<?//if($bOrderViewBasket && $arResult['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES'):?>
							<?if($arResult['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES' || $arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']['VALUE_XML_ID'] == 'YES'):?>
								<?if($bOrderViewBasket && $arResult['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES'):?>
									<div class="buy_block lg clearfix">
										<div class="counter pull-left">
											<div class="wrap">
												<span class="minus ctrl">
													<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/minus.svg')?>
												</span>
												<div class="input"><input type="text" value="1" class="count" /></div>
												<span class="plus ctrl">
													<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/plus.svg')?>
												</span>
											</div>
										</div>
										<div class="buttons pull-right">
											<span class="btn btn-default pull-right to_cart animate-load" data-quantity="1"><span><?=Loc::getMessage('BUTTON_TO_CART')?></span></span>
											<a href="<?=$basketURL?>" class="btn btn-default pull-right in_cart"><span><?=Loc::getMessage('BUTTON_IN_CART')?></span></a>
										</div>
									</div>
								<?endif;?>
								<div class="wrapper-block-btn order<?=($bOrderViewBasket ? ' basketTrue' : '')?>">
									<?if(!$bOrderViewBasket):?>
										<div class="wrapper">
											<span class="btn btn-default animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_order_product");?>" data-name="order_product" data-autoload-product="<?=CPriority::formatJsName($arResult['NAME'])?>"><?=(strlen($arParams['S_ORDER_SERVISE']) ? $arParams['S_ORDER_SERVISE'] : Loc::getMessage('S_ORDER_SERVISE'))?></span>
										</div>
									<?endif;?>
									<?if($bFormQuestion && $arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']['VALUE_XML_ID'] == 'YES'):?>								
										<div class="wrapper">
											<span class="btn btn-default wide-block animate-load btn-transparent" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question");?>" data-autoload-need_product="<?=CPriority::formatJsName($arResult['NAME'])?>" data-name="question"><span><?=(strlen($arParams['S_ASK_QUESTION']) ? $arParams['S_ASK_QUESTION'] : Loc::getMessage('S_ASK_QUESTION'))?></span></span>
										</div>
									<?endif?>
								</div>
							<?else:?>
								<?if($arResult['PROPERTIES']['LINK_TARIF']['VALUE']):?>
									</div>
								<?endif;?>						
							<?endif;?>
						</div>
						<?if(isset($arResult['DISPLAY_PROPERTIES']['DELIVERY']) && strlen($arResult['DISPLAY_PROPERTIES']['DELIVERY']['DISPLAY_VALUE'])):?>
							<div class="delivery">
								<span class="icon"><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/info.svg');?></span>
								<div class="text"><?=$arResult['DISPLAY_PROPERTIES']['DELIVERY']['DISPLAY_VALUE'];?></div>
							</div>
						<?endif;?>
						<?if(strlen($arResult['FIELDS']['PREVIEW_TEXT'])):?>
							<div class="previewtext" itemprop="description">
								<?// element detail text?>
								<?if($arResult['PREVIEW_TEXT_TYPE'] == 'text'):?>
									<p><?=$arResult['FIELDS']['PREVIEW_TEXT'];?></p>
								<?else:?>
									<?=$arResult['FIELDS']['PREVIEW_TEXT'];?>
								<?endif;?>
							</div>
						<?endif;?>					
						<?$frame->end();?>
					</div>
					<?if(strlen($arResult['FIELDS']['DETAIL_TEXT'])):?>
						<div class="link-block-more">
							<span class="font_upper dark-color"><?=Loc::getMessage('MORE_TEXT_BOTTOM');?></span>
						</div>
					<?endif;?>
				</div>
				<?if($arResult['GALLERY']):?>
					<div class="item col-md-8 col-sm-6">
						<div class="galery" id="slider">
							<div class="inner zomm_wrapper-block">
								<?if($arResult['PROPERTIES']['HIT']['VALUE']):?>
									<div class="stickers">
										<div class="stickers-wrapper">
											<?foreach($arResult['PROPERTIES']['HIT']['VALUE_XML_ID'] as $key => $class):?>
												<div class="sticker_<?=strtolower($class);?>"><?=$arResult['PROPERTIES']['HIT']['VALUE'][$key]?></div>
											<?endforeach;?>
										</div>
									</div>
								<?endif;?>
								<div class="flexslider dark-nav" data-slice="Y" id="slider" data-plugin-options='{"animation": "slide", "directionNav": true, "controlNav" :false, "animationLoop": true, "slideshow": false, "counts": [1, 1, 1], "sync": ".detail .galery #carousel", "useCSS": false}'>
									<ul class="slides items">
										<?if($arResult['GALLERY']):?>
											<?$countAll = count($arResult['GALLERY']);?>
											<?foreach($arResult['GALLERY'] as $i => $arPhoto):?>
												<li class="item" data-slice-block="Y" data-slice-params='{"lineheight": -3}'>
													<a href="<?=$arPhoto['DETAIL']['SRC']?>" target="_blank" title="<?=$arPhoto['TITLE']?>" class="fancybox" data-fancybox-group="gallery">
														<img src="<?=$arPhoto['PREVIEW']['src']?>" class="img-responsive inline" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" itemprop="image" />
														<span class="zoom">
															<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/zoom.svg');?>
														</span>
													</a>
												</li>
											<?endforeach;?>
										<?else:?>
											<li class="item">
												<img src="<?=SITE_TEMPLATE_PATH.'/images/svg/noimage_product.svg';?>" class="img-responsive inline" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" itemprop="image" />
											</li>
										<?endif;?>
									</ul>
								</div>
							</div>
							<?if(count($arResult["GALLERY"]) > 1):?>
								<div class="thmb_wrap">
									<div class="thmb flexslider unstyled" id="carousel">
										<ul class="slides">
											<?foreach($arResult["GALLERY"] as $arPhoto):?>
												<li>
													<img class="img-responsive inline" src="<?=$arPhoto["THUMB"]["src"]?>" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" />
												</li>
											<?endforeach;?>
										</ul>
									</div>
								</div>
							<?endif;?>
						</div>
					</div>
				<?else:?>
					<div class="item col-md-8 col-sm-6">
						<div class="galery" id="slider">
							<div class="inner zomm_wrapper-block">
								<ul class="items">
									<li class="item">
										<img src="<?=SITE_TEMPLATE_PATH.'/images/svg/noimage_product.svg';?>" class="img-responsive inline" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" itemprop="image" />
									</li>
								</ul>
							</div>
						</div>
					</div>
				<?endif;?>			
			</div>
		</div>
	</div>
</div>