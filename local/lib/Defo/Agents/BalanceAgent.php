<?php
namespace Defo\Agents;

use Bitrix\Highloadblock as HL;

class BalanceAgent
{
    static function updateBalance($countToUpdate) {
//    	$arXmlId = array('8#45014' );
global $DB;
\Bitrix\Main\Loader::includeModule("catalog");
\Bitrix\Main\Loader::includeModule('iblock');
\Bitrix\Main\Loader::includeModule('highloadblock');

		$logfile = "/var/www/bitrix/data/www/defo.ru/log/newBalanceChanges.log";
		$fp = fopen($logfile, 'a+');
		$time = date("d.m.Y H:i:s");
		fwrite($fp, $time.": updateBalanceStart! "."\n");

	//$this = new BalanceAgent();
	$arCitiesREG = self::getCitiesReg();

        $result = \CIBlockElement::GetList(
            array('NAME' => 'ASC'),
            array(
                'IBLOCK_ID' => 21,
                'ACTIVE' => 'Y',
                //'!=PROPERTY_FRANSHIZA_VALUE' => 'Да',
                '>PROPERTY_RATIO' => 0
            ),
            false,
            false,
            array('NAME', 'PROPERTY_LOCATION')
        );

        $arCities = array();
        while ($arCity = $result->Fetch()) {
			$arCities[$arCity['PROPERTY_LOCATION_VALUE']] = $arCity['NAME'];
        }
		
		$arStore = self::getStore($arCitiesREG);
			

        $hlblock = HL\HighloadBlockTable::getById(3)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $eshopPatternReferenceTable = $entity->getDataClass();

        $result = $eshopPatternReferenceTable::getList(array(
            'order' => array('UF_BALANCE_UPDATE' => 'ASC'),
            'select' => array('ID', 'UF_XML_ID'),
            'limit' => $countToUpdate
        ));

        $arRequest = array();
        $arPrimaryKeys = array();
        while ($arRow = $result->fetch()) {
				$arPrimaryKeys[$arRow['UF_XML_ID']] = $arRow['ID'];
				$arRequest[$arRow['UF_XML_ID']] = $arCities;
				$arArtikul[] = $arRow['UF_XML_ID'];
        }

		$arItem = self::getIdByArtikul($arArtikul);
		$arItemStore = self::getItemStore($arItem, $arStore);
	
        if($arRequest) {
			$timestamp = ConvertTimeStamp(time(), 'FULL');
			$arResponse = \Defo\Soap\SoapHelper::getBalance($arRequest);
			foreach ($arResponse as $code => $arCountsByCityCode) {
				$flagLog = false;				
				$eshopPatternReferenceTable::update($arPrimaryKeys[$code], array('UF_BALANCE' => json_encode($arCountsByCityCode), 'UF_BALANCE_UPDATE' => $timestamp));
				
				$flagStoreUpdate = false; // флаг что у товара какой-то склад обновился
				
				foreach($arCountsByCityCode as $location => $amount){
					if (!$arItem[$code] || !in_array($location, $arCitiesREG) || !$arStore[$location] || $arStore[$location] == 0)
						continue;
					$arItemStoreProduct = $arItemStore[$arItem[$code]];
					if ($amount != $arItemStoreProduct[$arStore[$location]]){
						$flagStoreUpdate = self::setStoreProduct($arItem[$code], $arStore[$location], $amount);
						$time = date("d.m.Y H:i:s");
						$flagLog = true;
						fwrite($fp, $time.": updateBalance: ".sprintf("%' 6d", $arItem[$code]).": sklad: ".sprintf("%' 3d", $arStore[$location]).", old: ".sprintf("%' 4d",$arItemStoreProduct[$arStore[$location]]).", new: ".sprintf("%' 4d",$amount)."\n");
					}
				}
				if ($flagStoreUpdate){
					self::setUpdateProduct($arItem[$code]);
				}
				if (!$flagLog){
					$time = date("d.m.Y H:i:s");
					fwrite($fp, $time.": updateBalance: ".$code.", ".sprintf("%' 6d", $arItem[$code])."\n");
				}
				$flagLog = false;
			}
		}
fclose($fp);
        return '\Defo\Agents\BalanceAgent::updateBalance('.$countToUpdate.');';
    }

