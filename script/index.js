

var swiper = new Swiper(".home-slider", {
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
});


//compteur
$(document).ready(function () {
    $('.counter').counterUp({
        delay: 10,
        time: 1200
    });
});