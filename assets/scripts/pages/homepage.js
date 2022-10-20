import "../../styles/pages/home.scss";
import Swiper, { Navigation, Pagination } from "swiper";
import "swiper/css/pagination";
import "swiper/css";

document.addEventListener("DOMContentLoaded", () => {
  const swiper = new Swiper(".testimonials-slider", {
    slidesPerView: 1,
    slidesPerGroup: 1,
    spaceBetween: 10,
    loopFillGroupWithBlank: true,
    keyboard: true,
    pagination: {
      el: ".swiper-custom-pagination",
      clickable: true,
      // renderBullet: function (index, className) {
      //   return '<span class="' + className + '">' + (index + 1) + "</span>";
      // },
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
    slidesPerView: 1,
    slidesPerGroup: 1,
    spaceBetween: 10,
    loopFillGroupWithBlank: true,
    keyboard: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    breakpoints: {
      768: {
        slidesPerView: 1,
        spaceBetween: 10,
      },
      1024: {
        slidesPerView: 3,
        slidesPerGroup: 1,
        spaceBetween: 30,
      },
    },
    modules: [Navigation],
  });
});
