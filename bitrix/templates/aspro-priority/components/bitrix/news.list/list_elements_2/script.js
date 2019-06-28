$(document).ready(function(){
	$('.item-views.services-items.type_5 .items .item>.wrap').sliceHeight();
	BX.addCustomEvent('onCompleteActionComponent', function(eventdata, _this){
		$('.item-views.services-items.type_5 .items .item>.wrap').sliceHeight();
	});	
});