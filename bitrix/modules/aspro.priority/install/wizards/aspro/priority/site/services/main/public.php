<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!defined("WIZARD_SITE_ID")) return;
if(!defined("WIZARD_SITE_DIR")) return;
if(!defined("WIZARD_SITE_PATH")) return;

function ___writeToAreasFile($fn, $text){
	if(file_exists($fn) && !is_writable($abs_path) && defined("BX_FILE_PERMISSIONS")){
		@chmod($abs_path, BX_FILE_PERMISSIONS);
	}
	if(!$fd = @fopen($fn, "wb")){
		return false;
	}
	if(!$res = @fwrite($fd, $text)){
		@fclose($fd);
		return false;
	}
	@fclose($fd);
	if(defined("BX_FILE_PERMISSIONS"))
		@chmod($fn, BX_FILE_PERMISSIONS);
}

$bitrixTemplatePath = BX_PERSONAL_ROOT."/templates/".WIZARD_TEMPLATE_ID;
$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"].$bitrixTemplatePath."/";
//$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"]."/local/templates/".WIZARD_TEMPLATE_ID."/";
$wizard =& $this->GetWizard();
use \Bitrix\Main\Config\Option;

if(Option::get("main", "upload_dir") == "")
	Option::set("main", "upload_dir", "upload");


if(Option::get("aspro.priority", "wizard_installed", "N") == 'N'){
	// if need add to init.php
	//$file = fopen(WIZARD_SITE_ROOT_PATH."/bitrix/php_interface/init.php", "ab");
	//fwrite($file, file_get_contents(WIZARD_ABSOLUTE_PATH."/site/services/main/bitrix/init.php"));
	//fclose($file);

	Option::set("aspro.priority", "wizard_installed", "Y");
}

