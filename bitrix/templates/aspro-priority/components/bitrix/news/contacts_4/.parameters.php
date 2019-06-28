<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/* get component template pages & params array */
/*$arPageBlocksParams = array();
if(\Bitrix\Main\Loader::includeModule('aspro.priority')){
	$arPageBlocks = CPriority::GetComponentTemplatePageBlocks(__DIR__);
	$arPageBlocksParams = CPriority::GetComponentTemplatePageBlocksParams($arPageBlocks);
}
*/
$arTemplateParameters = array(
	'SHOW_TOP_MAP' => array(
		'PARENT' => 'LIST_SETTINGS',
		'SORT' => 100,
		'NAME' => GetMessage('SHOW_TOP_MAP_TITLE'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N',
	),
);
?>