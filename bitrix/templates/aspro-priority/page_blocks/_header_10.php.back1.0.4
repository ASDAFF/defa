<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
global $arTheme, $arTheme, $arRegion;
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

<header class="header-v<?=$headerType?><?=$fixedMenuClass?><?=$basketViewClass?> block-phone sm">
	<div class="logo_and_menu-row white">
		<div class="logo-row">
			<div class="maxwidth-theme clearfix">
				<div class="row">
					<div class="logo-block col-md-5 col-sm-3">
						<?CPriority::ShowBurger();?>
						<div class="logo pull-left<?=$logoClass?>">
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
					<div class="right_wrap col-md-7 pull-right">
						<?if($bPhone || $arRegion):?>
							<div class="phone_wrap pull-left">
								<?if($arRegion):?>
									<div class="wrap_icon inner-table-block">
										<?CPriority::ShowListRegions();?>
									</div>
								<?endif?>
								<?if($bPhone):?>
									<div class="wrap_icon inner-table-block">
										<div class="phone-block">
											<div class="inline-block">
												<?CPriority::ShowHeaderPhones('mask');?>
											</div>
											<div class="inline-block callback_wrap">
												<span class="callback-block animate-load twosmallfont colored" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_callback");?>" data-name="callback"><?=GetMessage("S_CALLBACK")?></span>
											</div>
										</div>
									</div>
								<?endif?>
							</div>
						<?endif?>
						<div class="right-icons pull-right">
							<?if($bOrder):?>
								<div class="pull-right">
									<div class="wrap_icon wrap_basket">
										<?=CPriority::showBasketLink();?>
									</div>
								</div>
							<?endif;?>
							<?if($bCabinet):?>
								<div class="pull-right">
									<div class="wrap_icon wrap_cabinet">
										<?=CPriority::showCabinetLink(true, false, '', true);?>
									</div>
								</div>
							<?endif;?>
							<div class="pull-right show-fixed">
								<div class="wrap_icon">
									<?=CPriority::ShowSearch('', '', GetMessage('SEARCH_TITLE'));?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><?// class=logo-row?>
		<div class="menu-row appendDown bgcolored">
			<div class="maxwidth-theme">
				<div class="row">
					<div class="col-md-12">
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
	</div>
	<div class="line-row visible-xs"></div>
</header>