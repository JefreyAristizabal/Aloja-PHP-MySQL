$(document).ready(function(){

    $('.owl-carousel').owlCarousel({
        center: false,
        loop:false,
        margin:10,
        nav:true,
        autoplay:false,
        autoplayHoverPause:false,
        smartSpeed: 1500,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:3
            }
        }
    })

})