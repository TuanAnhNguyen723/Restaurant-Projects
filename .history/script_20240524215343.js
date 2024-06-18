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

// ON SCROLL TRANSITION
// const io = new IntersectionObserver(entries => {
//     entries.fonEach(entry => {
//         if (entry.intersectionRatio > 0) {
//             entry.target.classList.add('this')
//         }
//     })
// })

// const box = document.querySelectorAll('.animate');
//     box.forEach((el) => {
//         io.observe(el);
// })

// ADD TO CART
// const products = [
//   {
//     id: 0,
//     image: "../assets/products/baked1.jpg",
//     name: "Baked is good",
//     price: 11.99,
//   },

//   {
//     id: 1,
//     image: "../assets/products/baked2.jpg",
//     name: "Baked is good",
//     price: 12.99,
//   },

//   {
//     id: 2,
//     image: "../assets/products/baked3.jpg",
//     name: "Baked is good",
//     price: 20.99,
//   },

//   {
//     id: 3,
//     image: "../assets/products/baked4.jpg",
//     name: "Baked is good",
//     price: 10.99,
//   },

//   {
//     id: 4,
//     image: "../assets/products/baked5.jpg",
//     name: "Baked is good",
//     price: 9.99,
//   },

//   {
//     id: 5,
//     image: "../assets/products/baked6.jpg",
//     name: "Baked is good",
//     price: 16.99,
//   },

//   {
//     id: 6,
//     image: "../assets/products/baked7.jpg",
//     name: "Baked is good",
//     price: 17.99,
//   },

//   {
//     id: 7,
//     image: "../assets/products/baked8.jpg",
//     name: "Baked is good",
//     price: 30.99,
//   },

//   {
//     id: 8,
//     image: "../assets/products/baked9.jpg",
//     name: "Baked is good",
//     price: 23.99,
//   },

//   {
//     id: 9,
//     image: "../assets/products/garnish1.jpg",
//     name: "garnish is good",
//     price: 25.99,
//   },

//   {
//     id: 10,
//     image: "../assets/products/garnish2.jpg",
//     name: "garnish is good",
//     price: 27.99,
//   },

//   {
//     id: 11,
//     image: "../assets/products/garnish3.jpg",
//     name: "garnish is good",
//     price: 21.99,
//   },

//   {
//     id: 12,
//     image: "../assets/products/garnish4.jpg",
//     name: "garnish is good",
//     price: 19.99,
//   },

//   {
//     id: 13,
//     image: "../assets/products/garnish5.jpg",
//     name: "garnish is good",
//     price: 20.99,
//   },

//   {
//     id: 14,
//     image: "../assets/products/garnish6.jpg",
//     name: "garnish is good",
//     price: 30.99,
//   },

//   {
//     id: 15,
//     image: "../assets/products/herbs1.jpg",
//     name: "Herbs is good",
//     price: 10.99,
//   },

//   {
//     id: 16,
//     image: "../assets/products/herbs2.jpg",
//     name: "Herbs is good",
//     price: 5.99,
//   },

//   {
//     id: 17,
//     image: "../assets/products/herbs3.jpg",
//     name: "Herbs is good",
//     price: 7.99,
//   },

//   {
//     id: 18,
//     image: "../assets/products/herbs4.jpg",
//     name: "Herbs is good",
//     price: 12.99,
//   },

//   {
//     id: 19,
//     image: "../assets/products/herbs5.jpg",
//     name: "Herbs is good",
//     price: 20.99,
//   },

//   {
//     id: 20,
//     image: "../assets/products/nuts1.jpg",
//     name: "Nuts is good",
//     price: 30.29,
//   },

//   {
//     id: 21,
//     image: "../assets/products/nuts2.jpg",
//     name: "Nuts is good",
//     price: 21.39,
//   },

//   {
//     id: 22,
//     image: "../assets/products/nuts3.jpg",
//     name: "Nuts is good",
//     price: 22.49,
//   },

//   {
//     id: 23,
//     image: "../assets/products/nuts4.jpg",
//     name: "Nuts is good",
//     price: 24.59,
//   },

//   {
//     id: 24,
//     image: "../assets/products/nuts5.jpg",
//     name: "Nuts is good",
//     price: 26.99,
//   },

//   {
//     id: 25,
//     image: "../assets/products/nuts6.jpg",
//     name: "Nuts is good",
//     price: 28.99,
//   },

