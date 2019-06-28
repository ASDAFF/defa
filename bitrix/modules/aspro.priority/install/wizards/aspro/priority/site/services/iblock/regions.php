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

$iblockShortCODE = "regions";
$iblockXMLFile = WIZARD_SERVICE_RELATIVE_PATH."/xml/".LANGUAGE_ID."/".$iblockShortCODE.".xml";
$iblockTYPE = "aspro_priority_regionality";
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

	// edit form user options
	CUserOptions::SetOption("form", "form_element_".$iblockID, array(
		"tabs" => 'edit1--#--'.GetMessage("WZD_OPTION_182").'--,--ID--#--'.GetMessage("WZD_OPTION_362").'--,--ACTIVE--#--'.GetMessage("WZD_OPTION_2").'--,--NAME--#--'.GetMessage("WZD_OPTION_8").'--,--CODE--#--'.GetMessage("WZD_OPTION_10").'--,--SORT--#--'.GetMessage("WZD_OPTION_12").'--,--PROPERTY_'.$arProperty["DEFAULT"].'--#--'.GetMessage("WZD_OPTION_526").'--,--PROPERTY_'.$arProperty["FAVORIT_LOCATION"].'--#--'.GetMessage("WZD_OPTION_528").'--;--cedit4--#--'.GetMessage("WZD_OPTION_530").'--,--PROPERTY_'.$arProperty["MAIN_DOMAIN"].'--#--'.GetMessage("WZD_OPTION_532").'--,--PROPERTY_'.$arProperty["DOMAINS"].'--#--'.GetMessage("WZD_OPTION_530").'--;--cedit1--#--'.GetMessage("WZD_OPTION_534").'--,--PROPERTY_'.$arProperty["PHONES"].'--#--'.GetMessage("WZD_OPTION_142").'--,--PROPERTY_'.$arProperty["ADDRESS"].'--#--'.GetMessage("WZD_OPTION_536").'--,--PROPERTY_'.$arProperty["EMAIL"].'--#--'.GetMessage("WZD_OPTION_138").'--;--cedit3--#--'.GetMessage("WZD_OPTION_538").'--,--PROPERTY_'.$arProperty["REGION_NAME_DECLINE_PP"].'--#--'.GetMessage("WZD_OPTION_540").'--,--PROPERTY_'.$arProperty["REGION_NAME_DECLINE_RP"].'--#--'.GetMessage("WZD_OPTION_542").'--,--PROPERTY_'.$arProperty["REGION_NAME_DECLINE_TP"].'--#--'.GetMessage("WZD_OPTION_544").'--;--cedit2--#--'.GetMessage("WZD_OPTION_100").'--,--PROPERTY_'.$arProperty["REGION_TAG_TEST"].'--#--'.GetMessage("WZD_OPTION_546").'--,--PROPERTY_'.$arProperty["REGION_TAG_TEST2"].'--#--'.GetMessage("WZD_OPTION_548").'--;--edit2--#--'.GetMessage("WZD_OPTION_102").'--,--SECTIONS--#--'.GetMessage("WZD_OPTION_102").'--;----#--'.GetMessage("WZD_OPTION_104").'--;--',
	));
	// list user options
	CUserOptions::SetOption("list", "tbl_iblock_list_".md5($iblockTYPE.".".$iblockID), array(
		'columns' => 'NAME,ACTIVE,SORT,TIMESTAMP_X,ID,PROPERTY_'.$arProperty["DEFAULT"].',PROPERTY_'.$arProperty["FAVORIT_LOCATION"].',PROPERTY_'.$arProperty["ADDRESS"].'', 'by' => 'timestamp_x', 'order' => 'desc', 'page_size' => '20',
	));
}

if($iblockID){
	$file_robots = str_replace('//', '/', WIZARD_SITE_PATH.'/');
	$file_access = str_replace('//', '/', WIZARD_SITE_PATH.'/.htaccess');
	if(!file_exists($file_robots.'robots.txt'))
	{
		@copy($_SERVER["DOCUMENT_ROOT"].WIZARD_SERVICE_RELATIVE_PATH.'/files/robots.txt', $file_robots.'robots.txt');
		$arFile = file($file_robots.'robots.txt');
		foreach($arFile as $key => $str)
		{
			if(strpos($str, "Host" ) !== false)
				$arFile[$key] = "Host: ".(CMain::isHTTPS() ? "https://" : "http://").$server_host."\r\n";
			if(strpos($str, "Sitemap" ) !== false)
				$arFile[$key] = "Sitemap: ".(CMain::isHTTPS() ? "https://" : "http://").$server_host."/sitemap.xml\r\n";
		}
		$strr = implode("", $arFile);
		file_put_contents($file_robots.'robots.txt', $strr);	
	}
	if(!file_exists($file_access))
	{
		@copy($_SERVER["DOCUMENT_ROOT"].WIZARD_SERVICE_RELATIVE_PATH.'/files/.htaccess', $file_access);
	}
	else
	{
		if(!file_exists($file_access.'_back'))
			@copy($file_access, $file_access.'_back');

		$file = file_get_contents($file_access);
		if(strpos($file, "ASPRO_ROBOTS" ) === false && strpos($file, "RewriteEngine On" ) !== false)
		{
			$file = str_replace("RewriteEngine On", "RewriteEngine On
			\r\n\t# ASPRO_ROBOTS Serve robots.txt with robots.php only if the latter exists
	RewriteCond %{REQUEST_FILENAME} robots.txt
	RewriteCond %{DOCUMENT_ROOT}/robots.php -f
	RewriteRule ^(.*)$ /robots.php [L]", $file);
			file_put_contents($file_access, $file);	
		}		
	}

	$arItems = array();
	$rsItems = CIBlockElement::GetList(array(), array("IBLOCK_ID" => $iblockID));
	while($arItem = $rsItems->Fetch())
	{
		$arProperty = CIBlockElement::GetProperty($arItem["IBLOCK_ID"], $arItem["ID"], "sort", "asc", array("CODE" => "MAIN_DOMAIN"))->Fetch();
		if(!file_exists($file_robots.'aspro_regions/robots/robots_'.$arProperty["VALUE"].'.txt' ) && $arProperty["VALUE"])
		{			
			@copy($file_robots.'robots.txt', $file_robots.'aspro_regions/robots/robots_'.$arProperty["VALUE"].'.txt' );
			$arFile = file($file_robots.'aspro_regions/robots/robots_'.$arProperty["VALUE"].'.txt');
			foreach($arFile as $key => $str)
			{
				if(strpos($str, "Host" ) !== false)
					$arFile[$key] = "Host: ".$arProperty["VALUE"]."\r\n";
				if(strpos($str, "Sitemap" ) !== false)
					$arFile[$key] = "Sitemap: ".(CMain::isHTTPS() ? "https://" : "http://").$arProperty["VALUE"]."/sitemap.xml\r\n";
			}
			$strr = implode('', $arFile);
			file_put_contents($file_robots.'aspro_regions/robots/robots_'.$arProperty["VALUE"].'.txt', $strr);
		}
		$arItems[] = $arItem;
	}	
	// replace macros IBLOCK_TYPE & IBLOCK_ID & IBLOCK_CODE
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_REGIONS_TYPE" => $iblockTYPE));
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_REGIONS_ID" => $iblockID));
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("IBLOCK_REGIONS_CODE" => $iblockCODE));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_REGIONS_TYPE" => $iblockTYPE));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_REGIONS_ID" => $iblockID));
	CWizardUtil::ReplaceMacrosRecursive($bitrixTemplateDir, Array("IBLOCK_REGIONS_CODE" => $iblockCODE));
}
?>
