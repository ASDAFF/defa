<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

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
	'MAX_COUNT_ELEMENTS_ON_PAGE' => array(
		'NAME' => GetMessage('MAX_COUNT_ELEMENTS_ON_PAGE'),
		'TYPE' => 'STRING',
		'DEFAULT' => 9,
	),
	'SHOW_ALL_TITLE' => array(
		'SORT' => 100,
		'NAME' => GetMessage('SHOW_ALL_TITLE'),
		'TYPE' => 'STRING',
		'DEFAULT' => ''
	),
);
?>
