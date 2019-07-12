<?php
/**
 * Created by PhpStorm.
 * User: Winer
 * Date: 30.01.2019
 * Time: 11:10
 */

namespace XFive\Props;


class Spisok
{
    public static $propsValuesCache = []; //[PROPERTY_ID][VALUE_TEXT][VALUE_ID]
    public static $isValuesCacheFull = false;


    public static function getValueById($IDS = array(),$PROP_ID = 0, $PROP_CODE = '', $IBLOCK_ID = 0)
    {
        //if (!$XML_IDS) throw new \Bitrix\Main\ArgumentNullException("XML_ID");
        if (!$PROP_ID && !$PROP_CODE) throw new \Bitrix\Main\ArgumentNullException("PROP_ID or PROP_CODE");
        if ($PROP_CODE && intval($IBLOCK_ID) <= 0) throw new \Bitrix\Main\ArgumentNullException("PROP_CODE or IBLOCK_ID");
        $PROPERTY_ID = 0;
        if ($PROP_ID){
            $PROPERTY_ID = $PROP_ID;
        } elseif($PROP_CODE) {
           $tRes = \XFive\Props\General::getProps(array(),array($PROP_CODE),$IBLOCK_ID);
           $t = $tRes->getData();
           if($t['ID']) $PROPERTY_ID = $t['ID'];
        }

        self::initValuesCache($PROPERTY_ID, $IDS, array());
        $resAr = [];
        if ($IDS) {
            foreach ($IDS as $ID) {
                if (isset(self::$propsValuesCache[$PROPERTY_ID][$ID])) {
                    $resAr['found'][$ID] = self::$propsValuesCache[$PROPERTY_ID][$ID];
                } else {
                    $resAr['notfound'][$ID] = '';
                }
            }
        } else {
            $resAr = array(
                'found' => self::$propsValuesCache[$PROPERTY_ID],
                'notfound' => array()
            );
        }
        return $resAr;
    }


    public static function getIdByValue($NAMES = array(),$PROP_ID = 0, $PROP_CODE = '', $IBLOCK_ID = 0)
    {
        //if (!$XML_IDS) throw new \Bitrix\Main\ArgumentNullException("XML_ID");
        if (!$PROP_ID && !$PROP_CODE) throw new \Bitrix\Main\ArgumentNullException("PROP_ID or PROP_CODE");
        if ($PROP_CODE && intval($IBLOCK_ID) <= 0) throw new \Bitrix\Main\ArgumentNullException("PROP_CODE or IBLOCK_ID");
        $PROPERTY_ID = 0;
        if ($PROP_ID){
            $PROPERTY_ID = $PROP_ID;
        } elseif($PROP_CODE) {
            $tRes = \XFive\Props\General::getProps(array(),$PROP_CODE,$IBLOCK_ID);
            $t = $tRes->getData();
            if($t[$PROP_CODE]['ID']) $PROPERTY_ID = $t[$PROP_CODE]['ID'];
        }

        self::initValuesCache($PROPERTY_ID, array(), $NAMES);
        $resAr = [];
        $valuesIndexedByName = self::getValuesIndexedByName($PROPERTY_ID, $NAMES);
        if ($NAMES) {
            foreach ($NAMES as $NAME) {
                if (isset($valuesIndexedByName[$NAME])) {
                    $resAr['found'][$NAME] = $valuesIndexedByName[$NAME];
                } else {
                    $resAr['notfound'][$NAME] = '';
                }
            }
        } else {
            $resAr = array(
                'found' => $valuesIndexedByName,
                'notfound' => array()
            );
        }
        return $resAr;
    }


    public static function getValuesIndexedByName($PROPERTY_ID, $NAMES)
    {
        self::initValuesCache($PROPERTY_ID, array(), $NAMES); //для того, чтобы значения попали в кэш, если их там нет

        $resAr = [];
        foreach ($NAMES as $NAME) {
            foreach (self::$propsValuesCache[$PROPERTY_ID] as $id => $value) {
                if ($value['VALUE'] == $NAME) {
                    $resAr[$NAME] = $value;
                }
            }
        }
        return $resAr;
    }

