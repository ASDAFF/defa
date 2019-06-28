<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<div class="mega_fixed_menu">
	<div class="maxwidth-theme">
		<div class="row">
			<div class="col-md-9">
				<div class="logo<?=$logoClass?>">
					<?=CPriority::ShowLogo();?>
				</div>
				<?CPriority::ShowPageType('search_title_component_mega_menu');?>
				<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
					array(
						"COMPONENT_TEMPLATE" => ".default",
						"PATH" => SITE_DIR."include/header/search.title.mega_menu.php",
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "",
						"AREA_FILE_RECURSIVE" => "Y",
						"EDIT_TEMPLATE" => "include_area.php"
					),
					false, array("HIDE_ICONS" => "Y")
				);?>
				<?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
					array(
						"COMPONENT_TEMPLATE" => ".default",
						"PATH" => SITE_DIR."include/header/mega_menu.php",
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "",
						"AREA_FILE_RECURSIVE" => "Y",
						"EDIT_TEMPLATE" => "include_area.php"
					),
					false, array("HIDE_ICONS" => "Y")
				);?>
			</div>
			<div class="col-md-3">
			
			</div>
		</div>
	</div>
</div>