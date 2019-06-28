<?define("STATISTIC_SKIP_ACTIVITY_CHECK", "true");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if(!CModule::IncludeModule("sale") || !CModule::IncludeModule("catalog") || !CModule::IncludeModule("iblock")){
	echo "failure";
	return;
}

if(\Bitrix\Main\Loader::IncludeModule('aspro.next.b2c'))
{
	$iblockID=(isset($_GET["iblockID"]) ? $_GET["iblockID"] : CNextCacheB2c::$arIBlocks[SITE_ID]['aspro_next_catalog']['aspro_next_catalog'][0] );
	$arItems=CNextB2c::getBasketItems($iblockID);

	?>
	<script type="text/javascript">
		var arBasketAspro = <? echo CUtil::PhpToJSObject($arItems, false, true); ?>;
	</script>
<?}?>