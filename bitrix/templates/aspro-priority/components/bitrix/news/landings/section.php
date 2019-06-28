<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$this->setFrameMode(true);
global $APPLICATION, $arTheme;
$bOrderViewBasket = (trim($arTheme['ORDER_VIEW']['VALUE']) === 'Y');

// get section items count and subsections
$arItemFilter = CPriority::GetCurrentSectionElementFilter($arResult["VARIABLES"], $arParams);
$arSectionFilter = CPriority::GetCurrentSectionFilter($arResult["VARIABLES"], $arParams);
$itemsCnt = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());
$arSection = CCache::CIblockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "N")), $arSectionFilter, false, array('ID', 'IBLOCK_ID', 'DESCRIPTION', 'PICTURE', 'DETAIL_PICTURE',  'UF_VIEWTYPE', 'UF_TOP_SEO'), true);
CPriority::AddMeta(
	array(
		'og:description' => $arSection['DESCRIPTION'],
		'og:image' => (($arSection['PICTURE'] || $arSection['DETAIL_PICTURE']) ? CFile::GetPath(($arSection['PICTURE'] ? $arSection['PICTURE'] : $arSection['DETAIL_PICTURE'])) : false),
	)
);
$arSubSectionFilter = CPriority::GetCurrentSectionSubSectionFilter($arResult["VARIABLES"], $arParams, $arSection['ID']);
$arSubSections = CCache::CIblockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "Y")), $arSubSectionFilter, false, array("ID", "DEPTH_LEVEL"));

?>
<?if(!$arSection && $arParams['SET_STATUS_404'] !== 'Y'):?>
	<div class="alert alert-warning"><?=GetMessage("SECTION_NOTFOUND")?></div>
<?elseif(!$arSection && $arParams['SET_STATUS_404'] === 'Y'):?>
	<?CPriority::goto404Page();?>
<?else:?>
	<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>
	<?// rss
	if($arParams['USE_RSS'] !== 'N'){
		CPriority::ShowRSSIcon(CComponentEngine::makePathFromTemplate($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss_section'], array_map('urlencode', $arResult['VARIABLES'])));
	}?>
	<?if(!$arSubSections && !$itemsCnt):?>
		<div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div>
	<?endif;?>

	<?
	//seo
	$arSeoItems = CCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" =>"Y", "TAG" => CCache::GetIBlockCacheTag($arParams["LANDING_IBLOCK_ID"]))), array("IBLOCK_ID" => $arParams["LANDING_IBLOCK_ID"], "ACTIVE"=>"Y"), false, false, array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_PICTURE", "PROPERTY_FILTER_URL", "PROPERTY_FORM_QUESTION", "PROPERTY_TIZERS", "PROPERTY_SECTION", "DETAIL_TEXT", "ElementValues"));
	$arSeoItem = array();
	if($arSeoItems)
	{
		foreach($arSeoItems as $arItem)
		{
			if($arItem["PROPERTY_FILTER_URL_VALUE"] == $APPLICATION->GetCurDir())
			{
				$arSeoItem = $arItem;
				break;
			}
		}
		unset($arSeoItems);
	}
	?>

	<div class="main-section-wrapper">
		<?if($arSection['UF_TOP_SEO'] && strpos($_SERVER['REQUEST_URI'], 'PAGEN') === false):?>
			<div class="text_before_items">
				<p><?=$arSection['UF_TOP_SEO'];?></p>
				<hr>
			</div>
		<?endif;?>

		<?if($arSubSections):?>
			<?// sections list?>
			<?@include_once('page_blocks/'.$arParams["SECTION_TYPE_VIEW"].'.php');?>
		<?endif;?>

		<?// section elements?>
		<?@include_once('page_blocks/'.$arParams["SECTION_ELEMENTS_TYPE_VIEW"].'.php');?>

		<?if($arSection['DESCRIPTION'] && strpos($_SERVER['REQUEST_URI'], 'PAGEN') === false && !$arSeoItem):?>
			<div class="text_after_items">
				<?=$arSection['DESCRIPTION'];?>
			</div>
		<?endif;?>
	</div>
<?endif;?>