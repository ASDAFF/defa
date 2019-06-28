<?

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/**
 * Bitrix vars
 *
 * @var CBitrixComponent         $component
 * @var CBitrixComponentTemplate $this
 * @var array                    $arParams
 * @var array                    $arResult
 * @var array                    $arLangMessages
 * @var array                    $templateData
 *
 * @var string                   $templateFile
 * @var string                   $templateFolder
 * @var string                   $parentTemplateFolder
 * @var string                   $templateName
 * @var string                   $componentPath
 *
 * @var CDatabase                $DB
 * @var CUser                    $USER
 * @var CMain                    $APPLICATION
 */

$bShowForm = true;
?>
 <!-- вставить код -->
<script type="text/javascript">

		var product = {
	        'id': '<?=$arResult['PRODUCT']["newProps"][0]["VALUE"]?>', 
	        'name': '<?=$arResult['PRODUCT']['NAME']?>', 
	        'category': '<?=$arResult['PRODUCT']['CATEGORY']?>',
	        'quantity': 1, 
	        'price': '<?=$arResult['PRODUCT']['PRICE']?>' 
	    };
		var transaction = {
	        'id': '<?=$arResult["ORDER"]["ID"]?>', 
	        'affiliation': 'buyoneclick' 
	    };
</script>
 <!--конец кода -->


