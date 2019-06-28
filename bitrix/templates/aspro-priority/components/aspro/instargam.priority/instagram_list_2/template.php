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
				<div class="item-views front blocks padding0 instagram_scroll">
					<div class="instagram type_2 clearfix">
						<div class="container">
							<?$index = 0;?>
							<div class="items flexbox">
								<?foreach($arResult['POSTS']['data'] as $arItem):?>
									<div class="item">
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
									</div>
									<?if ($index == 5) break;?>
									<?++$index;?>
								<?endforeach;?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /noindex -->
	<?endif;?>
<?//endif;?>