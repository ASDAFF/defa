<!-- алфавитное меню-->
<div class="alphabet-menu-wrapper">
    <ul class="alphabet-list">

        <? foreach ($arResult["LETTERS"] as $letter => $data) { ?>
            <li class="alphabet-item">
                <span class="alphabet-toggle">
                    <?= $letter ?>
                </span>
                <ul class="alphabet-hide">
                    <li class="alphabet-hide-item alphabet-choice">
                        <ul class="alphabet-hide-list">
                            <li class="alphabet-hide-title">
                                <h5>Разделы</h5>
                            </li>
                            <? foreach ($data["SECTIONS"] as $section) { ?>
                                <li class="alphabet-hide-list-item">
                                    <p>
                                        <?= $section["NAME"] ?>
                                    </p>
                                </li>
                            <? } ?>
                        </ul>
                        <ul class="alphabet-hide-list">
                            <li class="alphabet-hide-title">
                                <h5>Серии</h5>
                            </li>
                            <? foreach ($data["SERIES"] as $seria) { ?>
                                <li class="alphabet-hide-list-item">
                                    <p>
                                        <?= $seria["NAME"] ?>
                                    </p>
                                </li>
                            <? } ?>
                        </ul>
                        <ul class="alphabet-hide-list">
                            <li class="alphabet-hide-title">
                                <h5>Товары</h5>
                            </li>
                            <? foreach ($data["ELEMENTS"] as $element) { ?>
                                <li class="alphabet-hide-list-item">
                                    <p><?= $element["NAME"] ?></p>
                                </li>
                            <? } ?>
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
                                        <span class="animate-load" data-event="jqm" data-param-form_id="SIMPLE_FORM_10"
                                              data-name="cheaper" data-autoload-product_name="IQ black"
                                              data-autoload-product_id="8901">Нужно быстрее?</span>
                                    </div>
                                </div>
                                <div class="product_scheme">
                                    <img src="/upload/iblock/e27/e276f068f4ec27b6ca8f979a94c3849d.jpg"
                                         alt="product scheme defo.ru" class="product_scheme__img">
                                </div>
                            </div>
                        </div>
                        <div class="alphabet-demo-series alphabet-demo-item active">
                            <div class="column img">
                                <h3 class="series-name">Нью-Вашингтон</h3>
                                <h4 class="series-subname">Президент-комплект для руководителя</h4>
                                <div class="series-slider-wrapper">
                                    <div class="main-img main-slide">
                                        <img src="/images/trevizo-demo.jpg" alt="" width="1020" height="683"
                                             class="series-item__main-photo">
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
                                <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный
                                    заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
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
                                                <div class="series-item-color-pic" data-title=""
                                                     style="background: url()">
                                                    <a href="#"
                                                       class="series-item-color-link series-item-color-link-main"
                                                       data-color-xml-id="">
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
                                                <div class="series-item-color-pic" data-title=""
                                                     style="background: url()">
                                                    <a href="#"
                                                       class="series-item-color-link series-item-color-link-add"
                                                       data-color-xml-id="">
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
        <? } ?>
    </ul>
</div>
