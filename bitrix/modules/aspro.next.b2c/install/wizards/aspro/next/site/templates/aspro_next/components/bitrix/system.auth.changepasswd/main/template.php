<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?global $arTheme;?>
<div class="border_block">
	<div class="module-form-block-wr lk-page">
		<?if(isset($APPLICATION->arAuthResult)) {
				$arResult['ERROR_MESSAGE'] = $APPLICATION->arAuthResult;
				ShowMessage($arResult['ERROR_MESSAGE']);
			}?>
			
		<?
		if( isset($_POST["LAST_LOGIN"]) && empty( $_POST["LAST_LOGIN"] ) ){
			$arResult["ERRORS"]["LAST_LOGIN"] = GetMessage("REQUIRED_FIELD");
		}
		if( isset($_POST["USER_PASSWORD"]) && strlen( $_POST["USER_PASSWORD"] ) < 6 ){
			$arResult["ERRORS"]["USER_PASSWORD"] = GetMessage("PASSWORD_MIN_LENGTH_2");
		}
		if( isset($_POST["USER_PASSWORD"]) && empty( $_POST["USER_PASSWORD"] ) ){
			$arResult["ERRORS"]["USER_PASSWORD"] = GetMessage("REQUIRED_FIELD");
		}
		if( isset($_POST["USER_CONFIRM_PASSWORD"]) && strlen( $_POST["USER_CONFIRM_PASSWORD"] ) < 6 ){
			$arResult["ERRORS"]["USER_CONFIRM_PASSWORD"] = GetMessage("PASSWORD_MIN_LENGTH_2");
		}
		if( isset($_POST["USER_CONFIRM_PASSWORD"]) && empty( $_POST["USER_CONFIRM_PASSWORD"] ) ){
			$arResult["ERRORS"]["USER_CONFIRM_PASSWORD"] = GetMessage("REQUIRED_FIELD");
		}
		if( $_POST["USER_PASSWORD"] != $_POST["USER_CONFIRM_PASSWORD"] ){
			$arResult["ERRORS"]["USER_CONFIRM_PASSWORD"] = GetMessage("WRONG_PASSWORD_CONFIRM");
		}
		if($arResult['ERROR_MESSAGE'])
			$arResult["ERRORS"] = $arResult['ERROR_MESSAGE'];
		if ($arResult['SHOW_ERRORS'] == 'Y' ){
			ShowMessage($arResult['ERROR_MESSAGE']);?>
			<p><font class="errortext"><?=GetMessage("WRONG_LOGIN_OR_PASSWORD")?></font></p>
		<?}?>
		<?if(isset($arResult['ERROR_MESSAGE']['TYPE']) && $arResult['ERROR_MESSAGE']['TYPE'] == 'OK' && !empty( $_POST["change_pwd"] ) ){?>
			<p><?=GetMessage("CHANGE_SUCCESS")?></p>
			<div class="but-r"><a href="/auth/" class="btn btn-default"><span><?=GetMessage("LOGIN")?></span></a></div>
		<?}else{?>
	<script>
	$(document).ready(function(){
		$(".form-block form").validate({
			rules:{
				USER_CONFIRM_PASSWORD: {equalTo: '#pass'},
				<?if($arTheme["LOGIN_EQUAL_EMAIL"]["VALUE"] == "Y"):?>
				USER_LOGIN: {email: true}
				<?endif;?>
			}, messages:{USER_CONFIRM_PASSWORD: {equalTo: '<?=GetMessage("PASSWORDS_DONT_MATCH")?>'}}	
		});
	})
	</script>
	    <div class="form-block">
	        <form method="post" action="/auth/change-password/" name="bform" class="bf">
				<?if (strlen($arResult["BACKURL"]) > 0): ?><input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" /><?endif;?>
				<input type="hidden" name="AUTH_FORM" value="Y">
				<input type="hidden" name="TYPE" value="CHANGE_PWD">	
	            <div class="form-control">
	            	<?
					$name = "AUTH_EMAIL";
					if($arTheme["LOGIN_EQUAL_EMAIL"]["VALUE"] != "Y")
					{
						$name = "AUTH_LOGIN";
					}?>
	                <label><?=GetMessage($name)?> <span class="star">*</span></label>
					<input type="text" name="USER_LOGIN" maxlength="50" required value="<?=$arResult["LAST_LOGIN"]?>" class="bx-auth-input <?=($_POST && empty( $_POST["USER_LOGIN"] ))? "error": ''?>" />
	            </div>	
	            <div class="form-control">
					<div class="label_block">
						<label><?=GetMessage("AUTH_NEW_PASSWORD_REQ")?> <span class="star">*</span></label>
						<input type="password" name="USER_PASSWORD" maxlength="50" id="pass" required value="<?=$arResult["USER_PASSWORD"]?>" class="bx-auth-input <?=( isset($arResult["ERRORS"]) && array_key_exists( "USER_PASSWORD", $arResult["ERRORS"] ))? "error": ''?>" />
					</div>
					<div class=" text_block">
						<?=GetMessage("PASSWORD_MIN_LENGTH")?>
					</div>
	            </div>	
	            <div class="form-control">
	                <label><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?> <span class="star">*</span></label>
					<input type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" required value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="bx-auth-input <?=(isset($arResult["ERRORS"]) && array_key_exists( "USER_CONFIRM_PASSWORD", $arResult["ERRORS"] ))? "error": ''?>"  />
	            </div>
	            <?if ($arResult["USE_CAPTCHA"]):?>
					<div class="form-control captcha-row forget_block clearfix">
						<label><span><?=GetMessage("FORM_CAPRCHE_TITLE")?>&nbsp;<span class="star">*</span></span></label>
						<div class="captcha_image">
							<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
							<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
							<div class="captcha_reload"></div>
						</div>
						<div class="captcha_input">
							<input type="text" class="inputtext captcha" name="captcha_word" size="30" maxlength="50" value="" required />
						</div>
					</div>
				<?endif?>
				<input type="hidden" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" class="bx-auth-input"  />
	            <div class="but-r">
					<button class="btn btn-default" type="submit" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>"><span><?=GetMessage("CHANGE_PASSWORD")?></span></button>
				</div> 		
	    	</form> 
	    </div>
		<script type="text/javascript">document.bform.USER_LOGIN.focus();</script>
		<?}?>
	</div>
</div>