	static function updateBalanceById($xmlId) {

		$logfile = "/var/www/bitrix/data/www/defo.ru/log/newBalanceChanges.log";
		$fp = fopen($logfile, 'a+');
		
		// Get cities codes
		\Bitrix\Main\Loader::includeModule('iblock');
		$result = \CIBlockElement::GetList(
			array('NAME' => 'ASC'),
			array(
				'IBLOCK_ID' => 21,
				'ACTIVE' => 'Y',
				//'!=PROPERTY_FRANSHIZA_VALUE' => 'Да',
				'>PROPERTY_RATIO' => 0
			),
			false,
			false,
			array('NAME', 'PROPERTY_LOCATION')
		);

		$arCities = array();
		$arCitiesREG = self::getCitiesReg();
		$arStore = self::getStore($arCitiesREG);
		
		while ($arCity = $result->Fetch()) {
			$arCities[$arCity['PROPERTY_LOCATION_VALUE']] = $arCity['NAME'];
		}
		
		// Get offers articules for update
		\Bitrix\Main\Loader::includeModule('highloadblock');

		$hlblock = HL\HighloadBlockTable::getById(3)->fetch();
		$entity = HL\HighloadBlockTable::compileEntity($hlblock);
		$eshopPatternReferenceTable = $entity->getDataClass();

		$result = $eshopPatternReferenceTable::getList(array(
			//'order' => array('UF_BALANCE_UPDATE' => 'ASC'),
			'select' => array('ID', 'UF_XML_ID'),
			'filter' => array('UF_XML_ID' => $xmlId)
			//'limit' => $countToUpdate
		));

		$arRequest = array();
		$arPrimaryKeys = array();
		while ($arRow = $result->fetch()) {
			if($arRow['UF_XML_ID'] == $xmlId) {
				$arPrimaryKeys[$arRow['UF_XML_ID']] = $arRow['ID'];
				$arRequest[$arRow['UF_XML_ID']] = $arCities;
				$arArtikul[] = trim($arRow['UF_XML_ID']);
			}
		}
		$arFilter = Array("IBLOCK_ID" => 17, "PROPERTY_ARTNUMBER" => $arArtikul);
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_ARTNUMBER");
		$res = \CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($item = $res->GetNext()){
			$arItem[$item["PROPERTY_ARTNUMBER_VALUE"]] = $item["ID"];
		}
		$arItemStore = self::getItemStore($arItem, $arStore);

		if($arRequest) {
			$timestamp = ConvertTimeStamp(time(), 'FULL');
			$arResponse = \Defo\Soap\SoapHelper::getBalance($arRequest);

			foreach ($arResponse as $code => $arCountsByCityCode) {
				
				$flagLog = false;
				$eshopPatternReferenceTable::update($arPrimaryKeys[$code],
					array('UF_BALANCE' => json_encode($arCountsByCityCode), 'UF_BALANCE_UPDATE' => $timestamp));
				
				$flagStoreUpdate = false; // флаг что у товара какой-то склад обновился
				
				foreach($arCountsByCityCode as $location => $amount){
					if (!$arItem[$code] || !in_array($location, $arCitiesREG))
						continue;
					$arItemStoreProduct = $arItemStore[$arItem[$code]];
					if ($amount != $arItemStoreProduct[$arStore[$location]]){
						$flagStoreUpdate = self::setStoreProduct($arItem[$code], $arStore[$location], $amount);
						$time = date("d.m.Y H:i:s");
						$flagLog = true;
						fwrite($fp, $time.": updateBalanceById: ".sprintf("%' 6d", $arItem[$code]).": sklad: ".sprintf("%' 3d", $arStore[$location]).", old: ".sprintf("%' 4d",$arItemStoreProduct[$arStore[$location]]).", new: ".sprintf("%' 4d",$amount)."\n");
					}
				}
				if ($flagStoreUpdate){
					self::setUpdateProduct($arItem[$code]);
				}
				if (!$flagLog){
					$time = date("d.m.Y H:i:s");
					fwrite($fp, $time.": updateBalanceById: ".$code.", ".sprintf("%' 6d", $arItem[$code])."\n");
				}
				$flagLog = false;
			}
		}
		fclose($fp);
		//return '\Defo\Agents\BalanceAgent::updateBalance('.$countToUpdate.');';   // ??????????????????????????????????????????????
	}

