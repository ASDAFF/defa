<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>

<?global $USER, $APPLICATION;
if( !$USER->IsAuthorized() ){?>
	<?if(!isset($_SERVER["HTTP_X_REQUESTED_WITH"])):?>
		<?$APPLICATION->IncludeFile(SITE_DIR."include/auth_description.php", Array(), Array("MODE" => "html", "NAME" => GetMessage("AUTH_INCLUDE_AREA"), ));?>
	<?endif;?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:system.auth.form",
		"main",
		Array(
			"AUTH_URL" => $arResult["SEF_FOLDER"].$arResult["URL_TEMPLATES"]["auth"],
			"REGISTER_URL" => $arResult["SEF_FOLDER"].$arResult["URL_TEMPLATES"]["registration"],
			"FORGOT_PASSWORD_URL" => $arResult["SEF_FOLDER"].$arResult["URL_TEMPLATES"]["forgot_password"],
			"PROFILE_URL" => $arResult["SEF_FOLDER"],
			"SHOW_ERRORS" => "Y",
		)
	);?>
<?}else{?>
	<?global $arTheme?>
	<?$url = ($arTheme["PERSONAL_PAGE_URL"]["VALUE"] ? $arTheme["PERSONAL_PAGE_URL"]["VALUE"] : SITE_DIR."personal/");?>
	<?LocalRedirect($url);?>
<?}?>