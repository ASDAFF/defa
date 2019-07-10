<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<div class="form order border<?=($arResult['isFormNote'] == 'Y' ? ' success' : '')?><?=($arResult['isFormErrors'] == 'Y' ? ' error' : '')?>">
	<?=$arResult["FORM_HEADER"]?>
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<?if( $arResult["isIblockDescription"] ){?>
					<div class="description">
						<?if( $arResult["IBLOCK_DESCRIPTION_TYPE"] == "text" ){?>
							<p><?=$arResult["IBLOCK_DESCRIPTION"]?></p>
						<?}else{?>
							<?=$arResult["IBLOCK_DESCRIPTION"]?>
						<?}?>
					</div>
				<?}?>
			</div>
			<div class="col-md-12 col-sm-12">
				<?if($arResult["isUseCaptcha"] === "Y" && $arResult["isUseReCaptcha2"] === "Y"):?>
					<div class="input <?=($arResult['CAPTCHA_ERROR'] == 'Y' ? 'error' : '')?>">
						<div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_SITE_KEY?>" data-callback="reCaptchaVerifyHidden" data-size="invisible"></div>
					</div>
				<?endif;?>
				<div class="row">
					<?if($arResult['isFormErrors'] == 'Y'):?>
						<div class="col-md-12">
							<div class="form-error alert alert-danger">
								<?=$arResult['FORM_ERRORS_TEXT']?>
							</div>
						</div>
					<?endif;?>
					<div class="col-md-12 col-sm-12">
						<?if(is_array($arResult["QUESTIONS"])):?>
							<?foreach( $arResult["QUESTIONS"] as $FIELD_SID => $arQuestion ){
								if( $FIELD_SID == "MESSAGE" ) continue;
								if( $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden' ){
									echo $arQuestion["HTML_CODE"];
								}else{?>
									<?$hidden = ($FIELD_SID == 'ORDER_LIST' || $FIELD_SID == 'SESSION_ID');?>
									<div class="row<?=($hidden ? ' hidden' : '');?>" data-SID="<?=$FIELD_SID?>">
										<div class="col-md-12">
											<div class="form-group animated-labels <?=( $arQuestion['VALUE'] ? "input-filed" : "");?>">
												<?=$arQuestion["CAPTION"]?>
												<div class="input">
													<?=$arQuestion["HTML_CODE"]?>
													<?if($arQuestion['FIELD_TYPE'] == "file" && $arQuestion['MULTIPLE'] == 'Y'):?>
														<div class="add_file"><span><?=GetMessage('JS_FILE_ADD');?></span></div>
													<?endif;?>
												</div>
												<?if( !empty( $arQuestion["HINT"] ) ){?>
													<div class="hint"><?=$arQuestion["HINT"]?></div>
												<?}?>
											</div>
										</div>
									</div>
								<?}
							}?>
						<?endif;?>
					</div>
					<?if($arResult["QUESTIONS"]["MESSAGE"]):?>
						<div class="col-md-12 col-sm-12">
							<div class="row" data-SID="MESSAGE">
								<div class="col-md-12">
									<div class="form-group animated-labels <?=($arResult["QUESTIONS"]["MESSAGE"]["VALUE"]["TEXT"] ? 'input-filed' : '');?>">
										<?=$arResult["QUESTIONS"]["MESSAGE"]["CAPTION"]?>
										<div class="input">
											<?=$arResult["QUESTIONS"]["MESSAGE"]["HTML_CODE"]?>
										</div>
										<?if( !empty( $arResult["QUESTIONS"]["MESSAGE"]["HINT"] ) ){?>
											<div class="hint"><?=$arResult["QUESTIONS"]["MESSAGE"]["HINT"]?></div>
										<?}?>
									</div>
								</div>
							</div>
						</div>
					<?endif;?>
					<?if($arResult["isUseCaptcha"] === "Y"):?>
						<div class="captcha-row">
							<div class="col-md-12">
								<?=$arResult["CAPTCHA_CAPTION"];?>
								<div class="captcha_image">
									<img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"])?>" class="captcha_img" border="0" />
									<input type="hidden" name="captcha_sid" class="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"])?>" />
									<div class="captcha_reload"></div>
									<span class="refresh"><a href="javascript:;" rel="nofollow"><?=GetMessage("REFRESH")?></a></span>
								</div>
								<div class="captcha_input">
									<input type="text" class="inputtext form-control captcha" name="captcha_word" size="30" maxlength="50" value="" required />
								</div>
							</div>
						</div>
					<?endif;?>
				</div>
				<div class="row">
					<div class="bottom_block col-md-12 col-sm-12">
						<?if($arParams["SHOW_LICENCE"] == "Y"):?>
							<div class="licence_block bx_filter">
								<input type="checkbox" id="licenses" <?=(COption::GetOptionString("aspro.priority", "LICENCE_CHECKED", "N") == "Y" ? "checked" : "");?> name="licenses" required value="Y">
								<label for="licenses">
									<?$APPLICATION->IncludeFile(SITE_DIR."include/licenses_text.php", Array(), Array("MODE" => "html", "NAME" => "LICENSES")); ?>
								</label>
							</div>
						<?endif;?>
						<div class="pull-left">
							<?=str_replace('class="', 'class="btn-lg ', $arResult["SUBMIT_BUTTON"])?>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	<?=$arResult["FORM_FOOTER"]?>
