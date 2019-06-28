<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if (!CModule::IncludeModule("iblock"))
    return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE_LIST"], "ACTIVE" => "Y"));

$iblocks = array();

$arSKUProps = array();
$arProps = array();

$dbIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("ACTIVE" => "Y"));
while ($arIb = $dbIBlock->Fetch()) {
    $dbProperty = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $arIb['ID'], "USER_TYPE" => "SKU"));
    while ($arProperty = $dbProperty->Fetch())
        $arSKUProps['PROPERTY_' . $arProperty['CODE']] = "[{$arIb['CODE']}] [{$arProperty['CODE']}] {$arProperty['NAME']}";
}

while ($arr = $rsIBlock->Fetch()) {
    if (CModule::IncludeModule('catalog') && $arCurrentValues['IBLOCK_CATALOG'] != 'N') {
        if (!($arCatalog = CCatalog::GetById($arr["ID"])))
            continue;
        if ($arCatalog["PRODUCT_IBLOCK_ID"] != 0)
            continue;
    }
    $arIBlock[$arr["ID"]] = $arIBlockType[$arr["IBLOCK_TYPE_ID"]] . " / " . $arr["NAME"];
    $iblocks[] = $arr["ID"];

    if (empty($arCurrentValues["IBLOCK_ID_IN"][0])) {
        $dbProperty = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $arr['ID']));
        while ($arProperty = $dbProperty->Fetch())
            $arProps[$arProperty['CODE']] = "[{$arProperty['CODE']}] {$arProperty['NAME']}";
    }
}

$arIBlockAll = $arIBlock;
$arIBlock[0] = GetMessage("ALL");
ksort($arIBlock);

if (is_array($arCurrentValues["IBLOCK_ID_IN"])) {
    foreach ($arCurrentValues["IBLOCK_ID_IN"] as $key => $id) {
        if (!array_key_exists($id, $arIBlock))
            unset($arCurrentValues["IBLOCK_ID_IN"][$key]);
    }
    if (!empty($arCurrentValues["IBLOCK_ID_IN"][0])) {
        foreach ($arCurrentValues["IBLOCK_ID_IN"] as $id) {
            $dbProperty = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $id));
            while ($arProperty = $dbProperty->Fetch())
                $arProps[$arProperty['CODE']] = "[{$arProperty['CODE']}] {$arProperty['NAME']}";
        }
    }
}

ksort($arProps);
array_unshift($arProps, '');

if (is_array($arCurrentValues['IBLOCK_ID_IN']) && !empty($arCurrentValues['IBLOCK_ID_IN'][0])) {
    $arIblockID = $arCurrentValues['IBLOCK_ID_IN'];
}
else {
    $arIblockID = $iblocks;
}

$arPrice = array("WF_EMPT" => "-----");
if (!CModule::IncludeModule("catalog") || $arCurrentValues['PRICE_FROM_IBLOCK'] == 'Y') {
    foreach ($arIblockID as $id)
        if ($id > 0) {
            $rsPrice = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $id, array("LOGIC" => "OR", array("PROPERTY_TYPE" => "S"), array("PROPERTY_TYPE" => "N"))));
            while ($arr = $rsPrice->Fetch())
                if (!in_array($arr["NAME"], $arPrice))
                    $arPrice[$arr["CODE"]] = $arr["NAME"];
        }
}
else {
    $rsPrice = CCatalogGroup::GetList($v1 = "sort", $v2 = "asc");
    while ($arr = $rsPrice->Fetch())
        $arPrice[$arr["NAME"]] = "[" . $arr["NAME"] . "] " . $arr["NAME_LANG"];
}

$arPhoto = array('' => GetMessage("NO_PHOTO"), 'wf_fields' => GetMessage("GET_OVER_FIELDS"));

foreach ($arIblockID as $id)
    if ($id > 0) {
        $rsPhoto = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $id, "PROPERTY_TYPE" => "F"));
        while ($arr = $rsPhoto->Fetch())
            $arPhoto[$arr["CODE"]] = $arr["NAME"];
    }

function getSecPath($id) {
    CModule::IncludeModule('iblock');
    $pathAr = array();
    $nav = CIBlockSection::GetNavChain(false, $id);
    $path = "";
    while ($arNav = $nav->GetNext()) {
        $path .= " / " . $arNav["NAME"];
    }
    return $path;
}

