<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?
// geting section items count and section [ID, NAME]
$arItemFilter = CNextStock::GetCurrentSectionElementFilter($arResult["VARIABLES"], $arParams);
$arSectionFilter = CNextStock::GetCurrentSectionFilter($arResult["VARIABLES"], $arParams);
$itemsCnt = CNextCacheStock::CIblockElement_GetList(array("CACHE" => array("TAG" => CNextCacheStock::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());
$arSection = CNextCacheStock::CIblockSection_GetList(array("CACHE" => array("TAG" => CNextCacheStock::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "N")), $arSectionFilter, false, array('ID', 'DESCRIPTION', 'PICTURE', 'DETAIL_PICTURE'), true);
CNextStock::AddMeta(
	array(
		'og:description' => $arSection['DESCRIPTION'],
		'og:image' => (($arSection['PICTURE'] || $arSection['DETAIL_PICTURE']) ? CFile::GetPath(($arSection['PICTURE'] ? $arSection['PICTURE'] : $arSection['DETAIL_PICTURE'])) : false),
	)
);
?>
<?if(!$arSection && $arParams['SET_STATUS_404'] !== 'Y'):?>
	<div class="alert alert-warning"><?=GetMessage("SECTION_NOTFOUND")?></div>
<?elseif(!$arSection && $arParams['SET_STATUS_404'] === 'Y'):?>
	<?CNextStock::goto404Page();?>
<?else:?>
	<?// rss
	if($arParams['USE_RSS'] !== 'N'){
		CNextStock::ShowRSSIcon(CComponentEngine::makePathFromTemplate($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss_section'], array_map('urlencode', $arResult['VARIABLES'])));
	}?>
	<?if(!$itemsCnt):?>
		<div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div>
	<?endif;?>
	<?@include_once('page_blocks/'.$arParams["SECTION_ELEMENTS_TYPE_VIEW"].'.php');?>	
<?endif;?>