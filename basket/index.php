<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
$articuls = array_diff(array_map("trim", explode(";", $_POST["articuls"])), array(''));
if ($articuls){
	CModule::IncludeModule("sale");
    CModule::IncludeModule("catalog");
	
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "XML_ID", "IBLOCK_EXTERNAL_ID", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_COLOR_REF", "CATALOG_GROUP_*");
	$arFilter = Array("IBLOCK_ID" => 20, "PROPERTY_ARTICLE" => $articuls);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>5), $arSelect);
	while($ob = $res->getNextElement()){
		$arFields = $ob->GetFields();
		$arProperties = $ob->GetProperties();
		
		$arProduct = CCatalogProductProvider::GetProductData(array(
            'PRODUCT_ID'     => $arFields['ID'],
            'RENEWAL'        => 'N',
            "CHECK_QUANTITY" => "Y",
            "CHECK_DISCOUNT" => "Y",
            "CHECK_PRICE"    => "Y",
            'QUANTITY'       => 1,
            'SITE_ID'        => LANG,
            "USER_ID"        => intval($USER->GetID()),
        ));
		if($arProduct) {
			$arProduct['PRODUCT_ID'] = $arFields['ID'];
            $arProduct['MODULE'] = 'catalog';
            $arProduct['PRODUCT_PROVIDER_CLASS'] = '\Bitrix\Catalog\Product\CatalogProvider';
            $arProduct["LID"] = LANG;
			if($arProperties["MORE_PHOTO"]["VALUE"] || $arFields['PREVIEW_PICTURE'] || $arFields['DETAIL_PICTURE']) {
				$pictureId = ($arProperties["MORE_PHOTO"]["VALUE"][0]?$arProperties["MORE_PHOTO"]["VALUE"][0]:$arFields['PREVIEW_PICTURE']);
                $pictureId = ($pictureId ? $pictureId : $arFields['DETAIL_PICTURE']);
                $arFileTmp = CFile::ResizeImageGet($pictureId, array("width" => 150, "height" => 150));
				if($arFileTmp['src'])
                    $arFileTmp['src'] = CUtil::GetAdditionalFileURL($arFileTmp['src'], true);

                $arProduct['PICTURE'] = array_change_key_case($arFileTmp, CASE_UPPER);
			}
			$arPrice = CCatalogProduct::GetOptimalPrice($arFields['ID'], 1, $USER->GetUserGroupArray(), 'N');
			$arProduct["PRICE"] = $arPrice["RESULT_PRICE"]["DISCOUNT_PRICE"];
            $arProduct["BASE_PRICE"] = $arPrice["RESULT_PRICE"]["BASE_PRICE"];
			
			$arProps = array();
			$arProps[0] = array(
				"CODE" => "CATALOG.XML_ID",
				"NAME" => "Catalog XML_ID",
				"VALUE" => $arProduct["CATALOG_XML_ID"]
			);
			$arProps[1] = array(
				"NAME" => "Product XML_ID",
				"CODE" => "PRODUCT.XML_ID",
				"VALUE" => $arProduct["PRODUCT_XML_ID"]
			);
			
			$arProduct["PROPS"] = $arProps;
			
			CSaleBasket::Add($arProduct);
		}
	}
}
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket", 
	".default", 
	array(
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "DISCOUNT",
			2 => "PROPS",
			3 => "DELETE",
			4 => "DELAY",
			5 => "TYPE",
			6 => "PRICE",
			7 => "QUANTITY",
			8 => "SUM",
		),
		"OFFERS_PROPS" => array(
			0 => "SIZES",
			1 => "COLOR_REF",
		),
		"PATH_TO_ORDER" => SITE_DIR."order/",
		"HIDE_COUPON" => "N",
		"PRICE_VAT_SHOW_VALUE" => "Y",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"USE_PREPAYMENT" => "N",
		"SET_TITLE" => "N",
		"AJAX_MODE_CUSTOM" => "Y",
		"SHOW_MEASURE" => "Y",
		"PICTURE_WIDTH" => "100",
		"PICTURE_HEIGHT" => "100",
		"SHOW_FULL_ORDER_BUTTON" => "Y",
		"SHOW_FAST_ORDER_BUTTON" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"QUANTITY_FLOAT" => "N",
		"ACTION_VARIABLE" => "action",
		"TEMPLATE_THEME" => "blue",
		"AUTO_CALCULATION" => "Y",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"USE_GIFTS" => "Y",
		"GIFTS_PLACE" => "BOTTOM",
		"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
		"GIFTS_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "undefined",
		"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
		"GIFTS_PAGE_ELEMENT_COUNT" => "4",
		"GIFTS_CONVERT_CURRENCY" => "N",
		"GIFTS_HIDE_NOT_AVAILABLE" => "N"
	),
	false
);?>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	"basket", 
	array(
		"COMPONENT_TEMPLATE" => "basket",
		"PATH" => SITE_DIR."include/comp_basket_bigdata.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "standard.php",
		"PRICE_CODE" => array(
			0 => "BASE",
			1 => "OPT",
		),
		"STORES" => array(
			0 => "1",
			1 => "2",
			2 => "",
		),
		"BIG_DATA_RCM_TYPE" => "bestsell",
		"STIKERS_PROP" => "HIT",
		"SALE_STIKER" => "SALE_TEXT"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>