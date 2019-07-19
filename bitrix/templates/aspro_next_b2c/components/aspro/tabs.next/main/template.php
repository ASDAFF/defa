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
if($arParams["TABS_CODE"] == "HIT"){?>
    <div class="tab_slider_wrapp specials <?=$class_block;?> best_block clearfix" itemscope itemtype="http://schema.org/WebPage">
        <?$arParams['SET_TITLE'] = 'N';$arParamsTmp = urlencode(serialize($arParams));?>
        <span class='request-data' data-value='<?=$arParamsTmp?>'></span>
        <div class="top_blocks">
            <?if($arParams["NAME_BLOCK"]):?>
                <div class="title_wrapper"><div class="title_block sm"><?=$arParams["NAME_BLOCK"];?></div></div>
            <?endif;?>
            <ul class="tabs tabs_hit ajax">
                <?$i=1;
                foreach($arResult["TABS"] as $code => $arTab):?>
                    <li data-code="<?=$code?>" class="<?=($i==1 ? "cur" : "")?>"  data-filter="<?=($arTab["FILTER"] ? urlencode(serialize($arTab["FILTER"])) : '');?>"><span><?=$arTab["TAB_NAME"];?></span></li>
                    <?$i++;?>
                <?endforeach;?>
                <li class="stretch"></li>
            </ul>
        </div>
        <div class="tabs_content">
            <? $arTab = array_shift($arResult["TABS"]);
            if($arTab["FILTER"])
                $GLOBALS[$arParams["FILTER_NAME"]] = $arTab["FILTER"];
            include(str_replace("//", "/", $_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/mainpage/comp_catalog_ajax.php"));
            ?>
        </div>
    </div>
    <?

}else{


	if($arResult["SHOW_SLIDER_PROP"] && !empty($arResult["TABS"])){?>

        <div class="tabs tabs-product-categories">
            <ul class="categories_list">

                <?foreach ($arResult['PODBORKIGROUP'] as $key=> $arPodborka) {?>
                <li class="<?if($key==0){?>cur<?}?> quick-sort" data-group="counters_<?=$key?>"><span><?=$arPodborka['VALUE']?></span></li>
                <? } ?>
            </ul>
        </div>
		<div class="tab_slider_wrapp specials <?=$class_block;?> best_block clearfix" itemscope itemtype="http://schema.org/WebPage">
			<?$arParams['SET_TITLE'] = 'N';$arParamsTmp = urlencode(serialize($arParams));?>
			<span class='request-data' data-value='<?=$arParamsTmp?>'></span>
			<div class="top_blocks">
				<?if($arParams["NAME_BLOCK"]):?>
					<div class="title_wrapper"><div class="title_block sm"><?=$arParams["NAME_BLOCK"];?></div></div>
				<?endif;?>

                <?
                $counter = 0;
                foreach ($arResult['PODBORKIGROUP_FILTER'] as $key=> $item) { ?>
				<ul <?if($counter>0){?>style="display: none"<?}?> class="tabs qwerty counters_<?=$counter?> <?=($arParams["FILTER_NAME"] == "arrFilterPodborki")?"tabs_podborki":"tabs_top"?> ajax">
					<?$i=1;
					foreach($arResult["TABS"] as $code => $arTab):
                        if(in_array($arTab["TITLE"], $item)) {?>
						<li data-key="<?=$key?>" data-code="<?=$code?>" class="<?=($i==1 ? "cur" : "")?>"  data-filter="<?=($arTab["FILTER"] ? urlencode(serialize($arTab["FILTER"])) : '');?>"><span><?=$arTab["TITLE"];?></span></li>
						<?$i++;?>

					<?};endforeach;?>
					<li class="stretch"></li>
				</ul>
                <?$counter++;}?>
			</div>
            <div class="tabs_content">
                <? $arTab = array_shift($arResult["TABS"]);
                if($arTab["FILTER"])
                    $GLOBALS[$arParams["FILTER_NAME"]] = $arTab["FILTER"];

                include(str_replace("//", "/", $_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/mainpage/comp_catalog_ajax.php"));

                ?>
            </div>
			<?/*<ul class="tabs_content">
				<?$j=1;?>
				<?foreach($arResult["TABS"] as $code => $arTab){?>
					<li class="tab <?=$code?>_wrapp <?=($j == 1 ? "cur opacity1" : "");?>" data-code="<?=$code?>" data-col="<?=$col;?>" data-filter="<?=($arTab["FILTER"] ? urlencode(serialize($arTab["FILTER"])) : '');?>">
						<div class="tabs_slider <?=$code?>_slides wr">
							<?if($j++ == 1)
							{
								if($arTab["FILTER"])
									$GLOBALS[$arParams["FILTER_NAME"]] = $arTab["FILTER"];

								include(str_replace("//", "/", $_SERVER["DOCUMENT_ROOT"].SITE_DIR."include/mainpage/comp_catalog_ajax.php"));
							}?>
						</div>
					</li>
				<?}?>
			</ul>*/?>
		</div>
	<?}
}?>