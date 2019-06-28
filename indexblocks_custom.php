<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?global $isShowSale, $isShowCatalogSections, $isShowCatalogElements, $isShowMiddleAdvBottomBanner, $isShowBlog;?>

<div class="first-block">
    <div class="maxwidth-theme">
        <!--<div class="row">-->
            <? $rsGroups = CIBlockSection::GetList (
                Array("SORT"=>"ASC"),
                Array("IBLOCK_ID"=>"56", "ACTIVE" => "Y", "UF_CITY_BNTS" => $_COOKIE['current_region']),
                false,
                Array("IBLOCK_ID", "ID", "NAME", "UF_*")
            );

            /*$cntMdClass = $rsGroups->Fetch() ? 9 : 12;*/?>
            <div class="first-block-slider">
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
            </div>


            <div class="first-right-block">
                <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
                        array(
                            "COMPONENT_TEMPLATE" => ".default",
                            "PATH" => SITE_DIR."include/mainpage/comp_firstblock_btns.php",
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "",
                            "AREA_FILE_RECURSIVE" => "Y",
                            "EDIT_TEMPLATE" => "standard.php"
                        ),
                        false
                    );?>
                </div>


            </div>
        <!--</div>-->
    </div>


</div>






<div class="what_do-block">
    <div class="grey_block">
        <div class="maxwidth-theme">

            <h3>Что вы хотите сделать?</h3>
            <div class="row">
                <div class="col-sm-2 col-sm-offset-1">
                    <a href="<?=SITE_DIR ?>services/test-drayv/" class="what_do-item">
                        <div class="what_do-item-icon">
                            <svg height="35" version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 37.066 26.266" style="enable-background:new 0 0 37.066 26.266;" xml:space="preserve">
