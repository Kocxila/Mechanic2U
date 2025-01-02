
var swiper = new Swiper(".reviews-slider", {
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    slidesPerView: 1,
    spaceBetween: 20,
    autoHeight: false,
    grabCursor: true,
    loop: true,
    keyboard: {
        enabled: true,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },

    breakpoints: {
        // when window width is >= 767px 
        767: {
            slidesPerView: 3,
        },
    },
  
});
