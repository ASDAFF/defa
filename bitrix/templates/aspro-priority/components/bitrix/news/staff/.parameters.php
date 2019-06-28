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
	'SHOW_SECTION_PREVIEW_DESCRIPTION' => array(
		'PARENT' => 'LIST_SETTINGS',
		'SORT' => 500,
		'NAME' => GetMessage('SHOW_SECTION_PREVIEW_DESCRIPTION'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	'T_DOCS' => array(
		'SORT' => 703,
		'NAME' => GetMessage('T_DOCS'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'T_CHARACTERISTICS' => array(
		'SORT' => 705,
		'NAME' => GetMessage('T_CHARACTERISTICS'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
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
	'T_DESC' => array(
		'SORT' => 706,
		'NAME' => GetMessage('T_DESC'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'T_NEWS' => array(
		'SORT' => 706,
		'NAME' => GetMessage('T_NEWS'),
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
$arTemplateParameters['DETAIL_USE_COMMENTS'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_DETAIL_USE_COMMENTS'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'N',
	'REFRESH' => 'Y'
);

if ('Y' == $arCurrentValues['DETAIL_USE_COMMENTS'])
{
	if (\Bitrix\Main\ModuleManager::isModuleInstalled("blog"))
	{
		$arTemplateParameters['DETAIL_BLOG_USE'] = array(
			'PARENT' => 'DETAIL_SETTINGS',
			'NAME' => GetMessage('CP_BC_TPL_DETAIL_BLOG_USE'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'N',
			'REFRESH' => 'Y'
		);
		if (isset($arCurrentValues['DETAIL_BLOG_USE']) && $arCurrentValues['DETAIL_BLOG_USE'] == 'Y')
		{
			$arTemplateParameters['DETAIL_BLOG_URL'] = array(
				'PARENT' => 'DETAIL_SETTINGS',
				'NAME' => GetMessage('CP_BC_DETAIL_TPL_BLOG_URL'),
				'TYPE' => 'STRING',
				'DEFAULT' => 'catalog_comments'
			);
			$arTemplateParameters['COMMENTS_COUNT'] = array(
				'PARENT' => 'DETAIL_SETTINGS',
				'NAME' => GetMessage('T_COMMENTS_COUNT'),
				'TYPE' => 'STRING',
				'DEFAULT' => '5'
			);
			$arTemplateParameters['BLOG_TITLE'] = array(
				'PARENT' => 'DETAIL_SETTINGS',
				'NAME' => GetMessage('BLOCK_TITLE_TAB'),
				'TYPE' => 'STRING',
				'DEFAULT' => GetMessage('S_COMMENTS_VALUE')
			);
			$arTemplateParameters['DETAIL_BLOG_EMAIL_NOTIFY'] = array(
				'PARENT' => 'DETAIL_SETTINGS',
				'NAME' => GetMessage('CP_BC_TPL_DETAIL_BLOG_EMAIL_NOTIFY'),
				'TYPE' => 'CHECKBOX',
				'DEFAULT' => 'N'
			);
		}
	}

	$boolRus = false;
	$langBy = "id";
	$langOrder = "asc";
	$rsLangs = CLanguage::GetList($langBy, $langOrder, array('ID' => 'ru',"ACTIVE" => "Y"));

	if ($arLang = $rsLangs->Fetch())
	{
		$boolRus = true;
	}

	if ($boolRus)
	{
		$arTemplateParameters['DETAIL_VK_USE'] = array(
			'PARENT' => 'DETAIL_SETTINGS',
			'NAME' => GetMessage('CP_BC_TPL_DETAIL_VK_USE'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'N',
			'REFRESH' => 'Y'
		);

		if (isset($arCurrentValues['DETAIL_VK_USE']) && 'Y' == $arCurrentValues['DETAIL_VK_USE'])
		{
			$arTemplateParameters['VK_TITLE'] = array(
				'PARENT' => 'DETAIL_SETTINGS',
				'NAME' => GetMessage('BLOCK_TITLE_TAB'),
				'TYPE' => 'STRING',
				'DEFAULT' => GetMessage('S_VK_VALUE')
			);
			$arTemplateParameters['DETAIL_VK_API_ID'] = array(
				'PARENT' => 'DETAIL_SETTINGS',
				'NAME' => GetMessage('CP_BC_TPL_DETAIL_VK_API_ID'),
				'TYPE' => 'STRING',
				'DEFAULT' => 'API_ID'
			);
		}
	}

	$arTemplateParameters['DETAIL_FB_USE'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_DETAIL_FB_USE'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N',
		'REFRESH' => 'Y'
	);

	if (isset($arCurrentValues['DETAIL_FB_USE']) && 'Y' == $arCurrentValues['DETAIL_FB_USE'])
	{
		$arTemplateParameters['FB_TITLE'] = array(
			'PARENT' => 'DETAIL_SETTINGS',
			'NAME' => GetMessage('BLOCK_TITLE_TAB'),
			'TYPE' => 'STRING',
			'DEFAULT' => GetMessage('S_FB_VALUE')
		);
		$arTemplateParameters['DETAIL_FB_APP_ID'] = array(
			'PARENT' => 'DETAIL_SETTINGS',
			'NAME' => GetMessage('CP_BC_TPL_DETAIL_FB_APP_ID'),
			'TYPE' => 'STRING',
			'DEFAULT' => ''
		);
	}
}
?>
