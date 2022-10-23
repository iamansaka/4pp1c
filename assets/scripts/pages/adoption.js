import Swiper, { Navigation } from "swiper";
import "../../styles/pages/adoption.scss";
// import "swiper/css/pagination";
// import "swiper/css/navigation";
// import "swiper/css";

document.addEventListener("DOMContentLoaded", function () {
  let main = new Swiper(".gallery-slider", {
    spaceBetween: 10,
    slidesPerView: 4,
    loop: true,
    loopedSlides: 6,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    modules: [Navigation],
  });

  let thumbnails = new Swiper(".gallery-thumbnail", {
    slidesPerView: "auto",
    spaceBetween: 10,
    centeredSlides: true,
    loop: true,
    slideToClickedSlide: true,
  });
  main.controller.control = main;
  thumbnails.controller.control = thumbnails;
});
