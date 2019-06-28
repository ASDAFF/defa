BX.addCustomEvent('onCompleteAction', function(eventdata){
	if(eventdata.action === 'ajaxContentLoaded')
	{
		setTimeout(function(){
			$('.banners-small .item.normal-block').sliceHeight();
		}, 100);
	}
});