<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (!CModule::IncludeModule("sebekon.deliveryprice")) {
    die();
}

$mapIds = $_REQUEST["maps"];
$params = $_REQUEST["params"];

$order_price = false;
$order_weight = false;
if (is_array($params) && $params['CUSTOM_CALC']=='Y') {
	$order_price = floatval($params['CUSTOM_PRICE']);
	$order_weight = floatval($params['CUSTOM_WEIGHT']);
}

//подгружаем все карты и зоны
$arResult = CSebekonDeliveryPrice::getMap($mapIds, $order_price, $order_weight);
$result = array();
$points = array();
foreach ($_REQUEST["points"] as $k=>$point) $points[$k] = CSebekonDeliveryPrice::convertToPoint($point);


//определяем принадлежность точек тем или иным зонам
foreach ($arResult['MAPS'] as $map) {	
	$mpoints = array();
	foreach ($arResult['ZONES'] as $zone) {
		if (!in_array($zone['ID'],$map['PROPS']['ZONES']['VALUE'])) continue;
		foreach ($points as $k=>$point) {
			if ($mpoints[$k]>0) continue;
			$polygons = CSebekonDeliveryPrice::convertToPolygons($zone['PROPS']['ZONE_COORDS']['VALUE']);
			if (CSebekonDeliveryPrice::arrayContains($point,$polygons)) {
				$mpoints[$k] = $zone['ID'];
			}
		}
	}
	
	//если все точки вошли в зоны принадлежащие этой карте, то по ней можно рассчитать стоимость
	$result[$map['ID']] = array();
	foreach ($mpoints as $pk=>$zone_id) {
		$result[$map['ID']][$zone_id][] = $points[$pk];
	}
}

echo json_encode($result);
die();
?>