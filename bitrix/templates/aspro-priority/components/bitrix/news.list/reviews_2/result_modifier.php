<?
$arStaffsID = $arResult['STAFF'] = array();

foreach($arResult['ITEMS'] as $key => $arItem){
	if($SID = $arItem['IBLOCK_SECTION_ID']){
		$arSectionsIDs[] = $SID;
	}
	
	if(isset($arItem['DISPLAY_PROPERTIES']['STAFF'])){
		$arStaffsID[] = $arItem['DISPLAY_PROPERTIES']['STAFF']['VALUE'];
	}
	
	if($arStaffsID){
		$arResult['STAFF'] = CCache::CIblockElement_GetList(array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['STAFF_IBLOCK_ID']), 'MULTI' => 'N', 'GROUP' => 'ID')), array('IBLOCK_ID' => $arParams['STAFF_IBLOCK_ID'], 'ID' => $arStaffsID), false, false, array('ID', 'NAME', 'PROPERTY_POST', 'PREVIEW_PICTURE'));
	}

}

if($arSectionsIDs){
	$arResult['SECTIONS'] = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), array('ID' => $arSectionsIDs));
}

// group elements by sections
foreach($arResult['ITEMS'] as $arItem){
	$SID = ($arItem['IBLOCK_SECTION_ID'] ? $arItem['IBLOCK_SECTION_ID'] : 0);

	if($arItem['PROPERTIES'])
	{
		foreach($arItem['PROPERTIES'] as $key2 => $arProp)
		{
			if(($key2 == 'EMAIL' || $key2 == 'PHONE') && $arProp['VALUE'])
				$arItem['MIDDLE_PROPS'][] = $arProp;
			if(strpos($key2, 'SOCIAL') !== false && $arProp['VALUE'])
			{
				if($arItem['DISPLAY_PROPERTIES'][$key2])
					unset($arItem['DISPLAY_PROPERTIES'][$key2]);
				$arItem['SOCIAL_PROPS'][] = $arProp;
			}
		}
	}
	
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