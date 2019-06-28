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
	
if(!IsModuleInstalled("highloadblock") && file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/highloadblock/")){
	$installFile = $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/highloadblock/install/index.php";
	if(!file_exists($installFile))
		return false;
	include_once($installFile);

	$moduleIdTmp = str_replace(".", "_", "highloadblock");
	if(!class_exists($moduleIdTmp))
		return false;

	$module = new $moduleIdTmp;
	if(!$module->InstallDB())
		return false;

	$module->InstallEvents();
	if(!$module->InstallFiles())
		return false;
}

if (!CModule::IncludeModule("highloadblock"))
	return;

if (!WIZARD_INSTALL_DEMO_DATA)
	return;

use Bitrix\Highloadblock as HL;

unset($_SESSION["PRIORITY_HBLOCK_COLORS_ID"]);

$dbHblock = HL\HighloadBlockTable::getList(array("filter" => array("NAME" => "AsproPriorityColors")));
if(!$dbHblock->Fetch()){
	$data = array('NAME' => 'AsproPriorityColors', 'TABLE_NAME' => 'priority_colors');
	$result = HL\HighloadBlockTable::add($data);
	$HL_ID = $result->getId();
	$_SESSION["PRIORITY_HBLOCK_COLORS_ID"] = $HL_ID;
	
	if($HL_ID){
		$hldata = HL\HighloadBlockTable::getById($HL_ID)->fetch();
		$hlentity = HL\HighloadBlockTable::compileEntity($hldata);

		//adding user fields
		$arUserFields = array (
			array (
				'ENTITY_ID' => 'HLBLOCK_'.$HL_ID,
				'FIELD_NAME' => 'UF_NAME',
				'USER_TYPE_ID' => 'string',
				'XML_ID' => 'UF_PROFIT_NAME',
				'SORT' => '100',
				'MULTIPLE' => 'N',
				'MANDATORY' => 'Y',
				'SHOW_FILTER' => 'N',
				'SHOW_IN_LIST' => 'Y',
				'EDIT_IN_LIST' => 'Y',
				'IS_SEARCHABLE' => 'N',
			),
			array (
				'ENTITY_ID' => 'HLBLOCK_'.$HL_ID,
				'FIELD_NAME' => 'UF_SORT',
				'USER_TYPE_ID' => 'double',
				'XML_ID' => 'UF_PROFIT_SORT',
				'SORT' => '200',
				'MULTIPLE' => 'N',
				'MANDATORY' => 'N',
				'SHOW_FILTER' => 'N',
				'SHOW_IN_LIST' => 'Y',
				'EDIT_IN_LIST' => 'Y',
				'IS_SEARCHABLE' => 'N',
			),
			array (
				'ENTITY_ID' => 'HLBLOCK_'.$HL_ID,
				'FIELD_NAME' => 'UF_XML_ID',
				'USER_TYPE_ID' => 'string',
				'XML_ID' => 'UF_XML_ID',
				'SORT' => '300',
				'MULTIPLE' => 'N',
				'MANDATORY' => 'Y',
				'SHOW_FILTER' => 'N',
				'SHOW_IN_LIST' => 'Y',
				'EDIT_IN_LIST' => 'Y',
				'IS_SEARCHABLE' => 'N',
			),
			array (
				'ENTITY_ID' => 'HLBLOCK_'.$HL_ID,
				'FIELD_NAME' => 'UF_FILE',
				'USER_TYPE_ID' => 'file',
				'XML_ID' => 'UF_PROFIT_FILE',
				'SORT' => '800',
				'MULTIPLE' => 'N',
				'MANDATORY' => 'N',
				'SHOW_FILTER' => 'N',
				'SHOW_IN_LIST' => 'Y',
				'EDIT_IN_LIST' => 'Y',
				'IS_SEARCHABLE' => 'N',
			),
		);
		
		$arLanguages = Array();
		$rsLanguage = CLanguage::GetList($by, $order, array());
		while($arLanguage = $rsLanguage->Fetch()){
			$arLanguages[] = $arLanguage["LID"];
		}

		$obUserField  = new CUserTypeEntity;
		foreach($arUserFields as $arFields){
			$dbRes = CUserTypeEntity::GetList(Array(), Array("ENTITY_ID" => $arFields["ENTITY_ID"], "FIELD_NAME" => $arFields["FIELD_NAME"]));
			if($dbRes->Fetch()){
				continue;
			}

			$arLabelNames = Array();
			foreach($arLanguages as $languageID){
				WizardServices::IncludeServiceLang("references.php", $languageID);
				$arLabelNames[$languageID] = GetMessage($arFields["FIELD_NAME"]);
			}

			$arFields["EDIT_FORM_LABEL"] = $arLabelNames;
			$arFields["LIST_COLUMN_LABEL"] = $arLabelNames;
			$arFields["LIST_FILTER_LABEL"] = $arLabelNames;
			$ID_USER_FIELD = $obUserField->Add($arFields);
		}
	}
}
?>