    static function updateBalanceChanges ($site) {

		// условия обновления с 1С: https://defo.bitrix24.ru/company/personal/user/990/tasks/task/view/99808/
		// Get cities codes
        \Bitrix\Main\Loader::includeModule('iblock');
		$logfile = "/var/www/bitrix/data/www/defo.ru/log/newBalanceChanges.log";
		$fp = fopen($logfile, 'a+');

        $result = \CIBlockElement::GetList(
            array('NAME' => 'ASC'),
            array(
                'IBLOCK_ID' => 21,
                'ACTIVE' => 'Y',
                //'!=PROPERTY_FRANSHIZA_VALUE' => 'Да',
                '>PROPERTY_RATIO' => 0
            ),
            false,
            false,
            array('NAME', 'PROPERTY_LOCATION')
        );

        $arCities = array();
        while ($arCity = $result->Fetch()) {
			$arCitiesCode[$arCity['PROPERTY_LOCATION_VALUE']] = $arCity['NAME'];
			$arCities[$arCity['NAME']] = $arCity['PROPERTY_LOCATION_VALUE'];
        }
		
		$arCitiesREG = self::getCitiesReg();
		$arStore = self::getStore($arCitiesREG);
		
		 $result = \CIBlockElement::GetList(
            array('NAME' => 'ASC'),
            array(
                'IBLOCK_ID' => 21,
				'PROPERTY_LOCATION' => $arCitiesREG
            ),
            false,
            false,
            array('ID', ' IBLOCK_ID', 'NAME', 'PROPERTY_LOCATION')
        );

        $arCitiesRegIdName = array();
        while ($arCity2 = $result->Fetch()) {
			$arCitiesRegIdName[$arCity2['PROPERTY_LOCATION_VALUE']] = $arCity2['NAME'];
        }
		$arCitiesRegNameId = array_flip($arCitiesRegIdName);
				
		$arResponse = \Defo\Soap\SoapHelper::getBalanceChanges($site);

		if($arResponse){
		// Get offers articules for update
		
		$arArtikul = array_map("trim", array_keys($arResponse));
		
		$arItem = self::getIdByArtikul($arArtikul);
		$arItemStore = self::getItemStore($arItem, $arStore);
		
        \Bitrix\Main\Loader::includeModule('highloadblock');

        $hlblock = HL\HighloadBlockTable::getById(3)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $eshopPatternReferenceTable = $entity->getDataClass();

		$result = $eshopPatternReferenceTable::getList(array(
            'select' => array('ID', 'UF_XML_ID', 'UF_BALANCE'),
            'filter' => array('UF_XML_ID' => array_keys($arResponse))
        ));
 
		$timestamp = ConvertTimeStamp(time(), 'FULL');

		while ($arRow = $result->fetch()) {//
			$ufBalance = json_decode($arRow['UF_BALANCE'], true);
			$isUpdateBalance = false;
			foreach($arResponse[$arRow['UF_XML_ID']] as $cityName => $count){
				if(in_array($arCities[$cityName], array_keys($ufBalance))){
					$isUpdateBalance = true;
					$ufBalance[$arCities[$cityName]] = $count;
				} else {
					$isUpdateBalance = true;
					$ufBalance[$arCities[$cityName]] = $count;
				}
			}
			if($isUpdateBalance) {
				$eshopPatternReferenceTable::update($arRow['ID'],
				array('UF_BALANCE' => json_encode($ufBalance), 'UF_BALANCE_UPDATE' => $timestamp));
			}
        }
		
		foreach($arResponse as $artikul => $arStoreAvail){
			if (!$arItem[trim($artikul)])
				continue;
			$itemId = $arItem[trim($artikul)];
			
			foreach($arStoreAvail as $cityName => $amount){
				if (!$arCitiesRegNameId[$cityName])
					continue;
				if ($amount != $arItemStore[$itemId][$arStore[$arCitiesRegNameId[$cityName]]]){
					$flagStoreUpdate = self::setStoreProduct($itemId, $arStore[$arCitiesRegNameId[$cityName]], $amount);
					$time = date("d.m.Y H:i:s");
					$flagLog = true;
					fwrite($fp, $time.": updateBalanceChanges: ".sprintf("%' 6d", $itemId).": sklad: ".sprintf("%' 3d", $arStore[$arCitiesRegNameId[$cityName]]).", old: ".sprintf("%' 4d",$arItemStore[$itemId][$arStore[$arCitiesRegNameId[$cityName]]]).", new: ".sprintf("%' 4d",$amount)."\n");
						
					if ($flagStoreUpdate){
						$itemForUpdate[] = $itemId;
					}
				}
			}
		}
		
		if (is_array($itemForUpdate)){
			$itemForUpdate = array_unique($itemForUpdate);
			foreach($itemForUpdate as $itemId){
				self::setUpdateProduct($itemId);
			}
		}
		}

		fclose($fp);
		return '\Defo\Agents\BalanceAgent::updateBalanceChanges('.$site.');';
	}
	
