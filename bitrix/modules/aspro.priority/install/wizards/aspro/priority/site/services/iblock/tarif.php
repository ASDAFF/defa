<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock")) return;

if(!defined("WIZARD_SITE_ID")) return;
if(!defined("WIZARD_SITE_DIR")) return;
if(!defined("WIZARD_SITE_PATH")) return;
if(!defined("WIZARD_TEMPLATE_ID")) return;
if(!defined("WIZARD_TEMPLATE_ABSOLUTE_PATH")) return;
if(!defined("WIZARD_THEME_ID")) return;

$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".WIZARD_TEMPLATE_ID."/";
//$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"]."/local/templates/".WIZARD_TEMPLATE_ID."/";

$iblockShortCODE = "tarif";
$iblockXMLFile = WIZARD_SERVICE_RELATIVE_PATH."/xml/".LANGUAGE_ID."/".$iblockShortCODE.".xml";
$iblockTYPE = "aspro_priority_catalog";
$iblockXMLID = "aspro_priority_".$iblockShortCODE."_".WIZARD_SITE_ID;
$iblockCODE = "aspro_priority_".$iblockShortCODE;
$iblockID = false;

$rsIBlock = CIBlock::GetList(array(), array("XML_ID" => $iblockXMLID, "TYPE" => $iblockTYPE));
if ($arIBlock = $rsIBlock->Fetch()) {
	$iblockID = $arIBlock["ID"];
	if (WIZARD_INSTALL_DEMO_DATA) {
		// delete if already exist & need install demo
		CIBlock::Delete($arIBlock["ID"]);
		$iblockID = false;
	}
}

