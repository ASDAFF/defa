<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER["DOCUMENT_ROOT"] . '/ddsdev/tcpdf/tcpdf.php');
/**
 * @param $num
 * @return string
 */
function num2str($num)
{
    $nul = 'ноль';
    $ten = array(
        array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
        array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
    );
    $a20 = array(
        'десять',
        'одиннадцать',
        'двенадцать',
        'тринадцать',
        'четырнадцать',
        'пятнадцать',
        'шестнадцать',
        'семнадцать',
        'восемнадцать',
        'девятнадцать'
    );
    $tens = array(
        2 => 'двадцать',
        'тридцать',
        'сорок',
        'пятьдесят',
        'шестьдесят',
        'семьдесят',
        'восемьдесят',
        'девяносто'
    );
    $hundred = array(
        '',
        'сто',
        'двести',
        'триста',
        'четыреста',
        'пятьсот',
        'шестьсот',
        'семьсот',
        'восемьсот',
        'девятьсот'
    );
    $unit = array( // Units
        array('копейка', 'копейки', 'копеек', 1),
        array('рубль', 'рубля', 'рублей', 0),
        array('тысяча', 'тысячи', 'тысяч', 1),
        array('миллион', 'миллиона', 'миллионов', 0),
        array('миллиард', 'милиарда', 'миллиардов', 0),
    );
    //
    list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
    $out = array();
    if (intval($rub) > 0) {
        foreach (str_split($rub, 3) as $uk => $v) { // by 3 symbols
            if (!intval($v)) {
                continue;
            }
            $uk = sizeof($unit) - $uk - 1; // unit key
            $gender = $unit[$uk][3];
            list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
            // mega-logic
            $out[] = $hundred[$i1]; # 1xx-9xx
            if ($i2 > 1) {
                $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3];
            } # 20-99
            else {
                $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3];
            } # 10-19 | 1-9
            // units without rub & kop
            if ($uk > 1) {
                $out[] = morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
            }
        } //foreach
    } else {
        $out[] = $nul;
    }
    $out[] = morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
    $out[] = $kop . ' ' . morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
    return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
}

/**
 * @param $n
 * @param $f1
 * @param $f2
 * @param $f5
 * @return mixed
 */
function morph($n, $f1, $f2, $f5)
{
    $n = abs(intval($n)) % 100;
    if ($n > 10 && $n < 20) {
        return $f5;
    }
    $n = $n % 10;
    if ($n > 1 && $n < 5) {
        return $f2;
    }
    if ($n == 1) {
        return $f1;
    }
    return $f5;
}

/**
 * @return string
 */
