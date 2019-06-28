<?
foreach ($arResult["OFFER"] as $num => &$arOffer)
{
    if ($arParams["PHOTO_CHECK"]=="Y" and empty($arOffer["PICTURE"]) and count($arOffer["MORE_PHOTO"])==0){
        unset($arResult["OFFER"][$num]);
    }
//fill product category
    $categoryId = $arOffer["CATEGORY"];
    $arOffer["CATEGORY"] = $arResult["CATEGORIES"][$categoryId]["NAME"];

    while ($categoryId = $arResult["CATEGORIES"][$categoryId]["PARENT"]) {
        $arOffer["CATEGORY"] = $arResult["CATEGORIES"][$categoryId]["NAME"] . ' &gt; ' . $arOffer["CATEGORY"];
    }

//fill product brand
    $props = CIBlockElement::GetProperty($arOffer["IBLOCK_ID"], $arOffer["ID"], array("sort" => "asc"), Array("CODE" => $arParams["DEVELOPER"]))->GetNext();
    $arOffer["DISPLAY_PROPERTIES"][$arParams["DEVELOPER"]] = CIBlockFormatProperties::GetDisplayValue($arResult["OFFER"], $props, "ym_out");
    $arOffer["DISPLAY_PROPERTIES"][$arParams["DEVELOPER"]]["DISPLAY_VALUE"] = $arOffer["DISPLAY_PROPERTIES"][$arParams["DEVELOPER"]]["VALUE_ENUM"] ? $arOffer["DISPLAY_PROPERTIES"][$arParams["DEVELOPER"]]["VALUE_ENUM"] : strip_tags($arOffer["DISPLAY_PROPERTIES"][$arParams["DEVELOPER"]]["DISPLAY_VALUE"]);
    unset($props);
}
?>