						<?CNextB2c::checkRestartBuffer();?>
						<?IncludeTemplateLangFile(__FILE__);?>
							<?if(!$isIndex):?>
								<?if($isBlog):?>
									</div> <?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
									<div class="col-md-3 col-sm-3 hidden-xs hidden-sm right-menu-md">
										<div class="sidearea">
											<?$APPLICATION->ShowViewContent('under_sidebar_content');?>
											<?CNextB2c::get_banners_position('SIDE', 'Y');?>
											<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "sect", "AREA_FILE_SUFFIX" => "sidebar", "AREA_FILE_RECURSIVE" => "Y"), false);?>
										</div>
									</div>
								</div><?endif;?>
								<?if($isHideLeftBlock && !$isWidePage):?>
									</div> <?// .maxwidth-theme?>
								<?endif;?>
								</div> <?// .container?>
							<?else:?>
								<?CNextB2c::ShowPageType('indexblocks');?>
							<?endif;?>
							<?CNextB2c::get_banners_position('CONTENT_BOTTOM');?>
						</div> <?// .middle?>
					<?//if(!$isHideLeftBlock && !$isBlog):?>
					<?if(($isIndex && $isShowIndexLeftBlock) || (!$isIndex && !$isHideLeftBlock) && !$isBlog):?>
						</div> <?// .right_block?>				
						<?if($APPLICATION->GetProperty("HIDE_LEFT_BLOCK") != "Y" && !defined("ERROR_404")):?>
							<div class="left_block">
								<?CNextB2c::ShowPageType('left_block');?>
							</div>
						<?endif;?>
					<?endif;?>
				<?if($isIndex):?>
					</div>
				<?elseif(!$isWidePage):?>
					</div> <?// .wrapper_inner?>				
				<?endif;?>
			</div> <?// #content?>
			<?CNextB2c::get_banners_position('FOOTER');?>
		</div><?// .wrapper?>
		<footer id="footer">
			<?if($APPLICATION->GetProperty("viewed_show") == "Y" || $is404):?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include", 
					"basket", 
					array(
						"COMPONENT_TEMPLATE" => "basket",
						"PATH" => SITE_DIR."include/footer/comp_viewed.php",
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "",
						"AREA_FILE_RECURSIVE" => "Y",
						"EDIT_TEMPLATE" => "standard.php",
						"PRICE_CODE" => array(
							0 => "BASE",
						),
						"STORES" => array(
							0 => "",
							1 => "",
						),
						"BIG_DATA_RCM_TYPE" => "bestsell"
					),
					false
				);?>					
			<?endif;?>
			<?CNextB2c::ShowPageType('footer');?>


		</footer>
		<div class="bx_areas">
			<?CNextB2c::ShowPageType('bottom_counter');?>
		</div>
		<?CNextB2c::ShowPageType('search_title_component');?>
		<?CNextB2c::setFooterTitle();
		CNextB2c::showFooterBasket();?>

                        <?$APPLICATION->AddHeadScript(SITE_DIR.'bitrix/js/slick.min.js',true);?>

                        <!--            Боковое всплывающее меню с тизерами-->
                        <div>
                            <div class="floating-tizers" id="tizerzFloat">
                                <ul class="floating-tizers-wrapper">
                                    <li class="floating-tizer-block drop">
                                        <span class="floating-tizer-link drop" id="callMenu">
                                            <div class="tizer-icon">
                                                <img src="<?SITE_DIR?>/images/consultant__light.svg" alt="" width="30" height="30">
                                            </div>
                                            <span>Обратная связь</span>
                                        </span>
                                        <ul class="hide-tizer" id="hideMenu">
                                            <li class="floating-tizer-block">
                                                <a class="floating-tizer-link help_me">
                                                    <div class="tizer-icon">
                                                        <img src="<?SITE_DIR?>/images/manager__light.svg" alt="" width="30" height="30">
                                                    </div>
                                                    <span>Получить консультацию</span>
                                                </a>
                                            </li>
