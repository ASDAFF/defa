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
$productsHTML = '<table>';
//TODO Сформировать верстку товаров и сделать выборку (массоив arItems заполнен рыбой)
foreach ($arItems as $arItem){
    $productsHTML.= '<tr>
<td style="width: 15%"><img height="70" src="'.$arItem['PREVIEW_PICTURE']['SRC'].'" alt=""></td>
<td style="width: 45%"><p class="namerd">'.$arItem['NAME'].'</p>
<p class="namepRopd">
Артикул '.$arItem['PROPERTIES']['ARTNUMBER']['VALUE'].', код  '.$arItem['PROPERTIES']['CODE']['VALUE'].'
<br>
Цвет: '.$arItem['PROPERTIES']['COLOR']['VALUE'].'

<span class="namepDelvier">
<br>
Дата поставки: '.$arItem['PROPERTIES']['DATE']['VALUE'].'
</span>
</p>

</td>
<td style="width: 15%; text-align: center;"><p class="namerd">'.$arItem['QUANTITY'].' шт</p></td>
<td style="width: 15%">

<p class="namerd">'.$arItem['PRICE'].' руб.
<br>
<span class="namepRopd">Скидка '.$arItem['DISCOUNT_PERCENT'].' %</span>
</p>

</td>
<td style="width: 15%"><p style="    text-decoration: line-through;color: #9E9FA2;" class="namerd">'.$arItem['DISCOUNT_PRICE'].' руб.</p></td>
</tr>';

}

$productsHTML.= '<tr class="smlPPw" >
<td colspan="3" style="text-align: right">
Итого
</td>
<td>
  12 880 руб
</td>

<td>
   <span style="  text-decoration: line-through;color: #9E9FA2;">12 880 руб</span> 
</td>

</tr>

<tr class="smlPPw">
<td colspan="3" style="text-align: right">
в том числе НДС (20%)      
</td>
<td  style="text-align: left">
     4736 руб.
</td>
<td>

</td>
</tr>
<tr></tr>
<br>
<tr>
<td class="smlPP" colspan="5" style="text-align: right">
<br>
Двадцать одна тысяча восемьсот восемьдесят рубле 00 копеек <br>
в том числе НДС (20%) четыре тысячи триста семьдесят шеть  рублей 00 копеек

</td>

</tr>

';

$productsHTML.= '</table>';



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
<h1>Трапезникова Татьяна Алексеевна</h1>
<p>(812) 448-8970 (2263)<br/><a href="mailto:tat@defo.ru">tat@defo.ru</a></p>
<br/>
<br/>
<br/><br/>
<br/><br/>
<br/><br/>
<br/>

<h2>ООО "ДЭФО-Санкт-Петербург"</h2>
<p>Юридический адрес:</p>
<p>199004, город Санкт-Петербург, линия Кадетская В.О, д. 27/5, лит. А, пом. 1Н</p><br/>
<p>Реквизиты:</p>
<p>ИНН / КПП: 7801512839 / 780101001</p>
<p>ОКТМО 40308000000</p>
<p>р/с 40702810606000028010</p>
<p>СТ-ПЕТЕРБУРГСКИЙ Ф-Л ПАО "ПРОМСВЯЗЬБАНК" в Санкт-Петербург</p>
<p>БИК 044030920</p>
<p>корр.сч. 30101810000000000920</p><br/>
<br/>
<br/>
<br/>
<br/>

</div>
<div class="tqFooter">
<p>Цены указанные в коммерческом предложении действительны в течении 3 (трех) рабочих дней.</p>
<p>Для получение индивидуальной скидки, необходимо обращаться к личному менеджеру либо сотрудникам интернет магазина</p>
</div>
EOD;


$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


$pdf->Output('offer-312312.pdf' ,  'I');
//$pdf->Output('example_001.pdf', 'I');
//OnOrderAdd2Quick1(6,[]);

?>