<?define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if(!CModule::IncludeModule("sale") || !CModule::IncludeModule("catalog") || !CModule::IncludeModule("iblock")){
	echo "failure";
	return;
}

\Bitrix\Main\Loader::IncludeModule('aspro.next');

if($_REQUEST['id']) {
    $IBLOCK_ID = 17;
    $IBLOCK_TYPE_ID = 'aspro_next_catalog';
    $iterator = CIblockSection::GetList([],['IBLOCK_ID'=>$IBLOCK_ID,'=ID'=>$_REQUEST['id']],false,['ID','NAME','SECTION_PAGE_URL',"UF_MODELS","UF_CATEGORY_SERIES","UF_BANNERS"]);
    if($section = $iterator->GetNext()) {
        ?>
        <div class="form_head">
            <h2><?=$section['NAME']?></h2>
        </div>
        <div class="container-n"><?
            if($section['UF_MODELS']):
                //x5 20190626
                $models_for_menu = \XFive\Data::getModelsRowForMenu($IBLOCK_ID);
                foreach($models_for_menu as $row){
                    $xmlIds[] = $row['UF_XML_ID'];
                }
                $models = [];
                if($xmlIds):
                    $iterator = CIblockElement::GetList([],['IBLOCK_ID'=>$IBLOCK_ID,'=SECTION_ID'=>$section['ID'],'!=PROPERTY_SHOW_MENU'=>false,
                        'PROPERTY_MODEL'=>$xmlIds
                    ],false,false,['ID','NAME','PROPERTY_MODEL']);
                    while($item = $iterator->Fetch()){
                        $model_name = $models_for_menu[$item['PROPERTY_MODEL_VALUE']]['UF_NAME'];
                        $models[$model_name][] = $item;
                    }
                endif;
                $banners = [];
                if($section['UF_BANNERS']){
                    foreach($section['UF_BANNERS'] as $imgId){
                        $banners[] = \CFile::GetFileArray($imgId);
                    }
                }
                ?>
                <div class="row-n">
                    <div class="col-md-2">
                        <h3>Модели</h3>
                        <ul class="collections mlist">

                            <?foreach($models as $model=>$elements):?>

                                <?if($model!=""):?>
                                    <li data-id="<?=$model?>" class="<?if(!$key):?> active<?$key=true;endif;?>"><?=$model?></li>
                                <?endif;?>
                            <?endforeach;?>
                        </ul>
                    </div>
                    <?$key = false;?>
                    <div class="col-md-2">
                        <?foreach($models as $model=>$elements):?>
                            <?if($model!=""):?>
                                <div class="model-elements-list model<?=$model?><?if(!$key):?> active<?$key=true;endif;?>">
                                    <h3>Модификации</h3>
                                    <ul class="mlist" >
                                        <?$nn=0;foreach($elements as $element):?>
                                            <?$nn++;?>
                                            <li class="model-elements <?=($nn==1)?"active":""?>" data-id="<?=$element['ID']?>" data-sectionid="<?=$section['ID']?>"><?=$element['NAME']?></li>
                                        <?endforeach;?>
                                    </ul>
                                </div>
                            <?endif;?>
                        <?endforeach;?>

                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="ajax-element col-xs-9">

<?$elementId = array_shift(array_shift($models))["ID"]; $elpropid = "undefined";
require($_SERVER["DOCUMENT_ROOT"]."/local/tools/getElementInfo.php");?>
                            </div>
                            <div class="col-xs-3">
                                <ul class="x5slider" data-interval="3000">
                                    <?$i=0;
                                    foreach($banners as $banner):
                                        ?>
                                        <li class="x5slide <?=($i==0?"showing":"")?>"><img src1="<?=SITE_TEMPLATE_PATH?>/images/onepixel.jpg" src="<?=$banner['SRC']?>" data-img-src="<?=$banner['SRC']?>" /></li>
                                        <?
                                        $i++;
                                    endforeach;?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!---->
            <?
            elseif($section['UF_CATEGORY_SERIES']):
                $sectionIds = [""];
                $iterator = CIblockSection::GetList([],['IBLOCK_ID'=>$IBLOCK_ID,'=SECTION_ID'=>$section['ID'],'!=UF_CATEGORY_SERIES'=>false],false,['ID','NAME','UF_SERIES']);
                while($item = $iterator->Fetch()){
                    $series[$item['ID']] = $item;
                    $sectionIds[] = $item['ID'];
                }
                $iterator = CIblockElement::GetList([],['IBLOCK_ID'=>$IBLOCK_ID,'=SECTION_ID'=>$sectionIds],false,false,['ID','NAME','IBLOCK_SECTION_ID','PROPERTY_MODEL','PROPERTY_TYPE_PRODUCT']);
                while($item = $iterator->Fetch()){
                    //print_r($item);
                    $skey = false;
                    $key = false;
                    $db_old_groups = CIBlockElement::GetElementGroups($item['ID'], false);
                    while($ar_group = $db_old_groups->Fetch()) {
                        if($key=array_search($ar_group["ID"],$sectionIds))
                        $skey = $sectionIds[$key];
                    }
                    if($skey) {

                        $series[$skey]['ELEMENTS'][$item['PROPERTY_TYPE_PRODUCT_VALUE']] = $item;
                        $props[$item['PROPERTY_TYPE_PRODUCT_VALUE']] = $item['PROPERTY_TYPE_PRODUCT_ENUM_ID'];
                        $props1[$skey][$item['PROPERTY_TYPE_PRODUCT_VALUE']] = $item['PROPERTY_TYPE_PRODUCT_ENUM_ID'];
                    }
                    ?>
                    <?
                    if($item['ID']==9904):
                        ?>
                        <?php
                        $db_old_groups = CIBlockElement::GetElementGroups($item['ID'], false);
                        while($ar_group = $db_old_groups->Fetch()) {
                            if($key=array_search($ar_group["ID"],$sectionIds))
                                $skey = $sectionIds[$key];?>


                            <?
                        }
                    endif;
                }
                ?>
                <div class="row-n">
                    <div class="col-md-2">
                        <h3>Серии</h3>
                        <ul class="collections js-series mlist">
                            <?foreach($series as $model=>$lements):?>
                                <?if($model!=""):?>
                                    <li data-id="<?=$model?>" class="<?if(!$key):?> active<?$key=true;endif;?>"><?=$lements['NAME']?></li>
                                <?endif;?>
                            <?endforeach;?>
                        </ul>
                    </div>
                    <?$key = false;?>
                    <div class="col-md-2">

                    <?foreach($series as $model=>$elements):?>
                            <?if($model!=""):?>
                                <div class="model-elements-list model<?=$model?><?if(!$key):?> active<?$key=true;endif;?>">
                                    <h3>Состав</h3>
                                    <ul class="mlist" >
                                            <li class="js-desc-series active" data-id="<?=$elements['ID']?>">Описание серии</li>
                                            <li class="js-kit-series" data-id="<?=$elements['ID']?>">Комплекты</li>
                                        <?foreach($elements['ELEMENTS'] as $prop=>$element):?>
                                        <?if($prop!=""):?>
                                            <li class="model-elements" data-propid="<?=$props[$prop]?>" data-sectionid="<?=$elements['ID']?>"><?=$prop?></li>
                                        <?endif;?>
                                        <?endforeach;?>
                                    </ul>
                                </div>
                            <?endif;?>
                        <?endforeach;?>

                    </div>
                    <div class="col-md-8">
                        <div class="ajax-element">
                            <?$menuSeriesId = array_shift($series)["ID"]; require($_SERVER["DOCUMENT_ROOT"]."/local/tools/getCollectionInfo.php");?>
                        </div>
                    </div>
                </div>

            <?
            else:
                ?>
                <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "catalog_custom_block_ajax",
                Array(
                    "ACTION_VARIABLE" => "action",
                    "ADD_PICT_PROP" => "MORE_PHOTO",
                    "ADD_PROPERTIES_TO_BASKET" => "Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "ADD_TO_BASKET_ACTION" => "ADD",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "BACKGROUND_IMAGE" => "UF_BACKGROUND_IMAGE",
                    "BASKET_URL" => "/personal/basket.php",
                    "BRAND_PROPERTY" => "BRAND_REF",
                    "BROWSER_TITLE" => "-",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "N",
                    "COMPATIBLE_MODE" => "Y",
                    "CONVERT_CURRENCY" => "Y",
                    "CURRENCY_ID" => "RUB",
                    "CUSTOM_FILTER" => "",
                    "DATA_LAYER_NAME" => "dataLayer",
                    "DETAIL_URL" => "",
                    "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                    "DISCOUNT_PERCENT_POSITION" => "bottom-right",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_TOP_PAGER" => "N",
                    "ELEMENT_SORT_FIELD" => "PROPERTY_SHOW_MENU_1",
                    "ELEMENT_SORT_FIELD2" => "sort",
                    "ELEMENT_SORT_ORDER" => "desc",
                    "ELEMENT_SORT_ORDER2" => "asc",
                    "ENLARGE_PRODUCT" => "PROP",
                    "ENLARGE_PROP" => "NEWPRODUCT",
                    "FILTER_NAME" => "arrFilter",
                    "HIDE_NOT_AVAILABLE" => "N",
                    "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                    "IBLOCK_ID" => $IBLOCK_ID,
                    "IBLOCK_TYPE" => $IBLOCK_TYPE_ID,
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "LABEL_PROP" => array("NEWPRODUCT"),
                    "LABEL_PROP_MOBILE" => array(),
                    "LABEL_PROP_POSITION" => "top-left",
                    "LAZY_LOAD" => "Y",
                    "LINE_ELEMENT_COUNT" => "5",
                    "LOAD_ON_SCROLL" => "N",
                    "MESSAGE_404" => "",
                    "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                    "MESS_BTN_BUY" => "Купить",
                    "MESS_BTN_DETAIL" => "Подробнее",
                    "MESS_BTN_LAZY_LOAD" => "Показать ещё",
                    "MESS_BTN_SUBSCRIBE" => "Подписаться",
                    "MESS_NOT_AVAILABLE" => "Нет в наличии",
                    "META_DESCRIPTION" => "-",
                    "META_KEYWORDS" => "-",
                    "OFFERS_CART_PROPERTIES" => array("ARTNUMBER","COLOR_REF","SIZES_SHOES","SIZES_CLOTHES"),
                    "OFFERS_FIELD_CODE" => array("",""),
                    "OFFERS_LIMIT" => "5",
                    "OFFERS_PROPERTY_CODE" => array("COLOR_REF","SIZES_SHOES","SIZES_CLOTHES",""),
                    "OFFERS_SORT_FIELD" => "sort",
                    "OFFERS_SORT_FIELD2" => "id",
                    "OFFERS_SORT_ORDER" => "asc",
                    "OFFERS_SORT_ORDER2" => "desc",
                    "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
                    "OFFER_TREE_PROPS" => array("COLOR_REF","SIZES_SHOES","SIZES_CLOTHES"),
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => ".default",
                    "PAGER_TITLE" => "Товары",
                    "PAGE_ELEMENT_COUNT" => "5",
                    "PARTIAL_PRODUCT_PROPERTIES" => "N",
                    "PRICE_CODE" => array("BASE"),
                    "PRICE_VAT_INCLUDE" => "Y",
                    "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
                    "PRODUCT_DISPLAY_MODE" => "Y",
                    "PRODUCT_ID_VARIABLE" => "id",
                    "PRODUCT_PROPERTIES" => array("NEWPRODUCT","MATERIAL"),
                    "PRODUCT_PROPS_VARIABLE" => "prop",
                    "PRODUCT_QUANTITY_VARIABLE" => "",
                    "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':true}]",
                    "PRODUCT_SUBSCRIPTION" => "Y",
                    "PROPERTY_CODE" => array("NEWPRODUCT",""),
                    "PROPERTY_CODE_MOBILE" => array(),
                    "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
                    "RCM_TYPE" => "personal",
                    "SECTION_CODE" => "",
                    "SECTION_ID" => $section['ID'],
                    "SECTION_ID_VARIABLE" => "SECTION_ID",
                    "SECTION_URL" => "",
                    "SECTION_USER_FIELDS" => array("",""),
                    "SEF_MODE" => "N",
                    "SET_BROWSER_TITLE" => "Y",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "Y",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "Y",
                    "SHOW_404" => "N",
                    "SHOW_ALL_WO_SECTION" => "N",
                    "SHOW_CLOSE_POPUP" => "N",
                    "SHOW_DISCOUNT_PERCENT" => "Y",
                    "SHOW_FROM_SECTION" => "N",
                    "SHOW_MAX_QUANTITY" => "N",
                    "SHOW_OLD_PRICE" => "N",
                    "SHOW_PRICE_COUNT" => "1",
                    "SHOW_SLIDER" => "Y",
                    "SLIDER_INTERVAL" => "3000",
                    "SLIDER_PROGRESS" => "N",
                    "TEMPLATE_THEME" => "blue",
                    "USE_ENHANCED_ECOMMERCE" => "Y",
                    "USE_MAIN_ELEMENT_SECTION" => "N",
                    "USE_PRICE_COUNT" => "N",
                    "USE_PRODUCT_QUANTITY" => "N"
                )
            );?>

            <?
                endif;

        ?>


        </div>

        <div class="bottom-section">
        <a href="<?=$section['SECTION_PAGE_URL']?>">Посмотреть весь раздел</a>
        </div>
        <?
    }
    else $errors[] = "Раздел не найден";
}
else $errors[] = "Не задан id";

if($errors) print_r($errors);
?>