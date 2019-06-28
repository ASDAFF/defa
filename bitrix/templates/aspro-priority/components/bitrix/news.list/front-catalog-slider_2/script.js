$(document).ready(function(){
	var index = $('.tabs_ajax .head-block .item-link.active').index();
	setBasketItemsClasses();
	
	$('.catalog.item-views.table .item .props').mCustomScrollbar();
	
	if(!index)
	{
		$('.item-block.active .catalog.item-views.table .item .title').sliceHeight({allElements: true});
		$('.item-block.active .catalog.item-views.table .item .cont').sliceHeight({allElements: true});
		$('.item-block.active .catalog.item-views.table .item .slice_price').sliceHeight({allElements: true});
		$('.item-block.active .catalog.item-views.table .item .image>.wrap').sliceHeight({lineheight:-3, allElements: true})
		setTimeout(function(){
			$('.item-block.active .catalog.item-views.table .item').sliceHeight({classNull: '.footer-button', allElements: true});
		}, 1000);
	}
	
	$(document).on('mouseenter', '.item .delivery', function(){
		var _this = $(this),
			$tooltip = _this.find('.tooltip'),
			tooltipWidth = $tooltip.outerWidth(),
			tooltipffsetLeft = $tooltip.offset().left,
			sliderWidth = _this.closest('.flex-viewport').outerWidth();

		if(tooltipWidth + tooltipffsetLeft > sliderWidth){
			$tooltip.addClass('rightpos');
		}
		
		_this.closest('.inner-wrap').css('overflow', 'visible');
	});
	
	setTimeout(function(){
		$('.catalog.item-views.table .item .delivery .tooltip').each(function(){
			var _this = $(this),
				textWidth = parseInt(_this.find('>span').width()),
				paddingLeftRight = parseInt(_this.css('padding-left')),
				tooltipWidth = textWidth + paddingLeftRight*2 + 2;
				
			_this.outerWidth(tooltipWidth);
			_this.css('left', -tooltipWidth/2 + 8);
		});
	}, 300);
	
	$(document).on('mouseleave', '.item .delivery', function(){
		var _this = $(this),
			$tooltip = _this.find('.tooltip');
		setTimeout(function(){
			_this.closest('.inner-wrap').css('overflow', 'hidden');
			$tooltip.removeClass('rightpos');
			$tooltip.removeClass('leftpos');
		}, 100);
	});
});