//   {
//     id: 26,
//     image: "../assets/products/nuts7.jpg",
//     name: "Nuts is good",
//     price: 10.99,
//   },

//   {
//     id: 27,
//     image: "../assets/products/nuts8.jpg",
//     name: "Nuts is good",
//     price: 15.59,
//   },

//   {
//     id: 28,
//     image: "../assets/products/nuts9.jpg",
//     name: "Nuts is good",
//     price: 32.39,
//   },

//   {
//     id: 29,
//     image: "../assets/products/seafood1.jpg",
//     name: "Seafood is good",
//     price: 40.99,
//   },

//   {
//     id: 30,
//     image: "../assets/products/seafood2.jpg",
//     name: "Seafood is good",
//     price: 45.99,
//   },

//   {
//     id: 31,
//     image: "../assets/products/seafood3.jpg",
//     name: "Seafood is good",
//     price: 46.99,
//   },

//   {
//     id: 32,
//     image: "../assets/products/seafood4.jpg",
//     name: "Seafood is good",
//     price: 47.99,
//   },

//   {
//     id: 33,
//     image: "../assets/products/seafood5.jpg",
//     name: "Seafood is good",
//     price: 49.99,
//   },

//   {
//     id: 34,
//     image: "../assets/products/seafood6.jpg",
//     name: "Seafood is good",
//     price: 50.99,
//   },

//   {
//     id: 35,
//     image: "../assets/products/seafood7.jpg",
//     name: "Seafood is good",
//     price: 51.99,
//   },

//   {
//     id: 36,
//     image: "../assets/products/seafood8.jpg",
//     name: "Seafood is good",
//     price: 41.99,
//   },

//   {
//     id: 37,
//     image: "../assets/products/seafood9.jpg",
//     name: "Seafood is good",
//     price: 60.99,
//   },

//   {
//     id: 38,
//     image: "../assets/products/vegetable1.jpg",
//     name: "Vegetable is good",
//     price: 20.99,
//   },

//   {
//     id: 39,
//     image: "../assets/products/vegetable2.jpg",
//     name: "Vegetable is good",
//     price: 18.99,
//   },

//   {
//     id: 40,
//     image: "../assets/products/vegetable3.jpg",
//     name: "Vegetable is good",
//     price: 17.99,
//   },

//   {
//     id: 41,
//     image: "../assets/products/vegetable4.jpg",
//     name: "Vegetable is good",
//     price: 16.99,
//   },

//   {
//     id: 42,
//     image: "../assets/products/vegetable5.jpg",
//     name: "Vegetable is good",
//     price: 15.99,
//   },

//   {
//     id: 43,
//     image: "../assets/products/vegetable6.jpg",
//     name: "Vegetable is good",
//     price: 14.99,
//   },

//   {
//     id: 44,
//     image: "../assets/products/vegetable7.jpg",
//     name: "Vegetable is good",
//     price: 13.99,
//   },

//   {
//     id: 45,
//     image: "../assets/products/vegetable8.jpg",
//     name: "Vegetable is good",
//     price: 12.99,
//   },

//   {
//     id: 46,
//     image: "../assets/products/vegetable9.jpg",
//     name: "Vegetable is good",
//     price: 11.99,
//   },
// ];

const btnCart = document.querySelector(".icart");
const btnCloseCart = document.querySelector(".md_cart_close");
const btnOpenCart = document.querySelector(".js-btn-open-cart");
const modalCart = document.querySelector(".js-modal_cart");
const modalCartCtn = document.querySelector(".md_cart_container");

function showCart() {
  modalCart.classList.add("open");
  modalCart.classList.add("animationIn");
}

function hideCart() {
  modalCart.classList.remove("animationIn");
  modalCart.classList.remove("open");
}
btnCart.addEventListener("click", () => {
  setTimeout(() => {
    showCart();
  }, 50);
});

btnCloseCart.addEventListener("click", hideCart);

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

// // Lovely
// const allFoods = ".products li";
// const allFoodsCart = document.querySelectorAll(allFoods);
// const btnLikes = document.querySelectorAll(".like");

// btnLikes.forEach(function (btnLike) {
//   btnLike.addEventListener("click", (e) => {
//     e.preventDefault();
//     console.log(111);
//   });
// });

