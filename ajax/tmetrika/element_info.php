<?php

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$element = CIBlockElement::GetByID($_POST["id"])->GetNextElement();
$fields = $element->GetFields();
$properties = $element->GetProperties();

$detailPicture = CFile::GetPath($fields["DETAIL_PICTURE"]);

?>

<div class="alphabet-demo-product alphabet-demo-item active">
    <div class="column img">
        <div class="product-img-wrap">
            <img src="<?= $detailPicture ?>" alt="" title="" class="product-photo">
        </div>
        <h3 class="product-name">
            <?= $fields["NAME"] ?>
        </h3>
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
