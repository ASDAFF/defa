$(document).ready(function()
{
    //catalog -> series list -> series gallery -> image change
    $('.series-item__main-photo').attr('data-src',$('.series-item__main-photo').attr('src'));
    $('.series-item__thumb-img').on('click',function()
    {
        if($(this).hasClass('series-item__thumb-img-active'))
        {
            $(this).removeClass('series-item__thumb-img-active');
            $(this).closest('.img.shine').find('.series-item__main-photo').attr('src',$(this).closest('.img.shine').find('.series-item__main-photo').attr('data-src'));
        }
        else
        {
            $(this).closest('.img.shine').find('.series-item__main-photo').attr('src',$(this).attr('src'));
            $(this).closest('.series-item__thumbs').find('.series-item__thumb-img').removeClass('series-item__thumb-img-active');
            $(this).addClass('series-item__thumb-img-active');
        }
    });

    //catalog -> series list -> color change
    $('.series-item-color-link-main').on('click',function(e)
    {
        e.preventDefault();
        $(this).closest('.series-item-color-content').find('.series-item-color-link-main').removeClass('active');
        $(this).addClass('active');
        
		
		$(this).closest('.series-item-info').find('.series-item-kit').addClass('hidden');
        $(this).closest('.series-item-info').find('.series-item-kit[data-color-xml-id="'+$(this).attr('data-color-xml-id')+'"]').removeClass('hidden');
		var count = $(this).closest('.series-item-info').find('.series-item-kit[data-color-xml-id="'+$(this).attr('data-color-xml-id')+'"]').length;
		console.log($(this).attr('data-color-xml-id') + ":" + count);
		if (count > 0){
			$(this).closest('.series-item-info').find('.popular-content-missing-kit').addClass('hidden');
		}else{
			$(this).closest('.series-item-info').find('.popular-content-missing-kit').removeClass('hidden');
		}
		
		
		$(this).closest('.series-item-info').find('.series-item-product').addClass('hidden');
        $(this).closest('.series-item-info').find('.series-item-product[data-color-xml-id="'+$(this).attr('data-color-xml-id')+'"]').removeClass('hidden');
		var count = $(this).closest('.series-item-info').find('.series-item-product[data-color-xml-id="'+$(this).attr('data-color-xml-id')+'"]').length;
		console.log($(this).attr('data-color-xml-id') + ":" + count);
		if (count > 0){
			$(this).closest('.series-item-info').find('.popular-content-missing-product').addClass('hidden');
		}else{
			$(this).closest('.series-item-info').find('.popular-content-missing-product').removeClass('hidden');
		}
		
    });

	//catalog -> series list -> add color change
    $('.series-item-color-link-add').on('click',function(e)
    {
        e.preventDefault();
        $(this).closest('.series-item-color-content').find('.series-item-color-link-add').removeClass('active');
        $(this).addClass('active');
        
		
		$(this).closest('.series-item-info').find('.series-item-kit').addClass('hidden');
        $(this).closest('.series-item-info').find('.series-item-kit[data-karkas-xml-id="'+$(this).attr('data-karkas-xml-id')+'"]').removeClass('hidden');
		$(this).closest('.series-item-info').find('.series-item-kit[data-dveri-xml-id="'+$(this).attr('data-dveri-xml-id')+'"]').removeClass('hidden');
		var count_karkas = $(this).closest('.series-item-info').find('.series-item-kit[data-karkas-xml-id="'+$(this).attr('data-color-xml-id')+'"]').length;
		var count_dveri = $(this).closest('.series-item-info').find('.series-item-kit[data-dveri-xml-id="'+$(this).attr('data-color-xml-id')+'"]').length;
		var count = count_karkas + count_dveri;
		console.log($(this).attr('data-color-xml-id') + " karkas:" + count_karkas);
		console.log($(this).attr('data-color-xml-id') + " dveri:" + count_dveri);
		if (count > 0){
			$(this).closest('.series-item-info').find('.popular-content-missing-kit').addClass('hidden');
		}else{
			$(this).closest('.series-item-info').find('.popular-content-missing-kit').removeClass('hidden');
		}
		
		
		$(this).closest('.series-item-info').find('.series-item-product').addClass('hidden');
        $(this).closest('.series-item-info').find('.series-item-product[data-karkas-xml-id="'+$(this).attr('data-color-xml-id')+'"]').removeClass('hidden');
		$(this).closest('.series-item-info').find('.series-item-product[data-dveri-xml-id="'+$(this).attr('data-color-xml-id')+'"]').removeClass('hidden');
		
		var count_karkas = $(this).closest('.series-item-info').find('.series-item-product[data-karkas-xml-id="'+$(this).attr('data-color-xml-id')+'"]').length;
		var count_dveri = $(this).closest('.series-item-info').find('.series-item-product[data-dveri-xml-id="'+$(this).attr('data-color-xml-id')+'"]').length;
		var count = count_karkas + count_dveri;
		console.log($(this).attr('data-color-xml-id') + " karkas2:" + count_karkas);
		console.log($(this).attr('data-color-xml-id') + " dveri2:" + count_dveri);
		
		//console.log($(this).attr('data-color-xml-id') + ":" + count);
		if (count > 0){
			$(this).closest('.series-item-info').find('.popular-content-missing-product').addClass('hidden');
		}else{
			$(this).closest('.series-item-info').find('.popular-content-missing-product').removeClass('hidden');
		}
		
    });
});
