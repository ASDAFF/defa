$(document).ready(function(){
	$('.item-views.tarifs .flexslider .item .image>.wrap').sliceHeight({allElements: true});
	$('.item-views.tarifs .flexslider .item .section_name').sliceHeight({allElements: true});
	$('.item-views.tarifs .flexslider .item .name').sliceHeight({allElements: true});
	$('.item-views.tarifs .flexslider .item .previewtext').sliceHeight({allElements: true});
	$('.item-views.tarifs .flexslider .item .prices').sliceHeight({allElements: true});
	
	
	$('.item-views.tarifs .property').on('mouseenter', function(){
		var index = $(this).index();

		$('.item-views.tarifs .property').each(function(){
			var thisIndex = $(this).index();
			
			if(thisIndex == index){
				$(this).addClass('onhover');
			}
		});
	});
	
	$('.item-views.tarifs .property').on('mouseleave', function(){
		$('.item-views.tarifs .property').removeClass('onhover');
	});
});