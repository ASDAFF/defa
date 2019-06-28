<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arTemplateParameters = array(
	'SHOW_DETAIL_LINK' => array(
		'NAME' => GetMessage('SHOW_DETAIL_LINK'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	'ELEMENTS_COUNT' => array(
		'SORT' => 100,
		'NAME' => GetMessage('ELEMENTS_COUNT'),
		'TYPE' => 'STRING',
		'DEFAULT' => '8',
	),
	'TITLE' => array(
		'SORT' => 100,
		'NAME' => GetMessage('TITLE'),
		'TYPE' => 'STRING',
		'DEFAULT' => ''
	),
	'SHOW_ALL_TITLE' => array(
		'NAME' => GetMessage('SHOW_ALL_TITLE'),
		'TYPE' => 'STRING',
		'DEFAULT' => '',
	),
);
?>