$(document).ready(function(){
	$('.switch_gallery').on('click', function(){
		var $this = $(this),
			animationTime = 200;
		
		if(!$this.hasClass('small')){
			$this.addClass('small');
			$this.closest('.galerys-block').find('.title.big-gallery').fadeOut(animationTime, function(){
				$this.closest('.galerys-block').find('.title.small-gallery').fadeIn(animationTime);
			});
			
			$this.closest('.galerys-block').find('.big-gallery-block').fadeOut(animationTime, function(){
				$this.closest('.galerys-block').find('.small-gallery-block').fadeIn(animationTime);
			});
		}
		else{
			$this.removeClass('small');
			$this.closest('.galerys-block').find('.title.small-gallery').fadeOut(animationTime, function(){
				$this.closest('.galerys-block').find('.title.big-gallery').fadeIn(animationTime);
			});
			
			$this.closest('.galerys-block').find('.small-gallery-block').fadeOut(animationTime, function(){
				$this.closest('.galerys-block').find('.big-gallery-block').fadeIn(animationTime);
			});
		}
	});
	
	$('.detail .galerys-block .small-gallery-block .item').on('click', function(){
		var $this = $(this),
			index = $this.parent().index();
			
		$this.closest('.galerys-block').find('.switch_gallery').click();
		
		setTimeout(function(){
			$this.closest('.galerys-block').find('.big-gallery-block.flexslider').flexslider(index);
		}, 300);
	});	
});