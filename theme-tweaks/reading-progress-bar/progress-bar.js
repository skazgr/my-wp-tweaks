(function($){
    $(window).on('scroll', function(){
        var docHeight = $(document).height() - $(window).height();
        var scrollTop = $(window).scrollTop();
        var percent = (docHeight > 0) ? (scrollTop / docHeight) * 100 : 0;
        $('#reading-progress-bar').css('width', percent + '%');
    });
})(jQuery);