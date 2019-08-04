<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this->setFrameMode(true);?>
<?
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

global $arRegion;

$arItemFilter = CNext::GetIBlockAllElementsFilter($arParams);
$arItemSelect = array('ID', 'NAME', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'PROPERTY_MAP','PROPERTY_ADDRESS','PROPERTY_SCHEDULE','PROPERTY_EMAIL','PROPERTY_MORE_PHOTOS','PROPERTY_PHONE','PROPERTY_METRO');
$arItems = CNextCache::CIblockElement_GetList(['SORT'=>'ASC'], $arItemFilter, false, false, $arItemSelect);

$arAllSections = array();
if($arItems)
    $arAllSections = CNext::GetSections($arItems, $arParams);
?>
<?/*if($arParams['SHOW_TOP_MAP'] != 'Y'):*/?><!--
	<div class="contacts-page-top">
		<div class="contacts maxwidth-theme" itemscope itemtype="http://schema.org/Organization">
			<div class="row">
				<?/*$bHasSections = (isset($arAllSections['ALL_SECTIONS']) && $arAllSections['ALL_SECTIONS']);*/?>
				<?/*$bHasChildSections = (isset($arAllSections['CHILD_SECTIONS']) && $arAllSections['CHILD_SECTIONS']);*/?>
				<?/*if($bHasSections):*/?>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6 col-sm-4">
								<select class="<?/*=($bHasChildSections ? 'region' : 'city');*/?>">
									<option value="0" selected><?/*=Loc::getMessage('CHOISE_ITEM', array('#ITEM#' => ($bHasChildSections ? Loc::getMessage('REGION') : Loc::getMessage('CITY'))))*/?></option>
									<?/*foreach($arAllSections['ALL_SECTIONS'] as $arSection):*/?>
										<option value="<?/*=$arSection['SECTION']['ID'];*/?>"><?/*=$arSection['SECTION']['NAME'];*/?></option>
									<?/*endforeach;*/?>
								</select>
							</div>
							<?/*if($bHasChildSections):*/?>
								<div class="col-md-6 col-sm-4">
									<select class="city">
										<option value="0" selected><?/*=Loc::getMessage('CHOISE_ITEM', array('#ITEM#' => Loc::getMessage('CITY')))*/?></option>
										<?/*foreach($arAllSections['CHILD_SECTIONS'] as $arSection):*/?>
											<option style="display:none;" disabled="disabled" value="<?/*=$arSection['ID'];*/?>" data-parent_section="<?/*=$arSection['IBLOCK_SECTION_ID'];*/?>"><?/*=$arSection['NAME'];*/?></option>
										<?/*endforeach;*/?>
									</select>
								</div>
							<?/*endif;*/?>
						</div>
					</div>
				<?/*endif;*/?>
				<div class="col-md-<?/*=($bHasSections ? 6 : 12);*/?>">
					<div class="row">
						<div class="col-md-6 print-6">
							<?/*CNext::showContactPhones('', true, '', 'Phone_black2.svg', 'grey');*/?>
						</div>
						<div class="col-md-6 print-6">
							<?/*CNext::showContactEmail('E-mail', true, '', 'Email.svg', 'grey');*/?>
						</div>
					</div>

					<?/*//hidden text for validate microdata*/?>
					<div class="hidden">
						<?/*if($arRegion):*/?>
							<?/*if($arRegion["PROPERTY_ADDRESS_VALUE"]["TEXT"]):*/?>
								<span itemprop="address"><?/*=$arRegion["PROPERTY_ADDRESS_VALUE"]["TEXT"];*/?></span>
							<?/*endif;*/?>
						<?/*else:*/?>
							<span itemprop="address"><?/*$APPLICATION->IncludeFile(SITE_DIR."include/contacts-site-address.php", Array(), Array("MODE" => "html", "NAME" => "Address"));*/?></span>
						<?/*endif;*/?>
						<?/*global $arSite;*/?>
						<span itemprop="name"><?/*=$arSite["NAME"];*/?></span>
					</div>
				</div>
			</div>
		</div>
	</div>