<!--                                            <li class="floating-tizer-block">-->
<!--                                                <span class="animate-load floating-tizer-link" data-event="jqm" data-param-form_id="HELP_ME" data-name="HELP_ME" data-autoload-product_name="--><?//=CNextB2c::formatJsName($arResult["NAME"]);?><!--" data-autoload-product_id="--><?//=$arResult["ID"];?><!--">-->
<!--                                                    <div class="tizer-icon">-->
<!--                                                        <img src="--><?//SITE_DIR?><!--/images/manager__light.svg" alt="" width="30" height="30">-->
<!--                                                    </div>-->
<!--                                                    <span>Получить консультацию</span>-->
<!--                                                </span>-->
<!--                                            </li>-->
<!--                                            <li class="floating-tizer-block">-->
<!--                                                <span class="animate-load floating-tizer-link" data-event="jqm" data-param-form_id="DESIGN_PROJECT" data-name="DESIGN_PROJECT" data-autoload-product_name="--><?//=CNextB2c::formatJsName($arResult["NAME"]);?><!--" data-autoload-product_id="--><?//=$arResult["ID"];?><!--">-->
<!--                                                    <div class="tizer-icon">-->
<!--                                                        <img src="--><?//SITE_DIR?><!--/images/design-project__light.svg" alt="" width="30" height="30">-->
<!--                                                    </div>-->
<!--                                                    <span>Заказать дизайн-проект</span>-->
<!--                                                </span>-->
<!--                                            </li>-->
                                            <li class="floating-tizer-block">
                                                <span class="animate-load floating-tizer-link" data-event="jqm" data-param-form_id="CALL_SPECIALIST" data-name="CALL_SPECIALIST" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">
                                                    <div class="tizer-icon">
                                                        <img src="<?SITE_DIR?>/images/manager-call__light.svg" alt="" width="30" height="30">
                                                    </div>
                                                    <span>Выезд специалиста</span>
                                                </span>
                                            </li>
<!--                                            <li class="floating-tizer-block">-->
<!--                                                <span class="animate-load floating-tizer-link" data-event="jqm" data-param-form_id="TEST_DRIVE" data-name="TEST_DRIVE" data-autoload-product_name="--><?//=CNextB2c::formatJsName($arResult["NAME"]);?><!--" data-autoload-product_id="--><?//=$arResult["ID"];?><!--">-->
<!--                                                    <div class="tizer-icon">-->
<!--                                                        <img src="--><?//SITE_DIR?><!--/images/test_drive__light.svg" alt="" width="30" height="30">-->
<!--                                                    </div>-->
<!--                                                    <span>Заказать тест-драйв</span>-->
<!--                                                </span>-->
<!--                                            </li>-->
                                            <li class="floating-tizer-block">
                                                <span class="animate-load floating-tizer-link"  data-event="jqm" data-param-form_id="BOSS_MESSAGE" data-name="BOSS_MESSAGE" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">
                                                    <div class="tizer-icon">
                                                        <img src="<?SITE_DIR?>/images/mesage_rukovodstvo__light.svg" alt="" width="30" height="30">
                                                    </div>
                                                    <span>Написать руководителю</span>
                                                </span>
                                            </li>
                                            <li class="floating-tizer-block">
                                                <span class="animate-load floating-tizer-link" data-event="jqm" data-param-form_id="LEAVE_FEEDBACK" data-name="LEAVE_FEEDBACK" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">
                                                    <div class="tizer-icon">
                                                        <img src="<?SITE_DIR?>/images/feedback__light.svg" alt="" width="30" height="30">
                                                    </div>
                                                    <span>Написать отзыв</span>
                                                </span>
                                            </li>
                                            <li class="floating-tizer-block" id="callMap">
                                                <a href="/contacts/stores/" class="floating-tizer-link">
