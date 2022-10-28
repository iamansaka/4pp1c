import "../../styles/pages/home.scss";
import Swiper, { Navigation, Pagination } from "swiper";
import "swiper/css/pagination";
import "swiper/css";

document.addEventListener("DOMContentLoaded", () => {
  const bush = document.querySelector(".illustration-bush");
  const cat = document.querySelector(".illustration-cat");

  const swiper = new Swiper(".testimonials-slider", {
    slidesPerView: 1,
    slidesPerGroup: 1,
    spaceBetween: 10,
    loopFillGroupWithBlank: true,
    keyboard: true,
    pagination: {
      el: ".swiper-custom-pagination",
      clickable: true,
    },
    breakpoints: {
      768: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      1024: {
        slidesPerView: 3,
        slidesPerGroup: 3,
        spaceBetween: 30,
      },
    },
    modules: [Pagination],
  });

  const adoptables = new Swiper(".adoptables-slider", {
    slidesPerView: 3,
    spaceBetween: 25,
    centerSlide: "true",
    fade: "true",
    grabCursor: "true",
    loopFillGroupWithBlank: true,
    keyboard: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      520: {
        slidesPerView: 2,
      },
      950: {
        slidesPerView: 3,
      },
    },
    modules: [Navigation],
  });

  bush.addEventListener("click", () => {
    cat.style.transform = "translateX(-100%)";
    bush.style.animation = "none";
  });
});
