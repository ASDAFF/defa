<?php
namespace Defo\Agents;

use Bitrix\Highloadblock as HL;
use Bitrix\Sale\Delivery\ExtraServices\Store;

class BalanceAgent2{
	const ROOT_PATCH = "/home/bitrix/www";
	//надо будет изменить на ($site);
	static function updateBalanceChanges ($arResponse, $storeFromSite, $type) {
		\Bitrix\Main\Loader::includeModule('iblock');
		\Bitrix\Main\Loader::IncludeModule("defo.log1c");

		if (!is_dir(self::ROOT_PATCH))
		    $root = $_SERVER['DOCUMENT_ROOT'];
		else
		    $root = self::ROOT_PATCH;

		$logfile = $root."/log/newBalanceChanges2.log";
		$fp = fopen($logfile, 'a+');

        $time = date("d.m.Y H:i:s");
        fwrite($fp, $time.": $type: ------------------------------------------------------------------"."\n");

		//$arResponse = \Defo\Soap\SoapHelper::getBalanceChanges($site);
        if($arResponse) {

            foreach ($arResponse as $artikul => $item) { //патч для устранения пробелова в артикулах
                $artikul = trim($artikul);
                $arResponse2[$artikul] = $item;
            }
            $arResponse = $arResponse2;
            $time = date("d.m.Y H:i:s");
            $count1c = count($arResponse);
            fwrite($fp, $time.": $type: Received $count1c goods from 1C"."\n");

            $arArtikul = array_map("trim", array_keys($arResponse));

            $arItem = self::getIdByArtikul($arArtikul);
			
            $itemDiff = array_diff($arArtikul, array_keys($arItem));
			$logfile3 = $root."/log/newBalanceNotFoundItem.log";
			$fp3 = fopen($logfile3, 'a+');
			foreach ($itemDiff as $ar){
				$time = date("d.m.Y H:i:s");
	            fwrite($fp3, $time.": $ar"."\n");
			}
			fclose($fp3);
            
            
            $countSite = count($arItem);
            fwrite($fp, $time.": $type: Found $countSite goods from $count1c"."\n");

            $arStore = self::getStore();

            $arItemStore = self::getItemStore($arItem);

            $nn = 0; $countStore = 0; $countMainStore = 0;
            foreach ($arItem as $artikul => $id) {

                $nn++;
                foreach ($arResponse[$artikul] as $city => $arCity) {
                    foreach ($arCity as $storeXmlId => $store) {
                        $skladId = $arStore[$storeXmlId];
                        $itemId = $arItem[$artikul];
                        $ostatok = $store["Остаток"];
                        $ostatokSite = $arItemStore[$itemId][$skladId];

                        if ($ostatok != $ostatokSite) {
                            self::setStoreProduct($itemId, $skladId, $ostatok);
                            $itemForUpdate[] = $itemId;
                            $time = date("d.m.Y H:i:s");
                            fwrite($fp, $time.": $type: ".sprintf("%' 6d", $itemId).": sklad: ".sprintf("%' 4d", $skladId).", old: ".sprintf("%' 4d",$ostatokSite).", new: ".sprintf("%' 4d",$ostatok).sprintf("%' 25d",$nn)."\n");
							$countStore++;

                        }

                        if (in_array($storeXmlId, $storeFromSite->mainStoresElement)) {
                            foreach ($storeFromSite->mainStoresList as $includeStores) {
                                if (array_key_exists($storeXmlId, $includeStores) && isset($ostatok)){
                                    $arMainStore[$includeStores[$storeXmlId]] += $ostatok;
                                }
                            }
                        }


                    }
                    if (is_array($arMainStore)){
                        foreach ($arMainStore as $storenewId => $ostatokNew){
                            if ($ostatokNew != $arItemStore[$arItem[$artikul]][$storenewId]){
                                self::setStoreProduct($arItem[$artikul], $storenewId, $ostatokNew);
                                $itemForUpdate[] = $arItem[$artikul];
                                fwrite($fp, $time.": $type: ".sprintf("%' 6d", $arItem[$artikul]).": sklad: ".sprintf("%' 4d", $storenewId).", old: ".sprintf("%' 4d",$arItemStore[$arItem[$artikul]][$storenewId]).", new: ".sprintf("%' 4d",$ostatokNew)." <-- main store\n");
								$countMainStore++;
                            }
                        }
                    }
                    unset($arMainStore);

                }//city
            }

			$arLog = array(
				"TYPE" => "restsdr",
				"STATUS" => "SUCCESS",
				"AMOUNT" => $count1c,
				"DATE" => date("Y-m-d H:i:s",time()),
				"TEXT" => "Найдено $countSite товаров из $count1c;<br>Обновлены склады у ".count($itemForUpdate)." товаров;<br>Обновлено простых $countStore складов и $countMainStore составных; $type"
			);
			\DLog::add($arLog);
        }
        if (is_array($itemForUpdate)){
            $itemForUpdate = array_unique($itemForUpdate);
            foreach($itemForUpdate as $itemId){
                self::setUpdateProduct($itemId);
            }
        }
        unset($itemForUpdate);

	}


