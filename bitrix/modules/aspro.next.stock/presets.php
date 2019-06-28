<?php
/**
 * Aspro:Next module params presets
 * @copyright 2018 Aspro
 */

IncludeModuleLangFile(__FILE__);
$moduleClass = 'CNextStock';
$solution = ASPRO_NEXT_STOCK_MODULE_ID;

// initialize module parametrs list and default values
$moduleClass::$arPresetsList = array(
	0 => array(
		'ID' => 968,
		'TITLE' => GetMessage('PRESET_968_TITLE'),
		'DESCRIPTION' => '',
		'IMG' => '/bitrix/images/aspro.next/themes/preset968_1544181424.png',
		'OPTIONS' => array(
			'THEME_SWITCHER' => 'Y',
			'BASE_COLOR' => '9',
			'BASE_COLOR_CUSTOM' => '1976d2',
			'SHOW_BG_BLOCK' => 'N',
			'COLORED_LOGO' => 'Y',
			'PAGE_WIDTH' => '3',
			'FONT_STYLE' => '2',
			'MENU_COLOR' => 'COLORED',
			'LEFT_BLOCK' => '1',
			'SIDE_MENU' => 'LEFT',
			'H1_STYLE' => '2',
			'TYPE_SEARCH' => 'fixed',
			'PAGE_TITLE' => '1',
			'HOVER_TYPE_IMG' => 'shine',
			'SHOW_LICENCE' => 'Y',
			'MAX_DEPTH_MENU' => '3',
			'HIDE_SITE_NAME_TITLE' => 'Y',
			'SHOW_CALLBACK' => 'Y',
			'PRINT_BUTTON' => 'N',
			'USE_GOOGLE_RECAPTCHA' => 'N',
			'GOOGLE_RECAPTCHA_SHOW_LOGO' => 'Y',
			'HIDDEN_CAPTCHA' => 'Y',
			'INSTAGRAMM_WIDE_BLOCK' => 'N',
			'BIGBANNER_HIDEONNARROW' => 'N',
			'INDEX_TYPE' => array(
				'VALUE' => 'index1',
				'SUB_PARAMS' => array(
					'TIZERS' => 'Y',
					'CATALOG_SECTIONS' => 'Y',
					'CATALOG_TAB' => 'Y',
					'MIDDLE_ADV' => 'Y',
					'SALE' => 'Y',
					'BLOG' => 'Y',
					'BOTTOM_BANNERS' => 'Y',
					'COMPANY_TEXT' => 'Y',
					'BRANDS' => 'Y',
					'INSTAGRAMM' => 'Y',
				),
			),
			'FRONT_PAGE_BRANDS' => 'brands_slider',
			'FRONT_PAGE_SECTIONS' => 'front_sections_only',
			'TOP_MENU_FIXED' => 'Y',
			'HEADER_TYPE' => '1',
			'USE_REGIONALITY' => 'Y',
			'FILTER_VIEW' => 'COMPACT',
			'SEARCH_VIEW_TYPE' => 'with_filter',
			'USE_FAST_VIEW_PAGE_DETAIL' => 'fast_view_1',
			'SHOW_TOTAL_SUMM' => 'Y',
			'CHANGE_TITLE_ITEM' => 'N',
			'VIEW_TYPE_HIGHLOAD_PROP' => 'N',
			'SHOW_HEADER_GOODS' => 'Y',
			'SEARCH_HIDE_NOT_AVAILABLE' => 'N',
			'LEFT_BLOCK_CATALOG_ICONS' => 'N',
			'SHOW_CATALOG_SECTIONS_ICONS' => 'Y',
			'LEFT_BLOCK_CATALOG_DETAIL' => 'Y',
			'CATALOG_COMPARE' => 'Y',
			'CATALOG_PAGE_DETAIL' => 'element_1',
			'SHOW_BREADCRUMBS_CATALOG_SUBSECTIONS' => 'Y',
			'SHOW_BREADCRUMBS_CATALOG_CHAIN' => 'H1',
			'TYPE_SKU' => 'TYPE_1',
			'DETAIL_PICTURE_MODE' => 'POPUP',
			'MENU_POSITION' => 'LINE',
			'MENU_TYPE_VIEW' => 'HOVER',
			'VIEWED_TYPE' => 'LOCAL',
			'VIEWED_TEMPLATE' => 'HORIZONTAL',
			'USE_WORD_EXPRESSION' => 'Y',
			'ORDER_BASKET_VIEW' => 'FLY',
			'ORDER_BASKET_COLOR' => 'DARK',
			'SHOW_BASKET_ONADDTOCART' => 'Y',
			'SHOW_BASKET_PRINT' => 'Y',
			'SHOW_BASKET_ON_PAGES' => 'N',
			'USE_PRODUCT_QUANTITY_LIST' => 'Y',
			'USE_PRODUCT_QUANTITY_DETAIL' => 'Y',
			'ONE_CLICK_BUY_CAPTCHA' => 'N',
			'SHOW_ONECLICKBUY_ON_BASKET_PAGE' => 'Y',
			'ONECLICKBUY_SHOW_DELIVERY_NOTE' => 'N',
			'PAGE_CONTACTS' => '3',
			'CONTACTS_USE_FEEDBACK' => 'Y',
			'CONTACTS_USE_MAP' => 'Y',
			'BLOG_PAGE' => 'list_elements_2',
			'PROJECTS_PAGE' => 'list_elements_2',
			'NEWS_PAGE' => 'list_elements_3',
			'STAFF_PAGE' => 'list_elements_1',
			'PARTNERS_PAGE' => 'list_elements_3',
			'PARTNERS_PAGE_DETAIL' => 'element_4',
			'VACANCY_PAGE' => 'list_elements_1',
			'LICENSES_PAGE' => 'list_elements_2',
			'FOOTER_TYPE' => '4',
			'ADV_TOP_HEADER' => 'N',
			'ADV_TOP_UNDERHEADER' => 'N',
			'ADV_SIDE' => 'Y',
			'ADV_CONTENT_TOP' => 'N',
			'ADV_CONTENT_BOTTOM' => 'N',
			'ADV_FOOTER' => 'N',
			'HEADER_MOBILE_FIXED' => 'Y',
			'HEADER_MOBILE' => '1',
			'HEADER_MOBILE_MENU' => '1',
			'HEADER_MOBILE_MENU_OPEN' => '1',
			'PERSONAL_ONEFIO' => 'Y',
			'LOGIN_EQUAL_EMAIL' => 'Y',
			'YA_GOALS' => 'N',
			'YANDEX_ECOMERCE' => 'N',
			'GOOGLE_ECOMERCE' => 'N',
		),
	),
	1 => array(
		'ID' => 221,
		'TITLE' => GetMessage('PRESET_221_TITLE'),
		'DESCRIPTION' => '',
		'IMG' => '/bitrix/images/aspro.next/themes/preset221_1544181431.png',
		'OPTIONS' => array(
			'THEME_SWITCHER' => 'Y',
			'BASE_COLOR' => '11',
			'BASE_COLOR_CUSTOM' => '107bb1',
			'SHOW_BG_BLOCK' => 'N',
			'COLORED_LOGO' => 'Y',
			'PAGE_WIDTH' => '2',
			'FONT_STYLE' => '8',
			'MENU_COLOR' => 'LIGHT',
			'LEFT_BLOCK' => '2',
			'SIDE_MENU' => 'LEFT',
			'H1_STYLE' => '2',
			'TYPE_SEARCH' => 'fixed',
			'PAGE_TITLE' => '1',
			'HOVER_TYPE_IMG' => 'shine',
			'SHOW_LICENCE' => 'Y',
			'MAX_DEPTH_MENU' => '4',
			'HIDE_SITE_NAME_TITLE' => 'Y',
			'SHOW_CALLBACK' => 'Y',
			'PRINT_BUTTON' => 'N',
			'USE_GOOGLE_RECAPTCHA' => 'N',
			'GOOGLE_RECAPTCHA_SHOW_LOGO' => 'Y',
			'HIDDEN_CAPTCHA' => 'Y',
			'INSTAGRAMM_WIDE_BLOCK' => 'N',
			'BIGBANNER_HIDEONNARROW' => 'N',
			'INDEX_TYPE' => array(
				'VALUE' => 'index3',
				'SUB_PARAMS' => array(
					'TOP_ADV_BOTTOM_BANNER' => 'Y',
					'FLOAT_BANNER' => 'Y',
					'CATALOG_SECTIONS' => 'Y',
					'CATALOG_TAB' => 'Y',
					'TIZERS' => 'Y',
					'SALE' => 'Y',
					'BOTTOM_BANNERS' => 'Y',
					'COMPANY_TEXT' => 'Y',
					'BRANDS' => 'Y',
					'INSTAGRAMM' => 'N',
				),
			),
			'FRONT_PAGE_BRANDS' => 'brands_slider',
			'FRONT_PAGE_SECTIONS' => 'front_sections_with_childs',
			'TOP_MENU_FIXED' => 'Y',
			'HEADER_TYPE' => '2',
			'USE_REGIONALITY' => 'Y',
			'FILTER_VIEW' => 'VERTICAL',
			'SEARCH_VIEW_TYPE' => 'with_filter',
			'USE_FAST_VIEW_PAGE_DETAIL' => 'fast_view_1',
			'SHOW_TOTAL_SUMM' => 'Y',
			'CHANGE_TITLE_ITEM' => 'N',
			'VIEW_TYPE_HIGHLOAD_PROP' => 'N',
			'SHOW_HEADER_GOODS' => 'Y',
			'SEARCH_HIDE_NOT_AVAILABLE' => 'N',
			'LEFT_BLOCK_CATALOG_ICONS' => 'N',
			'SHOW_CATALOG_SECTIONS_ICONS' => 'Y',
			'LEFT_BLOCK_CATALOG_DETAIL' => 'Y',
			'CATALOG_COMPARE' => 'Y',
			'CATALOG_PAGE_DETAIL' => 'element_3',
			'SHOW_BREADCRUMBS_CATALOG_SUBSECTIONS' => 'Y',
			'SHOW_BREADCRUMBS_CATALOG_CHAIN' => 'H1',
			'TYPE_SKU' => 'TYPE_1',
			'DETAIL_PICTURE_MODE' => 'POPUP',
			'MENU_POSITION' => 'LINE',
			'MENU_TYPE_VIEW' => 'HOVER',
			'VIEWED_TYPE' => 'LOCAL',
			'VIEWED_TEMPLATE' => 'HORIZONTAL',
			'USE_WORD_EXPRESSION' => 'Y',
			'ORDER_BASKET_VIEW' => 'NORMAL',
			'ORDER_BASKET_COLOR' => 'DARK',
			'SHOW_BASKET_ONADDTOCART' => 'Y',
			'SHOW_BASKET_PRINT' => 'Y',
			'SHOW_BASKET_ON_PAGES' => 'N',
			'USE_PRODUCT_QUANTITY_LIST' => 'Y',
			'USE_PRODUCT_QUANTITY_DETAIL' => 'Y',
			'ONE_CLICK_BUY_CAPTCHA' => 'N',
			'SHOW_ONECLICKBUY_ON_BASKET_PAGE' => 'Y',
			'ONECLICKBUY_SHOW_DELIVERY_NOTE' => 'N',
			'PAGE_CONTACTS' => '3',
			'CONTACTS_USE_FEEDBACK' => 'Y',
			'CONTACTS_USE_MAP' => 'Y',
			'BLOG_PAGE' => 'list_elements_2',
			'PROJECTS_PAGE' => 'list_elements_2',
			'NEWS_PAGE' => 'list_elements_3',
			'STAFF_PAGE' => 'list_elements_1',
			'PARTNERS_PAGE' => 'list_elements_3',
			'PARTNERS_PAGE_DETAIL' => 'element_4',
			'VACANCY_PAGE' => 'list_elements_1',
			'LICENSES_PAGE' => 'list_elements_2',
			'FOOTER_TYPE' => '1',
			'ADV_TOP_HEADER' => 'N',
			'ADV_TOP_UNDERHEADER' => 'N',
			'ADV_SIDE' => 'Y',
			'ADV_CONTENT_TOP' => 'N',
			'ADV_CONTENT_BOTTOM' => 'N',
			'ADV_FOOTER' => 'N',
			'HEADER_MOBILE_FIXED' => 'Y',
			'HEADER_MOBILE' => '1',
			'HEADER_MOBILE_MENU' => '1',
			'HEADER_MOBILE_MENU_OPEN' => '1',
			'PERSONAL_ONEFIO' => 'Y',
			'LOGIN_EQUAL_EMAIL' => 'Y',
			'YA_GOALS' => 'N',
			'YANDEX_ECOMERCE' => 'N',
			'GOOGLE_ECOMERCE' => 'N',
		),
	),
	2 => array(
		'ID' => 215,
		'TITLE' => GetMessage('PRESET_215_TITLE'),
		'DESCRIPTION' => '',
		'IMG' => '/bitrix/images/aspro.next/themes/preset215_1544181438.png',
		'OPTIONS' => array(
			'THEME_SWITCHER' => 'Y',
			'BASE_COLOR' => '16',
			'BASE_COLOR_CUSTOM' => '188b30',
			'SHOW_BG_BLOCK' => 'N',
			'COLORED_LOGO' => 'Y',
			'PAGE_WIDTH' => '3',
			'FONT_STYLE' => '8',
			'MENU_COLOR' => 'LIGHT',
			'LEFT_BLOCK' => '3',
			'SIDE_MENU' => 'LEFT',
			'H1_STYLE' => '2',
			'TYPE_SEARCH' => 'fixed',
			'PAGE_TITLE' => '1',
			'HOVER_TYPE_IMG' => 'shine',
			'SHOW_LICENCE' => 'Y',
			'MAX_DEPTH_MENU' => '4',
			'HIDE_SITE_NAME_TITLE' => 'Y',
			'SHOW_CALLBACK' => 'Y',
			'PRINT_BUTTON' => 'N',
			'USE_GOOGLE_RECAPTCHA' => 'N',
			'GOOGLE_RECAPTCHA_SHOW_LOGO' => 'Y',
			'HIDDEN_CAPTCHA' => 'Y',
			'INSTAGRAMM_WIDE_BLOCK' => 'N',
			'BIGBANNER_HIDEONNARROW' => 'N',
			'INDEX_TYPE' => array(
				'VALUE' => 'index2',
				'SUB_PARAMS' => array(
				),
			),
			'FRONT_PAGE_BRANDS' => 'brands_list',
			'FRONT_PAGE_SECTIONS' => 'front_sections_with_childs',
			'TOP_MENU_FIXED' => 'Y',
			'HEADER_TYPE' => '2',
			'USE_REGIONALITY' => 'Y',
			'FILTER_VIEW' => 'VERTICAL',
			'SEARCH_VIEW_TYPE' => 'with_filter',
			'USE_FAST_VIEW_PAGE_DETAIL' => 'fast_view_1',
			'SHOW_TOTAL_SUMM' => 'Y',
			'CHANGE_TITLE_ITEM' => 'N',
			'VIEW_TYPE_HIGHLOAD_PROP' => 'N',
			'SHOW_HEADER_GOODS' => 'Y',
			'SEARCH_HIDE_NOT_AVAILABLE' => 'N',
			'LEFT_BLOCK_CATALOG_ICONS' => 'N',
			'SHOW_CATALOG_SECTIONS_ICONS' => 'Y',
			'LEFT_BLOCK_CATALOG_DETAIL' => 'Y',
			'CATALOG_COMPARE' => 'Y',
			'CATALOG_PAGE_DETAIL' => 'element_4',
			'SHOW_BREADCRUMBS_CATALOG_SUBSECTIONS' => 'Y',
			'SHOW_BREADCRUMBS_CATALOG_CHAIN' => 'H1',
			'TYPE_SKU' => 'TYPE_1',
			'DETAIL_PICTURE_MODE' => 'POPUP',
			'MENU_POSITION' => 'LINE',
			'MENU_TYPE_VIEW' => 'HOVER',
			'VIEWED_TYPE' => 'LOCAL',
			'VIEWED_TEMPLATE' => 'HORIZONTAL',
			'USE_WORD_EXPRESSION' => 'Y',
			'ORDER_BASKET_VIEW' => 'NORMAL',
			'ORDER_BASKET_COLOR' => 'DARK',
			'SHOW_BASKET_ONADDTOCART' => 'Y',
			'SHOW_BASKET_PRINT' => 'Y',
			'SHOW_BASKET_ON_PAGES' => 'N',
			'USE_PRODUCT_QUANTITY_LIST' => 'Y',
			'USE_PRODUCT_QUANTITY_DETAIL' => 'Y',
			'ONE_CLICK_BUY_CAPTCHA' => 'N',
			'SHOW_ONECLICKBUY_ON_BASKET_PAGE' => 'Y',
			'ONECLICKBUY_SHOW_DELIVERY_NOTE' => 'N',
			'PAGE_CONTACTS' => '3',
			'CONTACTS_USE_FEEDBACK' => 'Y',
			'CONTACTS_USE_MAP' => 'Y',
			'BLOG_PAGE' => 'list_elements_2',
			'PROJECTS_PAGE' => 'list_elements_2',
			'NEWS_PAGE' => 'list_elements_3',
			'STAFF_PAGE' => 'list_elements_1',
			'PARTNERS_PAGE' => 'list_elements_3',
			'PARTNERS_PAGE_DETAIL' => 'element_4',
			'VACANCY_PAGE' => 'list_elements_1',
			'LICENSES_PAGE' => 'list_elements_2',
			'FOOTER_TYPE' => '1',
			'ADV_TOP_HEADER' => 'N',
			'ADV_TOP_UNDERHEADER' => 'N',
			'ADV_SIDE' => 'Y',
			'ADV_CONTENT_TOP' => 'N',
			'ADV_CONTENT_BOTTOM' => 'N',
			'ADV_FOOTER' => 'N',
			'HEADER_MOBILE_FIXED' => 'Y',
			'HEADER_MOBILE' => '1',
			'HEADER_MOBILE_MENU' => '1',
			'HEADER_MOBILE_MENU_OPEN' => '1',
			'PERSONAL_ONEFIO' => 'Y',
			'LOGIN_EQUAL_EMAIL' => 'Y',
			'YA_GOALS' => 'N',
			'YANDEX_ECOMERCE' => 'N',
			'GOOGLE_ECOMERCE' => 'N',
		),
	),
	3 => array(
		'ID' => 881,
		'TITLE' => GetMessage('PRESET_881_TITLE'),
		'DESCRIPTION' => '',
		'IMG' => '/bitrix/images/aspro.next/themes/preset881_1544181443.png',
		'OPTIONS' => array(
			'THEME_SWITCHER' => 'Y',
			'BASE_COLOR' => 'CUSTOM',
			'BASE_COLOR_CUSTOM' => 'f07c00',
			'SHOW_BG_BLOCK' => 'N',
			'COLORED_LOGO' => 'Y',
			'PAGE_WIDTH' => '1',
			'FONT_STYLE' => '1',
			'MENU_COLOR' => 'COLORED',
			'LEFT_BLOCK' => '2',
			'SIDE_MENU' => 'RIGHT',
			'H1_STYLE' => '2',
			'TYPE_SEARCH' => 'fixed',
			'PAGE_TITLE' => '3',
			'HOVER_TYPE_IMG' => 'blink',
			'SHOW_LICENCE' => 'Y',
			'MAX_DEPTH_MENU' => '4',
			'HIDE_SITE_NAME_TITLE' => 'Y',
			'SHOW_CALLBACK' => 'Y',
			'PRINT_BUTTON' => 'Y',
			'USE_GOOGLE_RECAPTCHA' => 'N',
			'GOOGLE_RECAPTCHA_SHOW_LOGO' => 'Y',
			'HIDDEN_CAPTCHA' => 'Y',
			'INSTAGRAMM_WIDE_BLOCK' => 'N',
			'BIGBANNER_HIDEONNARROW' => 'N',
			'INDEX_TYPE' => array(
				'VALUE' => 'index4',
				'SUB_PARAMS' => array(
				),
			),
			'FRONT_PAGE_BRANDS' => 'brands_slider',
			'FRONT_PAGE_SECTIONS' => 'front_sections_with_childs',
			'TOP_MENU_FIXED' => 'Y',
			'HEADER_TYPE' => '9',
			'USE_REGIONALITY' => 'Y',
			'FILTER_VIEW' => 'COMPACT',
			'SEARCH_VIEW_TYPE' => 'with_filter',
			'USE_FAST_VIEW_PAGE_DETAIL' => 'fast_view_1',
			'SHOW_TOTAL_SUMM' => 'Y',
			'CHANGE_TITLE_ITEM' => 'N',
			'VIEW_TYPE_HIGHLOAD_PROP' => 'N',
			'SHOW_HEADER_GOODS' => 'Y',
			'SEARCH_HIDE_NOT_AVAILABLE' => 'N',
			'LEFT_BLOCK_CATALOG_ICONS' => 'N',
			'SHOW_CATALOG_SECTIONS_ICONS' => 'Y',
			'LEFT_BLOCK_CATALOG_DETAIL' => 'Y',
			'CATALOG_COMPARE' => 'Y',
			'CATALOG_PAGE_DETAIL' => 'element_4',
			'SHOW_BREADCRUMBS_CATALOG_SUBSECTIONS' => 'Y',
			'SHOW_BREADCRUMBS_CATALOG_CHAIN' => 'H1',
			'TYPE_SKU' => 'TYPE_1',
			'DETAIL_PICTURE_MODE' => 'POPUP',
			'MENU_POSITION' => 'LINE',
			'MENU_TYPE_VIEW' => 'HOVER',
			'VIEWED_TYPE' => 'LOCAL',
			'VIEWED_TEMPLATE' => 'HORIZONTAL',
			'USE_WORD_EXPRESSION' => 'Y',
			'ORDER_BASKET_VIEW' => 'NORMAL',
			'ORDER_BASKET_COLOR' => 'DARK',
			'SHOW_BASKET_ONADDTOCART' => 'Y',
			'SHOW_BASKET_PRINT' => 'Y',
			'SHOW_BASKET_ON_PAGES' => 'N',
			'USE_PRODUCT_QUANTITY_LIST' => 'Y',
			'USE_PRODUCT_QUANTITY_DETAIL' => 'Y',
			'ONE_CLICK_BUY_CAPTCHA' => 'N',
			'SHOW_ONECLICKBUY_ON_BASKET_PAGE' => 'Y',
			'ONECLICKBUY_SHOW_DELIVERY_NOTE' => 'N',
			'PAGE_CONTACTS' => '1',
			'CONTACTS_USE_FEEDBACK' => 'Y',
			'CONTACTS_USE_MAP' => 'Y',
			'BLOG_PAGE' => 'list_elements_2',
			'PROJECTS_PAGE' => 'list_elements_2',
			'NEWS_PAGE' => 'list_elements_3',
			'STAFF_PAGE' => 'list_elements_1',
			'PARTNERS_PAGE' => 'list_elements_3',
			'PARTNERS_PAGE_DETAIL' => 'element_4',
			'VACANCY_PAGE' => 'list_elements_1',
			'LICENSES_PAGE' => 'list_elements_2',
			'FOOTER_TYPE' => '1',
			'ADV_TOP_HEADER' => 'N',
			'ADV_TOP_UNDERHEADER' => 'N',
			'ADV_SIDE' => 'Y',
			'ADV_CONTENT_TOP' => 'N',
			'ADV_CONTENT_BOTTOM' => 'N',
			'ADV_FOOTER' => 'N',
			'HEADER_MOBILE_FIXED' => 'Y',
			'HEADER_MOBILE' => '1',
			'HEADER_MOBILE_MENU' => '1',
			'HEADER_MOBILE_MENU_OPEN' => '1',
			'PERSONAL_ONEFIO' => 'Y',
			'LOGIN_EQUAL_EMAIL' => 'Y',
			'YA_GOALS' => 'N',
			'YANDEX_ECOMERCE' => 'N',
			'GOOGLE_ECOMERCE' => 'N',
		),
	),
	4 => array(
		'ID' => 741,
		'TITLE' => GetMessage('PRESET_741_TITLE'),
		'DESCRIPTION' => '',
		'IMG' => '/bitrix/images/aspro.next/themes/preset741_1544181450.png',
		'OPTIONS' => array(
			'THEME_SWITCHER' => 'Y',
			'BASE_COLOR' => 'CUSTOM',
			'BASE_COLOR_CUSTOM' => 'd42727',
			'BGCOLOR_THEME' => 'LIGHT',
			'CUSTOM_BGCOLOR_THEME' => 'f6f6f7',
			'SHOW_BG_BLOCK' => 'Y',
			'COLORED_LOGO' => 'Y',
			'PAGE_WIDTH' => '2',
			'FONT_STYLE' => '5',
			'MENU_COLOR' => 'COLORED',
			'LEFT_BLOCK' => '2',
			'SIDE_MENU' => 'LEFT',
			'H1_STYLE' => '2',
			'TYPE_SEARCH' => 'fixed',
			'PAGE_TITLE' => '1',
			'HOVER_TYPE_IMG' => 'shine',
			'SHOW_LICENCE' => 'Y',
			'MAX_DEPTH_MENU' => '4',
			'HIDE_SITE_NAME_TITLE' => 'Y',
			'SHOW_CALLBACK' => 'Y',
			'PRINT_BUTTON' => 'N',
			'USE_GOOGLE_RECAPTCHA' => 'N',
			'GOOGLE_RECAPTCHA_SHOW_LOGO' => 'Y',
			'HIDDEN_CAPTCHA' => 'Y',
			'INSTAGRAMM_WIDE_BLOCK' => 'N',
			'BIGBANNER_HIDEONNARROW' => 'N',
			'INDEX_TYPE' => array(
				'VALUE' => 'index3',
				'SUB_PARAMS' => array(
					'TOP_ADV_BOTTOM_BANNER' => 'Y',
					'FLOAT_BANNER' => 'Y',
					'CATALOG_SECTIONS' => 'Y',
					'CATALOG_TAB' => 'Y',
					'TIZERS' => 'Y',
					'SALE' => 'Y',
					'BOTTOM_BANNERS' => 'Y',
					'COMPANY_TEXT' => 'Y',
					'BRANDS' => 'Y',
					'INSTAGRAMM' => 'N',
				),
			),
			'FRONT_PAGE_BRANDS' => 'brands_slider',
			'FRONT_PAGE_SECTIONS' => 'front_sections_only',
			'TOP_MENU_FIXED' => 'Y',
			'HEADER_TYPE' => '3',
			'USE_REGIONALITY' => 'Y',
			'FILTER_VIEW' => 'VERTICAL',
			'SEARCH_VIEW_TYPE' => 'with_filter',
			'USE_FAST_VIEW_PAGE_DETAIL' => 'fast_view_1',
			'SHOW_TOTAL_SUMM' => 'Y',
			'CHANGE_TITLE_ITEM' => 'N',
			'VIEW_TYPE_HIGHLOAD_PROP' => 'N',
			'SHOW_HEADER_GOODS' => 'Y',
			'SEARCH_HIDE_NOT_AVAILABLE' => 'N',
			'LEFT_BLOCK_CATALOG_ICONS' => 'N',
			'SHOW_CATALOG_SECTIONS_ICONS' => 'Y',
			'LEFT_BLOCK_CATALOG_DETAIL' => 'Y',
			'CATALOG_COMPARE' => 'Y',
			'CATALOG_PAGE_DETAIL' => 'element_1',
			'SHOW_BREADCRUMBS_CATALOG_SUBSECTIONS' => 'Y',
			'SHOW_BREADCRUMBS_CATALOG_CHAIN' => 'H1',
			'TYPE_SKU' => 'TYPE_1',
			'DETAIL_PICTURE_MODE' => 'POPUP',
			'MENU_POSITION' => 'LINE',
			'MENU_TYPE_VIEW' => 'HOVER',
			'VIEWED_TYPE' => 'LOCAL',
			'VIEWED_TEMPLATE' => 'HORIZONTAL',
			'USE_WORD_EXPRESSION' => 'Y',
			'ORDER_BASKET_VIEW' => 'NORMAL',
			'ORDER_BASKET_COLOR' => 'DARK',
			'SHOW_BASKET_ONADDTOCART' => 'Y',
			'SHOW_BASKET_PRINT' => 'Y',
			'SHOW_BASKET_ON_PAGES' => 'N',
			'USE_PRODUCT_QUANTITY_LIST' => 'Y',
			'USE_PRODUCT_QUANTITY_DETAIL' => 'Y',
			'ONE_CLICK_BUY_CAPTCHA' => 'N',
			'SHOW_ONECLICKBUY_ON_BASKET_PAGE' => 'Y',
			'ONECLICKBUY_SHOW_DELIVERY_NOTE' => 'N',
			'PAGE_CONTACTS' => '3',
			'CONTACTS_USE_FEEDBACK' => 'Y',
			'CONTACTS_USE_MAP' => 'Y',
			'BLOG_PAGE' => 'list_elements_2',
			'PROJECTS_PAGE' => 'list_elements_2',
			'NEWS_PAGE' => 'list_elements_3',
			'STAFF_PAGE' => 'list_elements_1',
			'PARTNERS_PAGE' => 'list_elements_3',
			'PARTNERS_PAGE_DETAIL' => 'element_4',
			'VACANCY_PAGE' => 'list_elements_1',
			'LICENSES_PAGE' => 'list_elements_2',
			'FOOTER_TYPE' => '4',
			'ADV_TOP_HEADER' => 'N',
			'ADV_TOP_UNDERHEADER' => 'N',
			'ADV_SIDE' => 'Y',
			'ADV_CONTENT_TOP' => 'N',
			'ADV_CONTENT_BOTTOM' => 'N',
			'ADV_FOOTER' => 'N',
			'HEADER_MOBILE_FIXED' => 'Y',
			'HEADER_MOBILE' => '1',
			'HEADER_MOBILE_MENU' => '1',
			'HEADER_MOBILE_MENU_OPEN' => '1',
			'PERSONAL_ONEFIO' => 'Y',
			'LOGIN_EQUAL_EMAIL' => 'Y',
			'YA_GOALS' => 'N',
			'YANDEX_ECOMERCE' => 'N',
			'GOOGLE_ECOMERCE' => 'N',
		),
	),
	5 => array(
		'ID' => 889,
		'TITLE' => GetMessage('PRESET_889_TITLE'),
		'DESCRIPTION' => '',
		'IMG' => '/bitrix/images/aspro.next/themes/preset889_1544181455.png',
		'OPTIONS' => array(
			'THEME_SWITCHER' => 'Y',
			'BASE_COLOR' => '9',
			'BASE_COLOR_CUSTOM' => '1976d2',
			'SHOW_BG_BLOCK' => 'N',
			'COLORED_LOGO' => 'Y',
			'PAGE_WIDTH' => '2',
			'FONT_STYLE' => '8',
			'MENU_COLOR' => 'COLORED',
			'LEFT_BLOCK' => '2',
			'SIDE_MENU' => 'LEFT',
			'H1_STYLE' => '2',
			'TYPE_SEARCH' => 'fixed',
			'PAGE_TITLE' => '1',
			'HOVER_TYPE_IMG' => 'shine',
			'SHOW_LICENCE' => 'Y',
			'MAX_DEPTH_MENU' => '3',
			'HIDE_SITE_NAME_TITLE' => 'Y',
			'SHOW_CALLBACK' => 'Y',
			'PRINT_BUTTON' => 'N',
			'USE_GOOGLE_RECAPTCHA' => 'N',
			'GOOGLE_RECAPTCHA_SHOW_LOGO' => 'Y',
			'HIDDEN_CAPTCHA' => 'Y',
			'INSTAGRAMM_WIDE_BLOCK' => 'N',
			'BIGBANNER_HIDEONNARROW' => 'N',
			'INDEX_TYPE' => array(
				'VALUE' => 'index1',
				'SUB_PARAMS' => array(
					'TIZERS' => 'Y',
					'CATALOG_SECTIONS' => 'Y',
					'CATALOG_TAB' => 'Y',
					'MIDDLE_ADV' => 'Y',
					'SALE' => 'Y',
					'BLOG' => 'Y',
					'BOTTOM_BANNERS' => 'Y',
					'COMPANY_TEXT' => 'Y',
					'BRANDS' => 'Y',
					'INSTAGRAMM' => 'Y',
				),
			),
			'FRONT_PAGE_BRANDS' => 'brands_slider',
			'FRONT_PAGE_SECTIONS' => 'front_sections_with_childs',
			'TOP_MENU_FIXED' => 'Y',
			'HEADER_TYPE' => '3',
			'USE_REGIONALITY' => 'Y',
			'FILTER_VIEW' => 'COMPACT',
			'SEARCH_VIEW_TYPE' => 'with_filter',
			'USE_FAST_VIEW_PAGE_DETAIL' => 'fast_view_1',
			'SHOW_TOTAL_SUMM' => 'Y',
			'CHANGE_TITLE_ITEM' => 'N',
			'VIEW_TYPE_HIGHLOAD_PROP' => 'N',
			'SHOW_HEADER_GOODS' => 'Y',
			'SEARCH_HIDE_NOT_AVAILABLE' => 'N',
			'LEFT_BLOCK_CATALOG_ICONS' => 'N',
			'SHOW_CATALOG_SECTIONS_ICONS' => 'Y',
			'LEFT_BLOCK_CATALOG_DETAIL' => 'Y',
			'CATALOG_COMPARE' => 'Y',
			'CATALOG_PAGE_DETAIL' => 'element_3',
			'SHOW_BREADCRUMBS_CATALOG_SUBSECTIONS' => 'Y',
			'SHOW_BREADCRUMBS_CATALOG_CHAIN' => 'H1',
			'TYPE_SKU' => 'TYPE_1',
			'DETAIL_PICTURE_MODE' => 'POPUP',
			'MENU_POSITION' => 'LINE',
			'MENU_TYPE_VIEW' => 'HOVER',
			'VIEWED_TYPE' => 'LOCAL',
			'VIEWED_TEMPLATE' => 'HORIZONTAL',
			'USE_WORD_EXPRESSION' => 'Y',
			'ORDER_BASKET_VIEW' => 'NORMAL',
			'ORDER_BASKET_COLOR' => 'DARK',
			'SHOW_BASKET_ONADDTOCART' => 'Y',
			'SHOW_BASKET_PRINT' => 'Y',
			'SHOW_BASKET_ON_PAGES' => 'N',
			'USE_PRODUCT_QUANTITY_LIST' => 'Y',
			'USE_PRODUCT_QUANTITY_DETAIL' => 'Y',
			'ONE_CLICK_BUY_CAPTCHA' => 'N',
			'SHOW_ONECLICKBUY_ON_BASKET_PAGE' => 'Y',
			'ONECLICKBUY_SHOW_DELIVERY_NOTE' => 'N',
			'PAGE_CONTACTS' => '3',
			'CONTACTS_USE_FEEDBACK' => 'Y',
			'CONTACTS_USE_MAP' => 'Y',
			'BLOG_PAGE' => 'list_elements_2',
			'PROJECTS_PAGE' => 'list_elements_2',
			'NEWS_PAGE' => 'list_elements_3',
			'STAFF_PAGE' => 'list_elements_1',
			'PARTNERS_PAGE' => 'list_elements_3',
			'PARTNERS_PAGE_DETAIL' => 'element_4',
			'VACANCY_PAGE' => 'list_elements_1',
			'LICENSES_PAGE' => 'list_elements_2',
			'FOOTER_TYPE' => '1',
			'ADV_TOP_HEADER' => 'N',
			'ADV_TOP_UNDERHEADER' => 'N',
			'ADV_SIDE' => 'Y',
			'ADV_CONTENT_TOP' => 'N',
			'ADV_CONTENT_BOTTOM' => 'N',
			'ADV_FOOTER' => 'N',
			'HEADER_MOBILE_FIXED' => 'Y',
			'HEADER_MOBILE' => '1',
			'HEADER_MOBILE_MENU' => '1',
			'HEADER_MOBILE_MENU_OPEN' => '1',
			'PERSONAL_ONEFIO' => 'Y',
			'LOGIN_EQUAL_EMAIL' => 'Y',
			'YA_GOALS' => 'N',
			'YANDEX_ECOMERCE' => 'N',
			'GOOGLE_ECOMERCE' => 'N',
		),
	),
);