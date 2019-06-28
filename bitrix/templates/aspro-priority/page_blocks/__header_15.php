<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
global $arTheme;
$bOrder = ($arTheme['ORDER_VIEW']['VALUE'] == 'Y' && $arTheme['ORDER_VIEW']['DEPENDENT_PARAMS']['ORDER_BASKET_VIEW']['VALUE']=='HEADER' ? true : false);
$bCabinet = ($arTheme["CABINET"]["VALUE"]=='Y' ? true : false);
$bPhone = (intval($arTheme['HEADER_PHONES']) > 0 ? true : false);
$logoClass = ($arTheme['COLORED_LOGO']['VALUE'] !== 'Y' ? '' : ' colored');
$fixedMenuClass = ($arTheme['TOP_MENU_FIXED']['VALUE'] == 'Y' ? ' canfixed' : '');
$basketViewClass = strtolower($arTheme["ORDER_BASKET_VIEW"]["VALUE"]);
?>

<header class="header-v15<?=$fixedMenuClass?><?=$basketViewClass?>">
	<div class="mega_fixed_menu">
		<div class="maxwidth-theme">
			<div class="col-md-12">
				<div class="menu-only">
					<nav class="mega-menu">
						<i class="svg svg-close"></i>
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
					</nav>
				</div>
			</div>
		</div>
	</div>

	<div class="logo_and_menu-row">
		<div class="logo-row">
			<div class="maxwidth-theme">
				<div class="col-md-4">
					<div class="burger pull-left"><i class="svg svg-burger mask"></i></div>
					<div class="search-block inner-table-block">
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
			
				<div class="logo-block col-md-2 col-md-offset-1 text-center">
					<div class="logo<?=$logoClass?>">
						<?=CPriority::ShowLogo();?>
					</div>
				</div>
				<div class="right-icons pull-right">
					<?if($bOrder):?>
						<div class="pull-right">
							<div class="wrap_icon wrap_basket">
								<?=CPriority::showBasketLink('', 'lg','');?>
							</div>
						</div>
					<?endif?>
					<?if($bCabinet):?>
						<div class="pull-right">
							<div class="wrap_icon wrap_cabinet">
								<?=CPriority::showCabinetLink(true, false, 'lg');?>
							</div>
						</div>
					<?endif?>
					<div class="pull-right">
						<div class="wrap_icon inner-table-block">
							<div class="phone-block">
								<?if($bPhone):?>
									<?CPriority::ShowHeaderPhones('lg');?>
								<?endif?>
								<div class="inline-block">
									<span class="callback-block animate-load twosmallfont colored" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_callback");?>" data-name="callback"><?=GetMessage("S_CALLBACK")?></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><?// class=logo-row?>
	</div>
	<div class="line-row visible-xs"></div>
</header>