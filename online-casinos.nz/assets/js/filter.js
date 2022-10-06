function filterMenu(selector) {
  let menu = document.querySelector(selector);
  let button = document.querySelector("#filtration__show");

  button.addEventListener("click", (e) => {
    e.preventDefault();
    toggleMenu();
  });

  function toggleMenu() {
    if (menu.classList.contains("filter-form-active")) {
      menu.classList.remove("filter-form-active");
      button.classList.remove("filtration__show-svg-active");
    } else {
      menu.classList.add("filter-form-active");
      button.classList.add("filtration__show-svg-active");
    }
  }
}
