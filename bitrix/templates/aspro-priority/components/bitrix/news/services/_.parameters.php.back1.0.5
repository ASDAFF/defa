<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Web\Json;

if (!Loader::includeModule('iblock'))
	return;

CBitrixComponent::includeComponentClass('bitrix:catalog.section');

$arGalleryType = array('big' => GetMessage('GALLERY_BIG'), 'small' => GetMessage('GALLERY_SMALL'));

/* get component template pages & params array */
$arPageBlocksParams = array();
if(\Bitrix\Main\Loader::includeModule('aspro.priority')){
	$arPageBlocks = CPriority::GetComponentTemplatePageBlocks(__DIR__);
	$arPageBlocksParams = CPriority::GetComponentTemplatePageBlocksParams($arPageBlocks);
	
	CPriority::AddComponentTemplateModulePageBlocksParams(__DIR__, $arPageBlocksParams, array('SECTION' => 'SERVICES_PAGE', 'OPTION' => 'SECTIONS_TYPE_VIEW', 'CUSTOM_PARAM' => 'SERVICES_SECTIONS_TYPE_VIEW')); // add option value FROM_MODULE
	CPriority::AddComponentTemplateModulePageBlocksParams(__DIR__, $arPageBlocksParams, array('SECTION' => 'SERVICES_PAGE', 'OPTION' => 'SECTION_ELEMENTS_TYPE_VIEW', 'CUSTOM_PARAM' => 'SERVICES_SECTION_ELEMENTS_TYPE_VIEW')); // add option value FROM_MODULE
	CPriority::AddComponentTemplateModulePageBlocksParams(__DIR__, $arPageBlocksParams, array('SECTION' => 'SERVICES_PAGE', 'OPTION' => 'SERVICES')); // add option value FROM_MODULE
}

