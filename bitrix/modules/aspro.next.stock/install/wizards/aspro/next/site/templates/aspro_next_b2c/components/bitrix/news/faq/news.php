<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?
$arItemFilter = CNextStock::GetIBlockAllElementsFilter($arParams);
$itemsCnt = CNextCacheStock::CIblockElement_GetList(array("CACHE" => array("TAG" => CNextCacheStock::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());

// rss
if($arParams['USE_RSS'] !== 'N'){
	CNextStock::ShowRSSIcon($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss']);
}
?>
<?if(!$itemsCnt):?>
	<div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div>
<?else:?>
	<?@include_once('page_blocks/'.$arParams["SECTION_ELEMENTS_TYPE_VIEW"].'.php');?>	
<?endif;?>