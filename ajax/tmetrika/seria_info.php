<?php

use Illuminate\Support\Str;
use Tmetrika\Section;

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");


$Section = new Section($_REQUEST["id"]);

$photos = [];

$gallery = CIBlockElement::GetByID($Section->Section["UF_SERIES_GALLERY"])->GetNextElement();

if ($gallery) {
    $photos = $gallery->GetProperties()["PICTURES"]["VALUE"];
}

$description = Str::words(strip_tags($Section->Section["~DESCRIPTION"]), 20);

$photos = array_slice($photos, 0, 4);

//todo в класс
$query = CIBlockElement::GetByID($Section->Section["UF_PROS_SERIES"]);

$advantages = [];

if ($advantages) {
    while ($item = $query->GetNextElement()) {
        $advantages = [
            "NAME" => $item["NAME"],
            "ICON" => data_get($item->GetProperties(), "PROS_ICON.VALUE"),
        ];
    }
}

$parent = CIBlockSection::GetByID($Section->Section["IBLOCK_SECTION_ID"])->GetNext();

?>

<div class="alphabet-demo-series alphabet-demo-item active">

    <div hidden><?= $Section->Section["ID"] ?></div>

    <div class="column img">
        <h3 class="series-name">
            <a href="<?= $Section->Section["SECTION_PAGE_URL"] ?>"><?= $Section->Section["NAME"] ?></a>
        </h3>
        <h4 class="series-subname">
            <a href="<?= $parent["SECTION_PAGE_URL"] ?>">
                <?= $parent["NAME"] ?>
            </a>

        </h4>
        <div class="series-slider-wrapper">
            <div class="main-img main-slide">
                <img src="<?= CFile::ResizeImageGet($Section->Section["PICTURE"], [
                    "width" => 300,
                    "height" => 300,
                ], BX_RESIZE_IMAGE_PROPORTIONAL)["src"] ?>" class="series-item__main-photo">
            </div>
            <div class="toggle-img">
                <? foreach ($photos as $photo) { ?>
                    <div class="toggle-img-item">
                        <img src="<?= CFile::ResizeImageGet($photo, [
                            "width" => 300,
                            "height" => 300,
                        ], BX_RESIZE_IMAGE_PROPORTIONAL)["src"] ?>">
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
            <? foreach ($Section->Advantages() as $advantage) { ?>
                <li class="series-item-pros-element">
                    <div class="pros-icon">
                        <img src="<?= $advantage->getFile(['width' => 50, 'height' => 50]) ?>" alt="">
                    </div>
                    <span class="pros-text">
                        <?= $advantage["UF_NAME"] ?>
                    </span>
                </li>
            <? } ?>
        </ul>
        <div class="colors-wrap">
            <div class="series-item-color-solutions">
                <h3>Цветовые решения</h3>
                <? foreach ($Section->getSeriaUniqueColors() as $color): ?>
                    <div class="series-item-color-content">
                        <div class="series-item-color-wrapper">
                            <div class="series-item-color-pic" data-title=""
                                 style="background: url()">
                                <a href="#"
                                   class="series-item-color-link series-item-color-link-main"
                                   data-color-xml-id="">
                                    <img width="90" height="60" src="<?= $color ?>" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                <? endforeach ?>
            </div>
            <div class="series-item-color-solutions">
                <h3>Дополнительные цвета</h3>
                <? foreach ($Section->getSeriaUniqueDopColors() as $color): ?>
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
                <? endforeach ?>
            </div>
        </div>
        <div class="series-item-buttons">
            <a class="btn" href="#">Заказать тест-драйв</a>
            <a class="btn" href="<?= $Section->Section["SECTION_PAGE_URL"] ?>">
                Подробнее о серии
            </a>
        </div>
    </div>

</div>
