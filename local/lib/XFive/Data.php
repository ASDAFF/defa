<?php
/**
 * Created by PhpStorm.
 * User: Winer
 * Date: 26.06.2019
 * Time: 17:17
 */

namespace XFive;


class Data
{
    /**x5 20190626 функция для получения записей из справочника моделей, которые должны отображаться в меню. Результат кэшируется на 5 минут, так как для справочников нет тэгированного кэша
     * @param $IBLOCK_ID - инфоблок каталога
     * @return array|bool
     */
    public static function getModelsRowForMenu($IBLOCK_ID){
        $cache_dir = '/iblock/highloadblocks';
        $obCache = \Bitrix\Main\Data\Cache::createInstance();
        if ($obCache->initCache(3600000, serialize(array('getModelsRowForMenu')),$cache_dir)) {
            $models_for_menu = $obCache->getVars();
        } elseif ($obCache->startDataCache()) {
            $models_for_menu = \XFive\Props\Spravochnik::getHlRowsByFilter($IBLOCK_ID,'MODEL',array('UF_MENU'=>'1'));
            if (defined('BX_COMP_MANAGED_CACHE')) {
                global $CACHE_MANAGER;
                $CACHE_MANAGER->StartTagCache($cache_dir);
                $CACHE_MANAGER->RegisterTag('xaiload_model');
                $CACHE_MANAGER->EndTagCache();
            }
            $obCache->endDataCache($models_for_menu);
        }
        return $models_for_menu;
    }
}