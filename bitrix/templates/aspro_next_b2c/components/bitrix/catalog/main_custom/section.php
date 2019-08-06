<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<?$this->setFrameMode(true);?>

<?

use Bitrix\Main\Loader,
    Bitrix\Main\ModuleManager;

Loader::includeModule("iblock");

global $arTheme, $NextSectionID, $arRegion;
$arPageParams = $arSection = $section = array();


// get current section ID
if($arResult["VARIABLES"]["SECTION_ID"] > 0){
    $section=CNextCache::CIBlockSection_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CNextCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('GLOBAL_ACTIVE' => 'Y', "ID" => $arResult["VARIABLES"]["SECTION_ID"], "IBLOCK_ID" => $arParams["IBLOCK_ID"]), false, array("ID", 'UF_METKA',"IBLOCK_ID", "PICTURE", "NAME", "DESCRIPTION","UF_SERIES", "UF_PROS_SERIES", "UF_SECTION_DESCR", "UF_OFFERS_TYPE","UF_DISCOUNT", $arParams["SECTION_DISPLAY_PROPERTY"], "IBLOCK_SECTION_ID", "DEPTH_LEVEL", "LEFT_MARGIN", "RIGHT_MARGIN", "UF_SERIES_GALLERY", "UF_NAME_RUS", "UF_PREVIEW"));
}
elseif(strlen(trim($arResult["VARIABLES"]["SECTION_CODE"])) > 0){

    $section=CNextCache::CIBlockSection_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CNextCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('GLOBAL_ACTIVE' => 'Y', "=CODE" => $arResult["VARIABLES"]["SECTION_CODE"], "IBLOCK_ID" => $arParams["IBLOCK_ID"]), false, array("ID", 'UF_METKA', "IBLOCK_ID", "PICTURE", "NAME", "DESCRIPTION", "UF_SERIES", "UF_PROS_SERIES", "UF_SECTION_DESCR", "UF_OFFERS_TYPE","UF_DISCOUNT", $arParams["SECTION_DISPLAY_PROPERTY"], "IBLOCK_SECTION_ID", "DEPTH_LEVEL", "LEFT_MARGIN", "RIGHT_MARGIN"));
}

$typeSKU = '';


if($section){

    $arSection["ID"] = $section["ID"];
    $arSection["NAME"] = $section["NAME"];
    $arSection["IBLOCK_SECTION_ID"] = $section["IBLOCK_SECTION_ID"];
    if($section[$arParams["SECTION_DISPLAY_PROPERTY"]]){
        $arDisplayRes = CUserFieldEnum::GetList(array(), array("ID" => $section[$arParams["SECTION_DISPLAY_PROPERTY"]]));
        if($arDisplay = $arDisplayRes->GetNext()){
            $arSection["DISPLAY"] = $arDisplay["XML_ID"];
        }
    }
    if(strlen($section["DESCRIPTION"]))
        $arSection["DESCRIPTION"] = $section["DESCRIPTION"];
    if(strlen($section["UF_SECTION_DESCR"]))
        $arSection["UF_SECTION_DESCR"] = $section["UF_SECTION_DESCR"];
    $posSectionDescr = COption::GetOptionString("aspro_next_b2c", "SHOW_SECTION_DESCRIPTION", "BOTTOM", SITE_ID);

    $iSectionsCount = CNextCache::CIBlockSection_GetCount(array('CACHE' => array("TAG" => CNextCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array("SECTION_ID" => $arSection["ID"], "ACTIVE" => "Y", "GLOBAL_ACTIVE" => "Y"));

    $catalog_available = $arParams['HIDE_NOT_AVAILABLE'];
    if (!isset($arParams['HIDE_NOT_AVAILABLE']))
        $catalog_available = 'N';
    if ($arParams['HIDE_NOT_AVAILABLE'] != 'Y' && $arParams['HIDE_NOT_AVAILABLE'] != 'L')
        $catalog_available = 'N';
    if($arParams['HIDE_NOT_AVAILABLE'] == 'Y')
        $catalog_available = 'Y';
    $arElementFilter = array("SECTION_ID" => $arSection["ID"], "ACTIVE" => "Y", "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"], "IBLOCK_ID" => $arParams["IBLOCK_ID"]);
    if($arParams["INCLUDE_SUBSECTIONS"] == "A")
    {
        $arElementFilter["INCLUDE_SUBSECTIONS"] = "Y";
        $arElementFilter["SECTION_GLOBAL_ACTIVE"] = "Y";
        $arElementFilter["SECTION_ACTIVE "] = "Y";
    }
    if($arParams['HIDE_NOT_AVAILABLE'] == 'Y')
        $arElementFilter["CATALOG_AVAILABLE"] = $catalog_available;

    $itemsCnt = CNextCache::CIBlockElement_GetList(array("CACHE" => array("TAG" => CNextCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arElementFilter, array());

    //set offer view type
    $typeTmpSKU = 0;
    if($section['UF_OFFERS_TYPE'])
        $typeTmpSKU = $section['UF_OFFERS_TYPE'];
    else
    {
        if($section["DEPTH_LEVEL"] > 2)
        {
            $sectionParent = CNextCache::CIBlockSection_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CNextCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('GLOBAL_ACTIVE' => 'Y', "ID" => $section["IBLOCK_SECTION_ID"], "IBLOCK_ID" => $arParams["IBLOCK_ID"]), false, array("ID", "IBLOCK_ID", "NAME", "UF_OFFERS_TYPE"));
            if($sectionParent['UF_OFFERS_TYPE'] && !$typeTmpSKU)
                $typeTmpSKU = $sectionParent['UF_OFFERS_TYPE'];

            if(!$typeTmpSKU)
            {
                $sectionRoot = CNextCache::CIBlockSection_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CNextCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('GLOBAL_ACTIVE' => 'Y', "<=LEFT_BORDER" => $section["LEFT_MARGIN"], ">=RIGHT_BORDER" => $section["RIGHT_MARGIN"], "DEPTH_LEVEL" => 1, "IBLOCK_ID" => $arParams["IBLOCK_ID"]), false, array("ID", "IBLOCK_ID", "NAME", "UF_OFFERS_TYPE"));
                if($sectionRoot['UF_OFFERS_TYPE'] && !$typeTmpSKU)
                    $typeTmpSKU = $sectionRoot['UF_OFFERS_TYPE'];
            }
        }
        else
        {
            $sectionRoot = CNextCache::CIBlockSection_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CNextCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array('GLOBAL_ACTIVE' => 'Y', "<=LEFT_BORDER" => $section["LEFT_MARGIN"], ">=RIGHT_BORDER" => $section["RIGHT_MARGIN"], "DEPTH_LEVEL" => 1, "IBLOCK_ID" => $arParams["IBLOCK_ID"]), false, array("ID", "IBLOCK_ID", "NAME", "UF_OFFERS_TYPE"));
            if($sectionRoot['UF_OFFERS_TYPE'] && !$typeTmpSKU)
                $typeTmpSKU = $sectionRoot['UF_OFFERS_TYPE'];
        }
    }
    if($typeTmpSKU)
    {
        $rsTypes = CUserFieldEnum::GetList(array(), array("ID" => $typeTmpSKU));
        if($arType = $rsTypes->GetNext())
        {
            $typeSKU = $arType['XML_ID'];
            $arTheme["TYPE_SKU"]["VALUE"] = $typeSKU;
        }

    }
}

