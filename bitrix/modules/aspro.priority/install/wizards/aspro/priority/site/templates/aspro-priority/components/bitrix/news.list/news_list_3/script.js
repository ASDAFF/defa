function TemplateScript(){	
	$('.item-views.front.news-items:not(.projects) .item:not(.wti) .section_name').sliceHeightRandomWidth({'row': '.row'});
	$('.item-views.front.news-items:not(.projects) .item:not(.wti)>.wrap').sliceHeightRandomWidth({'row': '.row'});
	$('.item-views.front.news-items:not(.projects) .item:not(.wti) .body-info>.wrap').sliceHeightRandomWidth({'row': '.row'});
	$('.item-views.front.news-items:not(.projects) .item>.wrap').sliceHeightRandomWidth({'row': '.row'});
}

$(document).ready(function(){	
	TemplateScript();
	BX.addCustomEvent('onCompleteActionComponent', function(eventdata, _this){
		setTimeout(function(){
			TemplateScript();
		}, 50);
	});	
});