getRandomInt = function(min, max){
	return Math.floor(Math.random() * (max - min)) + min;
}

ShowOverlay = function(){
	$('<div class="jqmOverlay waiting"></div>').appendTo('body');
}

HideOverlay = function(){
	setTimeout(function(){
		$('.jqmOverlay').detach();
	}, 300);
}

HideOverlaySwitcher = function(){
	$('.jqmOverlay').detach();
}

CheckTopMenuDotted = function(){
	var menu = $('nav.mega-menu.sliced');
	/*if(isMobile){
		return;
	}*/

	if(menu.length)
	{
		menu.each(function(){
			var menuMoreItem = $(this).find('td.js-dropdown');
			if($(this).parents('.collapse').css('display') == 'none'){
				return false;
			}

			var block_w = $(this).closest('div').actual('width');
			var	menu_w = $(this).find('table').actual('outerWidth');
			var afterHide = false;

			while(menu_w > block_w) {
				menuItemOldSave = $(this).find('td').not('.nosave').last();
				if(menuItemOldSave.length){
					menuMoreItem.show();
					dropdownClass = (menuItemOldSave.hasClass('full_dropdown') ? 'full_dropdown ' : (menuItemOldSave.hasClass('') ? 'normal_dropdown' : ''));
					menuItemNewSave = '<li class="' + (menuItemOldSave.hasClass('dropdown') ? 'dropdown-submenu ' + dropdownClass : '') + (menuItemOldSave.hasClass('active') ? 'active ' : '') + '" data-hidewidth="' + menu_w + '">' + menuItemOldSave.find('.wrap').html() + '</li>';
					menuItemOldSave.remove();
					menuMoreItem.find('> .wrap > .dropdown-menu').prepend(menuItemNewSave);
					menu_w = $(this).find('table').actual('outerWidth');
					afterHide = true;
				}
				else{
					break;
				}
			}

			if(!afterHide) {
				do {
					var menuItemOldSaveCnt = menuMoreItem.find('.dropdown-menu li').length;
					menuItemOldSave = menuMoreItem.find('.dropdown-menu li').first();
					if(!menuItemOldSave.length) {
						menuMoreItem.hide();
						break;
					}
					else {
						var hideWidth = menuItemOldSave.attr('data-hidewidth');
						if(hideWidth > block_w) {
							break
						}
						else {
							dropdownClass = (menuItemOldSave.hasClass('full_dropdown') ? 'full_dropdown ' : (menuItemOldSave.hasClass('') ? 'normal_dropdown' : ''));
							menuItemNewSave = '<td class="' + (menuItemOldSave.hasClass('dropdown-submenu') ? 'dropdown ' + dropdownClass : '') + (menuItemOldSave.hasClass('active') ? 'active ' : '') + '" data-hidewidth="' + block_w + '"><div class="wrap">' + menuItemOldSave.html() + '</div></td>';
							menuItemOldSave.remove();
							$(menuItemNewSave).insertBefore($(this).find('td.js-dropdown'));
							if(!menuItemOldSaveCnt) {
								menuMoreItem.hide();
								break;
							}
						}
					}
					menu_w = $(this).find('table').actual('outerWidth');
				}
				while(menu_w <= block_w);
			}
			$(this).find('td').css('visibility', 'visible');
			$(this).find('td').removeClass('unvisible');
			$(this).find('td.full_dropdown').mouseover(function(){
				$(this).find('.dropdown-submenu>.menu_body>.dropdown-menu').each(function(){
					$(this).find('li:not(.more_items):visible').last().find('.separator').css('opacity', 0);
				});
			});
		})
	}
	return false;
}

CheckTopVisibleMenu = function(that) {
	var dropdownMenu = $('.dropdown-menu:visible').last();

	if(dropdownMenu.length){
		dropdownMenu.find('a').css('white-space', '');
		dropdownMenu.css('left', '');
		dropdownMenu.css('right', '');
		dropdownMenu.removeClass('toright');

		var dropdownMenu_left = dropdownMenu.offset().left;
		if(typeof(dropdownMenu_left) != 'undefined'){
			var menu = dropdownMenu.parents('.mega-menu');
			if(!menu.length)
				menu = dropdownMenu.closest('.logo-row');
			var menu_width = menu.outerWidth();
			var menu_left = menu.offset().left;
			var menu_right = menu_left + menu_width;
			var isToRight = dropdownMenu.parents('.toright').length > 0;
			var parentsDropdownMenus = dropdownMenu.parents('.dropdown-menu');
			var isHasParentDropdownMenu = parentsDropdownMenus.length > 0;
			if(isHasParentDropdownMenu){
				var parentDropdownMenu_width = parentsDropdownMenus.first().outerWidth();
				var parentDropdownMenu_left = parentsDropdownMenus.first().offset().left;
				var parentDropdownMenu_right = parentDropdownMenu_width + parentDropdownMenu_left;
			}

			if(parentDropdownMenu_right + dropdownMenu.outerWidth() > menu_right){
				dropdownMenu.find('a').css('white-space', 'normal');
			}

			var dropdownMenu_width = dropdownMenu.outerWidth();
			var dropdownMenu_right = dropdownMenu_left + dropdownMenu_width;

			if(dropdownMenu_right > menu_right || isToRight){
				var addleft = 0;
				addleft = menu_right - dropdownMenu_right;
				if(isHasParentDropdownMenu || isToRight){

					if(menu_left <= dropdownMenu_left - dropdownMenu_width){
					dropdownMenu.css('left', 'auto');
					dropdownMenu.css('right', '100%');
					dropdownMenu.addClass('toright');

					}
				}
				else{
					var dropdownMenu_curLeft = parseInt(dropdownMenu.css('left'));
					dropdownMenu.css('left', (dropdownMenu_curLeft + addleft) + 'px');
				}
			}
		}
	}
}

MegaMenuFixed = function(){
	var animationTime = 150;

	$(document).on('click', '.logo_and_menu-row .burger, #headerfixed .burger', function(){
		$('.mega_fixed_menu').fadeIn(animationTime);
	});

	$(document).on('click', '.mega_fixed_menu .svg.svg-close', function(){
		$(this).closest('.mega_fixed_menu').fadeOut(animationTime);
	});

	$(document).on('click', '.mega_fixed_menu .dropdown-menu .arrow', function(e){
		e.preventDefault();
		e.stopPropagation();
		$(this).closest('.dropdown-submenu').find('.dropdown-menu').slideToggle(animationTime);
		$(this).closest('.dropdown-submenu').toggleClass('opened');
	});
}

CheckPopupTop = function(){
	var popup = $('.jqmWindow.show .popup>.wrap');

	if(popup.length){
		var documentScollTop = $(document).scrollTop();
		var windowHeight = $(window).height();
		var popupTop = parseInt(popup.css('top'));
		var popupHeight = popup.height();

		if(windowHeight >= popupHeight){
			// center
			popupTop = (windowHeight - popupHeight) / 2;
		}
		else{
			if(documentScollTop > documentScrollTopLast){
				// up
				popupTop -= documentScollTop - documentScrollTopLast;
			}
			else if(documentScollTop < documentScrollTopLast){
				// down
				popupTop += documentScrollTopLast - documentScollTop;
			}

			if(popupTop + popupHeight < windowHeight){
				// bottom
				popupTop = windowHeight - popupHeight;
			}
			else if(popupTop > 0){
				// top
				popupTop = 0;
			}
		}
		popup.css('top', popupTop + 'px');
	}
}

CheckMainBannerSliderVText = function(slider){
	if(slider.parents('.banners-big').length){
		var sh = slider.height(),
			headerMenuAndLogoHeight = $('header .logo_and_menu-row').outerHeight(true, true);

		slider.find('.item').each(function() {
			var curSlideTextInner = $(this).find('.text .inner');
			if(curSlideTextInner.length){
				var ith = curSlideTextInner.actual('height');
				var p = (ith >= sh ? 0 : Math.floor((sh - ith + ($(this).closest('.wmix_banner').length || window.matchMedia('(max-width: 991px)').matches ? 0 : headerMenuAndLogoHeight)) / 2));
				curSlideTextInner.css('padding-top', p + 'px');
			}
		});
	}
}

CheckStickyFooter = function() {
	var bodyHeight = $('.body').outerHeight(true, true),
		footeHeight = $('footer').outerHeight(true, true),
		headerHeight = $('header').outerHeight(true, true),
		topHeaderHeight = ($('.top-block').length ? $('.top-block').outerHeight(true, true) : 0),
		panelHeight = ($('#panel').length ? $('#panel').outerHeight(true, true) : 0),
		windowHeight = $(window).height(),
		minBodyHeight = windowHeight - footeHeight - panelHeight - headerHeight - topHeaderHeight;

	$('.body').css('min-height', minBodyHeight);
}

BX.addCustomEvent('onWindowResize', function(eventdata){
	if(!isMobile)
	{
		try{
			CheckStickyFooter();
			ignoreResize.pop();
		}
		catch(e){}
	}
});

verticalAlign = function(class_name){
	if(typeof class_name == "undefined")
		class_name = 'auto_align';
    if($('.'+class_name).length)
    {
	    maxHeight = 0;
	    $('.'+class_name).each(function(){
	        if ($(this).height()> maxHeight){
	            maxHeight = $(this).height();
	        };
	    });
	    $('.'+class_name).each(function(){

	            delta = Math.round((maxHeight - $(this).height())/2);
	            $(this).css({'padding-top': delta+'px', 'padding-bottom': delta+'px'});
	    });
	}
}

getGridSize = function(counts, custom_counts) {
	var z = parseInt($('.body_media').css('top'));
	if(typeof(custom_counts) != 'undefined')
	{
		if(window.matchMedia('(max-width: 700px)').matches)
			return (counts[3] ? counts[3] : counts[2]);
		else if(window.matchMedia('(max-width: 850px)').matches)
			return counts[2];
		else if(window.matchMedia('(max-width: 1100px)').matches)
			return counts[1];
		else
			return counts[0];
	}
	else
	{
		if(window.matchMedia('(max-width: 600px)').matches)
		{
			return (counts[3] ? counts[3] : counts[2]);
		}
		else
			return (z == 2 ? counts[0] : z == 1 ? counts[1] : counts[2]);
	}
}

CheckFlexSlider = function(){
	$('.flexslider:not(.thmb):visible').each(function(){
		var slider = $(this);
		slider.resize();
		var counts = slider.data('flexslider').vars.counts,
			slide_counts = slider.data('flexslider').vars.slide_counts;
		if(typeof(counts) != 'undefined'){
			var cnt = getGridSize(counts, slider.data('flexslider').vars.customGrid);
			var to0 = (cnt != slider.data('flexslider').vars.minItems || cnt != slider.data('flexslider').vars.maxItems || cnt != slider.data('flexslider').vars.move);
			if(to0){
				slider.data('flexslider').vars.minItems = cnt;
				slider.data('flexslider').vars.maxItems = cnt;
				if(typeof(slide_counts) != 'undefined')
					slider.data('flexslider').vars.move = slide_counts;
				else
					slider.data('flexslider').vars.move = cnt;

				slider.flexslider(0);
				slider.resize();
				slider.resize(); // twise!
			}
		}
	});
}

CheckHeaderFixed = function(){
	var header_fixed = $('#headerfixed');
		header = $('header').first();
	if(header_fixed.length){
		if(header.length)
		{
			var isHeaderFixed = false,
				headerCanFix = true,
				headerFixedHeight = header_fixed.actual('outerHeight'),
				headerNormalHeight = header.actual('outerHeight'),
				headerNormalHeight = (header.find('.logo_and_menu-row').css('position') == 'absolute' ? headerNormalHeight + header.find('.logo_and_menu-row').actual('outerHeight') : headerNormalHeight),
				headerDiffHeight = headerNormalHeight - headerFixedHeight,
				mobileBtnMenu = $('.btn.btn-responsive-nav'),
				headerTop = $('#panel:visible').actual('outerHeight');
				topBlock = $('.TOP_HEADER').first();

			if(headerDiffHeight <= 0)
				headerDiffHeight = 0;
			if(topBlock.length)
				headerTop += topBlock.actual('outerHeight');

			$(window).scroll(function(){
				if(!isMobile)
				{
					var scrollTop = $(window).scrollTop();
					headerCanFix = !mobileBtnMenu.is(':visible')/* && !$('.dropdown-menu:visible').length*/;

					var current_is = $('.search-wrapper .search-input:visible'),
						title_search_result = $('.title-search-result.'+current_is.attr('id')),
						pos, pos_input;

					if(!isHeaderFixed)
					{
						if((scrollTop > headerNormalHeight + headerTop) && headerCanFix)
						{
							isHeaderFixed = true;
							header_fixed.css('top', '-' + headerNormalHeight + 'px');
							header_fixed.addClass('fixed');
							// header_fixed.stop(0).animate({top: '0'}, 300);

							header_fixed.animate({top: '0'}, {duration:300, complete:
								function(){}
							});
							CheckTopMenuDotted();
						}
					}
					else if(isHeaderFixed || !headerCanFix)
					{
						if((scrollTop <= headerDiffHeight + headerTop) || !headerCanFix)
						{
							isHeaderFixed = false;
							header_fixed.removeClass('fixed');
						}
					}
				}
			});
		}
	}
}

CheckObjectsSizes = function() {
	$('.container iframe,.container object,.container video').each(function() {
		var height_attr = $(this).attr('height');
		var width_attr = $(this).attr('width');
		if (height_attr && width_attr) {
			$(this).css('height', $(this).outerWidth() * height_attr / width_attr);
		}
	});
}

scrollToTop = function(){
	if(arPriorityOptions['THEME']['SCROLLTOTOP_TYPE'] !== 'NONE'){
		scrollToTopAnimateClassIn = arPriorityOptions.THEME.SCROLLTOTOP_TYPE.indexOf('ROUND') !== -1 ? 'rotateIn' : 'rubberBand';
		scrollToTopAnimateClassOut = arPriorityOptions.THEME.SCROLLTOTOP_TYPE.indexOf('ROUND') !== -1 ? 'rotateOut' : 'flipOutX';
		var _isScrolling = false;
		// Append Button
		$('body').append($('<a />').addClass('scroll-to-top ' + arPriorityOptions['THEME']['SCROLLTOTOP_TYPE'] + ' ' + arPriorityOptions['THEME']['SCROLLTOTOP_POSITION']).attr({'href': '#', 'id': 'scrollToTop'}));
		$scrolltotop = $('#scrollToTop');
		$scrolltotop.click(function(e){
			e.preventDefault();
			$('body, html').animate({scrollTop : 0}, 500);
			return false;
		});
		// Show/Hide Button on Window Scroll event.
		$(window).scroll(function(){
			if(!_isScrolling) {
				_isScrolling = true;
				var bottom = 23,
					scrollVal = $(window).scrollTop(),
					windowHeight = $(window).height();

				var footerOffset = 0;
				if ($('footer').get(0)) {
					footerOffset = $('footer').offset().top;
				}
				if(scrollVal > 150){
					$('#scrollToTop').addClass('visible');
					_isScrolling = false;
				}
				else{
					$('#scrollToTop').removeClass('visible');
					_isScrolling = false;
				}
				CheckScrollToTop();
			}
		});
	}
}

CheckScrollToTop = function(){
	if(arPriorityOptions["THEME"]["SCROLLTOTOP_TYPE"] !== "NONE")
	{
		if(documentScrollTop > 150){
			$scrolltotop.stop(true, true).addClass('visible').addClass('animated');
			if(scrollToTopAnimateClassOut){
				$scrolltotop.removeClass(scrollToTopAnimateClassOut);
			}
			if(scrollToTopAnimateClassIn){
				$scrolltotop.addClass(scrollToTopAnimateClassIn);
			}
		}
		else{
			$scrolltotop.stop(true, true).removeClass('visible');
			if(scrollToTopAnimateClassIn){
				$scrolltotop.removeClass(scrollToTopAnimateClassIn);
			}
			if(scrollToTopAnimateClassOut){
				$scrolltotop.addClass(scrollToTopAnimateClassOut);
			}
		}
	}
	var bottom = 23,
		scrollVal = $(window).scrollTop(),
		windowHeight = $(window).height();
	if($('footer').length)
		var footerOffset = $('footer').offset().top;

	if(scrollVal + windowHeight > footerOffset){
		$('#scrollToTop').css('bottom', bottom + scrollVal + windowHeight - footerOffset);
	}
	else if(parseInt($('#scrollToTop').css('bottom')) > bottom){
		$('#scrollToTop').css('bottom', bottom);
	}
}

var isMobile = jQuery.browser.mobile;
var players = {};

if(isMobile){
	document.documentElement.className += ' mobile';
}

function pauseMainBanner(){
	$('.banners-big .flexslider').flexslider('pause');
}

function playMainBanner(){
	$('.banners-big .flexslider').flexslider('play');
}