if(WIZARD_INSTALL_DEMO_DATA){
	// copy files
	CopyDirFiles(
		str_replace("//", "/", WIZARD_ABSOLUTE_PATH."/site/public/".LANGUAGE_ID."/"),
		WIZARD_SITE_PATH,
		$rewrite = true, 
		$recursive = true,
		$delete_after_copy = false,
		$exclude = "bitrix"
	);

	// favicon
	//@copy(WIZARD_THEME_ABSOLUTE_PATH."/favicon.ico", WIZARD_SITE_PATH."favicon.ico");
	
	// .htaccess
	WizardServices::PatchHtaccess(WIZARD_SITE_PATH);
	
	// replace macros SITE_DIR & SITE_ID
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("SITE_DIR" => WIZARD_SITE_DIR));
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("SITE_ID" => WIZARD_SITE_ID));

	// add to UrlRewrite
	$arUrlRewrite = array(); 
	if(file_exists(WIZARD_SITE_ROOT_PATH."/urlrewrite.php")){
		include(WIZARD_SITE_ROOT_PATH."/urlrewrite.php");
	}
	
	$arNewUrlRewrite = array(
		array(
			"CONDITION" => "#^".WIZARD_SITE_DIR."bitrix/services/ymarket/#",
			"RULE" => "",
			"ID" => "",
			"PATH" => WIZARD_SITE_DIR."bitrix/services/ymarket/index.php",
		),
		array(
			"CONDITION" => "#^".WIZARD_SITE_DIR."company/partners/#",
			"RULE" => "",
			"ID" => "bitrix:news",
			"PATH" => WIZARD_SITE_DIR."company/partners/index.php",
		),
		array(
			"CONDITION" => "#^".WIZARD_SITE_DIR."company/reviews/#",
			"RULE" => "",
			"ID" => "bitrix:news",
			"PATH" => WIZARD_SITE_DIR."company/reviews/index.php",
		),
		array(
			"CONDITION" => "#^".WIZARD_SITE_DIR."company/vacancy/#",
			"RULE" => "",
			"ID" => "bitrix:news",
			"PATH" => WIZARD_SITE_DIR."company/vacancy/index.php",
		),
		array(
			"CONDITION" => "#^".WIZARD_SITE_DIR."company/staff/#",
			"RULE" => "",
			"ID" => "bitrix:news",
			"PATH" => WIZARD_SITE_DIR."company/staff/index.php",
		),
		array(
			"CONDITION" => "#^".WIZARD_SITE_DIR."company/docs/#",
			"RULE" => "",
			"ID" => "bitrix:news",
			"PATH" => WIZARD_SITE_DIR."company/docs/index.php",
		),
		array(
			"CONDITION" => "#^".WIZARD_SITE_DIR."articles/#",
			"RULE" => "",
			"ID" => "bitrix:news",
			"PATH" => WIZARD_SITE_DIR."articles/index.php",
		),
		array(
			"CONDITION" => "#^".WIZARD_SITE_DIR."projects/#",
			"RULE" => "",
			"ID" => "bitrix:news",
			"PATH" => WIZARD_SITE_DIR."projects/index.php",
		),
		array(
			"CONDITION" => "#^".WIZARD_SITE_DIR."services/#",
			"RULE" => "",
			"ID" => "bitrix:news",
			"PATH" => WIZARD_SITE_DIR."services/index.php",
		),
		array(
			"CONDITION" => "#^".WIZARD_SITE_DIR."news/#",
			"RULE" => "",
			"ID" => "bitrix:news",
			"PATH" => WIZARD_SITE_DIR."news/index.php",
		),
		array(
			"CONDITION" => "#^".WIZARD_SITE_DIR."cabinet/#",
			"RULE" => "",
			"ID" => "aspro:auth.priority",
			"PATH" => WIZARD_SITE_DIR."cabinet/index.php",
		),
		array(
			"CONDITION" => "#^".WIZARD_SITE_DIR."cabinet/news/#",
			"RULE" => "",
			"ID" => "bitrix:news",
			"PATH" => WIZARD_SITE_DIR."cabinet/news/index.php",
		),
		array(
			"CONDITION" => "#^".WIZARD_SITE_DIR."product/#",
			"RULE" => "",
			"ID" => "bitrix:news",
			"PATH" => WIZARD_SITE_DIR."product/index.php",
		),
		array(
			"CONDITION" => "#^".WIZARD_SITE_DIR."landings/#",
			"RULE" => "",
			"ID" => "bitrix:news",
			"PATH" => WIZARD_SITE_DIR."landings/index.php",
		),
		array(
			"CONDITION" => "#^".WIZARD_SITE_DIR."company/manufacturers/#",
			"RULE" => "",
			"ID" => "bitrix:news",
			"PATH" => WIZARD_SITE_DIR."company/manufacturers/index.php",
		),
		array(
			"CONDITION" => "#^".WIZARD_SITE_DIR."company/licenses/#",
			"RULE" => "",
			"ID" => "bitrix:news",
			"PATH" => WIZARD_SITE_DIR."company/licenses/index.php",
		),
	);
	
	foreach($arNewUrlRewrite as $arUrl){
		if(!in_array($arUrl, $arUrlRewrite)){
			CUrlRewriter::Add($arUrl);
		}
	}
}

CheckDirPath(WIZARD_SITE_PATH."include/");

// site name
if($wizard->GetVar('siteNameSet', true))
{
	$siteName = $wizard->GetVar("siteName");
	Option::set("main", "site_name", $siteName);	
	$obSite = new CSite;
	$arFields = array("NAME" => $siteName, "SITE_NAME" => $siteName);			
	$siteRes = $obSite->Update(WIZARD_SITE_ID, $arFields);
	CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH, Array("SITE_NAME" => $siteName));
}
// copyright
___writeToAreasFile(WIZARD_SITE_PATH."include/footer/copy.php", "&copy; <?=date('Y', time())?> ".$wizard->GetVar("siteCopy"));
// phone
$sitePhone = $wizard->GetVar("siteTelephone");
$sitePhoneAll = preg_replace('@[^\d+]*@', '', $sitePhone);
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."include/header/site-phone.php", Array("SITE_PHONEALL" => $sitePhoneAll, "SITE_PHONE" => $sitePhone));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."include/header/site-phone-one.php", Array("SITE_PHONEALL" => $sitePhoneAll, "SITE_PHONE" => $sitePhone));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."include/contacts-site-phone.php", Array("SITE_PHONE" => $sitePhone));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."include/contacts-site-phone-one.php", Array("SITE_PHONE" => $sitePhone));
$phones = Option::get('aspro.priority', "HEADER_PHONES", 1, WIZARD_SITE_ID);
Option::set('aspro.priority', "HEADER_PHONES", 1, WIZARD_SITE_ID);
Option::set('aspro.priority', "HEADER_PHONES_array_PHONE_VALUE_0", $sitePhone, WIZARD_SITE_ID);

