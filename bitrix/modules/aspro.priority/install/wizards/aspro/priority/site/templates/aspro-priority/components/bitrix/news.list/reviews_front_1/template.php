<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>
	<div class="item-views reviews front blocks greyline reviews_scroll">
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
						// preview image
						$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
						$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 80, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
						$imageSrc = ($bImage ? $arImage['src'] : '');
						$bLogo = false;
						
						if(!$imageSrc && strlen($arItem['FIELDS']['DETAIL_PICTURE']['SRC'])){
							$bImage = strlen($arItem['FIELDS']['DETAIL_PICTURE']['SRC']);
							$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['DETAIL_PICTURE']['ID'], array('width' => 90, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
							$imageSrc = ($bImage ? $arImage['src'] : '');
							$bLogo = ($imageSrc ? true : false);
						}
						?>
						<li class="col-md-12">
							<div class="item clearfix<?=($bImage ? '' : ' wti')?><?=($bLogo ? ' wlogo' : '')?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
								<div class="top_wrapper clearfix">
									<?if($imageSrc):?>
										<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?endif;?>
											<div class="image">
												<div class="wrap">
												<?if($imageSrc):?>
													<img class="img-responsive" src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" />
												<?endif;?>
												</div>
											</div>
										<?if($bDetailLink):?></a><?endif;?>
									<?endif;?>
									<div class="top-info">
										<div class="wrap">
											<?if(isset($arItem['DISPLAY_PROPERTIES']['POST']) && strlen($arItem['DISPLAY_PROPERTIES']['POST']['VALUE'])):?>
												<span class="font_upper"><?=$arItem['DISPLAY_PROPERTIES']['POST']['VALUE']?></span>
											<?endif?>
											<?if(isset($arItem['DISPLAY_ACTIVE_FROM']) && $arItem['DISPLAY_ACTIVE_FROM'] && isset($arItem['DISPLAY_PROPERTIES']['POST']) && strlen($arItem['DISPLAY_PROPERTIES']['POST']['VALUE'])):?>
												<span class="separator">&ndash;</span>
											<?endif;?>
											<?if(isset($arItem['DISPLAY_ACTIVE_FROM']) && $arItem['DISPLAY_ACTIVE_FROM']):?>
												<span class="date font_upper"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
											<?endif;?>
											<?if(in_array('RATING', $arParams['PROPERTY_CODE'])):?>
												<?
												$ratingValue = ($arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'] ? $arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'] : 0);
												?>
												<div class="rating_wrap pull-right clearfix">
													<div class="rating current_<?=$ratingValue?>">
														<span class="stars_current"></span>
													</div>
												</div>
											<?endif;?>
										</div>
										<div class="title">
											<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?endif;?>
											<?=$arItem['NAME'];?>
											<?if($bDetailLink):?></a><?endif;?>
										</div>
									</div>
								</div>
								
								<div class="body-info">									
									<?if(isset($arItem['DISPLAY_PROPERTIES']['RATING'])):?>
										<?
										$ratingValue = ($arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'] ? $arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'] : 0);
										?>
										<div class="rating_wrap media clearfix">
											<div class="rating current_<?=$ratingValue?>">
												<span class="stars_current"></span>
											</div>
										</div>
									<?endif;?>
									
									<div class="clearfix"></div>
									<?if(isset($arItem['DISPLAY_PROPERTIES']['MESSAGE']) && strlen($arItem['DISPLAY_PROPERTIES']['MESSAGE']['DISPLAY_VALUE'])):?>
										<div class="preview-text"><?=CPriority::truncateLengthText($arItem['DISPLAY_PROPERTIES']['MESSAGE']['DISPLAY_VALUE'], $arParams['PREVIEW_TRUNCATE_LEN']);?></div>
										<?if(strlen($arParams['PREVIEW_TRUNCATE_LEN']) && strlen($arItem['DISPLAY_PROPERTIES']['MESSAGE']['DISPLAY_VALUE']) > $arParams['PREVIEW_TRUNCATE_LEN']):?>
											<div class="link-block-more">
												<span class="btn btn-default btn-transparent btn-xs animate-load" data-event="jqm" data-param-id="<?=$arItem['ID'];?>" data-param-type="review" data-name="review"><?=Loc::getMessage('MORE');?></span>
											</div>
										<?endif;?>
									<?endif;?>
								</div>
							</div>
						</li>
					<?endforeach;?>
				</ul>
			</div>
		</div>
	</div>
<?endif;?>