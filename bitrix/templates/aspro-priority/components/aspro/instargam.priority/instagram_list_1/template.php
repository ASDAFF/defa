<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
$this->setFrameMode(true);
//if(isset($_POST["AJAX_REQUEST_INSTAGRAM"]) && $_POST["AJAX_REQUEST_INSTAGRAM"] == "Y"):
	global $arTheme;
	$slideshowSpeed = (isset($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE']) && abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE'])) ? $arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE'] : abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED'])));
	$animationSpeed = (isset($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE']) && abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE'])) ? $arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE'] : abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED'])));
	$bAnimation = (bool)$slideshowSpeed;
	if($arResult['POSTS'] && !$arResult['POSTS']["meta"]["error_message"]):?>
		<div class="row margin0">
			<div class="instagram_ajax">
				<div class="item-views front blocks instagram_scroll">
					<div class="maxwidth-theme">
						<a class="show_all pull-right" href="https://www.instagram.com/<?=$arResult['USER']['data']['username']?>/" target="_blank" rel="nofollow"><span><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/instagram_mainpage.svg');?><?=GetMessage('SHOW_ALL');?></span></a>
						<h2><?=($arParams["TITLE"] ? $arParams["TITLE"] : GetMessage("TITLE_INSTAGRAM"));?></h2>
						<div class="instagram flexslider type_1 clearfix" data-plugin-options='{"directionNav": true, "controlNav" :false, "animationLoop": true, "slideshow": false, <?=($slideshowSpeed >= 0 ? '"slideshowSpeed": '.$slideshowSpeed.',' : '')?> <?=($animationSpeed >= 0 ? '"animationSpeed": '.$animationSpeed.',' : '')?> "counts": [4, 3, 2, 1], "itemMargin": 0}'>
							<?$index = 0;?>
							<ul class="items slides">
								<?foreach($arResult['POSTS']['data'] as $arItem):?>
									<li class="item">
										<div class="image" style="background:url(<?=$arItem['images']['standard_resolution']['url'];?>) center center/cover no-repeat;"></div>
										<div class="desc">
											<div class="wrap">
												<div class="date font_upper"><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/instagram_mainpage.svg');?><span><?=FormatDate('d F', $arItem['caption']['created_time'], 'SHORT');?></span></div>
												<?if($arItem['caption']['text']):?>
													<div class="text font_xs"><?=$arItem['caption']['text'];?></div>
												<?endif;?>
												<a href="<?=$arItem['link']?>" target="_blank" rel="nofollow"></a>
											</div>
										</div>
									</li>
									<?if ($index == 11) break;?>
									<?++$index;?>									
								<?endforeach;?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?endif;?>
<?//endif;?>