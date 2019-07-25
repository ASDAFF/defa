function viewdiv(id) {
    var el = document.getElementById(id);
    var link = document.getElementById('toggleLink_<?=$group;?>');
    if (el.style.display == "none") {
        el.style.display = "flex";
        link.innerText = link.getAttribute('data-text-hide');
    } else {
        el.style.display = "none";
        link.innerText = link.getAttribute('data-text-show');
    }
}

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