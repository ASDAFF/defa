<?
if($arResult['ITEMS'])
{
	$arSectionsID = array();
	$bHasImg = false;
	foreach($arResult['ITEMS'] as $key_item => $arItem)
	{
		CPriority::getFieldImageData($arItem, array('PREVIEW_PICTURE'));
		if($arItem['PREVIEW_PICTURE'])
			$bHasImg = true;
		if($arItem['PROPERTIES'])
		{
			foreach($arItem['PROPERTIES'] as $key_prop => $arProperty)
			{
				if($arProperty["USER_TYPE"]=="directory" && isset($arProperty["USER_TYPE_SETTINGS"]["TABLE_NAME"])) // get values from highload
				{
					$rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('=TABLE_NAME'=>$arProperty["USER_TYPE_SETTINGS"]["TABLE_NAME"])));
			        if ($arData = $rsData->fetch()){
			            $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);
			            $entityDataClass = $entity->getDataClass();
			            $arFilter = array(
			                'filter' => array(
			                    '=UF_XML_ID' => $arProperty["VALUE"]
			                )
			            );
			            $rsValues = $entityDataClass::getList($arFilter);
			            while($arValue = $rsValues->fetch())
			            {
			            	$arResult['ITEMS'][$key_item]['PROPERTIES'][$key_prop]['FORMAT'][] = $arValue;
			            }
			        }
				}
			}
		}
		
		if($arItem['IBLOCK_SECTION_ID']){
			$arSectionsID[] = $arItem['IBLOCK_SECTION_ID'];
		}
	}

	if($arSectionsID){
		$arResult['SECTIONS'] = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => $arSectionsID), false, array('ID', 'NAME'));
	}
}
?>