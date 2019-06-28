BX.addCustomEvent('onSlideInit', function(eventdata){
	try{
		ignoreResize.push(true);
		if(eventdata)
		{
			var slider = eventdata.slider;
			$('.wrapper_block .content_inner .slides').equalize({children: '.item-title'}); 
			$('.wrapper_block .content_inner .slides').equalize({children: '.item_info'}); 
			$('.wrapper_block .content_inner .slides').equalize({children: '.catalog_item'});
		}
	}
	catch(e){}
	finally{
		ignoreResize.pop();
	}
})