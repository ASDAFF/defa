<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arTemplateParameters = array(
	'SHOW_ALL_TITLE' => array(
		'NAME' => GetMessage('SHOW_ALL_TITLE'),
		'TYPE' => 'STRING',
		'DEFAULT' => '',
	),
	'MORE_BUTTON_TITLE' => array(
		'NAME' => GetMessage('MORE_BUTTON_TITLE'),
		'TYPE' => 'STRING',
		'DEFAULT' => '',
	),
	'COUNT_BENEFITS' => array(
		'NAME' => GetMessage('COUNT_BENEFITS'),
		'TYPE' => 'STRING',
		'DEFAULT' => '4',
	),
	'FILTER_NAME' => array(
		'NAME' => GetMessage('FILTER_NAME'),
		'TYPE' => 'STRING',
		'DEFAULT' => '',
	),
	'REGION' => array(
		'NAME' => GetMessage('REGION'),
		'TYPE' => 'STRING',
		'DEFAULT' => '={$arRegion}',
	),
);