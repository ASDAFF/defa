$(document).ready(function(){
	if($('.detail .galery-block .flexslider .item').length)
	{
		$('.detail .galery-block .flexslider .item').sliceHeight({lineheight: -3});
		if($('.detail .galery #carousel').length)
		{
			$('.detail .galery #carousel').flexslider({
				animation: 'slide',
				controlNav: false,
				animationLoop: true,
				slideshow: false,
				itemWidth: 77,
				itemMargin: 7.5,
				minItems: 2,
				maxItems: 4,
				asNavFor: '.detail .galery #slider'
			});
		}
	}
	if($('.docs-block .blocks').length)
		$('.docs-block .blocks .inner-wrapper').sliceHeight({'row': '.blocks', 'item': '.inner-wrapper'});
	if($('.projects.item-views').length)
	{
		$('.projects.item-views .item .image').sliceHeight({lineheight: -3});
		$('.projects.item-views .item').sliceHeight();
	}
	
	$('.item-views.fixed.tarifs').removeClass('fixed');
	
	$('.detail .tabs li a[href=#projects], #projects .title-tab-heading').on('click', function(){
		if(!reinitProjects){
			var _this = $(this);
			setTimeout(function(){
				InitFlexSlider();
				// $(window).resize();
				setTimeout(function(){
					_this.closest('.tabs').find('#projects .item-views').removeClass('fixed');
					reinitProjects = true;
				}, 70);
			}, 50);
		}
	});
	
	$('.detail .galerys-block .big-gallery-block .item').sliceHeight({'lineheight': -3});
	
	$('.switch_gallery').on('click', function(){
		var $this = $(this),
			animationTime = 200;
		
		if(!$this.hasClass('small')){
			$this.addClass('small');
			$this.closest('.galerys-block').find('.title.big-gallery').fadeOut(animationTime, function(){
				$this.closest('.galerys-block').find('.title.small-gallery').fadeIn(animationTime);
			});
			
			$this.closest('.galerys-block').find('.big-gallery-block').fadeOut(animationTime, function(){
				$this.closest('.galerys-block').find('.small-gallery-block').fadeIn(animationTime);
			});
		}
		else{
			$this.removeClass('small');
			$this.closest('.galerys-block').find('.title.small-gallery').fadeOut(animationTime, function(){
				$this.closest('.galerys-block').find('.title.big-gallery').fadeIn(animationTime);
			});
			
			$this.closest('.galerys-block').find('.small-gallery-block').fadeOut(animationTime, function(){
				$this.closest('.galerys-block').find('.big-gallery-block').fadeIn(animationTime);
			});
		}
	});
	
	$('.detail .galerys-block .small-gallery-block .item').on('click', function(){
		var $this = $(this),
			index = $this.parent().index();
			
		$this.closest('.galerys-block').find('.switch_gallery').click();
		
		setTimeout(function(){
			$this.closest('.galerys-block').find('.big-gallery-block.flexslider').flexslider(index);
		}, 300);
	});		
});