<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новости");
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"news", 
	array(
		"IBLOCK_TYPE" => "aspro_next_content",
		"IBLOCK_ID" => "10",
		"NEWS_COUNT" => "6",
		"USE_SEARCH" => "N",
		"USE_RSS" => "Y",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "Y",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/news/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"USE_PERMISSIONS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "j F Y",
		"LIST_FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "DATE_ACTIVE_FROM",
			4 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "PERIOD",
			1 => "REDIRECT",
			2 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "N",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_ACTIVE_DATE_FORMAT" => "j F Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "DETAIL_TEXT",
			2 => "DETAIL_PICTURE",
			3 => "DATE_ACTIVE_FROM",
			4 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "LINK_GOODS",
			1 => "PHOTOS",
			2 => "FORM_QUESTION",
			3 => "FORM_ORDER",
			4 => "PERIOD",
			5 => "PHOTOPOS",
			6 => "LINK_SERVICES",
			7 => "DOCUMENTS",
			8 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"PAGER_TEMPLATE" => "main",
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
		"SHOW_DETAIL_LINK" => "Y",
		"S_ASK_QUESTION" => "",
		"S_ORDER_SERVISE" => "",
		"T_GALLERY" => "",
		"T_DOCS" => "",
		"T_GOODS" => "",
		"T_SERVICES" => "",
		"T_STUDY" => "",
		"COMPONENT_TEMPLATE" => "news",
		"SET_LAST_MODIFIED" => "N",
		"T_VIDEO" => "",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"NUM_NEWS" => "20",
		"NUM_DAYS" => "30",
		"YANDEX" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"SECTION_ELEMENTS_TYPE_VIEW" => "FROM_MODULE",
		"ELEMENT_TYPE_VIEW" => "element_1",
		"S_ORDER_SERVICE" => "",
		"T_PROJECTS" => "",
		"T_REVIEWS" => "",
		"T_STAFF" => "",
		"IMAGE_CATALOG_POSITION" => "left",
		"SHOW_SECTION_PREVIEW_DESCRIPTION" => "Y",
		"SHOW_SECTION_DESCRIPTION" => "Y",
		"LINE_ELEMENT_COUNT" => "3",
		"LINE_ELEMENT_COUNT_LIST" => "3",
		"SHOW_CHILD_SECTIONS" => "N",
		"GALLERY_TYPE" => "small",
		"INCLUDE_SUBSECTIONS" => "Y",
		"FORM_ID_ORDER_SERVISE" => "",
		"T_NEXT_LINK" => "",
		"T_PREV_LINK" => "",
		"SHOW_NEXT_ELEMENT" => "N",
		"IMAGE_WIDE" => "N",
		"SHOW_FILTER_DATE" => "Y",
		"FILTER_NAME" => "arRegionLink",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_STRICT_SECTION_CHECK" => "Y",
		"STRICT_SECTION_CHECK" => "Y",
		"LIST_VIEW" => "slider",
		"LINKED_ELEMENST_PAGE_COUNT" => "20",
		"SHOW_DISCOUNT_PERCENT_NUMBER" => "N",
		"PRICE_CODE" => array(
		),
		"STORES" => array(
			0 => "",
			1 => "",
		),
		"HIDE_NOT_AVAILABLE" => "N",
		"FILE_404" => "",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
			"rss" => "rss/",
			"rss_section" => "#SECTION_ID#/rss/",
		)
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>