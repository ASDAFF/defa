<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Услуги");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"services", 
	array(
		"IBLOCK_TYPE" => "aspro_priority_catalog",
		"IBLOCK_ID" => "#IBLOCK_SERVICES_ID#",
		"NEWS_COUNT" => "20",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "Y",
		"FILTER_NAME" => "arrFilter",
		"COUNT_TARIFS" => 20,
		"COUNT_SHOW_PROPRERTIES" => 4,
		"TARIFS_PROPERTY_CODE" => array(
			0 => "ICON",
			1 => "FORM_ORDER",
			2 => "VISA",
			3 => "NUM_DEVICES",
			4 => "APPLE",
			5 => "DURATION",
			6 => "ELPURSE",
			7 => "API_INTEGRATION",
			8 => "SIEM_SYSTEM",
			9 => "HIT",
			10 => "COLLECT_INFO",
			11 => "KOLLICHESTVO_BAZ_DANNIX",
			12 => "TARIF_PRICE_1",
			13 => "TARIF_PRICE_2",
			14 => "TARIF_PRICE_3",
			15 => "TARIF_PRICE_DEFAULT",
			16 => "ONLY_ONE_PRICE",
			17 => "RULES_SIGNAT",
			18 => "SCANNER",
			19 => "ANTIVIRUS",
			20 => "PROTECT_PAYMENT",
			21 => "PROTECT_CAMERA",
			22 => "ANTIVOR",
			23 => "CONTROL",
			24 => "SUPPORT_FREE",
			25 => "GUARANTEE",
			26 => "BLOCKING_SITES",
			27 => "BLOCKING_TRAFFIC",
			28 => "SECURITY",
			29 => "PROTECT_CHILDREN",
			30 => "SUM_FINANCING",
			31 => "TERM_LEASING",
			32 => "INSURANCE",
			33 => "CURRENCY",
			34 => "ADVANCE_PAY",
			35 => "RATE",
			36 => "PERCENTAGE",
			37 => "PAYMENTS",
			38 => "SUPPORT",
			39 => "NOTIFICATION",
			40 => "TURN",
		),
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "DESC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "#SITE_DIR#services/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "100000",
		"LANDING_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_advt"]["aspro_priority_catalog_info"][0],
		"LANDING_SECTION_COUNT" => "20",
		"LANDING" => "",
		"LANDING_SECTION_COUNT_VISIBLE" => "10",
		"LANDING_TIZER_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_tizers_landing"][0],		
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"USE_PERMISSIONS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "221",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "PRICE",
			1 => "PRICE_OLD",
			2 => "SROKI",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "N",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"TARIFS_LINK_ELEMENTS_TEMPLATE" => "tarifs_linked_4",
		"DETAIL_FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "DETAIL_TEXT",
			2 => "DETAIL_PICTURE",
			3 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "VIDEO_IFRAME",
			1 => "FORM_ORDER",
			2 => "FORM_QUESTION",
			3 => "LINK_SALE",
			4 => "LINK_SERVICES",
			5 => "LINK_PARTNERS",
			6 => "LINK_FAQ",
			7 => "LINK_VACANCYS",
			8 => "LINK_GOODS",
			9 => "LINK_STAFF",
			10 => "LINK_REVIEWS",
			11 => "LINK_PROJECTS",
			12 => "CHARSET",
			13 => "SROKI",
			14 => "SKYPE",
			15 => "SYSTEM_MODEL",
			16 => "LINK_SERTIFICATES",
			17 => "DOCUMENTS",
			18 => "PHOTOS",
			19 => "LINK_TARIFS",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"IMAGE_POSITION" => "left",
		"USE_SHARE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"USE_REVIEW" => "N",
		"ADD_ELEMENT_CHAIN" => "Y",
		"IMAGE_CATALOG_POSITION" => "left",
		"SHOW_DETAIL_LINK" => "Y",
		"S_ASK_QUESTION" => "",
		"S_ORDER_SERVICE" => "",
		"T_GALLERY" => "",
		"T_DOCS" => "",
		"T_GOODS" => "",
		"T_SERVICES" => "",
		"T_PROJECTS" => "",
		"T_REVIEWS" => "",
		"T_STAFF" => "",
		"REVIEWS_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_form"]["aspro_priority_add_review"][0],
		"PROJECTS_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_projects"][0],
		"SERVICES_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_catalog"]["aspro_priority_services"][0],
		"CATALOG_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_catalog"]["aspro_priority_catalog"][0],
		"STAFF_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_staff"][0],
		"PARTNERS_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_partners"][0],
		"NEWS_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_news"][0],
		"FAQ_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_faq"][0],
		"VACANCYS_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_vacancy"][0],
		"SERTIFICATES_IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_licenses"][0],
		"TARIFS_IBLOCK_ID" => "#TARIFS_IBLOCK_ID#",
		"SERVICES_LINK_ELEMENTS_TEMPLATE" => "services_linked_2",
		"LIST_PRODUCT_BLOCKS_ORDER" => "order,tab,gallery,brand,services,sale,goods,partners,reviews,staff,vacancys,sertificates,comments",
		"LIST_PRODUCT_BLOCKS_TAB_ORDER" => "desc,char,tarifs,projects,faq,docs,video",
		"LIST_PRODUCT_BLOCKS_ALL_ORDER" => "order,previews_desc,desc,char,tarifs,docs,video,gallery,projects,brand,services,sale,goods,partners,reviews,staff,vacancys,sertificates,faq,comments",
		"COMPONENT_TEMPLATE" => "services",
		"SET_LAST_MODIFIED" => "N",
		"T_VIDEO" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"VIEW_TYPE" => "row_block",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"VIEW_TYPE_SECTION" => "row_block",
		"SHOW_CHILD_SECTIONS" => "Y",
		"GALLERY_TYPE" => "big",
		"PREVIEW_REVIEW_TRUNCATE_LEN" => "255",
		"SECTIONS_TYPE_VIEW" => "FROM_MODULE",
		"SECTION_TYPE_VIEW" => "section_2",
		"ELEMENT_TYPE_VIEW" => "FROM_MODULE",
		"SHOW_SECTION_PREVIEW_DESCRIPTION" => "Y",
		"LINE_ELEMENT_COUNT" => "2",
		"SECTION_ELEMENTS_TYPE_VIEW" => "FROM_MODULE",
		"SHOW_SECTION_DESCRIPTION" => "Y",
		"LINE_ELEMENT_COUNT_LIST" => "3",
		"S_ORDER_SERVISE" => "",
		"FORM_ID_ORDER_SERVISE" => "",
		"T_NEXT_LINK" => "",
		"T_PREV_LINK" => "",
		"SHOW_NEXT_ELEMENT" => "N",
		"IMAGE_WIDE" => "N",
		"DETAIL_STRICT_SECTION_CHECK" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"DETAIL_USE_COMMENTS" => "Y",
		"DETAIL_BLOG_USE" => "Y",
		"DETAIL_BLOG_URL" => "catalog_comments",
		"COMMENTS_COUNT" => "5",
		"BLOG_TITLE" => "Комментарии",
		"DETAIL_BLOG_EMAIL_NOTIFY" => "N",
		"DETAIL_VK_USE" => "Y",
		"VK_TITLE" => "Вконтакте",
		"DETAIL_VK_API_ID" => "",
		"DETAIL_FB_USE" => "Y",
		"FB_TITLE" => "Facebook",
		"DETAIL_FB_APP_ID" => "",
		"T_NEWS" => "",
		"T_CHARACTERISTICS" => "",
		"T_FAQ" => "",
		"T_DESC" => "",
		"T_ITEMS" => "",
		"T_PARTNERS" => "",
		"T_VACANCYS" => "",
		"T_SERTIFICATES" => "",
		"FILE_404" => "",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "#SECTION_CODE_PATH#/",
			"detail" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
		)
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>