// email
$siteEmail = $wizard->GetVar("siteEmail");
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."include/footer/site-email.php", Array("SITE_EMAIL" => $siteEmail));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."include/contacts-site-email.php", Array("SITE_EMAIL" => $siteEmail));

// address
$siteAddress = $wizard->GetVar("siteAddress");
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."include/header/site-address.php", Array("SITE_ADDRESS" => $siteAddress));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."include/contacts-site-address.php", Array("SITE_ADDRESS" => $siteAddress));

// schedule
$siteSchedule = $wizard->GetVar("siteSchedule");
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."include/contacts-site-schedule.php", Array("SITE_SCHEDULE" => $siteSchedule));

// meta
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/.section.php", array("SITE_DESCRIPTION" => htmlspecialcharsbx($wizard->GetVar("siteMetaDescription"))));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/.section.php", array("SITE_KEYWORDS" => htmlspecialcharsbx($wizard->GetVar("siteMetaKeywords"))));

\Bitrix\Main\Loader::includeModule('iblock');
$iblockContacts = CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_contact"][0];
$arContactElement = CCache::CIblockElement_GetList(array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag($iblockContacts), 'MULTI' => 'N')), array('IBLOCK_ID' => $iblockContacts, '!PROPERTY_MAIN_OFFICE' => false), false, false, array('IBLOCK_ID', 'ID'));
CIBlockElement::SetPropertyValues($arContactElement['ID'], $arContactElement['IBLOCK_ID'], array('PHONE' => $sitePhone, 'EMAIL' => $siteEmail, 'SCHEDULE' => $siteSchedule));
$contactElement = new CIBlockElement;
$contactElement->Update($arContactElement['ID'], array('NAME' => $siteAddress));

// socials
Option::set('aspro.priority', "SOCIAL_VK", $wizard->GetVar("shopVk"), WIZARD_SITE_ID);
Option::set('aspro.priority', "SOCIAL_FACEBOOK", $wizard->GetVar("shopFacebook"), WIZARD_SITE_ID);
Option::set('aspro.priority', "SOCIAL_TWITTER", $wizard->GetVar("shopTwitter"), WIZARD_SITE_ID);
Option::set('aspro.priority', "SOCIAL_YOUTUBE", $wizard->GetVar("shopYoutube"), WIZARD_SITE_ID);
Option::set('aspro.priority', "SOCIAL_INSTAGRAM", $wizard->GetVar("shopInstagram"), WIZARD_SITE_ID);
Option::set('aspro.priority', "SOCIAL_TELEGRAM", $wizard->GetVar("shopTelegram"), WIZARD_SITE_ID);
Option::set('aspro.priority', "SOCIAL_ODNOKLASSNIKI", $wizard->GetVar("shopOdnoklassniki"), WIZARD_SITE_ID);
Option::set('aspro.priority', "SOCIAL_GOOGLEPLUS", $wizard->GetVar("shopGooglePlus"), WIZARD_SITE_ID);
Option::set('aspro.priority', "SOCIAL_MAIL", $wizard->GetVar("shopMailRu"), WIZARD_SITE_ID);

// rewrite /index.php
if($wizard->GetVar('rewriteIndex', true))
{
	CopyDirFiles(
		WIZARD_ABSOLUTE_PATH."/site/public/".LANGUAGE_ID."/_index.php",
		WIZARD_SITE_PATH."/index.php",
		$rewrite = true,
		$recursive = true,
		$delete_after_copy = false
	);
	CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/_index.php", Array("SITE_DIR" => WIZARD_SITE_DIR));
	CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/index.php", Array("SITE_DIR" => WIZARD_SITE_DIR));
}

if (class_exists('\Bitrix\Main\Data\ManagedCache')) {
    (new \Bitrix\Main\Data\ManagedCache())->cleanAll();
}

CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH.'/company/index.php', Array("SITE_TEMPLATE_PATH" => $bitrixTemplatePath));

DeleteDirFilesEx(WIZARD_SITE_PATH."/.left.menu_ext.php");
DeleteDirFilesEx(WIZARD_SITE_PATH."/.bottom.menu_ext.php");
DeleteDirFilesEx(WIZARD_SITE_PATH."/.top.menu_ext.php");
DeleteDirFilesEx(WIZARD_SITE_PATH."/_index.php");
?>