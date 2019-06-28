<?define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");?>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
header('Content-type: application/json');
if(!\Bitrix\Main\Loader::includeModule("sale") || !\Bitrix\Main\Loader::includeModule("catalog") || !\Bitrix\Main\Loader::includeModule("iblock") || !\Bitrix\Main\Loader::includeModule('aspro.next.stock')){
	echo "failure";
	return;
}

$iblockID=(isset($_GET["iblockID"]) ? $_GET["iblockID"] : CNextCacheStock::$arIBlocks[SITE_ID]['aspro_next_catalog']['aspro_next_catalog'][0] );
$arItems=CNextStock::getBasketItems($iblockID);

echo json_encode($arItems);