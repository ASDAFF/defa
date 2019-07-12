<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?global $arTheme;?>
<!--модалка цены-->
<div class="price-modal" id="price-modal">
    <div class="close-modal">
        <span></span>
        <span></span>
    </div>
    <h3>Способы оплаты в Санкт-Петербурге</h3>
    <div class="row">
        <div class="col-md-4">
            <div class="item">
                <h4 class="no-cash">Безналичная оплата</h4>
                <p>После оформления заказа на сайте с Вами
                    свяжется менеджер для подтверждения заказа.
                    После согласования заказа на электронную
                    почту придет счет с реквизитами для оплаты.
                </p>
                <p>Оплату счета можно провести в любом
                    интернет-банке или банковским переводом в
                    отделение банка.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="item">
                <h4 class="card-pay">Оплата банковской картой</h4>
                <ol>
                    <li>
                        <p>Оплата заказа онлайн при покупке через
                            “корзину” на сайте. При выборе способа оплаты
                            вы будете перенаправлены на платёжную
                            форму для введения данных банковской карты.
                            К оплате принимаются карты MasterCard, Visa
                            или Мир (без коммиссии).</p>
                    </li>
                    <li>
                        <p>Оплата заказа курьеру или при самовывозе
                            по адресу: Чугунная ул., д. 14, лит. Р.</p>
                    </li>
                </ol>
            </div>
        </div>
        <div class="col-md-4">
            <div class="item">
                <h4 class="cash">Оплата наличными</h4>
                <ol>
                    <li>
                        <p>При доставке заказа курьером</p>
                    </li>
                    <li>
                        <p>При самовывозе товара со склада по адресу:
                            Чугунная ул., д. 14, лит. Р.</p>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>


<?/*if($arResult["TIZERS_ITEMS"]){*/?><!--
        <div class="tizers-catalog-elem">
		<div class="tizers_block_detail tizers_block">
			<div class="row">
				<?/*$count_t_items=count($arResult["TIZERS_ITEMS"]);*/?>
				<?/*foreach($arResult["TIZERS_ITEMS"] as $arItem){*/?>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="inner_wrapper item">
							<?/*if($arItem["UF_FILE"]){*/?>
								<div class="img">
									<?/*if($arItem["UF_LINK"]){*/?>
										<a href="<?/*=$arItem["UF_LINK"];*/?>" <?/*=(strpos($arItem["UF_LINK"], "http") !== false ? "target='_blank' rel='nofollow'" : '')*/?>>
									<?/*}*/?>
									<img src="<?/*=$arItem["PREVIEW_PICTURE"]["src"];*/?>" alt="<?/*=$arItem["UF_NAME"];*/?>" title="<?/*=$arItem["UF_NAME"];*/?>">
									<?/*if($arItem["UF_LINK"]){*/?>
										</a>
									<?/*}*/?>
								</div>
							<?/*}*/?>
							<div class="title">
								<?/*if($arItem["UF_LINK"]){*/?>
									<a href="<?/*=$arItem["UF_LINK"];*/?>" <?/*=(strpos($arItem["UF_LINK"], "http") !== false ? "target='_blank' rel='nofollow'" : '')*/?>>
								<?/*}*/?>
								<?/*=$arItem["UF_NAME"];*/?>
								<?/*if($arItem["UF_LINK"]){*/?>
									</a>
								<?/*}*/?>
							</div>
						</div>
					</div>
				<?/*}*/?>
			</div>
		</div>
		</div>
	--><?/*}*/?>




<!--ФИКСИРОВАННОЕ МЕНЮ-->

<!--<div class="fixed-menu">
<?/*$APPLICATION->IncludeComponent("bitrix:menu", "left_front_catalog_custom", array(
				"ROOT_MENU_TYPE" => "left",
				"MENU_CACHE_TYPE" => "A",
				"MENU_CACHE_TIME" => "3600000",
				"MENU_CACHE_USE_GROUPS" => "N",
				"CACHE_SELECTED_ITEMS" => "N",
				"MENU_CACHE_GET_VARS" => "",
				"MAX_LEVEL" => $arTheme["MAX_DEPTH_MENU"]["VALUE"],
				"CHILD_MENU_TYPE" => "left",
				"USE_EXT" => "Y",
				"DELAY" => "N",
				"ALLOW_MULTI_SELECT" => "N" ),
				false, array( "ACTIVE_COMPONENT" => "Y" )
			);*/?>

</div>-->




<div class="basket_props_block" id="bx_basket_div_<?=$arResult["ID"];?>" style="display: none;">
	<?if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])){
		foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo){?>
			<input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
			<?if (isset($arResult['PRODUCT_PROPERTIES'][$propID]))
				unset($arResult['PRODUCT_PROPERTIES'][$propID]);
		}
	}
	$arResult["EMPTY_PROPS_JS"]="Y";
	$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
	if (!$emptyProductProperties){
		$arResult["EMPTY_PROPS_JS"]="N";?>
		<div class="wrapper">
			<table>
				<?foreach ($arResult['PRODUCT_PROPERTIES'] as $propID => $propInfo){?>
					<tr>
						<td><? echo $arResult['PROPERTIES'][$propID]['NAME']; ?></td>
						<td>
							<?if('L' == $arResult['PROPERTIES'][$propID]['PROPERTY_TYPE'] && 'C' == $arResult['PROPERTIES'][$propID]['LIST_TYPE']){
								foreach($propInfo['VALUES'] as $valueID => $value){?>
									<label>
										<input type="radio" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?>
									</label>
								<?}
							}else{?>
								<select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]">
									<?foreach($propInfo['VALUES'] as $valueID => $value){?>
										<option value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>><? echo $value; ?></option>
									<?}?>
								</select>
							<?}?>
						</td>
					</tr>
				<?}?>
			</table>
		</div>
	<?}?>
</div>
<?
$this->setFrameMode(true);
$currencyList = '';
if (!empty($arResult['CURRENCIES'])){
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$arTmpAssoc = json_decode($arResult['PROPERTIES']['ASSOCIATED_FILTER']['~VALUE'], true);
$arTmpExp = json_decode($arResult['PROPERTIES']['EXPANDABLES_FILTER']['~VALUE'], true);
$arTmpModif = json_decode($arResult['PROPERTIES']['MODIFICATIONS_FILTER']['~VALUE'], true);
$arTmpRecomend = json_decode($arResult['PROPERTIES']['RECOMENDATION_FILTER']['~VALUE'], true);
$arTmpThissect = json_decode($arResult['PROPERTIES']['THISSECTION_FILTER']['~VALUE'], true);
$arTmpThisser = json_decode($arResult['PROPERTIES']['THISSERIES_FILTER']['~VALUE'], true);

$templateData = array(
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'BRAND_ITEM' => $arResult['BRAND_ITEM'],
	'ASSOCIATED' => $arResult['PROPERTIES']['ASSOCIATED']['VALUE'],
	'STORES' => array(
		"USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
		"SCHEDULE" => $arParams["SCHEDULE"],
		"USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
		"MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
		"ELEMENT_ID" => $arResult["ID"],
		"STORE_PATH"  =>  $arParams["STORE_PATH"],
		"MAIN_TITLE"  =>  $arParams["MAIN_TITLE"],
		"MAX_AMOUNT"=>$arParams["MAX_AMOUNT"],
		"USE_ONLY_MAX_AMOUNT" => $arParams["USE_ONLY_MAX_AMOUNT"],
		"SHOW_EMPTY_STORE" => $arParams['SHOW_EMPTY_STORE'],
		"SHOW_GENERAL_STORE_INFORMATION" => $arParams['SHOW_GENERAL_STORE_INFORMATION'],
		"USE_ONLY_MAX_AMOUNT" => $arParams["USE_ONLY_MAX_AMOUNT"],
		"USER_FIELDS" => $arParams['USER_FIELDS'],
		"FIELDS" => $arParams['FIELDS'],
		"STORES_FILTER_ORDER" => $arParams['STORES_FILTER_ORDER'],
		"STORES_FILTER" => $arParams['STORES_FILTER'],
		"STORES" => $arParams['STORES'] = array_diff($arParams['STORES'], array('')),
	)
);
unset($currencyList, $templateLibrary);

if($arResult["PROPERTIES"]["YM_ELEMENT_ID"] && $arResult["PROPERTIES"]["YM_ELEMENT_ID"]["VALUE"])
	$templateData["YM_ELEMENT_ID"] = $arResult["PROPERTIES"]["YM_ELEMENT_ID"]["VALUE"];

$arSkuTemplate = array();
if (!empty($arResult['SKU_PROPS'])){
	$arSkuTemplate=CNextB2c::GetSKUPropsArray($arResult['SKU_PROPS'], $arResult["SKU_IBLOCK_ID"], "list", $arParams["OFFER_HIDE_NAME_PROPS"]);
}
$strMainID = $this->GetEditAreaId($arResult['ID']);

$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);

$arResult["strMainID"] = $this->GetEditAreaId($arResult['ID']);
$arItemIDs=CNextB2c::GetItemsIDs($arResult, "Y");
$totalCount = CNextB2c::GetTotalCount($arResult, $arParams);

$arQuantityData = CNextB2c::GetQuantityArray($totalCount, $arItemIDs["ALL_ITEM_IDS"], "Y");

$arParams["BASKET_ITEMS"]=($arParams["BASKET_ITEMS"] ? $arParams["BASKET_ITEMS"] : array());

$useStores = $arParams["USE_STORE"] == "Y" && $arResult["STORES_COUNT"] && $arQuantityData["RIGHTS"]["SHOW_QUANTITY"];
$showCustomOffer=(($arResult['OFFERS'] && $arParams["TYPE_SKU"] !="N") ? true : false);
if($showCustomOffer){
	$templateData['JS_OBJ'] = $strObName;
}
$strMeasure='';
$arAddToBasketData = array();

$templateData['STR_ID'] = $strObName;

if($arResult["OFFERS"]){
	$strMeasure=$arResult["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
	$templateData["STORES"]["OFFERS"]="Y";
	foreach($arResult["OFFERS"] as $arOffer){
		$templateData["STORES"]["OFFERS_ID"][]=$arOffer["ID"];
	}
}else{
	if (($arParams["SHOW_MEASURE"]=="Y")&&($arResult["CATALOG_MEASURE"])){
		$arMeasure = CCatalogMeasure::getList(array(), array("ID"=>$arResult["CATALOG_MEASURE"]), false, false, array())->GetNext();
		$strMeasure=$arMeasure["SYMBOL_RUS"];
	}
	$arAddToBasketData = CNextB2c::GetAddToBasketArray($arResult, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], 'btn-lg w_icons', $arParams);
}
$arOfferProps = implode(';', $arParams['OFFERS_CART_PROPERTIES']);

// save item viewed
$arFirstPhoto = reset($arResult['MORE_PHOTO']);
$arItemPrices = $arResult['MIN_PRICE'];
if(isset($arResult['PRICE_MATRIX']) && $arResult['PRICE_MATRIX'])
{
	$rangSelected = $arResult['ITEM_QUANTITY_RANGE_SELECTED'];
	$priceSelected = $arResult['ITEM_PRICE_SELECTED'];
	if(isset($arResult['FIX_PRICE_MATRIX']) && $arResult['FIX_PRICE_MATRIX'])
	{
		$rangSelected = $arResult['FIX_PRICE_MATRIX']['RANGE_SELECT'];
		$priceSelected = $arResult['FIX_PRICE_MATRIX']['PRICE_SELECT'];
	}
	$arItemPrices = $arResult['ITEM_PRICES'][$priceSelected];
	$arItemPrices['VALUE'] = $arItemPrices['BASE_PRICE'];
	$arItemPrices['PRINT_VALUE'] = \Aspro\Functions\CAsproItem::getCurrentPrice('BASE_PRICE', $arItemPrices);
	$arItemPrices['DISCOUNT_VALUE'] = $arItemPrices['PRICE'];
	$arItemPrices['PRINT_DISCOUNT_VALUE'] = \Aspro\Functions\CAsproItem::getCurrentPrice('PRICE', $arItemPrices);
}
$arViewedData = array(
	'PRODUCT_ID' => $arResult['ID'],
	'IBLOCK_ID' => $arResult['IBLOCK_ID'],
	'NAME' => $arResult['NAME'],
	'DETAIL_PAGE_URL' => $arResult['DETAIL_PAGE_URL'],
	'PICTURE_ID' => $arResult['PREVIEW_PICTURE'] ? $arResult['PREVIEW_PICTURE']['ID'] : ($arFirstPhoto ? $arFirstPhoto['ID'] : false),
	'CATALOG_MEASURE_NAME' => $arResult['CATALOG_MEASURE_NAME'],
	'MIN_PRICE' => $arItemPrices,
	'CAN_BUY' => $arResult['CAN_BUY'] ? 'Y' : 'N',
	'IS_OFFER' => 'N',
	'WITH_OFFERS' => $arResult['OFFERS'] ? 'Y' : 'N',
);
?>
<script type="text/javascript">
setViewedProduct(<?=$arResult['ID']?>, <?=CUtil::PhpToJSObject($arViewedData, false)?>);
</script>
<meta itemprop="name" content="<?=$name = strip_tags(!empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] : $arResult['NAME'])?>" />
<meta itemprop="category" content="<?=$arResult['CATEGORY_PATH']?>" />
<meta itemprop="description" content="<?=(strlen(strip_tags($arResult['PREVIEW_TEXT'])) ? strip_tags($arResult['PREVIEW_TEXT']) : (strlen(strip_tags($arResult['DETAIL_TEXT'])) ? strip_tags($arResult['DETAIL_TEXT']) : $name))?>" />

