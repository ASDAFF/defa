<?
//<title>RetailRocket</title>
/** @global CUser $USER */
/** @global CMain $APPLICATION */
/** @var int $IBLOCK_ID */
/** @var string $SETUP_SERVER_NAME */
/** @var string $SETUP_FILE_NAME */
/** @var array $V */

/** @var string $XML_DATA */
$start = microtime(true);
use Bitrix\Currency,
    Bitrix\Iblock,
    Bitrix\Catalog,
	Bitrix\Highloadblock as HL;

IncludeModuleLangFile($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/catalog/export_yandex.php');
set_time_limit(0);

global $USER, $APPLICATION;

$logfile = $_SERVER['DOCUMENT_ROOT']."/log/retailRocket.log";
$fpl = fopen($logfile, 'w+');
fwrite($fpl, $_SERVER['DOCUMENT_ROOT']);
if (!function_exists("yandex_replace_special")) {
    function yandex_replace_special($arg)
    {
        if (in_array($arg[0], array("&quot;", "&amp;", "&lt;", "&gt;")))
            return $arg[0];
        else
            return " ";
    }
}

if (!function_exists("yandex_text2xml")) {
    function yandex_text2xml($text, $bHSC = false, $bDblQuote = false)
    {
        global $APPLICATION;

        $bHSC = (true == $bHSC ? true : false);
        $bDblQuote = (true == $bDblQuote ? true : false);

        if ($bHSC) {
            $text = htmlspecialcharsbx($text);
            if ($bDblQuote)
                $text = str_replace('&quot;', '"', $text);
        }
        $text = preg_replace("/[\x1-\x8\xB-\xC\xE-\x1F]/", "", $text);
        $text = str_replace("'", "&apos;", $text);
        $text = $APPLICATION->ConvertCharset($text, LANG_CHARSET, 'windows-1251');
        return $text;
    }
}

if (!function_exists('yandex_get_value'))
{
    function yandex_get_value($arOfferItemProp, $param, $PROPERTY, $arUserTypeFormat, $usedProtocol)
    {//$arProperties
        //$arProperty = $arOffer['PROPERTIES'][$prop_id];
        global $iblockServerName;
        $logfile = $_SERVER['DOCUMENT_ROOT'] . "/log/retailRocket.log";
        $fpl = fopen($logfile, 'a+');

	fwrite($fpl, var_export($arOfferItemProp, true));

        $arProperty = $arOfferItemProp;
        $strProperty = '';
        $bParam = (strncmp($param, 'PARAM_', 6) == 0);

            $value = '';
            $description = '';
            switch ($arOfferItemProp['PROPERTY_TYPE'])
            {
                case 'USER_TYPE':
                    if ($arProperty['MULTIPLE'] == 'Y')
                    {
                        if (!empty($arProperty['~VALUE']))
                        {
                            $arValues = array();
                            foreach($arProperty["~VALUE"] as $oneValue)
                            {
                                $isArray = is_array($oneValue);
                                if (
                                    ($isArray && !empty($oneValue))
                                    || (!$isArray && $oneValue != '')
                                )
                                {
                                    $arValues[] = call_user_func_array($arUserTypeFormat[$PROPERTY],
                                        array(
                                            $arProperty,
                                            array("VALUE" => $oneValue),
                                            array('MODE' => 'SIMPLE_TEXT'),
                                        )
                                    );
                                }
                            }
                            $value = implode(', ', $arValues);
                        }
                    }
                    else
                    {
                        $isArray = is_array($arProperty['~VALUE']);
                        if (
                            ($isArray && !empty($arProperty['~VALUE']))
                            || (!$isArray && $arProperty['~VALUE'] != '')
                        )
                        {
                            $value = call_user_func_array($arUserTypeFormat[$PROPERTY],
                                array(
                                    $arProperty,
                                    array("VALUE" => $arProperty["~VALUE"]),
                                    array('MODE' => 'SIMPLE_TEXT'),
                                )
                            );
                        }
                    }
                    break;
                case Iblock\PropertyTable::TYPE_ELEMENT:
                    if (!empty($arProperty['VALUE']))
                    {
                        $arCheckValue = array();
                        if (!is_array($arProperty['VALUE']))
                        {
                            $arProperty['VALUE'] = (int)$arProperty['VALUE'];
                            if (0 < $arProperty['VALUE'])
                                $arCheckValue[] = $arProperty['VALUE'];
                        }
                        else
                        {
                            foreach ($arProperty['VALUE'] as &$intValue)
                            {
                                $intValue = (int)$intValue;
                                if (0 < $intValue)
                                    $arCheckValue[] = $intValue;
                            }
                            if (isset($intValue))
                                unset($intValue);
                        }
                        if (!empty($arCheckValue))
                        {
                            $filter = array(
                                'ID' => $arCheckValue
                            );
                            $arProperty['LINK_IBLOCK_ID'] = (int)$arProperty['LINK_IBLOCK_ID'];
                            if ($arProperty['LINK_IBLOCK_ID'] > 0)
                                $filter['IBLOCK_ID'] = $arProperty['LINK_IBLOCK_ID'];
                            $dbRes = CIBlockElement::GetList(
                                array(),
                                $filter,
                                false,
                                false,
                                array('IBLOCK_ID', 'ID', 'NAME')
                            );
                            while ($arRes = $dbRes->Fetch())
                            {
                                $value .= ($value ? ', ' : '').$arRes['NAME'];
                            }
                        }
                    }
                    break;
                case Iblock\PropertyTable::TYPE_SECTION:
                    if (!empty($arProperty['VALUE']))
                    {
                        $arCheckValue = array();
                        if (!is_array($arProperty['VALUE']))
                        {
                            $arProperty['VALUE'] = (int)$arProperty['VALUE'];
                            if (0 < $arProperty['VALUE'])
                                $arCheckValue[] = $arProperty['VALUE'];
                        }
                        else
                        {
                            foreach ($arProperty['VALUE'] as &$intValue)
                            {
                                $intValue = (int)$intValue;
                                if (0 < $intValue)
                                    $arCheckValue[] = $intValue;
                            }
                            if (isset($intValue))
                                unset($intValue);
                        }
                        if (!empty($arCheckValue))
                        {
                            $filter = array(
                                'ID' => $arCheckValue
                            );
                            $arProperty['LINK_IBLOCK_ID'] = (int)$arProperty['LINK_IBLOCK_ID'];
                            if ($arProperty['LINK_IBLOCK_ID'] > 0)
                                $filter['IBLOCK_ID'] = $arProperty['LINK_IBLOCK_ID'];
                            $dbRes = CIBlockSection::GetList(
                                array(),
                                $filter,
                                false,
                                array('ID', 'NAME')
                            );
                            while ($arRes = $dbRes->Fetch())
                            {
                                $value .= ($value ? ', ' : '').$arRes['NAME'];
                            }
                        }
                    }
                    break;
                case Iblock\PropertyTable::TYPE_LIST:
                    if (!empty($arProperty['VALUE']))
                    {
                        if (is_array($arProperty['VALUE']))
                            $value .= implode(', ', $arProperty['VALUE']);
                        else
                            $value .= $arProperty['VALUE'];
                    }
                    break;
                case Iblock\PropertyTable::TYPE_FILE:
                    if (!empty($arProperty['VALUE']))
                    {
                        if (is_array($arProperty['VALUE']))
                        {
                            foreach ($arProperty['VALUE'] as &$intValue)
                            {
                                $intValue = (int)$intValue;
                                if ($intValue > 0)
                                {
                                    if ($ar_file = CFile::GetFileArray($intValue))
                                    {
                                        if(substr($ar_file["SRC"], 0, 1) == "/")
                                            $strFile = $usedProtocol.$iblockServerName.CHTTP::urnEncode($ar_file['SRC'], 'utf-8');
                                        else
                                            $strFile = $ar_file["SRC"];
                                        $value .= ($value ? ', ' : '').$strFile;
                                    }
                                }
                            }
                            if (isset($intValue))
                                unset($intValue);
                        }
                        else
                        {
                            $arProperty['VALUE'] = (int)$arProperty['VALUE'];
                            if ($arProperty['VALUE'] > 0)
                            {
                                if ($ar_file = CFile::GetFileArray($arProperty['VALUE']))
                                {
                                    if(substr($ar_file["SRC"], 0, 1) == "/")
                                        $strFile = $usedProtocol.$iblockServerName.CHTTP::urnEncode($ar_file['SRC'], 'utf-8');
                                    else
                                        $strFile = $ar_file["SRC"];
                                    $value = $strFile;
                                }
                            }
                        }
                    }
                    break;
                default:
                    if ($bParam && $arProperty['WITH_DESCRIPTION'] == 'Y')
                    {
                        $description = $arProperty['DESCRIPTION'];
                        $value = $arProperty['VALUE'];
                    }
                    else
                    {
                        $value = is_array($arProperty['VALUE']) ? implode(', ', $arProperty['VALUE']) : $arProperty['VALUE'];
                    }
            }

            // !!!! check multiple properties and properties like CML2_ATTRIBUTES

            if ($bParam)
            {
                if (is_array($description))
                {
                    foreach ($value as $key => $val)
                    {
                        $strProperty .= $strProperty ? "\n" : "";
                        $strProperty .= '<param name="'.yandex_text2xml($description[$key], true).'">'.
                            yandex_text2xml($val, true).'</param>';
                    }
                }
                else
                {
                    $strProperty .= '<param name="'.yandex_text2xml($arProperty['NAME'], true).'">'.
                        yandex_text2xml($value, true).'</param>';
                }
            }
            else
            {
                $param_h = yandex_text2xml($param, true);
                $strProperty .= '<'.$param_h.'>'.yandex_text2xml($value, true).'</'.$param_h.'>';
            }
	fwrite($fpl, '--------------------------strProperty--------------------'."\n");
	fwrite($fpl, var_export($strProperty, true));

        return $strProperty;
    }
}


$res = CIBlockElement::GetList(Array("NAME" => "ASC"), Array("IBLOCK_ID"=>21, "ACTIVE"=>"Y", "!PROPERTY_DOMAIN"=>false), false, false, Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_RATIO", "PROPERTY_FACTOR", "PROPERTY_DELIVERY_COST"));
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();
    $arCity[$arFields["ID"]] = $arFields["NAME"];
    $arRatio[$arFields["ID"]] = $arProps["ratio"]["VALUE"];
    $arFactor[$arFields["ID"]] = $arProps["factor"]["VALUE"];
    $arDelivery_cost[$arFields["ID"]] = $arProps["delivery_cost"]["VALUE"];
    $arDomain[$arFields["ID"]] = $arProps["DOMAIN"]["VALUE"];
}

$arRunErrors = array();

if ($XML_DATA && CheckSerializedData($XML_DATA)) {
    $XML_DATA = unserialize(stripslashes($XML_DATA));
    if (!is_array($XML_DATA)) $XML_DATA = array();
}
if (!is_array($XML_DATA))
    $arRunErrors[] = GetMessage('YANDEX_ERR_BAD_XML_DATA');

$yandexFormat = 'none';
if (isset($XML_DATA['TYPE']) && isset($formatList[$XML_DATA['TYPE']]))
    $yandexFormat = $XML_DATA['TYPE'];

$productFormat = ($yandexFormat != 'none' ? ' type="' . htmlspecialcharsbx($yandexFormat) . '"' : '');

$fields = array();
$parametricFields = array();
$fieldsExist = !empty($XML_DATA['XML_DATA']) && is_array($XML_DATA['XML_DATA']);
$parametricFieldsExist = false;
if ($fieldsExist) {
    foreach ($XML_DATA['XML_DATA'] as $key => $value) {
        if ($key == 'PARAMS')
            $parametricFieldsExist = (!empty($value) && is_array($value));
        if (is_array($value))
            continue;
        $value = (string)$value;
        if ($value == '')
            continue;
        $fields[$key] = $value;
    }
    unset($key, $value);
    $fieldsExist = !empty($fields);
}

if ($parametricFieldsExist)
    $parametricFields = $XML_DATA['XML_DATA']['PARAMS'];

$needProperties = !empty($XML_DATA['XML_DATA']) && is_array($XML_DATA['XML_DATA']);

$IBLOCK_ID = (int)$IBLOCK_ID;
$db_iblock = CIBlock::GetByID($IBLOCK_ID);
if (!($ar_iblock = $db_iblock->Fetch())) {
    $arRunErrors[] = str_replace('#ID#', $IBLOCK_ID, GetMessage('YANDEX_ERR_NO_IBLOCK_FOUND_EXT'));
} else {
    $SETUP_SERVER_NAME = trim($SETUP_SERVER_NAME);

    if (strlen($SETUP_SERVER_NAME) <= 0) {
        if (strlen($ar_iblock['SERVER_NAME']) <= 0) {
            $b = "sort";
            $o = "asc";
            $rsSite = CSite::GetList($b, $o, array("LID" => $ar_iblock["LID"]));
            if ($arSite = $rsSite->Fetch())
                $ar_iblock["SERVER_NAME"] = $arSite["SERVER_NAME"];
            if (strlen($ar_iblock["SERVER_NAME"]) <= 0 && defined("SITE_SERVER_NAME"))
                $ar_iblock["SERVER_NAME"] = SITE_SERVER_NAME;
            if (strlen($ar_iblock["SERVER_NAME"]) <= 0)
                $ar_iblock["SERVER_NAME"] = COption::GetOptionString("main", "server_name", "");
        }
    } else {
        $ar_iblock['SERVER_NAME'] = $SETUP_SERVER_NAME;
    }
    $ar_iblock['PROPERTY'] = array();
    $rsProps = CIBlockProperty::GetList(
        array('SORT' => 'ASC', 'NAME' => 'ASC'),
        array('IBLOCK_ID' => $IBLOCK_ID, 'ACTIVE' => 'Y', 'CHECK_PERMISSIONS' => 'N')
    );
    while ($arProp = $rsProps->Fetch()) {
        $arProp['ID'] = (int)$arProp['ID'];
        $arProp['USER_TYPE'] = (string)$arProp['USER_TYPE'];
        $arProp['CODE'] = (string)$arProp['CODE'];
        $ar_iblock['PROPERTY'][$arProp['ID']] = $arProp;
    }
}

global $iblockServerName;
$iblockServerName = $ar_iblock["SERVER_NAME"];

$arProperties = array();
if (isset($ar_iblock['PROPERTY']))
    $arProperties = $ar_iblock['PROPERTY'];

$boolOffers = false;
$arOffers = false;
$arOfferIBlock = false;
$intOfferIBlockID = 0;
$arSelectOfferProps = array();

$arPropertyMap = array();
$arSKUExport = array();

$arOffers = CCatalogSku::GetInfoByProductIBlock($IBLOCK_ID);
$intOfferIBlockID = $arOffers['IBLOCK_ID'];

//$strExportErrorMessage = var_export($arOffers, true);

$bAllSections = false;
$arSections = array();
if (empty($arRunErrors))
{
    if (is_array($V))
    {
        foreach ($V as $key => $value)
        {
            if (trim($value)=="0")
            {
                $bAllSections = true;
                break;
            }
            $value = (int)$value;
            if ($value > 0)
            {
                $arSections[] = $value;
            }
        }
    }

    if (!$bAllSections && empty($arSections))
    {
        $arRunErrors[] = GetMessage('YANDEX_ERR_NO_SECTION_LIST');
    }
}










$usedProtocol = (isset($USE_HTTPS) && $USE_HTTPS == 'Y' ? 'https://' : 'http://');
$filterAvailable = (isset($FILTER_AVAILABLE) && $FILTER_AVAILABLE == 'Y');
$disableReferers = (isset($DISABLE_REFERERS) && $DISABLE_REFERERS == 'Y');

if (strlen($SETUP_FILE_NAME) <= 0) {
    $arRunErrors[] = GetMessage("CATI_NO_SAVE_FILE");
} elseif (preg_match(BX_CATALOG_FILENAME_REG, $SETUP_FILE_NAME)) {
    $arRunErrors[] = GetMessage("CES_ERROR_BAD_EXPORT_FILENAME");
} else {
    $SETUP_FILE_NAME = Rel2Abs("/", $SETUP_FILE_NAME);
}
if (empty($arRunErrors))
{
    CheckDirPath($_SERVER["DOCUMENT_ROOT"].$SETUP_FILE_NAME);

    if (!$fp = @fopen($_SERVER["DOCUMENT_ROOT"].$SETUP_FILE_NAME, "wb"))
    {
        $arRunErrors[] = str_replace('#FILE#', $_SERVER["DOCUMENT_ROOT"].$SETUP_FILE_NAME, GetMessage('YANDEX_ERR_FILE_OPEN_WRITING'));
    }
    else
    {
       /* if (!@fwrite($fp, '<? $disableReferers = '.($disableReferers ? 'true' : 'false').';'."\n"))
        {
            $arRunErrors[] = str_replace('#FILE#', $_SERVER["DOCUMENT_ROOT"].$SETUP_FILE_NAME, GetMessage('YANDEX_ERR_SETUP_FILE_WRITE'));
            @fclose($fp);
        }
        else
        {
            if (!$disableReferers)
            {
                fwrite($fp, 'if (!isset($_GET["referer1"]) || strlen($_GET["referer1"])<=0) $_GET["referer1"] = "yandext";'."\n");
                fwrite($fp, 'if (!isset($_GET["referer1"]) || strlen($_GET["referer1"])<=0) $_GET["referer1"] = "yandext";'."\n");
                fwrite($fp, '$strReferer1 = htmlspecialchars($_GET["referer1"]);'."\n");
                fwrite($fp, 'if (!isset($_GET["referer2"]) || strlen($_GET["referer2"]) <= 0) $_GET["referer2"] = "";'."\n");
                fwrite($fp, '$strReferer2 = htmlspecialchars($_GET["referer2"]);'."\n");
            }
        }*/
    }
}

if (empty($arRunErrors)){
    /** @noinspection PhpUndefinedVariableInspection */
    //fwrite($fp, 'header("Content-Type: text/xml; charset=windows-1251");'."\n");
    fwrite($fp, '<?xml version="1.0" encoding="windows-1251"?>'."\n");
    fwrite($fp, '<yml_catalog date="'.date("Y-m-d H:i").'">'."\n");
    fwrite($fp, '<shop>'."\n");

    fwrite($fp, '<name>'.$APPLICATION->ConvertCharset(htmlspecialcharsbx(COption::GetOptionString('main', 'site_name', '')), LANG_CHARSET, 'windows-1251')."</name>\n");

    fwrite($fp, '<company>'.$APPLICATION->ConvertCharset(htmlspecialcharsbx(COption::GetOptionString('main', 'site_name', '')), LANG_CHARSET, 'windows-1251')."</company>\n");
    fwrite($fp, '<url>'.$usedProtocol.htmlspecialcharsbx($ar_iblock['SERVER_NAME'])."</url>\n");
    fwrite($fp, '<platform>1C-Bitrix</platform>'."\n");

    $strTmp = '<currencies>'."\n";

    $RUR = 'RUB';
    $currencyIterator = Currency\CurrencyTable::getList(array(
        'select' => array('CURRENCY'),
        'filter' => array('=CURRENCY' => 'RUR')
    ));
    if ($currency = $currencyIterator->fetch())
        $RUR = 'RUR';
    unset($currency, $currencyIterator);

    $arCurrencyAllowed = array($RUR, 'USD', 'EUR', 'UAH', 'BYR', 'BYN', 'KZT');

    $BASE_CURRENCY = Currency\CurrencyManager::getBaseCurrency();
    if (is_array($XML_DATA['CURRENCY']))
    {
        foreach ($XML_DATA['CURRENCY'] as $CURRENCY => $arCurData)
        {
            if (in_array($CURRENCY, $arCurrencyAllowed))
            {
                $strTmp.= '<currency id="'.$CURRENCY.'"'
                    .' rate="'.($arCurData['rate'] == 'SITE' ? CCurrencyRates::ConvertCurrency(1, $CURRENCY, $RUR) : $arCurData['rate']).'"'
                    .($arCurData['plus'] > 0 ? ' plus="'.(int)$arCurData['plus'].'"' : '')
                    ." />\n";
            }
        }
        unset($CURRENCY, $arCurData);
    }

    $strTmp .= "</currencies>\n";

    fwrite($fp, $strTmp);
    unset($strTmp);

    //*****************************************//


    //*****************************************//

    $intMaxSectionID = 0;

    $strTmpCat = '';
    $strTmpOff = '';

    $arSectionIDs = array();
    $arAvailGroups = array();


    if (!$bAllSections)
    {
        for ($i = 0, $intSectionsCount = count($arSections); $i < $intSectionsCount; $i++)
        {
            $sectionIterator = CIBlockSection::GetNavChain($IBLOCK_ID, $arSections[$i], array('ID', 'IBLOCK_SECTION_ID', 'NAME', 'LEFT_MARGIN', 'RIGHT_MARGIN'));
            $curLEFT_MARGIN = 0;
            $curRIGHT_MARGIN = 0;
            while ($section = $sectionIterator->Fetch())
            {
                $section['ID'] = (int)$section['ID'];
                $section['IBLOCK_SECTION_ID'] = (int)$section['IBLOCK_SECTION_ID'];
                if ($arSections[$i] == $section['ID'])
                {
                    $curLEFT_MARGIN = (int)$section['LEFT_MARGIN'];
                    $curRIGHT_MARGIN = (int)$section['RIGHT_MARGIN'];
                    $arSectionIDs[] = $section['ID'];
                }
                $arAvailGroups[$section['ID']] = array(
                    'ID' => $section['ID'],
                    'IBLOCK_SECTION_ID' => $section['IBLOCK_SECTION_ID'],
                    'NAME' => $section['NAME']
                );
                if ($intMaxSectionID < $section['ID'])
                    $intMaxSectionID = $section['ID'];
            }
            unset($section, $sectionIterator);

            $filter = array("IBLOCK_ID"=>$IBLOCK_ID, ">LEFT_MARGIN"=>$curLEFT_MARGIN, "<RIGHT_MARGIN"=>$curRIGHT_MARGIN, "ACTIVE"=>"Y", "IBLOCK_ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y");
            $sectionIterator = CIBlockSection::GetList(array("LEFT_MARGIN"=>"ASC"), $filter, false, array('ID', 'IBLOCK_SECTION_ID', 'NAME'));
            while ($section = $sectionIterator->Fetch())
            {
                $section["ID"] = (int)$section["ID"];
                $section["IBLOCK_SECTION_ID"] = (int)$section["IBLOCK_SECTION_ID"];
                $arSectionIDs[] = $section["ID"];
                $arAvailGroups[$section["ID"]] = $section;
                if ($intMaxSectionID < $section["ID"])
                    $intMaxSectionID = $section["ID"];
            }
            unset($section, $sectionIterator);
        }
        if (!empty($arSectionIDs))
            $arSectionIDs = array_unique($arSectionIDs);
    }
    else
    {
        $filter = array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE"=>"Y", "IBLOCK_ACTIVE"=>"Y", "GLOBAL_ACTIVE"=>"Y");
        $sectionIterator = CIBlockSection::GetList(array("LEFT_MARGIN"=>"ASC"), $filter, false, array('ID', 'IBLOCK_SECTION_ID', 'NAME'));
        while ($section = $sectionIterator->Fetch())
        {
            $section["ID"] = (int)$section["ID"];
            $section["IBLOCK_SECTION_ID"] = (int)$section["IBLOCK_SECTION_ID"];
            $arAvailGroups[$section["ID"]] = $section;
            if ($intMaxSectionID < $section["ID"])
                $intMaxSectionID = $section["ID"];
        }
        unset($section, $sectionIterator);

        if (!empty($arAvailGroups))
            $arSectionIDs = array_keys($arAvailGroups);
    }
$arMetallSection = array(20);
    foreach ($arAvailGroups as &$value)
    {
        $strTmpCat.= '<category id="'.$value['ID'].'"'.($value['IBLOCK_SECTION_ID'] > 0 ? ' parentId="'.$value['IBLOCK_SECTION_ID'].'"' : '').'>'.yandex_text2xml($value['NAME'], true).'</category>'."\n";
        if (in_array($value["IBLOCK_SECTION_ID"], $arMetallSection)){
            array_push($arMetallSection, $value["ID"]);
        }
    }
    if (isset($value))
        unset($value);

    $intMaxSectionID += 100000000;

    //*****************************************//
    $boolNeedRootSection = false;

    $arOfferSelect = array(
        "ID", "LID", "IBLOCK_ID", "NAME",
        "PREVIEW_PICTURE", "PREVIEW_TEXT", "PREVIEW_TEXT_TYPE", "DETAIL_PICTURE", "DETAIL_PAGE_URL",
        "CATALOG_AVAILABLE", "CATALOG_TYPE", "MORE_PHOTO"
    );
    $arOfferFilter = array('IBLOCK_ID' => $intOfferIBlockID, '=PROPERTY_'.$arOffers['SKU_PROPERTY_ID'] => 0, "ACTIVE" => "Y", "ACTIVE_DATE" => "Y");
    $arSelect = array(
        "ID", "LID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME",
        "PREVIEW_PICTURE", "PREVIEW_TEXT", "PREVIEW_TEXT_TYPE", "DETAIL_PICTURE", "DETAIL_PAGE_URL",
        "CATALOG_AVAILABLE", "CATALOG_TYPE"//, "PROPERTY_DISPLAY_CITIES", "PROPERTY_NOFACTOR"
    );
    $arFilter = array("IBLOCK_ID" => $IBLOCK_ID);
    if (!$bAllSections && !empty($arSectionIDs))
    {
        $arFilter["INCLUDE_SUBSECTIONS"] = "Y";
        $arFilter["SECTION_ID"] = $arSectionIDs;
    }
    $arFilter["ACTIVE"] = "Y";
    //$arFilter["ACTIVE_DATE"] = "Y";
    //if ($filterAvailable)
        //$arFilter['CATALOG_AVAILABLE'] = 'Y';
    $cnt = 0;
    $ocnt = 0;

    $rsItems = CIBlockElement::GetList(array('ID' => 'ASC'), $arFilter, false, false, $arSelect);

    while ($obItem = $rsItems->GetNextElement()){
        $cnt++;
        $arCross = array();
        $arItem = $obItem->GetFields();

        $arItem['PROPERTIES'] = $obItem->GetProperties();

        /*if (!empty($arItem['PROPERTIES']))
        {
            foreach ($arItem['PROPERTIES'] as &$arProp)
            {
                $arCross[$arProp['ID']] = $arProp;
            }
            if (isset($arProp))
                unset($arProp);
            $arItem['PROPERTIES'] = $arCross;
        }*/
        $boolItemExport = false;
        $boolItemOffers = false;
        $arItem['OFFERS'] = array();

        $boolCurrentSections = false;
        $boolNoActiveSections = true;
        $strSections = '';
        $rsSections = CIBlockElement::GetElementGroups($arItem["ID"], false, array('ID', 'ADDITIONAL_PROPERTY_ID'));
        while ($arSection = $rsSections->Fetch()){
            if (0 < (int)$arSection['ADDITIONAL_PROPERTY_ID'])
                continue;
            $arSection['ID'] = (int)$arSection['ID'];
            $boolCurrentSections = true;
            if (in_array($arSection['ID'], $arSectionIDs))
            {
                $strSections .= "<categoryId>".$arSection["ID"]."</categoryId>\n";
                $boolNoActiveSections = false;
                if (in_array($arSection["ID"], $arMetallSection)){
                    $metallFlag = true;
                }else{
                    $metallFlag = false;
                }
            }
        }
        if (!$boolCurrentSections)
        {
            $boolNeedRootSection = true;
            $strSections .= "<categoryId>".$intMaxSectionID."</categoryId>\n";
        }
        else
        {
            if ($boolNoActiveSections)
                continue;
        }


        $arItem['YANDEX_CATEGORY'] = $strSections;

        $strFile = '';
        $arItem["DETAIL_PICTURE"] = (int)$arItem["DETAIL_PICTURE"];
        $arItem["PREVIEW_PICTURE"] = (int)$arItem["PREVIEW_PICTURE"];
        if ($arItem["DETAIL_PICTURE"] > 0 || $arItem["PREVIEW_PICTURE"] > 0)
        {
            $pictNo = ($arItem["DETAIL_PICTURE"] > 0 ? $arItem["DETAIL_PICTURE"] : $arItem["PREVIEW_PICTURE"]);

            if ($ar_file = CFile::GetFileArray($pictNo))
            {
                if(substr($ar_file["SRC"], 0, 1) == "/")
                    $strFile = $usedProtocol.$ar_iblock['SERVER_NAME'].CHTTP::urnEncode($ar_file['SRC'], 'utf-8');
                else
                    $strFile = $ar_file["SRC"];
            }
        }
        $arItem['YANDEX_PICT'] = $strFile;

        $arItem['YANDEX_DESCR'] = yandex_text2xml(TruncateText(
            ($arItem["PREVIEW_TEXT_TYPE"]=="html"?
                strip_tags(preg_replace_callback("'&[^;]*;'", "yandex_replace_special", $arItem["~PREVIEW_TEXT"])) : preg_replace_callback("'&[^;]*;'", "yandex_replace_special", $arItem["~PREVIEW_TEXT"])),
            3000), true);



        $arOfferFilter['=PROPERTY_'.$arOffers['SKU_PROPERTY_ID']] = $arItem['ID'];
        fwrite($fpl, "\n==============================================================================================================\n");
        fwrite($fpl, var_export($arOfferFilter, true));
        fwrite($fpl, var_export($arOfferSelect, true));
        fwrite($fpl, var_export($XML_DATA, true));
        $rsOfferItems = CIBlockElement::GetList(array('CATALOG_PRICE_1' => 'ASC'), $arOfferFilter, false, false, $arOfferSelect);
        //$strExportErrorMessage = var_export($arOfferFilter, true);

        $arCurrentOffer = false;
        $arCurrentPrice = false;
        $dblAllMinPrice = 0;
        $boolFirst = true;
        while ($obOfferItem = $rsOfferItems->GetNextElement()){
            $arOfferItem = $obOfferItem->GetFields();
            //fwrite($fpl, "\n------------------------------------------------------------------------------------------------------\n");
            //fwrite($fpl, var_export($arOfferItem, true));
            //fwrite($fpl, "\n------------------------------------------------------------------------------------------------------\n");
            $fullPrice = 0;
            $minPrice = 0;

            $minPriceRUR = 0;
            $minPriceCurrency = '';
            $minPriceGroup = 0;


            if ($XML_DATA['PRICE'] > 0)
            {
                $rsPrices = CPrice::GetListEx(array(), array(
                        'PRODUCT_ID' => $arOfferItem['ID'],
                        'CATALOG_GROUP_ID' => $XML_DATA['PRICE'],
                        'CAN_BUY' => 'Y',
                        'GROUP_GROUP_ID' => array(2),
                        '+<=QUANTITY_FROM' => 1,
                        '+>=QUANTITY_TO' => 1,
                    )
                );
                if ($arPrice = $rsPrices->Fetch())
                {
                    if ($arOptimalPrice = CCatalogProduct::GetOptimalPrice(
                        $arOfferItem['ID'],
                        1,
                        array(2),
                        'N',
                        array($arPrice),
                        $arOfferIBlock['LID'],
                        array()
                    )
                    )
                    {
                        $minPrice = $arOptimalPrice['RESULT_PRICE']['DISCOUNT_PRICE'];
                        $fullPrice = $arOptimalPrice['RESULT_PRICE']['BASE_PRICE'];
                        $minPriceCurrency = $arOptimalPrice['RESULT_PRICE']['CURRENCY'];
                        $arOfferPrice[$arOfferItem["ID"]] = array("minPrice" => $minPrice, "fullPrice" => $fullPrice);
                        if ($minPriceCurrency == $RUR)
                            $minPriceRUR = $minPrice;
                        else
                            $minPriceRUR = CCurrencyRates::ConvertCurrency($minPrice, $minPriceCurrency, $RUR);
                        $minPriceGroup = $arOptimalPrice['PRICE']['CATALOG_GROUP_ID'];
                    }
                }
            }
            else
            {
                if ($arPrice = CCatalogProduct::GetOptimalPrice(
                    $arOfferItem['ID'],
                    1,
                    array(2), // anonymous
                    'N',
                    array(),
                    $arOfferIBlock['LID'],
                    array()
                )
                )

                {
                    $minPrice = $arPrice['RESULT_PRICE']['DISCOUNT_PRICE'];
                    $fullPrice = $arPrice['RESULT_PRICE']['BASE_PRICE'];

                    $minPriceCurrency = $arPrice['RESULT_PRICE']['CURRENCY'];
                    if ($minPriceCurrency == $RUR)
                        $minPriceRUR = $minPrice;
                    else
                        $minPriceRUR = CCurrencyRates::ConvertCurrency($minPrice, $minPriceCurrency, $RUR);
                    $minPriceGroup = $arPrice['PRICE']['CATALOG_GROUP_ID'];
                }
            }
            if ($minPrice <= 0)
                continue;

            if ($boolFirst)
            {
                $dblAllMinPrice = $minPriceRUR;
                $arCross = (!empty($arItem['PROPERTIES']) ? $arItem['PROPERTIES'] : array());
                $arOfferItem['PROPERTIES'] = $obOfferItem->GetProperties();
                $arCurrentOfferProp = $arOfferItem['PROPERTIES'];
                /*
                if (!empty($arOfferItem['PROPERTIES']))
                {
                    foreach ($arOfferItem['PROPERTIES'] as $arProp)
                    {
                        $arCross[$arProp['ID']] = $arProp;
                    }
                }
                $arOfferItem['PROPERTIES'] = $arCross;
                */
                $arCurrentOffer = $arOfferItem;

                $arCurrentPrice = array(
                    'FULL_PRICE' => $fullPrice,
                    'MIN_PRICE' => $minPrice,
                    'MIN_PRICE_CURRENCY' => $minPriceCurrency,
                    'MIN_PRICE_RUR' => $minPriceRUR,
                    'MIN_PRICE_GROUP' => $minPriceGroup,
                );
                $boolFirst = false;
            }
            else
            {
                if ($dblAllMinPrice > $minPriceRUR)
                {
                    $dblAllMinPrice = $minPriceRUR;
                    $arCross = (!empty($arItem['PROPERTIES']) ? $arItem['PROPERTIES'] : array());
                    $arOfferItem['PROPERTIES'] = $obOfferItem->GetProperties();
                    $arCurrentOfferProp = $arOfferItem['PROPERTIES'];
                    if (!empty($arOfferItem['PROPERTIES']))
                    {
                        foreach ($arOfferItem['PROPERTIES'] as $arProp)
                        {
                            $arCross[$arProp['ID']] = $arProp;
                        }
                    }
                    $arOfferItem['PROPERTIES'] = $arCross;

                    $arCurrentOffer = $arOfferItem;
                    $arCurrentPrice = array(
                        'FULL_PRICE' => $fullPrice,
                        'MIN_PRICE' => $minPrice,
                        'MIN_PRICE_CURRENCY' => $minPriceCurrency,
                        'MIN_PRICE_RUR' => $minPriceRUR,
                        'MIN_PRICE_GROUP' => $minPriceGroup,
                    );
                }
            }

        }

        $res = CCatalogStore::GetList(
            array('PRODUCT_ID'=>'ASC','ID' => 'ASC'),
            array('PRODUCT_ID'=>array_keys($arOfferPrice), ">ELEMENT_ID" => false, "!PRODUCT_AMOUNT" => false, "!UF_STORE_CITY" => false),
            false,
            false,
            array("ID","TITLE","PRODUCT_AMOUNT","ELEMENT_ID", "UF_STORE_CITY")
        );

        while($itemStores = $res->GetNext()){
            if (!intval($itemStores["PRODUCT_AMOUNT"]))
                continue;
            //$arItemStore[$itemStores["ELEMENT_ID"]][$itemStores["ID"]] = intval($itemStores["PRODUCT_AMOUNT"]);
            $arItemStore[$itemStores["UF_STORE_CITY"]] = intval($itemStores["PRODUCT_AMOUNT"]);
        }
fwrite($fpl, "\n---------arItemStore-------------------\n");
fwrite($fpl, var_export($arItemStore, true));
fwrite($fpl, "\n---arOfferPrice-------------------------\n");
fwrite($fpl, var_export($arOfferPrice, true));
fwrite($fpl, "\n----------------------------\n");

        if (!empty($arCurrentOffer) && !empty($arCurrentPrice)){

            $arOfferItem = $arCurrentOffer;
            $arOfferProp = $arCurrentOfferProp;

            $fullPrice = $arCurrentPrice['FULL_PRICE'];
            $minPrice = $arCurrentPrice['MIN_PRICE'];
            $minPriceCurrency = $arCurrentPrice['MIN_PRICE_CURRENCY'];
            $minPriceRUR = $arCurrentPrice['MIN_PRICE_RUR'];
            $minPriceGroup = $arCurrentPrice['MIN_PRICE_GROUP'];
		$oldPrice = $arItem["PROPERTIES"]["MINIMUM_OLD_PRICE"]["VALUE"];

            //$arOfferItem['YANDEX_AVAILABLE'] = ($arOfferItem['CATALOG_AVAILABLE'] == 'Y' ? 'true' : 'false'); // для яндекс-маркета. для retailRocket нужен false;
            $arOfferItem['YANDEX_AVAILABLE'] = 'false';

            if (strlen($arOfferItem['DETAIL_PAGE_URL']) <= 0)
                $arOfferItem['DETAIL_PAGE_URL'] = '/';
            else
                $arOfferItem['DETAIL_PAGE_URL'] = str_replace(' ', '%20', $arOfferItem['DETAIL_PAGE_URL']);

            $strOfferYandex = '';
            $strOfferYandex .= '<offer id="'.$arItem["ID"].'"'.$productFormat.' available="'.$arOfferItem['YANDEX_AVAILABLE'].'">'."\n";


            $referer = '';
            if (!$disableReferers)
                $referer = (strpos($arOfferItem['DETAIL_PAGE_URL'], '?') === false ? '?' : '&amp;').'r1=<?=$strReferer1; ?>&amp;r2=<?=$strReferer2; ?>';

            $strOfferYandex .= "<url>".$usedProtocol.$ar_iblock['SERVER_NAME'].htmlspecialcharsbx($arOfferItem["~DETAIL_PAGE_URL"]).$referer."</url>\n";

            $strOfferYandex .= "<price>".$minPrice."</price>\n";
            if ($oldPrice && $minPrice != $oldPrice)
                $strOfferYandex .= "<oldprice>".$oldPrice."</oldprice>\n";
            $strOfferYandex .= "<currencyId>".$minPriceCurrency."</currencyId>\n";

            $strOfferYandex .= $arItem['YANDEX_CATEGORY'];

            $strFile = '';
            $arOfferItem["DETAIL_PICTURE"] = (int)$arOfferItem["DETAIL_PICTURE"];
            $arOfferItem["PREVIEW_PICTURE"] = (int)$arOfferItem["PREVIEW_PICTURE"];
            if ($arOfferItem["DETAIL_PICTURE"] > 0 || $arOfferItem["PREVIEW_PICTURE"] > 0 || count($arOfferProp["MORE_PHOTO"]["VALUE"])> 0)
            {
                //$pictNo = ($arOfferItem["DETAIL_PICTURE"] > 0 ? $arOfferItem["DETAIL_PICTURE"] : $arOfferItem["PREVIEW_PICTURE"]);
                if ($arOfferItem["DETAIL_PICTURE"] > 0){
                   $pictNo =  $arOfferItem["DETAIL_PICTURE"];
                }elseif (count($arOfferProp["MORE_PHOTO"]["VALUE"]) > 0){
                    $pictNo = current($arOfferProp["MORE_PHOTO"]["VALUE"]);
                }else{
                    $pictNo = $arOfferItem["PREVIEW_PICTURE"];
                }

                if ($ar_file = CFile::GetFileArray($pictNo))
                {
                    if (substr($ar_file["SRC"], 0, 1) == "/")
                        $strFile = $usedProtocol.$ar_iblock['SERVER_NAME'].CHTTP::urnEncode($ar_file['SRC'], 'utf-8');
                    else
                        $strFile = $ar_file["SRC"];
                }
            }


            if (!empty($strFile) || !empty($arItem['YANDEX_PICT']))
            {
                $strOfferYandex .= "<picture>".(!empty($strFile) ? $strFile : $arItem['YANDEX_PICT'])."</picture>\n";
            }

            $strOfferYandex .= "<name>".yandex_text2xml($arItem["~NAME"], true)."</name>\n";
            $strOfferYandex .= "<description>".$arItem['YANDEX_DESCR']."</description>\n";

            $strStock = "";
            $nnn++;

                if ($nnn< 10) {
                    fwrite($fpl, "\n---------arItem['PROPERTIES']-------------------\n");
                    fwrite($fpl, var_export($arItem, true));
                    fwrite($fpl, "\n---------arItem['PROPERTIES']-------------------\n");
                }


            foreach ($arCity as $cityId => $cityName){
                $strStockTmp = "";
                $strStock .= '<stock id="'.$cityId.'">'."\n";
//DISPLAY_CITIES 176
//NOFACTOR      299
//указан один город, два или ни одного
//галочка не перещитывать цены


               if ((!$arItem['PROPERTIES']['DISPLAY_CITIES']["VALUE"] or in_array($cityId, $arItem['PROPERTIES']['DISPLAY_CITIES']["VALUE"])) && !$arItem['PROPERTIES']['NORETAILROCKET']["VALUE"] && $arItemStore[$cityId]) {
                   $available = "\t<available>true</available>\n";
               }else {
                   $available = "\t<available>false</available>\n";
               }
                    if ($arItem['PROPERTIES']['NOFACTOR']["VALUE"] && $arItem['PROPERTIES']['NOFACTOR']["VALUE"] == "Y"){//не пересчитывать цены!
                        $newPrice = $minPrice;
                        $ratio = 1;
                        $factor = 1;
                        $index = 1;

                    }else{//цены надо пересчитать!
                        $ratio = $arRatio[$cityId]?$arRatio[$cityId]:1;
                        $factor = $arFactor[$cityId]?$arFactor[$cityId]:$ratio;
                        if ($metallFlag){
                            $index = $factor;
                        }else{
                            $index = $ratio;
                        }
                    }
                   $newPrice = round($minPrice*$index);
                    $strStockTmp .= "\t<price>$newPrice</price>\n";
		if ($arItem["PROPERTIES"]["MINIMUM_OLD_PRICE"]["VALUE"] && $minPrice  != $arItem["PROPERTIES"]["MINIMUM_OLD_PRICE"]["VALUE"])
                        $strStockTmp .= "\t<oldprice>".round($arItem["PROPERTIES"]["MINIMUM_OLD_PRICE"]["VALUE"]*$index)."</oldprice>\n";

                    $strStockTmp .= "\t<url>".$usedProtocol.$arDomain[$cityId].".".$ar_iblock['SERVER_NAME'].htmlspecialcharsbx($arOfferItem["~DETAIL_PAGE_URL"]).$referer."</url>\n";

                $strStock .= $available.$strStockTmp."</stock>\n";
            }

            $strOfferYandex .= $strStock;

            if ($parametricFieldsExist){
				\Bitrix\Main\Loader::includeModule('highloadblock');

				$hlblock = HL\HighloadBlockTable::getById(3)->fetch();
				$entity = HL\HighloadBlockTable::compileEntity($hlblock);
				$eshopPatternReferenceTable = $entity->getDataClass();

                 $arOfferItemProperties = array();
                 foreach ($arOfferItem['PROPERTIES'] as $keyProp => $itemProp) {
                       $arOfferItemProperties[$itemProp['ID']] = $itemProp;
                 }

				$arItmPropertiesId = array();
				foreach ($arItem['PROPERTIES'] as $keyProp => $itemProp) {
					$arItmPropertiesId[$itemProp['ID']] = $itemProp;
				}
				$arParams = $arOfferItemProperties + $arItmPropertiesId;
                fwrite($fpl, '-------------arParams--------');
                fwrite($fpl, var_export($arParams, true));

                foreach ($parametricFields as $paramKey => $prop_id){
                    $strParamValue = '';

					if($prop_id == 53 || $prop_id == 51) { //newproduct or saleleader
						$arParams[$prop_id]["VALUE"] = !empty($arParams[$prop_id]['VALUE']) ? 'true' : 'false';
					}
					if($prop_id == 57) { //ARTNUMBER
						$result = $eshopPatternReferenceTable::getList(array(
							'select' => array('UF_XML_ID', 'UF_FILE'),
							'filter' => array(
								'UF_XML_ID' => $arParams[$prop_id]["VALUE"]
							)
						));
						while ($arRow = $result->fetchRaw()) {
							//$arCounts[$arRow['UF_XML_ID']] = json_decode($arRow['UF_BALANCE'], true);
							fwrite($fpl, '--------------PatternReference-----------------'."\n");
							fwrite($fpl, var_export($arRow, true));
							$pathImgOffer = $_SERVER['SERVER_NAME'] . CFile::GetPath($arRow['UF_FILE']);
							fwrite($fpl, var_export($pathImgOffer, true));
						}
						unset($arParams[$prop_id]); // артикул для вывода в фид не нужен (удаляем)
					}

					fwrite($fpl, var_export(isset($arParams[$prop_id]["VALUE"]), true));

                  	if (isset($arParams[$prop_id]["VALUE"]) && !empty($arParams[$prop_id]["VALUE"])){
                        $arOfferItemProp = $arParams[$prop_id];

                        $strParamValue = yandex_get_value($arOfferItemProp, 'PARAM_'.$paramKey, $prop_id, $arUserTypeFormat, $usedProtocol);
                    }
                    if ('' != $strParamValue)
                        $strOfferYandex .= $strParamValue."\n";
                }
				$strOfferYandex .= '<param name="color">'.$pathImgOffer.'</param>';
                unset($paramKey, $prop_id);
            }









            $strOfferYandex .= "</offer>\n";
            $arItem['OFFERS'][] = $strOfferYandex;
            $boolItemOffers = true;
            $boolItemExport = true;

        }



        if (!$boolItemExport)
            continue;
        foreach ($arItem['OFFERS'] as $strOfferItem)
        {
            $strTmpOff .= $strOfferItem;
        }

        unset($arOfferPrice);unset($arItemStore);
    }


/*

    $strExportErrorMessage .= var_export($arOfferFilter, true);$strExportErrorMessage .= "<br>===========================================<br>";
    $strExportErrorMessage .= var_export($arFilter, true); $strExportErrorMessage .= "<br>===========================================<br>";
    $strExportErrorMessage .= var_export($arSelect, true);$strExportErrorMessage .= "<br>===========================================<br>";
    $strExportErrorMessage .= var_export($XML_DATA, true);$strExportErrorMessage .= "<br>===========================================<br>";
    $strExportErrorMessage .= var_export("cnt: ".$cnt, true);$strExportErrorMessage .= "<br>===========================================<br>";
    $strExportErrorMessage .= var_export("ocnt: ".$ocnt, true);$strExportErrorMessage .= "<br>===========================================<br>";

*/

    fwrite($fp, "<categories>\n");
    fwrite($fp, $strTmpCat);
    fwrite($fp, "</categories>\n");

    fwrite($fp, "<offers>\n");
    fwrite($fp, $strTmpOff);
    fwrite($fp, "</offers>\n");

    fwrite($fp, "</shop>\n");
    fwrite($fp, "</yml_catalog>\n");

    fclose($fp);
}
if (!empty($arRunErrors))
    $strExportErrorMessage = implode('<br />',$arRunErrors);

if ($bTmpUserCreated)
{
    unset($USER);
    if (isset($USER_TMP))
    {
        $USER = $USER_TMP;
        unset($USER_TMP);
    }
}


