window.onload = function () {
  document.body.classList.add("loaded_hiding");
  window.setTimeout(function () {
    document.body.classList.add("loaded");
    document.body.classList.remove("loaded_hiding");
  }, 500);
};

function burgerMenu(selector) {
  let menu = document.querySelector(selector);
  let button = menu.querySelector(".burger-menu_button");

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

// function languageMenu(selector) {
//   let menu = document.querySelector(selector);
//   let button = menu.querySelector(".language__menu-button");
//   let body = document.querySelector("body");

//   button.addEventListener("click", (e) => {
//     e.preventDefault();
//     toggleMenu();
//   });

//   function toggleMenu() {
//     if (menu.classList.contains("language__menu_active")) {
//       menu.classList.remove("language__menu_active");
//     } else {
//       menu.classList.add("language__menu_active");
//     }
//   }
// }

// languageMenu("#language__menu");

const faqItems = document.querySelectorAll(".faq__text");

// add a click event for all items
faqItems.forEach((acc) => acc.addEventListener("click", toggleAcc));

function toggleAcc() {
  // remove active class from all items exept the current item (this)
  faqItems.forEach((item) =>
    item != this ? item.classList.remove("faq__menu_active") : null
  );

  // toggle active class on current item
  if (this.classList != "faq__menu_active") {
    this.classList.toggle("faq__menu_active");
  }
}

// регистрация обзервера
const headerRef = document.querySelector(".js-page-header");
const back2topObserver = new IntersectionObserver(onEntryBack2top);

function onEntryBack2top(entries) {
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
const back2TopBtnRef = document.querySelector(".back2top");

function onClick() {
  window.scrollTo({ top, behavior: "smooth" });
}

back2TopBtnRef.addEventListener("click", onClick);

// function gameOpen(selector) {
//   let menu = document.querySelector(selector);
//   let button = menu.querySelector(".video__link");
//   let iframe = menu.querySelector(".FramePlaceholder");

//   button.addEventListener("click", (e) => {
//     e.preventDefault();
//     toggleMenu();
//   });

//   function toggleMenu() {
//     if (menu.classList.contains("FramePlaceholder__active")) {
//       iframe.classList.remove("FramePlaceholder__active");
//       button.classList.remove("remove-button");
//     } else {
//       iframe.classList.add("FramePlaceholder__active");
//       button.classList.add("remove-button");
//     }
//   }
// }

// gameOpen(".video");

// select all accordion items
