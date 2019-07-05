<?php
namespace Defo\Log1c;

use Bitrix\Main\Entity;

class LogTable extends Entity\DataManager{

    public static function getTableName(){
        return 'b_defo_log1c_entity';
    }

    public static function getMap(){
        return array(
            new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true
            )),
            new Entity\DatetimeField('DATE', array(
                'required' => true
            )),
            new Entity\StringField('TYPE', array(
                'required' => true
            )),
            new Entity\StringField('STATUS', array(
                'required' => true
            )),
            new Entity\IntegerField('AMOUNT', array(
                'required' => true
            )),
            new Entity\StringField('TEXT', array(
                'required' => false
            )),
        );
    }

    public static function add($data){

        $arStatus = array("SUCCESS", "ERROR", "WARNING", 'UNKNOWN');
        $arType = array('offers', 'prices', 'rests', 'restsdr', 'unknown');

        if( !isset($data['STATUS']) || empty($data['STATUS']) || !in_array(strtoupper($data['STATUS']), $arStatus)){
            $data['STATUS'] = 'UNKNOWN';
        }else{
            $data['STATUS'] = strtoupper($data['STATUS']);
        }

        if( !isset($data['TYPE']) || empty($data['TYPE']) || !in_array(strtolower($data['TYPE']), $arType)){
            $data['TYPE'] = 'unknown';
        }else{
            $data['TYPE'] = strtolower($data['TYPE']);
        }

        if( !isset($data['AMOUNT']) || empty($data['AMOUNT'])){
            $data['AMOUNT'] = 0;
        }

        if( !isset($data['DATE']) || empty($data['DATE']) ){
            $data['DATE'] = new \Bitrix\Main\Type\DateTime(date('Y-m-d H:i:s', time()), 'Y-m-d H:i:s');
        }else{
            $data['DATE'] = new \Bitrix\Main\Type\DateTime($data["DATE"], "Y-m-d H:i:s");
        }
        
        $result = parent::add($data);
        if (!$result->isSuccess(true)) {
            return $result;
        }

        return $result;
    }
}