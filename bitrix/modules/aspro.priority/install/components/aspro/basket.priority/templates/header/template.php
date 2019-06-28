<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$frame = $this->createFrame()->begin();
$frame->setAnimation(true);

$bItems = ($arResult['ITEMS_COUNT'] > 0 ? true : false);

$title_text = GetMessage("TITLE_BASKET", array("#SUMM#" => $arResult['ALL_SUM']));
if(intval($arResult['ITEMS_COUNT']) <= 0)
	$title_text = GetMessage("EMPTY_BASKET");
?>
<div class="basket_top sep<?=(intval($arResult['ITEMS_COUNT']) <= 0 ? ' empted_cart' : '')?>">
	<div class="b_wrap">
		<a href="<?=$arParams['PATH_TO_BASKET']?>" class="icon" title="<?=$title_text;?>" data-summ="<?=$arResult['ALL_SUM'];?>"><span class="count<?=(intval($arResult['ITEMS_COUNT']) <= 0 ? ' empted' : '')?>"><?=($bItems ? $arResult['ITEMS_COUNT'] : '0')?></span></a>
	</div>
	<div class="dropdown">
		<?if($bItems):?>
			<div class="items">
				<?foreach($arResult['ITEMS'] as $arItem):?>
					<?
					$imageSrc = (is_array($arItem['PICTURE']) && strlen($arItem['PICTURE']['IMAGE_80']['src']) ? $arItem['PICTURE']['IMAGE_80']['src'] : SITE_TEMPLATE_PATH.'/images/svg/noimage_product.svg');
					$imageTitle = (is_array($arItem['PICTURE']) && strlen($arItem['PICTURE']['DESCRIPTION']) ? $arItem['PICTURE']['DESCRIPTION'] : $arItem['NAME']);
					$quantity = (isset($arItem['QUANTITY']) && $arItem['QUANTITY'] > 0 ? $arItem['QUANTITY'] : '');
					?>
					<div class="item clearfix" id="<?=$this->GetEditAreaId($arItem['ID'])?>" data-item='{"ID":"<?=$arItem['ID']?>"}'>
						<div class="image"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img class="img-responsive" src="<?=$imageSrc;?>" alt="<?=$imageTitle;?>" title="<?=$imageTitle;?>" /></a></div>
						<div class="body-info">
							<div class="title">
								<?if(isset($arResult['IBLOCK_TARIF'][$arItem['IBLOCK_ID']])):?>
									<span><?=$arItem['NAME'];?></span>
								<?else:?>
									<a class="dark-color" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME'];?></a>
								<?endif;?>
							</div>
							<?if(strlen($arItem['PROPERTY_ARTICLE_VALUE']) || strlen($arItem['PROPERTY_STATUS']['VALUE'])):?>
								<div class="medium">
									<?if(strlen($arItem['PROPERTY_STATUS']['VALUE'])):?>
										<span class="status-icon <?=$arItem['PROPERTY_STATUS']['XML_ID'];?>"><?=$arItem['PROPERTY_STATUS']['VALUE'];?></span>
									<?endif;?>
									<?if(strlen($arItem['PROPERTY_ARTICLE_VALUE'])):?>
										<span class="article font_upper"><?=GetMessage('S_ARTICLE')?>&nbsp;<span><?=$arItem['PROPERTY_ARTICLE_VALUE']?></span></span>
									<?endif;?>
								</div>
							<?endif;?>
							<div class="bottom">
								<?if(strlen($arItem['PROPERTY_PRICE_VALUE']) || strlen($arItem['PROPERTY_PRICEOLD_VALUE'])):?>
									<div class="prices">
										<?if(strlen($arItem['PROPERTY_PRICE_VALUE'])):?>
											<div class="price_new"><div><?=$arItem['PROPERTY_PRICE_VALUE']?></div></div>
										<?endif;?>
										<?if(strlen($arItem['PROPERTY_PRICEOLD_VALUE'])):?>
											<div class="price_old"><div><?=$arItem['PROPERTY_PRICEOLD_VALUE'];?></div></div>
										<?endif;?>
									</div>
								<?endif;?>
								<div class="buy_block">
									<div class="counter sm">
										<div class="wrap">
											<span class="minus ctrl">
												<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/minus_little.svg')?>
											</span>
											<div class="input"><input name="" type="text" value="<?=$quantity;?>" class="count" maxlength="5" /></div>
											<span class="plus ctrl">
												<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/plus_little.svg')?>
											</span>
											<?if(isset($arItem['SUMM']) && $arItem['SUMM'] > 0):?>
												<input type="hidden" name="PRICE" value="<?=$arItem['PROPERTY_FILTER_PRICE_VALUE']?>" />
											<?endif;?>
										</div>
									</div>
								</div>
								<?if(strlen($arItem['SUMM'])):?>
									<div class="summ pull-right text-right"><span class="price_val"><?=$arItem['SUMM']?></span></div>
								<?endif;?>
							</div>
							<span class="remove">
								<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/remove_little.svg')?>
							</span>
						</div>
					</div>
				<?endforeach;?>
			</div>
			<div class="total_wrap clearfix">
				<span class="remove all pull-left font_upper" data-remove_all="Y">
					<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/remove_little.svg')?>
					<span><?=GetMessage('T_BUTTON_REMOVE_ALL');?></span>
				</span>			
				<?if(isset($arResult['ALL_SUM']) && strlen($arResult['ALL_SUM'])):?>
					<div class="total pull-right"><?=GetMessage('T_BASKET_TOTAL_TITLE');?>: <span><?=$arResult['ALL_SUM']?></span></div>
				<?endif;?>
			</div>
			<div class="buttons clearfix">
				<a class="btn btn-default btn-lg pull-right" href="<?=$arParams['PATH_TO_ORDER']?>"><?=GetMessage('PATH_TO_ORDER_TITLE');?></a>
				<a class="btn btn-default btn-transparent btn-lg pull-left btn-order" href="<?=$arParams['PATH_TO_BASKET']?>"><?=GetMessage('PATH_TO_BASKET_TITLE');?></a>
			</div>
		<?endif;?>
	</div>
	<div class="dropdown">
		<div class="basket_empty"<?=($arResult['ITEMS'] ? ' style="display:none;"' : '')?>>
			<svg class="empty_icon" xmlns="http://www.w3.org/2000/svg" width="90" height="90" viewBox="0 0 90 90">
			  <path id="Rounded_Rectangle_961" data-name="Rounded Rectangle 961" class="clsp-1" d="M1430,241a45,45,0,1,1,45-45A45,45,0,0,1,1430,241Zm0-88a43,43,0,1,0,43,43A43,43,0,0,0,1430,153Zm17.99,35.188-3.03,11.026a1,1,0,0,1-1.17.8A0.646,0.646,0,0,0,1443,200h-23a0.945,0.945,0,0,1-.48-0.142,1.019,1.019,0,0,1-.38.136,1,1,0,0,1-1.13-.856l-3.84-18.172a1.023,1.023,0,0,1-.17.034h-7a1,1,0,0,1,0-2h7a0.982,0.982,0,0,1,.46.125,0.948,0.948,0,0,1,.38-0.139,1,1,0,0,1,1.13.855l1.3,6.159H1447A3.569,3.569,0,0,1,1447.99,188.188Zm-30.3-.188,2.13,10.037A0.819,0.819,0,0,1,1420,198h23a0.869,0.869,0,0,1,.21.043L1445.98,188h-28.29Zm5.81,15a6.5,6.5,0,1,1-6.5,6.5A6.5,6.5,0,0,1,1423.5,203Zm0,11a4.5,4.5,0,1,0-4.5-4.5A4.5,4.5,0,0,0,1423.5,214Zm16-11a6.5,6.5,0,1,1-6.5,6.5A6.5,6.5,0,0,1,1439.5,203Zm0,11a4.5,4.5,0,1,0-4.5-4.5A4.5,4.5,0,0,0,1439.5,214Z" transform="translate(-1385 -151)"/>
			  <path class="clsp-2" d="M1422,204a4,4,0,1,1-4,4A4,4,0,0,1,1422,204Zm16,0a4,4,0,1,1-4,4A4,4,0,0,1,1438,204Zm-19-8h22l2.69-9H1417Z" transform="translate(-1385 -151)"/>
			</svg>
		
			<div class="wrap">
				<h4><?=GetMessage('T_BASKET_EMPTY_TITLE');?></h4>
				<div class="description"><?=GetMessage('T_BASKET_EMPTY_DESCRIPTION');?></div>
			</div>
			<div class="button"><a class="btn btn-default btn-lg" href="<?=$arParams['PATH_TO_CATALOG'];?>"><?=GetMessage('T_BASKET_BUTTON_CATALOG');?></a></div>
		</div>
	</div>
</div>
<?$frame->end();?>