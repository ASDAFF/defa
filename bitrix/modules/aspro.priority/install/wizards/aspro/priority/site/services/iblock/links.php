<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock")) return;
if(!CModule::IncludeModule("aspro.priority")) return;
	
if(!defined("WIZARD_SITE_ID")) return;
if(!defined("WIZARD_SITE_DIR")) return;
if(!defined("WIZARD_SITE_PATH")) return;
if(!defined("WIZARD_TEMPLATE_ID")) return;
if(!defined("WIZARD_TEMPLATE_ABSOLUTE_PATH")) return;
if(!defined("WIZARD_THEME_ID")) return;
use \Bitrix\Main\Config\Option;
\Bitrix\Main\Loader::includeModule('iblock');
$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".WIZARD_TEMPLATE_ID."/";
//$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"]."/local/templates/".WIZARD_TEMPLATE_ID."/";

// iblocks ids
$servicesIBlockID = CCache::$arIBlocks[WIZARD_SITE_ID]["aspro_priority_content"]["aspro_priority_services"][0];
$staffIBlockID = CCache::$arIBlocks[WIZARD_SITE_ID]["aspro_priority_content"]["aspro_priority_staff"][0];
$reviewsIBlockID = CCache::$arIBlocks[WIZARD_SITE_ID]["aspro_priority_form"]["aspro_priority_add_review"][0];
$projectsIBlockID = CCache::$arIBlocks[WIZARD_SITE_ID]["aspro_priority_content"]["aspro_priority_projects"][0];
$catalogIBlockID = CCache::$arIBlocks[WIZARD_SITE_ID]["aspro_priority_catalog"]["aspro_priority_catalog"][0];
$partnerIBlockID = CCache::$arIBlocks[WIZARD_SITE_ID]["aspro_priority_content"]["aspro_priority_partners"][0];
$newsIBlockID = CCache::$arIBlocks[WIZARD_SITE_ID]["aspro_priority_content"]["aspro_priority_news"][0];
$faqIBlockID = CCache::$arIBlocks[WIZARD_SITE_ID]["aspro_priority_content"]["aspro_priority_faq"][0];
$vacancyIBlockID = CCache::$arIBlocks[WIZARD_SITE_ID]["aspro_priority_content"]["aspro_priority_vacancy"][0];
$manufacturesIBlockID = CCache::$arIBlocks[WIZARD_SITE_ID]["aspro_priority_content"]["aspro_priority_manufactures"][0];
$tizersIBlockID = CCache::$arIBlocks[WIZARD_SITE_ID]["aspro_priority_content"]["aspro_priority_tizers"][0];
$companyIBlockID = CCache::$arIBlocks[WIZARD_SITE_ID]["aspro_priority_content"]["aspro_priority_static"][0];
$tarifsIBlockID = CCache::$arIBlocks[WIZARD_SITE_ID]["aspro_priority_catalog"]["aspro_priority_tarif"][0];

// XML_ID => ID (here XML_ID - old ID, ID - new ID)
$arStatics = CCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CCache::GetIBlockCacheTag($companyIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $companyIBlockID), false, false, array("ID", "XML_ID"));

//update company id on front page
if($arStatics && $arStatics["945"]){
	//CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH.'include/mainpage/components/company/company_1.php', Array("COMPANY_ELEMENT_ID" => $arStatics["945"]));
	//CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH.'include/mainpage/components/company/company_2.php', Array("COMPANY_ELEMENT_ID" => $arStatics["945"]));
	//CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH.'include/mainpage/components/company/company_3.php', Array("COMPANY_ELEMENT_ID" => $arStatics["945"]));
	//CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH.'include/mainpage/components/company/company_4.php', Array("COMPANY_ELEMENT_ID" => $arStatics["945"]));
	//CWizardUtil::ReplaceMacrosRecursive(WIZARD_SITE_PATH.'include/mainpage/components/info/info.php', Array("COMPANY_ELEMENT_ID" => $arStatics["945"]));
	CWizardUtil::ReplaceMacrosRecursive(str_replace('//', '/', WIZARD_SITE_PATH.'/include/'), Array("COMPANY_ELEMENT_ID" => $arStatics["945"]));
	CWizardUtil::ReplaceMacros($bitrixTemplateDir.'/components/bitrix/news/vacancy/page_blocks/list_elements_1.php', Array("COMPANY_ELEMENT_ID" => $arStatics["945"]));
	CWizardUtil::ReplaceMacros($bitrixTemplateDir.'/components/bitrix/news/vacancy/page_blocks/list_elements_2.php', Array("COMPANY_ELEMENT_ID" => $arStatics["945"]));
}

