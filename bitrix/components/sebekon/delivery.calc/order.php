<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (!CModule::IncludeModule("sebekon.deliveryprice") || !CModule::IncludeModule("sale")) {
    die();
}

$mapIds = $_REQUEST["maps"];
if ($_REQUEST['action'] == 'prices' && count($_REQUEST['prices'])>0 && count($_REQUEST['coords'])==2) {

	if (!function_exists('iconv_utf_convert')) {
		function iconv_utf_convert ($val) {
			if (is_array($val)) {
				foreach ($val as $k=>$v) {
					$val[$k] = iconv_utf_convert($v);
				}
			} else {
				$val = iconv("UTF-8", SITE_CHARSET, $val);
			}
			return $val;
		}
	}

	if(ToUpper(SITE_CHARSET)!="UTF-8"){
		$_REQUEST = iconv_utf_convert($_REQUEST);
	}
    
    \CSebekonDeliveryPrice::setPoint(array('x'=>floatval($_REQUEST['coords'][0]),'y'=>floatval($_REQUEST['coords'][1])));
    \CSebekonDeliveryPrice::setName(htmlspecialcharsEx($_REQUEST['name']));    
    $arPrices = array();
    $arRoutes = array();
	foreach ($_REQUEST['prices'] as $mapId=>$price) {
		$arPrices[intval($mapId)] = floatval($price['DELIVERY_PRICE']);
		$arRoutes[intval($mapId)] = floatval($price['LENGTH']);
	}
    \CSebekonDeliveryPrice::setPrices($arPrices);
    \CSebekonDeliveryPrice::setRoutes($arRoutes);
	
	//CSaleDeliveryHandler::ResetAll();
	
    $arPrices = \CSebekonDeliveryPrice::getPrices();
	$events = GetModuleEvents("sebekon.deliveryprice", "OnOrderShippingPriceCalculated");
	while ($arEvent = $events->Fetch())
		ExecuteModuleEventEx($arEvent, array(&$arPrices));
	
    \CSebekonDeliveryPrice::setPrices($arPrices);
    
	echo json_encode(array('1'=>'1'));
	die();
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");	
}

$mapGPS = '';
$mapScale = '';
if ($_REQUEST['DELIVERY_ID']>0) {
    $arParams = \Bitrix\Sale\Delivery\Services\Manager::getById($_REQUEST['DELIVERY_ID']);
    if ($arParams && $arParams['CONFIG'] && $arParams['CONFIG']['MAIN']) {
        $_SESSION['sebekon_yaroute_arconfig'] = $arParams['CONFIG']['MAIN'];
    }
}
if ($_REQUEST['PROFILE_ID']>0) {
    $arParams = \Bitrix\Sale\Delivery\Services\Manager::getById($_REQUEST['PROFILE_ID']);
    if ($arParams && $arParams['CONFIG'] && $arParams['CONFIG']['MAIN']) {
        if (!is_array($_SESSION['sebekon_yaroute_arconfig'])) $_SESSION['sebekon_yaroute_arconfig'] = array();
        foreach ($arParams['CONFIG']['MAIN'] as $key=>$value) {
            $_SESSION['sebekon_yaroute_arconfig'][$key] = $value;
        }
    }
    
    if ($arParams && $arParams['CONFIG'] && $arParams['CONFIG']['MAIN'] && $arParams['CONFIG']['MAIN']['MAP_GPS']) {
        $mapGPS = $arParams['CONFIG']['MAIN']['MAP_GPS'];
    }
    if ($arParams && $arParams['CONFIG'] && $arParams['CONFIG']['MAIN'] && $arParams['CONFIG']['MAIN']['MAP_SCALE']) {
        $mapScale = $arParams['CONFIG']['MAIN']['MAP_SCALE'];
    }
}

?>
<link href="/bitrix/components/sebekon/delivery.calc/templates/order/style.css?v=3" type="text/css" rel="stylesheet" />
<?$APPLICATION->IncludeComponent(
	"sebekon:delivery.calc",
	"order",
	Array(
		"MAP" => $mapIds,
		"ORDER_MAP_ID" => $_REQUEST['ORDER_MAP_ID'],
		"MAP_GPS" => $mapGPS,
		"MAP_SCALE" => $mapScale,
		"SHOW_ROUTE" => (\COption::GetOptionString('sebekon.deliveryprice', 'DP_HIDE_ROUTE', 'N')=='Y')?'N':'Y',
		"ADD2BASKET" => "N"
	)
);?>