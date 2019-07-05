<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$bForgotPassword = isset($_REQUEST['forgot_password']) && $_REQUEST['forgot_password'] === 'yes';
$bChangePassword = isset($_REQUEST['change_password']) && $_REQUEST['change_password'] === 'yes';
$bConfirmPassword = isset($_REQUEST['confirm_password']) && $_REQUEST['confirm_password'] === 'yes';
$bConfirmRegistration = isset($_REQUEST['confirm_registration']) && $_REQUEST['confirm_registration'] === 'yes';

LocalRedirect(SITE_DIR.'cabinet/'.($bForgotPassword ? 'forgot-password/' : ($bChangePassword ? 'change-password/' : ($bConfirmPassword ? 'confirm-password/' : ($bConfirmRegistration ? 'confirm-registration/' : '')))).str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['REQUEST_URI']), '301 Moved permanently');
?>