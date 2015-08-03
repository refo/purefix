(function($){
$(function(){


    $('.product-detail .product-images').slick({
        arrows: true,
        dots: true,

        responsive: [
            {
                breakpoint:768,
                settings: {
                    arrows: false
                }
            }
        ]

    });
    
    $('.product-detail .lifestyle-images').slick({
        arrows: true,
        dots: true,
        slidesToShow: 2,
        centerMode: true,
        
        responsive: [
            {
                breakpoint:768,
                settings: {
                    arrows: false,
                    mobileFirst: true,
                    slidesToShow: 1,
                    centerPadding: '20px'
                }
            }
        ]

    });


});    
})(jQuery);


/*
(function($){

    var 
        $el         = $('#main-header'),
        logo        = $('a.logo.full').addClass('animated'),
        height      = logo.outerHeight(),
        logoSmall   = $('a.logo.logo-small').addClass('animated'),
        placeHolder = $('<div />').css('height', $el.height()).hide().insertBefore($el);

    new Waypoint({
        element: $el[0],
        offset: 0,
        handler: function(direction){
            $el.toggleClass('stuck');
            if ($el.hasClass('stuck')){
                // Page's going up, hide the full logo
                logo.stop().animate({'margin-top': -1 * height}, 200);
                placeHolder.show();
                $el.addClass('shadow');
            } else {
                // Page's going down, put the full logo back in down
                logo.stop().animate({'margin-top': 0}, 200);
                placeHolder.hide();
                $el.removeClass('shadow');
            }
        }
    });
})(jQuery);

(function($){
    $('.slide').hide();
    $('.slide img').load(function(e){
        var me = $(this);
        me.parent().fadeIn();
        console.log($(this));
    });
})(jQuery);
*/
