
<?php
CModule::IncludeModule("sale");

/*данные для поключения к API*/
define("DELLIN_API_METOD", "POST");
define("DELLIN_API_CONTENT_TYPE", "application/json");

/*данные аунтицикации*/
define("DELLIN_API_LOGIN", " ");
define("DELLIN_API_PASSWORD", " ");

/*logo*/
define("DELLIN_LOGO", "/bitrix/php_interface/include/sale_delivery/dellin_logo.png");

Class CDeliveryDellin { 

/**
* Описние обработчика
*/
function Init()
{
//настройки
return array(
 
"SID"                   => "Dellin",
"NAME"                  => CDeliveryDellin::chToUTF("Деловые линии"),
"DESCRIPTION"           => CDeliveryDellin::chToUTF("Описание его для клиентов сайта"),
"DESCRIPTION_INNER"     => CDeliveryDellin::chToUTF("Описание для администраторов сайта"),
"BASE_CURRENCY"         => "RUR",
"HANDLER"                 => __FILE__,

/* Определение методов */
"DBGETSETTINGS"         => array("CDeliveryDellin", "GetSettings"),
"DBSETSETTINGS"         => array("CDeliveryDellin", "SetSettings"),
"GETCONFIG"             => array("CDeliveryDellin", "GetConfig"),

"COMPABILITY"           => array("CDeliveryDellin", "Compability"),
"CALCULATOR"            => array("CDeliveryDellin", "Calculate"),

"LOGOTIP"   => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].DELLIN_LOGO),
/* Список профилей */
"PROFILES" => array(
		"alldellin" => array(
		"TITLE" => CDeliveryDellin::chToUTF("На основании API"),
		"DESCRIPTION" => CDeliveryDellin::chToUTF("Профиль доставки на основании API «Деловые линии»"),

		"RESTRICTIONS_WEIGHT" => array(0),
		"RESTRICTIONS_SUM"    => array(0),
		),
)
);
}


