!function ($) {

	$(document).ready(function() {

	$('.whp-slider-wrap').each(function(){

		var theAutoplay = $(this).data('autoplay')
		,	theSpeed = $(this).data('speed') || 4000

		var whpSlider = $(this).find('.whp-slider').evoSlider({
			
	        mode: "slider",
	        width: 1100,
	        height: 450,
	        slideSpace: 0,
	        paddingRight: 0,
	        mouse: false,
	        keyboard: true,
	        speed: 500,
	        loop: true,
	        lazyLoad: true,
	        autoplay: theAutoplay,
	        interval: theSpeed,
	        pauseOnHover: true,
	        showPlayButton: false,
	        directionNav: true,
	        directionNavAutoHide: true,
	        showDirectionText: false,
	        controlNav: false,
	        autoHideText: false, 
	        outerText: false,
	        imageScale: "none",
	    })
		
		$(this).find('.arrow_prev').html('<i class="icon icon-angle-left"></i>')
		$(this).find('.arrow_next').html('<i class="icon icon-angle-right"></i>')

		/* Overwritten Styles */
		$(this).find('.whp-slider, .whp-slider dl').css('width', '100%')
		$(this).find('.whp-slider dd').css({"width": "100%"});
		$(this).find('.whp-slider .evoImage').css('width', '70%')

		});  
		
		
	})
	

}(window.jQuery);