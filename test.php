<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");


$mail="ka@defo.ru"; // ваша почта
$subject ="Test123" ; // тема письма
$text= "Line 1\nLine 2\nLine 3"; // текст письма
if( mail($mail, $subject, $text) )
{
echo 'Успешно отправлено!'; }
else{
echo 'Отправка не удалась!';
}
global $arTheme;?>
<?CNextB2c::ShowPageType('header_fixed');?>
<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"top_fixed_field",
	Array(
		"COMPONENT_TEMPLATE" => "top_fixed_field",
		"MENU_CACHE_TIME" => "3600000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"DELAY" => "N",
		"MAX_LEVEL" => $arTheme["MAX_DEPTH_MENU"]["VALUE"],
		"ALLOW_MULTI_SELECT" => "Y",
		"ROOT_MENU_TYPE" => "top_content_multilevel",
		"CHILD_MENU_TYPE" => "left",
		"CACHE_SELECTED_ITEMS" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"USE_EXT" => "Y"
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>