/* Запрос конфигурации службы доставки */
function GetConfig()
{
$arConfig = array(
"CONFIG_GROUPS" => array(

    "all1" => CDeliveryDellin::chToUTF("Настройка доставки"),
),

"CONFIG" => array(
						 "henderAPI" => array(
                        "TYPE" => 'SECTION',
                         "TITLE" => CDeliveryDellin::chToUTF('Настройки API '),
                         "GROUP" => "all1"
                    ),
   "API_URL" => array(
                         "TYPE" => "TEXT",
                         "TITLE" => CDeliveryDellin::chToUTF("API URL (включая http://) *"),
						 "DEFAULT" => "http://",
                         "GROUP" => "all1",
						  "SIZE" => "50"
						 
                    ),   
   "API_KEY" => array(
                         "TYPE" => "TEXT",
                         "TITLE" => "API KEY *",
						 "DEFAULT" => "",
                         "GROUP" => "all1",
						"SIZE" => "50"
						 
						 
                    ),
    "hender0" => array(
                        "TYPE" => 'SECTION',
                         "TITLE" => CDeliveryDellin::chToUTF('КЛАДР пункта отправки'),
                         "GROUP" => "all1"
                    ),
   "KLADR_otn1" => array(
                         "TYPE" => "TEXT",
                         "TITLE" => CDeliveryDellin::chToUTF("Указывать в кавычках \"7800000000000000000000000\""),
						 "DEFAULT" => CDeliveryDellin::chToUTF("\"7800000000000000000000000\""),
                         "GROUP" => "all1",
						 "SIZE" => "30"
						 
						 
                    ),
    "hender1" => array(
                        "TYPE" => 'SECTION',
                         "TITLE" => CDeliveryDellin::chToUTF('Наценка'),
                         "GROUP" => "all1",
                         
                    ),
     "nachenka_abc" => array(
                         "TYPE" => "STRING",
                         "DEFAULT" => '0',
                         "TITLE" => CDeliveryDellin::chToUTF('Наценка абсолютная, руб'),
                         "GROUP" => "all1",
                         
                    ),
        "hender2" => array(
                        "TYPE" => 'SECTION',
                        "TITLE" => CDeliveryDellin::chToUTF('Страхование'),
                         "GROUP" => "all1"
                        
    
                    ),
        "ctracho" => array(
                         "TYPE" => "CHECKBOX",
                         "DEFAULT" => 'N',
                         "TITLE" => CDeliveryDellin::chToUTF('Застраховать груз заявленной стоимостью? (грузы без заявленной стоимости страхуются бесплатно на сумму до 80 000 рублей)'),
                         "GROUP" => "all1"
                                         
                    ),
					/*Погрузка\загрузка*/
         "hender3" => array(
                        "TYPE" => 'SECTION',
                         "TITLE" => CDeliveryDellin::chToUTF('Погрузка'),
                         "GROUP" => "all1",
                         
                    ),
        "pogruzka_zagruz" => array(
                         "TYPE" => "CHECKBOX",
                         "DEFAULT" => 'N',
                         "TITLE" => CDeliveryDellin::chToUTF('Необходим забор груза?'),
                         "GROUP" => "all1",
                         'HIDE_BY_NAMES' => array('pogruzka_zagruz_type','pogruzka_zagruz_spez_treb','pogruzka_zagruz_dop_komplekt')                
                    ),
		"pogruzka_zagruz_type" => array(
                         "TYPE" => "DROPDOWN",
                         "DEFAULT" => 'pogruzka_zagruz_type_zad',
                         "TITLE" => CDeliveryDellin::chToUTF('Тип загрузки'),
                         "GROUP" => "all1",
                         "VALUES" => array(
									'pogruzka_zagruz_type_zad' => CDeliveryDellin::chToUTF('Задняя'),
                                    'pogruzka_zagruz_type_bok' => CDeliveryDellin::chToUTF('Боковая'),
		                            'pogruzka_zagruz_type_verch' => CDeliveryDellin::chToUTF('Верхняя'),
		                            ),                
                    ),
		"pogruzka_zagruz_spez_treb" => array(
                         "TYPE" => "DROPDOWN",
                         "DEFAULT" => 'pogruzka_zagruz_spez_treb_no',
                         "TITLE" => CDeliveryDellin::chToUTF('Специальные требования к транспорту'),
                         "GROUP" => "all1",
                         "VALUES" => array(
									'pogruzka_zagruz_spez_treb_no' => CDeliveryDellin::chToUTF('Не требуются'),
                                    'pogruzka_zagruz_spez_treb_otr_mash' => CDeliveryDellin::chToUTF('Открытая машина'),
		                            'pogruzka_zagruz_spez_treb_rastent' => CDeliveryDellin::chToUTF('Требуется растентовка')
                                    ),                
                    ),
		"pogruzka_zagruz_dop_komplekt" => array(
                         "TYPE" => "DROPDOWN",
                         "DEFAULT" => 'pogruzka_zagruz_dop_komplekt_no',
                         "TITLE" => CDeliveryDellin::chToUTF('Дополнительная комплектация'),
                         "GROUP" => "all1",
                         "VALUES" => array(
									'pogruzka_zagruz_dop_komplekt_no' => CDeliveryDellin::chToUTF('Не требуется'),
                                    'pogruzka_zagruz_dop_komplekt_gidro' => CDeliveryDellin::chToUTF('Гидроборт'),
		                            'pogruzka_zagruz_dop_komplekt_mani' => CDeliveryDellin::chToUTF('Манипулятор'),
		                            
                                    ),                
                    ),					
        

					
					
					
/*выгрузка\отвоз*/
	"hender4" => array(
                        "TYPE" => 'SECTION',
                         "TITLE" => CDeliveryDellin::chToUTF('Выгрузка'),
                         "GROUP" => "all1",
                         
                    ),			
        "vigruzka_otvoz" => array(
                         "TYPE" => "CHECKBOX",
                         "DEFAULT" => 'N',
                         "TITLE" => CDeliveryDellin::chToUTF('Необходим отвоз груза'),
                         "GROUP" => "all1",
                         "HIDE_BY_NAMES" => array('vigruzka_otvoz_type','vigruzka_otvoz_spez_treb','vigruzka_otvoz_dop_komplekt')                 
                    ),
		"vigruzka_otvoz_type" => array(
                         "TYPE" => "DROPDOWN",
                         "DEFAULT" => 'vigruzka_otvoz_type_zad',
                         "TITLE" => CDeliveryDellin::chToUTF('Тип загрузки'),
                         "GROUP" => "all1",
                         "VALUES" => array(
									'vigruzka_otvoz_type_zad' => CDeliveryDellin::chToUTF('Задняя'),
                                    'vigruzka_otvoz_type_bok' => CDeliveryDellin::chToUTF('Боковая'),
		                            'vigruzka_otvoz_type_verch' => CDeliveryDellin::chToUTF('Верхняя'),
		                            ),                
                    ),
		"vigruzka_otvoz_spez_treb" => array(
                         "TYPE" => "DROPDOWN",
                         "DEFAULT" => 'vigruzka_otvoz_spez_treb_no',
                         "TITLE" => CDeliveryDellin::chToUTF('Специальные требования к транспорту'),
                         "GROUP" => "all1",
                         "VALUES" => array(
									'vigruzka_otvoz_spez_treb_no' => CDeliveryDellin::chToUTF('Не требуются'),
                                    'vigruzka_otvoz_spez_treb_otr_mash' => CDeliveryDellin::chToUTF('Открытая машина'),
		                            'vigruzka_otvoz_spez_treb_rastent' => CDeliveryDellin::chToUTF('Требуется растентовка')
                                    ),                
                    ),
		"vigruzka_otvoz_dop_komplekt" => array(
                         "TYPE" => "DROPDOWN",
                         "DEFAULT" => 'vigruzka_otvoz_dop_komplekt_no',
                         "TITLE" => CDeliveryDellin::chToUTF('Дополнительная комплектация'),
                         "GROUP" => "all1",
                         "VALUES" => array(
									'vigruzka_otvoz_dop_komplekt_no' => CDeliveryDellin::chToUTF('Не требуется'),
                                    'vigruzka_otvoz_dop_komplekt_gidro' => CDeliveryDellin::chToUTF('Гидроборт'),
		                            'vigruzka_otvoz_dop_komplekt_mani' => CDeliveryDellin::chToUTF('Манипулятор')
		                            
                                    ),                
                    ),					       
 

					
					
					
/*упаковка*/					
             "hender5" => array(
                        "TYPE" => 'SECTION',
                         "TITLE" => CDeliveryDellin::chToUTF('Упаковка'),
                         "GROUP" => "all1"
                         
                    ),
            "up_jest" => array(
                         "TYPE" => "CHECKBOX",
                         "DEFAULT" => 'N',
                         "TITLE" => CDeliveryDellin::chToUTF('Упаковать в жёсткую упаковку'),
                         "GROUP" => "all1"
                                         
                    ),
    
    "up_dop" => array(
                         "TYPE" => "CHECKBOX",
                         "DEFAULT" => 'N',
                         "TITLE" => CDeliveryDellin::chToUTF('Упаковать в дополнительную упаковку'),
                         "GROUP" => "all1"
                                         
                    ),
    
    "up_puz" => array(
                         "TYPE" => "CHECKBOX",
                         "DEFAULT" => 'N',
                         "TITLE" => CDeliveryDellin::chToUTF('Упаковать в воздушно-пузырькову плёнку'),
                         "GROUP" => "all1"
                                         
                    ),
        
    "up_meshok" => array(
                         "TYPE" => "CHECKBOX",
                         "DEFAULT" => 'N',
                         "TITLE" => CDeliveryDellin::chToUTF('Упаковать в мешки'),
                         "GROUP" => "all1"
                                         
                    ),
    
    "up_palbort" => array(
                         "TYPE" => "CHECKBOX",
                         "DEFAULT" => 'N',
                         "TITLE" => CDeliveryDellin::chToUTF('Упаковать в паллетный борт (только до терминала-получателя)'),
                         "GROUP" => "all1"
                                         
                    ),
/*внутригородская*/ 
            "hender6" => array(
                        "TYPE" => 'SECTION',
                         "TITLE" => CDeliveryDellin::chToUTF('Внутригородская доставка'),
                         "GROUP" => "all1",
                         
                    ),
    
            
    "vnutr_gorod_dostavka" => array(
                         "TYPE" => "CHECKBOX",
                         "DEFAULT" => 'N',
                         "TITLE" => CDeliveryDellin::chToUTF('Скрыть этот способ доставки для покупателей из города магазина? (в настройках магазина необходимо указать индекс)'),
                         "GROUP" => "all1"
                                         
                    ),      
    
),
    
);
return $arConfig;
}