if($arParams['STORES'])
{
    foreach($arParams['STORES'] as $key => $store)
    {
        if(!$store)
            unset($arParams['STORES'][$key]);
    }
}
if($arRegion)
{
    if($arRegion['LIST_PRICES'])
    {
        if(reset($arRegion['LIST_PRICES']) != 'component')
            $arParams['PRICE_CODE'] = array_keys($arRegion['LIST_PRICES']);
    }
    if($arRegion['LIST_STORES'])
    {
        if(reset($arRegion['LIST_STORES']) != 'component')
            $arParams['STORES'] = $arRegion['LIST_STORES'];
    }
}

$NextSectionID = $arSection["ID"];?>

<?
//seo
$arSeoItems = CNextCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" =>"Y", "TAG" => CNextCache::GetIBlockCacheTag(CNextCache::$arIBlocks[SITE_ID]["aspro_next_catalog"]["aspro_next_catalog_info"][0]))), array("IBLOCK_ID" => CNextCache::$arIBlocks[SITE_ID]["aspro_next_catalog"]["aspro_next_catalog_info"][0], "ACTIVE"=>"Y"), false, false, array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_PICTURE", "PROPERTY_FILTER_URL", "PROPERTY_LINK_REGION", "PROPERTY_FORM_QUESTION", "PROPERTY_SECTION_SERVICES", "PROPERTY_TIZERS", "PROPERTY_SECTION", "DETAIL_TEXT", "ElementValues"));
$arSeoItem = $arTmpRegionsLanding = array();
if($arSeoItems)
{
    $iLandingItemID = 0;
    $current_url =  $APPLICATION->GetCurDir();
    $url = urldecode(str_replace(' ', '+', $current_url));
    foreach($arSeoItems as $arItem)
    {
        if(urldecode($arItem["PROPERTY_FILTER_URL_VALUE"]) == $url)
        {
            $arSeoItem = $arItem;
            $iLandingItemID = $arSeoItem['ID'];
            break;
        }
    }
    if($arRegion)
    {
        if($arSeoItem)
        {
            if($arSeoItem['PROPERTY_LINK_REGION_VALUE'])
            {
                if(!is_array($arSeoItem['PROPERTY_LINK_REGION_VALUE']))
                    $arSeoItem['PROPERTY_LINK_REGION_VALUE'] = (array)$arSeoItem['PROPERTY_LINK_REGION_VALUE'];
                if(!in_array($arRegion['ID'], $arSeoItem['PROPERTY_LINK_REGION_VALUE']))
                    $arSeoItem = array();
            }
        }
        else
        {//top-page-tizers
            foreach($arSeoItems as $arItem)
            {
                if($arItem['PROPERTY_LINK_REGION_VALUE'])
                {
                    if(!is_array($arItem['PROPERTY_LINK_REGION_VALUE']))
                        $arItem['PROPERTY_LINK_REGION_VALUE'] = (array)$arItem['PROPERTY_LINK_REGION_VALUE'];
                    if(!in_array($arRegion['ID'], $arItem['PROPERTY_LINK_REGION_VALUE']))
                        $arTmpRegionsLanding[] = $arItem['ID'];
                }
            }
        }
    }
}
if($arRegion)
{
    if($arRegion["LIST_STORES"] && $arParams["HIDE_NOT_AVAILABLE"] == "Y")
    {
        $arTmpFilter["LOGIC"] = "OR";
        foreach($arParams['STORES'] as $storeID)
        {
            $arTmpFilter[] = array(">CATALOG_STORE_AMOUNT_".$storeID => 0);
        }
        $GLOBALS[$arParams["FILTER_NAME"]][] = $arTmpFilter;
    }
    $arParams["USE_REGION"] = "Y";
}

/* hide compare link from module options */
if(CNext::GetFrontParametrValue('CATALOG_COMPARE') == 'N')
    $arParams["USE_COMPARE"] = 'N';
/**/
?>
<?if(!in_array("DETAIL_PAGE_URL", (array)$arParams["LIST_OFFERS_FIELD_CODE"]))
    $arParams["LIST_OFFERS_FIELD_CODE"][] = "DETAIL_PAGE_URL";?>

<?$arTransferParams = array(
    "SHOW_ABSENT" => $arParams["SHOW_ABSENT"],
    "HIDE_NOT_AVAILABLE_OFFERS" => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
    "PRICE_CODE" => $arParams["PRICE_CODE"],
    "OFFER_TREE_PROPS" => $arParams["OFFER_TREE_PROPS"],
    "CACHE_TIME" => $arParams["CACHE_TIME"],
    "CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
    "CURRENCY_ID" => $arParams["CURRENCY_ID"],
    "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
    "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
    "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
    "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
    "LIST_OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],
    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
    "LIST_OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
    "SHOW_DISCOUNT_TIME" => $arParams["SHOW_DISCOUNT_TIME"],
    "SHOW_COUNTER_LIST" => $arParams["SHOW_COUNTER_LIST"],
    "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
    "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
    "SHOW_MEASURE" => $arParams["SHOW_MEASURE"],
    "SHOW_OLD_PRICE" => $arParams["SHOW_OLD_PRICE"],
    "SHOW_DISCOUNT_PERCENT" => $arParams["SHOW_DISCOUNT_PERCENT"],
    "SHOW_DISCOUNT_PERCENT_NUMBER" => $arParams["SHOW_DISCOUNT_PERCENT_NUMBER"],
    "USE_REGION" => $arParams["USE_REGION"],
    "STORES" => $arParams["STORES"],
    "DEFAULT_COUNT" => $arParams["DEFAULT_COUNT"],
    "BASKET_URL" => $arParams["BASKET_URL"],
    "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
    "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
    "PARTIAL_PRODUCT_PROPERTIES" => $arParams["PARTIAL_PRODUCT_PROPERTIES"],
    "ADD_PROPERTIES_TO_BASKET" => $arParams["ADD_PROPERTIES_TO_BASKET"],
    "SHOW_DISCOUNT_TIME_EACH_SKU" => $arParams["SHOW_DISCOUNT_TIME_EACH_SKU"],
    "SHOW_ARTICLE_SKU" => $arParams["SHOW_ARTICLE_SKU"],
    "OFFER_ADD_PICT_PROP" => $arParams["OFFER_ADD_PICT_PROP"],
    "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
);?>

<?// section elements?>






<? $isSeries = false;

if(!empty($section['UF_SERIES']) && !empty($section["UF_PROS_SERIES"])){
    $isSeries = true;
}
?>