$arServices = CCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CCache::GetIBlockCacheTag($servicesIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $servicesIBlockID), false, false, array("ID", "XML_ID"));
$arStaff = CCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CCache::GetIBlockCacheTag($staffIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $staffIBlockID), false, false, array("ID", "XML_ID"));
$arCatalog = CCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CCache::GetIBlockCacheTag($catalogIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $catalogIBlockID), false, false, array("ID", "XML_ID"));
$arProjects = CCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CCache::GetIBlockCacheTag($projectsIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $projectsIBlockID), false, false, array("ID", "XML_ID"));
$arReviews = CCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CCache::GetIBlockCacheTag($reviewsIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $reviewsIBlockID), false, false, array("ID", "XML_ID"));
$arNews = CCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CCache::GetIBlockCacheTag($newsIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $newsIBlockID), false, false, array("ID", "XML_ID"));
$arPartners = CCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CCache::GetIBlockCacheTag($partnerIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $partnerIBlockID), false, false, array("ID", "XML_ID"));
$arFaq = CCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CCache::GetIBlockCacheTag($faqIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $faqIBlockID), false, false, array("ID", "XML_ID"));
$arVacancy = CCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CCache::GetIBlockCacheTag($vacancyIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $vacancyIBlockID), false, false, array("ID", "XML_ID"));
$arManufactures = CCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CCache::GetIBlockCacheTag($manufacturesIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $manufacturesIBlockID), false, false, array("ID", "XML_ID"));
$arTizers = CCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CCache::GetIBlockCacheTag($tizersIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $tizersIBlockID), false, false, array("ID", "XML_ID"));
$arTarifs = CCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CCache::GetIBlockCacheTag($tarifsIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $tarifsIBlockID), false, false, array("ID", "XML_ID"));

// update properties link goods
$dbRes = CIBlockProperty::GetList(array(), array('SITE_ID' => WIZARD_SITE_ID, 'CODE' => 'LINK_GOODS'));
while($arRes = $dbRes->Fetch()){
	$ibp = new CIBlockProperty;
	$ibp->Update($arRes['ID'], array('LINK_IBLOCK_ID' => $catalogIBlockID));
}

// update properties link news
$dbRes = CIBlockProperty::GetList(array(), array('SITE_ID' => WIZARD_SITE_ID, 'CODE' => 'LINK_SALE'));
while($arRes = $dbRes->Fetch()){
	$ibp = new CIBlockProperty;
	$ibp->Update($arRes['ID'], array('LINK_IBLOCK_ID' => $newsIBlockID));
}

// update services link news
$dbRes = CIBlockProperty::GetList(array(), array('SITE_ID' => WIZARD_SITE_ID, 'CODE' => 'LINK_SERVICES'));
while($arRes = $dbRes->Fetch()){
	$ibp = new CIBlockProperty;
	$ibp->Update($arRes['ID'], array('LINK_IBLOCK_ID' => $servicesIBlockID));
}

// update links in services
CIBlockElement::SetPropertyValuesEx($arServices["1565"], $servicesIBlockID, array('LINK_FAQ' => array($arFaq['4']), 'LINK_SALE' => array($arNews['1604']), 'LINK_SERVICES' => array($arServices['1567'])));
CIBlockElement::SetPropertyValuesEx($arServices["1566"], $servicesIBlockID, array('LINK_PROJECTS' => array($arProjects['1692']), 'LINK_SALE' => array($arNews['1604']), 'LINK_STAFF' => array($arStaff['48']), 'LINK_SERVICES' => array($arServices['1567'])));
CIBlockElement::SetPropertyValuesEx($arServices["1572"], $servicesIBlockID, array("LINK_SALE" => array($arNews["1604"], $arCatalog["924"]), 'LINK_PROJECTS' => array($arProjects['1665'])));
CIBlockElement::SetPropertyValuesEx($arServices["1575"], $servicesIBlockID, array("LINK_SALE" => array($arNews["1604"]), 'LINK_PARTNERS' => array($arPartners['27']), 'LINK_STAFF' => array($arStaff['228'])));
CIBlockElement::SetPropertyValuesEx($arServices["1576"], $servicesIBlockID, array("LINK_PARTNERS" => array($arPartners["28"]), 'LINK_GOODS' => array($arCatalog['1735'], $arCatalog['1739'], $arCatalog['1737'], $arCatalog['1738']), 'LINK_STAFF' => array($arStaff['228']), 'LINK_TARIFS' => array($arTarifs['1920'], $arTarifs['1921'])));
CIBlockElement::SetPropertyValuesEx($arServices["1577"], $servicesIBlockID, array('LINK_TARIFS' => array($arTarifs['1922'], $arTarifs['1923'])));

