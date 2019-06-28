function TemplateScript2(){
	$('.item-views.services-items.type_2 .items .item>.wrap').sliceHeight();
	
	$('.item-views.services-items.type_2 .item').each(function(){
		var itemID = $(this).data('id');
		
		window['hoverItem'+itemID] = false
	});

	$('.item-views.services-items.type_2 .items .item>.wrap').hover(function(){
		var block = $(this).find('.body-info'),
			itemID = $(this).closest('.item').data('id');
		
		clearTimeout(window['hoverItem'+itemID]);
		block.find('.bottom-block').show();
		
		var marginTop = block.outerHeight() - block.find('.bottom-block').outerHeight();

		block.closest('.body-info').css('margin-top', -marginTop);
	},
	function(){
		var block = $(this).find('.bottom-block'),
			itemID = $(this).closest('.item').data('id');
		block.closest('.body-info').css('margin-top', '0');
		window['hoverItem'+itemID] = setTimeout(function(){
			block.hide();
		}, 200);
	});
}

$(document).ready(function(){
	TemplateScript2();
	BX.addCustomEvent('onCompleteActionComponent', function(eventdata, _this){
		setTimeout(function(){
			TemplateScript2();
		}, 50);
	});
});