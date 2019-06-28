<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule("sebekon.deliveryprice"))
	return;

$arComponentDescription = array(
	"NAME" => GetMessage("sebekon_DP_MODULE_NAME"),
	"DESCRIPTION" => GetMessage("sebekon_DP_MODULE_DESCRIPTION"),
	"ICON" => "/images/breadcrumb.gif",
	"PATH" => array(
		"ID" => "sebekon",
		"NAME" => GetMessage("sebekon_DP_PARTNER_NAME")
	)
);

?>