    var stub_showing = false;
 
    function woahbar_show() { 
        if(stub_showing) {
          $('.woahbar-stub').slideUp('fast', function() {
            $('.woahbar').show('bounce', { times:3, distance:15 }, 100); 
            $('body').animate({"marginTop": "2.4em"}, 250);
          }); 
        }
        else {
          $('.woahbar').show('bounce', { times:3, distance:15 }, 100); 
          $('body').animate({"marginTop": "2.4em"}, 250);
        }
    }
 
    function woahbar_hide() { 
        $('.woahbar').slideUp('fast', function() {
          $('.woahbar-stub').show('bounce', { times:3, distance:15 }, 100);  
          stub_showing = true;
        }); 
 
        if( $(window).width() > 1024 ) {
          $('body').animate({"marginTop": "0px"}, 250); // if width greater than 1024 pull up the body
        }
    }
 
    $().ready(function() {
        window.setTimeout(function() {
        woahbar_show();
     }, 5000);
    });