<!--                                                    <a href="href="/contacts/stores/" "></a>-->
                                                    <div class="tizer-icon">
                                                        <img src="<?SITE_DIR?>/images/see-in-shop__light.svg" alt="" width="30" height="30">
                                                    </div>
                                                    <span>Контакты</span>
                                                </a>
                                            </li>
                                            <!--<div class="floating-tizer-block">
                                   <a href="javascript:;" class="floating-tizer-link">
                                        <div class="tizer-icon">
                                            <img src="<?SITE_DIR?>/images/design-project__light.svg" alt="">
                                        </div>
                                        <span>Получить предложение</span>
                                    </a>
                                </div> -->
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="map-fly">
                                <button class="button-close"><span></span></button>
                                <div class="contacts_map">
                                    <?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID('shops-map-block');?>
                                    <?if($arParams["MAP_TYPE"] != "0"):?>
                                        <?$APPLICATION->IncludeComponent(
                                            "bitrix:map.google.view",
                                            "map",
                                            array(
                                                "INIT_MAP_TYPE" => "ROADMAP",
                                                "MAP_DATA" => serialize(array("google_lat" => $mapLAT, "google_lon" => $mapLON, "google_scale" => 15, "PLACEMARKS" => $arPlacemarks)),
                                                "MAP_WIDTH" => "100%",
                                                "MAP_HEIGHT" => "100%",
                                                "CONTROLS" => array(
                                                ),
                                                "OPTIONS" => array(
                                                    0 => "ENABLE_DBLCLICK_ZOOM",
                                                    1 => "ENABLE_DRAGGING",
                                                ),
                                                "MAP_ID" => "",
                                                "ZOOM_BLOCK" => array(
                                                    "POSITION" => "right center",
                                                ),
                                                "API_KEY" => $arParams["GOOGLE_API_KEY"],
                                                "COMPONENT_TEMPLATE" => "map",
                                                "COMPOSITE_FRAME_MODE" => "A",
                                                "COMPOSITE_FRAME_TYPE" => "AUTO"
                                            ),
                                            false,
                                            array(
                                                "HIDE_ICONS" => "Y"
                                            )
                                        );?>
                                    <?else:?>
                                        <?
                                        $mapLAT = floatval($mapLAT / count($arItems));
                                        $mapLON = floatval($mapLON / count($arItems));
                                        ?>
                                        <?$APPLICATION->IncludeComponent(
                                            "bitrix:map.yandex.view",
                                            "",
                                            array(
                                                "INIT_MAP_TYPE" => "ROADMAP",
                                                "MAP_DATA" => serialize(array("yandex_lat" => $mapLAT, "yandex_lon" => $mapLON, "yandex_scale" => 4, "PLACEMARKS" => $arPlacemarks)),
                                                "MAP_WIDTH" => "100%",
                                                "MAP_HEIGHT" => "660",
                                                "CONTROLS" => array(
                                                    0 => "ZOOM",
                                                    1 => "SMALLZOOM",
                                                    3 => "TYPECONTROL",
                                                    4 => "SCALELINE",
                                                ),
                                                "OPTIONS" => array(
                                                    0 => "ENABLE_DBLCLICK_ZOOM",
                                                    1 => "ENABLE_DRAGGING",
                                                ),
                                                "MAP_ID" => "",
                                                "ZOOM_BLOCK" => array(
                                                    "POSITION" => "right center",
                                                ),
                                                "COMPONENT_TEMPLATE" => "map",
                                                "API_KEY" => $arParams["GOOGLE_API_KEY"],
                                                "COMPOSITE_FRAME_MODE" => "A",
                                                "COMPOSITE_FRAME_TYPE" => "AUTO"
                                            ),
                                            false, array("HIDE_ICONS" =>"Y")
                                        );?>
                                    <?endif;?>
                                    <?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID('shops-map-block', '');?>
                                </div>
                            </div>
                        </div>
<!--подарок-->
<!--                        <div class="gift">-->
<!--                            <a href="#" class="gift-activate">-->
<!--                                <img src="/images/gift.png" alt="Хотите подарок? Тогда нажимайте скорее!" class="gift-img" width="464" height="474">-->
<!--                            </a>-->
<!--                        </div>-->

                        <div class="gift-banner">
