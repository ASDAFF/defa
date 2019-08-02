<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
//x5 20190702
$arResult['REGION_ID'] = 0;
if(\Bitrix\Main\Loader::includeModule('aspro.next')){
    $arResult['CURRENT_REGION'] = CNextRegionality::getCurrentRegion();
    $arResult['REAL_REGION'] = CNextRegionality::getRealRegionByIP();
    $arResult['IS_REGION_SELECTED'] = isset($_COOKIE['current_region']) && $_COOKIE['current_region'];
    if($arResult['IS_REGION_SELECTED']) $arResult['REGION_ID'] = $_COOKIE['current_region'];
    elseif($arResult['REAL_REGION']) $arResult['REGION_ID'] = $arResult['REAL_REGION']['ID'];
    elseif($arResult['CURRENT_REGION']) $arResult['REGION_ID'] = $arResult['CURRENT_REGION']['ID'];
 }