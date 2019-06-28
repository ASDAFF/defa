<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->setFrameMode(true);
//if(isset($_POST["AJAX_REQUEST_INSTAGRAM"]) && $_POST["AJAX_REQUEST_INSTAGRAM"] == "Y"):
	if($arResult['POSTS'] && !$arResult['POSTS']["meta"]["error_message"]):?>
		<!-- noindex -->
		<div class="row margin0">
			<div class="instagram_ajax">
				<div class="item-views front blocks instagram_scroll">
					<div class="maxwidth-theme">
						<a class="show_all pull-right" href="https://www.instagram.com/<?=$arResult['USER']['data']['username']?>/" target="_blank" rel="nofollow"><span><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/instagram_mainpage.svg');?><?=GetMessage('SHOW_ALL');?></span></a>
						<h2><?=($arParams["TITLE"] ? $arParams["TITLE"] : GetMessage("TITLE_INSTAGRAM"));?></h2>
						<div class="instagram type_3 clearfix">
							<?$index = 0;?>
							<div class="items clearfix">
								<div class="left_item">
									<div class="item">
										<div class="image" style="background:url(<?=$arResult['POSTS']['data'][0]['images']['standard_resolution']['url'];?>) center center/cover no-repeat;"><a href="<?=$arItem['link']?>" target="_blank" rel="nofollow"></a></div>
										<div class="desc">
											<div class="wrap">
												<div class="date font_upper"><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/instagram_mainpage.svg');?><span><?=FormatDate('d F', $arResult['POSTS']['data'][0]['created_time'], 'SHORT');?></span></div>
												<?if($arResult['POSTS']['data'][0]['caption']['text']):?>
													<div class="text font_xs"><?=$arResult['POSTS']['data'][0]['caption']['text'];?></div>
												<?endif;?>
												<a href="<?=$arResult['POSTS']['data'][0]['link']?>" target="_blank" rel="nofollow"></a>												
											</div>
										</div>
									</div>
								</div>
								<div class="right_items_1">
									<?foreach($arResult['POSTS']['data'] as $key => $arItem):?>
										<?
										if($key == 0){
											continue;
										}
										?>
										<div class="item item_<?=$key;?>">
											<div class="image" style="background:url(<?=$arItem['images']['standard_resolution']['url'];?>) center center/cover no-repeat;"><a href="<?=$arItem['link']?>" target="_blank" rel="nofollow"></a></div>
											<div class="desc">
												<div class="wrap">
													<div class="date font_upper"><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/instagram_mainpage.svg');?><span><?=FormatDate('d F', $arItem['caption']['created_time'], 'SHORT');?></span></div>
													<?if($arItem['caption']['text']):?>
														<div class="text font_xs"><?=$arItem['caption']['text'];?></div>
													<?endif;?>
													<a href="<?=$arItem['link']?>" target="_blank" rel="nofollow"></a>
												</div>
											</div>
										</div>
										<?if($index == 1) break;?>
										<?++$index;?>
									<?endforeach;?>
								</div>
								<div class="right_items_2">
									<?foreach($arResult['POSTS']['data'] as $key => $arItem):?>
										<?
										if($key <= 2){
											continue;
										}
										?>
										<div class="item item_<?=$key;?>">
											<div class="image" style="background:url(<?=$arItem['images']['standard_resolution']['url'];?>) center center/cover no-repeat;"><a href="<?=$arItem['link']?>" target="_blank" rel="nofollow"></a></div>
											<div class="desc">
												<div class="wrap">
													<div class="date font_upper"><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/instagram_mainpage.svg');?><span><?=FormatDate('d F', $arItem['caption']['created_time'], 'SHORT');?></span></div>
													<?if($arItem['caption']['text']):?>
														<div class="text font_xs"><?=$arItem['caption']['text'];?></div>
													<?endif;?>
													<a href="<?=$arItem['link']?>" target="_blank" rel="nofollow"></a>
												</div>
											</div>
										</div>
										<?if($index == 4) break;?>
										<?++$index;?>
									<?endforeach;?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /noindex -->
	<?endif;?>
<?//endif;?>