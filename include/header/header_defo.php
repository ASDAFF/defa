<?
global $arTheme, $arRegion;
$arRegions = CNextRegionality::getRegions();
if($arRegion)
    $bPhone = ($arRegion['PHONES'] ? true : false);
else
    $bPhone = ((int)$arTheme['HEADER_PHONES'] ? true : false);
$logoClass = ($arTheme['COLORED_LOGO']['VALUE'] !== 'Y' ? '' : ' colored');
?>


<div class="top-block top-block-v1">
    <div class="maxwidth-theme">
        <div class="wrapp_block">
            <div class="row">
                <a href="/" class="logo-block">
                    <!--<div class="logo<?/*=$logoClass*/?>">-->
                        <?/*=CNext::ShowLogo();*/?>
                    <!--</div>-->
                    <div class="logo-cube">
                        <div class="face1" style="background-image: url(<?SITE_DIR?>/images/cube-logo.png); background-position: center center"></div>
                        <div class="face2" style="background-image: url(<?SITE_DIR?>/images/cube2.png); background-position: center center"></div>
                        <div class="face3" style="background-image: url(<?SITE_DIR?>/images/cube3.png); background-position: center center"></div>
                        <div class="face4" style="background-image: url(<?SITE_DIR?>/images/cube4.png); background-position: center center"></div>
                        <div class="face5" style="background-image: url(<?SITE_DIR?>/images/cube7.png); background-position: center center"></div>
                        <div class="face6" style="background-image: url(<?SITE_DIR?>/images/cube6.png); background-position: center center"></div>
                    </div>
                </a>
                <div class="menu-block">
                    <div class="row top-menu-block">
                        <nav class="mega-menu sliced col-md-6">
                            <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
                                array(
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH" => SITE_DIR."include/menu/menu.top_segments.php",
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "",
                                    "AREA_FILE_RECURSIVE" => "Y",
                                    "EDIT_TEMPLATE" => "include_area.php"
                                ),
                                false, array("HIDE_ICONS" => "Y")
                            );?>
                        </nav>

                            <!--<div class="top-block-item col-md-3">

                            </div>