// update links in news
CIBlockElement::SetPropertyValuesEx($arNews["1605"], $newsIBlockID, array("LINK_PROJECTS" => array($arProjects["1662"]), "LINK_SERVICES" => array($arServices["1567"])));
CIBlockElement::SetPropertyValuesEx($arNews["1607"], $newsIBlockID, array("LINK_FAQ" => array($arFaq["3"]), "LINK_STAFF" => array($arStaff["230"])));
CIBlockElement::SetPropertyValuesEx($arNews["1695"], $newsIBlockID, array("LINK_PROJECTS" => array($arProjects["1693"]), "LINK_STAFF" => array($arStaff["230"], $arStaff["229"], $arStaff["228"]), 'LINK_STAFF' => array($arStaff['1573'])));

// update links in projects
CIBlockElement::SetPropertyValuesEx($arProjects["1665"], $projectsIBlockID, array("LINK_REVIEWS" => array($arReviews["1670"]), "LINK_PARTNERS" => array($arPartners["67"]), 'LINK_STAFF' => array($arStaff['929'])));
CIBlockElement::SetPropertyValuesEx($arNews["1607"], $newsIBlockID, array("LINK_FAQ" => array($arFaq["3"]), "LINK_STAFF" => array($arStaff["230"])));
CIBlockElement::SetPropertyValuesEx($arNews["1693"], $newsIBlockID, array("LINK_STAFF" => array($arStaff["228"]), "LINK_SERVICES" => array($arServices["1573"])));

// update links in vacancy
CIBlockElement::SetPropertyValuesEx($arVacancy["934"], $vacancyIBlockID, array("LINK_STAFF" => array($arStaff["48"], $arStaff['929'], $arStaff['928']), "LINK_SERVICES" => array($arServices["1567"])));

// update links in staff
CIBlockElement::SetPropertyValuesEx($arStaff["48"], $staffIBlockID, array("LINK_SALE" => array($arNews["1605"], $arNews['1604']), "LINK_PROJECTS" => array($arProjects["1663"])));
CIBlockElement::SetPropertyValuesEx($arStaff["230"], $staffIBlockID, array("LINK_SALE" => array($arNews["1604"]), "LINK_PROJECTS" => array($arProjects["1663"])));

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

$iblockContacts = CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_contact"][0];
$arContactElement = CIBlockElement::GetList(array(), array('IBLOCK_ID' => $iblockContacts, '!PROPERTY_MAIN_OFFICE' => false), false, false, array('ID', 'IBLOCK_ID', 'PROPERTY_MAP'))->Fetch();

CIBlockElement::SetPropertyValues($arContactElement['ID'], $arContactElement['IBLOCK_ID'], array('PHONE' => $sitePhone, 'EMAIL' => $siteEmail, 'SCHEDULE' => $siteSchedule, 'MAP' => $arContactElement['PROPERTY_MAP_VALUE']));
            
$arPropertyEnum = CIBlockPropertyEnum::GetList(array(), array("IBLOCK_ID" => $arContactElement['IBLOCK_ID'], "CODE" => "MAIN_OFFICE", 'VALUE' => 'Y'))->Fetch();
CIBlockElement::SetPropertyValuesEx($arContactElement['ID'], $arContactElement['IBLOCK_ID'], array('MAIN_OFFICE' => array('VALUE' => $arPropertyEnum['ID'])));
$contactElement = new CIBlockElement;
$contactElement->Update($arContactElement['ID'], array('NAME' => $siteAddress, 'CODE' => Cutil::translit($siteAddress, LANGUAGE_ID, array("replace_space"=>"-","replace_other"=>"-"))));

/*print_r($arProjects);
die();*/

// iblock user fields
$dbSite = CSite::GetByID(WIZARD_SITE_ID);
if($arSite = $dbSite -> Fetch()) $lang = $arSite["LANGUAGE_ID"];
if(!strlen($lang)) $lang = "ru";
WizardServices::IncludeServiceLang("links", $lang);

