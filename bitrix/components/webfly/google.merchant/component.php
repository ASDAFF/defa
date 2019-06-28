<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if (!$_GET["merchant_stop"]) {
    define('DESCRIPTION_SIZE', 511);

    if (!CModule::IncludeModule("iblock"))
        die();

    $bCatalog = CModule::IncludeModule('catalog');
    /*     * ***********************************************************************
      Processing of received parameters
     * *********************************************************************** */

    if (!isset($arParams["CACHE_TIME"]))
        $arParams["CACHE_TIME"] = 3600;

    if (!isset($arParams["DO_NOT_INCLUDE_SUBSECTIONS"]))
        $arParams["DO_NOT_INCLUDE_SUBSECTIONS"] = "N";

    if (!is_array($arParams["PROPERTY_CODE"]))
        $arParams["PROPERTY_CODE"] = array();

    if (!$arParams['SKU_PROPERTY'])
        $arParams['SKU_PROPERTY'] = 'PROPERTY_CML2_LINK';

    $arParams['SKU_PROPERTY'] = strtoupper($arParams['SKU_PROPERTY']);

    foreach ($arParams["PROPERTY_CODE"] as $key => $value) {
        if ($value === "")
            unset($arParams["PROPERTY_CODE"][$key]);
        else
            $arProperty[] = "PROPERTY_" . trim($value);
    }

    if ($arParams['IBLOCK_AS_CATEGORY'] != 'N')
        $arParams['IBLOCK_AS_CATEGORY'] = 'Y';


    $arParams["IBLOCK_TYPE"] = trim($arParams["IBLOCK_TYPE"]);

    $arParams["COMPANY"] = trim($arParams["COMPANY"]);

    if (!is_array($arParams["IBLOCK_ID_IN"]))
        $arParams["IBLOCK_ID_IN"] = array();
    foreach ($arParams["IBLOCK_ID_IN"] as $k => $v)
        if ($v === "")
            unset($arParams["IBLOCK_ID_IN"][$k]);

    if ((count($arParams["IBLOCK_ID_IN"]) > 0 && $arParams["IBLOCK_ID_IN"][0] === '0'))
        $arParams["IBLOCK_ID_IN"] = '';


    if (!is_array($arParams["IBLOCK_ID_EX"]))
        $arParams["IBLOCK_ID_EX"] = array();
    foreach ($arParams["IBLOCK_ID_EX"] as $k => $v)
        if ($v === "")
            unset($arParams["IBLOCK_ID_EX"][$k]);

    //Filter for element
    if (strlen($arParams["FILTER_NAME"]) <= 0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"])) {
        $arrFilter = array();
    }
    else {
        $arrFilter = $GLOBALS[$arParams["FILTER_NAME"]];
        if (!is_array($arrFilter))
            $arrFilter = array();
    }
    //Filter for sku
    if (strlen($arParams["FILTER_NAME_SKU"]) <= 0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME_SKU"])) {
        $arrFilterSKU = array();
    }
    else {
        $arrFilterSKU = $GLOBALS[$arParams["FILTER_NAME_SKU"]];
        if (!is_array($arrFilterSKU))
            $arrFilterSKU = array();
    }

    if ($arParams["SHOW_PRICE_COUNT"] <= 0)
        $arParams["SHOW_PRICE_COUNT"] = 1;



    $arParams["CACHE_FILTER"] = ($arParams["CACHE_FILTER"] == "Y");
    if (!$arParams["CACHE_FILTER"] && count($arrFilter) > 0)
        $arParams["CACHE_TIME"] = 0;


    $arParams["PRICE_VAT_INCLUDE"] = $arParams["PRICE_VAT_INCLUDE"] !== "N";

    if (empty($arParams["DISCOUNTS"]))
        $arParams["DISCOUNTS"] = "DISCOUNT_CUSTOM";

    Class WFGMRoundPrices {
        /*
         * return round accuracy by id
         * type string $accuracy
         */

        function getPriceAccuracy($accuracy) {
            $accuracies = array(
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
            );
            return ($accuracies[$accuracy]);
        }

        /**
         * 
         * @param int $value rounding price
         * @param int $precision round accuracy
         * @param string $type rounding type
         * @return int rounded price
         */
        function roundValue($value, $precision, $type) {
            return ($precision < 1 ? self::roundFraction($value, $precision, $type) : self::roundWhole($value, $precision, $type)
                );
        }

        /**
         * 
         * @param int $value rounding price
         * @param int $precision round accuracy
         * @param string $type rounding type
         * @return int rounded price
         */
        function roundWhole($value, $precision, $type) {
            $quotient = $value / $precision;
            $quotientFloor = floor($quotient);
            switch ($type) {
                case "STORE":
                    if (($quotient - $quotientFloor) > 1E-5)
                        $quotientFloor += 1;
                    break;
                case "CLIENTS":
                    break;
                case "MATH":
                default:
                    if (($quotient - $quotientFloor) >= .5)
                        $quotientFloor += 1;
                    break;
            }

            return $quotientFloor * $precision;
        }

        /**
         *
         * @param int $value rounding price
         * @param int $precision round accuracy
         * @param string $type rounding type
         * @return int rounded price fraction
         */
        function roundFraction($value, $precision, $type) {
            $valueFloor = floor($value);
            $fraction = $value - $valueFloor;
            if ($fraction <= 1E-5)
                return $value;

            return $valueFloor + self::roundWhole($fraction, $precision, $type);
        }

    }

    if (!function_exists("charset_modifier")) {

        function charset_modifier($arg) {
            $ent = html_entity_decode($arg[0], ENT_QUOTES, LANG_CHARSET);

            if ($ent == $arg[0])
                return '';
            return $ent;
        }

    }

    if (!function_exists("xml_creator")) {

        function xml_creator($text, $bHSC = true, $bDblQuote = false) {
            $bDblQuote = (true == $bDblQuote ? true : false);

            if ($bHSC) {
                $text = htmlspecialcharsBx($text);
                if ($bDblQuote)
                    $text = str_replace('&quot;', '"', $text);
            }
            $text = preg_replace("/[\x1-\x8\xB-\xC\xE-\x1F]/", "", $text);
            $text = str_replace("'", "&apos;", $text);
            return $text;
        }

    }

    if ($arParams["DISCOUNTS"] == "PRICE_ONLY") {

        function webfly_googlem_GetPrice($product_id, &$arPrices, &$arOffers, $isRoundPrice) {
            $arOffers[$product_id]["PRICE"] = 0;
            foreach ($arPrices as $arProductPrice) {
                if ($arProductPrice['PRICE'] && ($arProductPrice['PRICE'] < $arOffers[$product_id]["PRICE"] || !$arOffers[$product_id]["PRICE"])) {
                    if ($isRoundPrice["ROUND"] == "Y") {// Round Price if is Flag in arParams
                        if ((abs($arProductPrice['PRICE']) > $isRoundPrice["MINIMUM_PRICE_ROUND"]) or $isRoundPrice["MINIMUM_PRICE_ROUND"] == 0) {
                            $arProductPrice['PRICE'] = WFGMRoundPrices::roundValue($arProductPrice['PRICE'], $isRoundPrice["ACCURACY_PRICE_ROUND"], $isRoundPrice["TYPE_PRICE_ROUND"]);
                            if (substr_count($arProductPrice['PRICE'], ".00") == 0)
                                $arProductPrice['PRICE'] = $arProductPrice['PRICE'] . ".00";
                        }
                    }
                    $arOffers[$product_id]["PRICE"] = $arProductPrice['PRICE'];
                    $arOffers[$product_id]["CURRENCY"] = $arProductPrice["CURRENCY"];
                }
            }
        }

    }
    else
    if ($arParams["DISCOUNTS"] == "DISCOUNT_CUSTOM") {//uproshchennyj algoritm
        $arUserGroups = $GLOBALS["USER"]->GetUserGroupArray();

        function webfly_googlem_GetPrice($product_id, &$arPrices, &$arOffers, $isRoundPrice, $isOldPrice) {
            global $arUserGroups;
            $price = 0;
            foreach ($arPrices as &$arProductPrice) {
                if ($arProductPrice['PRICE'] && ($arProductPrice['PRICE'] < $price || !$price)) {
                    $price = $arProductPrice['PRICE'];
                    $arOffers[$product_id]["CURRENCY"] = $arProductPrice["CURRENCY"];
                }
                $simple_round = $price;
                $arDiscounts = CCatalogDiscount::GetDiscountByProduct($product_id, $arUserGroups, "N", $arProductPrice['CATALOG_GROUP_ID'], SITE_ID);
                foreach ($arDiscounts as &$arDiscount) {
                    switch ($arDiscount["VALUE_TYPE"]) {
                        case 'P': $price_buf = $arProductPrice["PRICE"] - $arDiscount["VALUE"] * $arProductPrice["PRICE"] / 100; //v procentah
                            break;
                        case 'F': $price_buf = $arProductPrice["PRICE"] - $arDiscount["VALUE"]; //fiksirovannaya
                            break;
                        default: $price_buf = $arDiscount["VALUE"]; //ustanovit cenu na tovar
                            break;
                    }

                    if ($price_buf && ($price_buf < $price || !$price)) {
                        if ($isRoundPrice["ROUND"] == "Y") {// Round Price if is Flag in arParams
                            $simple_round = round($price);
                            if (substr_count($simple_round, ".00") == 0)
                                $simple_round = $simple_round . ".00";
                            if ((abs($price) > $isRoundPrice["MINIMUM_PRICE_ROUND"]) or $isRoundPrice["MINIMUM_PRICE_ROUND"] == 0) {
                                $price = WFGMRoundPrices::roundValue($price, $isRoundPrice["ACCURACY_PRICE_ROUND"], $isRoundPrice["TYPE_PRICE_ROUND"]);
                                if (substr_count($price, ".00") == 0)
                                    $price = $price . ".00";
                            }
                            if ((abs($price_buf) > $isRoundPrice["MINIMUM_PRICE_ROUND"]) or $isRoundPrice["MINIMUM_PRICE_ROUND"] == 0) {
                                $price_buf = WFGMRoundPrices::roundValue($price_buf, $isRoundPrice["ACCURACY_PRICE_ROUND"], $isRoundPrice["TYPE_PRICE_ROUND"]);
                                if (substr_count($price_buf, ".00") == 0)
                                    $price_buf = $price_buf . ".00";
                            }
                        }
                        if ($isOldPrice == "Y") {
                            $old_price = $price; //new
                        }
                        $price = $price_buf;
                        $arOffers[$product_id]["CURRENCY"] = $arProductPrice["CURRENCY"];
                    }
                }
                $arDiscounts = null;
            }
            if (!empty($old_price) and $isOldPrice == "Y") {
                $arOffers[$product_id]["OLD_PRICE"] = $simple_round; //Fill Old Price
            }
            $arOffers[$product_id]["PRICE"] = $price; //new
            /* $arOffers[$product_id]["PRICE"] = $price; */
            CCatalogDiscount::ClearDiscountCache(array('PRODUCT' => 'Y'));
        }

    }
    else {
        // if($arParams["DISCOUNTS"] == "DISCOUNT_API")
        $GLOBALS["baseCurrency"] = CCurrency::GetBaseCurrency();

        function webfly_googlem_GetPrice($product_id, &$arPrices, &$arOffers, $isRoundPrice, $isOldPrice) {
            global $baseCurrency;
            $arPrice = CCatalogProduct::GetOptimalPrice($product_id, 1, $GLOBALS["USER"]->GetUserGroupArray(), "N", $arPrices);
            if ($arPrices[0]["CURRENCY"] != $baseCurrency) {
                $arPrices[0]["PRICE"] = CCurrencyRates::ConvertCurrency($arPrices[0]["PRICE"], $arPrices[0]["CURRENCY"], $baseCurrency);
            }
            $arPrices[0]["SIMPLE_ROUND"] = $arPrices[0]["PRICE"];
            if ($isRoundPrice["ROUND"] == "Y") {// Round Price if is Flag in arParams
                $arPrices[0]["SIMPLE_ROUND"] = round($arPrices[0]["PRICE"]);
                if (substr_count($arPrices[0]["SIMPLE_ROUND"], ".00") == 0)
                    $arPrices[0]["SIMPLE_ROUND"] = $arPrices[0]["SIMPLE_ROUND"] . ".00";
                //1.03.2017 START
                if ((abs($arPrices[0]["PRICE"]) > $isRoundPrice["MINIMUM_PRICE_ROUND"]) or $isRoundPrice["MINIMUM_PRICE_ROUND"] == 0) {
                    $arPrices[0]["PRICE"] = WFGMRoundPrices::roundValue($arPrices[0]["PRICE"], $isRoundPrice["ACCURACY_PRICE_ROUND"], $isRoundPrice["TYPE_PRICE_ROUND"]);
                    if (substr_count($arPrices[0]["PRICE"], ".00") == 0)
                        $arPrices[0]["PRICE"] = $arPrices[0]["PRICE"] . ".00";
                }
                //1.03.2017 END
                if ((abs($arPrice["DISCOUNT_PRICE"]) > $isRoundPrice["MINIMUM_PRICE_ROUND"]) or $isRoundPrice["MINIMUM_PRICE_ROUND"] == 0) {
                    $arPrice["DISCOUNT_PRICE"] = WFGMRoundPrices::roundValue($arPrice["DISCOUNT_PRICE"], $isRoundPrice["ACCURACY_PRICE_ROUND"], $isRoundPrice["TYPE_PRICE_ROUND"]);
                    if (substr_count($arPrice["DISCOUNT_PRICE"], ".00") == 0)
                        $arPrice["DISCOUNT_PRICE"] = $arPrice["DISCOUNT_PRICE"] . ".00";
                }
            }

            if ((abs($arPrices[0]["PRICE"]) > abs($arPrice["DISCOUNT_PRICE"]) and $isOldPrice == "Y")) {//new
                $arOffers[$product_id]["OLD_PRICE"] = $arPrices[0]["SIMPLE_ROUND"];
            }

            $arOffers[$product_id]["PRICE"] = $arPrice["DISCOUNT_PRICE"];
            $arOffers[$product_id]["CURRENCY"] = $arPrice["PRICE"]["CURRENCY"];

            CCatalogDiscount::ClearDiscountCache(array('PRODUCT' => 'Y'));
        }

    }

    if (!function_exists("webfly_googlem_GetMinPrice")) {

        function webfly_googlem_GetMinPrice($product_id, $arPriceTypesID) {
            if (CModule::IncludeModule("catalog")) {
                $dbProductPrices = CPrice::GetList(array(), array("PRODUCT_ID" => $product_id, "CATALOG_GROUP_ID" => $arPriceTypesID)); // ->Fetch();
                $arPrices = array();
                while ($arProductPrice = $dbProductPrices->Fetch()) {
                    $arPrices[] = $arProductPrice;
                }
                $arPrice = CCatalogProduct::GetOptimalPrice($product_id, 1, $GLOBALS["USER"]->GetUserGroupArray(), "N", $arPrices);
                return $arPrice['DISCOUNT_PRICE'];
            }
            return false;
        }

    }

    if (!function_exists("webfly_googlem_GetCurrs")) {

        function webfly_googlem_GetCurrs($product_id, $arPriceTypesID) {
            if (CModule::IncludeModule("catalog")) {
                $productPrice = CPrice::GetList(array(), array("PRODUCT_ID" => $product_id, "CATALOG_GROUP_ID" => $arPriceTypesID))->Fetch();

                $currency = $productPrice["CURRENCY"];
            }
            return $currency;
        }

    }

    /* AGENT */
    $arResult["AGENT_FOLDER"] = $APPLICATION->GetCurDir();
    COption::SetOptionString("webfly.gmerchant", "agentFolder", $arResult["AGENT_FOLDER"], false, false);
    $agentResult = CAgent::GetList(array("ID" => "DESC"), array("MODULE_ID" => "webfly.gmerchant", "NAME" => "wfGmerchantAgent();"));
    $agentMass = array();
    while ($agentob = $agentResult->GetNext()) {
        $agentMass = $agentob;
    }
    if ($arParams ["AGENT_CHECK"] == "Y") {
        if (empty($agentMass)) {
            /* Add agent */
            CAgent::AddAgent(
                "wfGmerchantAgent();", // function name
                "webfly.gmerchant", // module's ID
                "N", 86400, // interval
                date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), time() + 10800), // first check - now
                "Y", // agent active
                date($DB->DateFormatToPHP(CSite::GetDateFormat("FULL")), time() + 10800), // first start - now
                30);
        }
    }
    else {
        if (!empty($agentMass)) {
            CAgent::RemoveAgent(
                "wfGmerchantAgent();", "webfly.gmerchant", false
            );
        }
    }

    /* HTTPS */
    if ($arParams ["HTTPS_CHECK"] == "Y")
        $http = "https";
    else
        $http = "http";

    if ($arParams["USE_SITE"] == "Y")
        $server_name = $arParams["SITE"];
    else
        $server_name = $_SERVER["SERVER_NAME"];

    $bDesignMode = is_object($GLOBALS["USER"]) && $GLOBALS["USER"]->IsAdmin();

    $bSaveInFile = $arParams["SAVE_IN_FILE"] == "Y";
    if (!$bDesignMode or $bSaveInFile) {
        $arResult["SAVE_IN_FILE"] = $bSaveInFile;
        if (!$bSaveInFile) {
            $APPLICATION->RestartBuffer();
            header("Content-Type: text/xml; charset=utf-8");
            header("Pragma: no-cache");
        }
    }
    else {
        echo "<br/><b>" . GetMessage("ADMIN_TEXT") . "</b><br/>";
        return;
    }

    /*     * ***********************************************************************
      Work with cache
     * *********************************************************************** */
    $cache_id = serialize($arrFilter) . serialize($arParams); //.$USER->GetGroups() ;
    $cache_folder = '/google-merchant';

    if ($arParams["CACHE_NON_MANAGED"] == 'Y') {
        $obCache = new CPHPCache;
        $bCache = $obCache->StartDataCache($arParams["CACHE_TIME"], $cache_id, $cache_folder);
    }
    else {
        $bCache = $this->StartResultCache(false, $cache_id, $cache_folder);
    }

    if ($bCache) {
        $arResult["DATE"] = Date("Y-m-d H:i");
        $arResult["COMPANY"] = strip_tags(html_entity_decode($arParams["COMPANY"]));
        $arResult["SITE"] = $arParams["SITE"];
        $arResult["URL"] = $http . '://' . htmlspecialcharsEx(COption::GetOptionString("main", "server_name", ""));

        // list of the element fields that will be used in selection
        $arSelect = array(
          "ID",
          "NAME",
          "IBLOCK_ID",
          "IBLOCK_SECTION_ID",
          "DATE_CREATE",
          "DETAIL_PAGE_URL",
          "DETAIL_TEXT",
          "PREVIEW_TEXT"
        );

        if (!$bCatalog && !empty($arParams["PRICE_CODE"])) {
            $arSelect[] = "PROPERTY_" . $arParams["PRICE_CODE"];
        }

        if ($arParams['MORE_PHOTO']) {
            $arSelect[] = "DETAIL_PICTURE";
            $arSelect[] = "PREVIEW_PICTURE";
        }

        if (is_array($arProperty))
            $arSelect = array_merge($arProperty, $arSelect);

        $arFilter = array(
          "IBLOCK_LID" => SITE_ID,
          "IBLOCK_ID" => $arParams["IBLOCK_ID_IN"],
          "SECTION_ID" => $arParams["IBLOCK_SECTION"],
          "INCLUDE_SUBSECTIONS" => "Y",
          "IBLOCK_ACTIVE" => "Y",
          "ACTIVE_DATE" => "Y",
          "ACTIVE" => "Y",
          "CHECK_PERMISSIONS" => "Y",
          "SECTION_ACTIVE" => "Y", //New bitrix API can't fetch from IBLOCK root with this filter
          "SECTION_GLOBAL_ACTIVE" => "Y"
        );

        if ($arParams['IBLOCK_AS_CATEGORY'] == 'Y') {
            unset($arFilter["SECTION_ACTIVE"]);
            unset($arFilter["SECTION_GLOBAL_ACTIVE"]);
        }

        if ($arParams["DO_NOT_INCLUDE_SUBSECTIONS"] == "Y")
            $arFilter["INCLUDE_SUBSECTIONS"] = "N";

        if ((count($arParams["IBLOCK_SECTION"]) == 1 && $arParams["IBLOCK_SECTION"][0] == 0) ||
            !$arParams["IBLOCK_SECTION"]) {
            unset($arFilter["SECTION_ID"]);
        }

        $arSort = array(
          "ID" => "DESC",
        );


        $i = 0;

        //EXECUTE

        if ($arParams["IBLOCK_TYPE"]) {
            $rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("ID" => $arParams["IBLOCK_ID_IN"], "TYPE" => $arParams["IBLOCK_TYPE"], "ACTIVE" => "Y"));
            $arFilter["IBLOCK_TYPE"] = $arParams["IBLOCK_TYPE"];
        }
        else {
            $rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("ID" => $arParams["IBLOCK_ID_IN"], "TYPE" => $arParams["IBLOCK_TYPE_LIST"], "ACTIVE" => "Y"));
            $arFilter["IBLOCK_TYPE"] = $arParams["IBLOCK_TYPE_LIST"];
        }

        $arSKUiblockID = array();

        while ($res = $rsIBlock->GetNext()) {
            if ($arParams['IBLOCK_AS_CATEGORY'] == 'Y') {
                $arResult["CATEGORIES"][$res["ID"]] = Array("ID" => $res["ID"], "NAME" => xml_creator($res["NAME"], true));
            }

            if ($bCatalog) {
                $rsSKU = CCatalog::GetList(array(), array("PRODUCT_IBLOCK_ID" => $res["ID"]), false, false, array("IBLOCK_ID"));
                if ($arSKUiBlock = $rsSKU->Fetch()) {
                    $arSKUiblockID[$res["ID"]] = $arSKUiBlock["IBLOCK_ID"];
                }
                unset($rsSKU);
            }
        }
        unset($rsIBlock);

