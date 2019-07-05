<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?$this->setFrameMode(false);?>
<div class="form inline<?=($arResult['isFormNote'] == 'Y' ? ' success' : '')?><?=($arResult['isFormErrors'] == 'Y' ? ' error' : '')?> border_block <?=$templateName;?>">
	<div class="top-form">
		<?if($arResult["isFormNote"] == "Y"){?>
			<div class="form-header">
				<div class="text">
					<div class="title"><?=GetMessage("SUCCESS_TITLE")?></div>
					<div class="description">
						<svg class="success_icon" xmlns="http://www.w3.org/2000/svg" width="90" height="90" viewBox="0 0 90 90">
						  <path id="Ellipse_273_copy" data-name="Ellipse 273 copy" class="clsp-1" d="M1550,151a45,45,0,1,1-45,45A45,45,0,0,1,1550,151Zm0,2a43,43,0,1,1-43,43A43,43,0,0,1,1550,153Z" transform="translate(-1505 -151)"/>
						  <path class="clsp-2" d="M1539.82,207.4a4.45,4.45,0,0,0,2.9,1.609c0.9,0.014,1.66-.434,2.93-1.854,1.53-1.692,23.35-24.3,23.35-24.3l-1-.852h-2l-2,2-20,21-10-10h-2l-2,1v2l2,4,4.9,3.372Z" transform="translate(-1505 -151)"/>
						  <path id="Rounded_Rectangle_840_copy_2" data-name="Rounded Rectangle 840 copy 2" class="clsp-1" d="M1545.41,212.678a4.006,4.006,0,0,1-4.33-.877h0l-10.91-10.88a4,4,0,0,1,5.66-5.646l8.08,8.057,20.23-21.172a4,4,0,0,1,5.66,5.646L1546.74,211.8A3.924,3.924,0,0,1,1545.41,212.678Zm22.97-26.283a2,2,0,1,0-2.83-2.823l-20.23,21.172-1.41,1.411-1.42-1.411-8.07-8.057a2,2,0,0,0-2.83,0,1.976,1.976,0,0,0,0,2.822l8.45,8.438,2.45,2.443a2.05,2.05,0,0,0,.66.438,2.005,2.005,0,0,0,2.17-.438l2.44-2.432Z" transform="translate(-1505 -151)"/>
						</svg>
						<div class="success-text"><?=$arResult["FORM_NOTE"]?></div>
					</div>
				</div>
				<?if( $arParams["DISPLAY_CLOSE_BUTTON"] == "Y" ){?>
					<div class="button">
						<?=str_replace('class="', 'class="btn-lg ', $arResult["CLOSE_BUTTON"])?>
					</div>
				<?}?>
			</div>
			<script>
				if(arPriorityOptions['THEME']['USE_FORMS_GOALS'] !== 'NONE')
				{
					var eventdata = {goal: 'goal_webform_success' + (arPriorityOptions['THEME']['USE_FORMS_GOALS'] === 'COMMON' ? '' : '_<?=$arParams["IBLOCK_ID"]?>'), params: <?=CUtil::PhpToJSObject($arParams, false)?>};
					BX.onCustomEvent('onCounterGoals', [eventdata]);
				}
			</script>
		<?}else{?>
			<?=$arResult["FORM_HEADER"]?>
				<div class="form-header-text">
					<div class="text">
						<?if( $arResult["isIblockDescription"] ){
							if( $arResult["IBLOCK_DESCRIPTION_TYPE"] == "text" ){?>
								<p><?=$arResult["IBLOCK_DESCRIPTION"]?></p>
							<?}else{?>
								<?=$arResult["IBLOCK_DESCRIPTION"]?>
							<?}
						}?>
					</div>
				</div>
				<?if($arResult['isFormErrors'] == 'Y'):?>
					<div class="form-error alert alert-danger">
						<?=$arResult['FORM_ERRORS_TEXT']?>
					</div>
				<?endif;?>
				<div class="form-body">
					<?if($arResult["isUseCaptcha"] === "Y" && $arResult["isUseReCaptcha2"] === "Y"):?>
						<div class="input <?=($arResult['CAPTCHA_ERROR'] == 'Y' ? 'error' : '')?>">
							<div class="g-recaptcha" data-sitekey="<?=RECAPTCHA_SITE_KEY?>" data-callback="reCaptchaVerifyHidden" data-size="invisible"></div>
						</div>
					<?endif;?>
					<?if(is_array($arResult["QUESTIONS"])):?>
						<?foreach( $arResult["QUESTIONS"] as $FIELD_SID => $arQuestion ){
							if( $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden' ){
								echo $arQuestion["HTML_CODE"];
							}else{?>
								<div class="row" data-SID="<?=$FIELD_SID?>">
									<div class="col-md-12">
										<div class="form-group <?=( $arQuestion['FIELD_TYPE'] != "file" ? "animated-labels" : "");?> <?=( $arQuestion['VALUE'] ? "input-filed" : "");?>">
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
					<?if($arResult["isUseCaptcha"] === "Y"):?>
						<div class="row captcha-row">
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
				<div class="form-footer clearfix">
					<?if($arParams["SHOW_LICENCE"] == "Y"):?>
						<div class="licence_block bx_filter">
							<input type="checkbox" id="licenses" <?=(COption::GetOptionString("aspro.priority", "LICENCE_CHECKED", "N") == "Y" ? "checked" : "");?> name="licenses" required value="Y">
							<label for="licenses">
								<?$APPLICATION->IncludeFile(SITE_DIR."include/licenses_text.php", Array(), Array("MODE" => "html", "NAME" => "LICENSES")); ?>
							</label>
						</div>
					<?endif;?>
					<div class="text-left">
						<?=str_replace('class="', 'class="btn-lg ', $arResult["SUBMIT_BUTTON"])?>
					</div>
				</div>
			<?=$arResult["FORM_FOOTER"]?>
		<?}?>
	</div>
</div>

<script>
	var bFormNote = <?=CUtil::PhpToJSObject($arResult['FORM_NOTE']);?>;

	$(document).ready(function(){
		if(arPriorityOptions['THEME']['CAPTCHA_FORM_TYPE'] == 'RECAPTCHA' || arPriorityOptions['THEME']['CAPTCHA_FORM_TYPE'] == 'RECAPTCHA2'){
			reCaptchaRender();
		}
		$('.inline form[name="<?=$arResult["IBLOCK_CODE"]?>"]').validate({
			ignore: ".ignore",
			highlight: function( element ){
				$(element).parent().addClass('error');
			},
			unhighlight: function( element ){
				$(element).parent().removeClass('error');
			},
			submitHandler: function( form ){
				if( $('.inline form[name="<?=$arResult["IBLOCK_CODE"]?>"]').valid() ){
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
			$('.inline form[name="<?=$arResult['IBLOCK_CODE']?>"] input.phone').inputmask('mask', {'mask': arPriorityOptions['THEME']['PHONE_MASK'], 'showMaskOnHover': false });
			$('.inline form[name="<?=$arResult['IBLOCK_CODE']?>"] input.phone').blur(function(){
				if( $(this).val() == base_mask || $(this).val() == '' ){
					if( $(this).hasClass('required') ){
						$(this).parent().find('div.error').html(BX.message('JS_REQUIRED'));
					}
				}
			});
		}

		if(arPriorityOptions['THEME']['DATE_MASK'].length){
			$('.inline form[name="<?=$arResult['IBLOCK_CODE']?>"] input.date').inputmask('datetime', {
				inputFormat: arPriorityOptions['THEME']['DATE_MASK'],
				placeholder: arPriorityOptions['THEME']['DATE_PLACEHOLDER'],
				showMaskOnHover: false
			});
		}

		if(arPriorityOptions['THEME']['DATETIME_MASK'].length){
			$('.inline form[name="<?=$arResult['IBLOCK_CODE']?>"] input.datetime').inputmask('datetime', {
				inputFormat: arPriorityOptions['THEME']['DATETIME_MASK'],
				placeholder: arPriorityOptions['THEME']['DATETIME_PLACEHOLDER'],
				showMaskOnHover: false
			});
		}

		$('.jqmClose').closest('.jqmWindow').jqmAddClose('.jqmClose');

		$('input[type=file]').uniform({fileButtonHtml: BX.message('JS_FILE_BUTTON_NAME'), fileDefaultHtml: BX.message('JS_FILE_DEFAULT')});
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