<div class="item_main_info type_clothes <?=(!$showCustomOffer ? "noffer" : "");?> <?=($arParams["SHOW_UNABLE_SKU_PROPS"] != "N" ? "show_un_props" : "unshow_un_props");?>" id="<?=$arItemIDs["strMainID"];?>">


    <div class="col-md-8">
        <div class="img_wrapper swipeignore">




            <div class="stickers">
                <?$prop = ($arParams["STIKERS_PROP"] ? $arParams["STIKERS_PROP"] : "HIT");?>
                <?foreach(CNextB2c::GetItemStickers($arResult["PROPERTIES"][$prop]) as $arSticker):?>
                    <div><div class="<?=$arSticker['CLASS']?>" title="<?=$arSticker['VALUE']?>"><?=$arSticker['VALUE']?></div></div>
                <?endforeach;?>
                <?if($arParams["SALE_STIKER"] && $arResult["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"]){?>
                    <div><div class="sticker_sale_text"><?=$arResult["PROPERTIES"][$arParams["SALE_STIKER"]]["VALUE"];?></div></div>
                <?}?>
            </div>
            <?$countThumb = count($arResult["MORE_PHOTO"]);?>
            <div class="item_slider has_<?=($countThumb > 1 ? 'more' : 'one');?>">
                <!--АРТИКУЛ-->
                <div class="item_block prod-number">
                    <div class="article iblock" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue" <?if($arResult['SHOW_OFFERS_PROPS']){?>id="<? echo $arItemIDs["ALL_ITEM_IDS"]['DISPLAY_PROP_ARTICLE_DIV'] ?>" style="display: none;"<?}?>>
                        <span class="block_title" itemprop="name"><?=$arResult["DISPLAY_PROPERTIES"]["CML2_ARTICLE"]["NAME"];?>:</span>
                        <span class="value" itemprop="value"><?=$arResult["DISPLAY_PROPERTIES"]["CML2_ARTICLE"]["VALUE"]?></span>
                    </div>
                </div>


                <!--ЗВЕЗДОЧКИ РЕЙТИНГА НЕ УБИРАТЬ-->

                <?$frame = $this->createFrame('dv_'.$arResult["ID"])->begin('');?>
                <div class="rating">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:iblock.vote",
                        "element_rating",
                        Array(
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arResult["IBLOCK_ID"],
                            "ELEMENT_ID" => $arResult["ID"],
                            "MAX_VOTE" => 5,
                            "VOTE_NAMES" => array(),
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "DISPLAY_AS_RATING" => 'vote_avg'
                        ),
                        $component, array("HIDE_ICONS" =>"Y")
                    );?>
                </div>
                <?$frame->end();?>

                <!---->






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

                <?reset($arResult['MORE_PHOTO']);
                $arFirstPhoto = current($arResult['MORE_PHOTO']);
                $viewImgType=$arParams["DETAIL_PICTURE_MODE"];?>
                <div class="slides">
                    <?if($showCustomOffer && !empty($arResult['OFFERS_PROP'])){?>
                        <div class="offers_img wof">
                            <?$alt=$arFirstPhoto["ALT"];
                            $title=$arFirstPhoto["TITLE"];?>
                            <?if($arFirstPhoto["BIG"]["src"]){?>
                                <a href="<?=($viewImgType=="POPUP" ? $arFirstPhoto["BIG"]["src"] : "javascript:void(0)");?>" class="<?=($viewImgType=="POPUP" ? "popup_link" : "line_link");?>" title="<?=$title;?>">
                                    <img id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>" src="<?=$arFirstPhoto['SMALL']['src']; ?>" <?=($viewImgType=="MAGNIFIER" ? 'data-large="" data-xpreview="" data-xoriginal=""': "");?> alt="<?=$alt;?>" title="<?=$title;?>" itemprop="image">
                                    <div class="zoom"></div>
                                </a>
                            <?}else{?>
                                <a href="javascript:void(0)" class="" title="<?=$title;?>">
                                    <img id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>" src="<?=$arFirstPhoto['SRC']; ?>" alt="<?=$alt;?>" title="<?=$title;?>" itemprop="image">
                                    <div class="zoom"></div>
                                </a>
                            <?}?>
                        </div>
                    <?}else{
                        if($arResult["MORE_PHOTO"]){
                            $bMagnifier = ($viewImgType=="MAGNIFIER");?>
                            <ul>
                                <?foreach($arResult["MORE_PHOTO"] as $i => $arImage){
                                    if($i && $bMagnifier):?>
                                        <?continue;?>
                                    <?endif;?>
                                    <?$isEmpty=($arImage["SMALL"]["src"] ? false : true );?>
                                    <?
                                    $alt=$arImage["ALT"];
                                    $title=$arImage["TITLE"];
                                    ?>
                                    <li id="photo-<?=$i?>" <?=(!$i ? 'class="current"' : 'style="display: none;"')?>>
                                        <?if(!$isEmpty){?>
                                            <a href="<?=($viewImgType=="POPUP" ? $arImage["BIG"]["src"] : "javascript:void(0)");?>" <?=($bIsOneImage ? '' : 'data-fancybox-group="item_slider"')?> class="<?=($viewImgType=="POPUP" ? "popup_link fancy" : "line_link");?>" title="<?=$title;?>">
                                                <img  src="<?=$arImage["SMALL"]["src"]?>" <?=($viewImgType=="MAGNIFIER" ? "class='zoom_picture'" : "");?> <?=($viewImgType=="MAGNIFIER" ? 'data-xoriginal="'.$arImage["BIG"]["src"].'" data-xpreview="'.$arImage["THUMB"]["src"].'"' : "");?> alt="<?=$alt;?>" title="<?=$title;?>"<?=(!$i ? ' itemprop="image"' : '')?>/>
                                                <div class="zoom"></div>
                                            </a>
                                        <?}else{?>
                                            <img  src="<?=$arImage["SRC"]?>" alt="<?=$alt;?>" title="<?=$title;?>" />
                                        <?}?>
                                    </li>
                                <?}?>
                            </ul>
                            <?if($countThumb > 1):?>
                                <ul class="flex-direction-nav"><li class="flex-nav-prev"><span class="flex-prev">Previous</span></li><li class="flex-nav-next"><span class="flex-next">Next</span></li></ul>
                            <?endif;?>
                        <?}
                    }?>
                </div>
                <?/*thumbs*/?>
                <?if(!$showCustomOffer || empty($arResult['OFFERS_PROP'])){
                if($countThumb > 1 || $arResult['PROPERTIES']['POPUP_VIDEO']['VALUE']):?>
                    <div class="wrapp_thumbs xzoom-thumbs top-small-wrapper test">
                        <?if($countThumb > 1):?>
                            <div class="thumbs bxSlider">
                                <div class="inner_slider">
                                    <ul class="slides_block" id="thumbs">
                                        <?foreach($arResult["MORE_PHOTO"]as $i => $arImage):?>
                                            <li <?=(!$i ? 'class="current"' : '')?> data-slide_key="<?=$i;?>" data-big_img="<?=$arImage["BIG"]["src"]?>" data-small_img="<?=$arImage["SMALL"]["src"]?>">
                                                <span><img class="xzoom-gallery" data-xpreview="<?=$arImage["THUMB"]["src"];?>" src="<?=$arImage["THUMB"]["src"]?>" alt="<?=$arImage["ALT"];?>" title="<?=$arImage["TITLE"];?>" /></span>
                                            </li>
                                        <?endforeach;?>
                                    </ul>
                                </div>
                                <span class="thumbs_navigation bx-controls-direction"><span class="slide-prev"></span><span class="slide-next"></span></span>
                            </div>
                        <?endif;?>
                        <?if($arResult['PROPERTIES']['POPUP_VIDEO']['VALUE']):?>
                            <div class="popup_video <?=($countThumb > 5 ? 'fromtop' : '');?>"><a class="various video_link" href="<?=$arResult['PROPERTIES']['POPUP_VIDEO']['VALUE'];?>"><?=GetMessage("VIDEO")?></a></div>
                        <?endif;?>
                    </div>
                    <script>
                        $(document).ready(function(){
                            $('.item_slider .thumbs li').first().addClass('current');
                            $('.item_slider .thumbs .slides_block').delegate('li:not(.current)', 'click', function(){console.log('test');
                                var slider_wrapper = $(this).parents('.item_slider'),
                                    index = $(this).data('slide_key');
                                $(this).addClass('current').siblings().removeClass('current')
                                $(this).siblings('[data-slide_key='+index+']').addClass('current')//.parents('.item_slider').find('.slides li').fadeOut(333);
                                if(arNextOptions['THEME']['DETAIL_PICTURE_MODE'] == 'MAGNIFIER')
                                {
                                    var li = $(this).parents('.item_slider').find('.slides li');
                                    li.find('img').attr('src', $(this).data('small_img'));
                                    li.find('img').attr('xoriginal', $(this).data('big_img'));
                                }
                                else
                                {
                                    slider_wrapper.find('.slides li').removeClass('current').hide();
                                    slider_wrapper.find('.slides li:eq('+index+')').addClass('current').show();
                                }
                            });
                            $('.bxSlider.thumbs .slides_block').bxSlider({
                                mode: 'vertical',
                                infiniteLoop: false,
                                minSlides: 5,
                                maxSlides: 5,
                                slideMargin: 10,
                                pager: false,
                                adaptiveHeight: false,
                                touchEnabled: false,
                                responsive: false,
                                nextSelector: '.bx-controls-direction .slide-next',
                                prevSelector: '.bx-controls-direction .slide-prev',
                                oneToOneTouch: false,
                                moveSlides: <?=($countThumb > 5 ? 1 : 0);?>,
                                preventDefaultSwipeY: true,
                                onSliderLoad: function(index)
                                {
                                    <?if($countThumb > 5):?>
                                    $(this).closest('.bx-viewport').addClass('long');
                                    $(this).closest('.bxSlider').find('.bx-controls-direction a').addClass('opacityv');
                                    <?endif;?>
                                    $('.top-small-wrapper li[data-slide_key="0"]').addClass('flex-active-slide');
                                }
                            })
                        })
                    </script>
                <?endif;?>
                <?}else{?>
                    <div class="wrapp_thumbs top-small-wrapper test2">
                        <div class="sliders">
                            <div class="thumbs bxSlider wof" style=""></div>
                        </div>
                    </div>
                <?}?>
                <div class="watched">
                    <p>
                        <svg id="Layer_2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                            <style>.eye{fill: #ffffff;stroke:#4c4e54;stroke-width:2.8346;stroke-miterlimit:10}</style>
                            <path class="eye" d="M68 38.8c-.1-.1-2.9-3.4-7.7-6.7-6.4-4.4-13.4-6.7-20.3-6.7s-13.8 2.3-20.3 6.7c-4.8 3.3-7.6 6.5-7.7 6.7L11 40l1 1.2c.1.1 2.9 3.4 7.7 6.7 6.4 4.4 13.4 6.7 20.3 6.7s13.8-2.3 20.3-6.7c4.8-3.3 7.6-6.5 7.7-6.7l1-1.2-1-1.2z" fill="#ffffff"/>
                            <path class="eye" d="M40 25.5c-8 0-14.5 6.5-14.5 14.5S32 54.5 40 54.5 54.5 48 54.5 40 48 25.5 40 25.5z"/>
                            <path d="M40 33c-3.9 0-7 3.1-7 7s3.1 7 7 7 7-3.1 7-7-3.1-7-7-7z" fill="#4c4e54"/>
                        </svg>
                        Сейчас смотрят - <span>5</span> человек</p>
                    <p>Всего смотрели - <span>210</span> человек</p>
                </div>
            </div>
            <?/*mobile*/?>
            <?if(!$showCustomOffer || empty($arResult['OFFERS_PROP'])){?>
                <div class="item_slider flex flexslider color-controls" data-plugin-options='{"animation": "slide", "directionNav": false, "controlNav": true, "animationLoop": false, "slideshow": false, "slideshowSpeed": 10000, "animationSpeed": 600'>
                    <ul class="slides">
                        <?if($arResult["MORE_PHOTO"]){
                            foreach($arResult["MORE_PHOTO"] as $i => $arImage){?>
                                <?$isEmpty=($arImage["SMALL"]["src"] ? false : true );?>
                                <li id="mphoto-<?=$i?>" <?=(!$i ? 'class="current"' : 'style="display: none;"')?>>
                                    <?
                                    $alt=$arImage["ALT"];
                                    $title=$arImage["TITLE"];
                                    ?>
                                    <?if(!$isEmpty){?>
                                        <a href="<?=$arImage["BIG"]["src"]?>" data-fancybox-group="item_slider_flex" class="fancy popup_link" title="<?=$title;?>" >
                                            <img src="<?=$arImage["SMALL"]["src"]?>" alt="<?=$alt;?>" title="<?=$title;?>" />
                                            <div class="zoom"></div>
                                        </a>
                                    <?}else{?>
                                        <img  src="<?=$arImage["SRC"];?>" alt="<?=$alt;?>" title="<?=$title;?>" />
                                    <?}?>
                                </li>
                            <?}
                        }?>
                    </ul>
                </div>
            <?}else{?>
                <div class="item_slider flex color-controls"></div>
            <?}?>
        </div>
    </div>

	<div class="col-md-4 right_info">
		<div class="info_item">

			<div class="middle_info main_item_wrapper">
			<?$frame = $this->createFrame()->begin();?>

			    <div class="row">
				    <div class="col-md-12 left-info">



                        <div class="prices_block">

                            <!--ЦЕНА И СКИДКА-->
                            <div class="cost-block">
                                <div class="cost prices clearfix">
                                    <?if( count( $arResult["OFFERS"] ) > 0 ){?>
                                        <div class="with_matrix" style="display:none;">
                                            <div class="price price_value_block"><span class="values_wrapper"></span></div>
                                            <?if($arParams["SHOW_OLD_PRICE"]=="Y"):?>
                                                <div class="price discount"></div>
                                            <?endif;?>
                                            <?if($arParams["SHOW_DISCOUNT_PERCENT"]=="Y"){?>
                                                <div class="sale_block matrix" style="display:none;">
                                                    <div class="sale_wrapper">
                                                        <?if($arParams["SHOW_DISCOUNT_PERCENT_NUMBER"] != "Y"):?>
                                                            <span class="title"><?=GetMessage("CATALOG_ECONOMY");?></span>
                                                            <div class="text"><span class="values_wrapper"></span></div>
                                                        <?else:?>
                                                            <div class="text">
                                                                <span class="title"><?=GetMessage("CATALOG_ECONOMY");?></span>
                                                                <span class="values_wrapper"></span>
                                                            </div>
                                                        <?endif;?>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            <?}?>
                                        </div>
                                        <?\Aspro\Functions\CAsproSku::showItemPrices($arParams, $arResult, $item_id, $min_price_id, $arItemIDs, ($arParams["SHOW_DISCOUNT_PERCENT_NUMBER"] == "Y" ? "N" : "Y"));?>
                                    <?}else{?>
                                        <?
                                        $item_id = $arResult["ID"];
                                        //print_r($arResult);
                                        if(isset($arResult['PRICE_MATRIX']) && $arResult['PRICE_MATRIX']) // USE_PRICE_COUNT
                                        {
                                            if($arResult['PRICE_MATRIX']['COLS'])
                                            {
                                                $arCurPriceType = current($arResult['PRICE_MATRIX']['COLS']);
                                                $arCurPrice = current($arResult['PRICE_MATRIX']['MATRIX'][$arCurPriceType['ID']]);
                                                $min_price_id = $arCurPriceType['ID'];?>
                                                <div class="" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                                    <meta itemprop="price" content="<?=($arResult['MIN_PRICE']['DISCOUNT_VALUE'] ? $arResult['MIN_PRICE']['DISCOUNT_VALUE'] : $arResult['MIN_PRICE']['VALUE'])?>" />
                                                    <meta itemprop="priceCurrency" content="<?=$arResult['MIN_PRICE']['CURRENCY']?>" />
                                                    <link itemprop="availability" href="http://schema.org/<?=($arResult['PRICE_MATRIX']['AVAILABLE'] == 'Y' ? 'InStock' : 'OutOfStock')?>" />
                                                </div>
                                            <?}?>
                                            <?if($arResult['ITEM_PRICE_MODE'] == 'Q' && count($arResult['PRICE_MATRIX']['ROWS']) > 1):?>
                                            <?=CNextB2c::showPriceRangeTop($arResult, $arParams, GetMessage("CATALOG_ECONOMY"));?>
                                        <?endif;?>
                                            <?=CNextB2c::showPriceMatrix($arResult, $arParams, $strMeasure, $arAddToBasketData);?>
                                            <?
                                        }
                                        else
                                        {?>
                                            <?\Aspro\Functions\CAsproItem::showItemPrices($arParams, $arResult["PRICES"], $strMeasure, $min_price_id, ($arParams["SHOW_DISCOUNT_PERCENT_NUMBER"] == "Y" ? "N" : "Y"));?>
                                        <?}?>
                                    <?}?>
                                </div>

                                <?if($arParams["SHOW_CHEAPER_FORM"] == "Y"):?>
                                    <div class="cheaper_form">
                                        <span class="animate-load" data-event="jqm" data-param-form_id="CHEAPER" data-name="cheaper" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>"><?=($arParams["CHEAPER_FORM_NAME"] ? $arParams["CHEAPER_FORM_NAME"] : GetMessage("CHEAPER"));?></span>
                                    </div>
                                <?endif;?>
                            </div>



                            <!--КОЛИЧЕСТВО-->
                            <div class="quantity_block_wrapper">


                                <?if($useStores){?>
                                    <div class="p_block">
                                <?}?>

                                        <span class="animate-load" data-event="jqm" data-param-form_id="FAST_PRODUCT" data-name="FAST_PRODUCT" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>"><?=$arQuantityData["HTML"];?>Нужно быстрее?</span>
                                <?if($useStores){?>
                                    </div>
                                <?}?>

                            </div>


                            <!--СЧЕТЧИК-->
                            <?if($arParams["SHOW_DISCOUNT_TIME"]=="Y"){?>
                                <?$arUserGroups = $USER->GetUserGroupArray();?>
                                <?if($arParams['SHOW_DISCOUNT_TIME_EACH_SKU'] != 'Y' || ($arParams['SHOW_DISCOUNT_TIME_EACH_SKU'] == 'Y' && (!$arResult['OFFERS'] || ($arResult['OFFERS'] && $arParams['TYPE_SKU'] != 'TYPE_1')))):?>
                                    <?$arDiscounts = CCatalogDiscount::GetDiscountByProduct($item_id, $arUserGroups, "N", $min_price_id, SITE_ID);
                                    $arDiscount=array();
                                    if($arDiscounts)
                                        $arDiscount=current($arDiscounts);
                                    if($arDiscount["ACTIVE_TO"]){?>
                                        <div class="view_sale_block <?=($arQuantityData["HTML"] ? '' : 'wq');?>">
                                            <div class="count_d_block">
                                                <span class="active_to hidden"><?=$arDiscount["ACTIVE_TO"];?></span>
                                                <div class="title"><?=GetMessage("UNTIL_AKC");?></div>
                                                <span class="countdown values"><span class="item"></span><span class="item"></span><span class="item"></span><span class="item"></span></span>
                                            </div>
                                            <?if($arQuantityData["HTML"]):?>
                                                <div class="quantity_block">
                                                    <div class="title"><?=GetMessage("TITLE_QUANTITY_BLOCK");?></div>
                                                    <div class="values">
                                                        <span class="item">
                                                            <span class="value" <?=((count( $arResult["OFFERS"] ) > 0 && $arParams["TYPE_SKU"] == 'TYPE_1' && $arResult["OFFERS_PROP"]) ? 'style="opacity:0;"' : '')?>><?=$totalCount;?></span>
                                                            <span class="text"><?=GetMessage("TITLE_QUANTITY");?></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            <?endif;?>
                                        </div>
                                    <?}?>
                                <?else:?>
                                    <?if($arResult['JS_OFFERS'])
                                    {

                                        foreach($arResult['JS_OFFERS'] as $keyOffer => $arTmpOffer2)
                                        {
                                            $active_to = '';
                                            $arDiscounts = CCatalogDiscount::GetDiscountByProduct( $arTmpOffer2['ID'], $arUserGroups, "N", array(), SITE_ID );
                                            if($arDiscounts)
                                            {
                                                foreach($arDiscounts as $arDiscountOffer)
                                                {
                                                    if($arDiscountOffer['ACTIVE_TO'])
                                                    {
                                                        $active_to = $arDiscountOffer['ACTIVE_TO'];
                                                        break;
                                                    }
                                                }
                                            }
                                            $arResult['JS_OFFERS'][$keyOffer]['DISCOUNT_ACTIVE'] = $active_to;
                                        }
                                    }?>
                                    <div class="view_sale_block" style="display:none;">
                                        <div class="count_d_block">
                                                <span class="active_to_<?=$arResult["ID"]?> hidden"><?=$arDiscount["ACTIVE_TO"];?></span>
                                                <div class="title"><?=GetMessage("UNTIL_AKC");?></div>
                                                <span class="countdown countdown_<?=$arResult["ID"]?> values"></span>
                                        </div>
                                        <?if($arQuantityData["HTML"]):?>
                                            <div class="quantity_block">
                                                <div class="title"><?=GetMessage("TITLE_QUANTITY_BLOCK");?></div>
                                                <div class="values">
                                                    <span class="item">
                                                        <span class="value"><?=$totalCount;?></span>
                                                        <span class="text"><?=GetMessage("TITLE_QUANTITY");?></span>
                                                    </span>
                                                </div>
                                            </div>
                                        <?endif;?>
                                    </div>
                                <?endif;?>
                            <?}?>



                            <!--КНОПКИ-->
                            <?if($arResult['VISIBLE_PROPS']):?>
                            <?$iCountProps = count($arResult['VISIBLE_PROPS']);?>
                            <?if($arResult["SIZE_PATH"]):?>
                                    <div class="table_sizes">
                                        <span><span class="animate-load link" data-event="jqm" data-param-form_id="TABLES_SIZE" data-param-url="<?=$arResult["SIZE_PATH"];?>" data-name="TABLES_SIZE"><?=GetMessage("TABLES_SIZE");?></span></span>
                                    </div>
                                <?endif;?>
                                <?if(!$arResult["OFFERS"]):?>
                                    <script>
                                        $(document).ready(function() {
                                            $('.catalog_detail input[data-sid="PRODUCT_NAME"]').attr('value', $('h1').text());
                                        });
                                    </script>
                                    <div class="counter_wrapp">
                                        <?if(($arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_DETAIL"] && $arAddToBasketData["ACTION"] == "ADD") && $arAddToBasketData["CAN_BUY"]):?>
                                            <div class="counter_block big_basket" data-offers="<?=($arResult["OFFERS"] ? "Y" : "N");?>" data-item="<?=$arResult["ID"];?>" <?=(($arResult["OFFERS"] && $arParams["TYPE_SKU"]=="N") ? "style='display: none;'" : "");?>>
                                                <span class="minus" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_DOWN']; ?>">-</span>
                                                <input type="text" class="text" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY']; ?>" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>" value="<?=$arAddToBasketData["MIN_QUANTITY_BUY"]?>" />
                                                <span class="plus" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_UP']; ?>" <?=($arAddToBasketData["MAX_QUANTITY_BUY"] ? "data-max='".$arAddToBasketData["MAX_QUANTITY_BUY"]."'" : "")?>>+</span>
                                            </div>
                                        <?endif;?>
                                        <div id="<? echo $arItemIDs["ALL_ITEM_IDS"]['BASKET_ACTIONS']; ?>" class="button_block <?=(($arAddToBasketData["ACTION"] == "ORDER" /*&& !$arResult["CAN_BUY"]*/) || !$arAddToBasketData["CAN_BUY"] || !$arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_DETAIL"] || ($arAddToBasketData["ACTION"] == "SUBSCRIBE" && $arResult["CATALOG_SUBSCRIBE"] == "Y")  ? "wide" : "");?>">
                                            <!--noindex-->
                                                <?=$arAddToBasketData["HTML"]?>
                                            <!--/noindex-->
                                        </div>
                                    </div>

                                    <?if(isset($arResult['PRICE_MATRIX']) && $arResult['PRICE_MATRIX']) // USE_PRICE_COUNT
                                    {?>
                                        <?if($arResult['ITEM_PRICE_MODE'] == 'Q' && count($arResult['PRICE_MATRIX']['ROWS']) > 1):?>
                                            <?$arOnlyItemJSParams = array(
                                                "ITEM_PRICES" => $arResult["ITEM_PRICES"],
                                                "ITEM_PRICE_MODE" => $arResult["ITEM_PRICE_MODE"],
                                                "ITEM_QUANTITY_RANGES" => $arResult["ITEM_QUANTITY_RANGES"],
                                                "MIN_QUANTITY_BUY" => $arAddToBasketData["MIN_QUANTITY_BUY"],
                                                "SHOW_DISCOUNT_PERCENT_NUMBER" => $arParams["SHOW_DISCOUNT_PERCENT_NUMBER"],
                                                "ID" => $arItemIDs["strMainID"],
                                            )?>
                                            <script type="text/javascript">
                                                var <? echo $arItemIDs["strObName"]; ?>el = new JCCatalogOnlyElement(<? echo CUtil::PhpToJSObject($arOnlyItemJSParams, false, true); ?>);
                                            </script>
                                        <?endif;?>
                                    <?}?>

                                    <?if($arAddToBasketData["ACTION"] !== "NOTHING"):?>
                                        <?if($arAddToBasketData["ACTION"] == "ADD" && $arAddToBasketData["CAN_BUY"] && $arParams["SHOW_ONE_CLICK_BUY"]!="N"):?>
                                            <div class="wrapp_one_click">
                                                <span class="btn btn-default white btn-lg type_block transition_bg one_click" data-item="<?=$arResult["ID"]?>" data-iblockID="<?=$arParams["IBLOCK_ID"]?>" data-quantity="<?=$arAddToBasketData["MIN_QUANTITY_BUY"];?>" onclick="oneClickBuy('<?=$arResult["ID"]?>', '<?=$arParams["IBLOCK_ID"]?>', this)">
                                                    <span><?=GetMessage('ONE_CLICK_BUY')?></span>
                                                </span>
                                            </div>
                                        <?endif;?>
                                    <?endif;?>
                                <?elseif($arResult["OFFERS"] && $arParams['TYPE_SKU'] == 'TYPE_1'):?>
                                    <div class="offer_buy_block buys_wrapp" style="display:none;">
                                        <div class="counter_wrapp"></div>


                                        <span class="animate-load more-quantity" data-event="jqm" data-param-form_id="MORE_QUANTITY" data-name="MORE_QUANTITY" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Нужно большое количество?</span>



                                    </div>
                                <?elseif($arResult["OFFERS"] && $arParams['TYPE_SKU'] != 'TYPE_1'):?>
                                    <span class="btn btn-default btn-lg slide_offer transition_bg type_block"><i></i><span><?=\Bitrix\Main\Config\Option::get('aspro.next', "EXPRESSION_READ_MORE_OFFERS_DEFAULT", GetMessage("MORE_TEXT_BOTTOM"));?></span></span>
                                <?endif;?>
                                <?endif;?>
                        </div>



                        <div class="buy_block">
                            <?if($arResult["OFFERS"] && $showCustomOffer){?>
                                <div class="sku_props">
                                    <?if (!empty($arResult['OFFERS_PROP'])){?>
                                        <div class="bx_catalog_item_scu wrapper_sku" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PROP_DIV']; ?>">
                                            <?foreach ($arSkuTemplate as $code => $strTemplate){
                                                if (!isset($arResult['OFFERS_PROP'][$code]))
                                                    continue;
                                                echo str_replace('#ITEM#_prop_', $arItemIDs["ALL_ITEM_IDS"]['PROP'], $strTemplate);
                                            }?>
                                        </div>
                                    <?}?>
                                    <?$arItemJSParams=CNextB2c::GetSKUJSParams($arResult, $arParams, $arResult, "Y");?>
                                    <script type="text/javascript">
                                        var <? echo $arItemIDs["strObName"]; ?> = new JCCatalogElement(<? echo CUtil::PhpToJSObject($arItemJSParams, false, true); ?>);
                                    </script>
                                </div>
                            <?}?>
                        </div>


                    </div>



						<div class="col-md-12 right-info">
                        <?if(is_array($arResult["STOCK"]) && $arResult["STOCK"]):?>
                            <div class="stock_wrapper">
                                <?foreach($arResult["STOCK"] as $key => $arStockItem):?>
                                    <div class="stock_board <?=($arStockItem["PREVIEW_TEXT"] ? '' : 'nt');?>">
                                        <div class="title"><a class="dark_link" href="<?=$arStockItem["DETAIL_PAGE_URL"]?>"><?=$arStockItem["NAME"];?></a></div>
                                        <div class="txt"><?=$arStockItem["PREVIEW_TEXT"]?></div>
                                    </div>
                                <?endforeach;?>
                            </div>
			               <?endif;?>
                        <?if($arResult['VISIBLE_PROPS']):?>
						<?$iCountProps = count($arResult['VISIBLE_PROPS']);?>
							<?$bShowMoreLink = ($iCountProps > $arParams['VISIBLE_PROP_COUNT']);?>
							<div class="top_props desktop-props">
								<div class="title"><?=($arParams["TAB_CHAR_NAME"] ? $arParams["TAB_CHAR_NAME"] : GetMessage("PROPERTIES_TAB"));?></div>
								<div class="props props_list">
									<?if(!$bShowMoreLink):?>
										<div class="inner_props">
									<?endif;?>
										<?$j=0;?>
										<?foreach($arResult["VISIBLE_PROPS"] as $arProp):?>
											<?if($j<$arParams['VISIBLE_PROP_COUNT']):?>
												<div class="prop" <?if($iCountProps <= $arParams['VISIBLE_PROP_COUNT']):?> itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue" <?endif;?>>
													<div class="name">
														<div class="char_name">
															<?if($arProp["HINT"] && $arParams["SHOW_HINTS"]=="Y"):?><div class="hint"><span class="icon"><i>?</i></span><div class="tooltip"><?=$arProp["HINT"]?></div></div><?endif;?>
															<div class="props_item <?if($arProp["HINT"] && $arParams["SHOW_HINTS"] == "Y"){?>whint<?}?>">
																<span <?if($iCountProps <= $arParams['VISIBLE_PROP_COUNT']):?> itemprop="name" <?endif;?>><?=$arProp["NAME"]?></span>
															</div>
														</div>
													</div>
													<div class="value">
														<div class="char_value" <?if($iCountProps <= $arParams['VISIBLE_PROP_COUNT']):?> itemprop="value" <?endif;?>>
															<?if(count($arProp["DISPLAY_VALUE"]) > 1):?>
																<?=implode(', ', $arProp["DISPLAY_VALUE"]);?>
															<?else:?>
																<?=$arProp["DISPLAY_VALUE"];?>
															<?endif;?>
														</div>
													</div>
												</div>
											<?endif;?>
											<?$j++;?>
										<?endforeach;?>
									<?if($bShowMoreLink):?>
										<div class=""><span class="choise colored" data-block=".char_inner_wrapper">Все характеристики<?/*=GetMessage('ALL_CHARS');*/?></span></div>
									<?else:?>
										</div>
									<?endif;?>
								</div>
							</div>
							<?endif;?>

                            <!--характеристики-->
                            <div class="top_props mobile-props">
                                <div class="props props_list">
                                    <span class="view_all_char">Все характеристики</span>
                                    <div class="inner_props">
                                        <?foreach($arResult["VISIBLE_PROPS"] as $arProp):?>
                                            <div class="prop" <?if($iCountProps <= $arParams['VISIBLE_PROP_COUNT']):?> itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue" <?endif;?>>
                                                <div class="name">
                                                    <div class="char_name">
                                                        <?if($arProp["HINT"] && $arParams["SHOW_HINTS"]=="Y"):?><div class="hint"><span class="icon"><i>?</i></span><div class="tooltip"><?=$arProp["HINT"]?></div></div><?endif;?>
                                                        <div class="props_item <?if($arProp["HINT"] && $arParams["SHOW_HINTS"] == "Y"){?>whint<?}?>">
                                                            <span <?if($iCountProps <= $arParams['VISIBLE_PROP_COUNT']):?> itemprop="name" <?endif;?>><?=$arProp["NAME"]?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="value">
                                                    <div class="char_value" <?if($iCountProps <= $arParams['VISIBLE_PROP_COUNT']):?> itemprop="value" <?endif;?>>
                                                        <?if(count($arProp["DISPLAY_VALUE"]) > 1):?>
                                                            <?=implode(', ', $arProp["DISPLAY_VALUE"]);?>
                                                        <?else:?>
                                                            <?=$arProp["DISPLAY_VALUE"];?>
                                                        <?endif;?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?endforeach;?>
                                    </div>

                                </div>
                            </div>
                            <!---->


                            <!--схема-->
                            <?if($arResult['PROPERTIES']['PRODUCT_SCHEME']['VALUE']):?>
                                <div class="product_scheme">
                                    <img src="<?=CFile::GetPath($arResult['PROPERTIES']['PRODUCT_SCHEME']['VALUE'])?>" alt="product scheme defo.ru" class="product_scheme__img">
                                </div>
                            <?endif;?>
                            <!---->


                            <?if($arParams['SHOW_GARANTY'] == 'Y'):?>
                                <div class="info_ext_block">
                                    <div class="title"><?=$arParams['TITLE_GARANTY'];?></div>
                                    <div class="text">
                                        <?$APPLICATION->IncludeFile(SITE_DIR."include/element_detail_garanty.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('CT_BCE_CATALOG_DOP_GARANTY')));?>
                                    </div>
                                </div>
                            <?endif;?>



                            <!--Табы-->
                            <div class="tabs-block">

                                <div class="tabs-item">
                                    <a href="javascript:;" class="active">Доставка</a>
                                    <a href="javascript:;">Сборка</a>
                                    <a href="javascript:;">Вывоз упаковки</a>
                                    <a href="javascript:;">Гарантия</a>
                                </div>
                                <div class="tabs-content">
                                    <div class="item active">
                                        <!--БЛОК ДОСТАВКИ-->
                                        <div class="product_delivery">
                                            <span class="choise" data-block=".stores-block">

                                                <div class="delivery_icon">
                                                    <img src="<?SITE_DIR?>/images/delivery1.svg" alt="">
                                                </div>
                                                <span class="gray-text">Доставка</span>
                                                <span class="black-text">от 750р</span>
                                                <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                            </span>

                                            <span class="choise" data-block=".stores-block">
                                                <div class="delivery_icon">
                                                    <img src="<?SITE_DIR?>/images/delivery2.svg" alt="">
                                                </div>
                                                <span class="gray-text">Самовывоз</span>
                                                <span class="black-text">из 2 пунктов</span>
                                                <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                            </span>

                                            <span class="choise" data-block=".stores-block">
                                                <div class="delivery_icon">
                                                    <img src="<?SITE_DIR?>/images/delivery3.svg" alt="">
                                                </div>
                                                <span class="gray-text">На витрине</span>
                                                <span class="black-text">в 7 салонах</span>
                                            </span>
                                            <div class="cheaper_form">
                                                <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="<?=CNext::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>"><?= 'Нужно быстрее?'/*($arParams["CHEAPER_FORM_NAME"] ? $arParams["CHEAPER_FORM_NAME"] : GetMessage("CHEAPER"));*/?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <!--СБОРКА-->
                                        <ul>
                                            <li>Быстро и профессионально</li>
                                            <li>Грамотная реализация дизайн-проекта</li>
                                            <li>Полное соблюдение технологии</li>
                                        </ul>
                                        <a class="help_me animated-load" data-event="jqm" data-param-form_id="ASK" data-name="question">Получить консультацию</a>
                                        <a href="/services/sborka/">Детальная информация</a>
                                    </div>
                                    <div class="item">
                                        <!--ВЫВОЗ УПАКОВКИ-->
                                        <ul>
                                            <li>Экономия сил и времени</li>
                                            <li>Утилизация упаковки</li>
                                            <li>Чистота окружающего пространства</li>
                                        </ul>
                                        <a class="help_me animated-load" data-event="jqm" data-param-form_id="ASK" data-name="question">Получить консультацию</a>
                                        <a href="/services/vyvoz-musora/">Детальная информация</a>
                                    </div>
                                    <div class="item">
                                        <!--ГАРАНТИЯ-->
                                        <ul>
                                            <li>Квалифицированные специалисты</li>
                                            <li>Оперативность гарантийных работ</li>
                                            <li>Косметический ремонт мебели</li>
                                            <li>Замена деталей и фурнитуры</li>
                                            <li>Выезд мастера на дом для ремонта</li>
                                            <li>Возврат денежных средств</li>
                                        </ul>
                                        <a class="help_me animated-load" data-event="jqm" data-param-form_id="ASK" data-name="question">Получить консультацию</a>
                                        <a href="/services/dostavka/">Детальная информация</a>

                                    </div>
                                </div>
                            </div>
                            <!---->
                            <!--3D-расстановка-->
                            <div class="arrangement-block">
                                <a href="javascript:;" target="_blank">Посмотреть в планировщике</a>
                            </div>
                        </div>
                </div>

                <div class="row">
                    <?if($arTmpModif["CHILDREN"]){?>
                    <div class="col-md-8">
                        <div class="modification">
                            <div class="wraps hidden_print addon_type">

                                <h4><?=($arParams["DETAIL_MODIFICATIONS_TITLE"] ? $arParams["DETAIL_MODIFICATIONS_TITLE"] : GetMessage("DETAIL_MODIFICATIONS_TITLE"))?></h4>
                                <div class="bottom_slider specials tab_slider_wrapp custom_type">
                                    <ul class="slider_navigation top custom_flex border">
                                        <li class="tabs_slider_navigation modif_nav cur" data-code="access"></li>
                                    </ul>

                                    <ul class="tabs_goods">
                                        <li class="tab access_wrapp" data-code="access">
                                            <div class="catalog-detail-slider-modif">
                                                <!--<ul class="tabs_slider access_slides slides">-->
                                                <?$APPLICATION->IncludeComponent(
                                                    "bitrix:catalog.top",
                                                    "main_custom",
                                                    array(
                                                        "USE_REGION" => ($arRegion ? "Y" : "N"),
                                                        "STORES" => $arParams['STORES'],
                                                        "TITLE_BLOCK" => $arParams["SECTION_TOP_BLOCK_TITLE"],
                                                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                                        "SALE_STIKER" => $arParams["SALE_STIKER"],
                                                        "STIKERS_PROP" => $arParams["STIKERS_PROP"],
                                                        "SHOW_RATING" => $arParams["SHOW_RATING"],
                                                        "FILTER_NAME" => 'arrFilterAccess',
                                                        "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                                                        "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                                                        "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                                                        "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                                                        "CUSTOM_FILTER" => $arResult['PROPERTIES']['MODIFICATIONS_FILTER']['~VALUE'],
                                                        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                                        "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                                                        "BASKET_URL" => $arParams["BASKET_URL"],
                                                        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                                                        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                                                        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                                                        "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                                                        "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                                                        "DISPLAY_COMPARE" => ($arParams["DISPLAY_COMPARE"] ? "Y" : "N"),
                                                        "DISPLAY_WISH_BUTTONS" => $arParams["DISPLAY_WISH_BUTTONS"],
                                                        "ELEMENT_COUNT" => 5,
                                                        "SHOW_MEASURE_WITH_RATIO" => $arParams["SHOW_MEASURE_WITH_RATIO"],
                                                        "SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
                                                        "LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
                                                        "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
                                                        "PRICE_CODE" => $arParams['PRICE_CODE'],
                                                        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                                                        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                                                        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                                                        "PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
                                                        "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                                                        "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                                                        "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                                                        "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
                                                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                                                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                                        "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                                                        "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                                                        "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                                                        "OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],
                                                        "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                                                        "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                                                        "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                                                        "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                                                        "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],
                                                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                                                        'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
                                                        'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
                                                        'VIEW_MODE' => (isset($arParams['TOP_VIEW_MODE']) ? $arParams['TOP_VIEW_MODE'] : ''),
                                                        'ROTATE_TIMER' => (isset($arParams['TOP_ROTATE_TIMER']) ? $arParams['TOP_ROTATE_TIMER'] : ''),
                                                        'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                                                        'LABEL_PROP' => $arParams['LABEL_PROP'],
                                                        'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                                                        'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

                                                        'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                                                        'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                                                        'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                                                        'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                                                        'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                                                        'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                                                        'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
                                                        'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
                                                        'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
                                                        'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
                                                        'ADD_TO_BASKET_ACTION' => $basketAction,
                                                        'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                                                        'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                                                    ),
                                                    false, array("HIDE_ICONS"=>"Y")
                                                );?>
                                                <!--</ul>-->
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                    </div>
                    <?}?>

                </div>

                <div class="sale-banner">
                    <a href="" class="animated-load" data-event="jqm" data-param-form_id="COMMERCIAL_OFFER" data-name="question">
                        <p>Предоставляем скидки для<br>больших партий товара</p>
                        <span>Индивидуальное предложение</span>
                    </a>
                </div>








			<?$frame->end();?>
			</div>

			<!--<div class="element_detail_text wrap_md">
				<div class="price_txt">
					<div class="sharing">
						<div class="">
							<?/*$APPLICATION->IncludeFile(SITE_DIR."include/share_buttons.php", Array(), Array("MODE" => "html", "NAME" => GetMessage('CT_BCE_CATALOG_SOC_BUTTON')));*/?>
						</div>
					</div>
					<div class="text">
						<?/*$APPLICATION->IncludeFile(SITE_DIR."include/element_detail_text.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('CT_BCE_CATALOG_DOP_DESCR')));*/?>
					</div>
				</div>
			</div>-->
		</div>
	</div>
	<?$bPriceCount = ($arParams['USE_PRICE_COUNT'] == 'Y');?>
	<?if($arResult['OFFERS']):?>
		<span itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer" style="display:none;">
			<meta itemprop="offerCount" content="<?=count($arResult['OFFERS'])?>" />
			<meta itemprop="lowPrice" content="<?=($arResult['MIN_PRICE']['DISCOUNT_VALUE'] ? $arResult['MIN_PRICE']['DISCOUNT_VALUE'] : $arResult['MIN_PRICE']['VALUE'] )?>" />
			<meta itemprop="priceCurrency" content="<?=$arResult['MIN_PRICE']['CURRENCY']?>" />
			<?foreach($arResult['OFFERS'] as $arOffer):?>
				<?$currentOffersList = array();?>
				<?foreach($arOffer['TREE'] as $propName => $skuId):?>
					<?$propId = (int)substr($propName, 5);?>
					<?foreach($arResult['SKU_PROPS'] as $prop):?>
						<?if($prop['ID'] == $propId):?>
							<?foreach($prop['VALUES'] as $propId => $propValue):?>
								<?if($propId == $skuId):?>
									<?$currentOffersList[] = $propValue['NAME'];?>
									<?break;?>
								<?endif;?>
							<?endforeach;?>
						<?endif;?>
					<?endforeach;?>
				<?endforeach;?>
				<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
					<meta itemprop="sku" content="<?=implode('/', $currentOffersList)?>" />
					<a href="<?=$arOffer['DETAIL_PAGE_URL']?>" itemprop="url"></a>
					<meta itemprop="price" content="<?=($arOffer['MIN_PRICE']['DISCOUNT_VALUE']) ? $arOffer['MIN_PRICE']['DISCOUNT_VALUE'] : $arOffer['MIN_PRICE']['VALUE']?>" />
					<meta itemprop="priceCurrency" content="<?=$arOffer['MIN_PRICE']['CURRENCY']?>" />
					<link itemprop="availability" href="http://schema.org/<?=($arOffer['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
				</span>
			<?endforeach;?>
		</span>
		<?unset($arOffer, $currentOffersList);?>
	<?else:?>
		<?if(!$bPriceCount):?>
			<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				<meta itemprop="price" content="<?=($arResult['MIN_PRICE']['DISCOUNT_VALUE'] ? $arResult['MIN_PRICE']['DISCOUNT_VALUE'] : $arResult['MIN_PRICE']['VALUE'])?>" />
				<meta itemprop="priceCurrency" content="<?=$arResult['MIN_PRICE']['CURRENCY']?>" />
				<link itemprop="availability" href="http://schema.org/<?=($arResult['MIN_PRICE']['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
			</span>
		<?endif;?>
	<?endif;?>
	<div class="clearleft"></div>


	<?if($arParams["SHOW_KIT_PARTS"] == "Y" && $arResult["SET_ITEMS"]):?>
		<div class="set_wrapp set_block">
			<div class="title"><?=GetMessage("GROUP_PARTS_TITLE")?></div>
			<ul>
				<?foreach($arResult["SET_ITEMS"] as $iii => $arSetItem):?>
					<li class="item">
						<div class="item_inner">
							<div class="image">
								<a href="<?=$arSetItem["DETAIL_PAGE_URL"]?>">
									<?if($arSetItem["PREVIEW_PICTURE"]):?>
										<?$img = CFile::ResizeImageGet($arSetItem["PREVIEW_PICTURE"], array("width" => 140, "height" => 140), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
										<img  src="<?=$img["src"]?>" alt="<?=$arSetItem["NAME"];?>" title="<?=$arSetItem["NAME"];?>" />
									<?elseif($arSetItem["DETAIL_PICTURE"]):?>
										<?$img = CFile::ResizeImageGet($arSetItem["DETAIL_PICTURE"], array("width" => 140, "height" => 140), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
										<img  src="<?=$img["src"]?>" alt="<?=$arSetItem["NAME"];?>" title="<?=$arSetItem["NAME"];?>" />
									<?else:?>
										<img  src="<?=SITE_TEMPLATE_PATH?>/images/no_photo_small.png" alt="<?=$arSetItem["NAME"];?>" title="<?=$arSetItem["NAME"];?>" />
									<?endif;?>
								</a>
								<?if($arResult["SET_ITEMS_QUANTITY"]):?>
									<div class="quantity">x<?=$arSetItem["QUANTITY"];?></div>
								<?endif;?>
							</div>
							<div class="item_info">
								<div class="item-title">
									<a href="<?=$arSetItem["DETAIL_PAGE_URL"]?>"><span><?=$arSetItem["NAME"]?></span></a>
								</div>
								<?if($arParams["SHOW_KIT_PARTS_PRICES"] == "Y"):?>
									<div class="cost prices clearfix">
										<?
										$arCountPricesCanAccess = 0;
										foreach($arSetItem["PRICES"] as $key => $arPrice){
											if($arPrice["CAN_ACCESS"]){
												$arCountPricesCanAccess++;
											}
										}?>
										<?foreach($arSetItem["PRICES"] as $key => $arPrice):?>
											<?if($arPrice["CAN_ACCESS"]):?>
												<?$price = CPrice::GetByID($arPrice["ID"]);?>
												<?if($arCountPricesCanAccess > 1):?>
													<div class="price_name"><?=$price["CATALOG_GROUP_NAME"];?></div>
												<?endif;?>
												<?if($arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"]  && $arParams["SHOW_OLD_PRICE"]=="Y"):?>
													<div class="price">
														<?=$arPrice["PRINT_DISCOUNT_VALUE"];?><?if(($arParams["SHOW_MEASURE"] == "Y") && $strMeasure):?><small>/<?=$strMeasure?></small><?endif;?>
													</div>
													<div class="price discount">
														<span><?=$arPrice["PRINT_VALUE"]?></span>
													</div>
												<?else:?>
													<div class="price">
														<?=$arPrice["PRINT_VALUE"];?><?if(($arParams["SHOW_MEASURE"] == "Y") && $strMeasure):?><small>/<?=$strMeasure?></small><?endif;?>
													</div>
												<?endif;?>
											<?endif;?>
										<?endforeach;?>
									</div>
								<?endif;?>
							</div>
						</div>
					</li>
					<?if($arResult["SET_ITEMS"][$iii + 1]):?>
						<li class="separator"></li>
					<?endif;?>
				<?endforeach;?>
			</ul>
		</div>
	<?endif;?>
	<?if($arResult['OFFERS']):?>
		<?if($arResult['OFFER_GROUP']):?>
			<?foreach($arResult['OFFERS'] as $arOffer):?>
				<?if(!$arOffer['OFFER_GROUP']) continue;?>
				<span id="<?=$arItemIDs['ALL_ITEM_IDS']['OFFER_GROUP'].$arOffer['ID']?>" style="display: none;">
					<?$APPLICATION->IncludeComponent("bitrix:catalog.set.constructor", "",
						array(
							"IBLOCK_ID" => $arResult["OFFERS_IBLOCK"],
							"ELEMENT_ID" => $arOffer['ID'],
							"PRICE_CODE" => $arParams["PRICE_CODE"],
							"BASKET_URL" => $arParams["BASKET_URL"],
							"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
							"CACHE_TYPE" => $arParams["CACHE_TYPE"],
							"CACHE_TIME" => $arParams["CACHE_TIME"],
							"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
							"BUNDLE_ITEMS_COUNT" => $arParams["BUNDLE_ITEMS_COUNT"],
							"SHOW_OLD_PRICE" => $arParams["SHOW_OLD_PRICE"],
							"SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
							"SHOW_DISCOUNT_PERCENT" => $arParams["SHOW_DISCOUNT_PERCENT"],
							"CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
							"CURRENCY_ID" => $arParams["CURRENCY_ID"]
						), $component, array("HIDE_ICONS" => "Y")
					);?>
				</span>
			<?endforeach;?>
		<?endif;?>
	<?else:?>
		<?$APPLICATION->IncludeComponent("bitrix:catalog.set.constructor", "",
			array(
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"ELEMENT_ID" => $arResult["ID"],
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"BUNDLE_ITEMS_COUNT" => $arParams["BUNDLE_ITEMS_COUNT"],
				"SHOW_OLD_PRICE" => $arParams["SHOW_OLD_PRICE"],
				"SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
				"SHOW_DISCOUNT_PERCENT" => $arParams["SHOW_DISCOUNT_PERCENT"],
				"CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
				"CURRENCY_ID" => $arParams["CURRENCY_ID"]
			), $component, array("HIDE_ICONS" => "Y")
		);?>
	<?endif;?>




</div>
<div class="tabs_section">
	<?if($arResult["OFFERS"] && $arParams["TYPE_SKU"]=="N"):?>
		<h4><?=($arParams["TAB_OFFERS_NAME"] ? $arParams["TAB_OFFERS_NAME"] : GetMessage("OFFER_PRICES"));?></h4>
		<?
		$showSkUName = ((in_array('NAME', $arParams['OFFERS_FIELD_CODE'])));
		$showSkUImages = false;
		if(((in_array('PREVIEW_PICTURE', $arParams['OFFERS_FIELD_CODE']) || in_array('DETAIL_PICTURE', $arParams['OFFERS_FIELD_CODE'])))){
			foreach ($arResult["OFFERS"] as $key => $arSKU){
				if($arSKU['PREVIEW_PICTURE'] || $arSKU['DETAIL_PICTURE']){
					$showSkUImages = true;
					break;
				}
			}
		}?>
		<?if($arResult["OFFERS"] && $arParams["TYPE_SKU"] !== "TYPE_1"):?>
			<script>
				$(document).ready(function() {
					$('.catalog_detail .tabs_section .tabs_content .form.inline input[data-sid="PRODUCT_NAME"]').attr('value', $('h1').text());
				});
			</script>
		<?endif;?>
		<?if($arResult["OFFERS"] && $arParams["TYPE_SKU"] !== "TYPE_1"):?>
			<div class="prices_tab">
				<div class="bx_sku_props" style="display:none;">
					<?$arSkuKeysProp='';
					$propSKU=$arParams["OFFERS_CART_PROPERTIES"];
					if($propSKU){
						$arSkuKeysProp=base64_encode(serialize(array_keys($propSKU)));
					}?>
					<input type="hidden" value="<?=$arSkuKeysProp;?>"></input>
				</div>
				<table class="offers_table">
					<thead>
						<tr>
							<?if($useStores):?>
								<td class="str"></td>
							<?endif;?>
							<?if($showSkUImages):?>
								<td class="property img" width="50"></td>
							<?endif;?>
							<?if($showSkUName):?>
								<td class="property names"><?=GetMessage("CATALOG_NAME")?></td>
							<?endif;?>
							<?if($arResult["SKU_PROPERTIES"]){
								foreach ($arResult["SKU_PROPERTIES"] as $key => $arProp){?>
									<?if(!$arProp["IS_EMPTY"]):?>
										<td class="property">
											<div class="props_item char_name <?if($arProp["HINT"] && $arParams["SHOW_HINTS"] == "Y"){?>whint<?}?>">
												<?if($arProp["HINT"] && $arParams["SHOW_HINTS"]=="Y"):?><div class="hint"><span class="icon"><i>?</i></span><div class="tooltip"><?=$arProp["HINT"]?></div></div><?endif;?>
												<span><?=$arProp["NAME"]?></span>
											</div>
										</td>
									<?endif;?>
								<?}
							}?>
							<td class="price_th"><?=GetMessage("CATALOG_PRICE")?></td>
							<?if($arQuantityData["RIGHTS"]["SHOW_QUANTITY"]):?>
								<td class="count_th"><?=GetMessage("AVAILABLE")?></td>
							<?endif;?>
							<?if($arParams["DISPLAY_WISH_BUTTONS"] != "N"  || $arParams["DISPLAY_COMPARE"] == "Y"):?>
								<td class="like_icons_th"></td>
							<?endif;?>
							<td colspan="3"></td>
						</tr>
					</thead>
					<tbody>
						<?$numProps = count($arResult["SKU_PROPERTIES"]);
						if($arResult["OFFERS"]){
							foreach ($arResult["OFFERS"] as $key => $arSKU){?>
								<?
								if($arResult["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"]){
									$sMeasure = $arResult["PROPERTIES"]["CML2_BASE_UNIT"]["VALUE"].".";
								}
								else{
									$sMeasure = GetMessage("MEASURE_DEFAULT").".";
								}
								$skutotalCount = CNextB2c::GetTotalCount($arSKU, $arParams);
								$arskuQuantityData = CNextB2c::GetQuantityArray($skutotalCount, array('quantity-wrapp', 'quantity-indicators'));
								$arSKU["IBLOCK_ID"]=$arResult["IBLOCK_ID"];
								$arSKU["IS_OFFER"]="Y";
								$arskuAddToBasketData = CNextB2c::GetAddToBasketArray($arSKU, $skutotalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, array(), 'small w_icons', $arParams);
								$arskuAddToBasketData["HTML"] = str_replace('data-item', 'data-props="'.$arOfferProps.'" data-item', $arskuAddToBasketData["HTML"]);
								?>
								<?$collspan = 1;?>
								<tr class="main_item_wrapper" id="<?=$this->GetEditAreaId($arSKU["ID"]);?>">
									<?if($useStores):?>
										<td class="opener top">
											<?$collspan++;?>
											<span class="opener_icon"><i></i></span>
										</td>
									<?endif;?>
									<?if($showSkUImages):?>
										<?$collspan++;?>
										<td class="property">
											<?
											$srcImgPreview = $srcImgDetail = false;
											$imgPreviewID = ($arResult['OFFERS'][$key]['PREVIEW_PICTURE'] ? (is_array($arResult['OFFERS'][$key]['PREVIEW_PICTURE']) ? $arResult['OFFERS'][$key]['PREVIEW_PICTURE']['ID'] : $arResult['OFFERS'][$key]['PREVIEW_PICTURE']) : false);
											$imgDetailID = ($arResult['OFFERS'][$key]['DETAIL_PICTURE'] ? (is_array($arResult['OFFERS'][$key]['DETAIL_PICTURE']) ? $arResult['OFFERS'][$key]['DETAIL_PICTURE']['ID'] : $arResult['OFFERS'][$key]['DETAIL_PICTURE']) : false);
											if($imgPreviewID || $imgDetailID){
												$arImgPreview = CFile::ResizeImageGet($imgPreviewID ? $imgPreviewID : $imgDetailID, array('width' => 50, 'height' => 50), BX_RESIZE_IMAGE_PROPORTIONAL, true);
												$srcImgPreview = $arImgPreview['src'];
											}
											if($imgDetailID){
												$srcImgDetail = CFile::GetPath($imgDetailID);
											}
											?>
											<?if($srcImgPreview || $srcImgDetail):?>
												<a href="<?=($srcImgDetail ? $srcImgDetail : $srcImgPreview)?>" class="fancy" data-fancybox-group="item_slider"><img src="<?=$srcImgPreview?>" alt="<?=$arSKU['NAME']?>" /></a>
											<?endif;?>
										</td>
									<?endif;?>
									<?if($showSkUName):?>
										<?$collspan++;?>
										<td class="property names"><?=$arSKU['NAME']?></td>
									<?endif;?>
									<?foreach( $arResult["SKU_PROPERTIES"] as $arProp ){?>
										<?if(!$arProp["IS_EMPTY"]):?>
											<?$collspan++;?>
											<td class="property">
												<?if($arResult["TMP_OFFERS_PROP"][$arProp["CODE"]]){
													echo $arResult["TMP_OFFERS_PROP"][$arProp["CODE"]]["VALUES"][$arSKU["TREE"]["PROP_".$arProp["ID"]]]["NAME"];?>
												<?}else{
													if (is_array($arSKU["PROPERTIES"][$arProp["CODE"]]["VALUE"])){
														echo implode("/", $arSKU["PROPERTIES"][$arProp["CODE"]]["VALUE"]);
													}else{
														if($arSKU["PROPERTIES"][$arProp["CODE"]]["USER_TYPE"]=="directory" && isset($arSKU["PROPERTIES"][$arProp["CODE"]]["USER_TYPE_SETTINGS"]["TABLE_NAME"])){
															$rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('=TABLE_NAME'=>$arSKU["PROPERTIES"][$arProp["CODE"]]["USER_TYPE_SETTINGS"]["TABLE_NAME"])));
													        if ($arData = $rsData->fetch()){
													            $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);
													            $entityDataClass = $entity->getDataClass();
													            $arFilter = array(
													                'limit' => 1,
													                'filter' => array(
													                    '=UF_XML_ID' => $arSKU["PROPERTIES"][$arProp["CODE"]]["VALUE"]
													                )
													            );
													            $arValue = $entityDataClass::getList($arFilter)->fetch();
													            if(isset($arValue["UF_NAME"]) && $arValue["UF_NAME"]){
													            	echo $arValue["UF_NAME"];
													            }else{
													            	echo $arSKU["PROPERTIES"][$arProp["CODE"]]["VALUE"];
													            }
													        }
														}else{
															echo $arSKU["PROPERTIES"][$arProp["CODE"]]["VALUE"];
														}
													}
												}?>
											</td>
										<?endif;?>
									<?}?>
									<td class="price">
										<div class="cost prices clearfix">
											<?
											$collspan++;
											$arCountPricesCanAccess = 0;
											if(isset($arSKU['PRICE_MATRIX']) && $arSKU['PRICE_MATRIX'] && count($arSKU['PRICE_MATRIX']['ROWS']) > 1) // USE_PRICE_COUNT
											{?>
												<?=CNextB2c::showPriceRangeTop($arSKU, $arParams, GetMessage("CATALOG_ECONOMY"));?>
												<?echo CNextB2c::showPriceMatrix($arSKU, $arParams, $arSKU["CATALOG_MEASURE_NAME"]);
											}
											else
											{
												?>
												<?\Aspro\Functions\CAsproItem::showItemPrices($arParams, $arSKU["PRICES"], $arSKU["CATALOG_MEASURE_NAME"], $min_price_id, ($arParams["SHOW_DISCOUNT_PERCENT_NUMBER"] == "Y" ? "N" : "Y"));?>
											<?}?>
										</div>
									</td>
									<?if(strlen($arskuQuantityData["TEXT"])):?>
										<?$collspan++;?>
										<td class="count">
											<?=$arskuQuantityData["HTML"]?>
										</td>
									<?endif;?>
									<!--noindex-->
										<?if($arParams["DISPLAY_WISH_BUTTONS"] != "N"  || $arParams["DISPLAY_COMPARE"] == "Y"):?>
											<td class="like_icons">
												<?$collspan++;?>
												<?if($arParams["DISPLAY_WISH_BUTTONS"] != "N"):?>
													<?if($arskuAddToBasketData['CAN_BUY']):?>
														<div class="wish_item_button o_<?=$arSKU["ID"];?>">
															<span title="<?=GetMessage('CATALOG_WISH')?>" class="wish_item text to <?=$arParams["TYPE_SKU"];?>" data-item="<?=$arSKU["ID"]?>" data-iblock="<?=$arResult["IBLOCK_ID"]?>" data-offers="Y" data-props="<?=$arOfferProps?>"><i></i></span>
															<span title="<?=GetMessage('CATALOG_WISH_OUT')?>" class="wish_item text in added <?=$arParams["TYPE_SKU"];?>" style="display: none;" data-item="<?=$arSKU["ID"]?>" data-iblock="<?=$arSKU["IBLOCK_ID"]?>"><i></i></span>
														</div>
													<?endif;?>
												<?endif;?>
												<?if($arParams["DISPLAY_COMPARE"] == "Y"):?>
													<div class="compare_item_button o_<?=$arSKU["ID"];?>">
														<span title="<?=GetMessage('CATALOG_COMPARE')?>" class="compare_item to text <?=$arParams["TYPE_SKU"];?>" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arSKU["ID"]?>" ><i></i></span>
														<span title="<?=GetMessage('CATALOG_COMPARE_OUT')?>" class="compare_item in added text <?=$arParams["TYPE_SKU"];?>" style="display: none;" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arSKU["ID"]?>"><i></i></span>
													</div>
												<?endif;?>
											</td>
										<?endif;?>
										<?if($arskuAddToBasketData["ACTION"] == "ADD"):?>
											<?if($arskuAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_DETAIL"] && !count($arSKU["OFFERS"]) && $arskuAddToBasketData["ACTION"] == "ADD" && $arskuAddToBasketData["CAN_BUY"]):?>
												<td class="counter_wrapp counter_block_wr">
													<div class="counter_block" data-item="<?=$arSKU["ID"];?>">
														<?$collspan++;?>
														<span class="minus">-</span>
														<input type="text" class="text" name="quantity" value="<?=$arskuAddToBasketData["MIN_QUANTITY_BUY"];?>" />
														<span class="plus">+</span>
													</div>
												</td>
											<?endif;?>
										<?endif;?>
										<?if(isset($arSKU['PRICE_MATRIX']) && $arSKU['PRICE_MATRIX'] && count($arSKU['PRICE_MATRIX']['ROWS']) > 1) // USE_PRICE_COUNT
										{?>
											<?$arOnlyItemJSParams = array(
												"ITEM_PRICES" => $arSKU["ITEM_PRICES"],
												"ITEM_PRICE_MODE" => $arSKU["ITEM_PRICE_MODE"],
												"ITEM_QUANTITY_RANGES" => $arSKU["ITEM_QUANTITY_RANGES"],
												"MIN_QUANTITY_BUY" => $arskuAddToBasketData["MIN_QUANTITY_BUY"],
												"SHOW_DISCOUNT_PERCENT_NUMBER" => $arParams["SHOW_DISCOUNT_PERCENT_NUMBER"],
												"ID" => $this->GetEditAreaId($arSKU["ID"]),
											)?>
											<script type="text/javascript">
												var ob<? echo $this->GetEditAreaId($arSKU["ID"]); ?>el = new JCCatalogOnlyElement(<? echo CUtil::PhpToJSObject($arOnlyItemJSParams, false, true); ?>);
											</script>
										<?}?>
										<td class="buy" <?=($arskuAddToBasketData["ACTION"] !== "ADD" || !$arskuAddToBasketData["CAN_BUY"] || $arParams["SHOW_ONE_CLICK_BUY"]=="N" ? 'colspan="3"' : "")?>>
											<?if($arskuAddToBasketData["ACTION"] !== "ADD"  || !$arskuAddToBasketData["CAN_BUY"]):?>
												<?$collspan += 3;?>
											<?else:?>
												<?$collspan++;?>
											<?endif;?>
											<div class="counter_wrapp">
												<?=$arskuAddToBasketData["HTML"]?>
											</div>
										</td>
										<?if($arskuAddToBasketData["ACTION"] == "ADD" && $arskuAddToBasketData["CAN_BUY"] && $arParams["SHOW_ONE_CLICK_BUY"]!="N"):?>
											<td class="one_click_buy">
												<?$collspan++;?>
												<span class="btn btn-default white one_click" data-item="<?=$arSKU["ID"]?>" data-offers="Y" data-iblockID="<?=$arParams["IBLOCK_ID"]?>" data-quantity="<?=$arskuAddToBasketData["MIN_QUANTITY_BUY"];?>" data-props="<?=$arOfferProps?>" onclick="oneClickBuy('<?=$arSKU["ID"]?>', '<?=$arParams["IBLOCK_ID"]?>', this)">
													<span><?=GetMessage('ONE_CLICK_BUY')?></span>
												</span>
											</td>
										<?endif;?>
									<!--/noindex-->
									<?if($useStores):?>
										<td class="opener bottom">
											<?$collspan++;?>
											<span class="opener_icon"><i></i></span>
										</td>
									<?endif;?>
								</tr>
								<?if($useStores):?>
									<?$collspan--;?>
									<tr class="offer_stores"><td colspan="<?=$collspan?>">
										<?$APPLICATION->IncludeComponent("bitrix:catalog.store.amount", "main", array(
												"PER_PAGE" => "10",
												"USE_STORE_PHONE" => $arParams["USE_STORE_PHONE"],
												"SCHEDULE" => $arParams["SCHEDULE"],
												"USE_MIN_AMOUNT" => $arParams["USE_MIN_AMOUNT"],
												"MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
												"ELEMENT_ID" => $arSKU["ID"],
												"STORE_PATH"  =>  $arParams["STORE_PATH"],
												"MAIN_TITLE"  =>  $arParams["MAIN_TITLE"],
												"MAX_AMOUNT"=>$arParams["MAX_AMOUNT"],
												"SHOW_EMPTY_STORE" => $arParams['SHOW_EMPTY_STORE'],
												"SHOW_GENERAL_STORE_INFORMATION" => $arParams['SHOW_GENERAL_STORE_INFORMATION'],
												"USE_ONLY_MAX_AMOUNT" => $arParams["USE_ONLY_MAX_AMOUNT"],
												"USER_FIELDS" => $arParams['USER_FIELDS'],
												"FIELDS" => $arParams['FIELDS'],
												"STORES" => $arParams['STORES'],
												"CACHE_TYPE" => "A",
											),
											$component
										);?>
									</tr>
								<?endif;?>
							<?}
						}?>
					</tbody>
				</table>
			</div>
		<?endif;?>
	<?endif;?>
</div>

<?
$showProps = false;
	if($arResult["DISPLAY_PROPERTIES"]){
		foreach($arResult["DISPLAY_PROPERTIES"] as $arProp){
			if(!in_array($arProp["CODE"], array("SERVICES", "BRAND", "HIT", "RECOMMEND", "NEW", "STOCK", "VIDEO", "VIDEO_YOUTUBE", "CML2_ARTICLE", "POPUP_VIDEO"))){
				if(!is_array($arProp["DISPLAY_VALUE"])){
					$arProp["DISPLAY_VALUE"] = array($arProp["DISPLAY_VALUE"]);
				}
			}
			if(is_array($arProp["DISPLAY_VALUE"])){
				foreach($arProp["DISPLAY_VALUE"] as $value){
					if(strlen($value)){
						$showProps = true;
						break 2;
					}
				}
			}
		}
	}
	if(!$showProps && $arResult['OFFERS']){
		foreach($arResult['OFFERS'] as $arOffer){
			foreach($arOffer['DISPLAY_PROPERTIES'] as $arProp){
				if(!$arResult["TMP_OFFERS_PROP"][$arProp['CODE']])
				{
					if(!is_array($arProp["DISPLAY_VALUE"]))
						$arProp["DISPLAY_VALUE"] = array($arProp["DISPLAY_VALUE"]);


					foreach($arProp["DISPLAY_VALUE"] as $value){
						if(strlen($value)){
							$showProps = true;
							break 3;
						}
					}
				}
			}
		}
	}
?>


	<div class="row <?=($arResult["DETAIL_TEXT"] || $showProps ? 'wdesc' : '');?>">
        <!--<div class="catalog-item-width">
            <div class="top-page-tizers">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <a href="#" class="top-page-tizer-item help_me">
                            <div class="front">
                                <div class="tizer-icon">
                                    <svg version="1.1" width="30" height="30" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 25.716 26.266" style="enable-background:new 0 0 25.716 26.266;" xml:space="preserve">

                                        <g>
                                            <g>
                                                <g>
                                                    <path class="tizer-icon-svg" d="M18.775,1.638c-1.827-0.967-3.862-1.476-5.929-1.481C5.81,0.155,0.105,5.858,0.104,12.894
				c-0.001,3.321,1.296,6.511,3.613,8.89L3.184,25.57c-0.046,0.273,0.137,0.533,0.411,0.579c0.126,0.021,0.256-0.006,0.362-0.077
				l2.892-1.918c6.218,3.293,13.928,0.922,17.22-5.296S24.992,4.93,18.775,1.638z M21.196,21.141
				c-2.204,2.235-5.211,3.494-8.35,3.495c-2.021,0.003-4.008-0.516-5.77-1.506c-0.155-0.09-0.347-0.09-0.502,0l-2.265,1.471
				l0.437-2.917c0.022-0.157-0.032-0.316-0.146-0.427C-0.014,16.706-0.066,9.276,4.485,4.661S16.466-0.006,21.08,4.545
				S25.747,16.526,21.196,21.141z"/>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path class="tizer-icon-svg" d="M15.723,17.405h-0.417V9.983c0-0.277-0.225-0.502-0.502-0.502h-4.334c-0.277,0-0.502,0.225-0.502,0.502
				v1.808c0,0.277,0.225,0.502,0.502,0.502h0.422v5.112h-0.422c-0.277,0-0.502,0.225-0.502,0.502v1.808
				c0,0.277,0.225,0.502,0.502,0.502h5.252c0.277,0,0.502-0.225,0.502-0.502v-1.808C16.225,17.63,16,17.405,15.723,17.405z
				 M10.973,19.213V18.41h0.422c0.277,0,0.502-0.225,0.502-0.502v-6.116c0-0.277-0.225-0.502-0.502-0.502h-0.422v-0.803h3.324v7.422
				c0,0.277,0.225,0.502,0.502,0.502h0.417l0.005,0.803L10.973,19.213L10.973,19.213z"/>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path class="tizer-icon-svg" d="M12.846,4.575c-1.162,0-2.104,0.942-2.104,2.104s0.942,2.104,2.104,2.104s2.104-0.942,2.104-2.104
				S14.008,4.575,12.846,4.575z M12.846,7.784c-0.607,0-1.1-0.492-1.1-1.1c-0.003-0.607,0.487-1.102,1.095-1.105
				c0.002,0,0.003,0,0.005,0v0.005c0.607,0,1.1,0.492,1.1,1.1S13.453,7.784,12.846,7.784z"/>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>

                                </div>
                                <span>Получить консультацию эксперта</span>
                            </div>
                        </a>
                        <div class="hidden-content">
                            <ul>
                                <li>Экономия времени</li>
                                <li>Актуальная информация по любым вопросам</li>
                                <li>Оперативное решение вопросов</li>
                                <li>Помощь на любом этапе покупки</li>
                                <li>Не нужно регистрироваться на сайте</li>
                                <li>Выставление счета на оплату</li>
                            </ul>
                            <a href="#" class="help_me">Получить</a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <span class="top-page-tizer-item choise" data-block=".stores-block">
                            <div class="front">
                                <div class="tizer-icon">
                                    <svg version="1.1" width="30" height="30" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 27.862 30" style="enable-background:new 0 0 27.862 30;" xml:space="preserve">

<g>
	<path class="tizer-icon-svg" d="M14.2,4.273c-1.898,0-3.442,1.544-3.442,3.442s1.544,3.442,3.442,3.442c1.898,0,3.443-1.544,3.443-3.442
		S16.098,4.273,14.2,4.273z M16.58,7.715c0,1.172-1.223,2.412-2.38,2.412c-1.167,0-2.401-1.24-2.401-2.412
		c0-1.161,1.234-2.39,2.401-2.39C15.356,5.326,16.58,6.554,16.58,7.715z"/>
	<path class="tizer-icon-svg" d="M25.969,23.236c-0.675-2.103-1.312-4.09-1.941-6.159c-0.048-0.155-0.191-0.277-0.339-0.385
		c-1.675-1.223-2.484-1.831-3.837-2.916c1.37-2.731,2.064-4.77,2.064-6.061C21.917,3.461,18.455,0,14.2,0
		C9.946,0,6.484,3.461,6.484,7.715c0,1.331,0.735,3.449,2.183,6.298c-0.917,0.725-1.692,1.226-3.45,2.297
		c-0.213,0.13-0.341,0.259-0.394,0.394c-0.667,1.729-1.359,3.498-2.053,5.273c-0.908,2.323-1.848,4.726-2.727,7.026
		c-0.055,0.146-0.01,0.326,0.118,0.47c0.076,0.086,0.204,0.145,0.34,0.158c0.073,0.007,0.153,0.012,0.237-0.008
		c1.255-0.309,2.249-0.559,3.177-0.793c1.264-0.318,2.406-0.605,3.92-0.971c1.223,0.392,2.181,0.733,3.196,1.094
		c0.861,0.306,1.749,0.623,2.946,1.02C14.051,29.991,14.118,30,14.181,30c0.063,0,0.13-0.009,0.187-0.025l0.042-0.007
		c1.694-0.489,2.847-0.938,4.066-1.415c0.632-0.247,1.285-0.502,2.05-0.777c1.753,0.448,2.743,0.745,4.109,1.156
		c0.668,0.201,1.428,0.429,2.414,0.716c0.078,0.023,0.155,0.027,0.22,0.027c0.127,0.002,0.246-0.024,0.346-0.072
		c0.19-0.094,0.28-0.265,0.228-0.437v0C27.219,27.132,26.584,25.151,25.969,23.236z M13.672,28.764
		c-1.703-0.515-2.808-0.933-4.193-1.457c-0.303-0.115-0.617-0.234-0.954-0.36c0.232-1.871,0.499-3.7,0.758-5.469
		c0.238-1.625,0.482-3.302,0.701-5.017c0.421,0.75,0.77,1.335,1.196,2.043c0.156,0.255,0.32,0.521,0.476,0.771l0.139,0.225
		c1.002,1.614,1.755,2.745,1.858,2.885c0.002,0.003,0.005,0.007,0.009,0.011l0.007,1.591C13.676,25.609,13.683,27.146,13.672,28.764
		z M9.196,15.029c-0.241,1.578-0.481,3.125-0.718,4.664c-0.371,2.396-0.74,4.778-1.111,7.246c-1.84,0.474-3.175,0.835-5.01,1.332
		l-1.06,0.287c0.682-1.892,1.434-3.819,2.163-5.685c0.732-1.872,1.489-3.808,2.171-5.704c1.185-0.735,1.867-1.174,2.588-1.638
		c0.295-0.19,0.592-0.381,0.928-0.595L9.196,15.029z M20.961,7.715c0,3.005-5.016,10.96-6.761,13.634
		c-1.379-2.118-6.717-10.521-6.717-13.634c0-3.511,3.201-6.708,6.717-6.708C17.739,1.007,20.961,4.205,20.961,7.715z M14.679,24.224
		c0.007-0.593,0.014-1.185,0.018-1.776c0.015-0.015,0.031-0.033,0.051-0.058c0.124-0.146,0.919-1.369,1.862-2.89
		c0.204-0.324,0.398-0.641,0.611-0.997c0.489-0.812,0.952-1.608,1.38-2.372l1.246,10.849c-0.626,0.235-1.18,0.457-1.715,0.672
		c-1.075,0.431-2.093,0.839-3.48,1.266C14.643,27.362,14.661,25.768,14.679,24.224z M23.051,17.371
		c0.905,3.234,2.033,6.6,3.126,9.855l0.464,1.387c-0.661-0.201-1.221-0.373-1.73-0.529c-1.349-0.415-2.33-0.717-3.905-1.151
		c-0.273-2.075-0.533-4.102-0.792-6.127c-0.259-2.024-0.517-4.046-0.79-6.117C20.877,15.803,21.406,16.195,23.051,17.371z"/>
</g>
</svg>
                                </div>
                                <span>Посмотреть наличие в салоне</span>
                            </div>
                        </span>
                        <div class="hidden-content">
                            <ul>
                                <li>Экономия времени</li>
                                <li>Актуальная информация по наличию</li>
                                <li>В ближайшей доступности к Вам</li>
                                <li>Возможность просмотра в салоне</li>
                                <li>Тест-драйв мебели в салоне</li>
                            </ul>
                            <span class="choise" data-block=".stores-block">Посмотреть</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <span class="top-page-tizer-item " data-event="jqm" data-param-form_id="CALL_MANAGER" data-name="CALL_MANAGER" data-autoload-product_name="<?/*=CNextB2c::formatJsName($arResult["NAME"]);*/?>" data-autoload-product_id="<?/*=$arResult["ID"];*/?>">
                            <div class="front">
                                <div class="tizer-icon">
                                    <svg version="1.1" width="30" height="30" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 29.685 26.445" style="enable-background:new 0 0 29.685 26.445;" xml:space="preserve">

<path class="tizer-icon-svg" d="M27.491,8.966c-0.45,0-0.864,0.164-1.204,0.436c-1.174-5.245-5.859-9.179-11.453-9.179
	c-5.597,0-10.285,3.939-11.456,9.188C3.036,9.134,2.619,8.966,2.165,8.966c-1.138,0-2.065,1.022-2.065,2.279v3.751
	c0,1.257,0.926,2.279,2.065,2.279c0.513,0,0.976-0.215,1.338-0.558c1.017,5.031,4.454,8.771,8.575,8.934
	c0.176,0.336,0.584,0.571,1.061,0.571h3.751c0.637,0,1.153-0.42,1.153-0.939c0-0.519-0.516-0.939-1.153-0.939h-3.751
	c-0.354,0-0.659,0.137-0.871,0.342c-4.144-0.059-7.554-4.289-8.038-9.72v-3h0.033c0-5.829,4.742-10.571,10.571-10.571
	s10.571,4.742,10.571,10.571h0.022v3.03c0,1.257,0.926,2.279,2.065,2.279c1.138,0,2.065-1.022,2.065-2.279v-3.751
	C29.555,9.989,28.629,8.966,27.491,8.966z M3.103,14.997c0,0.637-0.42,1.153-0.939,1.153c-0.519,0-0.939-0.516-0.939-1.153v-3.751
	c0-0.637,0.42-1.153,0.939-1.153c0.519,0,0.939,0.516,0.939,1.153v0.445c-0.002,0.093-0.014,0.183-0.014,0.276h0.014V14.997z
	 M28.43,14.997c0,0.637-0.42,1.153-0.939,1.153c-0.519,0-0.939-0.516-0.939-1.153v-3.03h0.025c0-0.169-0.018-0.333-0.025-0.501
	v-0.22c0-0.637,0.42-1.153,0.939-1.153c0.519,0,0.939,0.516,0.939,1.153V14.997z"/>
</svg>
                                </div>
                                <span>Заказать выезд специалиста</span>
                            </div>
                        </span>
                        <div class="hidden-content">
                            <ul>
                                <li>Экономия времени</li>
                                <li>Выезд менеджера на объект</li>
                                <li>Проведение замеров</li>
                                <li>Демонстрация образцов материалов</li>
                                <li>Индивидуальный подбор мебели</li>
                                <li>Ведение заказа на всех этапах</li>
                            </ul>
                            <span data-event="jqm" data-param-form_id="CALL_MANAGER" data-name="CALL_MANAGER" data-autoload-product_name="<?/*=CNextB2c::formatJsName($arResult["NAME"]);*/?>" data-autoload-product_id="<?/*=$arResult["ID"];*/?>">Заказать</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">

                        <span class="top-page-tizer-item " data-event="jqm" data-param-form_id="DESIGN_PROJECT" data-name="DESIGN_PROJECT" data-autoload-product_name="<?/*=CNextB2c::formatJsName($arResult["NAME"]);*/?>" data-autoload-product_id="<?/*=$arResult["ID"];*/?>">
                            <div class="front">
                                <div class="tizer-icon">
                                    <svg version="1.1" id="Слой_1" width="30" height="30" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 26.836 26.445" style="enable-background:new 0 0 26.836 26.445;" xml:space="preserve">

<g>
	<path class="tizer-icon-svg" d="M19.336,25.359H8.011c-0.244,0-0.442,0.198-0.442,0.442s0.198,0.442,0.442,0.442h11.324
		c0.244,0,0.442-0.198,0.442-0.442S19.579,25.359,19.336,25.359z"/>
	<path class="tizer-icon-svg" d="M16.244,22.655c-0.037-0.112-0.116-0.203-0.221-0.256c-0.063-0.032-0.13-0.047-0.199-0.047
		c-0.046,0-0.092,0.007-0.138,0.022c-0.113,0.037-0.204,0.115-0.257,0.22l-1.368,2.713c-0.053,0.105-0.062,0.225-0.025,0.336
		c0.037,0.112,0.116,0.203,0.221,0.256c0.211,0.107,0.487,0.016,0.593-0.195l1.368-2.713C16.271,22.886,16.28,22.766,16.244,22.655z
		"/>
	<path class="tizer-icon-svg" d="M12.08,25.592c0.037-0.112,0.028-0.231-0.025-0.336l-1.368-2.713c-0.054-0.106-0.145-0.185-0.258-0.221
		c-0.045-0.015-0.091-0.022-0.137-0.022c-0.068,0-0.135,0.016-0.197,0.048c-0.106,0.053-0.185,0.144-0.222,0.256
		c-0.037,0.112-0.028,0.232,0.025,0.337l1.368,2.713c0.107,0.212,0.38,0.304,0.593,0.195C11.964,25.795,12.043,25.704,12.08,25.592z
		"/>
	<g>
		<path class="tizer-icon-svg" d="M10.673,15.968c1.493-0.012,1.678-0.371,2.164-1.868c0.896-2.364,4.935,0.619,2.432,1.653
			C12.767,16.789,9.181,15.979,10.673,15.968L10.673,15.968z M10.673,15.968"/>
	</g>
	<path class="tizer-icon-svg" d="M26.255,6.893H22.27c1.158-1.235,2.364-2.549,3.527-3.847c0.696-0.866,0.732-2.006,0.075-2.535
		c-0.226-0.182-0.504-0.268-0.802-0.268c-0.568,0-1.203,0.316-1.664,0.888c-1.394,1.929-2.803,3.943-4.03,5.763H0.587
		c-0.245,0-0.443,0.199-0.443,0.443v15.099c0,0.245,0.199,0.443,0.443,0.443h25.668c0.245,0,0.443-0.199,0.443-0.443V7.336
		C26.699,7.091,26.5,6.893,26.255,6.893z M24.195,1.587c0.207-0.289,0.609-0.356,0.898-0.148c0.289,0.207,0.355,0.609,0.148,0.898
		c-0.014,0.02-0.03,0.04-0.047,0.058l-7.775,8.593L24.195,1.587z M25.812,21.992H1.031V7.779h17.753
		c-1.83,2.755-3.121,4.908-3.072,5.341c0.503-0.05,2.891-2.362,5.722-5.341h4.378V21.992z"/>
</g>
</svg>
                                </div>
                                <span>Получить техническую документацию по ФЗ-44 и ФЗ-223</span>
                            </div>
                        </span>
                        <div class="hidden-content">
                            <ul>
                                <li>Подбор мебели</li>
                                <li>Расчет цены проекта</li>
                                <li>Подбор под Ваш бюджет</li>
                                <li>Демонстрация мебели в интерьере</li>
                                <li>Создание эксклюзивного интерьера</li>

                            </ul>
                            <span data-event="jqm" data-param-form_id="DESIGN_PROJECT" data-name="DESIGN_PROJECT" data-autoload-product_name="<?/*=CNextB2c::formatJsName($arResult["NAME"]);*/?>" data-autoload-product_id="<?/*=$arResult["ID"];*/?>">Получить</span>
                        </div>
                    </div>
                </div>
            </div>





        </div>-->




        <div class="what_do-block">
                <div class="maxwidth-theme">

                    <h3>Что вы хотите сделать?</h3>
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-1">
                            <a href="<?=SITE_DIR ?>services/test-drayv/" class="what_do-item">
                                <div class="what_do-item-icon">
                                    <svg height="35" version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 37.066 26.266" style="enable-background:new 0 0 37.066 26.266;" xml:space="preserve">
<style type="text/css">
    .st0{fill:#4C4E54;}
</style>
                                        <g>
                                            <polygon class="st0" points="11.527,0.271 5.617,0.271 5.617,0.975 8.052,0.975 8.052,9.5 9.078,9.5 9.078,0.975 11.527,0.975 	"/>
                                            <polygon class="st0" points="17.537,5.068 17.537,4.363 14.001,4.363 14.001,0.975 18.061,0.975 18.061,0.271 12.976,0.271
		12.976,9.5 18.1,9.5 18.1,8.795 14.001,8.795 14.001,5.068 	"/>
                                            <path class="st0" d="M22.219,0.133c-0.883,0-1.568,0.293-2.095,0.898c-0.525,0.601-0.791,1.455-0.791,2.538v2.646
		c0,1.083,0.269,1.934,0.8,2.531c0.526,0.592,1.241,0.892,2.126,0.892c0.87,0,1.549-0.247,2.019-0.736
		c0.452-0.469,0.692-1.139,0.715-1.992h-0.982c-0.026,0.671-0.165,1.158-0.426,1.484c-0.284,0.357-0.731,0.538-1.327,0.538
		c-0.609,0-1.088-0.245-1.424-0.728c-0.325-0.465-0.489-1.137-0.489-1.995V3.541c0-0.845,0.161-1.509,0.478-1.974
		c0.33-0.484,0.8-0.729,1.396-0.729c0.609,0,1.065,0.186,1.356,0.552c0.263,0.33,0.411,0.829,0.441,1.484h0.975
		c-0.031-0.881-0.275-1.56-0.726-2.02C23.795,0.376,23.107,0.133,22.219,0.133z"/>
                                            <polygon class="st0" points="31.765,0.271 25.854,0.271 25.854,0.975 28.29,0.975 28.29,9.5 29.316,9.5 29.316,0.975 31.765,0.975
			"/>
                                            <path class="st0" d="M7.715,26.126l0.113-3.029H6.826v-8.524H2.099l-0.195,3.556C1.87,19.506,1.732,20.6,1.495,21.377
		c-0.243,0.794-0.504,1.34-0.802,1.67l-0.045,0.05H0.097l0.125,3.036h0.894v-2.331h5.692v2.324H7.715z M5.807,23.097H1.676
		l0.145-0.232c0.303-0.486,0.558-1.133,0.757-1.924c0.199-0.795,0.32-1.749,0.359-2.834v-0.002l0.145-2.827h2.725V23.097z"/>
                                            <path class="st0" d="M14.318,19.287c0.476-0.494,0.717-1.162,0.717-1.985c0-0.818-0.242-1.485-0.717-1.982
		c-0.474-0.495-1.142-0.747-1.985-0.747H9.355v9.229h1.025v-3.772h1.952C13.176,20.031,13.845,19.781,14.318,19.287z M10.381,15.278
		h1.952c0.555,0,0.982,0.202,1.266,0.599c0.273,0.382,0.411,0.866,0.411,1.438c0,0.565-0.14,1.043-0.416,1.42
		c-0.287,0.392-0.711,0.591-1.262,0.591h-1.952V15.278z"/>
                                            <path class="st0" d="M20.16,21.393l0.694,2.41h1.029l-2.814-9.229H18.01l-2.84,9.229h1.029l0.694-2.41H20.16z M18.4,16.175h0.268
		l1.278,4.468h-2.832L18.4,16.175z"/>
                                            <g>
                                                <polygon class="st0" points="28.257,16.891 28.257,23.803 29.283,23.803 29.283,14.573 28.198,14.573 24.301,22.092
			24.307,21.477 24.307,14.573 23.281,14.573 23.281,23.803 24.366,23.803 28.262,16.281 		"/>
                                                <path class="st0" d="M26.298,12.845c-0.333,0-0.585-0.114-0.748-0.338c-0.127-0.174-0.202-0.391-0.223-0.645h-0.706
			c0.004,0.423,0.143,0.761,0.423,1.029c0.308,0.293,0.718,0.436,1.254,0.436c0.533,0,0.941-0.143,1.247-0.436
			c0.281-0.268,0.421-0.605,0.429-1.029H27.25c-0.021,0.253-0.095,0.47-0.222,0.645C26.864,12.731,26.619,12.845,26.298,12.845z"/>
                                            </g>
                                            <path class="st0" d="M36.262,23.153c0.46-0.428,0.694-1.066,0.694-1.895c0-0.54-0.131-1.016-0.391-1.413
		c-0.257-0.395-0.615-0.638-1.094-0.744l-0.484-0.107l0.461-0.183c0.379-0.15,0.668-0.381,0.883-0.705
		c0.211-0.32,0.318-0.696,0.318-1.117c0-0.817-0.23-1.409-0.703-1.81c-0.473-0.402-1.148-0.605-2.007-0.605h-2.506v9.229h2.879
		C35.142,23.803,35.798,23.584,36.262,23.153z M32.458,15.278h1.48c0.542,0,0.963,0.148,1.251,0.44
		c0.287,0.291,0.433,0.725,0.433,1.29c0,0.536-0.139,0.957-0.414,1.251c-0.279,0.296-0.662,0.446-1.139,0.446h-1.612V15.278z
		 M32.458,19.357h1.992c0.504,0,0.886,0.182,1.134,0.54c0.235,0.341,0.353,0.801,0.353,1.366c0,0.576-0.141,1.029-0.42,1.348
		c-0.284,0.323-0.689,0.487-1.204,0.487h-1.854V19.357z"/>
                                        </g>
</svg>

                                </div>
                                <span>Заказать Тест-драйв в офис</span>

                                <div class="hidden-content">
                                    <ul>
                                        <li>Текст</li>
                                        <li>Текст</li>
                                        <li>Текст</li>
                                    </ul>
                                </div>
                            </a>
                        </div>


                        <div class="col-sm-2">
                            <a href="<?=SITE_DIR ?>services/dizayn-proekt/" class="what_do-item">
                                <div class="what_do-item-icon">
                                    <svg height="35" version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 30.192 26.266" style="enable-background:new 0 0 30.192 26.266;" xml:space="preserve">
<style type="text/css">
    .st0{fill:#4C4E54;}
</style>
                                        <g>
                                            <path class="st0" d="M16.629,14.04c-0.157-0.455-0.393-0.857-0.7-1.192c-0.309-0.337-0.698-0.608-1.161-0.805
		c-0.463-0.197-1.011-0.298-1.629-0.298H10.43v7.563h2.708c0.566,0,1.086-0.092,1.545-0.272v0c0.455-0.18,0.849-0.436,1.172-0.763
		c0.323-0.327,0.574-0.726,0.747-1.187c0.174-0.464,0.261-0.992,0.261-1.569C16.863,14.997,16.785,14.5,16.629,14.04z
		 M15.621,15.516c0,0.384-0.055,0.746-0.162,1.075c-0.109,0.334-0.269,0.627-0.476,0.873c-0.208,0.247-0.472,0.445-0.782,0.588
		c-0.312,0.141-0.669,0.212-1.064,0.212h-1.477v-5.476h1.477c0.387,0,0.74,0.068,1.05,0.2c0.311,0.133,0.576,0.325,0.789,0.571
		c0.209,0.24,0.372,0.533,0.483,0.869C15.566,14.758,15.621,15.124,15.621,15.516z"/>
                                            <path class="st0" d="M8.243,16.008c-0.254-0.321-0.97-0.723-0.97-0.723s0.314-0.213,0.452-0.301
		c0.16-0.101,0.303-0.232,0.424-0.388c0.118-0.153,0.209-0.326,0.271-0.512c0.063-0.188,0.095-0.389,0.095-0.6
		c0-0.28-0.058-0.535-0.172-0.758c-0.114-0.225-0.28-0.421-0.492-0.58c-0.214-0.163-0.474-0.292-0.772-0.383
		c-0.527-0.164-1.207-0.185-1.821-0.058c-0.261,0.052-0.51,0.128-0.74,0.226c-0.225,0.096-0.428,0.212-0.606,0.343
		c-0.124,0.092-0.233,0.194-0.324,0.303l-0.054,0.066l0.791,0.886l0.073-0.093c0.155-0.199,0.341-0.361,0.553-0.481
		c0.56-0.323,1.381-0.327,1.826-0.006c0.234,0.167,0.353,0.421,0.353,0.756c0,0.347-0.14,0.636-0.414,0.857
		c-0.268,0.217-0.646,0.327-1.125,0.327H5.348v0.909h0.21c0.573,0,1.01,0.111,1.299,0.331c0.298,0.225,0.45,0.549,0.45,0.963
		c0,0.4-0.133,0.703-0.394,0.899c-0.254,0.189-0.62,0.285-1.089,0.285c-0.41,0-0.76-0.07-1.04-0.209
		c-0.21-0.106-0.4-0.245-0.565-0.414l-0.077-0.08l-0.715,0.891l0.06,0.063c0.259,0.275,0.573,0.49,0.932,0.639
		c0.418,0.175,0.906,0.263,1.45,0.263c0.431,0,0.824-0.053,1.167-0.156c0.341-0.104,0.634-0.251,0.868-0.437
		c0.234-0.184,0.419-0.413,0.549-0.68c0.131-0.269,0.194-0.562,0.194-0.897C8.647,16.768,8.511,16.347,8.243,16.008z"/>
                                            <path class="st0" d="M10.315,0.114L0.107,5.207v20.908h19.72l10.185-5.092V0.114H10.315z M3.007,4.995l7.546-3.774h16.56
		l-7.547,3.774H3.007z M1.215,25.007V6.103h17.929v18.904H1.215z M28.905,1.564v18.774l-8.656,4.328V5.891L28.905,1.564z"/>
                                        </g>
</svg>

                                </div>
                                <span>Получить 3D-проект бесплатно</span>
                                <div class="hidden-content">
                                    <ul>
                                        <li>Текст</li>
                                        <li>Текст</li>
                                        <li>Текст</li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <a href="<?=SITE_DIR ?>services/vyezd-spetsialista/" class="what_do-item">
                                <div class="what_do-item-icon">
                                    <svg  height="35" version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                          viewBox="0 0 34.005 26.445" style="enable-background:new 0 0 34.005 26.445;" xml:space="preserve">
<style type="text/css">
    .st0{fill:#4C4E54;}
</style>
                                        <g>
                                            <path class="st0" d="M24.294,18.65h-5.167c-0.157,0-0.286,0.165-0.286,0.369s0.128,0.369,0.286,0.369h5.166
		c0.158,0,0.286-0.165,0.286-0.369S24.451,18.65,24.294,18.65z"/>
                                            <path class="st0" d="M23.186,7.305c0-0.204-0.128-0.369-0.285-0.369h-8.465c-0.157,0-0.286,0.165-0.286,0.369
		c0,0.204,0.128,0.369,0.286,0.369H22.9C23.058,7.673,23.186,7.508,23.186,7.305z"/>
                                            <path class="st0" d="M33.324,7.266c-0.7-0.7-1.839-0.7-2.54,0l-2.306,2.308V3.887c0-0.479-0.187-0.93-0.526-1.269l-1.869-1.869
		c-0.339-0.339-0.79-0.526-1.269-0.526H13.466c-0.99,0-1.796,0.806-1.796,1.796v6.68c-0.575-0.219-1.194-0.352-1.846-0.352
		c-2.869,0-5.196,2.327-5.196,5.18c0,2.853,2.327,5.196,5.196,5.196c0.653,0,1.271-0.134,1.846-0.354v0.65H6.669
		c-3.586,0-6.518,2.917-6.518,6.518c0,0.383,0.303,0.685,0.685,0.685h18.041c0.382,0,0.685-0.303,0.685-0.685
		c0-1.134-0.293-2.202-0.806-3.134h7.926c0.99,0,1.796-0.806,1.796-1.796v-5.952l4.846-4.85C34.024,9.105,34.024,7.966,33.324,7.266
		z M24.513,1.171h0.187l0.029,0c0.14-0.001,0.43-0.005,0.684,0.249l1.869,1.869c0.252,0.251,0.25,0.534,0.249,0.686l-0.001,0.185
		l-0.185,0.028h-2.83V1.171z M9.824,17.763c-2.335,0-4.235-1.9-4.235-4.236c0-2.335,1.9-4.235,4.235-4.235
		c0.662,0,1.287,0.157,1.846,0.429c0.345,0.168,0.663,0.38,0.948,0.631c0.881,0.777,1.441,1.91,1.441,3.175
		c0,1.265-0.56,2.398-1.441,3.175c-0.285,0.251-0.603,0.463-0.948,0.631C11.112,17.605,10.487,17.763,9.824,17.763z M1.099,25.262
		l0.062-0.465c0.367-2.747,2.735-4.818,5.507-4.818h5.002h0.948h0.425c1.437,0,2.762,0.559,3.758,1.476
		c0.309,0.284,0.586,0.601,0.825,0.949c0.479,0.698,0.806,1.51,0.924,2.394l0.062,0.464H1.099z M27.529,20.608
		c0,0.467-0.38,0.847-0.847,0.847h-8.564c-1.195-1.482-3.022-2.436-5.074-2.436h-0.425v-1.124c1.156-0.741,1.993-1.926,2.283-3.314
		h4.585c0.158,0,0.286-0.165,0.286-0.369s-0.128-0.369-0.285-0.369h-4.488c0.006-0.106,0.021-0.209,0.021-0.317
		c0-0.872-0.222-1.687-0.603-2.405c0.007,0.001,0.012,0.005,0.019,0.005h6.958c0.158,0,0.286-0.165,0.286-0.369
		c0-0.204-0.128-0.369-0.285-0.369h-6.959c-0.14,0-0.252,0.134-0.276,0.306c-0.403-0.609-0.924-1.133-1.541-1.526V2.019
		c0-0.467,0.38-0.848,0.848-0.848h10.098v3.491c0,0.261,0.213,0.474,0.474,0.474h3.49v5.388l-2.938,2.94
		c-0.053,0.053-0.091,0.115-0.115,0.185l-0.935,2.804c-0.058,0.171-0.014,0.357,0.115,0.485c0.128,0.128,0.314,0.173,0.485,0.115
		l2.803-0.935c0.07-0.023,0.133-0.062,0.184-0.114l0.4-0.4V20.608z M25.861,13.535l1.199,1.199l-0.562,0.534l-1.756,0.586
		l0.63-1.829L25.861,13.535z M27.54,14.253l-1.199-1.199l3.991-3.993l1.198,1.199L27.54,14.253z M32.653,9.135L31.84,9.949
		L30.641,8.75l0.813-0.814c0.33-0.33,0.868-0.331,1.199,0C32.983,8.267,32.983,8.804,32.653,9.135z"/>
                                        </g>
</svg>

                                </div>
                                <span>Вызвать специалиста в офис</span>
                                <div class="hidden-content">
                                    <ul>
                                        <li>Экономия времени</li>
                                        <li>Выезд менеджера на объект</li>
                                        <li>Проведение замеров</li>
                                        <li>Демонстрация образцов материалов</li>
                                        <li>Индивидуальный подбор мебели</li>
                                        <li>Ведение заказа на всех этапах</li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-2">
                            <a href="" class="what_do-item animate-load" data-event="jqm" data-param-form_id="ASK" data-name="question">
                                <div class="what_do-item-icon">
                                    <svg height="35" version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 25.716 26.266" style="enable-background:new 0 0 25.716 26.266;" xml:space="preserve">
<style type="text/css">
    .st0{fill:#4C4E54;}
</style>
                                        <g>
                                            <g>
                                                <g>
                                                    <path class="st0" d="M18.775,1.638c-1.827-0.967-3.862-1.476-5.929-1.481C5.81,0.155,0.105,5.858,0.104,12.894
				c-0.001,3.321,1.296,6.511,3.613,8.89L3.184,25.57c-0.046,0.273,0.137,0.533,0.411,0.579c0.126,0.021,0.256-0.006,0.362-0.077
				l2.892-1.918c6.218,3.293,13.928,0.922,17.22-5.296S24.992,4.93,18.775,1.638z M21.196,21.141
				c-2.204,2.235-5.211,3.494-8.35,3.495c-2.021,0.003-4.008-0.516-5.77-1.506c-0.155-0.09-0.347-0.09-0.502,0l-2.265,1.471
				l0.437-2.917c0.022-0.157-0.032-0.316-0.146-0.427C-0.014,16.706-0.066,9.276,4.485,4.661S16.466-0.006,21.08,4.545
				S25.747,16.526,21.196,21.141z"/>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path class="st0" d="M15.723,17.405h-0.417V9.983c0-0.277-0.225-0.502-0.502-0.502h-4.334c-0.277,0-0.502,0.225-0.502,0.502
				v1.808c0,0.277,0.225,0.502,0.502,0.502h0.422v5.112h-0.422c-0.277,0-0.502,0.225-0.502,0.502v1.808
				c0,0.277,0.225,0.502,0.502,0.502h5.252c0.277,0,0.502-0.225,0.502-0.502v-1.808C16.225,17.63,16,17.405,15.723,17.405z
				 M10.973,19.213V18.41h0.422c0.277,0,0.502-0.225,0.502-0.502v-6.116c0-0.277-0.225-0.502-0.502-0.502h-0.422v-0.803h3.324v7.422
				c0,0.277,0.225,0.502,0.502,0.502h0.417l0.005,0.803L10.973,19.213L10.973,19.213z"/>
                                                </g>
                                            </g>
                                            <g>
                                                <g>
                                                    <path class="st0" d="M12.846,4.575c-1.162,0-2.104,0.942-2.104,2.104s0.942,2.104,2.104,2.104s2.104-0.942,2.104-2.104
				S14.008,4.575,12.846,4.575z M12.846,7.784c-0.607,0-1.1-0.492-1.1-1.1c-0.003-0.607,0.487-1.102,1.095-1.105
				c0.002,0,0.003,0,0.005,0v0.005c0.607,0,1.1,0.492,1.1,1.1S13.453,7.784,12.846,7.784z"/>
                                                </g>
                                            </g>
                                        </g>
</svg>

                                </div>
                                <span>Получить консультацию эксперта</span>
                                <div class="hidden-content">
                                    <ul>
                                        <li>Экономия времени</li>
                                        <li>Актуальная информация по любым вопросам</li>
                                        <li>Оперативное решение вопросов</li>
                                        <li>Помощь на любом этапе покупки</li>
                                        <li>Не нужно регистрироваться на сайте</li>
                                        <li>Выставление счета на оплату</li>
                                    </ul>
                                </div>
                            </a>
                        </div>


                        <div class="col-sm-2">
                            <a href="<?=SITE_DIR ?>services/test-drayv/" class="what_do-item">
                                <div class="what_do-item-icon">

                                    <svg height="35" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40.34 47.5">
                                        <defs>
                                            <style>
                                                .svg5-1,.svg5-2{fill:none;stroke:#4C4E54;stroke-miterlimit:10;}
                                                .svg5-1{stroke-width:3px;}
                                                .svg5-2{stroke-width:2px;}
                                            </style>
                                        </defs>
                                        <title>checklist</title>
                                        <g id="Layer_2" data-name="Layer 2">
                                            <g id="Layer_2-2" data-name="Layer 2">
                                                <rect class="svg5-1" x="1.5" y="1.5" width="37.34" height="44.5" rx="3" ry="3"/>
                                                <polyline class="svg5-2" points="6.64 10.56 9.57 13.31 13.77 8.75"/>
                                                <line class="svg5-2" x1="17.62" y1="12" x2="33.7" y2="12"/>
                                                <polyline class="svg5-2" points="6.64 19.91 9.57 22.66 13.77 18.1"/>
                                                <line class="svg5-2" x1="17.62" y1="21.35" x2="33.7" y2="21.35"/>
                                                <polyline class="svg5-2" points="6.64 29.27 9.57 32.02 13.77 27.46"/>
                                                <line class="svg5-2" x1="17.62" y1="30.71" x2="33.7" y2="30.71"/>
                                            </g>
                                        </g>
                                    </svg>


                                </div>
                                <span>Подготовить документацию под ФЗ-44 и ФЗ-223</span>
                                <div class="hidden-content">
                                    <ul>
                                        <li>Подбор мебели</li>
                                        <li>Расчет цены проекта</li>
                                        <li>Подбор под Ваш бюджет</li>
                                        <li>Демонстрация мебели в интерьере</li>
                                        <li>Создание эксклюзивного интерьера</li>
                                    </ul>
                                </div>
                            </a>
                        </div>


                    </div>
                </div>

        </div>






        <!--ТИЗЕРЫ-->
        <!--<div class="page-tizers">
            <div class="row">
                <div class="col-md-3">
                    <a href="/services/dostavka/" class="page-tizers-item">
                        <div class="front">
                            <div class="tizer-icon">
                                <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 37.76 26.445" width="35" height="35" style="enable-background:new 0 0 37.76 26.445;" xml:space="preserve">

                                <path class="tizer-icon-svg" d="M30.918,6.368c-0.097-0.109-0.235-0.173-0.38-0.173h-6.106V0.93c0-0.278-0.227-0.505-0.505-0.505H0.585
	c-0.278,0-0.505,0.227-0.505,0.505v21.845c0,0.278,0.227,0.505,0.505,0.505h2.836l0.126,0.46c0.435,1.58,1.882,2.684,3.519,2.684
	c1.638,0,3.085-1.104,3.52-2.684l0.126-0.46h16.034l0.126,0.46c0.435,1.58,1.882,2.684,3.52,2.684c1.637,0,3.084-1.104,3.519-2.684
	l0.126-0.46h3.081c0.278,0,0.505-0.227,0.505-0.505v-8.562c0-0.122-0.045-0.24-0.126-0.333L30.918,6.368z M7.066,25.416
	c-1.455,0-2.639-1.184-2.639-2.64c0-1.456,1.184-2.64,2.639-2.64c1.456,0,2.64,1.184,2.64,2.64
	C9.706,24.232,8.522,25.416,7.066,25.416z M23.422,22.271H10.713l-0.126-0.46c-0.435-1.58-1.882-2.685-3.52-2.685
	c-1.637,0-3.084,1.105-3.52,2.686L3.42,22.271H1.09v-8.783h5.325c0.278,0,0.505-0.227,0.505-0.505s-0.227-0.505-0.505-0.505H1.09
	v-2.475h8.77c0.278,0,0.505-0.227,0.505-0.505c0-0.278-0.227-0.505-0.505-0.505H1.09V5.972H13.6c0.278,0,0.505-0.227,0.505-0.505
	c0-0.278-0.227-0.505-0.505-0.505H1.09V1.435h22.332V22.271z M30.392,25.416c-1.455,0-2.639-1.184-2.639-2.64
	c0-1.456,1.184-2.64,2.639-2.64c1.456,0,2.64,1.184,2.64,2.64C33.032,24.232,31.848,25.416,30.392,25.416z M36.614,22.271h-2.576
	l-0.126-0.46c-0.435-1.58-1.882-2.685-3.52-2.685c-1.637,0-3.084,1.105-3.519,2.685l-0.126,0.46h-2.315V7.205h5.876l6.306,7.197
	V22.271z"/>
</svg>

                            </div>
                            <span>Доставка</span>
                        </div>
                    </a>
                    <div class="hidden-content">
                        <ul>
                            <li>Доставляем точно в срок!</li>
                            <li>Возможность срочной доставки</li>
                            <li>Доставка в удобное время</li>
                            <li>Профессиональные водители</li>
                            <li>Собственный большой автопарк</li>
                            <li>Возможен самовывоз</li>
                        </ul>
                        <a href="#" class="help_me">Получить консультацию</a>
                        <a href="/services/dostavka/">Детальная информация</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="/services/sborka/" class="page-tizers-item">
                        <div class="front">
                            <div class="tizer-icon">
                                <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 26.401 26.445" width="35" height="35" style="enable-background:new 0 0 26.401 26.445;" xml:space="preserve">

                                        <g>
                                            <path class="tizer-icon-svg" d="M25.692,22.271c-0.283,0-0.513,0.23-0.513,0.513v1.836c0,0.317-0.258,0.576-0.576,0.576H13.681v-3.342h0.897
		c1.407,0,2.552-1.145,2.552-2.552c0-1.407-1.145-2.552-2.552-2.552h-0.897v-2.997h3.963c0.283,0,0.513-0.23,0.513-0.513v-1.41
		c0-0.829,0.665-1.506,1.49-1.525c0.825,0.019,1.49,0.696,1.49,1.525v1.41c0,0.283,0.23,0.513,0.513,0.513h3.529v4.95
		c0,0.283,0.23,0.513,0.513,0.513c0.283,0,0.513-0.23,0.513-0.513v-5.464c0-0.061-0.011-0.12-0.03-0.174V1.825
		c0-0.884-0.719-1.602-1.602-1.602H1.808c-0.884,0-1.602,0.719-1.602,1.602v11.241c-0.02,0.054-0.03,0.113-0.03,0.174v11.38
		c0,0.884,0.719,1.602,1.602,1.602h11.36c0.005,0,0.01,0,0.015,0c0.005,0,0.01,0,0.015,0h11.436c0.884,0,1.602-0.719,1.602-1.602
		v-1.836C26.205,22.501,25.975,22.271,25.692,22.271z M13.681,4.855V1.249h10.892c0.318,0,0.576,0.258,0.576,0.576v10.902h-2.914
		V11.83c0-1.407-1.145-2.552-2.552-2.552c-0.012,0-0.024,0-0.035,0c-0.012,0-0.023,0-0.035,0c-1.407,0-2.551,1.145-2.551,2.552
		v0.897h-3.38V8.931c0-0.283-0.23-0.513-0.513-0.513h-1.41c-0.841,0-1.525-0.684-1.525-1.525s0.684-1.525,1.525-1.525h1.41
		C13.451,5.368,13.681,5.138,13.681,4.855z M1.232,1.825c0-0.318,0.258-0.576,0.576-0.576h10.846v3.092h-0.897
		c-1.407,0-2.552,1.145-2.552,2.552c0,1.407,1.145,2.551,2.552,2.551h0.897v3.283H8.991c-0.283,0-0.513,0.23-0.513,0.513v1.388
		c0,0.841-0.684,1.525-1.525,1.525c-0.841,0-1.525-0.684-1.525-1.525v-1.214c0.02-0.054,0.03-0.113,0.03-0.174
		c0-0.283-0.23-0.513-0.513-0.513H1.232V1.825z M12.654,21.341v3.855H1.777c-0.317,0-0.576-0.258-0.576-0.576V13.754h3.2v0.875
		c0,1.407,1.145,2.552,2.552,2.552c1.407,0,2.551-1.145,2.551-2.552v-0.875h3.15v3.51c0,0.283,0.23,0.513,0.513,0.513h1.41
		c0.841,0,1.525,0.684,1.525,1.525c0,0.841-0.684,1.525-1.525,1.525h-1.41C12.884,20.828,12.654,21.058,12.654,21.341z"/>
                                            <path class="tizer-icon-svg" d="M5.721,2.65c0-0.283-0.23-0.513-0.513-0.513H3.295c-0.552,0-1.001,0.449-1.001,1.001v1.651
		c0,0.283,0.23,0.513,0.513,0.513c0.283,0,0.513-0.23,0.513-0.513V3.163h1.887C5.491,3.163,5.721,2.934,5.721,2.65z"/>
                                            <path class="tizer-icon-svg" d="M7.096,2.856c0.081,0.2,0.273,0.321,0.476,0.321c0.064,0,0.129-0.012,0.192-0.038
		c0.263-0.106,0.39-0.405,0.283-0.668L8.037,2.444C7.93,2.181,7.631,2.055,7.369,2.161c-0.263,0.106-0.39,0.405-0.283,0.668
		L7.096,2.856z"/>
                                            <path class="tizer-icon-svg" d="M26.163,20.511c-0.106-0.263-0.406-0.39-0.668-0.283c-0.263,0.106-0.39,0.405-0.283,0.668l0.011,0.026
		c0.081,0.2,0.273,0.321,0.476,0.321c0.064,0,0.13-0.012,0.192-0.038c0.263-0.106,0.39-0.406,0.283-0.668L26.163,20.511z"/>
                                        </g>
</svg>
                            </div>
                            <span>Сборка</span>
                        </div>
                    </a>
                    <div class="hidden-content">
                        <ul>
                            <li>Быстро и профессионально</li>
                            <li>Грамотная реализация дизайн-проекта</li>
                            <li>Полное соблюдение технологии</li>
                        </ul>
                        <a href="#" class="help_me">Получить консультацию</a>
                        <a href="/services/sborka/">Детальная информация</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="/services/vyvoz-musora/" class="page-tizers-item ">
                        <div class="front">
                            <div class="tizer-icon">
                                <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 34.812 26.445" width="35" height="35" style="enable-background:new 0 0 34.812 26.445;" xml:space="preserve">

                                        <g>
                                            <path class="tizer-icon-svg" d="M31.485,24.183h2.588c0.308,0,0.561-0.253,0.561-0.561v-8.293c0-0.053-0.012-0.128-0.029-0.175v-0.003
		l-2.073-6.218c-0.076-0.23-0.29-0.383-0.532-0.383h-7.732V3.45h1.512c0.308,0,0.561-0.251,0.561-0.56s-0.253-0.56-0.561-0.56
		h-5.728V0.816c0-0.309-0.253-0.56-0.561-0.56c-0.308,0-0.561,0.251-0.561,0.56V2.33h-5.099V0.816c0-0.309-0.251-0.56-0.56-0.56
		c-0.309,0-0.56,0.251-0.56,0.56V2.33H7.611V0.816c0-0.309-0.251-0.56-0.56-0.56s-0.56,0.251-0.56,0.56v1.839L0.368,8.711
		C0.261,8.817,0.202,8.959,0.202,9.109v14.513c0,0.308,0.251,0.561,0.56,0.561h5.767l0.113,0.316
		c0.372,1.051,1.37,1.757,2.483,1.757c0.649,0,1.272-0.239,1.755-0.674l0.318-0.286l0.318,0.286
		c0.483,0.435,1.106,0.674,1.755,0.674c1.112,0,2.11-0.706,2.483-1.757l0.113-0.316h10.427l0.113,0.316
		c0.372,1.051,1.37,1.757,2.483,1.757c1.112,0,2.11-0.706,2.483-1.757L31.485,24.183z M28.413,9.67h3.182l1.7,5.099h-4.881V9.67z
		 M9.124,25.135c-0.834,0-1.513-0.678-1.513-1.512S8.29,22.11,9.124,22.11s1.513,0.678,1.513,1.512S9.958,25.135,9.124,25.135z
		 M13.271,25.135c-0.834,0-1.513-0.678-1.513-1.512s0.679-1.512,1.513-1.512s1.513,0.678,1.513,1.512S14.105,25.135,13.271,25.135z
		 M23.145,23.061h-7.279l-0.113-0.316c-0.372-1.051-1.37-1.757-2.483-1.757c-0.649,0-1.272,0.239-1.755,0.674l-0.318,0.286
		l-0.318-0.286c-0.483-0.435-1.106-0.674-1.755-0.674c-1.112,0-2.11,0.706-2.483,1.757l-0.113,0.316H1.322V9.343L7.281,3.45h15.864
		V23.061z M28.889,25.135c-0.835,0-1.512-0.678-1.512-1.512s0.678-1.512,1.512-1.512c0.835,0,1.512,0.678,1.512,1.512
		S29.724,25.135,28.889,25.135z M28.889,20.988c-1.112,0-2.11,0.706-2.483,1.757l-0.113,0.316h-2.027V9.67h3.025v5.66
		c0,0.308,0.253,0.561,0.561,0.561h5.659v7.171h-2.027l-0.113-0.316C31,21.694,30.002,20.988,28.889,20.988z"/>
                                            <path class="tizer-icon-svg" d="M6.014,17.963c0.309,0,0.56-0.253,0.56-0.561V9.109c0-0.309-0.251-0.56-0.56-0.56s-0.56,0.251-0.56,0.56v8.293
		C5.454,17.711,5.705,17.963,6.014,17.963z"/>
                                            <path class="tizer-icon-svg" d="M12.234,17.963c0.309,0,0.56-0.253,0.56-0.561V9.109c0-0.309-0.251-0.56-0.56-0.56
		c-0.309,0-0.56,0.251-0.56,0.56v8.293C11.674,17.711,11.925,17.963,12.234,17.963z"/>
                                            <path class="tizer-icon-svg" d="M18.454,17.963c0.308,0,0.561-0.253,0.561-0.561V9.109c0-0.309-0.253-0.56-0.561-0.56s-0.561,0.251-0.561,0.56
		v8.293C17.893,17.711,18.145,17.963,18.454,17.963z"/>
                                        </g>
</svg>
                            </div>
                            <span>Вывоз упаковки</span>
                        </div>
                    </a>
                    <div class="hidden-content">
                        <ul>
                            <li>Экономия сил и времени</li>
                            <li>Утилизация упаковки</li>
                            <li>Чистота окружающего пространства</li>
                        </ul>
                        <a href="#" class="help_me">Получить консультацию</a>
                        <a href="/services/vyvoz-musora/">Детальная информация</a>
                    </div>
                </div>

                <div class="col-md-3">
                    <a href="/services/dostavka/" class="page-tizers-item">
                        <div class="front">
                            <div class="tizer-icon">
                                <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 37.76 26.445" width="35" height="35" style="enable-background:new 0 0 37.76 26.445;" xml:space="preserve">

                                <path class="tizer-icon-svg" d="M30.918,6.368c-0.097-0.109-0.235-0.173-0.38-0.173h-6.106V0.93c0-0.278-0.227-0.505-0.505-0.505H0.585
	c-0.278,0-0.505,0.227-0.505,0.505v21.845c0,0.278,0.227,0.505,0.505,0.505h2.836l0.126,0.46c0.435,1.58,1.882,2.684,3.519,2.684
	c1.638,0,3.085-1.104,3.52-2.684l0.126-0.46h16.034l0.126,0.46c0.435,1.58,1.882,2.684,3.52,2.684c1.637,0,3.084-1.104,3.519-2.684
	l0.126-0.46h3.081c0.278,0,0.505-0.227,0.505-0.505v-8.562c0-0.122-0.045-0.24-0.126-0.333L30.918,6.368z M7.066,25.416
	c-1.455,0-2.639-1.184-2.639-2.64c0-1.456,1.184-2.64,2.639-2.64c1.456,0,2.64,1.184,2.64,2.64
	C9.706,24.232,8.522,25.416,7.066,25.416z M23.422,22.271H10.713l-0.126-0.46c-0.435-1.58-1.882-2.685-3.52-2.685
	c-1.637,0-3.084,1.105-3.52,2.686L3.42,22.271H1.09v-8.783h5.325c0.278,0,0.505-0.227,0.505-0.505s-0.227-0.505-0.505-0.505H1.09
	v-2.475h8.77c0.278,0,0.505-0.227,0.505-0.505c0-0.278-0.227-0.505-0.505-0.505H1.09V5.972H13.6c0.278,0,0.505-0.227,0.505-0.505
	c0-0.278-0.227-0.505-0.505-0.505H1.09V1.435h22.332V22.271z M30.392,25.416c-1.455,0-2.639-1.184-2.639-2.64
	c0-1.456,1.184-2.64,2.639-2.64c1.456,0,2.64,1.184,2.64,2.64C33.032,24.232,31.848,25.416,30.392,25.416z M36.614,22.271h-2.576
	l-0.126-0.46c-0.435-1.58-1.882-2.685-3.52-2.685c-1.637,0-3.084,1.105-3.519,2.685l-0.126,0.46h-2.315V7.205h5.876l6.306,7.197
	V22.271z"/>
</svg>

                            </div>
                            <span>Гарантия</span>
                        </div>
                    </a>
                    <div class="hidden-content">
                        <ul>
                            <li>Квалифицированные специалисты</li>
                            <li>Оперативность гарантийных работ</li>
                            <li>Косметический ремонт мебели</li>
                            <li>Замена деталей и фурнитуры</li>
                            <li>Выезд мастера на дом для ремонта</li>
                            <li>Возврат денежных средств</li>
                        </ul>
                        <a href="#" class="help_me">Получить консультацию</a>
                        <a href="/services/dostavka/">Детальная информация</a>
                    </div>
                </div>
            </div>
        </div>-->



	    <div class="catalog-item-left">



            <!--БАННЕРЫ СЛЕВА-->
            <?CNextB2c::get_banners_position('SIDE', 'Y');?>




            <!--ПОДПИСКА-->

            <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
                    array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => SITE_DIR."include/left_block/comp_subscribe.php",
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "EDIT_TEMPLATE" => "standard.php"
                    ),
                    false
            );?>







	        <!--НОВОСТИ-->
	        <div class="catalog-element-news">
	        <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
                    array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => SITE_DIR."include/left_block/comp_news.php",
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "EDIT_TEMPLATE" => "standard.php"
                    ),
                    false
            );?>
            </div>





            <!--СТАТЬИ-->

            <div class="catalog-element-articles">
            <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
                    array(
                        "COMPONENT_TEMPLATE" => ".default",
                        "PATH" => SITE_DIR."include/left_block/comp_news_articles.php",
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "",
                        "AREA_FILE_RECURSIVE" => "Y",
                        "EDIT_TEMPLATE" => "standard.php"
                    ),
                    false
            );?>
            </div>





        </div>






        <div class="catalog-item-right">
<div class="tabs_section type_more">
	<?
	$arVideo = array();
	if(strlen($arResult["DISPLAY_PROPERTIES"]["VIDEO"]["VALUE"])){
		$arVideo[] = $arResult["DISPLAY_PROPERTIES"]["VIDEO"]["~VALUE"];
	}
	if(isset($arResult["DISPLAY_PROPERTIES"]["VIDEO_YOUTUBE"]["VALUE"])){
		if(is_array($arResult["DISPLAY_PROPERTIES"]["VIDEO_YOUTUBE"]["VALUE"])){
			$arVideo = $arVideo + $arResult["DISPLAY_PROPERTIES"]["VIDEO_YOUTUBE"]["~VALUE"];
		}
		elseif(strlen($arResult["DISPLAY_PROPERTIES"]["VIDEO_YOUTUBE"]["VALUE"])){
			$arVideo[] = $arResult["DISPLAY_PROPERTIES"]["VIDEO_YOUTUBE"]["~VALUE"];
		}
	}
	if(strlen($arResult["SECTION_FULL"]["UF_VIDEO"])){
		$arVideo[] = $arResult["SECTION_FULL"]["~UF_VIDEO"];
	}
	if(strlen($arResult["SECTION_FULL"]["UF_VIDEO_YOUTUBE"])){
		$arVideo[] = $arResult["SECTION_FULL"]["~UF_VIDEO_YOUTUBE"];
	}
	?>
	<?$instr_prop = ($arParams["DETAIL_DOCS_PROP"] ? $arParams["DETAIL_DOCS_PROP"] : "INSTRUCTIONS");?>
	<?$strGrupperType = $arParams["GRUPPER_PROPS"];?>




    <?/*if($arResult["TIZERS_ITEMS"]){*/?><!--
        <div class="tizers-catalog-elem">
		<div class="tizers_block_detail tizers_block">
			<div class="row">
				<?/*$count_t_items=count($arResult["TIZERS_ITEMS"]);*/?>
				<?/*foreach($arResult["TIZERS_ITEMS"] as $arItem){*/?>
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="inner_wrapper item">
							<?/*if($arItem["UF_FILE"]){*/?>
								<div class="img">
									<?/*if($arItem["UF_LINK"]){*/?>
										<a href="<?/*=$arItem["UF_LINK"];*/?>" <?/*=(strpos($arItem["UF_LINK"], "http") !== false ? "target='_blank' rel='nofollow'" : '')*/?>>
									<?/*}*/?>
									<img src="<?/*=$arItem["PREVIEW_PICTURE"]["src"];*/?>" alt="<?/*=$arItem["UF_NAME"];*/?>" title="<?/*=$arItem["UF_NAME"];*/?>">
									<?/*if($arItem["UF_LINK"]){*/?>
										</a>
									<?/*}*/?>
								</div>
							<?/*}*/?>
							<div class="title">
								<?/*if($arItem["UF_LINK"]){*/?>
									<a href="<?/*=$arItem["UF_LINK"];*/?>" <?/*=(strpos($arItem["UF_LINK"], "http") !== false ? "target='_blank' rel='nofollow'" : '')*/?>>
								<?/*}*/?>
								<?/*=$arItem["UF_NAME"];*/?>
								<?/*if($arItem["UF_LINK"]){*/?>
									</a>
								<?/*}*/?>
							</div>
						</div>
					</div>
				<?/*}*/?>
			</div>
		</div>
		</div>
	--><?/*}*/?>








	<?/*if($arResult['ADDITIONAL_GALLERY']):*/?><!--
		<div class="wraps galerys-block with-padding<?/*=($arResult['OFFERS'] && 'TYPE_1' === $arParams['TYPE_SKU'] ? ' hidden' : '')*/?>">

			<h4><?/*=($arParams["BLOCK_ADDITIONAL_GALLERY_NAME"] ? $arParams["BLOCK_ADDITIONAL_GALLERY_NAME"] : GetMessage("ADDITIONAL_GALLERY_TITLE"))*/?></h4>
			<?/*if($arParams['ADDITIONAL_GALLERY_TYPE'] === 'SMALL'):*/?>
				<div class="small-gallery-block">
					<div class="flexslider unstyled front border small_slider custom_flex top_right color-controls" data-plugin-options='{"animation": "slide", "useCSS": true, "directionNav": true, "controlNav" :true, "animationLoop": true, "slideshow": false, "counts": [4, 3, 2, 1]}'>
						<ul class="slides items">
							<?/*if(!$arResult['OFFERS'] || 'TYPE_1' !== $arParams['TYPE_SKU']):*/?>
								<?/*foreach($arResult['ADDITIONAL_GALLERY'] as $i => $arPhoto):*/?>
									<li class="col-md-3 item visible">
										<div>
											<img src="<?/*=$arPhoto['PREVIEW']['src']*/?>" class="img-responsive inline" title="<?/*=$arPhoto['TITLE']*/?>" alt="<?/*=$arPhoto['ALT']*/?>" />
										</div>
										<a href="<?/*=$arPhoto['DETAIL']['SRC']*/?>" class="fancy dark_block_animate" rel="gallery" target="_blank" title="<?/*=$arPhoto['TITLE']*/?>"></a>
									</li>
								<?/*endforeach;*/?>
							<?/*endif;*/?>
						</ul>
					</div>
				</div>
			<?/*else:*/?>
				<div class="gallery-block">
					<div class="gallery-wrapper">
						<div class="inner">
							<?/*if(count($arResult['ADDITIONAL_GALLERY']) > 1 || ($arResult['OFFERS'] && 'TYPE_1' === $arParams['TYPE_SKU'])):*/?>
								<div class="small-gallery-wrapper">
									<div class="flexslider unstyled small-gallery center-nav ethumbs" data-plugin-options='{"slideshow": false, "useCSS": true, "animation": "slide", "animationLoop": true, "itemWidth": 60, "itemMargin": 20, "minItems": 1, "maxItems": 9, "slide_counts": 1, "asNavFor": ".gallery-wrapper .bigs"}' id="carousel1">
										<ul class="slides items">
											<?/*if(!$arResult['OFFERS'] || 'TYPE_1' !== $arParams['TYPE_SKU']):*/?>
												<?/*foreach($arResult['ADDITIONAL_GALLERY'] as $arPhoto):*/?>
													<li class="item">
														<img class="img-responsive inline" border="0" src="<?/*=$arPhoto['THUMB']['src']*/?>" title="<?/*=$arPhoto['TITLE']*/?>" alt="<?/*=$arPhoto['ALT']*/?>" />
													</li>
												<?/*endforeach;*/?>
											<?/*endif;*/?>
										</ul>
									</div>
								</div>
							<?/*endif;*/?>
							<div class="flexslider big_slider dark bigs color-controls" id="slider" data-plugin-options='{"animation": "slide", "useCSS": true, "directionNav": true, "controlNav" :true, "animationLoop": true, "slideshow": false, "sync": "#carousel1"}'>
								<ul class="slides items">
									<?/*if(!$arResult['OFFERS'] || 'TYPE_1' !== $arParams['TYPE_SKU']):*/?>
										<?/*foreach($arResult['ADDITIONAL_GALLERY'] as $i => $arPhoto):*/?>
											<li class="col-md-12 item">
												<a href="<?/*=$arPhoto['DETAIL']['SRC']*/?>" class="fancy" rel="gallery" target="_blank" title="<?/*=$arPhoto['TITLE']*/?>">
													<img src="<?/*=$arPhoto['PREVIEW']['src']*/?>" class="img-responsive inline" title="<?/*=$arPhoto['TITLE']*/?>" alt="<?/*=$arPhoto['ALT']*/?>" />
													<span class="zoom"></span>
												</a>
											</li>
										<?/*endforeach;*/?>
									<?/*endif;*/?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			<?/*endif;*/?>
		</div>
	--><?/*endif;*/?>





    <!--НАЛИЧИЕ-->
    <div class="stores-block">
        <div class="contacts-v5">
            <?$APPLICATION->IncludeComponent(
                "bitrix:news",
                "contacts_custom_elem",
                array(
                    "IBLOCK_TYPE" => "aspro_next_content",
                    "IBLOCK_ID" => "10",
                    "NEWS_COUNT" => "20",
                    "USE_SEARCH" => "N",
                    "USE_RSS" => "Y",
                    "USE_RATING" => "N",
                    "USE_CATEGORIES" => "N",
                    "USE_FILTER" => "Y",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "CHECK_DATES" => "Y",
                    "SEF_MODE" => "Y",
                    "SEF_FOLDER" => "/contacts/",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "100000",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "N",
                    "SET_TITLE" => "Y",
                    "SET_STATUS_404" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "USE_PERMISSIONS" => "N",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "LIST_ACTIVE_DATE_FORMAT" => "j F Y",
                    "LIST_FIELD_CODE" => array(
                        0 => "NAME",
                        1 => "PREVIEW_TEXT",
                        2 => "PREVIEW_PICTURE",
                        3 => "DATE_ACTIVE_FROM",
                        4 => "",
                    ),
                    "LIST_PROPERTY_CODE" => array(
                        0 => "",
                        1 => "PERIOD",
                        2 => "REDIRECT",
                        3 => "",
                    ),
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "DISPLAY_NAME" => "N",
                    "META_KEYWORDS" => "-",
                    "META_DESCRIPTION" => "-",
                    "BROWSER_TITLE" => "-",
                    "DETAIL_ACTIVE_DATE_FORMAT" => "j F Y",
                    "DETAIL_FIELD_CODE" => array(
                        0 => "PREVIEW_TEXT",
                        1 => "DETAIL_TEXT",
                        2 => "DETAIL_PICTURE",
                        3 => "DATE_ACTIVE_FROM",
                        4 => "",
                    ),
                    "DETAIL_PROPERTY_CODE" => array(
                        0 => "",
                        1 => "FORM_QUESTION",
                        2 => "FORM_ORDER",
                        3 => "PHOTOPOS",
                        4 => "LINK_GOODS",
                        5 => "LINK_SERVICES",
                        6 => "LINK_STUDY",
                        7 => "VIDEO",
                        8 => "PHOTOS",
                        9 => "DOCUMENTS",
                        10 => "",
                    ),
                    "DETAIL_DISPLAY_TOP_PAGER" => "N",
                    "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                    "DETAIL_PAGER_TITLE" => "Страница",
                    "DETAIL_PAGER_TEMPLATE" => "",
                    "DETAIL_PAGER_SHOW_ALL" => "Y",
                    "PAGER_TEMPLATE" => ".default",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "Новости",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "IMAGE_POSITION" => "left",
                    "USE_SHARE" => "Y",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "USE_REVIEW" => "N",
                    "ADD_ELEMENT_CHAIN" => "Y",
                    "SHOW_DETAIL_LINK" => "Y",
                    "S_ASK_QUESTION" => "",
                    "S_ORDER_SERVISE" => "",
                    "T_GALLERY" => "",
                    "T_DOCS" => "",
                    "T_GOODS" => "",
                    "T_SERVICES" => "",
                    "T_STUDY" => "",
                    "COMPONENT_TEMPLATE" => "contacts",
                    "SET_LAST_MODIFIED" => "N",
                    "T_VIDEO" => "",
                    "DETAIL_SET_CANONICAL_URL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "SHOW_404" => "N",
                    "MESSAGE_404" => "",
                    "NUM_NEWS" => "20",
                    "NUM_DAYS" => "30",
                    "YANDEX" => "N",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "SECTIONS_TYPE_VIEW" => "sections_1",
                    "SECTION_TYPE_VIEW" => "section_1",
                    "SECTION_ELEMENTS_TYPE_VIEW" => "list_elements_2",
                    "ELEMENT_TYPE_VIEW" => "element_1",
                    "S_ORDER_SERVICE" => "",
                    "T_PROJECTS" => "",
                    "T_REVIEWS" => "",
                    "T_STAFF" => "",
                    "IMAGE_CATALOG_POSITION" => "left",
                    "SHOW_SECTION_PREVIEW_DESCRIPTION" => "Y",
                    "SHOW_SECTION_DESCRIPTION" => "Y",
                    "LINE_ELEMENT_COUNT" => "3",
                    "LINE_ELEMENT_COUNT_LIST" => "3",
                    "SHOW_CHILD_SECTIONS" => "N",
                    "GALLERY_TYPE" => "small",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "FORM_ID_ORDER_SERVISE" => "",
                    "T_NEXT_LINK" => "",
                    "T_PREV_LINK" => "",
                    "SHOW_NEXT_ELEMENT" => "N",
                    "IMAGE_WIDE" => "N",
                    "SHOW_FILTER_DATE" => "Y",
                    "FILTER_NAME" => "arFilterNews",
                    "FILTER_FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "FILTER_PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "DETAIL_STRICT_SECTION_CHECK" => "N",
                    "VIEW_TYPE" => "list",
                    "SHOW_TABS" => "Y",
                    "SHOW_ASK_QUESTION_BLOCK" => "Y",
                    "SEF_URL_TEMPLATES" => array(
                        "news" => "",
                        "section" => "",
                        "detail" => "stores/#ELEMENT_ID#/",
                        "rss" => "rss/",
                        "rss_section" => "#SECTION_ID#/rss/",
                    )
                ),
                false
            );?>
        </div>
    </div>


    <?if(!empty($arResult['PROPERTIES']['MECHANISM_NAME']['VALUE'] || $arResult['PROPERTIES']['MECHANISM_DESC']['VALUE']['TEXT'])):?>
    <div class="gif-block" style="margin-bottom: <?=(!empty($arResult['PROPERTIES']['MECHANISM_NAME']['VALUE']) ? 104 : 0)?>px">
        <div class="row">
            <?if($arResult['PROPERTIES']['MECHANISM_NAME']['VALUE'] || $arResult['PROPERTIES']['MECHANISM_DESC']['VALUE']['TEXT']):?>
                <div class="col-md-<?=(!empty($arResult['PROPERTIES']['MECHANISM_BANNER_IMG']['VALUE'])? 8 : 12)?>">
                <?/*?><div class="col-md-<?=($arResult["PROPERTIES"]["MODIFICATIONS_FILTER"] ? 8 : 12)?>"><?*/?>
                    <div class="gif-block">
                        <?if($arResult['PROPERTIES']['MECHANISM_GIF']['VALUE']):?>
                            <div class="gif-left">
                                <img src="<?= CFile::GetPath($arResult['PROPERTIES']['MECHANISM_GIF']['VALUE'])?>" alt="Мезанизм preview: <?=$arResult['PROPERTIES']['MECHANISM_NAME']?>">
                            </div>
                        <?endif;?>
                        <div class="gif-right" style="padding-left: <?=($arResult['PROPERTIES']['MECHANISM_GIF']['VALUE'] ? 220 : 0)?>px">
                            <!--Механизм: --> <h4><?= $arResult['PROPERTIES']['MECHANISM_NAME']['VALUE']?></h4>
                            <p><?= $arResult['PROPERTIES']['MECHANISM_DESC']['~VALUE']['TEXT']?></p>
                        </div>
                    </div>
                </div>
            <?endif;?>
            <?if(!empty($arResult['PROPERTIES']['MECHANISM_BANNER_IMG']['VALUE'])):?>
            <div class="col-md-4">
                <a href="<?= $arResult['PROPERTIES']['MECHANISM_BANNER_LINK']['VALUE']?>" class="gif-banner">
                    <div class="banner-img">
                        <img src="<?= CFile::GetPath($arResult['PROPERTIES']['MECHANISM_BANNER_IMG']['VALUE'])?>" alt="">
                    </div>
                    <h4 class="banner-title"><?= $arResult['PROPERTIES']['MECHANISM_BANNER_NAME']['VALUE']?></h4>
                    <div class="banner-text">
                        <?= $arResult['PROPERTIES']['MECHANISM_BANNER_DESC']['~VALUE']['TEXT']?>
                    </div>
                    <div class="flash"></div>
                </a>
            </div>
            <?endif;?>
        </div>

    </div>

    <?endif;?>




    <!-- new! -->
    <!--<div class="maxwidth-theme">
        <div class="podborki-block">
            <?/*$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
                array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => SITE_DIR."include/mainpage/comp_catalog_podborki.php",
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "",
                    "AREA_FILE_RECURSIVE" => "Y",
                    "EDIT_TEMPLATE" => "standard.php"
                ),
                false
            );*/?>
        </div>
    </div>-->
    <!-- end new! -->




<!--ОПИСАНИЕ И ДОКУМЕНТЫ-->
    <div class="description-and-docs">
        <div class="row">
            <div class="col-md-7">
            <?if(strlen($arResult["PREVIEW_TEXT"])):?>
                <div class="preview_text dotdot"><?=$arResult["PREVIEW_TEXT"]?></div>
                <?if(strlen($arResult["DETAIL_TEXT"])):?>
                    <div class="more_block icons_fa color_link"><span><?=GetMessage('MORE_TEXT_BOTTOM');?></span></div>
                <?endif;?>
            <?endif;?>
            </div>
            <div class="col-md-4 col-md-offset-1">
            <h4>Скачать</h4>

            <!--ДОКУМЕНТЫ-->

            <div class="docs-form">
                <span class="animate-load" data-event="jqm" data-param-form_id="DOCUMENTS" data-name="DOCUMENTS" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Получить техническую документацию</span>
            </div>


            <?/*if (!empty($arResult["PROPERTIES"]["DOCUMENTS44"]["VALUE"]) || !empty($arResult["PROPERTIES"]["DOCUMENTS223"]["VALUE"])):*/?><!--


            <div class="docs-block">

                    <?/*if (!empty($arResult["PROPERTIES"]["DOCUMENTS44"]["VALUE"])):*/?>
                        <a href="<?/*=CFile::GetPath($arResult["PROPERTIES"]["DOCUMENTS44"]["VALUE"]);*/?>">ФЗ-44</a>
                    <?/*endif;*/?>
                    <?/*if (!empty($arResult["PROPERTIES"]["DOCUMENTS223"]["VALUE"])):*/?>
                        <a href="<?/*=CFile::GetPath($arResult["PROPERTIES"]["DOCUMENTS223"]["VALUE"]);*/?>">ФЗ-223</a>
                    <?/*endif;*/?>

            </div>
            --><?/*endif;*/?>





        <!--ФАЙЛЫ-->
        <?if((count($arResult["PROPERTIES"][$instr_prop]["VALUE"]) && is_array($arResult["PROPERTIES"][$instr_prop]["VALUE"])) || count($arResult["SECTION_FULL"]["UF_FILES"])):?>

        <?
		$arFiles = array();
		if($arResult["PROPERTIES"][$instr_prop]["VALUE"]){
			$arFiles = $arResult["PROPERTIES"][$instr_prop]["VALUE"];
		}
		else{
			$arFiles = $arResult["SECTION_FULL"]["UF_FILES"];
		}
		if(is_array($arFiles)){
			foreach($arFiles as $key => $value){
				if(!intval($value)){
					unset($arFiles[$key]);
				}
			}
		}



		if($arFiles):?>
			<div class="wraps">


				<div class="files_block">
						<?foreach($arFiles as $arItem):?>
							<div class="files_item">
								<?$arFile=CNextB2c::GetFileInfo($arItem);?>
								<div class="file_type clearfix <?=$arFile["TYPE"];?>">
									<!--<i class="icon"></i>-->
									<div class="description">
										<a target="_blank" href="<?=$arFile["SRC"];?>" class="dark_link"><?=$arFile["DESCRIPTION"];?></a>
										<span class="size">
											<?=$arFile["FILE_SIZE_FORMAT"];?>
										</span>
									</div>
								</div>
							</div>
						<?endforeach;?>

				</div>
			</div>
		<?endif;?>
	<?endif;?>

        </div>
        </div>



    </div>






    <?if(is_array($arResult['PROPERTIES']['DETAILS']['VALUE']) and !empty ($arResult['PROPERTIES']['DETAILS']['VALUE'])) :?>

    <div class="features desktop-features">
        <div class="row">
        <!--Особенности товара-->
        <?
            $dbDetails = CIBlockElement::GetList(
            	array(),
            	array('IBLOCK_ID' => $arResult['PROPERTIES']['DETAILS']['LINK_IBLOCK_ID'], 'ACTIVE' => 'Y', 'ID' => $arResult['PROPERTIES']['DETAILS']['VALUE']),
            	array('IBLOCK_ID', 'ID', 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE')
            );
            while($arDetail = $dbDetails->Fetch()){?>
            	<div class="col-md-3">

					<img src="<?=CFile::GetPath($arDetail['PREVIEW_PICTURE'])?>" alt="<?=$arDetail['NAME']?>">
					<span class="name-details"><?=$arDetail['NAME']?></span>
					<div class="detail-description">
					<?=htmlspecialchars($arDetail['PREVIEW_TEXT']);?>
					</div>
				</div>
            <?}
            ?>



        </div>
    </div>


        <div class="features mobile-features">
                <!--Особенности товара-->
                <?
                $dbDetails = CIBlockElement::GetList(
                    array(),
                    array('IBLOCK_ID' => $arResult['PROPERTIES']['DETAILS']['LINK_IBLOCK_ID'], 'ACTIVE' => 'Y', 'ID' => $arResult['PROPERTIES']['DETAILS']['VALUE']),
                    array('IBLOCK_ID', 'ID', 'NAME', 'PREVIEW_TEXT', 'PREVIEW_PICTURE')
                );
                while($arDetail = $dbDetails->Fetch()){?>
                    <div class="features-slide">

                        <img src="<?=CFile::GetPath($arDetail['PREVIEW_PICTURE'])?>" alt="<?=$arDetail['NAME']?>">
                        <span class="name-details"><?=$arDetail['NAME']?></span>
                        <div class="detail-description">
                            <?=htmlspecialchars($arDetail['PREVIEW_TEXT']);?>
                        </div>
                    </div>
                <?}
                ?>
        </div>
<?endif;?>








    <!--ХАРАКТЕРИСТИКИ-->
    <?if($arResult["DETAIL_TEXT"] || ($showProps && ($iCountProps > $arParams['VISIBLE_PROP_COUNT']))):
    $class = 12;?>
	<div class="characteristics">
    	<div class="row">
	        <div class="col-md-12">

				<div class="row char_inner_wrapper">
					<?if($arResult["DETAIL_TEXT"]):?>
						<div class="col-md-<?=$class;?>">
							<h4><?=($arParams["TAB_DESCR_NAME"] ? $arParams["TAB_DESCR_NAME"] : GetMessage("DESCRIPTION_TAB"));?></h4>
							<?=$arResult["DETAIL_TEXT"];?>
						</div>
					<?endif;?>
					<?if($showProps && ($iCountProps > $arParams['VISIBLE_PROP_COUNT'])):?>
						<div class="col-md-<?=$class;?>">
							<h4><?=($arParams["TAB_CHAR_NAME"] ? $arParams["TAB_CHAR_NAME"] : GetMessage("PROPERTIES_TAB"));?></h4>
							<?if($strGrupperType == "GRUPPER"):?>
								<div class="char_block">
									<?$APPLICATION->IncludeComponent(
										"redsign:grupper.list",
										"",
										Array(
											"CACHE_TIME" => "3600000",
											"CACHE_TYPE" => "A",
											"COMPOSITE_FRAME_MODE" => "A",
											"COMPOSITE_FRAME_TYPE" => "AUTO",
											"DISPLAY_PROPERTIES" => $arResult["GROUPS_PROPS"]
										),
										$component, array('HIDE_ICONS'=>'Y')
									);?>
									<table class="props_list" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['DISPLAY_PROP_DIV']; ?>"></table>
								</div>
							<?elseif($strGrupperType == "WEBDEBUG"):?>
								<div class="char_block">
									<?$APPLICATION->IncludeComponent(
										"webdebug:propsorter",
										"linear",
										array(
											"IBLOCK_TYPE" => $arResult['IBLOCK_TYPE'],
											"IBLOCK_ID" => $arResult['IBLOCK_ID'],
											"PROPERTIES" => $arResult['GROUPS_PROPS'],
											"EXCLUDE_PROPERTIES" => array(),
											"WARNING_IF_EMPTY" => "N",
											"WARNING_IF_EMPTY_TEXT" => "",
											"NOGROUP_SHOW" => "Y",
											"NOGROUP_NAME" => "",
											"MULTIPLE_SEPARATOR" => ", "
										),
										$component, array('HIDE_ICONS'=>'Y')
									);?>
									<table class="props_list" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['DISPLAY_PROP_DIV']; ?>"></table>
								</div>
							<?elseif($strGrupperType == "YENISITE_GRUPPER"):?>
								<div class="char_block">
									<?$APPLICATION->IncludeComponent(
										'yenisite:ipep.props_groups',
										'',
										array(
											'DISPLAY_PROPERTIES' => $arResult['GROUPS_PROPS'],
											'IBLOCK_ID' => $arParams['IBLOCK_ID']
										),
										$component, array('HIDE_ICONS'=>'Y')
									)?>
									<table class="props_list colored_char" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['DISPLAY_PROP_DIV']; ?>"></table>
								</div>
							<?else:?>
								<?if($arParams["PROPERTIES_DISPLAY_TYPE"] != "TABLE"):?>
									<div class="props_block" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['DISPLAY_PROP_DIV']; ?>">
										<?foreach($arResult["PROPERTIES"] as $propCode => $arProp):?>
											<?if(isset($arResult["DISPLAY_PROPERTIES"][$propCode])):?>
												<?$arProp = $arResult["DISPLAY_PROPERTIES"][$propCode];?>
												<?if(!in_array($arProp["CODE"], array("SERVICES", "BRAND", "HIT", "RECOMMEND", "NEW", "STOCK", "VIDEO", "VIDEO_YOUTUBE", "CML2_ARTICLE", "POPUP_VIDEO"))):?>
													<?if((!is_array($arProp["DISPLAY_VALUE"]) && strlen($arProp["DISPLAY_VALUE"])) || (is_array($arProp["DISPLAY_VALUE"]) && implode('', $arProp["DISPLAY_VALUE"]))):?>
														<div class="char" itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
															<div class="char_name">
																<?if($arProp["HINT"] && $arParams["SHOW_HINTS"]=="Y"):?><div class="hint"><span class="icon"><i>?</i></span><div class="tooltip"><?=$arProp["HINT"]?></div></div><?endif;?>
																<div class="props_item <?if($arProp["HINT"] && $arParams["SHOW_HINTS"] == "Y"){?>whint<?}?>">
																	<span itemprop="name"><?=$arProp["NAME"]?></span>
																</div>
															</div>
															<div class="char_value" itemprop="value">
																<?if(count($arProp["DISPLAY_VALUE"]) > 1):?>
																	<?=implode(', ', $arProp["DISPLAY_VALUE"]);?>
																<?else:?>
																	<?=$arProp["DISPLAY_VALUE"];?>
																<?endif;?>
															</div>
														</div>
													<?endif;?>
												<?endif;?>
											<?endif;?>
										<?endforeach;?>
									</div>
								<?else:?>
									<div class="char_block">
										<ul class="props_list nbg">
											<?foreach($arResult["DISPLAY_PROPERTIES"] as $arProp):?>
												<?if(!in_array($arProp["CODE"], array("SERVICES", "BRAND", "HIT", "RECOMMEND", "NEW", "STOCK", "VIDEO", "VIDEO_YOUTUBE", "CML2_ARTICLE", "POPUP_VIDEO"))):?>
													<?if((!is_array($arProp["DISPLAY_VALUE"]) && strlen($arProp["DISPLAY_VALUE"])) || (is_array($arProp["DISPLAY_VALUE"]) && implode('', $arProp["DISPLAY_VALUE"]))):?>
														<li itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">

                                                            <div class="char_name">
																<?if($arProp["HINT"] && $arParams["SHOW_HINTS"]=="Y"):?><div class="hint"><span class="icon"><i>?</i></span><div class="tooltip"><?=$arProp["HINT"]?></div></div><?endif;?>
																<div class="props_item <?if($arProp["HINT"] && $arParams["SHOW_HINTS"] == "Y"){?>whint<?}?>">
																	<span itemprop="name"><?=$arProp["NAME"]?></span>
																</div>
															</div>
															<div class="char_value">
																<span itemprop="value">
																	<?if(count($arProp["DISPLAY_VALUE"]) > 1):?>
																		<?=implode(', ', $arProp["DISPLAY_VALUE"]);?>
																	<?else:?>
																		<?=$arProp["DISPLAY_VALUE"];?>
																	<?endif;?>
																</span>
															</div>
														</li>
													<?endif;?>
												<?endif;?>
											<?endforeach;?>
										</ul>
										<table class="props_list nbg" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['DISPLAY_PROP_DIV']; ?>"></table>
									</div>
								<?endif;?>
							<?endif;?>
						</div>
					<?endif;?>
				</div>

            </div>







        </div>
    </div>
    <?endif;?>



    <!--ПЕРВЫЙ БАНЕР-->
    <?if($arResult['PROPERTIES']['FIRST_BANNER_CATALOG']['VALUE']):?>
    <div class="catalog_detail-banner first-banner">
        <a href="<?= $arResult['PROPERTIES']['FIRST_BANNER_CATALOG_LINK']['VALUE']?>" class="">
            <span style="background-image: url('<?= CFile::GetPath($arResult['PROPERTIES']['FIRST_BANNER_CATALOG']['VALUE'])?>')"></span>
        </a>
    </div>
    <?endif;?>



    <?/*$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR."include/mainpage/comp_elem_banner_first.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    );*/?>
    <!-- new! -->
    <!--<div class="maxwidth-theme">-->
        <div class="podborki-block">
            <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
                array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => SITE_DIR."include/mainpage/comp_catalog_podborki.php",
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "",
                    "AREA_FILE_RECURSIVE" => "Y",
                    "EDIT_TEMPLATE" => "standard.php"
                ),
                false
            );?>
        </div>
    <!--</div>-->
    <!-- end new! -->





    <!--<div class="catalog-page-products">-->
        <!--ПОХОЖИЕ ТОВАРЫ-->
        <?if(!empty($arTmpAssoc["CHILDREN"])){?>
            <div class="associated">


                <div class="wraps hidden_print addon_type">

                    <h4><?=($arParams["DETAIL_ASSOCIATED_TITLE"] ? $arParams["DETAIL_ASSOCIATED_TITLE"] : GetMessage("DETAIL_ASSOCIATED_TITLE"))?></h4>
                    <div class="bottom_slider specials tab_slider_wrapp custom_type">
                        <ul class="slider_navigation top custom_flex border">
                            <li class="tabs_slider_navigation access_nav cur" data-code="accos"></li>
                        </ul>

                        <ul class="tabs_goods">
                            <li class="tab access_wrapp" data-code="accos">
                                <div class="catalog-detail-slider-assoc">
                                    <!--<ul class="tabs_slider access_slides slides">-->

                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:catalog.top",
                                        "main_custom",
                                        array(
                                            "USE_REGION" => ($arRegion ? "Y" : "N"),
                                            "STORES" => $arParams['STORES'],
                                            "TITLE_BLOCK" => $arParams["SECTION_TOP_BLOCK_TITLE"],
                                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                            "SALE_STIKER" => $arParams["SALE_STIKER"],
                                            "STIKERS_PROP" => $arParams["STIKERS_PROP"],
                                            "SHOW_RATING" => $arParams["SHOW_RATING"],
                                            "FILTER_NAME" => 'arrFilterAccess',
                                            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                                            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                                            "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                                            "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                                            "CUSTOM_FILTER" => $arResult['PROPERTIES']['ASSOCIATED_FILTER']['~VALUE'],
                                            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                                            "BASKET_URL" => $arParams["BASKET_URL"],
                                            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                                            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                                            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                                            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                                            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                                            "DISPLAY_COMPARE" => ($arParams["DISPLAY_COMPARE"] ? "Y" : "N"),
                                            "DISPLAY_WISH_BUTTONS" => $arParams["DISPLAY_WISH_BUTTONS"],
                                            "ELEMENT_COUNT" => 20,
                                            "SHOW_MEASURE_WITH_RATIO" => $arParams["SHOW_MEASURE_WITH_RATIO"],
                                            "SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
                                            "LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
                                            "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
                                            "PRICE_CODE" => $arParams['PRICE_CODE'],
                                            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                                            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                                            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                                            "PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
                                            "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                                            "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                                            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                                            "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
                                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                                            "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                                            "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                                            "OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],
                                            "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                                            "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                                            "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                                            "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                                            "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],
                                            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                                            'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
                                            'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
                                            'VIEW_MODE' => (isset($arParams['TOP_VIEW_MODE']) ? $arParams['TOP_VIEW_MODE'] : ''),
                                            'ROTATE_TIMER' => (isset($arParams['TOP_ROTATE_TIMER']) ? $arParams['TOP_ROTATE_TIMER'] : ''),
                                            'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                                            'LABEL_PROP' => $arParams['LABEL_PROP'],
                                            'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                                            'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

                                            'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                                            'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                                            'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                                            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                                            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                                            'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                                            'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
                                            'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
                                            'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
                                            'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
                                            'ADD_TO_BASKET_ACTION' => $basketAction,
                                            'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                                            'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                                        ),
                                        false, array("HIDE_ICONS"=>"Y")
                                    );?>
                                    <!--</ul>-->
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        <?}?>

        <!--END-->

        <!--ТОВАРЫ ЭТОГО РАЗДЕЛА-->
        <?if(!empty($arTmpThissect["CHILDREN"])){?>
            <div class="associated-sect">


                <div class="wraps hidden_print addon_type">

                    <h4><?=GetMessage("DETAIL_THISSECTION_TITLE")?></h4>
                    <div class="bottom_slider specials tab_slider_wrapp custom_type">
                        <ul class="slider_navigation top custom_flex border">
                            <li class="tabs_slider_navigation access_nav cur" data-code="accos"></li>
                        </ul>

                        <ul class="tabs_goods">
                            <li class="tab access_wrapp" data-code="accos">
                                <div class="catalog-detail-slider-sect">
                                    <!--<ul class="tabs_slider access_slides slides">-->

                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:catalog.top",
                                        "main_custom",
                                        array(
                                            "USE_REGION" => ($arRegion ? "Y" : "N"),
                                            "STORES" => $arParams['STORES'],
                                            "TITLE_BLOCK" => $arParams["SECTION_TOP_BLOCK_TITLE"],
                                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                            "SALE_STIKER" => $arParams["SALE_STIKER"],
                                            "STIKERS_PROP" => $arParams["STIKERS_PROP"],
                                            "SHOW_RATING" => $arParams["SHOW_RATING"],
                                            "FILTER_NAME" => 'arrFilterThisSection',
                                            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                                            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                                            "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                                            "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                                            "CUSTOM_FILTER" => $arResult['PROPERTIES']['THISSECTION_FILTER']['~VALUE'],
                                            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                                            "BASKET_URL" => $arParams["BASKET_URL"],
                                            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                                            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                                            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                                            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                                            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                                            "DISPLAY_COMPARE" => ($arParams["DISPLAY_COMPARE"] ? "Y" : "N"),
                                            "DISPLAY_WISH_BUTTONS" => $arParams["DISPLAY_WISH_BUTTONS"],
                                            "ELEMENT_COUNT" => 20,
                                            "SHOW_MEASURE_WITH_RATIO" => $arParams["SHOW_MEASURE_WITH_RATIO"],
                                            "SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
                                            "LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
                                            "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
                                            "PRICE_CODE" => $arParams['PRICE_CODE'],
                                            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                                            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                                            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                                            "PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
                                            "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                                            "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                                            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                                            "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
                                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                                            "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                                            "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                                            "OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],
                                            "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                                            "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                                            "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                                            "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                                            "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],
                                            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                                            'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
                                            'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
                                            'VIEW_MODE' => (isset($arParams['TOP_VIEW_MODE']) ? $arParams['TOP_VIEW_MODE'] : ''),
                                            'ROTATE_TIMER' => (isset($arParams['TOP_ROTATE_TIMER']) ? $arParams['TOP_ROTATE_TIMER'] : ''),
                                            'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                                            'LABEL_PROP' => $arParams['LABEL_PROP'],
                                            'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                                            'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

                                            'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                                            'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                                            'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                                            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                                            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                                            'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                                            'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
                                            'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
                                            'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
                                            'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
                                            'ADD_TO_BASKET_ACTION' => $basketAction,
                                            'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                                            'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                                        ),
                                        false, array("HIDE_ICONS"=>"Y")
                                    );?>
                                    <!--</ul>-->
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        <?}?>

        <!--END-->


        <!--ТОВАРЫ ЭТОЙ СЕРИИ-->
        <?if(!empty($arTmpThisser["CHILDREN"])){?>
            <div class="associated-series">


                <div class="wraps hidden_print addon_type">

                    <h4><?=GetMessage("DETAIL_THISSERIES_TITLE")?></h4>
                    <div class="bottom_slider specials tab_slider_wrapp custom_type">
                        <ul class="slider_navigation top custom_flex border">
                            <li class="tabs_slider_navigation access_nav cur" data-code="accos"></li>
                        </ul>

                        <ul class="tabs_goods">
                            <li class="tab access_wrapp" data-code="accos">
                                <div class="catalog-detail-slider-series">
                                    <!--<ul class="tabs_slider access_slides slides">-->

                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:catalog.top",
                                        "main_custom",
                                        array(
                                            "USE_REGION" => ($arRegion ? "Y" : "N"),
                                            "STORES" => $arParams['STORES'],
                                            "TITLE_BLOCK" => $arParams["SECTION_TOP_BLOCK_TITLE"],
                                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                            "SALE_STIKER" => $arParams["SALE_STIKER"],
                                            "STIKERS_PROP" => $arParams["STIKERS_PROP"],
                                            "SHOW_RATING" => $arParams["SHOW_RATING"],
                                            "FILTER_NAME" => 'arrFilterThisSeries',
                                            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                                            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                                            "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                                            "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                                            "CUSTOM_FILTER" => $arResult['PROPERTIES']['THISSERIES_FILTER']['~VALUE'],
                                            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                                            "BASKET_URL" => $arParams["BASKET_URL"],
                                            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                                            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                                            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                                            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                                            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                                            "DISPLAY_COMPARE" => ($arParams["DISPLAY_COMPARE"] ? "Y" : "N"),
                                            "DISPLAY_WISH_BUTTONS" => $arParams["DISPLAY_WISH_BUTTONS"],
                                            "ELEMENT_COUNT" => 20,
                                            "SHOW_MEASURE_WITH_RATIO" => $arParams["SHOW_MEASURE_WITH_RATIO"],
                                            "SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
                                            "LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
                                            "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
                                            "PRICE_CODE" => $arParams['PRICE_CODE'],
                                            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                                            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                                            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                                            "PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
                                            "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                                            "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                                            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                                            "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
                                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                                            "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                                            "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                                            "OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],
                                            "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                                            "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                                            "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                                            "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                                            "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],
                                            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                                            'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
                                            'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
                                            'VIEW_MODE' => (isset($arParams['TOP_VIEW_MODE']) ? $arParams['TOP_VIEW_MODE'] : ''),
                                            'ROTATE_TIMER' => (isset($arParams['TOP_ROTATE_TIMER']) ? $arParams['TOP_ROTATE_TIMER'] : ''),
                                            'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                                            'LABEL_PROP' => $arParams['LABEL_PROP'],
                                            'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                                            'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

                                            'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                                            'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                                            'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                                            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                                            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                                            'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                                            'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
                                            'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
                                            'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
                                            'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
                                            'ADD_TO_BASKET_ACTION' => $basketAction,
                                            'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                                            'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                                        ),
                                        false, array("HIDE_ICONS"=>"Y")
                                    );?>
                                    <!--</ul>-->
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        <?}?>

        <!--END-->

        <!--РЕКОМЕНДАЦИИ-->
        <?if(!empty($arTmpRecomend["CHILDREN"])):?>
            <div class="recomendation">
                <div class="wraps hidden_print addon_type">
                    <h4><?=($arParams["DETAIL_RECOMENDATION_TITLE"] ? $arParams["DETAIL_RECOMENDATION_TITLE"] : GetMessage("DETAIL_RECOMENDATION_TITLE"))?></h4>
                    <div class="bottom_slider specials tab_slider_wrapp custom_type">
                        <!--<ul class="slider_navigation top custom_flex border">
                            <li class="tabs_slider_navigation access_nav cur" data-code="access"></li>
                        </ul>-->

                        <ul class="tabs_goods">
                            <li class="tab access_wrapp" data-code="access">
                                <div class="catalog-detail-slider-recommend">
                                    <!--<ul class="tabs_slider access_slides slides">-->
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:catalog.top",
                                        "main_custom",
                                        array(
                                            "USE_REGION" => ($arRegion ? "Y" : "N"),
                                            "STORES" => $arParams['STORES'],
                                            "TITLE_BLOCK" => $arParams["SECTION_TOP_BLOCK_TITLE"],
                                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                            "SALE_STIKER" => $arParams["SALE_STIKER"],
                                            "STIKERS_PROP" => $arParams["STIKERS_PROP"],
                                            "SHOW_RATING" => $arParams["SHOW_RATING"],
                                            "FILTER_NAME" => 'arrFilterAccess',
                                            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                                            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                                            "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                                            "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                                            "CUSTOM_FILTER" => $arResult['PROPERTIES']['RECOMENDATION_FILTER']['~VALUE'],
                                            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                                            "BASKET_URL" => $arParams["BASKET_URL"],
                                            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                                            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                                            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                                            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                                            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                                            "DISPLAY_COMPARE" => ($arParams["DISPLAY_COMPARE"] ? "Y" : "N"),
                                            "DISPLAY_WISH_BUTTONS" => $arParams["DISPLAY_WISH_BUTTONS"],
                                            "ELEMENT_COUNT" => "",
                                            "SHOW_MEASURE_WITH_RATIO" => $arParams["SHOW_MEASURE_WITH_RATIO"],
                                            "SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
                                            "LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
                                            "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
                                            "PRICE_CODE" => $arParams['PRICE_CODE'],
                                            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                                            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                                            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                                            "PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
                                            "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                                            "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                                            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                                            "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
                                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                                            "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                                            "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                                            "OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],
                                            "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                                            "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                                            "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                                            "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                                            "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],
                                            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                                            'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
                                            'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
                                            'VIEW_MODE' => (isset($arParams['TOP_VIEW_MODE']) ? $arParams['TOP_VIEW_MODE'] : ''),
                                            'ROTATE_TIMER' => (isset($arParams['TOP_ROTATE_TIMER']) ? $arParams['TOP_ROTATE_TIMER'] : ''),
                                            'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                                            'LABEL_PROP' => $arParams['LABEL_PROP'],
                                            'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                                            'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

                                            'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                                            'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                                            'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                                            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                                            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                                            'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                                            'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
                                            'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
                                            'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
                                            'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
                                            'ADD_TO_BASKET_ACTION' => $basketAction,
                                            'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                                            'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                                        ),
                                        false, array("HIDE_ICONS"=>"Y")
                                    );?>
                                    <!--</ul>-->
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        <?endif;?>
        <!--END-->


        <!--ВАМ ТАКЖЕ МОЖЕТ ПОНАДОБИТЬСЯ-->
        <?if(!empty($arTmpExp["CHILDREN"])):?>
            <div class="interesting">
                <div class="wraps hidden_print addon_type">

                    <h4><?=($arParams["DETAIL_EXPANDABLES_TITLE"] ? $arParams["DETAIL_EXPANDABLES_TITLE"] : GetMessage("DETAIL_EXPANDABLES_TITLE"))?></h4>
                    <div class="bottom_slider specials tab_slider_wrapp custom_type">
                        <ul class="slider_navigation top custom_flex border">
                            <li class="tabs_slider_navigation interesing_nav cur" data-code="access"></li>
                        </ul>

                        <ul class="tabs_goods">
                            <li class="tab access_wrapp" data-code="access">
                                <div class="catalog-detail-slider-interesting">
                                    <!--<ul class="tabs_slider access_slides slides">-->
                                    <?if($arResult["PROPERTIES"]["ASSOCIATED"]["VALUE"])
                                        $GLOBALS['arrFilterAccess'] = array("ID" => $arResult["PROPERTIES"]["EXPANDABLES"]["VALUE"]);?>
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:catalog.top",
                                        "main_custom",
                                        array(
                                            "USE_REGION" => ($arRegion ? "Y" : "N"),
                                            "STORES" => $arParams['STORES'],
                                            "TITLE_BLOCK" => $arParams["SECTION_TOP_BLOCK_TITLE"],
                                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                            "SALE_STIKER" => $arParams["SALE_STIKER"],
                                            "STIKERS_PROP" => $arParams["STIKERS_PROP"],
                                            "SHOW_RATING" => $arParams["SHOW_RATING"],
                                            "FILTER_NAME" => 'arrFilterAccess',
                                            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                                            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                                            "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                                            "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                                            "CUSTOM_FILTER" => $arResult['PROPERTIES']['EXPANDABLES_FILTER']['~VALUE'],
                                            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                                            "BASKET_URL" => $arParams["BASKET_URL"],
                                            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                                            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                                            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                                            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                                            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                                            "DISPLAY_COMPARE" => ($arParams["DISPLAY_COMPARE"] ? "Y" : "N"),
                                            "DISPLAY_WISH_BUTTONS" => $arParams["DISPLAY_WISH_BUTTONS"],
                                            "ELEMENT_COUNT" => 20,
                                            "SHOW_MEASURE_WITH_RATIO" => $arParams["SHOW_MEASURE_WITH_RATIO"],
                                            "SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
                                            "LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
                                            "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
                                            "PRICE_CODE" => $arParams['PRICE_CODE'],
                                            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                                            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                                            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                                            "PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
                                            "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                                            "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                                            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                                            "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
                                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                                            "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                                            "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                                            "OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],
                                            "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                                            "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                                            "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                                            "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                                            "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],
                                            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                                            'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
                                            'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
                                            'VIEW_MODE' => (isset($arParams['TOP_VIEW_MODE']) ? $arParams['TOP_VIEW_MODE'] : ''),
                                            'ROTATE_TIMER' => (isset($arParams['TOP_ROTATE_TIMER']) ? $arParams['TOP_ROTATE_TIMER'] : ''),
                                            'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                                            'LABEL_PROP' => $arParams['LABEL_PROP'],
                                            'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                                            'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

                                            'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                                            'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                                            'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                                            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                                            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                                            'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
                                            'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
                                            'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
                                            'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
                                            'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],
                                            'ADD_TO_BASKET_ACTION' => $basketAction,
                                            'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                                            'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                                        ),
                                        false, array("HIDE_ICONS"=>"Y")
                                    );?>
                                    <!--</ul>-->
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        <?endif;?>
        <!--END-->
    <!--</div>-->



    <!--УСЛУГИ-->
    <?if($arResult["SERVICES"]):?>
    <div class="services-block">
        
            <?global $arrSaleFilter; $arrSaleFilter = array("ID" => $arResult["PROPERTIES"]["SERVICES"]["VALUE"]);?>
            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "items-services_custom",
                array(
                    "IBLOCK_TYPE" => "aspro_next_content",
                    "IBLOCK_ID" => $arResult["PROPERTIES"]["SERVICES"]["LINK_IBLOCK_ID"],
                    "NEWS_COUNT" => "20",
                    "SORT_BY1" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "SORT_BY2" => "ID",
                    "SORT_ORDER2" => "DESC",
                    "FILTER_NAME" => "arrSaleFilter",
                    "FIELD_CODE" => array(
                        0 => "NAME",
                        1 => "PREVIEW_TEXT",
                        3 => "PREVIEW_PICTURE",
                        4 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "PERIOD",
                        1 => "REDIRECT",
                        2 => "",
                    ),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "CACHE_TYPE" => "N",
                    "CACHE_TIME" => "36000000",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "N",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_STATUS_404" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "PAGER_TEMPLATE" => ".default",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "PAGER_TITLE" => "�������",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "VIEW_TYPE" => "list",
                    "BIG_BLOCK" => "Y",
                    "IMAGE_POSITION" => "left",
                    "COUNT_IN_LINE" => "2",
                    "TITLE" => ($arParams["BLOCK_SERVICES_NAME"] ? $arParams["BLOCK_SERVICES_NAME"] : GetMessage("SERVICES_TITLE")),
                ),
                $component, array("HIDE_ICONS" => "Y")
            );?>
        
    </div>
    <?endif;?>



    <!--ВТОРОЙ БАНЕР-->
    <?if ($arResult['PROPERTIES']['SECOND_BANNER_CATALOG']['VALUE']):?>
    <div class="catalog_detail-banner second-banner">
        <a href="<?= $arResult['PROPERTIES']['SECOND_BANNER_CATALOG_LINK']['VALUE']?>" class="">
            <span style="background-image: url('<?= CFile::GetPath($arResult['PROPERTIES']['SECOND_BANNER_CATALOG']['VALUE'])?>')"></span>
        </a>
    </div>
    <?endif;?>


    <?/*$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR."include/mainpage/comp_elem_banner_second.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    );*/?>





