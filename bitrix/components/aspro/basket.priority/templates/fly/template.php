<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$frame = $this->createFrame()->begin();
$frame->setAnimation(true);
global $arTheme;
$menu_class = (isset($arTheme['TOP_MENU']) && strlen($arTheme['TOP_MENU']['VALUE']) ? $arTheme['TOP_MENU']['VALUE'] : '');
$title_text = GetMessage("TITLE_BASKET", array("#SUMM#" => $arResult['ALL_SUM']));
if(intval($arResult['ITEMS_COUNT']) <= 0)
	$title_text = GetMessage("EMPTY_BASKET");
?>
<?$showFlyCallback = (isset($arTheme['CALLBACK']['DEPENDENT_PARAMS']) && $arTheme['CALLBACK']['DEPENDENT_PARAMS']['FLY_FORM_CALLBACK']['VALUE'] == 'Y' || $arTheme['FLY_FORM_CALLBACK'] == 'Y' ? 'Y' : 'N');?>
<?$showFlyAskQuestion = (isset($arTheme['ASK_QUESTION']['DEPENDENT_PARAMS']) && $arTheme['ASK_QUESTION']['DEPENDENT_PARAMS']['FLY_FORM_ASK_QUESTION']['VALUE'] == 'Y' || $arTheme['FLY_FORM_ASK_QUESTION'] == 'Y' ? 'Y' : 'N');?>
<?$showFlyAddReview = (isset($arTheme['ADD_REVIEW']['DEPENDENT_PARAMS']) && $arTheme['ADD_REVIEW']['DEPENDENT_PARAMS']['FLY_FORM_ADD_REVIEW']['VALUE'] == 'Y' || $arTheme['FLY_FORM_ADD_REVIEW'] == 'Y' ? 'Y' : 'N');?>
<?$showFlyMap = (isset($arTheme['MAP']['DEPENDENT_PARAMS']) && $arTheme['MAP']['DEPENDENT_PARAMS']['FLY_FORM_MAP']['VALUE'] == 'Y' || $arTheme['FLY_FORM_MAP'] == 'Y' ? 'Y' : 'N');?>

