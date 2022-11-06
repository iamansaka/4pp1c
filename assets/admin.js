import "./styles/admin.scss";
import "./scripts/elements/modal";
import { openDropdown, closeDropdown, closeAllDropdown } from "./scripts/dropdown";

const dropdownList = document.querySelectorAll(".option-trigger");
const menuBtn = document.querySelector(".menu-burger");
const menu = document.querySelector(".navbar-bottom");

(dropdownList || []).forEach((dropdown) => {
  dropdown.addEventListener("click", function (event) {
    event.stopPropagation();
    closeAllDropdown();
    const lastElement = dropdown.lastElementChild;
    if (lastElement.classList.contains("is-active")) {
      // closeDropdown(lastElement);
      // console.log("ok");
    } else {
      // console.log("ko");
    }
    openDropdown(lastElement);
  });
});

menuBtn.addEventListener("click", () => {
  menu.classList.toggle("menu-open");
});
