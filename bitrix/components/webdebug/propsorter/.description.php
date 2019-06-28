<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("WDU_PROPSORTER_COMPONENT_NAME"),
	"DESCRIPTION" => GetMessage("WDU_PROPSORTER_COMPONENT_DESC"),
	"ICON" => "/images/image.gif",
	"SORT" => 1100,
	"PATH" => array(
		"ID" => "webdebug",
		"NAME" => GetMessage("WDU_PROPSORTER_COMPONENT_SECTION_WEBDEBUG"),
		"SORT" => 450,
	),
);
?>