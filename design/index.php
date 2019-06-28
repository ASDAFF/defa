<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Design");
$APPLICATION->SetAdditionalCSS($_SERVER['DOCUMENT_ROOT'].'/bitrix/css/design/style.css'); ?>


<?$APPLICATION->IncludeComponent(
    "aspro:com.banners.next",
    "top_one_banner",
    array(
        "IBLOCK_TYPE" => "aspro_next_adv",
        "IBLOCK_ID" => "3",
        "TYPE_BANNERS_IBLOCK_ID" => "1",
        "SET_BANNER_TYPE_FROM_THEME" => "N",
        "NEWS_COUNT" => "10",
        "NEWS_COUNT2" => "4",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "ID",
        "SORT_ORDER2" => "DESC",
        "PROPERTY_CODE" => array(
            0 => "TEXT_POSITION",
            1 => "TARGETS",
            2 => "TEXTCOLOR",
            3 => "URL_STRING",
            4 => "BUTTON1TEXT",
            5 => "BUTTON1LINK",
            6 => "BUTTON2TEXT",
            7 => "BUTTON2LINK",
            8 => "",
        ),
        "CHECK_DATES" => "Y",
        "CACHE_GROUPS" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "SITE_THEME" => $SITE_THEME,
        "BANNER_TYPE_THEME" => "TOP",
        "BANNER_TYPE_THEME_CHILD" => "TOP_SMALL_BANNER",
    ),
    false
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>