    public static function initValuesCache($PROPERTY_ID, $IDS, $NAMES, $ignoreCache = false)
    {
        $result = new \Bitrix\Main\Result();
        if ($ignoreCache) self::resetValuesCache();
        if ($IDS && !is_array($IDS)) $IDS = array($IDS);
        elseif ($NAMES && !is_array($NAMES)) $NAMES = array($NAMES);
        if (!$PROPERTY_ID) throw new \Bitrix\Main\ArgumentNullException("PROPERTY_ID");
        if (
            !isset(self::$propsValuesCache[$PROPERTY_ID]) || //если в переменной нет кэша значений с ключом название таблицы
            ((!self::$isValuesCacheFull && !$IDS) && //если передан пустой параметр XML_IDS (то есть выбрать все значения), а признак того, что в кэш выбраны все значения - false
                (!self::$isValuesCacheFull && !$NAMES)) //если передан пустой параметр XML_IDS (то есть выбрать все значения), а признак того, что в кэш выбраны все значения - false
        ) {


            if ($IDS) {
                $uncachedIds = self::getUnCachedValues($PROPERTY_ID,$IDS, array());
                $uncachedNames = [];
                $selectAll = false;
            } elseif ($NAMES) {
                $uncachedIds = [];
                $uncachedNames = self::getUnCachedValues($PROPERTY_ID,array(), $NAMES);
                $selectAll = false;
            } else {
                $uncachedIds = array();
                $uncachedNames = array();
                $selectAll = true;
            }

            if ($selectAll || $uncachedIds || $uncachedNames) {
                \Bitrix\Main\Loader::includeModule('iblock');


                $filter = ["PROPERTY_ID"=>$PROPERTY_ID];

                    if ($uncachedIds) $filter['ID'] = $uncachedIds;
                    elseif ($uncachedNames) $filter['VALUE'] = $uncachedNames;

                d($filter);
                $select = array('ID', 'VALUE');
                $dbPropertyEnumeration = \Bitrix\Iblock\PropertyEnumerationTable::getList([
                    "select" => $select,
                    "filter" => $filter,
                    "limit" => 1
                ]);
                while($enum = $dbPropertyEnumeration->fetch()):
                    self::$propsValuesCache[$PROPERTY_ID][$enum['ID']] = $enum;
                endwhile;

            }
        }
        return $result;
    }

    public static function initAllValuesCache($PROP_ID, $PROP_CODE, $IBLOCK_ID)
    {
        $PROPERTY_ID = 0;
        if ($PROP_ID){
            $PROPERTY_ID = $PROP_ID;
        } elseif($PROP_CODE) {
            $tRes = \XFive\Props\General::getProps(array(),$PROP_CODE,$IBLOCK_ID);
            $t = $tRes->getData();
            if($t[$PROP_CODE]['ID']) $PROPERTY_ID = $t[$PROP_CODE]['ID'];
        }
        if(!$PROPERTY_ID) throw new \Bitrix\Main\SystemException("Не удалось получить ID свойства");
        self::initValuesCache($PROPERTY_ID, array(), array());
        return;
    }



    public static function getUnCachedValues($PROPERTY_ID,$IDS, $NAMES)
    {
        if (!$IDS && !$NAMES) throw new \Bitrix\Main\ArgumentNullException("IDS and NAMES");
        if (!$PROPERTY_ID) throw new \Bitrix\Main\ArgumentNullException("PROPERTY_ID");

        $uncached = [];

        if (is_array(self::$propsValuesCache) && self::$propsValuesCache) {
            if (is_array($IDS) && $IDS) {
                foreach ($IDS as $ID) {
                    if (!isset(self::$propsValuesCache[$PROPERTY_ID][$ID])) $uncached[] = $ID;
                }
            } elseif (is_array($NAMES) && $NAMES) {
                $valuesIndexedByName = self::getValuesIndexedByName($PROPERTY_ID, $NAMES);
                foreach ($NAMES as $NAME) {
                    if (!isset($valuesIndexedByName[$NAME])) $uncached[] = $NAME;
                }
            }
        } else {
            if (is_array($IDS) && $IDS) {
                $uncached = $IDS;
            } elseif (is_array($NAMES) && $NAMES) {
                $uncached = $NAMES;
            }
        }
        return $uncached;
    }



}