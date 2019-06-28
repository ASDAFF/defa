<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/*
 * Module: sebekon.deliveryprice
 */
 
CModule::IncludeModule('sebekon.deliveryprice'); 
?>
<script type="text/javascript">
	var sebDelivery<?=$arResult['ID']?> = new SebekonDelivery('<?=$arResult['ID']?>',{
		onPreload: function(self){
			$sebekon_jq_delivery('#DELIVERS'+self.compid).html("<p class=\"wait\"><img src=\"<?=$templateFolder?>/images/preloader.gif\" />&nbsp;<?=GetMessage("sebekon_DP_PUBLIC_WAIT")?></p>");
		},
		onResult: function(self) {
			var deliveryText = "";
			$sebekon_jq_delivery('.delivery_basket_btn').hide();
			
			if (self.points.length>0) {
				for(mapID in self.delivers) {
					var total = 0;
					var has_zones = false;
					var len = 0;
					var selectedZone = false;
					for(var zoneID in self.delivers[mapID]) {
						if (!isNaN(self.delivers[mapID][zoneID]['PRICE'])) {
							total += parseFloat(self.delivers[mapID][zoneID]['PRICE']);
							has_zones = true;
							selectedZone = zoneID;
						} 
						if (!isNaN(self.delivers[mapID][zoneID]['LENGTH'])) {
							len += parseFloat(self.delivers[mapID][zoneID]['LENGTH']);
							has_zones = true;
							selectedZone = zoneID;
						}
					}
					
					if(len==0 && has_zones){
						deliveryText += '<p><label><input type="radio" value="'+mapID+'" name="mapID"> '+self.maps[mapID]["NAME"] + ": <strong>" + getFormatPrice(total,self.zones[selectedZone]) + " <?=GetMessage("sebekon_RUB")?>.</strong></label></p>";
						self.price[mapID] = {"DELIVERY_PRICE" :  parseFloat(total), "MAP_ID": mapID};
						$sebekon_jq_delivery('.delivery_basket_btn').show();
					}else if(len>0){
						self.price[mapID] = {"DELIVERY_PRICE" :  parseFloat(total), "MAP_ID": mapID};
						deliveryText += '<p><label><input type="radio" value="'+mapID+'" name="mapID"> '+self.maps[mapID]["NAME"] + ": <strong>" + getFormatPrice(total,self.zones[selectedZone]) + " <?=GetMessage("sebekon_RUB")?>.</strong>";
						$sebekon_jq_delivery('.delivery_basket_btn').show();
						<?if($arParams["SHOW_ROUTE"]=="Y" ):?>
							if(self.delivers[mapID][zoneID]['ROUTE']){
								self.delivers[mapID][zoneID]['ROUTE'].options.set({zIndex: 9999, zIndexActive: 9999, zIndexHover: 9999});
								self.map.geoObjects.add(self.delivers[mapID][zoneID]['ROUTE']);
								deliveryText += '<br/><span class="info"><?=GetMessage("sebekon_DP_IBLOCK_ROUTE_LEN")?>: ' + number_format(len,2,',',' ') + ' <?=GetMessage("sebekon_DP_IBLOCK_KM")?></span>';
							}
						<?endif;?>
						deliveryText += "</label></p>";
					} else {
							deliveryText += '<p><label><input type="radio" value="'+mapID+'" name="mapID" disabled="disabled"> '+self.maps[mapID]["NAME"] + ": <?=GetMessage('sebekon_DP_PUBLIC_UNPOSSIBLE')?></label></p>";
							self.price[mapID] = null;
				
					}			
				}
			}
			
			$sebekon_jq_delivery('#DELIVERS<?=$arResult['ID']?>').html(deliveryText);
		}
	});
	
	sebDelivery<?=$arResult['ID']?>.params = <?=CUtil::PhpToJSObject($arResult['jsParams'])?>;	
	sebDelivery<?=$arResult['ID']?>.load(<?=CUtil::PhpToJSObject($arResult['jsResult'])?>, <?=CUtil::PhpToJSObject($arResult['jsLabels'])?>);
	
	ymaps.ready(function (){
		var deliveryObj = sebDelivery<?=$arResult['ID']?>;
		deliveryObj.mapInit();
		deliveryObj.boundsInit();
		deliveryObj.searchInit();
		deliveryObj.drawZones();
	
		deliveryObj.map.controls.add("zoomControl");
	});
	
	var addDeliveryToBasket = function(seb_delivery) {
		if ($sebekon_jq_delivery('#DELIVERS'+seb_delivery.compid+' input[name=mapID]:checked').size()>0) {
			var map_id = $sebekon_jq_delivery('#DELIVERS'+seb_delivery.compid+' input[name=mapID]:checked').val();
			$sebekon_jq_delivery.get(
				'<?=$templateFolder?>/add2basket.php', 
				{
					'DELIVERY_PRICE': seb_delivery.price[map_id]['DELIVERY_PRICE'], 
					'MAP_ID': seb_delivery.price[map_id]['MAP_ID']
				},
				function(data){
					if(parseFloat(data)>0){
						alert('<?=GetMessage("sebekon_DP_DELIVERY_BASKET_ADDED")?>');
					}else{
						alert('<?=GetMessage("sebekon_DP_DELIVERY_BASKET_NOT_ADDED")?>');
					}
				}
			);
		} else {
			alert('<?=GetMessage("sebekon_DP_DELIVERY_NO_DELIVERY_CHOOSEN")?>');
		}
	}
	
</script>

<form id="DP_search_form<?=$arResult['ID']?>" class="DP_search_form" action="" method="POST">
	<?=GetMessage('sebekon_SEARCH_ADDRESS')?>:
    <input type="text" value="" />
    <input type="submit" value="<?=GetMessage('sebekon_SEARCH_BTN')?>" class="btn"/>
	<p class="help"><i><?=GetMessage('sebekon_SEARCH_HELP')?></i></p>
</form>

<div id="map<?=$arResult['ID']?>" style="width: 600px; height: 400px"></div>

<div id="DELIVERS<?=$arResult['ID']?>" class="DELIVERS"></div>

<?if($arParams["ADD2BASKET"]):?>
	<a href="javascript:void(0);" class="btn delivery_basket_btn" onclick="addDeliveryToBasket(sebDelivery<?=$arResult['ID']?>);" style="display: none;">
		<?=GetMessage('sebekon_DP_ADD2BASKET')?>
	</a>	
<?endif;?>
<a href="javascript:void(0);" class="btn delivery_basket_btn" onclick="sebDelivery<?=$arResult['ID']?>.clear(true);	" style="display: none;">
	<?=GetMessage('sebekon_DP_CLEAR')?>
</a>