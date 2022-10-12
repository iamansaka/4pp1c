document.addEventListener("DOMContentLoaded", () => {
  const buttonModals = document.querySelectorAll(".open-button");
  const buttonCloseModals = document.querySelectorAll("[data-dismiss='dialog']");

  console.log(buttonCloseModals);
  (buttonModals || []).forEach((el) => {
    el.addEventListener("click", (event) => {
      event.preventDefault();
      const target = el.dataset.modal;
      const modal = document.querySelector(target);
      openModal(modal);

      (buttonCloseModals || []).forEach((btnClose) => {
        btnClose.addEventListener("click", () => {
          closeModal(modal);
        });
      });

      window.addEventListener("keydown", (event) => {
        if (event.keyCode === 27) {
          closeModal(modal);
        }
      });
    });
  });

  function openModal($el) {
    $el.showModal();
  }

  function closeModal($el) {
    $el.close();
  }
});
