<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?$this->setFrameMode(true);?>
<?
// get element
$arItemFilter = CNextStock::GetCurrentElementFilter($arResult["VARIABLES"], $arParams);
$arElement = CNextCacheStock::CIblockElement_GetList(array("CACHE" => array("TAG" => CNextCacheStock::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "N")), $arItemFilter, false, false, array("ID", 'PREVIEW_TEXT', "IBLOCK_SECTION_ID", 'PREVIEW_PICTURE', 'DETAIL_PICTURE'));
?>
<?if(!$arElement && $arParams['SET_STATUS_404'] !== 'Y'):?>
	<div class="alert alert-warning"><?=GetMessage("ELEMENT_NOTFOUND")?></div>
<?elseif(!$arElement && $arParams['SET_STATUS_404'] === 'Y'):?>
	<?CNextStock::goto404Page();?>
<?else:?>
	<?// rss
	if($arParams['USE_RSS'] !== 'N'){
		CNextStock::ShowRSSIcon($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss']);
	}?>
	<?CNextStock::AddMeta(
		array(
			'og:description' => $arElement['PREVIEW_TEXT'],
			'og:image' => (($arElement['PREVIEW_PICTURE'] || $arElement['DETAIL_PICTURE']) ? CFile::GetPath(($arElement['PREVIEW_PICTURE'] ? $arElement['PREVIEW_PICTURE'] : $arElement['DETAIL_PICTURE'])) : false),
		)
	);?>
	<?//element?>
	<?$sViewElementTemplate = ($arParams["ELEMENT_TYPE_VIEW"] == "FROM_MODULE" ? $arTheme["NEWS_PAGE_DETAIL"]["VALUE"] : $arParams["ELEMENT_TYPE_VIEW"]);?>
	<?@include_once('page_blocks/'.$sViewElementTemplate.'.php');?>
	<?/*
	if(is_array($arElement["IBLOCK_SECTION_ID"]) && count($arElement["IBLOCK_SECTION_ID"]) > 1){
		CNextStock::CheckAdditionalChainInMultiLevel($arResult, $arParams, $arElement);
	}*/
	?>
<?endif;?>
<div style="clear:both"></div>
<div class="row">
	<div class="col-md-6 share">
		<?if($arParams["USE_SHARE"] == "Y" && $arElement):?>
			<div class="line_block">
				<?$APPLICATION->IncludeFile(SITE_DIR."include/share_buttons.php", Array(), Array("MODE" => "html", "NAME" => GetMessage('CT_BCE_CATALOG_SOC_BUTTON')));?>
			</div>
		<?endif;?>
	</div>
	<div class="col-md-6">
		<a class="back-url url-block" href="<?=$arResult['FOLDER'].$arResult['URL_TEMPLATES']['news']?>"><i class="fa fa-angle-left"></i><span><?=GetMessage('BACK_LINK')?></span></a>
	</div>
</div>