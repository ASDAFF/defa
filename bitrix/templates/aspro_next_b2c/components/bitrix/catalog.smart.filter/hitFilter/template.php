<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

foreach ($arResult['ITEMS'] as $arItem) {
    if ($arItem['CODE'] == 'HIT') {
        $arHit = $arItem;
    }
}
?>

<div class="sort-list-wrapper">
    <form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get"
          class="smartfilter">
        <? foreach ($arResult["HIDDEN"] as $arItem): ?>
            <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
                   value="<? echo $arItem["HTML_VALUE"] ?>"/>
        <? endforeach; ?>

        <ul class="sort-list quick_filter">
            <? foreach ($arHit["VALUES"] as $val => $ar): ?>
                <li class="sort-item ">
                    <input
                            hidden
                            type="checkbox"
                            value="<? echo $ar["HTML_VALUE"] ?>"
                            name="<? echo $ar["CONTROL_NAME"] ?>"
                            id="<? echo $ar["CONTROL_ID"] ?>"
                        <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                    />

                    <label data-role="label_<?= $ar["CONTROL_ID"] ?>"
                           for="<?= $ar['CONTROL_ID'] ?>"><?= $ar['VALUE'] ?></label>
                </li>
            <? endforeach; ?>
        </ul>
        <div class="quick_filter">


            <input
                    class="btn btn-themes"
                    type="submit"
                    name="set_filter"
                    value="<?= GetMessage("CT_BCSF_SET_FILTER") ?>"
            />
            <input
                    class="btn btn-link"
                    type="submit"
                    name="del_filter"
                    value="<?= GetMessage("CT_BCSF_DEL_FILTER") ?>"
            />
        </div>
    </form>
</div>

