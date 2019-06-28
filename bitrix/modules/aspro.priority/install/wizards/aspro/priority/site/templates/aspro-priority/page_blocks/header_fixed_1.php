<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
global $arRegion;
$bOrder = (isset($arTheme['ORDER_VIEW']['VALUE']) && $arTheme['ORDER_VIEW']['VALUE'] == 'Y' && $arTheme['ORDER_VIEW']['DEPENDENT_PARAMS']['ORDER_BASKET_VIEW']['VALUE']=='HEADER' || $arTheme['ORDER_VIEW'] == 'Y' && $arTheme['ORDER_BASKET_VIEW'] == 'HEADER' ? true : false);
$headerType = ($arTheme['HEADER_TYPE'] && !is_array($arTheme['HEADER_TYPE']) ? $arTheme['HEADER_TYPE'] : $arTheme['HEADER_TYPE']['VALUE']);
?>
<div class="maxwidth-theme">
	<div class="logo-row v1 row margin0 fixed_row_<?=$headerType;?> block-phone">
		<div class="pull-left">
			<div class="inner-table-block logo-block">
				<?CPriority::ShowBurger();?>
				<div class="logo<?=($arTheme["COLORED_LOGO"]["VALUE"] !== "Y" ? '' : ' colored')?>">
					<?=CPriority::ShowLogo();?>
				</div>
			</div>
		</div>
		<div class="right-icons pull-right">
			<?if($bOrder):?>
				<div class="pull-right wrap_basket">
					<?=CPriority::ShowBasketLink('top-btn inner-table-block');?>
				</div>
			<?endif;?>
			<?if($arTheme["CABINET"]["VALUE"]=='Y'):?>
				<div class="pull-right">
					<div class="inner-table-block small-block">
						<div class="wrap_icon wrap_cabinet">
							<?=CPriority::showCabinetLink(true, false);?>
						</div>
					</div>
				</div>
			<?endif;?>
			<div class="pull-right callback">
			</div>
			<div class="pull-right logo_and_menu-row">
				<?if($arRegion):?>
					<div class="wrap_icon inner-table-block">
						<?CPriority::ShowListRegions();?>
					</div>
				<?endif?>
				<div class="inner-table-block phones">
					<?CPriority::ShowHeaderPhones('mask');?>
					<div class="callback_wrap">
						<div class="animate-load font_upper colored" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_callback");?>" data-name="callback">
							<span><?=GetMessage("S_CALLBACK")?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="search animation-width">
			<div class="inner-table-block">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => SITE_DIR."include/header/search.title.php",
						"EDIT_TEMPLATE" => "include_area.php"
					)
				);?>
			</div>
		</div>
	</div>
</div>