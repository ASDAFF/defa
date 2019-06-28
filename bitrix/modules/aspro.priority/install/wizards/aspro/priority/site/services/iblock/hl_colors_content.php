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

$HL_ID = $_SESSION["PRIORITY_HBLOCK_COLORS_ID"];
unset($_SESSION["PRIORITY_HBLOCK_COLORS_ID"]);

//adding rows
WizardServices::IncludeServiceLang("references.php", LANGUAGE_ID);

use Bitrix\Highloadblock as HL;
global $USER_FIELD_MANAGER;

if($HL_ID){
	$hldata = HL\HighloadBlockTable::getById($HL_ID)->fetch();
	$hlentity = HL\HighloadBlockTable::compileEntity($hldata);

	$entity_data_class = $hlentity->getDataClass();
	$arProfits = array(
		"BLUE_METALLIC" => array(
			"IMAGE" => "references_files/iblock/7c1/7c126a07a620b334ea15616b13740e0f.jpg",
			"XML_ID" => "blue_metallic",			
		),
		"GRAY_BEIGE" => array(
			"IMAGE" => "references_files/iblock/71d/71d0cc241e2f7f15131b3756d9aea1ab.jpg",
			"XML_ID" => "gray_beige",
		),
		"RED" => array(
			"IMAGE" => "references_files/iblock/b3a/b3a2387922b447a9d98eff4722daa36f.jpg",
			"XML_ID" => "red",
		),
		"SILVER" => array(
			"IMAGE" => "references_files/iblock/a29/a29e5a4eca50e854c1961d028b36701c.jpg",
			"XML_ID" => "silver",
		),
		"WHITE" => array(
			"IMAGE" => "references_files/iblock/9fd/9fd410382b0bf8489a1205c27333fa0a.jpg",
			"XML_ID" => "white",
		),
		"WHITE_BLUE" => array(
			"IMAGE" => "references_files/iblock/07a/07a48ba1a40fd795197e8c99b3021361.jpg",
			"XML_ID" => "white_blue",
		),
	);
	$sort = 100;
	foreach($arProfits as $profitName => $arFile){
		$arData = array(
			'UF_NAME' => GetMessage("WZD_REF_PROFIT_".$profitName),
			'UF_FILE' =>
				array (
					'name' => ToLower($profitName).".jpg",
					'type' => 'image/jpg',
					'tmp_name' => WIZARD_ABSOLUTE_PATH."/site/services/iblock/".$arFile["IMAGE"]
				),
			'UF_SORT' => $sort,
			// 'UF_DEF' => ($sort > 100) ? "0" : "1",
			'UF_XML_ID' => ($arFile["XML_ID"] ? $arFile["XML_ID"] : ToLower($profitName))
		);
		if(strlen(GetMessage("WZD_REF_PROFIT_".$profitName.'_DESC')))
			$arData["UF_DESCRIPTION"]=GetMessage("WZD_REF_PROFIT_".$profitName.'_DESC');//$arFile["DESC"];
		/*if($arFile["LINK"]){
			$arData["UF_LINK"]=$arFile["LINK"];
		}*/
		$USER_FIELD_MANAGER->EditFormAddFields('HLBLOCK_'.$HL_ID, $arData);
		$USER_FIELD_MANAGER->checkFields('HLBLOCK_'.$HL_ID, null, $arData);
		$result = $entity_data_class::add($arData);
		$sort += 100;
	}
}
?>