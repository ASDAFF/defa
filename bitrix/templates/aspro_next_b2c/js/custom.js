/*
You can use this file with your scripts.
It will not be overwritten when you upgrade solution.
*/



/*ШИРИНА ВЫПАДАЮЩЕГО МЕНЮ ДЛЯ СЕРИЙ*/
$(document).ready(function () {
    var dropdownMenu = $('.dropdown-menu.last-dropdown-level');
    var dropdownMenuRow = dropdownMenu.children('.row');

    dropdownMenu.each(function () {
        var countMenusRow = $(this).children('.row').size();
        dropdownMenuRow.each(function () {
            var countRowsItem = $(this).children('.menu-item').size();
            if (countRowsItem === 4) {
                $(this).addClass('four-elem');
            }
            else if (countRowsItem === 3) {
                $(this).addClass('three-elem');
            }
            else if (countRowsItem === 2) {
                $(this).addClass('two-elem');
            }
            else if (countRowsItem === 1) {
                $(this).addClass('one-elem');
            }
        });
    });


    $(".best-block .top_wrapper .catalog_block, .hit-block .top_wrapper .catalog_block, .recommend-block .top_wrapper .catalog_block, .catalog-sections-block .top_wrapper .catalog_block, .podborki-block .top_wrapper .catalog_block").slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        responsive: [
            {
                breakpoint: 1350,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 992,
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
                    centerMode: true,
                    initialSlide: 0,
                    centerPadding: '40px',
                    arrows: false
                }
            }
        ]

    });
    $(".catalog_detail .mobile-features").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
        responsive: [
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
                    centerMode: true,
                    initialSlide: 0,
                    centerPadding: '40px',
                    arrows: false
                }
            }
        ]

    })



});


//скрипт, показывающий боковое плавающее меню справа

// $(function() {
//     $(window).scroll(function() {
//         if ($(this).scrollTop() > 150) {
//             $('#tizerzFloat').fadeIn();
//         } else {
//             $('#tizerzFloat').fadeOut();
//         }
//     });
// });


//карта из плавающих тизеров

// $(document).ready(function () {
//     if ($('#callMap').length || $(".map-fly").length || $(".button-close").length) {
//         var btn = document.querySelector("#callMap");
//         var map = document.querySelector(".map-fly");
//         var close = document.querySelector(".button-close");
//         // var gift = document.querySelector(".gift-activate");
//         // var giftBanner = document.querySelector(".gift-banner");
//         // var giftCloseAlternate = document.querySelector(".gift-banner__link--no");
//         // var giftCloseYes = document.querySelector(".gift-banner__link--yes");
//
//         btn.addEventListener("click", function (evt) {
//             evt.preventDefault();
//             map.classList.add("show");
//         });
//
//         close.addEventListener("click", function (evt) {
//             evt.preventDefault();
//             map.classList.remove("show");
//         });
//
//         window.addEventListener("keydown", function (evt) {
//             if (evt.keyCode === 27) {
//                 if (map.classList.contains("show")) {
//                     evt.preventDefault();
//                     map.classList.remove("show");
//                 }
//             }
//         });
//
//         $(document).mouseup(function (e){
//             var div = $(".map-fly");
//             if (!div.is(e.target)
//                 && div.has(e.target).length === 0) {
//                 map.classList.remove("show");
//             }
//         });
//     };
//
//
// //подарок
//
//     // gift.addEventListener("click", function (evt) {
//     //     evt.preventDefault();
//     //     giftBanner.classList.add("show");
//     // });
//
//     // giftCloseAlternate.addEventListener("click", function (evt) {
//     //     evt.preventDefault();
//     //     giftBanner.classList.remove("show");
//     // });
//     //
//     // giftCloseYes.addEventListener("click", function (evt) {
//     //     evt.preventDefault();
//     //     giftBanner.classList.remove("show");
//     // });
//     //
//     // window.addEventListener("keydown", function (evt) {
//     //     if (evt.keyCode === 27) {
//     //         if (giftBanner.classList.contains("show")) {
//     //             evt.preventDefault();
//     //             giftBanner.classList.remove("show");
//     //         }
//     //     }
//     // });
//     //
//     // $(document).mouseup(function (e){
//     //     var div = $(".gift-banner");
//     //     if (!div.is(e.target)
//     //         && div.has(e.target).length === 0) {
//     //         giftBanner.classList.remove("show");
//     //     }
//     // });
//
//
//
// //открытие бокового меню по клику
//
//     // $(window).resize(function() {
//     //     if ( $(window).width() <= 1366 ) {
//     //
//     //         var callMenu = document.querySelector("#callMenu");
//     //         var hideMenu = document.querySelector("#hideMenu");
//     //
//     //             callMenu.addEventListener("click", function (evt) {
//     //                 evt.preventDefault();
//     //                 if (!callMenu.classList.contains("special-move-translate") || !hideMenu.classList.contains("special-move-right")) {
//     //                     callMenu.classList.add("special-move-translate");
//     //                     hideMenu.classList.add("special-move-right");
//     //                 } else {
//     //                     callMenu.classList.remove("special-move-translate");
//     //                     hideMenu.classList.remove("special-move-right");
//     //                 }
//     //
//     //             });
//     //
//     //     }
//     // });
//
//
// });

