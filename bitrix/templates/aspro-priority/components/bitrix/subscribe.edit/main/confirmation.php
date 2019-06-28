<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
//*************************************
//show confirmation form
//*************************************
?>
<div class="confirmation-block top-form">
	<h4><?echo GetMessage("subscr_title_confirm")?></h4>
	<form action="<?=$arResult["FORM_ACTION"]?>" method="get" class="form">
		<div class="form-group animated-labels">
			<div class="row">
				<div class="c_input_wrap col-md-6  col-sm-6">
					<div class="form-group">
						<label for="CONFIRM_CODE"><?echo GetMessage("subscr_conf_code")?><span class="required-star">*</span></label>
						<div class="input">
							<input class="form-control" type="text" id="CONFIRM_CODE" name="CONFIRM_CODE" value="<?echo $arResult["REQUEST"]["CONFIRM_CODE"];?>" size="20" />
						</div>
					</div>
				</div>
				<div class="c_message_wrap col-md-6  col-sm-6">
					<div class="text_block">
					<?echo GetMessage("subscr_conf_note1")?> <a title="<?echo GetMessage("adm_send_code")?>" href="<?echo $arResult["FORM_ACTION"]?>?ID=<?echo $arResult["ID"]?>&amp;action=sendcode&amp;<?echo bitrix_sessid_get()?>"><?echo GetMessage("subscr_conf_note2")?></a>.
					</div>
				</div>
			</div>			
		</div>

		<input type="submit" class="btn btn-default btn-confirm" name="confirm" value="<?echo GetMessage("subscr_conf_button")?>" />
		<div class="text_block popup">
		<?echo GetMessage("subscr_conf_note1")?> <a title="<?echo GetMessage("adm_send_code")?>" href="<?echo $arResult["FORM_ACTION"]?>?ID=<?echo $arResult["ID"]?>&amp;action=sendcode&amp;<?echo bitrix_sessid_get()?>"><?echo GetMessage("subscr_conf_note2")?></a>.
		</div>
		
		<input type="hidden" name="ID" value="<?echo $arResult["ID"];?>" />
		<input type="hidden" name="type" value="subscribe" />

		<?echo bitrix_sessid_post();?>
	</form>
</div>
