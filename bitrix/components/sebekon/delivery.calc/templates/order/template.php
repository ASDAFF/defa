<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/*
 * Module: sebekon.deliveryprice
 */
 
CModule::IncludeModule('sebekon.deliveryprice'); 
?>
<script type="text/javascript">

	var sebekon_get_inputed_address = function() {
		var country = false;
		var city = false;
		var address = false;
		<?foreach(\CSebekonDeliveryPrice::getArConfig() as $opt=>$val) {?>
            <?if(stripos($opt, 'ADDRESS')===FALSE) continue;?>
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
		if (address) {
			result.push(address);
			var res = result.join(', ');
			if (result.length>0) {
				$sebekon_jq_delivery('#DP_search_form<?=$arResult['ID']?> input[type=text]').val(result.join(', '));
				$sebekon_jq_delivery('#DP_search_form<?=$arResult['ID']?>').submit();
				return true;
			} 
		}
		
		return false;
	}

	var sebDelivery<?=$arResult['ID']?> = new SebekonDelivery('<?=$arResult['ID']?>',{
		onPreload: function(self){
			$sebekon_jq_delivery('#DELIVERS'+self.compid).html("<p class=\"wait\"><img src=\"<?=$templateFolder?>/images/preloader.gif\" />&nbsp;<?=GetMessage("sebekon_DP_PUBLIC_WAIT")?></p>");
		},
		onSetDestination: function(self, e, coords) {
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

			if(typeof coords == 'undefined'){
				coords = e.get('coords');
			}
			
			self.clear(false);
			self.addPlacemark(coords, properties, options);
			self.coords = coords;
			ymaps.geocode(self.coords).then(function (res) {
				var names = [];
				res.geoObjects.each(function (obj) {
					names.push(obj.properties.get('text'));
				});
				self.coordsName = names[0];
			});
		}
	});	
	
    sebDelivery<?=$arResult['ID']?>.params = <?=CUtil::PhpToJSObject($arResult['jsParams'])?>;
	sebDelivery<?=$arResult['ID']?>.load(<?=CUtil::PhpToJSObject($arResult['jsResult'])?>, <?=CUtil::PhpToJSObject($arResult['jsLabels'])?>);
	<?if(\CSebekonDeliveryPrice::getName()!=''):?>
		sebDelivery<?=$arResult['ID']?>.coordsName = '<?=addslashes(\CSebekonDeliveryPrice::getName())?>';
	<?endif;?>
	

	ymaps.ready(function (){
	
		var doc_h = $sebekon_jq_delivery(document).height();
		if (doc_h>$sebekon_jq_delivery(window).height())
			doc_h = $sebekon_jq_delivery(window).height();
		if (doc_h-400<100) doc_h = 500;
		$sebekon_jq_delivery("#map<?=$arResult['ID']?>").height(doc_h-400);
		
		var deliveryObj = sebDelivery<?=$arResult['ID']?>;
		deliveryObj.mapInit();
		deliveryObj.boundsInit();
		deliveryObj.searchInit();
		deliveryObj.drawZones();
	
		deliveryObj.map.controls.add("zoomControl");
		
		<?
            $arPoint = \CSebekonDeliveryPrice::getPoint();
        ?>
		<?if(isset($arPoint['x']) && isset($arPoint['y'])):?>
			deliveryObj.setDestination(false,['<?=$arPoint['x']?>','<?=$arPoint['y']?>']);
		<?else:?>
			sebekon_get_inputed_address();
		<?endif;?>
	});
	
	var sebekon_delivery_refresh_options = function() {
		var addressarr = sebDelivery<?=$arResult['ID']?>.coordsName.split(', ');
		var country = addressarr[0];
		var city = addressarr[1];		
		if (addressarr.length>4) {
			city = addressarr[2];	
			addressarr.splice(0,3);
		} else {
			addressarr.splice(0,2);
		}
		var address = addressarr.join(', ');
		<?foreach(\CSebekonDeliveryPrice::getArConfig() as $opt=>$val) {
            if(stripos($opt, 'ADDRESS')===FALSE) continue;
            ?>
			var str = sebDelivery<?=$arResult['ID']?>.coordsName;
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
</script>
<button onclick="submitParentForm();" class="btn btn-primary pull-right sebekon_select_btn" style="display: none;"><?=GetMessage('sebekon_DELIVERY_SELECT')?></button>
<form id="DP_search_form<?=$arResult['ID']?>" class="DP_search_form" action="" method="POST">
	<?=GetMessage('sebekon_SEARCH_ADDRESS')?>:
    <input type="text" value="" style="margin-bottom: 0;"/>	
    <input type="submit" value="<?=GetMessage('sebekon_SEARCH_BTN')?>" class="btn"/>
	<p class="help"><i><?=GetMessage('sebekon_SEARCH_HELP')?></i></p>
</form>
<div id="map<?=$arResult['ID']?>" style="width: 600px;"></div>

<div id="DELIVERS<?=$arResult['ID']?>" class="DELIVERS"></div>