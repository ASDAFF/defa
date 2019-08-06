<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?
use Bitrix\Main\Loader,
	Bitrix\Main\ModuleManager;

Loader::includeModule("iblock");
Loader::includeModule("highloadblock");

global $arTheme, $arRegion;
$arElement = array();
$arSelect = array("ID", "IBLOCK_ID", "NAME", "PROPERTY_FILTER_URL", "PROPERTY_SECTION", "ElementValues");
$arFilterElement = array("IBLOCK_ID" => CNextCache::$arIBlocks[SITE_ID]["aspro_next_catalog"]["aspro_next_landing"][0], "ACTIVE"=>"Y");
if($GLOBALS[$arParams['FILTER_NAME']])
{
	$arFilterElement = array_merge($arFilterElement, $GLOBALS[$arParams['FILTER_NAME']]);
}
if($arParams["SHOW_DEACTIVATED"] == "Y")
	unset($arFilterElement["ACTIVE"]);

if($arResult["VARIABLES"]["ELEMENT_ID"] > 0)
{
	$arElement = CNextCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CNextCache::GetIBlockCacheTag(CNextCache::$arIBlocks[SITE_ID]["aspro_next_catalog"]["aspro_next_landing"][0]))), array_merge($arFilterElement, array("ID" => $arResult["VARIABLES"]["ELEMENT_ID"])), false, false, $arSelect);
}
elseif(strlen(trim($arResult["VARIABLES"]["ELEMENT_CODE"])) > 0)
{
	$arElement = CNextCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CNextCache::GetIBlockCacheTag(CNextCache::$arIBlocks[SITE_ID]["aspro_next_catalog"]["aspro_next_landing"][0]))), array_merge($arFilterElement, array("=CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"])), false, false, $arSelect);

}
if($arParams['STORES'])
{
	foreach($arParams['STORES'] as $key => $store)
	{
		if(!$store)
			unset($arParams['STORES'][$key]);
	}
}
if($arRegion)
{
	if($arRegion['LIST_PRICES'])
	{
		if(reset($arRegion['LIST_PRICES']) != 'component')
			$arParams['PRICE_CODE'] = array_keys($arRegion['LIST_PRICES']);
	}
	if($arRegion['LIST_STORES'])
	{
		if(reset($arRegion['LIST_STORES']) != 'component')
			$arParams['STORES'] = $arRegion['LIST_STORES'];
	}
}
?>
<?if(!$arElement && $arParams['SET_STATUS_404'] !== 'Y'):?>
	<div class="alert alert-warning"><?=GetMessage("ELEMENT_NOTFOUND")?></div>
<?elseif(!$arElement && $arParams['SET_STATUS_404'] === 'Y'):?>
	<?CNext::goto404Page();?>
<?else:?>
	<?CNext::AddMeta(
		array(
			'og:description' => $arElement['PREVIEW_TEXT'],
			'og:image' => (($arElement['PREVIEW_PICTURE'] || $arElement['DETAIL_PICTURE']) ? CFile::GetPath(($arElement['PREVIEW_PICTURE'] ? $arElement['PREVIEW_PICTURE'] : $arElement['DETAIL_PICTURE'])) : false),
		)
	);?>

	<?if($arParams["USE_SHARE"] == "Y" && $arElement):?>
		<?$this->SetViewTarget('product_share');?>
		<div class="catalog_detail share top <?=($arParams['USE_RSS'] == 'Y' ? 'rss-block' : '');?>">
			<?$APPLICATION->IncludeFile(SITE_DIR."include/share_buttons.php", Array(), Array("MODE" => "html", "NAME" => GetMessage('CT_BCE_CATALOG_SOC_BUTTON')));?>
		</div>
		<?$this->EndViewTarget();?>
	<?endif;?>
	<?$isWideBlock = (isset($arParams["DIR_PARAMS"]["HIDE_LEFT_BLOCK"]) ? $arParams["DIR_PARAMS"]["HIDE_LEFT_BLOCK"] : "");?>
	<div class="landing_detail <?=($isWideBlock == "Y" ? "fixed_wrapper" : "");?>" itemscope itemtype="http://schema.org/Product">
		<?@include_once('page_blocks/'.$arParams["ELEMENT_TYPE_VIEW"].'.php');?>	
	</div>
	<?CNext::checkBreadcrumbsChain($arParams, $arSection, $arElement);?>

	<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.history.js');?>
<?endif;?>