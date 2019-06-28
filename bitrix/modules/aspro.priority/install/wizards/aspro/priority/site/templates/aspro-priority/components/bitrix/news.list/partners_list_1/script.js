$(document).ready(function(){
	if($('.row.sid').length)
	{
		$('.row.sid').each(function(){
			// $(this).find('.item:visible .image').sliceHeight({lineheight: -3});
			$(this).find('.item:visible .properties').sliceHeight({fixWidth: 2});
			$(this).find('.item:visible .previewtext').sliceHeight({fixWidth: 2});
			$(this).find('.item:visible .text').sliceHeight({fixWidth: 2});
		})
	}
});