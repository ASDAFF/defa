<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$arTemplateParameters = array(
	'TITLE' => array(
		'NAME' => GetMessage('T_TITLE'),
		'TYPE' => 'STRING',
		'DEFAULT' => GetMessage('V_TITLE'),
	),
	'RIGHT_TITLE' => array(
		'NAME' => GetMessage('T_RIGHT_TITLE'),
		'TYPE' => 'STRING',
		'DEFAULT' => GetMessage('V_RIGHT_TITLE'),
	),
	'RIGHT_LINK' => array(
		'NAME' => GetMessage('T_RIGHT_LINK'),
		'TYPE' => 'STRING',
		'DEFAULT' => 'services/',
	),
);
?>