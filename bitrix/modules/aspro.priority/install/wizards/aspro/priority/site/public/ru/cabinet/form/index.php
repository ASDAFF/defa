<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Написать директору");
?>
<?$APPLICATION->IncludeComponent(
	"aspro:form.priority", 
	"director", 
	array(
		"IBLOCK_TYPE" => "aspro_priority_form",
		"IBLOCK_ID" => CPriority::getFormID("aspro_priority_director"),
		"USE_CAPTCHA" => "Y",
		"IS_PLACEHOLDER" => "N",
		"SUCCESS_MESSAGE" => "<p class=\"introtext\">Спасибо!</p><p>Ваше сообщение отправлено!</p>",
		"SEND_BUTTON_NAME" => "Отправить",
		"SEND_BUTTON_CLASS" => "btn btn-default",
		"DISPLAY_CLOSE_BUTTON" => "N",
		"CLOSE_BUTTON_NAME" => "Обновить страницу",
		"CLOSE_BUTTON_CLASS" => "btn btn-default refresh-page",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "100000",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "director",
		"CACHE_GROUPS" => "Y"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>