<!--                            <button class="gift-banner__close">x</button>-->
                            <div class="gift-banner__content">
                                <h3 class="gift-banner__title">Хотите получить <span class="gift-sale">500 <small>руб.</small></span> на Вашу покупку?</h3>
                                <a href="" class="gift-banner__link gift-banner__link--yes">Да, хочу!</a>
                                <a href="" class="gift-banner__link gift-banner__link--no">Нет, 500 рублей меня не интересуют</a>
                            </div>
                        </div>

                        <div class="flag-wrapper">
                            <div class="flag design">
                                <span class="animate-load flag-link" data-event="jqm" data-param-form_id="DESIGN_PROJECT" data-name="DESIGN_PROJECT" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Дизайн-проект<br> 3D бесплатно</span>
                            </div>
                            <div class="flag test-drive">
                                <span class="animate-load flag-link" data-event="jqm" data-param-form_id="TEST_DRIVE" data-name="TEST_DRIVE" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Тест-драйв мебели<br> у Вас в офисе</span>
                            </div>
                            <div class="flag more-quantity">
                                <span class="animate-load flag-link" data-event="jqm" data-param-form_id="COMMERCIAL_OFFER" data-name="COMMERCIAL_OFFER" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Необходимо<br> много мебели?</span>
                            </div>
                        </div>



                        <!--Нижнее меню в мобилке-->
                        <div class="mobile-menu-bottom">
                            <div class="menu-item">
                                <a href="/catalog">
                                    <img src="/images/catalog-menu-bottom.svg" alt="">
                                    <span>Каталог</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="/services">
                                    <img src="/images/services-menu-bottom.svg" alt="">
                                    <span>Услуги</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <?=CNext::ShowBasketWithCompareLink('', 'big white', false, false, true);?>
                            </div>
                            <div class="menu-item">
                                <a href="/contacts">
                                    <img src="/images/contacts-menu-bottom.svg" alt="">
                                    <span>Контакты</span>
                                </a>
                            </div>
                        </div>

