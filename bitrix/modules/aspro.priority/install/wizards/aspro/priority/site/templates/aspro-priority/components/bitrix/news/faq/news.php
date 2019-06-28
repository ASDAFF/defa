<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?
$arItemFilter = CPriority::GetIBlockAllElementsFilter($arParams);
$itemsCnt = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());

// rss
if($arParams['USE_RSS'] !== 'N'){
	CPriority::ShowRSSIcon($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss']);
}
?>
<?// intro text?>
<div class="text_before_items">
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "page",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => ""
		)
	);?>
</div>
<?if(!$itemsCnt):?>
	<div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div>
<?else:?>
	<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>
	<?// section elements?>
	<?@include_once('page_blocks/'.$arParams["SECTION_ELEMENTS_TYPE_VIEW"].'.php');?>
	<?if($arParams['SHOW_ASK_QUESTION_BLOCK'] !== 'N'):?>
		<table class="order-block faq">
			<tr">
				<td class="col-md-9 col-sm-8 col-xs-7 valign">
					<div class="text">
						<?$APPLICATION->IncludeComponent('bitrix:main.include', '', Array('AREA_FILE_SHOW' => 'file', 'PATH' => SITE_DIR.'include/ask_question_faq.php', 'EDIT_TEMPLATE' => ''));?>
					</div>
				</td>
				<td class="col-md-3 col-sm-4 col-xs-5 valign">
					<div class="btns">
						<span class="btn btn-default btn-lg animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question")?>" data-name="question"><span><?=(strlen($arParams['S_ASK_QUESTION']) ? $arParams['S_ASK_QUESTION'] : GetMessage('S_ASK_QUESTION'))?></span></span>
					</div>
				</td>
			</tr>
		</table>
	<?endif;?>
<?endif;?>