<? if($isSeries):?>

    <!--ВЫВОД ИНФОРМАЦИИ О СЕРИИ-->
    <? $dbPros = CIBlockElement::GetList( //преимущества серий
        array(),
        array("IBLOCK_ID" => 53, "ACTIVE" => "Y"),
        array("IBLOCK_ID", "ID", "NAME", "PROPERTY_PROS_ICON")
    );


//премищуства
    while ($arPros = $dbPros->GetNext()) {

        $imgAdvantage = CFile::ResizeImageGet(
            $arPros['PROPERTY_PROS_ICON_VALUE'],
            array('width'=>'50', 'height'=>50),
            BX_RESIZE_IMAGE_EXACT
        );
        $arAdvantages[$arPros["ID"]] = $arPros;
        $arAdvantages[$arPros['ID']]['IMAGE'] = $imgAdvantage;

    }

    $res=CIBlockElement::GetList(array(), array("SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"], "IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y"), false, false, array("ID", "IBLOCK_ID", "NAME", "PROPERTY_TYPE_PRODUCT"));

    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arElements[] = $arFields["ID"];
        if ($arFields['PROPERTY_TYPE_PRODUCT_ENUM_ID'] == '') {
            $arGroupEl[0] = [
                "ID" => 0,
                "NAME" => 'Прочие'
            ];
        } else {
            $arGroupEl[$arFields['PROPERTY_TYPE_PRODUCT_ENUM_ID']] = [
                "ID" => $arFields['PROPERTY_TYPE_PRODUCT_ENUM_ID'],
                "NAME" => $arFields['PROPERTY_TYPE_PRODUCT_VALUE']
            ];
        }
        krsort($arGroupEl);
        if ($arFields['PROPERTY_TYPE_PRODUCT_ENUM_ID'] == '') {
            $arElementsGroup[0][$arFields["ID"]] = $arFields["ID"];
        } else {
            $arElementsGroup[$arFields["PROPERTY_TYPE_PRODUCT_ENUM_ID"]][$arFields["ID"]] = $arFields["ID"];
        }
        krsort($arElementsGroup);
    }?>
    <?$arInfo = CCatalogSKU::GetInfoByProductIBlock($arParams["IBLOCK_ID"]);
    $arSelectColor = array("ID", "IBLOCK_ID", "PROPERTY_COLOR_REF");

    foreach($arParams['SERIES_LIST_COLORS_ADD_PROPS'] as $prop){
        if(!empty($prop)){
            $arSelectColor[]='PROPERTY_'.$prop;
        }
    }

    $rsOffers = CIBlockElement::GetList(array(),array('IBLOCK_ID' => $arInfo['IBLOCK_ID'], 'PROPERTY_'.$arInfo['SKU_PROPERTY_ID'] => $arElements, "ACTIVE" => "Y"), false, false, $arSelectColor);
    while($arOffer = $rsOffers->getNext()){

        if ($arOffer["PROPERTY_COLOR_REF_VALUE"] && !in_array($arOffer["PROPERTY_COLOR_REF_VALUE"], $arColorItem["COLOR"])){
            $arColorId[] = $arOffer["PROPERTY_COLOR_REF_VALUE"];
            $arColorItem["COLOR"][] = $arOffer["PROPERTY_COLOR_REF_VALUE"];
        }
        $arColorIdItem[$arOffer["ID"]] = $arOffer["PROPERTY_COLOR_REF_VALUE"];

        foreach($arParams['SERIES_LIST_COLORS_ADD_PROPS'] as $prop){
            if ($prop && $arOffer["PROPERTY_".$prop."_VALUE"] && !in_array($arOffer["PROPERTY_".$prop."_VALUE"], $arColorItem["COLOR_".$prop])){
                $arColorId[] = $arOffer["PROPERTY_".$prop."_VALUE"];
                $arColorItem["COLOR_".$prop][] = $arOffer["PROPERTY_".$prop."_VALUE"];
                $arColorAddIdItem["COLOR_".$prop][$arOffer["ID"]] = $arOffer["PROPERTY_".$prop."_VALUE"];
            }
        }

    }

    $arColorId = array_unique($arColorId);

    $hl=Bitrix\Highloadblock\HighloadBlockTable::getById(COLOR_HL_ID)->fetch();
    $entity=Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hl);
    $entityClass=$entity->getDataClass();
    $result=$entityClass::getList(array('select'=>array('ID','UF_NAME','UF_XML_ID','UF_FILE'), 'filter'=>array("UF_XML_ID"=>$arColorId)));
    while ($arRow = $result->fetchRaw()) {
        $arColor[$arRow["UF_XML_ID"]] = $arRow;
        $arColor[$arRow["UF_XML_ID"]]["FILE_SRC"] = CFile::GetPath($arRow["UF_FILE"]);
    }

    foreach($arColorItem["COLOR"] as $item){
        $arColorNew["COLOR"][$item] = $arColor[$item];

    }
    foreach($arParams['SERIES_LIST_COLORS_ADD_PROPS'] as $prop){
        foreach($arColorItem["COLOR_".$prop] as $item){
            $arColorNew["COLOR_".$prop][$item] = $arColor[$item];

        }
    }

    foreach($arColorIdItem as $id=>$item){
        if ($arColorNew["COLOR"][$item])
            $arColorNew["COLOR"][$item]["COUNT"] = $arColorNew["COLOR"][$item]["COUNT"] + 1;
    }
    foreach($arParams['SERIES_LIST_COLORS_ADD_PROPS'] as $prop){
        if ($prop){
            foreach($arColorAddIdItem["COLOR_".$prop] as $id=>$item){
                if ($arColorNew["COLOR_".$prop][$item])
                    $arColorNew["COLOR_".$prop][$item]["COUNT"] = $arColorNew["COLOR"][$item]["COUNT"] + 1;
            }
        }
    }
    foreach($arColorNew as $key=>$item){
        usort($arColorNew[$key],function($a,$b){return($a['COUNT']<$b['COUNT']);});
    }

    $section["COLORS"] = $arColorNew;


