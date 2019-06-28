<?
if($arParams['DISPLAY_PICTURE'] != 'N'){
	if(is_array($arResult['DETAIL_PICTURE'])){
		CPriority::getFieldImageData($arResult, array('DETAIL_PICTURE'));
		$arResult['GALLERY'][] = array(
			'DETAIL' => $arResult['DETAIL_PICTURE'],
			'PREVIEW' => CFile::ResizeImageGet($arResult['DETAIL_PICTURE'] , array('width' => 450, 'height' => 450), BX_RESIZE_PROPORTIONAL_ALT, true),
			'THUMB' => CFile::ResizeImageGet($arResult['DETAIL_PICTURE'] , array('width' => 60, 'height' => 60), BX_RESIZE_IMAGE_EXACT, true),
			'TITLE' => (strlen($arResult['DETAIL_PICTURE']['DESCRIPTION']) ? $arResult['DETAIL_PICTURE']['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['TITLE']) ? $arResult['DETAIL_PICTURE']['TITLE'] : $arResult['NAME'])),
			'ALT' => (strlen($arResult['DETAIL_PICTURE']['DESCRIPTION']) ? $arResult['DETAIL_PICTURE']['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['ALT']) ? $arResult['DETAIL_PICTURE']['ALT'] : $arResult['NAME'])),
		);
	}
	
	if(!empty($arResult['PROPERTIES']['PHOTOS']['VALUE'])){
		foreach($arResult['PROPERTIES']['PHOTOS']['VALUE'] as $img){
			$arResult['GALLERY'][] = array(
				'DETAIL' => ($arPhoto = CFile::GetFileArray($img)),
				'PREVIEW' => CFile::ResizeImageGet($img, array('width' => 450, 'height' => 450), BX_RESIZE_PROPORTIONAL_ALT, true),
				'THUMB' => CFile::ResizeImageGet($img , array('width' => 60, 'height' => 60), BX_RESIZE_IMAGE_EXACT, true),
				'TITLE' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['TITLE']) ? $arResult['DETAIL_PICTURE']['TITLE']  :(strlen($arPhoto['TITLE']) ? $arPhoto['TITLE'] : $arResult['NAME']))),
				'ALT' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['ALT']) ? $arResult['DETAIL_PICTURE']['ALT']  : (strlen($arPhoto['ALT']) ? $arPhoto['ALT'] : $arResult['NAME']))),
			);
		}
	}
}

if(!empty($arResult['PROPERTIES']['GALLEY_BIG']['VALUE'])){
	foreach($arResult['PROPERTIES']['GALLEY_BIG']['VALUE'] as $img){
		$arResult['GALLERY_BIG'][] = array(
			'DETAIL' => ($arPhoto = CFile::GetFileArray($img)),
			'PREVIEW' => CFile::ResizeImageGet($img, array('width' => 10000, 'height' => 666), BX_RESIZE_PROPORTIONAL_ALT, true),
			'THUMB' => CFile::ResizeImageGet($img , array('width' => 60, 'height' => 60), BX_RESIZE_IMAGE_EXACT, true),
			'TITLE' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['TITLE']) ? $arResult['DETAIL_PICTURE']['TITLE']  :(strlen($arPhoto['TITLE']) ? $arPhoto['TITLE'] : $arResult['NAME']))),
			'ALT' => (strlen($arPhoto['DESCRIPTION']) ? $arPhoto['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['ALT']) ? $arResult['DETAIL_PICTURE']['ALT']  : (strlen($arPhoto['ALT']) ? $arPhoto['ALT'] : $arResult['NAME']))),
		);
	}
}

if($arResult['DISPLAY_PROPERTIES']){
	$arResult['CHARACTERISTICS'] = array();
	$arResult['VIDEO'] = array();
	$arResult['VIDEO_IFRAME'] = array();
	foreach($arResult['DISPLAY_PROPERTIES'] as $PCODE => $arProp){
		if(!in_array($arProp['CODE'], array('DELIVERY', 'PERIOD', 'PHOTOS', 'PRICE', 'PRICEOLD', 'ARTICLE', 'STATUS', 'TIZERS', 'DOCUMENTS', 'LINK_GOODS', 'LINK_STAFF', 'LINK_REVIEWS', 'LINK_PROJECTS', 'LINK_SERVICES', 'FORM_ORDER', 'FORM_QUESTION', 'PHOTOPOS')) && ($arProp['PROPERTY_TYPE'] != 'E' && $arProp['PROPERTY_TYPE'] != 'G')){
			if($arProp["VALUE"] || strlen($arProp["VALUE"])){
				if ($arProp['USER_TYPE'] == 'video') {
					if (count($arProp['PROPERTY_VALUE_ID']) >= 1) {
						foreach($arProp['VALUE'] as $val){
							if($val['path']){
								$arResult['VIDEO'][] = $val;
							}
						}
					}
					elseif($arProp['VALUE']['path']){
						$arResult['VIDEO'][] = $arProp['VALUE'];
					}
				}
				elseif($arProp['CODE'] == 'VIDEO_IFRAME'){
					$arResult['VIDEO_IFRAME'] = $arProp["~VALUE"];
				}
				else{
					$arResult['CHARACTERISTICS'][$PCODE] = $arProp;
				}
			}
		}
	}
}

/*brand item*/
$arBrand = array();
if(strlen($arResult["DISPLAY_PROPERTIES"]["BRAND"]["VALUE"]) && $arResult["PROPERTIES"]["BRAND"]["LINK_IBLOCK_ID"]){
	$arBrand = CCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CCache::GetIBlockCacheTag($arResult["PROPERTIES"]["BRAND"]["LINK_IBLOCK_ID"]))), array("IBLOCK_ID" => $arResult["PROPERTIES"]["BRAND"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "ID" => $arResult["DISPLAY_PROPERTIES"]["BRAND"]["VALUE"]), false, false, array("ID", "NAME", "PREVIEW_TEXT", "PREVIEW_TEXT_TYPE", "DETAIL_TEXT", "DETAIL_TEXT_TYPE", "PREVIEW_PICTURE", "DETAIL_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_SITE"));
	if($arBrand){
		if($arBrand["PREVIEW_PICTURE"] || $arBrand["DETAIL_PICTURE"]){
			$arBrand["IMAGE"] = CFile::ResizeImageGet(($arBrand["PREVIEW_PICTURE"] ? $arBrand["PREVIEW_PICTURE"] : $arBrand["DETAIL_PICTURE"]), array("width" => 120, "height" => 40), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
		}
	}
}
$arResult["BRAND_ITEM"]=$arBrand;

if($arResult["DISPLAY_PROPERTIES"]['TIZERS']['VALUE']){
	$arResult['TIZERS'] = CCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" =>"Y", "TAG" => CCache::GetIBlockCacheTag($arParams['TIZERS_IBLOCK_ID']))), array("IBLOCK_ID" => $arParams['TIZERS_IBLOCK_ID'], "ACTIVE"=>"Y", "ID" => $arResult["DISPLAY_PROPERTIES"]['TIZERS']['VALUE']), false, false, array("NAME", 'PREVIEW_TEXT', 'PROPERTY_ICON', 'PROPERTY_BACKGROUND', 'PROPERTY_LINK'));
}

if(isset($arResult['PROPERTIES']['BNR_TOP']) && $arResult['PROPERTIES']['BNR_TOP']['VALUE'] == 'Y')
{
	$cp = $this->__component;
	if(is_object($cp))
	{
		$cp->arResult['SECTION_BNR_CONTENT'] = true;
	    $cp->SetResultCacheKeys( array('SECTION_BNR_CONTENT') );
	}
}
?>