    static function getIdByArtikul($arArtikul){
        $arFilter = Array("IBLOCK_ID" => 20, "PROPERTY_ARTICLE" => $arArtikul);
        $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_ARTICLE");
        $res = \CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($item = $res->GetNext()){
            $arItem[$item["PROPERTY_ARTICLE_VALUE"]] = $item["ID"];
        }
        
        return $arItem;
    }

    static function getItemStore($arItem){
        $res = \CCatalogStore::GetList(
            array('PRODUCT_ID'=>'ASC','ID' => 'ASC'),
            array('PRODUCT_ID'=>array_values($arItem), ">ELEMENT_ID" => false, "!PRODUCT_AMOUNT" => false),
            false,
            false,
            array("ID","TITLE","PRODUCT_AMOUNT","ELEMENT_ID")
        ); // для массива товара по складам

        while($item = $res->GetNext()){
            $arItemStore[$item["ELEMENT_ID"]][$item["ID"]] = intval($item["PRODUCT_AMOUNT"]);
        }
        return $arItemStore;
    }

	static function getStore(){
		$res = \CCatalogStore::GetList(
			array('ID' => 'ASC'),
			array(),
			false,
			false,
			array("ID", "TITLE", "XML_ID")
		);
		
		while($item = $res->GetNext()) {
            if ($item["XML_ID"] && strlen($item["XML_ID"]) > 16){
                $arStore[$item["XML_ID"]] = $item["ID"];
            }
		}
		return $arStore;
	}
	
	function listStore(){
		$res = \CCatalogStore::GetList(
				array('ID' => 'ASC'),
				array(),
				false,
				false,
				array("ID", "TITLE", "XML_ID")
			);
		while($item = $res->GetNext()){
			$arStore[$item["XML_ID"]] = array($item["ID"], $item["TITLE"]);
		}
		return $arStore;
	}
    static function setStoreProduct($offerId, $storeId, $amount){
        $arFields = Array(
            "PRODUCT_ID" => $offerId,
            "STORE_ID" => $storeId,
            "AMOUNT" => $amount,
        );
        $flagUpdate = \CCatalogStoreProduct::UpdateFromForm($arFields);
        return true;
    }
    static function setUpdateProduct($offerId){
        $СElement = new \CIBlockElement;
        $timestamp = ConvertTimeStamp(time(), 'FULL');
        $userStoreId = StoresSite::getStoreUserId();
        $СElement->Update($offerId, array("TIMESTAMP_X" => $timestamp, "MODIFIED_BY" => $userStoreId));
    }
	
}


class StoresSite{
	public $stores;

	public function __construct(){
		$this->stores = [];
	}
	
