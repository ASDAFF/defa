<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
global $arTheme;
$bShowImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE']);
$bOrderViewBasket = $arParams['ORDER_VIEW'];
$basketURL = (strlen(trim($arTheme['ORDER_VIEW']['DEPENDENT_PARAMS']['URL_BASKET_SECTION']['VALUE'])) ? trim($arTheme['ORDER_VIEW']['DEPENDENT_PARAMS']['URL_BASKET_SECTION']['VALUE']) : '');
?>
<?if($arResult['ITEMS']):?>
	<?
	$qntyItems = count($arResult['ITEMS']);
	$countmd = 3;
	$countsm = 2;
	$countxs = 1;
	$colmd = 4;
	$colsm = 3;
	$colxs = 6;
	$bShowImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE']);
	?>
	<div class="catalog item-views table linked">
		<div class="flexslider unstyled front row shadow dark-nav" data-plugin-options='{"animation": "slide", "directionNav": true, "controlNav" :true, "animationLoop": true, "itemMargin": 32, "slideshow": false, "counts": [<?=$countmd?>, <?=$countsm?>, <?=$countxs?>]}'>
			<ul class="slides" data-slice="Y" itemscope itemtype="http://schema.org/ItemList">
				<?foreach($arResult["ITEMS"] as $i => $arItem):?>
					<?
					// edit/add/delete buttons for edit mode
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					// use detail link?
					$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
					// preview image
					if($bShowImage){
						$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
						$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 244, 'height' => 244), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
						$imageSrc = ($bImage ? $arImage['src'] : SITE_TEMPLATE_PATH.'/images/svg/noimage_product.svg');
						$imageDetailSrc = ($bImage ? $arItem['FIELDS']['DETAIL_PICTURE']['SRC'] : false);
					}
					// use order button?
					$bOrderButton = $arItem["DISPLAY_PROPERTIES"]["FORM_ORDER"]["VALUE_XML_ID"] == "YES";
					$dataItem = ($bOrderViewBasket ? CPriority::getDataItem($arItem) : false);
					?>
					<li class="col-md-<?=$colmd?> col-sm-<?=$colsm?> col-xs-<?=$colxs?>">
						<div class="item<?=($bShowImage ? '' : ' wti')?>" data-slice-block="Y" data-slice-params='{"row": ".slides", "classNull" : ".footer-button"}' id="<?=$this->GetEditAreaId($arItem['ID'])?>"<?=($bOrderViewBasket ? ' data-item="'.$dataItem.'"' : '')?> itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product">
							<div class="inner-wrap">
								<?if($bShowImage):?>
									<div class="image shine">
										<?if($arItem['DISPLAY_PROPERTIES']['HIT']['VALUE']):?>
											<div class="stickers">
												<div class="stickers-wrapper">
													<?foreach($arItem['DISPLAY_PROPERTIES']['HIT']['VALUE_XML_ID'] as $key => $class):?>
														<div class="sticker_<?=strtolower($class);?>"><?=$arItem['DISPLAY_PROPERTIES']['HIT']['VALUE'][$key]?></div>
													<?endforeach;?>
												</div>
											</div>
										<?endif;?>
										
										<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" itemprop="url">
										<?elseif($imageDetailSrc):?><a href="<?=$imageDetailSrc?>" class="img-inside fancybox" itemprop="url">
										<?endif;?>
											<img class="img-responsive" src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" itemprop="image" />
										<?if($bDetailLink):?></a>
										<?elseif($imageDetailSrc):?><span class="zoom"><i class="fa fa-16 fa-white-shadowed fa-search"></i></span></a>
										<?endif;?>
									</div>
								<?endif;?>

								<div class="text">
									<div class="cont">
										<?// element name?>
										<?if(strlen($arItem['FIELDS']['NAME'])):?>
											<div class="title">
												<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" itemprop="url" class="dark-color"><?endif;?>
													<span itemprop="name"><?=$arItem['NAME']?></span>
												<?if($bDetailLink):?></a><?endif;?>
											</div>
										<?endif;?>

										<?// element section name?>
										<?/*if(strlen($arItem['SECTION_NAME'])):?>
											<div class="section_name"><?=$arItem['SECTION_NAME']?></div>
										<?endif;*/?>

										<?// element status?>
										<?if(strlen($arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE'])):?>
											<span class="status-icon <?=$arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE_XML_ID']?>" itemprop="description"><?=$arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE']?></span>
										<?endif;?>

										<?// element article?>
										<?if(strlen($arItem['DISPLAY_PROPERTIES']['ARTICLE']['VALUE'])):?>
											<span class="article" itemprop="description"><?=GetMessage('S_ARTICLE')?>&nbsp;<span><?=$arItem['DISPLAY_PROPERTIES']['ARTICLE']['VALUE']?></span></span>
										<?endif;?>

									</div>

									<div class="row foot">
										<div class="col-md-12 col-sm-12 col-xs-12 clearfix slice_price">
											<?// element price?>
											<?if(strlen($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'])):?>
												<div class="price<?=($bOrderViewBasket ? '  inline' : '')?>" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
													<div class="price_new">
														<span class="price_val"><?=CPriority::FormatPriceShema($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'])?></span>
													</div>
													<?if($arItem['DISPLAY_PROPERTIES']['PRICEOLD']['VALUE']):?>
														<div class="price_old">
															<span class="price_val"><?=$arItem['DISPLAY_PROPERTIES']['PRICEOLD']['VALUE']?></span>
														</div>
													<?endif;?>
												</div>
											<?endif;?>
										</div>
										
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="footer-button">
												<?if($bOrderButton):?>
													<?// element order button?>
													<?if($bOrderButton && !$bOrderViewBasket):?>
														<span class="btn btn-default animate-load" <?=(strlen(($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']) && strlen($arItem['DISPLAY_PROPERTIES']['PRICEOLD']['VALUE'])) ? 'style="margin-top:16px;"' : '')?> data-event="jqm" data-param-id="<?=CCache::$arIBlocks[SITE_ID]["aspro_priority_form"]["aspro_priority_order_product"][0]?>" data-product="<?=$arItem["NAME"]?>" data-name="order_product"><?=(strlen($arParams['S_ORDER_PRODUCT']) ? $arParams['S_ORDER_PRODUCT'] : GetMessage('S_ORDER_PRODUCT'))?></span>
													<?endif;?>
													<?// element buy block?>
													<?if($bOrderViewBasket && $bOrderButton):?>
														<div class="buy_block clearfix">
															<div class="counter pull-left">
																<div class="wrap">
																	<span class="minus ctrl bgtransition"></span>
																	<div class="input"><input type="text" value="1" class="count" maxlength="20" /></div>
																	<span class="plus ctrl bgtransition"></span>
																</div>
															</div>
															<div class="buttons pull-right">
																<span class="btn btn-default to_cart animate-load" data-quantity="1"><span><?=GetMessage('BUTTON_TO_CART')?></span></span>
																<a href="<?=$basketURL;?>" class="btn btn-default in_cart"><span><?=GetMessage('BUTTON_IN_CART')?></span></a>
															</div>
														</div>
													<?endif;?>
												<?else:?>
													<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="btn btn-default"><?=(strlen($arParams['S_MORE_PRODUCT']) ? $arParams['S_MORE_PRODUCT'] : GetMessage('TO_ALL'))?></a>
												<?endif;?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
				<?endforeach;?>
			</ul>
		</div>
	</div>
<?endif;?>