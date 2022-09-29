document.addEventListener("DOMContentLoaded", () => {
  /**
   * Variables
   */
  let dropdownList = document.querySelectorAll('[data-toggle="dropdown-toggle"]');
  const menuOpenBtn = document.querySelector(".menu-burger-open");
  const menuCloseBtn = document.querySelector(".menu-burger-close");
  const menuOverlay = document.querySelector(".menu-overlay");
  let menu = document.querySelector(".nav-links");

  menuOpenBtn.addEventListener("click", menuToggle);
  menuCloseBtn.addEventListener("click", menuToggle);
  menuOverlay.addEventListener("click", menuToggle);

  /**
   * Function Toggle Menu
   */
  function menuToggle() {
    menuOverlay.classList.toggle("is-overlay-active");
    menu.classList.toggle("is-open");
    document.body.classList.toggle("hidden-y");
  }

  menu.addEventListener("click", (event) => {
    console.log(event.target.hasAttribute("data-toggle"));
    if (event.target.hasAttribute("data-toggle") && window.innerWidth <= 1024) {
      event.preventDefault();
      const dropdown = event.target.parentElement;
      if (dropdown.classList.contains("isDropdownOpen")) {
        dropdown.classList.remove("isDropdownOpen");
      } else {
        dropdown.classList.add("isDropdownOpen");
      }
    }
  });
});
