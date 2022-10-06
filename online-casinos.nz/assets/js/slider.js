
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