function startMainBannerSlideVideo($slide){
	var slideActiveIndex = $slide.attr('data-slide_index');
	var $slides = $slide.closest('.items').find('.item[data-slide_index="'+ slideActiveIndex +'"]'); // current slide & cloned
	var videoSource = $slide.attr('data-video_src');
	if(videoSource){
		if(!$slides.hasClass('started'))
			$slides.addClass('loading')
		pauseMainBanner()

		var videoPlayerSrc = $slide.attr('data-video_src')
		var videoSoundDisabled = $slide.attr('data-video_disable_sound')
		var bVideoSoundDisabled = videoSoundDisabled == 1
		var videoLoop = $slide.attr('data-video_loop')
		var bVideoLoop = videoLoop == 1
		var videoCover = $slide.attr('data-video_cover')
		var bVideoCover = videoCover == 1 // && !isMobile
		var videoUnderText = $slide.attr('data-video_under_text')
		var bVideoUnderText = videoUnderText == 1
		var videoPlayer = $slide.attr('data-video_player')
		var bVideoPlayerYoutube = videoPlayer === 'YOUTUBE'
		var bVideoPlayerVimeo = videoPlayer === 'VIMEO'
		var bVideoPlayerRutube = videoPlayer === 'RUTUBE'
		var bVideoPlayerHtml5 = videoPlayer === 'HTML5'

		if(videoPlayerSrc && !$slide.find('.video').length){
			var InitPlayer = function(){
				$slides.each(function(i, node){
					var $_slide = $(node);
					var videoID = getRandomInt(100, 1000);
					var bClone = $_slide.hasClass('clone')

					if(bVideoPlayerYoutube){
						$_slide.prepend('<iframe id="player_' + videoID + '" class="video' + (bVideoCover ? ' cover' : '') + '" src="'+ videoPlayerSrc +'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
					}
					else if(bVideoPlayerVimeo){
						$_slide.prepend('<iframe id="player_' + videoID + '" class="video' + (bVideoCover ? ' cover' : '') + '" src="'+ videoPlayerSrc +'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
					}
					else if(bVideoPlayerRutube){
						videoPlayerSrc = videoPlayerSrc + '&playerid=' + videoID;
						$_slide.prepend('<iframe id="player_' + videoID + '" class="video' + (bVideoCover ? ' cover' : '') + '" src="'+ videoPlayerSrc +'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
					}
					else if(bVideoPlayerHtml5){
						$_slide.prepend('<video autobuffer playsinline webkit-playsinline id="player_' + videoID + '" class="video' + (bVideoCover ? ' cover' : '') + '"' + (bVideoLoop ? ' loop ' : '') + (bVideoSoundDisabled || bClone ? ' muted ' : '') + '><source src="'+ videoPlayerSrc +'" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\' /><p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that supports HTML5 video</p></video>');
					}

					if(typeof(players) !== 'undefined' && players){
						players[videoID] = {
							id: 'player_' + videoID,
							mute: bVideoSoundDisabled || bClone,
							loop: bVideoLoop,
							cover: bVideoCover,
							videoPlayer: videoPlayer,
							slideIndex: slideActiveIndex,
							clone: bClone,
							playing: false
						};
						if(bVideoPlayerYoutube){
							window[players[videoID].id] = new YT.Player(
								players[videoID].id, {
									events: {
										'onReady': onYoutubePlayerReady,
										'onStateChange': onYoutubePlayerStateChange
									}
								}
							);
						}
						else if(bVideoPlayerVimeo){
						    window[players[videoID].id] = new Vimeo.Player(document.getElementById(players[videoID].id), {autopause: false, byline: false, loop: false, title: false});
						    window[players[videoID].id].on('loaded', onVimeoPlayerReady)
						    window[players[videoID].id].on('play', onVimeoPlayerStateChange)
						    window[players[videoID].id].on('pause', onVimeoPlayerStateChange)
						    window[players[videoID].id].on('ended', onVimeoPlayerStateChange)
						}
						else if(bVideoPlayerRutube){
							document.getElementById(players[videoID].id).onload = function(e){
								var videoID = this.id.replace('player_', '')
								players[videoID].contentWindow = this.contentWindow
								onRutubePlayerReady(videoID)
							}
						}
						else if(bVideoPlayerHtml5){
							document.getElementById(players[videoID].id).addEventListener('loadeddata', onHtml5PlayerReady)
							document.getElementById(players[videoID].id).addEventListener('play', onHtml5PlayerStateChange)
							document.getElementById(players[videoID].id).addEventListener('pause', onHtml5PlayerStateChange)
							document.getElementById(players[videoID].id).addEventListener('ended', onHtml5PlayerStateChange)
						}
					}
				});
			}

			if(!bVideoPlayerHtml5){
				var obPlayerVariable = ''
				var fnPlayerVariable = ''
				if(typeof window['YoutubePlayerScriptLoaded'] === 'undefined'){
					window['YoutubePlayerScriptLoaded'] = false
				}
				if(typeof window['VimeoPlayerScriptLoaded'] === 'undefined'){
					window['VimeoPlayerScriptLoaded'] = false
				}
				if(typeof window['RutubePlayerListnersAdded'] === 'undefined'){
					window['RutubePlayerListnersAdded'] = false
				}

				// load script
				if(bVideoPlayerYoutube){
					obPlayerVariable = 'YT'
					fnPlayerVariable = 'Player'
					if(!window['YoutubePlayerScriptLoaded']){
						var script = document.createElement('script');
						script.src = "https://www.youtube.com/iframe_api";
						var firstScriptTag = document.getElementsByTagName('script')[0];
						firstScriptTag.parentNode.insertBefore(script, firstScriptTag);
						window['YoutubePlayerScriptLoaded'] = true;
					}
				}
				else if(bVideoPlayerVimeo){
					obPlayerVariable = 'Vimeo'
					if(!window['VimeoPlayerScriptLoaded']){
						var script = document.createElement('script');
						script.src = 'https://player.vimeo.com/api/player.js';
						(document.head || document.documentElement).appendChild(script);
						window['VimeoPlayerScriptLoaded'] = true
					}
				}
				else if(bVideoPlayerRutube){
					if(!window['RutubePlayerListnersAdded']){
						window.addEventListener('message', function(e){
							if(e.origin.indexOf('rutube.ru') !== -1){
							    var message = JSON.parse(e.data)
							    if(typeof message === 'object' && message){
							    	if(typeof message.type !== 'undefined' && message.type){
							    		var videoID = false

							    		for(var j in players){
									    	if(typeof players[j].contentWindow !== 'undefined'){
									    		if(players[j].contentWindow == e.source){
									    			videoID = j
									    			break
									    		}
									    	}
									    }

									    if(videoID){
										    switch (message.type) {
										        case 'player:changeState':
										            onRutubePlayerStateChange(videoID, message.data.state)
										            break
										        case 'player:currentTime':
										            onRutubePlayerCurrentTime(videoID, message.data.time)
										            break
										    }
										}
									}
							    }
							}
						});
					}
				}

				if(!obPlayerVariable.length){
					InitPlayer()
				}
				else{
					// wait player class
					if(typeof window[obPlayerVariable] === 'object'){
						if(!fnPlayerVariable.length || (fnPlayerVariable.length && typeof window[obPlayerVariable][fnPlayerVariable] === 'function')){

							InitPlayer()
						}
					}
					else{
						var waitPlayerInterval = setInterval(function(){
							if(typeof window[obPlayerVariable] === 'object'){
								if(!fnPlayerVariable.length || (fnPlayerVariable.length && typeof window[obPlayerVariable][fnPlayerVariable] === 'function')){

									clearInterval(waitPlayerInterval)

									InitPlayer()
								}
							}
						}, 50)
					}
				}

			}
			else{
				InitPlayer();
			}
		}
		else{
			// pause play video
			if(typeof(players) !== 'undefined' && players){
				for(var j in players){
					if(/*players[j].playing &&*/ !players[j].clone/* && (players[j].slideIndex != curSlideIndex)*/){
						if((typeof window[players[j].id] == 'object')){
							if(players[j].playing)
							{
								if(players[j].videoPlayer === 'YOUTUBE'){
									window[players[j].id].pauseVideo()
								}
								else if(players[j].videoPlayer === 'VIMEO'){
									window[players[j].id].pause()
								}
								else if(players[j].videoPlayer === 'RUTUBE'){
									document.getElementById(players[j].id).contentWindow.postMessage(JSON.stringify({
									    type: 'player:pause',
									    data: {}
									}), '*')
								}
								else if(players[j].videoPlayer === 'HTML5'){
									document.getElementById(players[j].id).pause()
								}
							}
							else if(players[j].slideIndex == slideActiveIndex)
							{
								if(players[j].videoPlayer === 'YOUTUBE'){
									window[players[j].id].playVideo()
								}
								else if(players[j].videoPlayer === 'VIMEO'){
									window[players[j].id].play()
								}
								else if(players[j].videoPlayer === 'RUTUBE'){
									document.getElementById(players[j].id).contentWindow.postMessage(JSON.stringify({
									    type: 'player:play',
									    data: {}
									}), '*')
								}
								else if(players[j].videoPlayer === 'HTML5'){
									//document.getElementById(players[j].id).play()
								}
							}
						}
					}
				}
			}
		}
	}
}

var CoverPlayerHtml = function(){
	var $videoCover = $('.video.cover');

	if($videoCover.length){
		//setTimeout(function(){
			var bannersHeight = $('.banners-big').height();
			var bannersWidth = $('.banners-big').width();
			var videoHeight = $('.banners-big video').outerHeight();
			var videoWidth = $('.banners-big video').outerWidth();

			if(bannersHeight >= videoHeight && videoWidth >= bannersWidth){
				$('.banners-big video').height(bannersHeight).width('auto');
				$('.banners-big .wvideo').css('background-position-x', 'auto');

			}
			else if(bannersHeight < videoHeight && videoWidth < bannersWidth){
				$('.banners-big video').width(bannersWidth).height('auto');
				$('.banners-big .wvideo').css('background-position-y', 'auto');
			}

			if(window.matchMedia('(min-width:992px)').matches){
				//setTimeout(function(){
					$('.banners-big video').css('margin-top', -videoHeight/2);
					var bannerWidth = $('.banners-big video').width();
					$('.banners-big video').css('margin-left', -bannerWidth/2 + (isMobile ? 42 : 0));

				//}, 300);
			}
			else{
				$('.banners-big video').css('margin-top', 0);
			}
			setTimeout(function(){
				$('.video.cover').css('visibility', 'visible');
			}, 1300);
		//}, 10);
	}
}

var CoverPlayer = function(){
	var $videoCover = $('.video.cover')
	if($videoCover.length){
		var bannersHeight = $('.banners-big').height()
		var bannersWidth = $('.banners-big').width()
		var windowWidth = $(window).width()
		var height = windowWidth * 9 / 16
		$videoCover.css({'height': height + 'px', 'margin-top': ((bannersHeight - height) / 2) + 'px'})
	}
}

function onYoutubePlayerReady(e) {
	var videoID = e.target.a.id.replace('player_', '')
	if(videoID){
		var mute = players[videoID].mute
		var cover = players[videoID].cover
    	var clone = players[videoID].clone

    	// mute sound
		if(mute || clone){
			window[players[videoID].id].mute()
		}

    	// cover video
		if(cover){
	    	CoverPlayer()
	    }

    	// not start clone video playing
    	if(clone){
    		setTimeout(function(){
				e.target.pauseVideo()
    		}, 100)
    	}
    	else{
		    // stop slider
			pauseMainBanner()
		    e.target.playVideo()
    	}

    	// update slide class
		var $slide = $('#player_' + videoID).closest('.item')
		$slide.addClass('started')
		$slide.removeClass('loading')
    }
}

function onYoutubePlayerStateChange(e){
	var videoID = e.target.a.id.replace('player_', '')
    if(videoID){
    	var clone = players[videoID].clone
		var loop = players[videoID].loop
    	var slideIndex = players[videoID].slideIndex

    	if(!clone){
			if(e.data === YT.PlayerState.PLAYING){
				players[videoID].playing = true

				// stop slider
				pauseMainBanner()
			}
			else if(e.data === YT.PlayerState.PAUSED){
		    	players[videoID].playing = false

		    	// sync time in cloned players & pause
	    		var time = Math.floor(window[players[videoID].id].getCurrentTime() * 10) / 10
				window[players[videoID].id].seekTo(time, true)
				for(var j in players){
					if(players[j].slideIndex == slideIndex && players[j].clone){
						window[players[j].id].pauseVideo()
						window[players[j].id].seekTo(time, true)
					}
				}
			}
			else if(e.data === YT.PlayerState.ENDED){
				players[videoID].playing = false
		    	if(loop){
		    		e.target.playVideo()
		    	}
		    	else{
		    		// play slider
					playMainBanner()
		    	}
			}
		}
	}
}

function onVimeoPlayerReady(e){
	var videoID = this.element.id.replace('player_', '')
	if(videoID){
		var mute = players[videoID].mute
		var cover = players[videoID].cover
    	var clone = players[videoID].clone

    	// mute sound
		if(mute || clone){
			window[players[videoID].id].setVolume(0)
		}

    	// cover video
		if(cover){
			CoverPlayer()
	    }

    	// not start clone video playing
    	if(clone){
    		setTimeout(function(){
				window[players[videoID].id].pause()
    		}, 100)
    	}
    	else{
		    // stop slider
			pauseMainBanner()

		    window[players[videoID].id].play()
    	}

    	// update slide class
		var $slide = $('#player_' + videoID).closest('.item')
		$slide.addClass('started')
		$slide.removeClass('loading')
    }
}

function onVimeoPlayerStateChange(e){
	var videoID = this.element.id.replace('player_', '')
	if(videoID){
		var cover = players[videoID].cover
    	var clone = players[videoID].clone
		var loop = players[videoID].loop
    	var slideIndex = players[videoID].slideIndex

    	if(!clone){
    		window[players[videoID].id].getPaused().then(function(paused){
    			if(paused){
			    	players[videoID].playing = false

			    	// sync time in cloned players & pause
			    	window[players[videoID].id].getCurrentTime().then(function(seconds){
			    		var time = Math.floor(seconds * 10) / 10
			    		window[players[videoID].id].setCurrentTime(time).then(function(seconds){
							for(var j in players){
								if(players[j].slideIndex == slideIndex && players[j].clone){
									window[players[j].id].pause()
									window[players[j].id].setCurrentTime(time).then(function(seconds){})
								}
							}
			    		})
			    	})
    			}
    			else{
		    		window[players[videoID].id].getEnded().then(function(ended){
		    			if(ended){
							players[videoID].playing = false
					    	if(loop){
					    		window[players[videoID].id].play()
					    	}
					    	else{
					    		// play slider
								playMainBanner()
					    	}
		    			}
		    			else{
		    				players[videoID].playing = true

		    				// stop slider
							pauseMainBanner()
		    			}
		    		})
    			}
    		})
		}
	}
}

function onRutubePlayerReady(videoID){
	if(videoID){
		var mute = players[videoID].mute
		var cover = players[videoID].cover
    	var clone = players[videoID].clone
    	var player = document.getElementById(players[videoID].id)

    	// mute sound
		if(mute || clone){
			player.contentWindow.postMessage(JSON.stringify({
			    type: 'player:mute',
			    data: {}
			}), '*')
		}

    	// cover video
		if(cover){
	    	CoverPlayer()
	    }

    	// not start clone video playing
    	if(clone){
    		setTimeout(function(){
				player.contentWindow.postMessage(JSON.stringify({
				    type: 'player:pause',
				    data: {}
				}), '*')
    		}, 100)
    	}
    	else{
		    // stop slider
			pauseMainBanner()

		    player.contentWindow.postMessage(JSON.stringify({
			    type: 'player:play',
			    data: {}
			}), '*')
    	}

    	// update slide class
		var $slide = $('#player_' + videoID).closest('.item')
		$slide.addClass('started')
		$slide.removeClass('loading')
    }
}

function onRutubePlayerCurrentTime(videoID, time){
	if(videoID){
		players[videoID].time = time
	}
}

function onRutubePlayerStateChange(videoID, state){
	if(videoID){
    	var clone = players[videoID].clone
		var loop = players[videoID].loop
    	var slideIndex = players[videoID].slideIndex
    	var player = document.getElementById(players[videoID].id)

    	if(!clone){
			if(state === 'playing'){
				players[videoID].playing = true

				// stop slider
				pauseMainBanner()
			}
			else if(state === 'paused'){
		    	players[videoID].playing = false

		    	// sync time in cloned players & pause
	    		var time = Math.floor(players[videoID].time * 10) / 10
				player.contentWindow.postMessage(JSON.stringify({
				    type: 'player:setCurrentTime',
				    data: {time: time}
				}), '*')
				for(var j in players){
					if(players[j].slideIndex == slideIndex && players[j].clone){
						document.getElementById(players[j].id).contentWindow.postMessage(JSON.stringify({
						    type: 'player:pause',
						    data: {}
						}), '*')
						document.getElementById(players[j].id).contentWindow.postMessage(JSON.stringify({
						    type: 'player:setCurrentTime',
						    data: {time: time}
						}), '*')
					}
				}
			}
			else if(state === 'stopped'){
				players[videoID].playing = false
		    	if(loop){
		    		player.contentWindow.postMessage(JSON.stringify({
					    type: 'player:play',
					    data: {}
					}), '*')
		    	}
		    	else{
		    		// play slider
					playMainBanner()
		    	}
			}
		}
	}
}

function onHtml5PlayerReady(e){
	var videoID = e.target.id.replace('player_', '')
	if(videoID){
		var mute = players[videoID].mute
		var cover = players[videoID].cover
    	var clone = players[videoID].clone

    	// mute sound
		if(mute || clone){
			$('#' + players[videoID].id).prop('muted', true);
		}

    	// cover video
		if(cover){
	    	CoverPlayerHtml()
	    }

    	// not start clone video playing
    	if(clone){
    		e.target.pause()
    	}
    	else{
		    // stop slider
			pauseMainBanner()

		    //e.target.play()
    	}

    	// update slide class
		var $slide = $('#player_' + videoID).closest('.item')
		$slide.addClass('started')

		//if(jQuery.browser.safari){
			setTimeout(function(){
				$slide.removeClass('loading');
			}, 1300);
		/*}
		else{
			$slide.removeClass('loading')
		}*/
    }
}

function onHtml5PlayerStateChange(e){
	var videoID = e.target.id.replace('player_', '')
	if(videoID){
    	var cover = players[videoID].cover
    	var clone = players[videoID].clone
		var loop = players[videoID].loop
    	var slideIndex = players[videoID].slideIndex

    	if(!clone){
			if(e.target.paused){
		    	players[videoID].playing = false

		    	// sync time in cloned players & pause
	    		var time = Math.floor(e.target.currentTime * 10) / 10
				e.target.currentTime = time
				for(var j in players){
					if(players[j].slideIndex == slideIndex && players[j].clone){
						document.getElementById(players[j].id).pause()
						document.getElementById(players[j].id).currentTime = time
					}
				}

			}
			else if(e.target.ended){
				players[videoID].playing = false
		    	if(loop){
		    		//e.target.play()
		    	}
		    	else{
		    		// play slider
					playMainBanner()
		    	}
			}
			else{
				players[videoID].playing = true

				// stop slider
				pauseMainBanner()
			}
		}
	}
}

$.fn.equalizeHeights = function( outer, classNull, minHeight, autoHeightBlock ){
	var maxHeight = this.map( function( i, e ){
		var minus_height=0,
			calc_height=0;
		if(classNull !== false && $(e).find(classNull).is(':visible'))
			minus_height=parseInt($(e).find(classNull).actual('outerHeight'));
		if(minus_height)
			minus_height+=15;
		$(e).css('height', '');
		if(autoHeightBlock !== false)
		{
			var height_tmp = $(e).find(autoHeightBlock).css('height');
			$(e).find(autoHeightBlock).css('height', '');
		}
		if( outer == true ){
			calc_height=$(e).actual('outerHeight')-minus_height;
		}else{
			calc_height=$(e).actual('height')-minus_height;
		}

		if(autoHeightBlock !== false)
		{
			$(e).find(autoHeightBlock).css('height', height_tmp);
		}
		if(minHeight!==false){
			if(calc_height<minHeight){
				calc_height+=(minHeight-calc_height);
			}
			if(window.matchMedia('(max-width: 520px)').matches){
				calc_height=300;
			}
			if(window.matchMedia('(max-width: 400px)').matches){
				calc_height=200;
			}
		}
		return calc_height;
	}).get();

	for(var i = 0, c = maxHeight.length; i < c; ++i){
		if(maxHeight[i] % 2){
			--maxHeight[i];
		}
	}

	return this.height( Math.max.apply( this, maxHeight ) );
}

$.fn.getFloatWidth = function(){
	var width = 0

	if($(this).length){
		var rect = $(this)[0].getBoundingClientRect()
		if(!(width = rect.width)){
			width = rect.right - rect.left
		}
	}

	return width
}

$.fn.sliceHeightRandomWidth = function(options){
	function _slice(arElements){
		if(arElements.length){
			arElements.css({height: '', 'line-height': ''});
			if(options.slice){
				for(var i = 0; i < arElements.length; i += options.slice){
					$(arElements.slice(i, i + options.slice)).equalizeHeights(options.outer);
				}
			}
			else{
				var row = (typeof(options.row) !== 'undefined' && options.row.length) ? arElements.first().parents(options.row).first() : ((tmp = arElements.first().parents('.row').first()).length ? tmp : arElements.first().parents('.items').first());
				if(row.length){
					var rowWidth = row.getFloatWidth();
					var itemsWidth = 0;
					var arElementsToSlice = [];
					for(var i = 0, cnt = arElements.length; i <= cnt; ++i){
						if(i !== cnt){
							var element = $(arElements[i]);
							var item = (options.exact ? element : (element.hasClass('item') ? element : ((tmp = element.parents('.item').first()).length ? tmp : element)));
							var itemWidth = item.getFloatWidth() + parseInt(item.css('margin-left')) + parseInt(item.css('margin-right'));
						}

						if(((itemsWidth + itemWidth) > rowWidth) || (i === cnt)){
							if(arElementsToSlice.length){
								$(arElementsToSlice).equalizeHeights(options.outer);
							}
							itemsWidth = 0;
							arElementsToSlice = [];
						}

						if(((itemsWidth += itemWidth) <= rowWidth) && (i !== cnt)){
							if(options.excludeClass.length){
								if(!item.is(options.excludeClass)){
									arElementsToSlice.push(arElements[i]);
								}
							}
							else{
								arElementsToSlice.push(arElements[i]);
							}
						}
					}
				}
			}

			if(options.lineheight){
				var lineheightAdd = parseInt(options.lineheight);
				if(isNaN(lineheightAdd)){
					lineheightAdd = 0;
				}
				arElements.each(function(){
					$(this).css('line-height', ($(this).actual('height') + lineheightAdd) + 'px');
				});
			}
		}
	}

	var options = $.extend({
		slice: null,
		outer: false,
		lineheight: false,
		bindOnResize: true,
		liveClass: '',
		excludeClass: '',
		exact: false,
		id: false
	}, options);

	var arElements = $(this);
	ignoreResize.push(true);
	_slice(arElements);
	ignoreResize.pop();

	if(options.bindOnResize && (arElements.length || options.liveClass.length)){
		BX.addCustomEvent('onWindowResize', function(eventdata){
			ignoreResize.push(true);
			if(options.liveClass.length){
				arElements = $(options.liveClass);
			}
			_slice(arElements);
			ignoreResize.pop();
		});
	}
}

$.fn.sliceHeight = function( options ){
	function _slice(el){
		/*el.each(function() {
			$(this).css('line-height', '');
			$(this).css('height', '');
		});*/

		el.css({'line-height': '', 'height': ''});

		if(options.allElements == false){
			if(typeof(options.autoslicecount) == 'undefined' || options.autoslicecount !== false)
			{
				var elsw=(typeof(options.row) !== 'undefined' && options.row.length) ?  el.first().closest(options.row).getFloatWidth() : el.first().closest('.items').getFloatWidth(),
					elw=(typeof(options.item) !== 'undefined' && options.item.length) ? $(options.item).first().getFloatWidth() : (el.first().hasClass('item') ? el.first().getFloatWidth() : el.first().closest('.item').getFloatWidth());

				if(!elsw){
					elsw = el.first().closest('.row').getFloatWidth();
				}
				if(elw && options.fixWidth)
					elw -= options.fixWidth;

				if(elsw && elw){
					options.slice = Math.floor(elsw / elw);
				}
			}
		}
		else{
			options.slice = (typeof(options.item) !== 'undefined' && options.item.length) ? $(options.item).length : (el.first().hasClass('item') ? el.length : el.first().closest('.item').parent().children().length);
		}

		if(typeof(options.typeResize) == 'undefined' || options.typeResize == false)
		{
			if(options.sliceEqualLength && el.closest('.flexslider').length)
				options.slice = el.length;
			if(options.slice){
				for(var i = 0; i < el.length; i += options.slice){
					$(el.slice(i, i + options.slice)).equalizeHeights(options.outer, options.classNull, options.minHeight, options.autoHeightBlock);
				}
			}
			if(options.lineheight){
				var lineheightAdd = parseInt(options.lineheight);
				if(isNaN(lineheightAdd)){
					lineheightAdd = 0;
				}
				el.each(function() {
					$(this).css('line-height', ($(this).actual('height') + lineheightAdd) + 'px');
				});
			}
		}

		if(typeof options.callback == 'function')
			options.callback(el);

	}
	var options = $.extend({
		slice: null,
		outer: false,
		lineheight: false,
		autoslicecount: true,
		classNull: false,
		minHeight: false,
		row:false,
		item:false,
		typeResize:false,
		resize:true,
		typeValue:false,
		sliceEqualLength:false,
		fixWidth:0,
		callback:false,
		autoHeightBlock:false,
		allElements:false,
	}, options);

	var el = $(this);
	ignoreResize.push(true);
	_slice(el);
	ignoreResize.pop();

	if(options.resize != false)
	{
		BX.addCustomEvent('onWindowResize', function(eventdata) {
			ignoreResize.push(true);
			_slice(el);
			ignoreResize.pop();
		});
	}
}

sliceProps = function(){
	var arPropertyHeight = [];
	$('.item-views.tarifs .property').height('auto');

	$('.item-views.tarifs .dynamic-block .property').each(function(indx){
		arPropertyHeight[indx] = $(this).outerHeight();
	});

	$('.item-views.tarifs .item').each(function(){
		$(this).find('.property').each(function(indx){
			var _this = $(this),
				height = _this.outerHeight();

			if(height > arPropertyHeight[indx]){
				arPropertyHeight[indx] = height;
			}
		});
	});

	$('.item-views.tarifs .properties .property').each(function(indx){
		$(this).outerHeight(arPropertyHeight[$(this).index()]);
	});
}

waitingExists = function(selector, delay, callback){
	if(typeof(callback) !== 'undefined' && selector.length && delay > 0){
		delay = parseInt(delay);
		delay = (delay < 0 ? 0 : delay);

		if(!$(selector).length){
			setTimeout(function(){
				waitingExists(selector, delay, callback);
			}, delay);
		}
		else{
			callback();
		}
	}
}

waitingNotExists = function(selectorExists, selectorNotExists, delay, callback){
	if(typeof(callback) !== 'undefined' && selectorExists.length && selectorNotExists.length && delay > 0){
		delay = parseInt(delay);
		delay = (delay < 0 ? 0 : delay);

		setTimeout(function(){
			if(selectorExists.length && !$(selectorNotExists).length){
				callback();
			}
		}, delay);
	}
}

function onLoadjqm(hash){
	if($('textarea').length){
		$('textarea').each(function(){
			$(this).autoResize();
		});
	}

	if($('#licenses_popup').length){
		setTimeout(function(){
			$('#licenses_popup').onoff();
		}, 500);
	}

	var name = $(hash.t).data('name'),
		top = (($(window).height() > hash.w.height()) ? Math.floor(($(window).height() - hash.w.height()) / 2) : 0) + 'px';
	$.each($(hash.t).get(0).attributes, function(index, attr){
		if(/^data\-autoload\-(.+)$/.test(attr.nodeName)){
			var key = attr.nodeName.match(/^data\-autoload\-(.+)$/)[1];
			var el = $('input[name="'+key.toUpperCase()+'"]');
			if(!el.length) //is form block
				el = $('input[data-sid="'+key.toUpperCase()+'"]');
			el.val(BX.util.htmlspecialcharsback($(hash.t).data('autoload-'+key))).attr('readonly', 'readonly');
			el.closest('.form-group').addClass('input-filed');
			el.attr('title', el.val());
		}
	});

	var eventdata = {action:'loadForm'};
	BX.onCustomEvent('onCompleteAction', [eventdata, $(hash.t)[0]]);

	if($(hash.t).data('autohide')){
		$(hash.w).data('autohide', $(hash.t).data('autohide'));
	}
	if(name == 'order_product'){
		if($(hash.t).data('product')) {
			$('input[name="PRODUCT"]').closest('.form-group').addClass('input-filed');
			$('input[name="PRODUCT"]').val($(hash.t).data('product')).attr('readonly', 'readonly').attr('title', $('input[name="PRODUCT"]').val());
		}
	}
	if(name == 'question'){
		if($(hash.t).data('product')) {
			$('input[name="NEED_PRODUCT"]').closest('.form-group').addClass('input-filed');
			$('input[name="NEED_PRODUCT"]').val($(hash.t).data('product')).attr('readonly', 'readonly').attr('title', $('input[name="NEED_PRODUCT"]').val());
		}
	}

	if(arPriorityOptions['THEME']['FORM_TYPE'] == 'LATERAL'){
		var dataName = $(hash.t).data('name');
		if(hash.o.length){
			hash.o.addClass('dark');
		}

		if($('.jqmOverlay').length){
			$('.jqmOverlay').click().remove();
			$('.jqmWindow:visible').removeClass('opened');
			$('.fly_forms').removeClass('opened');
		}
		$('.jqmWindow').addClass('right_slide');
		if($('.ajax_basket').hasClass('opened')){
			$('.ajax_basket').removeClass('opened');
		}

		$('.fly_forms').addClass('showen');

		setTimeout(function(){
			if($('.jqmWindow.right_slide').length){
				$('.jqmWindow.right_slide .popup>.wrap').mCustomScrollbar({
					mouseWheel: {preventDefault: true},
					advanced: {autoScrollOnFocus: false},
				});
			}

			if($('.jqmWindow.right_slide .subscribe-edit-main')){
				$('.jqmWindow.right_slide .subscribe-edit-main').mCustomScrollbar({
					mouseWheel: {preventDefault: true},
					advanced: {autoScrollOnFocus: false},
				})
			}

			if($('#licenses_subscribe').length){
				$('#licenses_subscribe').onoff();
			}

			$('.jqmWindow').addClass('opened opacity1');
			$('.fly_forms').addClass('opened');
			if($(hash.t).closest('.fly_forms').length){
				$(hash.t).addClass('disabled');
			}
			if($('.fly_forms .button span[data-name='+dataName+']').length){
				$('.fly_forms .button span[data-name='+dataName+']').addClass('disabled');
			}

			if($('.jqmWindow.map_frame .bx-yandex-view-map').length){
				setTimeout(function(){
					$('.jqmWindow.map_frame .bx-yandex-view-map').css('opacity', 1);
				}, 350);
			}
		}, 450);
	}
	else{
		var scaleValue = retrieveScale($('.cd-modal-bg'));
		setTimeout(function(){
			$('.cd-modal-bg').show();
			$('.cd-modal-bg').addClass('is-visible');
			$('.cd-modal-bg').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				animateLayer($('.cd-modal-bg'), scaleValue, true);
			});
		}, 100);

		if($('.ajax_basket').hasClass('opened')){
			$('.basket.fly .opener').click();
		}

		setTimeout(function(){
			hash.w.addClass('show').css({'opacity': 1});
			$('.jqmOverlay').addClass('popup_form');
			$('.jqmOverlay').show();
			$(window).resize();
			$('.cd-modal-bg').hide();
			if($('.jqmWindow.map_frame .bx-yandex-view-map').length){
				setTimeout(function(){
					$('.jqmWindow.map_frame .bx-yandex-view-map').css('opacity', 1);
				}, 400);
			}
		}, 500);
	}

	//hash.w.addClass('show').css({'opacity': 1});
	if(arPriorityOptions['THEME']['FORM_TYPE'] != 'LATERAL'){
		hash.w.find('.popup>.wrap').css('top', top);
	}
	$('.style-switcher').hide();
}

function onHide(hash){
	if($(hash.w).data('autohide')){
		eval($(hash.w).data('autohide'));
	}
	// hash.w.css('opacity', 0).hide();

	hash.w.animate({'opacity': 0}, 200, function(){
		hash.w.hide();
		hash.w.empty();
		hash.o.remove();
		hash.w.removeClass('show');
	});
	if(arPriorityOptions['THEME']['FORM_TYPE'] == 'LATERAL'){
		$('.fly_forms .disabled').removeClass('disabled');

		$('.jqmWindow ').removeClass('opened');
		$('.fly_forms').removeClass('opened').removeClass('showen');
	}
	else{
		closeModal();
	}
	$('.style-switcher').show();

	if($(hash.w).hasClass('map_frame') && typeof(map) !== 'undefined' && map && $('.map_frame .bx-yandex-view-map').length){
		map.destroy();
	}
}

function parseUrlQuery() {
	var data = {};
	if(location.search) {
		var pair = (location.search.substr(1)).split('&');
		for(var i = 0; i < pair.length; i ++) {
			var param = pair[i].split('=');
			data[param[0]] = param[1];
		}
	}
	return data;
}

function scroll_block(block){
	if(block.length)
	{
		var topPos = block.offset().top,
			headerH = $('header').outerHeight(true,true);
		if($(".stores_tab").length){
			$(".stores_tab").addClass("active").siblings().removeClass("active");
		}else{
			$(".prices_tab").addClass("active").siblings().removeClass("active");
			if($(".prices_tab .opener").length && !$(".prices_tab .opener .opened").length){
				var item = $(".prices_tab .opener").first();
				item.find(".opener_icon").addClass("opened");
				item.parents("tr").addClass("nb")
				item.parents("tr").next(".offer_stores").find(".stores_block_wrap").slideDown(200);
			}
		}
		$('html,body').animate({'scrollTop':topPos-80},150);
	}
}

checkTable = function() {
	var z = parseInt($('.body_media').css('top'));
	$('.catalog.item-views.price .item > div').css('margin-top', '');
	$('.catalog.item-views.price .item .label').css('margin-top', '');
	$('.catalog.item-views.price .item .price').css('margin-top', '');
	$('.catalog.item-views.price .item').each(function() {
		var title = $(this).find('.title').parent();
		var buy_block = $(this).find('.buy_block');
		var price = $(this).find('.price');
		var btn = $(this).find('.btn');

		if(btn.length){
			btn.css('margin-top', (!$(this).find('.price_old').length ? '-3px' : '7px'));
		}

		if(z > 0){
			var itemHeight = $(this).outerHeight() - parseInt($(this).css('padding-top')) - parseInt($(this).css('padding-bottom')) - parseInt($(this).css('border-top-width')) - parseInt($(this).css('border-bottom-width'));

			if(title.length){
				var titleHeight = title.outerHeight();
				var titleMarginTop = Math.floor((itemHeight - titleHeight) / 2);
				title.css('margin-top', titleMarginTop + 'px');
			}

			if(buy_block.length){
				var statusHeight = buy_block.outerHeight();
				var statusMarginTop = Math.floor((itemHeight - statusHeight) / 2);
				buy_block.css('margin-top', statusMarginTop + 'px');
			}

			if(price.length){
				var priceHeight = price.outerHeight();
				var priceMarginTop = Math.floor((itemHeight - priceHeight) / 2);
				price.css('margin-top', priceMarginTop + 'px');
			}

			if(btn.length){
				var btnHeight = btn.outerHeight();
				var btnMarginTop = Math.floor((itemHeight - btnHeight) / 2);
				btn.css('margin-top', btnMarginTop + 'px');
			}
		}
	});
}

openerFunc = function(el, selectorHideBlock){
	var $this = el,
		$item = $this.closest('.item'),
		$hiddenBlock = (selectorHideBlock ? $item.find(selectorHideBlock) : $item.find('.hidden-block')),
		openText = (typeof($this.data('open_text')) !== 'undefined' ? $this.data('open_text') : ''),
		closeText = (typeof($this.data('close_text')) !== 'undefined' ? $this.data('close_text') : ''),
		btn = ($this.find('.btn').length ? $this.find('.btn') : $this);

	$hiddenBlock.slideToggle(200);
	$item.toggleClass('opened');

	if(!btn.hasClass('opened')){
		btn.addClass('opened').removeClass('closed');

		if(openText.length){
			if($this.find('.text').length){
				$this.find('.text').text(openText);
			}
			else{
				$this.text(openText);
			}
		}
	}
	else if(btn.hasClass('opened')){
		btn.addClass('closed').removeClass('opened');

		if(closeText.length){
			if($this.find('.text').length){
				$this.find('.text').text(closeText);
			}
			else{
				$this.text(closeText);
			}
		}
	}
}

$.fn.jqmEx = function(){
	$(this).each(function(){
		var _this = $(this);
		var name = _this.data('name');

		if(name.length){
			var script = arPriorityOptions['SITE_DIR'] + 'ajax/form.php';
			var paramsStr = ''; var trigger = ''; var arTriggerAttrs = {};
			$.each(_this.get(0).attributes, function(index, attr){
				var attrName = attr.nodeName;
				var attrValue = _this.attr(attrName);
				trigger += '[' + attrName + '=\"' + attrValue + '\"]';
				arTriggerAttrs[attrName] = attrValue;
				if(/^data\-param\-(.+)$/.test(attrName)){
					var key = attrName.match(/^data\-param\-(.+)$/)[1];
					paramsStr += key + '=' + attrValue + '&';
				}
			});
			var triggerAttrs = JSON.stringify(arTriggerAttrs);
			var encTriggerAttrs = encodeURIComponent(triggerAttrs);
			if(name == 'auth')
				script += '?' + paramsStr + 'auth=Y';
			else
				script += '?' + paramsStr + 'data-trigger=' + encTriggerAttrs;

			if(!$('.' + name + '_frame[data-trigger="' + encTriggerAttrs + '"]').length){
				if(_this.attr('disabled') != 'disabled'){
					$('body').find('.' + name + '_frame[data-trigger="' + encTriggerAttrs + '"]').remove();
					if(arPriorityOptions['THEME']['FORM_TYPE'] == 'LATERAL'){
						$('body').append('<div class="' + name + '_frame jqmWindow" style="width:580px" data-trigger="' + encTriggerAttrs + '"></div>');
					}
					else{
						$('body').append('<div class="' + name + '_frame jqmWindow" style="width:100%" data-trigger="' + encTriggerAttrs + '"></div>');
					}
					$('.' + name + '_frame[data-trigger="' + encTriggerAttrs + '"]').jqm({trigger: trigger, onLoad: function(hash){onLoadjqm(hash);}, onHide: function(hash){onHide(hash);}, ajax:script});
				}
			}
		}
	});
}

InitFlexSlider = function() {
	$('.flexslider:not(.thmb):not(.flexslider-init):visible').each(function(){
		var slider = $(this);
		var options;
		var defaults = {
			animationLoop: true,
			controlNav: false,
			directionNav: true,
			animation: "slide",
			animationSpeed: 600
		}
		var config = $.extend({}, defaults, options, slider.data('plugin-options'));
		if(typeof(config.counts) != 'undefined' && config.direction !== 'vertical'){
			var slide_counts = '';
			if(typeof(slider.data('plugin-options')) != 'undefined')
			{
				if('slide_counts' in slider.data('plugin-options'))
					slide_counts = slider.data('plugin-options').slide_counts;
			}
			config.maxItems =  getGridSize(config.counts);
			config.minItems = getGridSize(config.counts);

			if(slide_counts)
				config.move = slide_counts;
			else
				config.move = getGridSize(config.counts);

			config.itemWidth = 200;
		}

		// custom direction nav
		if(typeof(config.customDirection) != 'undefined')
			config.customDirectionNav = $(config.customDirection);

		config.prevText = BX.message("FANCY_PREV"),           //String: Set the text for the "previous" directionNav item
		config.nextText = BX.message("FANCY_NEXT"),

		/*config.after = */
		config.after = config.start = function(slider){
			var eventdata = {slider: slider};
			BX.onCustomEvent('onSlide', [eventdata]);
		}

		config.before = function(slider){
			var eventdata = {slider: slider};
			BX.onCustomEvent('onSlideStart', [eventdata]);
		}

		config.end = function(slider){
			var eventdata = {slider: slider};
			BX.onCustomEvent('onSlideEnd', [eventdata]);
		}

		slider.addClass('dark-nav');
		slider.flexslider(config).addClass('flexslider-init');
		if(config.controlNav)
			slider.addClass('flexslider-control-nav');
		if(config.directionNav)
			slider.addClass('flexslider-direction-nav');
	});
}

InitFlexSliderClass = function(class_name) {
	//$('.flexslider:not(.thmb):not(.flexslider-init)').each(function(){

		var slider = $(class_name);
		var options;
		var defaults = {
			animationLoop: false,
			controlNav: false,
			directionNav: true,
			animation: "slide"
		}
		var config = $.extend({}, defaults, options, slider.data('plugin-options'));

		var slide_counts = '';
		if(typeof(slider.data('plugin-options')) != 'undefined')
		{
			if('slide_counts' in slider.data('plugin-options'))
				slide_counts = slider.data('plugin-options').slide_counts;
		}

		if(typeof(config.counts) != 'undefined' && config.direction !== 'vertical'){
			config.maxItems =  getGridSize(config.counts);
			config.minItems = getGridSize(config.counts);
			config.move = getGridSize(config.counts);

			config.itemWidth = 200;
		}
		if(slide_counts)
			config.move = slide_counts;

		// custom direction nav
		if(typeof(config.customDirection) != 'undefined')
			config.customDirectionNav = $(config.customDirection);

		config.prevText = BX.message("FANCY_PREV"),           //String: Set the text for the "previous" directionNav item
		config.nextText = BX.message("FANCY_NEXT"),

		config.after = config.start = function(slider){
			var eventdata = {slider: slider};
			BX.onCustomEvent('onSlide', [eventdata]);
		}

		config.end = function(slider){
			var eventdata = {slider: slider};
			BX.onCustomEvent('onSlideEnd', [eventdata]);
		}

		slider.flexslider(config).addClass('flexslider-init');
		if(config.controlNav)
			slider.addClass('flexslider-control-nav');
		if(config.directionNav)
			slider.addClass('flexslider-direction-nav');
	//});
}

SliceHeightBlocks = function(){
	$('*[data-slice="Y"]').each(function(){
		var slice_els = $(this).find('*[data-slice-block="Y"]');
		if(slice_els.length)
		{
			var slice_params = {};
			if(slice_els.data('slice-params'))
				slice_params = slice_els.data('slice-params');
			slice_els.sliceHeight(slice_params);
		}
	})
}

createTableCompare = function(originalTable, appendDiv, cloneTable){
	try{
		if($('.tarifs .head-block:visible').length){
			var clone = originalTable.clone().addClass('clone');
			if(cloneTable.length){
				cloneTable.remove();
				appendDiv.html('');
				appendDiv.html(clone);
			}else{
				appendDiv.append(clone);
			}
		}
	}
	catch(e){}
	finally{}
}

CheckHeaderFixedMenu = function(){
	/*if(arPriorityOptions['THEME']['HEADER_FIXED'] == 2 && $('#headerfixed .js-nav').length && window.matchMedia('(min-width: 992px)').matches)
	{
		$('#headerfixed .js-nav').css('width','0');
		var all_width = 0,
			cont_width = $('#headerfixed .maxwidth-theme').actual('width'),
			padding_menu = $('#headerfixed .logo-row.v2 .menu-block').actual('outerWidth')-$('#headerfixed .logo-row.v2 .menu-block').actual('width');
			console.log(padding_menu);
		$('#headerfixed .logo-row.v2 > .inner-table-block').each(function(){
			if(!$(this).hasClass('menu-block'))
				all_width += $(this).actual('outerWidth');
		})
		$('#headerfixed .js-nav').width(cont_width-all_width-padding_menu);
	}*/
}

CheckTopMenuPadding = function(){
	if($('.menu-row .menu-only').length && $('.logo_and_menu-row .right-icons .wrap_icon').length && $('.logo_and_menu-row .menu-row').length && !$('.logo_and_menu-row .menu-row').hasClass('bgcolored')){
		var menuPosition = $('.menu-row .menu-only').position().left,
			maxWidth = $('.logo_and_menu-row .maxwidth-theme').width() - 32,
			leftPadding = 0,
			rightPadding = 0;

		$('.logo_and_menu-row .menu-row>div').each(function(indx){
			if(!$(this).hasClass('menu-only') && !$(this).closest('[id^=bx_incl_area]').length){
				var elementPosition = $(this).position().left,
					elementWidth = $(this).outerWidth();

				if(elementPosition > menuPosition){
					rightPadding += elementWidth;
				}else{
					leftPadding += elementWidth;
				}
			}
		}).promise().done(function(){
			$('.logo_and_menu-row .menu-only').css({'padding-left': leftPadding, 'padding-right': rightPadding, 'opacity': 1});
		});
	}
}

CheckTopMenuOncePadding = function(){
	if($('.menu-row .menu-only').length && $('.menu-row.sliced .right-icons .wrap_icon').length){
		var menuPosition = $('.menu-row .menu-only').position().left,
			maxWidth = $('.logo_and_menu-row .maxwidth-theme').width() - 32,
			leftPadding = 0,
			rightPadding = 0;

		$('.menu-row.sliced .maxwidth-theme>div>div').each(function(indx){
			if(!$(this).hasClass('menu-only') && !$(this).closest('[id^=bx_incl_area]').length){
				var elementPosition = $(this).position().left,
					elementWidth = $(this).outerWidth();

				if(elementPosition > menuPosition){
					rightPadding += elementWidth;
				}else{
					leftPadding += elementWidth;
				}
			}
		}).promise().done(function(){
			$('.menu-row.sliced .menu-only').css({'padding-left': leftPadding, 'padding-right': rightPadding});
		});
	}
}

CheckSearchWidth = function(){
	if($('.logo_and_menu-row .search_wrap').length){
		var searchPosition = $('.logo_and_menu-row .search_wrap').position().left,
			maxWidth = $('.logo_and_menu-row .maxwidth-theme').width() - 32;
			width = 0;

		$('.logo_and_menu-row .maxwidth-theme>div').each(function(){
			if(!$(this).hasClass('search_wrap')){
				var elementWidth = $(this).outerWidth();

				width = (width ? width - elementWidth : maxWidth - elementWidth);
			}
		}).promise().done(function(){
			$('.logo_and_menu-row .search_wrap').outerWidth(width).css({'opacity': 1, 'visibility': 'visible'});
		});
	}
}

waitCounter = function(idCounter, delay, callback){
	var obCounter = window['yaCounter' + idCounter];
	if(typeof obCounter == 'object')
	{
		if(typeof callback == 'function')
			callback();

	}
	else
	{
		setTimeout(function(){
			waitCounter(idCounter, delay, callback);
		}, delay);
	}
}

var waitReCaptcha = function(delay, callback){
	if(typeof grecaptcha == 'object'){
		if(typeof callback == 'function'){
			callback();
		}
	}
	else{
		setTimeout(function(){
			waitReCaptcha(delay, callback);
		}, delay);
	}
}

CheckTooltipWidth = function(el){
	if(!el.hasClass('check_width')){
		el.width(256);
		var _this = el,
			textWidth = parseInt(_this.find('>span').width()),
			paddingLeftRight = parseInt(_this.css('padding-left')),
			tooltipWidth = textWidth + paddingLeftRight*2 + 2;

		_this.outerWidth(tooltipWidth);
		_this.css('left', -tooltipWidth/2 + 6);
		el.addClass('check_width')
	}
}

var reCaptchaRender = function(response){
	if($('.g-recaptcha:not(.rendered)').length){
		waitReCaptcha(50, function(){
			$('.g-recaptcha:not(.rendered)').each(function(){
				$this = $(this);
				$this.addClass('rendered')
				var id = grecaptcha.render($this[0], {
					sitekey: $this.attr('data-sitekey'),
					theme: $this.attr('data-theme'),
					size: $this.attr('data-size'),
					callback: $this.attr('data-callback'),
				});
				$this.attr('data-widgetid', id);
			});
		});
	}
}

var reCaptchaVerify = function(response){
	$('.g-recaptcha.rendered').each(function(){
		var id = $(this).attr('data-widgetid');
		if(typeof(id) !== 'undefined'){
			if(grecaptcha.getResponse(id) != ''){
				$(this).closest('form').find('.recaptcha').valid();
			}
		}
	});
}

var reCaptchaVerifyHidden = function(response){
	$('.g-recaptcha.rendered:last').each(function(){
		var id = $(this).attr('data-widgetid');
		if(typeof(id) !== 'undefined' && response){
			if(!$(this).closest('form').find('.g-recaptcha-response').val())
				$(this).closest('form').find('.g-recaptcha-response').val(response)
			$(this).closest('form').submit();
		}
	});
}

waitYTPlayer = function(delay, callback){
	if((typeof YT !== "undefined") && YT && YT.Player)
	{
		if(typeof callback == 'function')
			callback();
	}
	else
	{
		setTimeout(function(){
			waitYTPlayer(delay, callback);
		}, delay);
	}
}

function retrieveScale(btn) {
	var btnRadius = btn.width()/2,
		left = btn.offset().left + btnRadius,
		top = btn.offset().top + btnRadius - $(window).scrollTop(),
		scale = scaleValue(top, left, btnRadius, $(window).height(), $(window).width());

	btn.css('position', 'fixed').velocity({
		top: top - btnRadius,
		left: left - btnRadius,
		translateX: 0,
	}, 0);

	return scale;
}

function scaleValue( topValue, leftValue, radiusValue, windowW, windowH) {
	var maxDistHor = ( leftValue > windowW/2) ? leftValue : (windowW - leftValue),
		maxDistVert = ( topValue > windowH/2) ? topValue : (windowH - topValue);
	return Math.ceil(Math.sqrt( Math.pow(maxDistHor, 2) + Math.pow(maxDistVert, 2) )/radiusValue);
}

function animateLayer(layer, scaleVal, bool) {
	layer.velocity({ scale: scaleVal }, 400, function(){
		$('body').toggleClass('overflow-hidden', bool);
		(bool)
			? layer.parents('.cd-section').addClass('modal-is-visible').end().off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend')
			: layer.removeClass('is-visible').removeAttr( 'style' ).siblings('[data-type="modal-trigger"]').removeClass('to-circle');
	});
}

function updateLayer() {
	var layer = $('.cd-section.modal-is-visible .cd-modal-bg'),
		layerRadius = layer.width()/2,
		layerTop = layer.siblings('.btn').offset().top + layerRadius - $(window).scrollTop(),
		layerLeft = layer.siblings('.btn').offset().left + layerRadius,
		scale = scaleValue(layerTop, layerLeft, layerRadius, $(window).height(), $(window).width());

	layer.velocity({
		top: layerTop - layerRadius,
		left: layerLeft - layerRadius,
		scale: scale,
	}, 0);
}

function closeModal() {
	$('.cd-modal-bg').fadeOut();
	animateLayer($('.cd-modal-bg'), 1, false);
	//$('.cd-modal-bg').removeAttr('style');
	//setTimeout(function(){
		$('.cd-modal-bg').removeClass('is-visible');
	//}, 510);
}

TemplateTarifsScript = function(){
	setBasketItemsClasses();
	//$('.item-views.tarifs .item .prices .all_price').mCustomScrollbar();
	$('.item-views.tarifs .item .prices .price_default.wdropdown .title-price>span').on('click', function(e){
		e.stopPropagation();
		$(this).closest('.prices').find('.all_price').toggleClass('showen');
	});

	$('body').on('click', function(){
		$('.item-views.tarifs .item .prices .all_price').removeClass('showen');
	});

	$('.item-views.tarifs .item .prices .all_price .price').on('click', function(){
		var _this = $(this),
			price = _this.data('price'),
			filterPrice = _this.data('filter_price'),
			name = _this.data('name'),
			json = _this.closest('.item').data('item'),
			itemName = _this.closest('.item').find('.name').text();

		if(typeof(json) !== 'undefined'){
			json.PROPERTY_FILTER_PRICE_VALUE = filterPrice;
			json.PROPERTY_PRICE_VALUE = price;
			_this.closest('.item').data('item', json);
		}

		if(!_this.closest('.tarifs.type_8').length){
			_this.closest('.prices').find('.title-price>span>span').text(name);
			_this.closest('.prices').find('.value').text(price);
			_this.closest('.item').find('.order .btn').data('product', itemName + ': ' + price);
		}
	});

	$('.item-views.tarifs .item').each(function(){
		var _this = $(this),
			json = _this.data('item'),
			price = (_this.closest('.item-views.tarifs').hasClass('type_8') ? _this.find('.price.active').data('price') : _this.find('.price_default .value').data('price')),
			filterPrice = (_this.closest('.item-views.tarifs').hasClass('type_8') ? _this.find('.price.active').data('filter_price') : _this.find('.price_default .value').data('filter_price'));

		if(typeof(json) !== 'undefined'){
			json.PROPERTY_PRICE_VALUE = price;
			json.PROPERTY_FILTER_PRICE_VALUE = filterPrice;
			_this.data('item', json)
		}
	});

	$('.rolldown>span').on('click', function(){
		openerFunc($(this));
	});
}

CheckInstagramItemDesc = function(){
	$('.instagram_ajax .instagram .item').each(function(){
		var _this = $(this),
			itemHeight = _this.outerHeight(),
			itemDescHeight = _this.find('.desc .wrap').outerHeight();

		if(itemDescHeight < itemHeight){
			_this.addClass('bottom_desc');
		}
		else{
			_this.removeClass('bottom_desc');
		}
	});
}


var scrollToTopAnimateClassIn = false;
var scrollToTopAnimateClassOut = false;

var $body = {}
var $scrolltotop = {}
var addFormScript = false;

$(document).ready(function(){
	scrollToTop();
	CheckStickyFooter();
	TemplateTarifsScript();

	CheckInstagramItemDesc();

	$(document).on('click', '.jqmOverlay.popup_form', function(e){
		e.stopPropagation();
		e.preventDefault();
	});

	/*$(document).on('click', '*', function(e){
		//e.stopPropagation();
		//e.preventDefault();
		console.log(e.target);
		return;
	});*/

	$('.fly_forms .button>span>span').on('click', function(e){
		if($(this).parent().hasClass('disabled')){
			$('.jqmWindow').jqmHide();
			e.stopPropagation();
		}
	});


	$(document).on('keyup', function(e){
		if(($('.jqmOverlay').length || $('.jqmOverlay_search').length) && e.keyCode === 27){
			if($('.jqmOverlay').length){
				$('.jqmOverlay').click();
			}
			if($('.jqmOverlay_search').length){
				$('.inline-search-block').removeClass('show');
				$('.title-search-result').hide();
				if(arPriorityOptions['THEME']['TYPE_SEARCH'] == 'fixed'){
					setTimeout(function(){
						$('.jqmOverlay_search').detach();
					}, 300);
				}
			}
		}
	});
	/*setTimeout(function(){
		if($('.banners-big video').length){
			var bannerWidth = $('.banners-big video').width();
			$('.banners-big video').css('margin-left', -bannerWidth/2 + (isMobile ? 150 : 0));
			//$('.banners-big .wvideo').css('background-position-x', -bannerWidth/2);
		}
	}, 1000);*/

	if($('textarea').length){
		$('textarea').each(function(){
			$(this).autoResize();
		});
	}

	if(!jQuery.browser.safari){
		CheckTopMenuPadding();
		CheckTopMenuOncePadding();
		CheckHeaderFixed();
		CheckTopMenuDotted();
		MegaMenuFixed();
		CheckSearchWidth();

		setTimeout(function() {
			$(window).resize(); // need to check resize flexslider & menu
			$('.flexslider .flex-viewport').height('auto');
		}, 350);

		setTimeout(function() {$(window).scroll();}, 250); // need to check position fixed ask block
	}
	else{
		setTimeout(function() {
			$(window).resize(); // need to check resize flexslider & menu
			setTimeout(function(){
				CheckTopMenuPadding();
				CheckTopMenuOncePadding();
				CheckHeaderFixed();
				CheckTopMenuDotted();
				MegaMenuFixed();
				CheckSearchWidth();
				setTimeout(function(){
					$(window).scroll();
				}, 50);
			}, 50);
		}, 350);
	}

	/*if($('.catalog.table').length){
		$('.catalog.table').prepend('<div class="catalog_overlay"></div>');
		setTimeout(function(){
			$('.catalog.table .catalog_overlay').remove();
		}, 1500);
	}
	*/
	if($('.services-items.type_2').length){
		$('.services-items.type_2').prepend('<div class="services_overlay"></div>');
		setTimeout(function(){
			$('.services-items.type_2 .services_overlay').remove();
		}, 1500);
	}

	if($('.sections.linked.item-views.staff.within .items .item').length){
		$('.sections.linked.item-views.staff.within .items .item').prepend('<div class="services_overlay"></div>');
		setTimeout(function(){
			$('.sections.linked.item-views.staff.within .items .item .services_overlay').remove();
		}, 1500);
	}

	if($('.sections.linked.item-views.staff.front.type_3').length){
		$('.sections.linked.item-views.staff.front.type_3').prepend('<div class="services_overlay"></div>');
		setTimeout(function(){
			$('.sections.linked.item-views.staff.front.type_3 .services_overlay').remove();
		}, 1500);
	}

	$(document).on('keyup', function(e){
		if($('.mega_fixed_menu').is(':visible') && e.keyCode == 27){
			$('.mega_fixed_menu .svg-close').click();
		}
		if($('.show_center').is(':visible') && e.keyCode == 27){
			$('.close-block').click();
		}
	});

	$('#bx-panel-hider, #bx-panel-expander').on('click', function(){
		CheckStickyFooter();
	});

	if(arPriorityOptions['THEME']['USE_DEBUG_GOALS'] === 'Y'){
		$.cookie('_ym_debug', '1');
	}
	else{
		$.cookie('_ym_debug', null);
	}

	/*  --- Bind mobile menu  --- */
	var $mobileMenu = $("#mobilemenu")
	if($mobileMenu.length){
		$mobileMenu.isLeftSide = $mobileMenu.hasClass('leftside')
		$mobileMenu.isOpen = $mobileMenu.hasClass('show')
		$mobileMenu.isDowndrop = $mobileMenu.find('>.scroller').hasClass('downdrop')

		$(document).on('click', '#mobileheader .burger', function(){
			SwipeMobileMenu()
		})

		if($mobileMenu.isLeftSide){
			$mobileMenu.parent().append('<div id="mobilemenu-overlay"></div>')
			var $mobileMenuOverlay = $('#mobilemenu-overlay')

			$mobileMenuOverlay.click(function(){
				if($mobileMenu.isOpen){
					CloseMobileMenu()
				}
			});

			$(document).swiperight(function(e) {
				if(!$(e.target).closest('.flexslider').length && !$(e.target).closest('.swipeignore').length){
					OpenMobileMenu()
				}
			});

			$(document).swipeleft(function(e) {
				if(!$(e.target).closest('.flexslider').length && !$(e.target).closest('.swipeignore').length){
					CloseMobileMenu()
				}
			});
		}
		else{
			$(document).on('click', '#mobileheader', function(e){
				if(!$(e.target).closest('#mobilemenu').length && !$(e.target).closest('.burger').length && $mobileMenu.isOpen){
					CloseMobileMenu()
				}
			});
		}

		if(!isMobile){
			$('#mobilemenu').mCustomScrollbar({
				mouseWheel: {preventDefault: true},
			});
		}

		$(document).on('click', '#mobilemenu .svg-close', function(){
			$('#mobilemenu-overlay').click();
		});

		$(document).on('click', '#mobilemenu .menu a,#mobilemenu .social-icons a,#mobilemenu .phones a.parent', function(e){
			var $this = $(this)
			if($this.hasClass('parent')){
				e.preventDefault()

				if(!$mobileMenu.isDowndrop){
					$this.closest('li').addClass('expanded')
					MoveMobileMenuWrapNext()
				}
				else{
					if(!$this.closest('li').hasClass('expanded')){
						$this.closest('li').addClass('expanded')
					}
					else{
						$this.closest('li').removeClass('expanded')
					}
				}
			}
			else{
				if($this.closest('li').hasClass('counters')){
					var href = $this.attr('href')
					if(typeof href !== 'undefined'){
						e.preventDefault()
						window.location.href = href
						//window.location.reload()
					}
				}

				if(!$this.closest('.menu_back').length){
					CloseMobileMenu()
				}
			}
		})

		$(document).on('click', '#mobilemenu .dropdown .menu_back', function(e){
			e.preventDefault()
			var $this = $(this)
			MoveMobileMenuWrapPrev()
			setTimeout(function(){
				$this.closest('.expanded').removeClass('expanded')
			}, 400)
		})

		OpenMobileMenu = function(){
			if(!$mobileMenu.isOpen){
				if(!jQuery.browser.safari){
					$('html').addClass('overflow_html');
				}

				// hide styleswitcher
				if($('.style-switcher').hasClass('active')){
					$('.style-switcher .switch').trigger('click')
				}
				$('.style-switcher .switch').hide()
				$('.style-switcher .oversite_button').hide()

				if($mobileMenu.isLeftSide){
					// show overlay
					setTimeout(function(){
						$mobileMenuOverlay.fadeIn('fast')
					}, 100)
				}
				else{
					// scroll body to top & set fixed
					$('body').scrollTop(0).css({position: 'fixed'})

					// set menu top = bottom of header
					$mobileMenu.css({top: + ($('#mobileheader').height() + $('#mobileheader').offset().top) + 'px'})

					// change burger icon
					$('#mobileheader .burger').addClass('c')
				}

				// show menu
				$mobileMenu.addClass('show')
				$mobileMenu.isOpen = true

				if(!$mobileMenu.isDowndrop){
					var $wrap = $mobileMenu.find('.wrap').first()
					var params =  $wrap.data('params')
					if(typeof params === 'undefined'){
						params = {
							depth: 0,
							scroll: {},
							height: {}
						}
					}
					$wrap.data('params', params)
				}
			}
		}

		CloseMobileMenu = function(){
			if($mobileMenu.isOpen){
				$('html').removeClass('overflow_html');
				// hide menu
				$mobileMenu.removeClass('show')
				$mobileMenu.isOpen = false

				// show styleswitcher
				$('.style-switcher .switch').show();
				$('.style-switcher .oversite_button').show()
				//$('#mobileheader .dropdown').css('display', 'none');
				$('#mobileheader li.expanded').removeClass('expanded');

				if($mobileMenu.isLeftSide){
					// hide overlay
					setTimeout(function(){
						$mobileMenuOverlay.fadeOut('fast')
					}, 100)
				}
				else{
					// change burger icon
					$('#mobileheader .burger').removeClass('c')

					// body unset fixed
					$('body').css({position: ''})
				}

				if(!$mobileMenu.isDowndrop){
					setTimeout(function(){
						var $scroller = $mobileMenu.find('.scroller').first()
						var $wrap = $mobileMenu.find('.wrap').first()
						var params =  $wrap.data('params')
						params.depth = 0
						$wrap.data('params', params).attr('style', '')
						$mobileMenu.scrollTop(0)
						$scroller.css('height', '')
					}, 400)
				}
			}
		}

		SwipeMobileMenu = function(){
			if($mobileMenu.isOpen){
				CloseMobileMenu()
			}
			else{
				OpenMobileMenu()
			}
		}

		function MoveMobileMenuWrapNext(){
			if(!$mobileMenu.isDowndrop){
				//var $scroller = $mobileMenu.find('.scroller').first()
				var $wrap = $mobileMenu.find('.wrap').first()
				if($wrap.length){
					var params =  $wrap.data('params')
					var $dropdownNext = $mobileMenu.find('.expanded>.dropdown').eq(params.depth)
					if($dropdownNext.length){
						$mobileMenu.mCustomScrollbar('stop')

						// save scroll position
						params.scroll[params.depth] = parseInt($mobileMenu.find('.mCSB_container').first().css('top'))

						// height while move animating
						params.height[params.depth + 1] = Math.max($dropdownNext.height(), (!params.depth ? $wrap.height() : $mobileMenu.find('.expanded>.dropdown').eq(params.depth - 1).height()))
						$wrap.css('height', params.height[params.depth + 1] + 'px')

						// inc depth
						++params.depth

						// scroll to top
						setTimeout(function() {
							$mobileMenu.animate({scrollTop : 0}, 200);
							//$mobileMenu.find('.mCSB_vertical').mCustomScrollbar.top(0);
						}, 100)

						// height on enimating end
						var h = $dropdownNext.height()
						setTimeout(function() {
							if(h){
								$wrap.css('height', h + 'px')
							}
							else{
								$wrap.css('height', '')
							}
							setTimeout(function(){
								$mobileMenu.mCustomScrollbar('update')
							}, 500)
						}, 200)

						// translateX for move
						$wrap.css('transform', 'translateX(' + -100 * params.depth + '%)')
						$mobileMenu.mCustomScrollbar('scrollTo', 0, {scrollInertia: 200})
					}

					$wrap.data('params', params)
				}
			}
		}

		function MoveMobileMenuWrapPrev(){
			if(!$mobileMenu.isDowndrop){
				//var $scroller = $mobileMenu.find('.scroller').first()
				var $wrap = $mobileMenu.find('.wrap').first()
				if($wrap.length){
					var params =  $wrap.data('params')
					if(params.depth > 0){
						var $dropdown = $mobileMenu.find('.expanded>.dropdown').eq(params.depth - 1)
						if($dropdown.length){
							$mobileMenu.mCustomScrollbar('stop')

							// height while move animating
							$wrap.css('height', params.height[params.depth] + 'px')

							// dec depth
							--params.depth

							// height on enimating end
							var h = (!params.depth ? false : $mobileMenu.find('.expanded>.dropdown').eq(params.depth - 1).height())
							setTimeout(function() {
								if(h){
									$wrap.css('height', h + 'px')
								}
								else{
									$wrap.css('height', '')
								}
							}, 200)

							// translateX for move
							$wrap.css('transform', 'translateX(' + -100 * params.depth + '%)')
							$mobileMenu.mCustomScrollbar('scrollTo', params.scroll[params.depth], {scrollInertia: 200})
						}
					}

					$wrap.data('params', params)
				}
			}
		}
	}
	/*  --- END Bind mobile menu  --- */

	$(document).on('click', '.ajax_load_btn_pagination', function(){
		var $this = $(this),
			url = $this.closest('.pagination_nav').find('.pagination .next a').attr('href');

		if(!$this.hasClass('loadings')){
			$this.addClass('loadings');
			$.ajax({
				url: url,
				data: {"AJAX_REQUEST": "Y"},
				success: function(html){
					//$(html).insertBefore($('.item-views .bottom_nav'));
					var htmlPagination = $(html).find('.pagination_nav').html(),
						htmlContent = $(html).find('.items').html();

					$this.closest('.item-views').find('.items').append(htmlContent);
					$this.closest('.item-views').find('.pagination_nav').html(htmlPagination);

					var eventdata = {action:'ajaxContentLoaded'};
					BX.onCustomEvent('onCompleteAction', [eventdata, $(this).find('.more_text_ajax')[0]]);
					BX.onCustomEvent('onCompleteActionComponent', [eventdata, $(this).find('.more_text_ajax')[0]]);
					$this.removeClass('loadings');
				}
			});
		}
	});

	if($('.contacts.front:not(.type_4) .bx-yandex-view-layout').length){
		$('.contacts.front .bx-yandex-view-layout').closest('.contacts.front').find('>.row>.item').sliceHeight({outer: true});
	}
	/* change type2 menu for fixed */
	if($('#headerfixed .js-nav').length)
	{
		if(arPriorityOptions['THEME']['HEADER_FIXED'] == 2)
			CheckHeaderFixedMenu();

		setTimeout(function(){
			$('#headerfixed .js-nav').addClass('opacity1');
		},350);
	}

	/* close search block */
	$("html, body").on('mousedown', function(e){
		if(typeof e.target.className == 'string' && e.target.className.indexOf('adm') < 0 && !$(e.target).closest('.inline-search-show').length)
		{
			e.stopPropagation();
			var search_target = $(e.target).closest('.bx_searche');
			if(!$(e.target).hasClass('inline-search-block') && !$(e.target).hasClass('svg') && !search_target.length)
			{
				$('.inline-search-block').removeClass('show');
				$('.title-search-result').hide();
				if(arPriorityOptions['THEME']['TYPE_SEARCH'] == 'fixed'){
					setTimeout(function(){
						$('.jqmOverlay_search').detach();
					}, 300);
				}
			}

			if(isMobile)
			{
				if(search_target.length)
					location.href = search_target.attr('href');
			}
			var class_name = $(e.target).attr('class');
			if(typeof(class_name) == 'undefined' || class_name.indexOf('tooltip') < 0) //tooltip link
				$('.tooltip-link').tooltip('hide');
		}
	});
	$('.inline-search-block').find('*').on('mousedown', function(e){
		e.stopPropagation();
	});


	$('.filter-action').on('click', function(){
		/*$(this).toggleClass('active');
		$(this).find('.svg').toggleClass('white');
		if($('.text_before_items').length)
		{
			var top_pos = $('.filters-wrap').position();
			$('.bx_filter').css({'top':top_pos.top+40});
		}

		$('.bx_filter.catalog').find('.bx_filter_section').slideToggle(200);
		$('.bx_filter.catalog').toggleClass('closed');*/

		$(this).toggleClass('active');
		$(this).find('.svg').toggleClass('white');
		if($('.text_before_items').length)
		{
			var top_pos = $('.filters-wrap').position();
			$('.bx_filter').css({'top':top_pos.top+40});
		}
		$('.bx_filter').slideToggle();

		var filterClosed = (typeof($.cookie('CLOSED_FILTER')) !== 'undefined' && $.cookie('CLOSED_FILTER') == 'Y' ? true : false);
		$.cookie('CLOSED_FILTER', (filterClosed ? 'N' : 'Y'), {
			path: arPriorityOptions['SITE_DIR'],
			domain: '',
			expires: 360
		});

		if($(this).hasClass('toggle')){
			$('.catalog.bx_filter .bx_filter_parameters_box_title .hints:visible .tooltip').each(function(){
				CheckTooltipWidth($(this));
			});
		}
	})

	waitingNotExists('#bx-composite-banner .bx-composite-btn', '#footer .col-sm-3.hidden-md.hidden-lg #bx-composite-banner .bx-composite-btn', 500, function() {
		$('#footer .col-sm-3.hidden-md.hidden-lg #bx-composite-banner').html($('#bx-composite-banner .bx-composite-btn').parent().html());
	});

	$.extend( $.validator.messages, {
		required: BX.message('JS_REQUIRED'),
		email: BX.message('JS_FORMAT'),
		equalTo: BX.message('JS_PASSWORD_COPY'),
		minlength: BX.message('JS_PASSWORD_LENGTH'),
		remote: BX.message('JS_ERROR')
	});

	$.validator.addMethod(
		'regexp', function( value, element, regexp ){
			var re = new RegExp( regexp );
			return this.optional( element ) || re.test( value );
		},
		BX.message('JS_FORMAT')
	);

	$.validator.addMethod(
		'filesize', function( value, element, param ){
			return this.optional( element ) || ( element.files[0].size <= param )
		},
		BX.message('JS_FILE_SIZE')
	);

	$.validator.addMethod(
		'date', function( value, element, param ) {
			var status = false;
			if(!value || value.length <= 0){
				status = false;
			}
			else{
				// html5 date allways yyyy-mm-dd
				var re = new RegExp('^([0-9]{4})(.)([0-9]{2})(.)([0-9]{2})$');
				var matches = re.exec(value);
				if(matches){
					var composedDate = new Date(matches[1], (matches[3] - 1), matches[5]);
					status = ((composedDate.getMonth() == (matches[3] - 1)) && (composedDate.getDate() == matches[5]) && (composedDate.getFullYear() == matches[1]));
				}
				else{
					// firefox
					var re = new RegExp('^([0-9]{2})(.)([0-9]{2})(.)([0-9]{4})$');
					var matches = re.exec(value);
					if(matches){
						var composedDate = new Date(matches[5], (matches[3] - 1), matches[1]);
						status = ((composedDate.getMonth() == (matches[3] - 1)) && (composedDate.getDate() == matches[1]) && (composedDate.getFullYear() == matches[5]));
					}
				}
			}
			return status;
		}, BX.message('JS_DATE')
	);

	$.validator.addMethod(
		'datetime', function( value, element, param ) {
			var status = false;
			if(!value || value.length <= 0){
				status = true;
			}
			else{
				var re = new RegExp('^([0-9]{2})(.)([0-9]{2})(.)([0-9]{4}) ([0-9]{1,2}):([0-9]{1,2})$');
				var matches = re.exec(value);
				if(matches){
					var composedDate = new Date(matches[5], (matches[3] - 1), matches[1], matches[6], matches[7]);
					status = ((composedDate.getMonth() == (matches[3] - 1)) && (composedDate.getDate() == matches[1]) && (composedDate.getFullYear() == matches[5]) && (composedDate.getHours() == matches[6]) && (composedDate.getMinutes() == matches[7]));
				}
			}
			return status;
		}, BX.message('JS_DATETIME')
	);

	$.validator.addMethod(
		'extension', function(value, element, param){
			param = typeof param === 'string' ? param.replace(/,/g, '|') : 'png|jpe?g|gif';
			return this.optional(element) || value.match(new RegExp('.(' + param + ')$', 'i'));
		}, BX.message('JS_FILE_EXT')
	);

	$.validator.addMethod(
		'captcha', function( value, element, params ){
			return $.validator.methods.remote.call(this, value, element,{
				url: arPriorityOptions['SITE_DIR'] + 'ajax/check-captcha.php',
				type: 'post',
				data:{
					captcha_word: value,
					captcha_sid: function(){
						return $(element).closest('form').find('input[name="captcha_sid"]').val();
					}
				}
			});
		},
		BX.message('JS_ERROR')
    );

    $.validator.addMethod(
		'recaptcha', function(value, element, param){
			var id = $(element).closest('form').find('.g-recaptcha').attr('data-widgetid');
			if(typeof id !== 'undefined'){
				return grecaptcha.getResponse(id) != '';
			}
			else{
				return true;
			}
		}, BX.message('JS_RECAPTCHA_ERROR')
	);

	/*reload captcha*/
	$('body').on( 'click', '.refresh', function(e){
		e.preventDefault();
		$.ajax({
			url: arPriorityOptions['SITE_DIR'] + 'ajax/captcha.php'
		}).done(function(text){
			if($('.captcha_sid').length)
			{
				$('.captcha_sid').val(text);
				$('.captcha_img').attr('src', '/bitrix/tools/captcha.php?captcha_sid=' + text);
			}
		});
	});

	$.validator.addClassRules({
		'phone':{
			regexp: arPriorityOptions['THEME']['VALIDATE_PHONE_MASK']
		},
		'confirm_password':{
			equalTo: 'input.password',
			minlength: 6
		},
		'password':{
			minlength: 6
		},
		'inputfile':{
			extension: arPriorityOptions['THEME']['VALIDATE_FILE_EXT'],
			filesize: 5000000
		},
		'datetime':{
			datetime: ''
		},
		'captcha':{
			captcha: ''
		},
		'recaptcha':{
			recaptcha: ''
		}
	});

	$.validator.setDefaults({
	   highlight: function( element ){
			$(element).parent().addClass('error');
		},
		unhighlight: function( element ){
			$(element).parent().removeClass('error');
		}
	});

	InitFlexSlider();

	// for check flexslider bug in composite mode
	// TODO: on frame data ricieved
	/*waitingNotExists('.detail .galery #slider', '.detail .galery #slider .flex-viewport', 1000, function() {
		InitFlexSlider();
		setTimeout(function() {
			$(window).resize();
		}, 350);
	});*/

	/*check mobile device*/
	if(jQuery.browser.mobile){
		$('.select-outer .sort_desktop .dropdown').hide();
		$('.select-outer select').addClass('mobile');
	}

	$(document).on('click', '*[data-event="jqm"]:not(.disabled)', function(e){
		if(jQuery.browser.mobile && $(this).data('param-id') != 'map'){
			e.preventDefault();
			var _this = $(this);
			var name = _this.data('name');

			if(window.matchMedia('(min-width:992px)').matches)
			{
				e.stopPropagation();
				$(this).jqmEx();
				$(this).trigger('click');
			}
			else if(name.length){
				var script = arPriorityOptions['SITE_DIR'] + 'form/';
				var paramsStr = ''; var arTriggerAttrs = {};
				$.each(_this.get(0).attributes, function(index, attr){
					var attrName = attr.nodeName;
					var attrValue = _this.attr(attrName);
					arTriggerAttrs[attrName] = attrValue;
					if(/^data\-param\-(.+)$/.test(attrName)){
						var key = attrName.match(/^data\-param\-(.+)$/)[1];
						paramsStr += key + '=' + attrValue + '&';
					}
				});

				var triggerAttrs = JSON.stringify(arTriggerAttrs);
				var encTriggerAttrs = encodeURIComponent(triggerAttrs);
				script += '?name=' + name + '&' + paramsStr + 'data-trigger=' + encTriggerAttrs;
				location.href = script;
			}
		}
		else{
			e.preventDefault();
			e.stopPropagation();
			$(this).jqmEx();
			$(this).trigger('click');
		}
	});

	$(document).on('click', '.item-views.services-items .menu li span', function(){
		var _this = $(this),
			_thisText = _this.text();

		if(!_this.parent().hasClass('selected')){
			var index = _this.parent().index(),
				animationTime = (window.matchMedia('(max-width: 767px)').matches ? 0 : 200);

			_this.closest('ul').find('li').removeClass('selected');
			_this.parent().addClass('selected');

			_this.closest('.item-views').find('.items .item').fadeOut(animationTime);
			setTimeout(function(){
				_this.closest('.item-views').find('.items .item').eq(index).fadeIn(animationTime);
			}, animationTime);
		}

		_this.closest('.left_block').find('.menu_item_selected').text(_thisText);
	});

	$(document).on('click', '.item-views.services-items .arrows .arrow', function(){
		var _this = $(this),
			maxElementIndex = _this.closest('.items').find('.item').length - 1,
			activeElementIndex = _this.closest('.item').index();

		if(_this.hasClass('next')){
			var newActiveElementIndex = (activeElementIndex + 1 > maxElementIndex ? 0 : activeElementIndex + 1);

		}
		else if(_this.hasClass('prev')){
			var newActiveElementIndex = (activeElementIndex - 1 < 0 ? maxElementIndex : activeElementIndex - 1);
		}

		_this.closest('.item-views').find('.menu li').eq(newActiveElementIndex).find('span').click();
	});

	$(document).on('click', '.item-views.services-items .menu_item_selected', function(e){
		e.stopPropagation();
		var _this = $(this);

		_this.toggleClass('opened');
		_this.closest('.left_block').find('.menu').slideToggle(200);
	});

	$(document).on('click', 'body', function(){
		if(window.matchMedia('(max-width: 767px)').matches){
			$('.item-views.services-items .left_block .menu_item_selected').removeClass('opened');
			$('.item-views.services-items .left_block .menu').slideUp(200);
		}
	});

	$(document).on('click', '.animate-load', function(){
		if(!$(this).hasClass('disabled')){
			$(this).parent().addClass('loadings');
		}
	});

	$(document).on('touchmove', '.overflow_html body', function(e) {
		e.stopPropagation();
		e.preventDefault();
	});

	if($('.basket_top .dropdown').length){
		$('.ajax_basket .dropdown').each(function(indx){
			var basketItemsDropdown = $(this).detach();
			$('.wrap_basket').append(basketItemsDropdown);
			$('.wrap_basket .dropdown .items').eq(indx).mCustomScrollbar({
				mouseWheel: {preventDefault: true},
			});

		});
	}

	if($('.basket.fly').length){
		$('.basket.fly>.wrap').mCustomScrollbar({
			mouseWheel: {preventDefault: true},
		});
	}

	BX.addCustomEvent('onCompleteAction', function(eventdata, _this){
		try{
			if(eventdata.action === 'loadForm')
			{
				$(_this).parent().removeClass('loadings');
			}
			else if(eventdata.action === 'loadBasket')
			{
				var basket_link = $('.basket-link');
				if(basket_link.length)
				{
					basket_link.attr('title', $(_this).find('a').attr('title'));
					if($('.basket_top .dropdown').length){
						$('.ajax_basket .dropdown').each(function(indx){
							var basketItemsDropdown = $(this).html();
							$('.wrap_basket .dropdown').eq(indx).html(basketItemsDropdown);
							$('.wrap_basket .dropdown .items').eq(indx).mCustomScrollbar({
								mouseWheel: {preventDefault: true},
							});

						});
					}

					if($(_this).find('a .count').length){
						var count = basket_link.find('.count').length ? $(_this).find('.count').text() : $(_this).find('.count').text();
						basket_link.find('.prices').text($(_this).find('.icon').data('summ'));
						if(basket_link.find('.count').length)
						{
							basket_link.find('.count').text(count);
							if(count)
								basket_link.addClass('basket-count');
							else
								basket_link.removeClass('basket-count');
						}
						else
						{
							basket_link.find('.js-basket-block').append($(_this));
							basket_link.addClass('basket-count');
							//CheckHeaderFixedMenu();
						}

						$('#mobilemenu .menu .ready .count').text(count);
						if(count){
							$('#mobilemenu .menu .ready .count').removeClass('empted');
						}
						else{
							$('#mobilemenu .menu .ready .count').addClass('empted');
						}
					}

					/*
					else
					{
						basket_link.find('.count').remove();
						basket_link.removeClass('basket-count');
						CheckHeaderFixedMenu();
					}*/
				}
			}
			else if(eventdata.action === 'loadRSS')
			{
			}
			else if(eventdata.action === 'ajaxContentLoaded')
			{
				setBasketItemsClasses();
				$('.catalog.item-views.table .item .props').mCustomScrollbar({
					mouseWheel: {preventDefault: true},
				});

				$('.catalog.item-views.table .item .title').sliceHeight({});
				$('.catalog.item-views.table .item .item .cont').sliceHeight({});
				$('.catalog.item-views.table .item .slice_price').sliceHeight({});
				$('.catalog.item-views.table .item .image>.wrap').sliceHeight({lineheight: -3});
				$('.catalog.item-views.table .item').sliceHeight({classNull: '.footer-button'});

				$('.item .delivery').mouseenter(function(){
					$(this).closest('.inner-wrap').css('overflow', 'visible');
				});

				$('.item .delivery').mouseleave(function(){
					var _this = $(this);
					setTimeout(function(){
						_this.closest('.inner-wrap').css('overflow', 'hidden');
					}, 100);
				});
			}
		}
		catch(e){
			console.error(e)
		}
	})

	BX.addCustomEvent('onCounterGoals', function(eventdata){
		if(arPriorityOptions['THEME']['YA_GOLAS'] == 'Y' && arPriorityOptions['THEME']['YA_COUNTER_ID'])
		{
			var idCounter = arPriorityOptions['THEME']['YA_COUNTER_ID'];
			idCounter = parseInt(idCounter);

			if(typeof eventdata != 'object')
				eventdata = {goal: 'undefined'};

			if(typeof eventdata.goal != 'string')
				eventdata.goal = 'undefined';

			if(idCounter)
			{
				try
				{
					waitCounter(idCounter, 50, function(){
						var obCounter = window['yaCounter' + idCounter];
						if(typeof obCounter == 'object'){
							obCounter.reachGoal(eventdata.goal);
						}
					});
				}
				catch(e)
				{
					console.error(e)
				}
			}
			else
			{
				console.info('Bad counter id!', idCounter);
			}
		}
	})

	/* show print */
	if(arPriorityOptions['THEME']['PRINT_BUTTON'] == 'Y')
	{
		setTimeout(function(){
			if($('.detail.news .top-wrapper').length){
					if($('.detail.news .top-wrapper .rss-block.top').length)
					{
						$('<div class="print-link"><svg class="svg svg-print" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path id="Rectangle_665_copy_4" data-name="Rectangle 665 copy 4" class="cls-print" d="M1570,210h-2v3h-8v-3h-2a2,2,0,0,1-2-2v-5a2,2,0,0,1,2-2h2v-4h8v4h2a2,2,0,0,1,2,2v5A2,2,0,0,1,1570,210Zm-8,1h4v-4h-4v4Zm4-12h-4v2h4v-2Zm4,4h-12v5h2v-3h8v3h2v-5Z" transform="translate(-1556 -197)"/></svg></div>').insertAfter($('.detail.news .top-wrapper .rss'));
					}
					else if($('.detail.news .top-wrapper .rss').length)
					{
						$('<div class="print-link"><svg class="svg svg-print" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path id="Rectangle_665_copy_4" data-name="Rectangle 665 copy 4" class="cls-print" d="M1570,210h-2v3h-8v-3h-2a2,2,0,0,1-2-2v-5a2,2,0,0,1,2-2h2v-4h8v4h2a2,2,0,0,1,2,2v5A2,2,0,0,1,1570,210Zm-8,1h4v-4h-4v4Zm4-12h-4v2h4v-2Zm4,4h-12v5h2v-3h8v3h2v-5Z" transform="translate(-1556 -197)"/></svg></div>').insertAfter($('.detail.news .top-wrapper .rss'));
					}
					else if($('.detail.news .top-wrapper').length){
						$('<div class="print-link"><svg class="svg svg-print" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path id="Rectangle_665_copy_4" data-name="Rectangle 665 copy 4" class="cls-print" d="M1570,210h-2v3h-8v-3h-2a2,2,0,0,1-2-2v-5a2,2,0,0,1,2-2h2v-4h8v4h2a2,2,0,0,1,2,2v5A2,2,0,0,1,1570,210Zm-8,1h4v-4h-4v4Zm4-12h-4v2h4v-2Zm4,4h-12v5h2v-3h8v3h2v-5Z" transform="translate(-1556 -197)"/></svg></div>').prependTo($('.detail.news .top-wrapper'));
					}
			}
			else{
				if($('.page-top .rss-block.top').length)
				{
					$('<div class="print-link"><svg class="svg svg-print" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path id="Rectangle_665_copy_4" data-name="Rectangle 665 copy 4" class="cls-print" d="M1570,210h-2v3h-8v-3h-2a2,2,0,0,1-2-2v-5a2,2,0,0,1,2-2h2v-4h8v4h2a2,2,0,0,1,2,2v5A2,2,0,0,1,1570,210Zm-8,1h4v-4h-4v4Zm4-12h-4v2h4v-2Zm4,4h-12v5h2v-3h8v3h2v-5Z" transform="translate(-1556 -197)"/></svg></div>').insertAfter($('.page-top .share'));
				}
				else if($('.page-top .rss').length)
				{
					$('<div class="print-link"><svg class="svg svg-print" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path id="Rectangle_665_copy_4" data-name="Rectangle 665 copy 4" class="cls-print" d="M1570,210h-2v3h-8v-3h-2a2,2,0,0,1-2-2v-5a2,2,0,0,1,2-2h2v-4h8v4h2a2,2,0,0,1,2,2v5A2,2,0,0,1,1570,210Zm-8,1h4v-4h-4v4Zm4-12h-4v2h4v-2Zm4,4h-12v5h2v-3h8v3h2v-5Z" transform="translate(-1556 -197)"/></svg></div>').insertAfter($('.page-top .rss'));
				}
				else if($('.page-top h1').length){
					$('<div class="print-link"><svg class="svg svg-print" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path id="Rectangle_665_copy_4" data-name="Rectangle 665 copy 4" class="cls-print" d="M1570,210h-2v3h-8v-3h-2a2,2,0,0,1-2-2v-5a2,2,0,0,1,2-2h2v-4h8v4h2a2,2,0,0,1,2,2v5A2,2,0,0,1,1570,210Zm-8,1h4v-4h-4v4Zm4-12h-4v2h4v-2Zm4,4h-12v5h2v-3h8v3h2v-5Z" transform="translate(-1556 -197)"/></svg></div>').insertBefore($('.page-top h1'));
				}
			}
			// else
				// $('footer .print-block').html('<div class="print-link"><i class="svg svg-print"><svg id="Print.svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path class="cls-1" d="M1553,287h-2v3h-8v-3h-2a2,2,0,0,1-2-2v-5a2,2,0,0,1,2-2h2v-4h8v4h2a2,2,0,0,1,2,2v5A2,2,0,0,1,1553,287Zm-8,1h4v-4h-4v4Zm4-12h-4v2h4v-2Zm4,4h-12v5h2v-3h8v3h2v-5Z" transform="translate(-1539 -274)"/></svg></i></div>');
		},150);
	}

	$(document).on('click', '.print-link', function(){
		window.print();
	})

	$('.head-block .item-link').on('click', function(){
		var _this = $(this);
		_this.siblings().removeClass('active');
		_this.addClass('active');
	})

	$('table.table').each(function(){
		var _this = $(this),
			first_td = _this.find('thead tr th');
		if(!first_td.length)
			first_td = _this.find('thead tr td');
		if(first_td.length)
		{
			var j = 0;
			_this.find('tbody tr td').each(function(i){
				if(j > first_td.length-1)
					j = 0;

				$('<div class="th-mobile">'+first_td[j].textContent+'</div>').appendTo($(this));
				j++;
			})
		}
	})

	$('[data-toggle=tab][href=#video]').on('click', function(){
		$(window).resize();
	});

	$('.shares-block').on('click', function(e){
		if(isMobile){
			e.stopPropagation();
			$(this).addClass('showen');
		}
	});

	$('.shares-block .ya-share2').on('touchstart', function(e){
		if(isMobile){
			e.stopPropagation();
		}
	});

	$('body').on('touchstart', function(){
		if(isMobile){
			$('.shares-block').removeClass('showen');
		}
	});

	$('a.fancybox').fancybox({
		padding: [40,40,64,40],
		opacity: true,
		tpl: {
			prev: '<a title="'+BX.message('FANCY_PREV')+'" class="fancybox-nav fancybox-prev"><span></span></a>',
			next: '<a title="'+BX.message('FANCY_NEXT')+'" class="fancybox-nav fancybox-next"><span></span></a>',
			closeBtn: '<a title="'+BX.message('FANCY_CLOSE')+'" class="fancybox-item fancybox-close" href="javascript:;"><svg class="svg svg-close" width="14" height="14" viewBox="0 0 14 14"><path data-name="Rounded Rectangle 568 copy 16" d="M1009.4,953l5.32,5.315a0.987,0.987,0,0,1,0,1.4,1,1,0,0,1-1.41,0L1008,954.4l-5.32,5.315a0.991,0.991,0,0,1-1.4-1.4L1006.6,953l-5.32-5.315a0.991,0.991,0,0,1,1.4-1.4l5.32,5.315,5.31-5.315a1,1,0,0,1,1.41,0,0.987,0.987,0,0,1,0,1.4Z" transform="translate(-1001 -946)"></path></svg></a>',
		},
		touch: 'enabled',
		beforeShow: function(event){
			if(!$('.cd-modal-bg').hasClass('is-visible')){
				var scaleValue = retrieveScale($('.cd-modal-bg'));

				$('.cd-modal-bg').show().addClass('is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
					animateLayer($('.cd-modal-bg'), scaleValue, true);
				});
			}
			$('.detail .galery .overlay_form').hide();
		},
		afterShow: function(){
			if($('.fancybox-overlay').css('opacity') == 0){
				setTimeout(function(){
					$('.fancybox-overlay').css('opacity', 1);
					$('html').addClass('overflow_html');
				}, 200);
			}

			$('.fancybox-nav').css('opacity', 0);
			setTimeout(function(){
				$('.fancybox-nav').css('opacity', 1);
			}, 150);
			if($('.fancybox-wrap #company_video').length){
				var fancyHeight = $('.fancybox-wrap').height();
				$('.fancybox-inner').height(fancyHeight);
				setTimeout(function(){
					$('.fancybox-wrap video').resize();
					setTimeout(function(){
						$('.fancybox-wrap').addClass('show_video');
						document.getElementById('company_video').currentTime = 0;
						document.getElementById('company_video').play();
					}, 300);
				}, 150);
			}
		},
		beforeClose: function(){
			closeModal();
			$('.fancybox-overlay').fadeOut();
			if($('#company_video').length){
				document.getElementById('company_video').currentTime = 0;
			}
			$('html').removeClass('overflow_html');
		},
		onClosed: function(){
			if($('.fancybox-wrap #company_video').length){
				document.getElementById('company_video').pause();
			}
		},
	});

	/*$(document).on('click', '.fancybox-wrap', function(e){
		if(!$(e.target).hasClass('fancybox-skin') && !$(e.target).closest('.fancybox-skin').length){
			$(this).find('.fancybox-close').click();
		}
	});*/

	/* flex pagination */
	$('.flex-viewport .item').on('mouseenter', function(){
		$(this).closest('.flexslider').find('.flex-control-nav').toggleClass('noz');
		$(this).closest('.flexslider').find('.flex-control-nav').css('z-index','0');
	})
	$('.flex-viewport .item').on('mouseleave', function(){
		$(this).closest('.flexslider').find('.flex-control-nav').toggleClass('noz');
		$(this).closest('.flexslider').find('.flex-control-nav').css('z-index','2');
	})

	/* ajax more items */
	$(document).on('click', '.ajax_load_btn', function(){
		var url=$(this).closest('.bottom_nav').find('.module-pagination .flex-direction-nav .flex-next').attr('href'),
			th=$(this).find('.more_text_ajax');
		if(!th.hasClass('loading'))
		{
			th.addClass('loading');
			var objUrl = parseUrlQuery(),
				add_url = '',
				obData = {"AJAX_REQUEST": "Y"};
			if('clear_cache' in objUrl)
			{
				if(objUrl.clear_cache == 'Y')
					add_url = '&clear_cache=Y';
			}
			if($('.banners-small.front').length)
			{
				obData.MD = $('.banners-small.front').find('.items').data('colmd');
				obData.SM = $('.banners-small.front').find('.items').data('colsm');
			}

			$.ajax({
				url: url+''+add_url,
				data: BX.ajax.prepareData(obData),
				success: function(html){

					if($('.banners-small.front').length)
					{
						$('.banners-small .items.row').append(html);
						$('.bottom_nav').html($('.banners-small .items.row .bottom_nav').html());
						$('.banners-small .items.row .bottom_nav').remove();
					}
					else
					{
						$(html).insertBefore($('.blog .bottom_nav'));
						$('.bottom_nav').html($('.blog .bottom_nav:hidden').html());
						$('.blog .bottom_nav:hidden').remove();
					}

					var eventdata = {action:'ajaxContentLoaded'};
					BX.onCustomEvent('onCompleteAction', [eventdata, th[0]]);

					setTimeout(function(){
						$('.banners-small .item.normal-block').sliceHeight();
						th.removeClass('loading');
					}, 100);
				}
			})
		}
	})

	$(document).on('click', '.front .ajax_btn .btn', function(){
		var _this = $(this),
			parent = _this.parent(),
			params = _this.data('params'),
			template = _this.data('template'),
			templateName = _this.data('template_name');

			if(_this.closest('.change_block').length){
				/*_this.closest('.item-views').remove();
				html = _this.closest('.change_block').html();
				html = $(html).find('>.wrap').empty();*/
				//$(html).find('.item-views').remove();

				//console.log(html);
				var changerID = _this.closest('.change_block').attr('id'),
					changerArrowLeft = _this.closest('.change_block').find('.change_params.left_params'),
					changerArrowLeftTitle = changerArrowLeft.attr('title'),
					changerArrowLeftParamValue = changerArrowLeft.data('param_value'),
					changerArrowRight = _this.closest('.change_block').find('.change_params.right_params'),
					changerArrowRightTitle = changerArrowRight.attr('title'),
					changerArrowRightParamValue = changerArrowRight.data('param_value'),
					changerParamName = changerArrowLeft.data('param_name'),
					changerType = changerArrowLeft.data('type'),
					changerComponentTemplate = changerArrowLeft.data('component_template'),
					changerHtml = ''
									+'<div id="'+changerID+'" class="change_block">'
										+'<span class="top_border_changer"></span>'
										+'<span class="right_border_changer"></span>'
										+'<span class="bottom_border_changer"></span>'
										+'<span class="left_border_changer"></span>'
										+_this.closest('.change_block').find('.change_params.left_params').clone()[0].outerHTML
										/*+'<span class="change_params left_params" title="'+changerArrowLeftTitle+'" data-param_name="'+changerParamName+'" data-param_value="'+changerArrowLeftParamValue+'" data-type="'+changerType+'" data-component_template="'+changerComponentTemplate+'">'
											+_this.closest('.change_block').find('.change_params.left_params').detach().html()
										+'</span>'*/
										/*+'<div class="actions">'
											+_this.closest('.change_block').find('.actions').detach().html()
										+'</div>'*/
										+_this.closest('.change_block').find('.actions').clone()[0].outerHTML
										+'<div class="wrap"></div>'
										+_this.closest('.change_block').find('.change_params.right_params').clone()[0].outerHTML
										/*+'<span class="change_params right_params" title="'+changerArrowRightTitle+'" data-param_name="'+changerParamName+'" data-param_value="'+changerArrowRightParamValue+'" data-type="'+changerType+'" data-component_template="'+changerComponentTemplate+'">'
											+_this.closest('.change_block').find('.change_params.right_params').detach().html()
										+'</span>'*/
										+_this.closest('.change_block').find('.variant_panel').clone()[0].outerHTML
										/*+'<div class="variant_panel '+changerID+'">'
											+_this.closest('.change_block').find('.variant_panel').detach().html()
										+'</div>'*/
									'</div>';


									//_this.closest('.change_block').find('.right_border_changer').clone();
								//+_this.closest('.change_block').find('.right_border_changer').detach()
								//+'<span class="bottom_border_changer"></span>'
								//+'<span class="left_border_changer"></span>'

			}

		if(!parent.hasClass('loadings')){
			parent.addClass('loadings');

			$.ajax({
				data: {AJAX_POST: 'Y', AJAX_PARAMS: params, TEMPLATE: template, TEMPLATE_NAME: templateName},
				type: 'POST',
				url: arPriorityOptions['SITE_DIR'] + 'include/mainpage/comp_news.php',
				success: function(html){
					if(changerHtml){
						_this.closest('.ajax_reload').html(changerHtml);
						$('#'+changerID+'.change_block>.wrap').html(html);
						$('#'+changerID+'.change_block .variant_flexslider').flexslider({
							animation: "slide",
							itemWidth: ($('#'+changerID+'.change_block .variant_flexslider').hasClass('wimage') ? 155 : 47),
							itemMargin: 10,
							controlNav: false,
							slideshow: false,
							prevText: '<svg width="7" height="10" viewBox="0 0 7 10"><path d="M894.306,249.7l4.972,4a1,1,0,0,0,1.42,0,1.011,1.011,0,0,0,.293-0.706H901v-8h-0.01a1,1,0,0,0-1.712-.727l-4.972,4A1.013,1.013,0,0,0,894.306,249.7Z" transform="translate(-894.031 -244)"/></svg>',
							nextText: '<svg width="7" height="10" viewBox="0 0 7 10"><path d="M891.724,249.7l-4.994,4a1.008,1.008,0,0,1-1.721-.706H885v-8h0.01a1.007,1.007,0,0,1,1.72-.727l4.994,4A1.012,1.012,0,0,1,891.724,249.7Z" transform="translate(-885 -244)"/></svg>',
						});

						$('#'+changerID+'.change_block .variant_flexslider .variant .title').sliceHeight({allElements: true});
						$('#'+changerID+'.change_block .variant_flexslider .variant .image').sliceHeight({allElements: true});
						$(window).resize();
					}
					else{
						_this.closest('.ajax_reload').html(html);
					}

					$('.ajax_reload .item-views').each(function(){
						$(this).find('.item:not(.wti) .body-info').sliceHeightRandomWidth({'row': '.row'});
						$(this).find('.item:not(.wti)>.wrap').sliceHeightRandomWidth({'row': '.row'});
						$(this).find('.item>.wrap').sliceHeightRandomWidth({'row': '.row'});
						$(this).find('.item').sliceHeightRandomWidth({'row': '.row'});
					});
					setTimeout(function(){
						_this.closest('.item-views').wrap('<div class="wrap"></div>');
					}, 3000);

					TemplateTarifsScript();
					setBasketItemsClasses();
				}
			});
		}
	});

	/* bug fix in ff*/
	$('img').removeAttr('draggable');

	clicked_tab = 0;

	$('.title-tab-heading').on('click', function(){
		var container = $(this).closest('.tab-pane'),
			nav = $(this).closest('.tabs').find('.nav'),
			slide_block = $(this).next();

		clicked_tab = container.index()+1;

		container.siblings().removeClass('active');
		container.siblings().find('.title-tab-heading + div').hide();

		$('.catalog.detail .nav.nav-tabs li').removeClass('active');
		nav.find('li').removeClass('active');

		if(container.hasClass('active'))
		{
			slide_block.slideUp(200, function(){

				container.removeClass('active');
				nav.find('li:eq('+container.index()+')').removeClass('active');
			});
		}
		else
		{
			container.addClass('active');
			scrollToBlock(container);
			nav.find('li:eq('+container.index()+')').addClass('active');
			slide_block.slideDown();
		}
	})

	// Responsive Menu Events
	var addActiveClass = false;
	$('#mainMenu li.dropdown > a > i, #mainMenu li.dropdown-submenu > a > i').on('click', function(e){
		e.preventDefault();
		if($(window).width() > 979) return;
		addActiveClass = $(this).closest('li').hasClass('resp-active');
		// $('#mainMenu').find('.resp-active').removeClass('resp-active');
		if(!addActiveClass){
			$(this).closest("li").addClass("resp-active");
		}else{
			$(this).closest("li").removeClass("resp-active");
		}
	});

	/*animate increment*/
	$('.spincrement').counterUp({
		delay: 80,
    	time: 1000
	});

	$('.bx_filter_input_container input[type=text]').numeric({allow:"."});

	/* search sync */
	$(document).on('keyup', '.search-input-div input', function(e){
		var inputValue = $(this).val();
		$('.search-input-div input').val(inputValue);

		if($(this).closest('#headerfixed').length)
		{
			if(e.keyCode == 13)
				$('.search form').submit();
		}
	});
	$(document).on('click', '.search-button-div button', function(e){
		if($(this).closest('#headerfixed').length)
			$('.search form').submit();
	});
	$(document).on('click', '.item-views.services-items .menu li span', function(){
		var _this = $(this),
			_thisText = _this.text();

		if(!_this.parent().hasClass('selected')){
			var index = _this.parent().index(),
				animationTime = (window.matchMedia('(max-width: 767px)').matches ? 0 : 200);

			_this.closest('ul').find('li').removeClass('selected');
			_this.parent().addClass('selected');

			_this.closest('.item-views').find('.items .item').fadeOut(animationTime);
			setTimeout(function(){
				_this.closest('.item-views').find('.items .item').eq(index).fadeIn(animationTime);
			}, animationTime);
		}
		_this.closest('.left_block').find('.menu_item_selected').text(_thisText);
		setTimeout(function(){
			var height = _this.closest('.change_block').find('>.wrap').outerHeight();
			_this.closest('.change_block').height(height);
		}, 300);
	});

	$(document).on('click', '.item-views.services-items .arrows .arrow', function(){
		var _this = $(this),
			maxElementIndex = _this.closest('.items').find('.item').length - 1,
			activeElementIndex = _this.closest('.item').index();

		if(_this.hasClass('next')){
			var newActiveElementIndex = (activeElementIndex + 1 > maxElementIndex ? 0 : activeElementIndex + 1);

		}
		else if(_this.hasClass('prev')){
			var newActiveElementIndex = (activeElementIndex - 1 < 0 ? maxElementIndex : activeElementIndex - 1);
		}

		_this.closest('.item-views').find('.menu li').eq(newActiveElementIndex).find('span').click();

		var height = _this.closest('.change_block').find('>.wrap').outerHeight();
		_this.closest('.change_block').height(height);
	});

	$('.mega_fixed_menu').mCustomScrollbar({
		mouseWheel: {preventDefault: true},
	});
	$(document).on('click', '.inline-search-show, .inline-search-hide', function(e){
		if(window.matchMedia('(min-width: 600px)').matches)
		{
			if(arPriorityOptions['THEME']['TYPE_SEARCH'] == 'fixed'){
				$('.inline-search-block').addClass('fixed');
				$('.inline-search-block').toggleClass('show');
				if($('.inline-search-block').hasClass('show')){
					$('.inline-search-block').find('.search-input').focus();
				}

				if($('.top-block').length)
				{
					if($('.inline-search-block').hasClass('show'))
						$('.inline-search-block').css('background', $('.top-block').css('background-color'));
					else
						$('.inline-search-block').css('background', '#fff');
				}
				if(arPriorityOptions['THEME']['TYPE_SEARCH'] == 'fixed')
				{
					if($('.inline-search-block').hasClass('show'))
						$('<div class="jqmOverlay_search"></div>').appendTo('body');
					else{
						setTimeout(function(){
							$('.jqmOverlay_search').detach();
						}, 300);
					}
				}
			}
			else{
				if($(this).hasClass('inline-search-show')){
					var scaleValue = retrieveScale($('.cd-modal-bg'));

					$('.cd-modal-bg').show().addClass('is-visible').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
						animateLayer($('.cd-modal-bg'), scaleValue, true);
					});
					setTimeout(function(){
						if(!$('.inline-search-block').hasClass('fixed_center_show')){
							$('.inline-search-block').addClass('fixed_center_show show');
							$('.close-block.search_type_1').addClass('show');
						}

						if($('.inline-search-block').hasClass('show')){
							$('.inline-search-block').find('.search-input').focus();
						}
					}, 500);
				}
				else{
					closeModal();
					if($('.inline-search-block').hasClass('fixed_center_show')){
						$('.inline-search-block').removeClass('fixed_center_show show');
						$('.close-block.search_type_1').removeClass('show');
					}
				}

			}
		}
		else{
			window.location.href = arPriorityOptions['SITE_DIR'] + 'search/';
		}
	})

	/*$('body').on('click', function(){
		$('.title-search-result.title-search-input_mega_menu').addClass('closed');
	});*/

	if($('.styled-block .row > div.col-md-3').length){
		BX.addCustomEvent('onWindowResize', function(eventdata) {
			try{
				ignoreResize.push(true);
				$('.styled-block .row > div.col-md-3').each(function() {
					$(this).css({'height': '', 'line-height': ''});
					var z = parseInt($('.body_media').css('top'));
					if(z > 0){
						var rowHeight = $(this).parents('.row').first().actual('outerHeight');
						$(this).css({'height': rowHeight + 'px', 'line-height' : rowHeight + 'px'});
					}
				});
							}
			catch(e){}
			finally{
				ignoreResize.pop();
			}
		});
	}

	if($('.order-block').length){
		BX.addCustomEvent('onWindowResize', function(eventdata) {
			try{
				ignoreResize.push(true);
				$('.order-block').each(function() {
					var cols = $(this).find('.row > div');
					if(cols.length){
						var colFirst = cols.first();
						var colLast = cols.last();
						var colText = colFirst.find('.text');
						var bText = colText.length;
						var bOnlyText = cols.length === 1 && bText;
						var bPrice = colFirst.find('.price').length;
						var z = parseInt($('.body_media').css('top'));

						cols.css({'height': '', 'padding-top': '', 'padding-bottom': ''});
						colText.css({'height': '', 'padding-top': '', 'padding-bottom': ''});
						if((!bPrice && z > 0) || (bPrice && z > 1)){
							var minHeight = 83;

							if(!bOnlyText){
								var colLast_height = colLast.outerHeight();
								colLast_height = colLast_height >= minHeight ? colLast_height : minHeight;
							}

							if(bText){
								var colFirst_height = colFirst.outerHeight();
								colFirst_height = colFirst_height >= minHeight ? colFirst_height : minHeight;
							}

							var colMax_height = (bText ? (!bOnlyText ? (colLast_height >= colFirst_height ? colLast_height : colFirst_height) : colLast_height) : colFirst_height);

							if(!bOnlyText){
								var textPadding = 41 + (colMax_height - colFirst.outerHeight()) / 2;
								colLast.find('.btns').css({'padding-top': textPadding + 'px', 'padding-bottom': textPadding + 'px', 'height': colMax_height + 'px'});
							}
							if(bText){
								colLast.css({'height': colMax_height + 'px'});
								var textPadding = 41 + (colMax_height - colText.outerHeight()) / 2;
								colText.css({'padding-top': textPadding + 'px', 'padding-bottom': textPadding + 'px', 'height': colMax_height + 'px'});
							}
						}
					}
				});
			}
			catch(e){}
			finally{
				ignoreResize.pop();
			}
		});
	}

	if($('.equal-padding').length)
	{
		BX.addCustomEvent('onWindowResize', function(eventdata){
			try{
				ignoreResize.push(true);
				$('.equal-padding').each(function() {
					$(this).find('.text').css({'padding-top': '0px', 'padding-bottom': '0px'});
					var equal_block = $(this).siblings('.equals'),
						height = $(this).actual('outerHeight');

					delta = Math.round((equal_block.actual('outerHeight') - height)/2);
					if(delta)
						$(this).find('.text').css({'padding-top': delta+'px', 'padding-bottom': delta+'px'});
				})
			}
			catch(e){}
			finally{
				ignoreResize.pop();
			}
		});
	}

	$(document).on('click', '.mega-menu .dropdown-menu', function(e){
		e.stopPropagation()
	});

	$(document).on('click', '.mega-menu .dropdown-toggle.more-items', function(e){
		e.preventDefault();
	});

	$(document).on('mouseenter', '.table-menu .dropdown,.table-menu .dropdown-submenu,.table-menu .dropdown-toggle', function() {
		CheckTopVisibleMenu();
	});

	$('.mega-menu .search-item .search-icon, .menu-row #title-search .fa-close').on('click', function(e) {
		e.preventDefault();
		$('.menu-row #title-search').toggleClass('hide');
	});

	$('.mega-menu ul.nav .search input').on('keyup', function(e) {
		var inputValue = $(this).val();
		$('.menu-row > .search input').val(inputValue);
		if(e.keyCode == 13){
			$('.menu-row > .search form').submit();
		}
	});

	$('.menu-row > .search input').on('keyup', function(e) {
		var inputValue = $(this).val();
		$('.mega-menu ul.nav .search input').val(inputValue);
		if(e.keyCode == 13){
			$('.menu-row > .search form').submit();
		}
	});

	$('.mega-menu ul.nav .search button').on('click', function(e) {
		e.preventDefault();
		var inputValue = $(this).parents('.search').find('input').val();
		$('.menu-and-search .search input').val(inputValue);
		$('.menu-row > .search form').submit();
	});

	$('.filter .calendar').on('click', function() {
		var button = $(this).next();
		if(button.hasClass('calendar-icon')){
			button.trigger('click');
		}
	});

	/*sliceheights*/
	if($('.banners-small .item.normal-block').length)
		$('.banners-small .item.normal-block').sliceHeight();
	if($('.teasers .item').length)
		$('.teasers .item').sliceHeight();
	if($('.wrap-portfolio-front .row.items > div').length)
		$('.wrap-portfolio-front .row.items > div').sliceHeight({'row': '.row.items', 'item': '.item1'});

	SliceHeightBlocks();

	/* toggle */
	var $this = this,
		previewParClosedHeight = 25;

	$('section.toggle > label').prepend($('<i />').addClass('fa fa-plus'));
	$('section.toggle > label').prepend($('<i />').addClass('fa fa-minus'));
	$('section.toggle.active > p').addClass('preview-active');
	$('section.toggle.active > div.toggle-content').slideDown(350, function() {});

	$('section.toggle > label').click(function(e){
		var parentSection = $(this).parent(),
			parentWrapper = $(this).parents('div.toogle'),
			previewPar = false,
			isAccordion = parentWrapper.hasClass('toogle-accordion');

		if(isAccordion && typeof(e.originalEvent) != 'undefined') {
			parentWrapper.find('section.toggle.active > label').trigger('click');
		}

		parentSection.toggleClass('active');

		// Preview Paragraph
		if( parentSection.find('> p').get(0) ){
			previewPar = parentSection.find('> p');
			var previewParCurrentHeight = previewPar.css('height');
			previewPar.css('height', 'auto');
			var previewParAnimateHeight = previewPar.css('height');
			previewPar.css('height', previewParCurrentHeight);
		}

		// Content
		var toggleContent = parentSection.find('> div.toggle-content');

		if( parentSection.hasClass('active') ){
			$(previewPar).animate({
				height: previewParAnimateHeight
			}, 350, function() {
				$(this).addClass('preview-active');
			});
			toggleContent.slideDown(350, function() {});
		}
		else{
			$(previewPar).animate({
				height: previewParClosedHeight
			}, 350, function() {
				$(this).removeClass('preview-active');
			});
			toggleContent.slideUp(350, function() {});
		}
	});

	/* accordion */
	$('.accordion-head').on('click', function(e){
		e.preventDefault();
		if(!$(this).next().hasClass('collapsing')){
			$(this).toggleClass('accordion-open');
			$(this).toggleClass('accordion-close');
		}
	});

	/* progress bar */
	$('[data-appear-progress-animation]').each(function(){
		var $this = $(this);
		$this.appear(function(){
			var delay = ($this.attr('data-appear-animation-delay') ? $this.attr('data-appear-animation-delay') : 1);
			if( delay > 1 )
				$this.css('animation-delay', delay + 'ms');
			$this.addClass($this.attr('data-appear-animation'));

			setTimeout(function(){
				$this.animate({
					width: $this.attr('data-appear-progress-animation')
				}, 1500, 'easeOutQuad', function() {
					$this.find('.progress-bar-tooltip').animate({
						opacity: 1
					}, 500, 'easeOutQuad');
				});
			}, delay);
		}, {accX: 0, accY: -50});
	});

	/* portfolio item */
	$('.item.animated-block').appear(function(){
		var $this = $(this);

		$this.addClass($this.data('animation')).addClass('visible');

	}, {accX: 0, accY: 150})

	$('a[rel=tooltip]').tooltip();
	$('span[data-toggle=tooltip]').tooltip();

	$('select.sort').on('change', function(){
		location.href = $(this).val();
	});

	setTimeout(function(th){
		$('.catalog.group.list .item').each(function(){
			var th = $(this);
			if((tmp = th.find('.image').outerHeight() - th.find('.text_info').outerHeight()) > 0){
				th.find('.text_info .titles').height(th.find('.text_info .titles').outerHeight() + tmp);
			}
		})
	}, 50);

	/* ajax tabs*/
	$('.tabs_ajax .head-block .item-link').on('click', function(){
		var index = $(this).index(),
			body_block = $(this).closest('.tabs_ajax').find('.body-block'),
			obQuery = parseUrlQuery(),
			url_post = arPriorityOptions['SITE_DIR'] + 'include/mainpage/comp_catalog_ajax.php';
		/*$(this).siblings().removeClass('active');
		$(this).addClass('active');*/
		$(this).closest('.tabs_ajax').find('.head-block .item-link').removeClass('active');
		//$(this).closest('.tabs_ajax').find('.head-block .item-link').eq(index).addClass('active');
		$(this).closest('.tabs_ajax').find('.head-block').each(function(){
			$(this).find('.item-link').eq(index).addClass('active');
		});
		//s).closest('.tabs_ajax').find('.head-block .item-link').eq(index).length);

		if('clear_cache' in obQuery)
			url_post += '?clear_cache='+obQuery.clear_cache;

		if(!$(this).hasClass('clicked'))
		{
			$.ajax({
				url: url_post,
				type: 'POST',
				data: {AJAX_POST: 'Y', AJAX_PARAMS: $(this).closest('.item-views.catalog').find('.request-data').data('value'), GLOBAL_FILTER: body_block.find('.item-block:eq('+index+')').data('filter')},
			}).success(function(html){
				body_block.find('.item-block:eq('+index+')').html(html);

				InitFlexSliderClass(body_block.find('.item-block:eq('+index+')').find('.flexslider')); //reinit flexslider

				body_block.css('height', body_block.find('.item-block.active').actual('outerHeight'));

				body_block.find('.item-block').removeClass('active').removeClass('opacity1').addClass('opacity0');
				body_block.find('.item-block:eq('+index+')').addClass('active');

				setTimeout(function(){
					body_block.css('height', 'auto');

					//recalculate height
					body_block.find('.catalog.item-views.table .item .props').mCustomScrollbar({
						mouseWheel: {preventDefault: true},
					});


					body_block.find('.item-block:eq('+index+') .catalog.item-views.table .item .title').sliceHeight({});
					body_block.find('.item-block:eq('+index+') .catalog.item-views.table .item .cont').sliceHeight({});
					body_block.find('.item-block:eq('+index+') .catalog.item-views.table .item .slice_price').sliceHeight({});
					body_block.find('.item-block:eq('+index+') .catalog.item-views.table .item .image>.wrap').sliceHeight({lineheight:-3})
					body_block.find('.item-block:eq('+index+') .catalog.item-views.table .item').sliceHeight({classNull: '.footer-button'});

					/*body_block.find('.item-block:eq('+index+') .catalog.item-views.table .item .title').sliceHeight();
					body_block.find('.item-block:eq('+index+') .catalog.item-views.table .item .cont').sliceHeight();
					body_block.find('.item-block:eq('+index+') .catalog.item-views.table .item .slice_price').sliceHeight();
					body_block.find('.item-block:eq('+index+') .catalog.item-views.table .item').sliceHeight({classNull: '.footer-button'});
*/
					body_block.find('.item-block:eq('+index+')').removeClass('opacity0').addClass('opacity1');
				},100)

				setTimeout(function(){
					$('.item-block.active .catalog.item-views.table .item .delivery .tooltip').each(function(){
						var _this = $(this),
							textWidth = parseInt(_this.find('>span').width()),
							paddingLeftRight = parseInt(_this.css('padding-left')),
							tooltipWidth = textWidth + paddingLeftRight*2 + 2;

						_this.outerWidth(tooltipWidth);
						_this.css('left', -tooltipWidth/2 + 8);
					});
				}, 300);
			});
		}
		else
		{
			body_block.find('.item-block').removeClass('active').removeClass('opacity1').addClass('opacity0');
			body_block.find('.item-block:eq('+index+')').addClass('active').removeClass('opacity0').addClass('opacity1');
		}
		//$(this).addClass('clicked');
		//$(this).closest('.tabs_ajax').find('.head-block .item-link').eq(index).addClass('clicked');
		$(this).closest('.tabs_ajax').find('.head-block').each(function(){
			$(this).find('.item-link').eq(index).addClass('clicked');
		});
	})

	/*item galery*/
	$('.thumbs .item a').on('click', function(e){
		e.preventDefault();
		$('.thumbs .item').removeClass('current');
		$(this).closest('.item').toggleClass('current');
		$('.slides li' + $(this).attr('href')).addClass('current').siblings().removeClass('current');
	});

	$('header.fixed .btn-responsive-nav').on('click', function() {
		$('html, body').animate({scrollTop: 0}, 400);
	});

	$('body').on('click', '.form .refresh-page', function(){
		location.href = location.href;
	});

	// click on HTML5 video
	$(document).on('click', 'video.video', function(e){
		var videoID = e.target.id.replace('player_', '')
	    if(videoID){
	    	if(players[videoID].playing){
				e.target.pause()
	    	}
	    	else{
	    		//e.target.play()
	    	}
	    }
	})

	// START VIDEO BUTTON
	/*$(document).on('click', '.banners-big .item .btn-video', function(){
		$(this).addClass('loading');
		startMainBannerSlideVideo($(this).closest('.item'));
	});
	*/
	$(document).on('click', '.jqmOverlay', function(){
		$('.ajax_basket').removeClass('showen');
	});

	/*$('.fly_forms .font_upper_md').click(function(){
		console.log(123);
		$('.jqmOverlay').trigger('click');
	});*/

	$(document).on('click', '.basket.fly .opener', function(){
		if(window.matchMedia('(max-width: 767px)').matches)
			location.href = arPriorityOptions['THEME']['URL_BASKET_SECTION'];
		else{
			if($(this).closest('.ajax_basket').hasClass('opened')){
				$('.jqmOverlay').remove();
			}

			if(arPriorityOptions['THEME']['FORM_TYPE'] == 'LATERAL' && ($('.form.popup').length || $('.bx-yandex-view-layout').length)){
				$('.fly_forms').removeClass('opened');
				$('.jqmWindow').removeClass('opened');
				var _this = $(this);

					$('.jqmWindow').jqmHide();
					setTimeout(function(){
						//if(!$('.jqmOverlay').length){
						if(!_this.closest('.ajax_basket').hasClass('opened')){
							$('body').append('<div class="jqmOverlay dark"></div>');
						}
						else{
							$('.jqmOverlay').detach();
						}
						//}
					}, 208);

				setTimeout(function(){
					_this.closest('.ajax_basket').toggleClass('opened');
					$('.fly_forms .disabled').removeClass('disabled');
				}, 450);
			}
			else{
				var _this = $(this);

				if(!_this.closest('.ajax_basket').hasClass('opened')){
					$('body').append('<div class="jqmOverlay dark"></div>');
					$(this).closest('.ajax_basket').addClass('showen');
				}
				else{
					$('.jqmOverlay').detach();
					$(this).closest('.ajax_basket').removeClass('showen');
				}
				$(this).closest('.ajax_basket').toggleClass('opened');
			}
		}
	})

	$(document).on('click', '.basket.fly .jqmClose', function()
	{
		$('.basket.fly .opener').trigger('click');
	})

	$(document).on('click', '.jqmOverlay', function(){
		if($('.ajax_basket').hasClass('opened')){
			$('.jqmOverlay').remove();
		}
	});

	if($('#licenses_reg').length){
		$('#licenses_reg').each(function(){
			$(this).onoff();
		});
	}

	if($('#licenses_subscribe').length){
		$('#licenses_subscribe').each(function(){
			$(this).onoff();
		});
	}

	if($('#licenses').length){
		$('#licenses').each(function(){
			$(this).onoff();
		});
	}

	if($('input[type=checkbox][name=licenses_popup]').length){
		$('input[type=checkbox][name=licenses_popup]').each(function(){
			$(this).onoff();
		});
	}

	/*if(arPriorityOptions['THEME']['FORM_TYPE'] != 'LATERAL'){
		$(document).on('click', '.jqmWindow', function(){
			$(this).find('.jqmClose').click();
		});
	}*/

	$(document).on('click', '.form.popup, .bx-yandex-map', function(e){
		e.stopPropagation();
	});

	/* animated labels */
	$('.animated-labels input,.animated-labels textarea,.animated-labels select').each(function(){
		var value = $(this).val();

		if(value){
			$(this).closest(".animated-labels").addClass("input-filed");
		}
	});

	$(document).on("focus", ".animated-labels input,.animated-labels textarea,.animated-labels select", function(){
		$(this).closest(".animated-labels").addClass("input-filed");
	}).on("focusout", ".animated-labels input,.animated-labels textarea", function(){
		if("" != $(this).val())
			$(this).closest(".animated-labels").addClass("input-filed");
		else
			$(this).closest(".animated-labels").removeClass("input-filed");
	}).on('click', '.animated-labels .calendar-icon', function(){
		$(this).closest(".animated-labels").addClass("input-filed");
	})

	/* accordion action*/
	$('.panel-collapse').on('hidden.bs.collapse', function(){
		$(this).parent().toggleClass('opened');
	})
	$('.panel-collapse').on('show.bs.collapse', function(){
		$(this).parent().toggleClass('opened');
	})

	// DIGITAL BASKET
	// - basket fly close
	$(document).on('click', function(){
		if($('.basket.fly').length && $('.ajax_basket').hasClass('opened')){
			$('.ajax_basket').removeClass('opened');
		}
	});

	$(document).on('click', '.basket.fly', function(e){
		e.stopPropagation();
	});

	// - COUNTER
	var timerBasketCounter = false;

	// -- keyup input
	$(document).on('keydown', '.count', function(e){
		// Allow: backspace, delete, tab, escape, enter and .
		if($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
			 // Allow: Ctrl+A, Command+A
			(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
			 // Allow: home, end, left, right, down, up
			(e.keyCode >= 35 && e.keyCode <= 40)) {
				 // let it happen, don't do anything
				 return;
		}
		// Ensure that it is a number and stop the keypress
		if((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)){
			e.preventDefault();
		}
	});
	$(document).on('keyup', '.count', function(e){
		var $this = $(this),
			counterInputValueNew = $this.val(),
			price = $this.closest('.item').find('input[name=PRICE]').val();

		Summ($this, counterInputValueNew, price);
	});

	// -- scroll after apply option
	/*if($('.instagram_ajax').length)
	{
		BX.addCustomEvent('onCompleteAction', function(eventdata){
			if(eventdata.action === 'instagrammLoaded')
				scrollPreviewBlock();
		});
	}
	else*/
		scrollPreviewBlock();

	$('select.region').on('change', function(){
		var val = parseInt($(this).val());
		if($('select.city').length)
		{
			if(val)
			{
				$('select.city').removeAttr('disabled');
				$('select.city option').hide();
				$('select.city option[data-parent_section='+val+']').show();
			}
			else
				$('select.city').attr('disabled', 'disabled');
		}
	})

	$('select.city, select.region').on('change', function(){
		var _this = $(this),
			val = parseInt(_this.val());
		if(_this.hasClass('region'))
		{
			$('select.city option:eq(0)').show();
			$('select.city').val(0);
		}

		if((_this.hasClass('region') && !val) || _this.hasClass('city'))
		{
			if(typeof(map) !== 'undefined' && map){
				map.destroy();
			}
			$.ajax({
				type: 'POST',
				data: {ID: val},
			}).success(function(html){
				var ob = BX.processHTML(html);
				$('.ajax_items')[0].innerHTML = ob.HTML;
				BX.ajax.processScripts(ob.SCRIPT);
			})
		}
	});

	$(document).on('click', '.mobile_regions .city_item', function(e){
		e.preventDefault();
		var _this = $(this);
		$.removeCookie('current_region');
		if(arPriorityOptions['SITE_ADDRESS'].indexOf(',') != '-1'){
			var arDomains = arPriorityOptions['SITE_ADDRESS'].split(',');
			if(arDomains){
				for(var i in arDomains){
					var domain_name = arDomains[i].replace("\n", "");
					domain_name = arDomains[i].replace("'", "");
					$.cookie('current_region', _this.data('id'), {path: '/',domain: domain_name});
				}
			}
		}
		else{
			$.cookie('current_region', _this.data('id'), {path: '/',domain: arPriorityOptions['SITE_ADDRESS']});
		}

		location.href = _this.attr('href');
	});

	// -- blur input
	$(document).on('blur', '.count', function(){
		BasketCounter($(this));
	});

	// -- click minus, plus button
	$(document).on('click', '.minus, .plus', function(e){
		e.stopPropagation();
		BasketCounter($(this));
	});

	$(document).on('click', '.basket .jqmClose', function(){
		$('.jqmOverlay').click();
	});

	// - Add2Basket
	$(document).on('click', '.to_cart', function(e){
		e.stopPropagation();
		var item = $(this).closest('[data-item]'),
			_this = $(this),
			itemData = item.data('item'),
			buyBlock = item.find('.buy_block'),
			counter = buyBlock.find('.counter'),
			buttonToCart = buyBlock.find('.to_cart'),
			itemQuantity = parseFloat(buttonToCart.data('quantity')),
			countItem = ($('.basket').length ? parseInt($('.basket .count').text()) : parseInt($('.basket_top:visible .count').text()));

		$('.basket_top .count').text(countItem + 1).removeClass('empted');
		$('.basket .count').text(countItem + 1).removeClass('empted');
		//$('.js-basket-block .count').text(countItem + 1).removeClass('empted');

		if(typeof(arPriorityOptions['THEME']['ORDER_BASKET_VIEW']) !== 'undefined')
		{
			if($.trim(arPriorityOptions['THEME']['ORDER_BASKET_VIEW']) === 'HEADER' && $('.basket_top').length)
				var bBasketTop = true;
			else if($('.basket.fly').length)
				var bBasketFly = true;
		}

		if(isNaN(itemQuantity) || itemQuantity <= 0){
			itemQuantity = 1;
		}

		if(!isNaN(itemData.ID) && parseInt(itemData.ID) > 0){
			buyBlock.addClass('in');

			$.ajax({
				url: arPriorityOptions['SITE_DIR'] + 'include/footer/site-basket.php',
				type: 'POST',
				data: {itemData: itemData, quantity: itemQuantity},
			}).success(function(html){
				var eventdata = {action:'loadForm'};
				BX.onCustomEvent('onCompleteAction', [eventdata, _this[0]]);

				if(bBasketTop){
					$('.ajax_basket').html(html);

					$('.ajax_basket .dropdown').each(function(indx){
						var basketItemsDropdown = $(this).html();
						$('.wrap_basket').each(function(){
							$(this).find('.dropdown').eq(indx).html(basketItemsDropdown);
						});
					});

					setTimeout(function(){
						$('.wrap_basket .dropdown .items').mCustomScrollbar({
							mouseWheel: {preventDefault: true},
						});
					}, 0);

					$('.wrap_basket .dropdown').addClass('opened');

					setTimeout(function(){
						$('.wrap_basket .dropdown').removeClass('opened');
					}, 2000);

					var eventdata = {action:'loadBasket'};
					BX.onCustomEvent('onCompleteAction', [eventdata, $('.ajax_basket')[0]]);
				}

				if(bBasketFly){
					if($('.basket.fly').length){
						$('.ajax_basket').html(html);
						setTimeout(function(){
							if(!$('.ajax_basket').hasClass('opened')){
								$('.ajax_basket').addClass('opened');
							}

							if(!$('.jqmOverlay').length){
								$('body').append('<div class="jqmOverlay dark"></div>');
							}
						}, 50);

						setTimeout(function(){
							$('.basket.fly .wrap.cont').mCustomScrollbar({
								mouseWheel: {preventDefault: true},
							});
						}, 0);
					}
				}

				if($('.catalog.item-views.price').length){
					checkTable();
				}

				if(arPriorityOptions['THEME']['USE_SALE_GOALS'] != 'N')
				{
					var eventdata = {goal: 'goal_basket_add', params: {itemData: itemData, quantity: itemQuantity}};
					BX.onCustomEvent('onCounterGoals', [eventdata]);
				}
			});
		}
		else{
			return;
		}
	});

	// - Remove9Basket
	$(document).on('click', '.remove', function(){
		var item = $(this).closest('[data-item]'),
			itemData = item.data('item'),
			bRemove = 'Y',
			bRemoveAll = ($.trim($(this).closest('[data-remove_all]').data('remove_all')) === 'Y' ? 'Y' : false);
			getCurUri = $.trim($('input[name=getPageUri]').val()),
			countItem = ($('.basket').length ? parseInt($('.basket .item').length) : parseInt($('header .wrap_basket .item').length)),
			bOneItem = (countItem - 1 <= 0),
			scrollTop = ($('.basket.fly').length ? $('.basket.fly .items_wrap').scrollTop() : ($('.basket_top:visible').length ? $('.basket_top .items:visible').scrollTop() : ''));

		if(typeof(arPriorityOptions['THEME']['ORDER_BASKET_VIEW']) !== 'undefined')
		{
			if($.trim(arPriorityOptions['THEME']['ORDER_BASKET_VIEW']) === 'HEADER' && $('.basket_top').length)
				var bBasketTop = true;
			else if($('.basket.fly').length)
				var bBasketFly = true;
		}

		var _ajax = function(){
			$.ajax({
				url: arPriorityOptions['SITE_DIR'] + 'include/footer/site-basket.php',
				data: {itemData: itemData, remove: bRemove, removeAll: bRemoveAll},
			}).success(function(html){
				if(bBasketTop){
					$('.ajax_basket').html(html);

					$('.ajax_basket .dropdown').each(function(indx){
						var basketItemsDropdown = $(this).html();
						$('.wrap_basket').each(function(){
							$(this).find('.dropdown').eq(indx).html(basketItemsDropdown);
						});
					});

					setTimeout(function(){
						$('.wrap_basket .dropdown .items').mCustomScrollbar({
							mouseWheel: {preventDefault: true},
						});
					}, 0);

				}

				if(getCurUri){
					$.ajax({
						url: getCurUri,
						type: 'POST',
					}).success(function(html){
						if($('.basket.default').length){
							$('.basket.default').html(html);
						}
					});
				}

				if(bBasketFly){
					$('.ajax_basket').html(html);
					$('.ajax_basket').addClass('opened');
					//$('.basket.fly .items_wrap').scrollTop(scrollTop);
					setTimeout(function(){
						$('.basket.fly .wrap.cont').mCustomScrollbar({
							mouseWheel: {preventDefault: true},
						});
					}, 0);
				}

				if(arPriorityOptions['THEME']['USE_SALE_GOALS'] != 'N')
				{
					var eventdata = {goal: 'goal_basket_remove', params: {itemData: itemData, remove: bRemove, removeAll: bRemoveAll}};
					BX.onCustomEvent('onCounterGoals', [eventdata]);
				}
			});
		}

		if(typeof(itemData) !== 'undefined' && (!isNaN(itemData.ID) && itemData.ID > 0) || bRemoveAll){
			if(bRemoveAll){
				$('.buy_block').removeClass('in');
				$('.basket .count').text(0).addClass('empted');
				$('.wrap_basket .count').text(0).addClass('empted');
				$('.js-basket-block .count').text(0).addClass('empted');
				$('#mobilemenu .menu .ready .count').text(0).addClass('empted');
			}
			else{
				$('[data-item]').each(function(){
					if($(this).data('item').ID == itemData.ID){
						$(this).find('.buy_block').removeClass('in');
					}
				});
				if($('.basket').length){
					if($('.basket_top .count').length){
						$('.basket_top .count').text(parseFloat($('.basket_top .count').first().text()) - 1);
					}
					else
					{
						$('.basket .count').text(parseFloat($('.basket .count').first().text()) - 1);
						$('.basket_top .count').text(parseFloat($('.basket .count').first().text()) - 1);
					}
				}
				else{
					$('.wrap_basket .count').text(parseFloat($('.basket_top .count').first().text()) - 1);
				}

				if($('.basket').length){
					$('.js-basket-block .count').text(parseInt($('.basket .count').first().text()));
				}
				else{

				}

				$('#mobilemenu .menu .ready .count').text(parseFloat($('#mobilemenu .menu .ready .count').first().text()) - 1);
			}

			if(bOneItem && !bRemoveAll){
				if(item.closest('.wrap_basket').length){
					//item.closest('.dropdown').animate({opacity: 0}, 200, function(){
						_ajax();
					//});
				}
				else{
					item.closest('.basket').find('.count').addClass('empted');
					item.closest('.basket_wrap').fadeOut(200, function(){
						item.closest('.basket').find('.basket_empty').fadeIn(200, function(){
							_ajax();
						});
					});
				}
			}
			else if(bRemoveAll){
				if(bBasketTop){
					_ajax();
				}
				else{
					$('.basket_wrap').fadeOut(200, function(){
						$('.remove.all').remove();
						$('.basket').find('.basket_empty').fadeIn(200, function(){
							_ajax();
						});
					});
				}
			}
			else if(!bOneItem){
				item.animate({opacity: 0}, 200).slideUp(200, function(){
					_ajax();
				});
			}
		}
		else{
			return;
		}
	});
	$(document).on('click', '.print', function(){
		window.print();
	});

	/*$(document).on('click', '.jqmWindow .subscribe-edit-main [type=submit]', function(){
		var _this = $(this),
			type = $(this).data('type'),
			data = $(this).closest('form').serialize();

		$.ajax({
			url: arPriorityOptions['SITE_DIR'] + 'ajax/form.php',
			data: {'type': type, 'data': data},
			type: 'POST',
		}).success(function(html){
			$('.jqmWindow').html(html);
			if($('#licenses_subscribe').length){
				$('#licenses_subscribe').onoff();
			}
			$('.jqmWindow.right_slide .subscribe-edit-main').mCustomScrollbar();

			$('.jqmWindow .subscribe-edit-main .animated-labels input, .jqmWindow .subscribe-edit-main .animated-labels textarea').each(function(){
				var value = $(this).val();

				if(value){
					$(this).closest('.animated-labels').addClass('input-filed');
				}
			});
		});
	});*/

	$('.choise').on('click', function(){
		var _this = $(this);
		if(typeof(_this.data('block')) != 'undefined')
		{
			scrollToBlock(_this.data('block'));
		}
	});

	// form rating
	$(document).on('mouseenter', '.form .rating .star', function(){
		var $this = $(this),
			currentStarWidth = $this.data('current_width'),
			ratingValue = $this.data('rating_value'),
			ratingMessage = $this.data('message');

		$this.closest('.rating').find('.stars_current').width(currentStarWidth + '%');
		$this.closest('.rating_wrap').find('.rating_message').text(ratingMessage);
	});

	$(document).on('mouseleave', '.form .rating', function(){
		var $this = $(this),
			dataRating = $this.find('.stars_current').data('rating'),
			ratingMessage = $this.closest('.rating_wrap').find('.rating_message').data('message');

		$this.find('.stars_current').width(dataRating + '%');
		$this.closest('.rating_wrap').find('.rating_message').text(ratingMessage);
	});

	$(document).on('click', '.form .rating .star', function(){
		var $this = $(this),
			currentStarWidth = $this.data('current_width'),
			ratingValue = $this.data('rating_value'),
			ratingMessage = $this.data('message');

		$this.closest('.rating').find('.stars_current').data('rating', currentStarWidth);
		if($this.closest('.input').find('input[name=RATING]').length){
			$this.closest('.input').find('input[name=RATING]').val(ratingValue);
		}
		else{
			$this.closest('.input').find('input[data-sid=RATING]').val(ratingValue);
		}
		$this.closest('.rating_wrap').find('.rating_message').data('message', ratingMessage);
	});

	$('.mega_fixed_menu .js_city_chooser.popup_link, .mega_fixed_menu .right_block .button .btn, .mega_fixed_menu .right_block .phone.blocks .callback_wrap .callback-block, .mega_fixed_menu .right_block .personal-link').on('click', function(){
		$('.mega_fixed_menu .svg-close').click();
	});

	$('.hint').mouseenter(function(){
		var $tooltip = $(this).find('.tooltip.check_pos');
		if($tooltip.length){
			$tooltip.css('left', '');

			var width = $tooltip.outerWidth(),
				offsetLeft = $tooltip.offset().left,
				left = parseInt($tooltip.css('left')),
				windowWidth = $(window).width();

			if(offsetLeft < 0){
				$tooltip.css('left', left - offsetLeft);
			}
			else{
				if(offsetLeft > 0){
					var r = offsetLeft + width - windowWidth;
					if(r > 0){
						if(offsetLeft - r > 0){
							$tooltip.css('left', left - r);
						}
						else{
							$tooltip.css('left', 0);
						}
					}
				}
			}
		}
	});
});

