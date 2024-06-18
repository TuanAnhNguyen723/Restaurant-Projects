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