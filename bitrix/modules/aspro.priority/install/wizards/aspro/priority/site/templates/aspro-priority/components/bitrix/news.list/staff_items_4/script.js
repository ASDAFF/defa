function TemplateScript(){
	$('.sections.linked.item-views.staff .item .post').sliceHeight();
	$('.sections.linked.item-views.staff .item>.wrap').sliceHeight();
	
	$('.item-views.staff .items .item').hover(function(){
		var block = $(this).find('.bottom-block');
		block.show();
		var blockHeight = block.outerHeight(true, true);
		
		block.closest('.body-info').css('margin-top', -blockHeight);
	},
	function(){
		var block = $(this).find('.bottom-block');
		block.closest('.body-info').css('margin-top', '0');
		block.css('opaity', 0);
		//setTimeout(function(){
			block.hide();
		//}, 200);
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