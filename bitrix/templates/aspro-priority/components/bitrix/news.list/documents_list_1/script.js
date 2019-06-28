$(document).ready(function(){
	$('.item-views.documents_list.type_1 .tab-pane').each(function(){
		$(this).find('.docs-block .blocks .inner-wrapper .title').sliceHeight();
		$(this).find('.docs-block .blocks .inner-wrapper .filesize').sliceHeight();		
	});
});