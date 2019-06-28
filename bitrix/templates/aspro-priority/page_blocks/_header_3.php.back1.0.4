<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
global $arTheme, $isIndex, $arRegion;
$headerType = ($arTheme['HEADER_TYPE'] && !is_array($arTheme['HEADER_TYPE']) ? $arTheme['HEADER_TYPE'] : $arTheme['HEADER_TYPE']['VALUE']);
$bOrder = (isset($arTheme['ORDER_VIEW']['VALUE']) && $arTheme['ORDER_VIEW']['VALUE'] == 'Y' && $arTheme['ORDER_VIEW']['DEPENDENT_PARAMS']['ORDER_BASKET_VIEW']['VALUE']=='HEADER' || $arTheme['ORDER_VIEW'] == 'Y' && $arTheme['ORDER_BASKET_VIEW'] == 'HEADER' ? true : false);
$bCabinet = ($arTheme["CABINET"]["VALUE"]=='Y' ? true : false);

if($arRegion)
	$bPhone = ($arRegion['PHONES'] ? true : false);
else
	$bPhone = ((int)$arTheme['HEADER_PHONES'] ? true : false);

$logoClass = ($arTheme['COLORED_LOGO']['VALUE'] !== 'Y' ? '' : ' colored');
$fixedMenuClass = (is_array($arTheme['TOP_MENU_FIXED']) && $arTheme['TOP_MENU_FIXED']['VALUE'] == 'Y' || $arTheme['TOP_MENU_FIXED'] == 'Y' ? ' canfixed' : '');
$basketViewClass = (is_array($arTheme["ORDER_BASKET_VIEW"]) && $arTheme["ORDER_BASKET_VIEW"]["VALUE"] ? ' '. strtolower($arTheme["ORDER_BASKET_VIEW"]["VALUE"]) : ' '. strtolower($arTheme["ORDER_BASKET_VIEW"]));
?>

<header class="header-v<?=$headerType?> topmenu-LIGHT<?=$fixedMenuClass?><?=$basketViewClass?> with-top-block" data-change_color="Y">
	<div class="top-block top-block-v1">
		<div class="maxwidth-theme">
			<div class="row">
				<div class="top-block-item col-md-8">
					<?if($arRegion):?>
						<div class="pull-left">
							<?CPriority::ShowListRegions();?>
						</div>
					<?endif?>
					<div class="phone-block pull-left">
						<?if($bPhone):?>
							<div class="inline-block">
								<?CPriority::ShowHeaderPhones();?>
							</div>
						<?endif?>
						<div class="inline-block">
							<span class="callback-block animate-load twosmallfont colored" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_callback");?>" data-name="callback"><?=GetMessage("S_CALLBACK")?></span>
						</div>
					</div>
					<div class="top-block-item social_wrap pull-left">
						<?$APPLICATION->IncludeComponent(
							"aspro:social.info.priority",
							"top",
							array(
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "3600000",
								"CACHE_GROUPS" => "N",
								"COMPONENT_TEMPLATE" => ".default"
							),
							false
						);?>
					</div>
				</div>
				
				<?if($bOrder):?>
					<div class="top-block-item pull-right show-fixed top-ctrl">
						<div class="wrap_basket twosmallfont">
							<?=CPriority::showBasketLink();?>
						</div>
					</div>
				<?endif;?>

				<?if($bCabinet):?>
					<div class="top-block-item pull-right show-fixed top-ctrl">
						<div class="personal_wrap">
							<div class="personal top login twosmallfont">
								<?=CPriority::showCabinetLink(true, false, '', true);?>
							</div>
						</div>
					</div>
				<?endif;?>
				
				<div class="top-block-item pull-right show-fixed top-ctrl">
					<?=CPriority::ShowSearch('', '', GetMessage('SEARCH_TITLE'));?>
				</div>
			</div>
		</div>
	</div>

	<div class="logo_and_menu-row<?=($isIndex ? ' wbanner' : '')?>">
		<div class="maxwidth-theme">
			<div class="logo-row">
				<div class="row">
					<div class="logo-block col-md-5 col-sm-3">
						<?CPriority::ShowBurger();?>
						<div class="logo<?=$logoClass?>">
							<?=CPriority::ShowLogo();?>
						</div>
						<div class="slogan">
							<div class="top-description">
								<?$APPLICATION->IncludeFile(SITE_DIR."include/header/header-text.php", array(), array(
										"MODE" => "html",
										"NAME" => "Text in title",
										"TEMPLATE" => "include_area",
									)
								);?>
							</div>
						</div>
					</div>
					<div class="menu-row col-md-7 pull-right">
						<div class="nav-main-collapse collapse in">
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
					</div>
				</div>
			</div>
		</div><?// class=logo-row?>
	</div>
	<div class="line-row visible-xs"></div>
</header>