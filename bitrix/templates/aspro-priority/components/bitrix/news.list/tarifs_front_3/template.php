<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>
	<?
	global $arTheme;
	$bOrderViewBasket = $arParams['ORDER_VIEW'];
	$basketURL = (isset($arTheme['URL_BASKET_SECTION']) && strlen(trim($arTheme['URL_BASKET_SECTION']['VALUE'])) ? $arTheme['URL_BASKET_SECTION']['VALUE'] : SITE_DIR.'cart/');
	?>
	<div class="item-views front tarifs type_3 tarifs_scroll">
		<div class="maxwidth-theme">
			<?
			global $arTheme;
			$slideshowSpeed = (isset($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE']) && abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE'])) ? $arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE'] : abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED'])));
			$animationSpeed = (isset($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE']) && abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE'])) ? $arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE'] : abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED'])));
			$bAnimation = (bool)$slideshowSpeed;
			?>
			<?//items?>
			<?if(isset($arParams["TITLE"]) && strlen($arParams["TITLE"])):?>
				<h2><?=$arParams["TITLE"];?></h2>
			<?endif;?>
			<?
			if(!$arParams["COUNT_LG"] || $arParams["COUNT_LG"] > 8)
				$arParams["COUNT_LG"] = 4;
			if(!$arParams["COUNT_MD"] || $arParams["COUNT_MD"] > 8)
				$arParams["COUNT_MD"] = 3;
			if(!$arParams["COUNT_SM"] || $arParams["COUNT_SM"] > 8)
				$arParams["COUNT_SM"] = 2;
			if(!$arParams["COUNT_XS"] || $arParams["COUNT_XS"] > 8)
				$arParams["COUNT_XS"] = 1;
			?>
			<div class="flexslider unstyled row front dark-nav view-control navigation-vcenter" data-plugin-options='{"useCSS": false, "directionNav": true, "controlNav" :false, "animationLoop": true, "slideshow": false, "counts": [<?=$arParams["COUNT_LG"];?>, <?=$arParams["COUNT_MD"];?>, <?=$arParams["COUNT_SM"];?>, <?=$arParams["COUNT_XS"];?>], "itemMargin": 0}'>
				<ul class="slides flexbox">
					<?foreach($arResult["ITEMS"] as $arItem):?>
						<?
						// edit/add/delete buttons for edit mode
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						$dataItem = ($bOrderViewBasket ? CPriority::getDataItem($arItem) : false);
						$bImage = (isset($arItem['FIELDS']['PREVIEW_PICTURE']) && $arItem['FIELDS']['PREVIEW_PICTURE']['SRC'] ? true : false);
						?>
						<li class="item border shadow<?=(!$bImage ? ' wti' : '')?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>"<?=($bOrderViewBasket ? ' data-item="'.$dataItem.'"' : '')?>>
							<div class="image">
								<?if($arItem['DISPLAY_PROPERTIES']['HIT']['VALUE']):?>
									<div class="stickers">
										<div class="stickers-wrapper">
											<?foreach($arItem['DISPLAY_PROPERTIES']['HIT']['VALUE_XML_ID'] as $key => $class):?>
												<div class="sticker_<?=strtolower($class);?>"><?=$arItem['PROPERTIES']['HIT']['VALUE'][$key]?></div>
											<?endforeach;?>
										</div>
									</div>
								<?endif;?>
								<div class="wrap">
									<?if($bImage):?>
										<?
										$arImage = CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'] , array('width' => 568, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
										?>
										<img class="img-responsive" src="<?=$arImage['src'];?>" alt="<?=$arItem['NAME'];?>" title="<?=$arItem['NAME'];?>">
									<?endif;?>
								</div>
								<div class="top_block">
									<?if(isset($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']])):?>
										<div class="section_name font_upper"><?=$arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME'];?></div>
									<?endif;?>
									<?if(isset($arItem['FIELDS']['NAME']) && strlen($arItem['FIELDS']['NAME'])):?>
										<div class="name"><?=$arItem['FIELDS']['NAME'];?></div>
									<?endif;?>
								</div>
							</div>								
							<div class="wrap">
								<div class="body-wrap">
									<div class="body-info">
										<?
										$bPreviewText = (isset($arItem['FIELDS']['PREVIEW_TEXT']) && strlen($arItem['FIELDS']['PREVIEW_TEXT']) ? true : false);
										$bProperties = (isset($arItem['CHARACTERISTICS']) && $arItem['CHARACTERISTICS'] ? true : false);
										$bBottomBlock = ($bPreviewText || $bProperties);
										?>
										<?if($bBottomBlock):?>
											<div class="bottom_block">
												<div class="previewtext font_xs">
													<?if($bPreviewText):?>
														<div><?=$arItem['FIELDS']['PREVIEW_TEXT'];?></div>
													<?endif;?>
												</div>
												<?if($bProperties):?>
													<div class="properties">
														<?foreach($arItem['CHARACTERISTICS'] as $arProp):?>
															<div class="property <?=($arParams['SHOW_PROPS_NAME'] == 'N' ? 'ntitle' : '');?> font_xs clearfix">
																<?if($arParams['SHOW_PROPS_NAME'] != 'N'):?>
																	<div class="title-prop pull-left"><?=$arProp['NAME'];?></div>
																<?endif;?>
																<?if($arProp['VALUE_XML_ID'] == 'Y'):?>
																	<div class="value yes pull-right"><span><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/tariff_yes.svg');?></span></div>
																<?elseif($arProp['VALUE_XML_ID'] == 'N'):?>
																	<div class="value no pull-right"><span><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/tariff_no.svg');?></span></div>
																<?else:?>
																	<div class="value pull-right">
																		<?if(is_array($arProp['VALUE'])):?>
																			<?implode(', ', $arProp['VALUE']);?>
																		<?else:?>
																			<?=$arProp['VALUE'];?>
																		<?endif;?>
																	</div>
																<?endif;?>
															</div>
														<?endforeach;?>
													</div>
												<?endif;?>
											</div>
										<?endif;?>
									</div>
								</div>
								<?
								$bDefaultPrice = (isset($arItem['DEFAULT_PRICE']) ? true : false);
								$bAllPrices = (isset($arItem['PRICES']) ? true : false);
								$bShowAllPrices = ($bAllPrices && count($arItem['PRICES']) > 1 ? true : false);
								$bOnlyOnePrice = (isset($arItem['DISPLAY_PROPERTIES']['ONLY_ONE_PRICE']) && $arItem['DISPLAY_PROPERTIES']['ONLY_ONE_PRICE']['VALUE_XML_ID'] == 'Y' ? true : false);
								$defaultPrice = ($bDefaultPrice ? $arItem['DEFAULT_PRICE']['VALUE'] : $arItem['PRICES'][0]['VALUE']);
								$defaultFilterPrice = ($bDefaultPrice ? $arItem['DEFAULT_PRICE']['FILTER_PRICE'] : $arItem['FILTER_PRICES'][0]);
								?>
								<div class="prices">
									<?if($bAllPrices):?>
										<?if($bOnlyOnePrice):?>
											<div class="price_default">
												<div class="value" data-price="<?=$defaultPrice;?>" data-filter_price="<?=$defaultFilterPrice;?>"><?=$defaultPrice;?></div>
											</div>
										<?else:?>
											<div class="price_default<?=($bShowAllPrices ? ' wdropdown' : '');?>">
												<div class="title-price"><span><span><?=($bDefaultPrice ? $arItem['DEFAULT_PRICE']['NAME'] : $arItem['PRICES'][0]['NAME'])?></span></span></div>
												<div class="value" data-price="<?=$defaultPrice;?>" data-filter_price="<?=$defaultFilterPrice;?>"><?=$defaultPrice;?></div>
											</div>
											<?if($bShowAllPrices):?>
												<ul class="all_price dropdown">
													<?foreach($arItem['PRICES'] as $keyPrice => $arPrice):?>
														<li class="price font_xs" data-price="<?=$arPrice['VALUE'];?>" data-filter_price="<?=$arItem['FILTER_PRICES'][$keyPrice];?>" data-name="<?=$arPrice['NAME'];?>"><?=$arPrice['NAME'];?></li>
													<?endforeach?>
												</ul>
											<?endif;?>
										<?endif;?>
									<?endif;?>
								</div>
								<?if($bOrderViewBasket && $arItem['PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES'):?>
									<div class="buy_block lg clearfix">
										<div class="buttons">
											<span class="btn btn-default to_cart animate-load" data-quantity="1"><span><?=GetMessage('BUTTON_TO_CART')?></span></span>
											<a href="<?=$basketURL?>" class="btn btn-default in_cart"><span><span><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/inbasket.svg');?><?=GetMessage('BUTTON_IN_CART')?></span></span></a>
										</div>
									</div>
								<?endif;?>
								<?if($arItem['PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES' && !$bOrderViewBasket):?>
									<div class="order<?=($bOrderViewBasket ? ' basketTrue' : '')?>">
										<?if($arItem['PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES' && !$bOrderViewBasket):?>
											<span class="btn btn-default btn-xs animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_order_product");?>" data-name="order_product" data-autoload-product="<?=$arItem['NAME']?><?=($defaultPrice ? ': '.$defaultPrice : '');?>"><span><?=(strlen($arParams['S_ORDER_PRODUCT']) ? $arParams['S_ORDER_PRODUCT'] : GetMessage('S_ORDER_PRODUCT'))?></span></span>
										<?endif;?>
									</div>
								<?endif;?>
							</div>
						</li>
					<?endforeach;?>
				</ul>
			</div>
		</div>
	</div>
<?endif;?>