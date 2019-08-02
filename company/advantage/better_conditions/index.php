<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Лучшее предложение цена/качество");
?>


    <div class="row">
        <div class="row price-quality">
            <div class="col-lg-12">
                <h2>Мы побьем любые цены</h2>
                <p>«ДЭФО» стремится сделать максимум для того, чтобы вы могли приобрести на одном сайте качественную и красивую офисную мебель по выгодной стоимости.</p>
                <p>Мы предлагаем нашим клиентам гибкие условия сотрудничества благодаря продуманной производственной программе. Ваш персональный менеджер с радостью проконсультирует Вас по условиям работы, скидкам, отсрочкам платежа и другим вопросам.</p>
                <p>Мы на практике реализуем принцип индивидуального подхода – для нас ценен каждый клиент вне зависимости от стоимости проекта.</p>
                <p>Также в «ДЭФО» действует постоянная акция «Мы побьем любые цены». Нашли на другом сайте аналогичный товар дешевле? - Сообщите нам об этом, и мы предложим еще более выгодную цену.</p>
                <p>Условия акции:</p>
                <ul>
                    <li>необходимо предоставить ссылку на товар с сайта-конкурента;</li>
                    <li>продукция должна быть идентичной;</li>
                    <li>узнать подобнее Вы можете по телефону или в онлайн-чате.</li>
                </ul>

                <span class="animate-load red-btn red-btn-center" data-event="jqm" data-param-form_id="BEAT_PRICES" data-name="BEAT_PRICES" data-autoload-product_name="<?=CNextB2c::formatJsName($arResult["NAME"]);?>" data-autoload-product_id="<?=$arResult["ID"];?>">Побить цену</span>

            </div>
        </div>
        <div class="row price-quality">
            <h2>Преимущества работы с нами</h2>
            <div class="col-md-6 advantage-wrapp-img">
                <img src="/images/advantages/soluciones-penales.jpg" class="price-quality-img" alt="" width="663" height="268">
            </div>
            <div class="col-md-6 advantage-wrapp-text">
                <ul class="simple-list">
                    <li>Предложим лучшие цены и сервис на рынке.</li>
                    <li>Составим индивидуальное предложение на основе ваших интересов.</li>
                    <li>Бесплатно разработаем дизайн-проект помещения.</li>
                    <li>Предоставим образцы текстур и фактур в Вашем офисе.</li>
                    <li>Доставим и соберем мебель согласно плану.</li>
                </ul>
            </div>
        </div>
        <div class="row price-quality">
            <div class="col-md-12">
                <h2>Компания “ДЭФО” Лидер поставки мебели в России</h2>
                <p>
                    Мы являемся победителями и лауреатами множества профессиональных конкурсов как регионального, так и федерального значения. Впервые компания стала лауреатом Общенационального Экономического Рейтинга, учрежденного два года назад, и получила престижный статус – «Компания года-2018». В 2018 году компания ДЭФО снова подтвердила свое звание Добросовестного и Надежного поставщика мебели и была внесена в Федеральный реестр.
                </p>
            </div>
        </div>
        <div class="row price-quality">
            <div class="col-md-3 price-quality-item company-2018">
                <p>
                    ДЭФО - компания года-2018!
                </p>
            </div>
            <div class="col-md-3 price-quality-item provider">
                <p>
                    Добросовестный поставщик с 2011 года
                </p>
            </div>
            <div class="col-md-3 price-quality-item leader">
                <p>
                    Лидер отрасли 2014-2018
                </p>
            </div>
            <div class="col-md-3 price-quality-item guaranty-quality">
                <p>
                    Гарант качества и надежности
                </p>
            </div>
        </div>
        <div class="row price-quality">
            <div class="col-md-12">
                <p class="defo_advantages">
                    ДЭФО сохраняет за собой этот статус уже 8 лет, что говорит о стабильном развитии компании.
                </p>
            </div>
        </div>
        <div class="row price-quality">
            <h2>Качество нашей продукции</h2>
            <ul class="quality-list">
                <li>
                    <p class="europe">
                        Европейское качество
                    </p>
                </li>
                <li>
                    <p class="nature-tree">
                        Натуральное дерево
                    </p>
                </li>
                <li>
                    <p class="nature-skin">
                        Натуральная кожа
                    </p>
                </li>
                <li>
                    <p class="prof">
                        Профессиональная сборка
                    </p>
                </li>
                <li>
                    <p class="guaranty-10">
                        Гарантия до 10 лет
                    </p>
                </li>
            </ul>
        </div>
        <div class="row price-quality">
            <h2>Доступные цены для всех клиентов</h2>
            <div class="col-md-12 a11y-price">
                <div>
                    <p>
                        Подбор мебели из расчета ценового бюджета госзаказа
                    </p>
                </div>
                <img src="http://placehold.it/649x268" alt="">
            </div>
            <div class="col-md-12 a11y-price">
                <div>
                    <p>
                        Подбор мебели для реализации индивидуального дизайн-проекта
                    </p>
                </div>
                <img src="http://placehold.it/649x268" alt="">
            </div>
            <div class="col-md-12 a11y-price">
                <div>
                    <p>
                        Подбор мебели с учетом статуса компании и бизнес-процессов
                    </p>
                </div>
                <img src="http://placehold.it/649x268" alt="">
            </div>
        </div>

    </div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>