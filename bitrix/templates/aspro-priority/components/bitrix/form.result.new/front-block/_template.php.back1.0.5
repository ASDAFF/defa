<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="front-form">
	<div class="maxwidth-theme">
		<div class="col-md-12">
		<div class="form contacts<?=($arResult['FORM_NOTE'] ? ' success' : '')?><?=($arResult['isFormErrors'] == 'Y' ? ' error' : '')?>  item-views blocks">
			<!--noindex-->
			<div class="form-header1">
				<?if($arResult["isFormTitle"] == "Y"):?>
					<div class="top">
						<h3><?=($arResult['FORM_NOTE'] ? GetMessage("SUCCESS_TITLE") : $arResult["FORM_TITLE"]);?></h3>
					</div>
				<?endif;?>
				<?if($arResult["isFormDescription"] == "Y"):?>
					<div class="desc"><?=$arResult["FORM_DESCRIPTION"]?></div>
				<?endif;?>
				<?if(strlen($arResult["FORM_NOTE"])){?>
					<div class="form_result <?=($arResult["isFormErrors"] == "Y" ? 'error' : 'success')?>">
						<?if($arResult["isFormErrors"] == "Y"):?>
							<?=$arResult["FORM_ERRORS_TEXT"]?>
						<?else:?>
							<?$successNoteFile = SITE_DIR."include/form/success_{$arResult["arForm"]["SID"]}.php";?>
							<?if(\Bitrix\Main\IO\File::isFileExists(\Bitrix\Main\Application::getDocumentRoot().$successNoteFile)):?>
								<?$APPLICATION->IncludeFile($successNoteFile, array(), array("MODE" => "html", "NAME" => "Form success note"));?>
							<?elseif($arParams["SUCCESS_MESSAGE"]):?>
								<?=$arParams["SUCCESS_MESSAGE"];?>
							<?else:?>
								<?=GetMessage("FORM_SUCCESS");?>
							<?endif;?>
							<script>
								if(arPriorityOptions['THEME']['USE_FORMS_GOALS'] !== 'NONE')
								{
									var id = '_'+'<?=((isset($arResult["arForm"]["ID"]) && $arResult["arForm"]["ID"]) ? $arResult["arForm"]["ID"] : $arResult["ID"] )?>';
									var eventdata = {goal: 'goal_webform_success' + (arPriorityOptions['THEME']['USE_FORMS_GOALS'] === 'COMMON' ? '' : id)};
									BX.onCustomEvent('onCounterGoals', [eventdata]);
								}
							</script>
							<?if( $arParams["DISPLAY_CLOSE_BUTTON"] ){?>
								<div class="form-footer" style="text-align: center;">
									<button class="btn-lg btn btn-default refresh-page"><?=($arParams["CLOSE_BUTTON_NAME"] ? $arParams["CLOSE_BUTTON_NAME"] : GetMessage("RELOAD_PAGE"));?></button>
								</div>
							<?}?>
						<?endif;?>
					</div>
				<?}?>
			</div>
			<?if(!$arResult["FORM_NOTE"]){?>
				<div class="bottom">
					<?if($arResult["isFormErrors"] == "Y"):?>
						<div class="form-error alert alert-danger"><?=$arResult["FORM_ERRORS_TEXT"]?></div>
					<?endif;?>
					<?=$arResult["FORM_HEADER"]?>
					<?=bitrix_sessid_post();?>
					<div class="form-body1">
						<?if(is_array($arResult["QUESTIONS"])):?>
							<div class="row">
								<?foreach($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):
									if( $FIELD_SID == "MESSAGE" ) continue;?>
									<div class="col-md-4 col-sm-4">
										<?CPriority::drawFormField($FIELD_SID, $arQuestion);?>
									</div>
								<?endforeach;?>
							</div>
						<?endif;?>
						<?if($arResult["QUESTIONS"]["MESSAGE"]):?>
							<?CPriority::drawFormField("MESSAGE", $arResult["QUESTIONS"]["MESSAGE"]);?>
						<?endif;?>
						<?if($arResult["isUseCaptcha"] == "Y"):?>
							<div class="form-control captcha-row clearfix">
								<label><span><?=GetMessage("FORM_CAPRCHE_TITLE")?>&nbsp;<span class="required-star">*</span></span></label>
								<div class="captcha_image">
									<img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"])?>" border="0" />
									<input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"])?>" />
									<div class="captcha_reload"></div>
								</div>
								<div class="captcha_input">
									<input type="text" class="inputtext captcha" name="captcha_word" size="30" maxlength="50" value="" required />
								</div>
							</div>
						<?elseif($arParams["HIDDEN_CAPTCHA"] == "Y"):?>
							<textarea name="nspm" style="display:none;"></textarea>
						<?endif;?>
					</div>
					<div class="form-footer" style="margin-top: 5px;">
						<?if($arParams["SHOW_LICENCE"] == "Y"):?>
							<div class="licence_block bx_filter">
								<input type="checkbox" id="licenses_popup" <?=(COption::GetOptionString("aspro.priority", "LICENCE_CHECKED", "N") == "Y" ? "checked" : "");?> name="licenses_popup" required value="Y">
								<label for="licenses_popup">
									<?$APPLICATION->IncludeFile(SITE_DIR."include/licenses_text.php", Array(), Array("MODE" => "html", "NAME" => "LICENSES")); ?>
								</label>
							</div>
						<?endif;?>
						<div class="">
							<input type="submit" class="btn btn-default btn-lg" value="<?=$arResult["arForm"]["BUTTON"]?>" name="web_form_submit">
						</div>
					</div>
					<?=$arResult["FORM_FOOTER"]?>
				</div>
			<?}?>
			<!--/noindex-->
			<script type="text/javascript">
			$(document).ready(function(){
				$('form[name="<?=$arResult["arForm"]["VARNAME"]?>"]').validate({
					highlight: function( element ){
						$(element).parent().addClass('error');
					},
					unhighlight: function( element ){
						$(element).parent().removeClass('error');
					},
					submitHandler: function( form ){
						if( $('form[name="<?=$arResult["arForm"]["VARNAME"]?>"]').valid() ){
							setTimeout(function() {
								$(form).find('button[type="submit"]').attr("disabled", "disabled");
							}, 300);
							var eventdata = {type: 'form_submit', form: form, form_name: '<?=$arResult["arForm"]["VARNAME"]?>'};
							BX.onCustomEvent('onSubmitForm', [eventdata]);
						}
					},
					errorPlacement: function( error, element ){
						error.insertBefore(element);
					},
					messages:{
				      licenses_popup: {
				        required : BX.message('JS_REQUIRED_LICENSES')
				      }
					}
				});

				
				if(arPriorityOptions['THEME']['PHONE_MASK'].length){
					var base_mask = arPriorityOptions['THEME']['PHONE_MASK'].replace( /(\d)/g, '_' );
					$('form[name="<?=$arResult["arForm"]["VARNAME"]?>"] input.phone').inputmask('mask', {'mask': arPriorityOptions['THEME']['PHONE_MASK'], 'showMaskOnHover': false });
					$('form[name="<?=$arResult["arForm"]["VARNAME"]?>"] input.phone').blur(function(){
						if( $(this).val() == base_mask || $(this).val() == '' ){
							if( $(this).hasClass('required') ){
								$(this).parent().find('div.error').html(BX.message('JS_REQUIRED'));
							}
						}
					});
				}
				
				if(arPriorityOptions['THEME']['DATE_MASK'].length)
					$('form[name="<?=$arResult["arForm"]["VARNAME"]?>"] input.date').inputmask(arPriorityOptions['THEME']['DATE_MASK'], { 'placeholder': arPriorityOptions['THEME']['DATE_PLACEHOLDER'], 'showMaskOnHover': false  });

				$('.jqmClose').on('click', function(e){
					e.preventDefault();
					$(this).closest('.jqmWindow').jqmHide();
				})

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
		</div>
	</div>
</div>