<style type="text/css">
    .st0{fill:#4C4E54;}
</style>
                                <g>
                                    <polygon class="st0" points="11.527,0.271 5.617,0.271 5.617,0.975 8.052,0.975 8.052,9.5 9.078,9.5 9.078,0.975 11.527,0.975 	"/>
                                    <polygon class="st0" points="17.537,5.068 17.537,4.363 14.001,4.363 14.001,0.975 18.061,0.975 18.061,0.271 12.976,0.271
		12.976,9.5 18.1,9.5 18.1,8.795 14.001,8.795 14.001,5.068 	"/>
                                    <path class="st0" d="M22.219,0.133c-0.883,0-1.568,0.293-2.095,0.898c-0.525,0.601-0.791,1.455-0.791,2.538v2.646
		c0,1.083,0.269,1.934,0.8,2.531c0.526,0.592,1.241,0.892,2.126,0.892c0.87,0,1.549-0.247,2.019-0.736
		c0.452-0.469,0.692-1.139,0.715-1.992h-0.982c-0.026,0.671-0.165,1.158-0.426,1.484c-0.284,0.357-0.731,0.538-1.327,0.538
		c-0.609,0-1.088-0.245-1.424-0.728c-0.325-0.465-0.489-1.137-0.489-1.995V3.541c0-0.845,0.161-1.509,0.478-1.974
		c0.33-0.484,0.8-0.729,1.396-0.729c0.609,0,1.065,0.186,1.356,0.552c0.263,0.33,0.411,0.829,0.441,1.484h0.975
		c-0.031-0.881-0.275-1.56-0.726-2.02C23.795,0.376,23.107,0.133,22.219,0.133z"/>
                                    <polygon class="st0" points="31.765,0.271 25.854,0.271 25.854,0.975 28.29,0.975 28.29,9.5 29.316,9.5 29.316,0.975 31.765,0.975
			"/>
                                    <path class="st0" d="M7.715,26.126l0.113-3.029H6.826v-8.524H2.099l-0.195,3.556C1.87,19.506,1.732,20.6,1.495,21.377
		c-0.243,0.794-0.504,1.34-0.802,1.67l-0.045,0.05H0.097l0.125,3.036h0.894v-2.331h5.692v2.324H7.715z M5.807,23.097H1.676
		l0.145-0.232c0.303-0.486,0.558-1.133,0.757-1.924c0.199-0.795,0.32-1.749,0.359-2.834v-0.002l0.145-2.827h2.725V23.097z"/>
                                    <path class="st0" d="M14.318,19.287c0.476-0.494,0.717-1.162,0.717-1.985c0-0.818-0.242-1.485-0.717-1.982
		c-0.474-0.495-1.142-0.747-1.985-0.747H9.355v9.229h1.025v-3.772h1.952C13.176,20.031,13.845,19.781,14.318,19.287z M10.381,15.278
		h1.952c0.555,0,0.982,0.202,1.266,0.599c0.273,0.382,0.411,0.866,0.411,1.438c0,0.565-0.14,1.043-0.416,1.42
		c-0.287,0.392-0.711,0.591-1.262,0.591h-1.952V15.278z"/>
                                    <path class="st0" d="M20.16,21.393l0.694,2.41h1.029l-2.814-9.229H18.01l-2.84,9.229h1.029l0.694-2.41H20.16z M18.4,16.175h0.268
		l1.278,4.468h-2.832L18.4,16.175z"/>
                                    <g>
                                        <polygon class="st0" points="28.257,16.891 28.257,23.803 29.283,23.803 29.283,14.573 28.198,14.573 24.301,22.092
			24.307,21.477 24.307,14.573 23.281,14.573 23.281,23.803 24.366,23.803 28.262,16.281 		"/>
                                        <path class="st0" d="M26.298,12.845c-0.333,0-0.585-0.114-0.748-0.338c-0.127-0.174-0.202-0.391-0.223-0.645h-0.706
			c0.004,0.423,0.143,0.761,0.423,1.029c0.308,0.293,0.718,0.436,1.254,0.436c0.533,0,0.941-0.143,1.247-0.436
			c0.281-0.268,0.421-0.605,0.429-1.029H27.25c-0.021,0.253-0.095,0.47-0.222,0.645C26.864,12.731,26.619,12.845,26.298,12.845z"/>
                                    </g>
                                    <path class="st0" d="M36.262,23.153c0.46-0.428,0.694-1.066,0.694-1.895c0-0.54-0.131-1.016-0.391-1.413
		c-0.257-0.395-0.615-0.638-1.094-0.744l-0.484-0.107l0.461-0.183c0.379-0.15,0.668-0.381,0.883-0.705
		c0.211-0.32,0.318-0.696,0.318-1.117c0-0.817-0.23-1.409-0.703-1.81c-0.473-0.402-1.148-0.605-2.007-0.605h-2.506v9.229h2.879
		C35.142,23.803,35.798,23.584,36.262,23.153z M32.458,15.278h1.48c0.542,0,0.963,0.148,1.251,0.44
		c0.287,0.291,0.433,0.725,0.433,1.29c0,0.536-0.139,0.957-0.414,1.251c-0.279,0.296-0.662,0.446-1.139,0.446h-1.612V15.278z
		 M32.458,19.357h1.992c0.504,0,0.886,0.182,1.134,0.54c0.235,0.341,0.353,0.801,0.353,1.366c0,0.576-0.141,1.029-0.42,1.348
		c-0.284,0.323-0.689,0.487-1.204,0.487h-1.854V19.357z"/>
                                </g>
</svg>

                        </div>
                        <span>Заказать Тест-драйв в офис</span>
                    </a>
                </div>


                <div class="col-sm-2">
                    <a href="<?=SITE_DIR ?>services/dizayn-proekt/" class="what_do-item">
                        <div class="what_do-item-icon">
                            <svg height="35" version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 30.192 26.266" style="enable-background:new 0 0 30.192 26.266;" xml:space="preserve">
<style type="text/css">
    .st0{fill:#4C4E54;}
</style>
                                <g>
                                    <path class="st0" d="M16.629,14.04c-0.157-0.455-0.393-0.857-0.7-1.192c-0.309-0.337-0.698-0.608-1.161-0.805
		c-0.463-0.197-1.011-0.298-1.629-0.298H10.43v7.563h2.708c0.566,0,1.086-0.092,1.545-0.272v0c0.455-0.18,0.849-0.436,1.172-0.763
		c0.323-0.327,0.574-0.726,0.747-1.187c0.174-0.464,0.261-0.992,0.261-1.569C16.863,14.997,16.785,14.5,16.629,14.04z
		 M15.621,15.516c0,0.384-0.055,0.746-0.162,1.075c-0.109,0.334-0.269,0.627-0.476,0.873c-0.208,0.247-0.472,0.445-0.782,0.588
		c-0.312,0.141-0.669,0.212-1.064,0.212h-1.477v-5.476h1.477c0.387,0,0.74,0.068,1.05,0.2c0.311,0.133,0.576,0.325,0.789,0.571
		c0.209,0.24,0.372,0.533,0.483,0.869C15.566,14.758,15.621,15.124,15.621,15.516z"/>
                                    <path class="st0" d="M8.243,16.008c-0.254-0.321-0.97-0.723-0.97-0.723s0.314-0.213,0.452-0.301
		c0.16-0.101,0.303-0.232,0.424-0.388c0.118-0.153,0.209-0.326,0.271-0.512c0.063-0.188,0.095-0.389,0.095-0.6
		c0-0.28-0.058-0.535-0.172-0.758c-0.114-0.225-0.28-0.421-0.492-0.58c-0.214-0.163-0.474-0.292-0.772-0.383
		c-0.527-0.164-1.207-0.185-1.821-0.058c-0.261,0.052-0.51,0.128-0.74,0.226c-0.225,0.096-0.428,0.212-0.606,0.343
		c-0.124,0.092-0.233,0.194-0.324,0.303l-0.054,0.066l0.791,0.886l0.073-0.093c0.155-0.199,0.341-0.361,0.553-0.481
		c0.56-0.323,1.381-0.327,1.826-0.006c0.234,0.167,0.353,0.421,0.353,0.756c0,0.347-0.14,0.636-0.414,0.857
		c-0.268,0.217-0.646,0.327-1.125,0.327H5.348v0.909h0.21c0.573,0,1.01,0.111,1.299,0.331c0.298,0.225,0.45,0.549,0.45,0.963
		c0,0.4-0.133,0.703-0.394,0.899c-0.254,0.189-0.62,0.285-1.089,0.285c-0.41,0-0.76-0.07-1.04-0.209
		c-0.21-0.106-0.4-0.245-0.565-0.414l-0.077-0.08l-0.715,0.891l0.06,0.063c0.259,0.275,0.573,0.49,0.932,0.639
		c0.418,0.175,0.906,0.263,1.45,0.263c0.431,0,0.824-0.053,1.167-0.156c0.341-0.104,0.634-0.251,0.868-0.437
		c0.234-0.184,0.419-0.413,0.549-0.68c0.131-0.269,0.194-0.562,0.194-0.897C8.647,16.768,8.511,16.347,8.243,16.008z"/>
                                    <path class="st0" d="M10.315,0.114L0.107,5.207v20.908h19.72l10.185-5.092V0.114H10.315z M3.007,4.995l7.546-3.774h16.56
		l-7.547,3.774H3.007z M1.215,25.007V6.103h17.929v18.904H1.215z M28.905,1.564v18.774l-8.656,4.328V5.891L28.905,1.564z"/>
                                </g>
</svg>

                        </div>
                        <span>Получить 3D-проект бесплатно</span>
                    </a>
                </div>
                <div class="col-sm-2">
                    <a href="<?=SITE_DIR ?>services/vyezd-spetsialista/" class="what_do-item">
                        <div class="what_do-item-icon">
                            <svg  height="35" version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 34.005 26.445" style="enable-background:new 0 0 34.005 26.445;" xml:space="preserve">
<style type="text/css">
    .st0{fill:#4C4E54;}
</style>
                                <g>
                                    <path class="st0" d="M24.294,18.65h-5.167c-0.157,0-0.286,0.165-0.286,0.369s0.128,0.369,0.286,0.369h5.166
		c0.158,0,0.286-0.165,0.286-0.369S24.451,18.65,24.294,18.65z"/>
                                    <path class="st0" d="M23.186,7.305c0-0.204-0.128-0.369-0.285-0.369h-8.465c-0.157,0-0.286,0.165-0.286,0.369
		c0,0.204,0.128,0.369,0.286,0.369H22.9C23.058,7.673,23.186,7.508,23.186,7.305z"/>
                                    <path class="st0" d="M33.324,7.266c-0.7-0.7-1.839-0.7-2.54,0l-2.306,2.308V3.887c0-0.479-0.187-0.93-0.526-1.269l-1.869-1.869
		c-0.339-0.339-0.79-0.526-1.269-0.526H13.466c-0.99,0-1.796,0.806-1.796,1.796v6.68c-0.575-0.219-1.194-0.352-1.846-0.352
		c-2.869,0-5.196,2.327-5.196,5.18c0,2.853,2.327,5.196,5.196,5.196c0.653,0,1.271-0.134,1.846-0.354v0.65H6.669
		c-3.586,0-6.518,2.917-6.518,6.518c0,0.383,0.303,0.685,0.685,0.685h18.041c0.382,0,0.685-0.303,0.685-0.685
		c0-1.134-0.293-2.202-0.806-3.134h7.926c0.99,0,1.796-0.806,1.796-1.796v-5.952l4.846-4.85C34.024,9.105,34.024,7.966,33.324,7.266
		z M24.513,1.171h0.187l0.029,0c0.14-0.001,0.43-0.005,0.684,0.249l1.869,1.869c0.252,0.251,0.25,0.534,0.249,0.686l-0.001,0.185
		l-0.185,0.028h-2.83V1.171z M9.824,17.763c-2.335,0-4.235-1.9-4.235-4.236c0-2.335,1.9-4.235,4.235-4.235
		c0.662,0,1.287,0.157,1.846,0.429c0.345,0.168,0.663,0.38,0.948,0.631c0.881,0.777,1.441,1.91,1.441,3.175
		c0,1.265-0.56,2.398-1.441,3.175c-0.285,0.251-0.603,0.463-0.948,0.631C11.112,17.605,10.487,17.763,9.824,17.763z M1.099,25.262
		l0.062-0.465c0.367-2.747,2.735-4.818,5.507-4.818h5.002h0.948h0.425c1.437,0,2.762,0.559,3.758,1.476
		c0.309,0.284,0.586,0.601,0.825,0.949c0.479,0.698,0.806,1.51,0.924,2.394l0.062,0.464H1.099z M27.529,20.608
		c0,0.467-0.38,0.847-0.847,0.847h-8.564c-1.195-1.482-3.022-2.436-5.074-2.436h-0.425v-1.124c1.156-0.741,1.993-1.926,2.283-3.314
		h4.585c0.158,0,0.286-0.165,0.286-0.369s-0.128-0.369-0.285-0.369h-4.488c0.006-0.106,0.021-0.209,0.021-0.317
		c0-0.872-0.222-1.687-0.603-2.405c0.007,0.001,0.012,0.005,0.019,0.005h6.958c0.158,0,0.286-0.165,0.286-0.369
		c0-0.204-0.128-0.369-0.285-0.369h-6.959c-0.14,0-0.252,0.134-0.276,0.306c-0.403-0.609-0.924-1.133-1.541-1.526V2.019
		c0-0.467,0.38-0.848,0.848-0.848h10.098v3.491c0,0.261,0.213,0.474,0.474,0.474h3.49v5.388l-2.938,2.94
		c-0.053,0.053-0.091,0.115-0.115,0.185l-0.935,2.804c-0.058,0.171-0.014,0.357,0.115,0.485c0.128,0.128,0.314,0.173,0.485,0.115
		l2.803-0.935c0.07-0.023,0.133-0.062,0.184-0.114l0.4-0.4V20.608z M25.861,13.535l1.199,1.199l-0.562,0.534l-1.756,0.586
		l0.63-1.829L25.861,13.535z M27.54,14.253l-1.199-1.199l3.991-3.993l1.198,1.199L27.54,14.253z M32.653,9.135L31.84,9.949
		L30.641,8.75l0.813-0.814c0.33-0.33,0.868-0.331,1.199,0C32.983,8.267,32.983,8.804,32.653,9.135z"/>
                                </g>
</svg>

                        </div>
                        <span>Вызвать специалиста в офис</span>
                    </a>
                </div>
                <div class="col-sm-2">
                    <a href="" class="what_do-item animate-load" data-event="jqm" data-param-form_id="ASK" data-name="question">
                        <div class="what_do-item-icon">
                            <svg height="35" version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 25.716 26.266" style="enable-background:new 0 0 25.716 26.266;" xml:space="preserve">
<style type="text/css">
    .st0{fill:#4C4E54;}
</style>
                                <g>
                                    <g>
                                        <g>
                                            <path class="st0" d="M18.775,1.638c-1.827-0.967-3.862-1.476-5.929-1.481C5.81,0.155,0.105,5.858,0.104,12.894
				c-0.001,3.321,1.296,6.511,3.613,8.89L3.184,25.57c-0.046,0.273,0.137,0.533,0.411,0.579c0.126,0.021,0.256-0.006,0.362-0.077
				l2.892-1.918c6.218,3.293,13.928,0.922,17.22-5.296S24.992,4.93,18.775,1.638z M21.196,21.141
				c-2.204,2.235-5.211,3.494-8.35,3.495c-2.021,0.003-4.008-0.516-5.77-1.506c-0.155-0.09-0.347-0.09-0.502,0l-2.265,1.471
				l0.437-2.917c0.022-0.157-0.032-0.316-0.146-0.427C-0.014,16.706-0.066,9.276,4.485,4.661S16.466-0.006,21.08,4.545
				S25.747,16.526,21.196,21.141z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path class="st0" d="M15.723,17.405h-0.417V9.983c0-0.277-0.225-0.502-0.502-0.502h-4.334c-0.277,0-0.502,0.225-0.502,0.502
				v1.808c0,0.277,0.225,0.502,0.502,0.502h0.422v5.112h-0.422c-0.277,0-0.502,0.225-0.502,0.502v1.808
				c0,0.277,0.225,0.502,0.502,0.502h5.252c0.277,0,0.502-0.225,0.502-0.502v-1.808C16.225,17.63,16,17.405,15.723,17.405z
				 M10.973,19.213V18.41h0.422c0.277,0,0.502-0.225,0.502-0.502v-6.116c0-0.277-0.225-0.502-0.502-0.502h-0.422v-0.803h3.324v7.422
				c0,0.277,0.225,0.502,0.502,0.502h0.417l0.005,0.803L10.973,19.213L10.973,19.213z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path class="st0" d="M12.846,4.575c-1.162,0-2.104,0.942-2.104,2.104s0.942,2.104,2.104,2.104s2.104-0.942,2.104-2.104
				S14.008,4.575,12.846,4.575z M12.846,7.784c-0.607,0-1.1-0.492-1.1-1.1c-0.003-0.607,0.487-1.102,1.095-1.105
				c0.002,0,0.003,0,0.005,0v0.005c0.607,0,1.1,0.492,1.1,1.1S13.453,7.784,12.846,7.784z"/>
                                        </g>
                                    </g>
                                </g>
</svg>

                        </div>
                        <span>Получить консультацию эксперта</span>
                    </a>
                </div>


                <div class="col-sm-2">
                    <a href="<?=SITE_DIR ?>services/test-drayv/" class="what_do-item">
                        <div class="what_do-item-icon">

                            <svg height="35" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40.34 47.5">
                                <defs>
                                    <style>
                                        .svg5-1,.svg5-2{fill:none;stroke:#4C4E54;stroke-miterlimit:10;}
                                        .svg5-1{stroke-width:3px;}
                                        .svg5-2{stroke-width:2px;}
                                    </style>
                                </defs>
                                <title>checklist</title>
                                <g id="Layer_2" data-name="Layer 2">
                                    <g id="Layer_2-2" data-name="Layer 2">
                                        <rect class="svg5-1" x="1.5" y="1.5" width="37.34" height="44.5" rx="3" ry="3"/>
                                        <polyline class="svg5-2" points="6.64 10.56 9.57 13.31 13.77 8.75"/>
                                        <line class="svg5-2" x1="17.62" y1="12" x2="33.7" y2="12"/>
                                        <polyline class="svg5-2" points="6.64 19.91 9.57 22.66 13.77 18.1"/>
                                        <line class="svg5-2" x1="17.62" y1="21.35" x2="33.7" y2="21.35"/>
                                        <polyline class="svg5-2" points="6.64 29.27 9.57 32.02 13.77 27.46"/>
                                        <line class="svg5-2" x1="17.62" y1="30.71" x2="33.7" y2="30.71"/>
                                    </g>
                                </g>
                            </svg>


                        </div>
                        <span>Подготовить документацию под ФЗ-44 и ФЗ-223</span>
                    </a>
                </div>


            </div>
        </div>
    </div>
</div>






<div class="maxwidth-theme main-services">

        <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
                        array(
                            "COMPONENT_TEMPLATE" => ".default",
                            "PATH" => SITE_DIR."include/mainpage/comp_firstblock_services.php",
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "",
                            "AREA_FILE_RECURSIVE" => "Y",
                            "EDIT_TEMPLATE" => "standard.php"
                        ),
                        false
                    );?>

</div>



<div class="maxwidth-theme">
    <div class="popular-sections-mobile">
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

</div>

<!-- new! -->
<div class="maxwidth-theme">
        <div class="podborki-block">
            <div class="tabs tabs-product-categories">
                <ul class="categories_list">
                    <li class="cur"><span>Кресла и стулья</span></li>
                    <li><span>Офисная мебель</span></li>
                    <li><span>Офисная мебель</span></li>
                </ul>
            </div>
            <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
                array(
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => SITE_DIR."include/mainpage/comp_catalog_podborki.php",
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "",
                    "AREA_FILE_RECURSIVE" => "Y",
                    "EDIT_TEMPLATE" => "standard.php"
                ),
                false
            );?>
        </div>
    </div>
<!-- end new! -->

<div class="maxwidth-theme">
    <div class="best-block">
        <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => SITE_DIR."include/mainpage/comp_catalog_hit_best_custom.php",
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "",
		"AREA_FILE_RECURSIVE" => "Y",
		"EDIT_TEMPLATE" => "standard.php",
		"PRICE_CODE" => array(
			0 => "",
			1 => "",
		),
		"STORES" => array(
			0 => "",
			1 => "",
		),
		"STIKERS_PROP" => "HIT",
		"SALE_STIKER" => "SALE_TEXT",
		"SHOW_DISCOUNT_PERCENT_NUMBER" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
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
    <?$APPLICATION->IncludeComponent(
        "aspro:com.banners.next",
        "top_big_banners",
        array(
            "IBLOCK_TYPE" => "aspro_next_adv",
            "IBLOCK_ID" => "3",
            "TYPE_BANNERS_IBLOCK_ID" => "1",
            "SET_BANNER_TYPE_FROM_THEME" => "N",
            "NEWS_COUNT" => "10",
            "NEWS_COUNT2" => "2",
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
            "BANNER_TYPE_THEME" => "TOP_BIG_BANNER_ADV",
            "BANNER_TYPE_THEME_CHILD" => "TOP_SMALL_BANNER_ADV",
        ),
        false
    );?>
</div>




    <div class="maxwidth-theme">
        <div class="hit-block">
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

<!--<div class="maxwidth-theme">
    <div class="hit-block-mobile">
        <?/*$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => SITE_DIR."include/mainpage/comp_catalog_hit_custom.php",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => "standard.php"
            ),
            false
        );*/?>
    </div>
</div>-->


    <div class="maxwidth-theme">
        <div class="popular-series-block">
            <?$APPLICATION->IncludeComponent(
                "aspro:com.banners.next",
                "top_slider_banners_custom",
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
                    "BANNER_TYPE_THEME" => "TOP_POPULAR_SERIES",
                    "BANNER_TYPE_THEME_CHILD" => "TOP_POPULAR_SERIES",
                    "COMPONENT_TEMPLATE" => "top_slider_banners",
                    "FILTER_NAME" => "arRegionLink",
                    "CATALOG" => "/catalog/",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "TITLE_BLOCK" => "Популярные серии"
                ),
                false
            );?>
        </div>

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

<div class="maxwidth-theme">
    <div class="recommend-block">
        <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
            array(
                "COMPONENT_TEMPLATE" => ".default",
                "PATH" => SITE_DIR."include/mainpage/comp_catalog_hit_recommend_custom.php",
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => "standard.php"
            ),
            false
        );?>
    </div>

</div>



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


    <div class="grey_block tizers-container">
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
    </div>




<div class="maxwidth-theme">
    <div class="catalog-sections-block">
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

</div>


<div class="popular-section-desktop">
    <div class="grey_block">

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
    </div>
</div>





<div class="grey_block">
    <div class="maxwidth-theme">
        <div class="news-block">

            <?$APPLICATION->IncludeComponent(
                "bitrix:news",
                "news_custom",
                array(
//            "IBLOCK_TYPE" => "aspro_next_news",
                    "IBLOCK_ID" => "15",
                    "NEWS_COUNT" => "4",
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
                    "SEF_FOLDER" => "/",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_FILTER" => "Y",
                    "CACHE_GROUPS" => "N",
                    "SET_TITLE" => "N",
                    "SET_STATUS_404" => "Y",
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
                        0 => "PERIOD",
                        1 => "REDIRECT",
                        2 => "",
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
                        0 => "FORM_QUESTION",
                        1 => "FORM_ORDER",
                        2 => "PHOTOPOS",
                        3 => "LINK_GOODS",
                        4 => "LINK_SERVICES",
                        7 => "PHOTOS",
                        8 => "DOCUMENTS",
                        9 => "PERIOD",
                    ),
                    "DETAIL_DISPLAY_TOP_PAGER" => "N",
                    "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                    "DETAIL_PAGER_TITLE" => "Страница",
                    "DETAIL_PAGER_TEMPLATE" => "",
                    "DETAIL_PAGER_SHOW_ALL" => "Y",
                    "PAGER_TEMPLATE" => "main",
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
                    "COMPONENT_TEMPLATE" => "news",
                    "SET_LAST_MODIFIED" => "N",
                    "T_VIDEO" => "",
                    "DETAIL_SET_CANONICAL_URL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "SHOW_404" => "Y",
                    "MESSAGE_404" => "",
                    "NUM_NEWS" => "20",
                    "NUM_DAYS" => "30",
                    "YANDEX" => "N",
                    "COMPOSITE_FRAME_MODE" => "A",
                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                    "SECTION_ELEMENTS_TYPE_VIEW" => "FROM_MODULE",
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
                    "FILTER_NAME" => "arRegionLink",
                    "FILTER_FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "FILTER_PROPERTY_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "DETAIL_STRICT_SECTION_CHECK" => "Y",
                    "STRICT_SECTION_CHECK" => "Y",
                    "SEF_URL_TEMPLATES" => array(
                        "news" => "",
                        "section" => "",
                        "detail" => "/company/news/#ELEMENT_CODE#/",
                        "rss" => "rss/",
                        "rss_section" => "#SECTION_ID#/rss/",
                    ),
                    "TITLE_BLOCK" => "Пресс-центр",
                    "ALL_URL" => "company/news/",
                ),
                false
            );?>
        </div>
    </div>







    <div class="maxwidth-theme">
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
                ),
                "TITLE_BLOCK" => "Наши салоны",
                "ALL_URL" => "contacts/stores/"
            ),
            false
        );?>
    </div>
    </div>

</div>
</div>