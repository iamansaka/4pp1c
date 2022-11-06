import "../../styles/pages/dashboard.scss";
import moment from "moment";

document.addEventListener("DOMContentLoaded", function () {
  const date = document.querySelector(".date");
  const hours = document.querySelector(".heures");

  moment.locale("fr_FR");
  clock();

  function clock() {
    date.textContent = moment().format("LL");
    hours.textContent = moment().format("LTS");
  }

  setInterval(clock, 1000);
  console.log("hello dashboard");
});
