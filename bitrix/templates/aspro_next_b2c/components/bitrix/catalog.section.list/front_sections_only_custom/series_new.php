<?
if($arResult['SECTIONS'])
{
    ?>
    <style>
        .quick-metki{
            position: absolute;
            z-index: 9999999;
            padding: 10px;
            width: 100%!important;
        }
        .quick-metki li{
            width: 100%!important;
            margin-bottom: 10px!important;
        }
        .quick-metki .series-item-pros-element span{
            display: none!important;
            width: auto!important;
            padding: 10px!important;
        }
        .quick-metki li:hover span{
            background-color: white!important;
            color: black!important;
            display: block!important;

        }
    </style>
	
    <div class="sections_wrapper series">
        <?if($arParams["TITLE_BLOCK"] || $arParams["TITLE_BLOCK_ALL"]):?>
            <div class="top_block">
                <h3 class="title_block"><?=$arParams["TITLE_BLOCK"];?></h3>
                <a href="<?=SITE_DIR.$arParams["ALL_URL"];?>"><?=$arParams["TITLE_BLOCK_ALL"] ;?></a>
            </div>
        <?endif;?>
        <div class="list items">


            <div class="filters-for-series series-sort">
                            <div class="row">
                                <div class="col-lg-12 select">
                                    <div class="sort-list-wrapper">
                                        <?

                                            $arTQurrentSectionID = $arParams['SECTION_ID'];

                                            $arPodborki = $arParams['UF_PODBORKA'];
                                            if(empty($arPodborki))  $arPodborki = [];
                                            $filter = array(
                                                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                                                'SECTION_ID' => $arTQurrentSectionID,
                                                'ACTIVE_DATE'=>'Y', 'ACTIVE'=>'Y'
                                            );
                                            $sect = CIBlockSection::GetList(array('sort' => 'asc'), $filter, false,
                                                array('UF_PODBORKA'));
                                            while ($section = $sect->GetNext()) {
                                            	if(!empty($section['UF_PODBORKA']) && is_array($section['UF_PODBORKA'])){
                                                    $arPodborki = array_merge($arPodborki,$section['UF_PODBORKA']);
	                                            }
                                            }
                                            $arPodborki  = array_unique($arPodborki);
                                            if(!empty($arPodborki)){
                                                $rsEnum = CUserFieldEnum::GetList(array(),
                                                    array("USER_FIELD_NAME" => "UF_PODBORKA", 'ID' => $arPodborki));
                                                while ($arEnum = $rsEnum->GetNext()) {
                                                    $UF_PODBORKA[] = $arEnum;
                                                }
                                            }


                                        ?>
                                        <ul class="sort-list">
                                            <li class="sort-item"><a href="<?=$APPLICATION->GetCurPage()?>" class="sort-link <?if(empty($_GET['filter'])) { ?>active all<? } ?>">Все серии</a></li>
                                            <?foreach ($UF_PODBORKA as $arPodborka) { ?>
                                            <li class="sort-item"><a href="?filter=<?=$arPodborka['ID']?>" class="sort-link <?if( $_GET['filter'] == $arPodborka['ID']){?>active all<?}?>"><?=$arPodborka['VALUE']?></a></li>
                                            <? } ?>
                                        </ul>
                                    </div>
                                    <div class="view-list">
                                        <a href="" rel="nofollow" data-id="series_content_web" class="view-item web"><span>Сеткой</span></a>
                                        <a href="" rel="nofollow" data-id="series_content_list" class="view-item active list"><span>Списком</span></a>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 select">
                                    <div class="sort-list-wrapper">
                                        <form action="" method="post" class="select-wrap">
                                            <div class="sort-select-wrap">
                                                <p class="sort-evt">Сортировать:</p>
                                                <select name="" id="">
                                                    <option value="">По цене</option>
                                                    <option value=""></option>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="sort-select-wrap">
                                                <p class="sort-evt">Акции:</p>
                                                <select name="" id="">
                                                    <option value="">Жаркие скидки</option>
                                                    <option value=""></option>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                            <div class="sort-select-wrap">
                                                <p class="sort-evt">Наличие:</p>
                                                <select name="" id="">
                                                    <option value="">В наличии / На заказ</option>
                                                    <option value=""></option>
                                                    <option value=""></option>
                                                </select>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?if( !empty($_GET['filter'])) { ?>
            <div class="row margin0 flexbox series_content series_content_list active">
                <?
                foreach($arResult['SECTIONS'] as $arSection)
                {

                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
                    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_SECTION_DELETE_CONFIRM')));?>
                    <?if(in_array($_GET['filter'], $arSection['UF_PODBORKA'])) { ?>
                    <div class="series-item" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                        <div class="series-top">
                            <div class="row series-header">
                                    <div class="col-md-12 name-wrapper">
                                        <div class="name">
                                            <a href="<?=$arSection['SECTION_PAGE_URL'];?>" class="dark_link">Серия <?=$arSection['NAME'];?> <span class="dark_link-opacity">|</span> <?=$arSection["UF_NAME_RUS"]?></a>
                                        </div>
                                        <div class="name-right">
                                            <?if(($arParams["DISPLAY_WISH_BUTTONS"] != "N" || $arParams["DISPLAY_COMPARE"] == "Y") || (strlen($arResult["DISPLAY_PROPERTIES"]["CML2_ARTICLE"]["VALUE"]) || ($arResult['SHOW_OFFERS_PROPS'] && $showCustomOffer))):?>
                                                <div class="like_wrapper">
                                                    <?if($arParams["DISPLAY_WISH_BUTTONS"] != "N" || $arParams["DISPLAY_COMPARE"] == "Y"):?>
                                                        <div class="like_icons iblock">
                                                            <?if($arParams["DISPLAY_WISH_BUTTONS"] != "N"):?>
                                                                <?if(!$arResult["OFFERS"]):?>
                                                                    <div class="wish_item text" <?=($arAddToBasketData['CAN_BUY'] ? '' : 'style="display:none"');?> data-item="<?=$arResult["ID"]?>" data-iblock="<?=$arResult["IBLOCK_ID"]?>">
                                                                        <span class="value" title="<?=GetMessage('CT_BCE_CATALOG_IZB')?>" ><i></i></span>
                                                                        <span class="value added" title="<?=GetMessage('CT_BCE_CATALOG_IZB_ADDED')?>"><i></i></span>
                                                                    </div>
                                                                <?elseif($arResult["OFFERS"] && $arParams["TYPE_SKU"] === 'TYPE_1' && !empty($arResult['OFFERS_PROP'])):?>
                                                                    <div class="wish_item text " <?=($arAddToBasketData['CAN_BUY'] ? '' : 'style="display:none"');?> data-item="" data-iblock="<?=$arResult["IBLOCK_ID"]?>" <?=(!empty($arResult['OFFERS_PROP']) ? 'data-offers="Y"' : '');?> data-props="<?=$arOfferProps?>">
                                                                        <span class="value <?=$arParams["TYPE_SKU"];?>" title="<?=GetMessage('CT_BCE_CATALOG_IZB')?>"><i></i></span>
                                                                        <span class="value added <?=$arParams["TYPE_SKU"];?>" title="<?=GetMessage('CT_BCE_CATALOG_IZB_ADDED')?>"><i></i></span>
                                                                    </div>
                                                                <?endif;?>
                                                            <?endif;?>
                                                            <?if($arParams["DISPLAY_COMPARE"] == "Y"):?>
                                                                <?if(!$arResult["OFFERS"] || ($arResult["OFFERS"] && $arParams["TYPE_SKU"] === 'TYPE_1' && !$arResult["OFFERS_PROP"])):?>
                                                                    <div data-item="<?=$arResult["ID"]?>" data-iblock="<?=$arResult["IBLOCK_ID"]?>" data-href="<?=$arResult["COMPARE_URL"]?>" class="compare_item text <?=($arResult["OFFERS"] ? $arParams["TYPE_SKU"] : "");?>" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['COMPARE_LINK']; ?>">
                                                                        <span class="value" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE')?>"><i></i></span>
                                                                        <span class="value added" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE_ADDED')?>"><i></i></span>
                                                                    </div>
                                                                <?elseif($arResult["OFFERS"] && $arParams["TYPE_SKU"] === 'TYPE_1'):?>
                                                                    <div data-item="<?=$arResult["ID"]?>" data-iblock="<?=$arResult["IBLOCK_ID"]?>" data-href="<?=$arResult["COMPARE_URL"]?>" class="compare_item text <?=$arParams["TYPE_SKU"];?>">
                                                                        <span class="value" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE')?>"><i></i></span>
                                                                        <span class="value added" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE_ADDED')?>"><i></i></span>
                                                                    </div>
                                                                <?endif;?>
                                                            <?endif;?>
                                                        </div>
                                                    <?endif;?>
                                                </div>
                                            <?endif;?>
                                            <div class="line_block share top">
                                                <?$APPLICATION->IncludeFile(SITE_DIR."include/share_buttons.php", Array(), Array("MODE" => "html", "UF_NAME_RUS" => GetMessage('CT_BCE_CATALOG_SOC_BUTTON')));?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="row">
                                <div class="series-tabs">
                                    <a href="#" class="series-content-toggle current" data-tab="1">Описание серии</a>
                                    <a href="#" class="series-content-toggle" data-tab="2">Комплекты</a>
                                    <a href="#" class="series-content-toggle" data-tab="3">Пректы</a>
                                </div>
                                <div class="row series-main current series-desc-block"  data-tab="1">
                                        <div class="img col-lg-4 col-sm-12">

                                            <ul class="series-item-pros quick-metki">

                                                <? foreach($arSection['UF_METKA'] as $arMetka) { ?>
                                                    <li class="series-item-pros-element">
                                                        <div class="pros-icon">
                                                            <img src="<?=$arResult['METKI'][$arMetka['ID']]['SRC']?>" alt="">
                                                        </div>
                                                        <span class="pros-text"><?=$arResult['METKI'][$arMetka['ID']]['NAME']?></span>
                                                    </li>
                                                    <? } ?>
                                            </ul>

                                            <div class="series-slider-wrapper">
                                                <div class="slick-slider put-arrows main-slide slider-for slider-single">
                                                    <span class="sale-mark"><?=($section['UF_DISCOUNT']);?></span>
                                                    <?foreach($arResult['SERIES_GALLERIES'][$arSection['UF_SERIES_GALLERY']] as $image)
                                                    {

                                                        if($arSection['UF_DISCOUNT']){
                                                        $arWaterMark = array(
                                                            array(
                                                                'name' => 'watermark',
                                                                'type' =>'text',
                                                                'font' =>$_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/font/openSans.ttf',
                                                                'text' => "Скидка на серию  ".$arSection['UF_DISCOUNT'],
                                                                "position" => "topright",
                                                                "color" => "ffffff",
                                                            )

                                                        );
                                                        $arFileTmp = CFile::ResizeImageGet(
                                                            $image,
                                                            array("width" => 418, "height" => 300),
                                                            BX_RESIZE_IMAGE_EXACT,
                                                            true,
                                                            $arWaterMark
                                                        );

                                                    }else{
                                                        $arFileTmp = CFile::ResizeImageGet(
                                                            $image,
                                                            array("width" => 417, "height" => 300),
                                                            BX_RESIZE_IMAGE_EXACT,
                                                            true
                                                        );
                                                    }
                                                        ?>
                                                        <!--                                        <div class="shine">-->
                                                        <a class="series-main-fancy thumb" rel="group" data-fancybox="gallery" href="<?=CFile::GetPath($image);?>">
                                                            <!--                                            <a href="--><?//=$arSection["SECTION_PAGE_URL"]?><!--" class="thumb">-->
                                                            <img class="series-item__main-photo" src="<?=$arFileTmp['src']?>" alt="" />
                                                        </a>
                                                        <!--                                        </div>-->
                                                        <?
                                                    }
                                                    ?>
                                                </div>
                                                <?
                                                if(!empty($arResult['SERIES_GALLERIES'][$arSection['UF_SERIES_GALLERY']]))
                                                {

                                                    ?>
                                                    <div class="series-item__thumbs slick-nav preview-slide slider-nav">
                                                        <?foreach($arResult['SERIES_GALLERIES'][$arSection['UF_SERIES_GALLERY']] as $image)
                                                        {
                                                            ?>
                                                            <div class="series-item__thumb">
                                                                <img class="series-item__thumb-img" src="<?=CFile::GetPath($image);?>" alt="" />
                                                            </div>
                                                            <?
                                                        }
                                                        ?>
                                                    </div>
                                                    <?
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-sm-12">
                                            <div class="series-item-info">
                                                <div class="row">
                                                    <div class="col-md-7 col-lg-7 col-sm-6">
                                                        <div class="series-item-info-top">
                                                            <p class="series-item-info"><?=$arSection["UF_PREVIEW"]?></p>
                                                        </div>
                                                        <!--                                        <div class="series-item-description">-->
<!--                                                        --><?//=textCut($arSection['~DESCRIPTION'],200)?>
                                                        <!--                                            -->
                                                        <!--                                        </div>-->
                                                        <?
                                                        if(!empty($arSection['UF_TIZERS']) && !empty($arResult['TIZERS']))
                                                        {
                                                            ?>
                                                            <ul class="series-item-pros">
                                                                <?
                                                                foreach($arSection['UF_TIZERS'] as $tizerId)
                                                                {
                                                                    ?>
                                                                    <li class="series-item-pros-element">
                                                                        <div class="pros-icon">
                                                                            <img src="<?=$arResult['TIZERS'][$tizerId]['SRC']?>" alt="">
                                                                        </div>
                                                                        <span class="pros-text"><?=$arResult['TIZERS'][$tizerId]['NAME']?></span>
                                                                    </li>
                                                                    <?
                                                                }
                                                                ?>
                                                            </ul>
                                                            <?
                                                        }
                                                        ?>
                                                        <div class="series-item-color">
                                                            <div class="row">
                                                                <?
                                                                if(!empty($arResult['COLORS'][$arSection['ID']]['COLORS']))
                                                                {
                                                                    ?>
                                                                    <div class="col-sm-6 series-item-color-solutions">
                                                                        <h3>Цветовые решения</h3>
                                                                        <div class="series-item-color-content">
                                                                            <?
                                                                            foreach($arResult['COLORS'][$arSection['ID']]['COLORS'] as $color)
                                                                            {
                                                                                ?>
                                                                                <div class="series-item-color-wrapper">
                                                                                    <div class="series-item-color-pic" data-title="<?=$color['UF_NAME']?>" style="background: url(<?=$color['FILE_SRC']?>)">
                                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="<?=$color['UF_XML_ID']?>"></a>
                                                                                    </div>
                                                                                </div>
                                                                                <?
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <?
                                                                }
                                                                if(!empty($arResult['COLORS'][$arSection['ID']]['COLORS_ADD']))
                                                                {
                                                                    ?>
                                                                    <div class="col-sm-6 series-item-color-solutions">
                                                                        <h3>Дополнительные цвета</h3>
                                                                        <div class="series-item-color-content">
                                                                            <?
                                                                            foreach($arResult['COLORS'][$arSection['ID']]['COLORS_ADD'] as $color)
                                                                            {
                                                                                ?>
                                                                                <div class="series-item-color-wrapper">
                                                                                    <div class="series-item-color-pic" data-title="<?=$color['UF_NAME']?>" style="background: url(<?=$color['FILE_SRC']?>)">
                                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="<?=$color['UF_XML_ID']?>"></a>
                                                                                    </div>
                                                                                </div>
                                                                                <?
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <?
                                                                }
                                                                ?>
                                                            </div>
                                                            <a href="#" class="more-color">Все цвета <i class="fa fa-angle-down"></i></a>
                                                            <div class="another-color">
                                                                <p><span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_11" data-name="SIMPLE_FORM_11" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Нужна серия в другом цвете?</span></p>
                                                            </div>

                                                            <div class="series-item-color series-item-color__modal">
                                                                <div class="row colors">
                                                                    <?
                                                                    if(!empty($arResult['COLORS'][$arSection['ID']]['COLORS']))
                                                                    {
                                                                        ?>
                                                                        <div class="col-sm-12 series-item-color-solutions">
                                                                            <h3>Цветовые решения</h3>
                                                                            <div class="series-item-color-content">
                                                                                <?
                                                                                foreach($arResult['COLORS'][$arSection['ID']]['COLORS'] as $color)
                                                                                {
                                                                                    ?>
                                                                                    <div class="series-item-color-wrapper">
                                                                                        <div class="series-item-color-pic" data-title="<?=$color['UF_NAME']?>" style="background: url(<?=$color['FILE_SRC']?>)">
                                                                                            <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="<?=$color['UF_XML_ID']?>"></a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                        <?
                                                                    }
                                                                    if(!empty($arResult['COLORS'][$arSection['ID']]['COLORS_ADD']))
                                                                    {
                                                                        ?>
                                                                        <div class="col-sm-12 series-item-color-solutions">
                                                                            <h3>Дополнительные цвета</h3>
                                                                            <div class="series-item-color-content">
                                                                                <?
                                                                                foreach($arResult['COLORS'][$arSection['ID']]['COLORS_ADD'] as $color)
                                                                                {
                                                                                    ?>
                                                                                    <div class="series-item-color-wrapper">
                                                                                        <div class="series-item-color-pic" data-title="<?=$color['UF_NAME']?>" style="background: url(<?=$color['FILE_SRC']?>)">
                                                                                            <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="<?=$color['UF_XML_ID']?>"></a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                        <?
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="another-color">
                                                                    <p>Нужна серия в другом цвете?</p>
                                                                    <a class="btn"><span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_11" data-name="SIMPLE_FORM_11" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Оставить заявку</span></a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-5 col-lg-5 col-sm-6 extra-inform">
                                                        <?
                                                        if(!empty($arResult['POPULAR_KITS'][$arSection['ID']]))
                                                        {
                                                            ?>
                                                            <div class="series-item-info-bottom">
                                                                <h3>Комплекты</h3>
																<div class="popular-content-missing-kit <?=(count($arResult['POPULAR_KITS'][$arSection['ID']]['PRODUCTS']) > 0)?"hidden":""?>">К сожалению, комплекты выбранного цвета отсутствует.</div>
                                                                <div class="popular-content popular-content-sets">
                                                                    <?
                                                                    foreach($arResult['POPULAR_KITS'][$arSection['ID']]['PRODUCTS'] as $product)
                                                                    {
                                                                        $i=0;
                                                                        $priceText=($product['OFFERS_COUNT']>1?'от ':'').CurrencyFormat($product['OFFERS_MIN_PRICE'],Bitrix\Currency\CurrencyManager::getBaseCurrency());
                                                                        foreach($product['OFFERS'] as $offer)
                                                                        {
                                                                            ?>
                                                                            <a class="series-item-kit<?if($i++>0):?> hidden<?endif?>" href="<?=$offer['URL']?>" data-color-xml-id="<?=$offer['COLOR_REF_VALUE']?>" <?if($offer['TEXTURE_KARKASA_VALUE']){?>data-karkas-xml-id="<?=$offer['TEXTURE_KARKASA_VALUE']?>"<?}?> <?if($offer['TEKSTURA_DVEREJ_VALUE']){?>data-dveri-xml-id="<?=$offer['TEKSTURA_DVEREJ_VALUE']?>"<?}?>>
                                                                                <img src="<?=$offer['IMAGE']?>" alt="">
                                                                                <span class="series-item-info-price">
                                                                <?=$priceText?>
                                                            </span>
                                                                            </a>
                                                                            <?
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <?
                                                        }
                                                        ?>
                                                        <?
                                                        if(!empty($arResult['POPULAR_PRODUCTS'][$arSection['ID']]))
                                                        {
                                                            ?>
                                                            <div class="series-item-info-bottom">
                                                                <h3>Товары</h3>
																<div class="popular-content-missing-product <?=(count($arResult['POPULAR_PRODUCTS'][$arSection['ID']]['PRODUCTS']) > 0)?"hidden":""?>">К сожалению, товары выбранного цвета отсутствует.</div>
                                                                <div class="popular-content popular-content-items">
                                                                    <?
                                                                    foreach($arResult['POPULAR_PRODUCTS'][$arSection['ID']]['PRODUCTS'] as $product)
                                                                    {
																		$i = 0;
																		$priceText=($product['OFFERS_COUNT']>1?'от ':'').CurrencyFormat($product['OFFERS_MIN_PRICE'],Bitrix\Currency\CurrencyManager::getBaseCurrency());
                                                                        foreach($product['OFFERS'] as $offer)
                                                                        {
                                                                            ?>
                                                                            <a class="series-item-product<?if($i++>0):?> hidden<?endif?>" href="<?=$offer['URL']?>" data-color-xml-id="<?=$offer['COLOR_REF_VALUE']?>" <?if($offer['TEXTURE_KARKASA_VALUE']){?>data-karkas-xml-id="<?=$offer['TEXTURE_KARKASA_VALUE']?>"<?}?> <?if($offer['TEKSTURA_DVEREJ_VALUE']){?>data-dveri-xml-id="<?=$offer['TEKSTURA_DVEREJ_VALUE']?>"<?}?>>
                                                                                <img src="<?=$offer['IMAGE']?>" alt="">
                                                                                <span class="series-item-info-price">
                                                                <?=$priceText?>
                                                            </span>
                                                                            </a>
                                                                            <?
																		}
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <?
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div class="row series-main sets-block"  data-tab="2">
                                        <div class="img col-lg-4 col-sm-12 sets-demonstration">
                                            <div class="series-slider-wrapper">
                                                <div class="slick-slider put-arrows main-slide slider-for slider-single">
                                                    <?foreach($arResult['SERIES_GALLERIES'][$arSection['UF_SERIES_GALLERY']] as $image)
                                                    {

                                                            if($arSection['UF_DISCOUNT']){
                                                                $arWaterMark = array(
                                                                    array(
                                                                        'name' => 'watermark',
                                                                        'type' =>'text',
                                                                        'font' =>$_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/font/openSans.ttf',
                                                                        'text' => "Скидка на серию  ".$arSection['UF_DISCOUNT'],
                                                                        "position" => "topright",
                                                                        "color" => "ffffff",
                                                                    )

                                                                );
                                                                $arFileTmp = CFile::ResizeImageGet(
                                                                    $image,
                                                                    array("width" => 315, "height" => 300),
                                                                    BX_RESIZE_IMAGE_EXACT,
                                                                    true,
                                                                    $arWaterMark
                                                                );

                                                            }else{
                                                                $arFileTmp = CFile::ResizeImageGet(
                                                                    $image,
                                                                    array("width" => 315, "height" => 300),
                                                                    BX_RESIZE_IMAGE_EXACT,
                                                                    true
                                                                );
                                                            }
                                                        ?>
                                                        <!--                                        <div class="shine">-->
                                                        <a class="series-main-fancy thumb" rel="group.flag-wrapper" data-fancybox="gallery" href="<?=CFile::GetPath($image);?>">
                                                            <!--                                            <a href="--><?//=$arSection["SECTION_PAGE_URL"]?><!--" class="thumb">-->
                                                            <img class="series-item__main-photo" src="<?=$arFileTmp['src']?>" alt="" />
                                                        </a>
                                                        <!--                                        </div>-->
                                                        <?
                                                    }
                                                    ?>
                                                </div>
                                                <?
                                                if(!empty($arResult['SERIES_GALLERIES'][$arSection['UF_SERIES_GALLERY']]))
                                                {
                                                    ?>
                                                    <div class="series-item__thumbs slick-nav preview-slide slider-nav">
                                                        <?foreach($arResult['SERIES_GALLERIES'][$arSection['UF_SERIES_GALLERY']] as $image)
                                                        {
                                                            ?>
                                                            <div class="series-item__thumb">
                                                                <img class="series-item__thumb-img" src="<?=CFile::GetPath($image);?>" alt="" />
                                                            </div>
                                                            <?
                                                        }
                                                        ?>
                                                    </div>
                                                    <?
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-sm-12 sets-inform">
                                            <div class="series-item-info">
                                                <div class="row">
                                                    <div class="col-md-7 col-lg-7 col-sm-6">
                                                        <div class="series-item-color-top">
                                                            <h4>Комплект 001</h4>
                                                            <div class="series-item-color">
                                                                <div class="row">
                                                                    <?
                                                                    if(!empty($arResult['COLORS'][$arSection['ID']]['COLORS']))
                                                                    {
                                                                        ?>
                                                                        <div class="col-sm-6 series-item-color-solutions">
                                                                            <div class="series-item-color-content">
                                                                                <?
                                                                                foreach($arResult['COLORS'][$arSection['ID']]['COLORS'] as $color)
                                                                                {
                                                                                    ?>
                                                                                    <div class="series-item-color-wrapper">
                                                                                        <div class="series-item-color-pic" data-title="<?=$color['UF_NAME']?>" style="background: url(<?=$color['FILE_SRC']?>)">
                                                                                            <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="<?=$color['UF_XML_ID']?>"></a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                        <?
                                                                    }
                                                                    if(!empty($arResult['COLORS'][$arSection['ID']]['COLORS_ADD']))

                                                                    ?>
                                                                    <div class="col-sm-6 another-color">
                                                                        <p><span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_11" data-name="SIMPLE_FORM_11" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Нужна серия в другом цвете?</span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row series-items">
                                                            <div class="col-md-12">
                                                                <table>
                                                                    <tr>
                                                                        <td>
                                                                            <p class="series-products">Стол руководителя правый</p>
                                                                        </td>
                                                                        <td>
                                                                            <p class="old-price">263 523 &#8381;</p>
                                                                        </td>
                                                                        <td>
                                                                            <p class="price">223 523 &#8381;</p>
                                                                        </td>
                                                                        <td>
                                                                            <div class="counter_block">
                                                                                <span class="minus">-</span>
                                                                                <input type="text" class="text" name="quantity" value="1">
                                                                                <span class="plus">+</span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <p class="series-products">Брифинг</p>
                                                                        </td>
                                                                        <td>
                                                                            <p class="old-price">263 523 &#8381;</p>
                                                                        </td>
                                                                        <td>
                                                                            <p class="price">223 523 &#8381;</p>
                                                                        </td>
                                                                        <td>
                                                                            <div class="counter_block">
                                                                                <span class="minus">-</span>
                                                                                <input type="text" class="text" name="quantity" value="1">
                                                                                <span class="plus">+</span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <p class="series-products">Шкаф для документов</p>
                                                                        </td>
                                                                        <td>
                                                                            <p class="old-price">263 523 &#8381;</p>
                                                                        </td>
                                                                        <td>
                                                                            <p class="price">223 523 &#8381;</p>
                                                                        </td>
                                                                        <td>
                                                                            <div class="counter_block">
                                                                                <span class="minus">-</span>
                                                                                <input type="text" class="text" name="quantity" value="1">
                                                                                <span class="plus">+</span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <p class="series-products">Журнальный стол</p>
                                                                        </td>
                                                                        <td>
                                                                            <p class="old-price">263 523 &#8381;</p>
                                                                        </td>
                                                                        <td>
                                                                            <p class="price">223 523 &#8381;</p>
                                                                        </td>
                                                                        <td>
                                                                            <div class="counter_block">
                                                                                <span class="minus">-</span>
                                                                                <input type="text" class="text" name="quantity" value="1">
                                                                                <span class="plus">+</span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="row series-price">
                                                            <div class="col-md-4 new-price-wrap">
                                                                <p class="price">19 980 &#8381;</p>
                                                            </div>
                                                            <div class="col-md-4 old-price-wrap">
                                                                <p class="old-price">19 980 &#8381;</p>
                                                            </div>
                                                            <div class="col-md-4 sale-size-wrap">
                                                                <p class="economy"><span class="procent">-28%</span> Экономия 3 530 &#8381;</p>
                                                            </div>
                                                            <a href="#" class="expensive">Это дорого?</a>
                                                        </div>
                                                        <div class="row series-buy">
                                                            <div class="col-md-4 counter-wrap">
                                                                <div class="counter_block">
                                                                    <span class="minus">-</span>
                                                                    <input type="text" class="text" name="quantity" value="1">
                                                                    <span class="plus">+</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 in-basket-wrap">
                                                                <div class="button_block">
                                                                    <a href="#">В корзину</a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <a href="" class="fast-buy">Быстрый заказ</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 col-lg-5 col-sm-6 extra-consultation">
                                                        <div class="consultation">
                                                            <h3>Нужна консультация?</h3>
                                                            <ul>
                                                                <li>
                                                                    <h4>Самовывоз:</h4>
                                                                    <p>бесплатно, 25 июня</p>
                                                                </li>
                                                                <li>
                                                                    <h4>Доставка:</h4>
                                                                    <p>700 Р, 25 июня</p>
                                                                </li>
                                                                <li>
                                                                    <h4>Срочная доставка:</h4>
                                                                    <p>750 Р, 25 июня</p>
                                                                </li>
                                                                <li>
                                                                    <h4>Стоимость сборки:</h4>
                                                                    <p>2000 Р</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <?
                                                        if(!empty($arSection['UF_TIZERS']) && !empty($arResult['TIZERS']))
                                                        {
                                                            ?>
                                                            <ul class="series-item-pros">
                                                                <?
                                                                foreach($arSection['UF_TIZERS'] as $tizerId)
                                                                {
                                                                    ?>
                                                                    <li class="series-item-pros-element"><?=$arResult['TIZERS'][$tizerId]['NAME']?></li>
                                                                    <?
                                                                }
                                                                ?>
                                                            </ul>
                                                            <?
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div class="row series-main projects-block"  data-tab="3">
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="row about-company design-projects completed_projects">
                                                <div class="row">
                                                    <?$arFilter = array('IBLOCK_ID'=>16, 'ACTIVE' => 'Y', 'DEPTH_LEVEL' => 1);
                                                    $arSelect = array('ID', 'SORT', 'IBLOCK_ID', 'NAME', 'SECTION_PAGE_URL');
                                                    $arParentSections = CNextCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => CNextCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'Y')), $arFilter, false, $arSelect);
                                                    if($arParentSections)
                                                    {
                                                        $bHasSection = (isset($arSection['ID']) && $arSection['ID']);?>
                                                        <div class="head-block top controls">
                                                            <div class="bottom_border"></div>
                                                            <div class="item-link <?=($bHasSection ? '' : 'active');?>">
                                                                <div class="title">
                                                                    <?if($bHasSection):?>
                                                                        <a class="btn-inline black" href="<?=$arResult['FOLDER'];?>">Все проекты</a>
                                                                    <?else:?>
                                                                        <span class="btn-inline black" data-filter="all">Все проекты</span>
                                                                    <?endif;?>
                                                                </div>
                                                            </div>
                                                            <?$cur_page = $GLOBALS['APPLICATION']->GetCurPage(true);
                                                            $cur_page_no_index = $GLOBALS['APPLICATION']->GetCurPage(false);?>

                                                            <?foreach($arParentSections as $arParentItem):?>

                                                                <?$bSelected = ($bHasSection && CMenu::IsItemSelected($arParentItem['SECTION_PAGE_URL'], $cur_page, $cur_page_no_index));?>
                                                                <div class="item-link <?=($bSelected ? 'active' : '');?>">
                                                                    <div class="title btn-inline black">
                                                                        <?if(!$bHasSection):?>
                                                                            <span class="btn-inline black" data-filter=".s-<?=$arParentItem['ID']?>"><?=$arParentItem['NAME'];?></span>
                                                                        <?else:?>
                                                                            <?if($bSelected):?>
                                                                                <span class="btn-inline black"><?=$arParentItem['NAME'];?></span>
                                                                            <?else:?>
                                                                                <a class="btn-inline black" href="<?=$arParentItem['SECTION_PAGE_URL'];?>"><?=$arParentItem['NAME'];?></a>
                                                                            <?endif;?>
                                                                        <?endif;?>
                                                                    </div>
                                                                </div>
                                                            <?endforeach;?>
                                                        </div>
                                                    <?}?>


                                                    <?$APPLICATION->IncludeComponent(
                                                        "bitrix:news.list",
                                                        'news-project-company-page',
                                                        Array(
                                                            "IMAGE_POSITION" => $arParams["IMAGE_POSITION"],
                                                            "SHOW_CHILD_SECTIONS" => $arParams["SHOW_CHILD_SECTIONS"],
                                                            "DEPTH_LEVEL" => 1,
                                                            "LINE_ELEMENT_COUNT_LIST" => $arParams["LINE_ELEMENT_COUNT_LIST"],
                                                            "IMAGE_WIDE" => $arParams["IMAGE_WIDE"],
                                                            "SHOW_SECTION_PREVIEW_DESCRIPTION" => $arParams["SHOW_SECTION_PREVIEW_DESCRIPTION"],
                                                            "IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
                                                            "IBLOCK_ID"	=>	16,
                                                            "NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
                                                            "SORT_BY1"	=>	$arParams["SORT_BY1"],
                                                            "SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
                                                            "SORT_BY2"	=>	$arParams["SORT_BY2"],
                                                            "SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
                                                            "FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
                                                            "PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
                                                            "DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
                                                            "SET_TITLE"	=>	"N", //$arParams["SET_TITLE"],
                                                            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                                                            "INCLUDE_IBLOCK_INTO_CHAIN"	=> "N", //	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
                                                            "CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
                                                            "CACHE_TIME"	=>	$arParams["CACHE_TIME"],
                                                            "CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
                                                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                                            "DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
                                                            "DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
                                                            "PAGER_TITLE"	=>	"N", //$arParams["PAGER_TITLE"],
                                                            "PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
                                                            "PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
                                                            "PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
                                                            "PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                                                            "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                                                            "DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
                                                            "DISPLAY_NAME"	=>	$arParams["DISPLAY_NAME"],
                                                            "DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
                                                            "DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
                                                            "PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
                                                            "ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
                                                            "USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
                                                            "GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
                                                            "SHOW_DETAIL_LINK"	=>	$arParams["SHOW_DETAIL_LINK"],
                                                            "FILTER_NAME"	=>	$arParams["FILTER_NAME"],
                                                            "HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                                                            "CHECK_DATES"	=>	$arParams["CHECK_DATES"],
                                                            "PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
                                                            "PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
                                                            "DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                                                            "SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                                            "IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                                                            "INCLUDE_SUBSECTIONS" => "N",
                                                            "ADD_SECTIONS_CHAIN" => "N",
                                                            "SET_BROWSER_TITLE" => "N"
                                                        ),
                                                        $component
                                                    );?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="row series-footer">
                            <div class="series-item-buttons">
                                <?
                                if(!empty($arSection['UF_SERIES_BTN_NAME']) && (!empty($arSection['UF_SERIES_BTN_LINK']) || !empty($arSection['UF_SERIES_BTN_FORM'])))
                                {
									$rsForm = CForm::GetByID($arSection['UF_SERIES_BTN_FORM'])->Fetch();
                                    ?>
									<span class="btn" data-event="jqm" data-param-form_id="<?=$rsForm["SID"]?>" data-name="<?=$rsForm["SID"]?>" data-autoload-product_name="<?=$arSection["NAME"];?>" data-autoload-product_id="<?=$arSection["ID"];?>">
                                    <?=$arSection['UF_SERIES_BTN_NAME']?>
									</span>
                                    <?
                                }
                                ?>
                                <a class="btn" href="<?=$arSection['SECTION_PAGE_URL']?>">Подробнее о серии</a>
                            </div>
                        </div>
                    </div>
                    <? } ?>
                    <?
                }
                ?>
            </div>
            <div class="row margin0 flexbox series_content series_content_web">
                <div class="series_content_web_wrap">
                    <?
                    foreach($arResult['SECTIONS'] as $arSection)
                    {
                        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
                        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_SECTION_DELETE_CONFIRM')));?>
                        <?if(in_array($_GET['filter'], $arSection['UF_PODBORKA'])) { ?>
                    <div class="series-item" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                        <ul class="series-item-pros quick-metki">

                            <? foreach($arSection['UF_METKA'] as $arMetka) { ?>
                                <li class="series-item-pros-element">
                                    <div class="pros-icon">
                                        <img src="<?=$arResult['METKI'][$arMetka['ID']]['SRC']?>" alt="">
                                    </div>
                                    <span class="pros-text"><?=$arResult['METKI'][$arMetka['ID']]['NAME']?></span>
                                </li>
                            <? } ?>
                        </ul>
                        <div class="series-img-wrap">
                            <a href="<?=$arSection['SECTION_PAGE_URL'];?>">
                                <? $lolo=0; ?>
                                <?foreach($arResult['SERIES_GALLERIES'][$arSection['UF_SERIES_GALLERY']] as $image)
                                { if($arSection['UF_DISCOUNT']){
                                    $arWaterMark = array(
                                        array(
                                            'name' => 'watermark',
                                            'type' =>'text',
                                            'font' =>$_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/font/openSans.ttf',
                                            'text' => "Скидка на серию  ".$arSection['UF_DISCOUNT'],
                                            "position" => "topright",
                                            "color" => "ffffff",
                                        )

                                    );
                                    $arFileTmp = CFile::ResizeImageGet(
                                        $image,
                                        array("width" => 315, "height" => 300),
                                        BX_RESIZE_IMAGE_EXACT,
                                        true,
                                        $arWaterMark
                                    );

                                }else{
                                    $arFileTmp = CFile::ResizeImageGet(
                                        $image,
                                        array("width" => 315, "height" => 300),
                                        BX_RESIZE_IMAGE_EXACT,
                                        true
                                    );
                                }
                                    ?>
                                    <?$lolo++; if ($lolo>1) break;?>
                                    <img class="series-item__main-photo" src="<?=$arFileTmp['src']?>" alt="" />
                                    <?
                                }
                                ?>
                            </a>
                        </div>
                        <div class="series-content_wrap">
                            <h2 class="series-name"><a href="<?=$arSection['SECTION_PAGE_URL'];?>">Серия <?=$arSection["UF_NAME_RUS"]?></a></h2>
                            <span class="series-name-en"><?=$arSection['NAME'];?></span>
                            <div class="colors-wrap">
                                <div class="series-item-color">
                                    <div class="row">
                                        <?
                                        if(!empty($arResult['COLORS'][$arSection['ID']]['COLORS']))
                                        {
                                            ?>
                                            <div class="col-sm-6 series-item-color-solutions">
                                                <div class="series-item-color-content">
                                                    <?$lol=0;?>
                                                    <?
                                                    foreach($arResult['COLORS'][$arSection['ID']]['COLORS'] as $color)
                                                    {
                                                        ?>
                                                        <?$lol++; if ($lol>3) break;?>
                                                        <div class="series-item-color-wrapper">
                                                            <div class="series-item-color-pic" data-title="<?=$color['UF_NAME']?>" style="background: url(<?=$color['FILE_SRC']?>)">
                                                                <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="<?=$color['UF_XML_ID']?>"></a>
                                                            </div>
                                                        </div>
                                                        <?
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?
                                        }
                                        if(!empty($arResult['COLORS'][$arSection['ID']]['COLORS_ADD']))
                                        ?>
                                    </div>
                                </div>
                                <a href="" class="more-colors">Все цвета</a>
                            </div><p class="price_min">Стол руководителя от 3 000 Р</p>
                        </div>
                        </div>
                                        <? } ?>
                                            <?
                    }
                    ?>

                </div>
            </div>
            <? } else {?>
                <div class="row margin0 flexbox series_content series_content_list active">
                    <?
                    foreach($arResult['SECTIONS'] as $arSection)
                    {

                        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
                        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_SECTION_DELETE_CONFIRM')));?>

                        <div class="series-item" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                            <div class="series-top">
                                <div class="row series-header">
                                    <div class="col-md-12 name-wrapper">
                                        <div class="name">
                                            <a href="<?=$arSection['SECTION_PAGE_URL'];?>" class="dark_link">Серия <?=$arSection['NAME'];?> <span class="dark_link-opacity">|</span> <?=$arSection["UF_NAME_RUS"]?></a>
                                        </div>
                                        <div class="name-right">
                                            <?if(($arParams["DISPLAY_WISH_BUTTONS"] != "N" || $arParams["DISPLAY_COMPARE"] == "Y") || (strlen($arResult["DISPLAY_PROPERTIES"]["CML2_ARTICLE"]["VALUE"]) || ($arResult['SHOW_OFFERS_PROPS'] && $showCustomOffer))):?>
                                                <div class="like_wrapper">
                                                    <?if($arParams["DISPLAY_WISH_BUTTONS"] != "N" || $arParams["DISPLAY_COMPARE"] == "Y"):?>
                                                        <div class="like_icons iblock">
                                                            <?if($arParams["DISPLAY_WISH_BUTTONS"] != "N"):?>
                                                                <?if(!$arResult["OFFERS"]):?>
                                                                    <div class="wish_item text" <?=($arAddToBasketData['CAN_BUY'] ? '' : 'style="display:none"');?> data-item="<?=$arResult["ID"]?>" data-iblock="<?=$arResult["IBLOCK_ID"]?>">
                                                                        <span class="value" title="<?=GetMessage('CT_BCE_CATALOG_IZB')?>" ><i></i></span>
                                                                        <span class="value added" title="<?=GetMessage('CT_BCE_CATALOG_IZB_ADDED')?>"><i></i></span>
                                                                    </div>
                                                                <?elseif($arResult["OFFERS"] && $arParams["TYPE_SKU"] === 'TYPE_1' && !empty($arResult['OFFERS_PROP'])):?>
                                                                    <div class="wish_item text " <?=($arAddToBasketData['CAN_BUY'] ? '' : 'style="display:none"');?> data-item="" data-iblock="<?=$arResult["IBLOCK_ID"]?>" <?=(!empty($arResult['OFFERS_PROP']) ? 'data-offers="Y"' : '');?> data-props="<?=$arOfferProps?>">
                                                                        <span class="value <?=$arParams["TYPE_SKU"];?>" title="<?=GetMessage('CT_BCE_CATALOG_IZB')?>"><i></i></span>
                                                                        <span class="value added <?=$arParams["TYPE_SKU"];?>" title="<?=GetMessage('CT_BCE_CATALOG_IZB_ADDED')?>"><i></i></span>
                                                                    </div>
                                                                <?endif;?>
                                                            <?endif;?>
                                                            <?if($arParams["DISPLAY_COMPARE"] == "Y"):?>
                                                                <?if(!$arResult["OFFERS"] || ($arResult["OFFERS"] && $arParams["TYPE_SKU"] === 'TYPE_1' && !$arResult["OFFERS_PROP"])):?>
                                                                    <div data-item="<?=$arResult["ID"]?>" data-iblock="<?=$arResult["IBLOCK_ID"]?>" data-href="<?=$arResult["COMPARE_URL"]?>" class="compare_item text <?=($arResult["OFFERS"] ? $arParams["TYPE_SKU"] : "");?>" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['COMPARE_LINK']; ?>">
                                                                        <span class="value" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE')?>"><i></i></span>
                                                                        <span class="value added" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE_ADDED')?>"><i></i></span>
                                                                    </div>
                                                                <?elseif($arResult["OFFERS"] && $arParams["TYPE_SKU"] === 'TYPE_1'):?>
                                                                    <div data-item="<?=$arResult["ID"]?>" data-iblock="<?=$arResult["IBLOCK_ID"]?>" data-href="<?=$arResult["COMPARE_URL"]?>" class="compare_item text <?=$arParams["TYPE_SKU"];?>">
                                                                        <span class="value" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE')?>"><i></i></span>
                                                                        <span class="value added" title="<?=GetMessage('CT_BCE_CATALOG_COMPARE_ADDED')?>"><i></i></span>
                                                                    </div>
                                                                <?endif;?>
                                                            <?endif;?>
                                                        </div>
                                                    <?endif;?>
                                                </div>
                                            <?endif;?>
                                            <div class="line_block share top">
                                                <?$APPLICATION->IncludeFile(SITE_DIR."include/share_buttons.php", Array(), Array("MODE" => "html", "UF_NAME_RUS" => GetMessage('CT_BCE_CATALOG_SOC_BUTTON')));?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="series-tabs">
                                        <a href="#" class="series-content-toggle current" data-tab="1">Описание серии</a>
                                        <a href="#" class="series-content-toggle" data-tab="2">Комплекты</a>
                                        <a href="#" class="series-content-toggle" data-tab="3">Проекты</a>
                                    </div>
                                    <div class="row series-main current series-desc-block"  data-tab="1">
                                        <div class="img col-lg-4 col-sm-12">

                                            <ul class="series-item-pros quick-metki">

                                                <? foreach($arSection['UF_METKA'] as $arMetka) { ?>
                                                    <li class="series-item-pros-element">
                                                        <div class="pros-icon">
                                                            <img src="<?=$arResult['METKI'][$arMetka['ID']]['SRC']?>" alt="">
                                                        </div>
                                                        <span class="pros-text"><?=$arResult['METKI'][$arMetka['ID']]['NAME']?></span>
                                                    </li>
                                                <? } ?>
                                            </ul>
                                            <div class="series-slider-wrapper">
                                                <?if($arSection['UF_DISCOUNT']){?>
                                                    <span class="sale-mark"><?=($arSection['UF_DISCOUNT'])?></span>
                                                <?}?>
                                                <div class="slick-slider put-arrows main-slide slider-for slider-single">
                                                    <?foreach($arResult['SERIES_GALLERIES'][$arSection['UF_SERIES_GALLERY']] as $image)
                                                    {
                                                        if($arSection['UF_DISCOUNT']){

//                                                            $arWaterMark = array(
//                                                                array(
//                                                                    'name' => 'watermark',
//                                                                    'type' =>'text',
//                                                                    'font' =>$_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/font/openSans.ttf',
//                                                                    'text' => "Скидка на серию  ".$arSection['UF_DISCOUNT'],
//                                                                    "position" => "topright",
//                                                                    "color" => "ffffff",
//                                                                )
//
//                                                            );
                                                            $arFileTmp = CFile::ResizeImageGet(
                                                                $image,
                                                                array("width" => 417, "height" => 300),
                                                                BX_RESIZE_IMAGE_EXACT,
                                                                true
//                                                                $arWaterMark
                                                            );

                                                        }else{
                                                            $arFileTmp = CFile::ResizeImageGet(
                                                                $image,
                                                                array("width" => 417, "height" => 300),
                                                                BX_RESIZE_IMAGE_EXACT,
                                                                true
                                                            );
                                                        }
                                                        ?>
                                                        <!--                                        <div class="shine">-->
                                                        <a class="series-main-fancy thumb" rel="group" data-fancybox="gallery" href="<?=CFile::GetPath($image);?>">
                                                            <!--                                            <a href="--><?//=$arSection["SECTION_PAGE_URL"]?><!--" class="thumb">-->
                                                            <img class="series-item__main-photo" src="<?=$arFileTmp['src']?>" alt="" />
                                                        </a>
                                                        <!--                                        </div>-->
                                                        <?
                                                    }
                                                    ?>
                                                </div>
                                                <?
                                                if(!empty($arResult['SERIES_GALLERIES'][$arSection['UF_SERIES_GALLERY']]))
                                                {

                                                    ?>
                                                    <div class="series-item__thumbs slick-nav preview-slide slider-nav">
                                                        <?foreach($arResult['SERIES_GALLERIES'][$arSection['UF_SERIES_GALLERY']] as $image)
                                                        {
                                                            ?>
                                                            <div class="series-item__thumb">
                                                                <img class="series-item__thumb-img" src="<?=CFile::GetPath($image);?>" alt="" />
                                                            </div>
                                                            <?
                                                        }
                                                        ?>
                                                    </div>
                                                    <?
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-sm-12">
                                            <div class="series-item-info">
                                                <div class="row">
                                                    <div class="col-md-7 col-lg-7 col-sm-6">
                                                        <div class="series-item-info-top">
                                                            <p class="series-item-info"><?=$arSection["UF_PREVIEW"]?></p>
                                                        </div>
                                                        <!--                                        <div class="series-item-description">-->
                                                        <!--                                                        --><?//=textCut($arSection['~DESCRIPTION'],200)?>
                                                        <!--                                            -->
                                                        <!--                                        </div>-->
                                                        <?
                                                        if(!empty($arSection['UF_TIZERS']) && !empty($arResult['TIZERS']))
                                                        {
                                                            ?>
                                                            <ul class="series-item-pros">
                                                                <?
                                                                foreach($arSection['UF_TIZERS'] as $tizerId)
                                                                {
                                                                    ?>
                                                                    <li class="series-item-pros-element">
                                                                        <div class="pros-icon">
                                                                            <img src="<?=$arResult['TIZERS'][$tizerId]['SRC']?>" alt="">
                                                                        </div>
                                                                        <span class="pros-text"><?=$arResult['TIZERS'][$tizerId]['NAME']?></span>
                                                                    </li>
                                                                    <?
                                                                }
                                                                ?>
                                                            </ul>
                                                            <?
                                                        }
                                                        ?>
                                                        <div class="series-item-color">
                                                            <div class="row">
                                                                <?
                                                                if(!empty($arResult['COLORS'][$arSection['ID']]['COLORS']))
                                                                {
                                                                    ?>
                                                                    <div class="col-sm-6 series-item-color-solutions">
                                                                        <h3>Цветовые решения</h3>
                                                                        <div class="series-item-color-content">
                                                                            <?
                                                                            foreach($arResult['COLORS'][$arSection['ID']]['COLORS'] as $color)
                                                                            {
                                                                                ?>
                                                                                <div class="series-item-color-wrapper">
                                                                                    <div class="series-item-color-pic" data-title="<?=$color['UF_NAME']?>" style="background: url(<?=$color['FILE_SRC']?>)">
                                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="<?=$color['UF_XML_ID']?>"></a>
                                                                                    </div>
                                                                                </div>
                                                                                <?
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <?
                                                                }
                                                                if(!empty($arResult['COLORS'][$arSection['ID']]['COLORS_ADD']))
                                                                {
                                                                    ?>
                                                                    <div class="col-sm-6 series-item-color-solutions">
                                                                        <h3>Дополнительные цвета</h3>
                                                                        <div class="series-item-color-content">
                                                                            <?
                                                                            foreach($arResult['COLORS'][$arSection['ID']]['COLORS_ADD'] as $color)
                                                                            {
                                                                                ?>
                                                                                <div class="series-item-color-wrapper">
                                                                                    <div class="series-item-color-pic" data-title="<?=$color['UF_NAME']?>" style="background: url(<?=$color['FILE_SRC']?>)">
                                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="<?=$color['UF_XML_ID']?>"></a>
                                                                                    </div>
                                                                                </div>
                                                                                <?
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <?
                                                                }
                                                                ?>
                                                            </div>
                                                            <a href="#" class="more-color">Все цвета <i class="fa fa-angle-down"></i></a>
                                                            <div class="another-color">
                                                                <p><span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_11" data-name="SIMPLE_FORM_11" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Нужна серия в другом цвете?</span></p>
                                                            </div>

                                                            <div class="series-item-color series-item-color__modal">
                                                                <div class="row colors">
                                                                    <?
                                                                    if(!empty($arResult['COLORS'][$arSection['ID']]['COLORS']))
                                                                    {
                                                                        ?>
                                                                        <div class="col-sm-12 series-item-color-solutions">
                                                                            <h3>Цветовые решения</h3>
                                                                            <div class="series-item-color-content">
                                                                                <?
                                                                                foreach($arResult['COLORS'][$arSection['ID']]['COLORS'] as $color)
                                                                                {
                                                                                    ?>
                                                                                    <div class="series-item-color-wrapper">
                                                                                        <div class="series-item-color-pic" data-title="<?=$color['UF_NAME']?>" style="background: url(<?=$color['FILE_SRC']?>)">
                                                                                            <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="<?=$color['UF_XML_ID']?>"></a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                        <?
                                                                    }
                                                                    if(!empty($arResult['COLORS'][$arSection['ID']]['COLORS_ADD']))
                                                                    {
                                                                        ?>
                                                                        <div class="col-sm-12 series-item-color-solutions">
                                                                            <h3>Дополнительные цвета</h3>
                                                                            <div class="series-item-color-content">
                                                                                <?
                                                                                foreach($arResult['COLORS'][$arSection['ID']]['COLORS_ADD'] as $color)
                                                                                {
                                                                                    ?>
                                                                                    <div class="series-item-color-wrapper">
                                                                                        <div class="series-item-color-pic" data-title="<?=$color['UF_NAME']?>" style="background: url(<?=$color['FILE_SRC']?>)">
                                                                                            <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="<?=$color['UF_XML_ID']?>"></a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                        <?
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="another-color">
                                                                    <p>Нужна серия в другом цвете?</p>
                                                                    <a class="btn"><span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_11" data-name="SIMPLE_FORM_11" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Оставить заявку</span></a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-5 col-lg-5 col-sm-6 extra-inform">
                                                        <?
                                                        if(!empty($arResult['POPULAR_KITS'][$arSection['ID']]))
                                                        {
                                                            ?>
                                                            <div class="series-item-info-bottom">
                                                                <h3>Комплекты</h3>
                                                                <div class="popular-content-missing-kit <?=(count($arResult['POPULAR_KITS'][$arSection['ID']]['PRODUCTS']) > 0)?"hidden":""?>">К сожалению, комплекты выбранного цвета отсутствует.</div>
                                                                <div class="popular-content popular-content-sets">
                                                                    <?
                                                                    foreach($arResult['POPULAR_KITS'][$arSection['ID']]['PRODUCTS'] as $product)
                                                                    {
                                                                        $i=0;
                                                                        $priceText=($product['OFFERS_COUNT']>1?'от ':'').CurrencyFormat($product['OFFERS_MIN_PRICE'],Bitrix\Currency\CurrencyManager::getBaseCurrency());
                                                                        foreach($product['OFFERS'] as $offer)
                                                                        {
                                                                            ?>
                                                                            <a class="series-item-kit<?if($i++>0):?> hidden<?endif?>" href="<?=$offer['URL']?>" data-color-xml-id="<?=$offer['COLOR_REF_VALUE']?>" <?if($offer['TEXTURE_KARKASA_VALUE']){?>data-karkas-xml-id="<?=$offer['TEXTURE_KARKASA_VALUE']?>"<?}?> <?if($offer['TEKSTURA_DVEREJ_VALUE']){?>data-dveri-xml-id="<?=$offer['TEKSTURA_DVEREJ_VALUE']?>"<?}?>>
                                                                                <img src="<?=$offer['IMAGE']?>" alt="">
                                                                                <span class="series-item-info-price">
                                                                <?=$priceText?>
                                                            </span>
                                                                            </a>
                                                                            <?
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <?
                                                        }
                                                        ?>
                                                        <?
                                                        if(!empty($arResult['POPULAR_PRODUCTS'][$arSection['ID']]))
                                                        {
                                                            ?>
                                                            <div class="series-item-info-bottom">
                                                                <h3>Товары</h3>
                                                                <div class="popular-content-missing-product <?=(count($arResult['POPULAR_PRODUCTS'][$arSection['ID']]['PRODUCTS']) > 0)?"hidden":""?>">К сожалению, товары выбранного цвета отсутствует.</div>
                                                                <div class="popular-content popular-content-items">
                                                                    <?
                                                                    foreach($arResult['POPULAR_PRODUCTS'][$arSection['ID']]['PRODUCTS'] as $product)
                                                                    {
                                                                        $i = 0;
                                                                        $priceText=($product['OFFERS_COUNT']>1?'от ':'').CurrencyFormat($product['OFFERS_MIN_PRICE'],Bitrix\Currency\CurrencyManager::getBaseCurrency());
                                                                        foreach($product['OFFERS'] as $offer)
                                                                        {
                                                                            ?>
                                                                            <a class="series-item-product<?if($i++>0):?> hidden<?endif?>" href="<?=$offer['URL']?>" data-color-xml-id="<?=$offer['COLOR_REF_VALUE']?>" <?if($offer['TEXTURE_KARKASA_VALUE']){?>data-karkas-xml-id="<?=$offer['TEXTURE_KARKASA_VALUE']?>"<?}?> <?if($offer['TEKSTURA_DVEREJ_VALUE']){?>data-dveri-xml-id="<?=$offer['TEKSTURA_DVEREJ_VALUE']?>"<?}?>>
                                                                                <img src="<?=$offer['IMAGE']?>" alt="">
                                                                                <span class="series-item-info-price">
                                                                <?=$priceText?>
                                                            </span>
                                                                            </a>
                                                                            <?
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <?
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row series-main sets-block"  data-tab="2">
                                        <div class="img col-lg-4 col-sm-12 sets-demonstration">
                                            <div class="series-slider-wrapper">
                                                <div class="slick-slider put-arrows main-slide slider-for slider-single">
                                                    <?foreach($arResult['SERIES_GALLERIES'][$arSection['UF_SERIES_GALLERY']] as $image)
                                                    {

                                                        if($arSection['UF_DISCOUNT']){
                                                            $arWaterMark = array(
                                                                array(
                                                                    'name' => 'watermark',
                                                                    'type' =>'text',
                                                                    'font' =>$_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/font/openSans.ttf',
                                                                    'text' => "Скидка на серию  ".$arSection['UF_DISCOUNT'],
                                                                    "position" => "topright",
                                                                    "color" => "ffffff",
                                                                )

                                                            );
                                                            $arFileTmp = CFile::ResizeImageGet(
                                                                $image,
                                                                array("width" => 315, "height" => 300),
                                                                BX_RESIZE_IMAGE_EXACT,
                                                                true,
                                                                $arWaterMark
                                                            );

                                                        }else{
                                                            $arFileTmp = CFile::ResizeImageGet(
                                                                $image,
                                                                array("width" => 315, "height" => 300),
                                                                BX_RESIZE_IMAGE_EXACT,
                                                                true
                                                            );
                                                        }
                                                        ?>
                                                        <!--                                        <div class="shine">-->
                                                        <a class="series-main-fancy thumb" rel="group.flag-wrapper" data-fancybox="gallery" href="<?=CFile::GetPath($image);?>">
                                                            <!--                                            <a href="--><?//=$arSection["SECTION_PAGE_URL"]?><!--" class="thumb">-->
                                                            <img class="series-item__main-photo" src="<?=$arFileTmp['src']?>" alt="" />
                                                        </a>
                                                        <!--                                        </div>-->
                                                        <?
                                                    }
                                                    ?>
                                                </div>
                                                <?
                                                if(!empty($arResult['SERIES_GALLERIES'][$arSection['UF_SERIES_GALLERY']]))
                                                {
                                                    ?>
                                                    <div class="series-item__thumbs slick-nav preview-slide slider-nav">
                                                        <?foreach($arResult['SERIES_GALLERIES'][$arSection['UF_SERIES_GALLERY']] as $image)
                                                        {
                                                            ?>
                                                            <div class="series-item__thumb">
                                                                <img class="series-item__thumb-img" src="<?=CFile::GetPath($image);?>" alt="" />
                                                            </div>
                                                            <?
                                                        }
                                                        ?>
                                                    </div>
                                                    <?
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-sm-12 sets-inform">
                                            <div class="series-item-info">
                                                <div class="row">
                                                    <div class="col-md-7 col-lg-7 col-sm-6">
                                                        <div class="series-item-color-top">
                                                            <h4>Комплект 001</h4>
                                                            <div class="series-item-color">
                                                                <div class="row">
                                                                    <?
                                                                    if(!empty($arResult['COLORS'][$arSection['ID']]['COLORS']))
                                                                    {
                                                                        ?>
                                                                        <div class="col-sm-6 series-item-color-solutions">
                                                                            <div class="series-item-color-content">
                                                                                <?
                                                                                foreach($arResult['COLORS'][$arSection['ID']]['COLORS'] as $color)
                                                                                {
                                                                                    ?>
                                                                                    <div class="series-item-color-wrapper">
                                                                                        <div class="series-item-color-pic" data-title="<?=$color['UF_NAME']?>" style="background: url(<?=$color['FILE_SRC']?>)">
                                                                                            <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="<?=$color['UF_XML_ID']?>"></a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                        <?
                                                                    }
                                                                    if(!empty($arResult['COLORS'][$arSection['ID']]['COLORS_ADD']))

                                                                    ?>
                                                                    <div class="col-sm-6 another-color">
                                                                        <p><span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_11" data-name="SIMPLE_FORM_11" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Нужна серия в другом цвете?</span></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row series-items">
                                                            <div class="col-md-12">
                                                                <table>
                                                                    <tr>
                                                                        <td>
                                                                            <p class="series-products">Стол руководителя правый</p>
                                                                        </td>
                                                                        <td>
                                                                            <p class="old-price">263 523 &#8381;</p>
                                                                        </td>
                                                                        <td>
                                                                            <p class="price">223 523 &#8381;</p>
                                                                        </td>
                                                                        <td>
                                                                            <div class="counter_block">
                                                                                <span class="minus">-</span>
                                                                                <input type="text" class="text" name="quantity" value="1">
                                                                                <span class="plus">+</span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <p class="series-products">Брифинг</p>
                                                                        </td>
                                                                        <td>
                                                                            <p class="old-price">263 523 &#8381;</p>
                                                                        </td>
                                                                        <td>
                                                                            <p class="price">223 523 &#8381;</p>
                                                                        </td>
                                                                        <td>
                                                                            <div class="counter_block">
                                                                                <span class="minus">-</span>
                                                                                <input type="text" class="text" name="quantity" value="1">
                                                                                <span class="plus">+</span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <p class="series-products">Шкаф для документов</p>
                                                                        </td>
                                                                        <td>
                                                                            <p class="old-price">263 523 &#8381;</p>
                                                                        </td>
                                                                        <td>
                                                                            <p class="price">223 523 &#8381;</p>
                                                                        </td>
                                                                        <td>
                                                                            <div class="counter_block">
                                                                                <span class="minus">-</span>
                                                                                <input type="text" class="text" name="quantity" value="1">
                                                                                <span class="plus">+</span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <p class="series-products">Журнальный стол</p>
                                                                        </td>
                                                                        <td>
                                                                            <p class="old-price">263 523 &#8381;</p>
                                                                        </td>
                                                                        <td>
                                                                            <p class="price">223 523 &#8381;</p>
                                                                        </td>
                                                                        <td>
                                                                            <div class="counter_block">
                                                                                <span class="minus">-</span>
                                                                                <input type="text" class="text" name="quantity" value="1">
                                                                                <span class="plus">+</span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="row series-price">
                                                            <div class="col-md-4 new-price-wrap">
                                                                <p class="price">19 980 &#8381;</p>
                                                            </div>
                                                            <div class="col-md-4 old-price-wrap">
                                                                <p class="old-price">19 980 &#8381;</p>
                                                            </div>
                                                            <div class="col-md-4 sale-size-wrap">
                                                                <p class="economy"><span class="procent">-28%</span> Экономия 3 530 &#8381;</p>
                                                            </div>
                                                            <a href="#" class="expensive">Это дорого?</a>
                                                        </div>
                                                        <div class="row series-buy">
                                                            <div class="col-md-4 counter-wrap">
                                                                <div class="counter_block">
                                                                    <span class="minus">-</span>
                                                                    <input type="text" class="text" name="quantity" value="1">
                                                                    <span class="plus">+</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 in-basket-wrap">
                                                                <div class="button_block">
                                                                    <a href="#">В корзину</a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <a href="" class="fast-buy">Быстрый заказ</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 col-lg-5 col-sm-6 extra-consultation">
                                                        <div class="consultation">
                                                            <h3>Нужна консультация?</h3>
                                                            <ul>
                                                                <li>
                                                                    <h4>Самовывоз:</h4>
                                                                    <p>бесплатно, 25 июня</p>
                                                                </li>
                                                                <li>
                                                                    <h4>Доставка:</h4>
                                                                    <p>700 Р, 25 июня</p>
                                                                </li>
                                                                <li>
                                                                    <h4>Срочная доставка:</h4>
                                                                    <p>750 Р, 25 июня</p>
                                                                </li>
                                                                <li>
                                                                    <h4>Стоимость сборки:</h4>
                                                                    <p>2000 Р</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <?
                                                        if(!empty($arSection['UF_TIZERS']) && !empty($arResult['TIZERS']))
                                                        {
                                                            ?>
                                                            <ul class="series-item-pros">
                                                                <?
                                                                foreach($arSection['UF_TIZERS'] as $tizerId)
                                                                {
                                                                    ?>
                                                                    <li class="series-item-pros-element"><?=$arResult['TIZERS'][$tizerId]['NAME']?></li>
                                                                    <?
                                                                }
                                                                ?>
                                                            </ul>
                                                            <?
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row series-main projects-block"  data-tab="3">
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="row about-company design-projects completed_projects">
                                                <div class="row">
                                                    <?$arFilter = array('IBLOCK_ID'=>16, 'ACTIVE' => 'Y', 'DEPTH_LEVEL' => 1);
                                                    $arSelect = array('ID', 'SORT', 'IBLOCK_ID', 'NAME', 'SECTION_PAGE_URL');
                                                    $arParentSections = CNextCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => CNextCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'Y')), $arFilter, false, $arSelect);
                                                    if($arParentSections)
                                                    {
                                                        $bHasSection = (isset($arSection['ID']) && $arSection['ID']);?>
                                                        <div class="head-block top controls">
                                                            <div class="bottom_border"></div>
                                                            <div class="item-link <?=($bHasSection ? '' : 'active');?>">
                                                                <div class="title">
                                                                    <?if($bHasSection):?>
                                                                        <a class="btn-inline black" href="<?=$arResult['FOLDER'];?>">Все проекты</a>
                                                                    <?else:?>
                                                                        <span class="btn-inline black" data-filter="all">Все проекты</span>
                                                                    <?endif;?>
                                                                </div>
                                                            </div>
                                                            <?$cur_page = $GLOBALS['APPLICATION']->GetCurPage(true);
                                                            $cur_page_no_index = $GLOBALS['APPLICATION']->GetCurPage(false);?>

                                                            <?foreach($arParentSections as $arParentItem):?>

                                                                <?$bSelected = ($bHasSection && CMenu::IsItemSelected($arParentItem['SECTION_PAGE_URL'], $cur_page, $cur_page_no_index));?>
                                                                <div class="item-link <?=($bSelected ? 'active' : '');?>">
                                                                    <div class="title btn-inline black">
                                                                        <?if(!$bHasSection):?>
                                                                            <span class="btn-inline black" data-filter=".s-<?=$arParentItem['ID']?>"><?=$arParentItem['NAME'];?></span>
                                                                        <?else:?>
                                                                            <?if($bSelected):?>
                                                                                <span class="btn-inline black"><?=$arParentItem['NAME'];?></span>
                                                                            <?else:?>
                                                                                <a class="btn-inline black" href="<?=$arParentItem['SECTION_PAGE_URL'];?>"><?=$arParentItem['NAME'];?></a>
                                                                            <?endif;?>
                                                                        <?endif;?>
                                                                    </div>
                                                                </div>
                                                            <?endforeach;?>
                                                        </div>
                                                    <?}?>


                                                    <?$APPLICATION->IncludeComponent(
                                                        "bitrix:news.list",
                                                        'news-project-company-page',
                                                        Array(
                                                            "IMAGE_POSITION" => $arParams["IMAGE_POSITION"],
                                                            "SHOW_CHILD_SECTIONS" => $arParams["SHOW_CHILD_SECTIONS"],
                                                            "DEPTH_LEVEL" => 1,
                                                            "LINE_ELEMENT_COUNT_LIST" => $arParams["LINE_ELEMENT_COUNT_LIST"],
                                                            "IMAGE_WIDE" => $arParams["IMAGE_WIDE"],
                                                            "SHOW_SECTION_PREVIEW_DESCRIPTION" => $arParams["SHOW_SECTION_PREVIEW_DESCRIPTION"],
                                                            "IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
                                                            "IBLOCK_ID"	=>	16,
                                                            "NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
                                                            "SORT_BY1"	=>	$arParams["SORT_BY1"],
                                                            "SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
                                                            "SORT_BY2"	=>	$arParams["SORT_BY2"],
                                                            "SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
                                                            "FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
                                                            "PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
                                                            "DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
                                                            "SET_TITLE"	=>	"N", //$arParams["SET_TITLE"],
                                                            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                                                            "INCLUDE_IBLOCK_INTO_CHAIN"	=> "N", //	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
                                                            "CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
                                                            "CACHE_TIME"	=>	$arParams["CACHE_TIME"],
                                                            "CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
                                                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                                            "DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
                                                            "DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
                                                            "PAGER_TITLE"	=>	"N", //$arParams["PAGER_TITLE"],
                                                            "PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
                                                            "PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
                                                            "PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
                                                            "PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                                                            "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                                                            "DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
                                                            "DISPLAY_NAME"	=>	$arParams["DISPLAY_NAME"],
                                                            "DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
                                                            "DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
                                                            "PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
                                                            "ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
                                                            "USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
                                                            "GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
                                                            "SHOW_DETAIL_LINK"	=>	$arParams["SHOW_DETAIL_LINK"],
                                                            "FILTER_NAME"	=>	$arParams["FILTER_NAME"],
                                                            "HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                                                            "CHECK_DATES"	=>	$arParams["CHECK_DATES"],
                                                            "PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
                                                            "PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
                                                            "DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                                                            "SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                                            "IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                                                            "INCLUDE_SUBSECTIONS" => "N",
                                                            "ADD_SECTIONS_CHAIN" => "N",
                                                            "SET_BROWSER_TITLE" => "N"
                                                        ),
                                                        $component
                                                    );?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row series-footer">
                                <div class="series-item-buttons">
                                    <?
                                    if(!empty($arSection['UF_SERIES_BTN_NAME']) && (!empty($arSection['UF_SERIES_BTN_LINK']) || !empty($arSection['UF_SERIES_BTN_FORM'])))
                                    {
                                        $rsForm = CForm::GetByID($arSection['UF_SERIES_BTN_FORM'])->Fetch();
                                        ?>
                                        <span class="btn" data-event="jqm" data-param-form_id="<?=$rsForm["SID"]?>" data-name="<?=$rsForm["SID"]?>" data-autoload-product_name="<?=$arSection["NAME"];?>" data-autoload-product_id="<?=$arSection["ID"];?>">
                                    <?=$arSection['UF_SERIES_BTN_NAME']?>
									</span>
                                        <?
                                    }
                                    ?>
                                    <a class="btn" href="<?=$arSection['SECTION_PAGE_URL']?>">Подробнее о серии</a>
                                </div>
                            </div>
                        </div>

                        <?
                    }
                    ?>
                </div>
                <div class="row margin0 flexbox series_content series_content_web">
                    <div class="series_content_web_wrap">
                        <?
                        foreach($arResult['SECTIONS'] as $arSection)
                        {
                            $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
                            $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_SECTION_DELETE_CONFIRM')));?>

                        <div class="series-item" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                            <ul class="series-item-pros quick-metki">

                                <? foreach($arSection['UF_METKA'] as $arMetka) { ?>
                                    <li class="series-item-pros-element">
                                        <div class="pros-icon">
                                            <img src="<?=$arResult['METKI'][$arMetka['ID']]['SRC']?>" alt="">
                                        </div>
                                        <span class="pros-text"><?=$arResult['METKI'][$arMetka['ID']]['NAME']?></span>
                                    </li>
                                <? } ?>
                            </ul>
                            <div class="series-img-wrap">
                                <a href="<?=$arSection['SECTION_PAGE_URL'];?>">
                                    <? $lolo=0; ?>
                                    <?foreach($arResult['SERIES_GALLERIES'][$arSection['UF_SERIES_GALLERY']] as $image)
                                    { if($arSection['UF_DISCOUNT']){
                                        $arWaterMark = array(
                                            array(
                                                'name' => 'watermark',
                                                'type' =>'text',
                                                'font' =>$_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/font/openSans.ttf',
                                                'text' => "Скидка на серию  ".$arSection['UF_DISCOUNT'],
                                                "position" => "topright",
                                                "color" => "ffffff",
                                            )

                                        );
                                        $arFileTmp = CFile::ResizeImageGet(
                                            $image,
                                            array("width" => 315, "height" => 300),
                                            BX_RESIZE_IMAGE_EXACT,
                                            true,
                                            $arWaterMark
                                        );

                                    }else{
                                        $arFileTmp = CFile::ResizeImageGet(
                                            $image,
                                            array("width" => 315, "height" => 300),
                                            BX_RESIZE_IMAGE_EXACT,
                                            true
                                        );
                                    }
                                        ?>
                                        <?$lolo++; if ($lolo>1) break;?>
                                        <img class="series-item__main-photo" src="<?=$arFileTmp['src']?>" alt="" />
                                        <?
                                    }
                                    ?>
                                </a>
                            </div>
                            <div class="series-content_wrap">
                            <h2 class="series-name"><a href="<?=$arSection['SECTION_PAGE_URL'];?>">Серия <?=$arSection["UF_NAME_RUS"]?></a></h2>
                            <span class="series-name-en"><?=$arSection['NAME'];?></span>
                            <div class="colors-wrap">
                            <div class="series-item-color">
                            <div class="row">
                            <?
                            if(!empty($arResult['COLORS'][$arSection['ID']]['COLORS']))
                            {
                                ?>
                                <div class="col-sm-6 series-item-color-solutions">
                                    <div class="series-item-color-content">
                                        <?$lol=0;?>
                                        <?
                                        foreach($arResult['COLORS'][$arSection['ID']]['COLORS'] as $color)
                                        {
                                            ?>
                                            <?$lol++; if ($lol>3) break;?>
                                            <div class="series-item-color-wrapper">
                                                <div class="series-item-color-pic" data-title="<?=$color['UF_NAME']?>" style="background: url(<?=$color['FILE_SRC']?>)">
                                                    <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="<?=$color['UF_XML_ID']?>"></a>
                                                </div>
                                            </div>
                                            <?
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?
                            }
                            if(!empty($arResult['COLORS'][$arSection['ID']]['COLORS_ADD']))
                                ?>
                                </div>
                                </div>
                                <a href="" class="more-colors">Все цвета</a>
                                </div><p class="price_min">Стол руководителя от 3 000 Р</p>
                                </div>
                                </div>

                            <?
                        }
                        ?>

                    </div>
                </div>
            <? } ?>
        </div>
    </div>
<?
}
?>