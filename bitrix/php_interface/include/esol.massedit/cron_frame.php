<?
@set_time_limit(0);
if(!defined('NOT_CHECK_PERMISSIONS')) define('NOT_CHECK_PERMISSIONS', true);
if(!defined('BX_CRONTAB')) define("BX_CRONTAB", true);
if(!defined('ADMIN_SECTION')) define("ADMIN_SECTION", true);
if(!ini_get('date.timezone') && function_exists('date_default_timezone_set')){@date_default_timezone_set("Europe/Moscow");}
$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__).'/../../../..');
if(!array_key_exists('REQUEST_URI', $_SERVER)) $_SERVER["REQUEST_URI"] = substr(__FILE__, strlen($_SERVER["DOCUMENT_ROOT"]));
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
@set_time_limit(0);
$moduleId = 'esol.massedit';
\Bitrix\Main\Loader::includeModule("iblock");
\Bitrix\Main\Loader::includeModule('catalog');
\Bitrix\Main\Loader::includeModule("currency");
\Bitrix\Main\Loader::includeModule($moduleId);
$PROFILE_ID = $argv[1];
$arEtypes = array(
	'E' => 'ELEMENT',
	'S' => 'SECTION'
);

$arProfiles = array_map('trim', explode(',', $PROFILE_ID));
foreach($arProfiles as $PROFILE_ID)
{
	if(strlen($PROFILE_ID)==0)
	{
		echo date('Y-m-d H:i:s').": profile id is not set\r\n";
		continue;
	}
	
	$arProfileFields = \Bitrix\EsolMassedit\ProfileTable::getList(array('filter'=>array('ID'=>$PROFILE_ID)))->Fetch();
	if(!$arProfileFields)
	{
		echo date('Y-m-d H:i:s').": profile is not exists\r\n"."Profile id = ".$PROFILE_ID."\r\n\r\n";
		continue;
	}
	if($arProfileFields['ACTIVE']=='N')
	{
		echo date('Y-m-d H:i:s').": profile is not active\r\n"."Profile id = ".$PROFILE_ID."\r\n\r\n";
		continue;
	}
	
	$arTemplateFields = \Bitrix\EsolMassedit\TemplateTable::getList(array('filter'=>array('ID'=>$arProfileFields['TEMPLATE_ID'])))->Fetch();
	if(!$arTemplateFields)
	{
		echo date('Y-m-d H:i:s').": template is not exists\r\n"."Profile id = ".$PROFILE_ID."\r\n\r\n";
		continue;
	}
	
	$arFilter = unserialize($arProfileFields['FILTER']);
	if(!is_array($arFilter)) $arFilter = array();
	$arParams = unserialize($arTemplateFields['PARAMS']);
	if(!is_array($arParams)) $arParams = array();
	
	$arParams = array_merge($arParams, array(
		'EXECTYPE' => 'CRON',
		'ETYPE' => $arEtypes[$arTemplateFields['ETYPE']],
		'IBLOCK_ID' => $arTemplateFields['IBLOCK_ID'],
		'FILTERTYPE' => 'CUSTOMFILTER', 
		'FILTER' => $arFilter
	));
	
	$pr = new \Bitrix\EsolMassedit\Processor($arParams);
	$arCounts = $pr->DoUpdate();
	
	echo date('Y-m-d H:i:s').": update complete\r\n"."Profile id = ".$PROFILE_ID."\r\n".CUtil::PhpToJSObject($arCounts)."\r\n\r\n";
}
?>