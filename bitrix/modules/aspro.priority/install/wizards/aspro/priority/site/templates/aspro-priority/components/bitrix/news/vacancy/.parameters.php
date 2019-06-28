<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/* get component template pages & params array */
$arPageBlocksParams = array();
if(\Bitrix\Main\Loader::includeModule('aspro.priority')){
	$arPageBlocks = CPriority::GetComponentTemplatePageBlocks(__DIR__);
	$arPageBlocksParams = CPriority::GetComponentTemplatePageBlocksParams($arPageBlocks);
	CPriority::AddComponentTemplateModulePageBlocksParams(__DIR__, $arPageBlocksParams); // add option value FROM_MODULE
}

$arTemplateParameters = array_merge($arPageBlocksParams, array(
	'SHOW_DETAIL_LINK' => array(
		'PARENT' => 'LIST_SETTINGS',
		'NAME' => GetMessage('SHOW_DETAIL_LINK'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	'SHOW_SECTION_PREVIEW_DESCRIPTION' => array(
		'PARENT' => 'LIST_SETTINGS',
		'SORT' => 500,
		'NAME' => GetMessage('SHOW_SECTION_PREVIEW_DESCRIPTION'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	'FORM' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'SORT' => 500,
		'NAME' => GetMessage('FORM'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	'FORM_BUTTON_TITLE' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'SORT' => 500,
		'NAME' => GetMessage('FORM_BUTTON_TITLE'),
		'TYPE' => 'STRING',
		'DEFAULT' => '',
	),
	'USE_SHARE' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'SORT' => 600,
		'NAME' => GetMessage('USE_SHARE'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N',
	),
	'T_PROJECTS' => array(
		'SORT' => 704,
		'NAME' => GetMessage('T_PROJECTS'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'T_FAQ' => array(
		'SORT' => 706,
		'NAME' => GetMessage('T_FAQ'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'T_SERVICES' => array(
		'SORT' => 706,
		'NAME' => GetMessage('T_SERVICES'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'T_ITEMS' => array(
		'SORT' => 706,
		'NAME' => GetMessage('T_ITEMS'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'T_PARTNERS' => array(
		'SORT' => 706,
		'NAME' => GetMessage('T_PARTNERS'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'T_REVIEWS' => array(
		'SORT' => 706,
		'NAME' => GetMessage('T_REVIEWS'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'T_STAFF' => array(
		'SORT' => 706,
		'NAME' => GetMessage('T_STAFF'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'T_VACANCYS' => array(
		'SORT' => 706,
		'NAME' => GetMessage('T_VACANCYS'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'T_SERTIFICATES' => array(
		'SORT' => 706,
		'NAME' => GetMessage('T_SERTIFICATES'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'REVIEWS_IBLOCK_ID' => array(
		'SORT' => 704,
		'NAME' => GetMessage('REVIEWS_IBLOCK_ID'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'PROJECTS_IBLOCK_ID' => array(
		'SORT' => 704,
		'NAME' => GetMessage('PROJECTS_IBLOCK_ID'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'SERVICES_IBLOCK_ID' => array(
		'SORT' => 704,
		'NAME' => GetMessage('SERVICES_IBLOCK_ID'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'STAFF_IBLOCK_ID' => array(
		'SORT' => 704,
		'NAME' => GetMessage('STAFF_IBLOCK_ID'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'PARTNERS_IBLOCK_ID' => array(
		'SORT' => 704,
		'NAME' => GetMessage('PARTNERS_IBLOCK_ID'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'NEWS_IBLOCK_ID' => array(
		'SORT' => 704,
		'NAME' => GetMessage('NEWS_IBLOCK_ID'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'FAQ_IBLOCK_ID' => array(
		'SORT' => 704,
		'NAME' => GetMessage('FAQ_IBLOCK_ID'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'CATALOG_IBLOCK_ID' => array(
		'SORT' => 704,
		'NAME' => GetMessage('CATALOG_IBLOCK_ID'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'VACANCYS_IBLOCK_ID' => array(
		'SORT' => 704,
		'NAME' => GetMessage('VACANCYS_IBLOCK_ID'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'SERTIFICATES_IBLOCK_ID' => array(
		'SORT' => 704,
		'NAME' => GetMessage('SERTIFICATES_IBLOCK_ID'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),	
));

?>