<div class="basket fly<?=(strlen($menu_class) ? ' '.$menu_class : '')?>">
	<div class="fly_forms">
		<span class="opener" title="<?=$title_text ;?>">
			<svg class="svg svg-basket" width="19" height="16" viewBox="0 0 19 16">
				<path class="cls-1" d="M956.047,952.005l-0.939,1.009-11.394-.008-0.952-1-0.953-6h-2.857a0.862,0.862,0,0,1-.952-1,1.025,1.025,0,0,1,1.164-1h2.327c0.3,0,.6.006,0.6,0.006a1.208,1.208,0,0,1,1.336.918L943.817,947h12.23L957,948v1Zm-11.916-3,0.349,2h10.007l0.593-2Zm1.863,5a3,3,0,1,1-3,3A3,3,0,0,1,945.994,954.005ZM946,958a1,1,0,1,0-1-1A1,1,0,0,0,946,958Zm7.011-4a3,3,0,1,1-3,3A3,3,0,0,1,953.011,954.005ZM953,958a1,1,0,1,0-1-1A1,1,0,0,0,953,958Z" transform="translate(-938 -944)"/>
			</svg>
		
			<span class="count<?=(intval($arResult['ITEMS_COUNT']) <= 0 ? ' empted' : '')?>"><?=$arResult['ITEMS_COUNT']?></span>
		</span>
		<?CPriority::checkShowForm($showFlyCallback, array('ICON_CLASS' => 'callback_icon', 'FORM_CODE' => 'aspro_priority_callback', 'FORM_NAME' => 'callback', 'FORM_TEXT' => GetMessage('CALLBACK_FORM_BUTTON_TEXT')));?>
		<?CPriority::checkShowForm($showFlyAskQuestion, array('ICON_CLASS' => 'question_icon', 'FORM_CODE' => 'aspro_priority_question', 'FORM_NAME' => 'question', 'FORM_TEXT' => GetMessage('ASK_QUESTION_FORM_BUTTON_TEXT')));?>
		<?CPriority::checkShowForm($showFlyAddReview, array('ICON_CLASS' => 'add_review_icon', 'FORM_CODE' => 'aspro_priority_add_review', 'FORM_NAME' => 'add_review', 'FORM_TEXT' => GetMessage('ADD_REVIEW_FORM_BUTTON_TEXT')));?>
		<?CPriority::checkShowForm($showFlyMap, array('ICON_CLASS' => 'map_icon', 'FORM_CODE' => 'map', 'FORM_NAME' => 'map', 'FORM_TEXT' => GetMessage('MAP_FORM_BUTTON_TEXT')));?>
	</div>
	<div class="wrap cont">
		<span class="jqmClose top-close"><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/close.svg');?></span>
		<div class="title">
			<?if($arResult['ITEMS']):?>
				<a class="dark-color" href="<?=$arParams['PATH_TO_BASKET'];?>"><?=GetMessage('T_BASKET_TITLE');?></a>
			<?else:?>
				<span><?=GetMessage('T_BASKET_TITLE');?></span>
			<?endif;?>
		</div>
		<?if($arResult['ITEMS']):?>
			<div class="basket_wrap">
				<div class="items_wrap">
					<div class="items">
						<?foreach($arResult['ITEMS'] as $arItem):?>
							<?
							$imageSrc = (is_array($arItem['PICTURE']) && strlen($arItem['PICTURE']['IMAGE_80']['src']) ? $arItem['PICTURE']['IMAGE_80']['src'] : SITE_TEMPLATE_PATH.'/images/svg/noimage_product.svg');
							$imageTitle = (is_array($arItem['PICTURE']) && strlen($arItem['PICTURE']['DESCRIPTION']) ? $arItem['PICTURE']['DESCRIPTION'] : $arItem['NAME']);
							$quantity = (isset($arItem['QUANTITY']) && $arItem['QUANTITY'] > 0 ? $arItem['QUANTITY'] : '');
							?>
							<div class="item" data-item='{"ID":"<?=$arItem['ID']?>"}'>
								<div class="wrap clearfix">
									<div class="image"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img class="img-responsive" src="<?=$imageSrc;?>" alt="<?=$imageTitle;?>" title="<?=$imageTitle;?>" /></a></div>
									<div class="body-info">
										<div class="description">
											<div class="name">
												<?if(isset($arResult['IBLOCK_TARIF'][$arItem['IBLOCK_ID']])):?>
													<span><?=$arItem['NAME'];?></span>
												<?else:?>
													<a class="dark-color" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME'];?></a>
												<?endif;?>
											</div>
											<div class="props">
												<?if(isset($arItem['PROPERTY_STATUS']) && strlen($arItem['PROPERTY_STATUS']['VALUE'])):?>
													<span class="status-icon <?=$arItem['PROPERTY_STATUS']['XML_ID']?>"><?=$arItem['PROPERTY_STATUS']['VALUE']?></span>
												<?endif;?>
												<?if(isset($arItem['PROPERTY_ARTICLE_VALUE']) && strlen($arItem['PROPERTY_ARTICLE_VALUE'])):?>
													<span class="article font_upper"><?=GetMessage('S_ARTICLE')?>&nbsp;<span><?=$arItem['PROPERTY_ARTICLE_VALUE']?></span></span>
												<?endif;?>
											</div>
										</div>
										<div class="bottom">
											<div class="prices">
												<?if(isset($arItem['PROPERTY_PRICE_VALUE']) && strlen($arItem['PROPERTY_PRICE_VALUE'])):?>
													<div class="price_new">
														<span class="price_val"><?=$arItem['PROPERTY_PRICE_VALUE']?></span>
													</div>
												<?endif;?>
												<?if(isset($arItem['PROPERTY_PRICEOLD_VALUE']) && strlen($arItem['PROPERTY_PRICEOLD_VALUE'])):?>
													<div class="price_old">
														<span class="price_val"><?=$arItem['PROPERTY_PRICEOLD_VALUE']?></span>
													</div>
												<?endif;?>
											</div>
											<div class="buy_block">
												<div class="counter sm">
													<div class="wrap">
														<span class="minus ctrl">
															<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/minus_little.svg')?>
														</span>
														<div class="input"><input type="text" value="<?=$quantity;?>" class="count" maxlength="5" /></div>
														<span class="plus ctrl">
															<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/plus_little.svg')?>
														</span>
														<?if(isset($arItem['SUMM']) && $arItem['SUMM'] > 0):?>
															<input type="hidden" name="PRICE" value="<?=$arItem['PROPERTY_FILTER_PRICE_VALUE']?>" />
														<?endif;?>
													</div>
												</div>
											</div>
											<div class="prices summ">
												<?if(isset($arItem['SUMM']) && $arItem['SUMM'] > 0):?>
													<div class="price_new">
														<span class="price_val"><?=$arItem['SUMM'];?></span>
													</div>
												<?endif;?>
											</div>
										</div>
										<div class="remove_bl">
											<div class="wrap">
												<span class="remove">
													<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/remove_little.svg')?>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?endforeach;?>
					</div>
				</div>
				<div class="foot">
					<span class="remove all pull-left font_upper" data-remove_all="Y">
						<span>
							<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/remove_little.svg')?>
							<?=GetMessage('T_BUTTON_REMOVE_ALL');?>
						</span>
					</span>			
					
					<?if(isset($arResult['ALL_SUM']) && strlen($arResult['ALL_SUM'])):?>
						<div class="total pull-right"><?=GetMessage('T_BASKET_TOTAL_TITLE');?>: <span><?=$arResult['ALL_SUM']?></span></div>
					<?endif;?>
					<div class="clearfix"></div>
				</div>
				<div class="buttons">
					<a class="btn btn-default pull-right btn-lg  to-order" href="<?=$arParams['PATH_TO_ORDER']?>"><?=GetMessage('T_BASKET_BUTTON_ORDER');?></a>
					<a class="btn btn-default btn-transparent pull-right btn-lg" href="<?=$arParams['PATH_TO_BASKET']?>"><?=GetMessage('T_BASKET_BUTTON_BASKET');?></a>
					<div class="clearfix"></div>
				</div>
			</div>
		<?endif;?>
		<div class="basket_empty"<?=($arResult['ITEMS'] ? ' style="display:none;"' : '')?>>
			<svg class="empty_icon" xmlns="http://www.w3.org/2000/svg" width="90" height="90" viewBox="0 0 90 90">
			  <path id="Rounded_Rectangle_961" data-name="Rounded Rectangle 961" class="clsp-1" d="M1430,241a45,45,0,1,1,45-45A45,45,0,0,1,1430,241Zm0-88a43,43,0,1,0,43,43A43,43,0,0,0,1430,153Zm17.99,35.188-3.03,11.026a1,1,0,0,1-1.17.8A0.646,0.646,0,0,0,1443,200h-23a0.945,0.945,0,0,1-.48-0.142,1.019,1.019,0,0,1-.38.136,1,1,0,0,1-1.13-.856l-3.84-18.172a1.023,1.023,0,0,1-.17.034h-7a1,1,0,0,1,0-2h7a0.982,0.982,0,0,1,.46.125,0.948,0.948,0,0,1,.38-0.139,1,1,0,0,1,1.13.855l1.3,6.159H1447A3.569,3.569,0,0,1,1447.99,188.188Zm-30.3-.188,2.13,10.037A0.819,0.819,0,0,1,1420,198h23a0.869,0.869,0,0,1,.21.043L1445.98,188h-28.29Zm5.81,15a6.5,6.5,0,1,1-6.5,6.5A6.5,6.5,0,0,1,1423.5,203Zm0,11a4.5,4.5,0,1,0-4.5-4.5A4.5,4.5,0,0,0,1423.5,214Zm16-11a6.5,6.5,0,1,1-6.5,6.5A6.5,6.5,0,0,1,1439.5,203Zm0,11a4.5,4.5,0,1,0-4.5-4.5A4.5,4.5,0,0,0,1439.5,214Z" transform="translate(-1385 -151)"/>
			  <path class="clsp-2" d="M1422,204a4,4,0,1,1-4,4A4,4,0,0,1,1422,204Zm16,0a4,4,0,1,1-4,4A4,4,0,0,1,1438,204Zm-19-8h22l2.69-9H1417Z" transform="translate(-1385 -151)"/>
			</svg>
		
			<div class="wrap">
				<h4><?=GetMessage('T_BASKET_EMPTY_TITLE');?></h4>
				<div class="description"><?=GetMessage('T_BASKET_EMPTY_DESCRIPTION');?></div>
				<div class="button"><a class="btn btn-default btn-lg" href="<?=$arParams['PATH_TO_CATALOG'];?>"><?=GetMessage('T_BASKET_BUTTON_CATALOG');?></a></div>
			</div>
		</div>
	</div>
</div>
<?$frame->end();?>