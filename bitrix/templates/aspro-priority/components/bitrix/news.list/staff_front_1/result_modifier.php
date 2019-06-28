<?
if($arResult['ITEMS'])
{
	$arSectionsIDs = array();
	foreach($arResult['ITEMS'] as $key => $arItem)
	{
		$arResult['ITEMS'][$key]['DETAIL_PAGE_URL'] = CPriority::FormatNewsUrl($arItem);
		CPriority::getFieldImageData($arResult['ITEMS'][$key], array('PREVIEW_PICTURE'));
		if($SID = $arItem['IBLOCK_SECTION_ID'])
		{
			$arSectionsIDs[] = $SID;
		}
		if($arItem['PROPERTIES'])
		{
			foreach($arItem['PROPERTIES'] as $key2 => $arProp)
			{
				if(($key2 == 'EMAIL' || $key2 == 'PHONE') && $arProp['VALUE'])
					$arResult['ITEMS'][$key]['MIDDLE_PROPS'][] = $arProp;
				if(strpos($key2, 'SOCIAL') !== false && $arProp['VALUE']){
					switch($key2){
						case('SOCIAL_VK'):
								$arProp['FILE'] = SITE_TEMPLATE_PATH.'/images/include_svg/social_vk.svg';
								break;
							case('SOCIAL_ODN'):
								$arProp['FILE'] = SITE_TEMPLATE_PATH.'/images/include_svg/social_odnoklassniki.svg';
								break;
							case('SOCIAL_FB'):
								$arProp['FILE'] = SITE_TEMPLATE_PATH.'/images/include_svg/social_facebook.svg';
								break;
							case('SOCIAL_MAIL'):
								$arProp['FILE'] = SITE_TEMPLATE_PATH.'/images/include_svg/social_mail.svg';
								break;
							case('SOCIAL_TW'):
								$arProp['FILE'] = SITE_TEMPLATE_PATH.'/images/include_svg/social_twitter.svg';
								break;						
							case('SOCIAL_INST'):
								$arProp['FILE'] = SITE_TEMPLATE_PATH.'/images/include_svg/social_instagram.svg';
								break;						
							case('SOCIAL_GOOGLE'):
								$arProp['FILE'] = SITE_TEMPLATE_PATH.'/images/include_svg/social_google.svg';
								break;						
							case('SOCIAL_SKYPE'):
								$arProp['FILE'] = SITE_TEMPLATE_PATH.'/images/include_svg/skype.svg';
								break;						
							case('SOCIAL_BITRIX'):
								$arProp['FILE'] = SITE_TEMPLATE_PATH.'/images/include_svg/bitrix24.svg';
								break;						
					}
					
					$arResult['ITEMS'][$key]['SOCIAL_PROPS'][] = $arProp;
				}
			}
		}
	}
	if($arSectionsIDs){
		$arResult['SECTIONS'] = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), array('ID' => $arSectionsIDs));
	}
}
?>