//UF_SERIES_GALLERY
    $res=CIBlockElement::GetList
    (
        [],
        ['IBLOCK_ID'=>SERIES_GALLERIES_IB_ID,'ACTIVE'=>'Y','ID'=>$section["UF_SERIES_GALLERY"]],
        false,
        false,
        ['IBLOCK_ID','ID','PROPERTY_PICTURES']
    );
    while($el=$res->fetch()){
        if($section['UF_DISCOUNT']){
//                $arWaterMark = array(
//                      array(
//                          'name' => 'watermark',
//                          'type' =>'text',
//                          'font' =>$_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/font/openSans.ttf',
//                          'text' => "Скидка на серию  ".$section['UF_DISCOUNT'],
//                          "position" => "topright",
//                          "color" => "ffffff",
//                          )
//
//                );
            $arFileTmp = CFile::ResizeImageGet(
                $el['PROPERTY_PICTURES_VALUE'],
                array("width" => 854, "height" => 571),
                BX_RESIZE_IMAGE_EXACT,
                true
//                    $arWaterMark
            );

            $seriesGalleries[] = ['SRC'=>CFile::GetPath($el['PROPERTY_PICTURES_VALUE']),'MIN_SRC'=>$arFileTmp['src']];
        }else{
            $seriesGalleries[] = ['SRC'=>CFile::GetPath($el['PROPERTY_PICTURES_VALUE']),'MIN_SRC'=>CFile::GetPath($el['PROPERTY_PICTURES_VALUE'])];
        }
    }
    $section["SERIES_GALLERIES"] = $seriesGalleries;
    //METKI
    $arMarks = GetMarks();
    foreach ($arMarks as $arMark){
        $arResult['METKI'][$arMark['ID']] = $arMark;
    }


    ?>

    <div class="series-block series-item inner">
        <div class="series-top">
            <div class="row series-header">
                <div class="col-md-12 name-wrapper">
                    <div class="name">
                        <a href="<?=$arSection['SECTION_PAGE_URL'];?>" class="dark_link">Серия <?=$arSection['NAME'];?> <span class="dark_link-opacity">|</span> <?=$section["UF_NAME_RUS"]?></a>
                    </div>
                    <div class="name-middle">
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
<!--                    <ul class="name-right more-series-list">-->
<!--                        <li class="more-series-main">-->
<!--                            <a class="more-series-toggle">Другие серии раздела</a>-->
<!--                            <ul class="other-series">-->
<!--                                <li class="other-series-choice">-->
<!--                                    <a href="" class="other-series-link active">Ларус</a>-->
<!--                                </li>-->
<!--                                <li class="other-series-choice">-->
<!--                                    <a href="" class="other-series-link">Тревизо</a>-->
<!--                                </li>-->
<!--                                <li class="other-series-choice">-->
<!--                                    <a href="" class="other-series-link">Привилегия</a>-->
<!--                                </li>-->
<!--                                <li class="other-series-choice">-->
<!--                                    <a href="" class="other-series-link">Нью Вашингтон</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                    </ul>-->
                </div>
            </div>
        </div>
        <div class="row series-content">
<!--            <div class="series-tabs">-->
<!--                <a href="#" class="series-content-toggle current" data-tab="1">Описание серии</a>-->
<!--                <a href="#" class="series-content-toggle" data-tab="2">Комплекты</a>-->
<!--            </div>-->
            <div class="row series-main current" data-tab="1">
                <div class="col-md-8">
                    <ul class="series-item-pros quick-metki">

                        <? foreach($section['UF_METKA'] as $arMetka) { ?>
                            <li class="series-item-pros-element">
                                <div class="pros-icon">
                                    <img src="<?=$arResult['METKI'][$arMetka]['SRC']?>" alt="">
                                </div>
                                <span class="pros-text"><?=$arResult['METKI'][$arMetka]['NAME']?></span>
                            </li>
                        <? } ?>
                    </ul>
                    <?if($section['UF_DISCOUNT']){?>
                        <span class="sale-mark"><?=($section['UF_DISCOUNT'])?></span>
                    <?}?>
                    <div class="series-item-slider">
                        <div class="series-item-main-slide slick-slider">
                            <?foreach($section['SERIES_GALLERIES'] as $image):
                                ?>
                                <a class="series-item-main-fancy thumb" rel="group_1" data-fancybox="gallery"  href="<?=$image['SRC']?>">
                                    <img src="<?=$image['MIN_SRC']?>" alt="">
                                </a>
                            <?endforeach;?>
                        </div>

                        <div class="series-item-preview-slide slick-nav preview-slide slider-nav">
                            <?foreach($section['SERIES_GALLERIES'] as $image):?>
                                <div class="series-item-preview-slide-item">
                                    <img src="<?=$image['SRC']?>" alt="">
                                </div>
                            <?endforeach;?>
                        </div>
                    </div>
                </div>
                <div class="series-column">
                    <div class="col-md-4">
                        <div class="series-item-info-top">
                            <p class="series-item-info text"><?=$section["UF_PREVIEW"]?></p>
                        </div>

                        <div class="color-wrapper">
                            <div class="kind-property">
                                <h4>Цвет серии</h4>
                                <? $nn=0; ?>
                                <?foreach($section["COLORS"]["COLOR"] as $color){?>
                                    <?$nn++; if ($nn>4) break;?>
                                    <a class="color-item" href="javascript:;" style="background: url(<?=$color['FILE_SRC']?>)"></a>
                                <?}?>

                            </div>
                            <div class="kind-property">
                                <h4>Цвет дверей</h4>
                                <? $nm=0; ?>
                                <?foreach($section["COLORS"]["COLOR_TEKSTURA_DVEREJ"] as $color){?>
                                    <?$nm++; if ($nm>4) break;?>
                                    <a class="color-item" href="javascript:;" style="background: url(<?=$color['FILE_SRC']?>)"></a>
                                <?}?>
                            </div>
                            <div class="kind-property">
                                <h4>Цвет каркаса</h4>
                                <? $nl=0; ?>
                                <?foreach($section["COLORS"]["COLOR_TEXTURE_KARKASA"] as $color){?>
                                    <?$nl++; if ($nl>4) break;?>
                                    <a class="color-item" href="javascript:;" style="background: url(<?=$color['FILE_SRC']?>)"></a>
                                <?}?>
                            </div>
                            <a href="#moreInformSeries" class="show-more-colors" id="showMeMoreColors">Показать все цвета <i class="fa fa-angle-double-down fa-fw"></i></a>
                        </div>


                        <p>Нужна серия в другом цвете? <span class="animate-load request-new-color" data-event="jqm" data-param-form_id="SIMPLE_FORM_11" data-name="SIMPLE_FORM_11" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Оставить заявку</span></p>
                    </div>
                </div>
            </div>
