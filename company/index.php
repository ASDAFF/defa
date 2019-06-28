<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
?>

    <div class="top_block">
        <h3 class="title_block big">О компании</h3>
    </div>

    <div class="row about-company advantages-wrap">
        <div class="row about-company advantages">
            <div class="col-lg-4 advantage-item">
                <p class="advantages-number"><span class="big">25</span> лет</p>
                <p class="advantages-text">являемся надежным партнером в мебельной индустрии</p>
            </div>
            <div class="col-lg-4 advantage-item">
                <p class="advantages-number"><span class="big">>20</span> тысяч</p>
                <p class="advantages-text">успешно исполненных проектов в рамках государственных и коммерческих контрактов</p>
                <a href="/company/projects/" class="arrow-link">Список проектов <span></span></a>
            </div>
            <div class="col-lg-4 advantage-item">
                <p class="advantages-number"><span class="big">44</span> тысячи</p>
                <p class="advantages-text">наименований мебели обеспечивают широкий выбор</p>
            </div>
        </div>

        <div class="row about-company advantages">
            <div class="col-lg-4 advantage-item">
                <p class="advantages-number"><span class="big">55</span> тысяч складских метров</p>
                <p class="advantages-text">позволяет поставлять мебель в кратчайшие сроки</p>
                <a href="/services/dostavka/" class="arrow-link">Подробнее о доставке <span></span></a>
            </div>
            <div class="col-lg-4 advantage-item">
                <p class="advantages-number"><span class="big">>107</span> салонов</p>
                <p class="advantages-text">мы открыли по всей России, чтобы купить мебель было еще проще</p>
                <a href="/contacts/" class="arrow-link">Карта салонов <span></span></a>
            </div>
            <div class="col-lg-4 reward-card card">
                <h4 class="reward-title">Компания года - 2018</h4>
                <p class="reward-text">По версии Общенационального Экономического Рейтинга</p>
                <a href="/company/news/defo_kompaniya_goda_2018/" class="arrow-link">Посмотреть новость <span></span></a>
            </div>
        </div>
    </div>


    <div class="top_block">
        <h3 class="title_block big">Принципы работы</h3>
    </div>

    <div class="row about-company principles">
        <div class="col-lg-12">
            <ul class="principles-list">
                <li class="principle">
                    <p class="principle-text">Быстрое решение вопросов через персонального менеджера</p>
                </li>
                <li class="principle">
                    <p class="principle-text">Индивидуальный подход к каждому проекту и гибкие условия сотрудничества</p>
                </li>
                <li class="principle">
                    <p class="principle-text">Лучшее соотношение цены и качества</p>
                </li>
                <li class="principle">
                    <p class="principle-text">Целостный подход к дизайну и комплексное решение любой задачи клиента</p>
                </li>
            </ul>
        </div>
    </div>

    <div class="top_block">
        <h3 class="title_block big">От идеи до воплощения</h3>
    </div>

    <div class="row about-company steps">
        <div class="col-lg-12">
            <ol class="steps-list">
                <li class="step">
                    <h4 class="step-title">Запрос клиента</h4>
                    <p class="step-text">Сделать запрос вы можете по телефону +7 (800) 505 45 79 или воспользовавшись <span class="animate-load" data-event="jqm" data-param-form_id="CALLBACK" data-name="CALLBACK" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">формой</span></p>
                </li>
                <li class="step">
                    <h4 class="step-title">Создание 3D-проекта</h4>
                    <p class="step-text">Бесплатное создание 3D-проекта вашего офиса нашим дизайн-бюро</p>
                    <a href="/services/dizayn-proekt/" class="arrow-link">Пример 3D-проекта <span></span></a>
                </li>
                <li class="step">
                    <h4 class="step-title">Тест-драйв мебели</h4>
                    <p class="step-text">Сделать запрос вы можете по телефону +7 (800) 505 45 79 или воспользовавшись <span class="animate-load" data-event="jqm" data-param-form_id="TEST_DRIVE" data-name="TEST_DRIVE" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">формой</span></p>
                </li>
                <li class="step">
                    <h4 class="step-title">Доставка и сборка</h4>
                    <p class="step-text">Бережная доставка собственным автотранспортом и профессиональная сборка</p>
                </li>
                <li class="step">
                    <h4 class="step-title">Постгарантийное обслуживание</h4>
                    <p class="step-text">Гарантийное и сервисное обслуживание после завершения проекта</p>
                </li>
            </ol>
        </div>
    </div>

    <div class="top_block">
        <h3 class="title_block big">Реализованные дизайн-проекты</h3>
    </div>

    <div class="row about-company design-projects completed_projects">
        <div class="row">
            <!--<div class="mixitup-container">-->
            <?$arFilter = array('IBLOCK_ID'=>16, 'ACTIVE' => 'Y', 'DEPTH_LEVEL' => 1);
            $arSelect = array('ID', 'SORT', 'IBLOCK_ID', 'NAME', 'SECTION_PAGE_URL');
            $arParentSections = CNextCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'ID' => 'ASC', 'CACHE' => array('TAG' => CNextCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'Y')), $arFilter, false, $arSelect);
            if($arParentSections)
            {
/*                $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/mixitup.min.js');*/
                $bHasSection = (isset($arSection['ID']) && $arSection['ID']);?>
                <div class="head-block top controls">
                    <div class="bottom_border"></div>
                    <div class="item-link <?=($bHasSection ? '' : 'active');?>">
                        <div class="title">
                            <?if($bHasSection):?>
                                <a class="btn-inline black" href="<?=$arResult['FOLDER'];?>">Все проекты</a>
                            <?else:?>
                                <span class="btn-inline black" data-filter="all">Все проекты</span>
                            <?endif;?>
                        </div>
                    </div>
                    <?$cur_page = $GLOBALS['APPLICATION']->GetCurPage(true);
                    $cur_page_no_index = $GLOBALS['APPLICATION']->GetCurPage(false);?>

                    <?foreach($arParentSections as $arParentItem):?>

                        <?$bSelected = ($bHasSection && CMenu::IsItemSelected($arParentItem['SECTION_PAGE_URL'], $cur_page, $cur_page_no_index));?>
                        <div class="item-link <?=($bSelected ? 'active' : '');?>">
                            <div class="title btn-inline black">
                                <?if(!$bHasSection):?>
                                    <span class="btn-inline black" data-filter=".s-<?=$arParentItem['ID']?>"><?=$arParentItem['NAME'];?></span>
                                <?else:?>
                                    <?if($bSelected):?>
                                        <span class="btn-inline black"><?=$arParentItem['NAME'];?></span>
                                    <?else:?>
                                        <a class="btn-inline black" href="<?=$arParentItem['SECTION_PAGE_URL'];?>"><?=$arParentItem['NAME'];?></a>
                                    <?endif;?>
                                <?endif;?>
                            </div>
                        </div>
                    <?endforeach;?>
                </div>
            <?}?>


            <?$APPLICATION->IncludeComponent(
                "bitrix:news.list",
                'news-project-company-page',
                Array(
                    "IMAGE_POSITION" => $arParams["IMAGE_POSITION"],
                    "SHOW_CHILD_SECTIONS" => $arParams["SHOW_CHILD_SECTIONS"],
                    "DEPTH_LEVEL" => 1,
                    "LINE_ELEMENT_COUNT_LIST" => $arParams["LINE_ELEMENT_COUNT_LIST"],
                    "IMAGE_WIDE" => $arParams["IMAGE_WIDE"],
                    "SHOW_SECTION_PREVIEW_DESCRIPTION" => $arParams["SHOW_SECTION_PREVIEW_DESCRIPTION"],
                    "IBLOCK_TYPE"	=>	$arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID"	=>	16,
                    "NEWS_COUNT"	=>	$arParams["NEWS_COUNT"],
                    "SORT_BY1"	=>	$arParams["SORT_BY1"],
                    "SORT_ORDER1"	=>	$arParams["SORT_ORDER1"],
                    "SORT_BY2"	=>	$arParams["SORT_BY2"],
                    "SORT_ORDER2"	=>	$arParams["SORT_ORDER2"],
                    "FIELD_CODE"	=>	$arParams["LIST_FIELD_CODE"],
                    "PROPERTY_CODE"	=>	$arParams["LIST_PROPERTY_CODE"],
                    "DISPLAY_PANEL"	=>	$arParams["DISPLAY_PANEL"],
                    "SET_TITLE"	=>	"N", //$arParams["SET_TITLE"],
                    "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                    "INCLUDE_IBLOCK_INTO_CHAIN"	=> "N", //	$arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
                    "CACHE_TYPE"	=>	$arParams["CACHE_TYPE"],
                    "CACHE_TIME"	=>	$arParams["CACHE_TIME"],
                    "CACHE_FILTER"	=>	$arParams["CACHE_FILTER"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "DISPLAY_TOP_PAGER"	=>	$arParams["DISPLAY_TOP_PAGER"],
                    "DISPLAY_BOTTOM_PAGER"	=>	$arParams["DISPLAY_BOTTOM_PAGER"],
                    "PAGER_TITLE"	=>	"N", //$arParams["PAGER_TITLE"],
                    "PAGER_TEMPLATE"	=>	$arParams["PAGER_TEMPLATE"],
                    "PAGER_SHOW_ALWAYS"	=>	$arParams["PAGER_SHOW_ALWAYS"],
                    "PAGER_DESC_NUMBERING"	=>	$arParams["PAGER_DESC_NUMBERING"],
                    "PAGER_DESC_NUMBERING_CACHE_TIME"	=>	$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                    "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                    "DISPLAY_DATE"	=>	$arParams["DISPLAY_DATE"],
                    "DISPLAY_NAME"	=>	$arParams["DISPLAY_NAME"],
                    "DISPLAY_PICTURE"	=>	$arParams["DISPLAY_PICTURE"],
                    "DISPLAY_PREVIEW_TEXT"	=>	$arParams["DISPLAY_PREVIEW_TEXT"],
                    "PREVIEW_TRUNCATE_LEN"	=>	$arParams["PREVIEW_TRUNCATE_LEN"],
                    "ACTIVE_DATE_FORMAT"	=>	$arParams["LIST_ACTIVE_DATE_FORMAT"],
                    "USE_PERMISSIONS"	=>	$arParams["USE_PERMISSIONS"],
                    "GROUP_PERMISSIONS"	=>	$arParams["GROUP_PERMISSIONS"],
                    "SHOW_DETAIL_LINK"	=>	$arParams["SHOW_DETAIL_LINK"],
                    "FILTER_NAME"	=>	$arParams["FILTER_NAME"],
                    "HIDE_LINK_WHEN_NO_DETAIL"	=>	$arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                    "CHECK_DATES"	=>	$arParams["CHECK_DATES"],
                    "PARENT_SECTION"	=>	$arResult["VARIABLES"]["SECTION_ID"],
                    "PARENT_SECTION_CODE"	=>	$arResult["VARIABLES"]["SECTION_CODE"],
                    "DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
                    "SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                    "IBLOCK_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                    "INCLUDE_SUBSECTIONS" => "N",
			"ADD_SECTIONS_CHAIN" => "N",
			"SET_BROWSER_TITLE" => "N"
                ),
                $component
            );?>
            <!--</div>-->



            <!--<div class="col-lg-3 design-project-card">
                <img src="/images/design-project/caricino.jpg" alt="" width="312" href="200">
                <h4 class="design-name">Царицино</h4>
                <p class="design-description">Описание проекта</p>
            </div>
            <div class="col-lg-3 design-project-card">
                <img src="/images/design-project/lazurit.jpg" alt="" width="312" href="200">
                <h4 class="design-name">Лазурит</h4>
                <p class="design-description">Описание проекта</p>
            </div>
            <div class="col-lg-3 design-project-card">
                <img src="/images/design-project/mkco.jpg" alt="" width="312" href="200">
                <h4 class="design-name">МКЦО</h4>
                <p class="design-description">Описание проекта</p>
            </div>
            <div class="col-lg-3 design-project-card">
                <img src="/images/design-project/zulcer.jpg" alt="" width="312" href="200">
                <h4 class="design-name">Зульцер</h4>
                <p class="design-description">Описание проекта</p>
            </div>-->
        </div>
        <div class="row">
            <div class="col-lg-12 design-project-btn">
                <p>Заказать бесплатный дизайн-проект</p>
                <span class="animate-load red-btn" data-event="jqm" data-param-form_id="DESIGN_PROJECT" data-name="DESIGN_PROJECT" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Заказать</span>
            </div>
        </div>
    </div>

    <div class="top_block">
        <h3 class="title_block big">Преимущества работы с ДЭФО</h3>
    </div>

    <div class="row about-company advantages-cards">
        <div class="row">
            <div class="col-lg-4 advantage-card card">
                <a href="/company/advantage/always_available/" class="advantage-card-text">Поставка мебели из наличия в кратчайшие сроки</a>
            </div>
            <div class="col-lg-4 advantage-card card">
                <a href="/services/dizayn-proekt/" class="advantage-card-text">Бесплатный дизайн-проект<br> помещения в 3D</a>
            </div>
            <div class="col-lg-4 advantage-card card">
                <a href="/services/" class="advantage-card-text">Полный комплекс сервисных услуг: доставка, сборка и т.д.</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 advantage-card card">
                <a href="/services/vyezd-spetsialista/" class="advantage-card-text">Возможность производства мебели по индивидуальному проекту</a>
            </div>
            <div class="col-lg-4 advantage-card card">
                <a href="/company/advantage/10_years_warranty/" class="advantage-card-text">Расширенная гарантия до 10 лет на мебель и до 5 лет на кресла</a>
            </div>
            <div class="col-lg-4 advantage-card card">
                <a href="/company/b2g/" class="advantage-card-text">Полное сопровождение контрактов по 223-ФЗ и 44-ФЗ</a>
            </div>
        </div>
    </div>

    <div class="top_block">
        <h3 class="title_block big tabs-title">Прайс-листы и презентации</h3>
    </div>

    <div class="row products-tabs">
        <div class="col-lg-12 products-tabs-card card">
            <div class="row products-tabs-content">
                <div class="col-lg-2 tabs-list-wrap">
                    <ul class="tabs-list">
                        <li class="tabs-item"><a href="">Мебель для офиса</a></li>
                        <li class="tabs-item active"><a href="">Кресла и стулья</a></li>
                        <li class="tabs-item"><a href="">Мебель для приемных</a></li>
                        <li class="tabs-item"><a href="">Переговорки</a></li>
                        <li class="tabs-item"><a href="">Мягкая мебель</a></li>
                    </ul>
                </div>
                <div class="col-lg-5 products-tabs-wrap">
                    <ul class="products-list">
                        <li class="products-item"><a href="">Тревизо</a></li>
                        <li class="products-item"><a href="">Ларус</a></li>
                        <li class="products-item active"><a href="">Пингеко</a></li>
                        <li class="products-item"><a href="">Гемсоун</a></li>
                        <li class="products-item"><a href="">Спич</a></li>
                        <li class="products-item"><a href="">Венеция</a></li>
                        <li class="products-item"><a href="">Прего</a></li>
                        <li class="products-item"><a href="">Плаза</a></li>
                        <li class="products-item"><a href="">Таурус</a></li>
                        <li class="products-item"><a href="">Смартекст</a></li>
                        <li class="products-item"><a href="">Вегас</a></li>
                        <li class="products-item"><a href="">Мастер</a></li>
                        <li class="products-item"><a href="">Нортон</a></li>
                        <li class="products-item"><a href="">Ричмонд</a></li>
                        <li class="products-item"><a href="">Лофт</a></li>
                    </ul>
                    <ul class="products-list">
                        <li class="products-item"><a href="">Тревизо</a></li>
                        <li class="products-item"><a href="">Ларус</a></li>
                        <li class="products-item"><a href="">Пингеко</a></li>
                        <li class="products-item"><a href="">Гемсоун</a></li>
                        <li class="products-item"><a href="">Спич</a></li>
                        <li class="products-item"><a href="">Венеция</a></li>
                        <li class="products-item"><a href="">Прего</a></li>
                        <li class="products-item"><a href="">Плаза</a></li>
                        <li class="products-item"><a href="">Таурус</a></li>
                        <li class="products-item"><a href="">Смартекст</a></li>
                        <li class="products-item"><a href="">Вегас</a></li>
                        <li class="products-item"><a href="">Мастер</a></li>
                        <li class="products-item"><a href="">Нортон</a></li>
                        <li class="products-item"><a href="">Ричмонд</a></li>
                        <li class="products-item"><a href="">Лофт</a></li>
                    </ul>
                </div>
                <div class="col-lg-5 product-demo">
                    <img class="product-demo-img" src="/images/iq.jpg" alt="" width="441" height="630">
                    <ul class="product-demo-documents">
                        <li>
                            <a class="document pdf" href="">Описание товара согласно ФЗ-223 <span class="doc-size">12,41 МБ</span></a>
                        </li>
                        <li>
                            <a class="document pdf" href="">Описание товара согласно ФЗ-44 <span class="doc-size">37,29 МБ</span></a>
                        </li>
                        <li>
                            <a class="document pdf" href="">Презентация <span class="doc-size">43,95 МБ</span></a>
                        </li>
                        <li>
                            <a class="document pdf" href="">Прайс-лист <span class="doc-size">37,29 МБ</span></a>
                        </li>
                        <li class="link-wrap">
                            <a href="" class="arrow-link">Скачать одним архивом<span></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 link-block"><a href="/catalog" class="arrow-link">Перейти в каталог<span></span></a></div>
            </div>
        </div>
    </div>

    <div class="top_block">
        <h3 class="title_block big">Каталоги</h3>
    </div>

    <div class="row about-company catalog">
        <div class="col-lg-3 catalog-item">
            <a href="/documents/catalog-1.pdf" download>
                <img src="/images/catalog-1.jpg" alt="" class="catalog-img" width="232" height="232">
                <h3 class="catalog-name">Офисная мебель</h3>
                <span class="year">2018</span>
            </a>
        </div>
        <div class="col-lg-3 catalog-item">
            <a href="/documents/catalog-2.pdf" download>
                <img src="/images/catalog-2.jpg" alt="" class="catalog-img" width="232" height="232">
                <h3 class="catalog-name">Мебель для руководителя</h3>
                <span class="year">2019</span>
            </a>
        </div>
        <div class="col-lg-3 catalog-item">
            <a href="/documents/catalog-3.pdf" download>
                <img src="/images/catalog-3.jpg" alt="" class="catalog-img" width="232" height="232">
                <h3 class="catalog-name">Мебель для дома</h3>
                <span class="year">2018</span>
            </a>
        </div>
        <div class="col-lg-3 catalog-item">
            <a href="/documents/catalog-4.pdf" download>
                <img src="/images/catalog-4.jpg" alt="" class="catalog-img" width="232" height="232">
                <h3 class="catalog-name">Портфолио дизайн-проектов</h3>
                <span class="year">2018</span>
            </a>
        </div>
    </div>

    <div class="top_block">
        <h3 class="title_block big">Разработка и производство</h3>
    </div>

    <div class="row about-company awards">
        <div class="columns principles">
            <div class="col-lg-8">
                <ul class="principles-list develop">
                    <li class="principle">
                        <p class="principle-text">3 мебельные фабрики в России и Белоруссии по производству корпусной мебели</p>
                    </li>
                    <li class="principle">
                        <p class="principle-text">Контрактные производства кресел в России и Китае</p>
                    </li>
                    <li class="principle">
                        <p class="principle-text">Эксклюзивный представитель итальянских фабрик</p>
                    </li>
                    <li class="principle">
                        <p class="principle-text">Отслеживаем и внедряем последние  тренды в дизайне офисной мебели</p>
                    </li>
                    <li class="principle">
                        <p class="principle-text">Изготавливаем мебель по индивидуальному дизайну</p>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 progress-card card">
                <ul>
                    <li class="progress-card-item">
                        <h2><a href="/company/licenses/" class="progress-card-title">Достижения</a></h2>
                    </li>
                    <li class="progress-card-item">
                        <h3 class="progress-card-subtitle">Добросовестный поставщик</h3>
                        <p class="progress-card-text">Лауреат конкурса "Добросовестный поствавщик" 2010-2018</p>
                    </li>
                    <li class="progress-card-item">
                        <h3 class="progress-card-subtitle">Компания года 2018</h3>
                        <p class="progress-card-text">Лауреат общенационального экономического рейтинга 2018</p>
                    </li>
                    <li class="progress-card-item">
                        <h3 class="progress-card-subtitle">Гарант качества и надежности</h3>
                        <p class="progress-card-text">Сертифицированный обладатель звания "Надежная российская компания" 2018</p>
                    </li>
                    <li class="progress-card-item">
                        <h3 class="progress-card-subtitle">WORK SPACE</h3>
                        <p class="progress-card-text">Финалист конкурса в области промышленного дизайна мебели ARTLIGA-2016, 2017</p>
                    </li>
                    <li class="progress-card-item">
                        <h3 class="progress-card-subtitle">Соответсвуем требованиям</h3>
                        <p class="progress-card-text">По сертификату соответствия</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="top_block">
        <h3 class="title_block big">Наши награды</h3>
    </div>

    <div class="row about-company awards">
        <div class="col-md-12">
            <img src="/bitrix/templates/aspro_next_b2c/images/about/nagrady.jpg" width="1344" height="764">
        </div>
    </div>

    <!--партнеры-->
    <div class="maxwidth-theme partners-company">

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


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>