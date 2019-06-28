<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?global $isShowSale, $isShowCatalogSections, $isShowCatalogElements, $isShowMiddleAdvBottomBanner, $isShowBlog;?>
<?$APPLICATION->IncludeComponent(
    "aspro:com.banners.next",
    "top_one_banner",
    array(
        "IBLOCK_TYPE" => "aspro_next_adv",
        "IBLOCK_ID" => "3",
        "TYPE_BANNERS_IBLOCK_ID" => "1",
        "SET_BANNER_TYPE_FROM_THEME" => "N",
        "NEWS_COUNT" => "10",
        "NEWS_COUNT2" => "4",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "ID",
        "SORT_ORDER2" => "DESC",
        "PROPERTY_CODE" => array(
            0 => "TEXT_POSITION",
            1 => "TARGETS",
            2 => "TEXTCOLOR",
            3 => "URL_STRING",
            4 => "BUTTON1TEXT",
            5 => "BUTTON1LINK",
            6 => "BUTTON2TEXT",
            7 => "BUTTON2LINK",
            8 => "",
        ),
        "CHECK_DATES" => "Y",
        "CACHE_GROUPS" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "SITE_THEME" => $SITE_THEME,
        "BANNER_TYPE_THEME" => "TOP",
        "BANNER_TYPE_THEME_CHILD" => "TOP_SMALL_BANNER",
    ),
    false
);?>








<!--<div class="maxwidth-theme">
    <?/*$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR."include/mainpage/comp_banners_float.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    );*/?>
</div>-->
<div class="what_do-block">
    <div class="grey_block">
        <div class="maxwidth-theme">

            <h3>Выбираете мебель?</h3>
            <div class="row">
                <div class="col-md-4">
                    <a href="javascript:;" class="what_do-item">
                        <div class="what_do-item-icon">
                            <svg width="30"; version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">
