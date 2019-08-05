$(document).ready(function(){
	$('.catalog_block .catalog_item_wrapp .catalog_item .item_info:visible .item-title').sliceHeight({item:'.catalog_item', mobile: true});
	$('.catalog_block .catalog_item_wrapp .catalog_item .item_info:visible').sliceHeight({item:'.catalog_item', mobile: true});
	$('.catalog_block .catalog_item_wrapp .catalog_item:visible').sliceHeight({classNull: '.footer_button', item:'.catalog_item', mobile: true});


	$(document).on('click','.quick-sort',function () {
		$('.quick-sort').removeClass('cur');
		$(this).addClass('cur');
		$('.qwerty').hide();
		$('.'+$(this).attr('data-group')).show();
	})



});