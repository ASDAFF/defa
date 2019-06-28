<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("3D планировщик мебели");?>
<?
$protocol = (array_reverse(explode('.', $_SERVER['HTTP_HOST']))[0] == "ru")?"https":"http";
$region = $arRegion["PROPERTY_REGION_TAG_TEST_VALUE"];
?>
<div class="o3d-online">
	<iframe src="https://o3d.ru/app/app_defo.php?domain=<?=$protocol?>://<?=$_SERVER['HTTP_HOST']?><?=($_GET["artcode"])?"&artcode=".urlencode($_GET["artcode"]):""?>&region=<?=$region;?>" allowfullscreen="allowfullscreen" style="width: 100%; height: 700px; border: 0; margin-left: 1%;"></iframe>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>