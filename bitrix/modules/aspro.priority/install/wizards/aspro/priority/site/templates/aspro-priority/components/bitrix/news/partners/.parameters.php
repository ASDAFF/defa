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
	'SERVICES_LINK_ELEMENTS_TEMPLATE' => array(
		'PARENT' => 'BASE',
		'SORT' => 1000,
		'NAME' => GetMessage('T_SERVICES_LINK_ELEMENTS_TEMPLATE'),
		'TYPE' => 'LIST',
		'VALUES' => array(
			'services_linked' => GetMessage('T_WITH_IMAGE'),
			'services_linked_2' => GetMessage('T_WITH_ICONS'),
			'services_linked_custom' => 'services_linked_custom',
		),
		'DEFAULT' => 'services_linked'
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

$arTemplateParameters['IMAGE_POSITION'] = array(
	'PARENT' => 'LIST_SETTINGS',
	'SORT' => 250,
	'NAME' => GetMessage('IMAGE_POSITION'),
	'TYPE' => 'LIST',
	'VALUES' => array(
		'left' => GetMessage('IMAGE_POSITION_LEFT'),
		'right' => GetMessage('IMAGE_POSITION_RIGHT'),
	),
	'DEFAULT' => 'left',
);

$arTemplateParameters['COUNT_IN_LINE'] = array(
	'PARENT' => 'LIST_SETTINGS',
	'NAME' => GetMessage('COUNT_IN_LINE'),
	'TYPE' => 'STRING',
	'DEFAULT' => '3',
);
?>