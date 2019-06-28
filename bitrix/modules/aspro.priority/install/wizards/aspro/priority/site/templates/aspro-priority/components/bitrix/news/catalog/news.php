<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?
$this->setFrameMode(true);
if($_arResult = CPriority::CheckSmartFilterSEF($arParams, $component)){
	$arResult = $_arResult;
	include  __DIR__.'/section.php';
	return;
}

global $arTheme;
$bOrderViewBasket = (trim($arTheme['ORDER_VIEW']['VALUE']) === 'Y');

$sectionTemplate = $sViewElementsTemplate = ($arParams["SECTIONS_TYPE_VIEW"] == "FROM_MODULE" ? $arTheme['SECTIONS_TYPE_VIEW']['VALUE'] : $arParams["SECTIONS_TYPE_VIEW"]);
?>
<div class="maxwidth-theme">
	<?if($sViewElementsTemplate == 'sections_3' || $sViewElementsTemplate == 'sections_6'):?>
		<div class="row">
			<?if($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"):?>
				<div class="col-md-9 col-sm-12 col-xs-12 content-md">
				<?CPriority::get_banners_position('CONTENT_TOP');?>
			<?elseif($arTheme["SIDE_MENU"]["VALUE"] == "LEFT"):?>
				<div class="col-md-3 col-sm-3 hidden-xs hidden-sm left-menu-md">
					<?CPriority::ShowPageType('left_block')?>
				</div>
				<div class="col-md-9 col-sm-12 col-xs-12 content-md">
				<?CPriority::get_banners_position('CONTENT_TOP');?>
			<?endif;?>
	<?else:?>
		<?CPriority::get_banners_position('CONTENT_TOP');?>
	<?endif;?>
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
				<?
				// get section items count and subsections
				$arItemFilter = CPriority::GetCurrentSectionElementFilter($arResult["VARIABLES"], $arParams, false);
				$arSubSectionFilter = CPriority::GetCurrentSectionSubSectionFilter($arResult["VARIABLES"], $arParams, false);
				$itemsCnt = CCache::CIBlockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());
				$arSubSections = CCache::CIBlockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "Y")), $arSubSectionFilter, false, array("ID"));

				// rss
				if($arParams['USE_RSS'] !== 'N'){
					CPriority::ShowRSSIcon($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss']);
				}
				?>
				<?if(!$itemsCnt && !$arSubSections):?>
					<div class="alert alert-warning"><?=GetMessage("SECTION_EMPTY")?></div>
				<?else:?>
					<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>
					<?if($arSubSections):?>
						<?// sections?>
						<?@include_once('page_blocks/'.$sViewElementsTemplate.'.php');?>
					<?endif;?>
					<?if($itemsCnt):?>
						<?// section elements?>
						<?if($arSubSections):?>
							<div class="element_with_sections">
						<?endif;?>
						<?@include_once('page_blocks/'.$arParams["SECTION_ELEMENTS_TYPE_VIEW"].'.php');?>
						<?if($arSubSections):?>
							</div>
						<?endif;?>
					<?endif;?>
				<?endif;?>
	<?if($sectionTemplate == 'sections_3' || $sectionTemplate == 'sections_6'):?>
			<?if($arTheme["SIDE_MENU"]["VALUE"] == "LEFT"):?>
				<?CPriority::get_banners_position('CONTENT_BOTTOM');?>
				</div><?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
			<?elseif($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"):?>
				<?CPriority::get_banners_position('CONTENT_BOTTOM');?>
				</div><?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
				<div class="col-md-3 col-sm-3 hidden-xs hidden-sm right-menu-md">
					<?CPriority::ShowPageType('left_block')?>
				</div>
			<?endif;?>
		</div>
	<?else:?>
		<?CPriority::get_banners_position('CONTENT_BOTTOM');?>
	<?endif;?>
</div>