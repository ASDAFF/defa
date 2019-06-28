<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock")) return;

if(!defined("WIZARD_SITE_ID")) return;
if(!defined("WIZARD_SITE_DIR")) return;
if(!defined("WIZARD_SITE_PATH")) return;
if(!defined("WIZARD_TEMPLATE_ID")) return;
if(!defined("WIZARD_TEMPLATE_ABSOLUTE_PATH")) return;
if(!defined("WIZARD_THEME_ID")) return;

// iblock user fields
$dbSite = CSite::GetByID(WIZARD_SITE_ID);
if($arSite = $dbSite -> Fetch()) $lang = $arSite["LANGUAGE_ID"];
if(!strlen($lang)) $lang = "ru";
WizardServices::IncludeServiceLang("errors_updates", $lang);

$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".WIZARD_TEMPLATE_ID."/";
//$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"]."/local/templates/".WIZARD_TEMPLATE_ID."/";

if(isset($_SESSION["NEXT_CATALOG_ID"]) && $_SESSION["NEXT_CATALOG_ID"])
	\Bitrix\Main\Config\Option::set("aspro.next", "CATALOG_IBLOCK_ID", $_SESSION["NEXT_CATALOG_ID"], WIZARD_SITE_ID);
\Bitrix\Main\Config\Option::set("aspro.next", "MAX_DEPTH_MENU", 4, WIZARD_SITE_ID);
\Bitrix\Main\Config\Option::set("aspro.next", "REGIONALITY_FILTER_ITEM", "Y", WIZARD_SITE_ID);

$catalogIBlockID = CNextCache::$arIBlocks[WIZARD_SITE_ID]["aspro_next_catalog"]["aspro_next_catalog"][0];
$landingIBlockID = CNextCache::$arIBlocks[WIZARD_SITE_ID]['aspro_next_catalog']['aspro_next_catalog_info'][0];
$servicesIBlockID = CNextCache::$arIBlocks[WIZARD_SITE_ID]['aspro_next_content']['aspro_next_services'][0];

$dbProperty = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $landingIBlockID, "CODE" => "SECTION_SERVICES"));
if(!$dbProperty->SelectedRowsCount())
{
	$ibp = new CIBlockProperty;
	$arFields = Array(
		"NAME" => GetMessage("SECTION_LIST"),
		"ACTIVE" => "Y",
		"SORT" => "100",
		"CODE" => "SECTION_SERVICES",
		"PROPERTY_TYPE" => "G",
		"LIST_TYPE" => "L",
		"MULTIPLE" => "Y",
		"LINK_IBLOCK_ID" => $servicesIBlockID,
		"IBLOCK_ID" => $landingIBlockID
	);
	$PropID = $ibp->Add($arFields);
}

$brandsIBlockID = CNextCache::$arIBlocks[WIZARD_SITE_ID]['aspro_next_content']['aspro_next_brands'][0];

$dbProperty = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $brandsIBlockID, "CODE" => "BNR_TOP"));
if(!$dbProperty->SelectedRowsCount())
{
	$ibp = new CIBlockProperty;
	$arFields = Array(
		"NAME" => GetMessage("BNR_TOP"),
		"ACTIVE" => "Y",
		"SORT" => "100",
		"CODE" => "BNR_TOP",
		"PROPERTY_TYPE" => "L",
		"LIST_TYPE" => "C",
		"MULTIPLE" => "N",
		"VALUES" => array(
			array(
				"VALUE" => "Y",
				"XML_ID" => "YES",
			)
		),
		"IBLOCK_ID" => $brandsIBlockID
	);
	$PropID = $ibp->Add($arFields);
}

$dbProperty = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $brandsIBlockID, "CODE" => "BNR_TOP_IMG"));
if(!$dbProperty->SelectedRowsCount())
{
	$ibp = new CIBlockProperty;
	$arFields = Array(
		"NAME" => GetMessage("BNR_TOP_IMG"),
		"ACTIVE" => "Y",
		"SORT" => "100",
		"CODE" => "BNR_TOP_IMG",
		"PROPERTY_TYPE" => "F",
		"LIST_TYPE" => "L",
		"MULTIPLE" => "N",
		"IBLOCK_ID" => $brandsIBlockID
	);
	$PropID = $ibp->Add($arFields);
}