	public function getStores($cities){

$storeType = new StoreType();
$storeType->getStoreType();

		$res = \CCatalogStore::GetList(
				array('ID' => 'ASC'),
				array(),
				false,
				false,
				array("ID", "XML_ID", "UF_STORE_CODE", "UF_STORE_CITY", "TITLE", "ADDRESS", "UF_STORE_TYPE", "UF_STORE_SALE", "UF_STORE_NELIKVID", "UF_STORE_ICLUDE")
			);
		while($item = $res->GetNext()){
		    if (!$item["UF_STORE_ICLUDE"] or empty(unserialize($item["UF_STORE_ICLUDE"]))){
			$this->stores[$item["XML_ID"]] = array(
			    "ID" => $item["ID"],
                "Code" => (int)$item["UF_STORE_CODE"],
                "Город" => (string)$cities[$item["UF_STORE_CITY"]],
                "Наименование" => (string)$item["~TITLE"],
                "Местонахождение" => (string)(trim($item["ADDRESS"]))?$item["ADDRESS"]:"",
                "ВидСклада" =>  (string)$storeType->typebyid[$item["UF_STORE_TYPE"]],
                "Распродажа" =>  (string)($item["UF_STORE_SALE"])?"true":"false",
                "Неликвид" =>  (string)($item["UF_STORE_NELIKVID"])?"true":"false"
            );

		    }else {
		        foreach (unserialize($item["UF_STORE_ICLUDE"]) as $incstore){
		            $arStore[] = $this->storesIb[$incstore];
		            $this->mainStoresList[][$this->storesIb[$incstore]] = $item["ID"];
                }
                $this->mainStores[$item["ID"]] = array(
                    "city" => $cities[$item["UF_STORE_CITY"]],
                    "name" => $item["~TITLE"],
                    "include" => $arStore
                );


                unset($arStore);
            }
		}
		foreach ($this->mainStoresList as $item){
            $this->mainStoresElement[] = array_keys($item)[0];
        }
	}
	function addStore($xml_id, $code, $city, $title, $address, $type, $sale, $nelekvid){
        $userStoreId = self::getStoreUserId();
        $arFields = array(
          "ACTIVE" => "Y",
          "ISSUING_CENTER" => "N",
          "SHIPPING_CENTER" => "N",
          "SITE_ID" => "s1",
          "XML_ID" => $xml_id,
          "TITLE" => $title,
          "ADDRESS" => $address,
          "MODIFIED_BY" => $userStoreId,
          "USER_ID" => $userStoreId
        );

        $id = \CCatalogStore::Add($arFields);

        global $DB, $USER_FIELD_MANAGER;
        $fields = Array(
            "UF_STORE_CODE" => $code,
            "UF_STORE_CITY" => $city,
            "UF_STORE_TYPE" => $type,
            "UF_STORE_SALE" => ($sale=="true")?1:0,
            "UF_STORE_NELIKVID" => ($nelekvid=="true")?1:0,
        );
        $USER_FIELD_MANAGER->Update("CAT_STORE", $id, $fields);

        self::addElement($xml_id, $code, $city, $title, $address, $userStoreId);
    }

    function updateStore($idStore, $xml_id, $code, $city, $title, $address, $type, $sale, $nelekvid){
        $userStoreId = self::getStoreUserId();
        $arFields = array(
            //"ACTIVE" => "Y",
            "ISSUING_CENTER" => "N",
            "SHIPPING_CENTER" => "N",
            "SITE_ID" => "s1",
            "XML_ID" => $xml_id,
            "TITLE" => $title,
            "ADDRESS" => $address,
            "MODIFIED_BY" => $userStoreId,
            "USER_ID" => $userStoreId
        );
        $fields = array(
            "UF_STORE_CODE" => $code,
            "UF_STORE_CITY" => $city,
            "UF_STORE_TYPE" => $type,
            "UF_STORE_SALE" => ($sale=="true")?1:0,
            "UF_STORE_NELIKVID" => ($nelekvid=="true")?1:0,
        );
        \CCatalogStore::Update($idStore, $arFields);
        global $DB, $USER_FIELD_MANAGER;
        $USER_FIELD_MANAGER->Update("CAT_STORE", $idStore, $fields);
        self::updateElement($xml_id, $code, $city, $title, $address, $userStoreId);
    }

