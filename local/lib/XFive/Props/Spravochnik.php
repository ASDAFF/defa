<?php
/**
 * Created by PhpStorm.
 * User: Winer
 * Date: 30.01.2019
 * Time: 11:10
 */

namespace XFive\Props;

class Spravochnik
{
    const NOT_SPRAVOCHNIK_VALUE = 'NOT_SPRAVOCHNIK_VALUE';

    public static $propsValuesCache = []; //[table_name][UF_XML_ID][UF_NAME]
    public static $propsIdTableName = []; //
    public static $propsIdAccordTableNameCache = []; //[PROPERTY_ID]['TABLE_NAME'] = array(size ,width,group,multiple,TABLE_NAME)
    public static $isValuesCacheFull = false;


    public static function getValueByXmlId_tablename($XML_ID, $hlTableName)
    {
        if (!$hlTableName) throw new \Bitrix\Main\ArgumentNullException("hlTableName");
        if (!$XML_ID) throw new \Bitrix\Main\ArgumentNullException("XML_ID");

    }

    public static function initValuesCache($TABLE_NAME, $XML_IDS, $UF_NAMES, $ignoreCache = false)
    {
        $result = new \Bitrix\Main\Result();
        if ($ignoreCache) self::resetValuesCache();
        if ($XML_IDS && !is_array($XML_IDS)) $XML_IDS = array($XML_IDS);
        elseif ($UF_NAMES && !is_array($UF_NAMES)) $UF_NAMES = array($UF_NAMES);
        if (!$TABLE_NAME) throw new \Bitrix\Main\ArgumentNullException("TABLE_NAME");
        $uncachedXmlIds = [];
        $uncachedUfNames = [];
        if($XML_IDS) $uncachedXmlIds = self::getUnCachedValues($XML_IDS,array(),$TABLE_NAME);
        elseif($UF_NAMES) $uncachedUfNames = self::getUnCachedValues(array(),$UF_NAMES,$TABLE_NAME);
        if (
            !isset(self::$propsValuesCache[$TABLE_NAME]) || //если в переменной нет кэша значений с ключом название таблицы
            (!self::$isValuesCacheFull && !$XML_IDS && !$UF_NAMES) || //если передан пустой параметр XML_IDS и UF_NAME (то есть выбрать все значения), а признак того, что в кэш выбраны все значения - false
            (!self::$isValuesCacheFull && ($uncachedXmlIds || $uncachedUfNames) //если кэш неполон и есть незакэшированные значения
            )
        ) {

            if ($XML_IDS) {
                $uncachedXmlIds = self::getUnCachedValues($XML_IDS, array(), $TABLE_NAME);
                $uncachedUfNames = [];
                $selectAll = false;
            } elseif ($UF_NAMES) {
                $uncachedXmlIds = [];
                $uncachedUfNames = self::getUnCachedValues(array(), $UF_NAMES, $TABLE_NAME);
                $selectAll = false;
            } else {
                $uncachedXmlIds = array();
                $uncachedUfNames = array();
                $selectAll = true;
            }
            if ($selectAll || $uncachedXmlIds || $uncachedUfNames) {
                \Bitrix\Main\Loader::includeModule('highloadblock');
                $HLData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter' => array('TABLE_NAME' => $TABLE_NAME)));
                if (!($hlblock = $HLData->fetch())) {
                    $result->addError(new \Bitrix\Main\Error('Не найден халоаблок с именем таблицы ' . $TABLE_NAME));
                }

                if ($result->isSuccess()) {
                    //$hlblock   = HL\HighloadBlockTable::getById($idHL)->fetch();
                    $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock); //генерация класса
                    $entityClass = $entity->getDataClass();


                    $filter = [];

                    if ($uncachedXmlIds) $filter['UF_XML_ID'] = $uncachedXmlIds;
                    elseif ($uncachedUfNames) $filter['UF_NAME'] = $uncachedUfNames;

                    $select = array('ID', 'UF_NAME', 'UF_XML_ID');
                    $rsData = $entityClass::getList(array(
                        'filter' => $filter,
                        'select' => $select,
                        //'limit' => '1',
                    ));
                    while ($arItem = $rsData->Fetch()) {
                        self::$propsValuesCache[$TABLE_NAME][$arItem['UF_XML_ID']] = $arItem['UF_NAME'];
                    }
                }
            }
        }
        return $result;
    }

    /** прокси для функции initValuesCache
     * @param $TABLE_NAME
     * @param $PROP_ID
     * @param $PROP_CODE
     * @param $IBLOCK_ID
     * @throws \Bitrix\Main\ArgumentNullException\
     */
    public static function initAllValuesCache($TABLE_NAME, $PROP_ID, $PROP_CODE, $IBLOCK_ID)
    {
        if (!$PROP_ID && !$PROP_CODE && !$TABLE_NAME) throw new \Bitrix\Main\ArgumentNullException("PROP_ID or PROP_CODE or TABLE_NAME");
        if ($PROP_CODE && intval($IBLOCK_ID) <= 0) throw new \Bitrix\Main\ArgumentNullException("PROP_CODE or IBLOCK_ID");
        $hlTableName = '';
        if ($TABLE_NAME) {
            $hlTableName = $TABLE_NAME;
        } elseif ($PROP_ID) {
            $tRes = self::getHLTableNameForProps($PROP_ID, array(), $IBLOCK_ID);
            $t = $tRes->getData();
            if (isset($t['spravochniki'][$PROP_ID])) $hlTableName = $t['spravochniki'][$PROP_ID];
        } elseif ($PROP_CODE) {
            $tRes = self::getHLTableNameForProps(array(), $PROP_CODE, $IBLOCK_ID);
            $t = $tRes->getData();
            if (isset($t['spravochniki'][$PROP_CODE])) $hlTableName = $t['spravochniki'][$PROP_CODE];
        }
        if(!$hlTableName) throw new \Bitrix\Main\SystemException("Не удалось получить имя хайлоадблока");
        self::initValuesCache($hlTableName, array(), array());
        return;
    }

    public static function resetValuesCache()
    {
        self::$propsValuesCache = array();
        self::$isValuesCacheFull = false;
        return;
    }

    public static function getValueByXmlId($XML_IDS = array(), $TABLE_NAME = '', $PROP_ID = 0, $PROP_CODE = '', $IBLOCK_ID = 0)
    {
        if (!$XML_IDS) throw new \Bitrix\Main\ArgumentNullException("XML_IDS");
        if($XML_IDS&&!is_array($XML_IDS)) $XML_IDS = array($XML_IDS);
        if (!$PROP_ID && !$PROP_CODE && !$TABLE_NAME) throw new \Bitrix\Main\ArgumentNullException("PROP_ID or PROP_CODE or TABLE_NAME");
        if ($PROP_CODE && intval($IBLOCK_ID) <= 0) throw new \Bitrix\Main\ArgumentNullException("PROP_CODE or IBLOCK_ID");
        $hlTableName = '';
        if ($TABLE_NAME) {
            $hlTableName = $TABLE_NAME;
        } elseif ($PROP_ID) {
            $tRes = self::getHLTableNameForProps($PROP_ID, array(), $IBLOCK_ID);
            $t = $tRes->getData();
            if (isset($t['spravochniki'][$PROP_ID])) $hlTableName = $t['spravochniki'][$PROP_ID];
        } elseif ($PROP_CODE) {
            $tRes = self::getHLTableNameForProps(array(), $PROP_CODE, $IBLOCK_ID);
            $t = $tRes->getData();
            if (isset($t['spravochniki'][$PROP_CODE])) $hlTableName = $t['spravochniki'][$PROP_CODE];
        }

        self::initValuesCache($hlTableName, $XML_IDS, array());
        $resAr = [];
        if ($XML_IDS) {
            foreach ($XML_IDS as $XML_ID) {
                if (isset(self::$propsValuesCache[$hlTableName][$XML_ID])) {
                    $resAr['found'][$XML_ID] = self::$propsValuesCache[$hlTableName][$XML_ID];
                } else {
                    $resAr['notfound'][$XML_ID] = '';
                }
            }
        } else {
            $resAr = array(
                'found' => self::$propsValuesCache[$hlTableName],
                'notfound' => array()
            );
        }
        return $resAr;
    }


    public static function getXmlIdByValue($UF_NAMES = array(), $TABLE_NAME = '', $PROP_ID = 0, $PROP_CODE = '', $IBLOCK_ID = 0)
    {
        //if (!$XML_IDS) throw new \Bitrix\Main\ArgumentNullException("XML_ID");
        if (!$PROP_ID && !$PROP_CODE && !$TABLE_NAME) throw new \Bitrix\Main\ArgumentNullException("PROP_ID or PROP_CODE or TABLE_NAME");
        if ($PROP_CODE && intval($IBLOCK_ID) <= 0) throw new \Bitrix\Main\ArgumentNullException("PROP_CODE or IBLOCK_ID");
        $hlTableName = '';
        if ($TABLE_NAME) {
            $hlTableName = $TABLE_NAME;
        } elseif ($PROP_ID) {
            $tRes = self::getHLTableNameForProps($PROP_ID, array(), $IBLOCK_ID);
            $t = $tRes->getData();
            if (isset($t['spravochniki'][$PROP_ID])) $hlTableName = $t['spravochniki'][$PROP_ID];
        } elseif ($PROP_CODE) {
            $tRes = self::getHLTableNameForProps(array(), $PROP_CODE, $IBLOCK_ID);
            $t = $tRes->getData();
            if (isset($t['spravochniki'][$PROP_CODE])) $hlTableName = $t['spravochniki'][$PROP_CODE];
        }

        self::initValuesCache($hlTableName, array(), $UF_NAMES);
        $resAr = [];
        $valuesIndexedByUfName = self::getValuesIndexedByUfName($hlTableName, $UF_NAMES);
        if ($UF_NAMES) {
            foreach ($UF_NAMES as $UF_NAME) {
                if (isset($valuesIndexedByUfName[$UF_NAME])) {
                    $resAr['found'][$UF_NAME] = $valuesIndexedByUfName[$UF_NAME];
                } else {
                    $resAr['notfound'][$UF_NAME] = '';
                }
            }
        } else {
            $resAr = array(
                'found' => $valuesIndexedByUfName,
                'notfound' => array()
            );
        }
        return $resAr;
    }

    public static function getHLTableNameForProps($PROPERTY_IDS, $PROPERTY_CODES, $IBLOCK_ID = 0)
    {
        $resAr = [];
        $resNotSpravochnikAr = [];
        if ($PROPERTY_IDS && !is_array($PROPERTY_IDS)) $PROPERTY_IDS = array($PROPERTY_IDS);
        if ($PROPERTY_CODES && !is_array($PROPERTY_CODES)) $PROPERTY_CODES = array($PROPERTY_CODES);
        $propsRes = \XFive\Props\General::getProps($PROPERTY_IDS, $PROPERTY_CODES, $IBLOCK_ID); //будет проиндексировано в зависимости от того, какой массив передан
        $props = $propsRes->getData();
        $c = \XFive\Props\General::CUSTOM_PREFIX;
        if (is_array($PROPERTY_IDS) && $PROPERTY_IDS) {
            foreach ($PROPERTY_IDS as $PROPERTY_ID) {
                if (isset($props[$PROPERTY_ID])) {
                    if ($props[$PROPERTY_ID][$c . 'PROPERTY_TYPE'] == \XFive\Props\General::TYPE_SPRAVOCHNIK)
                        $resAr[$PROPERTY_ID] = $props[$PROPERTY_ID][$c . 'USER_TYPE_SETTINGS_UNSERIALIZED']['TABLE_NAME'];
                    else
                        $resNotSpravochnikAr[$PROPERTY_ID]['ID'] = self::NOT_SPRAVOCHNIK_VALUE;
                }
            }
        } elseif (is_array($PROPERTY_CODES) && $PROPERTY_CODES) {
            foreach ($PROPERTY_CODES as $PROPERTY_CODE) {
                if (isset($props[$PROPERTY_CODE])) {
                    if ($props[$PROPERTY_CODE][$c . 'PROPERTY_TYPE'] == \XFive\Props\General::TYPE_SPRAVOCHNIK) {
                        $resAr[$PROPERTY_CODE] = $props[$PROPERTY_CODE][$c . 'USER_TYPE_SETTINGS_UNSERIALIZED']['TABLE_NAME'];
                    } else
                        $resNotSpravochnikAr[$PROPERTY_CODE]['ID'] = self::NOT_SPRAVOCHNIK_VALUE;
                }
            }
        }

        $result = new \Bitrix\Main\Result();
        $result->setData(array('spravochniki' => $resAr, 'ne_spravochniki' => $resNotSpravochnikAr));
        return $result;
    }


    public static function getUnCachedValues($XML_IDS, $UF_NAMES, $TABLE_NAME)
    {
        if (!$XML_IDS && !$UF_NAMES) throw new \Bitrix\Main\ArgumentNullException("XML_IDS and UF_NAMES");
        if (!$TABLE_NAME) throw new \Bitrix\Main\ArgumentNullException("TABLE_NAME");

        $uncached = [];

        if (is_array(self::$propsValuesCache) && self::$propsValuesCache) {
            if (is_array($XML_IDS) && $XML_IDS) {
                foreach ($XML_IDS as $XML_ID) {
                    if (!isset(self::$propsValuesCache[$TABLE_NAME][$XML_ID])) $uncached[] = $XML_ID;
                }
            } elseif (is_array($UF_NAMES) && $UF_NAMES) {
                $valuesIndexedByUfName = self::getValuesIndexedByUfName($TABLE_NAME, $UF_NAMES);
                foreach ($UF_NAMES as $UF_NAME) {
                    if (!isset($valuesIndexedByUfName[$UF_NAME])) $uncached[] = $UF_NAME;
                }
            }
        } else {
            if (is_array($XML_IDS) && $XML_IDS) {
                $uncached = $XML_IDS;
            } elseif (is_array($UF_NAMES) && $UF_NAMES) {
                $uncached = $UF_NAMES;
            }
        }
        return $uncached;
    }


    public static function getValuesIndexedByUfName($TABLE_NAME, $UF_NAMES)
    {
        self::initValuesCache($TABLE_NAME, array(), $UF_NAMES); //для того, чтобы значения попали в кэш, если их там нет

        $resAr = [];
        foreach ($UF_NAMES as $UF_NAME) {
            foreach (self::$propsValuesCache[$TABLE_NAME] as $xmlId => $ufName) {
                if ($ufName == $UF_NAME) {
                    $resAr[$ufName] = $xmlId;
                }
            }
        }
        return $resAr;
    }

    /**x5 20190625 поиск записей хайлоаблока по фильтру
     * @param $filter
     */
    public static function getHlRowsByFilter($IBLOCK_ID,$PROP_CODE,$filter){
        $arRows = [];
        $propRes = \XFive\Props\General::getProps([],[$PROP_CODE],$IBLOCK_ID);
        $props = $propRes->getData();
        if(!$props[$PROP_CODE]) return false;

        $USER_TYPE_SETTINGS_LIST = $props[$PROP_CODE]['USER_TYPE_SETTINGS_LIST'];
        $entityClass = self::getHLEntityClass($USER_TYPE_SETTINGS_LIST['TABLE_NAME']);
        //$select = array('ID', 'UF_NAME', 'UF_XML_ID');
        $select = ['*'];
        $rsData = $entityClass::getList(array(
            'filter' => $filter,
            'select' => $select
        ));

        while ($arItem = $rsData->Fetch()) {
            $arRows[$arItem['UF_XML_ID']] = $arItem;
        }
        return $arRows;

    }

    /**x5 получаем entityClass для последующей выборки
     * @param $tableName
     * @param int $table_id
     * @return mixed
     */
    public static function getHLEntityClass($tableName,$table_id=0){

        $result = new \Bitrix\Main\Result();
        \Bitrix\Main\Loader::includeModule('highloadblock');
        $HLData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter' => array('TABLE_NAME' => $tableName)));
        if (!($hlblock = $HLData->fetch())) {
            $result->addError(new \Bitrix\Main\Error('Не найден халоаблок с именем таблицы ' . $tableName));
        }

        if ($result->isSuccess()) {
            //$hlblock   = HL\HighloadBlockTable::getById($idHL)->fetch();
            $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock); //генерация класса
            $entityClass = $entity->getDataClass();
            return $entityClass;
        }
        return false;
    }


}