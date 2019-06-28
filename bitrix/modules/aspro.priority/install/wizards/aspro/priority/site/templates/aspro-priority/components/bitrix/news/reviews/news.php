<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?$this->setFrameMode(true);?>
<?// intro text?>
<div class="text_before_items">
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"PATH" => SITE_DIR."include/reviews.php",
			"EDIT_TEMPLATE" => ""
		)
	);?>
</div>
<?
$arItemFilter = CPriority::GetIBlockAllElementsFilter($arParams);
$itemsCnt = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());
?>
<?if(!$itemsCnt):?>
	<div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div>
<?endif;?>
<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>

<?global $arTheme;?>
<?// section elements?>
<?$sViewElementsTemplate = ($arParams["SECTION_ELEMENTS_TYPE_VIEW"] == "FROM_MODULE" ? $arTheme["REVIEWS_PAGE"]["VALUE"] : $arParams["SECTION_ELEMENTS_TYPE_VIEW"]);?>

<?@include_once('page_blocks/'.$sViewElementsTemplate.'.php');?>