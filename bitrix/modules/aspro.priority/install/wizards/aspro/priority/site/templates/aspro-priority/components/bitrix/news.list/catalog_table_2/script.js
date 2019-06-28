$(document).ready(function(){
	setBasketItemsClasses();
	$('.catalog.item-views.table .item .props').mCustomScrollbar();
	
	$('.catalog.item-views.table .item .title').sliceHeight({});
	$('.catalog.item-views.table .item .item .cont').sliceHeight({});
	$('.catalog.item-views.table .item .slice_price').sliceHeight({});
	$('.catalog.item-views.table .item .image>.wrap').sliceHeight({lineheight: -3});
	$('.catalog.item-views.table .item').sliceHeight({classNull: '.footer-button'});
	
	$('.catalog.item-views.table .item .delivery .tooltip').each(function(){
		var _this = $(this),
			textWidth = parseInt(_this.find('>span').width()),
			paddingLeftRight = parseInt(_this.css('padding-left')),
			tooltipWidth = textWidth + paddingLeftRight*2 + 2;
			
		_this.outerWidth(tooltipWidth);
		_this.css('left', -tooltipWidth/2 + 8);
	});
	
	$('.item .delivery').mouseenter(function(){
		var _this = $(this),
			$tooltip = _this.find('.tooltip'),
			tooltipWidth = $tooltip.outerWidth(),
			tooltipffsetLeft = $tooltip.offset().left,
			windowWidth = $(window).width();
			
		if(tooltipWidth + tooltipffsetLeft > windowWidth){
			$tooltip.addClass('rightpos');
		}
		
		if(tooltipffsetLeft < 0){
			$tooltip.addClass('leftpos');
		}
		_this.closest('.inner-wrap').css('overflow', 'visible');
	});
	
	$('.item .delivery').mouseleave(function(){
		var _this = $(this),
			$tooltip = _this.find('.tooltip');
		setTimeout(function(){
			_this.closest('.inner-wrap').css('overflow', 'hidden');
			$tooltip.removeClass('rightpos');
			$tooltip.removeClass('leftpos');
		}, 100);
	});
});