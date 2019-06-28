<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?
// geting section items count and section [ID, NAME]
$arItemFilter = CPriority::GetCurrentSectionElementFilter($arResult["VARIABLES"], $arParams);
$arSectionFilter = CPriority::GetCurrentSectionFilter($arResult["VARIABLES"], $arParams);
$itemsCnt = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());
$arSection = CCache::CIblockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "N")), $arSectionFilter, false, array('ID', 'DESCRIPTION', 'PICTURE', 'DETAIL_PICTURE'), true);
CPriority::AddMeta(
	array(
		'og:description' => $arSection['DESCRIPTION'],
		'og:image' => (($arSection['PICTURE'] || $arSection['DETAIL_PICTURE']) ? CFile::GetPath(($arSection['PICTURE'] ? $arSection['PICTURE'] : $arSection['DETAIL_PICTURE'])) : false),
	)
);
?>
<?if(!$arSection && $arParams['SET_STATUS_404'] !== 'Y'):?>
	<div class="alert alert-warning"><?=GetMessage("SECTION_NOTFOUND")?></div>
<?elseif(!$arSection && $arParams['SET_STATUS_404'] === 'Y'):?>
	<?CPriority::goto404Page();?>
<?else:?>
	<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>
	<?// rss
	if($arParams['USE_RSS'] !== 'N'){
		CPriority::ShowRSSIcon(CComponentEngine::makePathFromTemplate($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss_section'], array_map('urlencode', $arResult['VARIABLES'])));
	}?>
	<?if(!$itemsCnt):?>
		<div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div>
	<?endif;?>
	<?// section elements?>
	<?@include_once('page_blocks/'.$arParams["SECTION_TYPE_VIEW"].'.php');?>
	<?if($arParams['SHOW_ASK_QUESTION_BLOCK'] !== 'N'):?>
		<div class="order-block" style="margin-bottom:0;">
			<div class="row">
				<div class="col-md-8 col-sm-8 col-xs-7 valign">
					<div class="text">
						<?$APPLICATION->IncludeComponent('bitrix:main.include', '', Array('AREA_FILE_SHOW' => 'file', 'PATH' => SITE_DIR.'include/ask_question_faq.php', 'EDIT_TEMPLATE' => ''));?>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-5 valign">
					<span class="btn btn-default btn-lg" data-event="jqm" data-param-id="<?=CCache::$arIBlocks[SITE_ID]['aspro_priority_form']['aspro_priority_question'][0]?>" data-name="question"><span><?=(strlen($arParams['S_ASK_QUESTION']) ? $arParams['S_ASK_QUESTION'] : GetMessage('S_ASK_QUESTION'))?></span></span>
				</div>
			</div>
		</div>
	<?endif;?>
<?endif;?>