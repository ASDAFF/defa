<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR."include/header/header_defo.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => "include_area.php"
    ),
    false, array("HIDE_ICONS" => "Y")
);?>

<?/*$APPLICATION->SetAdditionalCSS(SITE_DIR.'bitrix/css/slick.css',true);
$APPLICATION->SetAdditionalCSS(SITE_DIR.'bitrix/css/slick-theme.css',true);

*/?>

