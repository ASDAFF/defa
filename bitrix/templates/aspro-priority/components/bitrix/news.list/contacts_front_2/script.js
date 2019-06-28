$(document).ready(function(){
	$('.contacts.front.type_2 .items').mCustomScrollbar();
	$('.contacts.front.type_2>.item').sliceHeight();
	$(document).on('click', '.contacts.front.type_2 .items .item', function(){
		var _this = $(this),
			itemID = _this.data('id'),
			animationTime = 200;
		
		_this.closest('.left_block').find('>.top_block').fadeOut(animationTime);
		_this.closest('.items').fadeOut(animationTime, function(){
			_this.closest('.left_block').find('.detail_desc_items').show();
			_this.closest('.left_block').find('.detail_desc_items .item[data-id='+itemID+']').fadeIn(animationTime);
		});
	});
	
	$(document).on('click', '.contacts.front.type_2 .top-close', function(){
		var _this = $(this).closest('.left_block').find('.detail_desc_items .item:visible'),
			animationTime = 200;
		
		_this.fadeOut(animationTime);

		_this.closest('.detail_desc_items').fadeOut(animationTime, function(){
			_this.closest('.left_block').find('.items').fadeIn(animationTime);
			_this.closest('.left_block').find('>.top_block').fadeIn(animationTime);
		});
	});
});