$dbProperty = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $brandsIBlockID, "CODE" => "BNR_TOP_BG"));
if(!$dbProperty->SelectedRowsCount())
{
	$ibp = new CIBlockProperty;
	$arFields = Array(
		"NAME" => GetMessage("BNR_TOP_BG"),
		"ACTIVE" => "Y",
		"SORT" => "100",
		"CODE" => "BNR_TOP_BG",
		"PROPERTY_TYPE" => "F",
		"LIST_TYPE" => "L",
		"MULTIPLE" => "N",
		"IBLOCK_ID" => $brandsIBlockID
	);
	$PropID = $ibp->Add($arFields);
}

$dbProperty = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $brandsIBlockID, "CODE" => "CODE_TEXT"));
if(!$dbProperty->SelectedRowsCount())
{
	$ibp = new CIBlockProperty;
	$arFields = Array(
		"NAME" => GetMessage("CODE_TEXT"),
		"ACTIVE" => "Y",
		"SORT" => "100",
		"CODE" => "CODE_TEXT",
		"PROPERTY_TYPE" => "S",
		"LIST_TYPE" => "L",
		"MULTIPLE" => "N",
		"IBLOCK_ID" => $brandsIBlockID
	);
	$PropID = $ibp->Add($arFields);
}

$dbProperty = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $brandsIBlockID, "CODE" => "BANNER_TITLE"));
if(!$dbProperty->SelectedRowsCount())
{
	$ibp = new CIBlockProperty;
	$arFields = Array(
		"NAME" => GetMessage("BANNER_TITLE"),
		"ACTIVE" => "Y",
		"SORT" => "100",
		"CODE" => "BANNER_TITLE",
		"PROPERTY_TYPE" => "S",
		"LIST_TYPE" => "L",
		"MULTIPLE" => "N",
		"IBLOCK_ID" => $brandsIBlockID
	);
	$PropID = $ibp->Add($arFields);
}

$dbProperty = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $brandsIBlockID, "CODE" => "BANNER_DESCRIPTION"));
if(!$dbProperty->SelectedRowsCount())
{
	$ibp = new CIBlockProperty;
	$arFields = Array(
		"NAME" => GetMessage("BANNER_DESCRIPTION"),
		"ACTIVE" => "Y",
		"SORT" => "100",
		"CODE" => "BANNER_DESCRIPTION",
		"PROPERTY_TYPE" => "S",
		"USER_TYPE" => "HTML",
		"IBLOCK_ID" => $brandsIBlockID
	);
	$PropID = $ibp->Add($arFields);
}

$arUserFieldViewType = CUserTypeEntity::GetList(array(), array("ENTITY_ID" => "IBLOCK_".$catalogIBlockID."_SECTION", "FIELD_NAME" => "UF_OFFERS_TYPE"))->Fetch();
if(!$arUserFieldViewType)
{
	$arFields = array(
		"FIELD_NAME" => "UF_OFFERS_TYPE",
		"USER_TYPE_ID" => "enumeration",
		"XML_ID" => "UF_OFFERS_TYPE",
		"SORT" => 100,
		"MULTIPLE" => "N",
		"MANDATORY" => "N",
		"SHOW_FILTER" => "N",
		"SHOW_IN_LIST" => "Y",
		"EDIT_IN_LIST" => "Y",
		"IS_SEARCHABLE" => "N",
		"SETTINGS" => array(
			"DISPLAY" => "LIST",
			"LIST_HEIGHT" => 5,
		)
	);
	$arLangs = array(
		"EDIT_FORM_LABEL" => array(
			"ru" => GetMessage("OFFERS_TYPE"),
			"en" => "Offers type",
		),
		"LIST_COLUMN_LABEL" => array(
			"ru" => GetMessage("OFFERS_TYPE"),
			"en" => "Offers type",
		)
	);

	$ob = new CUserTypeEntity();
	$FIELD_ID = $ob->Add(array_merge($arFields, array("ENTITY_ID" => "IBLOCK_".$catalogIBlockID."_SECTION"), $arLangs));
	if($FIELD_ID)
	{
		$obEnum = new CUserFieldEnum;
		$obEnum->SetEnumValues($FIELD_ID, array(
			"n0" => array(
				"VALUE" => 1,
				"XML_ID" => "TYPE_1",
			),
			"n1" => array(
				"VALUE" => 2,
				"XML_ID" => "TYPE_2",
			),
		));
	}
}

