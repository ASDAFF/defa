<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?
// get section items count and subsections
$arSectionFilter = CNextStock::GetCurrentSectionFilter($arResult["VARIABLES"], $arParams);
$arSection = CNextCacheStock::CIblockSection_GetList(array("CACHE" => array("TAG" => CNextCacheStock::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "CACHE_GROUP" => array($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()), "MULTI" => "N")), $arSectionFilter, false, array('ID', 'DESCRIPTION', 'PICTURE', 'DETAIL_PICTURE', 'IBLOCK_ID', 'UF_TOP_SEO'));
$arItemFilter = CNextStock::GetCurrentSectionElementFilter($arResult["VARIABLES"], $arParams);

if($arSection && !$arItemFilter['SECTION_ID'])
{
	$arItemFilter['SECTION_ID'] = $arSection['ID'];
}
$itemsCnt = CNextCacheStock::CIblockElement_GetList(array("CACHE" => array("TAG" => CNextCacheStock::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "CACHE_GROUP" => array($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()))), $arItemFilter, array());
CNextStock::AddMeta(
	array(
		'og:description' => $arSection['DESCRIPTION'],
		'og:image' => (($arSection['PICTURE'] || $arSection['DETAIL_PICTURE']) ? CFile::GetPath(($arSection['PICTURE'] ? $arSection['PICTURE'] : $arSection['DETAIL_PICTURE'])) : false),
	)
);
$arSubSectionFilter = CNextStock::GetCurrentSectionSubSectionFilter($arResult["VARIABLES"], $arParams, $arSection['ID']);
$arSubSections = CNextCacheStock::CIblockSection_GetList(array("CACHE" => array("TAG" => CNextCacheStock::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "Y")), $arSubSectionFilter, false, array("ID", "DEPTH_LEVEL"));

global $arRegion;
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
	<?if(!$arSubSections && !$itemsCnt):?>
		<div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div>
	<?endif;?>

	<?//seo
	$arParams["LANDING_IBLOCK_ID"] = (!isset($arParams["LANDING_IBLOCK_ID"]) || !$arParams["LANDING_IBLOCK_ID"] ? CNextCacheStock::$arIBlocks[SITE_ID]["aspro_next_catalog"]["aspro_next_catalog_info"][0] : $arParams["LANDING_IBLOCK_ID"]);
	$arParams["TIZERS_IBLOCK_ID"] = (!isset($arParams["TIZERS_IBLOCK_ID"]) || !$arParams["TIZERS_IBLOCK_ID"] ? CNextCacheStock::$arIBlocks[SITE_ID]["aspro_next_content"]["aspro_next_tizers"][0] : $arParams["TIZERS_IBLOCK_ID"]);
	$arSeoItems = CNextCacheStock::CIBLockElement_GetList(array('CACHE' => array("MULTI" =>"Y", "TAG" => CNextCacheStock::GetIBlockCacheTag($arParams["LANDING_IBLOCK_ID"]))), array("IBLOCK_ID" => $arParams["LANDING_IBLOCK_ID"], "ACTIVE"=>"Y"), false, false, array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_PICTURE", "PROPERTY_FILTER_URL", "PROPERTY_FORM_QUESTION", "PROPERTY_TIZERS", "PROPERTY_SECTION", "PROPERTY_LINK_REGION", "PROPERTY_SECTION_SERVICES", "DETAIL_TEXT", "PROPERTY_SEO_TEXT", "ElementValues"));
	$arSeoItem = array();
	if($arSeoItems)
	{
		$iLandingItemID = 0;
		$current_url =  $APPLICATION->GetCurDir();
		$url = urldecode(str_replace(' ', '+', $current_url));
		foreach($arSeoItems as $arItem)
		{
			if(urldecode($arItem["PROPERTY_FILTER_URL_VALUE"]) == $url)
			{
				$arSeoItem = $arItem;
				$iLandingItemID = $arSeoItem['ID'];
				break;
			}
		}
		if($arRegion)
		{
			if($arSeoItem)
			{
				if($arSeoItem['PROPERTY_LINK_REGION_VALUE'])
				{
					if(!is_array($arSeoItem['PROPERTY_LINK_REGION_VALUE']))
						$arSeoItem['PROPERTY_LINK_REGION_VALUE'] = (array)$arSeoItem['PROPERTY_LINK_REGION_VALUE'];
					if(!in_array($arRegion['ID'], $arSeoItem['PROPERTY_LINK_REGION_VALUE']))
						$arSeoItem = array();
				}
			}
			else
			{
				foreach($arSeoItems as $arItem)
				{
					if($arItem['PROPERTY_LINK_REGION_VALUE'])
					{
						if(!is_array($arItem['PROPERTY_LINK_REGION_VALUE']))
							$arItem['PROPERTY_LINK_REGION_VALUE'] = (array)$arItem['PROPERTY_LINK_REGION_VALUE'];
						if(!in_array($arRegion['ID'], $arItem['PROPERTY_LINK_REGION_VALUE']))
							$arTmpRegionsLanding[] = $arItem['ID'];
					}
				}
			}
		}
	}
	?>
	
	<div class="main-section-wrapper">
		<?if($arSection['UF_TOP_SEO'] && strpos($_SERVER['REQUEST_URI'], 'PAGEN') === false):?>
			<div class="text_before_items">
				<p class="introtext"><?=$arSection['UF_TOP_SEO'];?></p>				
			</div>
		<?endif;?>

		<?if($arSubSections):?>
			<?// sections list?>
			<?@include_once('page_blocks/'.$arParams["SECTION_TYPE_VIEW"].'.php');?>
		<?endif;?>
		<?// section elements?>
		<?@include_once('page_blocks/'.$arParams["SECTION_ELEMENTS_TYPE_VIEW"].'.php');?>
		
		<?if($arSection['DESCRIPTION'] && strpos($_SERVER['REQUEST_URI'], 'PAGEN') === false):?>
			<div class="text_after_items">
				<?=$arSection['DESCRIPTION'];?>
			</div>
		<?endif;?>
	</div>
<?endif;?>

<?if(\Bitrix\Main\Loader::includeModule("sotbit.seometa")):?>
	<?$APPLICATION->IncludeComponent(
		"sotbit:seo.meta",
		".default",
		array(
			"FILTER_NAME" => $arParams["FILTER_NAME"],
			"SECTION_ID" => $arSection['ID'],
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
		)
	);?>
<?endif;?>