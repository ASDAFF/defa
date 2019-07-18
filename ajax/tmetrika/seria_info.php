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

$description = Str::words(strip_tags($seria["~DESCRIPTION"]), 20);

$photos = array_slice($photos, 0, 4);

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

$parent = CIBlockSection::GetByID($seria["IBLOCK_SECTION_ID"])->GetNext();

?>

<div class="alphabet-demo-series alphabet-demo-item active">

    <div hidden><?= $seria["ID"] ?></div>

    <div class="column img">
        <h3 class="series-name">
            <?= $seria["NAME"] ?>
        </h3>
        <h4 class="series-subname">
            <?= $parent["NAME"] ?>
        </h4>
        <div class="series-slider-wrapper">
            <div class="main-img main-slide">
                <img src="<?= CFile::GetPath($seria["PICTURE"]) ?>" class="series-item__main-photo">
            </div>
            <div class="toggle-img">
                <? foreach ($photos as $photo) { ?>
                    <div class="toggle-img-item">
                        <img src="<?= CFile::GetPath($photo) ?>">
                    </div>
                <? } ?>
            </div>
        </div>
    </div>
    <div class="column info">
        <p class="series-item-info">
            <?= $description ?>
        </p>
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
            <a class="btn" href="<?= $seria["SECTION_PAGE_URL"] ?>">
                Подробнее о серии
            </a>
        </div>
    </div>

</div>
