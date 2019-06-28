<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$this->setFrameMode(true);
global $APPLICATION, $arTheme;
$bOrderViewBasket = (trim($arTheme['ORDER_VIEW']['VALUE']) === 'Y');

// get section items count and subsections
$arItemFilter = CPriority::GetCurrentSectionElementFilter($arResult["VARIABLES"], $arParams);
if($arParams['INCLUDE_SUBSECTIONS'] != 'N'){
	$arItemFilter['INCLUDE_SUBSECTIONS'] = $arParams['INCLUDE_SUBSECTIONS'];
}

$arSectionFilter = CPriority::GetCurrentSectionFilter($arResult["VARIABLES"], $arParams);
$itemsCnt = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());
$arSection = CCache::CIblockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "N")), $arSectionFilter, false, array('ID', 'IBLOCK_ID', 'DESCRIPTION', 'PICTURE', 'DETAIL_PICTURE',  'UF_VIEWTYPE', 'UF_TOP_SEO', 'UF_QUESTION'), true);
CPriority::AddMeta(
	array(
		'og:description' => $arSection['DESCRIPTION'],
		'og:image' => (($arSection['PICTURE'] || $arSection['DETAIL_PICTURE']) ? CFile::GetPath(($arSection['PICTURE'] ? $arSection['PICTURE'] : $arSection['DETAIL_PICTURE'])) : false),
	)
);
$arSubSectionFilter = CPriority::GetCurrentSectionSubSectionFilter($arResult["VARIABLES"], $arParams, $arSection['ID']);

$arSubSections = CCache::CIblockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "Y")), $arSubSectionFilter, false, array("ID", "DEPTH_LEVEL"));

$arStaffElement = array();
if($arSection['UF_QUESTION']){
	$arStaffElement = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["STAFF_IBLOCK_ID"]), 'MULTI' => 'N')), array('IBLOCK_ID' => $arParams['STAFF_IBLOCK_ID'], 'ID' => $arSection['UF_QUESTION'], 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'), false, false, array('ID', 'NAME', 'PROPERTY_POST', 'PROPERTY_PHONE', 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL'));
}
$horizontalFilter = (isset($arTheme['SHOW_SMARTFILTER']['DEPENDENT_PARAMS']) && $arTheme['SHOW_SMARTFILTER']['DEPENDENT_PARAMS']['FILTER_VIEW']['VALUE'] == 'HORIZONTAL' || $arTheme['FILTER_VIEW'] == 'HORIZONTAL' ? true : false);
?>
<?global $arTheme, $showIcons, $bShowToogle, $arRegion;?>
<?$bShowToogle = true;?>
<div class="maxwidth-theme<?=(isset($_COOKIE['LEFT_CONTENT_CLOSED']) && $_COOKIE['LEFT_CONTENT_CLOSED'] == 'Y' ? ' view_full' : '')?><?=($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT" ? ' right_menu' : '');?>">
	<?if($arSubSections):?>
		<?// sections list?>
		<?@include_once('page_blocks/'.$arParams["SECTION_TYPE_VIEW"].'.php');?>
	<?endif;?>

	<div class="row relative">
		<?if($arTheme["SIDE_MENU"]["VALUE"] == "LEFT" || $arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"):?>
			<div class="col-md-3 col-sm-3 hidden-xs hidden-sm<?=($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT" ? ' right-menu-md pull-right' : ' left-menu-md')?>">
				<?CPriority::ShowPageType('left_block')?>
			</div>
			<div class="col-md-9 col-sm-12 col-xs-12 content-md">
			<?CPriority::get_banners_position('CONTENT_TOP');?>
		<?endif;?>

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
					<?
					//seo
					$arSeoItems = CCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" =>"Y", "TAG" => CCache::GetIBlockCacheTag($arParams["LANDING_IBLOCK_ID"]))), array("IBLOCK_ID" => $arParams["LANDING_IBLOCK_ID"], "ACTIVE"=>"Y"), false, false, array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_PICTURE", "PROPERTY_FILTER_URL", "PROPERTY_FORM_QUESTION", "PROPERTY_TIZERS", "PROPERTY_SECTION", "PROPERTY_LINK_REGION", "DETAIL_TEXT", "PROPERTY_SEO_TEXT", "ElementValues"));
					$arSeoItemsSection = CCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CCache::GetIBlockCacheTag($arParams["LANDING_IBLOCK_ID"]))), array("IBLOCK_ID" => $arParams["LANDING_IBLOCK_ID"], "ACTIVE"=>"Y", 'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID']), false, false, array("PROPERTY_SECTION"));
					$arSeoItem = array();
					if($arSeoItems)
					{
						$current_url =  $APPLICATION->GetCurDir();
						$url = urldecode(str_replace(' ', '+', $current_url));
						foreach($arSeoItems as $arItem)
						{
							if(urldecode($arItem["PROPERTY_FILTER_URL_VALUE"]) == $url)
							{
								$arSeoItem = $arItem;
								break;
							}
						}
						if($arSeoItem['PROPERTY_LINK_REGION_VALUE'] && $arRegion)
						{
							if(!is_array($arSeoItem['PROPERTY_LINK_REGION_VALUE']))
								$arSeoItem['PROPERTY_LINK_REGION_VALUE'] = (array)$arSeoItem['PROPERTY_LINK_REGION_VALUE'];
							if(!in_array($arRegion['ID'], $arSeoItem['PROPERTY_LINK_REGION_VALUE']))
								$arSeoItem = array();
						}
						
						if($arSeoItem){
							$arSeoItemBanner = array();
							$dbRes = CIBlockElement::GetProperty($arItem['IBLOCK_ID'], $arItem['ID'], array(), array());
							while($arRes = $dbRes->Fetch()){
								$arSeoItemBanner['PROPERTIES'][$arRes['CODE']] = $arRes;
							}
						}
						//unset($arSeoItems);
					}					
					?>
					<?$isAjax="N";?>
					<?if(isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest"  && isset($_GET["ajax_get"]) && $_GET["ajax_get"] == "Y" || (isset($_GET["AJAX_REQUEST"]) && $_GET["AJAX_REQUEST"]=="Y")){
						$isAjax="Y";
					}?>

					<div class="main-section-wrapper<?=($arSection['UF_TOP_SEO'] && strpos($_SERVER['REQUEST_URI'], 'PAGEN') === false ? ' wdesc' : '');?><?=($horizontalFilter ? ' whorizontal_filter' : '')?><?=($arSeoItem ? ' wlanding' : '')?>" itemscope="" itemtype="http://schema.org/Product">
						<?if($arSection['UF_TOP_SEO'] && strpos($_SERVER['REQUEST_URI'], 'PAGEN') === false):?>
							<div class="text_before_items catatlog_text">
								<p><?=$arSection['UF_TOP_SEO'];?></p>
								<hr>
							</div>
						<?endif;?>
						<?if($isAjax=="Y"):?>
							<?$APPLICATION->RestartBuffer();?>
						<?endif;?>

						<?// section elements?>
						<?@include_once('page_blocks/'.$arParams["SECTION_ELEMENTS_TYPE_VIEW"].'.php');?>
					</div>
				<?endif;?>
		<?if($arTheme["SIDE_MENU"]["VALUE"] == "LEFT"):?>
			<?CPriority::get_banners_position('CONTENT_BOTTOM');?>
			</div><?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
		<?elseif($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"):?>
			<?CPriority::get_banners_position('CONTENT_BOTTOM');?>
			</div><?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
		<?endif;?>
	</div>
</div>					