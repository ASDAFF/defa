<?php
/**
 * CPriority module
 * @copyright 2017 Aspro
 */

IncludeModuleLangFile(__FILE__);
$moduleClass = 'CPriority';
$solution = 'aspro.priority';
$arFirstSectionServices = CCache::CIblockSection_GetList(array('SORT' => 'ASC', "CACHE" => array("TAG" => CCache::GetIBlockCacheTag(CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_services"][0]), "MULTI" => "N")), array('IBLOCK_ID' => CCache::$arIBlocks[SITE_ID]["aspro_priority_catalog"]["aspro_priority_services"][0], 'ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'GLOBAL_ACTIVE' => 'Y'), false, array(), array('nTopCount' => 1));
$arFirstSectionServicesLastChild = CCache::CIblockSection_GetList(array('SORT' => 'ASC', "CACHE" => array("TAG" => CCache::GetIBlockCacheTag(CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_services"][0]), "MULTI" => "N")), array('IBLOCK_ID' => CCache::$arIBlocks[SITE_ID]["aspro_priority_catalog"]["aspro_priority_services"][0], 'ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', ">=LEFT_BORDER" => $arFirstSectionServices["LEFT_MARGIN"], "<=RIGHT_BORDER" => $arFirstSectionServices["RIGHT_MARGIN"]), false, array('ID', 'SECTION_PAGE_URL'), false);
$arFirstElementServices = CCache::CIblockElement_GetList(array('SORT' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag(CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_services"][0]), 'MULTI' => 'N')), array('IBLOCK_ID' => CCache::$arIBlocks[SITE_ID]["aspro_priority_catalog"]["aspro_priority_services"][0], 'ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'GLOBAL_ACTIVE' => 'Y'), false, array('nTopCount' => 1), array('DETAIL_PAGE_URL'));

$arFirstSectionCatalog = CCache::CIblockSection_GetList(array('SORT' => 'ASC', "CACHE" => array("TAG" => CCache::GetIBlockCacheTag(CCache::$arIBlocks[SITE_ID]["aspro_priority_catalog"]["aspro_priority_catalog"][0]), "MULTI" => "N")), array('IBLOCK_ID' => CCache::$arIBlocks[SITE_ID]["aspro_priority_catalog"]["aspro_priority_catalog"][0], 'ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'GLOBAL_ACTIVE' => 'Y'), false, array('SECTION_PAGE_URL'), array('nTopCount' => 1));
$arFirstElementCatalog = CCache::CIblockElement_GetList(array('SORT' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag(CCache::$arIBlocks[SITE_ID]["aspro_priority_catalog"]["aspro_priority_catalog"][0]), 'MULTI' => 'N')), array('IBLOCK_ID' => CCache::$arIBlocks[SITE_ID]["aspro_priority_catalog"]["aspro_priority_catalog"][0], 'ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'GLOBAL_ACTIVE' => 'Y'), false, array('nTopCount' => 1), array('DETAIL_PAGE_URL'));

// initialize module parametrs list and default values
$moduleClass::$arParametrsList = array(
	'MAIN' => array(
		'TITLE' => GetMessage('MAIN_OPTIONS_PARAMETERS'),
		'THEME' => 'Y',
		'OPTIONS' => array(
			'THEME_SWITCHER' =>	array(
				'TITLE' => GetMessage('THEME_SWITCHER'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'Y',
				'THEME' => 'N',
			),
			'BASE_COLOR' => array(
				'TITLE' => GetMessage('BASE_COLOR'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'CUSTOM' => array('COLOR' => '', 'TITLE' => GetMessage('BASE_COLOR_CUSTOM')),
					'1' => array('COLOR' => '#2b7de0', 'TITLE' => GetMessage('BASE_COLOR_1')),
					'2' => array('COLOR' => '#6465f1', 'TITLE' => GetMessage('BASE_COLOR_2')),
					'3' => array('COLOR' => '#8059d8', 'TITLE' => GetMessage('BASE_COLOR_3')),
					'4' => array('COLOR' => '#a453b9', 'TITLE' => GetMessage('BASE_COLOR_4')),
					'5' => array('COLOR' => '#da3b64', 'TITLE' => GetMessage('BASE_COLOR_5')),
					'6' => array('COLOR' => '#d2334d', 'TITLE' => GetMessage('BASE_COLOR_6')),
					'7' => array('COLOR' => '#da2a34', 'TITLE' => GetMessage('BASE_COLOR_7')),
					'8' => array('COLOR' => '#ef5a54', 'TITLE' => GetMessage('BASE_COLOR_8')),
					'9' => array('COLOR' => '#f17036', 'TITLE' => GetMessage('BASE_COLOR_9')),
					'10' => array('COLOR' => '#fb992a', 'TITLE' => GetMessage('BASE_COLOR_10')),
					'11' => array('COLOR' => '#85b82d', 'TITLE' => GetMessage('BASE_COLOR_11')),
					'12' => array('COLOR' => '#1da72e', 'TITLE' => GetMessage('BASE_COLOR_12')),
					'13' => array('COLOR' => '#1ca263', 'TITLE' => GetMessage('BASE_COLOR_13')),
					'14' => array('COLOR' => '#1baf9f', 'TITLE' => GetMessage('BASE_COLOR_14')),
					'15' => array('COLOR' => '#25b3e5', 'TITLE' => GetMessage('BASE_COLOR_15')),
					'16' => array('COLOR' => '#2b97df', 'TITLE' => GetMessage('BASE_COLOR_16')),
					'17' => array('COLOR' => '#1b70ca', 'TITLE' => GetMessage('BASE_COLOR_17')),
				),
				'DEFAULT' => '1',
				'TYPE_EXT' => 'colorpicker',
				'THEME' => 'Y',
			),
			'BASE_COLOR_CUSTOM' => array(
				'TITLE' => GetMessage('BASE_COLOR_CUSTOM'),
				'TYPE' => 'text',
				'DEFAULT' => 'de002b',
				'PARENT_PROP' => 'BASE_COLOR',
				'THEME' => 'Y',
			),
			'BGCOLOR_THEME' => array(
				'TITLE' => GetMessage('BGCOLOR_THEME_TITLE'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'CUSTOM' => array('COLOR' => '', 'TITLE' => GetMessage('BASE_COLOR_CUSTOM')),
					'LIGHT' => array('COLOR' => '#f6f6f7', 'TITLE' => GetMessage('BGCOLOR_THEME_LIGHT')),
					'DARK' => array('COLOR' => '#272a39', 'TITLE' => GetMessage('BGCOLOR_THEME_DARK')),

				),
				'DEFAULT' => 'LIGHT',
				'TYPE_EXT' => 'colorpicker',
				'THEME' => 'Y',
			),
			'CUSTOM_BGCOLOR_THEME' => array(
				'TITLE' => GetMessage('CUSTOM_BGCOLOR_THEME_TITLE'),
				'TYPE' => 'text',
				'DEFAULT' => 'f6f6f7',
				'PARENT_PROP' => 'BGCOLOR_THEME',
				'THEME' => 'Y',
			),
			/*'SHOW_BG_BLOCK' => array(
				'TITLE' => GetMessage('SHOW_BG_BLOCK_TITLE'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'N',
				'THEME' => 'Y',
			),*/
			'COLORED_LOGO' => array(
				'TITLE' => GetMessage('COLORED_LOGO'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'N',
				'THEME' => 'N',
			),
			'LOGO_IMAGE' => array(
				'TITLE' => GetMessage('LOGO_IMAGE'),
				'TYPE' => 'file',
				'DEFAULT' => serialize(array()),
				'THEME' => 'N',
			),
			'LOGO_IMAGE_LIGHT' => array(
				'TITLE' => GetMessage('LOGO_IMAGE_LIGHT'),
				'TYPE' => 'file',
				'DEFAULT' => serialize(array()),
				'THEME' => 'N',
			),
			'FAVICON_IMAGE' => array(
				'TITLE' => GetMessage('FAVICON_IMAGE'),
				'TYPE' => 'file',
				'DEFAULT' => serialize(array()),
				'THEME' => 'N',
			),
			'APPLE_TOUCH_ICON_IMAGE' => array(
				'TITLE' => GetMessage('APPLE_TOUCH_ICON_IMAGE'),
				'TYPE' => 'file',
				'DEFAULT' => serialize(array()),
				'THEME' => 'N',
			),
			'FONT_STYLE' => array(
				'TITLE' => GetMessage('FONT_STYLE'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'1' => array(
						'TITLE' => '15px Open Sans',
						'GROUP' => 'Open Sans',
						'LINK' => 'Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,500,600,700,800&subset=latin,cyrillic-ext',
						'VALUE' => '15 px',
					),
					'2' => array(
						'TITLE' => '14px Open Sans',
						'GROUP' => 'Open Sans',
						'LINK' => 'Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,500,600,700,800&subset=latin,cyrillic-ext',
						'VALUE' => '14 px',
					),
					'3' => array(
						'TITLE' => '13px Open Sans',
						'GROUP' => 'Open Sans',
						'LINK' => 'Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,500,600,700,800&subset=latin,cyrillic-ext',
						'VALUE' => '13 px',
					),
					'4' => array(
						'TITLE' => '15px PT Sans Caption',
						'GROUP' => 'PT Sans',
						'LINK' => 'PT+Sans+Caption:400italic,700italic,400,700&subset=latin,cyrillic-ext',
						'VALUE' => '15 px',
					),
					'5' => array(
						'TITLE' => '14px PT Sans Caption',
						'GROUP' => 'PT Sans',
						'LINK' => 'PT+Sans+Caption:400italic,700italic,400,700&subset=latin,cyrillic-ext',
						'VALUE' => '14 px',
					),
					'6' => array(
						'TITLE' => '13px PT Sans Caption',
						'GROUP' => 'PT Sans',
						'LINK' => 'PT+Sans+Caption:400italic,700italic,400,700&subset=latin,cyrillic-ext',
						'VALUE' => '13 px',
					),
					'7' => array(
						'TITLE' => '15px Ubuntu',
						'GROUP' => 'Ubuntu',
						'LINK' => 'Ubuntu:300italic,400italic,500italic,700italic,400,300,500,700subset=latin,cyrillic-ext',
						'VALUE' => '15 px',
					),
					'8' => array(
						'TITLE' => '14px Ubuntu',
						'GROUP' => 'Ubuntu',
						'LINK' => 'Ubuntu:300italic,400italic,500italic,700italic,400,300,500,700subset=latin,cyrillic-ext',
						'VALUE' => '14 px',
					),
					'9' => array(
						'TITLE' => '13px Ubuntu',
						'GROUP' => 'Ubuntu',
						'LINK' => 'Ubuntu:300italic,400italic,500italic,700italic,400,300,500,700subset=latin,cyrillic-ext',
						'VALUE' => '13 px',
					),
					'10' => array(
						'TITLE' => '15px Montserrat',
						'GROUP' => 'Montserrat',
						'LINK' => 'Montserrat:300italic,400italic,500italic,700italic,400,300,500,700subset=latin,cyrillic-ext',
						'VALUE' => '15 px',
					),
					'11' => array(
						'TITLE' => '14px Montserrat',
						'GROUP' => 'Montserrat',
						'LINK' => 'Montserrat:300italic,400italic,500italic,700italic,400,300,500,700subset=latin,cyrillic-ext',
						'VALUE' => '14 px',
					),
					'12' => array(
						'TITLE' => '13px Montserrat',
						'GROUP' => 'Montserrat',
						'LINK' => 'Montserrat:300italic,400italic,500italic,700italic,400,300,500,700subset=latin,cyrillic-ext',
						'VALUE' => '13 px',
					),
				),
				'DEFAULT' => '10',
				'THEME' => 'Y',
				'GROUPS' => 'Y',
			),
			'CUSTOM_FONT' => array(
				'TITLE' => GetMessage('CUSTOM_FONT'),
				'TYPE' => 'text',
				'SIZE' => '',
				'DEFAULT' => '',
				'THEME' => 'N',
			),
			'CUSTOM_FONT_HASH' => array(
				'TITLE' => GetMessage('CUSTOM_FONT_HASH'),
				'TYPE' => 'hidden',
				'SIZE' => '',
				'DEFAULT' => '',
				'THEME' => 'N',
			),
			'PAGE_WIDTH' => array(
				'TITLE' => GetMessage('PAGE_WIDTH'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'1' => '1 700 px',
					'2' => '1 500 px',
					'3' => '1 344 px',
					'4' => '1 200 px'
				),
				'DEFAULT' => '3',
				'THEME' => 'Y',
			),
			'ROUND_BUTTON' => array(
				'TITLE' => GetMessage('ROUND_BUTTON_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'N' => array(
						'TITLE' => GetMessage('RECTANGUL_BUTTON'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/button_rectangul.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'Y' => array(
						'TITLE' => GetMessage('ROUND_BUTTON'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/button_round.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'N',
				'THEME' => 'Y',
			),
			'DECORATIVE_INDENTATION' => array(
				'TITLE' => GetMessage('DECORATIVE_INDENTATION_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'Y' => array(
						'TITLE' => GetMessage('OPTION_ON'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/with_decorate.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'N' => array(
						'TITLE' => GetMessage('OPTION_OFF'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/without_decorate.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'Y',
				'THEME' => 'Y',
			),
			'H1_STYLE' => array(
				'TITLE' => GetMessage('H1FONT'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'1' => array(
						'TITLE' => GetMessage('H1FONT_STYLE_BOLD'),
						'GROUP' => GetMessage('H1FONT_STYLE'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/h1_bold.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
						'VALUE' => 'Bold',
					),
					'2' => array(
						'TITLE' => GetMessage('H1FONT_STYLE_NORMAL'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/h1_normal.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
						'GROUP' => GetMessage('H1FONT_STYLE'),
						'VALUE' => 'Normal',
					)
				),
				'DEFAULT' => '2',
				'THEME' => 'Y',
			),
			'PAGE_TITLE_POSITION' => array(
				'TITLE' => GetMessage('PAGE_TITLE_POSITION'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'left' => array(
						'TITLE' => GetMessage('PAGE_TITLE_POSITION_LEFT'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/title_left.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'center' => array(
						'TITLE' => GetMessage('PAGE_TITLE_POSITION_CENTER'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/title_center.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'left',
				'THEME' => 'Y',
			),
			'PAGE_TITLE' => array(
				'TITLE' => GetMessage('PAGE_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'1' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/title_1.jpg',
						'TITLE' => GetMessage('PAGE_TITLE_1'),
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'2' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/title_2.jpg',
						'TITLE' => GetMessage('PAGE_TITLE_2'),
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'3' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/title_3.jpg',
						'TITLE' => GetMessage('PAGE_TITLE_3'),
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'4' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/title_4.jpg',
						'TITLE' => GetMessage('PAGE_TITLE_4'),
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'custom' => array(
						'TITLE' => 'Custom',
						'HIDE' => 'Y'
					),
				),
				'DEFAULT' => '1',
				'THEME' => 'Y',
			),
			'TYPE_SEARCH' => array(
				'TITLE' => GetMessage('TYPE_SEARCH'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'corp' => array(
						'TITLE' => GetMessage('SEARCH_1'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/search_1.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'fixed' => array(
						'TITLE' => GetMessage('SEARCH_2'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/search_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'custom' => array(
						'TITLE' => 'Custom',
						'HIDE' => 'Y'
					)
				),
				'DEFAULT' => 'fixed',
				'THEME' => 'Y',
			),
			'SIDE_MENU' => array(
				'TITLE' => GetMessage('SIDE_MENU'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'LEFT' => array(
						'TITLE' => GetMessage('SIDE_MENU_LEFT'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/side_menu_left.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'RIGHT' => array(
						'TITLE' => GetMessage('SIDE_MENU_RIGHT'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/side_menu_right.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'LEFT',
				'THEME' => 'Y',
			),
			'HIDE_SITE_NAME_TITLE' => array(
				'TITLE' => GetMessage('HIDE_SITE_NAME_TITLE'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'N',
				'THEME' => 'N',
			),
			'PRINT_BUTTON' => array(
				'TITLE' => GetMessage('PRINT_BUTTON'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'Y',
				'ONE_ROW' => 'Y',
				'THEME' => 'Y',
			),
			'SCROLLTOTOP_TYPE' => array(
				'TITLE' => GetMessage('SCROLLTOTOP_TYPE'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'NONE' => GetMessage('SCROLLTOTOP_TYPE_NONE'),
					'ROUND_COLOR' => GetMessage('SCROLLTOTOP_TYPE_ROUND_COLOR'),
					'ROUND_GREY' => GetMessage('SCROLLTOTOP_TYPE_ROUND_GREY'),
					'ROUND_WHITE' => GetMessage('SCROLLTOTOP_TYPE_ROUND_WHITE'),
					'RECT_COLOR' => GetMessage('SCROLLTOTOP_TYPE_RECT_COLOR'),
					'RECT_GREY' => GetMessage('SCROLLTOTOP_TYPE_RECT_GREY'),
					'RECT_WHITE' => GetMessage('SCROLLTOTOP_TYPE_RECT_WHITE'),
				),
				'DEFAULT' => 'ROUND_COLOR',
				'THEME' => 'N',
			),
			'SCROLLTOTOP_POSITION' => array(
				'TITLE' => GetMessage('SCROLLTOTOP_POSITION'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'TOUCH' => GetMessage('SCROLLTOTOP_POSITION_TOUCH'),
					'PADDING' => GetMessage('SCROLLTOTOP_POSITION_PADDING'),
					'CONTENT' => GetMessage('SCROLLTOTOP_POSITION_CONTENT'),
				),
				'DEFAULT' => 'PADDING',
				'THEME' => 'N',
			),
			'MODERATION_REVIEWS' => array(
				'TITLE' => GetMessage('MODERATION_REVIEWS'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'Y',
				'ONE_ROW' => 'Y',
				'THEME' => 'N',
			),
		),
	),
	'GOOGLE_RECAPTCHA' => array(
		'TITLE' => GetMessage('GOOGLE_RECAPTCHA'),
		'OPTIONS' => array(
			'USE_GOOGLE_RECAPTCHA' => array(
				'TITLE' => GetMessage('USE_GOOGLE_RECAPTCHA_TITLE'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'N',
				'THEME' => 'N',
			),
			'GOOGLE_RECAPTCHA_PUBLIC_KEY' => array(
				'TITLE' => GetMessage('GOOGLE_RECAPTCHA_PUBLIC_KEY_TITLE'),
				'TYPE' => 'text',
				'SIZE' => '75',
				'DEFAULT' => '',
				'THEME' => 'N',
			),
			'GOOGLE_RECAPTCHA_PRIVATE_KEY' => array(
				'TITLE' => GetMessage('GOOGLE_RECAPTCHA_PRIVATE_KEY_TITLE'),
				'TYPE' => 'text',
				'SIZE' => '75',
				'DEFAULT' => '',
				'THEME' => 'N',
			),
			'GOOGLE_RECAPTCHA_MASK_PAGE' => array(
				'TITLE' => GetMessage('GOOGLE_RECAPTCHA_MASK_PAGE_TITLE'),
				'TYPE' => 'textarea',
				'ROWS' => '5',
				'COLS' => '77',
				'DEFAULT' => '',
				'THEME' => 'N',
			),
			'GOOGLE_RECAPTCHA_COLOR' => array(
				'TITLE' => GetMessage('GOOGLE_RECAPTCHA_COLOR_TITLE'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'DARK' => GetMessage('GOOGLE_RECAPTCHA_COLOR_DARK_TITLE'),
					'LIGHT' => GetMessage('GOOGLE_RECAPTCHA_COLOR_LIGHT_TITLE'),
				),
				'DEFAULT' => 'LIGHT',
				'THEME' => 'N',
			),
			'GOOGLE_RECAPTCHA_SIZE' => array(
				'TITLE' => GetMessage('GOOGLE_RECAPTCHA_SIZE_TITLE'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'NORMAL' => GetMessage('GOOGLE_RECAPTCHA_SIZE_NORMAL_TITLE'),
					'COMPACT' => GetMessage('GOOGLE_RECAPTCHA_SIZE_COMPACT_TITLE'),
					'INVISIBLE' => GetMessage('GOOGLE_RECAPTCHA_SIZE_INVISIBLE_TITLE'),
				),
				'DEFAULT' => 'NORMAL',
				'THEME' => 'N',
			),
			'GOOGLE_RECAPTCHA_SHOW_LOGO' => array(
				'TITLE' => GetMessage('GOOGLE_RECAPTCHA_SHOW_LOGO_TITLE'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'Y',
				'THEME' => 'N',
			),
			'GOOGLE_RECAPTCHA_BADGE' => array(
				'TITLE' => GetMessage('GOOGLE_RECAPTCHA_BADGE_TITLE'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'BOTTOMRIGHT' => GetMessage('GOOGLE_RECAPTCHA_BADGE_BOTTOMRIGHT_TITLE'),
					'BOTTOMLEFT' => GetMessage('GOOGLE_RECAPTCHA_BADGE_BOTTOMLEFT_TITLE'),
					'INLINE' => GetMessage('GOOGLE_RECAPTCHA_BADGE_INLINE_TITLE'),
				),
				'DEFAULT' => 'BOTTOMRIGHT',
				'THEME' => 'N',
			),
			'GOOGLE_RECAPTCHA_NOTE' => array(
				'TYPE' => 'note',
				'TITLE' => GetMessage('GOOGLE_RECAPTCHA_NOTE_TEXT'),
				'THEME' => 'N',
			),
		),
	),
	'FORMS' => array(
		'TITLE' => GetMessage('FORMS_OPTIONS'),
		'OPTIONS' => array(
			'CAPTCHA_FORM_TYPE' => array(
				'TITLE' => GetMessage('CAPTCHA_FORM_TYPE'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'N',
				'THEME' => 'N',
			),
			'PHONE_MASK' => array(
				'TITLE' => GetMessage('PHONE_MASK'),
				'TYPE' => 'text',
				'DEFAULT' => '+7 (999) 999-99-99',
				'THEME' => 'N',
			),
			'VALIDATE_PHONE_MASK' => array(
				'TITLE' => GetMessage('VALIDATE_PHONE_MASK'),
				'TYPE' => 'text',
				'DEFAULT' => '^[+][0-9] [(][0-9]{3}[)] [0-9]{3}[-][0-9]{2}[-][0-9]{2}$',
				'THEME' => 'N',
			),
			'DATE_FORMAT' => array(
				'TITLE' => GetMessage('DATE_FORMAT'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'DOT' => GetMessage('DATE_FORMAT_DOT'),
					'HYPHEN' => GetMessage('DATE_FORMAT_HYPHEN'),
					'SPACE' => GetMessage('DATE_FORMAT_SPACE'),
					'SLASH' => GetMessage('DATE_FORMAT_SLASH'),
					'COLON' => GetMessage('DATE_FORMAT_COLON'),
				),
				'DEFAULT' => 'DOT',
				'THEME' => 'N',
			),
			'VALIDATE_FILE_EXT' => array(
				'TITLE' => GetMessage('VALIDATE_FILE_EXT'),
				'TYPE' => 'text',
				'DEFAULT' => 'png|jpg|jpeg|gif|doc|docx|xls|xlsx|txt|pdf|odt|rtf',
				'THEME' => 'N',
			),
		),
	),
	'SOCIAL' => array(
		'TITLE' => GetMessage('SOCIAL_OPTIONS'),
		'OPTIONS' => array(
			'SOCIAL_VK' => array(
				'TITLE' => GetMessage('SOCIAL_VK'),
				'TYPE' => 'text',
				'DEFAULT' => '',
				'THEME' => 'N',
			),
			'SOCIAL_FACEBOOK' => array(
				'TITLE' => GetMessage('SOCIAL_FACEBOOK'),
				'TYPE' => 'text',
				'DEFAULT' => '',
				'THEME' => 'N',
			),
			'SOCIAL_TWITTER' =>	array(
				'TITLE' => GetMessage('SOCIAL_TWITTER'),
				'TYPE' => 'text',
				'DEFAULT' => '',
				'THEME' => 'N',
			),
			'SOCIAL_INSTAGRAM' => array(
				'TITLE' => GetMessage('SOCIAL_INSTAGRAM'),
				'TYPE' => 'text',
				'DEFAULT' => '',
				'THEME' => 'N',
			),
			'SOCIAL_TELEGRAM' => array(
				'TITLE' => GetMessage('SOCIAL_TELEGRAM'),
				'TYPE' => 'text',
				'DEFAULT' => '',
				'THEME' => 'N',
			),
			'SOCIAL_YOUTUBE' => array(
				'TITLE' => GetMessage('SOCIAL_YOUTUBE'),
				'TYPE' => 'text',
				'DEFAULT' => '',
				'THEME' => 'N',
			),
			'SOCIAL_ODNOKLASSNIKI' => array(
				'TITLE' => GetMessage('SOCIAL_ODNOKLASSNIKI'),
				'TYPE' => 'text',
				'DEFAULT' => '',
				'THEME' => 'N',
			),
			'SOCIAL_GOOGLEPLUS' => array(
				'TITLE' => GetMessage('SOCIAL_GOOGLEPLUS'),
				'TYPE' => 'text',
				'DEFAULT' => '',
				'THEME' => 'N',
			),
			'SOCIAL_MAIL' => array(
				'TITLE' => GetMessage('SOCIAL_MAILRU'),
				'TYPE' => 'text',
				'DEFAULT' => '',
				'THEME' => 'N',
			),
			'SOCIAL_YANDEX_DZEN' => array(
				'TITLE' => GetMessage('SOCIAL_YANDEX_DZEN'),
				'TYPE' => 'text',
				'DEFAULT' => '',
				'THEME' => 'N',
			),
		),
	),
	'INDEX_PAGE' => array(
		'TITLE' => GetMessage('INDEX_PAGE_OPTIONS'),
		'THEME' => 'Y',
		'OPTIONS' => array(
			/*'TYPE_INDEX' => array(
				'TITLE' => GetMessage('TYPE_INDEX'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
				),
				'DEFAULT' => '1',
				'THEME' => 'Y',
			),*/
			/*'BANNER_WIDTH' => array(
				'TITLE' => GetMessage('BANNER_WIDTH'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'AUTO' => GetMessage('BANNER_WIDTH_AUTO'),
					'WIDE' => GetMessage('BANNER_WIDTH_WIDE'),
					'MIDDLE' => GetMessage('BANNER_WIDTH_MIDDLE'),
					'NARROW' => GetMessage('BANNER_WIDTH_NARROW'),
				),
				'DEFAULT' => 'SECOND',
				'THEME' => 'Y',
			),*/
			'BIGBANNER_ANIMATIONTYPE' => array(
				'TITLE' => GetMessage('BIGBANNER_ANIMATIONTYPE'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'SLIDE_HORIZONTAL' => GetMessage('ANIMATION_SLIDE_HORIZONTAL'),
					'SLIDE_VERTICAL' => GetMessage('ANIMATION_SLIDE_VERTICAL'),
					'FADE' => GetMessage('ANIMATION_FADE'),
				),
				'DEFAULT' => 'SLIDE_HORIZONTAL',
				'THEME' => 'N',
			),
			'BIGBANNER_SLIDESSHOWSPEED' => array(
				'TITLE' => GetMessage('BIGBANNER_SLIDESSHOWSPEED'),
				'TYPE' => 'text',
				'DEFAULT' => '5000',
				'THEME' => 'N',
			),
			'BIGBANNER_ANIMATIONSPEED' => array(
				'TITLE' => GetMessage('BIGBANNER_ANIMATIONSPEED'),
				'TYPE' => 'text',
				'DEFAULT' => '600',
				'THEME' => 'N',
			),
			'BIGBANNER_HIDEONNARROW' => array(
				'TITLE' => GetMessage('BIGBANNER_HIDEONNARROW'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'N',
				'THEME' => 'N',
			),
			'PARTNERSBANNER_SLIDESSHOWSPEED' => array(
				'TITLE' => GetMessage('PARTNERSBANNER_SLIDESSHOWSPEED'),
				'TYPE' => 'text',
				'DEFAULT' => '5000',
				'THEME' => 'N',
			),
			'PARTNERSBANNER_ANIMATIONSPEED' => array(
				'TITLE' => GetMessage('PARTNERSBANNER_ANIMATIONSPEED'),
				'TYPE' => 'text',
				'DEFAULT' => '600',
				'THEME' => 'N',
			),
			'API_TOKEN_INSTAGRAMM' => array(
				'TITLE' => GetMessage('API_TOKEN_INSTAGRAMM_TITLE'),
				'TYPE' => 'text',
				'DEFAULT' => '1056017790.9b6cbfe.4dfb9d965b5c4c599121872c23b4dfd0',
				'THEME' => 'N',
			),
			'INDEX_TYPE' => array(
				'TITLE' => GetMessage('INDEX_TYPE'),
				'TYPE' => 'selectbox',
				'IS_TABS' => 'Y',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'index1' => array(
						'TITLE' => '1',
						'IMG' => '/bitrix/images/'.$solution.'/themes/main_1.jpg',
					),
					'index2' => array(
						'TITLE' => '2',
						'IMG' => '/bitrix/images/'.$solution.'/themes/main_2.jpg',
					),
					'index3' => array(
						'TITLE' => '3',
						'IMG' => '/bitrix/images/'.$solution.'/themes/main_3.jpg',
					),
					'index4' => array(
						'TITLE' => '4',
						'IMG' => '/bitrix/images/'.$solution.'/themes/main_4.jpg',
					),
					'custom' => array(
						'TITLE' => 'Custom',
						'HIDE' => 'Y'
					),
				),
				'DEFAULT' => 'index1',
				'THEME' => 'Y',
				'REFRESH' => 'Y',
				'PREVIEW' => array(
					'URL' => ''
				),
				'MESSAGE_FOR_SUB_PARAMS' => GetMessage('SUB_PARAMS_MAIN'),
				'SUB_PARAMS' => array(
					'index1' => array(
						'BIG_BANNER_INDEX' => array(
							'TITLE' => GetMessage('BIG_BANNER_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'DRAG' => 'N',
							'HIDE_TOGGLE' => 'Y',
							'PARENT' => 'index1',
						),
						'TOP_FLOAT_BANNERS_INDEX' => array(
							'TITLE' => GetMessage('TOP_FLOAT_BANNERS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'PARENT' => 'index1',
						),
						'TOP_SERVICES_INDEX' => array(
							'TITLE' => GetMessage('TOP_SERVICES_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'services',
							'PARENT' => 'index1',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('SERVICES_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('SERVICES_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_11.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('SERVICES_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_8.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('SERVICES_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_4.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'4' => array(
										'TITLE' => GetMessage('SERVICES_4'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_7.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'5' => array(
										'TITLE' => GetMessage('SERVICES_5'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'6' => array(
										'TITLE' => GetMessage('SERVICES_6'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_6.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'7' => array(
										'TITLE' => GetMessage('SERVICES_7'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_10.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'8' => array(
										'TITLE' => GetMessage('SERVICES_8'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'9' => array(
										'TITLE' => GetMessage('SERVICES_9'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.services_scroll'
								),
							),
						),
						'PORTFOLIO_INDEX' => array(
							'TITLE' => GetMessage('PORTFOLIO_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'N',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'projects',
							'PARENT' => 'index1',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('PROJECTS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('TEMPLATE_BLOCK_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/projects_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('TEMPLATE_BLOCK_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/projects_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.projects'
								),
							),
						),
						'PRODUCTS_INDEX' => array(
							'TITLE' => GetMessage('PRODUCTS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'N',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'products',
							'PARENT' => 'index1',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('PRODUCTS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('SERVICES_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_11.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('SERVICES_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_4.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('SERVICES_4'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_7.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'4' => array(
										'TITLE' => GetMessage('SERVICES_5'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'5' => array(
										'TITLE' => GetMessage('SERVICES_6'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_6.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'6' => array(
										'TITLE' => GetMessage('SERVICES_7'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_10.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'7' => array(
										'TITLE' => GetMessage('SERVICES_10'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_9.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'8' => array(
										'TITLE' => GetMessage('SERVICES_8'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'9' => array(
										'TITLE' => GetMessage('SERVICES_11'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_5.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'10' => array(
										'TITLE' => GetMessage('SERVICES_9'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '8',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.products_scroll'
								),
							),
						),
						'CATALOG_INDEX' => array(
							'TITLE' => GetMessage('CATALOG_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'N',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'PARENT' => 'index1',
						),
						'TOP_TARIFS_INDEX' => array(
							'TITLE' => GetMessage('TOP_TARIFS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'services',
							'PARENT' => 'index1',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('TARIFS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('TARIFS_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('TARIFS_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('TARIFS_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'4' => array(
										'TITLE' => GetMessage('TARIFS_4'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_4.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'5' => array(
										'TITLE' => GetMessage('TARIFS_5'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_5.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'6' => array(
										'TITLE' => GetMessage('TARIFS_6'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_6.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'7' => array(
										'TITLE' => GetMessage('TARIFS_7'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_7.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'8' => array(
										'TITLE' => GetMessage('TARIFS_8'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_8.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'9' => array(
										'TITLE' => GetMessage('TARIFS_9'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_9.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '3',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.tarifs_scroll'
								),
							),
						),
						'REVIEWS_INDEX' => array(
							'TITLE' => GetMessage('REVIEWS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'reviews',
							'PARENT' => 'index1',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('REVIEWS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('REVIEWS_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/reviews_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('REVIEWS_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/reviews_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.reviews_scroll'
								),
							),
						),
						'COMPANY_INDEX' => array(
							'TITLE' => GetMessage('COMPANY_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'company',
							'PARENT' => 'index1',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('COMPANY_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('COMPANY_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/company_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('COMPANY_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/company_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('COMPANY_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/company_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'4' => array(
										'TITLE' => GetMessage('COMPANY_4'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/company_4.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.company_scroll'
								),
							),
						),
						'TEASERS_INDEX' => array(
							'TITLE' => GetMessage('TEASERS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'teasers',
							'PARENT' => 'index1',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('TEASERS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('THREE_IN_LINE'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/teasers_front_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('FOURTH_IN_LINE'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/teasers_front_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '2',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.teasers_scroll'
								),
							),
						),
						'TEAM_INDEX' => array(
							'TITLE' => GetMessage('TEAM_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'staff',
							'PARENT' => 'index1',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('STAFF_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('STAFF_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/staff_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('STAFF_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/staff_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('STAFF_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/staff_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.staff_scroll'
								),
							),
						),
						'NEWS_INDEX' => array(
							'TITLE' => GetMessage('NEWS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'news',
							'PARENT' => 'index1',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('NEWS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('PAGE_TILE'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/new_page_2_new.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('PAGE_SLIDER'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/new_page_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.news_scroll'
								),
							),
						),
						'PARTNERS_INDEX' => array(
							'TITLE' => GetMessage('PARTNERS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'partners',
							'PARENT' => 'index1',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('PARTNERS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('PARTNERS_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/partners_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('PARTNERS_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/partners_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.partners_scroll'
								),
							),
						),
						'CONTACTS_INDEX' => array(
							'TITLE' => GetMessage('CONTACTS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'N',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'contacts',
							'PARENT' => 'index1',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('CONTACTS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('CONTACTS_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/contacts_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('CONTACTS_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/contacts_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.contacts_scroll'
								),
							),
						),
						'INSTAGRAMM_INDEX' => array(
							'TITLE' => GetMessage('INSTAGRAMM_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'instagram',
							'PARENT' => 'index1',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('INSTAGRAM_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('INSTAGRAM_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/instagram_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('INSTAGRAM_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/instagram_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('INSTAGRAM_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/instagram_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.instagram_scroll'
								),
							),
						),
						'CONSULT_INDEX' => array(
							'TITLE' => GetMessage('CONSULT_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'PARENT' => 'index1',
						),
					),
					'index2' => array(
						'BIG_BANNER_INDEX' => array(
							'TITLE' => GetMessage('BIG_BANNER_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'DRAG' => 'N',
							'HIDE_TOGGLE' => 'Y',
							'PARENT' => 'index2',
						),
						'TOP_FLOAT_BANNERS_INDEX' => array(
							'TITLE' => GetMessage('TOP_FLOAT_BANNERS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'N',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'PARENT' => 'index2',
						),
						'TOP_SERVICES_INDEX' => array(
							'TITLE' => GetMessage('TOP_SERVICES_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'N',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'services',
							'PARENT' => 'index2',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('SERVICES_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('SERVICES_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_11.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('SERVICES_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_8.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('SERVICES_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_4.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'4' => array(
										'TITLE' => GetMessage('SERVICES_4'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_7.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'5' => array(
										'TITLE' => GetMessage('SERVICES_5'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'6' => array(
										'TITLE' => GetMessage('SERVICES_6'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_6.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'7' => array(
										'TITLE' => GetMessage('SERVICES_7'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_10.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'8' => array(
										'TITLE' => GetMessage('SERVICES_8'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'9' => array(
										'TITLE' => GetMessage('SERVICES_9'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.services_scroll'
								),
							),
						),
						'PORTFOLIO_INDEX' => array(
							'TITLE' => GetMessage('PORTFOLIO_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'N',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'projects',
							'PARENT' => 'index2',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('PROJECTS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('TEMPLATE_BLOCK_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/projects_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('TEMPLATE_BLOCK_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/projects_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.projects'
								),
							),
						),
						'PRODUCTS_INDEX' => array(
							'TITLE' => GetMessage('PRODUCTS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'products',
							'PARENT' => 'index2',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('PRODUCTS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('SERVICES_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_11.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('SERVICES_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_4.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('SERVICES_4'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_7.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'4' => array(
										'TITLE' => GetMessage('SERVICES_5'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'5' => array(
										'TITLE' => GetMessage('SERVICES_6'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_6.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'6' => array(
										'TITLE' => GetMessage('SERVICES_7'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_10.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'7' => array(
										'TITLE' => GetMessage('SERVICES_10'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_9.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'8' => array(
										'TITLE' => GetMessage('SERVICES_8'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'9' => array(
										'TITLE' => GetMessage('SERVICES_11'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_5.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'10' => array(
										'TITLE' => GetMessage('SERVICES_9'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '7',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.products_scroll'
								),
							),
						),
						'TOP_TARIFS_INDEX' => array(
							'TITLE' => GetMessage('TOP_TARIFS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'services',
							'PARENT' => 'index2',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('TARIFS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('TARIFS_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('TARIFS_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('TARIFS_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'4' => array(
										'TITLE' => GetMessage('TARIFS_4'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_4.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'5' => array(
										'TITLE' => GetMessage('TARIFS_5'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_5.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'6' => array(
										'TITLE' => GetMessage('TARIFS_6'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_6.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'7' => array(
										'TITLE' => GetMessage('TARIFS_7'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_7.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'8' => array(
										'TITLE' => GetMessage('TARIFS_8'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_8.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'9' => array(
										'TITLE' => GetMessage('TARIFS_9'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_9.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '2',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.tarifs_scroll'
								),
							),
						),
						'REVIEWS_INDEX' => array(
							'TITLE' => GetMessage('REVIEWS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'N',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'reviews',
							'PARENT' => 'index2',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('REVIEWS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('REVIEWS_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/reviews_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('REVIEWS_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/reviews_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.reviews_scroll'
								),
							),
						),
						'COMPANY_INDEX' => array(
							'TITLE' => GetMessage('COMPANY_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'company',
							'PARENT' => 'index2',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('COMPANY_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('COMPANY_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/company_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('COMPANY_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/company_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('COMPANY_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/company_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'4' => array(
										'TITLE' => GetMessage('COMPANY_4'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/company_4.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '2',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.company_scroll'
								),
							),
						),
						'TEASERS_INDEX' => array(
							'TITLE' => GetMessage('TEASERS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'teasers',
							'PARENT' => 'index2',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('TEASERS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('THREE_IN_LINE'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/teasers_front_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('FOURTH_IN_LINE'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/teasers_front_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.teasers_scroll'
								),
							),
						),
						'CATALOG_INDEX' => array(
							'TITLE' => GetMessage('CATALOG_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'PARENT' => 'index2',
						),
						'TEAM_INDEX' => array(
							'TITLE' => GetMessage('TEAM_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'N',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'staff',
							'PARENT' => 'index2',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('STAFF_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('STAFF_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/staff_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('STAFF_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/staff_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('STAFF_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/staff_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.staff_scroll'
								),
							),
						),
						'PARTNERS_INDEX' => array(
							'TITLE' => GetMessage('PARTNERS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'partners',
							'PARENT' => 'index2',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('PARTNERS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('PARTNERS_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/partners_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('PARTNERS_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/partners_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '2',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.partners_scroll'
								),
							),
						),
						'NEWS_INDEX' => array(
							'TITLE' => GetMessage('NEWS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'news',
							'PARENT' => 'index2',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('NEWS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('PAGE_TILE'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/new_page_2_new.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('PAGE_SLIDER'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/new_page_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.news_scroll'
								),
							),
						),

						'CONTACTS_INDEX' => array(
							'TITLE' => GetMessage('CONTACTS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'contacts',
							'PARENT' => 'index2',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('CONTACTS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('CONTACTS_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/contacts_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('CONTACTS_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/contacts_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.contacts_scroll'
								),
							),
						),
						'CONSULT_INDEX' => array(
							'TITLE' => GetMessage('CONSULT_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'N',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'PARENT' => 'index2',
						),
						'INSTAGRAMM_INDEX' => array(
							'TITLE' => GetMessage('INSTAGRAMM_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'instagram',
							'PARENT' => 'index2',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('INSTAGRAM_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('INSTAGRAM_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/instagram_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('INSTAGRAM_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/instagram_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('INSTAGRAM_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/instagram_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '3',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.instagram_scroll'
								),
							),
						),
					),
					'index3' => array(
						'BIG_BANNER_INDEX' => array(
							'TITLE' => GetMessage('BIG_BANNER_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'DRAG' => 'N',
							'HIDE_TOGGLE' => 'Y',
							'PARENT' => 'index3',
						),
						'TOP_FLOAT_BANNERS_INDEX' => array(
							'TITLE' => GetMessage('TOP_FLOAT_BANNERS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'N',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'PARENT' => 'index3',
						),
						'TEASERS_INDEX' => array(
							'TITLE' => GetMessage('TEASERS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'teasers',
							'PARENT' => 'index3',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('TEASERS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('THREE_IN_LINE'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/teasers_front_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('FOURTH_IN_LINE'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/teasers_front_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '2',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.teasers_scroll'
								),
							),
						),
						'TOP_SERVICES_INDEX' => array(
							'TITLE' => GetMessage('TOP_SERVICES_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'services',
							'PARENT' => 'index3',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('SERVICES_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('SERVICES_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_11.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('SERVICES_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_8.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('SERVICES_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_4.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'4' => array(
										'TITLE' => GetMessage('SERVICES_4'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_7.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'5' => array(
										'TITLE' => GetMessage('SERVICES_5'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'6' => array(
										'TITLE' => GetMessage('SERVICES_6'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_6.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'7' => array(
										'TITLE' => GetMessage('SERVICES_7'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_10.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'8' => array(
										'TITLE' => GetMessage('SERVICES_8'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'9' => array(
										'TITLE' => GetMessage('SERVICES_9'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '2',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.services_scroll'
								),
							),
						),
						'PORTFOLIO_INDEX' => array(
							'TITLE' => GetMessage('PORTFOLIO_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'projects',
							'PARENT' => 'index3',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('PROJECTS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('TEMPLATE_BLOCK_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/projects_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('TEMPLATE_BLOCK_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/projects_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.projects'
								),
							),
						),
						'PRODUCTS_INDEX' => array(
							'TITLE' => GetMessage('PRODUCTS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'N',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'products',
							'PARENT' => 'index3',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('PRODUCTS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('SERVICES_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_11.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('SERVICES_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_4.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('SERVICES_4'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_7.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'4' => array(
										'TITLE' => GetMessage('SERVICES_5'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'5' => array(
										'TITLE' => GetMessage('SERVICES_6'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_6.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'6' => array(
										'TITLE' => GetMessage('SERVICES_7'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_10.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'7' => array(
										'TITLE' => GetMessage('SERVICES_10'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_9.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'8' => array(
										'TITLE' => GetMessage('SERVICES_8'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'9' => array(
										'TITLE' => GetMessage('SERVICES_11'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_5.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'10' => array(
										'TITLE' => GetMessage('SERVICES_9'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '8',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.products_scroll'
								),
							),
						),
						'CATALOG_INDEX' => array(
							'TITLE' => GetMessage('CATALOG_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'N',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'PARENT' => 'index3',
						),
						'TOP_TARIFS_INDEX' => array(
							'TITLE' => GetMessage('TOP_TARIFS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'services',
							'PARENT' => 'index3',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('TARIFS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('TARIFS_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('TARIFS_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('TARIFS_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'4' => array(
										'TITLE' => GetMessage('TARIFS_4'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_4.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'5' => array(
										'TITLE' => GetMessage('TARIFS_5'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_5.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'6' => array(
										'TITLE' => GetMessage('TARIFS_6'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_6.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'7' => array(
										'TITLE' => GetMessage('TARIFS_7'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_7.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'8' => array(
										'TITLE' => GetMessage('TARIFS_8'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_8.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'9' => array(
										'TITLE' => GetMessage('TARIFS_9'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_9.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.tarifs_scroll'
								),
							),
						),
						'COMPANY_INDEX' => array(
							'TITLE' => GetMessage('COMPANY_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'company',
							'PARENT' => 'index3',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('COMPANY_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('COMPANY_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/company_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('COMPANY_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/company_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('COMPANY_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/company_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'4' => array(
										'TITLE' => GetMessage('COMPANY_4'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/company_4.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '3',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.company_scroll'
								),
							),
						),
						'REVIEWS_INDEX' => array(
							'TITLE' => GetMessage('REVIEWS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'reviews',
							'PARENT' => 'index3',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('REVIEWS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('REVIEWS_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/reviews_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('REVIEWS_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/reviews_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.reviews_scroll'
								),
							),
						),
						'TEAM_INDEX' => array(
							'TITLE' => GetMessage('TEAM_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'N',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'staff',
							'PARENT' => 'index3',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('STAFF_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('STAFF_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/staff_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('STAFF_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/staff_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('STAFF_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/staff_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.staff_scroll'
								),
							),
						),
						'NEWS_INDEX' => array(
							'TITLE' => GetMessage('NEWS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'news',
							'PARENT' => 'index3',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('NEWS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('PAGE_TILE'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/new_page_2_new.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('PAGE_SLIDER'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/new_page_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.news_scroll'
								),
							),
						),

						'PARTNERS_INDEX' => array(
							'TITLE' => GetMessage('PARTNERS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'N',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'partners',
							'PARENT' => 'index3',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('PARTNERS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('PARTNERS_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/partners_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('PARTNERS_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/partners_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.partners_scroll'
								),
							),
						),
						'CONTACTS_INDEX' => array(
							'TITLE' => GetMessage('CONTACTS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'contacts',
							'PARENT' => 'index3',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('CONTACTS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('CONTACTS_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/contacts_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('CONTACTS_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/contacts_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '2',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.contacts_scroll'
								),
							),
						),
						'INSTAGRAMM_INDEX' => array(
							'TITLE' => GetMessage('INSTAGRAMM_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'N',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'instagram',
							'PARENT' => 'index3',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('INSTAGRAM_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('INSTAGRAM_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/instagram_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('INSTAGRAM_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/instagram_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('INSTAGRAM_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/instagram_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.instagram_scroll'
								),
							),
						),
						'CONSULT_INDEX' => array(
							'TITLE' => GetMessage('CONSULT_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'PARENT' => 'index3',
						),
					),
					'index4' => array(
						'BIG_BANNER_INDEX' => array(
							'TITLE' => GetMessage('BIG_BANNER_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'DRAG' => 'N',
							'HIDE_TOGGLE' => 'Y',
							'PARENT' => 'index4',
						),
						'TOP_FLOAT_BANNERS_INDEX' => array(
							'TITLE' => GetMessage('TOP_FLOAT_BANNERS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'PARENT' => 'index4',
						),
						'TOP_SERVICES_INDEX' => array(
							'TITLE' => GetMessage('TOP_SERVICES_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'services',
							'PARENT' => 'index4',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('SERVICES_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('SERVICES_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_11.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('SERVICES_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_8.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('SERVICES_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_4.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'4' => array(
										'TITLE' => GetMessage('SERVICES_4'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_7.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'5' => array(
										'TITLE' => GetMessage('SERVICES_5'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'6' => array(
										'TITLE' => GetMessage('SERVICES_6'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_6.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'7' => array(
										'TITLE' => GetMessage('SERVICES_7'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_10.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'8' => array(
										'TITLE' => GetMessage('SERVICES_8'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'9' => array(
										'TITLE' => GetMessage('SERVICES_9'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '4',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.services_scroll'
								),
							),
						),
						'PORTFOLIO_INDEX' => array(
							'TITLE' => GetMessage('PORTFOLIO_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'projects',
							'PARENT' => 'index4',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('PROJECTS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('TEMPLATE_BLOCK_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/projects_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('TEMPLATE_BLOCK_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/projects_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '2',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.projects'
								),
							),
						),
						'PRODUCTS_INDEX' => array(
							'TITLE' => GetMessage('PRODUCTS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'products',
							'PARENT' => 'index4',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('PRODUCTS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('SERVICES_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_11.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('SERVICES_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_4.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('SERVICES_4'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_7.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'4' => array(
										'TITLE' => GetMessage('SERVICES_5'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'5' => array(
										'TITLE' => GetMessage('SERVICES_6'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_6.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'6' => array(
										'TITLE' => GetMessage('SERVICES_7'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_10.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'7' => array(
										'TITLE' => GetMessage('SERVICES_10'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_9.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'8' => array(
										'TITLE' => GetMessage('SERVICES_8'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'9' => array(
										'TITLE' => GetMessage('SERVICES_11'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_5.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'10' => array(
										'TITLE' => GetMessage('SERVICES_9'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/services_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '9',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.products_scroll'
								),
							),
						),
						'CATALOG_INDEX' => array(
							'TITLE' => GetMessage('CATALOG_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'PARENT' => 'index4',
						),
						'TOP_TARIFS_INDEX' => array(
							'TITLE' => GetMessage('TOP_TARIFS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'services',
							'PARENT' => 'index4',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('TARIFS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('TARIFS_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('TARIFS_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('TARIFS_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'4' => array(
										'TITLE' => GetMessage('TARIFS_4'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_4.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'5' => array(
										'TITLE' => GetMessage('TARIFS_5'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_5.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'6' => array(
										'TITLE' => GetMessage('TARIFS_6'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_6.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'7' => array(
										'TITLE' => GetMessage('TARIFS_7'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_7.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'8' => array(
										'TITLE' => GetMessage('TARIFS_8'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_8.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'9' => array(
										'TITLE' => GetMessage('TARIFS_9'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/tarifs_9.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '5',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.tarifs_scroll'
								),
							),
						),
						'REVIEWS_INDEX' => array(
							'TITLE' => GetMessage('REVIEWS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'reviews',
							'PARENT' => 'index4',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('REVIEWS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('REVIEWS_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/reviews_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('REVIEWS_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/reviews_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '2',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.reviews_scroll'
								),
							),
						),
						'COMPANY_INDEX' => array(
							'TITLE' => GetMessage('COMPANY_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'company',
							'PARENT' => 'index4',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('COMPANY_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('COMPANY_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/company_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('COMPANY_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/company_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('COMPANY_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/company_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'4' => array(
										'TITLE' => GetMessage('COMPANY_4'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/company_4.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '2',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.company_scroll'
								),
							),
						),
						'TEASERS_INDEX' => array(
							'TITLE' => GetMessage('TEASERS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'teasers',
							'PARENT' => 'index4',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('TEASERS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('THREE_IN_LINE'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/teasers_front_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('FOURTH_IN_LINE'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/teasers_front_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '2',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.teasers_scroll'
								),
							),
						),
						'TEAM_INDEX' => array(
							'TITLE' => GetMessage('TEAM_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'staff',
							'PARENT' => 'index4',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('STAFF_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('STAFF_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/staff_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('STAFF_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/staff_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('STAFF_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/staff_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '2',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.staff_scroll'
								),
							),
						),
						'NEWS_INDEX' => array(
							'TITLE' => GetMessage('NEWS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'news',
							'PARENT' => 'index4',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('NEWS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('PAGE_TILE'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/new_page_2_new.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('PAGE_SLIDER'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/new_page_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '1',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.news_scroll'
								),
							),
						),
						'PARTNERS_INDEX' => array(
							'TITLE' => GetMessage('PARTNERS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'partners',
							'PARENT' => 'index4',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('PARTNERS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('PARTNERS_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/partners_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('PARTNERS_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/partners_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '2',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.partners_scroll'
								),
							),
						),
						'CONTACTS_INDEX' => array(
							'TITLE' => GetMessage('CONTACTS_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'contacts',
							'PARENT' => 'index4',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('CONTACTS_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('CONTACTS_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/contacts_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('CONTACTS_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/contacts_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '2',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.contacts_scroll'
								),
							),
						),
						'CONSULT_INDEX' => array(
							'TITLE' => GetMessage('CONSULT_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'PARENT' => 'index4',
						),
						'INSTAGRAMM_INDEX' => array(
							'TITLE' => GetMessage('INSTAGRAMM_INDEX'),
							'TYPE' => 'checkbox',
							'DEFAULT' => 'Y',
							'THEME' => 'Y',
							'ONE_ROW' => 'Y',
							'SMALL_TOGGLE' => 'Y',
							'COMPONENT_NAME' => 'instagram',
							'PARENT' => 'index4',
							'TEMPLATE' => array(
								'TITLE' => GetMessage('INSTAGRAM_TEMPLATE'),
								'TYPE' => 'selectbox',
								'IS_ROW' => 'Y',
								'LIST' => array(
									'1' => array(
										'TITLE' => GetMessage('INSTAGRAM_1'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/instagram_1.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'2' => array(
										'TITLE' => GetMessage('INSTAGRAM_2'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/instagram_2.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
									'3' => array(
										'TITLE' => GetMessage('INSTAGRAM_3'),
										'IMG' => '/bitrix/images/'.$solution.'/themes/instagram_3.jpg',
										'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
										'POSITION_BLOCK' => 'block',
									),
								),
								'DEFAULT' => '2',
								'THEME' => 'Y',
								'PREVIEW' => array(
									'URL' => '',
									'SCROLL_BLOCK' => '.instagram_scroll'
								),
							),
						),
					),
				),
			),
		),
	),
	'HEADER' => array(
		'TITLE' => GetMessage('HEADER_OPTIONS'),
		'THEME' => 'Y',
		'OPTIONS' => array(
			'MEGA_MENU' => array(
				'TITLE' => GetMessage('MEGA_MENU_TITLE'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'1' => GetMessage('VIEW_TYPE_1'),
					'custom' => array(
						'TITLE' => 'Custom',
						'HIDE' => 'Y'
					),
				),
				'DEFAULT' => '1',
				'THEME' => 'N',
			),
			'CALLBACK_BUTTON' => array(
				'TITLE' => GetMessage('CALLBACK_BUTTON'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'Y',
				'ONE_ROW' => 'Y',
				'THEME' => 'Y',
			),
			'TOP_MENU_FIXED' => array(
				'TITLE' => GetMessage('TOP_MENU_FIXED'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'Y',
				'THEME' => 'Y',
				'ONE_ROW' => 'Y',
				'DEPENDENT_PARAMS' => array(
					'HEADER_FIXED' => array(
						'TITLE' => GetMessage('HEADER_FIXED'),
						'HIDE_TITLE' => 'Y',
						'TYPE' => 'selectbox',
						'LIST' => array(
							'1' => array(
								'IMG' => '/bitrix/images/'.$solution.'/themes/fixed_header1.jpg',
								'TITLE' => '1',
								'POSITION_BLOCK' => 'block',
								'POSITION_TITLE' => 'left',
							),
							'2' => array(
								'IMG' => '/bitrix/images/'.$solution.'/themes/fixed_header2.jpg',
								'TITLE' => '2',
								'POSITION_BLOCK' => 'block',
								'POSITION_TITLE' => 'left',
							),
							'custom' => array(
								'TITLE' => 'Custom',
								'POSITION_BLOCK' => 'block',
								'HIDE' => 'Y'
							),
						),
						'CONDITIONAL_VALUE' => 'Y',
						'DEFAULT' => '2',
						'THEME' => 'Y',
					),
				)
			),
			'HEADER_TYPE' => array(
				'TITLE' => GetMessage('HEADER_TYPE'),
				'TYPE' => 'selectbox',
				/*'COMMUNITY' => array(
					'TYPE_INDEX' => array(
						'1' => array(
							'1' => array(
								'IMG' => '/bitrix/images/'.$solution.'/themes/header1.png',
								'TITLE' => '1',
								'POSITION_BLOCK' => 'block',
								'POSITION_TITLE' => 'left',
							),
							'2' => array(
								'IMG' => '/bitrix/images/'.$solution.'/themes/header2.png',
								'TITLE' => '2',
								'POSITION_BLOCK' => 'block',
								'POSITION_TITLE' => 'left',
							),
						),
						'2' => array(
							'3' => array(
								'IMG' => '/bitrix/images/'.$solution.'/themes/header3.png',
								'TITLE' => '1',
								'POSITION_BLOCK' => 'block',
								'POSITION_TITLE' => 'left',
							),
							'4' => array(
								'IMG' => '/bitrix/images/'.$solution.'/themes/header4.png',
								'TITLE' => '2',
								'POSITION_BLOCK' => 'block',
								'POSITION_TITLE' => 'left',
							),
						),
					),*/
				'LIST' => array(
					'1' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/header1.jpg',
						'TITLE' => '1',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'2' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/header2.jpg',
						'TITLE' => '2',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'3' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/header3.jpg',
						'TITLE' => '3',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'4' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/header4.jpg',
						'TITLE' => '4',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'5' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/header5.jpg',
						'TITLE' => '5',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'6' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/header6.jpg',
						'TITLE' => '6',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'7' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/header7.jpg',
						'TITLE' => '7',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'8' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/header8.jpg',
						'TITLE' => '8',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'9' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/header9.jpg',
						'TITLE' => '9',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'10' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/header10.jpg',
						'TITLE' => '10',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'11' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/header11.jpg',
						'TITLE' => '11',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'12' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/header12.jpg',
						'TITLE' => '12',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'13' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/header13.jpg',
						'TITLE' => '13',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'14' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/header14.jpg',
						'TITLE' => '14',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'15' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/header15.jpg',
						'TITLE' => '15',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'custom' => array(
						'TITLE' => 'Custom',
						'POSITION_BLOCK' => 'block',
						'HIDE' => 'Y'
					),
				),
				'DEFAULT' => '6',
				'THEME' => 'Y',
			),
			'HEADER_PHONES' => array(
				'TITLE' => GetMessage('HEADER_PHONES_OPTIONS_TITLE'),
				'TYPE' => 'array',
				'THEME' => 'N',
				'OPTIONS' => $arContactOptions = array(
					'PHONE_VALUE' => array(
						'TITLE' => GetMessage('HEADER_PHONE_OPTION_VALUE_TITLE'),
						'TYPE' => 'text',
						'DEFAULT' => '',
						'THEME' => 'N',
						'REQUIRED' => 'Y',
					),
				),
			),
		),
	),
	'MENU_PAGE' => array(
		'TITLE' => GetMessage('MENU_PAGE_OPTIONS'),
		'THEME' => 'Y',
		'OPTIONS' => array(
			'VIEW_TYPE_LEFT_BLOCK' => array(
				'TITLE' => GetMessage('VIEW_TYPE_LEFT_BLOCK_TITLE'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'1' => GetMessage('VIEW_TYPE_1'),
					'custom' => array(
						'TITLE' => 'Custom',
						'HIDE' => 'Y'
					),
				),
				'DEFAULT' => '1',
				'THEME' => 'N',
			),
			'SHOW_CATALOG_SECTIONS_IMAGE' => array(
				'TITLE' => GetMessage('SHOW_CATALOG_SECTIONS_IMAGE_TITLE'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'Y',
				'THEME' => 'Y',
				'ONE_ROW' => 'Y',
				'DEPENDENT_PARAMS' => array(
					'CATALOG_SECTIONS_IMAGE_TYPE' => array(
						'TITLE' => GetMessage('CATALOG_SECTIONS_IMAGE_TYPE'),
						'TYPE' => 'selectbox',
						'IS_ROW' => 'Y',
						'CONDITIONAL_VALUE' => 'Y',
						'HIDE_TITLE' => 'Y',
						'LIST' => array(
							'icons' => array(
								'TITLE' => GetMessage('IMAGE_TYPE_1'),
								'IMG' => '/bitrix/images/'.$solution.'/themes/section_image_1.jpg',
								'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
								'POSITION_BLOCK' => 'block',

							),
							'image' => array(
								'TITLE' => GetMessage('IMAGE_TYPE_2'),
								'IMG' => '/bitrix/images/'.$solution.'/themes/section_image_2.jpg',
								'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
								'POSITION_BLOCK' => 'block',
							),
						),
						'DEFAULT' => 'image',
						'THEME' => 'Y',
					),
					'CATALOG_ICONS_POSITION' => array(
						'TITLE' => GetMessage('CATALOG_ICONS_POSITION'),
						'TYPE' => 'selectbox',
						'IS_ROW' => 'Y',
						'CONDITIONAL_VALUE' => 'Y',
						'LIST' => array(
							'left' => array(
								'TITLE' => GetMessage('IMAGE_LEFT'),
								'IMG' => '/bitrix/images/'.$solution.'/themes/section_image_left.jpg',
								'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
								'POSITION_BLOCK' => 'block',
							),
							'top' => array(
								'TITLE' => GetMessage('IMAGE_TOP'),
								'IMG' => '/bitrix/images/'.$solution.'/themes/section_image_top.jpg',
								'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
								'POSITION_BLOCK' => 'block',
							),
						),
						'DEFAULT' => 'left',
						'THEME' => 'Y',
					),
				),
			),
			'MAX_VISIBLE_ITEMS_MENU' => array(
				'TITLE' => GetMessage('MAX_VISIBLE_ITEMS_MENU_TITLE'),
				'TYPE' => 'text',
				'DEFAULT' => '10',
				'THEME' => 'N',
			),
			'COUNT_ITEMS_IN_LINE_MENU_WIDE' => array(
				'TITLE' => GetMessage('COUNT_ITEMS_IN_LINE_MENU_WIDE_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					2 => array(
						'TITLE' => GetMessage('COUNT_2'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/section_count_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					3 => array(
						'TITLE' => GetMessage('COUNT_3'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/section_count_3.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					4 => array(
						'TITLE' => GetMessage('COUNT_4'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/section_count_4.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 3,
				'THEME' => 'Y',
			),
			'COUNT_ITEMS_IN_LINE_MENU_FULL' => array(
				'TITLE' => GetMessage('COUNT_ITEMS_IN_LINE_MENU_FULL_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					2 => array(
						'TITLE' => GetMessage('COUNT_2'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/section_count_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					3 => array(
						'TITLE' => GetMessage('COUNT_3'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/section_count_3.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					4 => array(
						'TITLE' => GetMessage('COUNT_4'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/section_count_4.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 4,
				'THEME' => 'Y',
			),
			'VIEW_TYPE_MENU' => array(
				'TITLE' => GetMessage('VIEW_TYPE_MENU_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'LINE' => array(
						'TITLE' => GetMessage('VIEW_TYPE_MENU_LIST'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/section_child_position_1.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'BLOCK' => array(
						'TITLE' => GetMessage('VIEW_TYPE_MENU_BLOCK'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/section_child_position_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'LINE',
				'THEME' => 'Y',
			),
		)
	),
	'REGIONALITY_PAGE' => array(
		'TITLE' => GetMessage('REGIONALITY_PAGE_OPTIONS'),
		'THEME' => 'Y',
		'OPTIONS' => array(
			'USE_REGIONALITY' => array(
				'TITLE' => GetMessage('USE_REGIONALITY_TITLE'),
				'TYPE' => 'checkbox',
				'ONE_ROW' => 'Y',
				'DEPENDENT_PARAMS' => array(
					'REGIONALITY_TYPE' => array(
						'TITLE' => GetMessage('REGIONALITY_TYPE_TITLE'),
						'HIDE_TITLE' => 'Y',
						'TYPE' => 'selectbox',
						'IS_ROW' => 'Y',
						'LIST' => array(
							'ONE_DOMAIN' => array(
								'TITLE' => GetMessage('REGIONALITY_TYPE_ONE_DOMAIN'),
								'IMG' => '/bitrix/images/'.$solution.'/themes/region_one_domain.jpg',
								'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
								'POSITION_BLOCK' => 'block',
							),
							'SUBDOMAIN' => array(
								'TITLE' => GetMessage('REGIONALITY_TYPE_SUBDOMAIN'),
								'IMG' => '/bitrix/images/'.$solution.'/themes/region_subdomain.jpg',
								'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
								'POSITION_BLOCK' => 'block',
							),
						),
						'DEFAULT' => 'ONE_DOMAIN',
						'THEME' => 'Y',
						'CONDITIONAL_VALUE' => 'Y',
					),
					'REGIONALITY_VIEW' => array(
						'TITLE' => GetMessage('REGIONALITY_VIEW_TITLE'),
						'TOP_BORDER' => 'Y',
						'TYPE' => 'selectbox',
						'IS_ROW' => 'Y',
						'LIST' => array(
							'SELECT' => array(
								'TITLE' => GetMessage('REGIONALITY_VIEW_SELECT'),
								'IMG' => '/bitrix/images/'.$solution.'/themes/region_dropdown.jpg',
								'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
								'POSITION_BLOCK' => 'block',
							),
							'POPUP_REGIONS' => array(
								'TITLE' => GetMessage('REGIONALITY_VIEW_POPUP_EXT'),
								'IMG' => '/bitrix/images/'.$solution.'/themes/region_popup_with_county.jpg',
								'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
								'POSITION_BLOCK' => 'block',
							),
							'POPUP_REGIONS_SMALL' => array(
								'TITLE' => GetMessage('REGIONALITY_VIEW_POPUP_SMALL'),
								'IMG' => '/bitrix/images/'.$solution.'/themes/popup_with_city.jpg',
								'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
								'POSITION_BLOCK' => 'block',
							),
						),
						'DEFAULT' => 'POPUP_REGIONS',
						'THEME' => 'Y',
						'CONDITIONAL_VALUE' => 'Y',
					),
					'REGIONALITY_FILTER_ITEM_NOTE' => array(
						'NOTE' => GetMessage('REGIONALITY_FILTER_ITEM_NOTE_TEXT'),
						'TYPE' => 'note',
						'DEFAULT' => 'N',
						'THEME' => 'N',
						'CONDITIONAL_VALUE' => 'Y',
					),
					'REGIONALITY_FILTER_ITEM' => array(
						'TITLE' => GetMessage('REGIONALITY_FILTER_ITEM_TITLE'),
						'TYPE' => 'checkbox',
						'DEFAULT' => 'Y',
						'THEME' => 'N',
						'CONDITIONAL_VALUE' => 'Y',
					),
				),
				'DEFAULT' => 'N',
				'THEME' => 'Y',
			),
			'SHOW_SECTIONS_REGION_HINT' => array(
				'TITLE' => GetMessage('SHOW_SECTIONS_REGION_HINT'),
				'TYPE' => 'note',
				'THEME' => 'N',
			),
			'SHOW_SECTIONS_REGION' => array(
				'TITLE' => GetMessage('SHOW_SECTIONS_REGION_TITLE'),
				'TYPE' => 'checkbox',
				'IS_ROW' => 'Y',
				'DEFAULT' => 'N',
				'THEME' => 'N',
			),
		)
	),
	'CATALOG_PAGE' => array(
		'TITLE' => GetMessage('CATALOG_PAGE_OPTIONS'),
		'THEME' => 'Y',
		'OPTIONS' => array(
			'URL_CATALOG_SECTION' => array(
				'TITLE' => GetMessage('URL_CATALOG_SECTION_TITLE'),
				'TYPE' => 'text',
				'DEFAULT' => '#SITE_DIR#product/',
				'CONDITIONAL_VALUE' => 'Y',
				'THEME' => 'N',
			),
			'ORDER_VIEW' => array(
				'TITLE' => GetMessage('ORDER_VIEW_TITLE'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'Y',
				'THEME' => 'Y',
				'ONE_ROW' => 'Y',
				'DEPENDENT_PARAMS' => array(
					'ORDER_BASKET_VIEW' => array(
						'TITLE' => GetMessage('ORDER_BASKET_VIEW_TITLE'),
						'HIDE_TITLE' => 'Y',
						'TYPE' => 'selectbox',
						'IS_ROW' => 'Y',
						'LIST' => array(
							'HEADER' => array(
								'TITLE' => GetMessage('ORDER_BASKET_VIEW_HEADER_TITLE'),
								'IMG' => '/bitrix/images/'.$solution.'/themes/basket_header.jpg',
								'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
								'POSITION_BLOCK' => 'block',
							),
							'FLY' => array(
								'TITLE' => GetMessage('ORDER_BASKET_VIEW_FLY_TITLE'),
								'IMG' => '/bitrix/images/'.$solution.'/themes/basket_fly.jpg',
								'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
								'POSITION_BLOCK' => 'block',
							),
						),
						'DEFAULT' => 'HEADER',
						'CONDITIONAL_VALUE' => 'Y',
						'THEME' => 'Y',
					),
					'URL_BASKET_SECTION' => array(
						'TITLE' => GetMessage('URL_BASKET_SECTION_TITLE'),
						'TYPE' => 'text',
						'DEFAULT' => '#SITE_DIR#cart/',
						'CONDITIONAL_VALUE' => 'Y',
						'THEME' => 'N',
					),
					'URL_ORDER_SECTION' => array(
						'TITLE' => GetMessage('URL_ORDER_SECTION_TITLE'),
						'TYPE' => 'text',
						'DEFAULT' => '#SITE_DIR#cart/order/',
						'CONDITIONAL_VALUE' => 'Y',
						'THEME' => 'N',
					),
				)
			),
			'SHOW_SMARTFILTER' => array(
				'TITLE' => GetMessage('SHOW_FILTER_TITLE'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'Y',
				'THEME' => 'Y',
				'ONE_ROW' => 'Y',
				'DEPENDENT_PARAMS' => array(
					'FILTER_VIEW' => array(
						'TITLE' => GetMessage('M_FILTER_VIEW'),
						'HIDE_TITLE' => 'Y',
						'TYPE' => 'selectbox',
						'IS_ROW' => 'Y',
						'LIST' => array(
							'VERTICAL' => array(
								'TITLE' => GetMessage('M_FILTER_VIEW_VERTICAL'),
								'IMG' => '/bitrix/images/'.$solution.'/themes/filter_vertical.jpg',
								'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
								'POSITION_BLOCK' => 'block',
							),
							'HORIZONTAL' => array(
								'TITLE' => GetMessage('M_FILTER_VIEW_HORIZONTAL'),
								'IMG' => '/bitrix/images/'.$solution.'/themes/filter_horizontal.jpg',
								'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
								'POSITION_BLOCK' => 'block',
							),
							// 'NONE' => GetMessage('M_FILTER_VIEW_NONE'),
						),
						'DEFAULT' => 'VERTICAL',
						'CONDITIONAL_VALUE' => 'Y',
						'THEME' => 'Y',
						'PREVIEW' => array(
							'URL' => $arFirstSectionCatalog['SECTION_PAGE_URL'],
						),
					),
				)
			),
			'SECTIONS_TYPE_VIEW' => array(
				'TITLE' => GetMessage('SECTIONS_TYPE_VIEW_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'sections_1' => array(
						'TITLE' => GetMessage("CATALOG_SECTIONS_1"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/catalog_sections_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'sections_2' => array(
						'TITLE' => GetMessage("CATALOG_SECTIONS_2"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/catalog_sections_5.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'sections_3' => array(
						'TITLE' => GetMessage("CATALOG_SECTIONS_3"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/catalog_sections_6.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'sections_4' => array(
						'TITLE' => GetMessage("CATALOG_SECTIONS_4"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/catalog_sections_1.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'sections_5' => array(
						'TITLE' => GetMessage("CATALOG_SECTIONS_5"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/catalog_sections_3.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'sections_6' => array(
						'TITLE' => GetMessage("CATALOG_SECTIONS_6"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/catalog_sections_4.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'sections_1',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'URL' => 'product/'
				),
			),
			'ELEMENTS_TABLE_TYPE_VIEW' => array(
				'TITLE' => GetMessage('ELEMENTS_TABLE_TYPE_VIEW_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'catalog_table' => array(
						'TITLE' => GetMessage('VIEW_TYPE_ITEM_NORMAL'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/catalog_table_1.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'catalog_table_2' => array(
						'TITLE' => GetMessage("VIEW_TYPE_ITEM_PROP"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/catalog_table_2.gif',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'catalog_table',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'URL' => $arFirstSectionCatalog['SECTION_PAGE_URL'].'?display=table',
				),
			),
			'ELEMENTS_LIST_TYPE_VIEW' => array(
				'TITLE' => GetMessage('ELEMENTS_LIST_TYPE_VIEW_TITLE'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'catalog_list' => array(
						'TITLE' => 1,
					),
				),
				'DEFAULT' => 'catalog_list',
				'THEME' => 'N',
			),
			'ELEMENTS_PRICE_TYPE_VIEW' => array(
				'TITLE' => GetMessage('ELEMENTS_PRICE_TYPE_VIEW_TITLE'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'catalog_price' => array(
						'TITLE' => 1,
					),
				),
				'DEFAULT' => 'catalog_price',
				'THEME' => 'N',
			),
			'CATALOG_PAGE_DETAIL' => array(
				'TITLE' => GetMessage('CATALOG_DETAIL_PAGE_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'element_1' => array(
						'TITLE' => GetMessage('PAGE_TAB'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/element_tab.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'element_2' => array(
						'TITLE' => GetMessage('PAGE_NOTAB'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/element_notab.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'element_1',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'URL' => $arFirstElementCatalog['DETAIL_PAGE_URL'],
				),
			),
		),
	),
	'SERVICES_PAGE' => array(
		'TITLE' => GetMessage('SERVICES_PAGE_OPTIONS'),
		'THEME' => 'Y',
		'OPTIONS' => array(
			'SERVICES_SECTIONS_TYPE_VIEW' => array(
				'TITLE' => GetMessage('SECTIONS_TYPE_VIEW_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'sections_1' => array(
						'TITLE' => GetMessage("SERVICES_SECTIONS_1"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/services_sections_4.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'sections_2' => array(
						'TITLE' => GetMessage("SERVICES_SECTIONS_2"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/services_sections_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'sections_3' => array(
						'TITLE' => GetMessage("SERVICES_SECTIONS_3"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/services_sections_3.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'sections_4' => array(
						'TITLE' => GetMessage("SERVICES_SECTIONS_4"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/services_sections_1.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'sections_5' => array(
						'TITLE' => GetMessage("SERVICES_SECTIONS_5"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/services_sections_7.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'sections_6' => array(
						'TITLE' => GetMessage("SERVICES_SECTIONS_6"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/services_sections_6.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'sections_7' => array(
						'TITLE' => GetMessage("SERVICES_SECTIONS_7"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/services_sections_5.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'sections_6',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'URL' => 'services/'
				),
			),
			'SERVICES_SECTION_ELEMENTS_TYPE_VIEW' => array(
				'TITLE' => GetMessage('ELEMENTS_TYPE_VIEW_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'list_elements_1' => array(
						'TITLE' => GetMessage("SERVICES_ELEMENTS_1"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/services_elements_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_2' => array(
						'TITLE' => GetMessage("SERVICES_ELEMENTS_2"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/services_elements_1.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_3' => array(
						'TITLE' => GetMessage("SERVICES_ELEMENTS_3"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/services_elements_4.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_4' => array(
						'TITLE' => GetMessage("SERVICES_ELEMENTS_4"),
						'IMG' => '/bitrix/images/'.$solution.'/themes/services_elements_3.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'list_elements_3',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'URL' => $arFirstSectionServicesLastChild['SECTION_PAGE_URL'],
				),
			),
			'SERVICES_PAGE_DETAIL' => array(
				'TITLE' => GetMessage('SERVICES_DETAIL_PAGE_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'element_1' => array(
						'TITLE' => GetMessage('PAGE_TAB'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/element_tab.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'element_2' => array(
						'TITLE' => GetMessage('PAGE_NOTAB'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/element_notab.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'element_1',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'URL' => $arFirstElementServices['DETAIL_PAGE_URL'],
				),
			),
		),
	),
	'SECTION' => array(
		'TITLE' => GetMessage('SECTION_OPTIONS'),
		'THEME' => 'Y',
		'OPTIONS' => array(
			'PAGE_CONTACTS' => array(
				'TITLE' => GetMessage('PAGE_CONTACTS'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'1' => array(
						'TITLE' => GetMessage('PAGE_CONTACTS_1'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/contacts_page_1.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'3' => array(
						'TITLE' => GetMessage('PAGE_CONTACTS_3'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/contacts_page_3.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'4' => array(
						'TITLE' => GetMessage('PAGE_CONTACTS_4'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/contacts_page_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'2' => array(
						'TITLE' => GetMessage('PAGE_CONTACTS_2'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/contacts_page_4.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => '2',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'URL' => 'contacts/'
				),
			),
			'CONTACTS_EDIT_LINK_NOTE' => array(
				'TITLE' => GetMessage('CONTACTS_OPTIONS_EDIT_LINK_NOTE'),
				'TYPE' => 'note',
				'THEME' => 'N',
			),
			/*'CONTACTS_ADDRESS' => array(
				'TITLE' => GetMessage('CONTACTS_OPTIONS_ADDRESS_TITLE'),
				'TYPE' => 'includefile',
				'INCLUDEFILE' => '#SITE_DIR#include/contacts-site-address.php',
				'THEME' => 'N',
			),
			'CONTACTS_PHONE' => array(
				'TITLE' => GetMessage('CONTACTS_OPTIONS_PHONE_TITLE'),
				'TYPE' => 'includefile',
				'INCLUDEFILE' => '#SITE_DIR#include/contacts-site-phone.php',
				'THEME' => 'N',
			),
			'CONTACTS_REGIONAL_PHONE' => array(
				'TITLE' => GetMessage('CONTACTS_OPTIONS_REGIONAL_PHONE_TITLE'),
				'TYPE' => 'includefile',
				'INCLUDEFILE' => '#SITE_DIR#include/contacts-site-phone-one.php',
				'THEME' => 'N',
			),
			'CONTACTS_EMAIL' => array(
				'TITLE' => GetMessage('CONTACTS_OPTIONS_EMAIL_TITLE'),
				'TYPE' => 'includefile',
				'INCLUDEFILE' => '#SITE_DIR#include/contacts-site-email.php',
				'THEME' => 'N',
			),
			'CONTACTS_SCHEDULE12' => array(
				'TITLE' => GetMessage('CONTACTS_OPTIONS_SCHEDULE12_TITLE'),
				'TYPE' => 'includefile',
				'INCLUDEFILE' => '#SITE_DIR#include/contacts-site-schedule.php',
				'THEME' => 'N',
			),
			'CONTACTS_DESCRIPTION12' => array(
				'TITLE' => GetMessage('CONTACTS_OPTIONS_DESCRIPTION12_TITLE'),
				'TYPE' => 'includefile',
				'INCLUDEFILE' => '#SITE_DIR#include/contacts-about.php',
				'THEME' => 'N',
			),
			'CONTACTS_REGIONAL_DESCRIPTION34' => array(
				'TITLE' => GetMessage('CONTACTS_OPTIONS_REGIONAL_DESCRIPTION34_TITLE'),
				'TYPE' => 'includefile',
				'INCLUDEFILE' => '#SITE_DIR#include/contacts-regions-title.php',
				'THEME' => 'N',
			),
			'CONTACTS_REGIONAL_DESCRIPTION5' => array(
				'TITLE' => GetMessage('CONTACTS_OPTIONS_REGIONAL_DESCRIPTION5_TITLE'),
				'TYPE' => 'includefile',
				'INCLUDEFILE' => '#SITE_DIR#include/contacts-regions.php',
				'THEME' => 'N',
			),*/
			'CONTACTS_USE_FEEDBACK' => array(
				'TITLE' => GetMessage('CONTACTS_OPTIONS_USE_FEEDBACK_TITLE'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'Y',
				'THEME' => 'N',
			),
			'CONTACTS_USE_MAP' => array(
				'TITLE' => GetMessage('CONTACTS_OPTIONS_USE_MAP_TITLE'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'Y',
				'THEME' => 'N',
			),
			'CONTACTS_MAP' => array(
				'TITLE' => GetMessage('CONTACTS_OPTIONS_MAP_TITLE'),
				'TYPE' => 'includefile',
				'INCLUDEFILE' => '#SITE_DIR#include/contacts-site-map.php',
				'THEME' => 'N',
			),
			'CONTACTS_MAP_NOTE' => array(
				'TITLE' => GetMessage('CONTACTS_OPTIONS_MAP_NOTE'),
				'TYPE' => 'note',
				'ALIGN' => 'center',
				'THEME' => 'N',
			),
			'PROJECTS_PAGE' => array(
				'TITLE' => GetMessage('PROJECTS_PAGE_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'list_elements_4' => array(
						'TITLE' => GetMessage('PAGE_PROJECTS_1'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/projects_page_6.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_2' => array(
						'TITLE' => GetMessage('PAGE_PROJECTS_2'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/projects_page_5.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_6' => array(
						'TITLE' => GetMessage('PAGE_PROJECTS_6'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/projects_page_4.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),

					'list_elements_1' => array(
						'TITLE' => GetMessage('PAGE_PROJECTS_3'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/projects_page_3.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_3' => array(
						'TITLE' => GetMessage('PAGE_PROJECTS_4'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/projects_page_1.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_5' => array(
						'TITLE' => GetMessage('PAGE_PROJECTS_5'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/projects_page_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'list_elements_5',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'URL' => 'projects/'
				),
			),
			'NEWS_PAGE' => array(
				'TITLE' => GetMessage('NEWS_PAGE_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'list_elements_1' => array(
						'TITLE' => GetMessage('PAGE_LIST'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/new_page_1.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_2' => array(
						'TITLE' => GetMessage('PAGE_TILE'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/new_page_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_3' => array(
						'TITLE' => GetMessage('PAGE_NEWS_3'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/new_page_3_new.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_4' => array(
						'TITLE' => GetMessage('PAGE_NEWS_4'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/news_page_4.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'list_elements_2',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'URL' => 'news/'
				),
			),
			'STAFF_PAGE' => array(
				'TITLE' => GetMessage('STAFF_PAGE_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'list_elements_1' => array(
						'TITLE' => GetMessage('PAGE_STAFF_1'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/staff_template_1.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_2' => array(
						'TITLE' => GetMessage('PAGE_STAFF_2'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/staff_template_3.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_3' => array(
						'TITLE' => GetMessage('PAGE_STAFF_3'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/staff_template_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_4' => array(
						'TITLE' => GetMessage('PAGE_STAFF_4'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/staff_template_4.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'list_elements_3',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'URL' => 'company/staff/'
				),
			),
			'PARTNERS_PAGE' => array(
				'TITLE' => GetMessage('PARTNERS_PAGE_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'list_elements_1' => array(
						'TITLE' => GetMessage('PAGE_PARTNERS_1'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/partners_page_1.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_2' => array(
						'TITLE' => GetMessage('PAGE_PARTNERS_2'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/partners_page_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_3' => array(
						'TITLE' => GetMessage('PAGE_PARTNERS_3'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/partners_page_3.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'list_elements_1',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'URL' => 'company/partners/'
				),
			),
			'MANUFACTURERS_PAGE' => array(
				'TITLE' => GetMessage('MANUFACTURERS_PAGE_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'list_elements_1' => array(
						'TITLE' => GetMessage('PAGE_PARTNERS_1'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/partners_page_1.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_2' => array(
						'TITLE' => GetMessage('PAGE_PARTNERS_2'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/partners_page_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_3' => array(
						'TITLE' => GetMessage('PAGE_PARTNERS_3'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/partners_page_3.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'list_elements_3',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'URL' => 'company/manufacturers/'
				),
			),
			'REVIEWS_PAGE' => array(
				'TITLE' => GetMessage('REVIEWS_PAGE_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'list_elements_1' => array(
						'TITLE' => GetMessage('PAGE_REVIEWS_1'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/reviews_page_1.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_2' => array(
						'TITLE' => GetMessage('PAGE_REVIEWS_2'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/reviews_page_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'list_elements_1',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'URL' => 'company/reviews/'
				),
			),
			'VACANCY_PAGE' => array(
				'TITLE' => GetMessage('VACANCY_PAGE_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'list_elements_1' => array(
						'TITLE' => GetMessage('PAGE_ACCORDION'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/vacancy_page_1.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_2' => array(
						'TITLE' => GetMessage('PAGE_LIST'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/vacancy_page_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'list_elements_2',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'URL' => 'company/vacancy/'
				),
			),
			'LICENSES_PAGE' => array(
				'TITLE' => GetMessage('LICENSES_PAGE_TITLE2'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'list_elements_1' => array(
						'TITLE' => GetMessage('PAGE_BLOCK'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/licenses_page_1.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_2' => array(
						'TITLE' => GetMessage('PAGE_LIST'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/licenses_page_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'list_elements_2',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'URL' => 'company/licenses/'
				),
			),
			'DOCUMENTS_PAGE' => array(
				'TITLE' => GetMessage('LICENSES_PAGE_TITLE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'list_elements_1' => array(
						'TITLE' => GetMessage('PAGE_BLOCK'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/documents_page_1.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'list_elements_2' => array(
						'TITLE' => GetMessage('PAGE_LIST'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/documents_page_2.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'list_elements_2',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'URL' => 'company/docs/'
				),
			),
		)
	),
	'PAGES' => array(
		'TITLE' => GetMessage('PAGES_OPTIONS'),
		'THEME' => 'N',
		'OPTIONS' => array(
			'SUBSCRIBE_PAGE' => array(
				'TITLE' => GetMessage('SUBSCRIBE_PAGE'),
				'TYPE' => 'text',
				'DEFAULT' => '#SITE_DIR#cabinet/subscribe/',
				'CONDITIONAL_VALUE' => 'Y',
				'THEME' => 'N'
			),
		),
	),
	'FOOTER' => array(
		'TITLE' => GetMessage('FOOTER_OPTIONS'),
		'THEME' => 'Y',
		'OPTIONS' => array(
			'CALLBACK_BUTTON_FOOTER' => array(
				'TITLE' => GetMessage('CALLBACK_BUTTON_FOOTER'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'Y',
				'ONE_ROW' => 'Y',
				'THEME' => 'Y',
			),
			'FOOTER_TYPE' => array(
				'TITLE' => GetMessage('FOOTER_TYPE'),
				'TYPE' => 'selectbox',
				'LIST' => array(
					'1' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/dark_3.jpg',
						'TITLE' => '1',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'2' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/dark_2.jpg',
						'TITLE' => '2',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'3' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/dark_1.jpg',
						'TITLE' => '3',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'4' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/light_3.jpg',
						'TITLE' => '4',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'5' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/light_2.jpg',
						'TITLE' => '5',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'6' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/light_1.jpg',
						'TITLE' => '6',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
					),
					'custom' => array(
						'TITLE' => 'Custom',
						'POSITION_BLOCK' => 'block',
						'HIDE' => 'Y'
					),
				),
				'DEFAULT' => '1',
				'THEME' => 'Y',
				'PREVIEW' => array(
					'SCROLL_BLOCK' => '#footer'
				),
			),
		)
	),

	'ADV' => array(
		'TITLE' => GetMessage('ADV_OPTIONS'),
		'THEME' => 'Y',
		'OPTIONS' => array(
			'ADV_TOP_HEADER' => array(
				'TITLE' => GetMessage('ADV_TOP_HEADER_TITLE'),
				'IMG' => '/bitrix/images/'.$solution.'/themes/banner_position1.png',
				'TYPE' => 'checkbox',
				'DEFAULT' => 'N',
				'THEME' => 'Y',
				'GROUP' => GetMessage('ADV_GROUP_TITLE'),
				'ROW_CLASS' => 'col-md-6',
				'POSITION_BLOCK' => 'block',
				'IS_ROW' => 'Y',
				'SMALL_TOGGLE' => 'Y',
			),
			'ADV_TOP_UNDERHEADER' => array(
				'TITLE' => GetMessage('ADV_TOP_UNDERHEADER_TITLE'),
				'IMG' => '/bitrix/images/'.$solution.'/themes/banner_position2.png',
				'TYPE' => 'checkbox',
				'DEFAULT' => 'N',
				'THEME' => 'Y',
				'GROUP' => GetMessage('ADV_GROUP_TITLE'),
				'ROW_CLASS' => 'col-md-6',
				'POSITION_BLOCK' => 'block',
				'IS_ROW' => 'Y',
				'SMALL_TOGGLE' => 'Y',
			),
			'ADV_SIDE' => array(
				'TITLE' => GetMessage('ADV_SIDE_TITLE'),
				'IMG' => '/bitrix/images/'.$solution.'/themes/banner_position5.png',
				'TYPE' => 'checkbox',
				'DEFAULT' => 'Y',
				'THEME' => 'Y',
				'GROUP' => GetMessage('ADV_GROUP_TITLE'),
				'ROW_CLASS' => 'col-md-6',
				'POSITION_BLOCK' => 'block',
				'IS_ROW' => 'Y',
				'SMALL_TOGGLE' => 'Y',
			),
			'ADV_CONTENT_TOP' => array(
				'TITLE' => GetMessage('ADV_CONTENT_TOP_TITLE'),
				'IMG' => '/bitrix/images/'.$solution.'/themes/banner_position3.png',
				'TYPE' => 'checkbox',
				'DEFAULT' => 'N',
				'THEME' => 'Y',
				'GROUP' => GetMessage('ADV_GROUP_TITLE'),
				'ROW_CLASS' => 'col-md-6',
				'POSITION_BLOCK' => 'block',
				'IS_ROW' => 'Y',
				'SMALL_TOGGLE' => 'Y',
			),
			'ADV_CONTENT_BOTTOM' => array(
				'TITLE' => GetMessage('ADV_CONTENT_BOTTOM_TITLE'),
				'IMG' => '/bitrix/images/'.$solution.'/themes/banner_position4.png',
				'TYPE' => 'checkbox',
				'DEFAULT' => 'N',
				'THEME' => 'Y',
				'GROUP' => GetMessage('ADV_GROUP_TITLE'),
				'ROW_CLASS' => 'col-md-6',
				'POSITION_BLOCK' => 'block',
				'IS_ROW' => 'Y',
				'SMALL_TOGGLE' => 'Y',
			),
			'ADV_FOOTER' => array(
				'TITLE' => GetMessage('ADV_FOOTER_TITLE'),
				'IMG' => '/bitrix/images/'.$solution.'/themes/banner_position6.png',
				'TYPE' => 'checkbox',
				'DEFAULT' => 'N',
				'THEME' => 'Y',
				'GROUP' => GetMessage('ADV_GROUP_TITLE'),
				'ROW_CLASS' => 'col-md-6',
				'POSITION_BLOCK' => 'block',
				'IS_ROW' => 'Y',
				'SMALL_TOGGLE' => 'Y',
			)
		),
	),
	'MOBILE' => array(
		'TITLE' => GetMessage('MOBILE_OPTIONS'),
		'THEME' => 'Y',
		'OPTIONS' => array(
			'HEADER_MOBILE' => array(
				'TITLE' => GetMessage('HEADER_MOBILE'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'N',
				'LIST' => array(
					'1' => array(
						'IMG' => '/bitrix/images/'.$solution.'/themes/white_mobile_header.jpg',
						'TITLE' => GetMessage('HEADER_MOBILE_WHITE'),
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
						'TITLE_WIDTH' => '75px',
					),
					'2' => array(
						'TITLE' => GetMessage('HEADER_MOBILE_COLOR'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/color_mobile_header.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
						'TITLE_WIDTH' => '75px',
					),
					'custom' => array(
						'TITLE' => 'Custom',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
						'POSITION_TITLE' => 'left',
						'TITLE_WIDTH' => '75px',
						'HIDE' => 'Y'
					),
				),
				'DEFAULT' => '1',
				'THEME' => 'Y',
			),
			'HEADER_MOBILE_MENU_OPEN' => array(
				'TITLE' => GetMessage('HEADER_MOBILE_MENU_OPEN'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'1' => array(
						'TITLE' => GetMessage('HEADER_MOBILE_MENU_OPEN_LEFT'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/left_mobile_menu.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'2' => array(
						'TITLE' => GetMessage('HEADER_MOBILE_MENU_OPEN_TOP'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/top_mobile_menu.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => '1',
				'THEME' => 'Y',
			),
			'HEADER_MOBILE_MENU' => array(
				'TITLE' => GetMessage('HEADER_MOBILE_MENU'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'1' => array(
						'TITLE' => GetMessage('HEADER_MOBILE_MENU_FULL'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/full_mobile_menu.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'2' => array(
						'TITLE' => GetMessage('HEADER_MOBILE_MENU_TOP'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/short_mobile_menu.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'custom' => array(
						'TITLE' => 'Custom',
						'HIDE' => 'Y',
					),
				),
				'DEFAULT' => '1',
				'THEME' => 'Y',
			),
			'HEADER_MOBILE_MENU_COLOR' => array(
				'TITLE' => GetMessage('HEADER_MOBILE_MENU_COLOR'),
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'LIGHT' => array(
						'TITLE' => GetMessage('LIGHT'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/light_mobile_menu.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
					'DARK' => array(
						'TITLE' => GetMessage('DARK'),
						'IMG' => '/bitrix/images/'.$solution.'/themes/dark_mobile_menu.jpg',
						'ROW_CLASS' => 'col-md-4 col-sm-4 col-xs-12',
						'POSITION_BLOCK' => 'block',
					),
				),
				'DEFAULT' => 'LIGHT',
				'THEME' => 'Y',
			),
		)
	),
	'LK' => array(
		'TITLE' => GetMessage('LK_OPTIONS'),
		'THEME' => 'Y',
		'OPTIONS' => array(
			'CABINET' => array(
				'TITLE' => GetMessage('CABINET'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'Y',
				'THEME' => 'Y',
				'ONE_ROW' => 'Y',
				'DEPENDENT_PARAMS' => array(
					'PERSONAL_ONEFIO' => array(
						'TITLE' => GetMessage('PERSONAL_ONEFIO_TITLE'),
						'TYPE' => 'checkbox',
						'DEFAULT' => 'Y',
						'THEME' => 'Y',
						'ONE_ROW' => 'Y',
						'CONDITIONAL_VALUE' => 'Y',
					),
				),
			),
			'LOGIN_EQUAL_EMAIL' => array(
				'TITLE' => GetMessage('LOGIN_EQUAL_EMAIL_TITLE'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'N',
				'THEME' => 'Y',
				'ONE_ROW' => 'Y',
			),
		)
	),
	'SHOW_FORMS' => array(
		'TITLE' => GetMessage('SHOW_FORMS_OPTIONS'),
		'THEME' => 'Y',
		'OPTIONS' => array(
			'USE_BITRIX_FORM' => array(
				'TITLE' => GetMessage('USE_BITRIX_FORM_TITLE'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'N',
				'ONE_ROW' => 'Y',
				'THEME' => 'N',
			),
			'SHOW_LICENCE' => array(
				'TITLE' => GetMessage('SHOW_LICENCE_TITLE'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'Y',
				'ONE_ROW' => 'Y',
				'HINT' => GetMessage('LICENCE_TEXT_VALUE_HINT'),
				'DEPENDENT_PARAMS' => array(
					'LICENCE_CHECKED' => array(
						'TITLE' => GetMessage('LICENCE_CHECKED_TITLE'),
						'TYPE' => 'checkbox',
						'CONDITIONAL_VALUE' => 'Y',
						'DEFAULT' => 'N',
						'THEME' => 'N',
					),
					'LICENCE_TEXT' => array(
						'TITLE' => GetMessage('LICENCE_TEXT_TITLE'),
						'HIDE_TITLE' => 'Y',
						'TYPE' => 'includefile',
						'INCLUDEFILE' => '#SITE_DIR#include/licenses_text.php',
						'CONDITIONAL_VALUE' => 'Y',
						'PARAMS' => array(
							'WIDTH' => '100%'
						),
						'DEFAULT' => GetMessage('LICENCE_TEXT_VALUE'),
						'THEME' => 'N',
					),
				),
				'THEME' => 'Y',
			),
			'FORM_TYPE' => array(
				'TITLE' => GetMessage('FORM_TYPE'),
				'DEFAULT' => 'N',
				'TYPE' => 'selectbox',
				'IS_ROW' => 'Y',
				'LIST' => array(
					'POPUP' => array(
						'TITLE' => GetMessage('FORM_TYPE_POPUP'),
						'IMG' => '',
						'ROW_CLASS' => 'col-md-4',
						'POSITION_BLOCK' => 'block',
						'IMG' => '/bitrix/images/'.$solution.'/themes/form_popup.jpg',
					),
					'LATERAL' => array(
						'TITLE' => GetMessage('FORM_TYPE_LATERAL'),
						'IMG' => '',
						'ROW_CLASS' => 'col-md-4',
						'POSITION_BLOCK' => 'block',
						'IMG' => '/bitrix/images/'.$solution.'/themes/form_slide.jpg',
					),
				),
				'DEFAULT' => 'LATERAL',
				'THEME' => 'Y',
			),
			'CALLBACK' => array(
				'TITLE' => GetMessage('SHOW_FORM_CALLBACK'),
				'TYPE' => 'hidden',
				'VALUE_IMPORTANT' => 'Y',
				'THEME' => 'Y',
				'CLASS' => 'join_option',
				'PARENT' => 'SHOW_FORMS',
				'SHOW_DEPENDENT_PARAMS' => 'Y',
				'DEPENDENT_PARAMS' => array(
					'LEFT_FORM_CALLBACK' => array(
						'TITLE' => GetMessage('LEFT_FORM'),
						'TYPE' => 'checkbox',
						'DEFAULT' => 'Y',
						'THEME' => 'Y',
						'CONDITIONAL_VALUE' => 'Y',
						'SMALL_TOGGLE' => 'Y',
					),
					'FLY_FORM_CALLBACK' => array(
						'TITLE' => GetMessage('FLY_FORM'),
						'TYPE' => 'checkbox',
						'DEFAULT' => 'Y',
						'THEME' => 'Y',
						'CONDITIONAL_VALUE' => 'Y',
						'SMALL_TOGGLE' => 'Y',
					),
				),
			),
			'ASK_QUESTION' => array(
				'TITLE' => GetMessage('SHOW_FORM_ASK_QUESTION'),
				'THEME' => 'Y',
				'VALUE_IMPORTANT' => 'Y',
				'TYPE' => 'hidden',
				'CLASS' => 'join_option',
				'PARENT' => 'SHOW_FORMS',
				'SHOW_DEPENDENT_PARAMS' => 'Y',
				'DEPENDENT_PARAMS' => array(
					'LEFT_FORM_ASK_QUESTION' => array(
						'TITLE' => GetMessage('LEFT_FORM'),
						'TYPE' => 'checkbox',
						'DEFAULT' => 'Y',
						'THEME' => 'Y',
						'CONDITIONAL_VALUE' => 'Y',
						'SMALL_TOGGLE' => 'Y',
					),
					'FLY_FORM_ASK_QUESTION' => array(
						'TITLE' => GetMessage('FLY_FORM'),
						'TYPE' => 'checkbox',
						'DEFAULT' => 'Y',
						'THEME' => 'Y',
						'CONDITIONAL_VALUE' => 'Y',
						'SMALL_TOGGLE' => 'Y',
					),
				)
			),
			'ADD_REVIEW' => array(
				'TITLE' => GetMessage('SHOW_FORM_ADD_REVIEW'),
				'THEME' => 'Y',
				'VALUE_IMPORTANT' => 'Y',
				'TYPE' => 'hidden',
				'CLASS' => 'join_option',
				'PARENT' => 'SHOW_FORMS',
				'SHOW_DEPENDENT_PARAMS' => 'Y',
				'DEPENDENT_PARAMS' => array(
					'LEFT_FORM_ADD_REVIEW' => array(
						'TITLE' => GetMessage('LEFT_FORM'),
						'TYPE' => 'checkbox',
						'DEFAULT' => 'Y',
						'THEME' => 'Y',
						'CONDITIONAL_VALUE' => 'Y',
						'SMALL_TOGGLE' => 'Y',
					),
					'FLY_FORM_ADD_REVIEW' => array(
						'TITLE' => GetMessage('FLY_FORM'),
						'TYPE' => 'checkbox',
						'DEFAULT' => 'Y',
						'THEME' => 'Y',
						'CONDITIONAL_VALUE' => 'Y',
						'SMALL_TOGGLE' => 'Y',
					),
				)
			),
			'MAP' => array(
				'TITLE' => GetMessage('SHOW_MAP'),
				'THEME' => 'Y',
				'VALUE_IMPORTANT' => 'Y',
				'TYPE' => 'hidden',
				'CLASS' => 'join_option',
				'PARENT' => 'SHOW_FORMS',
				'SHOW_DEPENDENT_PARAMS' => 'Y',
				'DEPENDENT_PARAMS' => array(
					'LEFT_FORM_MAP' => array(
						'TITLE' => GetMessage('LEFT_FORM'),
						'TYPE' => 'checkbox',
						'DEFAULT' => 'Y',
						'THEME' => 'Y',
						'CONDITIONAL_VALUE' => 'Y',
						'SMALL_TOGGLE' => 'Y',
					),
					'FLY_FORM_MAP' => array(
						'TITLE' => GetMessage('FLY_FORM'),
						'TYPE' => 'checkbox',
						'DEFAULT' => 'Y',
						'THEME' => 'Y',
						'CONDITIONAL_VALUE' => 'Y',
						'SMALL_TOGGLE' => 'Y',
					),
				)
			),
		)
	),

	'COUNTERS_GOALS' => array(
		'TITLE' => GetMessage('COUNTERS_GOALS_OPTIONS'),
		'THEME' => 'N',
		'OPTIONS' => array(
			'ALL_COUNTERS' => array(
				'TITLE' => GetMessage('ALL_COUNTERS_TITLE'),
				'TYPE' => 'includefile',
				'INCLUDEFILE' => '#SITE_DIR#include/invis-counter.php',
			),
			'YA_GOLAS' => array(
				'TITLE' => GetMessage('YA_GOLAS_TITLE'),
				'TYPE' => 'checkbox',
				'DEFAULT' => 'N',
				'DEPENDENT_PARAMS' => array(
					'YA_COUNTER_ID' => array(
						'TITLE' => GetMessage('YA_COUNTER_ID_TITLE'),
						'TYPE' => 'text',
						'DEFAULT' => '',
						'THEME' => 'N',
						'CONDITIONAL_VALUE' => 'Y',
					),
					'USE_FORMS_GOALS' => array(
						'TITLE' => GetMessage('USE_FORMS_GOALS_TITLE'),
						'TYPE' => 'selectbox',
						'LIST' => array(
							'NONE' => GetMessage('USE_FORMS_GOALS_NONE'),
							'COMMON' => GetMessage('USE_FORMS_GOALS_COMMON'),
							'SINGLE' => GetMessage('USE_FORMS_GOALS_SINGLE'),
						),
						'DEFAULT' => 'COMMON',
						'THEME' => 'N',
						'CONDITIONAL_VALUE' => 'Y',
					),
					'USE_FORMS_GOALS_NOTE' => array(
						'NOTE' => GetMessage('USE_FORM_GOALS_NOTE_TITLE'),
						'TYPE' => 'note',
						'THEME' => 'N',
						// 'CONDITIONAL_VALUE' => 'Y',
					),
					'USE_SALE_GOALS' => array(
						'TITLE' => GetMessage('USE_SALE_GOALS_TITLE'),
						'TYPE' => 'checkbox',
						'DEFAULT' => 'Y',
						'THEME' => 'N',
						'CONDITIONAL_VALUE' => 'Y',
					),
					'USE_SALE_GOALS_NOTE' => array(
						'NOTE' => GetMessage('USE_SALE_GOALS_NOTE_TITLE'),
						'TYPE' => 'note',
						'THEME' => 'N',
						// 'CONDITIONAL_VALUE' => 'Y',
					),
					'USE_DEBUG_GOALS' => array(
						'TITLE' => GetMessage('USE_DEBUG_GOALS_TITLE'),
						'TYPE' => 'checkbox',
						'DEFAULT' => 'N',
						'THEME' => 'N',
						'CONDITIONAL_VALUE' => 'Y',
					),
					'USE_DEBUG_GOALS_NOTE' => array(
						'NOTE' => GetMessage('USE_DEBUG_GOALS_NOTE_TITLE'),
						'TYPE' => 'note',
						'THEME' => 'N',
						// 'CONDITIONAL_VALUE' => 'Y',
					),
				)
			)
		)
	),
);

if(!\Bitrix\Main\Loader::includeModule('form')){
	unset($moduleClass::$arParametrsList['SHOW_FORMS']['OPTIONS']['USE_BITRIX_FORM']);
}

foreach(GetModuleEvents(PRIORITY_MODULE_ID, 'OnAsproParameters', true) as $arEvent) // event for manipulation arMainPageOrder
	ExecuteModuleEventEx($arEvent, array(&$moduleClass::$arParametrsList));
?>