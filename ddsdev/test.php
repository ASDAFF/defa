<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use Bitrix\Sale;
use Bitrix\Main,
    Bitrix\Iblock\Component\Element,
    Bitrix\Main\Localization\Loc,
    Bitrix\Catalog;
$intCurrentLocation = (int)CNextRegionalityB2c::getCurrentRegion()['LOCATION'];
if (!empty($intCurrentLocation) && $intCurrentLocation > 0) {
    $select = Array('ID', 'IBLOCK_ID','PROPERTY_REGION_TAG_REKVIZITY');
    $filter = Array('IBLOCK_ID' => 2, 'PROPERTY_LOCATION_LINK' => $intCurrentLocation);
    $res = CIBlockElement::GetList(Array(), $filter, false, Array("nPageSize" => 1), $select);
    $arLocation = $res->GetNext();
}
global $USER;
if($USER->IsAdmin()){
echo '<pre>',var_dump($arLocation),'</pre>';
}
/*
$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());

$fuser = new Sale\Discount\Context\Fuser($basket->getFUserId(true));
$discounts = Sale\Discount::buildFromBasket($basket, $fuser);
$discounts->calculate();
$result = $discounts->getApplyResult(true);
$showPrices = $discounts->getShowPrices();
$prices = $result['PRICES']['BASKET']; // цены товаров с учетом скидки
global $USER;
if($USER->IsAdmin()){
echo '<pre>',var_dump($showPrices),'</pre>';
}
$basketItems = $basket->getOrderableItems();
$basketItems->doFinalAction(true);
$allVatSum = $basketItems->getVatSum();
$allSum = $basketItems->getBasePrice();
$allDiscountSum = $basketItems->getPrice();
$vatRate = $basketItems->getVatRate();
global $USER;
if($USER->IsAdmin()){
    echo '<pre>',var_dump($allSum),'</pre>';
    echo '<pre>',var_dump($allDiscountSum),'</pre>';

}
$arProductsIDs = [];
foreach ($basketItems as $basketItem) {
    $mxResult = CCatalogSku::GetProductInfo(
        $basketItem->getProductId()
    );
    if (is_array($mxResult)) {
        $arProductsIDs[$mxResult['ID']] = $mxResult['ID'];
    } else {
        $arProductsIDs[$basketItem->getProductId()] = $basketItem->getProductId();
    }
}

if (!empty($arProductsIDs)) {
    $select = Array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_*');
    $filter = Array('IBLOCK_ID' => 17, 'ID' => $arProductsIDs);
    $res = CIBlockElement::GetList(Array(), $filter, false, false, $select);
    while ($ob = $res->GetNextElement()) {
        $fields = $ob->GetFields();
        $fields ['PROPERTIES'] = $ob->GetProperties();
        $arProducts[$fields['ID']] = $fields;
    }
}
foreach ($basketItems as $basketItem) {
    $mxResult = CCatalogSku::GetProductInfo(
        $basketItem->getProductId()
    );
    if (is_array($mxResult)) {
        $intProdID = $mxResult['ID'];
    } else {
        $intProdID = $basketItem->getProductId();
    }
    $arBasketItemInfo = $arProducts[$intProdID];
	$basePrice = $prices[$basketItem->getId()]['BASE_PRICE'];
	$discountPrice = $prices[$basketItem->getId()]['PRICE'];
    $arItems[] = [
        'PREVIEW_PICTURE' => ['SRC' => CFile::GetPath($arBasketItemInfo['PREVIEW_PICTURE'])],
        'NAME' => $basketItem->getField('NAME'),
        'PROPERTIES' => [
            'ARTNUMBER' => ['VALUE' => $arBasketItemInfo['PROPERTIES']['CML2_ARTICLE']['VALUE']],
            'CODE' => ['VALUE' => $arBasketItemInfo['PROPERTIES']['CML2_BAR_CODE']['VALUE']],
            'COLOR' => ['VALUE' => $arBasketItemInfo['PROPERTIES']['TEXTURE']['VALUE']],
            'DATE' => ['VALUE' => date("d.m.Y", strtotime(date('d.m.Y') . " +2 day"))],
        ],
        'QUANTITY' => $basketItem->getQuantity(),
        'PRICE' => $basePrice,
        'DISCOUNT_PRICE' => $discountPrice,
        'DISCOUNT_PERCENT' => floor((floatval($discountPrice)/ floatval($basePrice))*100)
    ];
}
$allSum = $basketItems->getBasePrice();
$allDiscountSum = $basketItems->getPrice();*/

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
?>