<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<div class="series-filters">
	
<?if( count( $arResult["ITEMS"] ) >= 1 ){?>

	<?if(($arParams["AJAX_REQUEST"]=="N") || !isset($arParams["AJAX_REQUEST"])){?>
		<?if(isset($arParams["TITLE"]) && $arParams["TITLE"]):?>
			<hr/>
			<h5><?=$arParams['TITLE'];?></h5>
		<?endif;?>
		<div class="top_wrapper row margin0 <?=($arParams["SHOW_UNABLE_SKU_PROPS"] != "N" ? "show_un_props" : "unshow_un_props");?>">
			<div class="catalog_block111 items11 block_list">
	<?}?>
		<?
		$currencyList = '';
		if (!empty($arResult['CURRENCIES'])){
			$templateLibrary[] = 'currency';
			$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
		}
		$templateData = array(
			'TEMPLATE_LIBRARY' => $templateLibrary,
			'CURRENCIES' => $currencyList
		);
		unset($currencyList, $templateLibrary);

		$arParams["BASKET_ITEMS"]=($arParams["BASKET_ITEMS"] ? $arParams["BASKET_ITEMS"] : array());
		$arOfferProps = implode(';', $arParams['OFFERS_CART_PROPERTIES']);


		switch ($arParams["LINE_ELEMENT_COUNT"]){
			case '1':
			case '2':
				$col=2;
				break;
			case '3':
				$col=3;
				break;
			case '5':
				$col=5;
				break;
			default:
				$col=4;
				break;
		}
		if($arParams["LINE_ELEMENT_COUNT"] > 5)
			$col = 5;
			$product_filters = [];
			
			foreach ($arResult["ITEMS"] as $arItems)
				{
				    $product_filters[$arItems['PROPERTIES']['TYPE_PRODUCT']['VALUE_ENUM_ID']][] = $arItems;
				    $product_group_name[$arItems['PROPERTIES']['TYPE_PRODUCT']['VALUE_ENUM_ID']] = ['NAME' => $arItems['PROPERTIES']['TYPE_PRODUCT']['VALUE_ENUM']];
				}?>
				<div class="series-sort">

	
				<div class="row">
					<div class="col-lg-12 filters-main-title">
						<div class="top_block">
							<h3 class="title_block big">Товары серии</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 select">
		                <div class="sort-list-wrapper" id="section_block">
		                    <p class="sort-evt">Выберите тип:</p>                    
			                    <ul class="sort-list">
			                    	<?foreach ($product_group_name as $key => $category) {
										echo "<li class='sort-item'><a href='#block_id_$key'>".$category['NAME']."</a></li>";
									} 
									?>
			                    </ul>
		                </div>
		                <div class="view-list">
		                    <a href="" rel="nofollow" class="view-item active web"><span>Сеткой</span></a>
		                    <a href="" rel="nofollow" class="view-item list"><span>Списком</span></a>
		                </div>
		            </div>
		        </div>

			<? foreach ($product_filters as $group => $names) {?>
				<div class="group_block" id="block_id_<?=$group;?>">
					<div class="top_block">
                        <h3 class="title_block big filters-title"><?=$product_group_name[$group]['NAME'];?></h3>
						<a id="toggleLink_<?=$group;?>" href="javascript:void(0);" onclick="viewdiv('hiddens_block_<?=$group;?>');" data-text-show="Скрыть" data-text-hide="Показать">Скрыть</a>
                    </div>
					<div class="hiddens_block" id="hiddens_block_<?=$group;?>" >
						<div class="row width100">
                            <div class="ajax_news_<?=$group;?>">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:catalog.section",
                                    "catalog_section_list_element",
                                    array(
                                        "ACTION_VARIABLE" => "action",
                                        "ADD_PICT_PROP" => "-",
                                        "ADD_PROPERTIES_TO_BASKET" => "Y",
                                        "ADD_SECTIONS_CHAIN" => "N",
                                        "ADD_TO_BASKET_ACTION" => "ADD",
                                        "AJAX_MODE" => "N",
                                        "AJAX_OPTION_ADDITIONAL" => "",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_STYLE" => "Y",
                                        "BACKGROUND_IMAGE" => "-",
                                        "BASKET_URL" => "/personal/basket.php",
                                        "BROWSER_TITLE" => "-",
                                        "CACHE_FILTER" => "N",
                                        "CACHE_GROUPS" => "Y",
                                        "CACHE_TIME" => "36000000",
                                        "CACHE_TYPE" => "A",
                                        "COMPATIBLE_MODE" => "Y",
                                        "CONVERT_CURRENCY" => "N",
                                        "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:17:647\",\"DATA\":{\"logic\":\"Equal\",\"value\":$group}}]}",
                                        "DETAIL_URL" => "",
                                        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                                        "DISPLAY_BOTTOM_PAGER" => "Y",
                                        "DISPLAY_COMPARE" => "N",
                                        "DISPLAY_TOP_PAGER" => "N",
                                        "ELEMENT_SORT_FIELD" => "sort",
                                        "ELEMENT_SORT_FIELD2" => "id",
                                        "ELEMENT_SORT_ORDER" => "asc",
                                        "ELEMENT_SORT_ORDER2" => "desc",
                                        "ENLARGE_PRODUCT" => "STRICT",
                                        "FILTER_NAME" => "arrFilter",
                                        "HIDE_NOT_AVAILABLE" => "N",
                                        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                                        "IBLOCK_ID" => "17",
                                        "IBLOCK_TYPE" => "aspro_next_catalog",
                                        "INCLUDE_SUBSECTIONS" => "Y",
                                        "LABEL_PROP" => "",
                                        "LAZY_LOAD" => "N",
                                        "LINE_ELEMENT_COUNT" => "4",
                                        "LOAD_ON_SCROLL" => "N",
                                        "MESSAGE_404" => "",
                                        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                                        "MESS_BTN_BUY" => "Купить",
                                        "MESS_BTN_DETAIL" => "Подробнее",
                                        "MESS_BTN_SUBSCRIBE" => "Подписаться",
                                        "MESS_NOT_AVAILABLE" => "Нет в наличии",
                                        "META_DESCRIPTION" => "-",
                                        "META_KEYWORDS" => "-",
                                        "OFFERS_CART_PROPERTIES" => array(
                                        ),
                                        "OFFERS_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "OFFERS_LIMIT" => "5",
                                        "OFFERS_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "OFFERS_SORT_FIELD" => "sort",
                                        "OFFERS_SORT_FIELD2" => "id",
                                        "OFFERS_SORT_ORDER" => "asc",
                                        "OFFERS_SORT_ORDER2" => "desc",
                                        "PAGER_BASE_LINK_ENABLE" => "N",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "N",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_TEMPLATE" => ".default",
                                        "PAGER_TITLE" => "Товары",
                                        "PAGE_ELEMENT_COUNT" => "4",
                                        "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                        "PRICE_CODE" => array(
                                        ),
                                        "PRICE_VAT_INCLUDE" => "Y",
                                        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                                        "PRODUCT_DISPLAY_MODE" => "N",
                                        "PRODUCT_ID_VARIABLE" => "id",
                                        "PRODUCT_PROPERTIES" => array(
                                        ),
                                        "PRODUCT_PROPS_VARIABLE" => "prop",
                                        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                                        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                                        "PRODUCT_SUBSCRIPTION" => "Y",
                                        "PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "PROPERTY_CODE_MOBILE" => "",
                                        "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
                                        "RCM_TYPE" => "personal",
                                        "SECTION_CODE" => "kabinet_rukovoditelya",
                                        "SECTION_ID" => "",
                                        "SECTION_ID_VARIABLE" => "SECTION_ID",
                                        "SECTION_URL" => "",
                                        "SECTION_USER_FIELDS" => array(
                                            0 => "",
                                            1 => "",
                                        ),
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
                                        "SHOW_DISCOUNT_PERCENT" => "N",
                                        "SHOW_FROM_SECTION" => "N",
                                        "SHOW_MAX_QUANTITY" => "N",
                                        "SHOW_OLD_PRICE" => "N",
                                        "SHOW_PRICE_COUNT" => "1",
                                        "SHOW_SLIDER" => "Y",
                                        "SLIDER_INTERVAL" => "3000",
                                        "SLIDER_PROGRESS" => "N",
                                        "TEMPLATE_THEME" => "blue",
                                        "USE_ENHANCED_ECOMMERCE" => "N",
                                        "USE_MAIN_ELEMENT_SECTION" => "N",
                                        "USE_PRICE_COUNT" => "N",
                                        "USE_PRODUCT_QUANTITY" => "N",
                                        "COMPONENT_TEMPLATE" => "catalog_custom_block"
                                    ),
                                    false
                                );?></div>

                            <div class="more_items">
                                <span class="button btn btn-default" onmousedown="loadMoreNews_<?=$group;?>();">Загрузить еще</span>
                            </div>
                            <script>
                                var newsPagen = 2;
                                function loadMoreNews_<?=$group;?>(){
                                    $.ajax({
                                        url: 'ajax.php?GROUP=<?=$group;?>&PAGEN_1=' + newsPagen,
                                        success: function(data){
                                            $('.ajax_news_<?=$group;?>').append(data);
                                            newsPagen++;
                                        }
                                    });
                                }
                            </script>
						</div>
					</div>

				</div>
			<?}?>
	<?if(($arParams["AJAX_REQUEST"]=="N") || !isset($arParams["AJAX_REQUEST"])){?>
			</div>
		</div>
	<?}?>