window.addEventListener("load", function () {
    //открытие бокового меню по клику

    if ($('#callMenu').length || $("#hideMenu").length) {
        if ( $(window).width() <= 1366 ) {

            var callMenu = document.querySelector("#callMenu");
            var hideMenu = document.querySelector("#hideMenu");

            callMenu.addEventListener("click", function (evt) {
                evt.preventDefault();
                if (!callMenu.classList.contains("special-move-translate") || !hideMenu.classList.contains("special-move-right")) {
                    callMenu.classList.add("special-move-translate");
                    hideMenu.classList.add("special-move-right");
                } else {
                    callMenu.classList.remove("special-move-translate");
                    hideMenu.classList.remove("special-move-right");
                }

            });

        }
    }



});

//скрипт, показывающий скрытый контент тизеров в заголовке страницы

/*$(function () {
    $('.catalog_page .top-page-tizers .col-md-3').hover(function () {
        $('.catalog_page .top-page-tizers .col-md-3 .hidden-content').fadeToggle();
    });
});*/





//Перемещение цветов на мобилке
$(function() {
    $(window).on('load resize', function() {
        var $windowWidth = $(window).width();
        var $colorsBlock = $('.catalog_detail .info_item .buy_block');
        var $beforeBlock = $('.catalog_detail .info_item .prices_block');


        if ($windowWidth <= 991) {
            $beforeBlock.before($colorsBlock);
        }
        else {
            $beforeBlock.after($colorsBlock);
        }
    });
});



/*КЛИК НА ЗАНК ВОПРОС В ЦЕНЕ*/
/*
$(document).ready(function () {
    $('.catalog_detail .middle_info .left-info .prices_block .offers_price_wrapper .offers_price, .catalog_detail .cost.prices .price').fancybox({
        selector : '.price-modal',
    });
});
*/

/*раскрытие всех характеристик на мобилке*/
$(document).ready(function () {
   $('.catalog_detail .mobile-props .view_all_char').click(function () {
       $('.catalog_detail .mobile-props .inner_props').slideToggle();
   })
});



/*СЛАЙДЕР НОВОСТЕЙ НА ГЛАВНОЙ*/
$(document).ready(function () {
    $('.front_page .news-block .items').slick({
        arrows: false,
        dots: false,
        infinite: true,
        slidesToScroll: 1,
        slidesToShow: 1,
        centerMode: true,
        centerPadding: '40px',
        mobileFirst: true,
        responsive: [
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                    centerMode: false

                }

            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    centerMode: false

                }

            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    centerMode: false

                }

            },
            {
                breakpoint: 1400,
                settings: 'unslick'
            }]

    });

});


