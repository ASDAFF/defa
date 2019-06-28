function TemplateScript(){	
	$('.item-views.front.news-items:not(.projects) .item:not(.wti) .section_name').sliceHeightRandomWidth({'row': '.row'});
	$('.item-views.front.news-items:not(.projects) .item:not(.wti) .title').sliceHeightRandomWidth({'row': '.row'});
	$('.item-views.front.news-items:not(.projects) .item').sliceHeightRandomWidth({'row': '.row'});
}
$(document).ready(function(){	
	TemplateScript();
	BX.addCustomEvent('onCompleteActionComponent', function(eventdata, _this){
		setTimeout(function(){
			TemplateScript();
		}, 50);
	});	
});