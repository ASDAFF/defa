<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?$APPLICATION->AddChainItem("������ ������");?>
<?$APPLICATION->SetTitle("������ ������");?>
<?global $USER, $APPLICATION;
if( !$USER->IsAuthorized() ){?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:system.auth.forgotpasswd",
		"aspro",
		false
	);?>
<?}else{
	LocalRedirect( $arParams["PERSONAL"] );
}?>