//страница серий. вывод товаров в 4 строчки в случае отсутствия комплектов

window.addEventListener("load", function() {
    $('.extra-inform').each(function (key, element) {
        var testSets = $(element).find(".popular-content").is(".popular-content-sets");
        if (testSets === false) {
            $(element).find(".popular-content-items").css({"height": "335px"});
        }
    });
})

// страница серий. открыть панель со всеми цветами
$(document).ready(function() {
    $('.series-item').each(function(key, element) {


        $(element).find('.more-color').on('click', function(evt) {
            evt.preventDefault();

            var t = $(element).find('.series-item-color__modal');

            var q = $(t).hasClass('show');

            if (q === false) {
                t.addClass('show');
            }

        });

        $(document).mouseup(function(e) {
            var w = $(element).find('.series-item-color__modal');
            if (!w.is(e.target) &&
                w.has(e.target).length === 0) {
                w.removeClass('show');
            }
        });

        // табы "описание" и "готовые наборы"
        $(element).find('.series-content-toggle').on('click', function(evt) {
               evt.preventDefault();
               var id = $(this).attr('data-tab'),
                   content = $(element).find('.series-main[data-tab="'+ id +'"]');
                $(element).find('.series-content-toggle.current').removeClass('current');
                $(this).addClass('current');

                $(element).find('.series-main.current').removeClass('current');
                content.addClass('current');
        });


        $(element).find(".series-main-fancy").fancybox({
            showNavArrows: true,
            infobar: false,
            thumbs: false
        });

        // $('.series-item .news-project-company-page .project-item').each(function () {
        //     var itemCatSeries = $(this).attr("data-filter");
        //     $(this).parent().parent('.slick-slide').addClass(itemCatSeries);
        // });
        //
        //
        // $(element).find(".completed_projects .head-block .item-link").on("click", function (evt) {
        //     evt.preventDefault();
        //     var cat = $(this).find('span.btn-inline').attr("data-filter");
        //
        //     $(this).find(".news-project-company-page .items").slick('slickUnfilter');
        //
        //     if (cat == ".s-1029") {
        //         $(this).find('.news-project-company-page .items').slick('slickFilter', '.s-1029');
        //     }
        //     else if (cat == ".s-27") {
        //         $(this).find('.news-project-company-page .items').slick('slickFilter', '.s-27');
        //     }
        //     else if (cat == ".s-1030") {
        //         $(this).find('.news-project-company-page .items').slick('slickFilter', '.s-1030');
        //     }
        //     else if (cat == ".s-1031") {
        //         $(this).find('.news-project-company-page .items').slick('slickFilter', '.s-1031');
        //     }
        //     else if (cat == ".s-1032") {
        //         $(this).find('.news-project-company-page .items').slick('slickFilter', '.s-1032');
        //     }
        //     else if (cat == ".s-1033") {
        //         $(this).find('.news-project-company-page .items').slick('slickFilter', '.s-1033');
        //     }
        //     else if (cat == ".s-1034") {
        //         $(this).find('.news-project-company-page .items').slick('slickFilter', '.s-1034');
        //     }
        //     else if(cat == 'all'){
        //         $(this).find('.news-project-company-page .items').slick('slickUnfilter');
        //     }
        // });

    })
});

