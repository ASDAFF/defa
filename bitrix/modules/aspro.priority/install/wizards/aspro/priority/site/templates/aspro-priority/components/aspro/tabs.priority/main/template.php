<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->setFrameMode(true);

if($arResult["TABS"]):?>
	<div class="item-views catalog sections1 front blocks">
		<div class="maxwidth-theme">
			<div class="tabs_ajax">
				<?if($arParams['PAGER_SHOW_ALL']):?>
					<a class="show_all pull-right" href="<?=str_replace('#SITE'.'_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL'])?>"><span><?=(strlen($arParams['SHOW_ALL_TITLE']) ? $arParams['SHOW_ALL_TITLE'] : GetMessage('S_TO_SHOW_ALL_PRODUCTS'))?></span></a>
				<?endif;?>
			
				<div class="head-block pull-right" <?=(count($arResult["TABS"]) == 1 ? "style='display:none;'" : "");?>>
					<?$i = 0;?>
					<?foreach($arResult["TABS"] as $key => $arItem):?>
						<div class="item-link <?=(!$i ? 'active clicked' : '');?>">
							<div class="font_xs">
								<span class="dark-color"><?=$arItem['TITLE']?></span>
							</div>
						</div>
						<?++$i;?>
					<?endforeach;?>
				</div>
				
				<h2><?=($arParams["TITLE"] ? $arParams["TITLE"] : GetMessage("TITLE"));?></h2>
				<div class="head-block media" <?=(count($arResult["TABS"]) == 1 ? "style='display:none;'" : "");?>>
					<?$i = 0;?>
					<?foreach($arResult["TABS"] as $key => $arItem):?>
						<div class="item-link <?=(!$i ? 'active clicked' : '');?>">
							<div class="font_upper_md">
								<span class="dark-color"><?=$arItem['TITLE']?></span>
							</div>
						</div>
						<?++$i;?>
					<?endforeach;?>
				</div>
				
				<?$arParams['SET_TITLE'] = 'N';$arParamsTmp = urlencode(serialize($arParams));?>
				<span class='request-data' data-value='<?=$arParamsTmp?>'></span>
				<div class="body-block">
					<div class="row">
						<div class="col-md-12">
							<?$i = 0;?>
							<?foreach($arResult["TABS"] as $key => $arItem):?>
								<div class="item-block <?=(!$i ? 'active opacity1' : '');?>" data-filter="<?=($arItem["FILTER"] ? urlencode(serialize($arItem["FILTER"])) : '');?>">
									<?if(!$i)
									{
										if($arItem["FILTER"])
											$GLOBALS[$arParams["FILTER_NAME"]] = $arItem["FILTER"];

										include(str_replace("//", "/", $_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/mainpage/comp_catalog_ajax.php"));
									}?>
								</div>
								<?++$i;?>
							<?endforeach;?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?endif;?>