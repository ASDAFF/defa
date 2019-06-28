<?php
/**
 * Created by PhpStorm.
 * User: web3
 * Date: 09.02.2018
 * Time: 16:27
 */

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog.php");
global $DB;
set_time_limit(0); 
if (!function_exists('dump')) {
	include("dumphper.php");
}
$files = array("det" => "Детские кресла", "bar" => "Для баров и кафе", "game" => "Кресла геймерские", "dir" => "Кресла директорские", "rab" => "Кресла рабочие", "mnogo" => "Многомерные секции", "dom" => "Стулья для дома", "pos" => "Стулья для посетителей", "tab" => "Табуреты");
$arProps = array(14, 15, 17, 20);
//21	23	24	25	26
//мн: 14	15	16	17	18	19	20
$nomerSv = 14; //echo $nomerSv."<<-- nomer";
if (!$_GET["q"] or !array_key_exists($_GET["q"], $files))
	$sec = "det";
else 
	$sec = $_GET["q"];
if ($_GET["q"] == "all")
	$sec = "all";
?>
<a href="?q=all">Все</a> | 
<a href="?q=det">Детские кресла</a> | 
<a href="?q=bar">Для баров и кафе</a> | 
<a href="?q=game">Кресла геймерские</a> | 
<a href="?q=dir">Кресла директорские</a> | 
<a href="?q=rab">Кресла рабочие</a> | 
<a href="?q=mnogo">Многомерные секции</a> | 
<a href="?q=dom">Стулья для дома</a> | 
<a href="?q=pos">Стулья для посетителей</a> | 
<a href="?q=tab">Табуреты</a> | 
<h1><?=($sec=="all")?"Все файлы":$files[$sec]?></h1>
<?
CModule::IncludeModule('iblock');

$fp = fopen('kresla/'.$sec.'.csv', 'r');
$fp2 = fopen('kresla/allnew.csv', 'w');

$a=0;
while(($pr = fgetcsv($fp, 1000, ";")) !== FALSE) {
	//echo $pr[0]."<br>";
	if($a == 0){
		$zagolovok = $pr;
		$a++;
	}else{
	$artikul = $pr[0];
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_ARTNUMBER");
	$arFilter = Array("IBLOCK_ID" => 17, "PROPERTY_ARTNUMBER" => $artikul);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	if($ob = $res->GetNextElement() ){
		$arFields = $ob->GetFields();
		$ELEMENT_ID = CCatalogSku::GetProductInfo($arFields["ID"])["ID"];
		//echo $ELEMENT_ID."<br>";
		$new = array($artikul, $ELEMENT_ID, $pr[13]);
		fputcsv($fp2, $new);
		//for($sv=2;$sv<=count($pr);$sv++){
		foreach ($arProps as $sv){
			if ($pr[$sv+1]){
				$prop[$ELEMENT_ID][$sv][] = $pr[$sv+1];
				$prop[$ELEMENT_ID][$sv] = array_unique($prop[$ELEMENT_ID][$sv]);
				$prop2[$sv][] = $pr[$sv+1];
				$prop2[$sv] = array_unique($prop2[$sv]);
				sort($prop2[$sv]);
			}
		}

	}
}
}
//for($sv=2;$sv<=53;$sv++){
	//foreach ($prop)
//}
//dump($zagolovok);
echo "---------------------------------------------------------<br>";
echo count($prop);
?>


<style>
.page__content{
overflow: visible;
</style>
<table>
	<tr><td bgcolor="#ffe4e1">Нет свойств</td></tr>
	<tr><td bgcolor="#f5fffa">Все свойства одинаковые</td></tr>
	<tr><td bgcolor="#e0ffff">Одинаковых более одного свойства</td></tr>
</table>
<?//dump($prop);
echo "<table border=1 width=100%>";

$a=0;
$strZag = "<tr><td>№</td>";
foreach ($zagolovok as $nomer=>$zag){
	if (!in_array($nomer-1, $arProps)) continue;
	$a++;
	//if ($a<3) continue;
	$strZag .= "<td>$zag</td>";
}
$strZag .= "</tr>";
echo $strZag;
$mm = 0;
$m=0;
$s=0;
foreach ($prop as $key=>$items){
	$mm++;
	if ($mm == 20){ echo $strZag; $mm=0;}
	//dump($item);
	//$props[$key][] = $item;
	echo "<tr>";
	//foreach ($items as $key=>$item){
	echo "<td>$key</td>";
	//for($ii=2;$ii<=53;$ii++){
	foreach ($arProps as $ii){
		//dump($key); dump($item);
		//$props[$key][] = $item;
		if (count($items[$ii]) == 0) $bgcolor = "#ffe4e1";
		if (count($items[$ii]) == 1) $bgcolor = "#f5fffa";
		if (count($items[$ii]) > 1) $bgcolor = "#e0ffff";
		echo "<td bgcolor=$bgcolor nowrap>";
		$nn=0;

		foreach ($items[$ii] as $i){
			$nn++;
			if (count($items[$ii]) == 1){
				echo $i;
				//if ($i && $ii==$nomerSv) echo "запишем ".mynum($i)." $ii $key";
				if ($i && $ii==$nomerSv){
					//if ($i == "Нет") $ni = "";
					//if ($i == "банкетка") $ni = 189;

					//CIBlockElement::SetPropertyValueCode($key, "TIPMEBELI3", $ni);
					
					//if ($i == "Да") {$ni = 173;
					
					//if ($ni) CIBlockElement::SetPropertyValueCode($key, "GARANTIYA3", $ni);
					//CIBlockElement::SetPropertyValueCode($key, "SHIRINAUPAK3", mynum($i));
					//}
					$s++;
				}
			}else{
				echo "<b>$nn.</b> ".$i."<br>";
				//if ($nn==1 && $i && $ii==$nomerSv) echo "Запишем ".mynum($i);
				
				if ($nn==1 && $i && $ii==$nomerSv){
					
					//CIBlockElement::SetPropertyValueCode($key, "SHIRINAUPAK3", mynum($i));
					//if ($i == "Нет") $ni = "";
					//if ($i == "Да") {$ni = 156;
					
					
					//CIBlockElement::SetPropertyValueCode($key, "HEIGHT_PODLOKOTNIK3", mynum($i));
					//$s++;
					//}
					//CIBlockElement::SetPropertyValueCode($key, "HEIGHT_PODLOKOTNIK3", mynum($i));
					$m++;
				}
					
		}
		}
		if (count($items[$ii])==0) echo "--";
		echo "</td>";
	}
	echo "</tr>";
}
echo "</table>";
function mynum($number){
	$number = floatval(str_replace(',', '.', $number))+0;
	return $number;
}
echo "$nomerSv мн: $m ; од: $s";