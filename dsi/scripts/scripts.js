(function ($) {
  Drupal.behaviors.genScripts = {
    attach: function (context, settings) {   
        
    $('#search-glass').click(function(){
        $('.region-header').slideToggle();
    });
    
     /* =============================================================================
     *   People Listing Page Overlay
     * ========================================================================== */
    if($('.people-grid').length > 0){
        $('.people-small-content').click(function(){
            var $inlineItem = $(this).siblings('.people-card-content').children('.card-content-inner');
            $(this).colorbox({inline:true, href:$inlineItem});
        });
    }
    
    $('.jcarousel').before('<span class="jcarousel-control-prev"><img src="' + Drupal.settings.pathToTheme + '/css/images/carousel-left.png" /></span>');    
    $('.jcarousel').before('<span class="jcarousel-control-next"><img src="' + Drupal.settings.pathToTheme + '/css/images/carousel-right.png" /></span>'); 
        var jcarousel = $('.jcarousel');

        jcarousel
            .on('jcarousel:reload jcarousel:create', function () {
                var carousel = $(this),
                    width = carousel.innerWidth();

                if (width >= 1080) {
                    width = width / 4;
                } else if (width >= 600) {
                    width = width / 3;
                } else if (width >= 484) {
                    width = width / 2;
                }

                carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
            })
            .jcarousel({
                wrap: 'circular'
            });

        $('.jcarousel-control-prev')
            .jcarouselControl({
                target: '-=1'
            });

        $('.jcarousel-control-next')
            .jcarouselControl({
                target: '+=1'
            });
    } // end of attach function
  };

function get_window_width(){
  var currentWidth = window.innerWidth || document.documentElement.clientWidth;
  return currentWidth;
}

function mobileTriggers(width){
    var currentWidth = get_window_width();
    if((currentWidth <= '767') && !$('body').hasClass('mobile-processed')){
   
    }
    if((currentWidth > '767') && !$('body').hasClass('desktop-processed')){

    }
}

})(jQuery);