//fetch sections into categories list
        if ((count($arParams["IBLOCK_SECTION"]) == 1 && $arParams["IBLOCK_SECTION"][0] == 0)) {
            $filter = Array("IBLOCK_TYPE" => $arFilter["IBLOCK_TYPE"], "IBLOCK_ID" => $arParams["IBLOCK_ID_IN"], "ACTIVE" => "Y", "IBLOCK_ACTIVE" => "Y", "GLOBAL_ACTIVE" => "Y");
            $bSections = false;
        }
        else {
            $filter = Array("IBLOCK_TYPE" => $arFilter["IBLOCK_TYPE"], "IBLOCK_ID" => $arParams["IBLOCK_ID_IN"], "ID" => $arParams["IBLOCK_SECTION"], "ACTIVE" => "Y", "IBLOCK_ACTIVE" => "Y", "GLOBAL_ACTIVE" => "Y");
            $bSections = true;
        }

        if ($arParams['IBLOCK_AS_CATEGORY'] == 'Y') {
            unset($filter['ACTIVE']);
            unset($filter['GLOBAL_ACTIVE']);
        }

        $db_acc = CIBlockSection::GetList(array("left_margin" => "asc"), $filter, false, array("ID", "NAME", "IBLOCK_ID", "IBLOCK_SECTION_ID", "LEFT_MARGIN", "RIGHT_MARGIN", "DEPTH_LEVEL"));

        unset($filter["ID"]);
        unset($filter["IBLOCK_ID"]);

        while ($arAcc = $db_acc->Fetch()) {
            $id = $arAcc["IBLOCK_ID"] . $arAcc["ID"];
            if (array_key_exists($id, $arResult["CATEGORIES"]))
                continue;

            $arResult["CATEGORIES"][$id] = Array(
              "ID" => $id,
              "NAME" => xml_creator($arAcc["NAME"], true),
              "PARENT" => ($arParams['IBLOCK_AS_CATEGORY'] == 'Y') ? $arAcc["IBLOCK_ID"] : NULL
            );

            if ($arParams["DO_NOT_INCLUDE_SUBSECTIONS"] != "Y" && $bSections) {
                $subFilter = array(
                  'IBLOCK_ID' => $arAcc['IBLOCK_ID'],
                  '>LEFT_MARGIN' => $arAcc['LEFT_MARGIN'],
                  '<RIGHT_MARGIN' => $arAcc['RIGHT_MARGIN'],
                  '>DEPTH_LEVEL' => $arAcc['DEPTH_LEVEL']
                );

                $db_sub = CIBlockSection::GetList(array("left_margin" => "asc"), array_merge($filter, $subFilter), false, array("ID", "NAME", "IBLOCK_ID", "IBLOCK_SECTION_ID"));

                while ($arAcc2 = $db_sub->Fetch()) {
                    $id2 = $arAcc2["IBLOCK_ID"] . $arAcc2["ID"];
                    $arResult["CATEGORIES"][$id2] = Array(
                      "ID" => $id2,
                      "NAME" => xml_creator($arAcc2["NAME"], true),
                      "PARENT" => ($arParams['IBLOCK_AS_CATEGORY'] == 'Y') ? $arAcc2["IBLOCK_ID"] : NULL
                    );
                    if (IntVal($arAcc2["IBLOCK_SECTION_ID"]) < 1)
                        continue;

                    $key2 = $arAcc2["IBLOCK_ID"] . $arAcc2["IBLOCK_SECTION_ID"];
                    if (!array_key_exists($key2, $arResult["CATEGORIES"]))
                        continue;

                    $arResult["CATEGORIES"][$id2]["PARENT"] = $key2;
                }
                unset($db_sub);
            }
            if (IntVal($arAcc["IBLOCK_SECTION_ID"]) < 1)
                continue;

            $key = $arAcc["IBLOCK_ID"] . $arAcc["IBLOCK_SECTION_ID"];
            if (!array_key_exists($key, $arResult["CATEGORIES"]))
                continue;

            $arResult["CATEGORIES"][$id]["PARENT"] = $key;
        }
        unset($arAcc);
        unset($db_acc);

