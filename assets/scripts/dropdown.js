/**
 * This function open dropdown
 * @param {*} el
 */
export function openDropdown(el) {
  el.classList.add("is-active");
}

/**
 *  This function close dropdown
 * @param {*} el
 */
export function closeDropdown(el) {
  el.classList.remove("is-active");
}

/**
 *  This function close all dropdown
 */
export function closeAllDropdown() {
  document.querySelectorAll(".option-trigger" || []).forEach(($dropdown) => {
    const lastElement = $dropdown.lastElementChild;
    closeDropdown(lastElement);
  });
}
