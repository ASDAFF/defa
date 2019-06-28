<?php
namespace Defo\Soap;


class SoapHelper
{

	private static $arWebServices = array(
    'SPB' => array(
        'main' => array(
            'url' => 'http://srv-1cdr.defo.ru:80/spb/ws/SiteData',
            'client' => 'http://srv-1cdr.defo.ru:80/spb/ws/SiteData?wsdl',
        ),
        'local2' => array(
            'url' => 'http://192.168.100.127/spb/ws/SiteData',
            'client' => 'http://192.168.100.127/spb/ws/SiteData?wsdl',
        )),
    'MSK' => array(
        'main' => array(
            'url' => 'http://srv-1cdr.defo.ru:80/msk/ws/SiteData',
            'client' => 'http://srv-1cdr.defo.ru:80/msk/ws/SiteData?wsdl',
        ),
        'local2' => array(
            'url' => 'http://192.168.100.127/msk/ws/SiteData',
            'client' => 'http://192.168.100.127/msk/ws/SiteData?wsdl',
        )),
    'REG' => array(
        'main' => array(
            'url' => 'http://srv-1cdr.defo.ru:80/reg/ws/SiteData',
            'client' => 'http://srv-1cdr.defo.ru:80/reg/ws/SiteData?wsdl',
        ),
        'local2' => array(
            'url' => 'http://192.168.100.127/reg/ws/SiteData',
            'client' => 'http://192.168.100.127/reg/ws/SiteData?wsdl',
        )),
    'UT' => array(
        'main' => array(
            'url' => 'http://srv-1c.defo.ru:54321/ut/ws/SiteData',
            'client' => 'http://srv-1c.defo.ru:54321/ut/ws/SiteData?wsdl',
        ))
);

    private static function createBalanceRequest($arRequest) {
		//print_r($arRequest);
        $balanceRequestSpb = new \StdClass();
        $balanceRequestSpb->TabReq = new \StdClass();
        $balanceRequestSpb->TabReq->Item = array();

        $balanceRequestMsk = new \StdClass();
        $balanceRequestMsk->TabReq = new \StdClass();
        $balanceRequestMsk->TabReq->Item = array();

        $balanceRequestReg = new \StdClass();
        $balanceRequestReg->TabReq = new \StdClass();
        $balanceRequestReg->TabReq->Item = array();

		$balanceRequestUT = new \StdClass();
		$balanceRequestUT->TabReq = new \StdClass();
		$balanceRequestUT->TabReq->Item = array();
//echo "arRequest1: "; var_dump($arRequest);
        $arStructure = array(
            'SPB' => array(),
            'MSK' => array(),
            'REG' => array(),
            'UT' => array()
        );
		$arCitiesUT2 = array(
			1147,	//Челябинск
			1009,	//Екатеринбург
			880,	//Пермь
			1215,	//Сургут
			1134,	//Тюмень
			24,		//Уфа
			270,	//Владивосток
			469,	//Иркутск
			303,	//Хабаровск
			822,	//Новосибирск
			838,	//Омск
			550,	//Кемерово
		);
		$arCitiesCode = SoapHelper::getCities();
		$arCitiesUT = $arCitiesCode["UT"];
		

        foreach ($arRequest as $code => $arCities) {
            // Novokuznetsk(553) from Kemerovo
            // Sayanogorsk(185) from Abakan
            unset($arCities[553]);
            unset($arCities[185]);

            foreach ($arCities as $location => $city) {
                $item = new \StdClass();

                $item->Code = $code;
                $item->City = $city;

                if ($location === 617) { // Sankt-Petersburg
                    $balanceRequestSpb->TabReq->Item[] = $item;
                    $arStructure['SPB'][$item->Code][] = $location;
                } else if ($location == 671) { // Moskva
                    $balanceRequestMsk->TabReq->Item[] = $item;
                    $arStructure['MSK'][$item->Code][] = $location;
                } else if(in_array($location, $arCitiesUT)) {
					$balanceRequestUT->TabReq->Item[] = $item;
					$arStructure['UT'][$item->Code][] = $location;
				}
                else {
                    $balanceRequestReg->TabReq->Item[] = $item;
                    $arStructure['REG'][$item->Code][] = $location;
                }
            }
        }

        $balanceRequest = array(
            'SPB' => $balanceRequestSpb,
            'MSK' => $balanceRequestMsk,
            'REG' => $balanceRequestReg,
            'UT' => $balanceRequestUT,
            'STRUCTURE' => $arStructure
        );
//print_r($balanceRequest);
        return $balanceRequest;
    }

