<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Всегда в наличии");
?>

    <div class="row">
        <div class="col-md-12 top-banner">
            <img src="/images/banners/always_available.png" alt="">
        </div>
    </div>

<div class="row text">
    <div class="col-md-12">
        <h2>Всегда в наличии</h2>
        <p>Необходимо оборудовать рабочее пространство в кратчайшие сроки?</p>
        <p>У нас есть решение! Всегда в наличии самые востребованные комплекты офисной мебели и кресел. Наличие широкого спектра товаров обеспечивается большими складскими площадями:</p>
    </div>
</div>

    <div class="row about-company advantages-wrap always-available-wrap">
        <div class="row about-company advantages">
            <div class="col-lg-4 advantage-item">
                <p class="advantages-number"><span class="big">55</span> 000 складских м<sup>2</sup></p>
                <p class="advantages-text big">2 центральных логистических комплекса в Москве и Санкт-Петербурге площадью 55 000 м<sup>2</sup></p>
                <a href="/services/dostavka/" class="red-btn">Доставка и самовывоз</a>
            </div>
            <div class="col-lg-4 advantage-item">
                <p class="advantages-number"><span class="big">47</span> региональных филиалов</p>
                <p class="advantages-text">Склады в 47 городах присутствия компании “ДЭФО”</p>
                <a href="/contacts/" class="red-btn">Карта салонов</a>
            </div>
        </div>
    </div>

    <div class="row text">
        <div class="col-md-12">
            <p>Склады оснащены  высокотехнологичным оборудованием и современными системами учета в соответствии с европейскими стандартами. Склады компании «ДЭФО» расположены максимально удобно для подъезда любых видов автотранспорта.</p>
        </div>
    </div>

<div class="row grey_bg why-we">
    <h2 class="why-we-title">Доставка 24 часа (МСК и СПБ)</h2>
    <h2 class="why-we-subtitle">При наличии товара на складе мы можем предложить экспресс-доставку в течение 24 часов <sup>*</sup>.</h2>
    <ol class="why-we-list">
        <li>
            <div class="why-we-wrapper">
                <h3>Выберете товар из наличия</h3>
<!--                <p>Доставку офисной мебели-->
<!--                    осуществляет-->
<!--                    «Служба Высокого Сервиса ДЭФО»</p>-->
            </div>
        </li>
        <li>
            <div class="why-we-wrapper">
                <h3>Оплатите заказ</h3>
<!--                <p>Компания «ДЭФО» осуществляет-->
<!--                    послегарантийное обслуживание-->
<!--                    и ремонт мебели, замену составных-->
<!--                    элементов или комплектующих.</p>-->
            </div>
        </li>
        <li>
            <div class="why-we-wrapper">
                <h3>Оформите заявку на доставку до 14:30</h3>
<!--                <p>Лучшие специалисты ответят-->
<!--                    на все Ваши вопросы,-->
<!--                    дадут полезные рекомендации-->
<!--                    или просто помогут советом.-->
<!--                    Абсолютно бесплатно.</p>-->
            </div>
        </li>
        <li>
            <div class="why-we-wrapper">
                <h3>Получите заказ на следующий день</h3>
<!--                <p>Нам очень важны отзывы, которые Вы оставляете о нашей продукции,-->
<!--                    о любимом товаре, нашей работе-->
<!--                    и просто что думаете!</p>-->
            </div>
        </li>
    </ol>

    <small><sup>*</sup>Ваш заказ не должен превышать 1,5 тонны. Услуга “Доставка 24 часа” осуществляется только в пределах КАД.</small>
    <p class="defo_advantages">Стоимость «Доставки 24 часа» рассчитывается, как основная стоимость доставки + 1 500 руб.</p>
</div>

<div class="row text">
    <div class="col-md-12">
        <h2>В наличии в салонах</h2>
<!--        <ul class="ways-to-get-list">-->
<!--            <li class="ways-to-get-item factory">-->
<!--                <p>Самовывоз со склада</p>-->
<!--            </li>-->
<!--            <li class="ways-to-get-item delivery">-->
<!--                <p>Доставка</p>-->
<!--            </li>-->
<!--            <li class="ways-to-get-item box">-->
<!--                <p>Самовывоз из салона</p>-->
<!--            </li>-->
<!--        </ul>-->
        <p>В наших салонах представлены коллекции мебели для персонала, кабинетов руководителей, офисные кресла, системы хранения и аксессуары. Можно подобрать все необходимое для удобного рабочего пространства.</p>
        <p>Обратите внимание на комплекты, которые представлены в наших салонах.</p>
        <b>При приобретении товара с  экспозиции мы предлагаем скидку!</b>
    </div>
