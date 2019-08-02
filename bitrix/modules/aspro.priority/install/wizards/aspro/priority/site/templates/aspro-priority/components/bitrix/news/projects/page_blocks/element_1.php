<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"projects",
	Array(
		"S_ASK_QUESTION" => $arParams["S_ASK_QUESTION"],
		"S_ORDER_SERVISE" => $arParams["S_ORDER_SERVISE"],
		"T_GALLERY" => $arParams["T_GALLERY"],
		"T_DOCS" => $arParams["T_DOCS"],
		"T_GOODS" => $arParams["T_GOODS"],
		"T_VIDEO" => $arParams["T_VIDEO"],
		"T_REVIEWS" => $arParams["T_REVIEWS"],
		"T_PROJECTS" => $arParams["T_PROJECTS"],
		"T_SERVICES" => $arParams["T_SERVICES"],
		"T_ITEMS" => $arParams["T_ITEMS"],
		"T_STAFF" => $arParams["T_STAFF"],
		"T_PARTNERS" => $arParams["T_PARTNERS"],
		"T_FAQ" => $arParams["T_FAQ"],
		"T_VACANCYS" => $arParams["T_VACANCYS"],
		"T_SERTIFICATES" => $arParams["T_SERTIFICATES"],
		"BRAND_PROP_CODE" => $arParams["DETAIL_BRAND_PROP_CODE"],
		"BRAND_USE" => $arParams["DETAIL_BRAND_USE"],
		"FORM_ID_ORDER_SERVISE" => ($arParams["FORM_ID_ORDER_SERVISE"] ? $arParams["FORM_ID_ORDER_SERVISE"] : ''),
		"SERVICES_LINK_ELEMENTS_TEMPLATE" => $arParams["SERVICES_LINK_ELEMENTS_TEMPLATE"],
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_CANONICAL_URL" => $arParams["DETAIL_SET_CANONICAL_URL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ADD_ELEMENT_CHAIN" => $arParams["ADD_ELEMENT_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"LIST_PRODUCT_BLOCKS_ALL_ORDER" => ($arParams["LIST_PRODUCT_BLOCKS_ALL_ORDER"] ? $arParams["LIST_PRODUCT_BLOCKS_ALL_ORDER"] : "tizers,sale,tarifs,desc,char,projects,faq,docs,video,gallery,comments,brand,services,goods"),
		// "CACHE_TYPE" => "N",
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" 			=> $arParams["USE_SHARE"],
		"SHARE_HIDE" 			=> $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" 		=> $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" 		=> $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN"	=> $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
		"GALLERY_TYPE" => $arParams["GALLERY_TYPE"],
		"REVIEWS_IBLOCK_ID" => $arParams["REVIEWS_IBLOCK_ID"],
		"PROJECTS_IBLOCK_ID" => $arParams["PROJECTS_IBLOCK_ID"],
		"SERVICES_IBLOCK_ID" => $arParams["SERVICES_IBLOCK_ID"],
		"CATALOG_IBLOCK_ID" => $arParams["CATALOG_IBLOCK_ID"],
		"STAFF_IBLOCK_ID" => $arParams["STAFF_IBLOCK_ID"],
		"PARTNERS_IBLOCK_ID" => $arParams["PARTNERS_IBLOCK_ID"],
		"NEWS_IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"],
		"FAQ_IBLOCK_ID" => $arParams["FAQ_IBLOCK_ID"],
		"VACANCYS_IBLOCK_ID" => $arParams["VACANCYS_IBLOCK_ID"],
		"SERTIFICATES_IBLOCK_ID" => $arParams["SERTIFICATES_IBLOCK_ID"],
		"COMMENTS_COUNT" => $arParams['COMMENTS_COUNT'],
		"DETAIL_USE_COMMENTS" => $arParams['DETAIL_USE_COMMENTS'],
		"FB_USE" => $arParams["DETAIL_FB_USE"],
		"VK_USE" => $arParams["DETAIL_VK_USE"],
		"BLOG_USE" => $arParams["DETAIL_BLOG_USE"],
		"BLOG_TITLE" => $arParams["BLOG_TITLE"],
		"BLOG_URL" => $arParams["DETAIL_BLOG_URL"],
		"EMAIL_NOTIFY" => $arParams["DETAIL_BLOG_EMAIL_NOTIFY"],
		"FB_TITLE" => $arParams["FB_TITLE"],
		"FB_APP_ID" => $arParams["DETAIL_FB_APP_ID"],
		"VK_TITLE" => $arParams["VK_TITLE"],
		"VK_API_ID" => $arParams["DETAIL_VK_API_ID"],
		"STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],
		'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
		'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
	),
	$component
);?>