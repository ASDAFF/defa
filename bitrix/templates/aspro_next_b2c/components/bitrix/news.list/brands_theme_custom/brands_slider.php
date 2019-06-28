<?
global $arTheme;
$slideshowSpeed = abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE']));
$animationSpeed = abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE']));
$bAnimation = (bool)$slideshowSpeed;
?>


<?
$dbResSect = CIBlockSection::GetList (
        array("SORT"=>"ASC"),
        array("IBLOCK_ID"=>"12")
);



while($sectRes = $dbResSect->GetNext())
{
    $arSections[] = $sectRes;
}

foreach($arSections as $arSection){
    foreach($arResult["ITEMS"] as $key=>$arItem){

        if($arItem['IBLOCK_SECTION_ID'] == $arSection['ID']){
            $arSection['ELEMENTS'][] =  $arItem;
        }
    }

    $arElementGroups[] = $arSection;

}

$arResult["ITEMS"] = $arElementGroups;


?>


<div class="brands_wrapp" <!--data-plugin-options='{"animation": "slide", "directionNav": true, "itemMargin":30, "controlNav" :false, "animationLoop": true, <?/*=($bAnimation ? '"slideshow": true,' : '"slideshow": false,')*/?> <?/*=($slideshowSpeed >= 0 ? '"slideshowSpeed": '.$slideshowSpeed.',' : '')*/?> <?/*=($animationSpeed >= 0 ? '"animationSpeed": '.$animationSpeed.',' : '')*/?> "counts": [7,6,5,4,3,2,1]}-->'>
<?if($arParams["TITLE_BLOCK"] || $arParams["TITLE_BLOCK_ALL"]):?>
    <div class="top_block">
        <h3 class="title_block"><?=$arParams["TITLE_BLOCK"];?></h3>
    </div>
<?endif;?>

    <div class="brands_block">

        <?foreach($arResult["ITEMS"] as $arSecElItem):?>
            <? $widthItem = 100/count($arSecElItem['ELEMENTS']);?>

        <div class="brands-row">

            <? foreach($arSecElItem['ELEMENTS'] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <?if( is_array($arItem["PREVIEW_PICTURE"]) ){?>
                    <div class="brand-item visible" id="<?=$this->GetEditAreaId($arItem['ID']);?>" style="width: <?= floor($widthItem)?>%;">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <img class="noborder" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
                        </a>
                    </div>
                <?}?>
            <?endforeach;?>
        </div>

        <?endforeach;?>
    </div>

    <div class="brands-mobile-block">
        <?foreach($arResult["ITEMS"] as $arSecElItem):?>
            <? foreach($arSecElItem['ELEMENTS'] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <?if( is_array($arItem["PREVIEW_PICTURE"]) ){?>
                    <div class="brand-item visible" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <img class="noborder" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
                        </a>
                    </div>
                <?}?>
            <?endforeach;?>
        <?endforeach;?>
    </div>


</div>
