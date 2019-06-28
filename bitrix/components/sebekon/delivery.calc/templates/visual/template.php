<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/*
 * Module: sebekon.deliveryprice
 */

CModule::IncludeModule('sebekon.deliveryprice'); 
?>
<div style="clear: both; height: 10px;"></div>
<div id="DP_search_form<?=$arResult['ID']?>" class="DP_search_form">
	<?=GetMessage('sebekon_SEARCH_ADDRESS')?>:
    <input type="text" value="" style="margin-bottom: 0;"/>	
    <input type="button" value="<?=GetMessage('sebekon_SEARCH_BTN')?>" class="btn"/>
	<p class="help"><i><?=GetMessage('sebekon_SEARCH_HELP')?></i></p>
</div>
	<div id="map<?=$arResult['ID']?>" style="width: 900px; height: 500px;"></div>

<div id="DELIVERS<?=$arResult['ID']?>" class="DELIVERS" style="font-weight: bold;"></div>
<script type="text/javascript">

	var SebekonDelivery = window.parent['SebekonDelivery'];
	var ymaps = window.parent['ymaps'];
	var $sebekon_jq_delivery = window.parent['$sebekon_jq_delivery'];
	var getPointsFromCoords = window.parent['getPointsFromCoords'];
	var getFormatPrice = window.parent['getFormatPrice'];
	
	
	var sendDeliveryForm = function() {
		$sebekon_jq_delivery.post('/bitrix/components/sebekon/delivery.calc/order.php',sebekon_deliverycalc_params, function(){
			sebekon_delivery_refresh_options();
			if (sebekon_deliverycalc_params.coords[0]!='<?=$_REQUEST['sebekon_yaroute_point']['x']?>' || sebekon_deliverycalc_params.coords[1]!='<?=$_REQUEST['sebekon_yaroute_point']['y']?>') {
				if (window['submitForm']) {
					submitForm();
				}
				else {
					if (window.parent['submitForm']) {
						window.parent['submitForm']();
					}
}
			}
		}
		);
	}

	var sebekon_get_inputed_address = function() {
		var country = false;
		var city = false;
		var address = false;
		<?foreach($_SESSION['sebekon_yaroute_arconfig'] as $opt=>$val) {?>
			var str = '';
			if ($sebekon_jq_delivery('input[type=text][name=ORDER_PROP_<?=$val?>]').size()>0 && $sebekon_jq_delivery('input[type=text][name=ORDER_PROP_<?=$val?>]').val()!='')
				str = $sebekon_jq_delivery('input[type=text][name=ORDER_PROP_<?=$val?>]').val();
				
			if ($sebekon_jq_delivery('input[type=text][name=ORDER_PROP_<?=$val?>_val]').size()>0 && $sebekon_jq_delivery('input[type=text][name=ORDER_PROP_<?=$val?>_val]').val()!='')
				str = $sebekon_jq_delivery('input[type=text][name=ORDER_PROP_<?=$val?>_val]').val();
			
			if ($sebekon_jq_delivery('textarea[name=ORDER_PROP_<?=$val?>]').size()>0 && $sebekon_jq_delivery('textarea[name=ORDER_PROP_<?=$val?>]').val()!='')
				str = $sebekon_jq_delivery('textarea[name=ORDER_PROP_<?=$val?>]').val();
				
			if ($sebekon_jq_delivery('select[name=ORDER_PROP_<?=$val?>]').size()>0 && !isNaN($sebekon_jq_delivery('select[name=ORDER_PROP_<?=$val?>]').val())) {
				str = $sebekon_jq_delivery('select[name=ORDER_PROP_<?=$val?>] option:selected').text();				
			}
			
			if (str!='') {
				<?if (stripos($opt,'COUNTRY')!==FALSE) {?>
				country = str;
				<?} elseif (stripos($opt,'CITY')!==FALSE) {?>
				city = str;
				<?} elseif (stripos($opt,'ADDRESS')!==FALSE) {?>
				address = str;
				<?}?>
			}
		<?}?>
		if (country==city) country = false;

		var result = [];
		if (country) result.push(country);
		if (city) result.push('<?=GetMessage('SEBEKON_DELIVERYPRICE_PARAMS_CITY')?> '+city);
		if (address) result.push(address);
		var res = result.join(', ');
		if (result.length>0) {
			$sebekon_jq_delivery('#DP_search_form<?=$arResult['ID']?> input[type=text]').val(result.join(', '));
			$sebekon_jq_delivery('#DP_search_form<?=$arResult['ID']?> input[type=button]').trigger('click');
			return true;
		} 
		
		return false;
	}

	var gCoords<?=$arResult['ID']?> = {};
	var gCoordName<?=$arResult['ID']?> = '';
	<?if($_SESSION['sebekon_yaroute_name']!=''):?>
		gCoordName<?=$arResult['ID']?> = '<?=addslashes($_SESSION['sebekon_yaroute_name'])?>';
	<?endif;?>

	var sebDelivery<?=$arResult['ID']?> = new SebekonDelivery('<?=$arResult['ID']?>');

	function setDestination<?=$arResult['ID']?>(e, coords){
		var properties = {},
		options = { 
			draggable: true,
			zIndex: 10000,
			zIndexActive: 10000,
			zIndexHover: 10000
		};
		
		if(typeof coords == 'undefined'){
			coords = e.get('coordPosition');
		}
		
		for (var i in sebDelivery<?=$arResult['ID']?>.placemarks) {
			sebDelivery<?=$arResult['ID']?>.map.geoObjects.remove(sebDelivery<?=$arResult['ID']?>.placemarks[i]);
		}
		sebDelivery<?=$arResult['ID']?>.points = new Array();
		sebDelivery<?=$arResult['ID']?>.placemarks = new Array();
		sebDelivery<?=$arResult['ID']?>.addPlacemark(coords, properties, options);
		gCoords<?=$arResult['ID']?> = coords;
		ymaps.geocode(gCoords<?=$arResult['ID']?>).then(function (res) {
			var names = [];
			res.geoObjects.each(function (obj) {
				names.push(obj.properties.get('text'));
			});
			gCoordName<?=$arResult['ID']?> = names[0];
		});
	}
		
	<?foreach($arResult["MAPS"] as $map):
		if(count($map["PROPS"]["ZONES"]["VALUE"])<=0) continue;?>	
		sebDelivery<?=$arResult['ID']?>.maps[<?=$map["ID"]?>] = {
			"NAME" : '<?=$map["NAME"]?>',
			"ID" : '<?=$map["ID"]?>',
			"ZONES": {<?=implode(":'',", $map["PROPS"]["ZONES"]["VALUE"])?>:''}
		};
	<?endforeach;?>
	
	setTimeout(function (){
		sebDelivery<?=$arResult['ID']?>.map = new ymaps.Map("map<?=$arResult['ID']?>", {
			center: [55.76, 37.64],
			zoom: 8,
			behaviors: ['drag']
		});
		DP_Collection<?=$arResult['ID']?> = new ymaps.GeoObjectCollection();
		$sebekon_jq_delivery('#DP_search_form<?=$arResult['ID']?> input[type=button]').click(function () {
			var search_query = $sebekon_jq_delivery('#DP_search_form<?=$arResult['ID']?> input:first').val();
			ymaps.geocode(search_query, {results: 1}).then(function (res) {
				DP_Collection<?=$arResult['ID']?>.removeAll();
				DP_Collection<?=$arResult['ID']?> = res.geoObjects;
				DP_Collection<?=$arResult['ID']?>.each(function(el){
					setDestination<?=$arResult['ID']?>(false, el.geometry.getCoordinates());
				});
			});
			return false;
		});
		
		var maxx=0, minx = 0, maxy=0, miny = 0;
		<?foreach($arResult["ZONES"] as $zone):?>
		var coordinates = getPointsFromCoords(<?=($zone["PROPS"]["ZONE_COORDS"]["VALUE"] ? $zone["PROPS"]["ZONE_COORDS"]["VALUE"] : "[[]]")?>);		
		for(var i in coordinates) {
			if (coordinates[i].x>maxx || maxx==0) maxx = coordinates[i].x;
			if (coordinates[i].x<minx || minx==0) minx = coordinates[i].x;
			if (coordinates[i].y>maxy || maxy==0) maxy = coordinates[i].y;			
			if (coordinates[i].y<miny || miny==0) miny = coordinates[i].y;
		}
		<?endforeach;?>
		if (maxx!=0 && minx!=0 && maxy!=0 && miny!=0) {
			var diff = (maxx-minx)*(maxx-minx) + (maxy-miny)*(maxy-miny);
			sebDelivery<?=$arResult['ID']?>.map.setBounds([[minx,miny],[maxx,maxy]], {checkZoomRange: true,  precizeZoom: true, callback:function(){				
				if (sebDelivery<?=$arResult['ID']?>.map.getZoom()<8 && diff<81) sebDelivery<?=$arResult['ID']?>.map.setZoom(8);}
			});
		}

		//рисование зон		
		<?foreach($arResult["ZONES"] as $zone):?>
			var c = <?=($zone["PROPS"]["ZONE_COORDS"]["VALUE"] ? $zone["PROPS"]["ZONE_COORDS"]["VALUE"] : "[[]]")?>;
			if (c instanceof Array) {
			var myGeometry = {
				type: 'Polygon',
				coordinates: <?=($zone["PROPS"]["ZONE_COORDS"]["VALUE"] ? $zone["PROPS"]["ZONE_COORDS"]["VALUE"] : "[[]]")?>
			};
			sebDelivery<?=$arResult['ID']?>.geometries[<?=$zone["ID"]?>] = new ymaps.GeoObject(
				{
					geometry: myGeometry
				}, 
				{
					<?if(!empty($zone["PROPS"]["ZONE_COLOR"]["VALUE"])):?>
						fill: true,
						fillColor: '<?=($zone["PROPS"]["ZONE_COLOR"]["VALUE"])?>',
						opacity: 0.3,
					<?else:?>
						fill: false,
						stroke: false,
					<?endif;?>
					zIndex: <?=intval($zone["SORT"])?>,
					interactivityModel: 'default#transparent'
				}
			);
			
			sebDelivery<?=$arResult['ID']?>.zones[<?=$zone["ID"]?>] = {
				"PRICE_FIX" : '<?=floatval($zone["PROPS"]["PRICE_FIX"]["VALUE"])?>',
				"PRICE_KM"	: '<?=floatval($zone["PROPS"]["PRICE_KM"]["VALUE"])?>',
				"ZONE_FROM"	: '<?=$zone["PROPS"]["ZONE_FROM"]["VALUE"]?>',
				"PRICE_INTERVALS" : [
				<?if(is_array($zone["PROPS"]["PRICE_INTERVALS"]['VALUE']) && count($zone["PROPS"]["PRICE_INTERVALS"]['VALUE'])>0) {
					foreach($zone["PROPS"]["PRICE_INTERVALS"]['VALUE'] as $_key=>$price) {
						$interval = explode('-', $zone["PROPS"]["PRICE_INTERVALS"]['DESCRIPTION'][$_key]);
						if($_key){ 
							echo ',';
						}?>{'from':'<?=intval($interval[0])?>', 'to':'<?=intval($interval[1])?>', 'price':'<?=floatval($price)?>'}<?
					}
				}?>
				],
				"DP_DECIMAL_CNT": 		<?=intval(!empty($zone["PROPS"]["DP_DECIMAL_CNT"]["VALUE"]) ? $zone["PROPS"]["DP_DECIMAL_CNT"]["VALUE"] 	: COption::GetOptionString('sebekon.deliveryprice', 'DP_DECIMAL_CNT', 0));?>,
				"DP_DEC_CNT": 			<?=intval(!empty($zone["PROPS"]["DP_DEC_CNT"]["VALUE"]) 	? $zone["PROPS"]["DP_DEC_CNT"]["VALUE"] 		: COption::GetOptionString('sebekon.deliveryprice', 'DP_DEC_CNT', 0));?>,
				"DP_DECIMAL_POINT": 	'<?=(!empty($zone["PROPS"]["DP_DECIMAL_POINT"]["VALUE"]) 	? $zone["PROPS"]["DP_DECIMAL_POINT"]["VALUE"] 	: COption::GetOptionString('sebekon.deliveryprice', 'DP_DECIMAL_POINT', '.'));?>',
				"DP_THOUSAND_POINT": 	'<?=(!empty($zone["PROPS"]["DP_THOUSAND_POINT"]["VALUE"]) 	? $zone["PROPS"]["DP_THOUSAND_POINT"]["VALUE"] 	: COption::GetOptionString('sebekon.deliveryprice', 'DP_THOUSAND_POINT', ' '));?>'
			
			}
			sebDelivery<?=$arResult['ID']?>.map.geoObjects.add(sebDelivery<?=$arResult['ID']?>.geometries[<?=$zone["ID"]?>]);
			}
		<?endforeach;?>
		
		sebDelivery<?=$arResult['ID']?>.map.events.add('dblclick', function (e) {
			setDestination<?=$arResult['ID']?>(e);
		});
	
		sebDelivery<?=$arResult['ID']?>.map.controls.add("mapTools").add("zoomControl").add("typeSelector");

		<?if(isset($_REQUEST['sebekon_yaroute_point']['x']) && isset($_REQUEST['sebekon_yaroute_point']['y'])):?>
				<?$_SESSION['sebekon_yaroute_point'] = $_REQUEST['sebekon_yaroute_point'];?>
				setDestination<?=$arResult['ID']?>(false,['<?=$_REQUEST['sebekon_yaroute_point']['x']?>','<?=$_REQUEST['sebekon_yaroute_point']['y']?>']);
		<?elseif(isset($_SESSION['sebekon_yaroute_point']['x']) && isset($_SESSION['sebekon_yaroute_point']['y'])):?>
			if (!sebekon_get_inputed_address()) {
				setDestination<?=$arResult['ID']?>(false,['<?=$_SESSION['sebekon_yaroute_point']['x']?>','<?=$_SESSION['sebekon_yaroute_point']['y']?>']);			
			}
		<?endif;?>
	}, 600);
	
	function showPreloader<?=$arResult['ID']?>() {
		$sebekon_jq_delivery('#DELIVERS<?=$arResult['ID']?>').html("<p class=\"wait\"><img src=\"<?=$templateFolder?>/images/preloader.gif\" />&nbsp;<?=GetMessage("sebekon_DP_PUBLIC_WAIT")?></p>");
		return;
	}

	function showResults<?=$arResult['ID']?>(){
		var deliveryText = "";		
		
		for(mapID in sebDelivery<?=$arResult['ID']?>.delivers) {	
			var total = 0;
			var has_zones = false;
			var len = 0;
			for(var zoneID in sebDelivery<?=$arResult['ID']?>.delivers[mapID]) {
				if (!isNaN(sebDelivery<?=$arResult['ID']?>.delivers[mapID][zoneID]['PRICE'])) {
					total += parseFloat(sebDelivery<?=$arResult['ID']?>.delivers[mapID][zoneID]['PRICE']);
					has_zones = true;
				} 
				if (!isNaN(sebDelivery<?=$arResult['ID']?>.delivers[mapID][zoneID]['LENGTH'])) {
					len += parseFloat(sebDelivery<?=$arResult['ID']?>.delivers[mapID][zoneID]['LENGTH']);
					has_zones = true;
				}
			}
			
			if(len==0 && has_zones){
				deliveryText += '<p><label>'+gCoordName<?=$arResult['ID']?> + ": <strong>" + getFormatPrice(total,sebDelivery<?=$arResult['ID']?>.delivers[mapID].slice(0,1)) + " <?=GetMessage("sebekon_RUB")?>.</strong> ("+sebDelivery<?=$arResult['ID']?>.maps[mapID]["NAME"]+")</label></p>";
				sebDelivery<?=$arResult['ID']?>.price[mapID] = {"DELIVERY_PRICE" :  parseFloat(total), "MAP_ID": mapID, "LENGTH": 0};
				$sebekon_jq_delivery('.delivery_basket_btn').show();
			}else if(len>0){
				sebDelivery<?=$arResult['ID']?>.price[mapID] = {"DELIVERY_PRICE" :  parseFloat(total), "MAP_ID": mapID, "LENGTH": len};
				deliveryText += '<p><label>'+gCoordName<?=$arResult['ID']?> + ": <strong>" + getFormatPrice(total,sebDelivery<?=$arResult['ID']?>.delivers[mapID].slice(0,1)) + " <?=GetMessage("sebekon_RUB")?>.</strong>";
				deliveryText += " ("+sebDelivery<?=$arResult['ID']?>.maps[mapID]["NAME"]+")</label></p>";
			} else {
					deliveryText += '<p><label>'+gCoordName<?=$arResult['ID']?> + ": <?=GetMessage('sebekon_DP_PUBLIC_UNPOSSIBLE')?> ("+sebDelivery<?=$arResult['ID']?>.maps[mapID]["NAME"]+")</label></p>";
					sebDelivery<?=$arResult['ID']?>.price[mapID] = null;
		
			}			
		}
		
		$sebekon_jq_delivery('#DELIVERS<?=$arResult['ID']?>').html(deliveryText);
		sebekon_deliverycalc_params = {prices: sebDelivery<?=$arResult['ID']?>.price, action:'prices', coords: gCoords<?=$arResult['ID']?>, name: gCoordName<?=$arResult['ID']?>};				
		$sebekon_jq_delivery('#sebekon_yaroute_point_x').val(gCoords<?=$arResult['ID']?>[0]);
		$sebekon_jq_delivery('#sebekon_yaroute_point_y').val(gCoords<?=$arResult['ID']?>[1]);
		sendDeliveryForm();
		return;
	}

	function sebekon_dragend<?=$arResult['ID']?> (coords) {
		gCoords<?=$arResult['ID']?> = coords;
		ymaps.geocode(gCoords<?=$arResult['ID']?>).then(function (res) {
			var names = [];
			res.geoObjects.each(function (obj) {
				names.push(obj.properties.get('text'));
			});
			gCoordName<?=$arResult['ID']?> = names[0];
		});
	}
	
	
	var sebekon_delivery_refresh_options = function() {
		var addressarr = gCoordName<?=$arResult['ID']?>.split(', ');
		var country = addressarr[0];
		var city = addressarr[1];		
		if (addressarr.length>4) {
			city = addressarr[2];	
			addressarr.splice(0,3);
		} else {
			addressarr.splice(0,2);
		}
		var address = addressarr.join(', ');
		<?foreach($_SESSION['sebekon_yaroute_arconfig'] as $opt=>$val) {
			if (stripos($opt,'COUNTRY')!==FALSE) {?>
			var str = country;
			<?} elseif (stripos($opt,'CITY')!==FALSE) {?>
			var str = city;
			<?} elseif (stripos($opt,'ADDRESS')!==FALSE) {?>
			var str = address;
			<?}?>
			if ($sebekon_jq_delivery('input[type=text][name=ORDER_PROP_<?=$val?>]').size()>0)
				$sebekon_jq_delivery('input[type=text][name=ORDER_PROP_<?=$val?>]').val(str);
			
			if ($sebekon_jq_delivery('input[type=text][name=ORDER_PROP_<?=$val?>_val]').size()>0)
				$sebekon_jq_delivery('input[type=text][name=ORDER_PROP_<?=$val?>_val]').val(str);
			
			if ($sebekon_jq_delivery('textarea[name=ORDER_PROP_<?=$val?>]').size()>0)
				$sebekon_jq_delivery('textarea[name=ORDER_PROP_<?=$val?>]').val(str);
				
			if ($sebekon_jq_delivery('select[name=ORDER_PROP_<?=$val?>]').size()>0) {				
				$sebekon_jq_delivery('select[name=ORDER_PROP_<?=$val?>] option').each(function(){
					if ($sebekon_jq_delivery(this).text().search(str)>=0) {
						$sebekon_jq_delivery('select[name=ORDER_PROP_<?=$val?>] option:selected').removeAttr('selected');
						$sebekon_jq_delivery(this).attr('selected','selected');
						$sebekon_jq_delivery(this).parents('select').val($sebekon_jq_delivery(this).attr('value'));
					}
				});
			}
			
		<?}?>
	}

window.parent['showPreloader<?=$arResult['ID']?>'] = showPreloader<?=$arResult['ID']?>;
window.parent['showResults<?=$arResult['ID']?>'] = showResults<?=$arResult['ID']?>;
window.parent['sebDelivery<?=$arResult['ID']?>'] = sebDelivery<?=$arResult['ID']?>;
window.parent['sebekon_dragend<?=$arResult['ID']?>'] = sebekon_dragend<?=$arResult['ID']?>;
window.parent['sebekon_delivery_refresh_options'] = sebekon_delivery_refresh_options;
</script>
<input type="hidden" name="sebekon_yaroute_point[x]" id="sebekon_yaroute_point_x" value="<?=htmlspecialchars((($_REQUEST['sebekon_yaroute_point']['x'])?$_REQUEST['sebekon_yaroute_point']['x']:$_SESSION['sebekon_yaroute_point']['x']))?>">
<input type="hidden" name="sebekon_yaroute_point[y]" id="sebekon_yaroute_point_y" value="<?=htmlspecialchars((($_REQUEST['sebekon_yaroute_point']['y'])?$_REQUEST['sebekon_yaroute_point']['y']:$_SESSION['sebekon_yaroute_point']['y']))?>">