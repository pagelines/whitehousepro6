!function ($) {

    $(document).ready(function() {
        
        $('.whp-quotes-wrap').each(function(){
            
             var quotesSlideshow = $(this).data('autoplay')
            ,   quotesSpeed = $(this).data('speed') || 4000
            
            var whpQuotes = $(this).find('.whp-quotes').flexslider({

                animation: "fade",
                slideshow: quotesSlideshow,
                slideshowSpeed: quotesSpeed,
                animationSpeed: 500,
                touch:  true,
                directionNav: false,
                controlNav: "thumbnails",
                keyboardNav: true,
                /*start: function(slider){
                    //switch slides on thumbnail hover
                    $('.flex-control-thumbs > li').hover( function() {
                        slider.flexAnimate( $(this).index(), true );
                        return false;
                    }); 
                }*/
                
            })

        });
        
    })

}(window.jQuery);