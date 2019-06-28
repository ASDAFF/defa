<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(isset($APPLICATION->arAuthResult))
	$arResult['ERROR_MESSAGE'] = $APPLICATION->arAuthResult;?>
<?global $arTheme;?>
<div class="module-form-block-wr lk-page form forgot_pass">
	<?ShowMessage($arResult['ERROR_MESSAGE']);?>
	<div class="form-block">
		<form name="bform" method="post" target="_top" class="bf" action="<?=$arParams["URL"];?>">
			<?if (strlen($arResult["BACKURL"]) > 0){?><input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" /><?}?>
			<input type="hidden" name="AUTH_FORM" value="Y">
			<input type="hidden" name="TYPE" value="SEND_PWD">
			<div class="top-text-block"><?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></div>
			<div class="max-form-block">
				<?
				$name = "AUTH_EMAIL";
				if($arTheme["LOGIN_EQUAL_EMAIL"]["VALUE"] != "Y")
				{
					$name = "AUTH_LOGIN";
				}?>
				<div class="form-group animated-labels input-filed bg-color">
					<label for="USER_EMAIL"><?=GetMessage($name)?> <span class="required-star">*</span></label>
					<div class="input">
					<?if($arTheme["LOGIN_EQUAL_EMAIL"]["VALUE"] == "Y"):?>
						<input type="email" name="USER_EMAIL" class="form-control bg-color required" required="required"  maxlength="255" />
					<?else:?>
						<input type="text" name="USER_LOGIN" class="form-control bg-color required" required="required"  maxlength="255" />
					<?endif;?>

					</div>
				</div>	
				<?if($arResult["USE_CAPTCHA"]):?>
					<div class="captcha-row clearfix">
						<label><span><?=GetMessage("FORM_CAPRCHE_TITLE_RECAPTCHA2")?>&nbsp;<span class="required-star">*</span></span></label>
						<div class="captcha_image">
							<input class="captcha_sid" type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
							<img class="captcha_img" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
							<span class="refresh"><a href="javascript:;" rel="nofollow"><?=GetMessage("REFRESH")?></a></span>
						</div>
						<div class="captcha_input">
							<input type="text" class="inputtext form-control captcha" name="captcha_word" size="30" maxlength="50" value="" required />
						</div>
					</div>
					
				<?endif?>

				<div class="but-r">
					<button class="btn btn-default btn-lg" type="submit" name="send_account_info" value=""><span><?=GetMessage("RETRIEVE")?></span></button>
				</div>
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
	
	<script type="text/javascript">
	$("form.bf").validate({
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
		errorPlacement: function( error, element ){
			if($(element).hasClass('captcha')){
				$(element).closest('.captcha-row').append(error);
			}
			else if($(element).closest('.licence_block').length){
				$(element).closest('.licence_block').append(error);
			}
			else if($(element).closest('[data-sid=FILE]')){
				$(element).closest('.form-group').append(error);
			}
			else{
				if($(element).closest('.licence_block').length){
					$(element).closest('.licence_block').append(error);
				}
				else if($(element).closest('[data-sid=FILE]')){
					$(element).closest('.form-group').append(error);
				}
				else{
					error.insertAfter(element);
				}
			}
		},
	});
	</script>
</div>