    static function updateBalanceRepeatLast($site) {

		// условия обновления с 1С: https://defo.bitrix24.ru/company/personal/user/990/tasks/task/view/99808/
		// Get cities codes
        \Bitrix\Main\Loader::includeModule('iblock');
		$logfile = "/var/www/bitrix/data/www/defo.ru/log/newBalanceChanges.log";
		$fp = fopen($logfile, 'a+');

        $result = \CIBlockElement::GetList(
            array('NAME' => 'ASC'),
            array(
                'IBLOCK_ID' => 21,
                'ACTIVE' => 'Y',
                //'!=PROPERTY_FRANSHIZA_VALUE' => 'Да',
                '>PROPERTY_RATIO' => 0
            ),
            false,
            false,
            array('NAME', 'PROPERTY_LOCATION')
        );

        $arCities = array();
        while ($arCity = $result->Fetch()) {
			$arCitiesCode[$arCity['PROPERTY_LOCATION_VALUE']] = $arCity['NAME'];
			$arCities[$arCity['NAME']] = $arCity['PROPERTY_LOCATION_VALUE'];
        }

		$arCitiesREG = self::getCitiesReg();
		$arStore = self::getStore($arCitiesREG);

		 $result = \CIBlockElement::GetList(
            array('NAME' => 'ASC'),
            array(
                'IBLOCK_ID' => 21,
				'PROPERTY_LOCATION' => $arCitiesREG
            ),
            false,
            false,
            array('ID', ' IBLOCK_ID', 'NAME', 'PROPERTY_LOCATION')
        );

        $arCitiesRegIdName = array();
        while ($arCity2 = $result->Fetch()) {
			$arCitiesRegIdName[$arCity2['PROPERTY_LOCATION_VALUE']] = $arCity2['NAME'];
        }
		$arCitiesRegNameId = array_flip($arCitiesRegIdName);

		$arResponse = \Defo\Soap\SoapHelper::getBalanceRepeatLast($site);

		if($arResponse){
		// Get offers articules for update

		$arArtikul = array_map("trim", array_keys($arResponse));

		$arItem = self::getIdByArtikul($arArtikul);
		$arItemStore = self::getItemStore($arItem, $arStore);

        \Bitrix\Main\Loader::includeModule('highloadblock');

        $hlblock = HL\HighloadBlockTable::getById(3)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $eshopPatternReferenceTable = $entity->getDataClass();

		$result = $eshopPatternReferenceTable::getList(array(
            'select' => array('ID', 'UF_XML_ID', 'UF_BALANCE'),
            'filter' => array('UF_XML_ID' => array_keys($arResponse))
        ));

		$timestamp = ConvertTimeStamp(time(), 'FULL');

		while ($arRow = $result->fetch()) {//
			$ufBalance = json_decode($arRow['UF_BALANCE'], true);
			$isUpdateBalance = false;
			foreach($arResponse[$arRow['UF_XML_ID']] as $cityName => $count){
				if(in_array($arCities[$cityName], array_keys($ufBalance))){
					$isUpdateBalance = true;
					$ufBalance[$arCities[$cityName]] = $count;
				} else {
					$isUpdateBalance = true;
					$ufBalance[$arCities[$cityName]] = $count;
				}
			}
			if($isUpdateBalance) {
				$eshopPatternReferenceTable::update($arRow['ID'],
					array('UF_BALANCE' => json_encode($ufBalance), 'UF_BALANCE_UPDATE' => $timestamp));
			}
        }
		foreach($arResponse as $artikul => $arStoreAvail){
			if (!$arItem[trim($artikul)])
				continue;
			$itemId = $arItem[trim($artikul)];

			foreach($arStoreAvail as $cityName => $amount){
				if (!$arCitiesRegNameId[$cityName])
					continue;
				if ($amount != $arItemStore[$itemId][$arStore[$arCitiesRegNameId[$cityName]]]){
					$flagStoreUpdate = self::setStoreProduct($itemId, $arStore[$arCitiesRegNameId[$cityName]], $amount);
					$time = date("d.m.Y H:i:s");
					fwrite($fp, $time.": updateBalanceRepeatLast: ".sprintf("%' 6d", $itemId).": sklad: ".sprintf("%' 3d", $arStore[$arCitiesRegNameId[$cityName]]).", old: ".sprintf("%' 4d",$arItemStore[$itemId][$arStore[$arCitiesRegNameId[$cityName]]]).", new: ".sprintf("%' 4d",$amount)."\n");

					if ($flagStoreUpdate){
						$itemForUpdate[] = $itemId;
					}
				}
			}
		}

		if (is_array($itemForUpdate)){
			$itemForUpdate = array_unique($itemForUpdate);
			foreach($itemForUpdate as $itemId){
				self::setUpdateProduct($itemId);
			}
		}
		}


		fclose($fp);
		return '\Defo\Agents\BalanceAgent::updateBalanceRepeatLast('.$site.');';
	}

