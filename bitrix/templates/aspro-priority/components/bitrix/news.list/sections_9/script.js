$(document).ready(function(){
	$('.sections.item-views .item .opener').on('click', function(){
		openerFunc($(this), $(this).closest('.item').find('.childs'));
	});
});