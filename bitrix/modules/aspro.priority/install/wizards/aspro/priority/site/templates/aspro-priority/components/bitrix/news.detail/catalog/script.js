//sly functions start
function initSly(){
	var $frame  = $(document).find('.frame');
	var $slidee = $frame.children('ul').eq(0);
	var $wrap   = $frame.parent();

	$frame.sly({
		horizontal: 1,
		itemNav: 'basic',
		smart: 1,
		mouseDragging: 0,
		touchDragging: 0,
		releaseSwing: 0,
		startAt: 0,
		scrollBar: $wrap.find('.scrollbar'),
		scrollBy: 230,
		speed: 100,
		moveBy:100,
		elasticBounds: 1,
		easing: 'swing',
		dragHandle: 1,
		dynamicHandle: 1,
		clickBar: 1,
		swingSpeed:1,

		// Buttons
		forward: $wrap.find('.forward'),
		backward: $wrap.find('.backward'),
	});
	$frame.sly('reload');
}

function createTableCompare(originalTable, appendDiv, cloneTable){
	try{
		var clone = originalTable.clone().removeAttr('id').addClass('clone');
		if(cloneTable.length){
			cloneTable.remove();
			appendDiv.html('');
			appendDiv.html(clone);
		}else{
			appendDiv.append(clone);
		}
	}
	catch(e){}
	finally{

	}
}
//sly functions end

$(document).ready(function(){
	$('.link-block-more span').on('click', function(){ // scroll to block
		if(!$(this).closest('.flexslider').length){
			if($('.content.wttabs').length){
				var content_offset = $('.content.wttabs').offset().top;
				$('html, body').animate({scrollTop: content_offset - 10}, 400);
			}
			else if($('.detail .tabs').length)
			{
				var content_offset = $('.detail .tabs').offset();
				$('html, body').animate({scrollTop: content_offset.top-100}, 400);
				$('.nav.nav-tabs li:eq('+$('.tab-content #desc').index()+') a').trigger('click');
			}
		}
	});
	
	setBasketItemsClasses();
	$('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
		var _this = $(e.target),
			index = _this.parent().index();

		if(_this.hasClass('gallery-link')) // gallery
		{
			InitFlexSliderClass($('.tab-content .tab-pane:visible').find('.flexslider.bigs'));
			InitFlexSliderClass($('.tab-content .tab-pane:visible').find('.flexslider.small-gallery'));
		}
		else if(_this.hasClass('projects-link')) // projects
		{
			setTimeout(function(){
				$('#projects .projects.item-views .item').sliceHeight();
			},100);
		}
	})
	
	if($('.title-tab-heading').length)
	{
		$('.title-tab-heading').on('click', function(){
			var _this = $(this),
				content_offset = _this.offset();
			if(_this.next().hasClass('gallery-block') || _this.next().hasClass('small-gallery-block'))
			{
				InitFlexSliderClass(_this.next().find('.flexslider.bigs'));
				InitFlexSliderClass(_this.next().find('.flexslider.small-gallery'));
				if(_this.next().hasClass('small-gallery-block'))
				{
					setTimeout(function(){
						$('#gallerys .flexslider .item').sliceHeight({'lineheight': -3});
					},100);
				}
			}
			$('html, body').animate({scrollTop: content_offset.top-100}, 400);
		})
	}
	
	if($('.head-block').length) // tarifs
	{
		$(window).on('resize', function(){
			initSly();
			createTableCompare($('.data_table_props:not(.clone)'), $('.prop_title_table'), $('.data_table_props.clone'));
		});
		$('.head-block .item .body-info .title').sliceHeight({'row': '.head-block .items_view', 'item': '.head-block .items_view .title'});
	}
	
	$('.catalog.detail .head>.maxwidth-theme>.row>.item').sliceHeight();
	
	var reinitProjects = false,
		reinitTarifs = false;
	
	$('.detail .tabs li a[href=#projects], #projects .title-tab-heading').on('click', function(e){
		if(!reinitProjects){
			var _this = $(this);
			setTimeout(function(){
				InitFlexSlider();
				e.stopPropagation();
				// $(window).resize();
				setTimeout(function(){
					_this.closest('.tabs').find('#projects .item-views').removeClass('fixed');
					reinitProjects = true;
				}, 70);
			}, 50);
		}
	});
	
	$('.detail .tabs li a[href=#tarifs], #tarifs .title-tab-heading').on('click', function(){
		if(!reinitTarifs){
			var _this = $(this);
			setTimeout(function(){
				InitFlexSlider();
				// $(window).resize();
				setTimeout(function(){
					_this.closest('.tabs').find('#tarifs .item-views').removeClass('fixed');
					reinitTarifs = true;
				}, 70);
			}, 50);
		}
	});
	
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
		
		setTimeout(function(){
			$('.detail .galerys-block .small-gallery-block .item>.wrap').sliceHeight({'lineheight': -3});
		}, animationTime);
	});
	
	$('.detail .galerys-block .small-gallery-block .item').on('click', function(){
		var $this = $(this),
			index = $this.parent().index();
			
		$this.closest('.galerys-block').find('.switch_gallery').click();
		
		setTimeout(function(){
			$this.closest('.galerys-block').find('.big-gallery-block.flexslider').flexslider(index);
		}, 300);
	});
	
	$('.detail #carousel').flexslider({
		animation: 'slide',
		controlNav: false,
		animationLoop: true,
		slideshow: false,
		itemWidth: 60,
		itemMargin: 12,
		//minItems: 2,
		//maxItems: 3,
		asNavFor: '.detail .galery #slider',
		start: function(){
			$('.catalog.detail .galery .inner').height('auto');
			$('.detail #carousel').css({'width': 'auto', 'opacity': 1});
		}
	});
	
	setTimeout(function(){
		$('.catalog.detail .head .link-block-more').css('opacity', 1);
	}, 300);
});