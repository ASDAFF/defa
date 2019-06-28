<?
$bUseMap = CNext::GetFrontParametrValue('CONTACTS_USE_MAP', SITE_ID) != 'N';
$bUseFeedback = CNext::GetFrontParametrValue('CONTACTS_USE_FEEDBACK', SITE_ID) != 'N';
?>
<?if($bUseMap):?>
	<div class="contacts-page-map">
		<?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-map.php", Array(), Array("MODE" => "html", "TEMPLATE" => "include_area.php", "NAME" => "Карта"));?>
	</div>
<?endif;?>

<div class="contacts contacts-page-map-overlay maxwidth-theme" itemscope itemtype="http://schema.org/Organization">
	<div class="contacts-wrapper">
		<div class="row">
			<div class="col-md-3 col-sm-3 print-6">
				<table cellpadding="0" cellspasing="0">
					<tr>
						<td align="left" valign="top"><i class="fa big-icon s45 fa-map-marker"></i></td><td align="left" valign="top"><span class="dark_table">Адрес</span>
							<br />
							<span itemprop="address"><?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-address.php", Array(), Array("MODE" => "html", "NAME" => "Address"));?></span>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-md-3 col-sm-3 print-6">
				<table cellpadding="0" cellspasing="0">
					<tr>
						<td align="left" valign="top"><i class="fa big-icon s45 fa-phone"></i></td><td align="left" valign="top"> <span class="dark_table">Телефон</span>
							<br />
							<span itemprop="telephone"><?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-phone.php", Array(), Array("MODE" => "html", "NAME" => "Phone"));?></span>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-md-3 col-sm-3 print-6">
				<table cellpadding="0" cellspasing="0">
					<tr>
						<td align="left" valign="top"><i class="fa big-icon s45 fa-envelope"></i></td><td align="left" valign="top"> <span class="dark_table">E-mail</span>
							<br />
							<span itemprop="email"><?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-email.php", Array(), Array("MODE" => "html", "NAME" => "Email"));?></span>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-md-3 col-sm-3 print-6">
				<table cellpadding="0" cellspasing="0">
					<tr>
						<td align="left" valign="top"><i class="fa big-icon s45 fa-clock-o"></i></td><td align="left" valign="top"> <span class="dark_table">Режим работы</span>
							<br />
							<?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-schedule.php", Array(), Array("MODE" => "html", "NAME" => "Schedule"));?>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row1">
	<div class="contacts maxwidth-theme <?=($bUseMap ? 'top-cart' : '');?>">
		<div class="cols-md-12" itemprop="description">
			<?$APPLICATION->IncludeFile(SITE_DIR."include/contacts-about.php", Array(), Array("MODE" => "html", "NAME" => "Contacts about"));?>
		</div>
	</div>
</div>
<?if($bUseFeedback):?>
	<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("contacts-form-block");?>
	<?global $arTheme;?>
	<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "inline",
		Array(
			"WEB_FORM_ID" => "3",
			"IGNORE_CUSTOM_TEMPLATE" => "N",
			"USE_EXTENDED_ERRORS" => "Y",
			"SEF_MODE" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600000",
			"LIST_URL" => "",
			"EDIT_URL" => "",
			"SUCCESS_URL" => "?send=ok",
			"SHOW_LICENCE" => $arTheme["SHOW_LICENCE"]["VALUE"],
			"HIDDEN_CAPTCHA" => CNext::GetFrontParametrValue('HIDDEN_CAPTCHA'),
			"CHAIN_ITEM_TEXT" => "",
			"CHAIN_ITEM_LINK" => "",
			"VARIABLE_ALIASES" => Array(
				"WEB_FORM_ID" => "WEB_FORM_ID",
				"RESULT_ID" => "RESULT_ID"
			)
		)
	);?>
	<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("contacts-form-block", "");?>
<?endif;?>