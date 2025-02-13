document.addEventListener("DOMContentLoaded", (event) => {
  const stars = document.querySelectorAll(".star-rating i");

  stars.forEach((star) => {
    star.addEventListener("click", function () {
      const rating = this.getAttribute("data-value");
      const collabId = this.getAttribute("data-collab-id");
      const url = `?rating=${rating}&q=${collabId}`;

      window.location.href = url;
    });
  });

  function highlightStars(rating) {
    stars.forEach((star) => {
      if (star.getAttribute("data-value") <= rating) {
        star.classList.add("selected");
      } else {
        star.classList.remove("selected");
      }
    });
  }
});
