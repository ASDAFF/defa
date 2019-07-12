<?php
/**
 * Created by PhpStorm.
 * User: Winer
 * Date: 30.01.2019
 * Time: 14:30
 */

namespace XFive\Props;


class General
{
    const TYPE_SPRAVOCHNIK = 'SPRAVOCHNIK';
    const TYPE_SPISOK = 'SPISOK';
    const TYPE_STROKA = 'STROKA';
    const TYPE_CHISLO = 'CHISLO';
    const TYPE_INFOBLOCK = 'INFOBLOCK';
    const TYPE_OTHER = 'OTHER';
    const CUSTOM_PREFIX = 'CustoM_';

    public static $propsCache = []; //[PROPERTY_ID] = array("ID", "IBLOCK_ID", "CODE", "PROPERTY_TYPE", "USER_TYPE", "USER_TYPE_SETTINGS", "LINK_IBLOCK_ID")

    /** должен быть указан один из параметров. Функция проверяет закэширована ли информация в статической переменной и возвращает массив незакэшированных ID или CODE
     * Возвращает результат с ключами по ID или по CODE - зависит от того, какой параметр был передан
     * @param $PROPERTY_IDS
     * @param $PROPERTY_CODES
     * @param int $IBLOCK_ID - необязательный парамер, если указан параметр $PROPERTY_IDS
     * @return \Bitrix\Main\Result
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\LoaderException
     */
    public static function getProps($PROPERTY_IDS, $PROPERTY_CODES, $IBLOCK_ID = 0,$ignoreCache=false)
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        if ($PROPERTY_IDS && !is_array($PROPERTY_IDS)) $PROPERTY_IDS = array($PROPERTY_IDS);
        if ($PROPERTY_CODES && !is_array($PROPERTY_CODES)) $PROPERTY_CODES = array($PROPERTY_CODES);
        if (!is_array($PROPERTY_IDS) && !is_array($PROPERTY_CODES)) throw new \Bitrix\Main\ArgumentNullException("Один из параметров (PROPERTY_IDS или PROPERTIES_CODES) обязательно должен быть непустым ");
        if (is_array($PROPERTY_CODES) && $PROPERTY_CODES && intval($IBLOCK_ID)<=0) throw new \Bitrix\Main\ArgumentNullException("Если указали параметр PROPERTIES_CODES, то обязательно надо указать параметр IBLOCK_ID");

        if($ignoreCache) self::$propsCache = [];
        $uncachedIds = [];
        $uncachedCodes = [];
        if (is_array($PROPERTY_IDS)&&$PROPERTY_IDS) $uncachedIds = self::getUnCached($PROPERTY_IDS, array(),$IBLOCK_ID);
        elseif (is_array($PROPERTY_CODES)&&$PROPERTY_CODES) $uncachedCodes = self::getUnCached(array(), $PROPERTY_CODES,$IBLOCK_ID);

        if ($uncachedIds || $uncachedCodes) {
            $select = ["ID", "IBLOCK_ID", "CODE", "PROPERTY_TYPE", "USER_TYPE", "USER_TYPE_SETTINGS", "USER_TYPE_SETTINGS_LIST", "LINK_IBLOCK_ID","MULTIPLE"];
            //$select = ['*'];
            $filter = [];
            if (intval($IBLOCK_ID) > 0) $filter['IBLOCK_ID'] = $IBLOCK_ID;
            if (is_array($uncachedIds)&&$uncachedIds) $filter['ID'] = $uncachedIds;
            elseif (is_array($uncachedCodes)&&$uncachedCodes) $filter['CODE'] = $uncachedCodes;
            $dbProperty = \Bitrix\Iblock\PropertyTable::getList([
                "select" => $select,
                "filter" => $filter
            ]);
            while ($arP = $dbProperty->fetch()) {
                if ($arP['USER_TYPE'] == 'directory') {
                    //хайлоадблок
                    $arP[self::CUSTOM_PREFIX . 'PROPERTY_TYPE'] = self::TYPE_SPRAVOCHNIK;
                    $arP[self::CUSTOM_PREFIX . 'USER_TYPE_SETTINGS_UNSERIALIZED'] = unserialize($arP['USER_TYPE_SETTINGS']);


                } elseif (in_array($arP['PROPERTY_TYPE'], array('S'))) {

                    $arP[self::CUSTOM_PREFIX . 'PROPERTY_TYPE'] = self::TYPE_STROKA;
                } elseif (in_array($arP['PROPERTY_TYPE'], array('N'))) {

                    $arP[self::CUSTOM_PREFIX . 'PROPERTY_TYPE'] = self::TYPE_CHISLO;

                } elseif ($arP['PROPERTY_TYPE'] == 'L') {

                    $arP[self::CUSTOM_PREFIX . 'PROPERTY_TYPE'] = self::TYPE_SPISOK;

                } elseif ($arP['PROPERTY_TYPE'] == 'E') {
                    $arP[self::CUSTOM_PREFIX . 'PROPERTY_TYPE'] = self::TYPE_INFOBLOCK;
                }

                self::$propsCache[$arP['ID']] = $arP;
            }
        }

