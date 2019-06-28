<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
\Bitrix\Main\Loader::includeModule('iblock');

$arTemplateParameters = array(
	'SHOW_DETAIL_LINK' => array(
		'NAME' => GetMessage('SHOW_DETAIL_LINK'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	'TITLE' => array(
		'NAME' => GetMessage('TITLE'),
		'TYPE' => 'STRING',
		'DEFAULT' => '',
	),
	'COUNT_SHOW_PROPRERTIES' => array(
		'PARENT' => 'DATA_SOURCE',
		'NAME' => GetMessage('COUNT_SHOW_PROPRERTIES'),
		'TYPE' => 'STRING',
		'DEFAULT' => '4',
	),
	'SHOW_PROPS_NAME' => array(
		'NAME' => GetMessage('T_SHOW_PROPS_NAME'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
);
?>
