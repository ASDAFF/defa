<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
$bOrderView = ($arTheme['ORDER_VIEW']['VALUE'] == 'Y' ? true : false);
$bCabinet = ($arTheme["CABINET"]["VALUE"]=='Y' ? true : false);
?>

<div class="mega_fixed_menu">
	<div class="maxwidth-theme">
		<svg class="svg svg-close" width="14" height="14" viewBox="0 0 14 14">
		  <path data-name="Rounded Rectangle 568 copy 16" d="M1009.4,953l5.32,5.315a0.987,0.987,0,0,1,0,1.4,1,1,0,0,1-1.41,0L1008,954.4l-5.32,5.315a0.991,0.991,0,0,1-1.4-1.4L1006.6,953l-5.32-5.315a0.991,0.991,0,0,1,1.4-1.4l5.32,5.315,5.31-5.315a1,1,0,0,1,1.41,0,0.987,0.987,0,0,1,0,1.4Z" transform="translate(-1001 -946)"></path>
		</svg>
		<i class="svg svg-close mask arrow"></i>
		<div class="logo<?=$logoClass?>">
			<?=CPriority::ShowLogo();?>
		</div>
		<div class="row">
			<div class="col-md-9">
				<div class="left_block">
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
			</div>
			<div class="col-md-3">
				<div class="right_block">
					<div class="top_block<?=(!$bOrderView && !$bCabinet ? ' one_item' : '');?>">
						<div class="button"><span class="btn btn-default btn-lg animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question");?>" data-name="question"><?=GetMessage('QUESTION_BUTTON');?></span></div>
						<?if($bCabinet):?>
							<div class="wrap_icon wrap_cabinet font_upper_md<?=(!$bOrderView ? ' wtorder' : '')?>">
								<?=CPriority::showCabinetLink(true, false, '', true);?>
							</div>
						<?endif;?>
						<div class="wrap_icon wrap_basket font_upper_md">
							<?=CPriority::showBasketLink('', '', GetMessage('BASKET'), '', true);?>
						</div>
					</div>
					<div class="contact_wrap">
						<div class="info">
							<?global $arRegion;?>
							<?if($arRegion):?>
								<?CPriority::ShowListRegions();?>
							<?endif;?>
							<div class="phone blocks">
								<div class="">
									<?CPriority::ShowHeaderPhones('white sm', true);?>
								</div>
								<div class="callback_wrap">
									<span class="callback-block animate-load font_upper colored" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_callback");?>" data-name="callback"><?=GetMessage("S_CALLBACK")?></span>
								</div>
							</div>
							<?=CPriority::showEmail('email blocks')?>
							<?=CPriority::showAddress('address blocks')?>
						</div>
					</div>
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
	</div>
</div>