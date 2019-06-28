<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"landing",
	Array(
		"S_ASK_QUESTION" => $arParams["S_ASK_QUESTION"],
		"S_ORDER_SERVISE" => $arParams["S_ORDER_SERVISE"],
		"FORM_ID_ORDER_SERVISE" => $arParams["FORM_ID_ORDER_SERVISE"] ? $arParams["FORM_ID_ORDER_SERVISE"] : CPriority::getFormID("aspro_priority_order_product"),
		"T_GALLERY" => $arParams["T_GALLERY"],
		"T_DOCS" => $arParams["T_DOCS"],
		"T_PROJECTS" => $arParams["T_PROJECTS"],
		"T_CHARACTERISTICS" => $arParams["T_CHARACTERISTICS"],
		"T_VIDEO" => $arParams["T_VIDEO"],
		"T_DESC" => $arParams["T_DESC"],
		"T_TARIF" => $arParams["T_TARIF"],
		"T_FAQ" => $arParams["T_FAQ"],
		"T_SERVICES" => $arParams["T_SERVICES"],
		"T_ITEMS" => $arParams["T_ITEMS"],
		"T_DEV" => $arParams["T_DEV"],
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
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
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
		"ORDER_VIEW" => $bOrderViewBasket,
		"BRAND_PROP_CODE" => $arParams["DETAIL_BRAND_PROP_CODE"],
		"BRAND_USE" => $arParams["DETAIL_BRAND_USE"],
		"GALLERY_TYPE" => $arParams["GALLERY_TYPE"],
		"LANDING_TIZER_IBLOCK_ID" => $arParams["LANDING_TIZER_IBLOCK_ID"],
		"LANDING_SECTION_COUNT" => $arParams["LANDING_SECTION_COUNT"],
		"LANDING_SECTION_COUNT_VISIBLE" => $arParams["LANDING_SECTION_COUNT_VISIBLE"],
		"LANDING" => $arParams["LANDING"],
	),
	$component
);?>

