<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?
$this->setFrameMode(true);
if($arResult['ITEMS']){
	foreach($arResult['ITEMS'] as $i => $arItem){
		if(!is_array($arItem['FIELDS']['PREVIEW_PICTURE'])){
			unset($arResult['ITEMS'][$i]);
		}
	}
}
?>
<?use \Bitrix\Main\Localization\Loc;?>

<?if($arResult['ITEMS']):?>
	<div class="item-views partners front blocks type_1 partners_scroll">
		<div class="maxwidth-theme">
			<div class="row">
				<div class="col-md-12">
					<?
					$qntyItems = count($arResult['ITEMS']);
					$countmd = ($qntyItems > 3 ? 4 : ($qntyItems > 2 ? 3 : ($qntyItems > 1 ? 2 : 1)));
					$countsm = ($qntyItems > 2 ? 3 : ($qntyItems > 1 ? 2 : 1));
					$colmd = ($qntyItems > 4 ? 2 : ($qntyItems > 3 ? 3 : ($qntyItems > 2 ? 4 : ($qntyItems > 1 ? 6 : 12))));
					$colsm = ($qntyItems > 4 ? 4 : ($qntyItems > 3 ? 6 : 12));

					global $arTheme;
					$slideshowSpeed = (isset($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE']) && abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE'])) ? $arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE'] : abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED'])));
					$animationSpeed = (isset($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE']) && abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE'])) ? $arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE'] : abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED'])));
					//$bAnimation = (bool)$slideshowSpeed;
					?>
					<?/*
					<?if($arParams['PAGER_SHOW_ALL']):?>
						<a class="show_all pull-right" href="<?=str_replace('#SITE'.'_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL'])?>"><span><?=(strlen($arParams['SHOW_ALL_TITLE']) ? $arParams['SHOW_ALL_TITLE'] : GetMessage('S_TO_SHOW_ALL_PARTNERS'))?></span></a>
					<?endif;?>
				
					<h2><?=($arParams["TITLE"] ? $arParams["TITLE"] : GetMessage("TITLE_BRAND"));?></h2>
					*/?>
					<?if($arParams['PAGER_SHOW_ALL']):?>
						<a class="show_all pull-right" href="<?=str_replace('#SITE'.'_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL'])?>"><span><?=(strlen($arParams['SHOW_ALL_TITLE']) ? $arParams['SHOW_ALL_TITLE'] : GetMessage('S_TO_SHOW_ALL_PARTNERS'))?></span></a>
					<?endif;?>
					<h2><?=($arParams["TITLE"] ? $arParams["TITLE"] : Loc::getMessage("TITLE_PARTNERS"));?></h2>
					
					<div class="flexslider unstyled row navigation-vcenter dark-nav" data-plugin-options='{"directionNav": true, "controlNav" :false, "animationLoop": true, <?=($bAnimation ? '"slideshow": true,' : '"slideshow": false,')?> "counts": [4, 3, 2, 1]}'>
						<ul class="slides items">
							<?foreach($arResult['ITEMS'] as $i => $arItem):?>
								<?
								// edit/add/delete buttons for edit mode
								$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
								// use detail link?
								$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
								// preview image
								$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
								$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 150, 'height' => 90), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
								$imageSrc = ($bImage ? $arImage['src'] : '');
								?>
								<li class="item col-md-2 col-sm-4">
									<div class="wrap" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
										<div class="image">
											<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?endif;?>
												<img class="img-responsive" src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" />
											<?if($bDetailLink):?></a><?endif;?>
										</div>
									</div>
								</li>
							<?endforeach;?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
<?endif;?>