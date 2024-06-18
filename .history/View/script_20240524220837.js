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

// NOTIFICATION
function showCartNotification() {
  const cartNotification = document.getElementById("cart-notification");
  cartNotification.classList.add("visible");

  setTimeout(() => {
    cartNotification.classList.remove("visible");
  }, 1000); // Hiển thị trong 0.5 giây, sau đó ẩn đi
}

function showPayNotification() {
  const payNotification = document.getElementById("payed-notification");
  payNotification.classList.add("visible");

  setTimeout(() => {
    payNotification.classList.remove("visible");
  }, 1000); // Hiển thị trong 0.5 giây, sau đó ẩn đi
}

function showCancelNotification() {
  const cancelNotification = document.getElementById("cancel-notification");
  cancelNotification.classList.add("visible");

  setTimeout(() => {
    cancelNotification.classList.remove("visible");
  }, 1000); // Hiển thị trong 0.5 giây, sau đó ẩn đi
}

function showErrorNotification() {
  const errorNotification = document.getElementById("error-notification");
  errorNotification.classList.add("visible");

  setTimeout(() => {
    errorNotification.classList.remove("visible");
  }, 1000); // Hiển thị trong 0.5 giây, sau đó ẩn đi
}

function addToCartClicked(productId) {
  $.ajax({
    url: "../View/ConnectDb.php",
    type: "POST",
    data: { productId: productId },
    success: function () {
      console.log("success");
      showCartNotification();
    },
    error: function (xhr, status, error) {
      console.log("error");
      console.log("Product ID:", productId);
    },
  });
}
