<?php
define('ADMIN_MODULE_NAME', 'defo.log1c');
require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_admin_before.php';


$fileInfo = pathinfo(__FILE__);
IncludeModuleLangFile(__FILE__);
use \Bitrix\Main\Localization\Loc;

use Bitrix\Main\Entity;
use Bitrix\Main\Type;
use Bitrix\Main\Entity\Query;
use Bitrix\Main\Entity\ExpressionField;

use \Defo\Log1c as MainData;

\Bitrix\Main\Loader::includeModule(ADMIN_MODULE_NAME);

$APPLICATION->SetTitle(Loc::getMessage("defo_log1c_title"));

$sTableID = "b_defo_log1c_entity";

$oSort = new CAdminSorting($sTableID, "DATE", "desc");
$lAdmin = new CAdminList($sTableID, $oSort);

/*if (!in_array($by, $lAdmin->GetVisibleHeaderColumns(), true)){
    $by = 'ID';
}
*/
function CheckFilter(){
    global $FilterArr, $lAdmin;
    foreach ($FilterArr as $f) global $$f;
    return count($lAdmin->arFilterErrors)==0;
}

$FilterArr = Array(
    "find_type",
);

$lAdmin->InitFilter($FilterArr);

$arFilter = Array();
if(CheckFilter()){
    $arFilter = Array(
        "TYPE" => $find_type,
    );
}

if(($arID = $lAdmin->GroupAction())){
    if($_REQUEST['action_target']=='selected'){
        $rsData = MainData\LogTable::GetList(array('order' => array($by=>$order), 'filter' => $arFilter));
        while($arRes = $rsData->Fetch())
            $arID[] = $arRes['ID'];
    }

    foreach($arID as $ID){
        $ID = IntVal($ID);
        if($ID <= 0)
            continue;
        switch($_REQUEST['action']){
            case "delete":
                if(!MainData\LogTable::Delete($ID))
                    $lAdmin->AddGroupError(GetMessage("DEFO_LOG_LIST_ERR_DEL"), $ID);
                break;
        }
    }
}

$order = strtoupper($order);

$arCleanFilter = array();
foreach($arFilter as $keyFilter=>$elFilter) {
    if (isset($elFilter) && !empty($elFilter)) {
        $arCleanFilter[$keyFilter] = $elFilter;
    }
}

$arFilter = $arCleanFilter;

$usePageNavigation = true;
if (isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'excel'){
    $usePageNavigation = false;
}else{
    $navyParams = CDBResult::GetNavParams(CAdminResult::GetNavSize(
        $sTableID,
        array('nPageSize' => 20, 'sNavID' => $APPLICATION->GetCurPage().'?ENTITY_ID='.$ENTITY_ID)
    ));
    if ($navyParams['SHOW_ALL']){
        $usePageNavigation = false;
    }else{
        $navyParams['PAGEN'] = (int)$navyParams['PAGEN'];
        $navyParams['SIZEN'] = (int)$navyParams['SIZEN'];
    }
}
$getListParams = array();
$getListParams['select'] = array('*');
$getListParams['filter'] = $arFilter;
$getListParams['order'] = array($by => $order);

unset($filterValues);
if ($usePageNavigation){
    $getListParams['limit'] = $navyParams['SIZEN'];
    $getListParams['offset'] = $navyParams['SIZEN']*($navyParams['PAGEN']-1);
}

if ($usePageNavigation){
    $countQuery = new Entity\Query(MainData\LogTable::getEntity());
    #$countQuery = new Query($entity_data_class::getEntity());
    $countQuery->addSelect(new ExpressionField('CNT', 'COUNT(1)'));
    $countQuery->setFilter($getListParams['filter']);
    $totalCount = $countQuery->setLimit(null)->setOffset(null)->exec()->fetch();
    unset($countQuery);
    $totalCount = (int)$totalCount['CNT'];
    if ($totalCount > 0){
        $totalPages = ceil($totalCount/$navyParams['SIZEN']);
        if ($navyParams['PAGEN'] > $totalPages)
            $navyParams['PAGEN'] = $totalPages;
        $getListParams['limit'] = $navyParams['SIZEN'];
        $getListParams['offset'] = $navyParams['SIZEN']*($navyParams['PAGEN']-1);
    }else{
        $navyParams['PAGEN'] = 1;
        $getListParams['limit'] = $navyParams['SIZEN'];
        $getListParams['offset'] = 0;
    }
}

$rsData = MainData\LogTable::getList($getListParams);
$rsData = new CAdminResult($rsData, $sTableID);

if ($usePageNavigation){
    $rsData->NavStart($getListParams['limit'], $navyParams['SHOW_ALL'], $navyParams['PAGEN']);
    $rsData->NavRecordCount = $totalCount;
    $rsData->NavPageCount = $totalPages;
    $rsData->NavPageNomer = $navyParams['PAGEN'];
}else{
    $rsData->NavStart();
}

$lAdmin->NavText($rsData->GetNavPrint(GetMessage("DEFO_LOG_LIST_NAV")));

$aContext=array();
$lAdmin->AddAdminContextMenu($aContext);

