<?
if(empty($arParams['SERIES_LIST_POPULAR_KITS_SORT']))
{
    $arParams['SERIES_LIST_POPULAR_KITS_SORT']='sort';
}
else
{
    if(!in_array($arParams['SERIES_LIST_POPULAR_KITS_SORT'],['sort','avail']))
    {
        $arParams['SERIES_LIST_POPULAR_KITS_SORT']='sort';
    }
}
if(!empty($arResult['SECTION']['UF_SERIES']))
{
    //METKI
    $hl = Bitrix\Highloadblock\HighloadBlockTable::getById(15)->fetch();
    $entity=Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hl);
    $entityClass=$entity->getDataClass();
    $res=$entityClass::getList([
        'select'=>['*'],
    ]);
    $tizers=[];
    while($el=$res->fetch())
    {
        $tizers[$el['ID']]=
            [
                'ID'=>$el['ID'],
                'NAME'=>$el['UF_DESC'],
                'SRC'=>CFile::GetPath($el['UF_PICTURE']),
            ];
    }
    if(!empty($tizers))
    {
        $arResult['METKI'] = $tizers;
    }
    //TIZERS
    $hl=Bitrix\Highloadblock\HighloadBlockTable::getById(TIZER_HL_ID)->fetch();
    $entity=Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hl);
    $entityClass=$entity->getDataClass();
    $res=$entityClass::getList([
        'select'=>['*'],
        'order'=>['UF_SORT'],
    ]);
    $tizers=[];
    while($el=$res->fetch())
    {
        $tizers[$el['ID']]=
        [
            'ID'=>$el['ID'],
            'NAME'=>$el['UF_NAME'],
            'SRC'=>CFile::GetPath($el['UF_FILE']),
        ];
    }
    if(!empty($tizers))
    {
        $arResult['TIZERS']=$tizers;
    }
    //SERIES GALLERIES
    $seriesGalleriesIdsFilter=[];
    foreach($arResult['SECTIONS'] as $arItem)
    {
        if(!empty($arItem['UF_SERIES_GALLERY']))
        {
            $seriesGalleriesIdsFilter[]=$arItem['UF_SERIES_GALLERY'];
        }
    }
    if(!empty($seriesGalleriesIdsFilter))
    {
        $seriesGalleriesIdsFilter=array_unique($seriesGalleriesIdsFilter);
        $res=CIBlockElement::GetList
        (
            [],
            ['IBLOCK_ID'=>SERIES_GALLERIES_IB_ID,'ACTIVE'=>'Y','ID'=>$seriesGalleriesIdsFilter],
            false,
            false,
            ['IBLOCK_ID','ID','PROPERTY_PICTURES']
        );
        $seriesGalleries=[];
        while($el=$res->fetch())
        {


            $seriesGalleries[$el['ID']][]=$el['PROPERTY_PICTURES_VALUE'];
        }
        if(!empty($seriesGalleries))
        {
            $arResult['SERIES_GALLERIES']=$seriesGalleries;
        }
    }
    $sectionsIds=[];
    foreach($arResult['SECTIONS'] as $arItem)
    {
        $sectionsIds[]=$arItem['ID'];
    }
    if(!empty($sectionsIds))
    {
        $skyPropId=CCatalogSKU::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
        $skyPropId=$skyPropId['SKU_PROPERTY_ID'];
        //COLORS
        $hl=Bitrix\Highloadblock\HighloadBlockTable::getById(COLOR_HL_ID)->fetch();
        $entity=Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hl);
        $entityClass=$entity->getDataClass();
        $res=$entityClass::getList(['select'=>['ID','UF_NAME','UF_XML_ID','UF_FILE']]);
        $colors=[];
        while($el=$res->fetch())
        {
            $colors[$el['UF_XML_ID']]=$el;
        }
        $res=CIBlockElement::GetList
        (
            [],
            ['IBLOCK_ID'=>$arParams['IBLOCK_ID'],'ACTIVE'=>'Y','SECTION_ID'=>$sectionsIds],
            false,
            false,
            ['ID']
        );
        $productsIds=[];
        while($el=$res->fetch())
        {
            $productsIds[]=$el['ID'];
        }
        if(!empty($productsIds))
        {
            $res=CIBlockElement::GetElementGroups($productsIds,false,['ID','IBLOCK_ELEMENT_ID']);
            $tree=[];
            while($el=$res->fetch())
            {
                if(in_array($el['ID'],$sectionsIds))
                {
                    $tree[$el['ID']]['PRODUCTS'][]=$el['IBLOCK_ELEMENT_ID'];
                    $tree[$el['ID']]['COLORS']=[];
                }
            }
            if(!empty($tree))
            {
                $colorsAddProps=[];
                foreach($arParams['SERIES_LIST_COLORS_ADD_PROPS'] as $prop)
                {
                    if(!empty($prop))
                    {
                        $colorsAddProps[]='PROPERTY_'.$prop;
                    }
                }

                $res=CIBlockElement::GetList
                (
                    [],
                    ['IBLOCK_ID'=>OFFERS_IB_ID,'ACTIVE'=>'Y','PROPERTY_'.$skyPropId=>$productsIds,'!PROPERTY_COLOR_REF_VALUE'=>false],
                    false,
                    false,
                    array_merge(['ID','PROPERTY_COLOR_REF','PROPERTY_'.$skyPropId],$colorsAddProps)
                );
				
                while($el=$res->fetch())
                {
                    foreach($tree as $key=>$sect)
                    {
                        if(in_array($el['PROPERTY_'.$skyPropId.'_VALUE'],$sect['PRODUCTS']))
                        {
                            if(!empty($colors[$el['PROPERTY_COLOR_REF_VALUE']]))
                            {
                                $tree[$key]['COLORS'][$colors[$el['PROPERTY_COLOR_REF_VALUE']]['UF_XML_ID']] = $colors[$el['PROPERTY_COLOR_REF_VALUE']];
								
                            }
                            foreach($colorsAddProps as $prop)
                            {
                                if(!empty($colors[$el[$prop.'_VALUE']]))
                                {
                                    $tree[$key]['COLORS_ADD'][$colors[$el[$prop.'_VALUE']]['UF_XML_ID']]=$colors[$el[$prop.'_VALUE']];
                                }
                            }
                        }
                    }
                }
				
                $colorsImages=[];
                foreach($tree as $key=>$sect)
                {
                    unset($tree[$key]['PRODUCTS']);
                    foreach($sect['COLORS'] as $color)
                    {
                        $colorsImages[$color['UF_XML_ID']]=$color['UF_FILE'];
                    }
                    foreach($sect['COLORS_ADD'] as $colorAdd)
                    {
                        $colorsImages[$colorAdd['UF_XML_ID']]=$colorAdd['UF_FILE'];
                    }
                }
                foreach($colorsImages as $key=>$colorsImage)
                {
                    $colorsImages[$key]=CFile::GetPath($colorsImage);
                }
                foreach($tree as &$sect)
                {
                    foreach($sect['COLORS'] as &$color)
                    {
                        $color['FILE_SRC']=$colorsImages[$color['UF_XML_ID']];
                    }
					unset($color);
                    foreach($sect['COLORS_ADD'] as &$colorAdd)
                    {
                        $colorAdd['FILE_SRC']=$colorsImages[$colorAdd['UF_XML_ID']];
                    }
					unset($colorAdd);
                }
				unset($sect);
				
                $arResult['COLORS']=$tree;
            }
        }

        // ----------------------------------------------- POPULAR KITS ----------------------------------------------------
        $res=CIBlockElement::GetList
        (
            [],
            ['IBLOCK_ID'=>$arParams['IBLOCK_ID'],'ACTIVE'=>'Y','SECTION_ID'=>$sectionsIds,'!PROPERTY_IS_SET_VALUE'=>false],
            false,
            false,
            ['ID','SORT']
        );
        $productsIds=[];
        while($el=$res->fetch())
        {
            $productsIds[]=$el['ID'];
            $productsIdsSort[$el['ID']]=$el['SORT'];
        }
        if(!empty($productsIds))
        {
            $res=CIBlockElement::GetElementGroups($productsIds,false,['ID','IBLOCK_ELEMENT_ID']);
            $groups=[];
            while($el=$res->fetch())
            {
                $groups[]=$el;
            }
            foreach($groups as $key=>$el)
            {
                $groups[$key]['IBLOCK_ELEMENT_SORT']=$productsIdsSort[$el['IBLOCK_ELEMENT_ID']];
            }
            usort($groups,function($a,$b){return($a['IBLOCK_ELEMENT_SORT']-$b['IBLOCK_ELEMENT_SORT']);});
			
            $tree=[];
            foreach($groups as $el)
            {
                if(in_array($el['ID'],$sectionsIds))
                {
                    $tree[$el['ID']]['PRODUCTS_IDS'][]=$el['IBLOCK_ELEMENT_ID'];
                    $tree[$el['ID']]['PRODUCTS'][$el['IBLOCK_ELEMENT_ID']]=
                    [
                        'PRODUCT'=>
                        [
                            'ID'=>$el['IBLOCK_ELEMENT_ID'],
                            'SORT'=>$productsIdsSort[$el['IBLOCK_ELEMENT_ID']],
                        ],
                        'OFFERS'=>[],
                    ];
					
                }
            }
			
            if(!empty($tree))
            {
                $res=CIBlockElement::GetList
                (
                    ['SORT'=>'ASC'],
                    ['IBLOCK_ID'=>OFFERS_IB_ID,'ACTIVE'=>'Y','PROPERTY_'.$skyPropId=>$productsIds],
                    false,
                    false,
                    array_merge(['ID','DETAIL_PAGE_URL','PROPERTY_MORE_PHOTO','PROPERTY_COLOR_REF','PROPERTY_'.$skyPropId], $colorsAddProps)//PROPERTY_COLOR_REF
                );
                while($el=$res->GetNext())
                {
                    $img='';
                    if(!empty($el['PROPERTY_MORE_PHOTO_VALUE']))
                    {
                        if(!is_array($el['PROPERTY_MORE_PHOTO_VALUE']))
                        {
                            $img=$el['PROPERTY_MORE_PHOTO_VALUE'];
                        }
                        else
                        {
                            foreach($el['PROPERTY_MORE_PHOTO_VALUE'] as $tmp)
                            {
                                $img=$tmp;
                                break;
                            }
                        }
                    }
                    $file=CFile::ResizeImageGet($img,['width'=>100,'height'=>75],BX_RESIZE_IMAGE_PROPORTIONAL);
                    //$price=[];
                    $price=CCatalogProduct::GetOptimalPrice($el['ID']);
                    $offer=
                    [
                        'ID'=>$el['ID'],
                        'URL'=>$el['DETAIL_PAGE_URL'],
                        'IMAGE'=>$file['src'],
                        'PRICE'=>$price['DISCOUNT_PRICE'],
                        'COLOR_REF_VALUE'=>$el['PROPERTY_COLOR_REF_VALUE'],
						
                    ];
						if ($el["PROPERTY_TEXTURE_KARKASA_VALUE"])
							$offer["TEXTURE_KARKASA_VALUE"] = $el["PROPERTY_TEXTURE_KARKASA_VALUE"];
						if ($el["PROPERTY_TEKSTURA_DVEREJ_VALUE"])
							$offer["TEKSTURA_DVEREJ_VALUE"] = $el["PROPERTY_TEKSTURA_DVEREJ_VALUE"];
                    foreach($tree as $key=>$sect)
                    {
                        if(in_array($el['PROPERTY_'.$skyPropId.'_VALUE'],$sect['PRODUCTS_IDS']))
                        {
                            $tree[$key]['PRODUCTS'][$el['PROPERTY_'.$skyPropId.'_VALUE']]['OFFERS'][$el['ID']]=$offer;
                        }
                    }
					
                    foreach($tree as &$sect)
                    {
                        foreach($sect['PRODUCTS'] as &$prod)
                        {
                            $min='';
                            foreach($prod['OFFERS'] as $offer)
                            {
                                if(empty($min) || $offer['PRICE']<$min)
                                {
                                    $min=$offer['PRICE'];
                                }
                            }
                            $cnt=count($prod['OFFERS']);
                            $prod['OFFERS_COUNT']=$cnt;
                            $prod['OFFERS_MIN_PRICE']=$min;
                            if($cnt===0)
                            {
                                unset($prod);
                            }
                        }
						unset($prod);
                    }
					unset($sect);
					
                    foreach($tree as &$sect)
                    {
                        if(count($sect['PRODUCTS'])===0)
                        {
                            unset($sect);
                        }
                    }
					unset($sect);
                }
                $arResult['POPULAR_KITS']=$tree;
            }
        }
		
		/*foreach($arResult['POPULAR_KITS'] as $key=>$item){
			foreach($item["PRODUCTS"] as $key2=>$item2){
				foreach($item2["OFFERS"] as $key3=>$item3){
					$countColor[$key][$item3["COLOR_REF_VALUE"]] = $countColor[$key][$item3["COLOR_REF_VALUE"]] + 1;
					
				}
					
			}
			
		}
		
		foreach($arResult["COLORS"] as $key=>$item){
			foreach($item["COLORS"] as $key2=>$item2){
				if (!$countColor[$key][$key2])
						$countColor[$key][$key2] = 0;
				$arResult["COLORS"][$key]["COLORS"][$key2]["COUNT"] = $countColor[$key][$key2];
			}
			$arColor = $arResult["COLORS"][$key];
			usort($arColor["COLORS"],function($a,$b){return($a['COUNT']<$b['COUNT']);});
			$arResult["COLORS"][$key] = $arColor;
			unset($arColor);
		}

		*/
				
        // ------------------------------------------------- POPULAR PRODUCTS -------------------------------------------------------------------
        $res=CIBlockElement::GetList
        (
            [],
            ['IBLOCK_ID'=>$arParams['IBLOCK_ID'],'ACTIVE'=>'Y','SECTION_ID'=>$sectionsIds,'!PROPERTY_TYPE_PRODUCT_VALUE'=>false],
            false,
            false,
            ['ID','SORT']
        );
        $productsIds=[];
        while($el=$res->fetch()){
            $productsIds[]=$el['ID'];
            $productsIdsSort[$el['ID']]=$el['SORT'];
        }
		if(!empty($productsIds)){
			$res=CIBlockElement::GetElementGroups($productsIds,false,['ID','IBLOCK_ELEMENT_ID']);
            $groups=[];
            while($el=$res->fetch()){
				$groups[]=$el;
			}
			foreach($groups as $key=>$el){
                $groups[$key]['IBLOCK_ELEMENT_SORT']=$productsIdsSort[$el['IBLOCK_ELEMENT_ID']];
            }
			usort($groups,function($a,$b){return($a['IBLOCK_ELEMENT_SORT']-$b['IBLOCK_ELEMENT_SORT']);});
			$tree=[];
			
			foreach($groups as $el){
				if(in_array($el['ID'],$sectionsIds)){
					$tree[$el['ID']]['PRODUCTS_IDS'][]=$el['IBLOCK_ELEMENT_ID'];
                    $tree[$el['ID']]['PRODUCTS'][$el['IBLOCK_ELEMENT_ID']]=
                        [
                            'PRODUCT'=>
                                [
                                    'ID'=>$el['IBLOCK_ELEMENT_ID'],
                                    'SORT'=>$productsIdsSort[$el['IBLOCK_ELEMENT_ID']],
                                ],
                            'OFFERS'=>[],
                        ];
				}
			}
			if(!empty($tree)){
				$res=CIBlockElement::GetList
                (
                    ['SORT'=>'ASC'],
                    ['IBLOCK_ID'=>OFFERS_IB_ID,'ACTIVE'=>'Y','PROPERTY_'.$skyPropId=>$productsIds],
                    false,
                    false,
                    array_merge(['ID','DETAIL_PAGE_URL','PROPERTY_MORE_PHOTO','PROPERTY_COLOR_REF','PROPERTY_'.$skyPropId], $colorsAddProps)//PROPERTY_COLOR_REF
                );
				while($el=$res->GetNext()){
					$img='';
					if(!empty($el['PROPERTY_MORE_PHOTO_VALUE'])){
                        if(!is_array($el['PROPERTY_MORE_PHOTO_VALUE'])){
                            $img=$el['PROPERTY_MORE_PHOTO_VALUE'];
                        }else{
                            foreach($el['PROPERTY_MORE_PHOTO_VALUE'] as $tmp){
                                $img=$tmp;
                                break;
                            }
                        }
                    }

				$file=CFile::ResizeImageGet($img,['width'=>100,'height'=>75],BX_RESIZE_IMAGE_PROPORTIONAL);
				$price=CCatalogProduct::GetOptimalPrice($el['ID']);
				$offer=
                        [
                            'ID'=>$el['ID'],
                            'URL'=>$el['DETAIL_PAGE_URL'],
                            'IMAGE'=>$file['src'],
                            'PRICE'=>$price['DISCOUNT_PRICE'],
                            'COLOR_REF_VALUE'=>$el['PROPERTY_COLOR_REF_VALUE'],
                        ];
						//if ($el["PROPERTY_TEXTURE_KARKASA_VALUE"])
							$offer["TEXTURE_KARKASA_VALUE"] = $el["PROPERTY_TEXTURE_KARKASA_VALUE"];
						//if ($el["PROPERTY_TEKSTURA_DVEREJ_VALUE"])
							$offer["TEKSTURA_DVEREJ_VALUE"] = $el["PROPERTY_TEKSTURA_DVEREJ_VALUE"];
						
				foreach($tree as $key=>$sect){
					if(in_array($el['PROPERTY_'.$skyPropId.'_VALUE'],$sect['PRODUCTS_IDS'])){
						$tree[$key]['PRODUCTS'][$el['PROPERTY_'.$skyPropId.'_VALUE']]['OFFERS'][$el['ID']]=$offer;
					}
				}
				foreach($tree as &$sect){
                    foreach($sect['PRODUCTS'] as &$prod){
                        $min='';
                        foreach($prod['OFFERS'] as $offer){
                            if(empty($min) || $offer['PRICE']<$min){
                                $min=$offer['PRICE'];
                            }
                        }
                        $cnt=count($prod['OFFERS']);
                        $prod['OFFERS_COUNT']=$cnt;
                        $prod['OFFERS_MIN_PRICE']=$min;
                        if($cnt===0){
                            unset($prod);
                        }
                    }
                        unset($prod);
                }
                unset($sect);
				
				foreach($tree as &$sect){
					if(count($sect['PRODUCTS'])===0){
						unset($sect);
					}
				}
                unset($sect);
				}
			$arResult['POPULAR_PRODUCTS']=$tree;
			}
		}
		
		foreach($arResult['POPULAR_PRODUCTS'] as $key=>$item){
            foreach($item["PRODUCTS"] as $key2=>$item2){
                foreach($item2["OFFERS"] as $key3=>$item3){
                    $countColor[$key][$item3["COLOR_REF_VALUE"]] = $countColor[$key][$item3["COLOR_REF_VALUE"]] + 1;
                }
            }
        }

		foreach($arResult["COLORS"] as $key=>$item){
            foreach($item["COLORS"] as $key2=>$item2){
                if (!$countColor[$key][$key2])
                    $countColor[$key][$key2] = 0;
                $arResult["COLORS"][$key]["COLORS"][$key2]["COUNT"] = $countColor[$key][$key2];
            }
            $arColor = $arResult["COLORS"][$key];
            usort($arColor["COLORS"],function($a,$b){return($a['COUNT']<$b['COUNT']);});
            $arResult["COLORS"][$key] = $arColor;
            unset($arColor);
        }
		
    }//if(!empty($sectionsIds))
}//if(!empty($arResult['SECTION']['UF_SERIES']))
