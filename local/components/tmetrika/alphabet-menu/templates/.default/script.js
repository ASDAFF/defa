$(function () {

    $(".element_hover, .seria_hover").hover(function () {
        $(this).addClass("active");
    }, function () {
        $(this).removeClass("active");
    });


    console.log("script");
});