scrollPreviewBlock = function(){
	if(typeof($.cookie('scoll_block')) != 'undefined' && $.cookie('scoll_block'))
	{
		setTimeout(function(){
			var scoll_block = $($.cookie('scoll_block'));

			if(scoll_block.length)
			{
				$('body, html').animate({scrollTop: scoll_block.offset().top - 62}, 500);
				$.cookie('scoll_block', null);
			}
		}, 300);
	}
}

scrollToBlock = function(block){
	if($(block).length)
	{
		var offset = $(block).offset().top;
		if(typeof($(block).data('toggle')) != 'undefined')
			$(block).click();

		if(typeof($(block).data('offset')) != 'undefined')
			offset += $(block).data('offset');
		$('body, html').animate({scrollTop: offset}, 500);
	}
}

$(document).on('click', '.banners-big .item.wvideo', function(){
	$(this).find('.btn-video').trigger('click');
});

// START VIDEO BUTTON
$(document).on('click', '.banners-big .item .btn-video', function(e){
	e.stopPropagation();
	if(!$(this).hasClass('loading')){
		$(this).addClass('loading');
		$(this).closest('.item').addClass('loading');

		if(!$(this).closest('.item').find('video').length){
			startMainBannerSlideVideo($(this).closest('.item'));
		}
		else{
			var videoID = $(this).closest('.item').find('video').attr('id');
			document.getElementById(videoID).play();
		}
		$(this).closest('.item').find('video').css('opacity', 0);
	}
	else{
		$(this).removeClass('loading');
		$(this).closest('.item').removeClass('loading');
		var videoID = $(this).closest('.item').find('video').attr('id');

		if(!$(this).closest('.item').find('video').length){
			startMainBannerSlideVideo($(this).closest('.item'));
		}
		else if(videoID){
			document.getElementById(videoID).pause();
		}
	}

	setTimeout(function(){
		$(window).resize();
	}, 100);
	var _this = $(this);
	setTimeout(function(){
		_this.closest('.item').find('video').css('opacity', 1);
	}, 100);
});

