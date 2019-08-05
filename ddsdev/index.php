<?php require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER["DOCUMENT_ROOT"].'/ddsdev/tcpdf/tcpdf.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,'', '', array(0,64,255), array(0,64,128));
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

$pdf->setPrintFooter(false);
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


$pdf->SetMargins(20, 25, 20);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

$pdf->setFontSubsetting(true);
$pdf->SetFont('dejavusans', '', 14, '', true);
$pdf->AddPage();

$date = date('d.m.Y');
$intNumber = 456371;
$arItems = [
    [
        'PREVIEW_PICTURE' => ['SRC' => '/ddsdev/images/product.jpg'],
        'NAME' => 'Стол руководителя B с приставкой 254х215х75',
        'PROPERTIES' => [
            'ARTNUMBER' => ['VALUE' => '7#57394'],
            'CODE' => ['VALUE' => '0014556'],
            'COLOR' => ['VALUE' => 'зебрано'],
            'DATE' => ['VALUE' => '19.08.2019'],
        ],
        'QUANTITY' => '1',
        'PRICE' => 6770,
        'DISCOUNT_PRICE' => 5470,
        'DISCOUNT_PERCENT' => 33
    ],
    [
        'PREVIEW_PICTURE' => ['SRC' => '/ddsdev/images/product.jpg'],
        'NAME' => 'Стол руководителя B с приставкой 254х215х75',
        'PROPERTIES' => [
            'ARTNUMBER' => ['VALUE' => '7#57394'],
            'CODE' => ['VALUE' => '0014556'],
            'COLOR' => ['VALUE' => 'зебрано'],
            'DATE' => ['VALUE' => '19.08.2019'],
        ],
        'QUANTITY' => '1',
        'PRICE' => 6770,
        'DISCOUNT_PRICE' => 5470,
        'DISCOUNT_PERCENT' => 33
    ],
    [
        'PREVIEW_PICTURE' => ['SRC' => '/ddsdev/images/product.jpg'],
        'NAME' => 'Стол руководителя B с приставкой 254х215х75',
        'PROPERTIES' => [
            'ARTNUMBER' => ['VALUE' => '7#57394'],
            'CODE' => ['VALUE' => '0014556'],
            'COLOR' => ['VALUE' => 'зебрано'],
            'DATE' => ['VALUE' => '19.08.2019'],
        ],
        'QUANTITY' => '1',
        'PRICE' => 6770,
        'DISCOUNT_PRICE' => 5470,
        'DISCOUNT_PERCENT' => 33
    ],
    [
        'PREVIEW_PICTURE' => ['SRC' => '/ddsdev/images/product.jpg'],
        'NAME' => 'Стол руководителя B с приставкой 254х215х75',
        'PROPERTIES' => [
            'ARTNUMBER' => ['VALUE' => '7#57394'],
            'CODE' => ['VALUE' => '0014556'],
            'COLOR' => ['VALUE' => 'зебрано'],
            'DATE' => ['VALUE' => '19.08.2019'],
        ],
        'QUANTITY' => '1',
        'PRICE' => 6770,
        'DISCOUNT_PRICE' => 5470,
        'DISCOUNT_PERCENT' => 33
    ]
];


$productsHTML.= '</table>';



$html = <<<EOD

<style>
body {
    padding: 0;
    font-family: Arial, sans-serif;
    width: 900px;
    margin: 60px auto;
    color: #4a4f55;
    font-size: 14px;
}

header {
    margin-bottom: 90px;
}

h1 {
    margin: 0;
    text-align: center;
    font-weight: 500;
    font-size: 24px;
    margin-bottom: 15px;
}

h2 {
    margin: 0;
    text-align: center;
    font-weight: 400;
    font-size: 16px;
    color: #a5a6a8;
    margin-bottom: 80px;
}

table {
    border-collapse: collapse;
    width: 100%;
}

table.main {
    margin-bottom: 155px;
}

table td {
    vertical-align: top;
    padding-bottom: 30px;
    padding-right: 50px;
}

table .inform {
    padding-right: 80px;
}

table .inform b {
    display: block;
    font-weight: 500;
    font-size: 16px;
    margin-bottom: 6px;
}

table .inform small {
    display: block;
    font-size: 12px;
    color: #a5a6a8;
    margin-bottom: 2px;
}

table .inform p {
    margin: 0;
    padding: 0;
    font-size: 13px;
}

table .amount {
    font-size: 14px;
    width: 50px;
}

table .price {
    width: 90px;
}

table .price b {
    display: block;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 6px;
}

table .price small {
    display: block;
    font-size: 12px;
    font-weight: 400;
    margin-bottom: 10px;
}

table .old-price {
    display: block;
    font-size: 18px;
    font-weight: 500;
    color: #9a9b9d;
    text-decoration: line-through;
}

table.all {
    width: 540px;
    margin-left: auto;
}

table.all td {
    padding-bottom: 20px;
}

table.all .total-price b {
    font-size: 24px;
    font-weight: 400;
}

table.all .total-price .text {
    text-align: right;
}

table.all .total-price .price b {
    font-size: 24px;
    width: 125px;
    font-weight: 600;
}

table.all .total-price .old-price {
    font-size: 24px;
    width: 100px;
    font-weight: 500;
}

table.all .total-nds {
    font-size: 14px;
    font-weight: 400;
}

table.all .total-nds td:first-child {
    text-align: right;
}

table.all .table-footer {
    text-align: right;
    font-size: 12px;
}

table.all .table-footer p {
    margin: 0;
    margin-bottom: 9px;
    padding: 0;
}

.specialist-info {
    margin-bottom: 65px;
    font-size: 20px;
}

