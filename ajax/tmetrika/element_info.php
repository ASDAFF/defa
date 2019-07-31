<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Tmetrika\Offer;
use Tmetrika\Product;

$hideProps = array("SERVICES", "BRAND", "HIT", "RECOMMEND", "NEW", "STOCK", "VIDEO", "VIDEO_YOUTUBE", "CML2_ARTICLE", "POPUP_VIDEO");

$Product = new Product($_REQUEST["id"]);

$Offer = $Product->Offers[0];
?>

<div class="alphabet-demo-product alphabet-demo-item active">

    <div hidden> <?= $fields["DETAIL_PAGE_URL"] ?></div>

    <div class="column img">
        <div class="product-img-wrap">
            <img src="<?= $Product->detailPicture() ?>" alt="" title="" class="product-photo">
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
            <?if($Offer->saleValue()):?>
            <span class="price"><?=$Product->discountValue()?> &#8381;</span>
            <span class="old-price"><?=$Product->getMinPrice(true)?></span>

            <span class="sale">-<?=$Offer->saleValue()?>%</span>
            <?else:?>
                <span class="price"><?=$Product->getMinPrice(true)?>&#8381;</span>
            <?endif?>
        </div>
        <a href="" class="blue-link">Гарантируем лучшие условия</a>

        <div class="color-wrap">
            <span>Цвета и отделки:</span>
            <div class="colors-wrapper">
                <? /** @var Offer $locOffer */
                foreach ($Product->Offers as $locOffer):?>
                <div class="color-item">
                    <img src="<?=$locOffer->getColor()->getFile(['width' => 33,'height' => 33])?>" alt="">
                </div>
                <?endforeach?>
            </div>
            <a href="" class="blue-link">Нужен в другом цвете?</a>
        </div>
    </div>
    <div class="column info">

        <!-- акции -->
        <? foreach ($Product->Actions() as $saleId) {
            $sale = CIBlockElement::GetByID($saleId)->GetNextElement();

            $saleProps = $sale->GetProperties();
            $saleFields = $sale->GetFields();

            $img = CFile::GetPath($saleFields["PREVIEW_PICTURE"]);
            ?>
            <div class="another-sale">

                <a href="<?= $saleFields["DETAIL_PAGE_URL"] ?>">
                    <img class="another-sale_img" src="<?= $img ?>" alt=""> <?= $saleFields["NAME"] ?>
                </a>
            </div>
        <? } ?>
        <ul class="characters">
            <? foreach ($Product->product['PROPS'] as $item) {
                $showProperty = $item["USER_TYPE"] === null &&
                    data_get($item, "VALUE") &&
                    $item["PROPERTY_TYPE"] !== "F" &&
                    !is_array(data_get($item, "VALUE")) &&
                    !in_array($item["CODE"], $hideProps);

                if ($showProperty) { ?>
                    <li>
                        <?= data_get($item, "NAME") ?>: <?= data_get($item, "VALUE") ?>
                    </li>
                <? } ?>
            <? } ?>
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
        <? if ($Product->Schema()) { ?>
            <div class="product_scheme">
                <img src="<?= $Product->Schema() ?>"
                     alt="product scheme defo.ru" class="product_scheme__img">
            </div>
        <? } ?>

    </div>
</div>
