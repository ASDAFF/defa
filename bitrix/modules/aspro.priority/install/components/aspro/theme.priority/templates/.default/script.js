var timerHide = false;

var saveButtonBottomPanel = '<div class="save_btn changer" title="'+BX.message('SAVE_CONFIG')+'">'
								+'<span>'
									+'<svg width="16" height="14" viewBox="0 0 16 14">'
										+'<path d="M624,254H612a2,2,0,0,1-2-2v-8a2,2,0,0,1,2-2h3v2h-3v8h12v-8h-3v-2h3a2,2,0,0,1,2,2v8A2,2,0,0,1,624,254Zm-5.279-4.295a0.907,0.907,0,0,1-.291.193,0.993,0.993,0,0,1-.315.079h0A0.9,0.9,0,0,1,618,250a0.837,0.837,0,0,1-.179-0.044,0.971,0.971,0,0,1-.193-0.047,112.157,112.157,0,0,0-.307-0.2c-0.009-.01-0.012-0.022-0.021-0.032s-0.05-.033-0.068-0.057l-1.949-1.923a0.991,0.991,0,1,1,1.4-1.4L617,246.6V241a1,1,0,0,1,2,0v5.618l0.3-.3a0.991,0.991,0,0,1,1.4,1.4Z" transform="translate(-610 -240)"></path>'
									+'</svg>'
									+'<span>'+BX.message('SAVE_CONFIG')+'</span>'
								+'</span>'
							+'</div>';

var saveButtonSwitcher = '<div class="button second">'
							+'<div class="save_btn animation-bg" title="'+BX.message('SAVE_CONFIG')+'">'
								+'<span>'
									+'<svg width="16" height="14" viewBox="0 0 16 14">'
										+'<path d="M624,254H612a2,2,0,0,1-2-2v-8a2,2,0,0,1,2-2h3v2h-3v8h12v-8h-3v-2h3a2,2,0,0,1,2,2v8A2,2,0,0,1,624,254Zm-5.279-4.295a0.907,0.907,0,0,1-.291.193,0.993,0.993,0,0,1-.315.079h0A0.9,0.9,0,0,1,618,250a0.837,0.837,0,0,1-.179-0.044,0.971,0.971,0,0,1-.193-0.047,112.157,112.157,0,0,0-.307-0.2c-0.009-.01-0.012-0.022-0.021-0.032s-0.05-.033-0.068-0.057l-1.949-1.923a0.991,0.991,0,1,1,1.4-1.4L617,246.6V241a1,1,0,0,1,2,0v5.618l0.3-.3a0.991,0.991,0,0,1,1.4,1.4Z" transform="translate(-610 -240)"></path>'
									+'</svg>'
									+BX.message('SAVE_CONFIG')
								+'</span>'
							+'</div>'
						+'</div>';

function addSaveButtons(){
	if(!$('.bottom_panel').hasClass('wsavebtn')){
		$('.bottom_panel .right_block').append(saveButtonBottomPanel);
		$('.bottom_panel').addClass('wsavebtn');
	}

	if(!$('.style-switcher .header').hasClass('can_save')){
		$('.style-switcher .header .buttons').append(saveButtonSwitcher);
		$('.style-switcher .header').addClass('can_save');
	}
}

function checkChangeBlockBorders(){
	if($('.change_block#HEADER_TYPE').length && $('.banners-big.front').length && !$('.mixed_banners').length){
		var headerLogoMenuRowHeight = $('header .logo_and_menu-row').outerHeight(),
			headerTopBlockHeight = ($('header .top-block').length ? $('header .top-block').outerHeight() : 0);

		$('.change_block#HEADER_TYPE .left_border_changer').css('bottom', -headerLogoMenuRowHeight);
		$('.change_block#HEADER_TYPE .right_border_changer').css('bottom', -headerLogoMenuRowHeight);
		$('.change_block#HEADER_TYPE .bottom_border_changer').css('bottom', -headerLogoMenuRowHeight);
		$('.change_block#HEADER_TYPE .change_params').css('margin-top', headerLogoMenuRowHeight/2);
		$('.change_block#HEADER_TYPE .variant_panel').css('top', headerLogoMenuRowHeight + headerTopBlockHeight);
	}
	else{
		$('.change_block#HEADER_TYPE .left_border_changer').css('bottom', 0);
		$('.change_block#HEADER_TYPE .right_border_changer').css('bottom', 0);
		$('.change_block#HEADER_TYPE .bottom_border_changer').css('bottom', 0);
	}
}

function checkActionDownDisabled(){
	var maxDataOrder = 0;

	$('.drag-block .actions .action_down').removeClass('disabled');
	setTimeout(function(){
		$('.drag-block:visible').each(function(indx){
			var dataOrder = parseInt($(this).attr('data-order'));

			if(dataOrder > maxDataOrder){
				maxDataOrder = dataOrder;
			}
		}).promise().done(function(){
			$('.drag-block[data-order='+maxDataOrder+'] .actions .action_down').addClass('disabled');
		});
	}, 10);
}

function checkActionUpDisabled(){
	var minDataOrder = Infinity;

	$('.drag-block .actions .action_up').removeClass('disabled');
	setTimeout(function(){
		$('.drag-block:visible').each(function(indx){
			var dataOrder = parseInt($(this).attr('data-order'));

			if(dataOrder != 1 && dataOrder < minDataOrder){
				minDataOrder = dataOrder;
			}
		}).promise().done(function(){
			$('.drag-block[data-order='+minDataOrder+'] .actions .action_up').addClass('disabled');
		});
	}, 10);
}

function horizontalScroll(){
	if($('.bottom_panel .components .slider').length){
		$('.bottom_panel .components .slider').mCustomScrollbar('destroy');
		$('.bottom_panel .components .slider').mCustomScrollbar({
			axis: 'x',
		});
	}
}

function showTooltip(el, tooltipClass){
	var _this = el,
		offsetLeft = _this.offset().left,
		width = _this.outerWidth(),
		tooltip = _this.closest('.components').find('.tooltip.'+tooltipClass),
		tooltipWidth = tooltip.outerWidth(),
		tooltipPositionLeft = offsetLeft + width/2 - tooltipWidth/2;

	tooltip.css({'left': tooltipPositionLeft, 'opacity': 1, 'visibility': 'visible'});
}

function hideTooltip(el, tooltipClass){
	var _this = el,
		tooltip = _this.closest('.components').find('.tooltip.'+tooltipClass);

	tooltip.css({'opacity': 0, 'visibility': 'hidden'});
}

