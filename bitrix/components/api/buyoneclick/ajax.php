<?php
/**
 * Bitrix vars
 *
 * @var CDatabase $DB
 * @var CUser     $USER
 * @var CMain     $APPLICATION
 *
 */

define('STOP_STATISTICS', true);
define('NO_KEEP_STATISTIC', 'Y');
define('NO_AGENT_STATISTIC', 'Y');
define('DisableEventsCheck', true);
define('BX_SECURITY_SHOW_MESSAGE', true);

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use \Bitrix\Main\Web;

$siteId = htmlspecialchars($_REQUEST['arParams']['SITE_ID']);
$siteId = substr(preg_replace('/[^a-z0-9_]/i', '', $siteId), 0, 2);
$siteId = ($siteId ? $siteId : 's1');
if($siteId) {
	define('SITE_ID', $siteId);
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

if($_SERVER["REQUEST_METHOD"] != "POST")
	return;

if(!Loader::includeModule('api.buyoneclick') || !Loader::includeModule('sale') || !Loader::includeModule('catalog'))
	return;

global $USER, $APPLICATION;

$request = Application::getInstance()->getContext()->getRequest();
$request->addFilter(new Web\PostDecodeFilter);

//Bitrix\Main\Localization\Loc::loadMessages(dirname(__FILE__)."/class.php");

$action = $request->get('API_BUYONECLICK_ACTION');
$params = $request->get('arParams');
$post   = $request->get('arPost');
parse_str($post, $arPost);

CBitrixComponent::includeComponentClass('api:buyoneclick');
$component = new ApiBuyoneclickComponent();
$component->initComponent('api:buyoneclick', $params['COMPONENT_TEMPLATE']);
$component->arParams = $component->onPrepareComponentParams($params);


if($request->get('API_BUYONECLICK_AJAX') == 'Y') {
	$component->executeAction($action,$arPost);
}
else {
	$component->executeComponent();
}

