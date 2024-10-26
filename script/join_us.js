var swiper = new Swiper(".reviews-slider", {
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    slidesPerView: 1,
    spaceBetween: 20,
    autoHeight: true,
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

/* Bouton page devenez mecanicien */
const realFileBtn1 = document.getElementById("identite");
const btn1 = document.getElementById("btn1");
const txt1 = document.getElementById("txt1");

btn1.addEventListener("click", function () {
    realFileBtn1.click();

})
realFileBtn1.addEventListener("change", function () {
    if (realFileBtn1.value) {
        txt1.innerHTML = realFileBtn1.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
    } else {
        txt1.innerHTML = "Aucun fichier actuellement joint";
    }

})

const realFileBtn2 = document.getElementById("diplome");
const btn2 = document.getElementById("btn2");
const txt2 = document.getElementById("txt2");

btn2.addEventListener("click", function () {
    realFileBtn2.click();

})
realFileBtn2.addEventListener("change", function () {
    if (realFileBtn2.value) {
        txt2.innerHTML = realFileBtn2.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
    } else {
        txt2.innerHTML = "Aucun fichier actuellement joint";
    }

})



