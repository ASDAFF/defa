<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->setFrameMode(true);
	
	$class_block="s_".$this->randString();
	$arTab=array();
	$col=4;
	if($arParams["LINE_ELEMENT_COUNT"]>=3 && $arParams["LINE_ELEMENT_COUNT"]<4)
		$col=3;
	if($arResult["SHOW_SLIDER_PROP"]){?>
		<div class="tab_slider_wrapp specials <?=$class_block;?> best_block clearfix" itemscope itemtype="http://schema.org/WebPage">
			<?$arParams['SET_TITLE'] = 'N';$arParamsTmp = urlencode(serialize($arParams));?>
			<span class='request-data' data-value='<?=$arParamsTmp?>'></span>
			<!--<div class="top_blocks">
				<?/*if($arParams["NAME_BLOCK"]):*/?>
					<div class="title_wrapper"><div class="title_block sm"><?/*=$arParams["NAME_BLOCK"];*/?></div></div>
				<?/*endif;*/?>
				<ul class="tabs ajax">
					<?/*$i=1;
					foreach($arResult["TABS"] as $code => $arTab):*/?>
						<li data-code="<?/*=$code*/?>" <?/*=($i==1 ? "class='cur'" : "")*/?> data-filter="<?/*=($arTab["FILTER"] ? urlencode(serialize($arTab["FILTER"])) : '');*/?>"><span><?/*=$arTab["TITLE"];*/?></span></li>
						<?/*$i++;*/?>
					<?/*endforeach;*/?>
					<li class="stretch"></li>
				</ul>
			</div>-->
            <!--<div class="tabs_content">
                <?/* $arTab = array_shift($arResult["TABS"]);
                if($arTab["FILTER"])
                    $GLOBALS[$arParams["FILTER_NAME"]] = $arTab["FILTER"];

                include(str_replace("//", "/", $_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/mainpage/comp_catalog_ajax.php"));
                */?>
            </div>-->
			<div class="tabs_content">
				<?$j=1;?>
                <?
                \Bitrix\Main\Diag\Debug::dump($arResult["TABS"]);?>
				<?foreach($arResult["TABS"] as $code => $arTab){?>
                    <div class="tabs_title"><span><?=$arTab["TITLE"];?></span></div>
					<li class="tab <?=$code?>_wrapp <?=($j == 1 ? "cur opacity1" : "");?>" data-code="<?=$code?>" data-col="<?=$col;?>" data-filter="<?=($arTab["FILTER"] ? urlencode(serialize($arTab["FILTER"])) : '');?>">
						<div class="tabs_slider <?=$code?>_slides wr">
                            <?if($arTab["FILTER"])
                                $GLOBALS[$arParams["FILTER_NAME"]] = $arTab["FILTER"];

                            $APPLICATION->IncludeComponent(
                                "bitrix:catalog.section",
                                "catalog_block_front",
                                $arParams,
                                false, array("HIDE_ICONS"=>"Y")
                            );
                            ?>
						</div>
					</li>
				<?}?>
			</div>
		</div>
	<?}?>



