<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>
	<div class="item-views news-items type_1 type_2 front greyline news_scroll">
		<div class="maxwidth-theme">
			<?
			global $arTheme;
			$slideshowSpeed = (isset($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE']) && abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE'])) ? $arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE'] : abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED'])));
			$animationSpeed = (isset($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE']) && abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE'])) ? $arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE'] : abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED'])));
			$bAnimation = (bool)$slideshowSpeed;
			?>
			<div class="top_block clearfix">
				<?if($arParams['PAGER_SHOW_ALL']):?>
					<a class="show_all pull-right" href="<?=str_replace('#SITE'.'_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL'])?>"><span><?=(strlen($arParams['SHOW_ALL_TITLE']) ? $arParams['SHOW_ALL_TITLE'] : Loc::getMessage('S_TO_SHOW_ALL_NEWS'))?></span></a>
				<?endif;?>
				<div class="pull-left">
					<h2><?=($arParams["TITLE"] ? $arParams["TITLE"] : Loc::getMessage("TITLE_NEWS"));?></h2>
				</div>
				<span class="subscribe font_upper pull-left"  data-event="jqm" data-param-id="subscribe" data-param-type="subscribe" data-name="subscribe">
					<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/subscribe.svg')?>
					<?=Loc::getMessage('SUBSCRIBE_NEWS');?>
				</span>
			</div>
			
			<div class="flexslider unstyled row front dark-nav view-control navigation-vcenter" data-plugin-options='{"directionNav": true, "controlNav" :false, "animationLoop": true, "slideshow": false, <?=($slideshowSpeed >= 0 ? '"slideshowSpeed": '.$slideshowSpeed.',' : '')?> <?=($animationSpeed >= 0 ? '"animationSpeed": '.$animationSpeed.',' : '')?> "counts": [4, 3, 2, 1], "itemMargin": 32}'>
				<ul class="items slides">
					<?foreach($arResult['ITEMS'] as $i => $arItem):?>
						<?
						// edit/add/delete buttons for edit mode
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						// use detail link?
						$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
						// preview image
						$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
						$imageSrc = ($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['SRC'] : '');

						// show active date period
						$bActiveDate = strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']) || ($arItem['DISPLAY_ACTIVE_FROM'] && in_array('DATE_ACTIVE_FROM', $arParams['FIELD_CODE']));
						?>
						<li class="item<?=(!$bImage ? ' wti' : '')?> col-md-3 col-sm-4 col-xs-6">
							<div class="wrap shadow border clearfix" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
								<?if($imageSrc):?>
									<div class="image<?=($bImage ? "" : " wti" );?>">
										<div class="wrap">
											<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?endif;?>
												<img class="img-responsive" src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" />
											<?if($bDetailLink):?></a><?endif;?>
										</div>
									</div>
								<?endif;?>
								<div class="body-info">
									<div class="wrap">
										<?// section title?>
										<?if(strlen($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME']) && !((isset($arItem['SOCIAL_PROPS']) && $arItem['SOCIAL_PROPS']))):?>
											<div class="section_name"><?=$arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME']?></div>
										<?endif;?>
									
										<?// element name?>
										<?if(strlen($arItem['FIELDS']['NAME'])):?>
											<div class="title font_md">
												<?if($bDetailLink):?><a class="dark-color" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?endif;?>
													<?=$arItem['NAME']?>
												<?if($bDetailLink):?></a><?endif;?>
											</div>
										<?endif;?>

										<?// element preview text?>
										<?if(strlen($arItem['FIELDS']['PREVIEW_TEXT']) && !$bImage):?>
											<div class="previewtext">
												<?if($arItem['PREVIEW_TEXT_TYPE'] == 'text'):?>
													<p><?=$arItem['FIELDS']['PREVIEW_TEXT']?></p>
												<?else:?>
													<?=$arItem['FIELDS']['PREVIEW_TEXT']?>
												<?endif;?>
											</div>
										<?endif;?>

										<?// date active period?>
										<?if($bActiveDate):?>
											<div class="period">
												<?if(strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE'])):?>
													<span class="date font_xs"><?=$arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']?></span>
												<?else:?>
													<span class="date font_xs"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
												<?endif;?>
											</div>
										<?endif;?>
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