/*!
 * $.fn.apiBuyoneclick
 */
(function ($) {

	"use strict"; // Hide scope, no $ conflict

	var defaults = {};
	var methods = {

		init: function (params) {

			var options = $.extend(true, {}, defaults, params);

			if (!this.data('apiBuyoneclick')) {
				this.data('apiBuyoneclick', options);

				//Код плагина

				var formId = '#aboc-modal';

				//if ($(options.container_id).find(options.input_id).val())
				//$.fn.apiBuyoneclick('showClearIcon',options);

				$(document).on('click', '.aboc-modal, .aboc-modal-close', function (e) {
					e.preventDefault();

					$(formId).find('.aboc-modal-dialog').css({
						'transform': 'translateY(-200px)',
						'-webkit-transform': 'translateY(-200px)'
					});
					$(formId).animate({opacity: 0}, 300, function () {
						$(this).hide();
						$('#aboc-modal').removeClass('aboc-open');
						$.fn.apiBuyoneclick('hideModal');
					});

				});
				$(document).on('click', '.aboc-modal-dialog', function (e) {
					//e.preventDefault();
					e.stopPropagation();
				});

				$(document).on('click', '.aboc-submit', function () {

					var submitButton = this;
					var submitFormUrl = $('.aboc-form').attr('action');

					$('.aboc-form .aboc-form-field > *').attr('readonly', true);
					$(submitButton).prop('disabled', true);

					$.ajax({
						url: submitFormUrl,
						type: 'POST',
						data: {
							arParams: options.arParams,
							arPost: $('.aboc-form').serialize()
						},
						success: function (data) {
							$(formId).html(data);
							$(submitButton).prop('disabled', false);
						}
					});

				});

				$('[data-module=buyoneclick]').each(function () {

					var button = this;
					var data = $(this).data();

					$(button).on('click', function (e) {

						$(button).attr('disabled', true);

						options.arParams.AJAX = 'Y';
						options.arParams.PRODUCT_ID = data.id;

						$.ajax({
							url: '/bitrix/components/api/buyoneclick/ajax.php',
							type: 'POST',
							data: {
								arParams: options.arParams
							},
							success: function (data) {

								//console.log(data);
								$.fn.apiBuyoneclick('showModal');

								if (!$(formId).length)
									$('body').append('<div id="aboc-modal" class="aboc-modal fade"></div>');

								$(formId).html(data).show().animate({opacity: 1}, 0);
								$(formId).addClass('aboc-open');
								$(button).attr('disabled', false);
							}
						});

						e.preventDefault();
						return false;
					});
				});

				$(document).on('click', '.aboc-modal .api-quantity .api-btn-minus, .aboc-modal .api-quantity .api-btn-plus', function (e) {
					e.preventDefault();

					var input = $(this).parent().find(':input');

					var ratio = 1;
					var curVal = parseFloat(+input.val());
					var newVal = ($(this).is('.api-btn-plus')) ? curVal + ratio : curVal - ratio;

					if (newVal <= 0 || isNaN(newVal))
						newVal = ratio;

					if ($(this).is('.api-btn-plus'))
						$(this).prev('.api-number').find('input').val(newVal).change();

					if ($(this).is('.api-btn-minus'))
						$(this).next().find('input').val(newVal).change();

				});

				$(document).on('change', '.aboc-modal .api-quantity [name=QUANTITY]', function () {
					$.fn.apiBuyoneclick('setQuantity', options);
				});

				var tmr;
				$(document).on('keyup', '.aboc-modal .api-quantity [name=QUANTITY]', function () {
					clearTimeout(tmr);
					tmr = setTimeout(function () {
						$.fn.apiBuyoneclick('setQuantity', options);
					}, 400);

				});
			}

			return this;
		},
		showModal: function () {
			$('html').addClass('aboc-modal-active');
		},
		hideModal: function () {
			$('html').removeClass('aboc-modal-active');
		},
		setQuantity: function (options) {
			$.ajax({
				url: '/bitrix/components/api/buyoneclick/ajax.php',
				type: 'POST',
				data: {
					arParams: options.arParams,
					arPost: $('.aboc-form').serialize(),
					API_BUYONECLICK_AJAX: 'Y',
					API_BUYONECLICK_ACTION: 'setQuantity',
				},
				success: function (response) {

					if (response.ERROR.length) {
						$('.aboc-form')
							 .find('.api-product .api_message')
							 .addClass('api_message_danger')
							 .html(response.ERROR)
							 .slideDown(200).delay(3000).slideUp(200);
					}

					$('.aboc-form').find('.api-product [name=QUANTITY]').val(response.DATA.QUANTITY);

					var api_price = $('.aboc-form').find('.api-product .api-price');
					var api_old_price = $('.aboc-form').find('.api-product .api-old-price');
					var api_discount = $('.aboc-form').find('.api-product .api-discount');
					var api_saving = $('.aboc-form').find('.api-product .api-saving');

					if (response.DATA.DISCOUNT_PRICE_PERCENT > 0) {
						api_price.html(response.DATA.TOTAL_PRICE_FORMATED);

						if (response.DATA.FULL_PRICE > 0)
							api_old_price.html(response.DATA.FULL_PRICE_FORMATED).show();
						else
							api_old_price.html('').hide();

						if (response.DATA.DISCOUNT_PRICE_PERCENT > 0)
							api_discount.show().find('i').html(response.DATA.DISCOUNT_PRICE_PERCENT_FORMATED);
						else
							api_discount.hide().find('i').html('');

						if (response.DATA.DISCOUNT_PRICE > 0)
							api_saving.show().find('i').html(response.DATA.DISCOUNT_PRICE_FORMATED);
						else
							api_saving.hide().find('i').html('');
					}
					else {
						api_price.html(response.DATA.TOTAL_PRICE_FORMATED);
					}

				}
			});

		}
	};

	$.fn.apiBuyoneclick = function (method) {
		if (methods[method]) {
			return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
		} else if (typeof method === 'object' || !method) {
			return methods.init.apply(this, arguments);
		} else {
			$.error('Error! Method "' + method + '" not found in plugin $.fn.apiBuyoneclick');
		}
	};

})(jQuery);