        $resProps = [];
        if (is_array($PROPERTY_IDS)&&$PROPERTY_IDS) {
            foreach ($PROPERTY_IDS as $PROPERTY_ID) {
                if (isset(self::$propsCache[$PROPERTY_ID])) {
                    $resProps[$PROPERTY_ID] = self::$propsCache[$PROPERTY_ID];
                }
            }
        } elseif (is_array($PROPERTY_CODES)&&$PROPERTY_CODES) {
            foreach ($PROPERTY_CODES as $PROPERTY_CODE) {
                foreach (self::$propsCache as $prop) {
                    if ($prop['CODE'] == $PROPERTY_CODE) {
                        $resProps[$PROPERTY_CODE] = $prop;
                    }
                }
            }
        }
        $result = new \Bitrix\Main\Result();
        $result->setData($resProps);

        return $result;
    }

    /** должен быть указан один из параметров. Функция проверяет закэширована ли информация в статической переменной и возвращает массив незакэшированных ID или CODE
     * @param $PROPERTY_IDS
     * @param $PROPERTY_CODES
     * @return array
     */
    public static function getUnCached($PROPERTY_IDS, $PROPERTY_CODES,$IBLOCK_ID=0)
    {
        $uncached = [];
        if ($PROPERTY_IDS && !is_array($PROPERTY_IDS)) $PROPERTY_IDS = array($PROPERTY_IDS);
        if ($PROPERTY_CODES && !is_array($PROPERTY_CODES)) $PROPERTY_CODES = array($PROPERTY_CODES);
        if (is_array($PROPERTY_CODES) && $PROPERTY_CODES && intval($IBLOCK_ID)<0) throw new \Bitrix\Main\ArgumentNullException("Если указали параметр PROPERTIES_CODES, то обязательно надо указать параметр IBLOCK_ID");

        if (is_array(self::$propsCache)&&self::$propsCache) {
            if (is_array($PROPERTY_IDS)&&$PROPERTY_IDS) {
                foreach ($PROPERTY_IDS as $PROPERTY_ID) {
                    if (!isset(self::$propsCache[$PROPERTY_ID])) $uncached[] = $PROPERTY_ID;
                }
            } elseif (is_array($PROPERTY_CODES)&&$PROPERTY_CODES) {

                foreach ($PROPERTY_CODES as $PROPERTY_CODE) {
                    $uncached[$PROPERTY_CODE] = $PROPERTY_CODE;
                    foreach (self::$propsCache as $prop) {
                        if ($prop['CODE'] == $PROPERTY_CODE && $prop['IBLOCK_ID']==$IBLOCK_ID) {
                            unset($uncached[$PROPERTY_CODE]);
                            break;
                        }
                    }
                }
                $uncached = array_keys($uncached);
            }
        } else {
            if (is_array($PROPERTY_IDS)&&$PROPERTY_IDS) $uncached = $PROPERTY_IDS;
            elseif (is_array($PROPERTY_CODES)&&$PROPERTY_CODES) $uncached = $PROPERTY_CODES;
        }
        return $uncached;
    }

    public static function getPropsIndexedByCode($PROPERTY_CODES,$IBLOCK_ID=0)
    {
        self::getProps(array(),$PROPERTY_CODES,$IBLOCK_ID); //для того, чтобы значения попали в кэш, если их там нет

        $resAr = [];
        foreach ($PROPERTY_CODES as $PROPERTY_CODE) {
            foreach (self::$propsCache as $key => $prop) {
                if ($prop['CODE'] == $PROPERTY_CODE) {
                    $resAr[$prop['CODE']] = $prop;
           }
            }
        }
        return $resAr;
    }

}