/* Установка параметров */
function SetSettings($arSettings)
{
	$arSettings[nachenka_abc] = (float)str_replace(",", ".", $arSettings[nachenka_abc]);
	$arSettings[KLADR_otn1] = preg_replace ("/[^\"0-9\s]/","",$arSettings[KLADR_otn1]);
	$arSettings[API_KEY] = trim($arSettings[API_KEY]);
	
return serialize($arSettings);
}

/* Запрос параметров */
function GetSettings($strSettings) {
	$strSettings = unserialize($strSettings);
	$strSettings[nachenka_abc]=(float)$strSettings[nachenka_abc];
	$strSettings[KLADR_otn1]=(string)$strSettings[KLADR_otn1];
	
return $strSettings;
}



/* Проверка соответствия профиля доставки заказу */
function Compability($arOrder, $arConfig)
{
	if($arConfig['vnutr_gorod_dostavka']['VALUE']=='Y' &&
            COption::GetOptionString('sale', 'location_zip')==$arOrder['LOCATION_ZIP'])
{

return ;
}
   $apidata= CDeliveryDellin::apiDataDellin($arConfig,$arOrder);

	if(strlen($apidata['INDEX_FROM']) <> 25 || !$apidata['INDEX_ZIP'])
{
return ;
};   

return array("alldellin");
}
  
   
    
 /*собираем данные для api*/   

