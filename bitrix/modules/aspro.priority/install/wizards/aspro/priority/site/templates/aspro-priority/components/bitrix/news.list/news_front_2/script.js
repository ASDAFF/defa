$(document).ready(function(){	
	$('.item-views.front.news-items:not(.projects) .item:not(.wti) .body-info').sliceHeight();
	$('.item-views.front.news-items:not(.projects) .item:not(.wti)>.wrap').sliceHeight();
	$('.item-views.front.news-items:not(.projects) .item>.wrap').sliceHeight();
	$('.item-views.front.news-items:not(.projects) .item').sliceHeight();
});