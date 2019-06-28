<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;
if(!CModule::IncludeModule("sebekon.deliveryprice"))
	return;


$arTemplateParameters = array(
	"CUSTOM_CALC" => Array(
		"NAME" => GetMessage("SBEEKON_DELIVERYPRICE_CUSTOM_CALC_PARAM"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"CUSTOM_PRICE" => Array(
		"NAME" => GetMessage("SBEEKON_DELIVERYPRICE_CUSTOM_PRICE_PARAM"),
		"TYPE" => "TEXT",
		"DEFAULT" => "",
	),
	"CUSTOM_WEIGHT" => Array(
		"NAME" => GetMessage("SBEEKON_DELIVERYPRICE_CUSTOM_WEIGHT_PARAM"),
		"TYPE" => "TEXT",
		"DEFAULT" => "",
	),
);
?>
