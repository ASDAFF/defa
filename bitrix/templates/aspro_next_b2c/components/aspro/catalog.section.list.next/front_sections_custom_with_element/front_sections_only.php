<div class="list items popular-list">
	<div class="row margin0 flexbox">
		<?foreach($arResult['SECTIONS'] as $arSection):
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
			<div class="col-md-12">
				<div class="popular-cat-item" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
					<div class="name">
						<a href="<?=$arSection['SECTION_PAGE_URL'];?>" class="dark_link"><?=$arSection['NAME'];?></a>
					</div>
				</div>
			</div>

            <?$APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "catalog_block_front_custom",
			array(
				"IBLOCK_TYPE" => "aspro_next_catalog",
				"IBLOCK_ID" => "17",
				"SECTION_ID" => $arSection['ID'],
				"SECTION_CODE" => "",
				"TABS_CODE" => "HIT",
				"SECTION_USER_FIELDS" => array(
					0 => "",
					1 => "",
				),
				"ELEMENT_SORT_FIELD" => "sort",
				"ELEMENT_SORT_ORDER" => "asc",
				"ELEMENT_SORT_FIELD2" => "id",
				"ELEMENT_SORT_ORDER2" => "desc",
				"INCLUDE_SUBSECTIONS" => "Y",
				"SHOW_ALL_WO_SECTION" => "Y",
				"HIDE_NOT_AVAILABLE" => "N",
				"PAGE_ELEMENT_COUNT" => "10",
				"LINE_ELEMENT_COUNT" => "4",
				"PROPERTY_CODE" => array(
					0 => "",
					1 => "",
				),
				"OFFERS_LIMIT" => "0",
				"SECTION_URL" => "",
				"DETAIL_URL" => "",
				"BASKET_URL" => "/basket/",
				"ACTION_VARIABLE" => "action",
				"PRODUCT_ID_VARIABLE" => "id",
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"SECTION_ID_VARIABLE" => "SECTION_ID",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_GROUPS" => "N",
				"CACHE_FILTER" => "Y",
				"META_KEYWORDS" => "-",
				"META_DESCRIPTION" => "-",
				"BROWSER_TITLE" => "-",
				"ADD_SECTIONS_CHAIN" => "N",
				"DISPLAY_COMPARE" => "Y",
				"SET_TITLE" => "N",
				"SET_STATUS_404" => "N",
				"PRICE_CODE" => array(
					0 => "BASE",
				),
				"USE_PRICE_COUNT" => "Y",
				"SHOW_PRICE_COUNT" => "1",
				"PRICE_VAT_INCLUDE" => "Y",
				"PRODUCT_PROPERTIES" => array(
				),
				"USE_PRODUCT_QUANTITY" => "N",
				"CONVERT_CURRENCY" => "N",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"PAGER_TITLE" => "Товары",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "catalog_block_front_custom",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"DISCOUNT_PRICE_CODE" => "",
				"AJAX_OPTION_ADDITIONAL" => "",
				"SHOW_ADD_FAVORITES" => "Y",
				"SECTION_NAME_FILTER" => "",
				"SECTION_SLIDER_FILTER" => "21",
				"COMPONENT_TEMPLATE" => "main",
				"OFFERS_FIELD_CODE" => array(
					0 => "ID",
					1 => "",
				),
				"OFFERS_PROPERTY_CODE" => array(
					0 => "",
					1 => "",
				),
				"OFFERS_SORT_FIELD" => "sort",
				"OFFERS_SORT_ORDER" => "asc",
				"OFFERS_SORT_FIELD2" => "id",
				"OFFERS_SORT_ORDER2" => "desc",
				"SHOW_MEASURE" => "Y",
				"OFFERS_CART_PROPERTIES" => array(
				),
				"DISPLAY_WISH_BUTTONS" => "Y",
				"SHOW_DISCOUNT_PERCENT" => "Y",
				"SHOW_OLD_PRICE" => "Y",
				"SHOW_RATING" => "Y",
				"SALE_STIKER" => "SALE_TEXT",
				"SHOW_DISCOUNT_TIME" => "N",
				"STORES" => array(
					0 => "1",
					1 => "2",
					2 => "",
				),
				"STIKERS_PROP" => "HIT",
				"SHOW_DISCOUNT_PERCENT_NUMBER" => "Y",
				"SHOW_MEASURE_WITH_RATIO" => "N",
				"COMPOSITE_FRAME_MODE" => "A",
				"COMPOSITE_FRAME_TYPE" => "AUTO"
			)
            );?>



		<?endforeach;?>
	</div>
</div>