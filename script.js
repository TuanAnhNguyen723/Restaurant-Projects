// MENU
const divtoShow = 'nav .menu';
const divPopup = document.querySelector(divtoShow)
const divTrigger = document.querySelector('.m-trigger')

divTrigger.addEventListener('click', () => {
    setTimeout(() => {
        if (!divPopup.classList.contains('show')) {
            divPopup.classList.add('show');
            document.body.classList.add('menu-visible')
        }
    }, 250);
})

// automatically close by click
document.addEventListener('click', (e) => {
    const isClosest = e.target.closest(divtoShow);

    if(!isClosest && divPopup.classList.contains('show')) {
        divPopup.classList.remove('show')
        document.body.classList.remove('menu-visible');
    }
})

// SEARCH
const sTrigger = document.querySelector('.s-trigger');
const addclass = document.querySelector('.site');

sTrigger.addEventListener('click', () => {
    addclass.classList.toggle('showsearch')
})

// SLIDER
const sliderThumb = new Swiper('.thumb-nav', {
    spaceBetween: 10,
    slidesPerView: 3,
    slidesPerGroup: false,
    breakpoints: {
        992: {
            direction: 'vertical'
        }
    }
});

const theSlider = new Swiper('.thumb-big', {
    slidesPerView: 1,
    pagination: {
        el: '.swiper-pagination',
    },
    thumbs: {
        swiper: sliderThumb,
    }
});

// TABBED PRODUCTS
const tabbeNav = new Swiper('.tnav', {
    spaceBetween: 20,
    slidesPerView: 6,
    centeredSlides: true,
    slidesPerGroup: false,
});

const theTab = new Swiper('.tabbed-item', {
    loop: true,
    slidesPerView: 1,
    thumbs: {
        swiper: tabbeNav,
    }
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
const products = [
    {
        id: 0,
        image: './assets/products/baked1.jpg',
        title: 'Baked is good',
        price: 15
    },
    
    {
        id: 1,
        image: './assets/products/baked2.jpg',
        title: 'Baked is good',
        price: 11
    },

    {
        id: 2,
        image: './assets/products/baked3.jpg',
        title: 'Baked is good',
        price: 13
    },

    {
        id: 3,
        image: './assets/products/baked4.jpg',
        title: 'Baked is good',
        price: 14
    },

    {
        id: 4,
        image: './assets/products/baked5.jpg',
        title: 'Baked is good',
        price: 15
    },

    {
        id: 5,
        image: './assets/products/baked6.jpg',
        title: 'Baked is good',
        price: 15
    },
]




const btnCart = document.querySelector('.icart');
const btnCloseCart = document.querySelector('.md_cart_close') 
const btnOpenCart = document.querySelector('.js-btn-open-cart')
const modalCart = document.querySelector('.js-modal_cart')
const modalCartCtn = document.querySelector('.md_cart_container')


function showCart() {
    modalCart.classList.add('open');
    modalCart.classList.add('animationIn');
}

function hideCart() {
    modalCart.classList.remove('animationIn');
    modalCart.classList.remove('open')
}
btnCart.addEventListener('click', () => {
    setTimeout(() => {
        showCart()
    }, 50);
});


btnCloseCart.addEventListener('click', hideCart);

// NOTIFICATION
function showCartNotification() {
    const cartNotification = document.getElementById("cart-notification");
    cartNotification.classList.add("visible");
  
    setTimeout(() => {
      cartNotification.classList.remove("visible");
    }, 1000); // Hiển thị trong 0.5 giây, sau đó ẩn đi
  }
  




const categories = [...new Set(products.map((item) =>
    {return item}))]
    let i = 0;

const addBtns = document.querySelectorAll('.buttons');

for (let i = 0; i < addBtns.length; i+1) {
    var addBtn = addBtns[i];
    addBtn.innerHTML = "<button onclick = 'addToCart("+(i++)+")'> AddToCart </button>" + 
    '<a href="#" class="like"><i class="fa-regular fa-heart"></i></a>'
}
var cart = [];
function addToCart(a) {
    cart.push({...categories[a]});
    displaycart();
    showCartNotification(); // Hiển thị thông báo khi sản phẩm được thêm vào giỏ hàng
}

function delElement(a) {
    cart.splice(a,1);
    displaycart();
}

function displaycart(a) {
    let j  =  0;
    var total_money = 0;
    document.getElementById("count").innerHTML=cart.length;
    if(cart.length == 0) {
        document.getElementById('cartItem').innerHTML = "Your cart is empty";
        document.getElementById('total_money').innerHTML = "Total: "+"$ "+ 0 +".00";

    } else {
        document.getElementById('cartItem').innerHTML = cart.map((items) => {
            var {image, title, price} = items
            total_money = total_money + price;
            document.getElementById("total_money").innerHTML = "Total: " + "$ " +total_money+".00";
            return(
            `<div class="md_box-cart">
                <div class="md_box_food">
                    <img src=${image}></img>
                    <p>${title}</p>
                    <p class="md_price">${price}.00</p>
                </div>` +
                "<div class='md_box-add' onclick ='delElement("+(j++)+")'><i class='fa-solid fa-trash'></i></div> " +
                
            `</div>`
            )
        }).join('');
    }
}






