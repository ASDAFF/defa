<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>
<?
global $arTheme;
$iVisibleItemsMenu = ($arTheme['MAX_VISIBLE_ITEMS_MENU']['VALUE'] ? $arTheme['MAX_VISIBLE_ITEMS_MENU']['VALUE'] : 10);
?>
<?if($arResult):?>
    <div class="table-menu">
        <div class="table-menu-wrapper">
            <div class="menu-item-wrapper">
                <?foreach($arResult as $arItem):?>
                    <?$bShowChilds = $arParams["MAX_LEVEL"] > 1;
                    $bWideMenu = (isset($arItem['PARAMS']['CLASS']) && strpos($arItem['PARAMS']['CLASS'], 'wide_menu') !== false);?>
                    <div class="menu-item unvisible <?=($arItem["CHILD"] ? "dropdown" : "")?> <?=(isset($arItem["PARAMS"]["CLASS"]) ? $arItem["PARAMS"]["CLASS"] : "");?>  <?=($arItem["SELECTED"] ? "active" : "")?>">
                        <div class="wrap">
                            <a class="<?=($arItem["CHILD"] && $bShowChilds ? "dropdown-toggle" : "")?>" href="<?=$arItem["LINK"]?>">
                                <div>
                                    <?if(isset($arItem["PARAMS"]["CLASS"]) && strpos($arItem["PARAMS"]["CLASS"], "sale_icon") !== false):?>
                                        <?=CNextB2c::showIconSvg('sale', SITE_TEMPLATE_PATH.'/images/svg/Sale.svg', '', '');?>
                                    <?endif;?>
                                    <?=$arItem["TEXT"]?>
                                    <div class="line-wrapper"><span class="line"></span></div>
                                </div>
                            </a>
                            <?if($arItem["CHILD"] && $bShowChilds):?>
                                <span class="tail"></span>
                                <ul class="dropdown-menu">
                                    <?foreach($arItem["CHILD"] as $arSubItem):?>
                                        <?$bShowChilds = $arParams["MAX_LEVEL"] > 2;?>
                                        <?$bHasPicture = (isset($arSubItem['PARAMS']['PICTURE']) && $arSubItem['PARAMS']['PICTURE'] && $arTheme['SHOW_CATALOG_SECTIONS_ICONS']['VALUE'] == 'Y');?>
                                        <li class="<?=($arSubItem["CHILD"] && $bShowChilds ? "dropdown-submenu" : "")?> <?=($arSubItem["SELECTED"] ? "active" : "")?> <?=($bHasPicture ? "has_img" : "")?>">
                                            <?if($bHasPicture && $bWideMenu):
                                                $arImg = CFile::ResizeImageGet($arSubItem['PARAMS']['PICTURE'], array('width' => 60, 'height' => 60), BX_RESIZE_PROPORTIONAL_ALT);
                                                if(is_array($arImg)):?>
                                                    <div class="menu_img"><img src="<?=$arImg["src"]?>" alt="<?=$arSubItem["TEXT"]?>" title="<?=$arSubItem["TEXT"]?>" /></div>
                                                <?endif;?>
                                            <?endif;?>
                                            <a href="<?=$arSubItem["LINK"]?>" title="<?=$arSubItem["TEXT"]?>"><span class="name"><?=$arSubItem["TEXT"]?></span><?=($arSubItem["CHILD"] && $bShowChilds ? '<span class="arrow"><i></i></span>' : '')?></a>
                                            <?if($arSubItem["CHILD"] && $bShowChilds):?>
                                                <?$iCountChilds = count($arSubItem["CHILD"]);?>
                                                <ul class="dropdown-menu toggle_menu">
                                                    <?foreach($arSubItem["CHILD"] as $key => $arSubSubItem):?>
                                                        <?$bShowChilds = $arParams["MAX_LEVEL"] > 3;?>
                                                        <li class="menu-item <?=(++$key > $iVisibleItemsMenu ? 'collapsed' : '');?> <?=($arSubSubItem["CHILD"] && $bShowChilds ? "dropdown-submenu" : "")?> <?=($arSubSubItem["SELECTED"] ? "active" : "")?>">
                                                            <a href="<?=$arSubSubItem["LINK"]?>" title="<?=$arSubSubItem["TEXT"]?>"><span class="name"><?=$arSubSubItem["TEXT"]?></span></a>
                                                            <?if($arSubSubItem["CHILD"] && $bShowChilds):?>
                                                                <ul class="dropdown-menu">
                                                                    <?foreach($arSubSubItem["CHILD"] as $arSubSubSubItem):?>
                                                                        <li class="menu-item <?=($arSubSubSubItem["SELECTED"] ? "active" : "")?>">
                                                                            <a href="<?=$arSubSubSubItem["LINK"]?>" title="<?=$arSubSubSubItem["TEXT"]?>"><span class="name"><?=$arSubSubSubItem["TEXT"]?></span></a>
                                                                        </li>
                                                                    <?endforeach;?>
                                                                </ul>

                                                            <?endif;?>
                                                        </li>
                                                    <?endforeach;?>
                                                    <?if($iCountChilds > $iVisibleItemsMenu && $bWideMenu):?>
                                                        <li><span class="colored more_items with_dropdown"><?=\Bitrix\Main\Localization\Loc::getMessage("S_MORE_ITEMS");?></span></li>
                                                    <?endif;?>
                                                </ul>
                                            <?endif;?>
                                        </li>
                                    <?endforeach;?>
                                </ul>
                            <?endif;?>
                        </div>
                    </div>
                <?endforeach;?>

                <div class="menu-item dropdown js-dropdown nosave unvisible">
                    <div class="wrap">
                        <a class="dropdown-toggle more-items" href="#">
                            <span><?=\Bitrix\Main\Localization\Loc::getMessage("S_MORE_ITEMS");?></span>
                        </a>
                        <span class="tail"></span>
                        <ul class="dropdown-menu"></ul>
                    </div>
                </div>

            </div>
            <div class="what_do-block">
                <div class="grey_block">
                    <div class="maxwidth-theme">

                        <h3>Что вы хотите сделать?</h3>
                        <div class="row what_do-wrapper">
                            <div class="what_do-item-wrapper">
                                <a href="<?=SITE_DIR ?>services/test-drayv/" class="what_do-item">
                                    <div class="what_do-item-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                                            <path style="fill:#4c4e54;" d="M47.9 12l2.2 25.5h-20L32.4 12h15.5m0-2.8H32.4c-1.5 0-2.7 1.1-2.8 2.6l-2.2 25.5c-.1.8.2 1.6.7 2.2.5.6 1.3.9 2.1.9h20c.8 0 1.6-.3 2.1-.9s.8-1.4.7-2.2l-2.2-25.5c-.3-1.5-1.5-2.6-2.9-2.6zM53.4 45.1v2.4H26.8v-2.4h26.6m0-2.8H26.8c-1.6 0-2.8 1.3-2.8 2.8v2.4c0 1.6 1.3 2.8 2.8 2.8h26.6c1.6 0 2.8-1.3 2.8-2.8v-2.4c0-1.6-1.3-2.8-2.8-2.8z"></path>
                                            <path style="fill:none;stroke:#4c4e54;stroke-width:2.8346;stroke-linejoin:round;stroke-miterlimit:10;" d="M24.7 46.3h-3.4V32M55.5 46.3h3.4V32"></path>
                                            <circle style="fill:#4c4e54;stroke:#4c4e54;stroke-width:2.8346;stroke-linejoin:round;stroke-miterlimit:10;" cx="21.2" cy="29.8" r="1.7"></circle>
                                            <circle style="fill:#4c4e54;stroke:#4c4e54;stroke-width:2.8346;stroke-linejoin:round;stroke-miterlimit:10;" cx="26.7" cy="66.3" r="1.7"></circle>
                                            <circle style="fill:#4c4e54;stroke:#4c4e54;stroke-width:2.8346;stroke-linejoin:round;stroke-miterlimit:10;" cx="53.3" cy="66.3" r="1.7"></circle>
                                            <circle style="fill:#4c4e54;stroke:#4c4e54;stroke-width:2.8346;stroke-linejoin:round;stroke-miterlimit:10;" cx="58.8" cy="29.8" r="1.7"></circle>
                                            <path style="fill:#4c4e54;stroke:#4c4e54;stroke-width:2.8346;stroke-linejoin:round;stroke-miterlimit:10;" d="M40.1 49.6v12.2M40.1 39.5v3.6"></path>
                                            <path style="fill:none;stroke:#4c4e54;stroke-width:2.8346;stroke-linejoin:round;stroke-miterlimit:10;" d="M53.4 65.2v-3.4l-26.6-.1v3.5"></path>
                                        </svg>
                                    </div>
                                    <span>Заказать Тест-драйв в офис</span>
                                </a>
                            </div>
                            <div class="what_do-item-wrapper">
                                <a href="<?=SITE_DIR ?>services/dizayn-proekt/" class="what_do-item">
                                    <div class="what_do-item-icon">

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                                            <circle style="fill:none;stroke:#4c4e54;stroke-width:2.8346;stroke-miterlimit:10" cx="12.7" cy="28.8" r="3.7"></circle>
                                            <circle style="fill:none;stroke:#4c4e54;stroke-width:2.8346;stroke-miterlimit:10" cx="49.9" cy="28.8" r="3.7"></circle>
                                            <circle style="fill:none;stroke:#4c4e54;stroke-width:2.8346;stroke-miterlimit:10" cx="49.9" cy="66" r="3.7"></circle>
                                            <circle style="fill:none;stroke:#4c4e54;stroke-width:2.8346;stroke-miterlimit:10" cx="12.7" cy="66" r="3.7"></circle>
                                            <path style="fill:none;stroke:#4c4e54;stroke-width:2.8346;stroke-miterlimit:10" d="M16.4 28.8h29.7M16.4 66h29.8M49.9 32.6v29.7M12.7 32.6v29.7"></path>
                                            <circle style="fill:none;stroke:#4c4e54;stroke-width:2.8346;stroke-miterlimit:10" cx="30.1" cy="14" r="3.7"></circle>
                                            <circle style="fill:none;stroke:#4c4e54;stroke-width:2.8346;stroke-miterlimit:10" cx="67.3" cy="14" r="3.7"></circle>
                                            <circle style="fill:none;stroke:#4c4e54;stroke-width:2.8346;stroke-miterlimit:10" cx="67.3" cy="51.2" r="3.7"></circle>
                                            <path style="fill:none;stroke:#4c4e54;stroke-width:2.8346;stroke-miterlimit:10" d="M33.8 14h29.7M67.3 17.7v29.7M16.4 25.6l11.5-10.4M53.6 26.9l11.5-10.5M53.6 64.1l11.5-10.5"></path>
                                        </svg>

                                    </div>
                                    <span>Получить 3D-проект бесплатно</span>
                                </a>
                            </div>
                            <div class="what_do-item-wrapper">
                                <a href="<?=SITE_DIR ?>services/vyezd-spetsialista/" class="what_do-item">
                                    <div class="what_do-item-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                                            <path style="fill:none;stroke:#4c4e54;stroke-width:2.8346;stroke-miterlimit:10" d="M37 54.9l-22-4.4c-1.6 0-3-1.4-3-3v-14c0-1.7 1.4-3 3-3h50c1.7 0 3 1.4 3 3v14c0 1.6-1.3 3-3 3l-22 4.4"></path>
                                            <path style="fill:none;stroke:#4c4e54;stroke-width:2.8346;stroke-miterlimit:10" d="M65 50.5v20c0 1.7-1.3 3-3 3H18c-1.6 0-3-1.3-3-3v-20M46 31.5v-5.2c0-.4-.3-.8-.7-.8H34.7c-.4 0-.7.4-.7.8v5.2"></path>
                                            <path style="fill:none;stroke:#4c4e54;stroke-width:2.8346;stroke-miterlimit:10" d="M38 52.5h4v7h-4z"></path>
                                        </svg>
                                    </div>
                                    <span>Вызвать специалиста в офис</span>
                                </a>
                            </div>
                            <div class="what_do-item-wrapper">
                                <a href="<?=SITE_DIR ?>services/konsultatsiya-eksperta/" class="what_do-item">
                                    <div class="what_do-item-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                                            <path style="fill:none;stroke:#4c4e54;stroke-miterlimit:100; stroke-linecap:round;stroke-linejoin:round;stroke-width:8.5039;" d="M16.8 35.6v8.7M63.2 35.6v8.7"></path>
                                            <path style="fill:none; stroke:#4c4e54; stroke-width:5.669; stroke-linecap:round; stroke-linejoin:round; stroke-miterlimit:10;" d="M35.3 65h8.6"></path>
                                            <path style="fill:none;stroke:#4c4e54;stroke-miterlimit:10; stroke-width:2.8346;" d="M34 65c-9.1 0-16.5-9.8-16.5-21.9M18.9 36.2C18.9 24.5 28.3 15 40 15s21.2 9.5 21.2 21.2"></path>
                                        </svg>
                                    </div>
                                    <span>Получить консультацию эксперта</span>
                                </a>
                            </div>
                            <div class="what_do-item-wrapper">
                                <a href="<?=SITE_DIR ?>partner/b2g/" class="what_do-item">
                                    <div class="what_do-item-icon">

                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
                                            <path style="fill:none; stroke:#4c4e54; stroke-width:2.8346; stroke-miterlimit:10;" d="M58 70.5H17c-1.6 0-3-1.3-3-3v-50c0-1.6 1.4-3 3-3h41c1.6 0 3 1.3 3 3v50c0 1.7-1.4 3-3 3zM24 26.5h27M24 34.5h27M24 42.5h27M24 50.5h27"/>
                                            <path style="fill:none; stroke:#4c4e54; stroke-width:2.8346; stroke-miterlimit:10;" d="M19 14.6v-2c0-1.6 1.4-3 3-3h41c1.6 0 3 1.4 3 3v50c0 1.7-1.4 3-3 3h-2.1"/>
                                        </svg>

                                    </div>
                                    <span>Подготовить документацию под ФЗ-44 и ФЗ-223</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?endif;?>