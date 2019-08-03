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

                        <? $APPLICATION->IncludeComponent("tmetrika:alphabet-menu", ".default", [

                        ]); ?>

        <?
        $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/_common.css',true);
        $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/_common.js',true);
        ?>
	</body>
</html>
