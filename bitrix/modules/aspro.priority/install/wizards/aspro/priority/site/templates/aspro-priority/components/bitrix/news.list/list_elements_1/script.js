function TemplateScript(){
	$('.item-views.services-items.type_2 .items .item>.wrap').sliceHeight();
	
	/*$('.item-views.services-items.type_2 .item').each(function(){
		var itemID = $(this).data('id');
		
		window['hoverItem'+itemID] = false
	});*/
	
	$('.item-views.services-items.type_2 .items .item:not(.wti)>.wrap').hover(function(){
		var block = $(this).find('.body-info'),
			blockHeightUnderHover = block.outerHeight(),
			itemID = $(this).closest('.item').data('id');
			
		//clearTimeout(window['hoverItem'+itemID]);
		block.find('.bottom-block').show();
		var blockHeight = block.height(),
			titleHeight = block.find('.bottom-block').outerHeight(),
			marginTop = blockHeight - titleHeight;

		block.closest('.body-info').css('margin-top', -blockHeight + blockHeightUnderHover);
	},
	function(){
		var block = $(this).find('.bottom-block'),
			itemID = $(this).closest('.item').data('id');
		block.closest('.body-info').css('margin-top', '0');
		//block.css('opacity', 0);
		setTimeout(function(){
			block.hide();
		}, 200);
	});
}

$(document).ready(function(){
	TemplateScript();
	BX.addCustomEvent('onCompleteActionComponent', function(eventdata, _this){
		setTimeout(function(){
			TemplateScript();
		}, 50);
	});
});