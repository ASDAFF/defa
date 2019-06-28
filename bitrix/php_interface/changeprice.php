<?php
/**
 * Created by PhpStorm.
 * User: web3
 * Date: 26.10.2018
 * Time: 12:51
 */

$interval = 60*60; //60*60 = 1 час
$idate = date('Y-m-d H:i:s',strtotime("now") - $interval);

$arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_TIME_AC", "PROPERTY_TIME_RRC", "CATALOG_GROUP_1", "CATALOG_GROUP_2", "CATALOG_GROUP_4", "CATALOG_GROUP_5");
$arFilter = Array("IBLOCK_ID" => 17, array("LOGIC" => "OR", ">=PROPERTY_TIME_AC" =>  $idate, ">=PROPERTY_TIME_RRC" => $idate));
$db_res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

$allowedKeys = array("ID", "PROPERTY_TIME_AC_VALUE", "PROPERTY_TIME_RRC_VALUE", "CATALOG_PRICE_ID_1", "CATALOG_PRICE_ID_2", "CATALOG_PRICE_ID_4", "CATALOG_PRICE_ID_5", "CATALOG_PRICE_1", "CATALOG_PRICE_2", "CATALOG_PRICE_4", "CATALOG_PRICE_5" );

while ($item = $db_res->Fetch()){
    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/bitrix/changePriceId.log", "a+");
    $time = date("d.m.Y H:i:s");
    fwrite($fp, $time."; ".$item["ID"]."\n");
    fclose($fp);
    $item = array_intersect_key($item, array_flip($allowedKeys));
    $flagChangeAc = (strtotime($item["PROPERTY_TIME_AC_VALUE"]) > strtotime($idate));
//0:
    if ($flagChangeAc){
        //echo "АЦ изменилась!<br>";
//1:
        if ($item["CATALOG_PRICE_5"] > 0){
//3:
            //echo "Устанавливаем Розничную = АЦ<br>";
//!надо будет заменить 6 на 1!
                priceChange($item["ID"], 6, $item["CATALOG_PRICE_ID_6"], $item["CATALOG_PRICE_5"], $item["CATALOG_PRICE_6"]);
            //echo "Устанавливаем Старую = РРЦ<br>";
//!надо будет заменить 7 на 2!
                priceChange($item["ID"], 7, $item["CATALOG_PRICE_ID_7"], $item["CATALOG_PRICE_4"], $item["CATALOG_PRICE_7"]);
        }else{
//4:
            //echo "Устанавливаем Розничную = РРЦ<br>";
//!надо будет заменить 6 на 1!
                priceChange($item["ID"], 6, $item["CATALOG_PRICE_ID_6"], $item["CATALOG_PRICE_4"], $item["CATALOG_PRICE_6"]);
            //echo "Устанавливаем Старую = 0 (удаляем)<br>";
//!надо будет заменить 7 на 2!
                \Bitrix\Catalog\Model\Price::delete($item["CATALOG_PRICE_ID_7"]);
                $fp = fopen ($_SERVER['DOCUMENT_ROOT']."/bitrix/changePrice.log", "a+");
            fwrite($fp, $time."; ".sprintf("%' 6d",$element_id)." del___: 7 oldprice: "."\n");
        }
    }else{
//2:
        //echo "АЦ не изменилась!<br>";
        $flagChangeRRC = (strtotime($item["PROPERTY_TIME_RRC_VALUE"]) > strtotime($idate));
        if ($flagChangeRRC){
//5:
            //echo "РРЦ изменилась!<br>";
            echo $item["CATALOG_PRICE_5"]."<br>";
            if ($item["CATALOG_PRICE_5"] > 0){ // АЦ
//6:
                //echo "Устанавливаем Старую = РРЦ<br>";
//!надо будет заменить 7 на 2!
                    priceChange($item["ID"], 7, $item["CATALOG_PRICE_ID_7"], $item["CATALOG_PRICE_4"], $item["CATALOG_PRICE_7"]);

            }else{
//7:
                //echo "Устанавливаем Розничную = РРЦ<br>";
//!надо будет заменить 6 на 1!
                priceChange($item["ID"], 6, $item["CATALOG_PRICE_ID_6"], $item["CATALOG_PRICE_4"], $item["CATALOG_PRICE_6"]);
            }
        }else{
            //echo "РРЦ не изменилась!<br>";
            //echo "End<br>";
        }
    }
}
function priceChange($element_id, $priceType, $price_id, $price, $oldprice)
{
    $type = array(1 => "base", 2 => "oldprice", 4 => "rrc", 5 => "ac", 6 => "tst:base", 7 => "tst:oldprice");
    $fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/bitrix/changePrice.log", "a+");
    $time = date("d.m.Y H:i:s");

    if ($price != $oldprice) {
        $arFields = Array("PRODUCT_ID" => $element_id, "CATALOG_GROUP_ID" => $priceType, "PRICE" => $price, "CURRENCY" => "RUB");
        if ($price_id) {
            \Bitrix\Catalog\Model\Price::update($price_id, $arFields);
            fwrite($fp, $time . "; " . sprintf("%' 6d", $element_id) . " update: $priceType: " . sprintf("%' 12s", $type[$priceType]) . "; new: " . sprintf("%' 6d", $price) . ", old: " . sprintf("%' 6d", $oldprice) . "\n");
        } else {
            \Bitrix\Catalog\Model\Price::add($arFields);
            fwrite($fp, $time . "; " . sprintf("%' 6d", $element_id) . " add___: $priceType: " . sprintf("%' 12s", $type[$priceType]) . "; new: " . sprintf("%' 6d", $price) . ", old: " . sprintf("%' 6d", $oldprice) . "\n");
        }

    } else {
    fwrite($fp, $time."; ".sprintf("%' 6d", $element_id)."\n");
    }
    fclose($fp);
}