$(document).on('change', '.uploader input[type=file]', function(){
	if(!$(this).next().length || !$(this).next().hasClass('resetfile')){
		$('<span class="resetfile"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 11 11"><path d="M1345.19,376.484l4.66,4.659a0.492,0.492,0,0,1,0,.707,0.5,0.5,0,0,1-.71,0l-4.66-4.659-4.65,4.659a0.5,0.5,0,0,1-.71,0,0.492,0.492,0,0,1,0-.707l4.66-4.659-4.66-4.659a0.492,0.492,0,0,1,0-.707,0.5,0.5,0,0,1,.71,0l4.65,4.659,4.66-4.659a0.5,0.5,0,0,1,.71,0,0.492,0.492,0,0,1,0,.707Z" transform="translate(-1339 -371)"/></svg></span>').insertAfter($(this));
	}
});

$(document).on('click', '.uploader.files_add input[type=file] + .resetfile', function(){
	var $input = $(this).prev();
	$input.val('');
	$.uniform.update($input);
	$(this).remove();
});

//DIGITAL BASKET
function number_format(number, decimals, dec_point, thousands_sep) {
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
	prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
	sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
	dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
	s = '',
	toFixedFix = function(n, prec){
		var k = Math.pow(10, prec);
		return '' + (Math.round(n*k)/k).toFixed(prec);
	};

	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');

	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}

	if ((s[1] || '')
		.length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	}

	return s.join(dec);
}