    function addElement($xml_id, $code, $city, $title, $address, $userStoreId){
        $arFields = array(
            "IBLOCK_ID" => 50,
            "CREATED_BY" =>  $userStoreId,
            "MODIFIED_BY" => $userStoreId,
            "NAME" => $title,
            "CODE" => $code,
            "XML_ID" => $xml_id,
            "PROPERTY_VALUES"=> array("CITY" => $city, "ADDRESS" => $address)
        );
        $element = new \CIBlockElement();
        if ($id = $element->Add($arFields, false, false, false)){

        }
    }

    function updateElement($xml_id, $code, $city, $title, $address, $userStoreId){
        $element = new \CIBlockElement();
        $dbResult = $element->GetList(array(), array("IBLOCK_ID" => 50, "XML_ID" => $xml_id), false, false, array("ID", "IBLOCK_ID"));
        $item = $dbResult->getNext();
        $arFields = array(
            "MODIFIED_BY" => $userStoreId,
            "NAME" => $title,
            "CODE" => $code,
            "PROPERTY_VALUES"=> array("CITY" => $city, "ADDRESS" => $address)
        );
        if ($item["ID"]){
        	$element->Update($item["ID"], $arFields);
	}else{
		$this->addElement($xml_id, $code, $city, $title, $address, $userStoreId);
	}
    }

    function getStoreIblock(){
        $element = new \CIBlockElement();
        $dbResult = $element->GetList(array(), array("IBLOCK_ID" => 50), false, false, array("ID", "IBLOCK_ID", "NAME", "CODE", "XML_ID", "PROPERTY_CITY", "PROPERTY_ADDRESS"));
        while($item = $dbResult->getNext()){
            $this->storesIb[$item["ID"]] = $item["XML_ID"];
			$this->storesIblock[$item["XML_ID"]] = array(
				"ID" => $item["ID"],
				"NAME" => $item["~NAME"],
				"CODE" => $item["CODE"],
				"XML_ID" => $item["XML_ID"],
				"CITY" => $item["PROPERTY_CITY_VALUE"],
				"ADDRESS" => $item["PROPERTY_ADDRESS_VALUE"] 
			);
        }
    }

    static function getStoreUserId(){
        $rsUser = \CUser::GetByLogin("1c-store@defo.ru");
        $arUser = $rsUser->Fetch();
        $userStoreId = $arUser["ID"];
        return $userStoreId;
    }

}

class Stores1c{
    public $stores;

    public function __construct($res){
        $this->res = $res;
    }

    public function getStores(){

        foreach ($this->res as $arCities) {
            foreach ($arCities as $city=>$arStores){
                foreach ($arStores as $xml_id=>$store){
                    $this->stores[$xml_id] = array(
                        "Code" => $store["Code"],
                        "Город" => $city,
                        "Наименование" => $store["Наименование"],
                        "Местонахождение" => $store["Местонахождение"],
                        "ВидСклада" =>  $store["ВидСклада"],
                        "Распродажа" =>  $store["Распродажа"],
                        "Неликвид" =>  $store["Неликвид"]
                    );
                }
            }
        }
        unset($this->res);
    }
}

class City{

    public function getCities(){
        $res = \CIBlockElement::GetList(
            array('NAME' => 'ASC'),
            array(
                'IBLOCK_ID' => 2,
                'ACTIVE' => 'Y',
                //'>PROPERTY_RATIO' => 0
            ),
            false,
            false,
            array('NAME', 'ID')
        );
        while($item = $res->GetNext()){
            $this->citybyid[$item["ID"]] = $item["NAME"];
            $this->idbycity[$item["NAME"]] = $item["ID"];
        }
    }
}