<!--ОТЗЫВЫ И ВИДЕО-->
    <div class="reviews-and-question">
        <div class="row">
            <?if($arVideo):?>
            <div class="col-md-6">

                        <div class="wraps hidden_print">
                            <h4>
                                <?=($arParams["TAB_VIDEO_NAME"] ? $arParams["TAB_VIDEO_NAME"] : GetMessage("VIDEO_TAB"));?>
                                <?if(count($arVideo) > 1):?>
                                    <span class="count empty">&nbsp;(<?=count($arVideo)?>)</span>
                                <?endif;?>
                            </h4>
                            <div class="video_block">
                                <?if(count($arVideo) > 1):?>
                                    <table class="video_table">
                                        <tbody>
                                            <?foreach($arVideo as $v => $value):?>
                                                <?if(($v + 1) % 2):?>
                                                    <tr>
                                                <?endif;?>
                                                <td width="50%"><?=str_replace('src=', 'width="458" height="257" src=', str_replace(array('width', 'height'), array('data-width', 'data-height'), $value));?></td>
                                                <?if(!(($v + 1) % 2)):?>
                                                    </tr>
                                                <?endif;?>
                                            <?endforeach;?>
                                            <?if(($v + 1) % 2):?>
                                                </tr>
                                            <?endif;?>
                                        </tbody>
                                    </table>
                                <?else:?>
                                    <?=$arVideo[0]?>
                                <?endif;?>
                            </div>
                        </div>

            </div>
            <?endif;?>
            <div class="col-md-6">



                <?if($arParams["USE_REVIEW"] == "Y"):?>
                        <div class="wraps product_reviews_tab hidden_print">

                            <h4><?=($arParams["TAB_REVIEW_NAME"] ? $arParams["TAB_REVIEW_NAME"] : GetMessage("REVIEW_TAB"))?><span class="count empty"></span></h4>
                        </div>
                    <?endif;?>
            </div>
        </div>
    </div>
