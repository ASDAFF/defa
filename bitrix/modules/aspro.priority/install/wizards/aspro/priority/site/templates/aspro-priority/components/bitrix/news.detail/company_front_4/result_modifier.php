<?
CPriority::getFieldImageData($arResult, array('PREVIEW_PICTURE'));
$arResult['BG_VALUE'] = ((isset($arResult['FIELDS']['PREVIEW_PICTURE']) && $arResult['FIELDS']['PREVIEW_PICTURE']) ? $arResult['FIELDS']['PREVIEW_PICTURE'] : (isset($arResult['FIELDS']['DETAIL_PICTURE']) && $arResult['FIELDS']['DETAIL_PICTURE']) );

if((isset($arResult['PROPERTIES']['PROPS']) && $arResult['PROPERTIES']['PROPS']) && (isset($arResult['PROPERTIES']['PROPS']['VALUE']) && $arResult['PROPERTIES']['PROPS']['VALUE']))
{
	$arProps = array();
	$rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('=TABLE_NAME'=>$arResult['PROPERTIES']['PROPS']['USER_TYPE_SETTINGS']['TABLE_NAME'])));
	if($arData = $rsData->fetch()){
		$entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);
		$entityDataClass = $entity->getDataClass();
		$arFilter = array(
			'limit' => $arParams['COUNT_BENEFITS'],
			'filter' => array(
				'=UF_XML_ID' => $arResult['PROPERTIES']['PROPS']['VALUE']
			)
		);
		
		$rsValues = $entityDataClass::getList($arFilter);
		while($arValue = $rsValues->Fetch())
		{
			if(isset($arValue['UF_FILE']) && $arValue['UF_FILE'])
			{
				$arValue['UF_FILE_FORMAT'] = CFile::GetFileArray($arValue['UF_FILE']);
				$arValue['UF_FILE_FORMAT']['SMALL'] = CFile::ResizeImageGet($arValue['UF_FILE'], array('width' => 20, 'height' => 14), BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
			}
			$arProps[] = $arValue;
		}
	}
	$arResult['COMPANY_PROPS'] = $arProps;
}

//regional filter
$arResult['EMPTY_ITEM'] = 'N';
if($arParams['FILTER_NAME'])
{
	if(!is_array($GLOBALS[$arParams['FILTER_NAME']]))
		$GLOBALS[$arParams['FILTER_NAME']] = array();
	$arElement = CCache::CIblockElement_GetList(array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'N')), array_merge(array('ID' => $arResult['ID']), $GLOBALS[$arParams['FILTER_NAME']]), false, false, array('ID'));
	if(!$arElement)
		$arResult['EMPTY_ITEM'] = 'Y';
}
?>