	public static function getCities(){
	foreach (self::$arWebServices as $codeBase => $address) {
		$client = SoapHelper::getConnect($address);
		$balanceCities = $client->BalanceСities();
		$arBalanceCities[$codeBase] = $balanceCities;
	}
	
	foreach($arBalanceCities as $codeBase => $arCitiesLists){
		foreach(json_decode($arCitiesLists->return) as $arCitiesList){
			if ($arCitiesList->ID){
				$arCities[$codeBase][] = (int)$arCitiesList->ID;
			}
			/*if ($codeBase == "UT"){
				if ($arCitiesList->ID){
					$arCitiesUT[] = (int)$arCitiesList->ID;
					//echo (int)$arCitiesList->ID.", ";
				}
			}
			if ($codeBase == "REG" || $codeBase == "SPB" || $codeBase == "MSK"){
				if ($arCitiesList->ID){
					$arCitiesREG[] = (int)$arCitiesList->ID;
				//echo (int)$arCitiesList->ID.", ";
				}
			}*/
		}
	}
	
	return $arCities;
}

	private static function createBalanceRequestChanges ($site, $arCities){
		$balanceRequest = new \StdClass();
		$balanceRequest->site = $site;
		$balanceRequest->arrCities = $arCities;

		return $balanceRequest;
	}
	private static function createBalanceRequestChangesRepeatLast($site){
		$balanceRequest = new \StdClass();
		$balanceRequest->site = $site;
		$balanceRequest->Date = ConvertTimeStamp(time(), 'FULL');

		return $balanceRequest;
	}

    private static function createResponse($balanceResponse, $balanceRequest) {
		//var_dump($balanceRequest);
        $balanceResponseSpb = $balanceResponse['SPB']->return->Item;
        $balanceResponseMsk = $balanceResponse['MSK']->return->Item;
        $balanceResponseReg = $balanceResponse['REG']->return->Item;
        $balanceResponseUT = $balanceResponse['UT']->return->Item;

        $arResponse = array();

        $i = 0;
        foreach ($balanceRequest['STRUCTURE']['SPB'] as $code => $codeCities) {
            foreach ($codeCities as $cityLocation) {
                $arResponse[$code][$cityLocation] = is_array($balanceResponseSpb)? $balanceResponseSpb[$i++]->Count: 0;
            }
        }

        $i = 0;
        foreach ($balanceRequest['STRUCTURE']['MSK'] as $code => $codeCities) {
            foreach ($codeCities as $cityLocation) {
                $arResponse[$code][$cityLocation] = is_array($balanceResponseMsk)? $balanceResponseMsk[$i++]->Count: 0;
            }
        }

        $i = 0;
        foreach ($balanceRequest['STRUCTURE']['REG'] as $code => $codeCities) {
            foreach ($codeCities as $cityLocation) {
                $arResponse[$code][$cityLocation] = is_array($balanceResponseReg)? $balanceResponseReg[$i++]->Count: 0;

                // Novokuznetsk(553) from Kemerovo
                // Sayanogorsk(185) from Abakan
                if ($cityLocation == 550) {
                    $arResponse[$code][553] = $arResponse[$code][$cityLocation];
                }
                if ($cityLocation == 184) {
                    $arResponse[$code][185] = $arResponse[$code][$cityLocation];
                }
            }
        }

		$i = 0;
		foreach ($balanceRequest['STRUCTURE']['UT'] as $code => $codeCities) {
			foreach ($codeCities as $cityLocation) {
			$arResponse[$code][$cityLocation] = is_array($balanceResponseUT)? $balanceResponseUT[$i++]->Count: 0;
			}
		}

		//var_dump($arResponse);

        return $arResponse;
    }

    /**
     * @var array $arRequest
     * @throws \SoapFault
     * @return array
     */
    public static function getBalance($arRequest)
    {
       /* $options = array(
            'soap_version' => SOAP_1_2,
            'login' => 'Bitrix',
			'password' => '401296999bx'
        );

        try {
			$options['location'] = 'http://93.190.227.29:7777/spb/ws/SiteData';
            $clientSpb = new \SoapClient('http://93.190.227.29:7777/spb/ws/SiteData?wsdl', $options);

            $options['location'] = 'http://93.190.227.29:7777/msk/ws/SiteData';
            $clientMsk = new \SoapClient('http://93.190.227.29:7777/msk/ws/SiteData?wsdl', $options);

            $options['location'] = 'http://93.190.227.29:7777/reg/ws/SiteData';
            $clientReg = new \SoapClient('http://93.190.227.29:7777/reg/ws/SiteData?wsdl', $options);

			$options['location'] = 'http://srv-1c.defo.ru:54321/ut/ws/SiteData';
			$clientUT = new \SoapClient('http://srv-1c.defo.ru:54321/ut/ws/SiteData?wsdl', $options);
        } catch (\SoapFault $sf) {
            // maybe you're in local
            try {
				$options['location'] = 'http://192.168.100.127/spb/ws/SiteData';
                $clientSpb = new \SoapClient('http://192.168.100.127/spb/ws/SiteData?wsdl', $options);

                $options['location'] = 'http://192.168.100.127/msk/ws/SiteData';
                $clientMsk = new \SoapClient('http://192.168.100.127/msk/ws/SiteData?wsdl', $options);

                $options['location'] = 'http://192.168.100.127/reg/ws/SiteData';
                $clientReg = new \SoapClient('http://192.168.100.127/reg/ws/SiteData?wsdl', $options);

				$options['location'] = 'http://srv-1c.defo.ru:54321/ut/ws/SiteData';
				$clientUT = new \SoapClient('http://srv-1c.defo.ru:54321/ut/ws/SiteData?wsdl', $options);
            } catch (\SoapFault $sf) {

                throw $sf;
            }
        }*/



        try {
            $balanceRequest = SoapHelper::createBalanceRequest($arRequest);
			//var_dump($balanceRequest);

			foreach (self::$arWebServices as $codeBase => $address) {
				$client = SoapHelper::getConnect($address);
				
				//var_dump($balanceRequest[$codeBase]);
				
				$balanceResponse = $client->Balance($balanceRequest[$codeBase]);
				$arBalanceResponse[$codeBase] = $balanceResponse;
			}

            /*$balanceResponseSpb = $clientSpb->Balance($balanceRequest['SPB']);
            $balanceResponseMsk = $clientMsk->Balance($balanceRequest['MSK']);
            $balanceResponseReg = $clientReg->Balance($balanceRequest['REG']);
			$balanceResponseUT = $clientUT->Balance($balanceRequest['UT']);

            $arResponse = SoapHelper::createResponse(array(
                'SPB' => $balanceResponseSpb,
                'MSK' => $balanceResponseMsk,
                'REG' => $balanceResponseReg,
				'UT' => $balanceResponseUT
            ), $balanceRequest);*/

			$arResponse = SoapHelper::createResponse($arBalanceResponse, $balanceRequest);

        } catch (\SoapFault $sf) {

                throw $sf;
        }

        return $arResponse;
    }

