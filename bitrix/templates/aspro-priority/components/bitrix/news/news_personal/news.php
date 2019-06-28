<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?// intro text?>
<div class="text_before_items"><!--
	--><?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "page",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => ""
		)
	);?><!--
--></div>
<?
$arItemFilter = CPriority::GetIBlockAllElementsFilter($arParams);

if($arParams['CACHE_GROUPS'] == 'Y')
{
	$arItemFilter['CHECK_PERMISSIONS'] = 'Y';
	$arItemFilter['GROUPS'] = $GLOBALS["USER"]->GetGroups();
}
$arGlobalFilter = ($arParams['FILTER_NAME'] ? $GLOBALS[$arParams['FILTER_NAME']] : '');
if(!is_array($arGlobalFilter))
	$arGlobalFilter = array();

$itemsCnt = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());?>

<?if(!$itemsCnt):?>
	<div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div>
<?else:?>
	<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>
	<?// rss
	if($arParams['USE_RSS'] !== 'N')
		CPriority::ShowRSSIcon($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss']);
	?>

<?$arItems = CCache::CIBLockElement_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']))), array_merge(array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y'), $arGlobalFilter), false, false, array('ID', 'NAME', 'ACTIVE_FROM'));
	$arYears = array();
	if($arItems)
	{
		foreach($arItems as $arItem)
		{
			if($arItem['ACTIVE_FROM'])
			{
				if($arDateTime = ParseDateTime($arItem['ACTIVE_FROM'], FORMAT_DATETIME))
					$arYears[$arDateTime['YYYY']] = $arDateTime['YYYY'];
			}
		}
		if($arYears)
		{
			if($arParams['USE_FILTER'] != 'N')
		{
			rsort($arYears);
			$bHasYear = (isset($_GET['year']) && (int)$_GET['year']);
			$year = ($bHasYear ? (int)$_GET['year'] : 0);
			$yearGet = (isset($_GET['year']) && strlen($_GET['year']) ? true : false)
			?>	
			
			<div class="head-block top clearfix">
				<div class="hidden-xs">
					<div class="item-link font_upper_md<?=(!$yearGet ? ' active' : '')?>">
						<div class="title">
							<?if(!$yearGet):?>
								<span class="btn-inline black"><?=GetMessage('ALL_TIME');?></span>
							<?else:?>
								<a class="btn-inline black" href="<?=$arResult['FOLDER']?>"><?=GetMessage('ALL_TIME');?></a>
							<?endif?>
						</div>
					</div>
					<?foreach($arYears as $value):?>
						<?
						$bSelected = ($bHasYear && $value == $year);
						?>
						<div class="item-link font_upper_md<?=($bSelected ? ' active' : '')?>">
							<div class="title btn-inline black">
								<?if($bSelected):?>
									<span class="btn-inline black"><?=$value?></span>
								<?else:?>
									<a class="btn-inline black" href="<?=$APPLICATION->GetCurPageParam('year='.$value, array('year'));?>"><?=$value?></a>
								<?endif?>
							</div>
						</div>
					<?endforeach;?>
				</div>
				<select class="visible-xs form-control">
					<option value="<?=$arResult['FOLDER']?>"<?=(!$yearGet ? ' selected' : '')?>><?=GetMessage('ALL_TIME');?></option>
					<?foreach($arYears as $value):?>
					<?
					$bSelected = ($bHasYear && $value == $year);
					?>
					<option value="<?=$APPLICATION->GetCurPageParam('year='.$value, array('year'));?>"<?=($bSelected ? ' selected' : '')?>><?=$value?></option>
					<?endforeach?>
				</select>
				<script>
				$(document).ready(function(){
					$('.head-block select').on('change', function(){
						window.location.href = $(this).find('option:selected').val();
					});
				});
				</script>
			</div>
				<?
				if($bHasYear)
				{
					$GLOBALS[$arParams["FILTER_NAME"]] = array(
						">DATE_ACTIVE_FROM" => ConvertDateTime("31.12.".($year-1), FORMAT_DATETIME),
						"<=DATE_ACTIVE_FROM" => ConvertDateTime("31.12.".$year, FORMAT_DATETIME),
					);
				}?>
			<?}
		}
	}?>

	<?global $arTheme, $isMenu;?>

	<?// section elements?>
	<?$sViewElementsTemplate = ($arParams["SECTION_ELEMENTS_TYPE_VIEW"] == "FROM_MODULE" ? $arTheme["NEWS_PAGE"]["VALUE"] : $arParams["SECTION_ELEMENTS_TYPE_VIEW"]);?>
	<?@include_once('page_blocks/'.$sViewElementsTemplate.'.php');?>
<?endif;?>