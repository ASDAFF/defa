<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?if( $arParams["POPUP_AUTH"] == "Y"){ ?>
	<?if( $arResult["AUTH_SERVICES"] ){?>
		<div class="soc-avt inline">
			<div class="big-title font_xs"><span><?=GetMessage("SOCSERV_AS_USER_FORM");?></span></div>
			<?$APPLICATION->IncludeComponent(
				"bitrix:socserv.auth.form",
				"icons",
				array(
					"AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
					"AUTH_URL" => $arResult["AUTH_URL"],
					"POST" => $arResult["POST"],
					"POPUP" => "N",
					"SUFFIX" => "form",
				),
				$component,
				array( "HIDE_ICONS" => "N" )
			);?>
		</div>
	<?}?>
<?}?>
