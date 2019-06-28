<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arItemFilter = CPriority::GetIBlockAllElementsFilter($arParams);
$arItemFilter['!PROPERTY_MAIN_OFFICE'] = false;
$arItemSelect = array('ID', 'NAME', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'PREVIEW_TEXT', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'PROPERTY_MAP', 'PROPERTY_PHONE', 'PROPERTY_SCHEDULE', 'PROPERTY_METRO', 'PROPERTY_EMAIL', 'MAIN_OFFICE');
$arItem = CCache::CIblockElement_GetList(array($arParams['SORT_BY1'] => $arParams['SORT_ORDER1'], "CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), 'MULTI' => 'Y')), $arItemFilter, false, false, $arItemSelect);

if($arItem){
	$dbRes = CIBlock::GetProperties($arParams['IBLOCK_ID']);
	while($arRes = $dbRes->Fetch()){
		$arProperties[$arRes['CODE']] = $arRes;
	}
}
?>

<?if($arItem):?>
	<?@include_once('page_blocks/element_1.php');?>
<?endif;?>
