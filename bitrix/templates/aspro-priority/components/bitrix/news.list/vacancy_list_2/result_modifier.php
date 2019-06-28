<?
if($arResult['ITEMS']){
	foreach($arResult['ITEMS'] as $key => $arItem){
		if($SID = $arItem['IBLOCK_SECTION_ID']){
			$arSectionsIDs[] = $SID;
		}
		if(isset($arItem['DISPLAY_PROPERTIES']['PAY']) && strlen($arItem['DISPLAY_PROPERTIES']['PAY']['DISPLAY_VALUE'])){
			$arResult['ITEMS'][$key]['PAY'] = $arItem['DISPLAY_PROPERTIES']['PAY']['DISPLAY_VALUE'];
			unset($arResult['ITEMS'][$key]['DISPLAY_PROPERTIES']['PAY']);
		}
	}

	if($arSectionsIDs){
		$arResult['SECTIONS'] = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), array('ID' => $arSectionsIDs, 'ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y', 'GLOBAL_ACTIVE' => 'Y'));
	}
	
	if($arResult['SECTIONS']){
		foreach($arResult['SECTIONS'] as $arSection){
			$arItemsSectionsIDs[] = $arSection['ID'];
		}
	}	

	// group elements by sections
	foreach($arResult['ITEMS'] as $arItem){
		$SID = ($arItem['IBLOCK_SECTION_ID'] ? $arItem['IBLOCK_SECTION_ID'] : 0);
		if(in_array($arItem['IBLOCK_SECTION_ID'], $arItemsSectionsIDs) || !$arItem['IBLOCK_SECTION_ID']){
			$arResult['SECTIONS'][$SID]['ITEMS'][$arItem['ID']] = $arItem;
		}
	}

	// unset empty sections
	if(is_array($arResult['SECTIONS'])){
		foreach($arResult['SECTIONS'] as $i => $arSection){
			if(!$arSection['ITEMS']){
				unset($arResult['SECTIONS'][$i]);
			}
		}
	}
}
?>