<!-- алфавитное меню-->
<div class="alphabet-menu-wrapper">
    <ul class="alphabet-list">

        <?php foreach ($arResult["LETTERS"] as $letter => $data) { ?>
            <li class="alphabet-item">
                <span class="alphabet-toggle">
                    <?= $letter ?>
                </span>
                <ul class="alphabet-hide">
                    <li class="alphabet-hide-item alphabet-choice">
                        <ul class="alphabet-hide-list">
                            <? if (count($data["SECTIONS"])) { ?>
                                <li class="alphabet-hide-title">
                                    <h5>Разделы</h5>
                                </li>
                                <? foreach ($data["SECTIONS"] as $section) { ?>
                                    <li class="alphabet-hide-list-item">
                                        <p>
                                            <a href="<?= $section["SECTION_PAGE_URL"] ?>">
                                                <?= $section["NAME"] ?>
                                            </a>

                                        </p>
                                    </li>
                                <? } ?>
                            <? } ?>
                        </ul>
                        <ul class="alphabet-hide-list">
                            <? if (count($data["SERIES"])) { ?>
                                <li class="alphabet-hide-title">
                                    <h5>Серии</h5>
                                </li>
                                <? foreach ($data["SERIES"] as $seria) { ?>
                                    <li data-type="section" data-id="<?= $seria["ID"] ?>"
                                        class="alphabet-hide-list-item seria_hover">
                                        <p>
                                            <?= $seria["NAME"] ?>
                                        </p>
                                    </li>
                                <? } ?>
                            <? } ?>
                        </ul>
                        <ul class="alphabet-hide-list">
                            <? if (count($data["ELEMENTS"])) { ?>
                                <li class="alphabet-hide-title">
                                    <h5>Товары</h5>
                                </li>
                                <? foreach ($data["ELEMENTS"] as $element) { ?>
                                    <li data-type="element" data-id="<?= $element["ID"] ?>"
                                        class="alphabet-hide-list-item element_hover">
                                        <p>
                                            <?= $element["NAME"] ?>
                                        </p>
                                    </li>
                                <? } ?>
                            <? } ?>
                        </ul>
                    </li>
                    <li class="alphabet-hide-item alphabet-demo">

                    </li>
                    <li class="alphabet-loader alphabet-hide-item">
                        <img src="/images/loader.gif" alt="">
                    </li>
                </ul>
            </li>
        <? } ?>
    </ul>
</div>
