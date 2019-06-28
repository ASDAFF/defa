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
			for(mapID in self.delivers) {			
				for(var zoneID in self.delivers[mapID]) {
					self.map.balloon.open(
					self.coords, {
						contentBody: $sebekon_jq_delivery('.zone_preview.map'+self.compid+'[rel='+zoneID+']').html()
					}, {
						closeButton: true
					});
				}
			}
		},
		onDragEnd: function (self) {
			self.coords = coords;
		},
		onSetDestination: function(self, e, coords){
			var properties = {},
			options = { 
				draggable: true,
				zIndex: -1,
				iconImageSize:[0, 0],
				zIndexActive: -1,
				zIndexHover: -1
			};
			
			if(typeof coords == 'undefined'){
				coords = e.get('coordPosition');
			}
			
			if(typeof coords == 'undefined'){
				coords = e.get('coords');
			}			
			
			self.clear(false);
			self.addPlacemark(coords, properties, options);
			self.coords = coords;
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
	
</script>

<form id="DP_search_form<?=$arResult['ID']?>" class="DP_search_form" action="" method="POST">
	<?=GetMessage('sebekon_SEARCH_ADDRESS')?>:
    <input type="text" value="" />
    <input type="submit" value="<?=GetMessage('sebekon_SEARCH_BTN')?>" class="btn"/>
	<p class="help"><i><?=GetMessage('sebekon_SEARCH_HELP')?></i></p>
</form>
<?foreach($arResult["ZONES"] as $zone):?>
	<div class="zone_preview map<?=$arResult['ID']?>" rel="<?=$zone['ID']?>" style="display: none;">
	<strong><?=$zone['NAME']?></strong><br/>
	<?=$zone['PREVIEW_TEXT']?>
	</div>
<?endforeach;?>

<div id="map<?=$arResult['ID']?>" style="width: 600px; height: 400px"></div>