if (count($arCurrentValues["IBLOCK_ID_IN"]) > 0 && empty($arCurrentValues["IBLOCK_ID_IN"][0]) || !$arCurrentValues["IBLOCK_ID_IN"]) {
    if (!count($iblocks))
        $iblocks = '0';
    $rsIBlockSection = CIBlockSection::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $iblocks, "ACTIVE" => "Y", "INCLUDE_SUBSECTIONS" => "Y"));
}
else {
    $rsIBlockSection = CIBlockSection::GetList(Array("sort" => "asc"), Array("IBLOCK_ID" => $arCurrentValues["IBLOCK_ID_IN"], "ACTIVE" => "Y", "INCLUDE_SUBSECTIONS" => "Y"));
}

$arIBlockSection[0] = GetMessage("ALL");

while ($arr = $rsIBlockSection->Fetch()) {
    $arIBlockSection[$arr["ID"]] = $arIBlockAll[$arr["IBLOCK_ID"]] . getSecPath($arr["ID"]);
}

natsort($arIBlockSection);

$arUserFields_S = array("-" => " ");
$arUserFields = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_" . $arCurrentValues["IBLOCK_ID"] . "_SECTION");
foreach ($arUserFields as $FIELD_NAME => $arUserField)
    if ($arUserField["USER_TYPE"]["BASE_TYPE"] == "string")
        $arUserFields_S[$FIELD_NAME] = $arUserField["LIST_COLUMN_LABEL"] ? $arUserField["LIST_COLUMN_LABEL"] : $FIELD_NAME;

$arAscDesc = array(
  "asc" => GetMessage("IBLOCK_SORT_ASC"),
  "desc" => GetMessage("IBLOCK_SORT_DESC"),
);


$arOrder = $arPrice;

$arSKUName = array('PRODUCT_AND_SKU_NAME' => GetMessage('PRODUCT_AND_SKU_NAME'), 'PRODUCT_NAME' => GetMessage('PRODUCT_NAME'), 'SKU_NAME' => GetMessage('SKU_NAME'));