$aHeaders = array(
    array("id"=>"ID", "content"=>"ID", "sort"=>"ID", "default"=>true),
    array("id"=>"DATE", "content"=>GetMessage("DEFO_LOG_DATE"), "sort"=>"DATE", "default"=>true),
    array("id"=>"TYPE", "content"=>GetMessage("DEFO_LOG_TYPE"), "sort"=>"TYPE", "default"=>true),
    array("id"=>"STATUS", "content"=>GetMessage("DEFO_LOG_STATUS"), "sort"=>"STATUS", "default"=>true),
    array("id"=>"AMOUNT", "content"=>GetMessage("DEFO_LOG_AMOUNT"), "sort"=>"AMOUNT", "default"=>true),
    array("id"=>"TEXT", "content"=>GetMessage("DEFO_LOG_TEXT"), "sort"=>"TEXT", "default"=>true),
);

$lAdmin->AddHeaders($aHeaders);

while($arRes = $rsData->NavNext(true, "f_")) {
    $strCreatePercent = '';
    $row =& $lAdmin->AddRow($f_ID, $arRes);
    $row->AddViewField("DATE", $f_DATE);

//$row->AddViewField("TYPE", '<div style="display: inline-block; width: 12px; height: 12px; margin: 3px 7px 0px 0px; border-radius: 50%; background: #'.$colorType.'; "></div>'.$curType);
    $row->AddViewField("TYPE", htmlspecialcharsBack($f_TYPE));

    if ($f_STATUS == 'SUCCESS'){
        $curStatus = GetMessage("DEFO_LOG_LIST_FLT_STATUS_SUCCESS");
        $colorStatus = '00cc33';
    }elseif ($f_STATUS == 'WARNING'){
        $curStatus = GetMessage("DEFO_LOG_LIST_FLT_STATUS_WARNING");
        $colorStatus = 'ff6600';
    }elseif ($f_STATUS == 'ERROR'){
        $curStatus = GetMessage("DEFO_LOG_LIST_FLT_STATUS_ERROR");
        $colorStatus = 'cc0000';
    }else{
        $curStatus = GetMessage("DEFO_LOG_LIST_FLT_STATUS_UNKNOWN");
        $colorStatus = '999999';
    }

    $row->AddViewField("STATUS", '<div style="display: inline-block; width: 12px; height: 12px; margin: 3px 7px 0px 0px; border-radius: 50%; background: #'.$colorStatus.'; "></div>'.$curStatus);
    $row->AddViewField("TEXT", htmlspecialcharsBack($f_TEXT));

    $arActions = Array();

    $arActions[] = array(
        "ICON"=>"delete",
        "TEXT"=>GetMessage("DEFO_LOG_LIST_DEL"),
        "ACTION"=>"if(confirm('".GetMessage("DEFO_LOG_LIST_DEL_CONF")."')) ".$lAdmin->ActionDoGroup($f_ID, "delete")
    );

    $row->AddActions($arActions);
}
$lAdmin->AddGroupActionTable(Array(
    "delete"=>true,
));

$lAdmin->CheckListMode();

$APPLICATION->SetTitle(GetMessage("MAIN_DEFO_LOG_LIST"));
require_once ($DOCUMENT_ROOT.BX_ROOT."/modules/main/include/prolog_admin_after.php");

$oFilter = new CAdminFilter(
    $sTableID."_filter",
    array(
        GetMessage("DEFO_LOG_LIST_FLT_STATUS"),
    )
);
?>
    <form name="form1" method="GET" action="<?=$APPLICATION->GetCurPage()?>">
        <input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">
        <?$oFilter->Begin();?>
        <tr>
            <td><?echo GetMessage("DEFO_LOG_LIST_FLT_TYPE")?></td>
            <td><select name="find_type">
                    <option value=""><?echo GetMessage("DEFO_LOG_LIST_FLT_ALL")?></option>
                    <option value="offers"<?if($find_type == "offers") echo " selected"?>><?echo GetMessage("DEFO_LOG_LIST_FLT_TYPE_OFFERS")?></option>
                    <option value="prices"<?if($find_type == "prices") echo " selected"?>><?echo GetMessage("DEFO_LOG_LIST_FLT_TYPE_PRICES")?></option>
                    <option value="rests"<?if($find_type == "rests") echo " selected"?>><?echo GetMessage("DEFO_LOG_LIST_FLT_TYPE_RESTS")?></option>
                    <option value="restsdr"<?if($find_type == "restsdr") echo " selected"?>><?echo GetMessage("DEFO_LOG_LIST_FLT_TYPE_RESTSDR")?></option>
                </select>
            </td>
        </tr>

        <?
        $oFilter->Buttons(array("table_id"=>$sTableID,"url"=>$APPLICATION->GetCurPage(),"form"=>"form1"));
        $oFilter->End();
        ?>
    </form>
<?
$lAdmin->DisplayList();
?>
<p><strong>Информация о товарах передается на сайт в следующих файлах</strong></p>
    <ul>
        <li><a href="http://dev.1c-bitrix.ru/api_help/sale/xml/import.php" rel="nofollow" target="_blank">import</a> - товары, группы (разделы инфоблока), типы цен, склады, свойства товаров и единицах измерения;</li>
        <li><a href="http://dev.1c-bitrix.ru/api_help/sale/xml/offers.php" rel="nofollow" target="_blank">offers</a> - торговые предложения (ТП) товаров и их свойствах;</li>
        <li><a href="http://dev.1c-bitrix.ru/api_help/sale/xml/prices.php" rel="nofollow" target="_blank">prices</a> - цены ТП;</li>
        <li><a href="http://dev.1c-bitrix.ru/api_help/sale/xml/rests.php" rel="nofollow" target="_blank">rests</a> - остатки ТП;</li>
        <li><a href="" rel="nofollow" target="_blank">restsdr</a> - остатки из DR </li>
    </ul>
<?require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog_admin.php");
?>