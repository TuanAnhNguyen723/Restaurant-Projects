// MENU
const divtoShow = "nav .menu";
const divPopup = document.querySelector(divtoShow);
const divTrigger = document.querySelector(".m-trigger");

divTrigger.addEventListener("click", () => {
  setTimeout(() => {
    if (!divPopup.classList.contains("show")) {
      divPopup.classList.add("show");
      document.body.classList.add("menu-visible");
    }
  }, 250);
});

// automatically close by click
document.addEventListener("click", (e) => {
  const isClosest = e.target.closest(divtoShow);

  if (!isClosest && divPopup.classList.contains("show")) {
    divPopup.classList.remove("show");
    document.body.classList.remove("menu-visible");
  }
});

// SEARCH
const sTrigger = document.querySelector(".s-trigger");
const addclass = document.querySelector(".site");

sTrigger.addEventListener("click", () => {
  addclass.classList.toggle("showsearch");
});

// SLIDER
const sliderThumb = new Swiper(".thumb-nav", {
  spaceBetween: 10,
  slidesPerView: 3,
  slidesPerGroup: false,
  breakpoints: {
    992: {
      direction: "vertical",
    },
  },
});

const theSlider = new Swiper(".thumb-big", {
  slidesPerView: 1,
  pagination: {
    el: ".swiper-pagination",
  },
  thumbs: {
    swiper: sliderThumb,
  },
});

// TABBED PRODUCTS
const tabbeNav = new Swiper(".tnav", {
  spaceBetween: 20,
  slidesPerView: 6,
  centeredSlides: true,
  slidesPerGroup: false,
});

const theTab = new Swiper(".tabbed-item", {
  loop: true,
  slidesPerView: 1,
  thumbs: {
    swiper: tabbeNav,
  },
});

const container = document.getElementById("container");
const registerBtn = document.getElementById("register");
const loginBtn = document.getElementById("login");

registerBtn.addEventListener("click", () => {
  container.classList.add("active");
});

loginBtn.addEventListener("click", () => {
  container.classList.remove("active");
});
