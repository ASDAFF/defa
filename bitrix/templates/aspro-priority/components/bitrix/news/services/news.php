<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?$this->setFrameMode(true);?>
<?// intro text?>
<?
// get section items count and subsections
global $arTheme, $arRegion;
$arItemFilter = CPriority::GetCurrentSectionElementFilter($arResult["VARIABLES"], $arParams, false);
$arSubSectionFilter = CPriority::GetCurrentSectionSubSectionFilter($arResult["VARIABLES"], $arParams, false);
$itemsCnt = CCache::CIBlockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());

$arSubSections = CCache::CIBlockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "Y")), $arSubSectionFilter, false, array("ID"));
$sViewElementsTemplate = ($arParams["SECTIONS_TYPE_VIEW"] == "FROM_MODULE" ? $arTheme['SERVICES_SECTIONS_TYPE_VIEW']['VALUE'] : $arParams["SECTIONS_TYPE_VIEW"]);
// rss
if($arParams['USE_RSS'] !== 'N'){
	CPriority::ShowRSSIcon($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss']);
}
?>

<?if(!$itemsCnt && !$arSubSections):?>
	<div class="maxwidth-theme"><div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div></div>
<?else:?>
	<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>
	<?// sections?>
	<?if($arSubSections):?>
		<?@include_once('page_blocks/'.$sViewElementsTemplate.'.php');?>
	<?endif;?>
	
	<?// section elements?>
	<?if(!$arSubSections && $itemsCnt):?>
		<?if(strlen($arParams["FILTER_NAME"])):?>
			<?$GLOBALS[$arParams["FILTER_NAME"]] = array_merge((array)$GLOBALS[$arParams["FILTER_NAME"]], $arItemFilter);?>
		<?else:?>
			<?$arParams["FILTER_NAME"] = "arrFilter";?>
			<?$GLOBALS[$arParams["FILTER_NAME"]] = $arItemFilter;?>
		<?endif;?>
		<?$sViewElementTemplate = ($arParams["SECTION_ELEMENTS_TYPE_VIEW"] == "FROM_MODULE" ? $arTheme["SERVICES_SECTION_ELEMENTS_TYPE_VIEW"]["VALUE"] : $arParams["SECTION_ELEMENTS_TYPE_VIEW"]);?>
		<?if($arSubSections):?>
			<div class="element_with_sections">
		<?endif;?>
		<?@include_once('page_blocks/'.$sViewElementTemplate.'.php');?>
	<?endif;?>
	<?if($arSubSections):?>
		</div>
	<?endif;?>
<?endif;?>