//fetch elements
        $arParams["BIG_CATALOG_PROP"] = trim($arParams["BIG_CATALOG_PROP"]);
        if (!empty($arParams["BIG_CATALOG_PROP"]) and $arParams["SAVE_IN_FILE"] == "Y") {
            $wf_limit = $arParams["BIG_CATALOG_PROP"];

            if (empty($_GET["WF_PAGE"])) {
                unset($_SESSION["WFGM_FINISH"]);
                $arResult["WF_NUM"] = 1;
            }
            else {
                if ($_SESSION["WFGM_FINISH"] == "Yes") {
                    LocalRedirect($APPLICATION->GetCurDir());
                }
                else {
                    $arResult["WF_NUM"] = $_GET["WF_PAGE"];
                }
            }

            $arResult["WF_CURR"] = $wf_limit * $arResult["WF_NUM"];

            $rsElements = CIBlockElement::Getlist($arSort, array_merge($arrFilter, $arFilter), false, array("nPageSize" => $wf_limit, "iNumPage" => $arResult["WF_NUM"]), $arSelect);

            $arResult["WF_FULL"] = $rsElements->SelectedRowsCount();
        }
        else {
            $rsElements = CIBlockElement::Getlist($arSort, array_merge($arrFilter, $arFilter), false, false, $arSelect);
        }

        while ($arOffer = $rsElements->GetNext()) {
            $arOfferID[] = $arOffer["ID"];
            $arOffer["SKU"] = array();
            $arOffers[$arOffer["ID"]] = $arOffer;
        }
        unset($rsElements);