<!--            <div class="row series-main"  data-tab="2">-->
<!--                <div class="col-md-8 sets-demonstration">-->
<!--                    <div class="series-item-slider">-->
<!--                        <div class="series-item-main-slide slick-slider">-->
<!--                            --><?//foreach($section['SERIES_GALLERIES'] as $image):?>
<!--                                <a class="series-item-main-fancy thumb" rel="group_2" data-fancybox="gallery" href="--><?//=$image['SRC']?><!--">-->
<!--                                    <img src="--><?//=$image['MIN_SRC']?><!--" alt="">-->
<!--                                </a>-->
<!--                            --><?//endforeach;?>
<!--                        </div>-->
<!---->
<!--                        <div class="series-item-preview-slide slick-nav preview-slide slider-nav">-->
<!--                            --><?//foreach($section['SERIES_GALLERIES'] as $image):?>
<!--                                <div class="series-item-preview-slide-item">-->
<!--                                    <img src="--><?//=$image['SRC']?><!--" alt="">-->
<!--                                </div>-->
<!--                            --><?//endforeach;?>
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-lg-4 col-sm-12 sets-inform">-->
<!--                    <div class="series-item-info">-->
<!--                        <div class="row">-->
<!--                            <div class="col-md-12 col-lg-12">-->
<!--                                <div class="series-item-color-top">-->
<!--                                    <h4>Цена за комплект от 628 989 ₽</h4>-->
<!--                                    <div class="series-item-color">-->
<!--                                        <div class="color-wrapper colors-by-components">-->
<!--                                            <div class="kind-property">-->
<!--                                                --><?// $nn=0; ?>
<!--                                                --><?//foreach($section["COLORS"]["COLOR"] as $color){?>
<!--                                                    --><?//$nn++; if ($nn>4) break;?>
<!--                                                    <a class="color-item" style="background:url(--><?//=$color['FILE_SRC']?><!--);"></a>-->
<!--                                                    --><?//}?>
<!---->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="row series-items">-->
<!--                                    <div class="col-md-12">-->
<!--                                        <table>-->
<!--                                            <tr>-->
<!--                                                <td>-->
<!--                                                    <p class="series-products">Стол руководителя правый</p>-->
<!--                                                </td>-->
<!--                                                <td class="table-prices">-->
<!--                                                    <p class="old-price">263 523 &#8381;</p>-->
<!--                                                    <p class="price">223 523 &#8381;</p>-->
<!--                                                </td>-->
<!--                                                <td>-->
<!--                                                    <div class="counter_block">-->
<!--                                                        <span class="minus">-</span>-->
<!--                                                        <input type="text" class="text" name="quantity" value="1">-->
<!--                                                        <span class="plus">+</span>-->
<!--                                                    </div>-->
<!--                                                </td>-->
<!--                                            </tr>-->
<!--                                            <tr>-->
<!--                                                <td>-->
<!--                                                    <p class="series-products">Брифинг</p>-->
<!--                                                </td>-->
<!--                                                <td class="table-prices">-->
<!--                                                    <p class="old-price">263 523 &#8381;</p>-->
<!--                                                    <p class="price">223 523 &#8381;</p>-->
<!--                                                </td>-->
<!--                                                <td>-->
<!--                                                    <div class="counter_block">-->
<!--                                                        <span class="minus">-</span>-->
<!--                                                        <input type="text" class="text" name="quantity" value="1">-->
<!--                                                        <span class="plus">+</span>-->
<!--                                                    </div>-->
<!--                                                </td>-->
<!--                                            </tr>-->
<!--                                            <tr>-->
<!--                                                <td>-->
<!--                                                    <p class="series-products">Шкаф для документов</p>-->
<!--                                                </td>-->
<!--                                                <td class="table-prices">-->
<!--                                                    <p class="old-price">263 523 &#8381;</p>-->
<!--                                                    <p class="price">223 523 &#8381;</p>-->
<!--                                                </td>-->
<!--                                                <td>-->
<!--                                                    <div class="counter_block">-->
<!--                                                        <span class="minus">-</span>-->
<!--                                                        <input type="text" class="text" name="quantity" value="1">-->
<!--                                                        <span class="plus">+</span>-->
<!--                                                    </div>-->
<!--                                                </td>-->
<!--                                            </tr>-->
<!--                                            <tr>-->
<!--                                                <td>-->
<!--                                                    <p class="series-products">Журнальный стол</p>-->
<!--                                                </td>-->
<!--                                                <td class="table-prices">-->
<!--                                                    <p class="old-price">263 523 &#8381;</p>-->
<!--                                                    <p class="price">223 523 &#8381;</p>-->
<!--                                                </td>-->
<!--                                                <td>-->
<!--                                                    <div class="counter_block">-->
<!--                                                        <span class="minus">-</span>-->
<!--                                                        <input type="text" class="text" name="quantity" value="1">-->
<!--                                                        <span class="plus">+</span>-->
<!--                                                    </div>-->
<!--                                                </td>-->
<!--                                            </tr>-->
<!--                                        </table>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="row series-price">-->
<!--                                    <div class="col-md-4 new-price-wrap">-->
<!--                                        <p class="price">19 980 &#8381;</p>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-4 old-price-wrap">-->
<!--                                        <p class="old-price">19 980 &#8381;</p>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-4 sale-size-wrap">-->
<!--                                        <a href="#" class="expensive">Это дорого?</a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="row series-price procent">-->
<!--                                    <div class="col-md-12">-->
<!--                                        <p class="economy"><span class="procent">-28%</span> Экономия 3 530 &#8381;</p>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="row series-buy">-->
<!--                                    <div class="col-md-12 counter-wrap">-->
<!--                                        <div class="counter_block">-->
<!--                                            <span class="minus">-</span>-->
<!--                                            <input type="text" class="text" name="quantity" value="1">-->
<!--                                            <span class="plus">+</span>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="row series-buy">-->
<!--                                    <div class="col-md-6 in-basket-wrap">-->
<!--                                        <div class="button_block">-->
<!--                                            <a href="#">В корзину</a>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-6">-->
<!--                                        <a href="" class="fast-buy">Быстрый заказ</a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="row">-->
<!--                                    <div class="col-lg-12 another-color">-->
<!--                                        <p>Нужна серия в другом цвете?</p>-->
<!--                                        <a class="btn"><span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_11" data-name="SIMPLE_FORM_11" data-autoload-product_name="--><?//=CNextB2c::formatJsName($arResult["NAME"]);?><!--" data-autoload-product_id="--><?//=$arResult["ID"];?><!--">Оставить заявку</span></a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->

        </div>
        <div class="row series-advantages" id="moreInformSeries">
            <div class="series-block-pros desk">
                <ul class="pros-list">
                    <?foreach($section['UF_PROS_SERIES'] as $arAdv):?>
                        <li class="pros-item">
                            <div class="pros-icon">
                                <img src="<?=($arAdvantages[$arAdv]['IMAGE']['src']);?>" alt="">
                            </div>
                            <span class="pros-text"><?=($arAdvantages[$arAdv]['NAME']);?></span>
                        </li>
                    <?endforeach;?>
                </ul>
            </div>
            <div class="row advantages-cool">
                <div class="advantages-item col-md-2">
                    <img src="/images/for-demo/1.jpg" alt="" class="advantages-img" width="196" height="128">
                    <p class="advantages-name">Идеальные пропорции и геометрия форм</p>
                </div>
                <div class="advantages-item col-md-2">
                    <img src="/images/for-demo/2.jpg" alt="" class="advantages-img" width="196" height="128">
                    <p class="advantages-name">Передние панели из черного стекла с рисунком</p>
                </div>
                <div class="advantages-item col-md-2">
                    <img src="/images/for-demo/3.jpg" alt="" class="advantages-img" width="196" height="128">
                    <p class="advantages-name">Зеркальные цоколи создающие эффект невесомости</p>
                </div>
                <div class="advantages-item col-md-2">
                    <img src="/images/for-demo/4.jpg" alt="" class="advantages-img" width="196" height="128">
                    <p class="advantages-name">Функциональная тумба с ящиком для бара</p>
                </div>
                <div class="advantages-item col-md-2">
                    <img src="/images/for-demo/5.jpg" alt="" class="advantages-img" width="196" height="128">
                    <p class="advantages-name">Декоративные вставки и опоры столов и тумб</p>
                </div>
                <div class="advantages-item col-md-2">
                    <img src="/images/for-demo/6.jpg" alt="" class="advantages-img" width="196" height="128">
                    <p class="advantages-name">Файловая система хранения документов</p>
                </div>
            </div>
        </div>
        <div class="row series-tabs-more">
            <div class="col-md-12">
                <div class="inform-detailed" id="tabs">
                    <ul class="inform-toggle">
                        <li class="inform-item active detailed_description" data-tab="1">
                            <a href="#">Подробное описание</a>
                        </li>
                        <li class="inform-item colors_solution" data-tab="2">
                            <a href="#">Все цветовые решения</a>
                        </li>
                        <li class="inform-item technic" data-tab="3">
                            <a href="#">Техническая информация</a>
                        </li>
                        <li class="inform-item price-list" data-tab="4">
                            <a href="#">Прайс-листы</a>
                        </li>
                        <li class="inform-item presentations" data-tab="5">
                            <a href="#">Презентации</a>
                        </li>
                    </ul>
                    <div class="inform-content active" data-tab="1">
                        <div class="description-details-wrapper">
                            <p class="description-details description-details_gradient"><?=$arSection["DESCRIPTION"]?></p>
                            <div class="gradient-more"></div>
                            <button class="show_more"></button>
                        </div>
                    </div>
                    <div class="inform-content colors" data-tab="2">
                        <div class="all-colors">
                            <div class="color-wrapper">
                                <div class="kind-property">
                                    <h4>Цвет серии</h4>
                                    <?foreach($section["COLORS"]["COLOR"] as $color){?>
                                        <a class="color-item" href="javascript:;" style="background: url(<?=$color['FILE_SRC']?>)"></a>
                                    <?}?>
                                </div>
                                <div class="kind-property">
                                    <h4>Цвет дверей</h4>
                                    <?foreach($section["COLORS"]["COLOR_TEKSTURA_DVEREJ"] as $color){?>
                                        <a class="color-item" href="javascript:;" style="background: url(<?=$color['FILE_SRC']?>)"></a>
                                    <?}?>
                                </div>
                                <div class="kind-property">
                                    <h4>Цвет каркаса</h4>
                                    <?foreach($section["COLORS"]["COLOR_TEXTURE_KARKASA"] as $color){?>
                                        <a class="color-item" href="javascript:;" style="background: url(<?=$color['FILE_SRC']?>)"></a>
                                    <?}?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="inform-content" data-tab="3">
                        <div class="technical-inform-details">
                            <p class="description-details">Техническая информация</p>
                        </div>
                    </div>
                    <div class="inform-content" data-tab="4">
                        <div class="price-details">
                            <p class="description-details">Прайс</p>
                        </div>
                    </div>
                    <div class="inform-content" data-tab="5">
                        <div class="presentation-details">
                            <p class="description-details">Презентации</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="series-block-pros mobile">
            <ul class="pros-list">
                <?foreach($section['UF_PROS_SERIES'] as $arAdv):?>
                    <li class="pros-item">
                        <div class="pros-icon">
                            <img src="<?=($arAdvantages[$arAdv]['IMAGE']['src']);?>" alt="">
                        </div>
                        <span class="pros-text"><?=($arAdvantages[$arAdv]['NAME']);?></span>
                    </li>
                <?endforeach;?>
            </ul>
        </div>


    </div>
    <div class="series-filters">
        <div class="series-sort">
            <div class="row">
                <div class="col-lg-12 filters-main-title">
                    <div class="top_block">
                        <h3 class="title_block big">Товары серии</h3>
                        <div id="show_all" class="show_all">Скрыть все</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="target"></div>
                <div class="col-lg-12 select">
                    <div class="sort-list-wrapper" id="section_block">
                        <p class="sort-evt">Выберите тип:</p>
                        <ul class="sort-list">
                            <? foreach ($arGroupEl as $key => $category) {
                                echo "<li class='sort-item'><a href='#block_id_$key'>" . $category['NAME'] . "</a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <? foreach ($arElementsGroup as $group => $names) { ?>
            <div class="group_block" id="block_id_<?= $group; ?>">
                <div class="top_block">
                    <h3 class="title_block big filters-title"><?= $arGroupEl[$group]['NAME']; ?></h3>
                </div>
                <div class="row width100">
                    <div class="element_container">
                        <span class="open_section">Скрыть секцию</span>
                        <div class="hidden_section" style="display: block;">
                            <div class="row">
                                <? $count = 0;
                                $line = 0;
                                $elements = 0;
                                foreach ($names as $elementBlock) {
                                    $count++; ?>
                                    <? if ($count == 1):?>
                                        <? $line++; ?>
                                    <? endif; ?>
                                    <div class="col-lg-3 col-md-3 col-sm-6 line_<?= $group; ?>_<?= $line; ?> <? if ($line > 2) {
                                        echo "hide";
                                    } else {
                                        echo "show";
                                    } ?> ">
                                        <? $APPLICATION->IncludeComponent(
                                            "bitrix:catalog.element",
                                            "series_item",
                                            array(
                                                "ACTION_VARIABLE" => "action",
                                                "ADD_DETAIL_TO_SLIDER" => "N",
                                                "ADD_ELEMENT_CHAIN" => "N",
                                                "ADD_PROPERTIES_TO_BASKET" => "N",
                                                "ADD_SECTIONS_CHAIN" => "N",
                                                "ADD_TO_BASKET_ACTION" => array(
                                                    0 => "BUY",
                                                ),
                                                "BACKGROUND_IMAGE" => "-",
                                                "BASKET_URL" => "/personal/basket.php",
                                                "BRAND_USE" => "N",
                                                "BROWSER_TITLE" => "-",
                                                "CACHE_GROUPS" => "Y",
                                                "CACHE_TIME" => "36000000",
                                                "CACHE_TYPE" => "A",
                                                "CHECK_SECTION_ID_VARIABLE" => "N",
                                                "COMPATIBLE_MODE" => "Y",
                                                "CONVERT_CURRENCY" => "N",
                                                "DETAIL_PICTURE_MODE" => array(
                                                    0 => "POPUP",
                                                    1 => "MAGNIFIER",
                                                ),
                                                "DETAIL_URL" => "",
                                                "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                                                "DISPLAY_COMPARE" => "N",
                                                "DISPLAY_NAME" => "Y",
                                                "DISPLAY_PREVIEW_TEXT_MODE" => "E",
                                                "ELEMENT_CODE" => "",
                                                "ELEMENT_ID" => $elementBlock,
                                                "GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
                                                "GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
                                                "GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
                                                "GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
                                                "GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
                                                "GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
                                                "GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
                                                "GIFTS_MESS_BTN_BUY" => "Выбрать",
                                                "GIFTS_SHOW_DISCOUNT_PERCENT" => "N",
                                                "GIFTS_SHOW_IMAGE" => "N",
                                                "GIFTS_SHOW_NAME" => "N",
                                                "GIFTS_SHOW_OLD_PRICE" => "N",
                                                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                                                "IBLOCK_ID" => "17",
                                                "IBLOCK_TYPE" => "aspro_next_catalog",
                                                "IMAGE_RESOLUTION" => "16by9",
                                                "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
                                                "LINK_IBLOCK_ID" => "",
                                                "LINK_IBLOCK_TYPE" => "",
                                                "LINK_PROPERTY_SID" => "",
                                                "MESSAGE_404" => "",
                                                "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                                                "MESS_BTN_BUY" => "Купить",
                                                "MESS_BTN_SUBSCRIBE" => "Подписаться",
                                                "MESS_COMMENTS_TAB" => "Комментарии",
                                                "MESS_DESCRIPTION_TAB" => "Описание",
                                                "MESS_NOT_AVAILABLE" => "Нет в наличии",
                                                "MESS_PRICE_RANGES_TITLE" => "Цены",
                                                "MESS_PROPERTIES_TAB" => "Характеристики",
                                                "META_DESCRIPTION" => "-",
                                                "META_KEYWORDS" => "-",
                                                "OFFERS_CART_PROPERTIES" => array(),
                                                "OFFERS_FIELD_CODE" => array(
                                                    0 => "",
                                                    1 => "",
                                                ),
                                                "OFFERS_LIMIT" => "0",
                                                "OFFERS_PROPERTY_CODE" => array(
                                                    0 => "",
                                                    1 => "",
                                                ),
                                                "OFFERS_SORT_FIELD" => "sort",
                                                "OFFERS_SORT_FIELD2" => "id",
                                                "OFFERS_SORT_ORDER" => "asc",
                                                "OFFERS_SORT_ORDER2" => "desc",
                                                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                                "PRICE_CODE" => array(
                                                    "BASE",
                                                    "ИМ: Рек. розн. 0%",
                                                    "ИМ: Рек. розн. 12% (10%)",
                                                    "ИМ: Рек. розн. 2% (3%)",
                                                    "ИМ: Рек. розн. 3%",
                                                    "ИМ: Рек. розн. 7% (4%)",
                                                    "ИМ: Рек. розн. 7% (5%)",
                                                    "ИМ: Рек. розн. 8% (6%)",
                                                    "ИМ: Рек. розн. 8% (4%)",
                                                    "ИМ: Рек. розн. 8%",
                                                    "ИМ: Рек. розн. 8% (5%)",
                                                    "ИМ: Рек. розн. 8% (7%)",
                                                    "ИМ: Рек. розн. 12% (8%)",
                                                    "ИМ: Рек. розн. 12% (11%)",
                                                    "ИМ: Рек. розн. 12%",
                                                    "ИМ: Рек.розн. 12% (9%)",
                                                    "ИМ: Рек.розн 20%",
                                                    "ИМ: Рек. розн. 25%",
                                                    "ИМ: Рек. розн. 25% (14,5%)"
                                                ),
                                                "PRICE_VAT_INCLUDE" => "Y",
                                                "PRICE_VAT_SHOW_VALUE" => "N",
                                                "PRODUCT_ID_VARIABLE" => "id",
                                                "PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
                                                "PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
                                                "PRODUCT_PROPERTIES" => array(),
                                                "PRODUCT_PROPS_VARIABLE" => "prop",
                                                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                                                "PRODUCT_SUBSCRIPTION" => "Y",
                                                "PROPERTY_CODE" => array(
                                                    0 => "",
                                                    1 => "",
                                                ),
                                                "SECTION_CODE" => "",
                                                "SECTION_ID" => "",
                                                "SECTION_ID_VARIABLE" => "SECTION_ID",
                                                "SECTION_URL" => "",
                                                "SEF_MODE" => "N",
                                                "SET_BROWSER_TITLE" => "N",
                                                "SET_CANONICAL_URL" => "N",
                                                "SET_LAST_MODIFIED" => "N",
                                                "SET_META_DESCRIPTION" => "N",
                                                "SET_META_KEYWORDS" => "N",
                                                "SET_STATUS_404" => "N",
                                                "SET_TITLE" => "N",
                                                "SET_VIEWED_IN_COMPONENT" => "N",
                                                "SHOW_404" => "N",
                                                "SHOW_CLOSE_POPUP" => "N",
                                                "SHOW_DEACTIVATED" => "N",
                                                "SHOW_DISCOUNT_PERCENT" => "N",
                                                "SHOW_MAX_QUANTITY" => "N",
                                                "SHOW_OLD_PRICE" => "N",
                                                "SHOW_PRICE_COUNT" => "1",
                                                "SHOW_SLIDER" => "N",
                                                "STRICT_SECTION_CHECK" => "N",
                                                "TEMPLATE_THEME" => "blue",
                                                "USE_COMMENTS" => "N",
                                                "USE_ELEMENT_COUNTER" => "N",
                                                "USE_ENHANCED_ECOMMERCE" => "N",
                                                "USE_GIFTS_DETAIL" => "N",
                                                "USE_GIFTS_MAIN_PR_SECTION_LIST" => "N",
                                                "USE_MAIN_ELEMENT_SECTION" => "N",
                                                "USE_PRICE_COUNT" => "N",
                                                "USE_PRODUCT_QUANTITY" => "N",
                                                "USE_RATIO_IN_RANGES" => "N",
                                                "USE_VOTE_RATING" => "N",
                                                "COMPONENT_TEMPLATE" => "series_item"
                                            ),
                                            false
                                        );
                                        $elements++; ?>
                                    </div>

                                <? if ($count == 4): ?>
                                    <div class='clearfix'></div>
                                <? if ($line == 2): ?>
                                    <div class="more_items">
                                        <p class="show_more_<?= $group; ?>_<?= $line; ?>">
                                            <span class="more_button">Показать еще</span>
                                        </p>
                                    </div>
                                    <script>
                                        $(".show_more_<?=$group;?>_<?=$line;?>").click(function () {
                                            $(".line_<?=$group;?>_<?=$line + 1;?>").toggleClass("show");
                                            $(".show_more_<?=$group;?>_<?=$line;?>").toggleClass("hide");
                                            $(".show_more_<?=$group;?>_<?=$line + 1;?>").toggleClass("show");

                                        });
                                    </script>
                                <? endif; ?>

                                <? if ($line > 2): ?>
                                    <div class="more_items">
                                        <p class="show_more_<?= $group; ?>_<?= $line; ?> hide">
                                            <span class="more_button">Показать еще</span>
                                        </p>
                                    </div>
                                    <script>
                                        $(".show_more_<?=$group;?>_<?=$line;?>").click(function () {
                                            $(".line_<?=$group;?>_<?=$line + 1;?>").toggleClass("show");
                                            $(".show_more_<?=$group;?>_<?=$line;?>").toggleClass("show");
                                        });
                                    </script>
                                <? endif; ?>
                                    <? $count = 0; ?>
                                <? endif; ?>
                                <? } ?>
                            </div>
                            <? $elements = 0; ?>
                        </div>
                    </div>
                </div>
            </div>
        <? } ?>
        <script>
            function openCloseSection($target, openedAll = null) {
                var hBlock = $target.siblings('.hidden_section');
                const OPEN_SECTION_LABEL = 'Показать секцию';
                const CLOSE_SECTION_LABEL = 'Скрыть секцию';


                if (openedAll || hBlock.is(':visible')) {
                    $target.text(OPEN_SECTION_LABEL)
                }


                if (openedAll == false || hBlock.is(':visible') == false) {
                    $target.text(CLOSE_SECTION_LABEL)
                }


                if (openedAll === null) {
                    hBlock.toggle({
                        duration: 500,
                        complete: function () {
                            changeAllButtonState(checkSectionsOpenClose());
                        }
                    });
                } else {
                    if (openedAll === true) {
                        $target.siblings('.hidden_section').hide();
                    } else {
                        $target.siblings('.hidden_section').show();
                    }
                }
            }


            const SHOW_LABEL_ALL = 'Показать все';
            const HIDE_LABEL_ALL = 'Скрыть все';


            /**
             * if true - closed
             * if false - opened
             *
             * @returns {null|boolean}
             */
            function checkSectionsOpenClose(){
                var visibleSections = $('.open_section').siblings('.hidden_section:visible');
                if (visibleSections.length === 0){
                    return true;
                } else {
                    var notVisibleSections = $('.open_section').siblings('.hidden_section:hidden');
                    if (notVisibleSections.length === 0) {
                        return false;
                    }
                }
                return null;
            }


            function changeAllButtonState(show){
                if (show === true){
                    $('#show_all').text(SHOW_LABEL_ALL);
                } else {
                    $('#show_all').text(HIDE_LABEL_ALL);
                }
                $('#show_all').toggleClass('.opened');
            }


            $('.element_container').on('click', '.open_section',
                function () {
                    openCloseSection($(this));
                }
            );


            $(function () {
                $('#show_all').on('click', function (e) {


                    $target = $(e.target);
                    $this = $(this);


                    $groupOpenSectionLinks = $('.group_block').find('.open_section');
                    $isOpened = $this.hasClass('.opened');
                    $target.text($isOpened ? SHOW_LABEL_ALL : HIDE_LABEL_ALL);
                    $this.toggleClass('.opened');


                    openCloseSection($groupOpenSectionLinks,$isOpened);
                });
            });</script>
        <div class="sort-list-wrapper floating" id="section_block_bottom">
            <p class="sort-evt">Выберите тип:</p>
            <ul class="sort-list">
                <? foreach ($arGroupEl as $key => $category) {
                    echo "<li class='sort-item'><a href='#block_id_$key'>" . $category['NAME'] . "</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="top_block">
            <h3 class="title_block big">Похожие серии</h3>
        </div>

        <div class="row similar-series catalog">
            <div class="similar-series-wrapper">
                <div class="similar-series-slider slick-slider put-arrows">
                    <div class="similar-series-slide">
                        <a href="">
                            <img src="/images/for-demo/norton.jpg" alt="" width="410" height="240">
                            <p>Серия Norton / Нортон</p>
                        </a>
                    </div>
                    <div class="similar-series-slide">
                        <a href="">
                            <img src="/images/for-demo/prego.jpg" alt="" width="410" height="240">
                            <p>Серия Prego / Прего</p>
                        </a>
                    </div>
                    <div class="similar-series-slide">
                        <a href="">
                            <img src="/images/for-demo/larus.jpg" alt="" width="410" height="240">
                            <p>Серия Larus / Ларус</p>
                        </a>
                    </div>
                    <div class="similar-series-slide">
                        <a href="">
                            <img src="/images/for-demo/norton.jpg" alt="" width="410" height="240">
                            <p>Серия Norton / Нортон</p>
                        </a>
                    </div>
                    <div class="similar-series-slide">
                        <a href="">
                            <img src="/images/for-demo/prego.jpg" alt="" width="410" height="240">
                            <p>Серия Prego / Прего</p>
                        </a>
                    </div>
                    <div class="similar-series-slide">
                        <a href="">
                            <img src="/images/for-demo/larus.jpg" alt="" width="410" height="240">
                            <p>Серия Larus / Ларус</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="top_block">
            <h3 class="title_block big">Каталоги</h3>
        </div>

        <div class="row about-company catalog catalog-column">
            <div class="col-lg-3 catalog-item">
                <a href="/documents/catalog-1.pdf" download>
                    <img src="/images/catalog-1.jpg" alt="" class="catalog-img" width="232" height="232">
                    <h3 class="catalog-name">Офисная мебель</h3>
                    <span class="year">2018</span>
                </a>
            </div>
            <div class="col-lg-3 catalog-item">
                <a href="/documents/catalog-2.pdf" download>
                    <img src="/images/catalog-2.jpg" alt="" class="catalog-img" width="232" height="232">
                    <h3 class="catalog-name">Мебель для руководителя</h3>
                    <span class="year">2019</span>
                </a>
            </div>
            <div class="col-lg-3 catalog-item">
                <a href="/documents/catalog-3.pdf" download>
                    <img src="/images/catalog-3.jpg" alt="" class="catalog-img" width="232" height="232">
                    <h3 class="catalog-name">Мебель для дома</h3>
                    <span class="year">2018</span>
                </a>
            </div>
            <div class="col-lg-3 catalog-item">
                <a href="/documents/catalog-4.pdf" download>
                    <img src="/images/catalog-4.jpg" alt="" class="catalog-img" width="232" height="232">
                    <h3 class="catalog-name">Портфолио дизайн-проектов</h3>
                    <span class="year">2018</span>
                </a>
            </div>
        </div>
    </div>

<?endif;?>

    <div class="js_wrapper_items" data-params='<?=str_replace('\'', '"', CUtil::PhpToJSObject($arTransferParams, false))?>'>

    </div>

    <div class="panel-anchors">
        <ul class="anchors-list">
            <li>
                <a href="#moreInformSeries" class="anchor-desc" id="showMeDesc">Описание</a>
            </li>
            <li>
                <a href="#tables" class="anchor-toggle active">Столы</a>
            </li>
            <li>
                <a href="#tablesNegotiations" class="anchor-toggle">Столы для переговоров</a>
            </li>
            <li>
                <a href="#thumbs" class="anchor-toggle">Тумбы</a>
            </li>
            <li>
                <a href="#annex" class="anchor-toggle">Приставки</a>
            </li>
            <li>
                <a href="#cupboard" class="anchor-toggle">Шкафы</a>
            </li>
            <li>
                <a href="#screens" class="anchor-toggle">Экраны</a>
            </li>
            <li>
                <a href="#chairs" class="anchor-toggle">Кресла и стулья</a>
            </li>
        </ul>
    </div>

<?CNext::checkBreadcrumbsChain($arParams, $arSection);?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.history.js');?>

<?if(\Bitrix\Main\Loader::includeModule("sotbit.seometa")):?>
    <?$APPLICATION->IncludeComponent(
        "sotbit:seo.meta",
        ".default",
        array(
            "FILTER_NAME" => $arParams["FILTER_NAME"],
            "SECTION_ID" => $arSection['ID'],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
        )
    );?>
<?endif;?>