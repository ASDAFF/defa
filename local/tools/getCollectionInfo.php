<?define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if(!CModule::IncludeModule("sale") || !CModule::IncludeModule("catalog") || !CModule::IncludeModule("iblock")){
	echo "failure";
	return;
}

\Bitrix\Main\Loader::IncludeModule('aspro.next');
if ($menuSeriesId)
    $_REQUEST['id'] = $menuSeriesId;
if($_REQUEST['id']) {
    $IBLOCK_ID = 17;
    $IBLOCK_TYPE_ID = 'aspro_next_catalog';
	$colorsAddProps = array('PROPERTY_TEXTURE_KARKASA', 'PROPERTY_TEKSTURA_DVEREJ');
    $iterator = CIblockSection::GetList([],['IBLOCK_ID'=>$IBLOCK_ID,'=ID'=>$_REQUEST['id']],false,['ID','NAME','PICTURE','DESCRIPTION','SECTION_PAGE_URL',"UF_MAIN_PHOTO","UF_MORE_PHOTO","UF_TIZERS", "UF_PREVIEW", "UF_SERIES_GALLERY", "UF_SERIES_BTN_NAME", "UF_SERIES_BTN_FORM"]);
    if($section = $iterator->GetNext()) {
		
		$skyPropId=CCatalogSKU::GetInfoByProductIBlock($IBLOCK_ID);
		$offers_iblock = $skyPropId['IBLOCK_ID'];
        $skyPropId=$skyPropId['SKU_PROPERTY_ID'];
		$res=CIBlockElement::GetList(array(), array('IBLOCK_ID'=>$IBLOCK_ID, 'ACTIVE'=>'Y', 'SECTION_ID'=>$section['ID']), false, false, array('ID', 'IBLOCK_ID'));
		$productsIds=[];
		while($el=$res->fetch()){
            $productsIds[]=$el['ID'];
        }
		if(!empty($productsIds)){
			$res=CIBlockElement::GetList(array(), array('IBLOCK_ID'=>$offers_iblock, 'ACTIVE'=>'Y', 'PROPERTY_'.$skyPropId=>$productsIds, '!PROPERTY_COLOR_REF_VALUE'=>false), false,
                    false, array_merge(['ID', 'IBLOCK_ID', 'PROPERTY_COLOR_REF','PROPERTY_'.$skyPropId],$colorsAddProps)
                );
			$arColor = array();
			$arColorAdd = array();
			while($el=$res->fetch()){
				$arColor[] = $el["PROPERTY_COLOR_REF_VALUE"];
				$arColorItem[$el["ID"]] = $el["PROPERTY_COLOR_REF_VALUE"];
				foreach($colorsAddProps as $props){
					if ($el[$props."_VALUE"]){
						$arColorAdd[] = $el[$props."_VALUE"];
						$arColorAddItem[$el["ID"]] = $el[$props."_VALUE"];
					}
				}
				
			}
			$arColor = array_unique($arColor);
			$arColorAdd = array_unique($arColorAdd);
			$arColorAll = array_unique(array_merge($arColor, $arColorAdd));

			$hl=Bitrix\Highloadblock\HighloadBlockTable::getById(COLOR_HL_ID)->fetch();
			$entity=Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hl);
			$entityClass=$entity->getDataClass();
			$res = $entityClass::getList(array('select' => array('ID','UF_NAME','UF_XML_ID','UF_FILE'), 'filter' => array('UF_XML_ID' => $arColorAll)));
			

			while($el=$res->fetch()){
				$el["FILE_SRC"] = CFile::GetPath($el["UF_FILE"]);
				
				if (in_array($el["UF_XML_ID"], $arColor))
					$tree[$el["UF_XML_ID"]] = $el;
				if (in_array($el["UF_XML_ID"], $arColorAdd))
					$treeAdd[$el["UF_XML_ID"]] = $el;
			}
			$arResult = array("COLORS" => $tree, "COLORS_ADD" => $treeAdd);
						
			foreach($arColorItem as $id=>$item){
				if ($arResult["COLORS"][$item])
					$arResult["COLORS"][$item]["COUNT"] = $arResult["COLORS"][$item]["COUNT"] + 1;
			}
			foreach($arColorAddItem as $id=>$item){
				if ($arResult["COLORS_ADD"][$item])
					$arResult["COLORS_ADD"][$item]["COUNT"] = $arResult["COLORS_ADD"][$item]["COUNT"] + 1;
			}
			usort($arResult["COLORS"],function($a,$b){return($a['COUNT']<$b['COUNT']);});
			usort($arResult["COLORS_ADD"],function($a,$b){return($a['COUNT']<$b['COUNT']);});
			
			// ---------------------------------------GALLERY --------------------------------------
			$res=CIBlockElement::GetList(array(), array('IBLOCK_ID'=>SERIES_GALLERIES_IB_ID,'ACTIVE'=>'Y','ID'=>$section["UF_SERIES_GALLERY"]), false, false, array('IBLOCK_ID','ID','PROPERTY_PICTURES'));
			while($el=$res->fetch()){
				$seriesGalleries[]=CFile::ResizeImageGet($el['PROPERTY_PICTURES_VALUE'], ['width'=>750,'height'=>350],BX_RESIZE_IMAGE_PROPORTIONAL)["src"];
			}
			if(!empty($seriesGalleries)){
				$arResult['SERIES_GALLERIES']=$seriesGalleries;
			}
		
		}
		
		
        if($section['UF_MAIN_PHOTO'])
            $section['PICTURE'] = CFile::ResizeImageGet($section['UF_MAIN_PHOTO'],['width'=>750,'height'=>350],BX_RESIZE_IMAGE_EXACT);
        else
            $section['PICTURE'] = CFile::ResizeImageGet($section['PICTURE'],['width'=>750,'height'=>350],BX_RESIZE_IMAGE_EXACT);

        if($section['UF_MORE_PHOTO']) {
            foreach($section['UF_MORE_PHOTO'] as $photo) {
                $photos[] = CFile::GetPath($photo);
            }
        }
        $arParams["SECTION_TIZER"] = $section['UF_TIZERS'];
        /*get tizers section*/
        if(is_array($arParams["SECTION_TIZER"]) && $arParams["SECTION_TIZER"]){
            $arTizersData = array();
            $tizerCacheID = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'IDS'=>$arParams["SECTION_TIZER"]);
            $obCache = new CPHPCache();
            if ($obCache->InitCache(3600000, serialize($tizerCacheID), "/hlblock/tizers")){
                $arTizersData = $obCache->GetVars();
            }elseif ($obCache->StartDataCache()){
                $arItems=array();
                $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('=TABLE_NAME'=>'next_tizers_reference')));
                if ($arData = $rsData->fetch()){
                    $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);
                    $entityDataClass = $entity->getDataClass();
                    $fieldsList = $entityDataClass::getMap();
                    if (count($fieldsList) === 1 && isset($fieldsList['ID']))
                        $fieldsList = $entityDataClass::getEntity()->getFields();

                    $directoryOrder = array();
                    if (isset($fieldsList['UF_SORT']))
                        $directoryOrder['UF_SORT'] = 'ASC';
                    $directoryOrder['ID'] = 'ASC';

                    $arFilter = array(
                        'order' => $directoryOrder,
                        'limit' => 4,
                        'filter' => array(
                            '=ID' => $arParams["SECTION_TIZER"]
                        )
                    );

                    $rsPropEnums = $entityDataClass::getList($arFilter);
                    while ($arEnum = $rsPropEnums->fetch()){
                        if($arEnum["UF_FILE"]){
                            $arEnum['PREVIEW_PICTURE'] = CFile::ResizeImageGet(
                                $arEnum['UF_FILE'],
                                array("width" => 50, "height" => 50),
                                BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
                                true
                            );

                        }
                        $arItems[]=$arEnum;
                    }
                }
                $arTizersData=$arItems;
                $obCache->EndDataCache($arTizersData);
            }
        }
        ?>
        <div class="row">
            <div class="col-sm-6">

                <div class="main-image">
                    <?foreach($arResult["SERIES_GALLERIES"] as $photo){?>
                        <div class="">
                            <a href="<?=$photo?>" class=""><img src="<?=$photo?>"/></a>
                        </div>
                    <?}?>
                    <!--<img src="<?/*=$section['PICTURE']['src']*/?>"/>-->
                </div>
                <?if($arResult["SERIES_GALLERIES"]){?>
                    <div class="photos">
                       <?foreach($arResult["SERIES_GALLERIES"] as $photo){?>
                            <div class="photos-item">
                                <img src="<?=$photo?>"/>
                            </div>
					   <?}?>
                    </div>
                <?}?>
            </div>
            <div class="col-sm-6">
                <!--<div class="top-descr">
                    <h3>Цена за комплект от 19980₽</h3>
                    <a href="javascript:;">Спецификация</a>
                    <div class="specification-content">

                    </div>
                </div>-->



                <div class="descr-text">
                    <?=$section['UF_PREVIEW']?>
                </div>
                <?if($arTizersData){?>
                    <div class="tizers_block_detail tizers_block">
                        <div class="row">
                            <?$count_t_items=count($arTizersData);?>
                            <?foreach($arTizersData as $arItem){?>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <div class="inner_wrapper item">
                                        <?if($arItem["UF_FILE"]){?>
                                            <div class="img">
                                                <?if($arItem["UF_LINK"]){?>
                                                <a href="<?=$arItem["UF_LINK"];?>" <?=(strpos($arItem["UF_LINK"], "http") !== false ? "target='_blank' rel='nofollow'" : '')?>>
                                                    <?}?>
                                                    <img src="<?=$arItem["PREVIEW_PICTURE"]["src"];?>" alt="<?=$arItem["UF_NAME"];?>" title="<?=$arItem["UF_NAME"];?>">
                                                    <?if($arItem["UF_LINK"]){?>
                                                </a>
                                            <?}?>
                                            </div>
                                        <?}?>
                                        <div class="title">
                                            <?if($arItem["UF_LINK"]){?>
                                            <a href="<?=$arItem["UF_LINK"];?>" <?=(strpos($arItem["UF_LINK"], "http") !== false ? "target='_blank' rel='nofollow'" : '')?>>
                                                <?}?>
                                                <?=$arItem["UF_NAME"];?>
                                                <?if($arItem["UF_LINK"]){?>
                                            </a>
                                        <?}?>
                                        </div>
                                    </div>
                                </div>
                            <?}?>
                        </div>
                    </div>
                <?}?>

                    <div class="colors">
                        <div class="col-sm-6 series-item-color-solutions">
                            <h3>Цветовые решения</h3>
                            <div class="series-item-color-content">
								<?foreach($arResult['COLORS'] as $color){?>
									<div class="series-item-color-wrapper">
										<div class="series-item-color-pic" data-title="<?=$color['UF_NAME']?>" style="background: url(<?=$color['FILE_SRC']?>)">
											<a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="<?=$color['UF_XML_ID']?>"></a>
										</div>
									</div>
								<?}?>
                            </div>
                        </div>


                        <div class="col-sm-6 series-item-color-solutions">
                            <h3>Дополнительные цвета</h3>
                            <div class="series-item-color-content">
                                <?foreach($arResult['COLORS_ADD'] as $color){?>
									<div class="series-item-color-wrapper">
										<div class="series-item-color-pic" data-title="<?=$color['UF_NAME']?>" style="background: url(<?=$color['FILE_SRC']?>)">
											<a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="<?=$color['UF_XML_ID']?>"></a>
										</div>
									</div>
                                <?}?>
                            </div>
                        </div>


                        <a href="javascript:;" class="all-colors more-color">Все цвета</a>

                        <div class="series-item-color series-item-color__modal">
                            <div class="row colors">

                                    <div class="col-sm-12 series-item-color-solutions">
                                        <h3>Цветовые решения</h3>
                                        <div class="series-item-color-content">
                                            <?foreach($arResult['COLORS'] as $color){?>
                                                <div class="series-item-color-wrapper">
                                                    <div class="series-item-color-pic" data-title="<?=$color['UF_NAME']?>" style="background: url(<?=$color['FILE_SRC']?>)">
                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="<?=$color['UF_XML_ID']?>"></a>
                                                    </div>
                                                </div>
                                            <?}?>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 series-item-color-solutions">
                                        <h3>Дополнительные цвета</h3>
                                        <div class="series-item-color-content">
                                            <?foreach($arResult['COLORS_ADD'] as $color){?>
                                                <div class="series-item-color-wrapper">
                                                    <div class="series-item-color-pic" data-title="<?=$color['UF_NAME']?>" style="background: url(<?=$color['FILE_SRC']?>)">
                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="<?=$color['UF_XML_ID']?>"></a>
                                                    </div>
                                                </div>
                                            <?}?>
                                        </div>
                                    </div>

                            </div>
                            <div class="another-color">
                                <p>Нужна серия в другом цвете?</p>
                                <a class="btn"><span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_11" data-name="SIMPLE_FORM_11" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Оставить заявку</span></a>
                            </div>
                        </div>
                    </div>


