<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Web\Json;

if (!Loader::includeModule('iblock'))
	return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(Array("-"=>" "));

$arIBlocks=Array();
$db_iblock = CIBlock::GetList(Array("SORT"=>"ASC"), Array("SITE_ID"=>$_REQUEST["src_site"], "TYPE" => ($arCurrentValues["IBLOCK_SMALL_BANNERS_TYPE"]!="-"?$arCurrentValues["IBLOCK_SMALL_BANNERS_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
	$arIBlocks[$arRes["ID"]] = $arRes["NAME"];

$arTemplateParameters = array(
	"IBLOCK_SMALL_BANNERS_TYPE" => Array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("T_IBLOCK_SMALL_BANNERS_TYPE"),
		"TYPE" => "LIST",
		"VALUES" => $arTypesEx,
		"DEFAULT" => "aspro_adv",
		"REFRESH" => "Y",
	),
	"IBLOCK_SMALL_BANNERS_ID" => Array(
		"PARENT" => "BASE",
		"NAME" => GetMessage("T_IBLOCK_SMALL_BANNERS_ID"),
		"TYPE" => "LIST",
		"VALUES" => $arIBlocks,
		"DEFAULT" => '',
		"ADDITIONAL_VALUES" => "Y",
		"REFRESH" => "Y",
	),
);
?>