setBasketItemsClasses = function(){
	if(typeof(arBasketItems) !== 'undefined' && typeof(arBasketItems) !== 'string'){
		if(Object.keys(arBasketItems).length){
			for(var key in arBasketItems){
				$('[data-item]').each(function(){
					if($(this).data('item').ID == key && !$(this).closest('.basket.default').length){
						$(this).find('.buy_block').addClass('in');
					}
				});
			}
		}
	}
}

function Summ(el, counterInputValueNew, price){
	if(counterInputValueNew <= 0){
		counterInputValueNew = 1;
	}

	var summ = number_format(counterInputValueNew*price, 0, '.', ' '),
		allSumm = 0;

	el.closest('.items').find('.item').each(function(){
		var $this = $(this),
			price = parseFloat($this.find('input[name=PRICE]').val()),
			count =  parseFloat($this.find('input.count').val());

		if(count <= 0){
			count = 1;
		}

		if(!isNaN(price) && !isNaN(count)){
			allSumm += count*price;
		}
	});

	allSumm = number_format(parseFloat(allSumm), 0, '.', ' ');
	el.closest('.item').find('.summ .price_val').text(summ);
	el.closest('.basket').find('.foot .total>span').text(allSumm);
	el.closest('.wrap_basket').find('.total_wrap .total>span').text(allSumm);
}