<div class="row">
	<div class="col-md-<?=($arElement['PROPERTY_FORM_QUESTION_VALUE'] == 'Y' ? '9' : '12');?>">
		<div class="catalog" id="right_block_ajax">
			<?include_once(__DIR__."/../filter.php");?>

			<?=$APPLICATION->ShowViewContent('langing_title')?>

			<?
			/*if($GLOBALS[$arParams["FILTER_NAME"]])
			{*/
				$arFilter = array('IBLOCK_ID' => $arParams['CATALOG_IBLOCK_ID'], 'ACTIVE' => 'Y');
				if($arElement['PROPERTY_SECTION_VALUE'])
				{
					$arFilter['SECTION_ID'] = $arElement['PROPERTY_SECTION_VALUE'];
					$arFilter['INCLUDE_SUBSECTIONS'] = 'Y';
				}
				$iCountElement = CCache::CIblockElement_GetList(array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['CATALOG_IBLOCK_ID']), 'MULTI' => 'N')), array_merge($arFilter, $GLOBALS[$arParams["FILTER_NAME"]]), array());
				if($iCountElement)
				{
					$frame = new \Bitrix\Main\Page\FrameHelper('catalog-elements-block');
					$frame->begin();
					$frame->setAnimation(true);
					?>
					<div class="main-section-wrapper">
						<?include_once(__DIR__."/../include_sort.php");?>
						<?$display_template = $display ? 'catalog_'.$display: 'catalog_table';?>
						<?if($display_template == 'catalog_table')
						{
							$display_template = $arTheme['ELEMENTS_TABLE_TYPE_VIEW']['VALUE'];
						}?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							$display_template,
							Array(
								"S_ASK_QUESTION" => $arParams["S_ASK_QUESTION"],
								"S_ORDER_PRODUCT" => $arParams["S_ORDER_PRODUCT"],
								"TO_ALL" => $arParams["S_TO_ALL"],
								"DISPLAY" => $display,
								"COUNT_IN_LINE" => $arParams["CATALOG_COUNT_IN_LINE"],
								"VIEW_TYPE" => $arParams["VIEW_TYPE"],
								"SHOW_NAME" => $arParams["SHOW_NAME"],
								"SHOW_DETAIL" => $arParams["SHOW_DETAIL"],
								"SHOW_IMAGE" => $arParams["SHOW_IMAGE"],
								"IMAGE_POSITION" => $arParams["IMAGE_POSITION"],
								"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
								"IBLOCK_ID"	=>	$arParams["CATALOG_IBLOCK_ID"],
								"NEWS_COUNT"	=>	$arParams["CATALOG_NEWS_COUNT"],
								"SORT_BY1"	=>	$arAvailableSort[$sort]["SORT"],
								"SORT_ORDER1"	=>	strtoupper($order),
								"SORT_BY2"	=>	$arParams["SORT_BY2"],
								"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
								"FIELD_CODE"	=>	$arParams["DETAIL_FIELD_CODE"],
								"PROPERTY_CODE"	=>	$arParams["DETAIL_PROPERTY_CODE"],
								"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
								"SET_TITLE"	=>	"N",
								"SET_BROWSER_TITLE"	=>	"N",
								"SET_STATUS_404" => "N",
								"INCLUDE_IBLOCK_INTO_CHAIN"	=>	"N",
								"ADD_SECTIONS_CHAIN"	=>	"N",
								"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
								"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
								"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
								"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
								"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
								"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
								"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
								"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
								"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
								"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
								"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
								"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
								"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
								"DISPLAY_NAME"	=>	$arParams["DISPLAY_NAME"],
								"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
								"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
								"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
								"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
								"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
								"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
								"FILTER_NAME"	=>	$arParams["FILTER_NAME"],
								"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
								"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
								"PARENT_SECTION"	=>	$arElement['PROPERTY_SECTION_VALUE'],
								"PARENT_SECTION_CODE"	=>	"",
								"DETAIL_URL"	=>	"",
								"SECTION_URL"	=>	"",
								"IBLOCK_URL"	=>	"",
								"INCLUDE_SUBSECTIONS" => "N",
								"SHOW_DETAIL_LINK" => $arParams["SHOW_DETAIL_LINK"],
								"ORDER_VIEW" => $bOrderViewBasket,
							),
							$component
						);?>
					</div>
					<?$frame->end();?>
				<?}?>
			<?//}?>
			<?=$APPLICATION->ShowViewContent('langing_detail_text')?>
		</div>
		<?if($arParams["DETAIL_USE_COMMENTS"] == "Y"):?>
			<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/rating_likes.js");?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.comments",
				"main",
				array(
					'CACHE_TYPE' => $arParams['CACHE_TYPE'],
					'CACHE_TIME' => $arParams['CACHE_TIME'],
					'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
					"COMMENTS_COUNT" => $arParams['COMMENTS_COUNT'],
					"ELEMENT_CODE" => "",
					"ELEMENT_ID" => $arElement["ID"],
					"FB_USE" => $arParams["DETAIL_FB_USE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"IBLOCK_TYPE" => "aspro_priority_content",
					"SHOW_DEACTIVATED" => "N",
					"TEMPLATE_THEME" => "blue",
					"URL_TO_COMMENT" => "",
					"VK_USE" => $arParams["DETAIL_VK_USE"],
					"AJAX_POST" => "Y",
					"WIDTH" => "",
					"COMPONENT_TEMPLATE" => ".default",
					"BLOG_USE" => $arParams["DETAIL_BLOG_USE"],
					"BLOG_TITLE" => $arParams["BLOG_TITLE"],
					"BLOG_URL" => $arParams["DETAIL_BLOG_URL"],
					"PATH_TO_SMILE" => '',
					"EMAIL_NOTIFY" => $arParams["DETAIL_BLOG_EMAIL_NOTIFY"],
					"SHOW_SPAM" => "Y",
					"SHOW_RATING" => "Y",
					"RATING_TYPE" => "like_graphic",
					"FB_TITLE" => $arParams["FB_TITLE"],
					"FB_USER_ADMIN_ID" => "",
					"FB_APP_ID" => $arParams["DETAIL_FB_APP_ID"],
					"FB_COLORSCHEME" => "light",
					"FB_ORDER_BY" => "reverse_time",
					"VK_TITLE" => $arParams["VK_TITLE"],
					"VK_API_ID" => $arParams["DETAIL_VK_API_ID"]
				),
				false, array("HIDE_ICONS" => "Y")
			);?>
		<?endif;?>
	</div>
</div>