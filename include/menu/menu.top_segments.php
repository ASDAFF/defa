<?global $arTheme;?>

<?$APPLICATION->IncludeComponent(
    "bitrix:menu",
    ".default",
    Array(
        "ALLOW_MULTI_SELECT" => "N",
        "CHILD_MENU_TYPE" => "left",
        "COMPONENT_TEMPLATE" => ".default",
        "COUNT_ITEM" => "6",
        "DELAY" => "N",
        "MAX_LEVEL" => $arTheme["MAX_DEPTH_MENU"]["VALUE"],
        "MENU_CACHE_GET_VARS" => array(),
        "MENU_CACHE_TIME" => "3600000",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_USE_GROUPS" => "N",
        "CACHE_SELECTED_ITEMS" => "N",
        "ALLOW_MULTI_SELECT" => "N",
        "ROOT_MENU_TYPE" => "top_segments",
        "USE_EXT" => "Y"
    )
);?>