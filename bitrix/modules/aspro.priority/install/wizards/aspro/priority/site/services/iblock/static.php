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

$iblockShortCODE = "static";
$iblockXMLFile = WIZARD_SERVICE_RELATIVE_PATH."/xml/".LANGUAGE_ID."/".$iblockShortCODE.".xml";
$iblockTYPE = "aspro_priority_content";
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
						"WIDTH" => "1000",
						"HEIGHT" => "1000",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 75,
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
						"SCALE" => "Y",
						"WIDTH" => "2000",
						"HEIGHT" => "2000",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 75,
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
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => array(
						"UNIQUE" => "Y",
						"TRANSLITERATION" => "Y",
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
						"FROM_DETAIL" => "Y",
						"SCALE" => "Y",
						"WIDTH" => "800",
						"HEIGHT" => "800",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 75,
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
						"SCALE" => "Y",
						"WIDTH" => "1500",
						"HEIGHT" => "1500",
						"IGNORE_ERRORS" => "N",
						"METHOD" => "resample",
						"COMPRESSION" => 75,
					),
				), 
				"SECTION_XML_ID" => array(
					"IS_REQUIRED" => "N",
					"DEFAULT_VALUE" => "",
				), 
				"SECTION_CODE" => array(
					"IS_REQUIRED" => "Y",
					"DEFAULT_VALUE" => array(
						"UNIQUE" => "Y",
						"TRANSLITERATION" => "Y",
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
	$ibp->Update($arProperty["URL"], array("HINT" => GetMessage("WZD_PROPERTY_HINT_5")));
	unset($ibp);

	// edit form user options
	CUserOptions::SetOption("form", "form_element_".$iblockID, array(
		"tabs" => 'edit1--#--'.GetMessage("WZD_OPTION_106").'--,--ID--#--'.GetMessage("WZD_OPTION_362").'--,--DATE_CREATE--#--'.GetMessage("WZD_OPTION_364").'--,--TIMESTAMP_X--#--'.GetMessage("WZD_OPTION_366").'--,--ACTIVE--#--'.GetMessage("WZD_OPTION_2").'--,--ACTIVE_FROM--#--'.GetMessage("WZD_OPTION_4").'--,--ACTIVE_TO--#--'.GetMessage("WZD_OPTION_6").'--,--NAME--#--'.GetMessage("WZD_OPTION_8").'--,--CODE--#--'.GetMessage("WZD_OPTION_11").'--,--SORT--#--'.GetMessage("WZD_OPTION_12").'--,--edit1_csection1--#--'.GetMessage("WZD_OPTION_368").'--,--PROPERTY_'.$arProperty["LINK_REGION"].'--#--'.GetMessage("WZD_OPTION_40").'--,--PROPERTY_'.$arProperty["COMPANY_NAME"].'--#--'.GetMessage("WZD_OPTION_370").'--,--PROPERTY_'.$arProperty["URL"].'--#--'.GetMessage("WZD_OPTION_372").'--,--PROPERTY_'.$arProperty["SHOW_BUTTON"].'--#--'.GetMessage("WZD_OPTION_374").'--,--PREVIEW_PICTURE--#--'.GetMessage("WZD_OPTION_376").'--,--DETAIL_PICTURE--#--'.GetMessage("WZD_OPTION_378").'--,--PROPERTY_'.$arProperty["PICTURE_TYPE_3"].'--#--'.GetMessage("WZD_OPTION_380").'--,--PROPERTY_'.$arProperty["PICTURE_TYPE_3_BG"].'--#--'.GetMessage("WZD_OPTION_382").'--,--PROPERTY_'.$arProperty["PROPS"].'--#--'.GetMessage("WZD_OPTION_384").'--,--PROPERTY_'.$arProperty["VIDEO_SOURCE"].'--#--'.GetMessage("WZD_OPTION_58").'--,--PROPERTY_'.$arProperty["VIDEO_SRC"].'--#--'.GetMessage("WZD_OPTION_60").'--,--PROPERTY_'.$arProperty["VIDEO"].'--#--'.GetMessage("WZD_OPTION_62").'--,--PROPERTY_'.$arProperty["COMPANY_TEXT"].'--#--'.GetMessage("WZD_OPTION_132").'--,--edit1_csection2--#--'.GetMessage("WZD_OPTION_386").'--,--PROPERTY_'.$arProperty["FORM"].'--#--'.GetMessage("WZD_OPTION_388").'--,--PROPERTY_'.$arProperty["CONTACT"].'--#--'.GetMessage("WZD_OPTION_390").'--,--PROPERTY_'.$arProperty["EMAIL"].'--#--'.GetMessage("WZD_OPTION_138").'--,--PROPERTY_'.$arProperty["PHONE"].'--#--'.GetMessage("WZD_OPTION_142").'--,--PROPERTY_'.$arProperty["VACANCY_PICTURE"].'--#--'.GetMessage("WZD_OPTION_392").'--,--PROPERTY_'.$arProperty["VACANCY_TEXT"].'--#--'.GetMessage("WZD_OPTION_132").'--,--edit1_csection3--#--'.GetMessage("WZD_OPTION_394").'--,--но не занете с чего начать?" на главной--#--'.GetMessage("WZD_OPTION_104").'--,--PROPERTY_'.$arProperty["INFO_BLOCK_NAME"].'--#--'.GetMessage("WZD_OPTION_370").'--,--PROPERTY_'.$arProperty["ORDER_FORM"].'--#--'.GetMessage("WZD_OPTION_396").'--,--PROPERTY_'.$arProperty["CALLBACK_FORM"].'--#--'.GetMessage("WZD_OPTION_398").'--,--PROPERTY_'.$arProperty["MAIN_ACTION_PICTURE"].'--#--'.GetMessage("WZD_OPTION_392").'--,--PROPERTY_'.$arProperty["INFO_BLOCK_TEXT"].'--#--'.GetMessage("WZD_OPTION_132").'--;--edit14--#--'.GetMessage("WZD_OPTION_78").'--,--IPROPERTY_TEMPLATES_ELEMENT_META_TITLE--#--'.GetMessage("WZD_OPTION_80").'--,--IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS--#--'.GetMessage("WZD_OPTION_82").'--,--IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION--#--'.GetMessage("WZD_OPTION_84").'--,--IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE--#--'.GetMessage("WZD_OPTION_86").'--,--IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE--#--'.GetMessage("WZD_OPTION_88").'--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT--#--'.GetMessage("WZD_OPTION_90").'--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE--#--'.GetMessage("WZD_OPTION_92").'--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME--#--'.GetMessage("WZD_OPTION_94").'--,--IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE--#--'.GetMessage("WZD_OPTION_96").'--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT--#--'.GetMessage("WZD_OPTION_90").'--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE--#--'.GetMessage("WZD_OPTION_92").'--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME--#--'.GetMessage("WZD_OPTION_94").'--,--SEO_ADDITIONAL--#--'.GetMessage("WZD_OPTION_98").'--,--TAGS--#--'.GetMessage("WZD_OPTION_100").'--;--edit2--#--'.GetMessage("WZD_OPTION_102").'--,--SECTIONS--#--'.GetMessage("WZD_OPTION_102").'--;----#--'.GetMessage("WZD_OPTION_104").'--;--',
	));
	// list user options
	CUserOptions::SetOption("list", "tbl_iblock_list_".md5($iblockTYPE.".".$iblockID), array(
		'columns' => 'NAME,ACTIVE,SORT,ID,PROPERTY_'.$arProperty["LINK_REGION"].'', 'by' => 'timestamp_x', 'order' => 'desc', 'page_size' => '20',
	));
}

if($iblockID){
	// replace macros IBLOCK_TYPE & IBLOCK_ID & IBLOCK_CODE
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_STATIC_TYPE" => $iblockTYPE));
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_STATIC_ID" => $iblockID));
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_STATIC_CODE" => $iblockCODE));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_STATIC_TYPE" => $iblockTYPE));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_STATIC_ID" => $iblockID));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_STATIC_CODE" => $iblockCODE));
}
?>
