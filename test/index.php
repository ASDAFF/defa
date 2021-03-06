<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?>

<?php

$IBLOCK_ID = 17;
$IBLOCK_TYPE_ID = 'aspro_next_catalog';
global $filter;
$filter['=ID'] = $_REQUEST['id'];
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "catalog_custom_block_new",
    Array(
        "ACTION_VARIABLE" => "action",
        "ADD_DETAIL_TO_SLIDER" => "N",
        "ADD_ELEMENT_CHAIN" => "N",
        "ADD_PICT_PROP" => "MORE_PHOTO",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "ADD_TO_BASKET_ACTION" => array("BUY"),
        "ADD_TO_BASKET_ACTION_PRIMARY" => array("BUY"),
        "BACKGROUND_IMAGE" => "-",
        "BASKET_URL" => "/personal/basket.php",
        "BLOG_USE" => "N",
        "BRAND_PROPERTY" => "BRAND_REF",
        "BRAND_PROP_CODE" => array("BRAND_REF",""),
        "BRAND_USE" => "N",
        "BROWSER_TITLE" => "-",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "N",
        "CHECK_SECTION_ID_VARIABLE" => "N",
        "COMPARE_PATH" => "",
        "COMPATIBLE_MODE" => "Y",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "DATA_LAYER_NAME" => "dataLayer",
        "DETAIL_PICTURE_MODE" => array("POPUP","MAGNIFIER"),
        "DETAIL_URL" => "",
        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
        "DISPLAY_COMPARE" => "N",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PREVIEW_TEXT_MODE" => "E",
        "FB_USE" => "N",
        "FILE_404" => "",
        "GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
        "GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
        "GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "3",
        "GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
        "GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
        "GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
        "GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "3",
        "GIFTS_MESS_BTN_BUY" => "Выбрать",
        "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
        "GIFTS_SHOW_IMAGE" => "Y",
        "GIFTS_SHOW_NAME" => "Y",
        "GIFTS_SHOW_OLD_PRICE" => "Y",
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
        "IBLOCK_ID" => $IBLOCK_ID,
        "IBLOCK_TYPE" => $IBLOCK_TYPE_ID,
        "LABEL_PROP" => array("NEWPRODUCT"),
        "LABEL_PROP_MOBILE" => array(),
        "LABEL_PROP_POSITION" => "top-left",
        "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
        "LINK_IBLOCK_ID" => "",
        "LINK_IBLOCK_TYPE" => "",
        "LINK_PROPERTY_SID" => "",
        "MAIN_BLOCK_OFFERS_PROPERTY_CODE" => array("COLOR_REF"),
        "MAIN_BLOCK_PROPERTY_CODE" => array("MATERIAL"),
        "FILTER_NAME" => "filter",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_COMPARE" => "Сравнить",
        "MESS_BTN_SUBSCRIBE" => "Подписаться",
        "MESS_COMMENTS_TAB" => "Комментарии",
        "MESS_DESCRIPTION_TAB" => "Описание",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "MESS_PROPERTIES_TAB" => "Характеристики",
        "MESS_RELATIVE_QUANTITY_FEW" => "мало",
        "MESS_RELATIVE_QUANTITY_MANY" => "много",
        "MESS_SHOW_MAX_QUANTITY" => "Наличие",
        "META_DESCRIPTION" => "-",
        "META_KEYWORDS" => "-",
        "OFFERS_CART_PROPERTIES" => array("COLOR_REF"),
        "OFFERS_FIELD_CODE" => array("NAME","PREVIEW_PICTURE","DETAIL_PICTURE","DETAIL_PAGE_URL",""),
        "OFFERS_LIMIT" => "0",
        "OFFERS_PROPERTY_CODE" => array("ARTICLE","COLOR_REF","TEXTURE","IS_3DVIEW","MORE_PHOTO","FILES","FRAROMA","SPORT","VLAGOOTVOD","AGE","RUKAV","KAPUSHON","FRCOLLECTION","FRLINE","FRFITIL","FRMADEIN","FRELITE","TALL","FRFAMILY","FRSOSTAVCANDLE","FRTYPE","FRFORM",""),
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_FIELD2" => "id",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_ORDER2" => "desc",
        "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
        "OFFER_TREE_PROPS" => array("COLOR_REF","SIZES_SHOES","SIZES_CLOTHES"),
        "PARTIAL_PRODUCT_PROPERTIES" => "Y",
        "PRICE_CODE" => array("BASE","ИМ: Рек. розн. 0%"),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRICE_VAT_SHOW_VALUE" => "N",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
        "PRODUCT_PAY_BLOCK_ORDER" => "rating,price,quantityLimit,quantity,buttons",
        "PRODUCT_PROPERTIES" => array(),
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "",
        "PRODUCT_SUBSCRIPTION" => "Y",
        "PROPERTY_CODE" => array(
            0 => "BRAND",
            1 => "CML2_ARTICLE",
            2 => "COLOR_REF2",
            3 => "PROP_159",
            4 => "PROP_2033",
            5 => "PROP_2049",
            6 => "PROP_2065",
            7 => "PROP_2052",
            8 => "PROP_2027",
            9 => "PROP_2053",
            10 => "PROP_2083",
            11 => "PROP_2026",
            12 => "PROP_2044",
            13 => "PROP_162",
            14 => "PROP_2054",
            15 => "PROP_2017",
            16 => "PROP_2055",
            17 => "PROP_2069",
            18 => "PROP_2062",
            19 => "PROP_2061",
            20 => "CML2_LINK",),
        "RELATIVE_QUANTITY_FACTOR" => "5",
        "SECTION_CODE" => "",
        "SECTION_CODE_PATH" => "",
        "SECTION_ID" => $_REQUEST['sectionid'],
        "INCLUDE_SUBSECTIONS" => "Y",
        "SECTION_URL" => "",
        "SEF_MODE" => "N",
        "SEF_RULE" => "",
        "SET_BROWSER_TITLE" => "Y",
        "SET_CANONICAL_URL" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "SET_VIEWED_IN_COMPONENT" => "N",
        "SHOW_404" => "N",
        "SHOW_CLOSE_POPUP" => "N",
        "SHOW_DEACTIVATED" => "N",
        "SHOW_DISCOUNT_PERCENT" => "Y",
        "SHOW_MAX_QUANTITY" => "M",
        "SHOW_OLD_PRICE" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "SHOW_SLIDER" => "Y",
        "SLIDER_INTERVAL" => "5000",
        "SLIDER_PROGRESS" => "N",
        "STRICT_SECTION_CHECK" => "N",
        "TEMPLATE_THEME" => "blue",
        "TYPE_SKU" => "TYPE_1",
        "USE_COMMENTS" => "Y",
        "USE_ELEMENT_COUNTER" => "Y",
        "USE_ENHANCED_ECOMMERCE" => "Y",
        "USE_GIFTS_DETAIL" => "Y",
        "USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
        "USE_MAIN_ELEMENT_SECTION" => "N",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "USE_VOTE_RATING" => "Y",
        "VK_USE" => "N",
        "VOTE_DISPLAY_AS_RATING" => "rating"
    )
);

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>