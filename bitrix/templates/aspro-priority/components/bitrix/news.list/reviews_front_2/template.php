<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>
	<?
	$bRating = (in_array('RATING', $arParams['PROPERTY_CODE']) ? true : false);
	?>

	<div class="item-views greyline reviews_items front_items reviews_scroll">
		<div class="maxwidth-theme">
			<?
			$qntyItems = count($arResult['ITEMS']);

			global $arTheme;
			$slideshowSpeed = (isset($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE']) && $arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE'] ? abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE'])) : abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED'])));
			$animationSpeed = (isset($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE']) && $arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE'] ? abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE'])) : abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED'])));
			$bAnimation = (bool)$slideshowSpeed;
			?>
			<?if($arParams['PAGER_SHOW_ALL']):?>
				<a class="show_all pull-right" href="<?=str_replace('#SITE'.'_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL'])?>"><span><?=(strlen($arParams['SHOW_ALL_TITLE']) ? $arParams['SHOW_ALL_TITLE'] : GetMessage('S_TO_SHOW_ALL_REVIEWS'))?></span></a>
			<?endif;?>
			<h2><?=($arParams["TITLE"] ? $arParams["TITLE"] : Loc::getMessage("TITLE_REVIEWS"));?></h2>
			<div class="flexslider unstyled row navigation-vcenter dark-nav wsmooth" data-plugin-options='{"smoothHeight": true, "directionNav": true, "controlNav" :false, "animationLoop": true, "slideshow": false, <?=($slideshowSpeed >= 0 ? '"slideshowSpeed": '.$slideshowSpeed.',' : '')?> <?=($animationSpeed >= 0 ? '"animationSpeed": '.$animationSpeed.',' : '')?> "counts": [1, 1, 1]}'>
				<ul class="slides items">
					<?foreach($arResult['ITEMS'] as $i => $arItem):?>
						<?
						// edit/add/delete buttons for edit mode
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						// use detail link?
						$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
						$name = (isset($arItem['DISPLAY_PROPERTIES']['NAME']) && strlen($arItem['DISPLAY_PROPERTIES']['NAME']['VALUE']) ? $arItem['DISPLAY_PROPERTIES']['NAME']['VALUE'] : '');
						$post = (isset($arItem['DISPLAY_PROPERTIES']['POST']) && strlen($arItem['DISPLAY_PROPERTIES']['POST']['VALUE']) ? $arItem['DISPLAY_PROPERTIES']['POST']['VALUE'] : '');
						$review = (isset($arItem['DISPLAY_PROPERTIES']['MESSAGE']) && strlen($arItem['DISPLAY_PROPERTIES']['MESSAGE']['VALUE']['TEXT']) ? CPriority::truncateLengthText($arItem['DISPLAY_PROPERTIES']['MESSAGE']['~VALUE']['TEXT'], $arParams['PREVIEW_TRUNCATE_LEN']) : '');
						$bLogo = false;						
						
						// preview image
						$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
						$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 80, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
						$imageSrc = ($bImage ? $arImage['src'] : '');
						
						if(!$imageSrc && strlen($arItem['FIELDS']['DETAIL_PICTURE']['SRC'])){
							$bImage = strlen($arItem['FIELDS']['DETAIL_PICTURE']['SRC']);
							$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['DETAIL_PICTURE']['ID'], array('width' => 90, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
							$imageSrc = ($bImage ? $arImage['src'] : '');
							$bLogo = ($imageSrc ? true : false);
						}
						?>
						<li class="col-md-12">
							<div class="item   clearfix<?=($bImage ? '' : ' wti')?><?=($bLogo ? ' wlogo' : '')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
								<div class="question clearfix">
									<div class="right_block pull-right clearfix">
										<?if($bImage && $arImage['src']):?>
											<div class="image  <?=($bImage ? '' : 'wpi')?>">
												<img src="<?=$arImage['src']?>" alt="<?=( $arItem['PREVIEW_PICTURE']['ALT'] ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PREVIEW_PICTURE']['TITLE'] ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive" />
											</div>
										<?endif;?>
										<div class="body-info">
											<?if($post):?>
												<div class="post font_upper"><?=$post?></div>
											<?endif;?>
											
											<div class="title-wrapper<?=($bRating ? ' wrating' : '')?> <?=($bHasSocProps ? 'bottom-props' : '');?>">
												<?if($name):?>
													<div class="title"><?=$name?></div>
												<?endif?>
											</div>
										</div>
									</div>
									<div class="left_block">
										<div class="body-info">
											<div class="top-wrapper">
												<?if($bRating):?>
													<?
													$ratingValue = ($arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'] ? $arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'] : 0);
													?>
													<div class="rating_wrap clearfix">
														<div class="rating current_<?=$ratingValue?>" title="<?=GetMessage('RATING_MESSAGE_'.$ratingValue)?>">
															<span class="stars_current "></span>
														</div>
													</div>
												<?endif?>
												<?if(isset($arItem['DISPLAY_ACTIVE_FROM']) && strlen($arItem['DISPLAY_ACTIVE_FROM'])):?>
													<div class="date font_xs"><?=$arItem['DISPLAY_ACTIVE_FROM'];?></div>
												<?endif;?>
											</div>
											<?if($review):?>
												<div class="text"><?=$review?></div>
											<?endif;?>
											<?if(strlen($arParams['PREVIEW_TRUNCATE_LEN']) && strlen($arItem['DISPLAY_PROPERTIES']['MESSAGE']['DISPLAY_VALUE']) > $arParams['PREVIEW_TRUNCATE_LEN']):?>
												<div class="link-block-more">
													<span class="btn btn-default btn-transparent btn-xs animate-load" data-event="jqm" data-param-id="<?=$arItem['ID'];?>" data-param-type="review" data-name="review"><?=Loc::getMessage('MORE');?></span>
												</div>
											<?endif;?>
										</div>
									</div>
								</div>
							</div>
						</li>
					<?endforeach;?>
				</ul>
			</div>
		</div>
	</div>
<?endif;?>