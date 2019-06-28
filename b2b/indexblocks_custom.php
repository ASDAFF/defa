<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?global $isShowSale, $isShowCatalogSections, $isShowCatalogElements, $isShowMiddleAdvBottomBanner, $isShowBlog;?>

<div class="top-slider-block">
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

    <div class="left-block-catalog">
        <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"left_front_catalog", 
	array(
		"ROOT_MENU_TYPE" => "left",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600000",
		"MENU_CACHE_USE_GROUPS" => "N",
		"CACHE_SELECTED_ITEMS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "3",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"COMPONENT_TEMPLATE" => "left_front_catalog",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>
    </div>

</div>



<div class="tizers-block">
    <div class="maxwidth-theme">
        <div class="row">
            <div class="col-md-4">
                <div class="tizers-item">
                    <h3><a href="javascript:;">Преимущества</a></h3>
                    <div class="tizers-item-content">
                        <a href="javascript:;" class="tizers-item-child border-right border-bottom">
                            <div class="tizers-item-img">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     viewBox="0 0 75.8 42" xml:space="preserve">
	<path fill="#adb8c1" d="M75,14.3H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,14.3,75,14.3z"/>
                                    <path fill="#adb8c1" d="M75,22.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,22.4,75,22.4z"/>
                                    <path fill="#adb8c1" d="M75,30.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,30.4,75,30.4z"/>
                                    <path fill="#adb8c1" d="M32.6,42c-0.4,0-0.7-0.1-1-0.2l-14.1-4.5c-1.7-0.5-2.9-2.3-2.9-4.3v-3.5c-1.3-0.4-4.1-1.3-4.7-1.5
		c-0.5,0.1-1.2,0.1-1.9,0.1H6.4L4.3,28h0C1.9,28,0,24.7,0,20.4s1.9-7.6,4.4-7.6H8c0.8,0,2.3-0.3,3.2-0.6C20.1,9.4,49.1,0,50.3,0
		c6.2,0,11.1,8.9,11.1,20.3s-4.9,20.3-11.1,20.3c-0.1,0-0.1,0-0.2,0l-14.4-4.4l0,2.5C35.7,40.6,34.4,42,32.6,42z M10,26.5
		c0.1,0,0.1,0,0.2,0c0.3,0.1,5.1,1.6,5.5,1.7c0.3,0.1,0.5,0.4,0.5,0.7V33c0,1.1,0.6,2.5,1.8,2.9l14.1,4.5c0.2,0.1,0.4,0.1,0.6,0.1
		c1.1,0,1.6-1,1.6-1.8l0-3.6c0-0.2,0.1-0.5,0.3-0.6c0.2-0.1,0.4-0.2,0.7-0.1l15.3,4.7c5.2-0.1,9.4-8.5,9.4-18.8
		c0-10.4-4.3-18.8-9.6-18.8c-1.3,0.2-23.8,7.4-38.6,12.2C10.7,14,9,14.3,8,14.3H4.4c-1.4,0-2.9,2.4-2.9,6.1c0,3.6,1.5,6.1,2.9,6.1
		l2.1,0.1l1.5,0c0,0,0,0,0,0c0.8,0,1.4,0,1.8-0.1C9.9,26.5,10,26.5,10,26.5z"/>
                                    <path fill="#adb8c1" d="M50.3,40.6c-6.2,0-11.1-8.9-11.1-20.3S44.1,0,50.3,0c0.4,0,0.8,0.3,0.8,0.8s-0.3,0.8-0.8,0.8
		c-5.3,0-9.6,8.4-9.6,18.8s4.3,18.8,9.6,18.8c0.4,0,0.8,0.3,0.8,0.8S50.7,40.6,50.3,40.6z"/>
                                    <path fill="#adb8c1" d="M29.4,34.3c-0.1,0-0.1,0-0.2,0l-9.6-3l0.5-1.4l0,0l9.6,3c0.4,0.1,0.6,0.5,0.5,0.9C30,34.1,29.7,34.3,29.4,34.3
		z"/>
</svg>

                            </div>
                            <div class="tizers-item-text">
                                Тысячи товаров в наличие
                            </div>
                        </a>
                        <a href="javascript:;" class="tizers-item-child border-bottom">
                            <div class="tizers-item-img">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     viewBox="0 0 75.8 42" xml:space="preserve">
	<path fill="#adb8c1" d="M75,14.3H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,14.3,75,14.3z"/>
                                    <path fill="#adb8c1" d="M75,22.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,22.4,75,22.4z"/>
                                    <path fill="#adb8c1" d="M75,30.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,30.4,75,30.4z"/>
                                    <path fill="#adb8c1" d="M32.6,42c-0.4,0-0.7-0.1-1-0.2l-14.1-4.5c-1.7-0.5-2.9-2.3-2.9-4.3v-3.5c-1.3-0.4-4.1-1.3-4.7-1.5
		c-0.5,0.1-1.2,0.1-1.9,0.1H6.4L4.3,28h0C1.9,28,0,24.7,0,20.4s1.9-7.6,4.4-7.6H8c0.8,0,2.3-0.3,3.2-0.6C20.1,9.4,49.1,0,50.3,0
		c6.2,0,11.1,8.9,11.1,20.3s-4.9,20.3-11.1,20.3c-0.1,0-0.1,0-0.2,0l-14.4-4.4l0,2.5C35.7,40.6,34.4,42,32.6,42z M10,26.5
		c0.1,0,0.1,0,0.2,0c0.3,0.1,5.1,1.6,5.5,1.7c0.3,0.1,0.5,0.4,0.5,0.7V33c0,1.1,0.6,2.5,1.8,2.9l14.1,4.5c0.2,0.1,0.4,0.1,0.6,0.1
		c1.1,0,1.6-1,1.6-1.8l0-3.6c0-0.2,0.1-0.5,0.3-0.6c0.2-0.1,0.4-0.2,0.7-0.1l15.3,4.7c5.2-0.1,9.4-8.5,9.4-18.8
		c0-10.4-4.3-18.8-9.6-18.8c-1.3,0.2-23.8,7.4-38.6,12.2C10.7,14,9,14.3,8,14.3H4.4c-1.4,0-2.9,2.4-2.9,6.1c0,3.6,1.5,6.1,2.9,6.1
		l2.1,0.1l1.5,0c0,0,0,0,0,0c0.8,0,1.4,0,1.8-0.1C9.9,26.5,10,26.5,10,26.5z"/>
                                    <path fill="#adb8c1" d="M50.3,40.6c-6.2,0-11.1-8.9-11.1-20.3S44.1,0,50.3,0c0.4,0,0.8,0.3,0.8,0.8s-0.3,0.8-0.8,0.8
		c-5.3,0-9.6,8.4-9.6,18.8s4.3,18.8,9.6,18.8c0.4,0,0.8,0.3,0.8,0.8S50.7,40.6,50.3,40.6z"/>
                                    <path fill="#adb8c1" d="M29.4,34.3c-0.1,0-0.1,0-0.2,0l-9.6-3l0.5-1.4l0,0l9.6,3c0.4,0.1,0.6,0.5,0.5,0.9C30,34.1,29.7,34.3,29.4,34.3
		z"/>
</svg>

                            </div>
                            <div class="tizers-item-text">
                                Крупнейшая сеть салонов
                            </div>
                        </a>
                        <a href="javascript:;" class="tizers-item-child border-right">
                            <div class="tizers-item-img">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     viewBox="0 0 75.8 42" xml:space="preserve">
	<path fill="#adb8c1" d="M75,14.3H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,14.3,75,14.3z"/>
                                    <path fill="#adb8c1" d="M75,22.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,22.4,75,22.4z"/>
                                    <path fill="#adb8c1" d="M75,30.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,30.4,75,30.4z"/>
                                    <path fill="#adb8c1" d="M32.6,42c-0.4,0-0.7-0.1-1-0.2l-14.1-4.5c-1.7-0.5-2.9-2.3-2.9-4.3v-3.5c-1.3-0.4-4.1-1.3-4.7-1.5
		c-0.5,0.1-1.2,0.1-1.9,0.1H6.4L4.3,28h0C1.9,28,0,24.7,0,20.4s1.9-7.6,4.4-7.6H8c0.8,0,2.3-0.3,3.2-0.6C20.1,9.4,49.1,0,50.3,0
		c6.2,0,11.1,8.9,11.1,20.3s-4.9,20.3-11.1,20.3c-0.1,0-0.1,0-0.2,0l-14.4-4.4l0,2.5C35.7,40.6,34.4,42,32.6,42z M10,26.5
		c0.1,0,0.1,0,0.2,0c0.3,0.1,5.1,1.6,5.5,1.7c0.3,0.1,0.5,0.4,0.5,0.7V33c0,1.1,0.6,2.5,1.8,2.9l14.1,4.5c0.2,0.1,0.4,0.1,0.6,0.1
		c1.1,0,1.6-1,1.6-1.8l0-3.6c0-0.2,0.1-0.5,0.3-0.6c0.2-0.1,0.4-0.2,0.7-0.1l15.3,4.7c5.2-0.1,9.4-8.5,9.4-18.8
		c0-10.4-4.3-18.8-9.6-18.8c-1.3,0.2-23.8,7.4-38.6,12.2C10.7,14,9,14.3,8,14.3H4.4c-1.4,0-2.9,2.4-2.9,6.1c0,3.6,1.5,6.1,2.9,6.1
		l2.1,0.1l1.5,0c0,0,0,0,0,0c0.8,0,1.4,0,1.8-0.1C9.9,26.5,10,26.5,10,26.5z"/>
                                    <path fill="#adb8c1" d="M50.3,40.6c-6.2,0-11.1-8.9-11.1-20.3S44.1,0,50.3,0c0.4,0,0.8,0.3,0.8,0.8s-0.3,0.8-0.8,0.8
		c-5.3,0-9.6,8.4-9.6,18.8s4.3,18.8,9.6,18.8c0.4,0,0.8,0.3,0.8,0.8S50.7,40.6,50.3,40.6z"/>
                                    <path fill="#adb8c1" d="M29.4,34.3c-0.1,0-0.1,0-0.2,0l-9.6-3l0.5-1.4l0,0l9.6,3c0.4,0.1,0.6,0.5,0.5,0.9C30,34.1,29.7,34.3,29.4,34.3
		z"/>
</svg>

                            </div>
                            <div class="tizers-item-text">
                                Своя доставка
                            </div>
                        </a>
                        <a href="javascript:;" class="tizers-item-child">
                            <div class="tizers-item-img">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     viewBox="0 0 75.8 42" xml:space="preserve">
	<path fill="#adb8c1" d="M75,14.3H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,14.3,75,14.3z"/>
                                    <path fill="#adb8c1" d="M75,22.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,22.4,75,22.4z"/>
                                    <path fill="#adb8c1" d="M75,30.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,30.4,75,30.4z"/>
                                    <path fill="#adb8c1" d="M32.6,42c-0.4,0-0.7-0.1-1-0.2l-14.1-4.5c-1.7-0.5-2.9-2.3-2.9-4.3v-3.5c-1.3-0.4-4.1-1.3-4.7-1.5
		c-0.5,0.1-1.2,0.1-1.9,0.1H6.4L4.3,28h0C1.9,28,0,24.7,0,20.4s1.9-7.6,4.4-7.6H8c0.8,0,2.3-0.3,3.2-0.6C20.1,9.4,49.1,0,50.3,0
		c6.2,0,11.1,8.9,11.1,20.3s-4.9,20.3-11.1,20.3c-0.1,0-0.1,0-0.2,0l-14.4-4.4l0,2.5C35.7,40.6,34.4,42,32.6,42z M10,26.5
		c0.1,0,0.1,0,0.2,0c0.3,0.1,5.1,1.6,5.5,1.7c0.3,0.1,0.5,0.4,0.5,0.7V33c0,1.1,0.6,2.5,1.8,2.9l14.1,4.5c0.2,0.1,0.4,0.1,0.6,0.1
		c1.1,0,1.6-1,1.6-1.8l0-3.6c0-0.2,0.1-0.5,0.3-0.6c0.2-0.1,0.4-0.2,0.7-0.1l15.3,4.7c5.2-0.1,9.4-8.5,9.4-18.8
		c0-10.4-4.3-18.8-9.6-18.8c-1.3,0.2-23.8,7.4-38.6,12.2C10.7,14,9,14.3,8,14.3H4.4c-1.4,0-2.9,2.4-2.9,6.1c0,3.6,1.5,6.1,2.9,6.1
		l2.1,0.1l1.5,0c0,0,0,0,0,0c0.8,0,1.4,0,1.8-0.1C9.9,26.5,10,26.5,10,26.5z"/>
                                    <path fill="#adb8c1" d="M50.3,40.6c-6.2,0-11.1-8.9-11.1-20.3S44.1,0,50.3,0c0.4,0,0.8,0.3,0.8,0.8s-0.3,0.8-0.8,0.8
		c-5.3,0-9.6,8.4-9.6,18.8s4.3,18.8,9.6,18.8c0.4,0,0.8,0.3,0.8,0.8S50.7,40.6,50.3,40.6z"/>
                                    <path fill="#adb8c1" d="M29.4,34.3c-0.1,0-0.1,0-0.2,0l-9.6-3l0.5-1.4l0,0l9.6,3c0.4,0.1,0.6,0.5,0.5,0.9C30,34.1,29.7,34.3,29.4,34.3
		z"/>
</svg>

                            </div>
                            <div class="tizers-item-text">
                                Огромный выбор
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tizers-item">
                    <h3><a href="javascript:;">Услуги</a></h3>
                    <div class="tizers-item-content">
                        <a href="javascript:;" class="tizers-item-child border-right border-bottom">
                            <div class="tizers-item-img">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     viewBox="0 0 75.8 42" xml:space="preserve">
	<path fill="#adb8c1" d="M75,14.3H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,14.3,75,14.3z"/>
                                    <path fill="#adb8c1" d="M75,22.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,22.4,75,22.4z"/>
                                    <path fill="#adb8c1" d="M75,30.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,30.4,75,30.4z"/>
                                    <path fill="#adb8c1" d="M32.6,42c-0.4,0-0.7-0.1-1-0.2l-14.1-4.5c-1.7-0.5-2.9-2.3-2.9-4.3v-3.5c-1.3-0.4-4.1-1.3-4.7-1.5
		c-0.5,0.1-1.2,0.1-1.9,0.1H6.4L4.3,28h0C1.9,28,0,24.7,0,20.4s1.9-7.6,4.4-7.6H8c0.8,0,2.3-0.3,3.2-0.6C20.1,9.4,49.1,0,50.3,0
		c6.2,0,11.1,8.9,11.1,20.3s-4.9,20.3-11.1,20.3c-0.1,0-0.1,0-0.2,0l-14.4-4.4l0,2.5C35.7,40.6,34.4,42,32.6,42z M10,26.5
		c0.1,0,0.1,0,0.2,0c0.3,0.1,5.1,1.6,5.5,1.7c0.3,0.1,0.5,0.4,0.5,0.7V33c0,1.1,0.6,2.5,1.8,2.9l14.1,4.5c0.2,0.1,0.4,0.1,0.6,0.1
		c1.1,0,1.6-1,1.6-1.8l0-3.6c0-0.2,0.1-0.5,0.3-0.6c0.2-0.1,0.4-0.2,0.7-0.1l15.3,4.7c5.2-0.1,9.4-8.5,9.4-18.8
		c0-10.4-4.3-18.8-9.6-18.8c-1.3,0.2-23.8,7.4-38.6,12.2C10.7,14,9,14.3,8,14.3H4.4c-1.4,0-2.9,2.4-2.9,6.1c0,3.6,1.5,6.1,2.9,6.1
		l2.1,0.1l1.5,0c0,0,0,0,0,0c0.8,0,1.4,0,1.8-0.1C9.9,26.5,10,26.5,10,26.5z"/>
                                    <path fill="#adb8c1" d="M50.3,40.6c-6.2,0-11.1-8.9-11.1-20.3S44.1,0,50.3,0c0.4,0,0.8,0.3,0.8,0.8s-0.3,0.8-0.8,0.8
		c-5.3,0-9.6,8.4-9.6,18.8s4.3,18.8,9.6,18.8c0.4,0,0.8,0.3,0.8,0.8S50.7,40.6,50.3,40.6z"/>
                                    <path fill="#adb8c1" d="M29.4,34.3c-0.1,0-0.1,0-0.2,0l-9.6-3l0.5-1.4l0,0l9.6,3c0.4,0.1,0.6,0.5,0.5,0.9C30,34.1,29.7,34.3,29.4,34.3
		z"/>
</svg>

                            </div>
                            <div class="tizers-item-text">
                                Тест-драйв
                            </div>
                        </a>
                        <a href="javascript:;" class="tizers-item-child border-bottom">
                            <div class="tizers-item-img">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     viewBox="0 0 75.8 42" xml:space="preserve">
	<path fill="#adb8c1" d="M75,14.3H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,14.3,75,14.3z"/>
                                    <path fill="#adb8c1" d="M75,22.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,22.4,75,22.4z"/>
                                    <path fill="#adb8c1" d="M75,30.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,30.4,75,30.4z"/>
                                    <path fill="#adb8c1" d="M32.6,42c-0.4,0-0.7-0.1-1-0.2l-14.1-4.5c-1.7-0.5-2.9-2.3-2.9-4.3v-3.5c-1.3-0.4-4.1-1.3-4.7-1.5
		c-0.5,0.1-1.2,0.1-1.9,0.1H6.4L4.3,28h0C1.9,28,0,24.7,0,20.4s1.9-7.6,4.4-7.6H8c0.8,0,2.3-0.3,3.2-0.6C20.1,9.4,49.1,0,50.3,0
		c6.2,0,11.1,8.9,11.1,20.3s-4.9,20.3-11.1,20.3c-0.1,0-0.1,0-0.2,0l-14.4-4.4l0,2.5C35.7,40.6,34.4,42,32.6,42z M10,26.5
		c0.1,0,0.1,0,0.2,0c0.3,0.1,5.1,1.6,5.5,1.7c0.3,0.1,0.5,0.4,0.5,0.7V33c0,1.1,0.6,2.5,1.8,2.9l14.1,4.5c0.2,0.1,0.4,0.1,0.6,0.1
		c1.1,0,1.6-1,1.6-1.8l0-3.6c0-0.2,0.1-0.5,0.3-0.6c0.2-0.1,0.4-0.2,0.7-0.1l15.3,4.7c5.2-0.1,9.4-8.5,9.4-18.8
		c0-10.4-4.3-18.8-9.6-18.8c-1.3,0.2-23.8,7.4-38.6,12.2C10.7,14,9,14.3,8,14.3H4.4c-1.4,0-2.9,2.4-2.9,6.1c0,3.6,1.5,6.1,2.9,6.1
		l2.1,0.1l1.5,0c0,0,0,0,0,0c0.8,0,1.4,0,1.8-0.1C9.9,26.5,10,26.5,10,26.5z"/>
                                    <path fill="#adb8c1" d="M50.3,40.6c-6.2,0-11.1-8.9-11.1-20.3S44.1,0,50.3,0c0.4,0,0.8,0.3,0.8,0.8s-0.3,0.8-0.8,0.8
		c-5.3,0-9.6,8.4-9.6,18.8s4.3,18.8,9.6,18.8c0.4,0,0.8,0.3,0.8,0.8S50.7,40.6,50.3,40.6z"/>
                                    <path fill="#adb8c1" d="M29.4,34.3c-0.1,0-0.1,0-0.2,0l-9.6-3l0.5-1.4l0,0l9.6,3c0.4,0.1,0.6,0.5,0.5,0.9C30,34.1,29.7,34.3,29.4,34.3
		z"/>
</svg>

                            </div>
                            <div class="tizers-item-text">
                                Бесплатный дизайн-проект
                            </div>
                        </a>
                        <a href="javascript:;" class="tizers-item-child border-right">
                            <div class="tizers-item-img">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     viewBox="0 0 75.8 42" xml:space="preserve">
	<path fill="#adb8c1" d="M75,14.3H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,14.3,75,14.3z"/>
                                    <path fill="#adb8c1" d="M75,22.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,22.4,75,22.4z"/>
                                    <path fill="#adb8c1" d="M75,30.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,30.4,75,30.4z"/>
                                    <path fill="#adb8c1" d="M32.6,42c-0.4,0-0.7-0.1-1-0.2l-14.1-4.5c-1.7-0.5-2.9-2.3-2.9-4.3v-3.5c-1.3-0.4-4.1-1.3-4.7-1.5
		c-0.5,0.1-1.2,0.1-1.9,0.1H6.4L4.3,28h0C1.9,28,0,24.7,0,20.4s1.9-7.6,4.4-7.6H8c0.8,0,2.3-0.3,3.2-0.6C20.1,9.4,49.1,0,50.3,0
		c6.2,0,11.1,8.9,11.1,20.3s-4.9,20.3-11.1,20.3c-0.1,0-0.1,0-0.2,0l-14.4-4.4l0,2.5C35.7,40.6,34.4,42,32.6,42z M10,26.5
		c0.1,0,0.1,0,0.2,0c0.3,0.1,5.1,1.6,5.5,1.7c0.3,0.1,0.5,0.4,0.5,0.7V33c0,1.1,0.6,2.5,1.8,2.9l14.1,4.5c0.2,0.1,0.4,0.1,0.6,0.1
		c1.1,0,1.6-1,1.6-1.8l0-3.6c0-0.2,0.1-0.5,0.3-0.6c0.2-0.1,0.4-0.2,0.7-0.1l15.3,4.7c5.2-0.1,9.4-8.5,9.4-18.8
		c0-10.4-4.3-18.8-9.6-18.8c-1.3,0.2-23.8,7.4-38.6,12.2C10.7,14,9,14.3,8,14.3H4.4c-1.4,0-2.9,2.4-2.9,6.1c0,3.6,1.5,6.1,2.9,6.1
		l2.1,0.1l1.5,0c0,0,0,0,0,0c0.8,0,1.4,0,1.8-0.1C9.9,26.5,10,26.5,10,26.5z"/>
                                    <path fill="#adb8c1" d="M50.3,40.6c-6.2,0-11.1-8.9-11.1-20.3S44.1,0,50.3,0c0.4,0,0.8,0.3,0.8,0.8s-0.3,0.8-0.8,0.8
		c-5.3,0-9.6,8.4-9.6,18.8s4.3,18.8,9.6,18.8c0.4,0,0.8,0.3,0.8,0.8S50.7,40.6,50.3,40.6z"/>
                                    <path fill="#adb8c1" d="M29.4,34.3c-0.1,0-0.1,0-0.2,0l-9.6-3l0.5-1.4l0,0l9.6,3c0.4,0.1,0.6,0.5,0.5,0.9C30,34.1,29.7,34.3,29.4,34.3
		z"/>
</svg>

                            </div>
                            <div class="tizers-item-text">
                                Вызов менеджера
                            </div>
                        </a>
                        <a href="javascript:;" class="tizers-item-child">
                            <div class="tizers-item-img">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     viewBox="0 0 75.8 42" xml:space="preserve">
	<path fill="#adb8c1" d="M75,14.3H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,14.3,75,14.3z"/>
                                    <path fill="#adb8c1" d="M75,22.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,22.4,75,22.4z"/>
                                    <path fill="#adb8c1" d="M75,30.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,30.4,75,30.4z"/>
                                    <path fill="#adb8c1" d="M32.6,42c-0.4,0-0.7-0.1-1-0.2l-14.1-4.5c-1.7-0.5-2.9-2.3-2.9-4.3v-3.5c-1.3-0.4-4.1-1.3-4.7-1.5
		c-0.5,0.1-1.2,0.1-1.9,0.1H6.4L4.3,28h0C1.9,28,0,24.7,0,20.4s1.9-7.6,4.4-7.6H8c0.8,0,2.3-0.3,3.2-0.6C20.1,9.4,49.1,0,50.3,0
		c6.2,0,11.1,8.9,11.1,20.3s-4.9,20.3-11.1,20.3c-0.1,0-0.1,0-0.2,0l-14.4-4.4l0,2.5C35.7,40.6,34.4,42,32.6,42z M10,26.5
		c0.1,0,0.1,0,0.2,0c0.3,0.1,5.1,1.6,5.5,1.7c0.3,0.1,0.5,0.4,0.5,0.7V33c0,1.1,0.6,2.5,1.8,2.9l14.1,4.5c0.2,0.1,0.4,0.1,0.6,0.1
		c1.1,0,1.6-1,1.6-1.8l0-3.6c0-0.2,0.1-0.5,0.3-0.6c0.2-0.1,0.4-0.2,0.7-0.1l15.3,4.7c5.2-0.1,9.4-8.5,9.4-18.8
		c0-10.4-4.3-18.8-9.6-18.8c-1.3,0.2-23.8,7.4-38.6,12.2C10.7,14,9,14.3,8,14.3H4.4c-1.4,0-2.9,2.4-2.9,6.1c0,3.6,1.5,6.1,2.9,6.1
		l2.1,0.1l1.5,0c0,0,0,0,0,0c0.8,0,1.4,0,1.8-0.1C9.9,26.5,10,26.5,10,26.5z"/>
                                    <path fill="#adb8c1" d="M50.3,40.6c-6.2,0-11.1-8.9-11.1-20.3S44.1,0,50.3,0c0.4,0,0.8,0.3,0.8,0.8s-0.3,0.8-0.8,0.8
		c-5.3,0-9.6,8.4-9.6,18.8s4.3,18.8,9.6,18.8c0.4,0,0.8,0.3,0.8,0.8S50.7,40.6,50.3,40.6z"/>
                                    <path fill="#adb8c1" d="M29.4,34.3c-0.1,0-0.1,0-0.2,0l-9.6-3l0.5-1.4l0,0l9.6,3c0.4,0.1,0.6,0.5,0.5,0.9C30,34.1,29.7,34.3,29.4,34.3
		z"/>
</svg>

                            </div>
                            <div class="tizers-item-text">
                                Защита покупки
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="tizers-item">
                    <h3><a href="javascript:;">Сервис</a></h3>
                    <div class="tizers-item-content">
                        <a href="javascript:;" class="tizers-item-child border-right border-bottom">
                            <div class="tizers-item-img">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     viewBox="0 0 75.8 42" xml:space="preserve">
	<path fill="#adb8c1" d="M75,14.3H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,14.3,75,14.3z"/>
                                    <path fill="#adb8c1" d="M75,22.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,22.4,75,22.4z"/>
                                    <path fill="#adb8c1" d="M75,30.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,30.4,75,30.4z"/>
                                    <path fill="#adb8c1" d="M32.6,42c-0.4,0-0.7-0.1-1-0.2l-14.1-4.5c-1.7-0.5-2.9-2.3-2.9-4.3v-3.5c-1.3-0.4-4.1-1.3-4.7-1.5
		c-0.5,0.1-1.2,0.1-1.9,0.1H6.4L4.3,28h0C1.9,28,0,24.7,0,20.4s1.9-7.6,4.4-7.6H8c0.8,0,2.3-0.3,3.2-0.6C20.1,9.4,49.1,0,50.3,0
		c6.2,0,11.1,8.9,11.1,20.3s-4.9,20.3-11.1,20.3c-0.1,0-0.1,0-0.2,0l-14.4-4.4l0,2.5C35.7,40.6,34.4,42,32.6,42z M10,26.5
		c0.1,0,0.1,0,0.2,0c0.3,0.1,5.1,1.6,5.5,1.7c0.3,0.1,0.5,0.4,0.5,0.7V33c0,1.1,0.6,2.5,1.8,2.9l14.1,4.5c0.2,0.1,0.4,0.1,0.6,0.1
		c1.1,0,1.6-1,1.6-1.8l0-3.6c0-0.2,0.1-0.5,0.3-0.6c0.2-0.1,0.4-0.2,0.7-0.1l15.3,4.7c5.2-0.1,9.4-8.5,9.4-18.8
		c0-10.4-4.3-18.8-9.6-18.8c-1.3,0.2-23.8,7.4-38.6,12.2C10.7,14,9,14.3,8,14.3H4.4c-1.4,0-2.9,2.4-2.9,6.1c0,3.6,1.5,6.1,2.9,6.1
		l2.1,0.1l1.5,0c0,0,0,0,0,0c0.8,0,1.4,0,1.8-0.1C9.9,26.5,10,26.5,10,26.5z"/>
                                    <path fill="#adb8c1" d="M50.3,40.6c-6.2,0-11.1-8.9-11.1-20.3S44.1,0,50.3,0c0.4,0,0.8,0.3,0.8,0.8s-0.3,0.8-0.8,0.8
		c-5.3,0-9.6,8.4-9.6,18.8s4.3,18.8,9.6,18.8c0.4,0,0.8,0.3,0.8,0.8S50.7,40.6,50.3,40.6z"/>
                                    <path fill="#adb8c1" d="M29.4,34.3c-0.1,0-0.1,0-0.2,0l-9.6-3l0.5-1.4l0,0l9.6,3c0.4,0.1,0.6,0.5,0.5,0.9C30,34.1,29.7,34.3,29.4,34.3
		z"/>
</svg>

                            </div>
                            <div class="tizers-item-text">
                                Гарантия 10 лет
                            </div>
                        </a>
                        <a href="javascript:;" class="tizers-item-child border-bottom">
                            <div class="tizers-item-img">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     viewBox="0 0 75.8 42" xml:space="preserve">
	<path fill="#adb8c1" d="M75,14.3H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,14.3,75,14.3z"/>
                                    <path fill="#adb8c1" d="M75,22.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,22.4,75,22.4z"/>
                                    <path fill="#adb8c1" d="M75,30.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,30.4,75,30.4z"/>
                                    <path fill="#adb8c1" d="M32.6,42c-0.4,0-0.7-0.1-1-0.2l-14.1-4.5c-1.7-0.5-2.9-2.3-2.9-4.3v-3.5c-1.3-0.4-4.1-1.3-4.7-1.5
		c-0.5,0.1-1.2,0.1-1.9,0.1H6.4L4.3,28h0C1.9,28,0,24.7,0,20.4s1.9-7.6,4.4-7.6H8c0.8,0,2.3-0.3,3.2-0.6C20.1,9.4,49.1,0,50.3,0
		c6.2,0,11.1,8.9,11.1,20.3s-4.9,20.3-11.1,20.3c-0.1,0-0.1,0-0.2,0l-14.4-4.4l0,2.5C35.7,40.6,34.4,42,32.6,42z M10,26.5
		c0.1,0,0.1,0,0.2,0c0.3,0.1,5.1,1.6,5.5,1.7c0.3,0.1,0.5,0.4,0.5,0.7V33c0,1.1,0.6,2.5,1.8,2.9l14.1,4.5c0.2,0.1,0.4,0.1,0.6,0.1
		c1.1,0,1.6-1,1.6-1.8l0-3.6c0-0.2,0.1-0.5,0.3-0.6c0.2-0.1,0.4-0.2,0.7-0.1l15.3,4.7c5.2-0.1,9.4-8.5,9.4-18.8
		c0-10.4-4.3-18.8-9.6-18.8c-1.3,0.2-23.8,7.4-38.6,12.2C10.7,14,9,14.3,8,14.3H4.4c-1.4,0-2.9,2.4-2.9,6.1c0,3.6,1.5,6.1,2.9,6.1
		l2.1,0.1l1.5,0c0,0,0,0,0,0c0.8,0,1.4,0,1.8-0.1C9.9,26.5,10,26.5,10,26.5z"/>
                                    <path fill="#adb8c1" d="M50.3,40.6c-6.2,0-11.1-8.9-11.1-20.3S44.1,0,50.3,0c0.4,0,0.8,0.3,0.8,0.8s-0.3,0.8-0.8,0.8
		c-5.3,0-9.6,8.4-9.6,18.8s4.3,18.8,9.6,18.8c0.4,0,0.8,0.3,0.8,0.8S50.7,40.6,50.3,40.6z"/>
                                    <path fill="#adb8c1" d="M29.4,34.3c-0.1,0-0.1,0-0.2,0l-9.6-3l0.5-1.4l0,0l9.6,3c0.4,0.1,0.6,0.5,0.5,0.9C30,34.1,29.7,34.3,29.4,34.3
		z"/>
</svg>

                            </div>
                            <div class="tizers-item-text">
                                Личный менеджер
                            </div>
                        </a>
                        <a href="javascript:;" class="tizers-item-child border-right">
                            <div class="tizers-item-img">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     viewBox="0 0 75.8 42" xml:space="preserve">
	<path fill="#adb8c1" d="M75,14.3H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,14.3,75,14.3z"/>
                                    <path fill="#adb8c1" d="M75,22.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,22.4,75,22.4z"/>
                                    <path fill="#adb8c1" d="M75,30.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,30.4,75,30.4z"/>
                                    <path fill="#adb8c1" d="M32.6,42c-0.4,0-0.7-0.1-1-0.2l-14.1-4.5c-1.7-0.5-2.9-2.3-2.9-4.3v-3.5c-1.3-0.4-4.1-1.3-4.7-1.5
		c-0.5,0.1-1.2,0.1-1.9,0.1H6.4L4.3,28h0C1.9,28,0,24.7,0,20.4s1.9-7.6,4.4-7.6H8c0.8,0,2.3-0.3,3.2-0.6C20.1,9.4,49.1,0,50.3,0
		c6.2,0,11.1,8.9,11.1,20.3s-4.9,20.3-11.1,20.3c-0.1,0-0.1,0-0.2,0l-14.4-4.4l0,2.5C35.7,40.6,34.4,42,32.6,42z M10,26.5
		c0.1,0,0.1,0,0.2,0c0.3,0.1,5.1,1.6,5.5,1.7c0.3,0.1,0.5,0.4,0.5,0.7V33c0,1.1,0.6,2.5,1.8,2.9l14.1,4.5c0.2,0.1,0.4,0.1,0.6,0.1
		c1.1,0,1.6-1,1.6-1.8l0-3.6c0-0.2,0.1-0.5,0.3-0.6c0.2-0.1,0.4-0.2,0.7-0.1l15.3,4.7c5.2-0.1,9.4-8.5,9.4-18.8
		c0-10.4-4.3-18.8-9.6-18.8c-1.3,0.2-23.8,7.4-38.6,12.2C10.7,14,9,14.3,8,14.3H4.4c-1.4,0-2.9,2.4-2.9,6.1c0,3.6,1.5,6.1,2.9,6.1
		l2.1,0.1l1.5,0c0,0,0,0,0,0c0.8,0,1.4,0,1.8-0.1C9.9,26.5,10,26.5,10,26.5z"/>
                                    <path fill="#adb8c1" d="M50.3,40.6c-6.2,0-11.1-8.9-11.1-20.3S44.1,0,50.3,0c0.4,0,0.8,0.3,0.8,0.8s-0.3,0.8-0.8,0.8
		c-5.3,0-9.6,8.4-9.6,18.8s4.3,18.8,9.6,18.8c0.4,0,0.8,0.3,0.8,0.8S50.7,40.6,50.3,40.6z"/>
                                    <path fill="#adb8c1" d="M29.4,34.3c-0.1,0-0.1,0-0.2,0l-9.6-3l0.5-1.4l0,0l9.6,3c0.4,0.1,0.6,0.5,0.5,0.9C30,34.1,29.7,34.3,29.4,34.3
		z"/>
</svg>

                            </div>
                            <div class="tizers-item-text">
                                Онлайн планировщик
                            </div>
                        </a>
                        <a href="javascript:;" class="tizers-item-child">
                            <div class="tizers-item-img">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     viewBox="0 0 75.8 42" xml:space="preserve">
	<path fill="#adb8c1" d="M75,14.3H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,14.3,75,14.3z"/>
                                    <path fill="#adb8c1" d="M75,22.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,22.4,75,22.4z"/>
                                    <path fill="#adb8c1" d="M75,30.4H64.7c-0.4,0-0.8-0.3-0.8-0.8s0.3-0.8,0.8-0.8H75c0.4,0,0.8,0.3,0.8,0.8S75.4,30.4,75,30.4z"/>
                                    <path fill="#adb8c1" d="M32.6,42c-0.4,0-0.7-0.1-1-0.2l-14.1-4.5c-1.7-0.5-2.9-2.3-2.9-4.3v-3.5c-1.3-0.4-4.1-1.3-4.7-1.5
		c-0.5,0.1-1.2,0.1-1.9,0.1H6.4L4.3,28h0C1.9,28,0,24.7,0,20.4s1.9-7.6,4.4-7.6H8c0.8,0,2.3-0.3,3.2-0.6C20.1,9.4,49.1,0,50.3,0
		c6.2,0,11.1,8.9,11.1,20.3s-4.9,20.3-11.1,20.3c-0.1,0-0.1,0-0.2,0l-14.4-4.4l0,2.5C35.7,40.6,34.4,42,32.6,42z M10,26.5
		c0.1,0,0.1,0,0.2,0c0.3,0.1,5.1,1.6,5.5,1.7c0.3,0.1,0.5,0.4,0.5,0.7V33c0,1.1,0.6,2.5,1.8,2.9l14.1,4.5c0.2,0.1,0.4,0.1,0.6,0.1
		c1.1,0,1.6-1,1.6-1.8l0-3.6c0-0.2,0.1-0.5,0.3-0.6c0.2-0.1,0.4-0.2,0.7-0.1l15.3,4.7c5.2-0.1,9.4-8.5,9.4-18.8
		c0-10.4-4.3-18.8-9.6-18.8c-1.3,0.2-23.8,7.4-38.6,12.2C10.7,14,9,14.3,8,14.3H4.4c-1.4,0-2.9,2.4-2.9,6.1c0,3.6,1.5,6.1,2.9,6.1
		l2.1,0.1l1.5,0c0,0,0,0,0,0c0.8,0,1.4,0,1.8-0.1C9.9,26.5,10,26.5,10,26.5z"/>
                                    <path fill="#adb8c1" d="M50.3,40.6c-6.2,0-11.1-8.9-11.1-20.3S44.1,0,50.3,0c0.4,0,0.8,0.3,0.8,0.8s-0.3,0.8-0.8,0.8
		c-5.3,0-9.6,8.4-9.6,18.8s4.3,18.8,9.6,18.8c0.4,0,0.8,0.3,0.8,0.8S50.7,40.6,50.3,40.6z"/>
                                    <path fill="#adb8c1" d="M29.4,34.3c-0.1,0-0.1,0-0.2,0l-9.6-3l0.5-1.4l0,0l9.6,3c0.4,0.1,0.6,0.5,0.5,0.9C30,34.1,29.7,34.3,29.4,34.3
		z"/>
</svg>

                            </div>
                            <div class="tizers-item-text">
                                Комплексный сервис
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="maxwidth-theme">
    <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR."include/mainpage/comp_catalog_sections.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    );?>
</div>





<!--<div class="grey_block small-padding">
    <div class="maxwidth-theme">
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

    </div>
    <hr>
</div>
-->

<div class="maxwidth-theme">
    <?/*$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR."include/mainpage/comp_tizers.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    );*/?>
    <?/*$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR."include/mainpage/comp_catalog_sections.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    );*/?>
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
    <?/*$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR."include/mainpage/comp_catalog_sections.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    );*/?>

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
</div>-->


<div class="grey_block">
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
</div>


<!--БЛОК КОНТАКТОВ-->
<div class="maxwidth-theme">
    <div class="contacts-block">
        <div class="row">
            <div class="col-md-4">
                <div class="contacts-block-item">
                    <p>Остались вопросы?</p>
                    <a href="javascript:;">Получить консультацию</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contacts-block-item">
                    <p>Контактный телефон</p>
                    <?CNext::ShowHeaderPhones();?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contacts-block-item">
                    <p>Адреса салонов</p>
                    <a href="javascript:;">Посмотреть на карте</a>
                </div>
            </div>
        </div>

    </div>
</div>


<?/*if($isShowBlog):*/?><!--
    <div class="maxwidth-theme">
        <?/*$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => SITE_DIR."include/mainpage/comp_blog.php",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => "standard.php"
            ),
            false
        );*/?>
    </div>
--><?/*endif;*/?>



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


<div class="maxwidth-theme">
    <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
        array(
            "COMPONENT_TEMPLATE" => ".default",
            "PATH" => SITE_DIR."include/mainpage/comp_bottom_banners.php",
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "",
            "AREA_FILE_RECURSIVE" => "Y",
            "EDIT_TEMPLATE" => "standard.php"
        ),
        false
    );?>
</div>


