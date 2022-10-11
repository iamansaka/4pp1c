window = () => {
  const notification = document.querySelector(".notification");
  const btnclose = document.querySelector(".notification .notification-close");

  // Close notification
  btnclose.addEventListener("click", () => {
    console.log("ok");
    notification.classList.remove("show");
    notification.classList.add("hidden");
  });
};
