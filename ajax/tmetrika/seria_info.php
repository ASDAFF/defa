<?php

use Illuminate\Support\Str;

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$seria = CIBlockSection::GetList([], [
    "ID" => $_REQUEST["id"],
    "IBLOCK_ID" => 17 // todo вынести в константу
], false, [
    "UF_*",
])->GetNext();

$photos = [];

$gallery = CIBlockElement::GetByID($seria["UF_SERIES_GALLERY"])->GetNextElement();

if ($gallery) {
    $photos = $gallery->GetProperties()["PICTURES"]["VALUE"];
}

$photos = array_slice($photos, 0, 4);

$description = Str::words(strip_tags($seria["~DESCRIPTION"]), 20);

//todo в класс
$query = CIBlockElement::GetByID($seria["UF_PROS_SERIES"]);

$advantages = [];

if ($advantages) {
    while ($item = $query->GetNextElement()) {
        $advantages = [
            "NAME" => $item["NAME"],
            "ICON" => data_get($item->GetProperties(), "PROS_ICON.VALUE"),
        ];
    }
}
?>

<div class="alphabet-demo-series alphabet-demo-item active">
    <div class="column img">
        <h3 class="series-name">
            <?= $seria["NAME"] ?>
        </h3>
        <h4 class="series-subname">
            <?= $description ?>
        </h4>
        <div class="series-slider-wrapper">
            <div class="main-img main-slide">
                <img src="<?= CFile::GetPath($seria["PICTURE"]) ?>" alt="" width="1020" height="683"
                     class="series-item__main-photo">
            </div>
            <div class="toggle-img">
                <? foreach ($photos as $photo) { ?>
                    <div class="toggle-img-item">
                        <img src="<?= CFile::GetPath($photo) ?>" alt="" width="1020" height="683">
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
    <div class="column info">
        <p class="series-item-info">Серия для руководителей TREVIZO – это интерьер, способный
            заявить о чувстве вкуса своего владельца, но ни в коем случае не кричащий о нем.</p>
        <ul class="series-item-pros">
            <? foreach ($advantages as $advantage) { ?>
                <li class="series-item-pros-element">
                    <div class="pros-icon">
                        <img src="<?= $advantage["ICON"] ?>" alt="">
                    </div>
                    <span class="pros-text">
                        <?= $advantage["NAME"] ?>
                    </span>
                </li>
            <? } ?>
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