    public static function getBalanceChanges ($arRequest) {
//echo "arRequest: "; var_dump($arRequest);
        try {

			foreach (self::$arWebServices as $codeBase => $address) {

				//$file = '/var/www/developer/data/www/defo-project.ru/log/balanceChanges.log';
				// Открываем файл для получения существующего содержимого
				//$current = file_get_contents($file);

				$logfile = "/home/bitrix/www/log/balanceChanges.log";
				$fp = fopen($logfile, 'a');
				$time = date("d.m.Y H:i:s");
				fwrite($fp, $time.": ".$code."\n");


				$client = SoapHelper::getConnect($address);
				//var_dump($balanceRequest[$codeBase]);
				//$balanceResponse = $client->Balance($balanceRequest[$codeBase]);
				//$arBalanceResponse[$codeBase] = $balanceResponse;


				$balanceRequest = SoapHelper::createBalanceRequestChanges($arRequest, '');
                $log = "/home/bitrix/www/log/soap.log";
                $fpl = fopen($log, 'w+');
                $time = date("d.m.Y H:i:s");
fwrite($fpl, var_export($balanceRequest, true));
print_r($balanceRequest);
				$balanceResponse = $client->BalanceChanges($balanceRequest);
echo "end\n";
				//file_put_contents($file, $codeBase);
				//file_put_contents($file, $balanceResponse->return);
				//fwrite($fp, $time.var_dump($balanceResponse->return)."\n");

				foreach (json_decode($balanceResponse->return, true) as $code => $cityList){
					foreach($cityList as $cityName => $count) {
						$arResponse[$code][$cityName] = $count;
					}
				}
			}

		} catch (\SoapFault $sf) {

			throw $sf;
		}
//fwrite($fpl, serialize($arResponse));
		return $arResponse;
	}
	
	public static function getBalanceRepeatLast($arRequest) {
        try {
			foreach (self::$arWebServices as $codeBase => $address) {
				$logfile = "/home/bitrix/www/log/balanceChanges.log";
				$fp = fopen($logfile, 'a');
				$time = date("d.m.Y H:i:s");
				fwrite($fp, $time.": ".$code."\n");

				$client = SoapHelper::getConnect($address);
				$balanceRequest = SoapHelper::createBalanceRequestChangesRepeatLast($arRequest);
				//var_export($balanceRequest);
				$balanceResponse = $client-> BalanceRepeatLast($balanceRequest);
//var_export($balanceResponse);

				foreach (json_decode($balanceResponse->return, true) as $code => $cityList){
					foreach($cityList as $cityName => $count) {
						$arResponse[$code][$cityName] = $count;
					}
				}
			}

		} catch (\SoapFault $sf) {

			throw $sf;
		}

		return $arResponse;
	}

	private static function getConnect ($arWebService) {
		$options = array(
			'soap_version' => SOAP_1_2,
			'login' => 'Bitrix',
			'password' => 'UKd5fB0mzh_'
		);

		try {
			$options['location'] = $arWebService['main']['url'];
			$client = new \SoapClient($arWebService['main']['client'], $options);
		} catch (\SoapFault $sf) {
			if(!$arWebService['local']) {
				$arWebService['local'] = $arWebService['main'];
			}
			$options['location'] = $arWebService['local']['url'];
			$client = new \SoapClient($arWebService['local']['client'], $options);
		} catch (\SoapFault $sf) {

			throw $sf;
		}

		return $client;
	}
}
