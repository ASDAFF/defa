<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?
$frame = $this->createFrame()->begin();
$frame->setAnimation(true);
global $arTheme;
$bShowImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE']);
$bOrderViewBasket = $arParams['ORDER_VIEW'];

$basketURL = (strlen(trim($arTheme['ORDER_VIEW']['DEPENDENT_PARAMS']['URL_BASKET_SECTION']['VALUE'])) ? trim($arTheme['ORDER_VIEW']['DEPENDENT_PARAMS']['URL_BASKET_SECTION']['VALUE']) : '');
?>
<?use \Bitrix\Main\Localization\Loc;?>
<?
$bHasSection = false;
if(isset($arResult['SECTION_CURRENT']) && $arResult['SECTION_CURRENT'])
	$bHasSection = true;
if($bHasSection)
{
	// edit/add/delete buttons for edit mode
	$arSectionButtons = CIBlock::GetPanelButtons($arParams['IBLOCK_ID'], 0, $arResult['SECTION_CURRENT']['ID'], array('SESSID' => false, 'CATALOG' => true));
	$this->AddEditAction($arResult['SECTION_CURRENT']['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'SECTION_EDIT'));
	$this->AddDeleteAction($arResult['SECTION_CURRENT']['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="section" id="<?=$this->GetEditAreaId($arResult['SECTION_CURRENT']['ID'])?>">
	<?
}?>
<div class="catalog item-views list image-<?=$arParams['IMAGE_POSITION']?>">
	<?if($arResult['ITEMS']):?>
		<?if($arParams['DISPLAY_TOP_PAGER']):?>
			<div class="pagination_nav">
				<?=$arResult['NAV_STRING']?>
			</div>
		<?endif;?>
		<div class="row items" itemscope itemtype="http://schema.org/ItemList">
			<?foreach($arResult['ITEMS'] as $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// use detail link?
				$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
				// preview image
				if($bShowImage){
					$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
					$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 396, 'height' => 396), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
					$imageSrc = ($bImage ? $arImage['src'] : SITE_TEMPLATE_PATH.'/images/svg/noimage_product.svg');
					$imageDetailSrc = ($bImage ? $arItem['FIELDS']['DETAIL_PICTURE']['SRC'] : false);
				}
				// use order button?
				$bOrderButton = ($arItem['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES');
				$dataItem = ($bOrderViewBasket ? CPriority::getDataItem($arItem) : false);
				?>
				<?ob_start();?>
					<?if($bShowImage):?>
						<div class="image-wrapper">
							<div class="image">
								<?if($arItem['PROPERTIES']['HIT']['VALUE']):?>
									<div class="stickers">
										<div class="stickers-wrapper">
											<?foreach($arItem['PROPERTIES']['HIT']['VALUE_XML_ID'] as $key => $class):?>
												<div class="sticker_<?=strtolower($class);?>"><?=$arItem['PROPERTIES']['HIT']['VALUE'][$key]?></div>
											<?endforeach;?>
										</div>
									</div>
								<?endif;?>
								<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" itemprop="url">
								<?elseif($imageDetailSrc):?><a href="<?=$imageDetailSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" class="img-inside fancybox" itemprop="url">
								<?endif;?>
									<img class="img-responsive" src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" itemprop="image" />
								<?if($bDetailLink):?></a>
								<?elseif($imageDetailSrc):?><span class="zoom"><i class="fa fa-16 fa-white-shadowed fa-search"></i></span></a>
								<?endif;?>
							</div>
						</div>
					<?endif;?>
				<?$imgPart = ob_get_clean();?>

				<?ob_start();?>
					<div class="text">
						<div class="row">
							<?$colmd = 12 - (strlen($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']) || $bOrderButton ? ($bShowImage ? 3 : 2) : 0);?>
							<div class="col-md-8 col-sm-8 col-xs-12">
								<div class="cont">
									<?// element article?>
									<?if(strlen($arItem['DISPLAY_PROPERTIES']['ARTICLE']['VALUE'])):?>
										<span class="article" itemprop="description"><?=GetMessage('S_ARTICLE')?>&nbsp;<span><?=$arItem['DISPLAY_PROPERTIES']['ARTICLE']['VALUE']?></span></span>
									<?endif;?>

									<?// element name?>
									<?if(strlen($arItem['FIELDS']['NAME'])):?>
										<div class="title">
											<?if($bDetailLink):?><a class="dark-color" href="<?=$arItem['DETAIL_PAGE_URL']?>" itemprop="url"><?endif;?>
												<span itemprop="name"><?=$arItem['NAME']?></span>
											<?if($bDetailLink):?></a><?endif;?>
										</div>
									<?endif;?>
									
									<?// element preview text?>
									<?if(strlen($arItem['FIELDS']['PREVIEW_TEXT'])):?>
										<div class="previewtext font_xs" itemprop="description">
											<?if($arItem['PREVIEW_TEXT_TYPE'] == 'text'):?>
												<p><?=$arItem['FIELDS']['PREVIEW_TEXT']?></p>
											<?else:?>
												<?=$arItem['FIELDS']['PREVIEW_TEXT']?>
											<?endif;?>
										</div>
									<?endif;?>
									
									<?// properties?>
									<?if(isset($arItem['CHARACTERISTICS']) && $arItem['CHARACTERISTICS']):?>
										<?$i = 0;?>
										<div class="props_list">
											<?foreach($arItem['CHARACTERISTICS'] as $arProp):?>
												<?if($arProp['VALUE']):?>
													<div class="prop font_xs">
														<span class="title-prop"><?=$arProp['NAME'];?></span>
														<span class="separator">&mdash;</span>
														<span class="value"><?=(is_array($arProp['VALUE']) ? implode(', ', $arProp['VALUE']) : $arProp['VALUE']);?></span>
													</div>
													<?if(count($arItem['CHARACTERISTICS']) > 3 && $i == 2):?>
														<div class="hidden-block">
															<div class="wrap">
													<?endif;?>
												<?endif;?>
												<?++$i;?>
											<?endforeach;?>
											<?if(count($arItem['CHARACTERISTICS']) > 3 && $i > 2):?>
													</div>
												</div>
												<div class="rolldown font_upper"><span data-open_text="<?=Loc::getMessage('OPEN_TEXT_1');?>" data-close_text="<?=Loc::getMessage('CLOSE_TEXT_1');?>"><span class="text"><?=Loc::getMessage('CLOSE_TEXT_1');?></span><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/v_roller.svg');?></span></div>
											<?endif;?>
										</div>
									<?endif;?>
								</div>
							</div>

							<?if(strlen($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']) || $bOrderButton || isset($arItem['DISPLAY_PROPERTIES']['DELIVERY'])):?>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="foot">
										<?// element status?>
										<?if(strlen($arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE'])):?>
											<span class="status-icon <?=$arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE_XML_ID']?>" itemprop="description"><?=$arItem['DISPLAY_PROPERTIES']['STATUS']['VALUE']?></span>
										<?endif;?>
									
										<?// element price?>
										<?if(strlen($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'])):?>
											<div class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
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
										
										<?if($bOrderButton):?>
											<?// element order button?>
											<?if($bOrderButton && !$bOrderViewBasket):?>
												<span class="btn btn-default animate-load" <?=(strlen(($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']) && strlen($arItem['DISPLAY_PROPERTIES']['PRICEOLD']['VALUE'])) ? 'style="margin-top:16px;"' : '')?> data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_order_product");?>" data-autoload-product="<?=CPriority::formatJsName($arItem['NAME'])?>" data-name="order_product"><?=(strlen($arParams['S_ORDER_PRODUCT']) ? $arParams['S_ORDER_PRODUCT'] : GetMessage('S_ORDER_PRODUCT'))?></span>
											<?endif;?>

											<?// element buy block?>
											<?if($bOrderViewBasket && $bOrderButton):?>
												<div class="buy_block clearfix">
													<div class="counter">
														<div class="wrap">
															<span class="minus ctrl">
																<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/minus.svg')?>
															</span>
															<div class="input"><input type="text" value="1" class="count" maxlength="20" /></div>
															<span class="plus ctrl">
																<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/plus.svg')?>
															</span>
														</div>
													</div>
													<div class="buttons">
														<span class="btn btn-default to_cart animate-load" data-quantity="1"><span><?=GetMessage('BUTTON_TO_CART')?></span></span>
														<a href="<?=$basketURL;?>" class="btn btn-default in_cart"><span><?=GetMessage('BUTTON_IN_CART')?></span></a>
													</div>
												</div>
											<?endif;?>
										<?else:?>
											<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="btn btn-default"><?=(strlen($arParams['TO_ALL']) ? $arParams['TO_ALL'] : GetMessage('TO_ALL'))?></a>
										<?endif;?>
										<?if(isset($arItem['DISPLAY_PROPERTIES']['DELIVERY']) && strlen($arItem['DISPLAY_PROPERTIES']['DELIVERY']['DISPLAY_VALUE'])):?>
											<div class="delivery">
												<span class="icon"><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/info.svg');?></span>
												<div class="text"><?=$arItem['DISPLAY_PROPERTIES']['DELIVERY']['DISPLAY_VALUE'];?></div>
											</div>
										<?endif;?>
									</div>
								</div>
							<?endif;?>
						</div>
					</div>
				<?$textPart = ob_get_clean();?>

				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="item border shadow<?=($bShowImage ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>"<?=($bOrderViewBasket ? ' data-item="'.$dataItem.'"' : '')?> itemprop="itemListElement" itemscope="" itemtype="http://schema.org/Product">
						<?if(!$bShowImage):?>
							<?=$textPart?>
						<?elseif($arParams['IMAGE_POSITION'] == 'right'):?>
							<?=$textPart?>
							<?=$imgPart?>
						<?else:?>
							<?=$imgPart?>
							<?=$textPart?>
						<?endif;?>
					</div>
				</div>
			<?endforeach;?>
			<script>
			$(document).ready(function(){
				setBasketItemsClasses();
			});
			</script>
		</div>

		<?if($arParams['DISPLAY_BOTTOM_PAGER']):?>
			<div class="pagination_nav">
				<?=$arResult['NAV_STRING']?>
			</div>
		<?endif;?>
	<?endif;?>
</div>
<?if($bHasSection):?>
	</div>
<?endif;?>
<?$frame->end();?>