<!--end-->

    <!--ПОЧЕМУ ПОКУПАЮТ В ДЭФО-->
    <div class="why-buy">

        <h4>Почему покупают в "ДЭФО"</h4>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <a href="/company/" class="why-buy-item">
                    <div class="why-buy-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="35" viewBox="0 0 40 35">
                            <image id="Векторный_смарт-объект" data-name="Векторный смарт-объект" width="40" height="35" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAjCAYAAADmOUiuAAAD8ElEQVRYhb2YeYhWZRTGfzouuYAjppKOhjYuietoNG4UpFKEYhIoiH+URCQuuVSChmEILoiISxv9JS5kSG6gqbngljYKLSpuqJCCCu4Lao48znPl8nHv/e43dueBYbj33Pe8z3fe9z3nOW+t8vJyUqIO8BYwGHgN6Ai0AGoDj4HLwEngMLAN2A78l9Z5HOqk+OZFYCLwMXAH2AgsA04A/5pEEdAa6Az0B5YDjYFvgSXA1eoSTIpgLWA88DWwB1gI7C7A9xvAVGAg8KV/VGWhBOMiqKitAl4GhgO7CnXsH6O/N4HvgaHA6EKjWTviXRtgH3AN6F1NcmFofBlw3X5LnoegNv1Ob/BRwO3nJBfgtv39ZsLNq0NQG30tcNB7r+D9kgfyN87+13q+ggh+DjQDPsqAXIBK+1cEPyuEoPbdDOBD4F5G5ALI/wfATKBtWoJKB5uAQxmTC3DI+XRKvg9FsKEjN6+GyAWYD4wFGiV9JILvAueBozVKr2q+c54/FiI4yLVzkvPUOZ80LXt9D6yXYz/g5Umyfxph3x+y63mra3ssVOoqgA7AGYf9uJ+nuc4OA34BXgDmAqctFHQKH9q+wVVpfsiurPAgZC+yXfN0Ar4ASv19WRLBa/5Vr9thgHqObKmdDoqwK6G/4kkGR9h3AO08PsqulWoPFCctsYxzcgbjZxX5Vk4J1bHPtMqJs2veJklLLILfOMVE4bDL1JEY+5/+/3eMvcLjK2LsmyzNYqtKGsFal6q9FoVii4qmFgNR0N58lG+SOKQRrHHk0iKXXH1rxe4WtVrqvywibuUOjpJbWaEBMBu45G3VyyvQyXtR7xd7NZ4hTQT/D+gkbwZuOO3sjfDZxWlM0RwRlN2aiGCgMdU2DIghJxwzebUWvwKvUkMRVOP0B/BJShm3yHJsJdAn6wiqQgwpgFyAr9wXvZ81wTHAGuBKnu+0kj9azOKTvVRNVtYEy73/wqib86yStw7o4ZofQGW0b9YEXwLOhp7f8WEIOjuR+xlo6VuLcKQvai9mTfB+Tq3dYoklWdY1RG6IU1AYEtL3syYo6dYt9FzpjnG163hxDDlcaU5lTVARGxnxfjrwHvB2DDk8bksagv/k6xsSxMBKd24jImzrgbsx43r5ymVpGoJNfcKi0MFqJu4GQu8nO1mXppgLJ+mffGl1IQ3B1U6cuZpNt1+zbE+Covgd8LtPcRLKrLIPui5TVFKS9y5HH0/wnjnrxrunb6x0+6VkrNOaBOVCqZUfnE4UGC2vLj6VivROSket7wL3O08rT5oI3nSRV5uoKznlKlUH5bN+XuI0WOFlVp+jiiGVrbFS4zo08qf+RASryiLwBCe58fT7hxqlAAAAAElFTkSuQmCC"/>
                        </svg>
                    </div>
                    <span>Надежность</span>
                    <p>25 лет на рынке, 48 филиалов по России</p>
                </a>
            </div>
            <div class="col-md-4 col-sm-4">
                <a href="/company/advantage/better_conditions/" class="why-buy-item">
                    <div class="why-buy-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="27" height="35" viewBox="0 0 27 35">
                            <image id="Векторный_смарт-объект" data-name="Векторный смарт-объект" width="27" height="35" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABsAAAAjCAYAAABl/XGVAAAEUElEQVRIibWXb2xfUxjHP12nw6YznZhgik4zFsxa4cUSm4QbczeuP6+Iv1nUvCUjvCIjhFeM6BDxjjjCNbnEsgmJJcUQ1Vi62YqYWGdl7bLVNvnK9zR3zd3yq7YnObm/9t7zfM95vs/zfZ5TR8VI0mw6sBi4HLgEaAbOBk4FppdWDAJ7gV+AHcB3wNfAZ0UeBkdbHgFL0uwE4CbgPuAq4Bugy8+dwM/AHuBAkYf9SZqdBEwDTgPOAc4FLgPa/fwCeBUIRR6GR8CSNEuAl4FfgReBD4o8/FV16lpGkmaNwA3AKuAs4P4iD0Vdkma3GED/ePf/AhxrJGmWAS8BD9a3tM7fANxe5OHDiQbS6N3a09PSOl9UdE4B5gA/TAZQacj+nCn+uzNJsxmTgWK7nfodwRQt3ydpdleSZg0TBNIge7Jr+yhAjhR50PN6YDVwMbAe+Bj4Etha5OFwDca18QuBNuBaYBnQDTyteBDOf2DyZ5GH373ofCAFrvbC2UCf5z5goIQxE5Cb5nru9gY3AXmRh+22eQawK4LpJLcVeRiq2LEMagNnAk3AyYASer+nAH4Dthd5GKhYr+/f0knLYBcBjwNvF3k4OBGcAbcCT9qdy8qcLTdnLQb/CPhKqVLk4UgNxuu8dhFwnTnrNWfvlzmbVeRhrxfNA5abs3ZzErXxT2kjMGR3ShtnWRvnWpi7zNl7RR56bVPf7IlgrwErizwcqthx0yjOZpZei6P+Emf9FevrgVeAeyKY3KXwfrjIw6bx8lUCkneecT4vimAqLyuBh+yiYM62VNWl4xhXrVtozjK7+lmfbDiCNajmODEXm7MljtCdLowqkH+7WMahYnqKC2uza1oPsFGcuYgedq08ONWL7gTWWSk+9dROFQCtJc6U4Ce6Wg+arx+VwOJMv4s8HKg49N1EuQJUKF8A1ozFbTW69VHVMqAxnky9xvOSpCTNXgdURDdXRWcNAIq+K91i6ESf235vPNlUGU7STCJ8h7VRebPFs8951m8FlycaHVhNpTxb6Nln175Z5KE7STMdajiebIUbk26ryGqLZ5uDZJ6TPGpjHEPegHqXbbFSRFEvDQXcCGeKskfUK9RSTsbgUkV3B/CUojaCycdrrQ5rfcod4wBpdp49YJXRc3M5qRUM1zgNJKJ/uDZ961zrM1eK1n/Es1Og0Xwpxy6160+3mL8BqKGqP4qzIg/vAJ9o+vhx4QInetTGGd7csIvpiDZagJ9TY1umI0mzGxnF2WPKtUngTDn2hDwQwdrN1Ww3lOJs2zhALjBnHa7k4qwrgtVbw5aU8mzAnOmy8FMN2nieLyFtDrSYZxt9wkPibBewVFzphUTULxeUOLuipI3TzNs+F9LdJc6UZ2vUvo2iY2lseGKv31HkIYyPpUqX3myKVh3rFrO+qlMaA0D1Lab0gcJZpN47gfezdRL1o+5nFTurunlqh2pcRt881QTJI8e/eQL/ApZ20J8wb8inAAAAAElFTkSuQmCC"/>
                        </svg>
                    </div>
                    <span>Лучшие цены</span>
                    <p>Скидки и акции на эксклюзивные коллекции</p>
                </a>
            </div>
            <div class="col-md-4 col-sm-4">
                <a href="/company/advantage/10_years_warranty/" class="why-buy-item">
                    <div class="why-buy-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="36" height="35" viewBox="0 0 36 35">
                            <image id="Векторный_смарт-объект" data-name="Векторный смарт-объект" width="36" height="35" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAjCAYAAAD8BaggAAADHUlEQVRYhb2Ya2iOYRjHf9vkNHJIWRlDSVoOzWmYQ0giQqiVb5NDI7QvvmyKhGw5W0oiPiiHIjJqsZx9QYZI+ECJxHIcE131f/X27rmf93mf933ef72tvfe9e7/nvq/7uv7Xk1NaWopDvYH5rsGA+gqcDjh3EVDRwWfCAOAgcCUkTHdgeECg0cAJoNoPqBPwBlgQEigfaAH6AW995tmDXwCOA3W5PhOLgY8hYUzfgEvAWp85tovngUdApX3hAsoBlgO30gAyVQN5jjH7/iTQEVgCtNmXriOrAoYBS9MEeqCPl3YDY4FxOlpcQOuBrcBCxVAUqtQJTAdex68fD1QCbBHxHKAxBRA74j7AhwBzbe09wDLgduKgxVAD8BK4AbzSUaUCY5oLPAZmJZk3QnGzST/bKa+wsNCuWwWwCjgHfE8RxvQcaAWOAJ2BJuBvwpwC4Ko2oMq1kGVq+8NewOcQIImytH8KeAGUA+803lWQP4CZwC/XAn55KIzuKBbbdLtmKL7sFHroojhh8Ln26cgCe7bipEG5zErIhIREa/nnjz7/lekdisn+SY2K81DtzLOEOfWJMAjIklKXiMCsdBQpfuI1SNm5nQzok2pKVGr1WLfIVSdzdSOGRAjkpYHAUxdQs5JhNmVx9cQFdA+YmGWgScB1F5BdzakRpQAv9VS9vOYCsqB+qCSWDZXr1rW4gEyHgdVZAloJHHMNxoCs/owCBkcMY/6nL3A2GdBvYD+wLUIYq2nbgR3Az2RApn3AGKAsIqByWZBDfpPigSyjbtD5dsswTIEeeI0sSCAg1JI06SlsizMh6y6OApe1vq+8qv06WU1rYTKhWqA/sCLIWl7J8AswD7grb1OfBtRGmfky9fmhgFBrYlazUS1xbQiYGnnnKR5eKGUg1N5a3rio/rtK6SGZ8vWSwh5omqpAYCVzjM3qLkeqGBYnmV8iX23VfDxwPxUYAlrY99qpM2rs6vTuKF7WJB4Abirrl4XteoN6avO+O7UDdnwWY7tk3PfqdysJZuY3x14cRAkUk7lL88KTZSPMM1vMmL9ZrPHwAv4BfS+YMd6k4yYAAAAASUVORK5CYII="/>
                        </svg>
                    </div>
                    <span>Гарантия до 10 лет</span>
                    <p>Расширенная гарантия на часть ассортимента</p>
                </a>
            </div>
            <div class="col-md-4 col-sm-4">
                <a href="/services/dostavka/" class="why-buy-item">
                    <div class="why-buy-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="58" height="32" viewBox="0 0 58 32">
                            <image id="Векторный_смарт-объект" data-name="Векторный смарт-объект" width="58" height="32" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAADoAAAAgCAYAAABD9mvVAAAEW0lEQVRYhe2Zf2iVVRjHP+/d2grapmt/FNYfTde0ZqtBUdQflaC5DoeC00+CCMN+gf8UFpEIiZhIK4RKLWxLwcoD5tlBw1rZ71mylglF/xYaWYGxlu6u3njme8e7u3vv9vrebRZ94eXynh/P9/2eH895znMDEkBp8ytQn6RPmfCYd7YjjanKhO1F5Crgk6lWFsOrQG1aI0mFCg57Z/enJZ4slDYD5bAzKjQMwweA60s17nl/P82XNK3o3r3z1jJw9wVBsLEMdiaF+IyKyPtKdVp00w3yc2OZuGcBMyK0IMIw5L2eDxgc/LMshG1tV3DRhXPKYisJJhR68uQQrnsPg4ODZSGsrq6aEaGjx0sYhp0TLd0yY3cQBBPudaVNPzAfOFGi2VfALd7ZorNxOl53JvAO8HYR3ipgLWCVNto7O/xvFtrvne0sVqm0+UYOBWCL0maZdzbMbzNO6LbtO/jyYB9DQ0McO/ZLqq+rqamhc+umVDYmA+/s50qbu4BdwA/A6vxu44RevrCF2tpastnsiNixkC09drDCQi/BqZaZTGbKRebgnXVKm0eATUqbH72zr8TrxwltbV048hAdLTkEwdiwWOqkOgz/LkgcBBkymUShdGp4ZzcrbeZEYo96Z33OZskhF3G5p1CdCKmoqCj4TLfIGGTZdgFvKW2uyRVXKm0aJWju7z9UX1t3KnYeGBjg+PHfEzMsmN9MQ8N5U/Hxk4Y4IqXNcuACoFtpc5139ntZul8D565avSY1yby5jTzfsX7aRBWDHDFKGwN8KEeT0uZaEXo+cFZX55aXqquq7pa+2ewwQ9l8RzQxZtXVzbjIHLyzfyht2oHPZGYrpUDq6mfvTK7sDId39melzVPAm3Gvu7FE9DGCtes27Gq7svXZpTcvPlAGiUenaZhGJnBUaBAEfXJHLNVDaUNv7xcH2pcuKTkgZyKm70SfYfwv9L+G1LcXpY2EQA8CjwKXAuLF90m20Dv77VSNl1zJgJXA1YDEoZ8Ca4ol7lLNaCSyK/LYHwF3Ao8DFwMHJSpJY78Er3DsBo5EyYLlkXftUdrcX6hP2hmV6OPe6Ha/N/Yhr0VH1TalTZN39q+UPKNQ2siqkfBrpXd2Q6zqdaXNc8CLSpu93tmf4v2SZurDaJnui4okuXzCO6sKtG0GvgMk2upNoW1PxPdC9C6zKXyN3tkxVyelzTmACOyIVppgMbA5qVBJBZ6dV7zeO/tkkfaS1qhIwjFJyIy1F+GUHFNrXvFw0qXbBDTE3mWULytCOC8SuWyiQCQhxOktUtpkCsxodeQfZGm/Eav6LdWlUWlzR2RwiXf23Vh5ZbRHZRCaiiWsTpOzBTgkSzj/jyeljQhcAcz1zh6J16UVKv23A7cDLwPi2mcDDwEt0QB8nIajCK9slXXAjihPJAN7T7R3JTm2Nb9P6jSA0kaW58OA5GsWALKPxXk87Z09nNZ+Cd7bgCeAq6JslZyjz3hnJRs4FsA/z8paLT/ZobUAAAAASUVORK5CYII="/>
                        </svg>

                    </div>
                    <span>Быстрая доставка в любой город</span>
                    <p>Доставка от 24 часов. Мебель в наличии на складе</p>
                </a>
            </div>
            <div class="col-md-4 col-sm-4">
                <a href="/help/payment/" class="why-buy-item">
                    <div class="why-buy-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" viewBox="0 0 35 35">
                            <image id="Векторный_смарт-объект" data-name="Векторный смарт-объект" width="35" height="35" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAACmElEQVRYhe2YX4jMURTHP6tZ1EoRIn8itEspxKM/7Zu6Xf9uaUvJA0ryoF0UxYZ4IpR92H2QkuRKrpsXyQPx4MF4EltKHiwPKG2LsDrTGY1pfrOza34zHub7MjNnzr33c8+cOffcXxMpyFi3GjgDtAMPgI0x+C8jrTSumijGugXGumvAY+AFsAKYAhyrZHxVImOskwWPAvuAu8ChGPwr/W4NcB9oi8G/Tg3GWDdBAQTkJdAZg39Uwu8mMByDd1WHMdbJuA7gFPALOAz4GPxwgv9C/dnaS8H+BWOsWwvsBWZWyCN+04ATQE8M/nsFGzgLbAP61TQE3AL6YvCyITLGuq3AVTEC94CfCfMtAfbr+wvA6Rj85wrhUfAdwAfNqznASWAVsFscmox1QnopBn8uYUcShW5gJ3Bd8iMG/2YUEIVzyWY6gdYY/JCxbhnwXD/3Z4BFSirOB4GlBeObpUYALTpIotZtbNk8LCeZby4QjXVv1e+rrpmDEX3T109Acej7xrpygs4XmQfzuZsptMbge6u88Igy1q3P+1S1Av+rGjBJasAkKTO2YaOTsW6D9jbTSwycJ5XdWLcpVRhj3XjgBrAOuK11rFhXgMlS4dOOjDRVbdrLDJSBnl8LmF3AHgEx1q0EjgB3YvCXSzmnlsDGuhbNkaya5NTeAvQa60oGITWYGPyg9iyz8yZtxGIM/kdNYVQeOG6sa47B9wATY/Cbk5zTzpku4CHwxFgnp/9AQvsxI3WYGPx7vUMdALYDk0q4tQpkrl8y1g3rX6suMtZlpeDROJvKqAGTpP8Spp5Qf8qLQHwElteDwlgnrcNi4F2e6qJcV7UyZvX8qIVm6eH5DHiahxGDPD2QO9PUGgZGHhZIw9WRu/gDvwGbxr4u3XihWgAAAABJRU5ErkJggg=="/>
                        </svg>
                    </div>
                    <span>Любые способы оплаты</span>
                    <p>Безналичный и наличный расчет, оплата картой</p>
                </a>
            </div>
            <div class="col-md-4 col-sm-4">
                    <span class="why-buy-item" data-event="jqm" data-param-form_id="CALLBACK" data-name="CALLBACK" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">
                        <div class="why-buy-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="35" viewBox="0 0 40 35">
                                <image id="Векторный_смарт-объект" data-name="Векторный смарт-объект" width="40" height="35" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAjCAYAAADmOUiuAAAC50lEQVRYhdXYW4hVdRTH8U/jRGmoSAOCDlaKihI9lOhgBCUp1kOEiniDehB8CAoVQrygpF1AKAeqBx800SLIIIVEBX3xhiDqg5pFhRBIyFRY3sdCFqyTMpwz58xpzj72e9ls9t7/9f3/93+t9V/rgY6ODnVqGF7BNDyN0RiUQ13HTziFg9iN3+sx01rHN+OxCnPxYEIcwmf4Ld95NIGnYCFu4yu8h3ONAhyId/EmLmIlvsCvVb4bjvlYhnn4JL+9WovRWn/xWHyDx7EOnbhV07TuqjUn9w5+wav4vtpHLTUM/BSOxWTwDDbWASd/84c5xj855pT/ChgrdyA3/LM4XwdYT8WqTc3r3tzTdQHGntuFLszEH/0AV9LlHPNibp1BlV7sDXADnsCcfoa7F3I2HsP7fQUcmxt6Pc42AK6k8+l0b2BCXwBX5K/9qIFwJW3CJbxd7mE5wMEZrz7NjNBoRUT4OG0OrQQY1zG5WWfkdXsBcCWFrYfxUtoeU2KLQB0paU+6+xVcwEMYVyBg6LuMj+E0j2QYejkoN+NvPIeteBInC4YLncBEbEmWYNoc6ecFvI7DOI4lGZiL1oXcj8vRjQ/iANKS//qvhOlOx+hqAmBX2u7O+2BqqRRmGhGYq+lyuee1HBaaqv8t4H0DHiDX8ngeasMQjGgCy9W03Zb3wXQ9wswOrM0iaHoeTIsO0qH96cnfYh/eigwTK7gU27AgZ7EGk5oAGF78Ymazhcm0tFxNMiRLxFF5oGyqyjnDnziKWc2G04u3Rj5cXDBLWVUC/BIjs25oqioB3sjycmOd3Yd+U28BuTOfr24mYG+rczPd/XCeD3cXyPWvqqW003gNn2cnq3ANaG9vr2YzjuI/ZN0QBdWRbGMUolod4OusYSO6L8oqbCd+zhbc81lH9NQZ/FgEoCzgJ2c3YEm24iItxWqWEnxPRREUzae6i/++HqvCYDQiI2dGSox6JgqtKHDKKWqbUlOz78IdzaqVvjR9XmAAAAAASUVORK5CYII="/>
                            </svg>
                        </div>
                        <span>Бесплатный звонок по России</span>
                        <p>Консультация по любым вопросам по тел.: 8(800)505-45-79</p>
                    </span>
            </div>
        </div>

    </div>



