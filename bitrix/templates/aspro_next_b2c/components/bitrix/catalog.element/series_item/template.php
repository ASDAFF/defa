<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
    <div class="catalog_item_wrapp item">
        <?$this->AddEditAction($arResult['ID'], $arResult['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arResult['ID'], $arResult['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

        $arResult["strMainID"] = $this->GetEditAreaId($arResult['ID']);
        $arResultIDs=CNextB2c::GetItemsIDs($arResult);

        $totalCount = CNextB2c::GetTotalCount($arResult, $arParams);
        $arQuantityData = CNextB2c::GetQuantityArray($totalCount, $arResultIDs["ALL_ITEM_IDS"]);

        $bLinkedItems = (isset($arParams["LINKED_ITEMS"]) && $arParams["LINKED_ITEMS"]);
        if($bLinkedItems)
            $arResult["FRONT_CATALOG"]="Y";
        $elementName = ((isset($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) && $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arResult['NAME']);


        $item_id = $arResult["ID"];
        $strMeasure = '';
        $arAddToBasketData = array();

        $arCurrentSKU = array();

        if(!$arResult["OFFERS"] || $arParams['TYPE_SKU'] !== 'TYPE_1'){
            if($arParams["SHOW_MEASURE"] == "Y" && $arResult["CATALOG_MEASURE"]){
                $arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arResult["CATALOG_MEASURE"]), false, false, array())->GetNext();
                $strMeasure = $arMeasure["SYMBOL_RUS"];
            }
            $arAddToBasketData = CNextB2c::GetAddToBasketArray($arResult, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], ($bLinkedItems ? true : false), $arResultIDs["ALL_ITEM_IDS"], 'small', $arParams);
        }
        elseif($arResult["OFFERS"]){
            $strMeasure = $arResult["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
            if($arParams['TYPE_SKU'] == 'TYPE_1' && $arResult['OFFERS_PROP'])
            {
                $totalCount = CNextB2c::GetTotalCount($arResult["OFFERS"][$arResult["OFFERS_SELECTED"]], $arParams);
                $arQuantityData = CNextB2c::GetQuantityArray($totalCount, $arResultIDs["ALL_ITEM_IDS"]);

                $currentSKUIBlock = $arResult["OFFERS"][$arResult["OFFERS_SELECTED"]]["IBLOCK_ID"];
                $currentSKUID = $arResult["OFFERS"][$arResult["OFFERS_SELECTED"]]["ID"];

                $arResult["DETAIL_PAGE_URL"] = $arResult["OFFERS"][$arResult["OFFERS_SELECTED"]]["DETAIL_PAGE_URL"];
                if($arResult["OFFERS"][$arResult["OFFERS_SELECTED"]]["PREVIEW_PICTURE"])
                    $arResult["PREVIEW_PICTURE"] = $arResult["OFFERS"][$arResult["OFFERS_SELECTED"]]["PREVIEW_PICTURE"];
                if($arResult["OFFERS"][$arResult["OFFERS_SELECTED"]]["PREVIEW_PICTURE"])
                    $arResult["DETAIL_PICTURE"] = $arResult["OFFERS"][$arResult["OFFERS_SELECTED"]]["DETAIL_PICTURE"];

                if($arParams["SET_SKU_TITLE"] == "Y")
                    $arResult["NAME"] = $elementName = $arResult["OFFERS"][$arResult["OFFERS_SELECTED"]]["NAME"];
                $item_id = $currentSKUID;

                // ARTICLE
                if($arResult["OFFERS"][$arResult["OFFERS_SELECTED"]]["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"])
                {
                    $arResult["ARTICLE"]["NAME"] = $arResult["OFFERS"][$arResult["OFFERS_SELECTED"]]["DISPLAY_PROPERTIES"]["ARTICLE"]["NAME"];
                    $arResult["ARTICLE"]["VALUE"] = (is_array($arResult["OFFERS"][$arResult["OFFERS_SELECTED"]]["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"]) ? reset($arResult["OFFERS"][$arResult["OFFERS_SELECTED"]]["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"]) : $arResult["OFFERS"][$arResult["OFFERS_SELECTED"]]["DISPLAY_PROPERTIES"]["ARTICLE"]["VALUE"]);
                }

                $arCurrentSKU = $arResult["JS_OFFERS"][$arResult["OFFERS_SELECTED"]];
                $strMeasure = $arCurrentSKU["MEASURE"];
            }
        }

        ?>
        <div class="catalog_item main_item_wrapper item_wrap" style="height: 420px;">
            <div class="inner_wrap">
                <div class="image_wrapper_block shine">
                    <div class="stickers">
                        <?$prop = ($arParams["STIKERS_PROP"] ? $arParams["STIKERS_PROP"] : "HIT");?>
                        <?foreach(CNextB2c::GetItemStickers($arResult["PROPERTIES"][$prop]) as $arSticker):?>
                            <div><div class="<?=$arSticker['CLASS']?>"><?=$arSticker['VALUE']?></div></div>
                        <?endforeach;?>
                        <?if($arParams["SALE_STIKER"] && $arResult["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"]){?>
                            <div><div class="sticker_sale_text"><?=$arResult["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"];?></div></div>
                        <?}?>
                    </div>
                    <?if($arParams["DISPLAY_WISH_BUTTONS"] != "N" || $arParams["DISPLAY_COMPARE"] == "Y"):?>
                        <div class="like_icons">
                            <?if($arParams["DISPLAY_WISH_BUTTONS"] != "N"):?>
                                <?if(!$arResult["OFFERS"]):?>
                                    <div class="wish_item_button" <?=($arAddToBasketData['CAN_BUY'] ? '' : 'style="display:none"');?>>
                                        <span title="<?=GetMessage('CATALOG_WISH')?>" class="wish_item to" data-item="<?=$arResult["ID"]?>" data-iblock="<?=$arResult["IBLOCK_ID"]?>"><i></i></span>
                                        <span title="<?=GetMessage('CATALOG_WISH_OUT')?>" class="wish_item in added" style="display: none;" data-item="<?=$arResult["ID"]?>" data-iblock="<?=$arResult["IBLOCK_ID"]?>"><i></i></span>
                                    </div>
                                <?elseif($arResult["OFFERS"] && !empty($arResult['OFFERS_PROP'])):?>
                                    <div class="wish_item_button">
                                        <span title="<?=GetMessage('CATALOG_WISH')?>" class="wish_item to <?=$arParams["TYPE_SKU"];?>" data-item="<?=$currentSKUID;?>" data-iblock="<?=$currentSKUIBlock?>" data-offers="Y" data-props="<?=$arOfferProps?>"><i></i></span>
                                        <span title="<?=GetMessage('CATALOG_WISH_OUT')?>" class="wish_item in added <?=$arParams["TYPE_SKU"];?>" style="display: none;" data-item="<?=$currentSKUID;?>" data-iblock="<?=$currentSKUIBlock?>"><i></i></span>
                                    </div>
                                <?endif;?>
                            <?endif;?>
                            <?if($arParams["DISPLAY_COMPARE"] == "Y"):?>
                                <?if(!$arResult["OFFERS"] || ($arParams["TYPE_SKU"] !== 'TYPE_1' || ($arParams["TYPE_SKU"] == 'TYPE_1' && !$arResult["OFFERS_PROP"]))):?>
                                    <div class="compare_item_button">
                                        <span title="<?=GetMessage('CATALOG_COMPARE')?>" class="compare_item to" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arResult["ID"]?>" ><i></i></span>
                                        <span title="<?=GetMessage('CATALOG_COMPARE_OUT')?>" class="compare_item in added" style="display: none;" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arResult["ID"]?>"><i></i></span>
                                    </div>
                                <?elseif($arResult["OFFERS"]):?>
                                    <div class="compare_item_button">
                                        <span title="<?=GetMessage('CATALOG_COMPARE')?>" class="compare_item to <?=$arParams["TYPE_SKU"];?>" data-item="<?=$currentSKUID;?>" data-iblock="<?=$arResult["IBLOCK_ID"]?>" ><i></i></span>
                                        <span title="<?=GetMessage('CATALOG_COMPARE_OUT')?>" class="compare_item in added <?=$arParams["TYPE_SKU"];?>" style="display: none;" data-item="<?=$currentSKUID;?>" data-iblock="<?=$arResult["IBLOCK_ID"]?>"><i></i></span>
                                    </div>
                                <?endif;?>
                            <?endif;?>
                        </div>
                    <?endif;?>
                    <a href="<?=$arResult["DETAIL_PAGE_URL"]?>" class="thumb shine" id="<? echo $arResultIDs["ALL_ITEM_IDS"]['PICT']; ?>">
                        <?
                        $a_alt = ($arResult["PREVIEW_PICTURE"] && strlen($arResult["PREVIEW_PICTURE"]['DESCRIPTION']) ? $arResult["PREVIEW_PICTURE"]['DESCRIPTION'] : ($arResult["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] ? $arResult["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] : $arResult["NAME"] ));
                        $a_title = ($arResult["PREVIEW_PICTURE"] && strlen($arResult["PREVIEW_PICTURE"]['DESCRIPTION']) ? $arResult["PREVIEW_PICTURE"]['DESCRIPTION'] : ($arResult["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] ? $arResult["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] : $arResult["NAME"] ));
                        ?>
                        <?if( !empty($arResult["PREVIEW_PICTURE"]) ):?>
                            <img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
                        <?elseif( !empty($arResult["DETAIL_PICTURE"])):?>
                            <?$img = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], array( "width" => 170, "height" => 170 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
                            <img src="<?=$img["src"]?>" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
                        <?else:?>
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/no_photo_medium.png" alt="<?=$a_alt;?>" title="<?=$a_title;?>" />
                        <?endif;?>
                        <?if($fast_view_text_tmp = CNextB2c::GetFrontParametrValue('EXPRESSION_FOR_FAST_VIEW'))
                            $fast_view_text = $fast_view_text_tmp;
                        else
                            $fast_view_text = GetMessage('FAST_VIEW');?>
                    </a>
                    <div class="fast_view_block" data-event="jqm" data-param-form_id="fast_view" data-param-iblock_id="<?=$arParams["IBLOCK_ID"];?>" data-param-id="<?=$arResult["ID"];?>" data-param-item_href="<?=urlencode($arResult["DETAIL_PAGE_URL"]);?>" data-name="fast_view"><?=$fast_view_text;?></div>
                </div>
                <div class="item_info <?=$arParams["TYPE_SKU"]?>" style="height: 128px;">
                    <div class="item-title" style="height: 40px;">
                        <a href="<?=$arResult["DETAIL_PAGE_URL"]?>" class="dark_link"><span><?=$elementName;?></span></a>
                    </div>

                    <div class="rating">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:iblock.vote",
                            "element_rating_front",
                            Array(
                                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                "IBLOCK_ID" => $arResult["IBLOCK_ID"],
                                "ELEMENT_ID" =>$arResult["ID"],
                                "MAX_VOTE" => 5,
                                "VOTE_NAMES" => array(),
                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "CACHE_TIME" => $arParams["CACHE_TIME"],
                                "DISPLAY_AS_RATING" => 'vote_avg'
                            ),
                            $component, array("HIDE_ICONS" =>"Y")
                        );?>
                    </div>

                    <div class="sa_block">
                        <?=$arQuantityData["HTML"];?>
                        <div class="article_block" <?if(isset($arResult['ARTICLE']) && $arResult['ARTICLE']['VALUE']):?>data-name="<?=$arResult['ARTICLE']['NAME'];?>" data-value="<?=$arResult['ARTICLE']['VALUE'];?>"<?endif;?>>
                            <?if(isset($arResult['ARTICLE']) && $arResult['ARTICLE']['VALUE']){?>
                                <div ><?=$arResult['ARTICLE']['NAME'];?>: <?=$arResult['ARTICLE']['VALUE'];?></div>
                            <?}?>
                        </div>
                    </div>
                    <div class="cost prices clearfix">
                        <div class="price">
                            от <span class="values_wrapper">
                                <?=number_format($arResult['PROPERTIES']['MINIMUM_PRICE']['VALUE'], 0, '.', ' ')?> руб.</span>
                        </div>
                        <div class="price discount">
                            <span class="values_wrapper">
                                <?=number_format($arResult['PROPERTIES']['MAXIMUM_PRICE']['VALUE'], 0, '.', ' ')?> руб.
                            </span>
                        </div>


                    </div>
                </div>
                <div class="footer_button <?=($arResult["OFFERS"] && $arResult['OFFERS_PROP'] ? 'has_offer_prop' : '');?> inner_content js_offers__<?=$arResult['ID'];?>">
                    <div class="counter_wrapp">
                        <a class="button btn btn-default" href="<?=$arResult["DETAIL_PAGE_URL"]?>" >Подробнее</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

