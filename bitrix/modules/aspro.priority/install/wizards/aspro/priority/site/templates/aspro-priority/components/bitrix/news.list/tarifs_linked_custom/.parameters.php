<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arTemplateParameters = array(
	'SHOW_DETAIL_LINK' => array(
		'NAME' => GetMessage('SHOW_DETAIL_LINK'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	'SHOW_SECTIONS' => array(
		'SORT' => 100,
		'NAME' => GetMessage('SHOW_SECTIONS'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	'SHOW_GOODS' => array(
		'SORT' => 100,
		'NAME' => GetMessage('SHOW_GOODS'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	'SHOW_PROPS_NAME' => array(
		'NAME' => GetMessage('T_SHOW_PROPS_NAME'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	'COUNT_LG' => array(
		'NAME' => GetMessage('T_COUNT_LG'),
		'TYPE' => 'STRING',
		'DEFAULT' => '4',
	),
	'COUNT_MD' => array(
		'NAME' => GetMessage('T_COUNT_MD'),
		'TYPE' => 'STRING',
		'DEFAULT' => '3',
	),
	'COUNT_SM' => array(
		'NAME' => GetMessage('T_COUNT_SM'),
		'TYPE' => 'STRING',
		'DEFAULT' => '2',
	),
	'COUNT_XS' => array(
		'NAME' => GetMessage('T_COUNT_XS'),
		'TYPE' => 'STRING',
		'DEFAULT' => '1',
	),
);
?>