<!--                        алфавитное меню-->

                        <div class="alphabet-menu-wrapper">
                            <ul class="alphabet-list">
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">А</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item active">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Б</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item active">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">В</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item active">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Г</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item active">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Д</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item active">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Е</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item active">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Ж</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item active">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">З</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item active">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">И</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item active">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">К</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item active">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Л</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item active">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">М</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item active">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Н</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item active">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">О</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item active">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">П</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item active">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Р</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item active">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">С</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item active">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Т</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item active">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">У</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item active">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Ф</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item active">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Х</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item active">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Ц</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item active">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Ч</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item active">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Ш</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item active">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Щ</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item active">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Э</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item active">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Ю</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item active">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="alphabet-item">
                                    <span class="alphabet-toggle">Я</span>
                                    <ul class="alphabet-hide">
                                        <li class="alphabet-hide-item alphabet-choice">
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Разделы</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Вакансии</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Барные стулья</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Детские кресла</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Серии</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Ларус</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Тревизо</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Нью-Вашингтон</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Привилегия</p>
                                                </li>
                                            </ul>
                                            <ul class="alphabet-hide-list">
                                                <li class="alphabet-hide-title">
                                                    <h5>Товары</h5>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бит</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Бюджет Нью</p>
                                                </li>
                                                <li class="alphabet-hide-list-item active">
                                                    <p>Бистро</p>
                                                </li>
                                                <li class="alphabet-hide-list-item">
                                                    <p>Браун</p>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="alphabet-hide-item alphabet-demo">
                                            <div class="alphabet-demo-product alphabet-demo-item active">
                                                <div class="column img">
                                                    <div class="product-img-wrap">
                                                        <img id="" src="/images/iq.jpg" alt="" title="" class="product-photo">
                                                    </div>
                                                    <h3 class="product-name">Кресло IQ</h3>
                                                    <div class="rating">
                                                        <div class="iblock-vote small">
                                                            <table class="table-no-border">
                                                                <tr>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="1"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="2"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="3"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="4"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="star-active star-voted" title="5"></div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="item-stock">
                                                        <span class="icon stock"></span>
                                                        <span class="value">
                                                            <span class="">Много</span>
                                                        </span>
                                                    </div>
                                                    <div class="price-wrap">
                                                        <span class="price">11 990 &#8381;</span>
                                                        <span class="old-price">18 690</span>
                                                        <span class="sale">-30%</span>
                                                    </div>
                                                    <a href="" class="blue-link">Гарантируем лучшие условия</a>
                                                    <div class="color-wrap">
                                                        <span>Цвета и отделки:</span>
                                                        <div class="colors-wrapper">
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                            <div class="color-item">
                                                                <img src="https://via.placeholder.com/33x33" alt="">
                                                            </div>
                                                        </div>
                                                        <a href="" class="blue-link">Нужен в другом цвете?</a>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <div class="another-sale">
                                                        <a href="">Другие товары акции</a>
                                                    </div>
                                                    <ul class="characters">
                                                        <li>ткань или экокожа</li>
                                                        <li>механизм качания с фиксацией в рабочем положении</li>
                                                        <li>ткань или экокожа</li>
                                                    </ul>
                                                    <a href="" class="blue-link">Все характеристики</a>
                                                    <div class="product_delivery">
                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery1.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Доставка</span>
                                                            <span class="black-text">от 750р</span>
                                                            <span class="date" title="Ближайшая дата доставки">07.05.2019</span>
                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery2.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">Самовывоз</span>
                                                            <span class="black-text">из 2 пунктов</span>
                                                            <span class="date" title="Ближайшая дата самовывоза">07.05.2019</span>

                                                        </span>

                                                        <span class="choise" data-block=".stores-block">
                                                            <div class="delivery_icon">
                                                                <img src="/images/delivery3.svg" alt="">
                                                            </div>
                                                            <span class="gray-text">На витрине</span>
                                                            <span class="black-text">в 7 салонах</span>
                                                        </span>
                                                        <div class="cheaper_form">
                                                            <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10" data-name="cheaper" data-autoload-product_name="IQ black" data-autoload-product_id="8901">Нужно быстрее?</span>
                                                        </div>
                                                    </div>
                                                    <div class="product_scheme">
                                                        <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg" alt="product scheme defo.ru" class="product_scheme__img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="alphabet-demo-series alphabet-demo-item">
                                                <div class="column img">
                                                    <h3 class="series-name">Нью-Вашингтон</h3>
                                                    <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                                    <div class="series-slider-wrapper">
                                                        <div class="main-img main-slide">
                                                            <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683" class="series-item__main-photo">
                                                        </div>
                                                        <div class="toggle-img">
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                            <div class="toggle-img-item">
                                                                <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="column info">
                                                    <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
                                                    <ul class="series-item-pros">
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Инновационные решения</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Итальянский дизайн</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Натуральный шпон</span>
                                                        </li>
                                                        <li class="series-item-pros-element">
                                                            <div class="pros-icon">
                                                                <img src="https://via.placeholder.com/30x30" alt="">
                                                            </div>
                                                            <span class="pros-text">Европейские материалы и фурнитура</span>
                                                        </li>
                                                    </ul>
                                                    <div class="colors-wrap">
                                                        <div class="series-item-color-solutions">
                                                            <h3>Цветовые решения</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="series-item-color-solutions">
                                                            <h3>Дополнительные цвета</h3>
                                                            <div class="series-item-color-content">
                                                                <div class="series-item-color-wrapper">
                                                                    <div class="series-item-color-pic" data-title="" style="background: url()">
                                                                        <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id="">
                                                                            <img src="https://via.placeholder.com/90x60" alt="">
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="series-item-buttons">
                                                        <a class="btn" href="#">Заказать тест-драйв</a>
                                                        <a class="btn" href="#">Подробнее о серии</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

        <?
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/_common.css',true);
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/_common.js',true);
        ?>
	</body>
</html>