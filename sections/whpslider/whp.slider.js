!function ($) {

    $(document).ready(function() {
        
        $('.whp-slider-wrap').each(function(){
            
             var whpSliderAutoplay = $(this).data('autoplay')
            ,   whpSliderSpeed = $(this).data('speed') || 4000
            
            var whpSlider = $(this).find('.whp-slider').flexslider({

                animation: "fade",
                slideshow: whpSliderAutoplay,
                slideshowSpeed: whpSliderSpeed,
                animationSpeed: 500,
                touch:  true,
                directionNav: true,
                controlNav: true,
                keyboardNav: true,
                
            })

        }); 

        
        
    })

}(window.jQuery);