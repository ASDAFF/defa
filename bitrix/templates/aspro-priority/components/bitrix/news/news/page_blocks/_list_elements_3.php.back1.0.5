<?
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
			<?if(\Bitrix\Main\Loader::includeModule('subscribe')):?>
				<div class="subscribe font_upper pull-right">
					<span class="animate-load" data-event="jqm" data-param-id="subscribe" data-param-type="subscribe" data-name="subscribe">
						<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/subscribe.svg')?>
						<?=GetMessage('SUBSCRIBE_BUTTON')?>
					</span>
				</div>
			<?endif;?>
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
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"news_list_3",
	Array(
		"IMAGE_POSITION" => $arParams["IMAGE_POSITION"],
		"SHOW_CHILD_SECTIONS" => $arParams["SHOW_CHILD_SECTIONS"],
		"DEPTH_LEVEL" => 1,
		"SHOW_SECTION_PREVIEW_DESCRIPTION" => $arParams["SHOW_SECTION_PREVIEW_DESCRIPTION"],
		"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
		"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
		"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
		"SORT_BY1"	=>	$arParams["SORT_BY1"],
		"SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
		"SORT_BY2"	=>	$arParams["SORT_BY2"],
		"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
		"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
		"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
		"SET_TITLE"	=>	($arResult['VARIABLES'] ? $arParams['SET_TITLE'] : 'N'),
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
		"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
		"CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
		"DISPLAY_NAME"	=>	$arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
		"SHOW_DETAIL_LINK"	=>	$arParams["SHOW_DETAIL_LINK"],
		"FILTER_NAME"	=>	$arParams["FILTER_NAME"],
		"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
		"PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
		"PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
		"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"INCLUDE_SUBSECTIONS" => "N",
	),
	$component
);?>