$arProperty_LNS = array();
$rsProp = CIBlockProperty::GetList(array("sort"=>"asc", "name"=>"asc"), array("ACTIVE"=>"Y", "IBLOCK_ID"=>(isset($arCurrentValues["TARIFS_IBLOCK_ID"])?$arCurrentValues["TARIFS_IBLOCK_ID"]:'')));
while ($arr=$rsProp->Fetch())
{
	$arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	if (in_array($arr["PROPERTY_TYPE"], array("L", "N", "S")))
	{
		$arProperty_LNS[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
	}
}

$arTemplateParameters = array_merge($arPageBlocksParams, array(
	'SHOW_DETAIL_LINK' => array(
		'PARENT' => 'LIST_SETTINGS',
		'NAME' => GetMessage('SHOW_DETAIL_LINK'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	'IMAGE_POSITION' => array(
		'PARENT' => 'LIST_SETTINGS',
		'SORT' => 250,
		'NAME' => GetMessage('IMAGE_POSITION'),
		'TYPE' => 'LIST',
		'VALUES' => array(
			'left' => GetMessage('IMAGE_POSITION_LEFT'),
			'right' => GetMessage('IMAGE_POSITION_RIGHT'),
		),
		'DEFAULT' => 'left',
	),
	'IMAGE_CATALOG_POSITION' => array(
		'PARENT' => 'LIST_SETTINGS',
		'SORT' => 250,
		'NAME' => GetMessage('IMAGE_CATALOG_POSITION'),
		'TYPE' => 'LIST',
		'VALUES' => array(
			'left' => GetMessage('IMAGE_POSITION_LEFT'),
			'right' => GetMessage('IMAGE_POSITION_RIGHT'),
		),
		'DEFAULT' => 'left',
	),
	'SHOW_SECTION_PREVIEW_DESCRIPTION' => array(
		'PARENT' => 'LIST_SETTINGS',
		'SORT' => 700,
		'NAME' => GetMessage('T_SHOW_SECTION_PREVIEW_DESCRIPTION'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	'SHOW_SECTION_DESCRIPTION' => array(
		'PARENT' => 'LIST_SETTINGS',
		'SORT' => 700,
		'NAME' => GetMessage('T_SHOW_SECTION_DESCRIPTION'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	/*'IMAGE_WIDE' => array(
		'PARENT' => 'LIST_SETTINGS',
		'SORT' => 700,
		'NAME' => GetMessage('T_IMAGE_WIDE'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N',
	),*/
	'LINE_ELEMENT_COUNT' => array(
		'PARENT' => 'LIST_SETTINGS',
		'SORT' => 700,
		'NAME' => GetMessage('T_LINE_ELEMENT_COUNT'),
		'TYPE' => 'LIST',
		'VALUES' => array(
			'2' => 2,
			'3' => 3,
		),
	),
	'LINE_ELEMENT_COUNT_LIST' => array(
		'PARENT' => 'LIST_SETTINGS',
		'SORT' => 700,
		'NAME' => GetMessage('T_LINE_ELEMENT_COUNT_LIST'),
		'TYPE' => 'STRING',
		'DEFAULT' => 3,
	),
	'SHOW_CHILD_SECTIONS' => array(
		'PARENT' => 'LIST_SETTINGS',
		'SORT' => 700,
		'NAME' => GetMessage('SHOW_CHILD_SECTIONS'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	'SHOW_NEXT_ELEMENT' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'SORT' => 600,
		'NAME' => GetMessage('T_SHOW_NEXT_ELEMENT'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N',
	),
	'USE_SHARE' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'SORT' => 600,
		'NAME' => GetMessage('USE_SHARE'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N',
	),
	'LANDING_IBLOCK_ID' => array(
		'SORT' => 1,
		'NAME' => GetMessage('LANDING_IBLOCK_ID_TITLE'),
		'TYPE' => 'TEXT',
		'PARENT' => 'ADDITIONAL',
		'DEFAULT' => '',
	),	
	'S_ASK_QUESTION' => array(
		'SORT' => 700,
		'NAME' => GetMessage('S_ASK_QUESTION'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'S_ORDER_SERVISE' => array(
		'SORT' => 701,
		'NAME' => GetMessage('S_ORDER_SERVISE'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'FORM_ID_ORDER_SERVISE' => array(
		'SORT' => 701,
		'NAME' => GetMessage('T_FORM_ID_ORDER_SERVISE'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'T_GALLERY' => array(
		'SORT' => 702,
		'NAME' => GetMessage('T_GALLERY'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
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
	'T_TARIF' => array(
		'SORT' => 706,
		'NAME' => GetMessage('T_TARIF'),
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
	'T_NEXT_LINK' => array(
		'SORT' => 707,
		'NAME' => GetMessage('T_NEXT_LINK'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'T_PREV_LINK' => array(
		'SORT' => 707,
		'NAME' => GetMessage('T_PREV_LINK'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'REVIEWS_IBLOCK_ID' => array(
		'SORT' => 704,
		'NAME' => GetMessage('REVIEWS_IBLOCK_ID'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	'TARIFS_IBLOCK_ID' => array(
		'SORT' => 704,
		'NAME' => GetMessage('TARIFS_IBLOCK_ID'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '',
	),
	"TARIFS_PROPERTY_CODE" => array(
		'SORT' => 704,
		"NAME" => GetMessage("T_IBLOCK_TARIF_PROPERTY"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"VALUES" => $arProperty_LNS,
		"ADDITIONAL_VALUES" => "Y",
	),
	'COUNT_TARIFS' => array(
		'SORT' => 704,
		'NAME' => GetMessage('T_COUNT_TARIFS'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '20',
	),
	'COUNT_SHOW_PROPRERTIES' => array(
		'SORT' => 704,
		'NAME' => GetMessage('T_COUNT_SHOW_PROPRERTIES'),
		'TYPE' => 'TEXT',
		'DEFAULT' => '4',
	),
	'SHOW_PROPS_NAME' => array(
		'NAME' => GetMessage('T_SHOW_PROPS_NAME'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
	),
	'COUNT_LG' => array(
		'NAME' => GetMessage('T_COUNT_LG'),
		'TYPE' => 'STRING',
		'DEFAULT' => '3',
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
	),
	'TARIFS_LINK_ELEMENTS_TEMPLATE' => array(
		'PARENT' => 'BASE',
		'SORT' => 1000,
		'NAME' => GetMessage('T_TARIFS_LINK_ELEMENTS_TEMPLATE'),
		'TYPE' => 'LIST',
		'VALUES' => array(
			'tarifs_linked_1' => GetMessage('T_BLOCK_WITH_ICONS'),
			'tarifs_linked_2' => GetMessage('T_BLOCK_WITH_ROUND_IMAGE'),
			'tarifs_linked_3' => GetMessage('T_BLOCK_WITH_IMAGE'),
			'tarifs_linked_4' => GetMessage('T_LIST_WITH_ICONS'),
			'tarifs_linked_5' => GetMessage('T_LIST_WITH_IMAGE'),
			'tarifs_linked_6' => GetMessage('T_LIST_WITH_ICONS_AND_COLUMN'),
			'tarifs_linked_7' => GetMessage('T_LIST_WITH_ICONS_AND_IMAGE'),
			'tarifs_linked_8' => GetMessage('T_LIST_WITH_ICONS_AND_INTERVAL'),
			'tarifs_linked_9' => GetMessage('T_LIST_WITH_IMAGE_AND_INTERVAL'),
			'tarifs_linked_custom' => 'tarifs_linked_custom',
		),
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
				'DEFAULT' => ''
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

$arTemplateParameters['LIST_PRODUCT_BLOCKS_ORDER'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_PRODUCT_BLOCKS_ORDER'),
	'TYPE' => 'CUSTOM',
	'JS_FILE' => CatalogSectionComponent::getSettingsScript('/bitrix/components/bitrix/catalog.section', 'dragdrop_order'),
	'JS_EVENT' => 'initDraggableOrderControl',
	'JS_DATA' => Json::encode(array(
		'order' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_ORDER'),
		'sale' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_SALE'),
		'tab' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_TAB'),
		'gallery' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_GALLERY'),
		'comments' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_COMMENTS'),
		'brand' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_BRAND'),
		'services' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_SERVICES'),
		'goods' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_GOODS'),
		'partners' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_PARTNERS'),
		'reviews' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_REVIEWS'),
		'staff' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_STAFF'),
		'vacancys' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_VACANCYS'),
		'sertificates' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_SERTIFICATES'),
	)),
	'DEFAULT' => 'sale,tab,gallery,comments,brand,services,goods,partners,reviews,staff,vacancys'
);
$arTemplateParameters['LIST_PRODUCT_BLOCKS_TAB_ORDER'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_PRODUCT_BLOCKS_TAB_ORDER'),
	'TYPE' => 'CUSTOM',
	'JS_FILE' => CatalogSectionComponent::getSettingsScript('/bitrix/components/bitrix/catalog.section', 'dragdrop_order'),
	'JS_EVENT' => 'initDraggableOrderControl',
	'JS_DATA' => Json::encode(array(
		'desc' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_DESC'),
		'char' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_CHAR'),
		'tarifs' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_TARIFS'),
		'projects' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_PROJECTS'),
		'faq' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_FAQ'),
		'docs' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_DOCS'),
		'video' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_VIDEO'),
	)),
	'DEFAULT' => 'desc,char,tarifs,projects,faq,docs,video'
);
$arTemplateParameters['LIST_PRODUCT_BLOCKS_ALL_ORDER'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_PRODUCT_BLOCKS_ALL_ORDER'),
	'TYPE' => 'CUSTOM',
	'JS_FILE' => CatalogSectionComponent::getSettingsScript('/bitrix/components/bitrix/catalog.section', 'dragdrop_order'),
	'JS_EVENT' => 'initDraggableOrderControl',
	'JS_DATA' => Json::encode(array(
		'order' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_ORDER'),
		'sale' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_SALE'),
		'gallery' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_GALLERY'),
		'comments' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_COMMENTS'),
		'brand' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_BRAND'),
		'services' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_SERVICES'),
		'goods' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_GOODS'),
		'previews_desc' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_DESC_PREVIEW'),
		'desc' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_DESC'),
		'char' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_CHAR'),
		'tarifs' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_TARIFS'),
		'projects' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_PROJECTS'),
		'faq' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_FAQ'),
		'partners' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_PARTNERS'),
		'reviews' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_REVIEWS'),
		'staff' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_STAFF'),
		'vacancys' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_VACANCYS'),
		'sertificates' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_SERTIFICATES'),
		'docs' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_DOCS'),
		'video' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_VIDEO'),
	)),
	'DEFAULT' => 'sale,desc,char,tarifs,projects,faq,docs,video,gallery,comments,brand,services,goods,partners,reviews,staff,vacancys'
);
?>