function apiDataDellin($arConfig,$arOrder)
{

	$rezult['PRICE'] = ($arConfig['ctracho']['VALUE']=='Y' && $arOrder['PRICE']>0)?(number_format($arOrder['PRICE'], 2, '.', '')):'';   /*стоимость товара для страховки если требуется, руб*/

    $weignt =  CSaleMeasure::Convert($arOrder["WEIGHT"], "G", "KG"); /*вес товара, кг*/
	$rezult['WEIGHT'] = ($weignt >= 0.01) ? $weignt : 0.01 ;   

	$rezult['INDEX_ZIP'] = $arOrder['LOCATION_ZIP'];   /*индекс места получения*/
	$rezult['INDEX_FROM'] = str_replace("\"", "", $arConfig['KLADR_otn1']['VALUE']);  /*КЛАДР магазина*/
	$rezult['OBEM'] = CDeliveryDellin::apiDataObem($arOrder['ITEMS']); /*объем всего товара, м3*/	

/*упаковки*/ 
	if($arConfig['up_jest']['VALUE']=='Y'){$rezult['UPAKOV'][]='0x838FC70BAEB49B564426B45B1D216C15';}  /*жесткая упаковка*/
	if($arConfig['up_dop']['VALUE']=='Y'){$rezult['UPAKOV'][]='0x9A7F11408F4957D7494570820FCF4549';}  /*дополнительная упаковка*/
	if($arConfig['up_puz']['VALUE']=='Y'){$rezult['UPAKOV'][]='0xA8B42AC5EC921A4D43C0B702C3F1C109';}  /*пузырьковая упаковка*/
	if($arConfig['up_meshok']['VALUE']=='Y'){$rezult['UPAKOV'][]='0xAD22189D098FB9B84EEC0043196370D6'; }  /*упаковка в мешок*/
	if($arConfig['up_palbort']['VALUE']=='Y'){$rezult['UPAKOV'][]='0xBAA65B894F477A964D70A4D97EC280BE';}   /*паллетный борт */

	
/*Погрузка\загрузка*/	
if ($arConfig['pogruzka_zagruz']['VALUE']=='Y')
{
	$rezult['ZABOR_GR'] = true;
	
	/*доп услуги*/ 

	/*Тип загрузки*/
	switch ($arConfig['pogruzka_zagruz_type']['VALUE']) 
	{
    case 'pogruzka_zagruz_type_zad':
        break;
    case 'pogruzka_zagruz_type_bok':
        $rezult['DOP_USLUGI_POG'][]='0xb83b7589658a3851440a853325d1bf69';
		break;
    case 'pogruzka_zagruz_type_verch':
        $rezult['DOP_USLUGI_POG'][]='0xabb9c63c596b08f94c3664c930e77778';
		break;
	}
	/*Специальные требования к транспорту*/
	switch ($arConfig['pogruzka_zagruz_spez_treb']['VALUE']) 
	{
    case 'pogruzka_zagruz_spez_treb_no':
        break;
    case 'pogruzka_zagruz_spez_treb_otr_mash':
        $rezult['DOP_USLUGI_POG'][]='0x9951e0ff97188f6b4b1b153dfde3cfec';
		break;
    case 'pogruzka_zagruz_spez_treb_rastent':
        $rezult['DOP_USLUGI_POG'][]='0x818e8ff1eda1abc349318a478659af08';
		break;
	}
	/*Дополнительная комплектация*/
	switch ($arConfig['pogruzka_zagruz_dop_komplekt']['VALUE']) 
	{
    case 'pogruzka_zagruz_dop_komplekt_no':
        break;
    case 'pogruzka_zagruz_dop_komplekt_gidro':
        $rezult['DOP_USLUGI_POG'][]='0x92fce2284f000b0241dad7c2e88b1655';
		break;
    case 'pogruzka_zagruz_dop_komplekt_mani':
        $rezult['DOP_USLUGI_POG'][]='0x88f93a2c37f106d94ff9f7ada8efe886';
		break;
	}	

}
else
{
	$rezult['ZABOR_GR'] = false;
}

/*выгрузка\отвоз*/

if ($arConfig['vigruzka_otvoz']['VALUE'] == 'Y')
{
	
	$rezult['OTVOZ_GR'] = true;
/*доп услуги*/ 

	/*Тип загрузки*/
	switch ($arConfig['vigruzka_otvoz_type']['VALUE']) 
	{
    case 'vigruzka_otvoz_type_zad':
        break;
    case 'vigruzka_otvoz_type_bok':
        $rezult['DOP_USLUGI_VIG'][] = '0xb83b7589658a3851440a853325d1bf69';
		break;
    case 'vigruzka_otvoz_type_verch':
        $rezult['DOP_USLUGI_VIG'][] = '0xabb9c63c596b08f94c3664c930e77778';
		break;
	}
	/*Специальные требования к транспорту*/
	switch ($arConfig['vigruzka_otvoz_spez_treb']['VALUE']) 
	{
    case 'vigruzka_otvoz_spez_treb_no':
        break;
    case 'vigruzka_otvoz_spez_treb_otr_mash':
        $rezult['DOP_USLUGI_VIG'][] = '0x9951e0ff97188f6b4b1b153dfde3cfec';
		break;
    case 'vigruzka_otvoz_spez_treb_rastent':
        $rezult['DOP_USLUGI_VIG'][] = '0x818e8ff1eda1abc349318a478659af08';
		break;
	}
	/*Дополнительная комплектация*/
	switch ($arConfig['vigruzka_otvoz_dop_komplekt']['VALUE']) 
	{
    case 'vigruzka_otvoz_dop_komplekt_no':
        break;
    case 'vigruzka_otvoz_dop_komplekt_gidro':
        $rezult['DOP_USLUGI_VIG'][]='0x92fce2284f000b0241dad7c2e88b1655';
		break;
    case 'vigruzka_otvoz_dop_komplekt_mani':
        $rezult['DOP_USLUGI_VIG'][]='0x88f93a2c37f106d94ff9f7ada8efe886';
		break;
	}	

}
else
{
	$rezult['OTVOZ_GR'] = false;
}

/*наценка абсолютна*/

	$rezult['NACHENKA_ABC']=(gettype($arConfig['nachenka_abc']['VALUE'])!='string' &&
		$arConfig['nachenka_abc']['VALUE']>=0 )?$arConfig['nachenka_abc']['VALUE']:0 ;

return $rezult;  
}
  
 /*расчет объема товаров(всех в корзине) QUANTITY:кол-во товара*/   
