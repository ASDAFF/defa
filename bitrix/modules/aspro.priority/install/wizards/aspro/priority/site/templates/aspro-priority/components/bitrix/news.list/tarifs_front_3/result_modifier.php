<?
function custom_mb_in_array(array $_hayStack,$_needle) {
    foreach ($_hayStack as $value) {
        if((mb_strtolower($value)) == (mb_strtolower($_needle))) {
            return true;
        }
    }
	return false;   
}

if($arResult['ITEMS'])
{
	$arResult['PROPS'] = $arResult['SECTIONS'] = $arSectionsID = array();
	$arHideProps = array('PRICE', 'FORM_ORDER', 'FILTER_PRICE');
	$arPlusValue = array('+', 1, 'true', 'y', GetMessage('YES'), GetMessage('TRUE'));
	$arMinusValue = array('-', 0, 'false', 'n', GetMessage('NO'), GetMessage('FALSE'));
	
	foreach($arResult['ITEMS'] as $key => $arItem){
		CPriority::getFieldImageData($arResult['ITEMS'][$key], array('PREVIEW_PICTURE'));
		/*if(isset($arItem['PROPERTIES']) && $arItem['PROPERTIES'])
		{
			foreach($arItem['PROPERTIES'] as $key => $arProp){
				if($arProp['VALUE'] && !in_array($arProp['CODE'], $arHideProps))
				{
					$arResult['PROPS'][$key]['NAME'] = $arProp['NAME'];
					
					if(custom_mb_in_array($arPlusValue, $arProp['VALUE']))
						$arResult['ITEMS'][$key_main]['PROPERTIES'][$key]['TYPE'] = 'Y';
					elseif(custom_mb_in_array($arMinusValue, $arProp['VALUE']))
						$arResult['ITEMS'][$key_main]['PROPERTIES'][$key]['TYPE'] = 'N';
				}
			}			
		}*/
		
		if($arItem['DISPLAY_PROPERTIES']){
			$arPropertyExclude = array('ONLY_ONE_PRICE', 'ICON', 'FORM_ORDER', 'HIT');
			foreach($arItem['DISPLAY_PROPERTIES'] as $PCODE => $arProp){
				if(strpos($PCODE, 'TARIF_PRICE') !== false || strpos($PCODE, 'FILTER_PRICE') !== false){
					$arPropertyExclude[] = $PCODE;
				}
				if(!in_array($arProp['CODE'], $arPropertyExclude)){
					if($arProp["VALUE"]){
						$arResult['ITEMS'][$key]['CHARACTERISTICS'][$PCODE] = $arProp;
					}
				}
				elseif(strpos($PCODE, 'TARIF_PRICE') !== false && $arProp['VALUE']){
					$arPropCode = explode('_', $PCODE);
					$arResult['ITEMS'][$key]['PRICES'][] = $arProp;
					$arResult['ITEMS'][$key]['FILTER_PRICES'][] = $arItem['PROPERTIES']['FILTER_PRICE_'.$arPropCode[count($arPropCode) - 1]]['VALUE'];
					
					if($PCODE == 'TARIF_PRICE_DEFAULT'){
						$arResult['ITEMS'][$key]['DEFAULT_PRICE'] = $arProp;
						$arResult['ITEMS'][$key]['DEFAULT_PRICE']['FILTER_PRICE'] = $arItem['PROPERTIES']['FILTER_PRICE_DEFAULT']['VALUE'];
					}
				}
			}
		}
		$arSectionsID[$arItem['IBLOCK_SECTION_ID']] = $arItem['IBLOCK_SECTION_ID'];		
	}
	
	if($arSectionsID){
		$arResult['SECTIONS'] = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => $arSectionsID, 'ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'), false, array('ID', 'NAME'));
	}
}
?>