if(WIZARD_INSTALL_DEMO_DATA){
	if(!$iblockID){
		// add new iblock
		$permissions = array("1" => "X", "2" => "R");
		$dbGroup = CGroup::GetList($by = "", $order = "", array("STRING_ID" => "content_editor"));
		if($arGroup = $dbGroup->Fetch()){
			$permissions[$arGroup["ID"]] = "W";
		};
		
		// replace macros IN_XML_SITE_ID & IN_XML_SITE_DIR in xml file - for correct url links to site
		if(file_exists($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile.".back")){
			@copy($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile.".back", $_SERVER["DOCUMENT_ROOT"].$iblockXMLFile);
		}
		@copy($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile, $_SERVER["DOCUMENT_ROOT"].$iblockXMLFile.".back");
		CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile, Array("IN_XML_SITE_DIR" => WIZARD_SITE_DIR));
		CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile, Array("IN_XML_SITE_ID" => WIZARD_SITE_ID));
		$iblockID = WizardServices::ImportIBlockFromXML($iblockXMLFile, $iblockCODE, $iblockTYPE, WIZARD_SITE_ID, $permissions);
		if(file_exists($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile.".back")){
			@copy($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile.".back", $_SERVER["DOCUMENT_ROOT"].$iblockXMLFile);
		}
		if ($iblockID < 1)	return;
			
		// iblock fields
		$iblock = new CIBlock;
		$arFields = array(
			"ACTIVE" => "Y",
			"CODE" => $iblockCODE,
			"XML_ID" => $iblockXMLID,
			"FIELDS" => array(
				"IBLOCK_SECTION" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "Array",
				),
				"ACTIVE" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE"=> "Y",
				),
				"ACTIVE_FROM" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				),
				"ACTIVE_TO" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				),
				"SORT" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "0",
				), 
				"NAME" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "",
				), 
				"PREVIEW_PICTURE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"FROM_DETAIL" => "Y",
						"SCALE" => "Y",
						"WIDTH" => "568",
						"HEIGHT" => "",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 95,
						"DELETE_WITH_DETAIL" => "N",
						"UPDATE_WITH_DETAIL" => "N",
					),
				), 
				"PREVIEW_TEXT_TYPE" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "text",
				), 
				"PREVIEW_TEXT" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				), 
				"DETAIL_PICTURE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"SCALE" => "N",
						"WIDTH" => "",
						"HEIGHT" => "",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 95,
					),
				), 
				"DETAIL_TEXT_TYPE" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "text",
				), 
				"DETAIL_TEXT" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				), 
				"XML_ID" =>  array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "",
				), 
				"CODE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"UNIQUE" => "N",
						"TRANSLITERATION" => "N",
						"TRANS_LEN" => 100,
						"TRANS_CASE" => "L",
						"TRANS_SPACE" => "-",
						"TRANS_OTHER" => "-",
						"TRANS_EAT" => "Y",
						"USE_GOOGLE" => "N",
					),
				),
				"TAGS" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				), 
				"SECTION_NAME" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "",
				), 
				"SECTION_PICTURE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"FROM_DETAIL" => "N",
						"SCALE" => "N",
						"WIDTH" => "",
						"HEIGHT" => "",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 95,
						"DELETE_WITH_DETAIL" => "N",
						"UPDATE_WITH_DETAIL" => "N",
					),
				), 
				"SECTION_DESCRIPTION_TYPE" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => "text",
				), 
				"SECTION_DESCRIPTION" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				), 
				"SECTION_DETAIL_PICTURE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"SCALE" => "N",
						"WIDTH" => "",
						"HEIGHT" => "",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 95,
					),
				), 
				"SECTION_XML_ID" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				), 
				"SECTION_CODE" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => array(
						"UNIQUE" => "N",
						"TRANSLITERATION" => "N",
						"TRANS_LEN" => 100,
						"TRANS_CASE" => "L",
						"TRANS_SPACE" => "-",
						"TRANS_OTHER" => "-",
						"TRANS_EAT" => "Y",
						"USE_GOOGLE" => "N",
					),
				), 
			),
		);
		
		$iblock->Update($iblockID, $arFields);
	}
	else{
		// attach iblock to site
		$arSites = array(); 
		$db_res = CIBlock::GetSite($iblockID);
		while ($res = $db_res->Fetch())
			$arSites[] = $res["LID"]; 
		if (!in_array(WIZARD_SITE_ID, $arSites)){
			$arSites[] = WIZARD_SITE_ID;
			$iblock = new CIBlock;
			$iblock->Update($iblockID, array("LID" => $arSites));
		}
	}

	// iblock user fields
	$dbSite = CSite::GetByID(WIZARD_SITE_ID);
	if($arSite = $dbSite -> Fetch()) $lang = $arSite["LANGUAGE_ID"];
	if(!strlen($lang)) $lang = "ru";
	WizardServices::IncludeServiceLang("editform_useroptions.php", $lang);
	WizardServices::IncludeServiceLang("properties_hints.php", $lang);
	$arProperty = array();
	$dbProperty = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $iblockID));
	while($arProp = $dbProperty->Fetch())
		$arProperty[$arProp["CODE"]] = $arProp["ID"];

	// properties hints
	$ibp = new CIBlockProperty;
	$ibp->Update($arProperty["FILTER_PRICE_1"], array("HINT" => GetMessage("WZD_PROPERTY_HINT_10")));
	unset($ibp);
	$ibp = new CIBlockProperty;
	$ibp->Update($arProperty["FILTER_PRICE_2"], array("HINT" => GetMessage("WZD_PROPERTY_HINT_11")));
	unset($ibp);
	$ibp = new CIBlockProperty;
	$ibp->Update($arProperty["FILTER_PRICE_3"], array("HINT" => GetMessage("WZD_PROPERTY_HINT_12")));
	unset($ibp);
	$ibp = new CIBlockProperty;
	$ibp->Update($arProperty["FILTER_PRICE_DEFAULT"], array("HINT" => GetMessage("WZD_PROPERTY_HINT_13")));
	unset($ibp);

	// edit form user options
	CUserOptions::SetOption("form", "form_element_".$iblockID, array(
		"tabs" => 'edit1--#--'.GetMessage("WZD_OPTION_282").'--,--ID--#--'.GetMessage("WZD_OPTION_362").'--,--DATE_CREATE--#--'.GetMessage("WZD_OPTION_364").'--,--TIMESTAMP_X--#--'.GetMessage("WZD_OPTION_366").'--,--ACTIVE--#--'.GetMessage("WZD_OPTION_2").'--,--ACTIVE_FROM--#--'.GetMessage("WZD_OPTION_4").'--,--ACTIVE_TO--#--'.GetMessage("WZD_OPTION_6").'--,--NAME--#--'.GetMessage("WZD_OPTION_8").'--,--CODE--#--'.GetMessage("WZD_OPTION_10").'--,--SORT--#--'.GetMessage("WZD_OPTION_12").'--,--IBLOCK_ELEMENT_PROP_VALUE--#--'.GetMessage("WZD_OPTION_14").'--,--PROPERTY_'.$arProperty["FORM_ORDER"].'--#--'.GetMessage("WZD_OPTION_286").'--,--PROPERTY_'.$arProperty["SHOW_ON_INDEX_PAGE"].'--#--'.GetMessage("WZD_OPTION_128").'--,--PROPERTY_'.$arProperty["HIT"].'--#--'.GetMessage("WZD_OPTION_294").'--,--PROPERTY_'.$arProperty["TURN"].'--#--'.GetMessage("WZD_OPTION_438").'--,--PROPERTY_'.$arProperty["VISA"].'--#--'.GetMessage("WZD_OPTION_440").'--,--Master Card--#--'.GetMessage("WZD_OPTION_104").'--,--ÌÈÐ--#--'.GetMessage("WZD_OPTION_104").'--,--PROPERTY_'.$arProperty["APPLE"].'--#--'.GetMessage("WZD_OPTION_442").'--,--Android Pay--#--'.GetMessage("WZD_OPTION_104").'--,--PROPERTY_'.$arProperty["ELPURSE"].'--#--'.GetMessage("WZD_OPTION_444").'--,--PROPERTY_'.$arProperty["DURATION"].'--#--'.GetMessage("WZD_OPTION_446").'--,--PROPERTY_'.$arProperty["SUPPORT"].'--#--'.GetMessage("WZD_OPTION_448").'--,--PROPERTY_'.$arProperty["NOTIFICATION"].'--#--'.GetMessage("WZD_OPTION_450").'--,--PROPERTY_'.$arProperty["API_INTEGRATION"].'--#--'.GetMessage("WZD_OPTION_452").'--,--PROPERTY_'.$arProperty["SIEM_SYSTEM"].'--#--'.GetMessage("WZD_OPTION_454").'--,--PROPERTY_'.$arProperty["COLLECT_INFO"].'--#--'.GetMessage("WZD_OPTION_456").'--,--PROPERTY_'.$arProperty["RULES_SIGNAT"].'--#--'.GetMessage("WZD_OPTION_458").'--,--PROPERTY_'.$arProperty["NUM_DEVICES"].'--#--'.GetMessage("WZD_OPTION_460").'--,--PROPERTY_'.$arProperty["SCANNER"].'--#--'.GetMessage("WZD_OPTION_462").'--,--PROPERTY_'.$arProperty["ANTIVIRUS"].'--#--'.GetMessage("WZD_OPTION_464").'--,--PROPERTY_'.$arProperty["PROTECT_PAYMENT"].'--#--'.GetMessage("WZD_OPTION_466").'--,--PROPERTY_'.$arProperty["PROTECT_CAMERA"].'--#--'.GetMessage("WZD_OPTION_468").'--,--PROPERTY_'.$arProperty["CONTROL"].'--#--'.GetMessage("WZD_OPTION_470").'--,--PROPERTY_'.$arProperty["SUPPORT_FREE"].'--#--'.GetMessage("WZD_OPTION_472").'--,--PROPERTY_'.$arProperty["GUARANTEE"].'--#--'.GetMessage("WZD_OPTION_474").'--,--PROPERTY_'.$arProperty["BLOCKING_SITES"].'--#--'.GetMessage("WZD_OPTION_476").'--,--PROPERTY_'.$arProperty["BLOCKING_TRAFFIC"].'--#--'.GetMessage("WZD_OPTION_478").'--,--PROPERTY_'.$arProperty["SECURITY"].'--#--'.GetMessage("WZD_OPTION_480").'--,--PROPERTY_'.$arProperty["ANTIVOR"].'--#--'.GetMessage("WZD_OPTION_482").'--,--PROPERTY_'.$arProperty["SUM_FINANCING"].'--#--'.GetMessage("WZD_OPTION_484").'--,--PROPERTY_'.$arProperty["TERM_LEASING"].'--#--'.GetMessage("WZD_OPTION_486").'--,--PROPERTY_'.$arProperty["INSURANCE"].'--#--'.GetMessage("WZD_OPTION_488").'--,--PROPERTY_'.$arProperty["CURRENCY"].'--#--'.GetMessage("WZD_OPTION_490").'--,--PROPERTY_'.$arProperty["ADVANCE_PAY"].'--#--'.GetMessage("WZD_OPTION_492").'--,--PROPERTY_'.$arProperty["RATE"].'--#--'.GetMessage("WZD_OPTION_494").'--,--PROPERTY_'.$arProperty["PERCENTAGE"].'--#--'.GetMessage("WZD_OPTION_496").'--,--PROPERTY_'.$arProperty["PAYMENTS"].'--#--'.GetMessage("WZD_OPTION_498").'--;--edit5--#--'.GetMessage("WZD_OPTION_42").'--,--PREVIEW_PICTURE--#--'.GetMessage("WZD_OPTION_228").'--,--PROPERTY_'.$arProperty["ICON"].'--#--'.GetMessage("WZD_OPTION_124").'--,--PROPERTY_'.$arProperty["BACKGROUND"].'--#--'.GetMessage("WZD_OPTION_500").'--,--PREVIEW_TEXT--#--'.GetMessage("WZD_OPTION_46").'--;--cedit1--#--'.GetMessage("WZD_OPTION_502").'--,--PROPERTY_'.$arProperty["TARIF_PRICE_1"].'--#--'.GetMessage("WZD_OPTION_504").'--,--PROPERTY_'.$arProperty["TARIF_PRICE_2"].'--#--'.GetMessage("WZD_OPTION_506").'--,--PROPERTY_'.$arProperty["TARIF_PRICE_3"].'--#--'.GetMessage("WZD_OPTION_508").'--,--PROPERTY_'.$arProperty["TARIF_PRICE_DEFAULT"].'--#--'.GetMessage("WZD_OPTION_510").'--,--PROPERTY_'.$arProperty["ONLY_ONE_PRICE"].'--#--'.GetMessage("WZD_OPTION_512").'--,--PROPERTY_'.$arProperty["TARIF_PRICE_4"].'--#--'.GetMessage("WZD_OPTION_514").'--;--edit14--#--'.GetMessage("WZD_OPTION_78").'--,--IPROPERTY_TEMPLATES_ELEMENT_META_TITLE--#--'.GetMessage("WZD_OPTION_80").'--,--IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS--#--'.GetMessage("WZD_OPTION_82").'--,--IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION--#--'.GetMessage("WZD_OPTION_84").'--,--IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE--#--'.GetMessage("WZD_OPTION_86").'--,--IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE--#--'.GetMessage("WZD_OPTION_88").'--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT--#--'.GetMessage("WZD_OPTION_90").'--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE--#--'.GetMessage("WZD_OPTION_92").'--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME--#--'.GetMessage("WZD_OPTION_94").'--,--IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE--#--'.GetMessage("WZD_OPTION_96").'--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT--#--'.GetMessage("WZD_OPTION_90").'--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE--#--'.GetMessage("WZD_OPTION_92").'--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME--#--'.GetMessage("WZD_OPTION_94").'--,--SEO_ADDITIONAL--#--'.GetMessage("WZD_OPTION_98").'--,--TAGS--#--'.GetMessage("WZD_OPTION_100").'--;--edit2--#--'.GetMessage("WZD_OPTION_102").'--,--SECTIONS--#--'.GetMessage("WZD_OPTION_102").'--;--cedit2--#--'.GetMessage("WZD_OPTION_358").'--,--PROPERTY_'.$arProperty["FILTER_PRICE_1"].'--#--'.GetMessage("WZD_OPTION_516").'--,--PROPERTY_'.$arProperty["FILTER_PRICE_2"].'--#--'.GetMessage("WZD_OPTION_518").'--,--PROPERTY_'.$arProperty["FILTER_PRICE_3"].'--#--'.GetMessage("WZD_OPTION_520").'--,--PROPERTY_'.$arProperty["FILTER_PRICE_DEFAULT"].'--#--'.GetMessage("WZD_OPTION_522").'--,--PROPERTY_'.$arProperty["FILTER_PRICE_4"].'--#--'.GetMessage("WZD_OPTION_524").'--;----#--'.GetMessage("WZD_OPTION_104").'--;--',
	));
	// list user options
	CUserOptions::SetOption("list", "tbl_iblock_list_".md5($iblockTYPE.".".$iblockID), array(
		'columns' => 'NAME,ACTIVE,SORT,TIMESTAMP_X,ID,PROPERTY_'.$arProperty["SHOW_ON_INDEX_PAGE"].',PROPERTY_'.$arProperty["FORM_ORDER"].',PREVIEW_PICTURE,PROPERTY_'.$arProperty["TARIF_PRICE_1"].',PROPERTY_'.$arProperty["TARIF_PRICE_2"].',PROPERTY_'.$arProperty["TARIF_PRICE_3"].',PROPERTY_'.$arProperty["TARIF_PRICE_DEFAULT"].',EXTERNAL_ID', 'by' => 'timestamp_x', 'order' => 'desc', 'page_size' => '20',
	));
}

if($iblockID){
	// replace macros IBLOCK_TYPE & IBLOCK_ID & IBLOCK_CODE
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_TARIF_TYPE" => $iblockTYPE));
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_TARIF_ID" => $iblockID));
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_TARIF_CODE" => $iblockCODE));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_TARIF_TYPE" => $iblockTYPE));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_TARIF_ID" => $iblockID));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_TARIF_CODE" => $iblockCODE));
}
?>