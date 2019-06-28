<?
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
define('NO_AGENT_CHECK', true);
define('STATISTIC_SKIP_ACTIVITY_CHECK', true);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
if((isset($_POST['NAME']) && $_POST['NAME']) && (isset($_POST['VALUE']) && $_POST['VALUE']))
{
	if(\Bitrix\Main\Loader::includeModule('aspro.priority'))
	{
		if($_POST['NAME'] == 'TYPE_INDEX'){
			$arParametrs = CPriority::$arParametrsList;
			$firstKey = array_keys($arParametrs['HEADER']['OPTIONS']['HEADER_TYPE']['COMMUNITY'][$_POST['NAME']][$_POST['VALUE']])[0];
			$_SESSION['THEME'][SITE_ID]['HEADER_TYPE'] = $firstKey;
		}
		
		$_SESSION['THEME'][SITE_ID][$_POST['NAME']] = $_POST['VALUE'];
	}
}
if($GLOBALS['USER']->IsAdmin()){
	echo json_encode(array('CAN_SAVE' => true));
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>