//work with module 'catalog'

        if ($bCatalog && $arParams['PRICE_FROM_IBLOCK'] != 'Y') {
            if (empty($arSKUiblockID)) {
                $arAllID = $arOfferID; //ID of SKU and offers without any SKU
            }
            else {
                //fetch SKU
                $filterSKU = array("IBLOCK_ID" => $arSKUiblockID, $arParams['SKU_PROPERTY'] => $arOfferID, 'ACTIVE' => 'Y');
                if (is_array($arrFilterSKU))
                    $filterSKU = array_merge($filterSKU, $arrFilterSKU);
                $arOfferInOb = CIBlockElement::GetList(array($arParams['SKU_PROPERTY'] => 'DESC'), $filterSKU, false, false, $arSelect);

                $arAllID = array(); //ID of SKU and offers without any SKU
                $productKey = $arParams['SKU_PROPERTY'] . '_VALUE';

                while ($arOfferIn = $arOfferInOb->GetNext()) {
                    $arAllID[] = $arOfferIn["ID"];
                    $productID = $arOfferIn[$productKey];
                    $arOffers[$productID]["SKU"][] = $arOfferIn["ID"];
                    $arOffers[$arOfferIn["ID"]] = $arOfferIn;
                }
                unset($arOfferInOb);

                foreach ($arOfferID as $offerID) {
                    if (empty($arOffers[$offerID]["SKU"]))
                        $arAllID[] = $offerID;
                }
            }

            //opredelenie dostupnosti tovara po odnomu iz trekh algoritmov (zdes tolko pervye dva)
            if ($arParams["AVAILABLE_ALGORITHM"] == "BITRIX_ALGORITHM" or $arParams["AVAILABLE_ALGORITHM"] == "QUANTITY_ZERO" or empty($arParams["AVAILABLE_ALGORITHM"])) {
//process catalog products
                $arProductSelect = array(
                  "ID",
                  "QUANTITY",
                  "QUANTITY_TRACE",
                  "CAN_BUY_ZERO"
                );
                $dbProducts = CCatalogProduct::GetList(array("ID" => "DESC"), array("@ID" => $arAllID), false, false, $arProductSelect);
                while ($tr = $dbProducts->Fetch()) {
                    $arOffers[$tr["ID"]]["AVAIBLE"] = "true";
                    $arOffers[$tr["ID"]]["QUANTITY"] = $tr["QUANTITY"];

                    switch ($arParams["AVAILABLE_ALGORITHM"]) {
                        case "BITRIX_ALGORITHM":default:
                            if ($tr["QUANTITY_TRACE"] == "N")//esli otklyuchen uchet - dostupen
                                continue;
//esli vklyuchen uchet
                            if ($tr["QUANTITY"] > 0)//esli kol-vo 0 - dostupen
                                continue;
                            if ($tr["CAN_BUY_ZERO"] == "Y")//esli mozhno pokupat pri kol-ve 0 - dostupen
                                continue;
                            $arOffers[$tr["ID"]]["AVAIBLE"] = "false";
                            break;
                        case "QUANTITY_ZERO":
                            if ($tr["QUANTITY"] > 0)//esli kol-vo 0 - dostupen
                                continue;
                            $arOffers[$tr["ID"]]["AVAIBLE"] = "false";
                            break;
                    }
                }
                unset($tr);
                unset($dbProducts);
            }
            //NEW
            foreach ($arOffers as $newKey => $newVal) {
                if (empty($newVal["AVAIBLE"]) or $newVal["AVAIBLE"] == "")
                    $arOffers[$newKey]["AVAIBLE"] = "false";
            }

            //fetch price types
            $dbPriceTypes = CCatalogGroup::GetList(array("SORT" => "ASC"), array("NAME" => $arParams["PRICE_CODE"], "CAN_BUY" => "Y"));

            while ($arPriceType = $dbPriceTypes->Fetch()) {
                $arPriceTypesID[] = $arPriceType['ID'];
            }
            unset($dbPriceTypes);

            //fetch and process product prices
            $arPriceSelect = array('PRODUCT_ID', 'PRICE', 'CURRENCY', 'CATALOG_GROUP_ID');
            $dbProductPrices = CPrice::GetList(array("PRODUCT_ID" => "DESC"), array("@PRODUCT_ID" => $arAllID, "@CATALOG_GROUP_ID" => $arPriceTypesID), false, false, $arPriceSelect);

            $arPrices = array();

            //Get price rounding params START
            if ($arParams["PRICE_ROUND"] == "Y") {
                //round?
                $roundSettings["ROUND"] = "Y";
                //minimum round price
                $roundSettings["MINIMUM_PRICE_ROUND"] = $arParams["MINIMUM_PRICE_ROUND"] ? abs($arParams["MINIMUM_PRICE_ROUND"]) : 0;
                //type round price
                $roundSettings["TYPE_PRICE_ROUND"] = $arParams["TYPE_PRICE_ROUND"]? : "MATH";
                //accuracy
                $roundSettings["ACCURACY_PRICE_ROUND"] = $arParams["ACCURACY_PRICE_ROUND"] ? WFGMRoundPrices::getPriceAccuracy($arParams["ACCURACY_PRICE_ROUND"]) : 1;
            }
            else {
                $roundSettings = array("ROUND" => "N");
            }

            //Get price rounding params END
            if (count($arPriceTypesID) > 1) {
                $arProductPrice = $dbProductPrices->GetNext();
                $product_id = $arProductPrice["PRODUCT_ID"];
                $arPrices[] = $arProductPrice;
                while ($arProductPrice = $dbProductPrices->GetNext()) {
                    if ($arProductPrice["PRODUCT_ID"] != $product_id) {
                        webfly_googlem_GetPrice($product_id, $arPrices, $arOffers, $roundSettings, $arParams["OLD_PRICE"]);

                        $product_id = $arProductPrice["PRODUCT_ID"];
                        $arPrices = array();
                    }
                    $arPrices[] = $arProductPrice;
                }
                webfly_googlem_GetPrice($product_id, $arPrices, $arOffers, $roundSettings, $arParams["OLD_PRICE"]);
            }
            else if ($arParams["DISCOUNTS"] == 'PRICE_ONLY') {
                while ($arPrice = $dbProductPrices->GetNext()) {
                    $arOffers[$arPrice["PRODUCT_ID"]]["PRICE"] = $arPrice["PRICE"];
                    $arOffers[$arPrice["PRODUCT_ID"]]["CURRENCY"] = $arPrice["CURRENCY"];
                }
            }
            else {
                $arAllPricesHolder = array();
                while ($tmpPrice = $dbProductPrices->GetNext()) {
                    $arPrices[0]["PRODUCT_ID"] = $tmpPrice["PRODUCT_ID"];
                    $arPrices[0]["PRICE"] = $tmpPrice["PRICE"];
                    $arPrices[0]["CURRENCY"] = $tmpPrice["CURRENCY"];
                    $arPrices[0]["CATALOG_GROUP_ID"] = $tmpPrice["CATALOG_GROUP_ID"];
                    $arAllPricesHolder[] = $arPrices;
                    unset($tmpPrice);
                }
                unset($arPrices);

                $arr_length = count($arAllPricesHolder);
                for ($i = 0; $i < $arr_length; $i++) {
                    webfly_googlem_GetPrice($arAllPricesHolder[$i][0]["PRODUCT_ID"], $arAllPricesHolder[$i], $arOffers, $roundSettings, $arParams["OLD_PRICE"]);
                }
                unset($arAllPricesHolder);
            }
            unset($dbProductPrices);
            CCatalogDiscount::ClearDiscountCache(array('SECTIONS' => 'Y', 'SECTION_CHAINS' => 'Y'));
        }

        $arResult['OFFER'] = array();
        $arResult['CURRENCIES'] = array();

        /* OFFER ITERATION */

        foreach ($arOfferID as &$offerID) {
            $arOffer = & $arOffers[$offerID];

            //setting offer pictures
            //6.03.2017
            $main_picture = $arOffer["DETAIL_PICTURE"];
            $add_picture = $arOffer["PREVIEW_PICTURE"];
            if ($arParams["GET_OVER_FIELDS_ANONCE"] == "Y") {
                $main_picture = $arOffer["PREVIEW_PICTURE"];
                $add_picture = $arOffer["DETAIL_PICTURE"];
            }
            if ($main_picture) {
                $db_file = CFile::GetByID($main_picture);
                if ($ar_file = $db_file->Fetch())
                    $arOffer["PICTURE"] = $ar_file["~src"] ? $ar_file["~src"] : $http . "://" . $server_name . "/" . ( COption::GetOptionString("main", "upload_dir", "upload")) . "/" . $ar_file["SUBDIR"] . "/" . implode("/", array_map("rawurlencode", explode("/", $ar_file["FILE_NAME"])));
                unset($ar_file);
                unset($db_file);
            }

            if ($add_picture && !$arOffer["PICTURE"]) {
                $db_file = CFile::GetByID($add_picture);
                if ($ar_file = $db_file->Fetch())
                    $arOffer["PICTURE"] = $ar_file["~src"] ? $ar_file["~src"] : $http . "://" . $server_name . "/" . (COption::GetOptionString("main", "upload_dir", "upload")) . "/" . $ar_file["SUBDIR"] . "/" . implode("/", array_map("rawurlencode", explode("/", $ar_file["FILE_NAME"])));
                unset($ar_file);
                unset($db_file);
            }
//6.03.2017

            /* MORE PHOTO START */
            if (!empty($arParams["MORE_PHOTO"]) && $arParams["MORE_PHOTO"] != "WF_EMPT") {
                $ph = CIBlockElement::GetProperty($arOffer["IBLOCK_ID"], $arOffer["ID"], array("value_id" => "asc"), Array("CODE" => $arParams["MORE_PHOTO"]));
                $arOffer["MORE_PHOTO"] = array();

                while (($ob = $ph->GetNext()) && count($arOffer["MORE_PHOTO"]) < 10) {
                    $arFile = CFile::GetFileArray($ob["VALUE"]);
                    if (!empty($arFile)) {
                        if (strpos($arFile["SRC"], $http) === false) {
                            $pic = $http . "://" . $server_name . implode("/", array_map("rawurlencode", explode("/", $arFile["SRC"])));
                        }
                        else {
                            $ar = explode($http . "://", $arFile["SRC"]);
                            $pic = $http . "://" . implode("/", array_map("rawurlencode", explode("/", $ar[1])));
                        }
                        $arOffer["MORE_PHOTO"][] = $pic;
                    }
                    unset($ob);
                }
                unset($ph);

                if (!$arOffer["PICTURE"] && is_array($arOffer["MORE_PHOTO"]))
                    $arOffer['PICTURE'] = array_shift($arOffer["MORE_PHOTO"]);
                $arOffer["MORE_PHOTO"] = array_slice($arOffer["MORE_PHOTO"], 0, 9);
            }
            /* MORE PHOTO END */


            //offer URL
            $arOffer["URL"] = $http . "://" . $server_name . $arOffer["DETAIL_PAGE_URL"];

            $propsArray = array("GTIN");
            if ($arParams["AVAILABLE_ALGORITHM"] == "PROP_ALGORITHM")
                $propsArray[] = "PROP_ALGORITHM_VALUE";

            if (count($propsArray) > 0) {
                foreach ($propsArray as $propKey => $propVal) {
                    if (!empty($arParams[$propVal])) {

                        //Get prop
                        $arProps = CIBlockElement::GetProperty($arOffer["IBLOCK_ID"], $arOffer["ID"], array("sort" => "asc"), Array("CODE" => $arParams[$propVal]))->GetNext();
                        $dispProp = CIBlockFormatProperties::GetDisplayValue($arOffer, $arProps, "gm_out");
                        //Format prop
                        $arOffer[$propVal] = ($dispProp["VALUE_ENUM"] or $dispProp["VALUE_ENUM"] === "0") ? xml_creator($dispProp["VALUE_ENUM"], true) : xml_creator($dispProp["DISPLAY_VALUE"], true);
                        $arOffer[$propVal] = strip_tags($arOffer[$propVal]);
                        if (substr_count($arOffer[$propVal], "a href") > 0) {
                            $arOffer[$propVal] = htmlspecialcharsBack($arOffer[$propVal]);
                            $arOffer[$propVal] = strip_tags($arOffer[$propVal]);
                            $arOffer[$propVal] = xml_creator($arOffer[$propVal], true);
                        }
                        if ($propVal == "PROP_ALGORITHM_VALUE") {
                            //Add prop
                            $arOffer["AVAIBLE"] = "false";
                            if ($arOffer[$propVal] == "true" or $arOffer[$propVal] == "Y" or $arOffer[$propVal] == "1")
                                $arOffer["AVAIBLE"] = "true";
                            if ($arOffer[$propVal] == "false" or $arOffer[$propVal] == "N" or $arOffer[$propVal] == "0" or empty($arOffer[$propVal]))
                                $arOffer["AVAIBLE"] = "false";
                        }
                    }
                    unset($arProps);
                    unset($dispProp);
                }
            }

            //NEW_IBLOCK_ORDER
            if ($bCatalog && empty($arOffer["SKU"]) && $arParams['PRICE_FROM_IBLOCK'] != 'Y') {
                if (intval($arOffer["PRICE"]) <= 0 && $arParams['PRICE_REQUIRED'] != 'N')
                    continue;
                if ($arParams["IBLOCK_ORDER"] != "Y" && $arOffer["AVAIBLE"] == "false")
                    continue;
            }
//NEW_IBLOCK_ORDER
//
            //setting offer description
            if ($arOffer["PREVIEW_TEXT"]) {
                $arOffer["PREVIEW_TEXT"] = xml_creator(($arOffer["PREVIEW_TEXT_TYPE"] == "html" ? preg_replace_callback("'&[^;]*;'", "charset_modifier", strip_tags($arOffer["~PREVIEW_TEXT"])) : $arOffer["~PREVIEW_TEXT"]), true);
            }

            if ($arOffer["DETAIL_TEXT"]) {
                $arOffer["DETAIL_TEXT"] = xml_creator(($arOffer["DETAIL_TEXT_TYPE"] == "html" ? preg_replace_callback("'&[^;]*;'", "charset_modifier", strip_tags($arOffer["~DETAIL_TEXT"])) : $arOffer["~DETAIL_TEXT"]), true);
            }

            $arOffer["DESCRIPTION"] = $arOffer["PREVIEW_TEXT"] ? $arOffer["PREVIEW_TEXT"] : $arOffer["DETAIL_TEXT"];

            if ($arParams["DETAIL_TEXT_PRIORITET"] == "Y") {
                $arOffer["DESCRIPTION"] = $arOffer["DETAIL_TEXT"] ? $arOffer["DETAIL_TEXT"] : $arOffer["PREVIEW_TEXT"];
            }

            $arOffer["CATEGORY"] = $arOffer["IBLOCK_ID"] . $arOffer["IBLOCK_SECTION_ID"];

            if (!array_key_exists($arOffer["CATEGORY"], $arResult["CATEGORIES"]) && $arOffer["IBLOCK_SECTION_ID"]) {
                $arGr = CIBlockElement::GetElementGroups($arOffer["ID"]);
                while ($ar_group = $arGr->Fetch()) {
                    if (!array_key_exists($arOffer["IBLOCK_ID"] . $ar_group["ID"], $arResult["CATEGORIES"]))
                        continue;
                    $arOffer["CATEGORY"] = $arOffer["IBLOCK_ID"] . $ar_group["ID"];
                    break;
                }
            }

            if ($arParams['SECTION_AS_VENDOR'] == 'Y') {
                if (!empty($arOffer['IBLOCK_SECTION_ID'])) {
                    $arOffer["DEVELOPER"] = $arResult["CATEGORIES"][$arOffer["IBLOCK_ID"] . $arOffer['IBLOCK_SECTION_ID']]["NAME"];
                }
            }

            if ($arParams["MARKET_CATEGORY_CHECK"] == "Y") {
                if (!empty($arParams['MARKET_CATEGORY_PROP'])) {
                    $arProps = CIBlockElement::GetProperty($arOffer["IBLOCK_ID"], $arOffer["ID"], array("sort" => "asc"), Array("CODE" => $arParams["MARKET_CATEGORY_PROP"]))->GetNext();
                    $dispProp = CIBlockFormatProperties::GetDisplayValue($arOffer, $arProps);

                    $arOffer["MARKET_CATEGORY"] = $dispProp["VALUE_ENUM"] ? xml_creator($dispProp["VALUE_ENUM"], true) : xml_creator($dispProp["DISPLAY_VALUE"], true);
                    $arOffer["MARKET_CATEGORY"] = strip_tags($arOffer["MARKET_CATEGORY"]);
                    if (substr_count($arOffer["MARKET_CATEGORY"], "a href") > 0) {
                        $arOffer["MARKET_CATEGORY"] = htmlspecialcharsBack($arOffer["MARKET_CATEGORY"]);
                        $arOffer["MARKET_CATEGORY"] = strip_tags($arOffer["MARKET_CATEGORY"]);
                        $arOffer["MARKET_CATEGORY"] = xml_creator($arOffer["MARKET_CATEGORY"], true);
                    }

                    unset($arProps);
                }

                if (!$arOffer["MARKET_CATEGORY"]) {
                    $arGr = CIBlockElement::GetElementGroups($arOffer["ID"]);
                    $ar_group = $arGr->Fetch();
                    $groupid = $ar_group["ID"];

                    $res = CIBlockSection::GetNavChain(false, $groupid);
                    while ($el = $res->GetNext()) {
                        $arOffer["MARKET_CATEGORY"] .= $el['NAME'];
                        $arOffer["MARKET_CATEGORY"] .= "/";
                    }
                    unset($res);
                    unset($arGr);
                    unset($ar_group);
                    if ($arParams["IBLOCK_AS_CATEGORY"] == 'Y') {
                        $arOffer["MARKET_CATEGORY"] = $arResult["CATEGORIES"][$arOffer["IBLOCK_ID"]]["NAME"]
                            . '/'
                            . $arOffer["MARKET_CATEGORY"];
                    }
                    $arOffer["MARKET_CATEGORY"] = substr($arOffer["MARKET_CATEGORY"], 0, -1);
                }
            }

            //setting offer name
            if (!empty($arParams['NAME_PROP'])) {
                $arProps = CIBlockElement::GetProperty($arOffer["IBLOCK_ID"], $arOffer["ID"], array("sort" => "asc"), Array("CODE" => $arParams['NAME_PROP']))->Fetch();
                $arOffer["MODEL"] = $arProps["VALUE_ENUM"] ? $arProps["VALUE_ENUM"] : $arProps["VALUE"];
                unset($arProps);
            }

            if (empty($arOffer["MODEL"])) {
                $arOffer["MODEL"] = $arOffer["~NAME"];
            }

            //work with offer SKU
            $flag = 0;
            foreach ($arOffer["SKU"] as &$arOfferInID) {
                $arOfferIn = & $arOffers[$arOfferInID];
                $flag = 1;

                if ($arParams["CURRENCIES_CONVERT"] != "NOT_CONVERT") {
                    if ($arParams["DISCOUNTS"] != "DISCOUNT_API") {
                        $arOfferIn["PRICE"] = CCurrencyRates::ConvertCurrency($arOfferIn["PRICE"], $arOfferIn["CURRENCY"], $arParams["CURRENCIES_CONVERT"]);
                        $arOfferIn["OLD_PRICE"] = CCurrencyRates::ConvertCurrency($arOfferIn["OLD_PRICE"], $arOfferIn["CURRENCY"], $arParams["CURRENCIES_CONVERT"]);
                        if ($roundSettings["ROUND"] == "Y") {// Round Price if is Flag in arParams
                            if ((abs($arOfferIn["PRICE"]) > $roundSettings["MINIMUM_PRICE_ROUND"]) or $roundSettings["MINIMUM_PRICE_ROUND"] == 0) {
                                $arOfferIn["PRICE"] = WFGMRoundPrices::roundValue($arOfferIn["PRICE"], $roundSettings["ACCURACY_PRICE_ROUND"], $roundSettings["TYPE_PRICE_ROUND"]);
                                if (substr_count($arOfferIn["PRICE"], ".00") == 0)
                                    $arOfferIn["PRICE"] = $arOfferIn["PRICE"] . ".00";
                            }
                            if ($arOfferIn["OLD_PRICE"] and $arParams["DISCOUNTS"] != "PRICE_ONLY") {
                                if ((abs($arOfferIn["OLD_PRICE"]) > $roundSettings["MINIMUM_PRICE_ROUND"]) or $roundSettings["MINIMUM_PRICE_ROUND"] == 0) {
                                    $arOfferIn["OLD_PRICE"] = WFGMRoundPrices::roundValue($arOfferIn["OLD_PRICE"], $roundSettings["ACCURACY_PRICE_ROUND"], $roundSettings["TYPE_PRICE_ROUND"]);
                                    if (substr_count($arOfferIn["OLD_PRICE"], ".00") == 0)
                                        $arOfferIn["OLD_PRICE"] = $arOfferIn["OLD_PRICE"] . ".00";
                                }
                            }
                        }
                    }
                    $arOfferIn["CURRENCY"] = $arParams["CURRENCIES_CONVERT"];
                }
                if (!in_array($arOfferIn["CURRENCY"], $arResult["CURRENCIES"]))
                    $arResult["CURRENCIES"][] = $arOfferIn["CURRENCY"];

                $arOfferIn["CATEGORY"] = $arOffer["CATEGORY"];

                $tmpName = $arOffer["MODEL"];

                switch ($arParams["SKU_NAME"]) {
                    case "PRODUCT_NAME":
                        $arOfferIn["MODEL"] = xml_creator($tmpName, true);
                        break;

                    case "SKU_NAME":
                        $arOfferIn["MODEL"] = xml_creator(empty($arOfferIn["~NAME"]) ? $tmpName : $arOfferIn["~NAME"], true);
                        break;

                    default:
                        if (!empty($arOfferIn["~NAME"]))
                            $tmpName .= " / " . $arOfferIn["~NAME"];
                        $arOfferIn["MODEL"] = xml_creator($tmpName, true);
                        break;
                }


                if (!$arOfferIn["DETAIL_PAGE_URL"]) {
                    $arOfferIn["URL"] = $arOffer["URL"] . "#" . $arOfferIn["ID"];
                }
                else
                    $arOfferIn["URL"] = $http . "://" . $server_name . $arOfferIn["DETAIL_PAGE_URL"];

                //6.03.2017
                $main_picture_in = $arOfferIn["DETAIL_PICTURE"];
                $add_picture_in = $arOfferIn["PREVIEW_PICTURE"];
                if ($arParams["GET_OVER_FIELDS_ANONCE"] == "Y") {
                    $main_picture_in = $arOfferIn["PREVIEW_PICTURE"];
                    $add_picture_in = $arOfferIn["DETAIL_PICTURE"];
                }

                if ($main_picture_in) {
                    $db_file = CFile::GetByID($main_picture_in);
                    if ($ar_file = $db_file->Fetch())
                        $arOfferIn["PICTURE"] = $ar_file["~src"] ? $ar_file["~src"] : $http . "://" . $server_name . "/" . (COption::GetOptionString("main", "upload_dir", "upload")) . "/" . $ar_file["SUBDIR"] . "/" . implode("/", array_map("rawurlencode", explode("/", $ar_file["FILE_NAME"])));
                    unset($ar_file);
                    unset($db_file);
                }

                if ($add_picture_in && !$arOfferIn["PICTURE"]) {
                    $db_file = CFile::GetByID($add_picture_in);
                    if ($ar_file = $db_file->Fetch())
                        $arOfferIn["PICTURE"] = $ar_file["~src"] ? $ar_file["~src"] : $http . "://" . $server_name . "/" . (COption::GetOptionString("main", "upload_dir", "upload")) . "/" . $ar_file["SUBDIR"] . "/" . implode("/", array_map("rawurlencode", explode("/", $ar_file["FILE_NAME"])));
                    unset($ar_file);
                    unset($db_file);
                }
//6.03.2017

                if (!empty($arParams["MORE_PHOTO"]) && $arParams["MORE_PHOTO"] != "WF_EMPT") {

                    $ph = CIBlockElement::GetProperty($arOfferIn["IBLOCK_ID"], $arOfferIn["ID"], array("sort" => "asc"), Array("CODE" => $arParams["MORE_PHOTO"]));
                    $arOfferIn["MORE_PHOTO"] = array();

                    while (($ob = $ph->GetNext()) && count($arOfferIn["MORE_PHOTO"]) < 10) {
                        $arFile = CFile::GetFileArray($ob["VALUE"]);
                        if (!empty($arFile)) {
                            if (strpos($arFile["SRC"], $http) === false) {
                                $pic = $http . "://" . $server_name . implode("/", array_map("rawurlencode", explode("/", $arFile["SRC"])));
                            }
                            else {
                                $ar = explode($http . "://", $arFile["SRC"]);
                                $pic = $http . "://" . implode("/", array_map("rawurlencode", explode("/", $ar[1])));
                            }
                            $arOfferIn["MORE_PHOTO"][] = $pic;
                        }
                        unset($ob);
                        unset($arFile);
                    }
                    unset($ph);
                }

                if (is_array($arOffer["MORE_PHOTO"]))
                    foreach ($arOffer["MORE_PHOTO"] as $pic) {
                        if (!in_array($pic, $arOfferIn["MORE_PHOTO"]) && count($arOfferIn["MORE_PHOTO"]) < 10)
                            $arOfferIn["MORE_PHOTO"][] = $pic;
                    }

                if (!$arOfferIn["PICTURE"]) {
                    if ($arOffer["PICTURE"])
                        $arOfferIn["PICTURE"] = $arOffer["PICTURE"];
                    else
                    if (is_array($arOfferIn["MORE_PHOTO"]))
                        $arOfferIn["PICTURE"] = array_shift($arOfferIn["MORE_PHOTO"]);
                }
                $arOfferIn["MORE_PHOTO"] = array_slice($arOfferIn["MORE_PHOTO"], 0, 9);

                $propsArrayOffers = array("GTIN");
                if ($arParams["AVAILABLE_ALGORITHM"] == "PROP_ALGORITHM")
                    $propsArrayOffers[] = "PROP_ALGORITHM_VALUE";

                if (count($propsArrayOffers) > 0) {
                    foreach ($propsArrayOffers as $propKey => $propVal) {
                        if (!empty($arParams[$propVal])) {

                            //Get prop
                            $arProps = CIBlockElement::GetProperty($arOfferIn["IBLOCK_ID"], $arOfferIn["ID"], array("sort" => "asc"), Array("CODE" => $arParams[$propVal]))->GetNext();
                            if ($propVal == "PROP_ALGORITHM_VALUE") {
                                if ($arProps) {//sku contain this prop
                                    $dispProp = CIBlockFormatProperties::GetDisplayValue($arOfferIn, $arProps, "ym_out");
                                }
                                else {
                                    $arProps = CIBlockElement::GetProperty($arOffer["IBLOCK_ID"], $arOffer["ID"], array("sort" => "asc"), Array("CODE" => $arParams[$propVal]))->GetNext();
                                    $dispProp = CIBlockFormatProperties::GetDisplayValue($arOffer, $arProps, "ym_out");
                                }
                            }

                            //Format prop
                            $arOfferIn[$propVal] = ($dispProp["VALUE_ENUM"] or $dispProp["VALUE_ENUM"] === "0") ? xml_creator($dispProp["VALUE_ENUM"], true) : xml_creator($dispProp["DISPLAY_VALUE"], true);
                            $arOfferIn[$propVal] = strip_tags($arOfferIn[$propVal]);
                            if (substr_count($arOfferIn[$propVal], "a href") > 0) {
                                $arOfferIn[$propVal] = htmlspecialcharsBack($arOfferIn[$propVal]);
                                $arOfferIn[$propVal] = strip_tags($arOfferIn[$propVal]);
                                $arOfferIn[$propVal] = xml_creator($arOfferIn[$propVal], true);
                            }
                            if ($propVal == "PROP_ALGORITHM_VALUE") {
                                //Add prop
                                $arOfferIn["AVAIBLE"] = "false";
                                if ($arOfferIn[$propVal] == "true" or $arOfferIn[$propVal] == "Y" or $arOfferIn[$propVal] == "1")
                                    $arOfferIn["AVAIBLE"] = "true";
                                if ($arOfferIn[$propVal] == "false" or $arOfferIn[$propVal] == "N" or $arOfferIn[$propVal] == "0" or empty($arOfferIn[$propVal]))
                                    $arOfferIn["AVAIBLE"] = "false";
                            }
                        }
                    }
                }

                //NEW_IBLOCK_ORDER 
                if ($arParams["IBLOCK_ORDER"] != "Y" && $arOfferIn["AVAIBLE"] == "false")
                    continue;

                if (intval($arOfferIn["PRICE"]) <= 0)
                    continue;
                //NEW_IBLOCK_ORDER 

                if ($arOfferIn["PREVIEW_TEXT"]) {
                    $arOfferIn["PREVIEW_TEXT"] = xml_creator(($arOfferIn["PREVIEW_TEXT_TYPE"] == "html" ? preg_replace_callback("'&[^;]*;'", "charset_modifier", strip_tags($arOfferIn["~PREVIEW_TEXT"])) : $arOfferIn["~PREVIEW_TEXT"]), true);
                }

                if ($arOfferIn["DETAIL_TEXT"]) {
                    $arOfferIn["DETAIL_TEXT"] = xml_creator(($arOfferIn["DETAIL_TEXT_TYPE"] == "html" ? preg_replace_callback("'&[^;]*;'", "charset_modifier", strip_tags($arOfferIn["~DETAIL_TEXT"])) : $arOfferIn["~DETAIL_TEXT"]), true);
                }

                $arOfferIn["DESCRIPTION"] = $arOfferIn["PREVIEW_TEXT"] ? $arOfferIn["PREVIEW_TEXT"] : $arOfferIn["DETAIL_TEXT"];

                if ($arParams["DETAIL_TEXT_PRIORITET"] == "Y") {
                    $arOfferIn["DESCRIPTION"] = $arOfferIn["DETAIL_TEXT"] ? $arOfferIn["DETAIL_TEXT"] : $arOfferIn["PREVIEW_TEXT"];
                }

                if (!$arOfferIn["DESCRIPTION"]) {
                    $arOfferIn["DESCRIPTION"] = $arOffer["DESCRIPTION"];
                }

                // MARKET_CATEGORY

                if ($arParams["MARKET_CATEGORY_CHECK"] == "Y") {
                    $arOfferIn["MARKET_CATEGORY"] = $arOffer["MARKET_CATEGORY"];
                }

                // GROUP_ID
                $arOfferIn["GROUP_ID"] = $arOffer["ID"];
                // ID Ibloka cataloga
                $arOfferIn["IBLOCK_ID_CATALOG"] = $arOffer["IBLOCK_ID"];

                if ($arParams['SECTION_AS_VENDOR'] == 'Y') {
                    if (!empty($arOffer['IBLOCK_SECTION_ID'])) {
                        $arOfferIn["DEVELOPER"] = $arOffer["DEVELOPER"];
                    }
                }

                $arResult["OFFER"][] = $arOfferIn;
            } // foreach ($arOffer["SKU"] as &$arOfferInID)

            if ($flag == 1)
                continue;

            if (!$bCatalog || $arParams['PRICE_FROM_IBLOCK'] == 'Y') {
                $arOffer["AVAIBLE"] = "true";
                if (isset($arParams["IBLOCK_QUANTITY"]) && $arParams["IBLOCK_QUANTITY"] != "WF_EMPT") {
                    $av = CIBlockElement::GetProperty($arOffer["IBLOCK_ID"], $arOffer["ID"], array("sort" => "asc"), Array("CODE" => $arParams["IBLOCK_QUANTITY"]))->Fetch();
                    if (IntVal($av["VALUE"]) > 0)
                        $arOffer["AVAIBLE"] = "true";
                    else {
                        if ($arParams["IBLOCK_ORDER"] == "Y")
                            $arOffer["AVAIBLE"] = "false";
                        else
                            continue;
                    }
                }
            }

            if ($bCatalog && $arParams['PRICE_FROM_IBLOCK'] != 'Y') {
                if ($arOffer['CURRENCY'] == "RUR")
                    $arOffer['CURRENCY'] = "RUB";

                if ($arParams["CURRENCIES_CONVERT"] != "NOT_CONVERT") {
                    if ($arParams["DISCOUNTS"] != "DISCOUNT_API") {
                        $arOffer["PRICE"] = CCurrencyRates::ConvertCurrency($arOffer["PRICE"], $arOffer["CURRENCY"], $arParams["CURRENCIES_CONVERT"]);
                        $arOffer["OLD_PRICE"] = CCurrencyRates::ConvertCurrency($arOffer["OLD_PRICE"], $arOffer["CURRENCY"], $arParams["CURRENCIES_CONVERT"]);
                        if ($roundSettings["ROUND"] == "Y") {// Round Price if is Flag in arParams
                            if ((abs($arOffer["PRICE"]) > $roundSettings["MINIMUM_PRICE_ROUND"]) or $roundSettings["MINIMUM_PRICE_ROUND"] == 0) {
                                $arOffer["PRICE"] = WFGMRoundPrices::roundValue($arOffer["PRICE"], $roundSettings["ACCURACY_PRICE_ROUND"], $roundSettings["TYPE_PRICE_ROUND"]);
                                if (substr_count($arOffer["PRICE"], ".00") == 0)
                                    $arOffer["PRICE"] = $arOffer["PRICE"] . ".00";
                            }
                            if ($arOffer["OLD_PRICE"] and $arParams["DISCOUNTS"] != "PRICE_ONLY") {
                                if ((abs($arOffer["OLD_PRICE"]) > $roundSettings["MINIMUM_PRICE_ROUND"]) or $roundSettings["MINIMUM_PRICE_ROUND"] == 0) {
                                    $arOffer["OLD_PRICE"] = WFGMRoundPrices::roundValue($arOffer["OLD_PRICE"], $roundSettings["ACCURACY_PRICE_ROUND"], $roundSettings["TYPE_PRICE_ROUND"]);
                                    if (substr_count($arOffer["OLD_PRICE"], ".00") == 0)
                                        $arOffer["OLD_PRICE"] = $arOffer["OLD_PRICE"] . ".00";
                                }
                            }
                        }
                        //$arOffer["PRICE"] = round($newval, 2);
                    }
                    $arOffer["CURRENCY"] = $arParams["CURRENCIES_CONVERT"];
                }
                if (!in_array($arOffer["CURRENCY"], $arResult["CURRENCIES"]))
                    $arResult["CURRENCIES"][] = $arOffer["CURRENCY"];
            }
            else {
//iblock price
                $arProps = CIBlockElement::GetProperty($arOffer["IBLOCK_ID"], $arOffer['ID'], array("sort" => "asc"), Array("CODE" => $arParams["PRICE_CODE"]))->Fetch();

                $arOffer["PRICE"] = $arProps["VALUE_ENUM"] ? $arProps["VALUE_ENUM"] : $arProps["VALUE"];
                $arOffer["PRICE"] = floatval(str_replace(" ", "", $arOffer["PRICE"]));
                //old iblock price
                if ($arParams["OLD_PRICE"] == "Y") {
                    unset($arProps);
                    $arProps = CIBlockElement::GetProperty($arOffer["IBLOCK_ID"], $arOffer['ID'], array("sort" => "asc"), Array("CODE" => $arParams["OLD_PRICE_CODE"]))->Fetch();
                    $arOffer["OLD_PRICE"] = $arProps["VALUE_ENUM"] ? $arProps["VALUE_ENUM"] : $arProps["VALUE"];
                    $arOffer["OLD_PRICE"] = floatval(str_replace(" ", "", $arOffer["OLD_PRICE"]));
                }
                if ($roundSettings["ROUND"] == "Y") {// Round Price if is Flag in arParams
                    if ((abs($arOffer["PRICE"]) > $roundSettings["MINIMUM_PRICE_ROUND"]) or $roundSettings["MINIMUM_PRICE_ROUND"] == 0) {
                        $arOffer["PRICE"] = WFGMRoundPrices::roundValue($arOffer["PRICE"], $roundSettings["ACCURACY_PRICE_ROUND"], $roundSettings["TYPE_PRICE_ROUND"]);
                        if (substr_count($arOffer["PRICE"], ".00") == 0)
                            $arOffer["PRICE"] = $arOffer["PRICE"] . ".00";
                    }
                    if ($arOffer["OLD_PRICE"]) {
                        if ((abs($arOffer["OLD_PRICE"]) > $roundSettings["MINIMUM_PRICE_ROUND"]) or $roundSettings["MINIMUM_PRICE_ROUND"] == 0) {
                            $arOffer["OLD_PRICE"] = WFGMRoundPrices::roundValue($arOffer["OLD_PRICE"], $roundSettings["ACCURACY_PRICE_ROUND"], $roundSettings["TYPE_PRICE_ROUND"]);
                            if (substr_count($arOffer["OLD_PRICE"], ".00") == 0)
                                $arOffer["OLD_PRICE"] = $arOffer["OLD_PRICE"] . ".00";
                        }
                    }
                }
                unset($arProps);

                if (intval($arOffer["PRICE"]) <= 0 && $arParams['PRICE_REQUIRED'] != 'N')
                    continue;

                if (!empty($arParams["CURRENCIES_PROP"]))
                    $arProps = CIBlockElement::GetProperty($arOffer["IBLOCK_ID"], $arOffer['ID'], array("sort" => "asc"), Array("CODE" => $arParams["CURRENCIES_PROP"]))->Fetch();

                $arOffer["CURRENCY"] = empty($arProps["VALUE_XML_ID"]) ? $arParams["CURRENCY"] : $arProps["VALUE_XML_ID"];
                $arProps = null;

                if (!in_array($arOffer["CURRENCY"], $arResult["CURRENCIES"]))
                    $arResult["CURRENCIES"][] = $arOffer["CURRENCY"];
            }

            $arOffer["MODEL"] = xml_creator($arOffer["MODEL"], true);


            $arResult["OFFER"][] = $arOffer;

            $i++;
        }

        //CURRENCIES SETTINGS
        if (!empty($arParams["BIG_CATALOG_PROP"]) and $arParams["SAVE_IN_FILE"] == "Y" and $arParams["CURRENCIES_CONVERT"] == "NOT_CONVERT" and $arResult["WF_NUM"] == 1 and $arParams['PRICE_FROM_IBLOCK'] != 'Y') {
            $db_res = CCatalogGroup::GetList(
                    array(), array(
                  "CURRENCY" => $arParams["PRICE_CODE"]
                    ), false, false, array("ID")
            );
            while ($ar_res = $db_res->Fetch()) {
                $result[] = $ar_res["ID"];
            }
            foreach ($result as $k => $re) {
                $curInfo = CIBlockElement::GetList(array(), array(array_merge($arrFilter, $arFilter)), false, false, array("ID", "CATALOG_GROUP_" . $re));
                while ($curob = $curInfo->Fetch()) {
                    if (!in_array($curob["CATALOG_CURRENCY_" . $re], $resCur) and ! empty($curob["CATALOG_CURRENCY_" . $re]))
                        $resCur[] = $curob["CATALOG_CURRENCY_" . $re];
                }
            }
            $arResult["CURRENCIES"] = $resCur;
        }

        unset($arOffers);

        $this->IncludeComponentTemplate();

        if ($arParams["CACHE_NON_MANAGED"] == 'Y') {
            $obCache->EndDataCache();
        }
    }

    if (!$bDesignMode and ! $bSaveInFile) {
        $r = $APPLICATION->EndBufferContentMan();
        echo $r;
        if (defined("HTML_PAGES_FILE") && !defined("ERROR_404"))
            CHTMLPagesCache::writeFile(HTML_PAGES_FILE, $r);
        die();
    }
}else {
    echo GetMessage("ADMIN_TEXT_STOP");
}
?>