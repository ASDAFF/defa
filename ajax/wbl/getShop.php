<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("main");
CModule::IncludeModule("iblock");

$intProductID = \Bitrix\Main\Application::getInstance()
    ->getContext()
    ->getRequest()
    ->get('PRODUCT_ID');

if ($intProductID > 0) {
    $arItemFilter = [
        'IBLOCK_ID' => 10,
        'INCLUDE_SUBSECTIONS' => 'Y',
        'ACTIVE' => 'Y',
        'ACTIVE_DATE' => 'Y',
    ];
    $arItemFilter['PROPERTY_REGION'] = \CNextRegionalityB2c::getCurrentRegion()['ID'];

    $arItemSelect = array('ID', 'NAME', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'PROPERTY_MAP', 'PROPERTY_ADDRESS', 'PROPERTY_SCHEDULE', 'PROPERTY_EMAIL', 'PROPERTY_MORE_PHOTOS', 'PROPERTY_PHONE', 'PROPERTY_METRO');
    $arItems = CNextCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CNextCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, false, false, $arItemSelect);

    $arAllSections = array();
    if ($arItems) {
        $arAllSections = CNext::GetSections($arItems, $arParams);
    }

    $bUseMap = CNext::GetFrontParametrValue('CONTACTS_USE_MAP', SITE_ID) != 'N';
    $mapLAT = $mapLON = $iCountShops = 0;
    $arPlacemarks = array();
    if ($bPostSection) {
        $arItems = CNextCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CNextCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), array_merge($arItemFilter, array('SECTION_ID' => $_POST['ID'])), false, false, $arItemSelect);
        $GLOBALS[$arParams['FILTER_NAME']]['SECTION_ID'] = $_POST['ID'];
    }

    foreach ($arItems as $arItem) {
        $arElements[$arItem['NAME']][] = $arItem;
    }

    foreach ($arItems as $arItem) {
        if ($arItem['PROPERTY_MAP_VALUE']) {
            $arCoords = explode(',', $arItem['PROPERTY_MAP_VALUE']);
            $mapLAT += $arCoords[0];
            $mapLON += $arCoords[1];
            $str_phones = '';
            if ($arItem['PHONE']) {
                foreach ($arShop['PHONE'] as $phone) {
                    $str_phones .= '<div class="phone"><a rel="nofollow" href="tel:'.str_replace(array(' ', ',', '-', '(', ')'), '', $phone).'">'.$phone.'</a></div>';
                }
            }
            if (is_array($arItem["PROPERTY_PHONE_VALUE"])) {
                $phone = implode(', ', $arItem["PROPERTY_PHONE_VALUE"]);
            } else {
                $phone = $arItem["PROPERTY_PHONE_VALUE"];
            }
            $schedule = preg_replace("/\r\n/", "<br />", $arItem["PROPERTY_SCHEDULE_VALUE"]['TEXT']);

            if (is_array($arItem["PROPERTY_METRO_VALUE"])) {
                $arItem["PROPERTY_METRO_VALUE"] = implode(',', $arItem["PROPERTY_METRO_VALUE"]);
            }

            if ($arItem["PROPERTY_METRO_VALUE"]) {
                $metro = "Метро: ".$arItem["PROPERTY_METRO_VALUE"];
            } else {
                $metro = "";
            }
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

    if ($iCountShops && $bUseMap) {
        $mapLAT = floatval($mapLAT / $iCountShops);
        $mapLON = floatval($mapLON / $iCountShops); ?>
        <? if ($arParams['SHOW_TOP_MAP'] == 'Y'): ?>
            <? $this->SetViewTarget('yandex_map'); ?>
        <? endif; ?>
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
                    'lat' => 100,
                    'lon' => 100,
                ],
                'max' => [
                    'lat' => 0,
                    'lon' => 0,
                ],
            ];
            ?>
            cityPlacemarks['<?=$city?>'] = [
                <?foreach($shops as $shop):

                $arCoords = explode(',', $shop['PROPERTY_MAP_VALUE']);
                if ($coords[$city]['max']['lat'] < $arCoords[0]) {
                    $coords[$city]['max']['lat'] = $arCoords[0];
                }
                if ($coords[$city]['min']['lat'] > $arCoords[0]) {
                    $coords[$city]['min']['lat'] = $arCoords[0];
                }
                if ($coords[$city]['max']['lon'] < $arCoords[1]) {
                    $coords[$city]['max']['lon'] = $arCoords[1];
                }
                if ($coords[$city]['min']['lon'] > $arCoords[1]) {
                    $coords[$city]['min']['lon'] = $arCoords[1];
                }
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

                if ($(window).width() < 767) {

                    myMap = new ymaps.Map("map", {
                        center: [<?=$mapLAT?>, <?=$mapLON?>],
                        zoom: 7,
                        controls: []
                    });

                    myMap.behaviors.disable('drag');
                    //myMap.behaviors.disable('multiTouch');
                } else {
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
                        "                                            <p><?=$placemark['METRO']?><br/>" +
                        "                                            <?=$placemark['SCHEDULE']?><br/>" +
                        "                                            <span class=\"icon-blocks phone\"></span><?=$placemark['PHONE']?><br/>" +
                        "                                            <span class=\"icon-blocks email\"></span><?=$placemark['EMAIL']?></p>" +
                        "                                            <p style=''><a class='dotted route' style='padding: 5px 7px; display: inline-block; border: 1px solid #000;' data-lat='<?=$placemark['LAT']?>' data-lon='<?=$placemark['LON']?>' href='#map'>Проложить маршрут</a></p>",
                    balloonContentFooter: "                                            <ul class=\"photos\">\n" +
                        "                                                <?foreach($placemark['PHOTO'] as $photo):?>\n" +
                        "                                                <?$src = CFile::GetPath($photo);?>\n" +
                        "                                                    <li><a href=\"<?=$src?>\" class=\"fancybox\" rel=\"shop<?=$shop['ID']?>\"><img src=\"<?=$src?>\"/></a></li>\n" +
                        "                                                <?endforeach;?>\n" +
                        "                                            </ul>\n",
                    id: "<?=$placemark['ID']?>",
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

                placemark.events.add(['click'], function (e) {
                    console.log('<?=$placemark["ID"]?>');
                    WblMap.zoomPlacemark('<?=$placemark["ID"]?>');
                    //$('[data-wbl-detail-shop-id="<?//=$placemark["ID"]?>//"]').click();

                    /*
                    var top1 = $('.map-info').offset().top;
                    var top2 = $('#placemark<=$placemark["ID"]?>').offset().top;
                    var top3 = top2 - top1;

                    console.log(top1);

                    if(top3>0)
                        if ($('#placemark<=$placemark["ID"]?>').length != 0) { // проверим существование элемента чтобы избежать ошибки
                            $('.map-info').scrollTop(top3); // анимируем скроолинг к элементу scroll_el
                        }
                    */

                    return false;
                });

                myMap.geoObjects.add(placemark);


                <?endforeach;?>
                myMap.setBounds(myMap.geoObjects.getBounds(), {
                    checkZoomRange: true
                });
            }

            $(document).ready(function () {


                $(document).on('click', '.print', function () {
                    window.print();

                });
                $(document).on('click', '.route', function () {
                    var location = ymaps.geolocation.get();
                    var _this = $(this);
                    var currCoord;
                    location.then(
                        function (result) {
                            // Добавление местоположения на карту.
                            var currCoord0 = result.geoObjects.position[0];
                            var currCoord1 = result.geoObjects.position[1];
                            var lat = _this.data('lat');
                            var lon = _this.data('lon');
                            console.log(currCoord0 + ',' + currCoord1);
                            console.log(lat + ',' + lon);
                            ymaps.route([
                                // Список точек, которые необходимо посетить
                                [currCoord0, currCoord1], [lat, lon]], {
                                // Опции маршрутизатора
                                mapStateAutoApply: true // автоматически позиционировать карту
                            }).then(function (router) {
                                myMap.geoObjects.add(router);
                            }, function (error) {
                                alert("Возникла ошибка: " + error.message);
                            });

                        },
                        function (err) {
                            console.log('Ошибка: ' + err)
                        }
                    );


                });

                $(document).on('click', '.all-shops', function () {

                    myMap.margin.setDefaultMargin(50);
                    myMap.setBounds(myMap.geoObjects.getBounds());
                    console.log(myMap.geoObjects.getBounds());
                    $('.level-1').removeClass('active');
                });

                $(document).on('click', '.level-1', function () {
                    var zoom = myMap.getZoom();
                    myMap.setZoom(zoom);
                    var active = false;
                    $('.shop-list').removeClass('mobile-active');
                    if ($(this).hasClass('active')) active = true;
                    $('.level-1').removeClass('active');
                    $('.level-2').removeClass('active');
                    if (active)
                        $(this).removeClass('active');
                    else
                        $(this).addClass('active');
                    var name = $(this).data('name');
                    $('.shop-list .li-level-0 .text').text(name);

                    if (cityPlacemarks[name].length > 1) {
                        myMap.margin.setDefaultMargin(80);
                        myMap.setBounds(cityPlacemarks[name],
                            {checkZoomRange: true, preciseZoom: true, zoomMargin: 2}
                        );
                        setTimeout(function () {

                            console.log(myMap.getZoom());
                            var zoom = myMap.getZoom() - 0.5;
                            myMap.setZoom(zoom);
                            console.log(zoom);
                        }, 100);
                    } else $(this).parent().find('.level-2').click();
                    //console.log(cityPlacemarks
                });
                $(document).on('click', '[data-wbl-detail-shop-id]', function () {

                    // $(this).parents('.li-level-1').find('.level-1').addClass('active');
                    // $('.level-2').removeClass('active');
                    // $(this).addClass('active');

                    var id = $(this).attr('data-wbl-detail-shop-id');
                    WblMap.zoomPlacemark(id);
                    // myMap.setZoom(zoom, { smooth: true });
                    // myMap.setCenter([placemarks[id]['lat'],placemarks[id]['lon']]);
                });
                $(document).on('click', '.li-level-0', function () {
                    $(this).parent().toggleClass('mobile-active');
                });

            });
            console.log(placemarks);


            class WblMap {
                static zoomPlacemark(intId) {
                    myMap.setZoom(zoom, {smooth: true});
                    myMap.setCenter([placemarks[intId]['lat'], placemarks[intId]['lon']]);
                    if (document.querySelectorAll('.contacts_wbl [data-wbl-shop-id].active').length > 0) {
                        for (var i in document.querySelectorAll('.contacts_wbl [data-wbl-shop-id].active')) {
                            if (!isNaN(i) && document.querySelectorAll('.contacts_wbl [data-wbl-shop-id].active')[i] instanceof Node) {
                                document.querySelectorAll('.contacts_wbl [data-wbl-shop-id].active')[i].classList.remove('active');
                            }
                        }
                    }


                    if (document.querySelectorAll('.contacts_wbl [data-wbl-shop-id="' + intId + '"]').length > 0) {
                        document.querySelector('.contacts_wbl [data-wbl-shop-id="' + intId + '"]').classList.add('active');
                    }
                }
            }

        </script>

        <?
        global $arWblFilterNews;
        $arWblFilterNews = $GLOBALS[$arParams["FILTER_NAME"]];
        if (!is_array($arWblFilterNews)) {
            $arWblFilterNews = [];
        }
        $arWblFilterNews['PROPERTY_REGION'] = \CNextRegionalityB2c::getCurrentRegion()['ID'];
        ?>
        <div class="contacts-page-map">
            <div class="shops-map-left">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "contacts_wbl",
                    [
                        'COUNT_IN_LINE' => null,
                        'SHOW_SECTION_PREVIEW_DESCRIPTION' => 'Y',
                        'VIEW_TYPE' => 'list',
                        'SHOW_TABS' => 'Y',
                        'IMAGE_POSITION' => 'left',
                        'IBLOCK_TYPE' => 'aspro_next_content',
                        'IBLOCK_ID' => '10',
                        'NEWS_COUNT' => 99999999999,
                        'SORT_BY1' => 'NAME',
                        'SORT_ORDER1' => 'DESC',
                        'SORT_BY2' => 'SORT',
                        'SORT_ORDER2' => 'ASC',
                        'FIELD_CODE' => [
                            0 => 'NAME',
                            1 => 'PREVIEW_TEXT',
                            2 => 'PREVIEW_PICTURE',
                            3 => 'DATE_ACTIVE_FROM',
                            4 => '',
                        ],
                        'PROPERTY_CODE' => [
                            0 => '',
                            1 => 'PERIOD',
                            2 => 'REDIRECT',
                            3 => '',
                        ],
                        'DISPLAY_PANEL' => null,
                        'SET_TITLE' => 'Y',
                        'SET_STATUS_404' => 'N',
                        'INCLUDE_IBLOCK_INTO_CHAIN' => 'N',
                        'ADD_SECTIONS_CHAIN' => 'N',
                        'CACHE_TYPE' => 'N',
                        'CACHE_TIME' => '100000',
                        'CACHE_FILTER' => 'Y',
                        'CACHE_GROUPS' => 'N',
                        'DISPLAY_TOP_PAGER' => 'N',
                        'DISPLAY_BOTTOM_PAGER' => 'Y',
                        'PAGER_TITLE' => 'Новости',
                        'PAGER_TEMPLATE' => '.default',
                        'PAGER_SHOW_ALWAYS' => 'N',
                        'PAGER_DESC_NUMBERING' => 'N',
                        'PAGER_DESC_NUMBERING_CACHE_TIME' => '36000',
                        'PAGER_SHOW_ALL' => 'N',
                        'DISPLAY_DATE' => null,
                        'DISPLAY_NAME' => 'N',
                        'DISPLAY_PICTURE' => null,
                        'DISPLAY_PREVIEW_TEXT' => null,
                        'PREVIEW_TRUNCATE_LEN' => '',
                        'ACTIVE_DATE_FORMAT' => 'j F Y',
                        'USE_PERMISSIONS' => 'N',
                        'GROUP_PERMISSIONS' => null,
                        'FILTER_NAME' => '$arWblFilterNews',
                        'HIDE_LINK_WHEN_NO_DETAIL' => 'N',
                        'CHECK_DATES' => 'Y',
                        'PARENT_SECTION' => null,
                        'PARENT_SECTION_CODE' => null,
                        'DETAIL_URL' => '/contacts/stores/#ELEMENT_ID#/',
                        'SECTION_URL' => '/contacts/',
                        'IBLOCK_URL' => '/contacts/',
                        'INCLUDE_SUBSECTIONS' => 'Y',
                        'SHOW_DETAIL_LINK' => 'Y',
                        'WBL_PRODUCT_ID' => 8425,
                    ],
                    false
                ); ?>
            </div>
            <div class="map-wrapper-inside">
                <div id="map" style="width:100%;height:400px">

                </div>
            </div>
        </div>
    <? }
} ?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");