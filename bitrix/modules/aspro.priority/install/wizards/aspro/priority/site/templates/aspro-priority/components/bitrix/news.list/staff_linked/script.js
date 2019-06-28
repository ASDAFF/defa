function TemplateScript(){
	$('.sections.linked.item-views.staff .item .post').sliceHeight();
	$('.sections.linked.item-views.staff .item .title').sliceHeight();
	$('.sections.linked.item-views.staff .item>.wrap').sliceHeight();
	
	$('.item-views.services-items.type_2 .item').each(function(){
		var itemID = $(this).data('id');
		
		window['hoverItem'+itemID] = false;
	});	
	
	$('.item-views.staff .items .item').hover(function(){
		var block = $(this).find('.bottom-block'),
			itemID = $(this).closest('.item').data('id');

		clearTimeout(window['hoverItem'+itemID]);
		block.show();
		var blockHeight = block.outerHeight(true, true) - 1;
		
		block.closest('.body-info').css('margin-top', -blockHeight);
	},
	function(){
		var block = $(this).find('.bottom-block'),
			itemID = $(this).closest('.item').data('id');
		
		block.closest('.body-info').css('margin-top', '0');
		block.css('opaity', 0);
		window['hoverItem'+itemID] = setTimeout(function(){
			block.hide();
		}, 200);
	});
}

$(document).ready(function(){
	setTimeout(function(){
		TemplateScript();
	}, 500);
	//$('.sections.linked.item-views.staff .item .image').css('padding-top', '100%');
	BX.addCustomEvent('onCompleteActionComponent', function(eventdata, _this){
		setTimeout(function(){
			TemplateScript();
		}, 50);
	});
});