<div class="aboc-modal-dialog<? if($arResult['IS_SUCCESS']): ?> aboc-modal-success<? endif; ?>">
	<div class="aboc-modal-close aboc-close"></div>
	<? if($arParams['MODAL_HEADER']): ?>
		<div class="aboc-modal-header"><?=$arParams['MODAL_HEADER']?></div>
	<? endif ?>
	<div class="aboc-modal-content">

		<? if($arResult['IS_SUCCESS']): ?>
			<?
			$bShowForm = false;
			$arOrder = $arResult['ORDER'];
			?>
			<? if($arOrder['ID']): ?>
				<? if($arParams['REDIRECT_PAGE']): ?>
					<div class="aboc-wait-title"><?=Loc::getMessage('ABOC_TPL_AJAX_WAIT_REDIRECT')?></div>
					<script type="text/javascript">
						setTimeout(function () {
							location.href = '<?=$arParams['REDIRECT_PAGE'] . '?' . http_build_query($arOrder)?>';
						}, 700);
					</script>
				<? else: ?>
					<? if($arParams['MESS_SUCCESS_TITLE']): ?>
						<div class="aboc-success-title"><?=str_replace(array('#ID#', '#ORDER_ID#', '#ORDER_DATE#'), $arResult['ORDER'], $arParams['MESS_SUCCESS_TITLE'])?></div>
					<? endif; ?>
					<? if($arParams['MESS_SUCCESS_INFO']): ?>
					<div class="aboc-success-info"><?=str_replace(array('#ID#', '#ORDER_ID#', '#ORDER_DATE#'), $arResult['ORDER'], $arParams['MESS_SUCCESS_INFO'])?>
					</div>
					<? endif; ?>
				<? endif ?>
			<? else: ?>
				<div class="aboc-success-error"><?=$arOrder['ERROR']?></div>
			<? endif; ?>
       
	   

		<? endif; ?>

		<?if(!$arResult['PRODUCT']):?>
			<?
			$bShowForm = false;
			?>
			 <div class="api-product-unavailable">
				<? if($arResult['MESSAGE_DANGER']): ?>
					<div class="api_message api_message_danger"><?=$arResult['MESSAGE_DANGER']?></div>
				<? endif ?>
				<?/* if($arResult['MESSAGE_SUCCESS']): ?>
					<div class="api_message api_message_success"><?=$arResult['MESSAGE_SUCCESS']?></div>
				<? endif */?>
			 </div>
		<?endif?>

		<? if($bShowForm): ?>
			<? if($arParams['MODAL_TEXT_BEFORE']): ?>
				<div class="aboc-modal-text-before"><?=$arParams['MODAL_TEXT_BEFORE']?></div>
			<? endif ?>
			<form action="<?=POST_FORM_ACTION_URI;?>" method="POST" class="aboc-form">
				<?=bitrix_sessid_post();?>
				<input type="hidden" name="ABOC_SUBMIT" value="Y">

				<? if($product = $arResult['PRODUCT']): ?>
					<div class="api-product">
						<? if($product['NAME']): ?>
							<div class="api-name"><?=$product['NAME']?></div>
						<? endif ?>
                            <div class="api-artikul">Артикул: <?=$product["newProps"][0]["VALUE"]?></div>
						<? if($product['PRICE']): ?>
							<?
							$hidden = ($product['DISCOUNT_PRICE_PERCENT'] > 0 ? '' : ' style="display:none;"');
                            $total_price = SaleFormatCurrency($product['TOTAL_PRICE'], 'RUB', true);
							?>
							<div class="api-prices">
								<div class="api-info-left">
									<div class="api-old-price"<?=$hidden?>><?=$product['FULL_PRICE_FORMATED']?>  ₽</div>
									<div class="api-price"><?=$total_price?>  ₽</div>
								</div>
								<div class="api-info-right">
									<div class="api-discount"<?=$hidden?>>
										<i><?=$product['DISCOUNT_PRICE_PERCENT_FORMATED']?></i><span><?=Loc::getMessage('ABOC_TPL_AJAX_DISCOUNT_PRICE')?></span>
									</div>
									<div class="api-saving"<?=$hidden?>>
										<i><?=$product['DISCOUNT_PRICE_FORMATED']?></i><span><?=Loc::getMessage('ABOC_TPL_AJAX_SAVING_PRICE')?></span>
									</div>
								</div>
							</div>
						<? endif ?>

						<? if($arParams['SHOW_QUANTITY'] == 'Y'): ?>
							<div class="api-quantity-inner">
								<div class="api-quantity">
									<div class="api-btn-minus"></div>
									<div class="api-number">
										<input type="text" name="QUANTITY" value="<?=$arParams['QUANTITY']?>" size="3" maxlength="18">
									</div>
									<div class="api-btn-plus"></div>
								</div>
							</div>
							<div class="api_message" style="display: none"></div>
						<? endif ?>

                        <div class="api-city">
                            <p>Город доставки: <span><?=$_SESSION["city_name"]?></span></p>
                            <p>Чтобы изменить,  <span class="api-close2">закройте</span>  форму и выберите другой город</p>
                        </div>

						<? if($product['PREVIEW_TEXT']): ?>
							<div class="api-desc"><?=$product['PREVIEW_TEXT']?></div>
						<? endif ?>
					</div>
				<? endif ?>


				<? if($arFields = $arParams['SHOW_FIELDS']): ?>
					<? foreach($arFields as $fieldId): ?>
						<? if($arField = $arResult['FIELDS'][ $fieldId ]): ?>
							<div class="aboc-form-row">

								<div class="aboc-form-field">
									<? /* if($arField['TYPE'] == 'LOCATION'): ?>
										<?if(Loader::includeModule('sale')):?>
											<?
											CSaleLocation::proxySaleAjaxLocationsComponent(
												 array(
														"LOCATION_VALUE"  => "",
														"CITY_INPUT_NAME" => 'CITY',
														"SITE_ID"         => SITE_ID,
												 ),
												 array(),
												 '',
												 true,
												 'api-location'
											);
											?>
										<?endif?>
									<? else: */ ?>
                                    <?$arPlace = array(1 => "Имя", 2 => "E-mail", 3 => "Телефон");?>
									<input type="text" class="abc-<?=ToLower($arField['CODE'])?>" name="FIELDS[<?=$arField['ID']?>]" value="<?=$arResult['VALUES'][ $arField['ID'] ]?>" placeholder="<?=$arPlace[$arField['ID']]?>">
									<? // endif; ?>

									<? if($error = $arResult['ERRORS'][ $fieldId ]): ?>
										<div class="aboc-field-error"><?=$error?></div>
									<? endif; ?>
								</div>
							</div>
						<? endif ?>
					<? endforeach; ?>
				<? endif ?>

				<? if($arParams['SHOW_COMMENT'] == 'Y'): ?>
					<div class="aboc-form-row">
						<div class="aboc-form-label"><?=Loc::getMessage('ABOC_TPL_AJAX_FIELD_COMMENT')?></div>
						<div class="aboc-form-field">
							<textarea name="ABOC_COMMENT"><?=$arResult['VALUES']['ABOC_COMMENT']?></textarea>
						</div>
					</div>
				<? endif ?>

				<div class="api-submit">
					<button class="aboc-submit" type="button"><?=$arParams['MODAL_TEXT_BUTTON']?></button>
				</div>
			</form>
			<? if($arParams['MODAL_TEXT_AFTER']): ?>
				<div class="aboc-modal-text-after"><?=$arParams['MODAL_TEXT_AFTER']?></div>
			<? endif ?>
		<? endif; ?>
	</div>
	<? if($arParams['MODAL_FOOTER']): ?>
		<div class="aboc-modal-footer"><?=$arParams['MODAL_FOOTER']?></div>
	<? endif ?>
</div>


