
<div class="maxwidth-theme">
	<?$arYears = CPriority::GetItemsYear($arParams);
	if($arYears)
	{
		if($arParams['USE_FILTER'] != 'N')
		{
			rsort($arYears);
			$bHasYear = (isset($_GET['year']) && (int)$_GET['year']);
			$year = ($bHasYear ? (int)$_GET['year'] : 0);?>
			<div class="head-block top clearfix projects_filter">
				<div class="hidden-xs">
					<div class="item-link font_upper_md <?=($bHasYear ? '' : 'active');?>">
						<?if($bHasYear):?>
							<a class="title btn-inline black" href="<?=$arResult['FOLDER'];?>">
						<?else:?>
							<div class="title">
						<?endif;?>
								<span class="btn-inline black"><?=GetMessage('ALL_TIME');?></span>
						<?if($bHasYear):?>
							</a>
						<?else:?>
							</div>
						<?endif;?>
					</div>
					<?foreach($arYears as $value):
						$bSelected = ($bHasYear && $value == $year);?>
						<div class="item-link font_upper_md <?=($bSelected ? 'active' : '');?>">
							<?if($bSelected):?>
								<div class="title btn-inline black">
							<?else:?>
								<a class="title btn-inline black" href="<?=$APPLICATION->GetCurPageParam('year='.$value, array('year'));?>">
							<?endif;?>
									<span class="btn-inline black"><?=$value;?></span>
							<?if($bSelected):?>
								</div>
							<?else:?>
								</a>
							<?endif;?>
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
		<?}?>
		<?
		if($bHasYear)
		{
			$GLOBALS[$arParams["FILTER_NAME"]] = array(
				">DATE_ACTIVE_FROM" => ConvertDateTime("31.12.".($year-1), FORMAT_DATETIME),
				"<=DATE_ACTIVE_FROM" => ConvertDateTime("31.12.".$year, FORMAT_DATETIME),
			);
		}?>
	<?}?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		'projects_list_2',
		Array(
			"IMAGE_POSITION" => $arParams["IMAGE_POSITION"],
			"SHOW_CHILD_SECTIONS" => $arParams["SHOW_CHILD_SECTIONS"],
			"DEPTH_LEVEL" => 1,
			"LINE_ELEMENT_COUNT_LIST" => $arParams["LINE_ELEMENT_COUNT_LIST"],
			"IMAGE_WIDE" => $arParams["IMAGE_WIDE"],
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
			"SET_TITLE"	=>	'N',
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
</div>