-->


                        <div class="top-block-item col-md-6 right-block-item">
                            <?if($arRegions): // dynamic?>
                                <div class="phone-block">
                                    <?if($bPhone):?>
                                        <div class="inline-block">
                                            <?CNext::ShowHeaderPhones();?>
                                        </div>
                                    <?endif?>
                                    <?/*if($arTheme['SHOW_CALLBACK']['VALUE'] == 'Y'):*/?><!--
                                <div class="inline-block">
                                    <span class="callback-block animate-load twosmallfont colored" data-event="jqm" data-param-form_id="CALLBACK" data-name="callback"><?/*=GetMessage("CALLBACK")*/?></span>
                                </div>
                            --><?/*endif;*/?>
                                </div>
                            <?endif;?>
                            <?if($arRegions): //dynamic?>
                                <div class="city-block">

                                    <div class="top-description">
                                        <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
                                            array(
                                                "COMPONENT_TEMPLATE" => ".default",
                                                "PATH" => SITE_DIR."include/top_page/regionality.list.php",
                                                "AREA_FILE_SHOW" => "file",
                                                "AREA_FILE_SUFFIX" => "",
                                                "AREA_FILE_RECURSIVE" => "Y",
                                                "EDIT_TEMPLATE" => "include_area.php"
                                            ),
                                            false
                                        );?>
                                    </div>

                                </div>
                            <?else: //dynamic?>
                                <div class="top-block-item">
                                    <div class="phone-block">
                                        <?if($bPhone):?>
                                            <div class="inline-block">
                                                <?CNext::ShowHeaderPhones();?>
                                            </div>
                                        <?endif?>
                                        <?/*if($arTheme['SHOW_CALLBACK']['VALUE'] == 'Y'):*/?><!--
                                <div class="inline-block">
                                    <span class="callback-block animate-load twosmallfont colored" data-event="jqm" data-param-form_id="CALLBACK" data-name="callback"><?/*=GetMessage("CALLBACK")*/?></span>
                                </div>
                            --><?/*endif;*/?>
                                    </div>
                                </div>
                            <?endif;?>
                            <div class="personal_wrap">
                                <div class="personal top login twosmallfont">
                                    <?=CNext::ShowCabinetLink(true, true);?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row bottom-menu-block">
                        <div class="col-md-11 menu-row">
                            <div class="nav-main-collapse collapse in">
                                <div class="menu-only">
                                    <nav class="mega-menu sliced">
                                        <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
                                            array(
                                                "COMPONENT_TEMPLATE" => ".default",
                                                "PATH" => SITE_DIR."include/menu/menu.top_sections.php",
                                                "AREA_FILE_SHOW" => "file",
                                                "AREA_FILE_SUFFIX" => "",
                                                "AREA_FILE_RECURSIVE" => "Y",
                                                "EDIT_TEMPLATE" => "include_area.php"
                                            ),
                                            false, array("HIDE_ICONS" => "Y")
                                        );?>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 right-block-item">
                            <div class="top-block-item">
                                <div class="burger pull-left"><?=CNext::showIconSvg("burger dark", SITE_TEMPLATE_PATH."/images/svg/Burger_big_white.svg");?></div>

                                <button class="top-btn inline-search-show twosmallfont">
                                    <?=CNext::showIconSvg("search", SITE_TEMPLATE_PATH."/images/svg/Search_black.svg");?>
                                    <!--<span class="dark-color"><?/*=GetMessage('SEARCH_TITLE')*/?></span>-->
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <!--<div class="top-block-item col-md-2">

                </div>-->
                <!--<div class="top-block-item pull-left visible-lg">
                    <?/*CNext::showAddress('address twosmallfont inline-block');*/?>
                </div>-->

                <!--<div class="top-block-item pull-right show-fixed top-ctrl">
                    <div class="basket_wrap twosmallfont">
                        <?/*CNext::ShowBasketWithCompareLink('', '');*/?>
                    </div>
                </div>-->


            </div>
        </div>
    </div>
</div>
<div class="header-wrapper topmenu-LIGHT">
    <div class="wrapper_inner">
        <div class="logo_and_menu-row">
            <div class="logo-row row">
                <!--<div class="logo-block col-md-2 col-sm-3">
                    <div class="logo<?/*=$logoClass*/?>">
                        <?/*=CNext::ShowLogo();*/?>
                    </div>
                </div>-->
                <!--<div class="col-md-2 hidden-sm hidden-xs">
                    <div class="top-description">
                        <?/*$APPLICATION->IncludeFile(SITE_DIR."include/top_page/slogan.php", array(), array(
                                "MODE" => "html",
                                "NAME" => "Text in title",
                                "TEMPLATE" => "include_area.php",
                            )
                        );*/?>
                    </div>
                </div>-->
<!--               dynamic-->

            </div><?// class=logo-row?>
        </div>
    </div>
    <div class="line-row visible-xs"></div>
</div>

<div class="mega_fixed_menu">
    <div class="maxwidth-theme">
        <div class="row">
            <div class="col-md-12">
                <div class="menu-only">
                    <nav class="mega-menu">
                        <?=CNext::showIconSvg("close dark", SITE_TEMPLATE_PATH."/images/svg/Close.svg");?>
                        <?$APPLICATION->IncludeComponent("bitrix:main.include", ".default",
                            array(
                                "COMPONENT_TEMPLATE" => ".default",
                                "PATH" => SITE_DIR."include/menu/menu.top.php",
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "",
                                "AREA_FILE_RECURSIVE" => "Y",
                                "EDIT_TEMPLATE" => "include_area.php"
                            ),
                            false, array("HIDE_ICONS" => "Y")
                        );?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>