--><?/*endif;*/?>


<?if($arParams["TITLE_BLOCK"] || $arParams["TITLE_BLOCK_ALL"]):?>
    <div class="maxwidth-theme">
        <div class="top_block">
            <a href="<?=SITE_DIR.$arParams["ALL_URL"];?>" class="title_block"><?=$arParams["TITLE_BLOCK"];?></a>
        </div>
    </div>

<?endif;?>



<div class="ajax_items">
    <?if((isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") || (strtolower($_REQUEST['ajax']) == 'y')){
        $APPLICATION->RestartBuffer();?>
    <?}?>
    <?if($arItems):?>
        <?$bPostSection = (isset($_POST['ID']) && $_POST['ID']);?>
        <?
        $bUseMap = CNext::GetFrontParametrValue('CONTACTS_USE_MAP', SITE_ID) != 'N';
        $mapLAT = $mapLON = $iCountShops =0;
        $arPlacemarks = array();
        if($bPostSection)
        {
            $arItems = CNextCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CNextCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array_merge($arItemFilter, array('SECTION_ID' => $_POST['ID'])), false, false, $arItemSelect);
            $GLOBALS[$arParams['FILTER_NAME']]['SECTION_ID'] = $_POST['ID'];
        }

        foreach($arItems as $arItem) {
            $arElements[$arItem['NAME']][] = $arItem;
        }

        foreach($arItems as $arItem)
        {
            if($arItem['PROPERTY_MAP_VALUE']){
                $arCoords = explode(',', $arItem['PROPERTY_MAP_VALUE']);
                $mapLAT += $arCoords[0];
                $mapLON += $arCoords[1];
                $str_phones = '';
                if($arItem['PHONE'])
                {
                    foreach($arShop['PHONE'] as $phone)
                    {
                        $str_phones .= '<div class="phone"><a rel="nofollow" href="tel:'.str_replace(array(' ', ',', '-', '(', ')'), '', $phone).'">'.$phone.'</a></div>';
                    }
                }
                if(is_array($arItem["PROPERTY_PHONE_VALUE"]))
                    $phone = implode(', ',$arItem["PROPERTY_PHONE_VALUE"]);
                else $phone  = $arItem["PROPERTY_PHONE_VALUE"];
                $schedule = preg_replace("/\r\n/","<br />",  $arItem["PROPERTY_SCHEDULE_VALUE"]['TEXT']);

                if(is_array($arItem["PROPERTY_METRO_VALUE"]))
                    $arItem["PROPERTY_METRO_VALUE"] = implode(',',$arItem["PROPERTY_METRO_VALUE"]);

                if($arItem["PROPERTY_METRO_VALUE"])
                    $metro  = "Метро: ".$arItem["PROPERTY_METRO_VALUE"];
                else
                    $metro = "";
                $arPlacemarks[] = array(
                    "ID" => $arItem["ID"],
                    "LAT" => $arCoords[0],
                    "LON" => $arCoords[1],
                    "CITY" => $arItem["NAME"],
                    "EMAIL" => $arItem["PROPERTY_EMAIL_VALUE"],
                    "PHONE" => $phone,
                    "SCHEDULE" => $schedule,
                    "METRO" => $metro,
                    "PHOTO" => $arItem["PROPERTY_MORE_PHOTOS_VALUE"],
                    "TEXT" => $arItem["PROPERTY_ADDRESS_VALUE"],
                    "HTML" => '<div class="title">'.(strlen($arShop["URL"]) ? '<a href="'.$arShop["URL"].'">' : '').$arShop["ADDRESS"].(strlen($arShop["URL"]) ? '</a>' : '').'</div><div class="info-content">'.($arShop['METRO'] ? $arShop['METRO_PLACEMARK_HTML'] : '').(strlen($arShop['SCHEDULE']) ? '<div class="schedule">'.$arShop['SCHEDULE'].'</div>' : '').$str_phones.(strlen($arShop['EMAIL']) ? '<div class="email"><a rel="nofollow" href="mailto:'.$arShop['EMAIL'].'">'.$arShop['EMAIL'].'</a></div>' : '').'</div>'.(strlen($arShop['URL']) ? '<a rel="nofollow" class="button" href="'.$arShop["URL"].'"><span>'.GetMessage('DETAIL').'</span></a>' : '')
                );
                ++$iCountShops;
            }
        }
        if($iCountShops && $bUseMap)
        {
            $mapLAT = floatval($mapLAT / $iCountShops);
            $mapLON = floatval($mapLON / $iCountShops);?>
            <?if($arParams['SHOW_TOP_MAP'] == 'Y'):?>
            <?$this->SetViewTarget('yandex_map');?>
        <?endif;?>

            <script src="https://api-maps.yandex.ru/2.1/?apikey=f989a31c-4e26-4964-b4f4-ff14775e44b4&lang=ru_RU" type="text/javascript">
            </script>
            <script src="<?=SITE_TEMPLATE_PATH?>/js/map.js?v=<?=time()?>"></script>
            <script>
                var placemarks = [];
                <?foreach($arPlacemarks as $placemark):?>
                placemarks[<?=$placemark['ID']?>] = {
                    'lat':<?=$placemark['LAT']?>,
                    'lon':<?=$placemark['LON']?>,
                };
                <?endforeach;?>
                ;

                var cityPlacemarks = [];
                <?foreach($arElements as $city=>$shops):?>
                <?
                $coords[$city] = [
                    'min' => [
                        'lat'=>100,
                        'lon'=>100,
                    ],
                    'max' => [
                        'lat'=>0,
                        'lon'=>0,
                    ],
                ];
                ?>
                cityPlacemarks['<?=$city?>'] = [
                    <?foreach($shops as $shop):

                    $arCoords = explode(',', $shop['PROPERTY_MAP_VALUE']);
                    if($coords[$city]['max']['lat']<$arCoords[0])
                        $coords[$city]['max']['lat'] = $arCoords[0];
                    if($coords[$city]['min']['lat']>$arCoords[0])
                        $coords[$city]['min']['lat'] = $arCoords[0];
                    if($coords[$city]['max']['lon']<$arCoords[1])
                        $coords[$city]['max']['lon'] = $arCoords[1];
                    if($coords[$city]['min']['lon']>$arCoords[1])
                        $coords[$city]['min']['lon'] = $arCoords[1];
                    ?>
                    <?endforeach;?>
                    [<?=$coords[$city]['min']['lat']?>,<?=$coords[$city]['min']['lon']?>],
                    [<?=$coords[$city]['max']['lat']?>,<?=$coords[$city]['max']['lon']?>],
                ];
                <?endforeach;?>
                var myMap;
                var zoom = 15;


                ymaps.ready(init);

                function init() {
                    // Создание карты.

                    if($(window).width()<767) {

                        myMap = new ymaps.Map("map", {
                            center: [<?=$mapLAT?>, <?=$mapLON?>],
                            zoom: 7,
                            controls: []
                        });

                        myMap.behaviors.disable('drag');
                        //myMap.behaviors.disable('multiTouch');
                    }
                    else {
                        myMap = new ymaps.Map("map", {
                            center: [<?=$mapLAT?>, <?=$mapLON?>],
                            zoom: 7
                        });

                    }

                    myMap.behaviors.disable('scrollZoom');

                    <?foreach($arPlacemarks as $placemark):?>
                    var placemark = new ymaps.Placemark([<?=$placemark['LAT']?>, <?=$placemark['LON']?>], {
                        balloonContentHeader: "<?=$placemark['CITY']?>",
                        balloonContentBody: "<?=$placemark['TEXT']?>\n" +
                            "                                            <p><?=$placemark['METRO']?></p>" +
                            "                                            <p><?=$placemark['SCHEDULE']?></p>" +
                            "                                            <p><span class=\"icon-blocks phone\"></span><?=$placemark['PHONE']?></p>" +
                            "                                            <p><span class=\"icon-blocks email\"></span><?=$placemark['EMAIL']?></p>" +
                            "                                            <p class=''><a class='dotted route' data-lat='<?=$placemark['LAT']?>' data-lon='<?=$placemark['LON']?>' href='#map'>Проложить маршрут</a></p>",
                        balloonContentFooter: "                                            <ul class=\"photos\">\n" +
                            "                                                <?foreach($placemark['PHOTO'] as $photo):?>\n" +
                            "                                                <?$src = CFile::GetPath($photo);?>\n" +
                            "                                                    <li><a href=\"<?=$src?>\" class=\"fancybox\" rel=\"shop<?=$shop['ID']?>\"><img src=\"<?=$src?>\"/></a></li>\n" +
                            "                                                <?endforeach;?>\n" +
                            "                                            </ul>\n",
                        id:"<?=$placemark['ID']?>",
                    }, {
                        preset: "islands#redDotIcon",
                        // Отключаем кнопку закрытия балуна.
                        balloonCloseButton: true,
                        // Балун будем открывать и закрывать кликом по иконке метки.
                        hideIconOnBalloonOpen: false,

                        //Иконка метки
                        iconLayout: 'default#image',
                        iconImageHref: '/images/icons/geotag.png',
                        iconImageSize: [41, 48],
                        iconImageOffset: [-11, -32]
                    });

                    placemark.events.add(['click'],  function (e) {
                        console.log('<?=$placemark["ID"]?>');
                        $('#placemark<?=$placemark["ID"]?>').click();

                        var top1 = $('.map-info').offset().top;
                        var top2 = $('#placemark<?=$placemark["ID"]?>').offset().top;
                        var top3 = top2 - top1;

                        console.log(top1);

                        if(top3>0)
                            if ($('#placemark<?=$placemark["ID"]?>').length != 0) { // проверим существование элемента чтобы избежать ошибки
                                $('.map-info').scrollTop(top3); // анимируем скроолинг к элементу scroll_el
                            }

                        return false;
                    });

                    myMap.geoObjects.add(placemark);


                    <?endforeach;?>

                    myMap.setBounds(myMap.geoObjects.getBounds());
                }

                $(document).ready(function () {


                    $(document).on('click','.print',function() {
                        window.print();

                    });
                    $(document).on('click','.route',function() {
                        var location = ymaps.geolocation.get();
                        var _this = $(this);
                        var currCoord;
                        location.then(
                            function(result) {
                                // Добавление местоположения на карту.
                                var currCoord0 = result.geoObjects.position[0];
                                var currCoord1 = result.geoObjects.position[1];
                                var lat = _this.data('lat');
                                var lon = _this.data('lon');
                                console.log(currCoord0 + ',' + currCoord1);
                                console.log(lat + ',' + lon);
                                ymaps.route([
                                    // Список точек, которые необходимо посетить
                                    [currCoord0,currCoord1], [lat,lon]], {
                                    // Опции маршрутизатора
                                    mapStateAutoApply: true // автоматически позиционировать карту
                                }).then(function (router) {
                                    myMap.geoObjects.add(router);
                                }, function (error) {
                                    alert("Возникла ошибка: " + error.message);
                                });

                            },
                            function(err) {
                                console.log('Ошибка: ' + err)
                            }
                        );


                    });

                    $(document).on('click','.all-shops',function() {

                        myMap.margin.setDefaultMargin(50);
                        myMap.setBounds(myMap.geoObjects.getBounds());
                        console.log(myMap.geoObjects.getBounds());
                        $('.level-1').removeClass('active');
                    });

                    $(document).on('click','.level-1',function(){
                        var zoom = myMap.getZoom();
                        myMap.setZoom(zoom);
                        var active = false;
                        $('.shop-list').removeClass('mobile-active');
                        if($(this).hasClass('active')) active = true;
                        $('.level-1').removeClass('active');
                        $('.level-2').removeClass('active');
                        if(active)
                            $(this).removeClass('active');
                        else
                            $(this).addClass('active');
                        var name = $(this).data('name');
                        $('.shop-list .li-level-0 .text').text(name);

                        if(cityPlacemarks[name].length>1)
                        {
                            myMap.margin.setDefaultMargin(80);
                            myMap.setBounds(cityPlacemarks[name],
                                {checkZoomRange:true,preciseZoom:true,zoomMargin:2}
                            );
                            setTimeout(function(){

                                console.log( myMap.getZoom());
                                var zoom = myMap.getZoom()-0.5;
                                myMap.setZoom(zoom);
                                console.log(zoom);
                            },100);
                        }
                        else $(this).parent().find('.level-2').click();
                        //console.log(cityPlacemarks
                    });
                    $(document).on('click','.level-2',function(){

                        $(this).parents('.li-level-1').find('.level-1').addClass('active');
                        $('.level-2').removeClass('active');
                        $(this).addClass('active');

                        var id = $(this).data('id');
                        myMap.setZoom(zoom, { smooth: true });
                        myMap.setCenter([placemarks[id]['lat'],placemarks[id]['lon']]);
                    });
                    $(document).on('click','.li-level-0',function() {
                        $(this).parent().toggleClass('mobile-active');
                    });

                });
                console.log(placemarks);

            </script>
            <div class="map-info">
                <div class="map-info-wrap">
                    <a class="all-shops">Все салоны России</a>
                    <ul class="shop-list">

                        <li class="li-level-0 hidden-sm hidden-md hidden-lg region_wrapper"><span class="text">Выбрать город</span><span class="arrow"><i></i></span></li>
                        <?foreach($arElements as $city=>$shops):?>
                            <li class="li-level-1"><a class="level-1" data-name="<?=$city?>"><span class="count"><?=count($shops)?></span><?=$city?></a>
                                <ul>
                                    <?foreach($shops as $shop):?>
                                        <li><a class="level-2" id="placemark<?=$shop['ID']?>" data-id="<?=$shop['ID']?>"><?=$shop['PROPERTY_ADDRESS_VALUE']?></a>
                                            <div class="shop-info">
                                                <div>
                                                    <?
                                                    if($shop["PROPERTY_METRO_VALUE"]):
                                                        if(is_array($shop["PROPERTY_METRO_VALUE"]))
                                                            $shop["PROPERTY_METRO_VALUE"] = implode(',',$shop["PROPERTY_METRO_VALUE"]);
                                                        $metro  = "Метро: ".$shop["PROPERTY_METRO_VALUE"];
                                                        ?>

                                                        <p><?=$metro?></p>
                                                    <?endif;
                                                    ?>
                                                    <p><?=$shop['PROPERTY_SCHEDULE_VALUE']['TEXT']?></p>
                                                    <p><span class="icon-blocks email"></span><?=$shop['PROPERTY_EMAIL_VALUE']?></p>

                                                    <?if(is_array($shop['PROPERTY_PHONE_VALUE'])) {
                                                        foreach($shop['PROPERTY_PHONE_VALUE'] as $phone):?>
                                                            <p><span class="icon-blocks phone"></span><?=$phone?></p>

                                                        <?endforeach;
                                                    }
                                                    else {
                                                        ?>
                                                        <p><span class="icon-blocks phone"></span><?=$shop['PROPERTY_PHONE_VALUE']?></p>
                                                        <p><button type="button" class="print_address"  onclick="$('#printContent').print()" value="Печать">Распечатать адрес</button></p><?
                                                    }?>
                                                    <?if($shop['PROPERTY_MORE_PHOTOS_VALUE']):?>
                                                        <ul class="photos">
                                                            <?foreach($shop['PROPERTY_MORE_PHOTOS_VALUE'] as $photo):?>
                                                                <?$src = CFile::GetPath($photo);?>
                                                                <li><a href="<?=$src?>" class="fancybox" rel="shop<?=$shop['ID']?>"><img src="<?=$src?>"/></a></li>
                                                            <?endforeach;?>
                                                        </ul>
                                                    <?endif;?>
                                                </div>
                                            </div>
                                        </li>
                                    <?endforeach;?>
                                </ul>
                            </li>
                        <?endforeach;?>
                    </ul>
                </div>
            </div>
            <div class="contacts-page-map" id="mapForScreen">
                <div id="map" style="width:100%;height:650px">

                </div>
                <?/*$APPLICATION->IncludeComponent(
					"bitrix:map.yandex.view",
					"map",
					array(
						"INIT_MAP_TYPE" => "MAP",
						"MAP_DATA" => serialize(array("yandex_lat" => $mapLAT, "yandex_lon" => $mapLON, "yandex_scale" => 19, "PLACEMARKS" => $arPlacemarks)),
						"MAP_WIDTH" => "100%",
						"MAP_HEIGHT" => "650",
						"CONTROLS" => array(
							0 => "ZOOM",
							1 => "TYPECONTROL",
							2 => "SCALELINE",
						),
						"OPTIONS" => array(
							0 => "ENABLE_DBLCLICK_ZOOM",
							1 => "ENABLE_DRAGGING",
						),
						"MAP_ID" => "MAP_v33",
						"COMPONENT_TEMPLATE" => "map"
					),
					false
				);*/?>
            </div>
            <?if($arParams['SHOW_TOP_MAP'] == 'Y'):?>
            <?$this->EndViewTarget();?>
        <?endif;?>
        <?}?>
        <?/*$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"contacts",
			Array(
				"COUNT_IN_LINE" => $arParams["COUNT_IN_LINE"],
				"SHOW_SECTION_PREVIEW_DESCRIPTION" => $arParams["SHOW_SECTION_PREVIEW_DESCRIPTION"],
				"VIEW_TYPE" => $arParams["VIEW_TYPE"],
				"SHOW_TABS" => $arParams["SHOW_TABS"],
				"IMAGE_POSITION" => $arParams["IMAGE_POSITION"],
				"IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
				"IBLOCK_ID"	=>	$arParams["IBLOCK_ID"],
				"NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
				"SORT_BY1"	=>	$arParams["SORT_BY1"],
				"SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
				"SORT_BY2"	=>	$arParams["SORT_BY2"],
				"SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
				"FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
				"PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
				"DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
				"SET_TITLE"	=>	$arParams["SET_TITLE"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"INCLUDE_IBLOCK_INTO_CHAIN"	=>	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
				"ADD_SECTIONS_CHAIN"	=>	$arParams["ADD_SECTIONS_CHAIN"],
				"CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
				"CACHE_TIME"	=>	$arParams["CACHE_TIME"],
				"CACHE_FILTER"	=>	"Y",
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE"	=>	$arParams["PAGER_TITLE"],
				"PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
				"PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
				"DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
				"DISPLAY_NAME"	=>	$arParams["DISPLAY_NAME"],
				"DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
				"DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
				"PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
				"ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
				"USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
				"GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
				"FILTER_NAME"	=>	$arParams["FILTER_NAME"],
				"HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
				"CHECK_DATES"	=>	$arParams["CHECK_DATES"],
				"PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
				"PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
				"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
				"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
				"INCLUDE_SUBSECTIONS" => "Y",
				"SHOW_DETAIL_LINK" => $arParams["SHOW_DETAIL_LINK"],
			),
			$component
		);*/?>
        <?CNext::checkRestartBuffer();?>
    <?endif;?>
</div>

<div id="printContent" style="display: none;">
    <img id="printContentImg" src="">
    <script>
    </script>
</div>

<script>

    $(document).ready(function() {
        $.fn.extend({
            print: function() {

        var mapCenter =  myMap.getCenter();
        var mapUrl = 'https://static-maps.yandex.ru/1.x/?ll=' + mapCenter.reverse() + '&size=600,450&z=' + myMap.getZoom() + '&l=map&pt=' + mapCenter + ',pm2rdm';
        $('#printContentImg').attr('src', mapUrl);


                var frameName = 'printIframe';
                var doc = window.frames[frameName];
                if (!doc) {
                    $('<iframe>').hide().attr('name', frameName).appendTo(document.body);
                    doc = window.frames[frameName];
                }
                doc.document.body.innerHTML = this.html();
                doc.window.print();
                return this;
            }
        });
    });



</script>
