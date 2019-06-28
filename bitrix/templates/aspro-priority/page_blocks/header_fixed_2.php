<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<?
$bOrder = (isset($arTheme['ORDER_VIEW']['VALUE']) && $arTheme['ORDER_VIEW']['VALUE'] == 'Y' && $arTheme['ORDER_VIEW']['DEPENDENT_PARAMS']['ORDER_BASKET_VIEW']['VALUE']=='HEADER' || $arTheme['ORDER_VIEW'] == 'Y' && $arTheme['ORDER_BASKET_VIEW'] == 'HEADER' ? true : false);
$headerType = ($arTheme['HEADER_TYPE'] && !is_array($arTheme['HEADER_TYPE']) ? $arTheme['HEADER_TYPE'] : $arTheme['HEADER_TYPE']['VALUE']);
?>
<div class="maxwidth-theme">
	<div class="logo-row v2 fixed_row_<?=$headerType;?>">
		<div class="row">
			<div class="logo-block col-md-2">
				<?CPriority::ShowBurger();?>
				<div class="logo<?=($arTheme["COLORED_LOGO"]["VALUE"] !== "Y" ? '' : ' colored')?>">
					<?=CPriority::ShowLogo();?>
				</div>
			</div>
			<div class="col-md-8 menu-block navs js-nav">
				<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
					array(
						"COMPONENT_TEMPLATE" => ".default",
						"PATH" => SITE_DIR."include/header/menu.php",
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "",
						"AREA_FILE_RECURSIVE" => "Y",
						"EDIT_TEMPLATE" => "include_area.php"
					),
					false, array("HIDE_ICONS" => "Y")
				);?>
			</div>
			<div class="right_wrap col-md-2 pull-right">
				<div class="right-icons">
					<?if($bOrder):?>
						<div class="pull-right">
							<div class="wrap_icon wrap_basket">
								<?=CPriority::showBasketLink();?>
							</div>
						</div>
					<?endif?>
					<?if($arTheme["CABINET"]["VALUE"]=='Y'):?>
						<div class="pull-right">
							<div class="wrap_icon wrap_cabinet">
								<?=CPriority::showCabinetLink(true, false, '');?>
							</div>
						</div>
					<?endif;?>
					<div class="pull-right">
						<div class="wrap_icon">
							<?=CPriority::ShowSearch();?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>