// clear and update list of UF_VIEWTYPE in some catalog sections
$arUserFieldViewType = CUserTypeEntity::GetList(array(), array("ENTITY_ID" => "IBLOCK_".$catalogIBlockID."_SECTION", "FIELD_NAME" => "UF_VIEWTYPE"))->Fetch();
$resUserFieldViewTypeEnum = CUserFieldEnum::GetList(array(), array("USER_FIELD_ID" => $arUserFieldViewType["ID"]));
while($arUserFieldViewTypeEnum = $resUserFieldViewTypeEnum->GetNext()){
	$obEnum = new CUserFieldEnum;
	$obEnum->SetEnumValues($arUserFieldViewType["ID"], array($arUserFieldViewTypeEnum["ID"] => array("DEL" => "Y")));
}
$obEnum = new CUserFieldEnum;
$obEnum->SetEnumValues($arUserFieldViewType["ID"], array(
	"n0" => array(
		"VALUE" => GetMessage("WZD_UFIELDENUM_TABLE"),
		"XML_ID" => "table",
	),
	"n1" => array(
		"VALUE" => GetMessage("WZD_UFIELDENUM_LIST"),
		"XML_ID" => "list",
	),
	"n2" => array(
		"VALUE" => GetMessage("WZD_UFIELDENUM_PRICE"),
		"XML_ID" => "price",
	),
));
$resUserFieldViewTypeEnum = CUserFieldEnum::GetList(array(), array("USER_FIELD_ID" => $arUserFieldViewType["ID"]));
while($arUserFieldViewTypeEnum = $resUserFieldViewTypeEnum->GetNext()){
	$arUserFieldViewTypeEnums[$arUserFieldViewTypeEnum["XML_ID"]] = $arUserFieldViewTypeEnum["ID"];
}

$arCatalog = CCache::CIBlockSection_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CCache::GetIBlockCacheTag($catalogIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $catalogIBlockID), false, array("ID", "XML_ID"));
$bs = new CIBlockSection;
$res = $bs->Update($arCatalog["19"], array("UF_VIEWTYPE" => $arUserFieldViewTypeEnums["list"]));
$res = $bs->Update($arCatalog["31"], array("UF_VIEWTYPE" => $arUserFieldViewTypeEnums["list"]));

// add top seo prop to catalog
$arFields = array(
	"FIELD_NAME" => "UF_TOP_SEO",
	"USER_TYPE_ID" => "string",
	"XML_ID" => "UF_TOP_SEO",
	"SORT" => 100,
	"MULTIPLE" => "N",
	"MANDATORY" => "N",
	"SHOW_FILTER" => "I",
	"SHOW_IN_LIST" => "Y",
	"EDIT_IN_LIST" => "Y",
	"IS_SEARCHABLE" => "N",
	"SETTINGS" => array(
		"SIZE" => 100,
		"ROWS" => 100,
	)
);
$arLangs = array(
	"EDIT_FORM_LABEL"   => array(
        "ru"    => GetMessage("SEO_PREVIEW_TEXT"),
        "en"    => "SEO_PREVIEW_TEXT",
    ),
    "LIST_COLUMN_LABEL" => array(
        "ru"    => GetMessage("SEO_PREVIEW_TEXT"),
        "en"    => "SEO_PREVIEW_TEXT",
    )
);
$arUserFieldTopSeo = CUserTypeEntity::GetList(array(), array("ENTITY_ID" => "IBLOCK_".$catalogIBlockID."_SECTION", "FIELD_NAME" => "UF_TOP_SEO"))->Fetch();
if(!$arUserFieldTopSeo)
{
	$ob = new CUserTypeEntity();
	$FIELD_ID = $ob->Add(array_merge($arFields, array("ENTITY_ID" => "IBLOCK_".$catalogIBlockID."_SECTION"), $arLangs));
}
else
{
	$ob = new CUserTypeEntity();
	$ob->Update($arUserFieldTopSeo["ID"], $arLangs);
}

$arUserFieldTopSeo = CUserTypeEntity::GetList(array(), array("ENTITY_ID" => "IBLOCK_".$servicesIBlockID."_SECTION", "FIELD_NAME" => "UF_TOP_SEO"))->Fetch();
if(!$arUserFieldTopSeo)
{
	$ob = new CUserTypeEntity();
	$FIELD_ID = $ob->Add(array_merge($arFields, array("ENTITY_ID" => "IBLOCK_".$servicesIBlockID."_SECTION"), $arLangs));
}
else
{
	$ob = new CUserTypeEntity();
	$ob->Update($arUserFieldTopSeo["ID"], $arLangs);
}

$arServices = CCache::CIBlockSection_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CCache::GetIBlockCacheTag($servicesIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $servicesIBlockID), false, array("ID", "XML_ID"));
$bs = new CIBlockSection;
$res = $bs->Update($arCatalog["4"], array("UF_TOP_SEO" => GetMessage("SECTION_4")));
$res = $bs->Update($arCatalog["6"], array("UF_TOP_SEO" => GetMessage("SECTION_6")));
?>