</div>


    <div class="contacts-page-map advantage">
        <?/*$APPLICATION->IncludeComponent(
            "bitrix:news",
            "contacts_custom",
            array(
                "IBLOCK_TYPE" => "aspro_next_content",
                "IBLOCK_ID" => "10",
                "NEWS_COUNT" => "20",
                "USE_SEARCH" => "N",
                "USE_RSS" => "Y",
                "USE_RATING" => "N",
                "USE_CATEGORIES" => "N",
                "USE_FILTER" => "Y",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_ORDER1" => "DESC",
                "SORT_BY2" => "SORT",
                "SORT_ORDER2" => "ASC",
                "CHECK_DATES" => "Y",
                "SEF_MODE" => "Y",
                "SEF_FOLDER" => "/contacts/",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "100000",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "N",
                "SET_TITLE" => "Y",
                "SET_STATUS_404" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "USE_PERMISSIONS" => "N",
                "PREVIEW_TRUNCATE_LEN" => "",
                "LIST_ACTIVE_DATE_FORMAT" => "j F Y",
                "LIST_FIELD_CODE" => array(
                    0 => "NAME",
                    1 => "PREVIEW_TEXT",
                    2 => "PREVIEW_PICTURE",
                    3 => "DATE_ACTIVE_FROM",
                    4 => "",
                ),
                "LIST_PROPERTY_CODE" => array(
                    0 => "",
                    1 => "PERIOD",
                    2 => "REDIRECT",
                    3 => "",
                ),
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "DISPLAY_NAME" => "N",
                "META_KEYWORDS" => "-",
                "META_DESCRIPTION" => "-",
                "BROWSER_TITLE" => "-",
                "DETAIL_ACTIVE_DATE_FORMAT" => "j F Y",
                "DETAIL_FIELD_CODE" => array(
                    0 => "PREVIEW_TEXT",
                    1 => "DETAIL_TEXT",
                    2 => "DETAIL_PICTURE",
                    3 => "DATE_ACTIVE_FROM",
                    4 => "",
                ),
                "DETAIL_PROPERTY_CODE" => array(
                    0 => "",
                    1 => "FORM_QUESTION",
                    2 => "FORM_ORDER",
                    3 => "PHOTOPOS",
                    4 => "LINK_GOODS",
                    5 => "LINK_SERVICES",
                    6 => "LINK_STUDY",
                    7 => "VIDEO",
                    8 => "PHOTOS",
                    9 => "DOCUMENTS",
                    10 => "",
                ),
                "DETAIL_DISPLAY_TOP_PAGER" => "N",
                "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                "DETAIL_PAGER_TITLE" => "Страница",
                "DETAIL_PAGER_TEMPLATE" => "",
                "DETAIL_PAGER_SHOW_ALL" => "Y",
                "PAGER_TEMPLATE" => ".default",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "IMAGE_POSITION" => "left",
                "USE_SHARE" => "Y",
                "AJAX_OPTION_ADDITIONAL" => "",
                "USE_REVIEW" => "N",
                "ADD_ELEMENT_CHAIN" => "Y",
                "SHOW_DETAIL_LINK" => "Y",
                "S_ASK_QUESTION" => "",
                "S_ORDER_SERVISE" => "",
                "T_GALLERY" => "",
                "T_DOCS" => "",
                "T_GOODS" => "",
                "T_SERVICES" => "",
                "T_STUDY" => "",
                "COMPONENT_TEMPLATE" => "contacts",
                "SET_LAST_MODIFIED" => "N",
                "T_VIDEO" => "",
                "DETAIL_SET_CANONICAL_URL" => "N",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "SHOW_404" => "N",
                "MESSAGE_404" => "",
                "NUM_NEWS" => "20",
                "NUM_DAYS" => "30",
                "YANDEX" => "N",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "SECTIONS_TYPE_VIEW" => "sections_1",
                "SECTION_TYPE_VIEW" => "section_1",
                "SECTION_ELEMENTS_TYPE_VIEW" => "list_elements_2",
                "ELEMENT_TYPE_VIEW" => "element_1",
                "S_ORDER_SERVICE" => "",
                "T_PROJECTS" => "",
                "T_REVIEWS" => "",
                "T_STAFF" => "",
                "IMAGE_CATALOG_POSITION" => "left",
                "SHOW_SECTION_PREVIEW_DESCRIPTION" => "Y",
                "SHOW_SECTION_DESCRIPTION" => "Y",
                "LINE_ELEMENT_COUNT" => "3",
                "LINE_ELEMENT_COUNT_LIST" => "3",
                "SHOW_CHILD_SECTIONS" => "N",
                "GALLERY_TYPE" => "small",
                "INCLUDE_SUBSECTIONS" => "Y",
                "FORM_ID_ORDER_SERVISE" => "",
                "T_NEXT_LINK" => "",
                "T_PREV_LINK" => "",
                "SHOW_NEXT_ELEMENT" => "N",
                "IMAGE_WIDE" => "N",
                "SHOW_FILTER_DATE" => "Y",
                "FILTER_NAME" => "arFilterNews",
                "FILTER_FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "FILTER_PROPERTY_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "DETAIL_STRICT_SECTION_CHECK" => "N",
                "VIEW_TYPE" => "list",
                "SHOW_TABS" => "Y",
                "SHOW_ASK_QUESTION_BLOCK" => "Y",
                "SEF_URL_TEMPLATES" => array(
                    "news" => "",
                    "section" => "",
                    "detail" => "stores/#ELEMENT_ID#/",
                    "rss" => "rss/",
                    "rss_section" => "#SECTION_ID#/rss/",
                )
            ),
            false
        );*/?>
    </div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>