<?define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
if(\Bitrix\Main\Loader::includeModule('aspro.priority'))
	$arTheme = CPriority::GetFrontParametrsValues(SITE_ID);
$id = (isset($_REQUEST["id"]) ? $_REQUEST["id"] : false);

$isCallBack = $id == CCache::$arIBlocks[SITE_ID]["aspro_priority_form"]["aspro_priority_callback"][0];
$successMessage = ($isCallBack ? "<p class=\"introtext\">Спасибо за ваше обращение!</p><p>Наш менеджер перезвонит вам в ближайшее время.</p>" : "<p class=\"introtext\">Спасибо!</p><p>Ваше сообщение отправлено!</p>");
$popupFormType = (isset($arTheme['FORM_TYPE']['VALUE']) && $arTheme['FORM_TYPE']['VALUE'] == 'POPUP' || $arTheme['FORM_TYPE'] == 'POPUP' ? true : false);
?>
<?if($popupFormType):?>
	<span class="jqmClose top-close fa fa-close"><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/close.svg');?></span>
<?endif;?>
<?if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'review'):?>
	<?include_once('review.php');?>
<?elseif(isset($_REQUEST['type']) && $_REQUEST['type'] == 'auth'):?>
	<?include_once('auth.php');?>
<?elseif(isset($_REQUEST['form_id']) && $_REQUEST['form_id'] == 'city_chooser'):?>
	<?include_once('city_chooser.php');?>
<?elseif(isset($_REQUEST['type']) && $_REQUEST['type'] == 'map'):?>
	<?include_once('map.php');?>
<?elseif((isset($_REQUEST['type']) && $_REQUEST['type'] == 'subscribe') || (isset($_REQUEST['ID']) && $_REQUEST['ID'] && isset($_REQUEST['mess_code']) && $_REQUEST['mess_code'] == 'SENT')):?>
	<?include_once('subscribe.php');?>
<?elseif($id):?>
	<?$APPLICATION->IncludeComponent(
		"aspro:form.priority", "popup",
		Array(
			"IBLOCK_TYPE" => "aspro_priority_form",
			"IBLOCK_ID" => $id,
			"AJAX_MODE" => "Y",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "N",
			"AJAX_OPTION_HISTORY" => "N",
			"SHOW_LICENCE" => $arTheme["SHOW_LICENCE"],
			"LICENCE_TEXT" => $arTheme["LICENCE_TEXT"],
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "100000",
			"AJAX_OPTION_ADDITIONAL" => "",
			//"IS_PLACEHOLDER" => "Y",
			"SUCCESS_MESSAGE" => $successMessage,
			"SEND_BUTTON_NAME" => "Отправить",
			"SEND_BUTTON_CLASS" => "btn btn-default",
			"DISPLAY_CLOSE_BUTTON" => "Y",
			"POPUP" => "Y",
			"CLOSE_BUTTON_NAME" => "Закрыть",
			"CLOSE_BUTTON_CLASS" => "jqmClose btn btn-default bottom-close"
		)
	);?>
<?endif;?>