function apiDataObem($obemData)
{
	foreach ($obemData as $value)
	{
		$rezult+=
		$value['QUANTITY']*
		$value['DIMENSIONS'][WIDTH]*
		$value['DIMENSIONS'][HEIGHT]*
		$value['DIMENSIONS'][LENGTH] ;
	}
	$rezult = $rezult/(1000*1000*1000); /*объем из мм^3 в м^3*/
	
	
return ($rezult >= 0.01) ? $rezult : 0.01 ; 
}    
 /*конец расчет объема товаров(всех в корзине)*/ 

    

    

/* Калькуляция стоимости доставки*/
function Calculate($profile, $arConfig, $arOrder, $STEP, $TEMP = false)
{

	$apidata= CDeliveryDellin::apiDataDellin($arConfig,$arOrder);
    
	if ($STEP >= 4)
		return array(
			"RESULT" => "ERROR",
			"TEXT" => CDeliveryDellin::chToUTF('ошибка соединения')
			);
			

	$API_KEY = $arConfig['API_KEY']['VALUE']; //ключь
		
$post_data =array(
	'login' => DELLIN_API_LOGIN,
	'password' => DELLIN_API_PASSWORD,
	'appKey' => $API_KEY,
	'derivalPoint' => $apidata['INDEX_FROM'],//'7800000000000000000000000',  /*КЛАДР места отправки*/
	'arrivalPoint' => $apidata['INDEX_ZIP'], /*индекс места получения*/
	'derivalDoor' => $apidata['ZABOR_GR'],   /*забор от двери 'True':'False'*/
	'arrivalDoor' => $apidata['OTVOZ_GR'],   /*отвоз до двери 'True':'False'*/ 
	'sizedVolume' => $apidata['OBEM'], /*объем товара m^3*/
	'sizedWeight' => $apidata['WEIGHT'],   /*вес товара кг*/
	'statedValue' => $apidata['PRICE'], /*стоимость для страховки руб*/
	'packages' => $apidata['UPAKOV'], /*упаковка*/
	'derivalServices' => $apidata['DOP_USLUGI_POG'] , /*дополнительные услуги погрузки\отправка*/
	'arrivalServices' => $apidata['DOP_USLUGI_VIG'] /*дополнительные услуги выгрузка\получение*/
	);
			
/* Удаляем пустые элементы массива (упаковки,доп услуги): */
	$post_data = array_diff($post_data, array(''));
	/**/
if(!isset($post_data['derivalDoor'])) { $post_data['derivalDoor'] = false ;}
if(!isset($post_data['arrivalDoor'])) { $post_data['arrivalDoor'] = false ;}

	
	$dataJSON = json_encode($post_data); 
	
/*print_r("<br>---------json отправляется в API------------<br>");	
print_r($dataJSON);*/

			$urlAPI = parse_url($arConfig['API_URL']['VALUE']);
			$host = isset($urlAPI['host']) ? $urlAPI['host'] : '';
			$port = isset($urlAPI['port']) ? $urlAPI['port'] : 80;
			$path = isset($urlAPI['path']) ? $urlAPI['path'] : ''; 

/*запрос к API*/
 
	$strQueryText = QueryGetData(
		$host, 
		$port, 
		$path,
		$dataJSON,
		$error_number, 
		$error_text,
		DELLIN_API_METOD,"",
		DELLIN_API_CONTENT_TYPE
	); 
/*	print_r("<br>---------json получение от API------------<br>");	
    print_r (iconv('UTF-8', 'Windows-1251', $strQueryText));
	print_r("<br>");
	print_r($error_number);
		print_r("<br>");
	print_r($error_text);*/
	
	if(!$error_number)
	{	
		$strQueryText = json_decode($strQueryText,TRUE);

		if ($strQueryText["price"])
		{
			$rezult = $strQueryText["price"] + $apidata['NACHENKA_ABC'];
			$trans = $strQueryText["time"]['value']	;		
			
			
			return array(
				"RESULT" => "OK",
				"VALUE" => $rezult,
				'TRANSIT' => $trans
				);
		}else
		{
			$rezult = CDeliveryDellin::chToUTF('Не удалось рассчитать срок и стоимость доставки');

			return array(
				"RESULT" => 'ERROR',
				"TEXT" => $rezult
					); 
 		}
	}//end no error 
	else
	{
		return array(
			"RESULT" => 'ERROR',
			"TEXT" => CDeliveryDellin::chToUTF('Ошибка соединения с сервером')
			); 

	}
   
   
   
   

}

function chToUTF($str){
$str = (LANG_CHARSET == 'UTF-8') ? iconv('Windows-1251','UTF-8',$str):$str;
return $str;
}


}//end class CDeliveryDellin

AddEventHandler("sale", "onSaleDeliveryHandlersBuildList", array("CDeliveryDellin", "Init"));

?>






      
   