//слайдер на странице серий
    $(document).ready(function() {
        if ($(".sections_wrapper.series").length > 0){

            $('.series-desc-block .slider-for').each(function(key, item) {

                var sliderIdNameDesc = 'sliderDesc' + key;
                var sliderNavIdNameDesc = 'sliderDescNav' + key;

                this.id = sliderIdNameDesc;
                $('.series-desc-block .slider-nav')[key].id = sliderNavIdNameDesc;

                var sliderIdDesc = '#' + sliderIdNameDesc;
                var sliderNavIdDesc = '#' + sliderNavIdNameDesc;

                $(sliderIdDesc).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    fade: true,
                    adaptiveHeight: true,
                    asNavFor: sliderNavIdDesc
                });

                $(sliderNavIdDesc).slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: sliderIdDesc,
                    dots: false,
                    arrows: false,
                    centerMode: false,
                    infinite: true,
                    focusOnSelect: true,
                    adaptiveHeight: true,
                    responsive: [
                        {
                            breakpoint: 1367,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 4
                            }
                        }
                    ]
                });

            });

            $('.series-main.sets-block .slider-for').each(function(key, item) {

                var sliderIdNameSets = 'sliderSets' + key;
                var sliderNavIdNameSets = 'sliderSetsNav' + key;

                this.id = sliderIdNameSets;
                $('.series-main.sets-block .slider-nav')[key].id = sliderNavIdNameSets;

                var sliderIdSets = '#' + sliderIdNameSets;
                var sliderNavIdSets = '#' + sliderNavIdNameSets;

                $(sliderIdSets).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: true,
                    fade: true,
                    adaptiveHeight: true,
                    asNavFor: sliderNavIdSets
                });

                $(sliderNavIdSets).slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: sliderIdSets,
                    dots: false,
                    arrows: false,
                    centerMode: false,
                    infinite: true,
                    focusOnSelect: true,
                    adaptiveHeight: true,
                    responsive: [
                        {
                            breakpoint: 1367,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 4
                            }
                        }
                    ]
                });

            });

        }

    //    выбор отображения списка серий
        $(".view-item").click(function(evt) {
            evt.preventDefault();
            $('.view-item').removeClass('active');
            $(this).addClass('active');
            $('.series_content').removeClass('active');
            $('.'+$(this).attr('data-id')).addClass('active');
        })

    //    слайдер похожие серии
                $(".similar-series-slider.slick-slider").slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    arrows: true,
                    infinite: true,
                    centerMode: true,
                    autoplay: true,
                    autoplaySpeed: 2500,
                    responsive: [
                        {
                            breakpoint: 1367,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });

    });

//табы на странице одной серии
$(document).ready(function() {
    // if ($(".series-block.inner").length > 0){
            $('.inform-item').click(function(evt) {
                evt.preventDefault();
                var id = $(this).attr('data-tab'),
                    content = $('.inform-content[data-tab="'+ id +'"]');

                $('.inform-item.active').removeClass('active');
                $(this).addClass('active');

                $('.inform-content.active').removeClass('active');
                content.addClass('active');
            });
    // }

    
//панель якорей ТОЛЬКО для страницы одной серии

    if($('.series-item').hasClass('inner')){
        $('.panel-anchors').addClass('show');
    };


//арендодателям, переключение склад-салон
    if ($(".tenants").length > 0) {
        $(".space-tab").click(function (evt) {
            evt.preventDefault();
            $('.space-tab').removeClass('active');
            $(this).addClass('active');
            $('.content-item').removeClass('active');
            $('.' + $(this).attr('data-id')).addClass('active');
        })
    }
});



//слайдер на странице серии
$(document).ready(function() {
    if ($(".series-block.inner").length > 0){

    $(".series-item-main-fancy").fancybox({
        showNavArrows: true,
        infobar: false,
        thumbs: false
    });



        $('.series-item-main-slide.slick-slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                // arrows: true,
                fade: true,
                asNavFor: $('.series-item-preview-slide.slick-nav')
        });

        $('.series-item-preview-slide.slick-nav').slick({
            slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: $('.series-item-main-slide.slick-slider'),
                dots: false,
                arrows: false,
                centerMode: false,
                infinite: true,
                focusOnSelect: true
        });
    }


});


