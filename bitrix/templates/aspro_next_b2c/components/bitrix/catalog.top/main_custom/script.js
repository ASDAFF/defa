$(document).ready(function () {
    $(".catalog-detail-slider-recommend").slick({
        slidesToShow: 4,
        arrows: true,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                    centerMode: true,
                    centerPadding: '15px'
                }
            }
        ]
    });




    $(".catalog-detail-slider-assoc, .catalog-detail-slider-sect, .catalog-detail-slider-series, .catalog-detail-slider-interesting").slick({
        slidesToShow: 4,
        arrows: true,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                    centerMode: true,
                    centerPadding: '15px'
                }
            }
        ]
    });



    $(".catalog-detail-slider-modif").slick({
        slidesToShow: 3,
        arrows: true,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 3,
                    arrows: false,
                    centerMode: true
                }
            },
            {
                breakpoint: 460,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                    centerMode: true
                }
            }
        ]
    });

    $(".catalog-detail-slider-assoc, .catalog-detail-slider-interesting, .catalog-detail-slider-modif-without-gif, .catalog-detail-slider-modif-with-gif").css("opacity","1");

});