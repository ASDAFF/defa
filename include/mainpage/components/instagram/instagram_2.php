<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->IncludeComponent(
	"aspro:instargam.priority",
	"instagram_list_2",
	Array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"TITLE" => "",
		"TOKEN" => \Bitrix\Main\Config\Option::get("aspro.priority","API_TOKEN_INSTAGRAMM","1056017790.9b6cbfe.4dfb9d965b5c4c599121872c23b4dfd0"),
		"COMPONENT_TEMPLATE" => "instagram_list_2",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "480",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y"
	)
);
?>