$(document).ready(function() {
    if ($(".guaranty-conditions").length > 0){
        $('.text-show-more').each(function(key, element) {
            $(element).find('.details-more').on('click', function (evt) {
                evt.preventDefault();
                if($(element).find('.text-show-block').hasClass('more')){
                    $(element).find('.text-show-block').removeClass('more');
                    $(element).find('.details-more').html("Развернуть полностью");
                } else {
                    $(element).find('.text-show-block').addClass('more');
                    $(element).find('.details-more').html("Свернуть");
                }
            })
        })
    }

    //страница серии, переход к вкладке "все цвета"

    if ($("#moreInformSeries").length > 0){
        $("#showMeMoreColors").on("click", function (evt) {
            evt.preventDefault();
            var el = $(this);
            var dest = el.attr('href');
            if(dest !== undefined && dest !== '') {
                $('html').animate({
                    scrollTop: $(dest).offset().top
                    }, 500
                );
            }

            $('.inform-item.active').removeClass('active');

            $('.inform-content.active').removeClass('active');

            $(".inform-item.colors_solution:not(.active)").addClass("active");
            $(".inform-content.colors:not(.active)").addClass("active");
            // $(".inform-item.colors_solution:not(.active)").addClass("active");
        })
    }

    $(".show_more").on("click", function(evt){
        $(".description-details_gradient").toggleClass("height_auto");
        $(".gradient-more").toggleClass("hide");
        $(".show_more").toggleClass("transform");
    });
});



/*СЛАЙДЕР ПРОЕКТОВ НА СТРАНИЦЕ КОМПАНИИ C ФИЛЬТРОМ*/
$(document).ready(function () {
    $('.news-project-company-page .items').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: false,
        infinite:false,
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.news-project-company-page .project-item').each(function () {
        var itemCat = $(this).attr("data-filter");
        $(this).parent().parent('.slick-slide').addClass(itemCat);
    });


    $(".completed_projects .head-block .item-link").click(function (evt) {
        evt.preventDefault();
        var cat = $(this).find('span.btn-inline').attr("data-filter");

        $(".news-project-company-page .items").slick('slickUnfilter');

        if (cat == ".s-1029") {
            $('.news-project-company-page .items').slick('slickFilter', '.s-1029');
        }
        else if (cat == ".s-27") {
            $('.news-project-company-page .items').slick('slickFilter', '.s-27');
        }
        else if (cat == ".s-1030") {
            $('.news-project-company-page .items').slick('slickFilter', '.s-1030');
        }
        else if (cat == ".s-1031") {
            $('.news-project-company-page .items').slick('slickFilter', '.s-1031');
        }
        else if (cat == ".s-1032") {
            $('.news-project-company-page .items').slick('slickFilter', '.s-1032');
        }
        else if (cat == ".s-1033") {
            $('.news-project-company-page .items').slick('slickFilter', '.s-1033');
        }
        else if (cat == ".s-1034") {
            $('.news-project-company-page .items').slick('slickFilter', '.s-1034');
        }
        else if(cat == 'all'){
            $('.news-project-company-page .items').slick('slickUnfilter');
        }
    });
});




/*ФИКСАЦИЯ ЛЕВОГО БЛОКА*/

$(document).ready(function () {
    if ($('.left_block').length){
        var $sidebar = $('.left_block .fixed-left-block');
        /*var $sidebarHeight = $sidebar.outerHeight();*/
        var $sidebarTop = $sidebar.offset().top;
        var $footer = $('#footer');
        var $footerTop = $footer.offset().top;
        $(window).scroll(function () {
            var $scrollTop = $(window).scrollTop();
            var $sidebarHeight = $sidebar.outerHeight();
            if ($scrollTop > ($sidebarTop - 100) ) {
                $sidebar.css({'position' : 'fixed', 'top' : '100px'});
                if ($scrollTop + $sidebarHeight > $footerTop) {
                    $sidebar.css("top", $footerTop - $scrollTop - $sidebarHeight);
                }
            }
            else {
                $sidebar.css({'position' : 'static', 'top' : '0'});
            }
        });
    };
});

/*ТАБЫ (ДОСТАВКА, ВЫВОЗ МУСОРА, СБОРКА)*/
$(document).ready(function () {
    $('.catalog_detail .info_item .tabs-block .tabs-item a').click(function () {
        $(this).addClass('active').siblings().removeClass('active');
        $('.tabs-content .item').removeClass('active').eq($(this).index()).addClass('active');
    });
});


