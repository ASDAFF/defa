<div class="row">
	<?if($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"):?>
		<div class="col-md-9 col-sm-12 col-xs-12 content-md">
		<?CPriority::get_banners_position('CONTENT_TOP');?>
	<?elseif($arTheme["SIDE_MENU"]["VALUE"] == "LEFT"):?>
		<div class="col-md-3 col-sm-3 hidden-xs hidden-sm left-menu-md">
			<?CPriority::ShowPageType('left_block')?>
		</div>
		<div class="col-md-9 col-sm-12 col-xs-12 content-md">
		<?CPriority::get_banners_position('CONTENT_TOP');?>
	<?endif;?>

		<?$APPLICATION->IncludeComponent(
			"bitrix:news.detail",
			"services2",
			Array(
				"S_ASK_QUESTION" => $arParams["S_ASK_QUESTION"],
				"S_ORDER_SERVISE" => $arParams["S_ORDER_SERVISE"],
				"LIST_PRODUCT_BLOCKS_ALL_ORDER" => ($arParams["LIST_PRODUCT_BLOCKS_ALL_ORDER"] ? $arParams["LIST_PRODUCT_BLOCKS_ALL_ORDER"] : "tizers,sale,tarifs,desc,char,projects,faq,docs,video,gallery,comments,brand,services,goods"),
				"T_GALLERY" => $arParams["T_GALLERY"],
				"T_DOCS" => $arParams["T_DOCS"],
				"T_PROJECTS" => $arParams["T_PROJECTS"],
				"T_CHARACTERISTICS" => $arParams["T_CHARACTERISTICS"],
				"T_VIDEO" => $arParams["T_VIDEO"],
				"T_DESC" => $arParams["T_DESC"],
				"T_FAQ" => $arParams["T_FAQ"],
				"T_SERVICES" => $arParams["T_SERVICES"],
				"T_ITEMS" => $arParams["T_ITEMS"],
				"T_PARTNERS" => $arParams["T_PARTNERS"],
				"T_REVIEWS" => $arParams["T_REVIEWS"],
				"T_STAFF" => $arParams["T_STAFF"],
				"T_TARIF" => $arParams["T_TARIF"],
				"T_VACANCYS" => $arParams["T_VACANCYS"],
				"T_NEWS" => $arParams["T_NEWS"],
				"ORDER_VIEW" => $bOrderViewBasket,
				"T_SERTIFICATES" => $arParams["T_SERTIFICATES"],
				"SERVICES_LINK_ELEMENTS_TEMPLATE" => $arParams["SERVICES_LINK_ELEMENTS_TEMPLATE"],
				"FORM_ID_ORDER_SERVISE" => $arParams["FORM_ID_ORDER_SERVISE"],
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
				'TARIFS_IBLOCK_ID' => $arParams['TARIFS_IBLOCK_ID'],
				'TARIFS_LINK_ELEMENTS_TEMPLATE' => $arParams['TARIFS_LINK_ELEMENTS_TEMPLATE'],
				'COUNT_SHOW_PROPRERTIES' => $arParams['COUNT_SHOW_PROPRERTIES'],
				'COUNT_TARIFS' => $arParams['COUNT_TARIFS'],
				'TARIFS_PROPERTY_CODE' => $arParams['TARIFS_PROPERTY_CODE'],
				"COUNT_LG" => $arParams["COUNT_LG"],
				"COUNT_MD" => $arParams["COUNT_MD"],
				"COUNT_SM" => $arParams["COUNT_SM"],
				"COUNT_XS" => $arParams["COUNT_XS"],
				"SHOW_PROPS_NAME" => $arParams["SHOW_PROPS_NAME"],
				"STRICT_SECTION_CHECK" => $arParams["STRICT_SECTION_CHECK"],
				'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
				'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
			),
			$component
		);?>
	<?if($arTheme["SIDE_MENU"]["VALUE"] == "LEFT"):?>
		<?CPriority::get_banners_position('CONTENT_BOTTOM');?>
		</div><?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
	<?elseif($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"):?>
		<?CPriority::get_banners_position('CONTENT_BOTTOM');?>
		</div><?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
		<div class="col-md-3 col-sm-3 hidden-xs hidden-sm right-menu-md">
			<?CPriority::ShowPageType('left_block')?>
		</div>
	<?endif;?>
</div>