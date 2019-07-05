<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="row">
	<div class="maxwidth-theme">
		<div class="col-md-12">
			<div class="form order border<?=($arResult['FORM_NOTE'] ? ' success' : '')?><?=($arResult['isFormErrors'] == 'Y' ? ' error' : '')?>">
				<!--noindex-->
				<?if($arResult["isFormErrors"] == "Y"):?>
					<div class="form-error alert alert-danger"><?=$arResult["FORM_ERRORS_TEXT"]?></div>
				<?endif;?>
				<?=$arResult["FORM_HEADER"]?>
				<?=bitrix_sessid_post();?>
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<?if($arResult["isFormDescription"] == "Y"):?>
								<div class="description"><?=$arResult["FORM_DESCRIPTION"]?></div>
							<?endif;?>
						</div>
						<div class="col-md-12 col-sm-12">
							<?if(is_array($arResult["QUESTIONS"])):?>
								<?foreach($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):?>
									<?if($FIELD_SID == "ORDER_LIST"):?>
										<div class="hidden">
									<?endif;?>
									<?CPriority::drawFormField($FIELD_SID, $arQuestion);?>
									<?if($FIELD_SID == "ORDER_LIST"):?>
										</div>
									<?endif;?>
								<?endforeach;?>
							<?endif;?>
							<?if($arResult["isUseCaptcha"] == "Y"):?>
								<div class="form-control captcha-row clearfix">
									<label><span><?=GetMessage("FORM_CAPRCHE_TITLE")?>&nbsp;<span class="star">*</span></span></label>
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
							<div class="form-footer1">
								<?if($arParams["SHOW_LICENCE"] == "Y"):?>
									<div class="licence_block bx_filter">
										<input type="checkbox" id="licenses_inline_<?=$arResult["arForm"]["ID"];?>" <?=(COption::GetOptionString("aspro.priority", "LICENCE_CHECKED", "N") == "Y" ? "checked" : "");?> name="licenses_popup" required value="Y">
										<label for="licenses_inline_<?=$arResult["arForm"]["ID"];?>">
											<?$APPLICATION->IncludeFile(SITE_DIR."include/licenses_text.php", Array(), Array("MODE" => "html", "NAME" => "LICENSES")); ?>
										</label>
									</div>
								<?endif;?>
								<div class="">
									<input type="submit" class="btn btn-default btn-lg" value="<?=$arResult["arForm"]["BUTTON"]?>" name="web_form_submit">
								</div>
							</div>
						</div>
					</div>
				<?=$arResult["FORM_FOOTER"]?>
				<!--/noindex-->
				<script type="text/javascript">
				var bFormNote = <?=CUtil::PhpToJSObject($arResult['FORM_NOTE']);?>;
				$(document).ready(function(){
					if(arPriorityOptions['THEME']['USE_SALE_GOALS'] !== 'N'){
						var eventdata = {goal: 'goal_order_begin'};
						BX.onCustomEvent('onCounterGoals', [eventdata]);
					}
					var sessionID = '<?=bitrix_sessid()?>';
					$('input[data-sid=SESSION_ID]').val(sessionID);

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
								$('form[name="<?=$arResult["arForm"]["VARNAME"]?>"]').prepend('<div class="overlay_form"><div class="loader"><div class="duo duo1"><div class="dot dot-a"></div><div class="dot dot-b"></div></div><div class="duo duo2"><div class="dot dot-a"></div><div class="dot dot-b"></div></div></div></div>');
								if(!bFormNote){
									$('form[name="<?=$arResult["arForm"]["VARNAME"]?>"]').prepend('<div class="overlay_form"><div class="loader"><div class="duo duo1"><div class="dot dot-a"></div><div class="dot dot-b"></div></div><div class="duo duo2"><div class="dot dot-a"></div><div class="dot dot-b"></div></div></div></div>');
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
</div>