</div>

<script>
	var bFormNote = <?=CUtil::PhpToJSObject($arResult['FORM_NOTE']);?>;

	$(document).ready(function(){
		if(arPriorityOptions['THEME']['CAPTCHA_FORM_TYPE'] == 'RECAPTCHA' || arPriorityOptions['THEME']['CAPTCHA_FORM_TYPE'] == 'RECAPTCHA2'){
			reCaptchaRender();
		}
		if(arPriorityOptions['THEME']['USE_SALE_GOALS'] !== 'N'){
			var eventdata = {goal: 'goal_order_begin'};
			BX.onCustomEvent('onCounterGoals', [eventdata]);
		}
		$('.order.form form[name="<?=$arResult["IBLOCK_CODE"]?>"]').validate({
			ignore: ".ignore",
			highlight: function( element ){
				$(element).parent().addClass('error');
			},
			unhighlight: function( element ){
				$(element).parent().removeClass('error');
			},
			submitHandler: function( form ){
				if( $('.order.form form[name="<?=$arResult["IBLOCK_CODE"]?>"]').valid() ){
					$(form).find('button[type="submit"]').attr("disabled", "disabled");
					var eventdata = {type: 'form_submit', form: form, form_name: '<?=$arResult["IBLOCK_CODE"]?>'};
					BX.onCustomEvent('onSubmitForm', [eventdata]);
					if(!bFormNote){
						$(form).prepend('<div class="overlay_form"><div class="loader"><div class="duo duo1"><div class="dot dot-a"></div><div class="dot dot-b"></div></div><div class="duo duo2"><div class="dot dot-a"></div><div class="dot dot-b"></div></div></div></div>');
					}
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
			messages:{
				licenses_popup: {
					required : BX.message('JS_REQUIRED_LICENSES')
				}
			}
		});

		if(arPriorityOptions['THEME']['PHONE_MASK'].length){
			var base_mask = arPriorityOptions['THEME']['PHONE_MASK'].replace( /(\d)/g, '_' );
			$('.order.form form[name="<?=$arResult["IBLOCK_CODE"]?>"] input.phone').inputmask("mask", { "mask": arPriorityOptions['THEME']['PHONE_MASK'], 'showMaskOnHover': false });
			$('.order.form form[name="<?=$arResult["IBLOCK_CODE"]?>"] input.phone').blur(function(){
				if( $(this).val() == base_mask || $(this).val() == '' ){
					if( $(this).hasClass('required') ){
						$(this).parent().find('div.error').html(BX.message("JS_REQUIRED"));
					}
				}
			});
		}

		var sessionID = '<?=bitrix_sessid()?>';
		$('input#SESSION_ID').val(sessionID);

		if(arPriorityOptions['THEME']['DATE_MASK'].length){
			$('.order.form form[name="<?=$arResult["IBLOCK_CODE"]?>"] input.date').inputmask('datetime', {
				inputFormat: arPriorityOptions['THEME']['DATE_MASK'],
				placeholder: arPriorityOptions['THEME']['DATE_PLACEHOLDER'],
				showMaskOnHover: false
			});
		}

		if(arPriorityOptions['THEME']['DATETIME_MASK'].length){
			$('.order.form form[name="<?=$arResult["IBLOCK_CODE"]?>"] input.datetime').inputmask('datetime', {
				inputFormat: arPriorityOptions['THEME']['DATETIME_MASK'],
				placeholder: arPriorityOptions['THEME']['DATETIME_PLACEHOLDER'],
				showMaskOnHover: false
			});
		}

		$("input[type=file]").uniform({ fileButtonHtml: BX.message("JS_FILE_BUTTON_NAME"), fileDefaultHtml: BX.message("JS_FILE_DEFAULT") });
		$(document).on('change', 'input[type=file]', function(){
			if($(this).val())
			{
				$(this).closest('.uploader').addClass('files_add');
			}
			else
			{
				$(this).closest('.uploader').removeClass('files_add');
			}
		})
		$('.form .add_file').on('click', function(){
			var index = $(this).closest('.input').find('input[type=file]').length+1;
			$('<input type="file" id="POPUP_FILE" name="FILE_n'+index+'"   class="inputfile" value="" />').insertBefore($(this));
			$('input[type=file]').uniform({fileButtonHtml: BX.message('JS_FILE_BUTTON_NAME'), fileDefaultHtml: BX.message('JS_FILE_DEFAULT')});
		})
	});
</script>