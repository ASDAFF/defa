<?
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
define('NO_AGENT_CHECK', true);
define('STATISTIC_SKIP_ACTIVITY_CHECK', true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(isset($_POST['PARAM_NAME']) && $_POST['PARAM_NAME'] && isset($_POST['PARAM_VALUE']) && $_POST['PARAM_VALUE'] && isset($_POST['PAGE_TYPE']) && $_POST['PAGE_TYPE']){
	\Bitrix\Main\Loader::includeModule('main');
	
	if(\Bitrix\Main\Loader::includeModule('aspro.priority')){
		global $APPLICATION, $arTheme;
		$GLOBALS['arFrontItemsFilter'] = array('!PROPERTY_SHOW_ON_INDEX_PAGE' => false);
		$GLOBALS['arFrontContactsFilter'] = array('!PROPERTY_MAIN_OFFICE' => false);
		$arTheme = CPriority::GetFrontParametrsValues(SITE_ID);
		$componentTemplate = (isset($_POST['COMPONENT_TEMPLATE']) && $_POST['COMPONENT_TEMPLATE'] ? $_POST['COMPONENT_TEMPLATE'] : '');
		if($componentTemplate){
			$arTheme[$arTheme['INDEX_TYPE'].'_'.$_POST['PARAM_NAME'].'_TEMPLATE'] = $_SESSION['THEME'][SITE_ID][$arTheme['INDEX_TYPE'].'_'.$_POST['PARAM_NAME'].'_TEMPLATE'] = $_POST['PARAM_VALUE'];
		}
		else{
			$arTheme[$_POST['PARAM_NAME']] = $_SESSION['THEME'][SITE_ID][$_POST['PARAM_NAME']] = $_POST['PARAM_VALUE'];
		}

		CPriority::ShowPageType($_POST['PAGE_TYPE'], $componentTemplate, $_POST['PARAM_NAME']);
		IncludeTemplateLangFile($_SERVER['DOCUMENT_ROOT'].'/'.SITE_TEMPLATE_PATH.'/lang/'.LANGUAGE_ID.'/header.php');
		IncludeTemplateLangFile($_SERVER['DOCUMENT_ROOT'].'/'.SITE_TEMPLATE_PATH.'/lang/'.LANGUAGE_ID.'/footer.php');
	}
}
//require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>