class StoreType{
    public function getStoreType(){
        $res = \CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME" => "UF_STORE_TYPE"));
        while($item = $res->GetNext()){
            $this->typebyid[$item["ID"]] = $item["VALUE"];
            $this->idbytype[$item["VALUE"]] = $item["ID"];
        }
    }
}

class StoreDiff{

    function diffStores($storeFrom1c, $storeFromSite, $storeFromIblock, $storesFromIblockList, $arCity, $arType){

        foreach ($storeFrom1c as $xml_id=>$store){
            if (!$storeFromSite[$xml_id]){
                StoresSite::addStore($xml_id, $store["Code"],  $arCity[$store["Город"]], $store["Наименование"], $store["Местонахождение"], $arType[$store["ВидСклада"]], $store["Распродажа"], $store["Неликвид"]);
                $logfile = "/home/bitrix/www/log/newBalanceChangesStore.log";
				$fp = fopen($logfile, 'a+');
				$time = date("d.m.Y H:i:s");
                fwrite($fp, $time.": updateBalanceChanges: add Store $xml_id"."\n");
            }else{
                self::diffOneStores($xml_id, $store, $storeFromSite[$xml_id], $arCity, $arType);
				self::diffOneStoresIblock($xml_id, $store, $storesFromIblockList[$xml_id], $arCity, $arType);
            }
        }

    }
    function diffOneStores($xml_id, $storeFrom1c, $storeFromSite, $arCity, $arType){

        $idStore = $storeFromSite["ID"];
        unset($storeFromSite["ID"]);
		$store = $storeFrom1c;
		if ($store["Code"] != $storeFromSite["Code"] or $store["Город"] != $storeFromSite["Город"] or $store["Наименование"] != $storeFromSite["Наименование"] or $store["Местонахождение"] != $storeFromSite["Местонахождение"] or $store["ВидСклада"] != $storeFromSite["ВидСклада"] or $store["Распродажа"] != $storeFromSite["Распродажа"] or $store["Неликвид"] != $storeFromSite["Неликвид"]){
            
            StoresSite::updateStore($idStore, $xml_id, $store["Code"],  $arCity[$store["Город"]], $store["Наименование"], $store["Местонахождение"], $arType[$store["ВидСклада"]], $store["Распродажа"], $store["Неликвид"]);
            $logfile = "/home/bitrix/www/log/newBalanceChangesStore.log";
			$fp = fopen($logfile, 'a+');
			$time = date("d.m.Y H:i:s");
            fwrite($fp, $time.": updateBalanceChanges: update Store $xml_id $idStore"."\n");
fwrite($fp, $time." ".$idStore.", xml_id: ".$xml_id.", city: ".$store["Code"].", code: ".$store["Code"].", name: ".$store["Наименование"].", address".$store["Местонахождение"].", type: ".$arType[$store["ВидСклада"]].",sale: ".$store["Распродажа"].", nelikvid: ".$store["Неликвид"]."\n");
fwrite($fp, $time." store from 1C: "."\n");
            fwrite($fp, var_export($storeFrom1c, true));
            fwrite($fp, $time." store from site: "."\n");
            fwrite($fp, var_export($storeFromSite, true));
        }
		
}

function diffOneStoresIblock($xml_id, $store, $storeFromIblock, $arCity, $arType){
		if (!$storeFromIblock){//!!!!!
			$userStoreId = StoresSite::getStoreUserId();
			StoresSite::addElement($xml_id, $store["Code"],  $arCity[$store["Город"]], $store["Наименование"], $store["Местонахождение"], $userStoreId);
		}else{
			if ($store["Code"] != intval($storeFromIblock["CODE"]) or $arCity[$store["Город"]] != $storeFromIblock["CITY"] or $store["Наименование"] != $storeFromIblock["NAME"] or $store["Местонахождение"] != $storeFromIblock["ADDRESS"]){
				$userStoreId = StoresSite::getStoreUserId();
				StoresSite::updateElement($xml_id, $store["Code"], $arCity[$store["Город"]], $store["Наименование"], $store["Местонахождение"], $userStoreId);
			}		
		}
	}
}