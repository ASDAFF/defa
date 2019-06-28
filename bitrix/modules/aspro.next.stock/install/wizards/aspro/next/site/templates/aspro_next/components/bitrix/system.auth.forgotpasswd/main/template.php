<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(isset($APPLICATION->arAuthResult))
	$arResult['ERROR_MESSAGE'] = $APPLICATION->arAuthResult;?>
<?global $arTheme;?>
<div class="border_block">
	<div class="module-form-block-wr lk-page">
		<?ShowMessage($arResult['ERROR_MESSAGE']);?>
		<?if(!isset($arResult['ERROR_MESSAGE']['TYPE']) || $arResult['ERROR_MESSAGE']['TYPE'] != 'OK'):?>
		<div class="form-block">
			<form name="bform" method="post" target="_top" class="bf" action="<?=SITE_DIR?>auth/forgot-password/">
				<?if (strlen($arResult["BACKURL"]) > 0){?><input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" /><?}?>
				<input type="hidden" name="AUTH_FORM" value="Y">
				<input type="hidden" name="TYPE" value="SEND_PWD">
				<?=GetMessage("AUTH_FORGOT_PASSWORD_1")?>
				<br /><br />
				<?
				$name = "AUTH_EMAIL";
				if($arTheme["LOGIN_EQUAL_EMAIL"]["VALUE"] != "Y")
				{
					$name = "AUTH_LOGIN";
				}?>
				<div class="form-control">
					<label><?=GetMessage($name)?> <span class="star">*</span></label>
					<?if($arTheme["LOGIN_EQUAL_EMAIL"]["VALUE"] == "Y"):?>
						<input type="email" name="USER_EMAIL" required="required"  maxlength="255" />
					<?else:?>
						<input type="text" name="USER_LOGIN" required="required"  maxlength="255" />
					<?endif;?>
				</div>
				<?if($arResult["USE_CAPTCHA"]):?>
					<div class="form-control captcha-row clearfix forget_block">
						<label><?echo GetMessage("system_auth_captcha")?></label>
						<div class="captcha_image">
							<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
							<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
							<div class="captcha_reload"></div>
						</div>
						<div class="captcha_input">
							<input type="text" name="captcha_word" maxlength="50" value="" />
						</div>
					</div>
				<?endif?>

				<div class="but-r">
					<button class="btn btn-default vbig_btn wides" type="submit" name="send_account_info" value=""><span><?=GetMessage("RETRIEVE")?></span></button>
				</div>
			</form>
		</div>
		<script type="text/javascript">
			<?if($arTheme["LOGIN_EQUAL_EMAIL"]["VALUE"] != "Y"):?>
				document.bform.USER_LOGIN.focus();
			<?else:?>
				document.bform.USER_EMAIL.focus();
			<?endif;?>
		</script>
		<?endif;?>
	</div>
</div>
<script>
$(document).ready(function(){
	$('form[name=bform]').validate({
		highlight: function( element ){
			$(element).parent().addClass('error');
		},
		unhighlight: function( element ){
			$(element).parent().removeClass('error');
		},
		submitHandler: function( form ){
			if( $('form[name=bform]').valid() ){
				var eventdata = {type: 'form_submit', form: form, form_name: 'FORGOT'};
				BX.onCustomEvent('onSubmitForm', [eventdata]);
			}
		},
	})
})
</script>