$arComponentParameters = array(
  "GROUPS" => array(
    "SKU" => array(
      "NAME" => GetMessage("SKU_GROUP_NAME")
    ),
    "PRICES" => array(
      "NAME" => GetMessage("IBLOCK_PRICES"),
    ),
    "PRICES_ROUND" => array(
      "NAME" => GetMessage("IBLOCK_PRICES_ROUND"),
    ),
    "DELIVERY" => array(
      "NAME" => GetMessage("DELIVERY"),
    ),
    "COMMON" => array(
      "NAME" => GetMessage("COMMON"),
    ),
    "CATEGORY" => array(
      "NAME" => GetMessage("CATEGORY"),
    ),
    "PERFORMANCE" => array(
      "NAME" => GetMessage("PERFORMANCE")
    ),
    "BIG_CATALOG" => array(
      "NAME" => GetMessage("BIG_CATALOG"),
      "SORT" => 100,
    ),
  ),
  "PARAMETERS" => array(
    "AGENT_CHECK" => array(
      "PARENT" => "BASE",
      "NAME" => GetMessage("AGENT_CHECK"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "N"
    ),
    "HTTPS_CHECK" => array(
      "PARENT" => "DATA_SOURCE",
      "NAME" => GetMessage("HTTPS_CHECK"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "N"
    ),
    "IBLOCK_TYPE_LIST" => array(
      "PARENT" => "BASE",
      "NAME" => GetMessage("IBLOCK_TYPE_LIST"),
      "TYPE" => "LIST",
      "VALUES" => $arIBlockType,
      "MULTIPLE" => "Y",
      "REFRESH" => "Y",
    ),
    "SAVE_IN_FILE" => array(
      "PARENT" => "BASE",
      "NAME" => GetMessage("SAVE_IN_FILE"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "N"
    ),
    "IBLOCK_CATALOG" => array(
      "PARENT" => "BASE",
      "NAME" => GetMessage("IBLOCK_CATALOG"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "Y",
      "REFRESH" => "Y",
    ),
    "IBLOCK_ID_IN" => array(
      "PARENT" => "BASE",
      "NAME" => GetMessage("IBLOCK_IBLOCK_IN"),
      "TYPE" => "LIST",
      "VALUES" => $arIBlock,
      "MULTIPLE" => "Y",
      "REFRESH" => "Y",
    ),
    "IBLOCK_SECTION" => array(
      "PARENT" => "BASE",
      "NAME" => GetMessage("IBLOCK_SECTION"),
      "TYPE" => "LIST",
      "VALUES" => $arIBlockSection,
      "MULTIPLE" => "Y",
      "DEFAULT" => "0",
      "SIZE" => 10,
    ),
    "DO_NOT_INCLUDE_SUBSECTIONS" => array(
      "PARENT" => "BASE",
      "NAME" => GetMessage("DO_NOT_INCLUDE_SUBSECTIONS"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "N"
    ),
    "IBLOCK_AS_CATEGORY" => array(
      "PARENT" => "BASE",
      "NAME" => GetMessage("IBLOCK_AS_CATEGORY"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "Y"
    ),
    "SITE" => array(
      "PARENT" => "DATA_SOURCE",
      "NAME" => GetMessage("SITE"),
      "TYPE" => "STRING",
      "DEFAULT" => "mysite.com",
    ),
    "USE_SITE" => array(
      "PARENT" => "DATA_SOURCE",
      "NAME" => GetMessage("USE_SITE"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "N"
    ),
    "COMPANY" => array(
      "PARENT" => "DATA_SOURCE",
      "NAME" => GetMessage("COMPANY_NAME"),
      "TYPE" => "STRING",
      "DEFAULT" => "My company",
    ),
    "SKU_NAME" => array(
      "PARENT" => "SKU",
      "NAME" => GetMessage("SKU_NAME_PARAM"),
      "TYPE" => "LIST",
      "MULTIPLE" => "N",
      "VALUES" => $arSKUName,
      "DEFAULT" => "PRODUCT_AND_SKU_NAME",
    ),
    "SKU_PROPERTY" => array(
      "PARENT" => "SKU",
      "NAME" => GetMessage("SKU_PROPERTY"),
      "TYPE" => "LIST",
      "MULTIPLE" => "N",
      "VALUES" => $arSKUProps,
      "DEFAULT" => "PROPERTY_CML2_LINK"
    ),
    "FILTER_NAME" => array(
      "PARENT" => "DATA_SOURCE",
      "NAME" => GetMessage("IBLOCK_FILTER_NAME_IN"),
      "TYPE" => "STRING",
      "DEFAULT" => "arrFilter",
    ),
    "FILTER_NAME_SKU" => array(
      "PARENT" => "DATA_SOURCE",
      "NAME" => GetMessage("FILTER_NAME_SKU"),
      "TYPE" => "STRING",
      "DEFAULT" => "arrFilterSku",
    ),
    "MORE_PHOTO" => array(
      "PARENT" => "DATA_SOURCE",
      "NAME" => GetMessage("MORE_PHOTO"),
      "TYPE" => "LIST",
      "VALUES" => $arPhoto,
      "DEFAULT" => "MORE_PHOTO",
      "ADDITIONAL_VALUES" => "Y",
    ),
    "GET_OVER_FIELDS_ANONCE" => array(
      "PARENT" => "DATA_SOURCE",
      "NAME" => GetMessage("GET_OVER_FIELDS_ANONCE"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "N"
    ),
    "PHOTO_CHECK" => array(
      "PARENT" => "DATA_SOURCE",
      "NAME" => GetMessage("PHOTO_CHECK"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "N"
    ),
    "PRICE_ROUND" => array(
      "PARENT" => "PRICES_ROUND",
      "NAME" => GetMessage("PRICE_ROUND"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "N"
    ),
    "MINIMUM_PRICE_ROUND" => array(
      "PARENT" => "PRICES_ROUND",
      "NAME" => GetMessage("MINIMUM_PRICE_ROUND"),
      "TYPE" => "STRING",
      "DEFAULT" => "0"
    ),
    "TYPE_PRICE_ROUND" => array(
      "PARENT" => "PRICES_ROUND",
      "NAME" => GetMessage("TYPE_PRICE_ROUND"),
      "TYPE" => "LIST",
      "VALUES" => array(
        "MATH" => GetMessage("TYPE_PRICE_ROUND_0"),
        "STORE" => GetMessage("TYPE_PRICE_ROUND_1"),
        "CLIENTS" => GetMessage("TYPE_PRICE_ROUND_2"),
      ),
    ),
    "ACCURACY_PRICE_ROUND" => array(
      "PARENT" => "PRICES_ROUND",
      "NAME" => GetMessage("ACCURACY_PRICE_ROUND"),
      "TYPE" => "LIST",
      "DEFAULT" => "9",
      "VALUES" => array(
        "0" => "0.0001",
        "1" => "0.001",
        "2" => "0.005",
        "3" => "0.01",
        "4" => "0.02",
        "5" => "0.05",
        "6" => "0.1",
        "7" => "0.2",
        "8" => "0.5",
        "9" => "1",
        "10" => "2",
        "11" => "5",
        "12" => "10",
        "13" => "20",
        "14" => "50",
        "15" => "100",
        "16" => "200",
        "17" => "500",
        "18" => "1000",
        "19" => "5000",
      ),
    ),
    "OLD_PRICE" => array(
      "PARENT" => "PRICES",
      "NAME" => GetMessage("OLD_PRICE"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "N"
    ),
    "PRICE_CODE" => array(
      "PARENT" => "PRICES",
      "NAME" => GetMessage("IBLOCK_PRICE_CODE"),
      "TYPE" => "LIST",
      "MULTIPLE" => "N",
      "VALUES" => $arPrice,
    ),
    "OLD_PRICE_CODE" => array(
      "PARENT" => "PRICES",
      "NAME" => GetMessage("IBLOCK_OLD_PRICE_CODE"),
      "TYPE" => "LIST",
      "MULTIPLE" => "N",
      "VALUES" => $arPrice,
    ),
    "DISCOUNTS" => array(
      "PARENT" => "PRICES",
      "NAME" => GetMessage("DISCOUNTS"),
      "TYPE" => "LIST",
      "VALUES" => array(
        "PRICE_ONLY" => GetMessage("PRICE_ONLY"),
        "DISCOUNT_CUSTOM" => GetMessage("DISCOUNT_CUSTOM"),
        "DISCOUNT_API" => GetMessage("DISCOUNT_API"),
      ),
      "DEFAULT" => "DISCOUNT_CUSTOM"
    ),
    "IBLOCK_QUANTITY" => array(
      "PARENT" => "PRICES",
      "NAME" => GetMessage("IBLOCK_QUANTITY"),
      "TYPE" => "LIST",
      "VALUES" => $arOrder,
    ),
    "IBLOCK_ORDER" => array(
      "PARENT" => "PRICES",
      "NAME" => GetMessage("IBLOCK_ORDER"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "N"
    ),
    "AVAILABLE_ALGORITHM" => array(
      "PARENT" => "PRICES",
      "NAME" => GetMessage("AVAILABLE_ALGORITHM"),
      "TYPE" => "LIST",
      "REFRESH" => "Y",
      "VALUES" => array(
        "BITRIX_ALGORITHM" => GetMessage("BITRIX_ALGORITHM"),
        "QUANTITY_ZERO" => GetMessage("QUANTITY_ZERO"),
        "PROP_ALGORITHM" => GetMessage("PROP_ALGORITHM"),
      ),
      "DEFAULT" => "BITRIX_ALGORITHM"
    ),
    "PROP_ALGORITHM_VALUE" => array(
      "PARENT" => "PRICES",
      "NAME" => GetMessage("PROP_ALGORITHM_VALUE"),
      "TYPE" => "LIST",
      "VALUES" => $arProps,
      "DEFAULT" => ""
    ),
    "CURRENCY" => array(
      "PARENT" => "PRICES",
      "NAME" => GetMessage("IBLOCK_CURRENCY"),
      "TYPE" => "LIST",
      "VALUES" => array(
        "RUB" => GetMessage("RUB"),
        "USD" => GetMessage("USD"), // not may be base
        "EUR" => GetMessage("EUR"), // not may be base
        "UAH" => GetMessage("UAH"),
        "BYR" => GetMessage("BYR"),
        "KZT" => GetMessage("KZT"),
      ),
      "DEFAULT" => "RUB"
    ),
    "CURRENCIES_PROP" => array(
      "PARENT" => "PRICES",
      "NAME" => GetMessage("CURRENCIES_PROP"),
      "TYPE" => "STRING",
    ),
    "CURRENCIES_CONVERT" => array(
      "PARENT" => "PRICES",
      "NAME" => GetMessage("CURRENCIES_CONVERT"),
      "TYPE" => "LIST",
      "VALUES" => array(
        "NOT_CONVERT" => GetMessage("NOT_CONVERT"),
        "RUB" => GetMessage("RUB"),
        "USD " => GetMessage("USD"), // not may be base
        "EUR" => GetMessage("EUR"), // not may be base
        "UAH" => GetMessage("UAH"),
        "BYR" => GetMessage("BYR"),
        "KZT" => GetMessage("KZT"),
      ),
      "DEFAULT" => "NOT_CONVERT",
    ),
    "LOCAL_DELIVERY_COST" => array(
      "PARENT" => "DELIVERY",
      "NAME" => GetMessage("LOCAL_DELIVERY_COST"),
      "TYPE" => "STRING",
      "DEFAULT" => ""
    ),
    "NAME_PROP" => array(
      "PARENT" => "COMMON",
      "NAME" => GetMessage("NAME_PROP"),
      "TYPE" => "LIST",
      "VALUES" => $arProps,
      "DEFAULT" => ""
    ),
    "DETAIL_TEXT_PRIORITET" => array(
      "PARENT" => "COMMON",
      "NAME" => GetMessage("DETAIL_TEXT_PRIORITET"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "N"
    ),
    "CACHE_TIME" => Array("DEFAULT" => 3600),
    "CACHE_FILTER" => array(
      "PARENT" => "ADDITIONAL_SETTINGS",
      "NAME" => GetMessage("IBLOCK_CACHE_FILTER"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "N",
    ),
    "CACHE_NON_MANAGED" => array(
      "PARENT" => "CACHE_SETTINGS",
      "NAME" => GetMessage("CACHE_NON_MANAGED"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "N",
    ),
    "BIG_CATALOG_PROP" => array(
      "PARENT" => "BIG_CATALOG",
      "NAME" => GetMessage("BIG_CATALOG_VALUE"),
      "TYPE" => "STRING",
    ),
    /* "PRODUCT_TYPE_CHECK" => Array(
      "PARENT" => "CATEGORY",
      "NAME" => GetMessage("PRODUCT_TYPE_CHECK"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "N",
      ),
      "PRODUCT_TYPE_PROP" => Array(
      "PARENT" => "CATEGORY",
      "NAME" => GetMessage("PRODUCT_TYPE_PROP"),
      "TYPE" => "LIST",
      "VALUES" => $arProps,
      ), */
    "GTIN" => Array(
      "PARENT" => "COMMON",
      "NAME" => GetMessage("GTIN"),
      "TYPE" => "LIST",
      "VALUES" => $arProps,
    ),
  ),
);

if ($arCurrentValues["AVAILABLE_ALGORITHM"] != "PROP_ALGORITHM") {
    unset($arComponentParameters["PARAMETERS"]["PROP_ALGORITHM_VALUE"]);
}
if (CModule::IncludeModule('catalog') && $arCurrentValues['PRICE_FROM_IBLOCK'] != 'Y') {
    $arComponentParameters["PARAMETERS"]["PRICE_CODE"]["MULTIPLE"] = "Y";
    unset($arComponentParameters["PARAMETERS"]["OLD_PRICE_CODE"]);
    unset($arComponentParameters["PARAMETERS"]["IBLOCK_QUANTITY"]);
    unset($arComponentParameters["PARAMETERS"]["CURRENCIES_PROP"]);
    unset($arComponentParameters["PARAMETERS"]["CURRENCY"]);
}
else {
    unset($arComponentParameters["PARAMETERS"]["CURRENCIES_CONVERT"]);
    unset($arComponentParameters["PARAMETERS"]["DISCOUNTS"]);
}
if (!CModule::IncludeModule('catalog')) {
    unset($arComponentParameters["PARAMETERS"]["IBLOCK_CATALOG"]);
}

$GLOBALS['WF_IBLOCK_ID'] = $iblocks;
?>