<?}else{?>
	<script>
		// $(document).ready(function(){
			$('.sort_header').animate({'opacity':'1'}, 500);
		// })
	</script>
	<div class="no_goods catalog_block_view">
		<div class="no_products">
			<div class="wrap_text_empty">
				<?if($_REQUEST["set_filter"]){?>
					<?$APPLICATION->IncludeFile(SITE_DIR."include/section_no_products_filter.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('EMPTY_CATALOG_DESCR')));?>
				<?}else{?>
					<?$APPLICATION->IncludeFile(SITE_DIR."include/section_no_products.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('EMPTY_CATALOG_DESCR')));?>
				<?}?>
			</div>
		</div>
		<?if($_REQUEST["set_filter"]){?>
			<span class="button wide btn btn-default"><?=GetMessage('RESET_FILTERS');?></span>
		<?}?>
	</div>
<?}?>
</div>
</div>
<script>
	BX.message({
		QUANTITY_AVAILIABLE: '<? echo COption::GetOptionString("aspro_next_b2c", "EXPRESSION_FOR_EXISTS", GetMessage("EXPRESSION_FOR_EXISTS_DEFAULT"), SITE_ID); ?>',
		QUANTITY_NOT_AVAILIABLE: '<? echo COption::GetOptionString("aspro_next_b2c", "EXPRESSION_FOR_NOTEXISTS", GetMessage("EXPRESSION_FOR_NOTEXISTS"), SITE_ID); ?>',
		ADD_ERROR_BASKET: '<? echo GetMessage("ADD_ERROR_BASKET"); ?>',
		ADD_ERROR_COMPARE: '<? echo GetMessage("ADD_ERROR_COMPARE"); ?>',
	})
	sliceItemBlock();
</script>