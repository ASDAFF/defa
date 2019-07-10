<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Localization\Loc;

$MODULE_ID = $module_id = "defo.log1c";
Bitrix\Main\Loader::includeSharewareModule($module_id);

    if(\Bitrix\Main\ModuleManager::isModuleInstalled($MODULE_ID))
    {
        IncludeModuleLangFile(__FILE__);

        $aMenu = array(
            array(
                'parent_menu' => 'global_menu_store',
                'sort' => 400,
                'text' => Loc::getMessage('LOG1C_LOG'),
                'title' => Loc::getMessage('LOG1C_LOG_TITLE'),
                'url' => 'defo_log1c.php',
                'items_id' => 'menu_defo_log1c',
                "icon" => "mnu_defo_log1c_icon",
            ),
        );

        return $aMenu;
    }
