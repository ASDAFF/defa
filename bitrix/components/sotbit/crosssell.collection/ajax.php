<?
define('STOP_STATISTICS', true);
define('PUBLIC_AJAX_MODE', true);

$siteId = isset($_REQUEST['siteId']) && is_string($_REQUEST['siteId']) ? $_REQUEST['siteId'] : '';
$siteId = substr(preg_replace('/[^a-z0-9_]/i', '', $siteId), 0, 2);
if (!empty($siteId) && is_string($siteId))
{
    define('SITE_ID', $siteId);
}

require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$request->addFilter(new \Bitrix\Main\Web\PostDecodeFilter);

if (!\Bitrix\Main\Loader::includeModule('sotbit.crosssell'))
    return;
$request = $_REQUEST;
$APPLICATION->IncludeComponent(
    "sotbit:crosssell.collection.list",
    ".default",
    array(
        "ACTION_VARIABLE" => $request['params']['ACTION_VARIABLE'],
        "ADD_PROPERTIES_TO_BASKET" => $request['params']['ADD_PROPERTIES_TO_BASKET'],
        "ADD_SECTIONS_CHAIN" => $request['params']['ADD_SECTIONS_CHAIN'],
        "AJAX_MODE" => $request['params']['AJAX_MODE'],
        "AJAX_OPTION_ADDITIONAL" => $request['params']['AJAX_OPTION_ADDITIONAL'],
        "AJAX_OPTION_HISTORY" => $request['params']['AJAX_OPTION_HISTORY'],
        "AJAX_OPTION_JUMP" => $request['params']['AJAX_OPTION_JUMP'],
        "AJAX_OPTION_STYLE" => $request['params']['AJAX_OPTION_STYLE'],
        "BACKGROUND_IMAGE" => $request['params']['BACKGROUND_IMAGE'],
        "BASKET_URL" => $request['params']['BASKET_URL'],
        "BROWSER_TITLE" => $request['params']['BROWSER_TITLE'],
        "CACHE_FILTER" => $request['params']['CACHE_FILTER'],
        "CACHE_GROUPS" => $request['params']['CACHE_GROUPS'],
        "CACHE_TIME" => $request['params']['CACHE_TIME'],
        "CACHE_TYPE" => $request['params']['CACHE_TYPE'],
        "COLLECTION_ID" => $request['collectionId'],
        "COMPATIBLE_MODE" => $request['params']['COMPATIBLE_MODE'],
        "CONVERT_CURRENCY" => $request['params']['CONVERT_CURRENCY'],
        "DETAIL_URL" => $request['params']['DETAIL_URL'],
        "DISABLE_INIT_JS_IN_COMPONENT" => $request['params']['DISABLE_INIT_JS_IN_COMPONENT'],
        "DISPLAY_BOTTOM_PAGER" => $request['params']['DISPLAY_BOTTOM_PAGER'],
        "DISPLAY_COMPARE" => $request['params']['DISPLAY_COMPARE'],
        "DISPLAY_TOP_PAGER" => $request['params']['DISPLAY_TOP_PAGER'],
        "ELEMENT_SORT_FIELD" => $request['params']['ELEMENT_SORT_FIELD'],
        "ELEMENT_SORT_FIELD2" => $request['params']['ELEMENT_SORT_FIELD2'],
        "ELEMENT_SORT_ORDER" => $request['params']['ELEMENT_SORT_ORDER'],
        "ELEMENT_SORT_ORDER2" => $request['params']['ELEMENT_SORT_ORDER2'],
        "FILTER_NAME" => $request['params']['FILTER_NAME'],
        "FROM_COMPLEX" => $request['params']['FROM_COMPLEX'],
        "HIDE_NOT_AVAILABLE" => $request['params']['HIDE_NOT_AVAILABLE'],
        "HIDE_NOT_AVAILABLE_OFFERS" => $request['params']['HIDE_NOT_AVAILABLE_OFFERS'],
        "IBLOCK_ID" => $request['params']['IBLOCK_ID'],
        "IBLOCK_TYPE" => $request['params']['IBLOCK_TYPE'],
        "INCLUDE_SUBSECTIONS" => $request['params']['INCLUDE_SUBSECTIONS'],
        "LINE_ELEMENT_COUNT" => $request['params']['LINE_ELEMENT_COUNT'],
        "MESSAGE_404" => $request['params']['MESSAGE_404'],
        "META_DESCRIPTION" => $request['params']['META_DESCRIPTION'],
        "META_KEYWORDS" => $request['params']['META_KEYWORDS'],
        "OFFERS_CART_PROPERTIES" => $request['params']['OFFERS_CART_PROPERTIES'],
        "OFFERS_FIELD_CODE" => $request['params']['OFFERS_FIELD_CODE'],
        "OFFERS_LIMIT" => $request['params']['OFFERS_LIMIT'],
        "OFFERS_PROPERTY_CODE" => $request['params']['OFFERS_PROPERTY_CODE'],
        "OFFERS_SORT_FIELD" => $request['params']['OFFERS_SORT_FIELD'],
        "OFFERS_SORT_FIELD2" => $request['params']['OFFERS_SORT_FIELD2'],
        "OFFERS_SORT_ORDER" => $request['params']['OFFERS_SORT_ORDER'],
        "OFFERS_SORT_ORDER2" => $request['params']['OFFERS_SORT_ORDER2'],
        "PAGER_BASE_LINK_ENABLE" => $request['params']['PAGER_BASE_LINK_ENABLE'],
        "PAGER_DESC_NUMBERING" => $request['params']['PAGER_DESC_NUMBERING'],
        "PAGER_DESC_NUMBERING_CACHE_TIME" => $request['params']['PAGER_DESC_NUMBERING_CACHE_TIME'],
        "PAGER_SHOW_ALL" => $request['params']['PAGER_SHOW_ALL'],
        "PAGER_SHOW_ALWAYS" => $request['params']['PAGER_SHOW_ALWAYS'],
        "PAGER_TEMPLATE" => $request['params']['PAGER_TEMPLATE'],
        "PAGER_TITLE" => $request['params']['PAGER_TITLE'],
        "PARTIAL_PRODUCT_PROPERTIES" => $request['params']['PARTIAL_PRODUCT_PROPERTIES'],
        "PRICE_CODE" => $request['params']['PRICE_CODE'],
        "PRICE_VAT_INCLUDE" => $request['params']['PRICE_VAT_INCLUDE'],
        "PRODUCT_ID_VARIABLE" => $request['params']['PRODUCT_ID_VARIABLE'],
        "PRODUCT_PROPERTIES" => $request['params']['PRODUCT_PROPERTIES'],
        "PRODUCT_PROPS_VARIABLE" => $request['params']['PRODUCT_PROPS_VARIABLE'],
        "PRODUCT_QUANTITY_VARIABLE" => $request['params']['PRODUCT_QUANTITY_VARIABLE'],
        "SECTION_ID" => $request['params']['SECTION_ID'],
        "SECTION_URL" => $request['params']['SECTION_URL'],
        "SEF_MODE" => $request['params']['SEF_MODE'],
        "SET_BROWSER_TITLE" => $request['params']['SET_BROWSER_TITLE'],
        "SET_LAST_MODIFIED" => $request['params']['SET_LAST_MODIFIED'],
        "SET_META_DESCRIPTION" => $request['params']['SET_META_DESCRIPTION'],
        "SET_META_KEYWORDS" => $request['params']['SET_META_KEYWORDS'],
        "SET_STATUS_404" => $request['params']['SET_STATUS_404'],
        "SET_TITLE" => $request['params']['SET_TITLE'],
        "SHOW_404" => $request['params']['SHOW_404'],
        "SHOW_PRICE_COUNT" => $request['params']['SHOW_PRICE_COUNT'],
        "USE_MAIN_ELEMENT_SECTION" => $request['params']['USE_MAIN_ELEMENT_SECTION'],
        "USE_PRICE_COUNT" => $request['params']['USE_PRICE_COUNT'],
        "USE_PRODUCT_QUANTITY" => $request['params']['USE_PRODUCT_QUANTITY']
    )
);
die();