var timerBasketUpdate = false;
// - COUNTER
BasketCounter = function(el){
	var elClass = $.trim(el.attr('class')),
		bClassMinus = (elClass.indexOf('minus') > -1),
		bClassPlus = (elClass.indexOf('plus') > -1),
		bClassCount = (elClass.indexOf('count') > -1),
		getCurUri = $.trim($('input[name=getPageUri]').val()),
		buyBlock = el.closest('.buy_block'),
		buttonToCart = buyBlock.find('.to_cart'),
		elID = el.closest('.item').attr('id'),
		counterInput = (el.closest('.wrap_basket').length ? $('.wrap_basket .item#'+elID+' .counter input.count') : el.closest('.counter').find('input.count')),
		counterInputValue = parseFloat($.trim(counterInput.val())),
		price = parseFloat(buyBlock.find('input[name=PRICE]').val()),
		counterInputMaxCount = Math.pow(10, parseInt(counterInput.attr('maxlength'))) - 1,
		bAjax = (el.closest('.basket').length || el.closest('.wrap_basket').length? true : false);

	// class minus button
	if(bClassMinus){
		var counterInputValueNew = counterInputValue - 1;

		if(counterInputValueNew <= 0){
			counterInputValueNew = 1;
		}

		counterInput.val(counterInputValueNew);

		if(bAjax){
			Summ(el, counterInputValueNew, price);

			if(timerBasketUpdate){
				clearTimeout(timerBasketUpdate);
				timerBasketUpdate = false;
			}

			timerBasketUpdate = setTimeout(function(){
				BasketUpdate(el, counterInputValueNew);
			}, 1500);
		}
	}
	// class plus button
	else if(bClassPlus){
		var counterInputValueNew = counterInputValue + 1;

		if(counterInputValueNew > counterInputMaxCount){
			counterInputValueNew = counterInputMaxCount;
		}

		counterInput.val(counterInputValueNew);

		if(bAjax){
			Summ(el, counterInputValueNew, price);

			if(timerBasketUpdate){
				clearTimeout(timerBasketUpdate);
				timerBasketUpdate = false;
			}

			timerBasketUpdate = setTimeout(function(){
				BasketUpdate(el, counterInputValueNew);
				timerBasketUpdate = false;
			}, 700);
		}
	}
	// class input
	else if(bClassCount){
		var counterInputValueNew = counterInputValue;

		if(counterInputValueNew <= 0 || isNaN(counterInputValueNew)){
			counterInputValueNew = 1;
		}
		el.val(counterInputValueNew);

		if(bAjax){
			BasketUpdate(el, counterInputValueNew);
		}
	}

	if(!getCurUri && !el.closest('.basket.fly').length){
		buttonToCart.data('quantity', counterInputValueNew);
	}
}