// const categories = [
//   ...new Set(
//     products.map((item) => {
//       return item;
//     })
//   ),
// ];
// let i = 0;

// document.addEventListener("DOMContentLoaded", function () {
//   const addBtns = document.querySelectorAll(".buttons");

//   // Check if the buttons are selected correctly
//   console.log(addBtns);

//   // Kiểm tra và lấy lại dữ liệu giỏ hàng từ localStorage
//   let cart = JSON.parse(localStorage.getItem("cart")) || [];

//   // Hiển thị giỏ hàng khi tải trang
//   displaycart();

//   // Loop through the buttons and update their innerHTML
//   addBtns.forEach((addBtn, i) => {
//     console.log(`Updating button ${i}`); // Debug statement
//     addBtn.innerHTML = `
//       <button onclick='addToCart(${i})'>AddToCart</button>
//       <a href="#" class="like"><i class="fa-regular fa-heart"></i></a>
//     `;
//   });
//   function addToCart(a) {
//     cart.push({ ...categories[a] });
//     // Lưu giỏ hàng vào localStorage
//     localStorage.setItem("cart", JSON.stringify(cart));
//     displaycart();

//     // Hiển thị thông báo khi sản phẩm được thêm vào giỏ hàng
//     showCartNotification();
//   }
// });

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

function delElement(a) {
  cart.splice(a, 1);
  // Cập nhật giỏ hàng trong localStorage
  localStorage.setItem("cart", JSON.stringify(cart));
  displaycart();
}

function displaycart() {
  let j = 0;
  let total_money = 0;
  document.getElementById("count").innerHTML = cart.length;
  if (cart.length == 0) {
    document.getElementById("cartItem").innerHTML = "Your cart is empty";
    document.getElementById("total_money").innerHTML =
      "Total: $" +
      total_money.toFixed(2) +
      `<div id="iconPay"> 
            <i class="fa-brands fa-apple-pay"></i> 
            <i class="fa-brands fa-cc-paypal"></i>
        </div>`;
  } else {
    document.getElementById("cartItem").innerHTML = cart
      .map((items) => {
        var { image, name, price } = items;

        total_money += price;
        document.getElementById("total_money").innerHTML =
          "Total: $" +
          total_money.toFixed(2) +
          `<div id="iconPay">
            <i class="fa-brands fa-apple-pay"></i> 
            <i class="fa-brands fa-cc-paypal"></i>
        </div>`;

        return (
          `<div class="md_box-cart">
                <div class="md_box_food">
                    <img src=${image}></img>
                    <p>${name}</p>
                    <p class="md_price">${price.toFixed(2)} $</p>
                </div>` +
          "<div class='md_box-add' onclick='delElement(" +
          j++ +
          ")'><i class='fa-solid fa-trash'></i></div> " +
          `</div>`
        );
      })
      .join("");
  }
}

const btnPays = document.querySelectorAll(".fa-brands");

// PAY
const applePay = document.querySelector(".fa-brands.fa-apple-pay");
const paypalPay = document.querySelector(".fa-brands.fa-cc-paypal");
const modalPay = document.querySelector(".js-modal-pay");
const closeModalPay = document.querySelector(".cancel-button");
const confirmPay = document.querySelector(".confirm-button");

document.addEventListener("click", function (event) {
  if (event.target.classList.contains("fa-apple-pay")) {
    showModalPay();
  }

  if (event.target.classList.contains("fa-cc-paypal")) {
    showModalPay();
  }
});

function showModalPay() {
  modalPay.classList.add("open");
}

function hideModalPay() {
  modalPay.classList.remove("open");
}

function moneyPay() {
  hideModalPay();
}

closeModalPay.addEventListener("click", hideModalPay);
confirmPay.addEventListener("click", moneyPay);

// Hàm thực hiện thanh toán
confirmPay.addEventListener("click", function () {
  if (total_money === 0) {
    showCancelNotification();
  } else {
    cart = [];
    // Xóa giỏ hàng khỏi localStorage
    localStorage.removeItem("cart");
    displaycart();
  }
  hideModalPay();
  hideCart();
  showPayNotification();
});
// JS notification modal login success

const container = document.getElementById("container");
const registerBtn = document.getElementById("register");
const loginBtn = document.getElementById("login");

registerBtn.addEventListener("click", () => {
  container.classList.add("active");
});

loginBtn.addEventListener("click", () => {
  container.classList.remove("active");
});