function getUrl()
{
    $url = @($_SERVER["HTTPS"] != 'on') ? 'http://' . $_SERVER["SERVER_NAME"] : 'https://' . $_SERVER["SERVER_NAME"];
    $url .= ($_SERVER["SERVER_PORT"] != 80) ? ":" . $_SERVER["SERVER_PORT"] : "";
    return $url;
}

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '', '', array(0, 64, 255), array(0, 64, 128));
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->setPrintFooter(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


$pdf->SetMargins(20, 25, 20);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

$pdf->setFontSubsetting(true);
$pdf->SetFont('dejavusans', '', 14, '', true);
$pdf->AddPage();

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Sale;
use Bitrix\Main,
    Bitrix\Iblock\Component\Element,
    Bitrix\Main\Localization\Loc,
    Bitrix\Catalog;

CModule::IncludeModule('iblock');
CModule::IncludeModule('sale');
$notShow = false;
global $USER;
$action = $_REQUEST['action'];
switch ($action) {
    case 'product':
        $allVatSum = 0;
        $vatRate = 0;
        $id = $_REQUEST['ID'];
        $arProductsIDs = $id;
        $mxResult = CCatalogSku::GetProductInfo($id);
        if (is_array($mxResult)) {
            $arProductsIDs = $mxResult['ID'];
        } else {
            $arProductsIDs = $id;
        }
        CModule::IncludeModule('catalog');
        if (!empty($arProductsIDs)) {
            $select = Array('ID', 'IBLOCK_ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_*');
            $filter = Array('IBLOCK_ID' => 17, 'ID' => $arProductsIDs);
            $res = CIBlockElement::GetList(Array(), $filter, false, Array("nPageSize" => 1), $select);
            while ($ob = $res->GetNextElement()) {
                $fields = $ob->GetFields();
                $fields ['PROPERTIES'] = $ob->GetProperties();
                $arProducts[$fields['ID']] = $fields;
                $arPrice = CCatalogProduct::GetOptimalPrice($id, 1, $USER->GetUserGroupArray(), null);

                if(!empty($arPrice['RESULT_PRICE']['VAT_RATE'] ))
                $vatRate = $arPrice['RESULT_PRICE']['VAT_RATE'] * 100;
                $allSum = $arPrice['RESULT_PRICE']['BASE_PRICE'];
                $allDiscountSum = $arPrice['RESULT_PRICE']['DISCOUNT_PRICE'];
                if($vatRate>0)
                $allVatSum = $arPrice['RESULT_PRICE']['DISCOUNT_PRICE']*$arPrice['RESULT_PRICE']['VAT_RATE'];


                $priceTypes = array();
                $priceIterator = Catalog\GroupAccessTable::getList(array(
                    'select' => array('CATALOG_GROUP_ID'),
                    'filter' => array('GROUP_ID' => 2, '=ACCESS' => Catalog\GroupAccessTable::ACCESS_BUY),
                    'order' => array('CATALOG_GROUP_ID' => 'ASC')
                ));
                while ($priceType = $priceIterator->fetch()) {
                    $priceTypeId = (int)$priceType['CATALOG_GROUP_ID'];
                    $priceTypes[$priceTypeId] = $priceTypeId;
                    unset($priceTypeId);
                }

                Catalog\Discount\DiscountManager::preloadPriceData(array($id), $priceTypes);
                Catalog\Product\Price::loadRoundRules($priceTypes);


                $optimalPrice = CCatalogProduct::GetOptimalPrice($id, 1, array(2), 'N', array(), SITE_ID, array());
                $counterData['price'] = $optimalPrice['RESULT_PRICE']['DISCOUNT_PRICE'];
                $arItems[] = [
                    'PREVIEW_PICTURE' => ['SRC' => CFile::GetPath($fields['PREVIEW_PICTURE'])],
                    'NAME' => $fields['NAME'],
                    'PROPERTIES' => [
                        'ARTNUMBER' => ['VALUE' => $fields['PROPERTIES']['CML2_ARTICLE']['VALUE']],
                        'CODE' => ['VALUE' => $fields['PROPERTIES']['CML2_BAR_CODE']['VALUE']],
                        'COLOR' => ['VALUE' => $fields['PROPERTIES']['TEXTURE']['VALUE']],
                        'DATE' => ['VALUE' => date("d.m.Y", strtotime(date('d.m.Y') . " +2 day"))],
                    ],
                    'QUANTITY' => 1,
                    'PRICE' => $arPrice['RESULT_PRICE']['BASE_PRICE'],
                    'DISCOUNT_PRICE' => $arPrice['RESULT_PRICE']['DISCOUNT_PRICE'],
                    'DISCOUNT_PERCENT' =>100 - floor(($arPrice['RESULT_PRICE']['DISCOUNT_PRICE'] / $arPrice['RESULT_PRICE']['BASE_PRICE']) * 100)
                ];
            }
        }
        break;
    case 'basket':
        $basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
        $fuser = new Sale\Discount\Context\Fuser($basket->getFUserId(true));
        $discounts = Sale\Discount::buildFromBasket($basket, $fuser);
        $discounts->calculate();
        $result = $discounts->getApplyResult(true);
        $prices = $result['PRICES']['BASKET']; // цены товаров с учетом скидки


        $basketItems = $basket->getOrderableItems();
        $allVatSum = 0/*$basketItems->getVatSum()*/;
        $allSum = 0;//$basketItems->getBasePrice();
        $allDiscountSum = 0;//$basketItems->getPrice();
        $vatRate = 0;
        if(!empty($basketItems->getVatRate()))
        $vatRate = $basketItems->getVatRate() * 100;


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
            $basePrice = $prices[$basketItem->getId()]['BASE_PRICE']*$basketItem->getQuantity();
            $discountPrice = $prices[$basketItem->getId()]['PRICE']*$basketItem->getQuantity();

            $allSum += floatval($basePrice);
            $allDiscountSum += floatval($discountPrice);
            if($vatRate > 0)
                $allVatSum += $basketItems->getVatRate()*$discountPrice;
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
                'DISCOUNT_PERCENT' => 100 - floor((floatval($discountPrice) / floatval($basePrice)) * 100)
            ];
        }
        break;
    case 'favorite':

        $allSum = 0;
        $allWeight = 0;
        $arItems = array();
        $allDiscountSum = 0;
        $allVatSum = 0;
        $vatRate = 0;
        if (Loader::includeModule("sale")) {
            $dbBasketItems = CSaleBasket::GetList(
                array(
                    "NAME" => "ASC",
                    "ID" => "ASC"
                ),
                array(
                    "FUSER_ID" => CSaleBasket::GetBasketUserID(),
                    "LID" => SITE_ID,
                    "ORDER_ID" => "NULL",
                    "DELAY" => "Y"
                ),
                false,
                false
            );
            while ($arItem = $dbBasketItems->Fetch()) {
                if ($arItem['DELAY'] == 'Y') {
                    $vatRate = $arItem['VAT_RATE'] * 100;

                    if ($vatRate > 0) {
                        $allVatSum += $arItem['PRICE'] / $vatRate;
                    }
                    $allSum += ($arItem["BASE_PRICE"] * $arItem["QUANTITY"]);
                    $allWeight += ($arItem["WEIGHT"] * $arItem["QUANTITY"]);
                    $basketItems[] = $arItem;
                }
            }


            $arOrder = array(
                'SITE_ID' => SITE_ID,
                'USER_ID' => $GLOBALS["USER"]->GetID(),
                'ORDER_PRICE' => $allSum,
                'ORDER_WEIGHT' => $allWeight,
                'BASKET_ITEMS' => $basketItems
            );

            $arOptions = array(
                'COUNT_DISCOUNT_4_ALL_QUANTITY' => 'Y',
            );

            $arErrors = array();

            CSaleDiscount::DoProcessOrder($arOrder, $arOptions, $arErrors);

            $arProductsIDs = [];
            foreach ($arOrder['BASKET_ITEMS'] as $basketItem) {
                $mxResult = CCatalogSku::GetProductInfo(
                    $basketItem['PRODUCT_ID']
                );
                if (is_array($mxResult)) {
                    $arProductsIDs[$mxResult['ID']] = $mxResult['ID'];
                } else {
                    $arProductsIDs[$basketItem['PRODUCT_ID']] = $basketItem['PRODUCT_ID'];
                }
                $allDiscountSum += ($basketItem['PRICE'] * $basketItem['QUANTITY']);
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


            foreach ($arOrder['BASKET_ITEMS'] as $basketItem) {
                $mxResult = CCatalogSku::GetProductInfo($basketItem['PRODUCT_ID']);
                if (is_array($mxResult)) {
                    $intProdID = $mxResult['ID'];
                } else {
                    $intProdID = $basketItem['PRODUCT_ID'];
                }
                $arBasketItemInfo = $arProducts[$intProdID];

                $arItems[] = [
                    'PREVIEW_PICTURE' => ['SRC' => CFile::GetPath($arBasketItemInfo['PREVIEW_PICTURE'])],
                    'NAME' => $basketItem['NAME'],
                    'PROPERTIES' => [
                        'ARTNUMBER' => ['VALUE' => $arBasketItemInfo['PROPERTIES']['CML2_ARTICLE']['VALUE']],
                        'CODE' => ['VALUE' => $arBasketItemInfo['PROPERTIES']['CML2_BAR_CODE']['VALUE']],
                        'COLOR' => ['VALUE' => $arBasketItemInfo['PROPERTIES']['TEXTURE']['VALUE']],
                        'DATE' => ['VALUE' => date("d.m.Y", strtotime(date('d.m.Y') . " +2 day"))],
                    ],
                    'QUANTITY' => $basketItem['QUANTITY'],
                    'PRICE' => $basketItem['BASE_PRICE'],
                    'DISCOUNT_PRICE' => $basketItem['PRICE'],
                    'DISCOUNT_PERCENT' => 100 - floor(($basketItem['PRICE'] / $basketItem['BASE_PRICE']) * 100)
                ];
            }
        }
        break;
    case 'getFileUrl':
        $GLOBALS['APPLICATION']->RestartBuffer();
        echo json_encode($_SESSION['CP_FILE']);
        $notShow = true;
        break;
}
if (!$notShow) {


    $date = date('d.m.Y');
    $intNumber = rand(1, 99999999);

    $productsHTML = '<table>';

    foreach ($arItems as $arItem) {
        $productsHTML .= '<tr>
<td style="width: 15%"><img height="70" src="' . $arItem['PREVIEW_PICTURE']['SRC'] . '" alt=""></td>
<td style="width: 45%"><p class="namerd">' . $arItem['NAME'] . '</p>
<p class="namepRopd">';
        if (!empty($arItem['PROPERTIES']['ARTNUMBER']['VALUE'])) {
            $productsHTML .= 'Артикул ' . $arItem['PROPERTIES']['ARTNUMBER']['VALUE'];
        }
        if (!empty($arItem['PROPERTIES']['CODE']['VALUE'])) {
            $productsHTML .= ', код  ' . $arItem['PROPERTIES']['CODE']['VALUE'];
        }
        $productsHTML .= '
<br>';
        if (!empty($arItem['PROPERTIES']['COLOR']['VALUE'])) {
            $productsHTML .= 'Цвет: ' . $arItem['PROPERTIES']['COLOR']['VALUE'];
        }
        $productsHTML .= '

<span class="namepDelvier">
<br>
Дата поставки: ' . $arItem['PROPERTIES']['DATE']['VALUE'] . '
</span>
</p>

</td>
<td style="width: 15%; text-align: center;"><p class="namerd">' . $arItem['QUANTITY'] . ' шт</p></td>
<td style="width: 15%">

<p class="namerd">' . number_format($arItem['DISCOUNT_PRICE'], 0, ' ', ' ') . ' руб.
<br>';
        if ($arItem['DISCOUNT_PRICE'] != $arItem['PRICE']) {
            $productsHTML .= '<span class="namepRopd">Скидка ' . $arItem['DISCOUNT_PERCENT'] . ' %</span>';
        }
        $productsHTML .= '</p>

</td>';
        if ($arItem['DISCOUNT_PRICE'] != $arItem['PRICE']) {
            $productsHTML .= '<td style="width: 15%"><p style="    text-decoration: line-through;color: #9E9FA2;" class="namerd">' . number_format($arItem['PRICE'],
                    0, ' ', ' ') . ' руб.</p></td>';
        }

        $productsHTML .= '</tr>';

    }

    $productsHTML .= '
<tr class="smlPPw" >
<td colspan="3" style="text-align: right">
Итого
</td>
<td>
  ' . number_format($allDiscountSum, 0, ' ', ' ') . ' руб
</td>';
    if ($allDiscountSum != $allSum) {
        $productsHTML .= '<td>
   <span style="  text-decoration: line-through;color: #9E9FA2;">' . number_format($allSum, 0, ' ', ' ') . ' руб</span> 
</td>';
    }
    $productsHTML .= '</tr>

<tr class="smlPPw">
<td colspan="3" style="text-align: right">
в том числе НДС (' . $vatRate . '%)      
</td>
<td  style="text-align: left">
     ' . $allVatSum . ' руб.
</td>
<td>

</td>
</tr>
<tr></tr>
<br>
<tr>
<td class="smlPP" colspan="5" style="text-align: right">
<br>
' . lcfirst(num2str($allDiscountSum)) . ' <br>
в том числе НДС (' . $vatRate . '%) ' . num2str($allVatSum) . '

</td>

</tr>';

    $productsHTML .= '</table>';

    $strLocationRequisites = '';
    $intCurrentLocation = (int)CNextRegionalityB2c::getCurrentRegion()['LOCATION'];
    if (!empty($intCurrentLocation) && $intCurrentLocation > 0) {
        $select = Array('ID', 'IBLOCK_ID','PROPERTY_REGION_TAG_REKVIZITY','PROPERTY_REGION_TAG_MANAGER');
        $filter = Array('IBLOCK_ID' => 2, 'PROPERTY_LOCATION_LINK' => $intCurrentLocation);
        $res = CIBlockElement::GetList(Array(), $filter, false, Array("nPageSize" => 1), $select);
        $arLocation = $res->GetNext();
        $strLocationRequisites = $arLocation['~PROPERTY_REGION_TAG_REKVIZITY_VALUE']['TEXT'];
        $strManagerInfo = $arLocation['~PROPERTY_REGION_TAG_MANAGER_VALUE']['TEXT'];
    }
   /* if(!empty($arLocation)){
        $select = Array('ID', 'IBLOCK_ID','PROPERTY_EMAIL','NAME');
        $filter = Array('IBLOCK_ID' => 63, 'PROPERTY_REGION' => $arLocation['ID']);
        $res = CIBlockElement::GetList(Array(), $filter, false, Array("nPageSize" => 1), $select);
        $arManager = $res->GetNext();
        $arManagerName = $arManager['NAME'];
        $arManagerEmail = $arManager['PROPERTY_EMAIL_VALUE'];
    }*/

    $html = <<<EOD
<style>

.smlPP{
font-size: 8px;
}


.smlPPw{
font-size: 10px;
}

p.namerd{
font-size: 10px;
}



p.namepDelvier, span.namepDelvier{
font-size: 9px;
color: #000000;
}

p.namepRopd, span.namepRopd {
color: #9E9FA2;
font-size: 8px;
}

.tqRequisites p{
color: #9E9FA2;
font-size: 8px;
}
.tqRequisites h1{
color: #9E9FA2;
font-size: 12px;
}
.tqRequisites h2{
color: #9E9FA2;
font-size: 10px;
}
.tqRequisites a{
color: #9E9FA2;
font-size: 8px;
text-decoration: none;
}
.tqFooter p{
color: #9E9FA2;
font-size: 7px;
}
.tqTitle{
margin: 0 auto;
text-align: center;
}
.tqTitle h1{
color: #9E9FA2;
font-size: 18px;
}
.tqTitle p{
color: #9E9FA2;
font-size: 10px;
}

</style>
<div class="tqTitle">
<h1>Коммерческое предложение</h1>
<p>№$intNumber  от $date</p>
</div>


$productsHTML



<div class="tqRequisites">
<p>Ваш персональный специалист</p>
<p>$strManagerInfo</p>
<br/>
<br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/>

$strLocationRequisites

</div>
<div class="tqFooter">
<p>Цены указанные в коммерческом предложении действительны в течении 3 (трех) рабочих дней.</p>
<p>Для получение индивидуальной скидки, необходимо обращаться к личному менеджеру либо сотрудникам интернет магазина</p>
</div>
EOD;

    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

    $_SESSION['CP_FILE'] = [
        'LINK' => getUrl() . '/cpoffers/offer-' . $intNumber . '.pdf',
        'NAME' => 'offer-' . $intNumber . '.pdf'
    ];
    $pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'cpoffers/offer-' . $intNumber . '.pdf', 'F');
    echo true;
}
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");