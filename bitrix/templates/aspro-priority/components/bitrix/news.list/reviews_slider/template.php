<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>
	<?
	$qntyItems = count($arResult['ITEMS']);

	global $arTheme;
	$slideshowSpeed = abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE']));
	$animationSpeed = abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE']));
	$bAnimation = (bool)$slideshowSpeed;
	?>
	<div class="item-views table-type-block reviews linked">
		<div class="flexslider navigation-vcenter unstyled row" data-plugin-options='{"useCSS": true, "directionNav": true, "controlNav" :true, "animationLoop": true, "slideshow": false, <?=($slideshowSpeed >= 0 ? '"slideshowSpeed": '.$slideshowSpeed.',' : '')?> <?=($animationSpeed >= 0 ? '"animationSpeed": '.$animationSpeed.',' : '')?> "counts": [1, 1, 1], "customGrid": true, "smoothHeight": true}'>
			<ul class="slides items" data-slice="Y">
				<?foreach($arResult['ITEMS'] as $i => $arItem):?>
					<?
					// edit/add/delete buttons for edit mode
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					// use detail link?
					$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
					// preview image
					$bImage = (isset($arItem['FIELDS']['PREVIEW_PICTURE']) && strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']));
					$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 150, 'height' => 150), BX_RESIZE_IMAGE_EXACT, true) : array());
					$imageSrc = ($bImage ? $arImage['src'] : '');
					$bMoreText = (strlen($arItem['~PREVIEW_TEXT']) > $arParams['PREVIEW_TRUNCATE_LEN'] ? Loc::getMessage('MORE_REVIEWS') : '');
					?>

					<li class="col-md-12">
						<div class="item shadow1" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<div class="wrap">
								<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?endif;?>
									<?if($imageSrc):?>
										<div class="image<?=($bImage ? '' : ' wpi')?>">
											<div class="image-wrapper">
												<div class="image-inner">
													<img class="img-responsive" src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" />
												</div>
											</div>
										</div>
									<?endif;?>
								<?if($bDetailLink):?></a><?endif;?>
								<?if(isset($arItem['FIELDS']['DATE_ACTIVE_FROM']) && strlen($arItem['DISPLAY_ACTIVE_FROM'])):?>
									<div class="date twosmallfont"><?=$arItem['DISPLAY_ACTIVE_FROM']?></div>
								<?endif?>
								<div class="title">
									<?if($bDetailLink):?>
										<a class="dark_link" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
									<?else:?>
										<span><?=$arItem['NAME']?></span>
									<?endif?>
								</div>

								<?if(strlen($arItem['FIELDS']['PREVIEW_TEXT'])):?>
									<div class="preview-text">
										<?if($arItem['PREVIEW_TEXT_TYPE'] == 'text'):?>
											<p><?=$arItem['FIELDS']['PREVIEW_TEXT'];?></p>
										<?else:?>
											<?=$arItem['FIELDS']['PREVIEW_TEXT'];?>
										<?endif;?>
									</div>
									
									<div class="button">
										<div class="link-block-more">
											<span class="btn btn-default white animate-load<?=($bMoreText ? '' : ' arrow')?>" data-event="jqm" data-param-id="<?=$arItem['ID'];?>" data-param-type="review" data-name="review"><?=($bMoreText ? Loc::getMessage('MORE_REVIEWS') : '')?></span>
										</div>
									</div>
								<?endif;?>
							</div>
						</div>
					</li>
				<?endforeach;?>
			</ul>
		</div>
	</div>
<?endif;?>