BasketUpdate = function(el, counterInputValueNew){
	var	itemData = el.closest('[data-item]').data('item'),
		itemData = (typeof(arBasketItems) === 'object' && typeof(arBasketItems[itemData.ID]) === 'object' ? arBasketItems[itemData.ID] : itemData),
		buyBlock = el.closest('.buy_block'),
		buttonToCart = buyBlock.find('.to_cart'),
		getCurUri = $.trim($('input[name=getPageUri]').val())
		scrollTop = ($('.basket.fly').length ? $('.basket.fly .items_wrap').scrollTop() : ($('.basket_top:visible').length ? $('.basket_top .items:visible').scrollTop() : ''));

	if(typeof(arPriorityOptions['THEME']['ORDER_BASKET_VIEW']) !== 'undefined' && $.trim(arPriorityOptions['THEME']['ORDER_BASKET_VIEW']) === 'FLY' && $('.basket.fly').length){
		var bBasketFly = true;
	}

	if(typeof(arPriorityOptions['THEME']['ORDER_BASKET_VIEW']) !== 'undefined' && $.trim(arPriorityOptions['THEME']['ORDER_BASKET_VIEW']) === 'HEADER' && $('.basket_top').length){
		var bBasketTop = true;
	}

	//else{
		if(typeof(itemData) != 'undefined' && !isNaN(itemData.ID) && itemData.ID > 0){
			$.ajax({
				// url: arPriorityOptions['SITE_DIR'] + 'ajax/basket_items.php',
				url: arPriorityOptions['SITE_DIR'] + 'include/footer/site-basket.php',
				data: {itemData: itemData, quantity: counterInputValueNew},
			}).success(function(data){
				if(typeof(data) === 'object'){
					arBasketItems = data;
				}
				if(bBasketTop){
					$.ajax({
						url: arPriorityOptions['SITE_DIR'] + 'include/footer/site-basket.php',
						type: 'POST',
						data: {'ajaxPost': 'Y'},
					}).success(function(html){
						buyBlock.removeClass('in');
						$('.ajax_basket').html(html);
						$('.ajax_basket .dropdown').each(function(indx){
							var basketItemsDropdown = $(this).html();
							$('.wrap_basket .dropdown').eq(indx).html(basketItemsDropdown);
							$('.wrap_basket .dropdown .items').eq(indx).mCustomScrollbar({
								mouseWheel: {preventDefault: true},
							});
						});
					});
				}

				if(bBasketFly){
					$.ajax({
						url: arPriorityOptions['SITE_DIR'] + 'include/footer/site-basket.php',
						type: 'POST',
						data: {'ajaxPost': 'Y'},
					}).success(function(html){
						if($('.basket.fly').length){
							$('.ajax_basket').html(html);
							//$('.basket.fly .items_wrap').scrollTop(scrollTop);
							$('.basket.fly .wrap.cont').mCustomScrollbar({
								mouseWheel: {preventDefault: true},
							});
						}
					});
				}

				if(getCurUri){
					$.ajax({
						url: getCurUri,
						type: 'POST',
					}).success(function(html){
						if($('.basket.default').length){
							$('.basket.default').html(html);
						}
					});
				}
			});
		}
		else{
			return;
		}
	//}
}