    static function updateBalanceByArr($arArtikul) {
//    	$arXmlId = array('8#45014' );
global $DB;
\Bitrix\Main\Loader::includeModule("catalog");
\Bitrix\Main\Loader::includeModule('iblock');
\Bitrix\Main\Loader::includeModule('highloadblock');

		$logfile = "/var/www/bitrix/data/www/defo.ru/log/newBalanceChanges.log";
		$fp = fopen($logfile, 'a+');

	//$this = new BalanceAgent();
	$arCitiesREG = self::getCitiesReg();

        $result = \CIBlockElement::GetList(
            array('NAME' => 'ASC'),
            array(
                'IBLOCK_ID' => 21,
                'ACTIVE' => 'Y',
                //'!=PROPERTY_FRANSHIZA_VALUE' => 'Да',
                '>PROPERTY_RATIO' => 0
            ),
            false,
            false,
            array('NAME', 'PROPERTY_LOCATION')
        );

        $arCities = array();
        while ($arCity = $result->Fetch()) {
			$arCities[$arCity['PROPERTY_LOCATION_VALUE']] = $arCity['NAME'];
        }

		$arStore = self::getStore($arCitiesREG);


        $hlblock = HL\HighloadBlockTable::getById(3)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $eshopPatternReferenceTable = $entity->getDataClass();

		$result = $eshopPatternReferenceTable::getList(array(
            'select' => array('ID', 'UF_XML_ID', 'UF_BALANCE'),
            'filter' => array('UF_XML_ID' => $arArtikul)
        ));
        $arRequest = array();
        $arPrimaryKeys = array();
        while ($arRow = $result->fetch()) {
				$arPrimaryKeys[$arRow['UF_XML_ID']] = $arRow['ID'];
				$arRequest[$arRow['UF_XML_ID']] = $arCities;
        }

		$arItem = self::getIdByArtikul($arArtikul);
		$arItemStore = self::getItemStore($arItem, $arStore);

        if($arRequest) {
			$timestamp = ConvertTimeStamp(time(), 'FULL');
			$arResponse = \Defo\Soap\SoapHelper::getBalance($arRequest);
			foreach ($arResponse as $code => $arCountsByCityCode) {
				$flagLog = false;
				$eshopPatternReferenceTable::update($arPrimaryKeys[$code], array('UF_BALANCE' => json_encode($arCountsByCityCode), 'UF_BALANCE_UPDATE' => $timestamp));

				$flagStoreUpdate = false; // флаг что у товара какой-то склад обновился

				foreach($arCountsByCityCode as $location => $amount){
					if (!$arItem[$code] || !in_array($location, $arCitiesREG))
						continue;
					$arItemStoreProduct = $arItemStore[$arItem[$code]];
					if ($amount != $arItemStoreProduct[$arStore[$location]]){
						$flagStoreUpdate = self::setStoreProduct($arItem[$code], $arStore[$location], $amount);
						$time = date("d.m.Y H:i:s");
						$flagLog = true;
						fwrite($fp, $time.": updateBalanceByArr: ".sprintf("%' 6d", $arItem[$code]).": sklad: ".sprintf("%' 3d", $arStore[$location]).", old: ".sprintf("%' 4d",$arItemStoreProduct[$arStore[$location]]).", new: ".sprintf("%' 4d",$amount)."\n");
					}
				}
				if ($flagStoreUpdate){
					self::setUpdateProduct($arItem[$code]);
				}
				if (!$flagLog){
					$time = date("d.m.Y H:i:s");
					fwrite($fp, $time.": updateBalanceByArr: ".$code.", ".sprintf("%' 6d", $arItem[$code])."\n");
				}
				$flagLog = false;
			}
		}
fclose($fp);
        return '\Defo\Agents\BalanceAgent::updateBalanceByArr('.$arArtikul.');';
    }
	
