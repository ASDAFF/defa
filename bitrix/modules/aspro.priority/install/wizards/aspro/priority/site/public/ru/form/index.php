<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заполнение формы");
?>
<style type="text/css">
section.page-top {display:none;}
.form.inline{}
.form .form-header{}
.form .form-header .title{text-align:center;}
.jqmWindow .form .form-header .title{text-align:left;}
.form.popup>.wrap{position:static;}
.jqmClose.top-close{display:none;}
.form .form-header .description{margin:24px 0 -4px;}
</style>
<?
$id = (isset($_REQUEST["id"]) ? $_REQUEST["id"] : false);
$isCallBack = $id == CCache::$arIBlocks[SITE_ID]["aspro_priority_form"]["aspro_priority_callback"][0];
$successMessage = ($isCallBack ? "<p class=\"introtext\">Спасибо за ваше обращение!</p><p>Наш менеджер перезвонит вам в ближайшее время.</p>" : "<p class=\"introtext\">Спасибо!</p><p>Ваше сообщение отправлено!</p>");
$arDataTrigger = json_decode((isset($_REQUEST["data-trigger"]) ? $_REQUEST["data-trigger"] : '{}'), true); // allways UTF-8
?>
<div class="form_page">
	<?if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'review'):?>
		<?include_once('../ajax/review.php');?>
	<?elseif(isset($_REQUEST['form_id']) && $_REQUEST['form_id'] == 'city_chooser'):?>
		<?include_once('../ajax/city_chooser.php');?>
	<?elseif(isset($_REQUEST['type']) && $_REQUEST['type'] == 'auth'):?>
		<?include_once('../ajax/auth.php');?>
	<?elseif(isset($_REQUEST['type']) && $_REQUEST['type'] == 'subscribe'):?>
		<?include_once('../ajax/subscribe.php');?>
	<?elseif($id):?>
		<?$APPLICATION->IncludeComponent(
			"aspro:form.priority", "popup",
			Array(
				"IBLOCK_TYPE" => "aspro_priority_form",
				"IBLOCK_ID" => $id,
				"USE_CAPTCHA" => $captcha,
				"AJAX_MODE" => "Y",
				"AJAX_OPTION_JUMP" => "Y",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "100000",
				"AJAX_OPTION_ADDITIONAL" => "",
				//"IS_PLACEHOLDER" => "Y",
				"SUCCESS_MESSAGE" => $successMessage,
				"SEND_BUTTON_NAME" => "Отправить",
				"SEND_BUTTON_CLASS" => "btn btn-default",
				"DISPLAY_CLOSE_BUTTON" => "N",
				"CLOSE_BUTTON_NAME" => "Перезагрузить страницу",
				"CLOSE_BUTTON_CLASS" => "jqmClose btn btn-default bottom-close",
			)
		);?>
		<?if($arDataTrigger && strlen($name)):?>
			<script type="text/javascript">
			var name = '<?=$name?>';
			var arTriggerAttrs = <?=json_encode($arDataTrigger)?>;
			$(document).ready(function() {
				$.each(arTriggerAttrs, function(index, val){
					if( /^data\-autoload\-(.+)$/.test(index)){
						var key = index.match(/^data\-autoload\-(.+)$/)[1];
						var el = $('input[data-sid="'+key.toUpperCase()+'"]');
						if(!el.length)
							el = $('input[name="'+key.toUpperCase()+'"]');
						if(el.closest('.form-group').length)
							el.closest('.form-group').addClass('input-filed');
						el.val(val).attr('readonly', 'readonly').attr('title', val);
					}
				});
				
				if(name == 'order_product'){
					if(arTriggerAttrs['data-product'].length){
						$('input[name="PRODUCT"]').val(arTriggerAttrs['data-product']).attr('readonly', 'readonly').attr('title', arTriggerAttrs['data-product']);
					}
				}
			});
			</script>
		<?endif;?>
	<?else:?>
		<div class="alert alert-warning">Не указан ID формы</div>
		<?CPriority::goto404Page();?>
	<?endif;?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>