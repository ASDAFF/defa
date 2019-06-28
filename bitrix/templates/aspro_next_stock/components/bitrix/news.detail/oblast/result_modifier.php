<?php
/**
 * @var array $arResult
 */

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {

    die();
}

// LATER: set task for content manager
foreach ($arResult['PROPERTIES'] as &$arProperty) {
    if (is_array($arProperty['VALUE'])) {
        foreach ($arProperty['VALUE'] as &$value) {
            $value = str_replace('₽', 'руб.', $value);
        }
    } else {
        $arProperty['VALUE'] = str_replace('₽', 'руб.', $arProperty['VALUE']);
    }
}