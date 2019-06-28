<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?$bImage = strlen($arResult['FIELDS']['PREVIEW_PICTURE']['SRC']);
$arImage = ($bImage ? CFile::ResizeImageGet($arResult['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 70, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
$imageSrc = ($bImage ? $arImage['src'] : '');
if(!$imageSrc && strlen($arResult['FIELDS']['DETAIL_PICTURE']['SRC'])){
	$bImage = strlen($arResult['FIELDS']['DETAIL_PICTURE']['SRC']);
	$arImage = ($bImage ? CFile::ResizeImageGet($arResult['FIELDS']['DETAIL_PICTURE']['ID'], array('width' => 90, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
	$imageSrc = ($bImage ? $arImage['src'] : '');
	$bLogo = ($imageSrc ? true : false);
}
?>
<div class="popup">
	<div class="wrap">
		<span class="jqmClose top-close fa fa-close"><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/close.svg');?></span>
		<div class="review-detail">
			<div class="item-views reviews front">
				<div class="item <?=($bImage ? '' : 'wti')?><?=($bLogo ? ' wlogo' : '')?>">
					<div class="top_wrapper clearfix">
						<?if($imageSrc):?>
							<div class="image">
								<div class="wrap">
								<?if($imageSrc):?>
									<img class="img-responsive" src="<?=$imageSrc?>" alt="<?=($bImage ? $arResult['PREVIEW_PICTURE']['ALT'] : $arResult['NAME'])?>" title="<?=($bImage ? $arResult['PREVIEW_PICTURE']['TITLE'] : $arResult['NAME'])?>" />
								<?endif;?>
								</div>
							</div>
						<?endif;?>
						<div class="top-info">
							<div class="wrap">
								<?if(isset($arResult['DISPLAY_PROPERTIES']['POST']) && strlen($arResult['DISPLAY_PROPERTIES']['POST']['VALUE'])):?>
									<span class="font_upper"><?=$arResult['DISPLAY_PROPERTIES']['POST']['VALUE']?></span>
								<?endif?>
								<?if(isset($arResult['DISPLAY_ACTIVE_FROM']) && $arResult['DISPLAY_ACTIVE_FROM'] && isset($arResult['DISPLAY_PROPERTIES']['POST']) && strlen($arResult['DISPLAY_PROPERTIES']['POST']['VALUE'])):?>
									<span class="separator">&ndash;</span>
								<?endif;?>
								<?if(isset($arResult['DISPLAY_ACTIVE_FROM']) && $arResult['DISPLAY_ACTIVE_FROM']):?>
									<span class="date font_upper"><?=$arResult['DISPLAY_ACTIVE_FROM']?></span>
								<?endif;?>
							</div>
							<div class="title"><?=$arResult['NAME'];?></div>
						</div>
					</div>
					<?//if(in_array('RATING', $arParams['PROPERTY_CODE'])):?>
						<?
						$ratingValue = ($arResult['PROPERTIES']['RATING']['VALUE'] ? $arResult['PROPERTIES']['RATING']['VALUE'] : 0);
						?>
						<div class="rating_wrap clearfix">
							<div class="wrap">
								<div class="rating current_<?=$ratingValue?>">
									<span class="stars_current"></span>
								</div>
							</div>
						</div>
					<?//endif;?>
					<div class="bottom-block">
						<?if($arResult["PROPERTIES"]['MESSAGE']['VALUE'] && strlen($arResult["PROPERTIES"]['MESSAGE']['VALUE']['TEXT'])):?>
							<div class="preview-text"><?=$arResult["PROPERTIES"]['MESSAGE']['~VALUE']['TEXT'];?></div>
						<?endif;?>
						<div class="close-block">
							<span class="btn btn-default btn-lg jqmClose"><?=Loc::getMessage('CLOSE');?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>