import "../styles/pages/testimonials.scss";

document.addEventListener("DOMContentLoaded", () => {
  const allStar = document.querySelectorAll(".bxs-star");
  let note = document.querySelector(".rating");

  allStar.forEach((star) => {
    star.addEventListener("click", saveRating);
    // star.addEventListener("mouseover", selectRating);
  });

  function saveRating(event) {
    const data = event.target;
    data.classList.add("gold");
    previousElement(data);
    note.value = data.dataset.value;
  }

  //   function selectRating(event) {
  //     const data = event.target;
  //     data.classList.add("gold");
  //     previousElement(data);
  //   }

  function previousElement(elem) {
    for (let i = 0; i < allStar.length; i++) {
      if (i < elem.dataset.value) {
        allStar[i].classList.add("gold");
      } else {
        allStar[i].classList.remove("gold");
      }
    }
  }
});
