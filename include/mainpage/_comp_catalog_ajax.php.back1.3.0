<?$bAjaxMode = (isset($_POST["AJAX_POST"]) && $_POST["AJAX_POST"] == "Y");
if($bAjaxMode)
{
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	global $APPLICATION;
	if(\Bitrix\Main\Loader::includeModule("aspro.next"))
	{
		$arRegion = CNextRegionality::getCurrentRegion();
	}
}?>
<?if((isset($arParams["IBLOCK_ID"]) && $arParams["IBLOCK_ID"]) || $bAjaxMode):?>
	<?
	$arIncludeParams = ($bAjaxMode ? $_POST["AJAX_PARAMS"] : $arParamsTmp);
	$arGlobalFilter = ($bAjaxMode ? unserialize(urldecode($_POST["GLOBAL_FILTER"])) : array());
	$arComponentParams = unserialize(urldecode($arIncludeParams));
	?>
	
	<?
	if($bAjaxMode && (is_array($arGlobalFilter) && $arGlobalFilter))
		$GLOBALS[$arComponentParams["FILTER_NAME"]] = $arGlobalFilter;
	?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"catalog_block_front",
		$arComponentParams,
		false, array("HIDE_ICONS"=>"Y")
	);?>
	
<?endif;?>