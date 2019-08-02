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
                foreach($arResult["TABS"] as $code => $arTab):if(!$arTab["FILTER"])continue;?>
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


	if($arResult["SHOW_SLIDER_PROP"] && !empty($arResult["TABS"])){

        foreach ($arResult['SPISOK'] as $key=> $item) { ?>
                <?$i=1;
                foreach($arResult["TABS"] as $code => $arTab):
                    if(in_array($arTab["TITLE"], $item['TABS'])) {
                        $flag[$arTab["TITLE"]] = true;
                        ?>
                    <?}else{$flag[$arTab["TITLE"]] = false;};endforeach;?>
            <?}?>
        <script>
            $(document).ready(function () {
                $('.categories_list').children().first().click();
                var clicker = $('.categories_list').children().first().attr('data-group');

                $('.'+clicker).children().first().click();
            })
            $(document).on('click','.quick-sort',function () {
                var clicker = $(this).attr('data-group');
                $('.'+clicker).children().first().click();
            })
        </script>
        <div class="tabs tabs-product-categories">
            <ul class="categories_list">

                <?foreach ($arResult['SPISOK'] as $key=> $arPodborka) {
                    $flafer = false;
                    foreach ($arPodborka['TABS'] as $arTab ) {
                        if($flag[$arTab] == true){
                            $flafer = true;
                        }
                    }
                    if(!$arPodborka['PODBORKI'])continue;
                    ?>
                <li class="<?if($key==1){?>cur<?}?> quick-sort" data-group="counters_<?=$key?>"><span><?=$arPodborka['TAB_NAME']?></span></li>
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
                foreach ($arResult['SPISOK'] as $key=> $item) { ?>
				<ul <?if($counter>0){?>style="display: none"<?}?> class="tabs qwerty counters_<?=$key?> <?=($arParams["FILTER_NAME"] == "arrFilterPodborki")?"tabs_podborki":"tabs_top"?> ajax">
					<?$i=1;
					foreach($arResult["TABS"] as $code => $arTab):
                        if(in_array($arTab["TITLE"], $item['TABS'])) {
                            $flag[$code] = true;
                            ?>
						<li data-key="<?=$key?>" data-code="<?=$code?>" class="<?=($i==1 ? "cur" : "")?>"  data-filter="<?=($arTab["FILTER"] ? urlencode(serialize($arTab["FILTER"])) : '');?>"><span><?=$arTab["TITLE"];?></span></li>
						<?$i++;?>

					<?}else{$flag[$code] = false;};endforeach;?>
					<li class="stretch"></li>
				</ul>
                <?$counter++;}?>
			</div>
            <div class="tabs_content">

                <? $arTab = array_shift($arResult["TABS"]);
                if($arTab["FILTER"] && $flag[$arTab['CODE']] == true)
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