<!--ФОРМА-->

	<?if(($arParams["SHOW_ASK_BLOCK"] == "Y") && (intVal($arParams["ASK_FORM_ID"]))):?>
		<div class="wraps hidden_print form-container">

			<div id="ask" class="tab-pane">
				<div class="row">

					<div class="col-md-4 form_block">
					    <!--<h4><?/*=($arParams["TAB_FAQ_NAME"] ? $arParams["TAB_FAQ_NAME"] : GetMessage('ASK_TAB'))*/?></h4>-->
					    <h4>Бесплатный 3D дизайн-проект в цвете</h4>
						<div id="ask_block"></div>
					</div>
					<div class="col-md-8 form_pic_block" style="background-image: url(<?SITE_DIR?>/images/form-block-bg.jpg)">

					</div>
				</div>
			</div>
		</div>
	<?endif;?>
<!--end-->













	<?/*if($arResult["PROPERTIES"]["PODBORKI"]["VALUE"]):*/?><!--
		<div class="wraps podborki">
			<?/*$GLOBALS['arrFilterLanding'] = array("ID" => $arResult["PROPERTIES"]["PODBORKI"]["VALUE"]);*/?>
			<?/*$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"news-project",
				array(
					"IBLOCK_TYPE" => "aspro_next_content",
					"IBLOCK_ID" => $arResult["PROPERTIES"]["PODBORKI"]["LINK_IBLOCK_ID"],
					"NEWS_COUNT" => "20",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "ID",
					"SORT_ORDER2" => "DESC",
					"FILTER_NAME" => "arrFilterLanding",
					"FIELD_CODE" => array(
						0 => "NAME",
						1 => "PREVIEW_PICTURE",
						2 => "",
					),
					"PROPERTY_CODE" => array(
						0 => "PERIOD",
						1 => "REDIRECT",
						2 => "",
					),
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => "N",
					"CACHE_TIME" => "36000000",
					"CACHE_FILTER" => "Y",
					"CACHE_GROUPS" => "N",
					"PREVIEW_TRUNCATE_LEN" => "",
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"SET_TITLE" => "N",
					"SET_STATUS_404" => "N",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"INCLUDE_SUBSECTIONS" => "Y",
					"PAGER_TEMPLATE" => ".default",
					"DISPLAY_TOP_PAGER" => "N",
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"PAGER_TITLE" => "�������",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"VIEW_TYPE" => "block",
					"BIG_BLOCK" => "Y",
					"SHOW_MORE" => "N",
					"IMAGE_POSITION" => "left",
					"COUNT_IN_LINE" => "3",
					"TITLE" => ($arParams["BLOCK_LANDINGS_NAME"] == "N" ? GetMessage("BLOCK_LANDINGS_NAME") : $arParams["BLOCK_LANDINGS_NAME"]),
				),
				$component, array("HIDE_ICONS" => "Y")
			);*/?>
		</div>
	<?/*endif;*/?>
	<div class="wraps podborki">
		<?/*$GLOBALS['arrFilterBlog'] = array("PROPERTY_LINK_GOODS" => $arResult["ID"]);*/?>
		<?/*$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			// "news-project",
			"news5",
			array(
				"IBLOCK_TYPE" => "aspro_next_content",
				"IBLOCK_ID" => $arParams["BLOG_IBLOCK_ID"],
				"NEWS_COUNT" => "20",
				"SORT_BY1" => "SORT",
				"SORT_ORDER1" => "ASC",
				"SORT_BY2" => "ID",
				"SORT_ORDER2" => "DESC",
				"FILTER_NAME" => "arrFilterBlog",
				"FIELD_CODE" => array(
					0 => "NAME",
					1 => "PREVIEW_PICTURE",
					2 => "",
				),
				"PROPERTY_CODE" => array(
					0 => "PERIOD",
					1 => "REDIRECT",
					2 => "",
				),
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CACHE_TYPE" => "N",
				"CACHE_TIME" => "36000000",
				"CACHE_FILTER" => "Y",
				"CACHE_GROUPS" => "N",
				"PREVIEW_TRUNCATE_LEN" => "",
				"ACTIVE_DATE_FORMAT" => "j F Y",
				"SET_TITLE" => "N",
				"SET_STATUS_404" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"INCLUDE_SUBSECTIONS" => "Y",
				"PAGER_TEMPLATE" => ".default",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"PAGER_TITLE" => "�������",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"VIEW_TYPE" => "block",
				"BIG_BLOCK" => "Y",
				"SHOW_MORE" => "N",
				"IMAGE_POSITION" => "left",
				"COUNT_IN_LINE" => "3",
				"TITLE" => ($arParams["BLOCK_BLOG_NAME"] == "N" ? GetMessage("BLOCK_BLOG_NAME") : $arParams["BLOCK_BLOG_NAME"]),
			),
			$component, array("HIDE_ICONS" => "Y")
		);*/?>
	</div>-->
























