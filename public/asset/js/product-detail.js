(function($){
$(function(){

    var
    variants   = $('.product-options :input[name=size]'),
    n11Urls    = $('.product-buy .n11-buy'),
    radioValue = null,
    activeUrl  = null,
    i;

    n11Urls.attr('target', '_blank');

    var radioChanged = function() {
        radioValue = variants.filter(':checked').val();
        $(activeUrl).addClass('hidden');
        activeUrl = n11Urls.filter('#url-'+radioValue).removeClass('hidden');
    };

    variants.change(radioChanged);

});
})(jQuery);
