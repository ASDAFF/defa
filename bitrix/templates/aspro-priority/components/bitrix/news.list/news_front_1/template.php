<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>
	<div class="item-views news-items type_1 front greyline news_scroll">
		<div class="maxwidth-theme">
			<?
			global $arTheme;
			/*$slideshowSpeed = abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE']));
			$animationSpeed = abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE']));*/
			$bAnimation = (bool)$slideshowSpeed;
			$isNormalBlock = (isset($arParams['NORMAL_BLOCK']) && $arParams['NORMAL_BLOCK'] == 'Y');
			//$col_sm = ($arParams['NEWS_COUNT'] > 3 ? );
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
			
			<div class="items row">
				<?$index = 1;?>
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
					
					// big block
					$bBigBlock = ($index == 1 || $index == 6 ? true : false);//(isset($arItem['DISPLAY_PROPERTIES']['BIG_BLOCK']) && $arItem['DISPLAY_PROPERTIES']['BIG_BLOCK']['VALUE_XML_ID'] == 'Y' ? true : false);
					?>
					<div class="item<?=($bBigBlock ? ' big_block' : '')?><?=(!$bImage ? ' wti' : '')?> col-md-<?=($bBigBlock ? 6 : 3)?> col-sm-4 col-xs-6">
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
					</div>
					<?
					$index = ($index == 6 ? 0 : $index);
					++$index;
					?>
				<?endforeach;?>
			</div>
			<?/*if(isset($arParams['NEWS_COUNT']) && isset($arParams['MAX_COUNT_ELEMENTS_ON_PAGE']) && $arResult['COUNT_ELEMENTS'] > $arParams['NEWS_COUNT'] && $arParams['NEWS_COUNT'] < $arParams['MAX_COUNT_ELEMENTS_ON_PAGE']):?>
				<?
				$countSections = $arResult['COUNT_SECTIONS'] - $arParams['NEWS_COUNT'];*/
			if((int)$arResult['NAV_RESULT']->nEndPage > 1):?>
				<div class="ajax_btn">
					<span class="btn btn-default btn-sm btn-transparent" data-params="<?=urlencode(serialize($arParams))?>" data-template="<?=$this->__component->__template->__name?>" data-template_name="<?=$this->__component->__template->__name?>"><?=GetMessage('MORE_TEXT_AJAX')?></span>
				</div>
			<?endif?>
		</div>
	</div>
<?endif;?>