window.onload = function () {
  document.body.classList.add("loaded_hiding");
  window.setTimeout(function () {
    document.body.classList.add("loaded");
    document.body.classList.remove("loaded_hiding");
  }, 500);
};

// регистрация обзервера
const headerRef = document.querySelector(".js-page-header");
const back2topObserver = new IntersectionObserver(onEntryBack2top);

function onEntryBack2top(entries) {
  const back2TopBtnRef = document.querySelector("#back2top");
  back2TopBtnRef.classList.add("show");

  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      back2TopBtnRef.classList.remove("show");
    }
  });
}
// элемент за который нужно наблюдать
back2topObserver.observe(headerRef);

// ссылка на кнопку Вверх
const back2TopBtnRef = document.querySelector("#back2top");

function onClick() {
  window.scrollTo({ top, behavior: "smooth" });
}

back2TopBtnRef.addEventListener("click", onClick);

function burgerMenu(selector) {
  let menu = document.querySelector(selector);
  let button = menu.querySelector(".burger-menu_button");
  let links = menu.querySelector(".burger-menu_link");
  let body = document.querySelector("body");

  button.addEventListener("click", (e) => {
    e.preventDefault();
    toggleMenu();
  });

  // links.addEventListener("click", () => toggleMenu());

  function toggleMenu() {
    if (menu.classList.contains("burger-menu_active")) {
      menu.classList.remove("burger-menu_active");

    } else {
      menu.classList.add("burger-menu_active");
    }
  }
}

burgerMenu(".nav__burger-menu");