<?/*if($arParams["SHOW_ADDITIONAL_TAB"] == "Y"):*/?><!--
		<div class="wraps">

			<h4><?/*=($arParams["TAB_DOPS_NAME"] ? $arParams["TAB_DOPS_NAME"] : GetMessage("ADDITIONAL_TAB"));*/?></h4>
			<div class="additional_block" id="dops">
				<?/*$APPLICATION->IncludeFile(SITE_DIR."include/additional_products_description.php", array(), array("MODE" => "html", "NAME" => GetMessage('CT_BCE_CATALOG_ADDITIONAL_DESCRIPTION')));*/?>
			</div>
		</div>
	--><?/*endif;*/?>
</div>

<!--<div class="gifts">
<?/*if ($arResult['CATALOG'] && $arParams['USE_GIFTS_DETAIL'] == 'Y' && \Bitrix\Main\ModuleManager::isModuleInstalled("sale"))
{
	$APPLICATION->IncludeComponent("bitrix:sale.gift.product", "main", array(
			"USE_REGION" => $arParams['USE_REGION'],
			"STORES" => $arParams['STORES'],
			"SHOW_UNABLE_SKU_PROPS"=>$arParams["SHOW_UNABLE_SKU_PROPS"],
			'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
			'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'SUBSCRIBE_URL_TEMPLATE' => $arResult['~SUBSCRIBE_URL_TEMPLATE'],
			'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
			"OFFER_HIDE_NAME_PROPS" => $arParams["OFFER_HIDE_NAME_PROPS"],

			"SHOW_DISCOUNT_PERCENT" => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
			"SHOW_OLD_PRICE" => $arParams['GIFTS_SHOW_OLD_PRICE'],
			"PAGE_ELEMENT_COUNT" => $arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],
			"LINE_ELEMENT_COUNT" => $arParams['GIFTS_DETAIL_PAGE_ELEMENT_COUNT'],
			"HIDE_BLOCK_TITLE" => $arParams['GIFTS_DETAIL_HIDE_BLOCK_TITLE'],
			"BLOCK_TITLE" => $arParams['GIFTS_DETAIL_BLOCK_TITLE'],
			"TEXT_LABEL_GIFT" => $arParams['GIFTS_DETAIL_TEXT_LABEL_GIFT'],
			"SHOW_NAME" => $arParams['GIFTS_SHOW_NAME'],
			"SHOW_IMAGE" => $arParams['GIFTS_SHOW_IMAGE'],
			"MESS_BTN_BUY" => $arParams['GIFTS_MESS_BTN_BUY'],

			"SHOW_PRODUCTS_{$arParams['IBLOCK_ID']}" => "Y",
			"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
			"PRODUCT_SUBSCRIPTION" => $arParams["PRODUCT_SUBSCRIPTION"],
			"MESS_BTN_DETAIL" => $arParams["MESS_BTN_DETAIL"],
			"MESS_BTN_SUBSCRIBE" => $arParams["MESS_BTN_SUBSCRIBE"],
			"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
			"PRICE_CODE" => $arParams["PRICE_CODE"],
			"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
			"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
			"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
			"CURRENCY_ID" => $arParams["CURRENCY_ID"],
			"BASKET_URL" => $arParams["BASKET_URL"],
			"ADD_PROPERTIES_TO_BASKET" => $arParams["ADD_PROPERTIES_TO_BASKET"],
			"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
			"PARTIAL_PRODUCT_PROPERTIES" => $arParams["PARTIAL_PRODUCT_PROPERTIES"],
			"USE_PRODUCT_QUANTITY" => 'N',
			"OFFER_TREE_PROPS_{$arResult['OFFERS_IBLOCK']}" => $arParams['OFFER_TREE_PROPS'],
			"CART_PROPERTIES_{$arResult['OFFERS_IBLOCK']}" => $arParams['OFFERS_CART_PROPERTIES'],
			"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"SHOW_DISCOUNT_TIME" => $arParams["SHOW_DISCOUNT_TIME"],
			"SALE_STIKER" => $arParams["SALE_STIKER"],
			"STIKERS_PROP" => $arParams["STIKERS_PROP"],
			"SHOW_OLD_PRICE" => $arParams["SHOW_OLD_PRICE"],
			"SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
			"DISPLAY_TYPE" => "block",
			"SHOW_RATING" => $arParams["SHOW_RATING"],
			"DISPLAY_COMPARE" => $arParams["DISPLAY_COMPARE"],
			"DISPLAY_WISH_BUTTONS" => $arParams["DISPLAY_WISH_BUTTONS"],
			"DEFAULT_COUNT" => $arParams["DEFAULT_COUNT"],
			"TYPE_SKU" => "Y",

			"POTENTIAL_PRODUCT_TO_BUY" => array(
				'ID' => isset($arResult['ID']) ? $arResult['ID'] : null,
				'MODULE' => isset($arResult['MODULE']) ? $arResult['MODULE'] : 'catalog',
				'PRODUCT_PROVIDER_CLASS' => isset($arResult['PRODUCT_PROVIDER_CLASS']) ? $arResult['PRODUCT_PROVIDER_CLASS'] : 'CCatalogProductProvider',
				'QUANTITY' => isset($arResult['QUANTITY']) ? $arResult['QUANTITY'] : null,
				'IBLOCK_ID' => isset($arResult['IBLOCK_ID']) ? $arResult['IBLOCK_ID'] : null,

				'PRIMARY_OFFER_ID' => isset($arResult['OFFERS'][0]['ID']) ? $arResult['OFFERS'][0]['ID'] : null,
				'SECTION' => array(
					'ID' => isset($arResult['SECTION']['ID']) ? $arResult['SECTION']['ID'] : null,
					'IBLOCK_ID' => isset($arResult['SECTION']['IBLOCK_ID']) ? $arResult['SECTION']['IBLOCK_ID'] : null,
					'LEFT_MARGIN' => isset($arResult['SECTION']['LEFT_MARGIN']) ? $arResult['SECTION']['LEFT_MARGIN'] : null,
					'RIGHT_MARGIN' => isset($arResult['SECTION']['RIGHT_MARGIN']) ? $arResult['SECTION']['RIGHT_MARGIN'] : null,
				),
			)
		), $component, array("HIDE_ICONS" => "Y"));
}
if ($arResult['CATALOG'] && $arParams['USE_GIFTS_MAIN_PR_SECTION_LIST'] == 'Y' && \Bitrix\Main\ModuleManager::isModuleInstalled("sale"))
{
	$APPLICATION->IncludeComponent(
			"bitrix:sale.gift.main.products",
			"main",
			array(
				"USE_REGION" => $arParams['USE_REGION'],
				"STORES" => $arParams['STORES'],
				"SHOW_UNABLE_SKU_PROPS"=>$arParams["SHOW_UNABLE_SKU_PROPS"],
				"PAGE_ELEMENT_COUNT" => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT'],
				"BLOCK_TITLE" => $arParams['GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE'],

				"OFFERS_FIELD_CODE" => $arParams["OFFERS_FIELD_CODE"],
				"OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],

				"AJAX_MODE" => $arParams["AJAX_MODE"],
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],

				"ELEMENT_SORT_FIELD" => 'ID',
				"ELEMENT_SORT_ORDER" => 'DESC',
				//"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
				//"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
				"FILTER_NAME" => 'searchFilter',
				"SECTION_URL" => $arParams["SECTION_URL"],
				"DETAIL_URL" => $arParams["DETAIL_URL"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],

				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],

				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"PROPERTY_CODE" => $arParams["PROPERTY_CODE"],
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
				"CURRENCY_ID" => $arParams["CURRENCY_ID"],
				"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
				"TEMPLATE_THEME" => (isset($arParams["TEMPLATE_THEME"]) ? $arParams["TEMPLATE_THEME"] : ""),

				"ADD_PICT_PROP" => (isset($arParams["ADD_PICT_PROP"]) ? $arParams["ADD_PICT_PROP"] : ""),

				"LABEL_PROP" => (isset($arParams["LABEL_PROP"]) ? $arParams["LABEL_PROP"] : ""),
				"OFFER_ADD_PICT_PROP" => (isset($arParams["OFFER_ADD_PICT_PROP"]) ? $arParams["OFFER_ADD_PICT_PROP"] : ""),
				"OFFER_TREE_PROPS" => (isset($arParams["OFFER_TREE_PROPS"]) ? $arParams["OFFER_TREE_PROPS"] : ""),
				"SHOW_DISCOUNT_PERCENT" => (isset($arParams["SHOW_DISCOUNT_PERCENT"]) ? $arParams["SHOW_DISCOUNT_PERCENT"] : ""),
				"SHOW_OLD_PRICE" => (isset($arParams["SHOW_OLD_PRICE"]) ? $arParams["SHOW_OLD_PRICE"] : ""),
				"MESS_BTN_BUY" => (isset($arParams["MESS_BTN_BUY"]) ? $arParams["MESS_BTN_BUY"] : ""),
				"MESS_BTN_ADD_TO_BASKET" => (isset($arParams["MESS_BTN_ADD_TO_BASKET"]) ? $arParams["MESS_BTN_ADD_TO_BASKET"] : ""),
				"MESS_BTN_DETAIL" => (isset($arParams["MESS_BTN_DETAIL"]) ? $arParams["MESS_BTN_DETAIL"] : ""),
				"MESS_NOT_AVAILABLE" => (isset($arParams["MESS_NOT_AVAILABLE"]) ? $arParams["MESS_NOT_AVAILABLE"] : ""),
				'ADD_TO_BASKET_ACTION' => (isset($arParams["ADD_TO_BASKET_ACTION"]) ? $arParams["ADD_TO_BASKET_ACTION"] : ""),
				'SHOW_CLOSE_POPUP' => (isset($arParams["SHOW_CLOSE_POPUP"]) ? $arParams["SHOW_CLOSE_POPUP"] : ""),
				'DISPLAY_COMPARE' => (isset($arParams['DISPLAY_COMPARE']) ? $arParams['DISPLAY_COMPARE'] : ''),
				'COMPARE_PATH' => (isset($arParams['COMPARE_PATH']) ? $arParams['COMPARE_PATH'] : ''),
				"SHOW_DISCOUNT_TIME" => $arParams["SHOW_DISCOUNT_TIME"],
				"SALE_STIKER" => $arParams["SALE_STIKER"],
				"STIKERS_PROP" => $arParams["STIKERS_PROP"],
				"SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
				"DISPLAY_TYPE" => "block",
				"SHOW_RATING" => $arParams["SHOW_RATING"],
				"DISPLAY_WISH_BUTTONS" => $arParams["DISPLAY_WISH_BUTTONS"],
				"DEFAULT_COUNT" => $arParams["DEFAULT_COUNT"],
			)
			+ array(
				'OFFER_ID' => empty($arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID']) ? $arResult['ID'] : $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['ID'],
				'SECTION_ID' => $arResult['SECTION']['ID'],
				'ELEMENT_ID' => $arResult['ID'],
			),
			$component,
			array("HIDE_ICONS" => "Y")
	);
}
*/?>
</div>-->
<script type="text/javascript">
	BX.message({
		QUANTITY_AVAILIABLE: '<? echo COption::GetOptionString("aspro_next_b2c", "EXPRESSION_FOR_EXISTS", GetMessage("EXPRESSION_FOR_EXISTS_DEFAULT"), SITE_ID); ?>',
		QUANTITY_NOT_AVAILIABLE: '<? echo COption::GetOptionString("aspro_next_b2c", "EXPRESSION_FOR_NOTEXISTS", GetMessage("EXPRESSION_FOR_NOTEXISTS"), SITE_ID); ?>',
		ADD_ERROR_BASKET: '<? echo GetMessage("ADD_ERROR_BASKET"); ?>',
		ADD_ERROR_COMPARE: '<? echo GetMessage("ADD_ERROR_COMPARE"); ?>',
		ONE_CLICK_BUY: '<? echo GetMessage("ONE_CLICK_BUY"); ?>',
		MORE_TEXT_BOTTOM: '<?=\Bitrix\Main\Config\Option::get("aspro_next_b2c", "EXPRESSION_READ_MORE_OFFERS_DEFAULT", GetMessage("MORE_TEXT_BOTTOM"));?>',
		TYPE_SKU: '<? echo $arParams['TYPE_SKU']; ?>',
		HAS_SKU_PROPS: '<? echo ($arResult['OFFERS_PROP'] ? 'Y' : 'N'); ?>',
		SITE_ID: '<? echo SITE_ID; ?>'
	})
</script>
<?if($templateData['BRAND_ITEM'] || (\Bitrix\Main\ModuleManager::isModuleInstalled("sale") && (!isset($arParams['USE_BIG_DATA']) || $arParams['USE_BIG_DATA'] != 'N'))):?>
	</div>
<?endif;?>
        <?if ($arResult["IS_3DVIEW"] == "Y"){?>
            <script src="https://o3d.ru/defo/build/three.min.js"></script>
            <script type="text/javascript" src="https://o3d.ru/vitra/View3dScript.js"></script>
        <?}?>
