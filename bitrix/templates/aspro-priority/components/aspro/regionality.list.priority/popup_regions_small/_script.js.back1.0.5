$(document).ready(function(){
	$('.confirm_region .aprove').on('click', function(e){
		var _this = $(this);
		$.removeCookie('current_region');
		
		if(arPriorityOptions['SITE_ADDRESS'].indexOf(',') != '-1')
		{
			var arDomains = arPriorityOptions['SITE_ADDRESS'].split(',');
			if(arDomains)
			{
				for(var i in arDomains)
				{
					var domain_name = arDomains[i].replace("\n", "");
						domain_name = arDomains[i].replace("'", "");
					$.cookie('current_region', _this.data('id'), {path: '/',domain: domain_name});
				}
			}
		}
		else
			$.cookie('current_region', _this.data('id'), {path: '/',domain: arPriorityOptions['SITE_ADDRESS']});

		_this.closest('.confirm_region').remove();
		if(typeof _this.data('href') !== 'undefined')
			location.href = _this.data('href');
	})
	$('.js_city_change').on('click', function(){
		var _this = $(this);
		_this.closest('.region_wrapper').find('.js_city_chooser').trigger('click');
		_this.closest('.confirm_region').remove();
	})
	$('.js_city_chooser').on('click', function(){
		var _this = $(this);
		_this.closest('.region_wrapper').find('.confirm_region').remove();
	})
});