$(document).ready(function(){
    $("#section_block").on("click","a", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1500);
    });
});

$(document).ready(function(){
    $("#section_block_bottom").on("click","a", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1500);
    });
});

$(function(){
    $(window).scroll(function() {
        var top = $(document).scrollTop();
        if (top > 2300) $('.floating').addClass('fixed');
        else $('.floating').removeClass('fixed');
    });
});