CheckTabActive = function(){
	if(typeof(clicked_tab) && clicked_tab)
	{
		if(window.matchMedia('(min-width: 768px)').matches)
		{
			clicked_tab--;
			$('.catalog.detail .nav.nav-tabs li:eq('+clicked_tab+')').addClass('active');
			$('.catalog.detail .tab-content .tab-pane:eq('+clicked_tab+')').addClass('active');
			$('.catalog.detail .tab-content .tab-pane .title-tab-heading').next().removeAttr('style');
			clicked_tab = 0;
		}
	}
}

/* parallax bg */
ParallaxBg = function(){
	if($('*[data-type=parallax-bg]').length)
	{
		var x = $(window).scrollTop()/$(document).height();
		x=parseInt(-x * 280);
		$('*[data-type=parallax-bg]').stop().animate({'background-position-y':  x + 'px'}, 400, 'swing');
	}
}
SetFixedAskBlock = function(){
	if($('.ask_a_question_wrapper').length && !isMobile)
	{
		var offset = $('.ask_a_question_wrapper').offset(),
			block = $('.ask_a_question_wrapper').find('.ask_a_question'),
			block_offset = BX.pos(block[0]),
			block_height = block_offset.bottom-block_offset.top,
			diff_top_scroll = $('#headerfixed').height() + 20;

		if(block_height+130 > block.closest('.fixed_wrapper').height())
			block.addClass('nonfixed');
		else
			block.removeClass('nonfixed');

		if(block_height+diff_top_scroll+documentScrollTopLast + 130 > $('footer').offset().top)
		{
			block.removeClass('fixed').css({'top': 'auto', 'width': 'auto', 'bottom': 0});
			block.parent().css('position', 'static');
			block.parent().parent().css('position', 'static');
		}
		else
		{
			block.parent().removeAttr('style');
			block.parent().parent().removeAttr('style');

			if(documentScrollTopLast + diff_top_scroll > offset.top)
				block.addClass('fixed').css({'top': diff_top_scroll, 'bottom': 'auto', 'width': $('.fixed_block_fix').width()});
			else
				block.removeClass('fixed').css({'top': 0, 'width': 'auto'});
		}
	}
}

CheckHeaderColor = function(slider, curSlide){
	if($(slider).closest('.banners-big.front').length){
		var changeColor = $('header').data('change_color');

		if(typeof(changeColor) !== 'undefined' && changeColor == 'Y'){
			var headerClass = curSlide.data('text_color'),
				logoSrc = arPriorityOptions.THEME.LOGO_IMAGE,
				logoLightSrc = arPriorityOptions.THEME.LOGO_IMAGE_LIGHT;

			if(logoLightSrc){
				if(headerClass == 'light'){
					$('header .logo img').attr('src', logoLightSrc)
				}
				else{
					$('header .logo img').attr('src', logoSrc)
				}
			}

			if(typeof(headerClass) !== 'undefined'){
				if(headerClass == 'light'){
					$('header').addClass('light');
				}
				else{
					$('header').removeClass('light');
				}
			}
		}
	}
}

CheckMenuLines = function(){
	if($('.menu_row_wrap .left_border').length || $('.menu_row_wrap .right_border').length){
		var positionMenu = ($('.header-v4 .logo_and_menu-row .menu-row .mega-menu table').length ? $('.header-v4 .logo_and_menu-row .menu-row .mega-menu table').offset().left : 0),
			varFixLineWidth = ($('body').hasClass('with_decorate') && window.matchMedia('(min-width: 1100px)').matches ? 126 : 86);

		$('.menu_row_wrap .left_border, .menu_row_wrap .right_border').css('width', positionMenu - varFixLineWidth);
	}
}

// Events
var timerScroll = false, ignoreScroll = [], documentScrollTopLast = $(document).scrollTop(), documentScrollTop = $(document).scrollTop();;
$(window).scroll(function(){
	documentScrollTop = $(document).scrollTop();
	CheckPopupTop();
	SetFixedAskBlock();
	if(!ignoreScroll.length){
		if(timerScroll){
			clearTimeout(timerScroll);
			timerScroll = false;
		}
		timerScroll = setTimeout(function(){
			BX.onCustomEvent('onWindowScroll', false);
		}, 100);
	}
	documentScrollTopLast = $(document).scrollTop();
});

var timerResize = false, ignoreResize = [];

$(window).resize(function(){
	documentScrollTop = $(document).scrollTop();
	CheckPopupTop();
	CheckScrollToTop();

	if(!ignoreResize.length){
		if(timerResize){
			clearTimeout(timerResize);
			timerResize = false;
		}
		timerResize = setTimeout(function(){
			BX.onCustomEvent('onWindowResize', false);
		}, 100);
	}
	documentScrollTopLast = $(document).scrollTop();
});

BX.addCustomEvent('onWindowScroll', function(eventdata) {
	try{
		ignoreScroll.push(true);
		//ParallaxBg();

		if(arPriorityOptions['THEME']['TYPE_SEARCH'] != 'fixed')
		{
			if(!$('header > .top-block').length)
			{
				var height_block = 0,
					scrollVal = $(window).scrollTop();
				height_block = $('.logo_and_menu-row').actual('outerHeight');
				if(!scrollVal)
				{
					$('.inline-search-block').css({
						'height': height_block,
						'line-height': height_block-4+'px',
						'top': -height_block
					})
				}
			}
		}

	}
	catch(e){}
	finally{
		ignoreScroll.pop();
	}
});

BX.addCustomEvent('onWindowResize', function(eventdata) {
	try{
		ignoreResize.push(true);
		CheckHeaderFixedMenu();
		CheckTopMenuPadding();
		CheckTopMenuOncePadding();
		CheckTopMenuDotted();
		CheckTopVisibleMenu();
		CheckFlexSlider();
		CheckMainBannerSliderVText($('.banners-big .flexslider'));
		CheckObjectsSizes();
		CoverPlayer();
		CoverPlayerHtml();
		verticalAlign();
		CheckTabActive();
		CheckSearchWidth();
		CheckMenuLines();

		CheckInstagramItemDesc();
		setTimeout(function(){
			createTableCompare($('.main-block .items .title-block:not(.clone) .item'), $('.prop_title_table'), $('.main-block .prop_title_table .item.clone'));
		}, 100);
		SliceHeightBlocks();
		if($('.banners-big video').length){
			var bannerWidth = $('.banners-big video').width();
			$('.banners-big video').css('margin-left', -bannerWidth/2 + (isMobile ? 42 : 0));
			//$('.banners-big .wvideo').css('background-position-x', -bannerWidth/2);
		}

		if($('.contacts.front.type_4').length){
			if(window.matchMedia('(min-width: 992px)').matches){
				var leftBlockHeight = $('.contacts.front.type_4 .left_block').outerHeight(),
					rightBlockHeight = $('.contacts.front.type_4 .right_block').outerHeight();

				if(leftBlockHeight >= rightBlockHeight){
					$('.contacts.front.type_4 .left_block').outerHeight(leftBlockHeight);
					$('.contacts.front.type_4 .right_block').outerHeight(leftBlockHeight);
				}
				else{
					$('.contacts.front.type_4 .left_block').outerHeight(rightBlockHeight);
					$('.contacts.front.type_4 .right_block').outerHeight(rightBlockHeight);
				}
			}
			else{
				$('.contacts.front.type_4 .left_block').height('auto');
				$('.contacts.front.type_4 .right_block').height('auto');
			}
		}

		if($('.flexslider.wsmooth').length){
			$('.flexslider.wsmooth').each(function(){
				$(this).flexslider('smoothHeight');
			});
		}

		if($('.tarifs.type_6').length){
			sliceProps();
		}

	}
	catch(e){}
	finally{
		ignoreResize.pop();
	}
});
var CheckWidthSlide = checkHeightGallery = timerFlexsliderCurrentSlides = false;
window.addCurrentSlidesClass = function (slider) {
    //debugger;
    slider.find('li').removeClass("active-slides");
    var startli = parseInt(slider.move) * parseInt(slider.currentSlide);
    var endli = parseInt(slider.move) * (parseInt(slider.currentSlide) + 1);
	if(endli > slider.count){
		endli = slider.count;
		startli = slider.count - startli;
	}

    for (i = startli + 1; i <= endli; i++) {
        $('.flexslider li:nth-child(' + i + ')').addClass('active-slides');
    }
	setTimeout(function(){
		$('.banners-big video').each(function(){
			var ID = $(this).attr('id');
			document.getElementById(ID).play();
		});
	}, 3000);

	if(slider.find('li.item-wrap').length <= slider.move){
		slider.find('li.item-wrap').addClass('active-slides');
	}
}

BX.addCustomEvent('onSlide', function(eventdata) {
	try{
		ignoreResize.push(true);
		if(eventdata){
			var slider = eventdata.slider;
			if(slider){
				slider.find('.item').removeClass('current');
				var curSlide = slider.find('.item.flex-active-slide');
				var curSlideIndex = curSlide.attr('data-slide_index');

				curSlide.addClass('current');
				slider.find('.item[data-slide_index=' + curSlideIndex + ']').addClass('shown');
				slider.resize();

				setTimeout(function(){
					slider.find('.slides').css({'height': 'auto', 'overflow': 'visible', 'opacity': 1});
				}, 600);
				window.addCurrentSlidesClass(slider);

				if(typeof(curSlideIndex) !== 'undefined' && curSlideIndex.length){
					// set main banners text vertical center
					CheckMainBannerSliderVText(slider);
					setTimeout(function(){
						CoverPlayerHtml();
					}, 200);
					// pause play video
					if(typeof(players) !== 'undefined' && players){
						for(var j in players){
							if(players[j].playing && !players[j].clone && (players[j].slideIndex != curSlideIndex)){
								if((typeof window[players[j].id] == 'object')){
									if(players[j].videoPlayer === 'YOUTUBE'){
										window[players[j].id].pauseVideo()
									}
									else if(players[j].videoPlayer === 'VIMEO'){
										window[players[j].id].pause()
									}
									else if(players[j].videoPlayer === 'RUTUBE'){
										document.getElementById(players[j].id).contentWindow.postMessage(JSON.stringify({
										    type: 'player:pause',
										    data: {}
										}), '*')
									}
									else if(players[j].videoPlayer === 'HTML5'){
										document.getElementById(players[j].id).pause()
									}
								}
							}
						}
					}
					// autoplay video
					var bVideoAutoPlay = curSlide.attr('data-video_autoplay') == 1
					if(bVideoAutoPlay){
						startMainBannerSlideVideo(curSlide)
					}
				}
				else
				{
					slider.find('.item').css('opacity', '1');
				}

				if(!slider.find('.flex-control-nav li').length && slider.hasClass('normal'))
				{
					slider.find('.flex-direction-nav li a').addClass('flex-disabled');
				}

				if(!slider.hasClass('flexslider-init-slice') && slider.hasClass('nav-title') && $('.gallery-block').closest('.tab-pane').hasClass('active'))
				{
					slider.find('.item').sliceHeight({'lineheight': -3});
					slider.addClass('flexslider-init-slice');
				}

				if(slider.find('.flex-direction-nav').length){
					if(slider.find('.flex-direction-nav').find('a.flex-disabled').length)
						slider.find('.flex-direction-nav').removeClass('opacity1').addClass('opacity0');
					else
						slider.find('.flex-direction-nav').removeClass('opacity0').addClass('opacity1');
				}
				CheckHeaderColor(slider, $(curSlide));

				$('.sections.linked.item-views.staff .item .image').css('opacity', '1');
				setTimeout(function(){
					$('.item-views.news-items.projects.linked .item:not(.big_block) .image').css('opacity', '1');
					$('.item-views.news-items.projects.linked .item .image').css('opacity', '1');
					$('.item-views.news-items.projects.linked .flexslider .slides').css('overflow', 'visible');

				}, 1500);

				if(slider.closest('.galerys-block').find('.title.big-gallery').length){
					var indexActiveSlide = slider.data('flexslider').currentSlide + 1;
					slider.closest('.galerys-block').find('.title.big-gallery .slide-number').text(indexActiveSlide);
				}
				if(curSlide.find('video').length && !curSlide.find('.btn-video').length){
					var videoID = curSlide.find('video').attr('id');
					document.getElementById(videoID).play();
				}

				setTimeout(function(){
					$('.banners-big .item .video').css('opacity', 1);
				}, 1200);

				/*if(slider.closest('.big-gallery-block').length){
					setTimeout(function(){
						slider.resize();
					}, 100);
				}*/
 			}
		}
	}
	catch(e){}
	finally{
		ignoreResize.pop();
	}
});

BX.addCustomEvent('onSlideEnd', function(eventdata) {
	try{
		ignoreResize.push(true);
		if(eventdata){
			var slider = eventdata.slider;
			if(slider){
				setTimeout(function(){
					$('.banners-big.front .btn-video, .banners-big.front .item').removeClass('loading');
				}, 300);
			}
		}
	}
	catch(e){}
	finally{
		ignoreResize.pop();
	}
});

BX.addCustomEvent('onSlideStart', function(eventdata) {
	try{
		ignoreResize.push(true);
		if(eventdata){
			var slider = eventdata.slider;
			if(slider){
				setTimeout(function(){
					CheckHeaderColor(slider, $(slider).closest('.banners-big').find('.flex-active-slide'));
				}, 150);

				//if(slider.closest('.catalog')){
					slider.find('.item-wrap').addClass('active-slides');
				//}
			}
		}
	}
	catch(e){}
	finally{
		ignoreResize.pop();
	}
});

$(window).resize(function(){
});

var onCaptchaVerifyinvisible = function(response){
	$('.g-recaptcha:last').each(function(){
		var id = $(this).attr('data-widgetid');
		if(typeof(id) !== 'undefined' && response){
			if(!$(this).closest('form').find('.g-recaptcha-response').val())
				$(this).closest('form').find('.g-recaptcha-response').val(response)
			if($('iframe[src*=recaptcha]').length)
			{
				$('iframe[src*=recaptcha]').each(function(){
					var block = $(this).parent().parent();
					if(!block.hasClass('grecaptcha-badge'))
						block.css('width', '100%');
				})
			}
			$(this).closest('form').submit();
		}
	})
}

var onCaptchaVerifynormal = function(response){
	$('.g-recaptcha').each(function(){
		var id = $(this).attr('data-widgetid');
		if(typeof(id) !== 'undefined'){
			if(grecaptcha.getResponse(id) != ''){
				$(this).closest('form').find('.recaptcha').valid();
			}
		}
	});
}

BX.addCustomEvent('onSubmitForm', function(eventdata){
	try{
		if(!window.renderRecaptchaById || !window.asproRecaptcha || !window.asproRecaptcha.key)
		{
			eventdata.form.submit();
			return true;
		}
		if(window.asproRecaptcha.params.recaptchaSize == 'invisible' && typeof grecaptcha != 'undefined')
		{
			if($(eventdata.form).find('.g-recaptcha-response').val())
			{
				eventdata.form.submit();
			}
			else
			{
				grecaptcha.execute($(eventdata.form).find('.g-recaptcha').data('widgetid'));
				return false;
			}
		}
		else
		{
			eventdata.form.submit();
		}

		return true;
	}catch (e){
		console.error(e);
		return true;
	}
})