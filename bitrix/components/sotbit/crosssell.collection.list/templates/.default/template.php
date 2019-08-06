<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

global $arrFilter;
// FILTER // ------------------------------------------------------------------------------------------------------------------------------------------------------------------
$arrFilter = $arResult['COND'];
if ($arParams['FROM_COMPLEX'] != true){
    $cnt = CIBlockElement::GetList(
        array(),
        $arrFilter,
        array(),
        false,
        array('ID')
    );
} else {
    $cnt = 1;
}


if ( isset($cnt) && ($cnt > 0)) {
?>
    <div>
        <?
        if ($arParams['FROM_COMPLEX'] != true){
            echo "<h2>" . $arResult['COND_NAME'] . "</h2>";
        }
        ?>
        <ul>
            <?
            if($arResult['SAFE']) {
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "",
                    Array(
                        "CACHE_FILTER" => "Y",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "SHOW_ALL_WO_SECTION" => "Y",
                        "ELEMENT_ID" => array(),
                        "ELEMENT_SORT_FIELD2" => "id",
                        "ELEMENT_SORT_FIELD" => $arResult['SORT_BY'],
                        "ELEMENT_SORT_ORDER" => $arResult['SORT_ORDER'],
                        "PAGE_ELEMENT_COUNT" => $arResult['NUMBER_OF_PRODUCTS'],
                        "ELEMENT_SORT_ORDER2" => "desc",
                        "FILTER_NAME" => "arrFilter",
                        "USE_FILTER" => 'Y',
                        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "LABEL_PROP" => "-",
                        "LINE_ELEMENT_COUNT" => $arParams['LINE_ELEMENT_COUNT'],
                        "ADD_PROPERTIES_TO_BASKET" => $arParams['ADD_PROPERTIES_TO_BASKET'],
                        "ADD_SECTIONS_CHAIN" => $arParams['ADD_SECTIONS_CHAIN'],
                        "ADD_TO_BASKET_ACTION" => $arParams['ADD_TO_BASKET_ACTION'],
                        "AJAX_MODE" => $arParams['AJAX_MODE'],
                        "AJAX_OPTION_ADDITIONAL" => $arParams['AJAX_OPTION_ADDITIONAL'],
                        "AJAX_OPTION_HISTORY" => $arParams['AJAX_OPTION_HISTORY'],
                        "AJAX_OPTION_JUMP" => $arParams['AJAX_OPTION_JUMP'],
                        "AJAX_OPTION_STYLE" => $arParams['AJAX_OPTION_STYLE'],
                        "BACKGROUND_IMAGE" => $arParams['BACKGROUND_IMAGE'],
                        "BASKET_URL" => $arParams['BASKET_URL'],
                        "BROWSER_TITLE" => $arParams['BROWSER_TITLE'],
                        "COMPATIBLE_MODE" => $arParams['COMPATIBLE_MODE'],
                        "CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
                        "DETAIL_URL" => $arParams['DETAIL_URL'],
                        "DISABLE_INIT_JS_IN_COMPONENT" => $arParams['DISABLE_INIT_JS_IN_COMPONENT'],
                        "DISPLAY_COMPARE" => $arParams['DISPLAY_COMPARE'],
                        "ENLARGE_PRODUCT" => $arParams['ENLARGE_PRODUCT'],
                        "HIDE_NOT_AVAILABLE" => $arParams['HIDE_NOT_AVAILABLE'],
                        "HIDE_NOT_AVAILABLE_OFFERS" => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],
                        "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                        "LAZY_LOAD" => $arParams['LAZY_LOAD'],
                        "LOAD_ON_SCROLL" => $arParams['LOAD_ON_SCROLL'],
                        "MESSAGE_404" => $arParams['MESSAGE_404'],
                        "MESS_BTN_ADD_TO_BASKET" => $arParams['MESS_BTN_ADD_TO_BASKET'],
                        "MESS_BTN_BUY" => $arParams['MESS_BTN_BUY'],
                        "MESS_BTN_DETAIL" => $arParams['MESS_BTN_DETAIL'],
                        "MESS_BTN_SUBSCRIBE" => $arParams['MESS_BTN_SUBSCRIBE'],
                        "MESS_NOT_AVAILABLE" => $arParams['MESS_NOT_AVAILABLE'],
                        "META_DESCRIPTION" => $arParams['META_DESCRIPTION'],
                        "META_KEYWORDS" => $arParams['META_KEYWORDS'],
                        "OFFERS_LIMIT" => $arParams['OFFERS_LIMIT'],
                        "PAGER_BASE_LINK_ENABLE" => $arParams['PAGER_BASE_LINK_ENABLE'],
                        "PAGER_DESC_NUMBERING" => $arParams['PAGER_DESC_NUMBERING'],
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams['PAGER_DESC_NUMBERING_CACHE_TIME'],
                        "PAGER_SHOW_ALL" => $arParams['PAGER_SHOW_ALL'],
                        "PAGER_SHOW_ALWAYS" => $arParams['PAGER_SHOW_ALWAYS'],
                        "PAGER_TEMPLATE" => $arParams['PAGER_TEMPLATE'],
                        "PAGER_TITLE" => $arParams['PAGER_TITLE'],
                        "PARTIAL_PRODUCT_PROPERTIES" => $arParams['PARTIAL_PRODUCT_PROPERTIES'],
                        "PRICE_CODE" => $arParams['PRICE_CODE'],
                        "PRICE_VAT_INCLUDE" => $arParams['PRICE_VAT_INCLUDE'],
                        "PRODUCT_BLOCKS_ORDER" => $arParams['PRODUCT_BLOCKS_ORDER'],
                        "PRODUCT_ID_VARIABLE" => $arParams['PRODUCT_ID_VARIABLE'],
                        "PRODUCT_PROPERTIES" => $arParams['PRODUCT_PROPERTIES'],
                        "PRODUCT_PROPS_VARIABLE" => $arParams['PRODUCT_PROPS_VARIABLE'],
                        "PRODUCT_QUANTITY_VARIABLE" => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                        "PRODUCT_ROW_VARIANTS" => $arParams['PRODUCT_ROW_VARIANTS'],
                        "PRODUCT_SUBSCRIPTION" => $arParams['PRODUCT_SUBSCRIPTION'],
                        "PROPERTY_CODE" => $arParams['PROPERTY_CODE'],
                        "RCM_PROD_ID" => $arParams['RCM_PROD_ID'],
                        "RCM_TYPE" => $arParams['RCM_TYPE'],
                        "SEF_MODE" => $arParams['SEF_MODE'],
                        "SET_BROWSER_TITLE" => $arParams['SET_BROWSER_TITLE'],
                        "SET_LAST_MODIFIED" => $arParams['PRODUCT_PROPS_VARIABLE'],
                        "SET_META_DESCRIPTION" => $arParams['SET_META_DESCRIPTION'],
                        "SET_META_KEYWORDS" => $arParams['SET_META_KEYWORDS'],
                        "SET_STATUS_404" => $arParams['SET_STATUS_404'],
                        "SET_TITLE" => $arParams['SET_TITLE'],
                        "SHOW_404" => $arParams['SHOW_404'],
                        "SHOW_CLOSE_POPUP" => $arParams['SHOW_CLOSE_POPUP'],
                        "SHOW_DISCOUNT_PERCENT" => $arParams['SHOW_DISCOUNT_PERCENT'],
                        "SHOW_FROM_SECTION" => $arParams['SHOW_FROM_SECTION'],
                        "SHOW_MAX_QUANTITY" => $arParams['SHOW_MAX_QUANTITY'],
                        "SHOW_OLD_PRICE" => $arParams['SHOW_OLD_PRICE'],
                        "SHOW_PRICE_COUNT" => $arParams['SHOW_PRICE_COUNT'],
                        "SHOW_SLIDER" => $arParams['SHOW_SLIDER'],
                        "TEMPLATE_THEME" => $arParams['TEMPLATE_THEME'],
                        "USE_ENHANCED_ECOMMERCE" => $arParams['USE_ENHANCED_ECOMMERCE'],
                        "USE_MAIN_ELEMENT_SECTION" => $arParams['USE_MAIN_ELEMENT_SECTION'],
                        "USE_PRICE_COUNT" => $arParams['USE_PRICE_COUNT'],
                        "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                    ),
                    false
                );
            }
            ?>
        </ul>
    </div>
<?
}