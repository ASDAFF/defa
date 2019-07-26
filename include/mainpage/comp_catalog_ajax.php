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

    if($bAjaxMode && $_POST["FILTER_HIT_PROP"])
        $arComponentParams["FILTER_HIT_PROP"] = $_POST["FILTER_HIT_PROP"];

    /* hide compare link from module options */
    if(CNext::GetFrontParametrValue('CATALOG_COMPARE') == 'N')
        $arComponentParams["DISPLAY_COMPARE"] = 'N';
    /**/
//arrFilterPodborki
    if($arComponentParams["FILTER_NAME"] == "" && $APPLICATION->GetCurPage()){
        $GLOBALS[$arComponentParams["FILTER_NAME"]]["PROPERTY_PODBORKAISMAIN_VALUE"][0] = "Y";
        $APPLICATION->RestartBuffer();
        echo date('Y-m-d H:i:s')." include/mainpage/comp_catalog_ajax.php"."<br>";
        echo " FILTER_NAME=".$arComponentParams["FILTER_NAME"]."<br>";
        echo $arComponentParams["FILTER_NAME"]."<br>";
        var_export($$arComponentParams["FILTER_NAME"]); echo "<br>";
        echo " arComponentParams:<br>";
        var_export($arComponentParams); echo "<br>";
        die();
    }
    ?>

    <?if(!empty($GLOBALS[$arComponentParams["FILTER_NAME"]])) {
        $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "catalog_block_front",
            $arComponentParams,
            false, array("HIDE_ICONS"=>"Y")
        );
    }
    ?>

<?endif;?>