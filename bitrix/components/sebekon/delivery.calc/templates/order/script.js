
	var sebekon_deliverycalc_params = {};	
	
	var sebekon_deliveryprice_order_click = function(event, obLink) {	
		
		if (event.preventDefault)
			event.preventDefault();
		
		if (event.returnValue)
			event.returnValue = false;
		
		if (event.stopPropagation)
			event.stopPropagation();
			
		if (event.cancelBubble)
			event.cancelBubble = true;
			
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER').css('position', 'fixed');
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER').css('top', 70);
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER').css('padding-right', 0);
		var paddingBeforeShow = $sebekon_jq_delivery('body').css('paddingRight');
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER').modal('show');
		$sebekon_jq_delivery('body').removeClass('modal-open');
		$sebekon_jq_delivery('body').css('paddingRight', paddingBeforeShow);
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER').css('padding-right', 0);
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER').on('hidden', function () {
			$sebekon_jq_delivery('.sebekon-help_block').remove();
		});
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER .sebekon-modal-body').css('width','634');
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER .sebekon-modal-body').css('opacity','1');
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER').css('opacity','1');
        
        var link = '/bitrix/components/sebekon/delivery.calc/order.php';
        
        if (obLink && $sebekon_jq_delivery(obLink).attr('data-delivery-id')=='%DELIVERY_ID%') $sebekon_jq_delivery(obLink).attr('data-delivery-id','');
        if (obLink && $sebekon_jq_delivery(obLink).attr('data-profile-id')=='%PROFILE_ID%') $sebekon_jq_delivery(obLink).attr('data-profile-id','');
        if (obLink && $sebekon_jq_delivery(obLink).attr('data-map-id')=='%MAP_ID%') $sebekon_jq_delivery(obLink).attr('data-map-id','');
        
        if (obLink && ($sebekon_jq_delivery(obLink).attr('data-delivery-id') || $sebekon_jq_delivery(obLink).attr('data-profile-id') || $sebekon_jq_delivery(obLink).attr('data-map-id'))) {
            link += '?';
            var hasParam = false;
            if ($sebekon_jq_delivery(obLink).attr('data-delivery-id')) {
                link += "DELIVERY_ID="+$sebekon_jq_delivery(obLink).attr('data-delivery-id');
                hasParam = true;
            }
            if ($sebekon_jq_delivery(obLink).attr('data-profile-id')) {
                if (hasParam) link += '&';
                hasParam = true;
                link += "PROFILE_ID="+$sebekon_jq_delivery(obLink).attr('data-profile-id');
            }
            if ($sebekon_jq_delivery(obLink).attr('data-map-id')) {
                if (hasParam) link += '&';
                hasParam = true;
                link += "ORDER_MAP_ID="+$sebekon_jq_delivery(obLink).attr('data-map-id');
            }
        }
        
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER .sebekon-modal-body').load(link);
		var top = $sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER').offset().top;
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER').css('position', 'absolute');
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER').css('top', top);
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER').css('padding-right', 0);
		$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER .modal-backdrop').remove();
		return false;
	}
	
	var submitParentForm = function() {
		$sebekon_jq_delivery.ajax({
			url: "/bitrix/components/sebekon/delivery.calc/order.php",
			data: sebekon_deliverycalc_params,
			success:  function(data){
				sebekon_delivery_refresh_options();
				$sebekon_jq_delivery('.sebekon-help_block').remove();
				if (window.submitForm) {
					submitForm();
				} else {
					if (window.BX && window.BX.Sale.OrderAjaxComponent) {
						var deliveryId = false;
                        if ($sebekon_jq_delivery('.sebekon_delivery_price_link').attr('data-delivery-id')) {
                            deliveryId = $sebekon_jq_delivery('.sebekon_delivery_price_link').attr('data-delivery-id');
                        }
						if (deliveryId && $sebekon_jq_delivery('input[name=DELIVERY_ID][value='+deliveryId+']').parents('.bx-soa-pp-company').size()>0) {
							if (!BX.Sale.OrderAjaxComponent.selectDelivery({'target': new BX($sebekon_jq_delivery('input[name=DELIVERY_ID][value='+deliveryId+']').parents('.bx-soa-pp-company')[0])})) {
								if (window.BX && window.BX.saleOrderAjax) {
									window.BX.saleOrderAjax.submitFormProxy();
								} else {
									BX.Sale.OrderAjaxComponent.sendRequest();
								}
							}
						} else {
							if (window.BX && window.BX.saleOrderAjax) {
								window.BX.saleOrderAjax.submitFormProxy();
							} else {
								BX.Sale.OrderAjaxComponent.sendRequest();
							}
						}
					} else {
						if (window.BX && window.BX.saleOrderAjax) {
							window.BX.saleOrderAjax.submitFormProxy();
						} else {
							$sebekon_jq_delivery('a.sebekon_delivery_price_link').eq(0).parents('form').submit();
						}
					}
				}
				$sebekon_jq_delivery('#SEBEKON_DELIVERYPRICE_ORDER').modal('hide');
			},
			dataType: 'json'
		});
	}