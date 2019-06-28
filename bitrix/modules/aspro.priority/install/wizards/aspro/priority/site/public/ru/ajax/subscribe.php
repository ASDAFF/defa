<?define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
$licenceChecked = (isset($arTheme["SHOW_LICENCE"]["DEPENDENT_PARAMS"]) && $arTheme["SHOW_LICENCE"]["DEPENDENT_PARAMS"]["LICENCE_CHECKED"]["VALUE"] == "Y" || $arTheme["LICENCE_CHECKED"] == 'Y' ? 'checked' : '');
$subscribePage = (isset($arTheme["SUBSCRIBE_PAGE"]["VALUE"]) && $arTheme["SUBSCRIBE_PAGE"]["VALUE"] ? $arTheme["SUBSCRIBE_PAGE"]["VALUE"] : $arTheme["SUBSCRIBE_PAGE"]);
$showLicence = (isset($arTheme["SHOW_LICENCE"]['VALUE']) && $arTheme["SHOW_LICENCE"]['VALUE'] == 'Y' ? $arTheme["SHOW_LICENCE"]['VALUE'] : $arTheme["SHOW_LICENCE"]);
?>
<div class="form popup bxform">
	<div class="wrap">
		<span class="jqmClose top-close fa fa-close">
			<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/close.svg');?>
		</span>
		<form name="short_subscribe" action="<?=$APPLICATION->GetCurPage();?>" method="post" enctype="multipart/form-data" novalidate="novalidate">
			<?echo bitrix_sessid_post();?>
			<input type="hidden" name="type" value="subscribe">
			<input type="hidden" name="note" value="Y">
			<div class="form-header">
				<div class="text">
					<div class="title"><?=GetMessage('SUBSCRIBE_TITLE');?></div>
				</div>
			</div>
			<div class="form-body">
				<div class="row" data-sid="SUBSCRIBE">
					<div class="col-md-12">
						<div class="form-group animated-labels">
							<label for="POPUP_EMAIL"><span><?=GetMessage('EMAIL');?>&nbsp;<span class="required-star">*</span></span></label>
							<div class="input">
								<input type="email" id="POPUP_EMAIL" class="form-control inputtext" data-sid="EMAIL" required name="EMAIL" value="" aria-required="true">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-footer">
				<?if($showLicence == 'Y'):?>
					<div class="subscribe_licenses">
						<div class="licence_block bx_filter label_block">
							<input type="checkbox" id="licenses_popup" <?=($licenceChecked ? 'checked' : '');?> name="licenses_subscribe" value="Y" required>
							<label for="licenses_popup">
								<?$APPLICATION->IncludeFile(SITE_DIR."include/licenses_text.php", Array(), Array("MODE" => "html", "NAME" => "LICENSES")); ?>
							</label>
						</div>
					</div>
				<?endif;?>
				<div class="buttons clearfix">
					<input class="btn btn-default btn-lg pull-left" type="submit" value="<?=GetMessage('SUBSCRIBE_PAGE');?>" name="web_form_submit">
					<a class="settings font_upper pull-right" href="<?=$subscribePage;?>"><?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/gear.svg');?><?=GetMessage('SETTINGS');?></a>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
$(document).ready(function(){
	if(arPriorityOptions['THEME']['CAPTCHA_FORM_TYPE'] == 'RECAPTCHA' || arPriorityOptions['THEME']['CAPTCHA_FORM_TYPE'] == 'RECAPTCHA2'){
		reCaptchaRender();
	}
	$('.popup form[name="short_subscribe"]').validate({
		ignore: ".ignore",
		highlight: function( element ){
			$(element).parent().addClass('error');
		},
		unhighlight: function( element ){
			$(element).parent().removeClass('error');
		},
		submitHandler: function( form ){
			if( $('.popup form[name="short_subscribe').valid() ){
				$(form).find('button[type="submit"]').attr('disabled', 'disabled');
				if(arPriorityOptions['THEME']['CAPTCHA_FORM_TYPE'] == 'RECAPTCHA2')
				{
					if($(form).find('.g-recaptcha-response').val()){
						//form.submit();
					}else
						grecaptcha.execute($(form).find('.g-recaptcha').attr('data-widgetid'));
				}

				var data = $(form).serialize();
				
				$.ajax({
					url: arPriorityOptions['SITE_DIR'] + 'ajax/subscribe_user.php',
					data: {'data': data},
					type: 'POST',
				}).success(function(html){
					$('.form.popup').html(html);
					$('.form.popup').addClass('success');
					//form.submit();
				});
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
});
</script>
<?
/*$APPLICATION->IncludeComponent(
	"bitrix:subscribe.edit",
	"main",
	Array(
		"AJAX_MODE" => "N",
		"SHOW_HIDDEN" => "N",
		"ALLOW_ANONYMOUS" => "Y",
		"SHOW_AUTH_LINKS" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"SET_TITLE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
	),
false
);*/?>