	static function getStoreUserId(){
		$rsUser = \CUser::GetByLogin("1c-store");
		$arUser = $rsUser->Fetch();
		$userStoreId = $arUser["ID"];
		return $userStoreId;
	}

	static function getCitiesReg(){
		$arCitiesCode = \Defo\Soap\SoapHelper::getCities();
		$arCitiesREG = array_merge($arCitiesCode["SPB"], $arCitiesCode["MSK"], $arCitiesCode["REG"]);
		return $arCitiesREG;
	}
	static function getStore($arCitiesREG){
		$res = \CCatalogStore::GetList(
			array('ID' => 'ASC'),
			array('ACTIVE' => 'Y','XML_ID'=> $arCitiesREG),
			false,
			false,
			array("ID", "TITLE", "XML_ID")
		);
		
		while($item = $res->GetNext()){
			$arStore[$item["XML_ID"]] = $item["ID"];
		}
		return $arStore;
	}
	
	static function getItemStore($arItem, $arStore){
		$res = \CCatalogStore::GetList(
			array('PRODUCT_ID'=>'ASC','ID' => 'ASC'),
			array('PRODUCT_ID'=>array_values($arItem), ">ELEMENT_ID" => false, "!PRODUCT_AMOUNT" => false, "ID" => array_values($arStore)),
			false,
			false,
			array("ID","TITLE","PRODUCT_AMOUNT","ELEMENT_ID")
		); // для массива товара по складам
		
		while($item = $res->GetNext()){
			$arItemStore[$item["ELEMENT_ID"]][$item["ID"]] = intval($item["PRODUCT_AMOUNT"]);
		}
	return $arItemStore;
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
		$userStoreId = $userStoreId = self::getStoreUserId();
		$СElement->Update($offerId, array("TIMESTAMP_X" => $timestamp, "MODIFIED_BY" => $userStoreId));
	}
	static function getIdByArtikul($arArtikul){
		$arFilter = Array("IBLOCK_ID" => 17, "PROPERTY_ARTNUMBER" => $arArtikul);
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_ARTNUMBER");
		$res = \CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
		while($item = $res->GetNext()){
			$arItem[$item["PROPERTY_ARTNUMBER_VALUE"]] = $item["ID"];
		}
	return $arItem;
	}
}