<?$rsForm = CForm::GetByID($section['UF_SERIES_BTN_FORM'])->Fetch();?>
                    <div class="buttons">
                        <div class="col-sm-6">
                            <span class="btn" data-event="jqm" data-param-form_id="<?=$rsForm["SID"]?>" data-name="<?=$rsForm["SID"]?>" data-autoload-product_name="<?=$section["NAME"];?>" data-autoload-product_id="<?=$section["ID"];?>">
                                <?=$section['UF_SERIES_BTN_NAME']?>
							</span>
                        </div>
                        <div class="col-sm-6">
                            <a href="<?=$section["SECTION_PAGE_URL"]?>">Подробнее о серии</a>
                        </div>
                    </div>

            </div>
        </div>

        <?
    }
    else $errors[] = "Раздел не найден";
}
else $errors[] = "Не задан id";

if($errors) print_r($errors);
?>


<script>
    /*ОТКРЫТИЕ СПЕЦИФИКАЦИЙ В МЕНЮ*/

    $('.sectionContainer .ajax-element .top-descr>a').click(function () {
        $('.sectionContainer .ajax-element .top-descr .specification-content').fadeToggle(300);
        $('.sectionContainer .ajax-element .top-descr').toggleClass('visible');
    });


    $('.ajax-element .main-image').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        asNavFor: '.ajax-element .photos'
    });
    $('.ajax-element .photos').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.ajax-element .main-image',
        dots: false,
        arrows:false,
        focusOnSelect: true
    });

    /*$(document).ready(function () {
        $('.ajax-element .photos').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            centerMode: false,
            infinite: false
        });
    });*/

    /*открытие цветов серий в меню*/
    $('.ajax-element .more-color').on('click', function(evt) {
        evt.preventDefault();

        var t = $('.ajax-element').find('.series-item-color__modal');

        var q = $(t).hasClass('show');

        if (q === false) {
            t.addClass('show');
        }

    });

    $(document).mouseup(function(e) {
        var w = $('.ajax-element').find('.series-item-color__modal');
        if (!w.is(e.target) &&
            w.has(e.target).length === 0) {
            w.removeClass('show');
        }
    });
</script>
