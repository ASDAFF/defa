<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//***********************************
//setting section
//***********************************
global $arTheme;
$subscribePage = (isset($arTheme['SUBSCRIBE_PAGE']['VALUE']) && $arTheme['SUBSCRIBE_PAGE']['VALUE'] ? $arTheme['SUBSCRIBE_PAGE']['VALUE'] : $arTheme['SUBSCRIBE_PAGE']);
$licenceChecked = (isset($arTheme["SHOW_LICENCE"]["DEPENDENT_PARAMS"]) && $arTheme["SHOW_LICENCE"]["DEPENDENT_PARAMS"]["LICENCE_CHECKED"]["VALUE"] == "Y" || $arTheme["SHOW_LICENCE"] == 'Y' ? 'checked' : '');
?>
<div class="top-form">
<h4><?echo GetMessage("subscr_title_settings")?></h4>
<form action="<?=$arResult["FORM_ACTION"];?>" method="post" class="form">
	<?echo bitrix_sessid_post();?>
	<?$email = ($arResult["SUBSCRIPTION"]["EMAIL"]!=""?$arResult["SUBSCRIPTION"]["EMAIL"]:$arResult["REQUEST"]["EMAIL"]);?>
	<div class="form-group animated-labels <?=($email ? 'input-filed' : '');?>">
		<div class="row">
			<div class="col-md-6  col-sm-6">
				<div class="form-group">
					<label for="EMAIL"><?echo GetMessage("subscr_email")?><span class="required-star">*</span></label>
					<div class="input">
						<input class="form-control" type="text" id="EMAIL" name="EMAIL" value="<?=$email;?>" size="30" maxlength="255" />
					</div>
				</div>
			</div>		
			<div class="col-md-6 col-sm-6">
				<div class="text_block"><?echo GetMessage("subscr_settings_note1")?> <?echo GetMessage("subscr_settings_note2")?></div>
			</div>
		</div>
	</div>
	<div class="form-group option bx_filter">
		<div class="subsection-title"><?echo GetMessage("subscr_rub")?><span class="required-star">*</span></div>
		<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
			<input type="checkbox" name="RUB_ID[]" id="rub_<?=$itemValue["ID"]?>" value="<?=$itemValue["ID"]?>"<?if($itemValue["CHECKED"]) echo " checked"?> />
			<label for="rub_<?=$itemValue["ID"]?>"><?=$itemValue["NAME"]?></label>
		<?endforeach;?>
	</div>
	<div class="form-group option">
		<div class="subsection-title"><?echo GetMessage("subscr_fmt")?></div>
		<input type="radio" id="text" name="FORMAT" value="text"<?if($arResult["SUBSCRIPTION"]["FORMAT"] == "text") echo " checked"?> />
		<label for="text"><?echo GetMessage("subscr_text")?></label>
		&nbsp;&nbsp;
		<input type="radio" name="FORMAT" id="html" value="html"<?if($arResult["SUBSCRIPTION"]["FORMAT"] == "html") echo " checked"?> />
		<label for="html">HTML</label>
	</div>	

	<?global $arTheme;?>
	<?if((isset($arTheme["SHOW_LICENCE"]["VALUE"]) && $arTheme["SHOW_LICENCE"]["VALUE"] == "Y") || $arTheme["SHOW_LICENCE"] && !$arResult["ID"] ):?>
		<div class="subscribe_licenses">
			<div class="licence_block filter label_block">
				<input type="checkbox" id="licenses_subscribe" <?=($_REQUEST["licenses_subscribe"] ? "checked" : ($_REQUEST ? "" : ($licenceChecked)));?> name="licenses_subscribe" value="Y">
				<label for="licenses_subscribe">
					<?$APPLICATION->IncludeFile(SITE_DIR."include/licenses_text.php", Array(), Array("MODE" => "html", "NAME" => "LICENSES")); ?>
				</label>
				<?if($arResult["ERROR"] && !$_POST["licenses_subscribe"]):?>
					<label id="licenses_subscribe-error" class="error" for="licenses_subscribe"><?=GetMessage("JS_REQUIRED_LICENSES");?></label>
				<?endif;?>				
			</div>
		</div>
	<?endif;?>
	<div class="buttons">
		<input type="submit" class="btn btn-default" name="Save" data-type="subscribe" value="<?echo ($arResult["ID"] > 0? GetMessage("subscr_upd"):GetMessage("subscr_add"))?>" />
		<input type="reset" class="btn btn-default btn-transparent" value="<?echo GetMessage("subscr_reset")?>" name="reset" />
	</div>

<input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
<input type="hidden" name="type" value="subscribe">
<?if($_REQUEST["register"] == "YES"):?>
	<input type="hidden" name="register" value="YES" />
<?endif;?>
<?if($_REQUEST["authorize"]=="YES"):?>
	<input type="hidden" name="authorize" value="YES" />
<?endif;?>
</form>
</div>
<script>
$(document).ready(function(){
	$('.jqmWindow .subscribe-edit-main form').on('submit', function(){
		return false;
	});
	
	$('jqmClose').on('click', function(){
		$('jqmOverlay').click();
	});
});
</script>