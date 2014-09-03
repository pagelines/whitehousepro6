!function ($) {

    $(document).ready(function() {
        
        $('.whp-slider-wrap').each(function(){
            
             var whpSliderAutoplay = $(this).data('autoplay')
            ,   whpSliderSpeed = $(this).data('speed') || 4000
            ,   whpSliderAnimation = $(this).data('animation')
            ,   whpSliderDirectionNav = $(this).data('direction_nav')
            
            var whpSlider = $(this).find('.whp-slider').flexslider({

                animation: whpSliderAnimation,
                slideshow: whpSliderAutoplay,
                slideshowSpeed: whpSliderSpeed,
                animationSpeed: 500,
                touch:  true,
                directionNav: whpSliderDirectionNav,
                controlNav: true,
                keyboardNav: true,
                
            })

        }); 

        
        
    })

}(window.jQuery);