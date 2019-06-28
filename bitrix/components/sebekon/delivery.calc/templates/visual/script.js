
	var sebekon_deliverycalc_params = {};	
	
	var sebekon_deliveryprice_order_click = function(event) {	
		
		if (event.preventDefault)
			event.preventDefault();
		
		if (event.returnValue)
			event.returnValue = false;
		
		if (event.stopPropagation)
			event.stopPropagation();
			
		if (event.cancelBubble)
			event.cancelBubble = true;
			
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER').modal('show');
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER .modal-body').css('width','605');
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER .modal-body').css('opacity','1');
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER').css('opacity','1');
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER .modal-body').load('/bitrix/components/sebekon/delivery.calc/order.php');
		return false;
	}
	
	var submitParentForm = function() {
		$sebekon_jq_delivery.post('/bitrix/components/sebekon/delivery.calc/order.php',sebekon_deliverycalc_params, function(){
				sebekon_delivery_refresh_options();
				if (window.submitForm) {
					submitForm();
				} else {
					$sebekon_jq_delivery('a.sebekon_delivery_price_link').eq(0).parents('form').submit();
				}
				$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER').modal('hide');
			}
		);
	}