//catalog detail type
$arUserFieldViewType = CUserTypeEntity::GetList(array(), array("ENTITY_ID" => "IBLOCK_".$catalogIBlockID."_SECTION", "FIELD_NAME" => "UF_ELEMENT_DETAIL"))->Fetch();
if(!$arUserFieldViewType)
{
	$arFields = array(
		"FIELD_NAME" => "UF_ELEMENT_DETAIL",
		"USER_TYPE_ID" => "enumeration",
		"XML_ID" => "UF_ELEMENT_DETAIL",
		"SORT" => 100,
		"MULTIPLE" => "N",
		"MANDATORY" => "N",
		"SHOW_FILTER" => "N",
		"SHOW_IN_LIST" => "Y",
		"EDIT_IN_LIST" => "Y",
		"IS_SEARCHABLE" => "N",
		"SETTINGS" => array(
			"DISPLAY" => "LIST",
			"LIST_HEIGHT" => 5,
		)
	);
	$arLangs = array(
		"EDIT_FORM_LABEL" => array(
			"ru" => GetMessage("CATALOG_DETAIL_TYPE"),
			"en" => "Catalog detail type",
		),
		"LIST_COLUMN_LABEL" => array(
			"ru" => GetMessage("CATALOG_DETAIL_TYPE"),
			"en" => "Catalog detail type",
		)
	);

	$ob = new CUserTypeEntity();
	$FIELD_ID = $ob->Add(array_merge($arFields, array("ENTITY_ID" => "IBLOCK_".$catalogIBlockID."_SECTION"), $arLangs));
	if($FIELD_ID)
	{
		$obEnum = new CUserFieldEnum;
		$obEnum->SetEnumValues($FIELD_ID, array(
			"n0" => array(
				"VALUE" => GetMessage("CATALOG_DETAIL_TYPE1"),
				"XML_ID" => "element_1",
			),
			"n1" => array(
				"VALUE" => GetMessage("CATALOG_DETAIL_TYPE2"),
				"XML_ID" => "element_2",
			),
			"n2" => array(
				"VALUE" => GetMessage("CATALOG_DETAIL_TYPE3"),
				"XML_ID" => "element_3",
			),
			"n3" => array(
				"VALUE" => GetMessage("CATALOG_DETAIL_TYPE4"),
				"XML_ID" => "element_4",
			),
			"n4" => array(
				"VALUE" => GetMessage("CATALOG_DETAIL_TYPE5"),
				"XML_ID" => "element_5",
			),
		));
	}
}

//table sizes
$arUserFieldViewType = CUserTypeEntity::GetList(array(), array("ENTITY_ID" => "IBLOCK_".$catalogIBlockID."_SECTION", "FIELD_NAME" => "UF_TABLE_SIZES"))->Fetch();
if(!$arUserFieldViewType)
{
	$arFields = array(
		"FIELD_NAME" => "UF_TABLE_SIZES",
		"USER_TYPE_ID" => "enumeration",
		"XML_ID" => "UF_TABLE_SIZES",
		"SORT" => 100,
		"MULTIPLE" => "N",
		"MANDATORY" => "N",
		"SHOW_FILTER" => "N",
		"SHOW_IN_LIST" => "Y",
		"EDIT_IN_LIST" => "Y",
		"IS_SEARCHABLE" => "N",
		"SETTINGS" => array(
			"DISPLAY" => "LIST",
			"LIST_HEIGHT" => 5,
		)
	);
	$arLangs = array(
		"EDIT_FORM_LABEL" => array(
			"ru" => GetMessage("TABLE_SIZES"),
			"en" => "Table sizes",
		),
		"LIST_COLUMN_LABEL" => array(
			"ru" => GetMessage("TABLE_SIZES"),
			"en" => "Table sizes",
		)
	);

	$ob = new CUserTypeEntity();
	$FIELD_ID = $ob->Add(array_merge($arFields, array("ENTITY_ID" => "IBLOCK_".$catalogIBlockID."_SECTION"), $arLangs));
	if($FIELD_ID)
	{
		$obEnum = new CUserFieldEnum;
		$obEnum->SetEnumValues($FIELD_ID, array(
			"n0" => array(
				"VALUE" => GetMessage("TABLE_SIZES1"),
				"XML_ID" => "CLOTHES",
			),
			"n1" => array(
				"VALUE" => GetMessage("TABLE_SIZES2"),
				"XML_ID" => "SHOES",
			),
		));
	}
}

unset($_SESSION['CATALOG_COMPARE_LIST']['NEXT_CATALOG_ID']);
unset($_SESSION['ASPRO_BASKET_COUNTERS']);
?>