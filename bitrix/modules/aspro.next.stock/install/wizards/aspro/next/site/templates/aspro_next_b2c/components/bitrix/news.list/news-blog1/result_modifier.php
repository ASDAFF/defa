<?
$arSectionsIDs = $arResult['SECTIONS'] = array();
foreach($arResult['ITEMS'] as $key => $arItem){
	if($SID = $arItem['IBLOCK_SECTION_ID']){
		$arSectionsIDs[] = $SID;
	}
	CNextStock::getFieldImageData($arResult['ITEMS'][$key], array('PREVIEW_PICTURE'));
}
if($arSectionsIDs){
	$arResult['SECTIONS'] = CNextCacheStock::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CNextCacheStock::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), array('ID' => $arSectionsIDs));
}

// group elements by sections
foreach($arResult['ITEMS'] as $key => $arItem){
	$SID = ($arItem['IBLOCK_SECTION_ID'] ? $arItem['IBLOCK_SECTION_ID'] : 0);
	$arResult['SECTIONS'][$SID]['ITEMS'][$arItem['ID']] = $arItem;
}

// unset empty sections
if(is_array($arResult['SECTIONS'])){
	foreach($arResult['SECTIONS'] as $i => $arSection){
		if(!$arSection['ITEMS']){
			unset($arResult['SECTIONS'][$i]);
		}
	}
}
?>