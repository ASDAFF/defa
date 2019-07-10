<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

$arItemFilter = CPriority::GetIBlockAllElementsFilter($arParams);
$arItemSelect = array('ID', 'NAME', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'PROPERTY_MAP', 'PROPERTY_PHONE', 'PROPERTY_SCHEDULE', 'PROPERTY_METRO', 'PROPERTY_EMAIL');
$arItems = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, false, false, $arItemSelect);
$arAllSections = $arProperties = array();

if($arItems){
	$arAllSections = CPriority::GetSections($arItems, $arParams);
	
	$dbRes = CIBlock::GetProperties($arParams['IBLOCK_ID']);
	while($arRes = $dbRes->Fetch()){
		$arProperties[$arRes['CODE']] = $arRes;
	}
}
?>

<?if($arParams['SHOW_TOP_MAP'] != 'Y'):?>
	<div class="contacts-page-top">
		<div class="contacts maxwidth-theme">
			<div class="row">
				<?$bHasSections = (isset($arAllSections['ALL_SECTIONS']) && $arAllSections['ALL_SECTIONS']);?>
				<?$bHasChildSections = (isset($arAllSections['CHILD_SECTIONS']) && $arAllSections['CHILD_SECTIONS']);?>
				<?if($bHasSections):?>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6 col-sm-4">
								<select class="form-control <?=($bHasChildSections ? 'region' : 'city');?>">
									<option value="0" selected><?=Loc::getMessage('CHOISE_ITEM', array('#ITEM#' => ($bHasChildSections ? Loc::getMessage('REGION') : Loc::getMessage('CITY'))))?></option>
									<?foreach($arAllSections['ALL_SECTIONS'] as $arSection):?>
										<option value="<?=$arSection['SECTION']['ID'];?>"><?=$arSection['SECTION']['NAME'];?></option>
									<?endforeach;?>
								</select>
							</div>
							<?if($bHasChildSections):?>
								<div class="col-md-6 col-sm-4">
									<select class="form-control city">
										<option value="0" selected><?=Loc::getMessage('CHOISE_ITEM', array('#ITEM#' => Loc::getMessage('CITY')))?></option>
										<?foreach($arAllSections['CHILD_SECTIONS'] as $arSection):?>
											<option style="display:none;" value="<?=$arSection['ID'];?>" data-parent_section="<?=$arSection['IBLOCK_SECTION_ID'];?>"><?=$arSection['NAME'];?></option>
										<?endforeach;?>
									</select>
								</div>
							<?endif;?>
						</div>
					</div>
				<?endif;?>
				<?if($arParams['USE_FEEDBACK']):?>
					<div class="col-md-6 text-right button_wrap">
						<div class="button"><span class="btn btn-default btn-transparent btn-lg animate-load question" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question")?>" data-name="question"><?=(isset($arParams['S_FEEDBACK_BUTTON']) && $arParams['S_FEEDBACK_BUTTON'] ? $arParams['S_FEEDBACK_BUTTON'] : GetMessage('S_FEEDBACK_BUTTON'));?></span></div>
					</div>
				<?endif;?>
			</div>
		</div>
	</div>
<?endif;?>
<div class="ajax_items">
	<?if((isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") || (strtolower($_REQUEST['ajax']) == 'y')){
		$APPLICATION->RestartBuffer();?>
	<?}?>
	<?if($arItems):?>
		<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>
		<?@include_once('page_blocks/'.$arParams["SECTIONS_TYPE_VIEW"].'.php');?>
		<?CPriority::checkRestartBuffer();?>
	<?endif;?>
</div>