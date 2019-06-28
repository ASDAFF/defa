$(document).ready(function () {
   $(".brands-mobile-block").slick({
       slidesToShow: 7,
       autoplay: true,
       autoplaySpeed: 4000,
       responsive: [
           {
               breakpoint: 1210,
               settings: {
                   slidesToShow: 6
               }
           },
           {
               breakpoint: 992,
               settings: {
                   slidesToShow: 5
               }
           },
           {
               breakpoint: 768,
               settings: {
                   slidesToShow: 4
               }
           },
           {
               breakpoint: 576,
               settings: {
                   slidesToShow: 3
               }
           },
           {
               breakpoint: 460,
               settings: {
                   slidesToShow: 1,
                   centerMode: true,
                   centerPadding: '80px'
               }
           }
       ]
   });
});