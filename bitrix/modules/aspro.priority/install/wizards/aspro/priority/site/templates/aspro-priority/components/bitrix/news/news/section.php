<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?// intro text?>
<div class="text_before_items"><!--
	--><?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "page",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => ""
		)
	);?><!--
--></div>
<?
global $arRegion, $arTheme;
$arItemFilter = CPriority::GetIBlockAllElementsFilter($arParams);
if($arRegion && $arTheme['USE_REGIONALITY']['DEPENDENT_PARAMS']['REGIONALITY_FILTER_ITEM']['VALUE'] == 'Y'){
	$arItemFilter['PROPERTY_LINK_REGION'] = $arRegion['ID'];
}
$arItemFilter['SECTION_ID'] = $arResult['VARIABLES']['SECTION_ID'];
if($arParams['CACHE_GROUPS'] == 'Y')
{
	$arItemFilter['CHECK_PERMISSIONS'] = 'Y';
	$arItemFilter['GROUPS'] = $GLOBALS["USER"]->GetGroups();
}

$arGlobalFilter = ($arParams['FILTER_NAME'] ? $GLOBALS[$arParams['FILTER_NAME']] : '');
if(!is_array($arGlobalFilter))
	$arGlobalFilter = array();

$arItems = CCache::CIBLockElement_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']))), $arItemFilter, false, false, array('ID', 'NAME', 'ACTIVE_FROM'));

$itemsCnt = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());?>
<div class="maxwidth-theme">
	<?CPriority::get_banners_position('CONTENT_TOP');?>
</div>
<?if(!$itemsCnt):?>
	<div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div>
<?else:?>
	<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>
	<?// rss
	if($arParams['USE_RSS'] !== 'N')
		CPriority::ShowRSSIcon($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss']);
	?>
	<?global $arTheme, $isMenu;?>

	<?//$arItems = CCache::CIBLockElement_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']))), array_merge(array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y'), $arGlobalFilter), false, false, array('ID', 'NAME', 'ACTIVE_FROM'));?>
	<?// section elements?>
	<?$sViewElementsTemplate = ($arParams["SECTION_ELEMENTS_TYPE_VIEW"] == "FROM_MODULE" ? $arTheme["NEWS_PAGE"]["VALUE"] : $arParams["SECTION_ELEMENTS_TYPE_VIEW"]);?>
	<?@include_once('page_blocks/'.$sViewElementsTemplate.'.php');?>
<?endif;?>
<div class="maxwidth-theme">
	<?CPriority::get_banners_position('CONTENT_BOTTOM');?>
</div>