$(document).ready(function(){
	//$('.item-views.tarifs.wicons .flexslider .item .image>.wrap').sliceHeight({allElements: true});
	$('.item-views.tarifs.wicons .flexslider .item .section_name').sliceHeight({allElements: true});
	$('.item-views.tarifs.wicons .flexslider .item .name').sliceHeight({allElements: true});
	$('.item-views.tarifs.wicons .flexslider .item .previewtext').sliceHeight({allElements: true});
	$('.item-views.tarifs.wicons .flexslider .item .properties').sliceHeight({allElements: true});
	//$('.item-views.tarifs.wicons .flexslider .item .prices').sliceHeight({allElements: true});
	$('.item-views.tarifs.wicons .flexslider .item .body-wrap').sliceHeight({allElements: true});
	$('.item-views.tarifs.wicons .flexslider .item>.wrap').sliceHeight({allElements: true});
	
	$(document).on('click', '.item-views.tarifs .item .price', function(){
		var _this = $(this);
		
		_this.closest('.all_price').find('.price').removeClass('active');
		_this.addClass('active');
	});
});