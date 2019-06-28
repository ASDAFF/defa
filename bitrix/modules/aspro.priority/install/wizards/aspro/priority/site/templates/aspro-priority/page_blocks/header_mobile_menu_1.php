<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<div class="mobilemenu-v1 scroller menu_open_v_<?=$arTheme['HEADER_MOBILE_MENU_OPEN']['VALUE'];?>">
	<div class="wrap">
		<div class="wrapper_rel">
			<?if($arTheme['HEADER_MOBILE_MENU_OPEN']['VALUE'] == 1):?>
				<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/close.svg');?>

				<div class="logo<?=$logoClass?>">
					<?=CPriority::ShowLogo();?>
				</div>
			<?endif;?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"top_mobile",
				Array(
					"COMPONENT_TEMPLATE" => "top_mobile",
					"MENU_CACHE_TIME" => "3600000",
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_USE_GROUPS" => "N",
					"MENU_CACHE_GET_VARS" => array(
					),
					"DELAY" => "N",
					"MAX_LEVEL" => "4",
					"ALLOW_MULTI_SELECT" => "Y",
					"ROOT_MENU_TYPE" => "top",
					"CHILD_MENU_TYPE" => "left",
					"USE_EXT" => "Y"
				)
			);?>
			<div class="actions">
				<?
				// show cabinet item
				CPriority::ShowMobileMenuCabinet();

				// show basket item
				CPriority::ShowMobileMenuBasket();
				?>
			</div>
			<?
			// use module options for change contacts
			CPriority::ShowMobileMenuContacts();
			?>
			<div class="social-block">
				<?$APPLICATION->IncludeComponent(
					"aspro:social.info.priority",
					".default",
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
	</div>
</div>