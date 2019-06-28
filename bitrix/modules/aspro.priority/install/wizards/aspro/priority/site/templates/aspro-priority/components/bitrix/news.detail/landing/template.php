<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?
global $arTheme;
use \Bitrix\Main\Localization\Loc;?>

<?// shot top banners start?>
<?$bShowTopBanner = (isset($arResult['SECTION_BNR_CONTENT'] ) && $arResult['SECTION_BNR_CONTENT'] == true);?>
<?if($bShowTopBanner):?>
	<?$this->SetViewTarget("section_bnr_content");?>
		<?CPriority::ShowTopDetailBanner($arResult, $arParams);?>
	<?$this->EndViewTarget();?>
<?endif;?>
<?// shot top banners end?>

<?if($arResult["PROPERTIES"]["H3_GOODS"]["VALUE"]):?>
	<?$this->SetViewTarget("langing_title");?>
		<h4><?=$arResult["PROPERTIES"]["H3_GOODS"]["VALUE"];?></h4>
	<?$this->EndViewTarget();?>
<?endif;?>

<div class="row">
	<?$bShowFormQuestion = ($arResult['PROPERTIES']['FORM_QUESTION']['VALUE_XML_ID'] == 'YES');?>
	<?if($arResult["DETAIL_TEXT"]):?>
		<div class="col-md-<?=($bShowFormQuestion ? 9 : 12)?>">
			<div class="previewtext"><?=$arResult["DETAIL_TEXT"];?></div>
		</div>
	<?endif;?>
	<?if($bShowFormQuestion):?>
		<div class="col-md-3">
			<div class="ask_a_question_wrapper">
				<div class="fixed_block_fix"></div>
				<div class="ask_a_question border shadow">
					<div class="inner">
						<div class="text-block">
							<?$APPLICATION->IncludeComponent(
								 'bitrix:main.include',
								 '',
								 Array(
									  'AREA_FILE_SHOW' => 'page',
									  'AREA_FILE_SUFFIX' => 'ask',
									  'EDIT_TEMPLATE' => ''
								 )
							);?>
						</div>
					</div>
					<div class="outer">
						<span class="font_upper animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID('aspro_priority_question');?>" data-autoload-need_product="<?=CPriority::formatJsName($arResult['NAME'])?>" data-name="question"><?=(strlen($arParams['S_ASK_QUESTION']) ? $arParams['S_ASK_QUESTION'] : Loc::getMessage('S_ASK_QUESTION'))?></span>
					</div>
				</div>
			</div>
		</div>
	<?endif;?>
</div>

<?if(isset($arResult["DISPLAY_PROPERTIES"]['SEO_TEXT']) && $arResult["DISPLAY_PROPERTIES"]['SEO_TEXT']['VALUE']):?>
	<?$this->SetViewTarget("langing_detail_text");?>
		<div class="landing_detail">
			<?=$arResult["DISPLAY_PROPERTIES"]['SEO_TEXT']['~VALUE']['TEXT'];?>
		</div>
	<?$this->EndViewTarget();?>
<?endif;?>