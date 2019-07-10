<?php
Class defo_log1c extends CModule
{
    public $MODULE_ID = 'defo.log1c';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $PARTNER_NAME;
    public $PARTNER_URI;

    // Свойства модуля
    public function defo_log1c() {
        $this->MODULE_NAME = 'Журналирование выгрузок из 1С';
        $this->MODULE_DESCRIPTION = 'Модуль для журналирования выгрузок из 1С';
        $this->MODULE_VERSION = '1.0';
        $this->MODULE_VERSION_DATE = '2019-05-13';
        $this->PARTNER_NAME = "Дэфо-мебель";
        $this->PARTNER_URI = "http://www.defo.ru";

    }

    // Установка
    public function DoInstall() {
        global $DB, $APPLICATION, $step;

        if($this->InstallDB()){
            $this->InstallFiles();
        }

    }

    // Удаление
    public function DoUninstall() {
        $this->UnInstallDB();
        $this->UnInstallFiles();
        UnRegisterModule($this->MODULE_ID);
    }

    function InstallDB(){

        global $DB, $DBType, $APPLICATION;

        if (!$DB->Query("SELECT 'x' FROM b_defo_log1c_entity WHERE 1=0", true)){
            $this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/db/".strtolower($DB->type)."/install.sql");
        }
        if ($this->errors !== false)
        {
            $APPLICATION->ThrowException(implode("<br>", $this->errors));
            return false;
        }
        else {
            RegisterModule($this->MODULE_ID);
            RegisterModuleDependences("main", "OnEpilog", $this->MODULE_ID, "DLog", "OnEpilog", "1000");
        }

        return true;
    }

    function InstallFiles()
    {
        CopyDirFiles($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/".$this->MODULE_ID."/install/admin", $_SERVER['DOCUMENT_ROOT']."/bitrix/admin");
        //CopyDirFiles($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/".$this->MODULE_ID."/install/themes/", $_SERVER['DOCUMENT_ROOT']."/bitrix/themes", true, true );
        return true;
    }

    function UnInstallDB(){
        global $DB, $DBType, $APPLICATION;
        $this->errors = false;
        COption::RemoveOption($this->MODULE_ID);
        $this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/db/".strtolower($DB->type)."/uninstall.sql");
        UnRegisterModuleDependences("main", "OnEpilog", $this->MODULE_ID, "CLog", "OnEpilog");
        UnRegisterModule($this->MODULE_ID);

        if ($this->errors !== false)
        {
            $APPLICATION->ThrowException(implode("<br>", $this->errors));
            return false;
        }

        return true;
    }

    function UnInstallFiles(){
        //DeleteDirFiles($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/".$this->MODULE_ID."/install/themes/.default/", $_SERVER['DOCUMENT_ROOT']."/bitrix/themes/.default" );
        //DeleteDirFilesEx($_SERVER['DOCUMENT_ROOT']."/bitrix/themes/.default/icons/".$this->MODULE_ID."/" );
        return true;
    }
}