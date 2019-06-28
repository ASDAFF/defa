<?
global $arSite, $isMenu, $isIndex, $is404, $indexType, $roundButton, $titleCenter, $showIcons, $bBigBannersIndex, $bTopFloatBannersIndex, $bTopServicesIndex, $bPortfolioIndex, $bPartnersIndex, $bTeasersIndex, $bInstagrammIndex, $bReviewsIndex, $bConsultIndex, $bCompanyIndex, $bTeamIndex, $bNewsIndex;
?>

<?$is404 = defined("ERROR_404") && ERROR_404 === "Y"?>
<?$arSite = CSite::GetByID(SITE_ID)->Fetch();?>
<?$isMenu = ($APPLICATION->GetProperty('MENU') !== "N" ? true : false);?>
<?$isForm = CSite::inDir(SITE_DIR.'form/');?>
<?$isBlog = (CSite::inDir(SITE_DIR.'articles/') || $APPLICATION->GetProperty("BLOG_PAGE") == "Y");?>
<?$isCabinet = CSite::inDir(SITE_DIR.'cabinet/');?>
<?$isIndex = CSite::inDir(SITE_DIR."index.php");?>
<?$isCatalog = CSite::inDir(SITE_DIR."product/");?>
<?$isServices = CSite::inDir(SITE_DIR."services/");?>
<?$isProjects = CSite::inDir(SITE_DIR."projects/");?>
<?$showIcons = ($arTheme['SHOW_CATALOG_SECTIONS_ICONS']['VALUE'] == 'Y' ? true : false);?>
<?$showLeftCallback = ($arTheme['CALLBACK']['DEPENDENT_PARAMS']['LEFT_FORM_CALLBACK']['VALUE'] == 'Y' ? 'Y' : 'N');?>
<?$showLeftAskQuestion = ($arTheme['ASK_QUESTION']['DEPENDENT_PARAMS']['LEFT_FORM_ASK_QUESTION']['VALUE'] == 'Y' ? 'Y' : 'N');?>
<?$showLeftAddReview = ($arTheme['ADD_REVIEW']['DEPENDENT_PARAMS']['LEFT_FORM_ADD_REVIEW']['VALUE'] == 'Y' ? 'Y' : 'N');?>
<?$showLeftMap = ($arTheme['MAP']['DEPENDENT_PARAMS']['LEFT_FORM_MAP']['VALUE'] == 'Y' ? 'Y' : 'N');?>
<?$showFlyCallback = ($arTheme['CALLBACK']['DEPENDENT_PARAMS']['FLY_FORM_CALLBACK']['VALUE'] == 'Y' || $arTheme['FLY_FORM_CALLBACK'] == 'Y' ? 'Y' : 'N');?>
<?$showFlyAskQuestion = ($arTheme['ASK_QUESTION']['DEPENDENT_PARAMS']['FLY_FORM_ASK_QUESTION']['VALUE'] == 'Y' || $arTheme['FLY_FORM_ASK_QUESTION'] == 'Y' ? 'Y' : 'N');?>
<?$showFlyAddReview = ($arTheme['ADD_REVIEW']['DEPENDENT_PARAMS']['FLY_FORM_ADD_REVIEW']['VALUE'] == 'Y' || $arTheme['FLY_FORM_ADD_REVIEW'] == 'Y' ? 'Y' : 'N');?>
<?$showFlyMap = ($arTheme['MAP']['DEPENDENT_PARAMS']['FLY_FORM_MAP']['VALUE'] == 'Y' || $arTheme['FLY_FORM_MAP'] == 'Y' ? 'Y' : 'N');?>
<?$roundButton = ($arTheme['ROUND_BUTTON']['VALUE'] == 'Y' || $arTheme['ROUND_BUTTON'] == 'Y' ? 'Y' : 'N');?>
<?$titleCenter = ($arTheme['PAGE_TITLE_POSITION']['VALUE'] == 'center' || $arTheme['PAGE_TITLE_POSITION'] == 'center' ? true : false);?>
<?$bActiveTheme = ($arTheme["THEME_SWITCHER"]["VALUE"] == 'Y');?>
<?if($isIndex = CSite::inDir(SITE_DIR."index.php")):?>
	<?$indexType = $arTheme["INDEX_TYPE"]["VALUE"];?>
	<?$bBigBannersIndex = $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["BIG_BANNER_INDEX"]["VALUE"] == 'Y';?>
	<?$bTopFloatBannersIndex = ($bActiveTheme || (!$bActiveTheme && $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["TOP_FLOAT_BANNERS_INDEX"]["VALUE"] == 'Y'));?>
	<?$bTopServicesIndex = ($bActiveTheme || (!$bActiveTheme && $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["TOP_SERVICES_INDEX"]["VALUE"] == 'Y'));?>
	<?$bPartnersIndex = ($bActiveTheme || (!$bActiveTheme && $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["PARTNERS_INDEX"]["VALUE"] == 'Y'));?>
	<?$bTeasersIndex = ($bActiveTheme || (!$bActiveTheme && $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["TEASERS_INDEX"]["VALUE"] == 'Y'));?>
	<?$bPortfolioIndex = ($bActiveTheme || (!$bActiveTheme && $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["PORTFOLIO_INDEX"]["VALUE"] == 'Y'));?>
	<?$bProductsIndex = ($bActiveTheme || (!$bActiveTheme && $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["PRODUCTS_INDEX"]["VALUE"] == 'Y'));?>
	<?$bContactsIndex = ($bActiveTheme || (!$bActiveTheme && $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["CONTACTS_INDEX"]["VALUE"] == 'Y'));?>
	<?$bCatalogIndex = ($bActiveTheme || (!$bActiveTheme && $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["CATALOG_INDEX"]["VALUE"] == 'Y'));?>
	<?$bTopTarifsIndex = ($bActiveTheme || (!$bActiveTheme && $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["TOP_TARIFS_INDEX"]["VALUE"] == 'Y'));?>

	<?if(isset($arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["INSTAGRAMM_INDEX"]))
		$bInstagrammIndex = ($bActiveTheme || (!$bActiveTheme && $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["INSTAGRAMM_INDEX"]["VALUE"] == 'Y'));
	else
		$bInstagrammIndex = true;?>
	<?$bReviewsIndex = ($bActiveTheme || (!$bActiveTheme && $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["REVIEWS_INDEX"]["VALUE"] == 'Y'));?>
	<?$bConsultIndex = ($bActiveTheme || (!$bActiveTheme && $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["CONSULT_INDEX"]["VALUE"] == 'Y'));?>
	<?$bCompanyIndex = ($bActiveTheme || (!$bActiveTheme && $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["COMPANY_INDEX"]["VALUE"] == 'Y'));?>
	<?$bTeamIndex = ($bActiveTheme || (!$bActiveTheme && $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["TEAM_INDEX"]["VALUE"] == 'Y'));?>
	<?$bNewsIndex = ($bActiveTheme || (!$bActiveTheme && $arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType]["NEWS_INDEX"]["VALUE"] == 'Y'));?>
<?endif;?>

<?$GLOBALS['arFrontItemsFilter'] = array('!PROPERTY_SHOW_ON_INDEX_PAGE' => false);?>
<?$GLOBALS['arFrontItemsFilterRegion'] = array('!PROPERTY_SHOW_ON_INDEX_PAGE' => false);?>

<?
//region filter
global $arRegion;

$GLOBALS['arFrontItemsFilterRegion'] = array('!PROPERTY_SHOW_ON_INDEX_PAGE' => false);
$GLOBALS['arFrontContactsFilterRegion'] = array('!PROPERTY_MAIN_OFFICE' => false);

if($arRegion && $arTheme['USE_REGIONALITY']['DEPENDENT_PARAMS']['REGIONALITY_FILTER_ITEM']['VALUE'] == 'Y')
{
	$GLOBALS['arRegionLink'] = array('PROPERTY_LINK_REGION' => $arRegion['ID']);
	if($isIndex)
	{
		$GLOBALS['arFrontItemsFilterRegion']['PROPERTY_LINK_REGION'] = $arRegion['ID'];
		$GLOBALS['arFrontContactsFilterRegion']['PROPERTY_LINK_REGION'] = $arRegion['ID'];
	}
}
?>