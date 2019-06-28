<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("iblock"))
	return;
if(!CModule::IncludeModule("sebekon.deliveryprice"))
	return;


$PARAMETERS = array(
	"SHOW_ROUTE" => Array(
		"PARENT" => "BASE",
		"NAME" => GetMessage('sebekon_DP_IBLOCK_PARAMS_SHOW_ROUTE'),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N"
	),
	"MULTI_POINTS" => Array(
		"PARENT" => "BASE",
		"NAME" => GetMessage('sebekon_DP_IBLOCK_PARAMS_MULTI_POINTS'),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y"
	),
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


if(CModule::IncludeModule("sale")){
	$PARAMETERS["ADD2BASKET"] = Array(
		"PARENT" => "BASE",
		"NAME" => GetMessage('sebekon_DP_IBLOCK_PARAMS_ADD2BASKET'),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N"
	);
}

$arTemplateParameters = $PARAMETERS;
?>
