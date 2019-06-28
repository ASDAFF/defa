<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arItemFilter = CPriority::GetIBlockAllElementsFilter($arParams);
$arItemSelect = array('ID', 'NAME', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'PROPERTY_MAP');
$arItems = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, false, false, $arItemSelect);

$arAllSections = array();
if($arItems)
	$arAllSections = CPriority::GetSections($arItems, $arParams);

$arItemFilter['!PROPERTY_MAIN_OFFICE'] = false;
$arItemSelect = array('ID', 'NAME', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'PROPERTY_MAP', 'PROPERTY_PHONE', 'PROPERTY_SCHEDULE', 'PROPERTY_METRO', 'PROPERTY_EMAIL', 'PROPERTY_ALTERNATIVE_NAME');
$arItem = CCache::CIblockElement_GetList(array($arParams['SORT_BY1'] => $arParams['SORT_ORDER1'], "CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), 'MULTI' => 'Y')), $arItemFilter, false, false, $arItemSelect);

if($arItem){
	$dbRes = CIBlock::GetProperties($arParams['IBLOCK_ID']);
	while($arRes = $dbRes->Fetch()){
		$arProperties[$arRes['CODE']] = $arRes;
	}
}
?>

<div class="ajax_items">
	<?if((isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") || (strtolower($_REQUEST['ajax']) == 'y')){
		$APPLICATION->RestartBuffer();?>
	<?}?>
	<?if($arItems):?>
		<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>
		<?@include_once('page_blocks/'.$arParams["SECTION_ELEMENTS_TYPE_VIEW"].'.php');?>
		<?CPriority::checkRestartBuffer();?>
	<?endif;?>
</div>