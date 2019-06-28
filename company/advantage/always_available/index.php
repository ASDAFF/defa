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
        <p>На сегодняшний день компания «ДЭФО» обладает современными складскими комплексами общей площадью более 50 000 м2.
            Оборудованные в соответствии с европейскими стандартами, оснащенные высокотехнологичным оборудованием и современными системами учета, склады
            компании «ДЭФО» расположены максимально удобно для подъезда любых видов автотранспорта.</p>
    </div>
</div>

<div class="row grey_bg why-we">
    <h2 class="why-we-title">Почему мы?</h2>
    <p class="why-we-subtitle">Почему покупать мебель в “ДЭФО” это правильный выбор?</p>
    <ol class="why-we-list">
        <li>
            <div class="why-we-wrapper">
                <h3>Качественная и
                    своевременная доставка</h3>
                <p>Доставку офисной мебели
                    осуществляет
                    «Служба Высокого Сервиса ДЭФО»</p>
            </div>
        </li>
        <li>
            <div class="why-we-wrapper">
                <h3>Послегарантийное
                    обслуживание</h3>
                <p>Компания «ДЭФО» осуществляет
                    послегарантийное обслуживание
                    и ремонт мебели, замену составных
                    элементов или комплектующих.</p>
            </div>
        </li>
        <li>
            <div class="why-we-wrapper">
                <h3>Мы отвечаем на все
                    Ваши вопросы!</h3>
                <p>Лучшие специалисты ответят
                    на все Ваши вопросы,
                    дадут полезные рекомендации
                    или просто помогут советом.
                    Абсолютно бесплатно.</p>
            </div>
        </li>
        <li>
            <div class="why-we-wrapper">
                <h3>Мы дорожим Вашим мнением!</h3>
                <p>Нам очень важны отзывы, которые Вы оставляете о нашей продукции,
                    о любимом товаре, нашей работе
                    и просто что думаете!</p>
            </div>
        </li>
    </ol>

    <p class="defo_advantages">Отличительное преимущество компании «ДЭФО» - быстрая доставка товара в любой регион России!</p>
</div>

<div class="row text">
    <div class="col-md-12">
        <h2>Способы получения товара</h2>
        <ul class="ways-to-get-list">
            <li class="ways-to-get-item factory">
                <p>Самовывоз со склада</p>
            </li>
            <li class="ways-to-get-item delivery">
                <p>Доставка</p>
            </li>
            <li class="ways-to-get-item box">
                <p>Самовывоз из салона</p>
            </li>
        </ul>
        <p>Доставка – один из самых важных этапов при покупке офисной мебели.
            Качественная и своевременная доставка – косвенный показатель того, что и сама офисная мебель будет высокого качества.
            Для «ДЭФО» доставка офисной мебели – ответственный этап во взаимодействии с клиентом. Четкое выполнение этого важного момента является зароком будущего
            уважения и доверия покупателя и партнера.</p>
        <p>Компания заботится о том, чтобы доставка была осуществлена точно в срок, оговоренный при оформлении заказа. Мебель и аксессуары требуют аккуратного и
            береженого отношения при транспортировке для чего профессионалы «службы высокого сервиса ДЭФО» используют удобную и надежную фабричную упаковку.</p>
        <p>Опытные водители компании ДЭФО бережно и в срок осуществят доставку офисной мебели на любой адрес в любой регион России! </p>
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