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

$iblockShortCODE = "catalog";
$iblockXMLFile = WIZARD_SERVICE_RELATIVE_PATH."/xml/".LANGUAGE_ID."/".$iblockShortCODE.".xml";
$iblockTYPE = "aspro_priority_catalog";
$iblockXMLID = "aspro_priority_".$iblockShortCODE."_".WIZARD_SITE_ID;
$iblockCODE = "aspro_priority_".$iblockShortCODE;
$iblockID = false;
$iblockStaffXMLID = "aspro_priority_staff_".WIZARD_SITE_ID;

$rsIBlock = CIBlock::GetList(array(), array("XML_ID" => $iblockXMLID, "TYPE" => $iblockTYPE));
if ($arIBlock = $rsIBlock->Fetch()) {
	$iblockID = $arIBlock["ID"];
	if (WIZARD_INSTALL_DEMO_DATA) {
		// delete if already exist & need install demo
		CIBlock::Delete($arIBlock["ID"]);
		$iblockID = false;
	}
}

$rsIBlockStaff = CIBlock::GetList(array(), array("XML_ID" => $iblockStaffXMLID, "TYPE" => 'aspro_priority_content'));
if ($arIBlockStaff = $rsIBlockStaff->Fetch()) {
	$iblockStaffID = $arIBlockStaff["ID"];
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
		CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"].$iblockXMLFile, Array("STAFF_IBLOCK_ID" => $iblockStaffID));
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
						"WIDTH" => "800",
						"HEIGHT" => "800",
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
						"WIDTH" => "2000",
						"HEIGHT" => "2000",
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
	$ibp->Update($arProperty["PRICEOLD"], array("HINT" => GetMessage("WZD_PROPERTY_HINT_2")));
	unset($ibp);
	$ibp = new CIBlockProperty;
	$ibp->Update($arProperty["FILTER_PRICE"], array("HINT" => GetMessage("WZD_PROPERTY_HINT_3")));
	unset($ibp);
	$ibp = new CIBlockProperty;
	$ibp->Update($arProperty["DELIVERY"], array("HINT" => GetMessage("WZD_PROPERTY_HINT_4")));
	unset($ibp);
	
	// update user properties
	$arLanguages = Array();
	$rsLanguage = CLanguage::GetList($by, $order, array());
	while($arLanguage = $rsLanguage->Fetch())
		$arLanguages[] = $arLanguage["LID"];

	$arUserFields = array('UF_ICON', 'UF_QUESTION', 'UF_BACKGROUND', 'UF_VIEWTYPE');
	foreach ($arUserFields as $userField)
	{
		$arLabelNames = Array();
		foreach($arLanguages as $languageID)
		{
			WizardServices::IncludeServiceLang("property_names.php", $languageID);
			$arLabelNames[$languageID] = GetMessage($userField);
		}

		$arProperty["EDIT_FORM_LABEL"] = $arLabelNames;
		$arProperty["LIST_COLUMN_LABEL"] = $arLabelNames;
		$arProperty["LIST_FILTER_LABEL"] = $arLabelNames;

		$dbRes = CUserTypeEntity::GetList(Array(), Array("ENTITY_ID" => 'IBLOCK_'.$iblockID.'_SECTION', "FIELD_NAME" => $userField));
		if ($arRes = $dbRes->Fetch())
		{
			$userType = new CUserTypeEntity();
			$userType->Update($arRes["ID"], $arProperty);
		}
	}
	
	// edit form user options
	CUserOptions::SetOption("form", "form_element_".$iblockID, array(
		"tabs" => 'edit1--#--'.GetMessage("WZD_OPTION_282").'--,--ACTIVE--#--'.GetMessage("WZD_OPTION_2").'--,--NAME--#--'.GetMessage("WZD_OPTION_8").'--,--CODE--#--'.GetMessage("WZD_OPTION_11").'--,--SORT--#--'.GetMessage("WZD_OPTION_12").'--,--IBLOCK_ELEMENT_PROP_VALUE--#--'.GetMessage("WZD_OPTION_14").'--,--PROPERTY_'.$arProperty["PRICE"].'--#--'.GetMessage("WZD_OPTION_278").'--,--PROPERTY_'.$arProperty["PRICEOLD"].'--#--'.GetMessage("WZD_OPTION_276").'--,--PROPERTY_'.$arProperty["STATUS"].'--#--'.GetMessage("WZD_OPTION_284").'--,--PROPERTY_'.$arProperty["FORM_ORDER"].'--#--'.GetMessage("WZD_OPTION_286").'--,--PROPERTY_'.$arProperty["FORM_QUESTION"].'--#--'.GetMessage("WZD_OPTION_234").'--,--PROPERTY_'.$arProperty["SHOW_ON_INDEX_PAGE"].'--#--'.GetMessage("WZD_OPTION_288").'--,--PROPERTY_'.$arProperty["ARTICLE"].'--#--'.GetMessage("WZD_OPTION_290").'--,--PROPERTY_'.$arProperty["BRAND"].'--#--'.GetMessage("WZD_OPTION_292").'--,--PROPERTY_'.$arProperty["HIT"].'--#--'.GetMessage("WZD_OPTION_294").'--,--PROPERTY_'.$arProperty["TIZERS"].'--#--'.GetMessage("WZD_OPTION_296").'--,--PROPERTY_'.$arProperty["DELIVERY"].'--#--'.GetMessage("WZD_OPTION_298").'--,--PROPERTY_'.$arProperty["RANGE_MEASURE"].'--#--'.GetMessage("WZD_OPTION_300").'--,--PROPERTY_'.$arProperty["WORK_TEMP"].'--#--'.GetMessage("WZD_OPTION_302").'--,--PROPERTY_'.$arProperty["WORK_PRESSURE"].'--#--'.GetMessage("WZD_OPTION_304").'--,--PROPERTY_'.$arProperty["NUM_CHANNELS"].'--#--'.GetMessage("WZD_OPTION_306").'--,--PROPERTY_'.$arProperty["DIMENSIONS"].'--#--'.GetMessage("WZD_OPTION_308").'--,--PROPERTY_'.$arProperty["MASS"].'--#--'.GetMessage("WZD_OPTION_310").'--,--êã--#--'.GetMessage("WZD_OPTION_104").'--,--PROPERTY_'.$arProperty["MAX_POWER_VT"].'--#--'.GetMessage("WZD_OPTION_312").'--,--PROPERTY_'.$arProperty["MAX_SPEED"].'--#--'.GetMessage("WZD_OPTION_314").'--,--PROPERTY_'.$arProperty["MODEL_ENGINE"].'--#--'.GetMessage("WZD_OPTION_316").'--,--PROPERTY_'.$arProperty["VOLUME_ENGINE"].'--#--'.GetMessage("WZD_OPTION_318").'--,--PROPERTY_'.$arProperty["SEATS"].'--#--'.GetMessage("WZD_OPTION_320").'--,--PROPERTY_'.$arProperty["BENDING_SIZE"].'--#--'.GetMessage("WZD_OPTION_322").'--,--ìì--#--'.GetMessage("WZD_OPTION_104").'--,--PROPERTY_'.$arProperty["BENDING_ANGLE"].'--#--'.GetMessage("WZD_OPTION_324").'--,--ãðàäóñîâ--#--'.GetMessage("WZD_OPTION_104").'--,--PROPERTY_'.$arProperty["COUNTRY"].'--#--'.GetMessage("WZD_OPTION_326").'--,--PROPERTY_'.$arProperty["ENGINE_POWER"].'--#--'.GetMessage("WZD_OPTION_328").'--,--êÂò--#--'.GetMessage("WZD_OPTION_104").'--,--PROPERTY_'.$arProperty["WORK_SPEED"].'--#--'.GetMessage("WZD_OPTION_330").'--,--ìì/ñåê--#--'.GetMessage("WZD_OPTION_104").'--,--PROPERTY_'.$arProperty["GUARANTEE"].'--#--'.GetMessage("WZD_OPTION_332").'--,--PROPERTY_'.$arProperty["INNER_MEMORY"].'--#--'.GetMessage("WZD_OPTION_334").'--,--PROPERTY_'.$arProperty["COMMUNIC_PORT"].'--#--'.GetMessage("WZD_OPTION_336").'--,--PROPERTY_'.$arProperty["POWER_LS"].'--#--'.GetMessage("WZD_OPTION_312").'--,--ë.ñ.--#--'.GetMessage("WZD_OPTION_104").'--,--PROPERTY_'.$arProperty["MAX_MASS_ZAG"].'--#--'.GetMessage("WZD_OPTION_338").'--,--êã--#--'.GetMessage("WZD_OPTION_104").'--,--PROPERTY_'.$arProperty["MAXIMUM_PRESSURE"].'--#--'.GetMessage("WZD_OPTION_340").'--,--Áàð--#--'.GetMessage("WZD_OPTION_104").'--,--PROPERTY_'.$arProperty["MAX_SIZE_ZAG"].'--#--'.GetMessage("WZD_OPTION_342").'--,--ìì--#--'.GetMessage("WZD_OPTION_104").'--,--PROPERTY_'.$arProperty["PRESS_POWER"].'--#--'.GetMessage("WZD_OPTION_344").'--,--êÍ--#--'.GetMessage("WZD_OPTION_104").'--,--PROPERTY_'.$arProperty["V_DVIGATELJA"].'--#--'.GetMessage("WZD_OPTION_346").'--,--êóá. ñì--#--'.GetMessage("WZD_OPTION_104").'--,--PROPERTY_'.$arProperty["RAZGON"].'--#--'.GetMessage("WZD_OPTION_348").'--,----#--'.GetMessage("WZD_OPTION_104").'--,--PROPERTY_'.$arProperty["COLOR_OF_PAINTWORK"].'--#--'.GetMessage("WZD_OPTION_350").'--;--edit5--#--'.GetMessage("WZD_OPTION_42").'--,--PREVIEW_PICTURE--#--'.GetMessage("WZD_OPTION_228").'--,--PREVIEW_TEXT--#--'.GetMessage("WZD_OPTION_46").'--;--edit6--#--'.GetMessage("WZD_OPTION_48").'--,--DETAIL_PICTURE--#--'.GetMessage("WZD_OPTION_190").'--,--PROPERTY_'.$arProperty["PHOTOS"].'--#--'.GetMessage("WZD_OPTION_352").'--,--PROPERTY_'.$arProperty["DOCUMENTS"].'--#--'.GetMessage("WZD_OPTION_266").'--,--PROPERTY_'.$arProperty["GALLEY_BIG"].'--#--'.GetMessage("WZD_OPTION_248").'--,--DETAIL_TEXT--#--'.GetMessage("WZD_OPTION_52").'--;--cedit1--#--'.GetMessage("WZD_OPTION_168").'--,--PROPERTY_'.$arProperty["LINK_VACANCYS"].'--#--'.GetMessage("WZD_OPTION_204").'--,--PROPERTY_'.$arProperty["LINK_FAQ"].'--#--'.GetMessage("WZD_OPTION_206").'--,--PROPERTY_'.$arProperty["LINK_SALE"].'--#--'.GetMessage("WZD_OPTION_170").'--,--PROPERTY_'.$arProperty["LINK_REVIEWS"].'--#--'.GetMessage("WZD_OPTION_172").'--,--PROPERTY_'.$arProperty["LINK_PARTNERS"].'--#--'.GetMessage("WZD_OPTION_210").'--,--PROPERTY_'.$arProperty["LINK_PROJECTS"].'--#--'.GetMessage("WZD_OPTION_174").'--,--PROPERTY_'.$arProperty["LINK_STAFF"].'--#--'.GetMessage("WZD_OPTION_192").'--,--PROPERTY_'.$arProperty["LINK_GOODS"].'--#--'.GetMessage("WZD_OPTION_212").'--,--PROPERTY_'.$arProperty["LINK_SERVICES"].'--#--'.GetMessage("WZD_OPTION_176").'--,--PROPERTY_'.$arProperty["LINK_TARIFS"].'--#--'.GetMessage("WZD_OPTION_280").'--;--cedit3--#--'.GetMessage("WZD_OPTION_0").'--,--PROPERTY_'.$arProperty["BNR_TOP"].'--#--'.GetMessage("WZD_OPTION_354").'--,--PROPERTY_'.$arProperty["BNR_TOP_IMG"].'--#--'.GetMessage("WZD_OPTION_44").'--,--PROPERTY_'.$arProperty["BNR_TOP_BG"].'--#--'.GetMessage("WZD_OPTION_50").'--,--PROPERTY_'.$arProperty["CODE_TEXT"].'--#--'.GetMessage("WZD_OPTION_22").'--,--PROPERTY_'.$arProperty["BANNER_IMG_ANIMATION"].'--#--'.GetMessage("WZD_OPTION_236").'--,--PROPERTY_'.$arProperty["BUTTON1CLASS"].'--#--'.GetMessage("WZD_OPTION_356").'--,--PROPERTY_'.$arProperty["BUTTON2CLASS"].'--#--'.GetMessage("WZD_OPTION_240").'--;--cedit4--#--'.GetMessage("WZD_OPTION_54").'--,--PROPERTY_'.$arProperty["VIDEO_IFRAME"].'--#--'.GetMessage("WZD_OPTION_60").'--,--PROPERTY_'.$arProperty["VIDEO"].'--#--'.GetMessage("WZD_OPTION_62").'--;--edit14--#--'.GetMessage("WZD_OPTION_78").'--,--IPROPERTY_TEMPLATES_ELEMENT_META_TITLE--#--'.GetMessage("WZD_OPTION_80").'--,--IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS--#--'.GetMessage("WZD_OPTION_82").'--,--IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION--#--'.GetMessage("WZD_OPTION_84").'--,--IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE--#--'.GetMessage("WZD_OPTION_86").'--,--IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE--#--'.GetMessage("WZD_OPTION_88").'--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT--#--'.GetMessage("WZD_OPTION_90").'--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE--#--'.GetMessage("WZD_OPTION_92").'--,--IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME--#--'.GetMessage("WZD_OPTION_94").'--,--IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE--#--'.GetMessage("WZD_OPTION_96").'--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT--#--'.GetMessage("WZD_OPTION_90").'--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE--#--'.GetMessage("WZD_OPTION_92").'--,--IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME--#--'.GetMessage("WZD_OPTION_94").'--,--SEO_ADDITIONAL--#--'.GetMessage("WZD_OPTION_98").'--,--TAGS--#--'.GetMessage("WZD_OPTION_100").'--;--edit2--#--'.GetMessage("WZD_OPTION_102").'--,--SECTIONS--#--'.GetMessage("WZD_OPTION_102").'--;--cedit2--#--'.GetMessage("WZD_OPTION_358").'--,--PROPERTY_'.$arProperty["FILTER_PRICE"].'--#--'.GetMessage("WZD_OPTION_360").'--;----#--'.GetMessage("WZD_OPTION_104").'--;--',
	));
	// list user options
	CUserOptions::SetOption("list", "tbl_iblock_list_".md5($iblockTYPE.".".$iblockID), array(
		'columns' => 'NAME,ACTIVE,PREVIEW_PICTURE,DETAIL_PICTURE,PROPERTY_'.$arProperty["PRICE"].',PROPERTY_'.$arProperty["PRICEOLD"].',SORT,ID', 'by' => 'timestamp_x', 'order' => 'desc', 'page_size' => '20',
	));
}

if($iblockID){
	// replace macros IBLOCK_TYPE & IBLOCK_ID & IBLOCK_CODE
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_CATALOG_TYPE" => $iblockTYPE));
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_CATALOG_ID" => $iblockID));
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_CATALOG_CODE" => $iblockCODE));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_CATALOG_ID" => $iblockID));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_CATALOG_TYPE" => $iblockTYPE));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_CATALOG_CODE" => $iblockCODE));

	$tarifsIBlockID = CCache::$arIBlocks[WIZARD_SITE_ID]["aspro_priority_catalog"]["aspro_priority_tarif"][0];
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("TARIFS_IBLOCK_ID" => $tarifsIBlockID));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("TARIFS_IBLOCK_ID" => $tarifsIBlockID));
}
?>
