<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");?>
<?$APPLICATION->SetPageProperty("title", "Карта сайта");?>
<?/*$APPLICATION->IncludeComponent(
	"bitrix:main.map", 
	"sitemap", 
	array(
		"LEVEL" => "3",
		"COL_NUM" => "2",
		"SHOW_DESCRIPTION" => "Y",
		"SET_TITLE" => "Y",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "3600",
		"COMPONENT_TEMPLATE" => "sitemap"
	),
	false
);*/?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.map",
	"",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COL_NUM" => "1",
		"LEVEL" => "3",
		"SET_TITLE" => "Y",
		"SHOW_DESCRIPTION" => "N"
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>