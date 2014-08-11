!function ($) {

    $(document).ready(function() {
        
        $('.whp-slider-wrap').each(function(){
            
             var theAnimation = $(this).data('animation')
            ,   theAutoplay = $(this).data('autoplay') || 12000
            ,   theSpeed = $(this).data('speed') || 500
            ,   theTouch = $(this).data('touch') || "off" 
            
            var whpSlider = $(this).find('.flexslider').flexslider({

                animation: "fade",
                slideshow: false,
                slideshowSpeed: 7000,
                animationSpeed: 1000,
                touch:  true,
                directionNav: true,
                prevText: "<i class\"icon icon-chevron-left\"></i>",
                nextText: "<i class\"icon icon-chevron-right\"></i>",
                controlNav: true,
                keyboardNav: true
                
            })

        });   
        
    })

}(window.jQuery);