function InitToggle(cls){
	//toggle
	new DG.OnOffSwitchAuto({
		cls: cls,
		textOn:"",
		height:33,
		heightTrack:16,
		textOff:"",
		trackColorOff:"f5f5f5",
		listener:function(name, checked){
			var bNested = $('input[name='+name+']').closest('.values').length;
			if(checked)
				$('input[name='+name+']').val('Y');

			else
				$('input[name='+name+']').val('N');

			if(bNested)
			{
				var ajax_btn = $('<div class="btn-ajax-block animation-opacity"></div>'),
					option_wrapper = $('input[name='+name+']').closest('.option-wrapper'),
					pos = BX.pos(option_wrapper[0], true),
					top = 0,
					current_index = $('input[name='+name+']').closest('.inner-wrapper').data('key'),
					div_class = name.replace(current_index+'_','');
				ajax_btn.html($('.values > .apply-block').html());
				option_wrapper.toggleClass('disabled');
				top = pos.top+$('.style-switcher .header').actual('outerHeight');
				ajax_btn.css('top',top);
				if($('.btn-ajax-block').length)
					$('.btn-ajax-block').remove();
				ajax_btn.appendTo($('.style-switcher'));
				ajax_btn.addClass('opacity1');
			}

			if(checked)
			{
				$('.drag-block[data-class='+div_class+'_drag]').removeClass('hidden');
				$('.templates_block .item.'+name+'').removeClass('hidden');

				InitFlexSlider();
				$(window).resize();

				if(div_class == 'BIG_BANNER_INDEX' && $('.long-banner').length)
				{
					$('body').addClass('header_opacity');
				}

				$('[name='+name+']').closest('.option_wrap').removeClass('disabled');

				if($('input[name='+name+']').closest('.INDEX_PAGE').length){
					$('.bottom_panel .components .item .add_block[data-param_name='+name+']').closest('.item').css('opacity', 0);
					setTimeout(function(){
						$('.bottom_panel .components .item .add_block[data-param_name='+name+']').closest('.item').remove()
					}, 300);
				}
			}
			else
			{
				$('.drag-block[data-class='+div_class+'_drag]').addClass('hidden');
				$('.templates_block .item.'+name+'').addClass('hidden');

				if(div_class == 'BIG_BANNER_INDEX' && $('.long-banner').length)
				{
					$('body').removeClass('header_opacity');
				}

				$('[name='+name+']').closest('.option_wrap').addClass('disabled');

				if($('input[name='+name+']').closest('.INDEX_PAGE').length){
					var title = $('input[name='+name+']').closest('.option-wrapper').find('.block-title').text(),
						dragBlockClass = $('input[name='+name+']').closest('.inner-wrapper').data('key');

					dragBlockClass = name.replace(dragBlockClass + '_', '');
					title = title.replace(/"/g, '');
					title = title.replace(BX.message('IN_INDEX_PAGE'), '');

					var variantPanelHtml = ($('.change_block .variant_panel.' + dragBlockClass).length ? $('.change_block .variant_panel.' + dragBlockClass).clone()[0].outerHTML : '');

					var html = '<li class="item'+($('.style-switcher .right-block .block-item .item .options[data-code='+name+'_TEMPLATE]').length ? ' wtemplates' : '')+'">'
									+'<div class="title">'+title+'</div>'
									+'<span class="add_block" data-param_name="'+name+'" data-block="'+dragBlockClass+'">'
										+'<svg width="10" height="10" viewBox="0 0 10 10">'
											+'<path d="M784,250h-3v3a1,1,0,0,1-2,0v-3h-3a1,1,0,0,1,0-2h3v-3a1,1,0,0,1,2,0v3h3A1,1,0,0,1,784,250Z" transform="translate(-775 -244)"/>'
										+'</svg>'
									+'</span>'
									+variantPanelHtml
								+'</li>'

					if($('.bottom_panel .components .item').length){
						$('.bottom_panel .components .item').first().before(html);
					}
					else{
						$('.bottom_panel .components .slides').html(html);
					}
					$('.bottom_panel').find('.variant').append('<span class="select_variant"><span><svg width="16" height="16" viewBox="0 0 16 16"><path d="M595,598h-6v6a1,1,0,0,1-2,0v-6h-6a1,1,0,1,1,0-2h6v-6a1,1,0,0,1,2,0v6h6A1,1,0,1,1,595,598Z" transform="translate(-580 -589)"/></svg></span></span>');
				}
			}

			horizontalScroll();

			//save option
			/*$.post(
				arPriorityOptions['SITE_DIR']+"ajax/options_save_mainpage.php",
				{
					VALUE: $('input[name='+name+']').val(),
					NAME: name
				}
			);*/

			$.ajax({
				url: arPriorityOptions['SITE_DIR']+"ajax/options_save_mainpage.php",
				type: 'POST',
				dataType: 'json',
				data: {'VALUE': $('input[name='+name+']').val(), NAME: name},
				success: function(response){
					if(response.CAN_SAVE === true){
						addSaveButtons();
					}
				},
			});

			setTimeout(function(){
				if(!bNested)
					$('form[name=style-switcher]').submit();
			},200);
		}
	});
}

$(document).ready(function() {
	checkChangeBlockBorders();
	InitToggle($('.block-item.active .sup-params').length ? '.block-item.active .sup-params.active .custom-switch' : '.block-item.active .custom-switch');
	if(!$('.block-item.INDEX_PAGE').hasClass('active')){
		InitToggle('.block-item.INDEX_PAGE .sup-params.active .custom-switch');
		$('.style-switcher .left-block .section-block.INDEX_PAGE').addClass('init_toggle');
	}

	$('.style-switcher .left-block').mCustomScrollbar({
		mouseWheel: {
			scrollAmount: 150,
			preventDefault: true
		},
		callbacks:{
			onScroll: function(){
				var topPositionLeftBlock = $('.style-switcher .left-block .mCSB_container').css('top');

				$.cookie('STYLE_SWITCHER_SCROLL_LEFT_POSITION', topPositionLeftBlock, {path: arPriorityOptions['SITE_DIR']});
			}
		},
		setTop: (typeof($.cookie('STYLE_SWITCHER_SCROLL_LEFT_POSITION')) !== 'undefined' ? $.cookie('STYLE_SWITCHER_SCROLL_LEFT_POSITION') : 0),
	});

	$('.style-switcher .right-block').mCustomScrollbar({
		mouseWheel: {
			scrollAmount: 150,
			preventDefault: true,
		},
		callbacks:{
			onScroll: function(){
				var topPositionRightBlock = $('.style-switcher .right-block .mCSB_container').css('top');

				$.cookie('STYLE_SWITCHER_SCROLL_RIGHT_POSITION', topPositionRightBlock, {path: arPriorityOptions['SITE_DIR']});
			}
		},
		setTop: (typeof($.cookie('STYLE_SWITCHER_SCROLL_RIGHT_POSITION')) !== 'undefined' ? $.cookie('STYLE_SWITCHER_SCROLL_RIGHT_POSITION') : 0),
	});

	if($('.oversite_button').hasClass('active')){
		$('body').addClass('body_animate');
	}

	$('.style-switcher .right-block .block-item .item .sup-params.options .values .value.hide_block .on-off-switch').remove();

	horizontalScroll();

	$('.style-switcher .item input[type=checkbox]:not(.back_input)').on('change', function(){
		var _this =  $(this);
		if(_this.is(':checked'))
			_this.val('Y');
		else
			_this.val('N');

		$('form[name=style-switcher]').submit();
	})

	$('.change_block .variant_panel').each(function(){
		$(this).find('.variant .title').sliceHeight({allElements: true});
		$(this).find('.variant .image').sliceHeight({allElements: true});
	});

	$('.style-switcher .left-block .section-block:not(.active)').on('click', function(){
		var _this = $(this);
		setTimeout(function(){
			if(!_this.hasClass('init_toggle')){
				InitToggle($('.block-item.active .sup-params').length ? '.block-item.active .sup-params.active .custom-switch' : '.block-item.active .custom-switch');
			}

			_this.addClass('init_toggle');
		}, 0);
	});

	//admin save
	$(document).on('click', '.style-switcher .can_save .save_btn', function(){
		var _this = $(this);

		if(timerHide){
			clearTimeout(timerHide);
			timerHide = false;
		}

		$.ajax({
			type:"POST",
			url:arPriorityOptions['SITE_DIR']+"ajax/options_save.php",
			data:{'SAVE_OPTIONS':'Y'},
			dataType:"json",
			success:function(response){
				if("STATUS" in response)
				{
					if(!$('.save_config_status').length){
						$('.save_btn').each(function(){
							$('<div class="save_config_status"><span></span></div>').appendTo($(this));
						});
					}
					if(response.STATUS === 'OK')
						$('.save_config_status').addClass('success');
					else
						$('.save_config_status').addClass('error');

					$('.save_config_status span').text(BX.message(response.MESSAGE));

					$('.save_config_status').slideDown(200);
					timerHide = setTimeout(function(){
						// here delayed functions in event
						$('.save_config_status').slideUp(200, function(){
							$(this).remove();
						})
					}, 1000);
				}
			}
		})
	});

	//admin save publick button click
	$(document).on('click', '.save_btn.changer', function(){
		var _this = $(this);

		if(timerHide){
			clearTimeout(timerHide);
			timerHide = false;
		}

		$.ajax({
			type:"POST",
			url:arPriorityOptions['SITE_DIR']+"ajax/options_save.php",
			data:{'SAVE_OPTIONS':'Y'},
			dataType:"json",
			success:function(response){
				if("STATUS" in response)
				{
					if(!$('.save_config_status').length){
						$('.save_btn').each(function(){
							$('<div class="save_config_status"><span></span></div>').appendTo($(this));
						});
					}
					if(response.STATUS === 'OK')
						$('.save_config_status').addClass('success');
					else
						$('.save_config_status').addClass('error');

					$('.save_config_status span').text(BX.message(response.MESSAGE));

					$('.save_config_status').slideDown(200);
					timerHide = setTimeout(function(){
						// here delayed functions in event
						$('.save_config_status').slideUp(200, function(){
							$(this).remove();
						})
					}, 1000);
				}
			}
		})
	});

	//sort order for main page
	checkActionDownDisabled();
	checkActionUpDisabled();
	$(document).on('change', '.ajax_save_option', function(){
		var name = $(this).attr('name'),
			value = ($(this).prop('checked') == true ? 'Y' : 'N');

		$.ajax({
			url: arPriorityOptions['SITE_DIR']+"ajax/options_save_mainpage.php",
			type: 'POST',
			dataType: 'json',
			data: {'VALUE': value, NAME: name},
			success: function(response){
				if(response.CAN_SAVE === true){
					addSaveButtons();
				}
			},
		});
	});


	$(document).on('click', '.change_block .actions .action_down:not(.disabled)', function(){
		var _this = $(this),
			thisDataOrder = parseInt(_this.closest('.drag-block').attr('data-order')),
			nextDataOrder = 0, diff = Infinity, tmp, min = Infinity, el;

		$('.drag-block:visible').each(function(){
			tmp = parseInt($(this).attr('data-order'));
			if (tmp > thisDataOrder ){
				diff = tmp - thisDataOrder;

				if (diff < min){
					min = diff;
					nextDataOrder = tmp;
				}
			}
		}).promise().done(function(){
			var insertAfterElement = $('.style-switcher .right-block .block-item.INDEX_PAGE .item .sup-params.options.active .values .option-wrapper').eq(nextDataOrder - 1),
				switcherOptionDown = $('.style-switcher .right-block .block-item.INDEX_PAGE .item .sup-params.options.active .values .option-wrapper').eq(thisDataOrder - 1).detach();
				switcherOptionDown.insertAfter(insertAfterElement);

			_this.closest('body').find('.drag-block[data-order='+nextDataOrder+']').attr('data-order', nextDataOrder - 1);
			_this.closest('.drag-block').attr('data-order', nextDataOrder);
			checkActionDownDisabled();
			checkActionUpDisabled();

			window['sort'+$('.INDEX_PAGE .sup-params.active').index()].options.onUpdate(function(){});
			var blockOffsetTop = _this.closest('.drag-block').offset().top,
				headerFixedHeight = ($('#headerfixed').length ? $('#headerfixed').outerHeight() : 0);

			$('body').prepend('<div class="slide_overlay"></div>');
			$('html, body').animate({scrollTop: blockOffsetTop - headerFixedHeight}, 500, function(){
				$('.slide_overlay').remove();
			});
		});
	});

	$(document).on('click', '.change_block .actions .action_up:not(.disabled)', function(){
		var _this = $(this),
			thisDataOrder = parseInt(_this.closest('.drag-block').attr('data-order')),
			prevDataOrder = 0, diff = 0, tmp, min = Infinity, el;
		$('.drag-block:visible').each(function(){
			tmp = parseInt($(this).attr('data-order'));

			if (tmp < thisDataOrder){
				diff = thisDataOrder - tmp;
				if (diff < min){
					min = diff;
					prevDataOrder = tmp;
				}
			}
		}).promise().done(function(){
			var switcherOptionDown = $('.style-switcher .right-block .block-item.INDEX_PAGE .item .sup-params.options.active .values .option-wrapper').eq(thisDataOrder - 1).detach();
			switcherOptionDown.insertBefore($('.style-switcher .right-block .block-item.INDEX_PAGE .item .sup-params.options.active .values .option-wrapper').eq(prevDataOrder - 1));

			_this.closest('body').find('.drag-block[data-order='+prevDataOrder+']').attr('data-order', prevDataOrder - 1);
			_this.closest('.drag-block').attr('data-order', prevDataOrder);
			checkActionDownDisabled();
			checkActionUpDisabled();

			window['sort'+$('.INDEX_PAGE .sup-params.active').index()].options.onUpdate(function(){});
			var blockOffsetTop = _this.closest('.drag-block').offset().top,
				headerFixedHeight = ($('#headerfixed').length ? $('#headerfixed').outerHeight() : 0);
			$('body').prepend('<div class="slide_overlay"></div>');
			$('html, body').animate({scrollTop: blockOffsetTop - headerFixedHeight}, 500, function(){
				$('.slide_overlay').remove();
			});
		});
	});

	$(document).on('click', '.bottom_panel .components .item.wtemplates .variant_panel .variant', function(){
		var _this = $(this);
		if(!$(this).hasClass('active')){
			var paramName = _this.data('param_name'),
				paramValue = _this.data('param_value'),
				type = _this.data('type'),
				componentTemplate = _this.data('component_template');

			$('.change_block .variant_panel.' + paramName + ' .variant[data-param_name='+paramName+'][data-param_value='+paramValue+'][data-type='+type+'][data-component_template='+componentTemplate+']').click();
			_this.closest('.item.wtemplates').find('.add_block').click();
		}
	});

	$(document).on('click', '.bottom_panel .components .item.wtemplates .variant_panel .variant.active', function(){
		$(this).closest('.item').find('.add_block').click();
	});

	$(document).on('click', '.bottom_panel .components .item.wtemplates .variant_panel', function(e){
		e.stopPropagation();
	});

	$(document).on('click', '.bottom_panel .components .item.wtemplates .variant_panel .close_panel', function(){
		$(this).closest('.variant_panel').css({'opacity': 0, 'visibility': 'hidden'});
		$(this).closest('.item').removeClass('opened');
	});

	$(document).on('click', 'body', function(){
		$('.bottom_panel .components .item').removeClass('opened');
		$('.bottom_panel .components .item.wtemplates .variant_panel').css({'opacity': 0, 'visibility': 'hidden'});
	});

	/*$('.bottom_panel .components .item.wtemplates .variant_panel .variant_flexslider').addEventListener('touchmove', function(e){
		e.stopPropagation();
		console.log(123);
	}, false);*/

	$(document).on('click', '.bottom_panel .components .item.wtemplates', function(e){
		e.stopPropagation();
		var _this = $(this);

		if(!$(this).hasClass('opened')){
			$('.bottom_panel .components .item').removeClass('opened');
			$(this).addClass('opened');
			$('.bottom_panel .components .item .variant_panel').css({'opacity': 0, 'visibility': 'hidden'});
			setTimeout(function(){
				_this.find('.variant_panel').css({'opacity': 1, 'visibility': 'visible'});
			}, 200);
		}
		else{
			$(this).removeClass('opened');
			_this.find('.variant_panel').css({'opacity': 0, 'visibility': 'hidden'});
		}

		_this.closest('.components').find('>.tooltip').css({'opacity': 0, 'visibility': 'hidden'});
	});

	$(document).on('click', '.bottom_panel .components .item .add_block', function(){
		var _this = $(this),
			paramName = _this.data('param_name'),
			dragBlockClass = _this.data('block');

		$('.style-switcher .INDEX_PAGE .options input[type=checkbox][name='+paramName+']').closest('.value').find('.on-off-switch .on-off-switch-track').click();
		checkActionDownDisabled();
		checkActionUpDisabled();
		$('[data-class='+dragBlockClass+'_drag]').css('opacity', 0);
		setTimeout(function(){
			var dragBlockClassOffset = $('[data-class='+dragBlockClass+'_drag]').offset().top,
				headerFixedHeight = $('#headerfixed').outerHeight();
			$(window).resize();
			setTimeout(function(){
				$('html, body').animate({scrollTop: dragBlockClassOffset - headerFixedHeight}, 500);
				$('[data-class='+dragBlockClass+'_drag]').css('opacity', 1);
			}, 500);
		}, 300);

		horizontalScroll();
	});

	$(document).on('mouseenter', '.bottom_panel .components .item .add_block', function(e){
		$(this).closest('.components').find('.tooltip.action_select').css({'opacity': 0, 'visibility': 'hidden'});
		showTooltip($(this), 'action_activate');
	});

	$(document).on('mouseleave', '.bottom_panel .components .item .add_block', function(){
		hideTooltip($(this), 'action_activate');
	});

	$(document).on('mouseenter', '.bottom_panel .components .item.wtemplates:not(.opened)', function(e){
		if($(e.target).hasClass('add_block') || e.target.nodeName == 'svg' || e.target.nodeName == 'path' || $(this).closest('.components').find('.tooltip.action_select').css('opacity') == 1){
			return;
		}
		showTooltip($(this), 'action_select');
	});

	$(document).on('mouseleave', '.bottom_panel .components .item', function(){
		hideTooltip($(this), 'action_select');
	});

	$(document).on('mousemove', '.bottom_panel .components .item.wtemplates:not(.opened)', function(e){
		if($(e.target).hasClass('add_block') || e.target.nodeName == 'svg' || e.target.nodeName == 'path' || $(this).closest('.components').find('.tooltip.action_select').css('opacity') == 1){
			return;
		}
		showTooltip($(this), 'action_select');
	});

	$(document).on('click', '.change_block .actions .action_hide', function(){
		var _this = $(this),
			paramName = _this.data('param_name'),
			dragBlockClass = _this.data('block'),
			title = _this.data('title');

		_this.closest('.change_block').css('transition', '');
		_this.closest('.drag-block').slideUp(400, function(){
			_this.closest('.drag-block').removeAttr('style');
			_this.closest('.change_block').css({'transition': 'all 0.3s ease','-moz-transition': 'all 0.3s ease','-ms-transition': 'all 0.3s ease','-o-transition': 'all 0.3s ease','-webkit-transition': 'all 0.3s ease'});
			$('.style-switcher .INDEX_PAGE .sup-params.active input[type=checkbox][name='+paramName+']').closest('.value').find('.on-off-switch .on-off-switch-track').click();
			checkActionDownDisabled();
			checkActionUpDisabled();
			//checkActionDownDisabled();
			//checkActionUpDisabled();
			horizontalScroll();
		});
	});

	$('.refresh-block.sup-params .values .inner-wrapper').each(function(indx){
		var _th = $(this),
			sort_block = _th[0];
		window["sort"+indx] = Sortable.create(sort_block,{
			handle: '.drag',
			animation: 150,
			forceFallback: true,
			filter: '.no_drag',
			// Element dragging started
			onStart: function (/**Event*/evt){
				evt.oldIndex;  // element index within parent
				window.getSelection().removeAllRanges();
			},
			onMove: function (evt) {
				return evt.related.className.indexOf('no_drag') === -1;
			},
			// Changed sorting within list
			onUpdate: function (/**Event*/evt){
				var itemEl = evt.item;  // dragged HTMLElement
				var order = [],
					current_type = _th.data('key'),
					name = 'SORT_ORDER_INDEX_TYPE_'+current_type;
				_th.find('.option-wrapper').each(function(){
					order.push($(this).find('input[type="checkbox"]').attr('name').replace(current_type+'_', ''));
					$('div[data-class="'+$(this).find('input[type="checkbox"]').attr('name').replace(current_type+'_', '')+'_drag"]').attr('data-order', $(this).index()+1);
				})

				$('input[name='+name+']').val(order.join(','));

				//save option
				$.ajax({
					url: arPriorityOptions['SITE_DIR']+"ajax/options_save_mainpage.php",
					type: 'POST',
					dataType: 'json',
					data: {'VALUE': $('input[name='+name+']').val(), NAME: name},
					success: function(response){
						if(response.CAN_SAVE === true){
							addSaveButtons();
						}
					},
				});
			},
		});
	})

	if($.cookie('styleSwitcher') == 'open')
		$('.style-switcher').addClass('active');

	if($('.base_color_custom input[type=hidden]').length)
	{
		$('.base_color_custom input[type=hidden]').each(function(){
			var _this = $(this),
				parent = $(this).closest('.base_color_custom');
			_this.spectrum({
				preferredFormat: 'hex',
				showButtons: true,
				showInput: true,
				showPalette: false,
				appendTo: parent,
				chooseText: BX.message('CUSTOM_COLOR_CHOOSE'),
				cancelText: BX.message('CUSTOM_COLOR_CANCEL'),
				containerClassName: 'custom_picker_container',
				replacerClassName: 'custom_picker_replacer',
				clickoutFiresChange: false,
				move: function(color) {
					var colorCode = color.toHexString();
					parent.find('span span').attr('style', 'background:' + colorCode);
				},
				hide: function(color) {
					var colorCode = color.toHexString();
					parent.find('span span').attr('style', 'background:' + colorCode);
				},
				change: function(color) {
					parent.addClass('current').siblings().removeClass('current');

					$('form[name=style-switcher] input[name=' + parent.find('.click_block').data('option-id') + ']').val(parent.find('.click_block').data('option-value'));
					$('form[name=style-switcher]').submit();
				}
			});
		})
	}

	$('.base_color_custom').click(function(e) {
		e.preventDefault();
		$('input[name='+$(this).data('name')+']').spectrum('toggle');
		return false;
	});

	if($('.base_color.current').length)
	{
		$('.base_color.current').each(function(){
			var color_block = $(this).closest('.options').find('.base_color_custom'),
				curcolor = $(this).data('color');
			if(curcolor != undefined && curcolor.length)
			{
				$('input[name='+color_block.data('name')+']').spectrum('set', curcolor);
				color_block.find('a span').attr('style', 'background:' + curcolor);
			}
		})
	}

	$('.style-switcher .switch').click(function(e){
		e.preventDefault();
		var styleswitcher = $(this).closest('.style-switcher');

		HideHintBlock();

		if(styleswitcher.hasClass('active')){
			$('html').removeClass('overflow_html');
			styleswitcher.addClass('closes');
			setTimeout(function(){
				styleswitcher.removeClass('active');
			},500)
			$.removeCookie('styleSwitcher', {path: '/'});
		}
		else{
			$('html').addClass('overflow_html');
			ShowOverlay();
			styleswitcher.removeClass('closes').addClass('active');
			$.cookie('styleSwitcher', 'open', {path: arPriorityOptions['SITE_DIR']});
		}
	});

	HideHintBlock = function()
	{
		HideOverlaySwitcher();
		$.cookie('clickedSwitcher', 'Y', {path: arPriorityOptions['SITE_DIR']});
		if($('.hint-theme').length)
		{
			$('.hint-theme').fadeIn(300, function(){
				$('.hint-theme').remove();
			});
		}
	}

	$(document).on('click', '.style-switcher .right-block .block-item .item .options .rows .tabs_content .opener_wrap', function(){
		var tabs = $(this).closest('.tabs_content'),
			itemHeight = tabs.find('.item.current').outerHeight(),
			animationTime = 300;

		if(!tabs.hasClass('opened')){
			tabs.addClass('opened').animate({height: itemHeight}, animationTime);
		}
		else{
			tabs.removeClass('opened').animate({height: '379px'}, animationTime);
		}
	});

	$(document).on('click', '.close-overlay', function(){
		HideHintBlock()
	})

	$(document).on('click', '.jqmOverlay', function(){
		var styleswitcher = $('.style-switcher');
		if(!$('.hint-theme').length)
			HideOverlaySwitcher();
		styleswitcher.each(function(){
			var _this = $(this);
			_this.addClass('closes');
			setTimeout(function(){
				_this.removeClass('active');
			},500);
			$('.form_demo-switcher').animate({left: '-' + $('.form_demo-switcher').outerWidth() + 'px'}, 100).removeClass('active abs');
		})
		$.removeCookie('styleSwitcher', {path: '/'});
	})

	$('.style-switcher .section-block').on('click', function(){
		$(this).siblings().removeClass('active');
		$(this).addClass('active');
		$('.style-switcher .right-block .block-item').removeClass('active');
		$('.style-switcher .right-block .block-item:eq('+$(this).index()+')').addClass('active');
		$.cookie('styleSwitcherTabIndex', $(this).index(), {path: arPriorityOptions['SITE_DIR']});
	})

	$('.style-switcher .reset, .bottom_panel .reset').click(function(e){
		$('form[name=style-switcher]').append('<input type="hidden" name="THEME" value="default" />');
		$('form[name=style-switcher]').submit();
	});

	$(document).on('click', '.style-switcher .apply', function(){
		$('form[name=style-switcher]').submit();
	})
	$('.style-switcher .sup-params.options .title_wrap .block-title').click(function(){
		$(this).closest('.sup-params').toggleClass('opened');
		$(this).closest('.sup-params').find('.values').slideToggle();
	});

	$('.style-switcher .options > a,.style-switcher .options > div:not(.base_color_custom) a, .style-switcher .options > div:not(.base_color_custom) .click_block').click(function(e){
		var _this = $(this);
		if(_this.hasClass('current'))
			return;

		_this.addClass('current').siblings().removeClass('current');
		$('form[name=style-switcher] input[name=' + _this.data('option-id') + ']').val(_this.data('option-value'));

		if(typeof($(this).data('option-type')) != 'undefined') // set cookie for scroll block
			$.cookie('scoll_block', $(this).data('option-type'), {path: arPriorityOptions['SITE_DIR']});

		if(typeof($(this).data('option-url')) != 'undefined') // set action form for redirect
			$('form[name=style-switcher]').prepend('<input type="hidden" name="backurl" value='+$(this).data('option-url')+' />');

		if(_this.closest('.options').hasClass('refresh-block'))
		{
			if(!_this.closest('.options').hasClass('sup-params'))
				var index = _this.index()-1;


			/*if(_this.data('option-value') == 'custom' || (typeof(index) != 'undefined' && !$('.sup-params.options:eq('+index+')').length))
			{
				$('.sup-params.options').removeClass('active');
				$('form[name=style-switcher]').submit();
			}
			else
			{*/
				/*if($('.sup-params.options').length && typeof(index) != 'undefined')
				{*/
					_this.closest('.item').find('.sup-params.options').removeClass('active');
					_this.closest('.item').find('.sup-params.options.s_'+_this.data('option-value')+'').addClass('active');
					// _this.closest('.item').find('.sup-params.options:eq('+index+')').addClass('active');
				//}
			//}

			$('form[name=style-switcher]').submit();
		}
		else{
			/*if(typeof(_this.data('option-id')) !== 'undefined' && _this.data('option-id') == 'TYPE_INDEX'){
				var optionID = _this.data('option-id'),
					value = _this.data('option-value');

				$.ajax({
					type:"POST",
					url:arPriorityOptions['SITE_DIR']+"ajax/options_save_mainpage.php",
					data:{'NAME': optionID, 'VALUE': value},
					success:function(data){
						window.location.href = arPriorityOptions['SITE_DIR'];
					}
				});
			}
			else{*/
				$('form[name=style-switcher]').submit();
			//}
		}
	});

	$('.variant_flexslider').each(function(){
		$(this).flexslider({
			animation: "slide",
			itemWidth: ($(this).hasClass('wimage') ? 155 : 47),
			itemMargin: 10,
			controlNav: false,
			slideshow: false,
			prevText: '<svg width="7" height="10" viewBox="0 0 7 10"><path d="M894.306,249.7l4.972,4a1,1,0,0,0,1.42,0,1.011,1.011,0,0,0,.293-0.706H901v-8h-0.01a1,1,0,0,0-1.712-.727l-4.972,4A1.013,1.013,0,0,0,894.306,249.7Z" transform="translate(-894.031 -244)"/></svg>',
			nextText: '<svg width="7" height="10" viewBox="0 0 7 10"><path d="M891.724,249.7l-4.994,4a1.008,1.008,0,0,1-1.721-.706H885v-8h0.01a1.007,1.007,0,0,1,1.72-.727l4.994,4A1.012,1.012,0,0,1,891.724,249.7Z" transform="translate(-885 -244)"/></svg>',
		});
	});

	$(document).on('click', '.jqmOverlay.waiting', function(){
		$('html').removeClass('overflow_html');
	});

	$(document).on('click', '.bottom_panel .close', function(){
		$.cookie('OVERSITE_PANEL_SHOW', null, {path: arPriorityOptions['SITE_DIR']});
		window.location.href = window.location.href;
	});

	$(document).on('click', '.style-switcher .oversite_button', function(){
		if(!$(this).hasClass('active')){
			$.cookie('OVERSITE_PANEL_SHOW', 'Y', {path: arPriorityOptions['SITE_DIR']});
		}
		else{
			$.cookie('OVERSITE_PANEL_SHOW', null, {path: arPriorityOptions['SITE_DIR']});
		}

		window.location.href = window.location.href;
	});

	$(document).on('click', '.style-switcher .oversite_button .tooltip', function(e){
		e.stopPropagation();
	});

	setTimeout(function(){
		$('div.change_block').css({'transition': 'all 0.3s ease','-moz-transition': 'all 0.3s ease','-ms-transition': 'all 0.3s ease','-o-transition': 'all 0.3s ease','-webkit-transition': 'all 0.3s ease'});
		$('div.change_block').each(function(){
			var height = $(this).outerHeight();
			$(this).height(height);
		});
	}, 2000);

	$(document).on('click', '.change_block .change_params, .change_block .variant_panel .variant', function(){
		var _this = $(this),
			paramName = _this.data('param_name'),
			paramValue = parseInt(_this.data('param_value')),
			pageType = _this.data('type'),
			componentTemplate = _this.data('component_template'),
			indexNumber = $('input#INDEX_TYPE').val(),
			maxValue = (componentTemplate ? parseInt(objCountValues[indexNumber+'_'+paramName+'_TEMPLATE']) : parseInt(objCountValues[paramName])),
			offsetTopBlock = $('div#'+paramName).offset().top,
			headerFixedHeight = $('#headerfixed').outerHeight(true, true);

		$('.order_product_frame').remove();

		if(_this.hasClass('left_params')){
			paramValue = (paramValue < 1 ? maxValue : paramValue);
		}
		else if(_this.hasClass('right_params')){
			paramValue = (paramValue > maxValue ? 1 : paramValue);
		}
		_this.closest('.change_block').find('.left_params').data('param_value', paramValue - 1);
		_this.closest('.change_block').find('.right_params').data('param_value', paramValue + 1);
		//if(_this.hasClass('left_params'))
		//console.log(paramValue);
		/*else if(_this.hasClass('variant')){
			paramValue
		}*/

		//_this.closest('.change_block').find('.change_params').data('param_value', (_this.hasClass('left_params') ? _this.data('param_value') - 1 : _this.data('param_value') + 1));
		/*_this.closest('.change_block').find('.change_params').each(function(){
			//console.log($(this).data('param_value'));
			var thisParamValue = (_this.hasClass('left_params') ? $(this).data('param_value') - 1 : $(this).data('param_value') + 1);

			if(thisParamValue < 1){
				if($(this).hasClass('left_params')){
					$(this).data('param_value', maxValue)
				}
				else if($(this).hasClass('right_params')){
					$(this).data('param_value', 1)
				}
			}
			else if(paramValue > maxValue){
				if($(this).hasClass('left_params')){
					$(this).data('param_value', maxValue)
				}
				else if($(this).hasClass('right_params')){
					$(this).data('param_value', 1)
				}
			}
			else{
				$(this).data('param_value', thisParamValue)
			}
				console.log(thisParamValue);
		});*/
		_this.closest('.change_block').find('.variant_panel .variant').removeClass('active');
		_this.closest('.change_block').find('.variant_panel .variant[data-param_value='+paramValue+']').addClass('active');

		$('div#'+paramName + '>.wrap').css('opacity', 0);
		$('.style-switcher [name='+paramName+']').val(paramValue);


		if(paramName == 'HEADER_TYPE' || paramName == 'FOOTER_TYPE'){
			$('.style-switcher [data-option-id='+paramName+']').removeClass('current')
			$('.style-switcher [data-option-id='+paramName+'][data-option-value='+paramValue+']').addClass('current')
		}
		else{
			$('.style-switcher [data-option-id='+indexNumber+'_'+paramName+'_TEMPLATE]').removeClass('current')
			$('.style-switcher [data-option-id='+indexNumber+'_'+paramName+'_TEMPLATE][data-option-value='+paramValue+']').addClass('current')
		}

		$.ajax({
			type: "POST",
			url: arPriorityOptions['SITE_DIR']+"ajax/options_change_oversite.php",
			data: {'PARAM_NAME': paramName, 'PARAM_VALUE': paramValue, 'PAGE_TYPE': pageType, 'ajaxPost': 'Y', 'COMPONENT_TEMPLATE': componentTemplate},
			success: function(html){
				setTimeout(function(){
					//$('div#' + paramName).find('.flexslider .item>.wrap').css('opacity', 0);
					html = $.trim(html);
					$('div#' + paramName + '>.wrap').html($(html).find('>.wrap').html()).css('opacity', 1);
					setTimeout(function(){
						height = $('div#'+paramName+'>.wrap').outerHeight();
						$('div#'+paramName).height(height);
					}, 100);

					switch(componentTemplate){
						case 'services':
							$('.item-views.services-items.icons:not(.type_1) .items .item>.wrap').sliceHeight();
							//$('.item-views.services-items.type_2 .items .item:not(.wti) .body-info').sliceHeight();
							$('.item-views.services-items.type_2 .items .item>.wrap').sliceHeight();
							$('.item-views.services-items.type_3 .items .item>.wrap').sliceHeight();
							$('.item-views.services-items.type_4 .items .item>.wrap').sliceHeight();
							$('.item-views.services-items.type_5 .items .item>.wrap').sliceHeight();

							if($('.item-views.services-items.type_2').length){
								$('.item-views.services-items.type_2 .item').each(function(){
									var itemID = $(this).data('id');

									window['hoverItem'+itemID] = false
								});

								$('.item-views.services-items.type_2 .items .item>.wrap').hover(function(){
									var block = $(this).find('.body-info'),
										itemID = $(this).closest('.item').data('id');

									clearTimeout(window['hoverItem'+itemID]);
									block.find('.bottom-block').show();

									var marginTop = block.find('.bottom-block').outerHeight();
									block.closest('.body-info').css('margin-top', -marginTop);
								},
								function(){
									var block = $(this).find('.bottom-block'),
										itemID = $(this).closest('.item').data('id');
									block.closest('.body-info').css('margin-top', '0');
									window['hoverItem'+itemID] = setTimeout(function(){
										block.hide();
									}, 200);
								});
							}
							break;
						case 'products':
							$('.item-views.services-items.icons .items .item>.wrap').sliceHeight();
							$('.item-views.services-items.type_2 .items .item:not(.wti) .body-info').sliceHeight();
							$('.item-views.services-items.type_2 .items .item>.wrap').sliceHeight();
							$('.item-views.services-items.type_3 .items .item>.wrap').sliceHeight();
							$('.item-views.services-items.type_4 .items .item>.wrap').sliceHeight();
							$('.item-views.services-items.type_5 .items .item>.wrap').sliceHeight();
							break;
						case 'company':
							$('.item-views.company.front:not(.type_4) .company-block>.row>.item').sliceHeight();
							break;
						case 'staff':
							if($('.sections.linked.item-views.staff.within.front.type_3').length){
								$('.sections.linked.item-views.staff .item .post').sliceHeight();
								$('.sections.linked.item-views.staff .item .title').sliceHeight();
								$('.sections.linked.item-views.staff .item>.wrap').sliceHeight();

								$('.item-views.staff .items .item').each(function(){
									var itemID = $(this).data('id');

									window['hoverItem'+itemID] = false
								});

								$('.item-views.staff .items .item').hover(function(){
									var block = $(this).find('.bottom-block'),
										itemID = $(this).closest('.item').data('id');

									clearTimeout(window['hoverItem'+itemID]);
									block.show();
									var blockHeight = block.outerHeight(true, true);

									block.closest('.body-info').css('margin-top', -blockHeight);
								},
								function(){
									var block = $(this).find('.bottom-block'),
										itemID = $(this).closest('.item').data('id');

									block.closest('.body-info').css('margin-top', '0');
									//block.css('opacity', 0);
									window['hoverItem'+itemID] = setTimeout(function(){
										block.hide();
									}, 200);
								});
							}
							if($('.sections.linked.item-views.staff.within.front.type_4').length){
								$('.sections.linked.item-views.staff .item .post').sliceHeight();
								$('.sections.linked.item-views.staff .item .title').sliceHeight();
								$('.sections.linked.item-views.staff .item>.wrap').sliceHeight();

								$('.item-views.staff .items .item').hover(function(){
									var block = $(this).find('.bottom-block');
									block.show();
									var blockHeight = block.outerHeight(true, true);

									block.closest('.body-info').css('margin-top', -blockHeight);
								},
								function(){
									var block = $(this).find('.bottom-block');
									block.closest('.body-info').css('margin-top', '0');
									block.css('opaity', 0);
									//setTimeout(function(){
										block.hide();
									//}, 200);
								});
							}

							break;
						case 'contacts':
							if($('.contacts.front.type_2').length){
								$('.contacts.front.type_2 .items').mCustomScrollbar({
									mouseWheel: {preventDefault: true},
								});
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

								$(document).on('click', '.contacts.front.type_2 .jqmClose', function(){
									var _this = $(this).closest('.left_block').find('.detail_desc_items .item:visible'),
										animationTime = 200;

									_this.fadeOut(animationTime);
									_this.closest('.detail_desc_items').fadeOut(animationTime, function(){
										_this.closest('.left_block').find('.items').fadeIn(animationTime);
										_this.closest('.left_block').find('>.top_block').fadeIn(animationTime);
									});
								});
								/*if(typeof(map) !== 'undefined' && map){
									map.destroy();
								}	*/
							}
							break;
						case 'news':
							$('.item-views.front.news-items:not(.projects) .item:not(.wti) .body-info').sliceHeight();
							$('.item-views.front.news-items:not(.projects) .item:not(.wti)>.wrap').sliceHeight();
							$('.item-views.front.news-items:not(.projects) .item>.wrap').sliceHeight();
							$('.item-views.front.news-items:not(.projects) .item').sliceHeight();
							break;
						case 'tarifs':
							setBasketItemsClasses();
							$('.item-views.tarifs.type_2 .flexslider .item .image').sliceHeight({allElements: true});
							$('.item-views.tarifs .flexslider .item .section_name').sliceHeight({allElements: true});
							$('.item-views.tarifs .flexslider .item .name').sliceHeight({allElements: true});
							$('.item-views.tarifs .flexslider .item .previewtext').sliceHeight({allElements: true});
							$('.item-views.tarifs .flexslider .item .properties').sliceHeight({allElements: true});
							$('.item-views.tarifs .flexslider .item .prices').sliceHeight({allElements: true});
							$('.item-views.tarifs .flexslider .item .body-wrap').sliceHeight({allElements: true});
							$('.item-views.tarifs .flexslider .item>.wrap').sliceHeight({allElements: true});

							//$('.item-views.tarifs .item .prices .all_price').mCustomScrollbar();
							/*$('.item-views.tarifs .item .prices .price_default.wdropdown .title-price>span').on('click', function(e){
								e.stopPropagation();
								$(this).closest('.prices').find('.all_price').toggleClass('showen');
							});

							$('body').on('click', function(){
								$('.item-views.tarifs .item .prices .all_price').removeClass('showen');
							});

							$('.rolldown>span').on('click', function(){
								openerFunc($(this));
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

								_this.closest('.prices').find('.title-price>span>span').text(name);
								_this.closest('.prices').find('.value').text(price);
								_this.closest('.item').find('.order .btn').data('product', itemName + ': ' + price);
							});

							$('.item-views.tarifs .item').each(function(){
								var _this = $(this),
									json = _this.data('item'),
									price = filterPrice = _this.find('.price_default .value').data('price'),
									filterPrice = _this.find('.price_default .value').data('filter_price');

								if(typeof(json) !== 'undefined'){
									json.PROPERTY_PRICE_VALUE = price;
									json.PROPERTY_FILTER_PRICE_VALUE = filterPrice;
									_this.data('item', json)
								}
							});*/

							TemplateTarifsScript();
							sliceProps();
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
							break;
						case 'instagram':
							$('.instagram_ajax .instagram .item .desc').mCustomScrollbar();
							$('#INSTAGRAMM_INDEX').resize();
							break;
					}

					if(pageType == 'header'){
						var bodyClassString = $('body').attr('class'),
							headerFixedClass = $('#headerfixed .logo-row').attr('class');
							newBodyClass = bodyClassString.replace(/wheader_v[0-9]+/g, '') + ' wheader_v' + paramValue,
							newHeaderFixedClass = headerFixedClass.replace(/fixed_row_[0-9]+/g, '') + ' fixed_row_' + paramValue;

						$('body').attr('class', newBodyClass);
						$('#headerfixed .logo-row').attr('class', newHeaderFixedClass);

						if(typeof($('header[data-change_color]')) !== 'undefined' && $('header').data('change_color') == 'Y'){
							var headerColor = $('.banners-big.front .item.flex-active-slide').data('text_color');

							if(headerColor == 'light'){
								$('header').addClass('light');
							}
							else{
								$('header').removeClass('light');
							}

							CheckMenuLines();
						}
						CheckTopMenuDotted();

						if(!$('.mixed_banners').length){
							$('.logo_and_menu-row').css('position', 'absolute');
						}
						/*else{
							$('.logo_and_menu-row').css('position', 'static');
						}*/

						//CheckHeaderColor($('.banners-big .flexslider'), $('.banners-big .flexslider .item.shown'));
						if($('header').data('change_color') == 'Y'){
							$('.logo_and_menu-row').addClass('wbanner');
						}
						checkChangeBlockBorders();
					}

					InitFlexSlider();
					setTimeout(function(){
					//InitFlexSliderClass($('.reviews_items .flexslider')); //reinit flexslider
						$('div#' + paramName).find('.flexslider .item>.wrap').css('opacity', 1);
						$(window).resize();
					}, 200);
					$.ajax({
						url: arPriorityOptions['SITE_DIR']+"ajax/options_save_mainpage.php",
						type: 'POST',
						dataType: 'json',
						data: {},
						success: function(response){
							if(response.CAN_SAVE === true){
								addSaveButtons();
							}
						},
					});
				}, 300);
			}
		});
	});

	$('.tooltip-link').on('shown.bs.tooltip', function (e) {
		var tooltip_block = $(this).next(),
			wihdow_height = $(window).height(),
			scroll = $(this).closest('form').scrollTop(),
			pos = BX.pos($(this)[0], true),
			pos_tooltip = BX.pos(tooltip_block[0], true),
			pos_item_wrapper = BX.pos($(this).closest('.item')[0], true);

		if(!$(this).closest('.item').next().length && pos_tooltip.bottom > pos_item_wrapper.bottom)
		{
			tooltip_block.removeClass('bottom').addClass('top');
			tooltip_block.css({'top':(pos.top-tooltip_block.actual('outerHeight'))});
		}
	});
});

setTimeout(function(){
	$(window).resize(function(){
		setTimeout(function(){
			$('div.change_block').each(function(){
				var height = $(this).find('>.wrap').outerHeight();
				$(this).height(height);
			});
		}, 300);
	});
}, 4000);