.specialist-info h3 {
    margin: 0;
    margin-bottom: 12px;
    color: #9a9b9d;
    font-weight: 400;
    font-size: 16px;
}

.specialist-info .name {
    margin: 0;
    margin-bottom: 8px;
    font-weight: 500;
    font-size: 18px;
}

.specialist-info a {
    display: block;
    color: #4a4f55;
    text-decoration: none;
    font-size: 16px;
    margin-bottom: 8px;
}

.defo-info {
    margin-bottom: 130px;
}

.defo-info p {
    margin: 0;
    padding: 0;
}

.defo-info .adress {
    margin-bottom: 20px;
}

footer p {
    padding: 0;
    margin: 0;
    margin-bottom: 10px;
}
</style>
<body>
<main>
    <h1>Комерческое предложение</h1>
    <h2>№456571 от 20.07.2019</h2>

    <table class="main">
        <tr>
            <td class="img">
                <img src="/ddsdev/images/product.jpg" alt="" width="98" height="65">
            </td>
            <td class="inform">
                <b>Стол руководителя B с приставкой 254х215х75</b>
                <small>Артикул 7#57394, код 0014556</small>
                <small>Цвет: зебрано</small>
                <p>Дата поставки: <time datatime="2019-08-19">19.08.2019</time></p>
            </td>
            <td class="amount">1 шт</td>
            <td class="price">
                <b>5 470 &#8381;</b>
                <small>Скидка 33%</small>
            </td>
            <td class="old-price">8770</td>
        </tr>
        <tr>
            <td class="img">
                <img src="/ddsdev/images/product.jpg" alt="" width="98" height="65">
            </td>
            <td class="inform">
                <b>Стол руководителя B с приставкой 254х215х75</b>
                <small>Артикул 7#57394, код 0014556</small>
                <small>Цвет: зебрано</small>
                <p>Дата поставки: <time datatime="2019-08-19">19.08.2019</time></p>
            </td>
            <td class="amount">1 шт</td>
            <td class="price">
                <b>5 470 &#8381;</b>
                <small>Скидка 33%</small>
            </td>
            <td class="old-price">8770</td>
        </tr>
        <tr>
            <td class="img">
                <img src="/ddsdev/images/product.jpg" alt="" width="98" height="65">
            </td>
            <td class="inform">
                <b>Стол руководителя B с приставкой 254х215х75</b>
                <small>Артикул 7#57394, код 0014556</small>
                <small>Цвет: зебрано</small>
                <p>Дата поставки: <time datatime="2019-08-19">19.08.2019</time></p>
            </td>
            <td class="amount">1 шт</td>
            <td class="price">
                <b>5 470 &#8381;</b>
                <small>Скидка 33%</small>
            </td>
            <td class="old-price">8770</td>
        </tr>
        <tr>
            <td class="img">
                <img src="/ddsdev/images/product.jpg" alt="" width="98" height="65">
            </td>
            <td class="inform">
                <b>Стол руководителя B с приставкой 254х215х75</b>
                <small>Артикул 7#57394, код 0014556</small>
                <small>Цвет: зебрано</small>
                <p>Дата поставки: <time datatime="2019-08-19">19.08.2019</time></p>
            </td>
            <td class="amount">1 шт</td>
            <td class="price">
                <b>5 470 &#8381;</b>
                <small>Скидка 33%</small>
            </td>
            <td class="old-price">8770</td>
        </tr>
        <tr>
            <td colspan="5">
                <table class="all">
                    <tr class="total-price">
                        <td class="text">
                            <b>Итого</b>
                        </td>
                        <td class="price">
                            <b>21 880 &#8381;</b>
                        </td>
                        <td class="old-price">21 880 &#8381;</td>
                    </tr>
                    <tr class="total-nds">
                        <td>в том числе НДС (20%)</td>
                        <td class="all-price" colspan="2">4 376 &#8381;</td>
                    </tr>
                    <tr class="table-footer">
                        <td colspan="3">
                            <p>Двадцать одна тысяча восемьсот восемьдесят реблей 00 коппек</p>
                            <p>в том числе НДС (20%) четыре тысячи триста семьдесят шесть рублей 00 копеек</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <section class="specialist-info">
        <h3>Ваш персональный специалист</h3>
        <p class="name">Трапезникова Татьяна Алексеевна</p>
        <a href="tel:+781244889702263">(812) 448-8970 (2263)</a>
        <a href="mailto:tat@defo.ru">tat@defo.ru</a>
    </section>

    <section class="defo-info">
        <h3>ООО "ДЭФО-Санкт-Петербург"</h3>
        <p class="adress">Юридический адрес:<br>
            199004, город Санкт-Петербург, линия Кадетская В.О., д. 27/5, лит. А, пом. 1Н
        </p>

        <p>Реквизиты:</p>
        <p>
            ИНН/КПП: 7801512838 / 780101001<br>
            ОКТМО: 40308000000<br>
            р/с 40702810606000028010<br>
            СТ-ПЕТЕРБУРГСКИЙ Ф-Л ПАО "ПРОМСВЯЗЬБАНК" в Санкт-Петербург<br>
            БИК 044030920<br>
            корр.сч. 30101810000000000920<br>
        </p>
    </section>
</main>

<footer>
    <p>Цены указаные в коммерческом предложении действительны в течении 3 (трех) рабочих дней</p>
    <p>Для получения индивидуальной скидки необходимо обращаться к личному менеджеру либо сотрудникам интернет-магазина</p>
</footer>
</body>
EOD;


$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


$pdf->Output('offer-test.pdf' ,  'I');
//$pdf->Output('example_001.pdf', 'I');
//OnOrderAdd2Quick1(6,[]);

?>