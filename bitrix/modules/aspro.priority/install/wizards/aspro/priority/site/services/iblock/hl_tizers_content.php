<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)	die();

if(!defined("WIZARD_SITE_ID")) return;
if(!defined("WIZARD_SITE_DIR")) return;
if(!defined("WIZARD_SITE_PATH")) return;
if(!defined("WIZARD_TEMPLATE_ID")) return;
if(!defined("WIZARD_TEMPLATE_ABSOLUTE_PATH")) return;
if(!defined("WIZARD_THEME_ID")) return;

$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".WIZARD_TEMPLATE_ID."/";
//$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"]."/local/templates/".WIZARD_TEMPLATE_ID."/";	

set_time_limit(0);

if (!CModule::IncludeModule("highloadblock"))
	return;

if (!WIZARD_INSTALL_DEMO_DATA)
	return;

$HL_ID = $_SESSION["PRIORITY_HBLOCK_TIZERS_ID"];
unset($_SESSION["PRIORITY_HBLOCK_TIZERS_ID"]);

//adding rows
WizardServices::IncludeServiceLang("references.php", LANGUAGE_ID);

use Bitrix\Highloadblock as HL;
global $USER_FIELD_MANAGER;

if($HL_ID){
	$hldata = HL\HighloadBlockTable::getById($HL_ID)->fetch();
	$hlentity = HL\HighloadBlockTable::compileEntity($hldata);

	$entity_data_class = $hlentity->getDataClass();
	$arProfits = array(
		"PRIVACY" => array(
			"IMAGE" => "references_files/iblock/02e/aae2db0a8a1ad2e2a26b094c90f3aef5.svg",
			"XML_ID" => "privacy",			
		),
		"COMPANIES" => array(
			"IMAGE" => "references_files/iblock/94c/2aa97d15461c6951ca91adf6ddc60053.svg",
			"XML_ID" => "companies",
		),
		"GUARANTIE" => array(
			"IMAGE" => "references_files/iblock/95e/8a5eccd45973bbde97f9551c72aaeab0.svg",
			"XML_ID" => "guarantie",
		),
		"MOBILITY" => array(
			"IMAGE" => "references_files/iblock/364/cb3c0c28a0744b5f53ce259661283bf4.svg",
			"XML_ID" => "mobility",
		),
	);
	$sort = 100;
	foreach($arProfits as $profitName => $arFile){
		$arData = array(
			'UF_NAME' => GetMessage("WZD_REF_PROFIT_".$profitName),
			'UF_FILE' =>
				array (
					'name' => ToLower($profitName).".svg",
					'type' => 'image/svg+xml',
					'tmp_name' => WIZARD_ABSOLUTE_PATH."/site/services/iblock/".$arFile["IMAGE"]
				),
			'UF_SORT' => $sort,
			// 'UF_DEF' => ($sort > 100) ? "0" : "1",
			'UF_XML_ID' => ($arFile["XML_ID"] ? $arFile["XML_ID"] : ToLower($profitName))
		);
		if(strlen(GetMessage("WZD_REF_PROFIT_".$profitName.'_DESC')))
			$arData["UF_DESCRIPTION"]=GetMessage("WZD_REF_PROFIT_".$profitName.'_DESC');//$arFile["DESC"];
		if($arFile["LINK"]){
			$arData["UF_LINK"]=$arFile["LINK"];
		}
		$USER_FIELD_MANAGER->EditFormAddFields('HLBLOCK_'.$HL_ID, $arData);
		$USER_FIELD_MANAGER->checkFields('HLBLOCK_'.$HL_ID, null, $arData);
		$result = $entity_data_class::add($arData);
		$sort += 100;
	}
}
?>