<?/*$showFlyCallback = $showFlyAskQuestion = $showFlyAddReview = $showFlyMap = "Y";?>
	<div class="fly_forms">
		<?CPriorityCut::checkShowForm($showFlyCallback, array('ICON_CLASS' => 'callback_icon', 'FORM_CODE' => 'aspro_priority_callback', 'FORM_NAME' => 'callback', 'FORM_TEXT' => GetMessage('CALLBACK_FORM_BUTTON_TEXT')));?>
		<?CPriorityCut::checkShowForm($showFlyAskQuestion, array('ICON_CLASS' => 'question_icon', 'FORM_CODE' => 'aspro_priority_question', 'FORM_NAME' => 'question', 'FORM_TEXT' => GetMessage('ASK_QUESTION_FORM_BUTTON_TEXT')));?>
		<?CPriorityCut::checkShowForm($showFlyAddReview, array('ICON_CLASS' => 'add_review_icon', 'FORM_CODE' => 'aspro_priority_add_review', 'FORM_NAME' => 'add_review', 'FORM_TEXT' => GetMessage('ADD_REVIEW_FORM_BUTTON_TEXT')));?>
		<?CPriorityCut::checkShowForm($showFlyMap, array('ICON_CLASS' => 'map_icon', 'FORM_CODE' => 'map', 'FORM_NAME' => 'map', 'FORM_TEXT' => GetMessage('MAP_FORM_BUTTON_TEXT')));?>
	</div>

<? class CPriorityCut
{

	public static function checkShowForm($showFormValue = '', $arParams = array())
	{
		if ($showFormValue && $showFormValue == 'Y') {
			?>
			<div
				class="button font_upper_md<?= (strlen($arParams['ICON_CLASS']) ? ' ' . $arParams['ICON_CLASS'] : ''); ?>">
				<span class="dark-color animate-load border shadow" title="<?= $arParams['FORM_TEXT']; ?>"
					  data-event="jqm"
					  data-param-id="<?= ($arParams['FORM_CODE'] == 'map' ? 'map' : self::getFormID($arParams['FORM_CODE'])); ?>"
					  data-name="<?= $arParams['FORM_NAME']; ?>"<?= ($arParams['FORM_CODE'] == 'map' ? ' data-param-type="map" data-iblock_id="' . CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_contact"][0] . '"' : '') ?><?= ($arParams['FORM_CODE'] == 'map' ? ' data-map_button="Y"' : '') ?>>
					<span>
						<? if ($arParams['FORM_NAME'] == 'callback'):?>
							<?= CPriorityCut::showIconSvg(SITE_TEMPLATE_PATH . '/images/include_svg/callback.svg'); ?>
							<?
						elseif ($arParams['FORM_NAME'] == 'question'):?>
							<?= CPriorityCut::showIconSvg(SITE_TEMPLATE_PATH . '/images/include_svg/question.svg'); ?>
							<?
						elseif ($arParams['FORM_NAME'] == 'add_review'):?>
							<?= CPriorityCut::showIconSvg(SITE_TEMPLATE_PATH . '/images/include_svg/add_review.svg'); ?>
							<?
						elseif ($arParams['FORM_NAME'] == 'map'):?>
							<?= CPriorityCut::showIconSvg(SITE_TEMPLATE_PATH . '/images/include_svg/map.svg'); ?>
						<?endif ?>

						<?= $arParams['FORM_TEXT']; ?>
					</span>
				</span>
			</div>
			<?
		}
	}

	public static function showIconSvg($path)
	{
		$iconSVG = '';

		if (file_exists($_SERVER['DOCUMENT_ROOT'] . $path)) {
			$iconSVG = Bitrix\Main\IO\File::getFileContents($_SERVER['DOCUMENT_ROOT'] . $path);
		}

		return $iconSVG;
	}
}*/
?>