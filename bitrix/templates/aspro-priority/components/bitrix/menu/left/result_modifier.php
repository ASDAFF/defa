<?$arResult = CPriority::getChilds($arResult);
global $arRegion, $arTheme;
if($arResult)
{
	foreach($arResult as $key=>$arItem)
	{
		$bSectionChildRegion = false;
		$arPath = explode('/', $arItem['LINK']);
		$arPath[0] = ($arPath[0] ? $arPath[0] : $arPath[1]);
		$arMenuParametrs = CPriority::GetDirMenuParametrs($_SERVER['DOCUMENT_ROOT'].'/'.str_replace('/', '', $arPath[0]));
		
		if(isset($arItem['PARAMS']) && $arRegion && $arTheme['USE_REGIONALITY']['VALUE'] === 'Y' && $arTheme['USE_REGIONALITY']['DEPENDENT_PARAMS']['REGIONALITY_FILTER_ITEM']['VALUE'] === 'Y' && ($arTheme['SHOW_SECTIONS_REGION']['VALUE'] == 'Y' || $arMenuParametrs['MENU_SHOW_SECTIONS'] != 'Y'))
		{
			// filter items by region
			if(isset($arItem['PARAMS']['LINK_REGION']) && !isset($arItem['CHILD'])){
				if(isset($arItem['PARAMS']['LINK_REGION']) )
				{
					if($arItem['PARAMS']['LINK_REGION'])
					{
						if(!in_array($arRegion['ID'], $arItem['PARAMS']['LINK_REGION']))
							unset($arResult[$key]);
					}
					else
						unset($arResult[$key]);
				}
			}	
			elseif($arItem['CHILD']){
				foreach($arItem['CHILD'] as $key2 => $arSubChild){
					if(isset($arSubChild['PARAMS']['LINK_REGION']))
					{
						if($arSubChild['PARAMS']['LINK_REGION'])
						{							
							if(!in_array($arRegion['ID'], (array)$arSubChild['PARAMS']['LINK_REGION'])){
								unset($arResult[$key]['CHILD'][$key2]);
							}
							else{
								$bSectionChildRegion = true;
							}
						}
						else{						
							unset($arResult[$key]['CHILD'][$key2]);							
						}								
					}
				
					if(isset($arSubChild['CHILD']) && $arSubChild['CHILD']){
						foreach($arSubChild['CHILD'] as $key3 => $arSubSubItem){
							if(isset($arSubSubItem['PARAMS']['LINK_REGION']))
							{								
								if($arSubSubItem['PARAMS']['LINK_REGION'])
								{
									if(!in_array($arRegion['ID'], (array)$arSubSubItem['PARAMS']['LINK_REGION'])){
										unset($arResult[$key]['CHILD'][$key2]['CHILD'][$key3]);
									}
									else{
										$bSectionChildRegion = true;
									}
								}
								else{
									unset($arResult[$key]['CHILD'][$key2]['CHILD'][$key3]);
								}
							}
						}

						/*if(!$arResult[$key]['CHILD'][$key2]['CHILD']){
							unset($arSubChild);
							//unset($arResult[$key]['CHILD'][$key2]);
						}*/
					}					
				}
								
				if($arMenuParametrs['MENU_SHOW_ELEMENTS'] != 'Y' && $arItem['CHILD']){
					foreach($arItem['CHILD'] as $key3 => $arSubChild){
						if(!$arSubChild['CHILD'] && isset($arSubChild['PARAMS']['LINK_REGION'])){
							unset($arResult[$key]['CHILD'][$key3]);
						}
						elseif($arSubChild['CHILD']){
							foreach($arSubChild['CHILD'] as $key4 => $arSubSubChild){
								if(isset($arSubSubChild['PARAMS']['LINK_REGION'])){
									unset($arResult[$key]['CHILD'][$key2]['CHILD'][$key3]['CHILD'][$key4]);
								}
							}
						}
					}
				}
				
				if(!$bSectionChildRegion && $arTheme['SHOW_SECTIONS_REGION']['VALUE'] == 'Y'){
					unset($arResult[$key]);
				}
				
			}
			elseif(!isset($arItem['CHILD']) && isset($arItem['PARAMS']) && $arItem['PARAMS']['FROM_IBLOCK'] && !isset($arItem['PARAMS']['LINK_REGION'])){
				unset($arResult[$key]);
			}
		}

		if($arResult[$key]["CHILD"])
			$arResult[$key]["CHILD"]=CPriority::unique_multidim_array($arResult[$key]["CHILD"], "TEXT");
	}
	
}?>