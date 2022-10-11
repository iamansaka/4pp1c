import "./styles/admin.scss";
import { openDropdown, closeDropdown, closeAllDropdown } from "./scripts/dropdown";

// Dropdown

// const dropdownList = document.querySelectorAll(".option-trigger");

// dropdownList.forEach((dropdown) => {
//   dropdown.addEventListener("click", function (event) {
//     event.stopPropagation();
//     dropdown.lastElementChild.classList.toggle("is-active");
//   });
// });
const dropdownList = document.querySelectorAll(".option-trigger");

(dropdownList || []).forEach((dropdown) => {
  dropdown.addEventListener("click", function (event) {
    event.stopPropagation();
    closeAllDropdown();
    const lastElement = dropdown.lastElementChild;
    if (lastElement.classList.contains("is-active")) {
      // closeDropdown(lastElement);
      console.log("ok");
    } else {
      console.log("ko");
    }
    openDropdown(lastElement);
  });
});
