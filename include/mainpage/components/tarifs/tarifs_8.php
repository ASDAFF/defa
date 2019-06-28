<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<?$bOrderViewBasket = (trim($arTheme['ORDER_VIEW']['VALUE']) === 'Y' || trim($arTheme['ORDER_VIEW']) === 'Y');?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"tarifs_front_8",
	array(
		"IBLOCK_TYPE" => "aspro_priority_catalog",
		"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_catalog"]["aspro_priority_tarif"][0],
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "ID",
		"SORT_ORDER2" => "DESC",
		"FILTER_NAME" => "arFrontItemsFilter",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "PREVIEW_PICTURE",
			3 => "",
		),
		"PROPERTY_CODE" => array(
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
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"VIEW_TYPE" => "list",
		"IMAGE_POSITION" => "left",
		"COUNT_IN_LINE" => "3",
		"TITLE" => "Тарифы",
		"ORDER_VIEW" => $bOrderViewBasket,
		"T_TARIF" => ($arParams["T_TARIF"] ? $arParams["T_TARIF"] : GetMessage("T_TARIF")),
		"S_ORDER_PRODUCT" => $arParams["S_ORDER_SERVISE"],
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>