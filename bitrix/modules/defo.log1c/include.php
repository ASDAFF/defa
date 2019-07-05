<?php
global $DBType;
IncludeModuleLangFile(__FILE__);
use \Bitrix\Main\Localization\Loc;

$MODULE_ID = "defo.log1c";

class DLog{
    private static $MODULE_ID = "defo.log1c";

    public function OnEpilog(){
        if( defined(ADMIN_SECTION) && ADMIN_SECTION === true) {
            self::logDelOld();
        }
    }

    public function add($arPrm){
        $ModuleOn = COption::GetOptionString(self::$MODULE_ID, "log_on");
        if( $ModuleOn != 'Y'){
            return 'logoff';
        }

        $arDataParam = array();

        if( isset($arPrm["TYPE"]) && !empty($arPrm["TYPE"]) ) {
            $arDataParam["TYPE"] = $arPrm["TYPE"];
        }
        if( isset($arPrm["STATUS"]) && !empty($arPrm["STATUS"]) ) {
            $arDataParam["STATUS"] = $arPrm["STATUS"];
        }

        if( isset($arPrm["AMOUNT"]) && !empty($arPrm["AMOUNT"]) ) {
            $arDataParam["AMOUNT"] = $arPrm["AMOUNT"];
        }

        if( isset($arPrm["TEXT"]) && !empty($arPrm["TEXT"]) ) {
            $arDataParam["TEXT"] = $arPrm["TEXT"];
        }
        if( isset($arPrm["DATE"]) && !empty($arPrm["DATE"]) ) {
            $arDataParam["DATE"] = $arPrm["DATE"];
        }
        $obLogData = \Defo\Log1c\LogTable::add($arDataParam);
        self::logDelOld();

        if ($obLogData->isSuccess()) {
            return true;
        }else {
            return false;
        }
    }

    public function logDelOld(){
        $ModuleLogDelOld = COption::GetOptionString(self::$MODULE_ID, "log_del_old");
        if( $ModuleLogDelOld == "Y" ) {
            $ModuleLogDelDays = COption::GetOptionString(self::$MODULE_ID, "log_del_days");
        }
    }
}

