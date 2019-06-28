$(document).ready(function(){
	$(document).on('click', '.mega-menu table td.full_dropdown .dropdown-menu li.more_items>span', function(){
		var _this = $(this),
			openText = _this.data('open_text'),
			closeText = _this.data('close_text');
			
		_this.toggleClass('opened');
		
		if(_this.hasClass('opened')){
			_this.text(closeText);

		}
		else{
			_this.text(openText);
		}

		_this.closest('ul').find('li.collapsed').slideToggle(200, function(){
			if(_this.hasClass('opened')){
				//_this.closest('ul').find('li').css('display', 'inline');
				_this.closest('ul').find('li .separator').css('opacity', 1);
			}
			else{
				_this.closest('ul').find('li:not(.more_items):visible').last().find('.separator').css('opacity', 0);
			}			
		});
	});
});