<style type="text/css">
    .st1-0{ fill:none;stroke:#1F2229;stroke-width:2;stroke-miterlimit:10;}
</style>
                                <g>
                                    <path class="st1-0" d="M27,25.1H14.4L8.6,30l0-4.9H5c-2.2,0-4-1.7-4-3.9V6.9C1,4.7,2.8,3,5,3H27c2.2,0,4,1.7,4,3.9v14.4
		C31,23.4,29.2,25.1,27,25.1z"/>
                                    <g>
                                        <line class="st1-0" x1="6.4" y1="9.2" x2="25.6" y2="9.2"/>
                                        <line class="st1-0" x1="6.4" y1="14.3" x2="25.6" y2="14.3"/>
                                    </g>
                                </g>
</svg>

                        </div>
                        <span>Получить консультацию</span>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="javascript:;" class="what_do-item">
                        <div class="what_do-item-icon">
                            <svg width="30" version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 55.7 50.5" style="enable-background:new 0 0 55.7 50.5;" xml:space="preserve">
<style type="text/css">
    .st2-0{fill:none;stroke:#1F2229;stroke-width:3;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
    .st2-1{fill:none;stroke:#1F2229;stroke-width:2;stroke-miterlimit:10;}
    .st2-2{fill:#1F2229;stroke:#1F2229;stroke-miterlimit:10;}
</style>
                                <g>
                                    <g>
                                        <path class="st2-0" d="M51.5,49C35.7,49,20,49,4.2,49c-2,0-3.1-1.3-2.5-3C4.6,38.4,6.1,34.6,9,27c0.6-1.7,2.2-3,3.5-3
			c10.2,0,20.4,0,30.6,0c1.3,0,2.9,1.3,3.5,3c2.9,7.6,4.4,11.4,7.3,19C54.7,47.6,53.5,49,51.5,49z"/>
                                    </g>
                                    <g>
                                        <path class="st2-1" d="M39.7,12.6c0,6.3-11.4,23.7-11.4,23.7S17,18.8,17,12.6S22,1.2,28.3,1.2S39.7,6.3,39.7,12.6z"/>
                                        <path class="st2-2" d="M39.7,12.6c0,6.3-11.4,23.7-11.4,23.7S17,18.8,17,12.6S22,1.2,28.3,1.2S39.7,6.3,39.7,12.6z M28.3,3.1
			c-5.2,0-9.5,4.3-9.5,9.5s4.3,9.5,9.5,9.5s9.5-4.3,9.5-9.5S33.6,3.1,28.3,3.1z"/>
                                    </g>
                                </g>
</svg>

                        </div>
                        <span>Посмотреть контакты</span>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="javascript:;" class="what_do-item">
                        <div class="what_do-item-icon">
                            <svg width="30" version="1.1" id="Layer_4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 47 46" style="enable-background:new 0 0 47 46;" xml:space="preserve">
<style type="text/css">
    .st3-0{fill:#1F2229;}
    .st3-1{fill:none;stroke:#1F2229;stroke-width:3;stroke-linejoin:round;stroke-miterlimit:10;}
    .st3-2{fill:#FFFFFF;stroke:#1F2229;stroke-width:3;stroke-linejoin:round;stroke-miterlimit:10;}
    .st3-3{fill:#FFFFFF;stroke:#1F2229;stroke-width:3;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
    .st3-4{fill:#FFFFFF;stroke:#1F2229;stroke-width:2;stroke-miterlimit:10;}
</style>
                                <g>
                                    <g>
                                        <g>
                                            <path class="st3-1" d="M14,4.8v38H4v-38H14 M17,1.8h-3H4H1v3v38v3h3h10h3v-3v-38V1.8L17,1.8z"/>
                                        </g>
                                        <g>
                                            <polyline class="st3-1" points="27.5,38.8 35.5,7.8 44.7,38.7 			"/>
                                            <g>
                                                <polygon class="st3-0" points="28.5,38.3 26.5,45.8 27,37.3 				"/>
                                            </g>
                                            <g>
                                                <polygon class="st3-0" points="43.5,38.3 45.5,45.8 45,37.3 				"/>
                                            </g>
                                            <circle class="st3-2" cx="35.5" cy="10.4" r="3.5"/>
                                            <line class="st3-3" x1="35.5" y1="6.8" x2="35.5" y2="1.8"/>
                                        </g>
                                    </g>
                                    <g>
                                        <line class="st3-4" x1="9.3" y1="7.8" x2="13.3" y2="7.8"/>
                                        <line class="st3-4" x1="9.3" y1="11.8" x2="13.3" y2="11.8"/>
                                        <line class="st3-4" x1="9.3" y1="15.8" x2="13.3" y2="15.8"/>
                                        <line class="st3-4" x1="9.3" y1="19.8" x2="13.3" y2="19.8"/>
                                        <line class="st3-4" x1="9.3" y1="23.8" x2="13.3" y2="23.8"/>
                                        <line class="st3-4" x1="9.3" y1="27.8" x2="13.3" y2="27.8"/>
                                        <line class="st3-4" x1="9.3" y1="31.8" x2="13.3" y2="31.8"/>
                                        <line class="st3-4" x1="9.3" y1="35.8" x2="13.3" y2="35.8"/>
                                        <line class="st3-4" x1="9.3" y1="39.8" x2="13.3" y2="39.8"/>
                                    </g>
                                </g>
</svg>

                        </div>
                        <span>3D-планирование</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>











<!--<div class="maxwidth-theme">
    <?/*$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR."include/mainpage/comp_news_akc.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    );*/?>
</div>
-->


    <div class="maxwidth-theme">
        <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => SITE_DIR."include/mainpage/comp_catalog_hit.php",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => "standard.php"
            ),
            false
        );?>
    </div>




    <!--<div class="maxwidth-theme">
        <?/*$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => SITE_DIR."include/mainpage/comp_adv_middle.php",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => "standard.php"
            ),
            false
        );*/?>

    </div>-->


    <div class="maxwidth-theme">
        <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => SITE_DIR."include/mainpage/comp_tizers.php",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => "standard.php"
            ),
            false
        );?>
    </div>



<div class="maxwidth-theme">
    <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR."include/mainpage/comp_catalog_sections_custom.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    );?>
</div>

<div class="maxwidth-theme">
    <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR."include/mainpage/comp_banners_float.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    );?>
</div>



<?if($isShowBlog):?>
    <div class="maxwidth-theme">
        <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => SITE_DIR."include/mainpage/comp_blog_custom.php",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => "standard.php"
            ),
            false
        );?>
    </div>
<?endif;?>


<div class="maxwidth-theme">
<?/*$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PATH" => SITE_DIR."include/mainpage/comp_bottom_banners.php",
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => "standard.php"
    ),
    false
);*/?>
</div>

<div class="maxwidth-theme">

    <?/*global $arRegion, $isShowCompany;*/?><!--
    <div class="company_bottom_block">
        <div class="row wrap_md">
            <div class="col-md-3 col-sm-3 hidden-xs img">
                <?/*$APPLICATION->IncludeFile(SITE_DIR."include/mainpage/company/front_img.php", Array(), Array( "MODE" => "html", "NAME" => GetMessage("FRONT_IMG") )); */?>
            </div>
            <div class="col-md-9 col-sm-9 big">
                <?/*if($arRegion):*/?>
                    <?/*$frame = new \Bitrix\Main\Page\FrameHelper('text-regionality-block');*/?>
                    <?/*$frame->begin();*/?>
                    <?/*=$arRegion['DETAIL_TEXT'];*/?>
                    <?/*$frame->end();*/?>
                <?/*else:*/?>
                    <?/*$APPLICATION->IncludeComponent("bitrix:main.include", "front", Array("AREA_FILE_SHOW" => "file","PATH" => SITE_DIR."include/mainpage/company/front_info.php","EDIT_TEMPLATE" => ""));*/?>
                <?/*endif;*/?>
            </div>
        </div>
    </div>-->



</div>


<div class="contacts-v5">
    <?$APPLICATION->IncludeComponent(
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
    );?>




</div>

<div class="maxwidth-theme">
        <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => SITE_DIR."include/mainpage/comp_brands.php",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => "standard.php"
            ),
            false
        );?>
</div>
