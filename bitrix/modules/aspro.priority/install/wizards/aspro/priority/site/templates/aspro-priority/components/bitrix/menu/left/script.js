$(document).ready(function(){
	$(document).on('click', '.side-menu .arrow', function(e){
		e.preventDefault();
		openerFunc($(this), '>.hidden-block');
	});
	
	$(document).on('click', '.catalog_opener', function(){
		$(this).closest('.sidebar').find('.side-menu').slideToggle(200);
		$(this).closest('.sidebar').toggleClass('closed');
		var menuClosed = (typeof($.cookie('MENU_CLOSED')) && $.cookie('MENU_CLOSED') == 'Y' ? true : false);
		
		$.cookie('MENU_CLOSED', (menuClosed ? 'N' : 'Y'), {
			path: arPriorityOptions['SITE_DIR'],
			domain: '',
			expires: 360
		});
	});
	
	
	$(document).on('click', '.sidebar .switcher>span', function(){
		var animationTime = 200,
		leftContentClosed = (typeof($.cookie('LEFT_CONTENT_CLOSED')) && $.cookie('LEFT_CONTENT_CLOSED') == 'Y' ? true : false);;
		
		$(this).closest('.switcher').toggleClass('collapsed');
		$('.left-menu-md').toggleClass('hide_blocks');
		if(!$('.body .container .maxwidth-theme').first().hasClass('view_full')){
			$('.catalog_opener, .side-menu, .sidearea').fadeOut(animationTime);
		}
		$('.main-section-wrapper').animate({opacity: 0}, animationTime);
		
		$.cookie('LEFT_CONTENT_CLOSED', (leftContentClosed ? 'N' : 'Y'), {
			path: arPriorityOptions['SITE_DIR'],
			domain: '',
			expires: 360
		});
		
		setTimeout(function(){
			if($('.body .container .maxwidth-theme').first().hasClass('view_full')){
				$('.body .container .maxwidth-theme').first().removeClass('view_full');
				$('.catalog_opener, .side-menu, .sidearea').fadeIn(animationTime);
			}
			else{
				$('.body .container .maxwidth-theme').first().addClass('view_full');
			}
			$('.main-section-wrapper').animate({opacity: 1}, animationTime);
			$('.catalog.item-views.table .item .title').sliceHeight({});
			$('.catalog.item-views.table .item .item .cont').sliceHeight({});
			$('.catalog.item-views.table .item .slice_price').sliceHeight({});
			$('.catalog.item-views.table .item .image>.wrap').sliceHeight({lineheight: -3});
			$('.catalog.item-views.table .item').sliceHeight({classNull: '.footer-button'});			
		}, animationTime);	
	});
});