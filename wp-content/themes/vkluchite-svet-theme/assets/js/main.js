const html = document.querySelector('html');
const body = document.querySelector('body');

// бургер
if (document.querySelector(".sd-header__burger-button")) {
  const burgerButton = document.querySelector('.sd-header__burger-button');
  const burgerMenu = document.querySelector('.sd-burger');

  const toggleMenu = () => {
    burgerMenu.classList.toggle('open');
    burgerButton.classList.toggle('active');
    body.classList.toggle('body-overflow');
    html.classList.toggle('body-overflow');
  }

  burgerButton.addEventListener('click', e => {
    e.stopPropagation();
    toggleMenu();
  });

  document.addEventListener('click', e => {
    let target = e.target;
    let its_burgerMenu = target == burgerMenu || burgerMenu.contains(target);
    let its_burgerButton = target == burgerButton;
    let burgerMenu_is_open = burgerMenu.classList.contains('open');

    if (!its_burgerMenu && !its_burgerButton && burgerMenu_is_open) {
      toggleMenu();
    }
  });
}

// поиск
if (document.querySelector(".sd-search")) {
  const search = document.querySelector('.sd-search');
  const searchButton = document.querySelectorAll('.sd-header__search-button');

  searchButton.forEach((ep) => {
    const toggleMenu = () => {
      search.classList.toggle('b-catalog_open');
      body.classList.toggle('body-overflow');
      html.classList.toggle('body-overflow');
    }

    ep.addEventListener('click', e => {
      e.stopPropagation();
      toggleMenu();
    });

    document.addEventListener('click', e => {
      let target = e.target;
      let its_burgerMenu = target == search || search.contains(target);
      let its_burgerButton = target == ep;
      let burgerMenu_is_open = search.classList.contains('b-catalog_open');

      if (!its_burgerMenu && !its_burgerButton && burgerMenu_is_open) {
        toggleMenu();
      }
    })
  })

  const searchInput = document.querySelector('.b-search__input');
  const searchSubmit = document.querySelector('.b-search__button');

  searchInput.addEventListener("click", () => {
    searchInput.classList.add("b-search_active");
    searchSubmit.classList.add('b-search_active');
  })
}
// диалог

if (document.querySelector("#modalDialog")) {
  const dialog = document.querySelector("#modalDialog");
  const open = document.querySelectorAll(".sd-header__modal-button");
  const close = document.querySelector(".sd-dialog__close");

  open.forEach((e) => {

    e.addEventListener("click", () => {
      dialog.show();
      body.classList.add('body-overflow');
    });
  })



  function handleClose() {

    const keyFrame = new KeyframeEffect(dialog,
      [{
        translate: "0 -100%", opacity: "0"
      }], {
      duration: 500, easing: "ease", direction: "normal"
    });
    const animation = new Animation(keyFrame, document.timeline);
    animation.play();
    animation.onfinish = () => dialog.close();
    body.classList.remove('body-overflow');
  }

  close.addEventListener("click", handleClose);

  document.addEventListener('click', el => {
    if (dialog.hasAttribute("open")) {
      let target = el.target;
      let its_catalog = target == dialog || dialog.contains(target);

      // for (let i = 0; i =< open.length; i++) {}
      let its_catalogButton0 = target == open[0];
      let its_catalogButton1 = target == open[1];
      let its_catalogButton2 = target == open[2];
      let its_catalogButton3 = target == open[3];
      let its_catalogButton4 = target == open[4];
      let its_catalogButton5 = target == open[5];

      if (!its_catalog && !its_catalogButton0 && !its_catalogButton1 && !its_catalogButton2 && !its_catalogButton3 && !its_catalogButton4 && !its_catalogButton5) {
        handleClose();
      }
    }
  });
}

// регистрация

if (document.querySelector("#modalDialogReg")) {
  const dialog = document.querySelector("#modalDialogReg");
  const open = document.querySelectorAll(".sd-header__modal-button_reg");
  const close = document.querySelector(".sd-dialog__close");

  open.forEach((e) => {

    e.addEventListener("click", () => {
      dialog.show();
      body.classList.add('body-overflow');
    });
  })

  close.addEventListener("click", handleClose);

  function handleClose() {

    const keyFrame = new KeyframeEffect(dialog,
      [{
        translate: "0 -100%", opacity: "0"
      }], {
      duration: 500, easing: "ease", direction: "normal"
    });
    const animation = new Animation(keyFrame, document.timeline);
    animation.play();
    animation.onfinish = () => dialog.close();
    body.classList.remove('body-overflow');
  }

  document.addEventListener('click', el => {
    if (dialog.hasAttribute("open")) {
      let target = el.target;
      let its_catalog = target == dialog || dialog.contains(target);

      // for (let i = 0; i =< open.length; i++) {}
      let its_catalogButton0 = target == open[0];
      let its_catalogButton1 = target == open[1];
      let its_catalogButton2 = target == open[2];
      let its_catalogButton3 = target == open[3];
      let its_catalogButton4 = target == open[4];
      let its_catalogButton5 = target == open[5];

      if (!its_catalog && !its_catalogButton0 && !its_catalogButton1 && !its_catalogButton2 && !its_catalogButton3 && !its_catalogButton4 && !its_catalogButton5) {
        handleClose();
      }
    }
  });
}

// авторизация

if (document.querySelector("#modalDialogAut")) {
  const dialog = document.querySelector("#modalDialogAut");
  const open = document.querySelectorAll(".sd-header__modal-button_aut");
  const close = document.querySelector(".sd-dialog__close");

  open.forEach((e) => {

    e.addEventListener("click", () => {
      dialog.show();
      body.classList.add('body-overflow');
    });
  })

  close.addEventListener("click", handleClose);

  function handleClose() {

    const keyFrame = new KeyframeEffect(dialog,
      [{
        translate: "0 -100%", opacity: "0"
      }], {
      duration: 500, easing: "ease", direction: "normal"
    });
    const animation = new Animation(keyFrame, document.timeline);
    animation.play();
    animation.onfinish = () => dialog.close();
    body.classList.remove('body-overflow');
  }

  document.addEventListener('click', el => {
    if (dialog.hasAttribute("open")) {
      let target = el.target;
      let its_catalog = target == dialog || dialog.contains(target);

      // for (let i = 0; i =< open.length; i++) {}
      let its_catalogButton0 = target == open[0];
      let its_catalogButton1 = target == open[1];
      let its_catalogButton2 = target == open[2];
      let its_catalogButton3 = target == open[3];
      let its_catalogButton4 = target == open[4];
      let its_catalogButton5 = target == open[5];

      if (!its_catalog && !its_catalogButton0 && !its_catalogButton1 && !its_catalogButton2 && !its_catalogButton3 && !its_catalogButton4 && !its_catalogButton5) {
        handleClose();
      }
    }
  });
}

// кнопка "В корзину"
(function () {
  if (!document.querySelector('.sd-card')) return;

  const card = document.querySelectorAll('.sd-card');
  card.forEach(function (e) {
    if (!e.querySelector('.sd-card__cart')) return;
  
    const cart = e.querySelector('.sd-card__cart');
  
    cart.addEventListener('click', (ep) => {
      cart.classList.toggle('active');
    })
  })
})();

if (document.querySelector(".sd-card__cart_p")) {
  const cart = document.querySelector('.sd-card__cart');
  cart.addEventListener('click', (ep) => {
    cart.classList.toggle('active');
  })
};

if (document.querySelector(".sd-card-page__favorite")) {
  const favoriteCard = document.querySelector('.sd-card-page__favorite');
  favoriteCard.addEventListener('click', (ep) => {
    favoriteCard.classList.toggle('active');
  })
};

// слайдер главной

if (document.querySelector('.swiper-main')) {
  const swiperMain = new Swiper(".swiper-main", {

    spaceBetween: 20,
    slidesPerView: 1,
    pagination: {
      el: ".swiper-pagination-main",
      clickable: true
    },
    autoplay: {
      delay: 5000,
    },
  });
}

// слайдер поулярных товаров

if (document.querySelector('.swiper-pop')) {
  const swiperPop = new Swiper(".swiper-pop", {
    spaceBetween: 15,
    slidesPerView: 1.8,
    breakpoints: {
      1700: {
        spaceBetween: 30,
      },
      992: {
        spaceBetween: 20,
        slidesPerView: 4,
      },
      768: {
        slidesPerView: 3,
      },
      576: {
        slidesPerView: 2,
      },
    },
  });
}

// слайдер стадии

if (document.querySelector('.swiper-stage')) {
  const swiperStage = new Swiper(".swiper-stage", {
    slidesPerView: 1.2,
    scrollbar: {
      el: '.swiper-scrollbar-stage',
      draggable: true,
    },
    breakpoints: {
      1701: {
        slidesPerView: 4,
      },
      992: {
        slidesPerView: 3,
      },
      576: {
        slidesPerView: 2,
      },
    },
  });
}

// слайдер блога

const resizableSwiperNew = (breakpoint, swiperClass, swiperSettings, callback) => {
  let swiper;
  breakpoint = window.matchMedia(breakpoint);

  const enableSwiper = function (className, settings) {
    swiper = new Swiper(className, settings);
    if (callback) {
      callback(swiper);
    }
  }

  const checker = function () {
    if (breakpoint.matches) {
      return enableSwiper(swiperClass, swiperSettings);
    }

    else {
      if (swiper !== undefined) swiper.destroy(true, true);
      return;
    }
  };

  breakpoint.addEventListener('change', checker);
  checker();
}

const someFuncNew = (instance) => {
  if (instance) {
    instance.on('slideChange', function (e) {
      console.log('*** mySwiper.activeIndex', instance.activeIndex);
    });
  }
};

resizableSwiperNew('(max-width: 1199px)',
  '.swiper-blog',
  {
    spaceBetween: 15,
    slidesPerView: 1.5,
    breakpoints: {
      768: {
        slidesPerView: 2.5,
      }
    },
  },
);

// слайдер карточки товара

const resizableSwiperCard = (breakpoint, swiperClass, swiperSettings, callback) => {
  let swiper;
  breakpoint = window.matchMedia(breakpoint);

  const enableSwiper = function (className, settings) {
    swiper = new Swiper(className, settings);
    if (callback) {
      callback(swiper);
    }
  }

  const checker = function () {
    if (breakpoint.matches) {
      return enableSwiper(swiperClass, swiperSettings);
    }

    else {
      if (swiper !== undefined) swiper.destroy(true, true);
      return;
    }
  };

  breakpoint.addEventListener('change', checker);
  checker();
}

const someFuncCard = (instance) => {
  if (instance) {
    instance.on('slideChange', function (e) {
      console.log('*** mySwiper.activeIndex', instance.activeIndex);
    });
  }
};

resizableSwiperCard('(max-width: 991px)',
  '.swiper-card-page',
  {
    spaceBetween: 10,
    slidesPerView: 1,
    pagination: {
      el: ".swiper-pagination-card-page",
      clickable: true
    },
  },
);

// маска телефона

function maskPhone(selector, masked = '+7 (___) ___-__-__') {
  const elems = document.querySelectorAll(selector);

  function mask(event) {
    const keyCode = event.keyCode;
    const template = masked,
      def = template.replace(/\D/g, ""),
      val = this.value.replace(/\D/g, "");
    console.log(template);

    let i = 0,
      newValue = template.replace(/[_\d]/g, function (a) {
        return i < val.length ? val.charAt(i++) || def.charAt(i) : a;
      }

      );
    i = newValue.indexOf("_");

    if (i !== -1) {
      newValue = newValue.slice(0, i);
    }

    let reg = template.substr(0, this.value.length).replace(/_+/g,
      function (a) {
        return "\\d{1," + a.length + "}";
      }

    ).replace(/[+()]/g, "\\$&");
    reg = new RegExp("^" + reg + "$");

    if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) {
      this.value = newValue;
    }

    if (event.type === "blur" && this.value.length < 5) {
      this.value = "";
    }

  }

  for (const elem of elems) {
    elem.addEventListener("input", mask);
    elem.addEventListener("focus", mask);
    elem.addEventListener("blur", mask);
  }

}

maskPhone('.wpcf7-tel');

// вопросы

if (document.querySelector(".b-protocol__details")) {
  const details = document.querySelectorAll('.b-protocol__details');

  details.forEach((e) => {
    const detailsButton = e.querySelector('.b-protocol__details-button');
    const detailsBox = e.querySelector('.b-protocol__details-box');

    detailsButton.addEventListener('click', () => {
      detailsBox.classList.toggle('active');
      detailsButton.classList.toggle('active');
    })
  })
}

// фото зум

if (document.querySelector(".glightbox")) {
  const lightbox = GLightbox();
  lightbox.on('open', (target) => {
    console.log('lightbox opened');
  });
}

// табы

const buttonsTabs = document.querySelectorAll('.b-tabs__nav-button');
const boxesTabs = document.querySelectorAll('.b-tabs__box');

buttonsTabs.forEach((item, index) => {
  item.addEventListener('click', () => {
    boxesTabs[index].classList.add('active');

    let boxesTabsArray = Array.from(boxesTabs)

    boxesTabsArray.splice(index, 1);
    boxesTabsArray.forEach((ep) => {
      ep.classList.remove('active')
    })

    buttonsTabs[index].classList.add('active');

    let buttonsTabsArray = Array.from(buttonsTabs)

    buttonsTabsArray.splice(index, 1);
    buttonsTabsArray.forEach((ep) => {
      ep.classList.remove('active')
    })

    const detailsButton = document.querySelectorAll('.b-protocol__details-button');
    const detailsBox = document.querySelectorAll('.b-protocol__details-box');
    detailsButton.forEach((e) => {
      e.classList.remove('active');
    })
    detailsBox.forEach((e) => {
      e.classList.remove('active');
    })
  });
});

// выпадающий список в фильтре

const details = document.querySelectorAll('.details');
details.forEach((e) => {
  const summary = e.querySelector('.summary');
  const subMenu = e.querySelectorAll('.sub-menu');
  summary.addEventListener('click', function () {
    summary.classList.toggle('summary-open');
    for (let i = 0; i < subMenu.length; i++) {
      subMenu[i].classList.toggle('details-open');
    }
  })
})

// мобильный фильтр

if (document.querySelector('.categ-1-categ__catalog-button')) {
  const filterButton = document.querySelector('.categ-1-categ__catalog-button');
  const filterClose = document.querySelector('.categ-1-categ__filteres-close');
  const filter = document.querySelector('.categ-1-categ__filter');

  filterButton.addEventListener('click', () => {
    filter.classList.add('categ-1-categ__filter_open');
    body.classList.add('body-overflow');
    html.classList.add('body-overflow');
  })

  filterClose.addEventListener('click', () => {
    filter.classList.remove('categ-1-categ__filter_open');
    body.classList.remove('body-overflow');
    html.classList.remove('body-overflow');
  })
}

// range slider ползунок
if (document.getElementById('sliderPrice')) {
  const slider = document.getElementById('sliderPrice');
  const rangeMin = parseInt(slider.dataset.min);
  const rangeMax = parseInt(slider.dataset.max);
  const step = parseInt(slider.dataset.step);
  const filterInputs = document.querySelectorAll('input.filter__input');

  noUiSlider.create(slider, {
    start: [rangeMin, rangeMax],
    connect: true,
    step: step,
    range: {
      'min': rangeMin,
      'max': rangeMax
    },

    // make numbers whole
    format: {
      to: value => value,
      from: value => value
    }
  });

  // bind inputs with noUiSlider 
  slider.noUiSlider.on('update', (values, handle) => {
    filterInputs[handle].value = values[handle];
  });

  filterInputs.forEach((input, indexInput) => {
    input.addEventListener('change', () => {
      slider.noUiSlider.setHandle(indexInput, input.value);
    })
  });
}

// select сортировки товаров

if (document.querySelector('.b-header__currency')) {
  const currency = document.querySelector('.b-header__currency');
  const currencyMenu = document.querySelector('.b-header__currency-menu');
  const currencyNow = document.querySelector('.b-header__currency-now');
  const currencyType = document.querySelectorAll('.b-header__currency-type');

  currency.addEventListener('click', function () {
    currency.classList.toggle('b-header__currency_open')
    currencyMenu.classList.toggle('display_flex')
  });

  currencyType.forEach(element => currencyChoice(element));
  function currencyChoice(item) {
    item.addEventListener('click', function (event) {
      let currencyTypeContent = event.target.textContent;
      currencyNow.textContent = currencyTypeContent;
    });
  }
}

// добавить в избранное

if (document.querySelector('.sd-card__favorite')) {
  const favorite = document.querySelectorAll('.sd-card__favorite');

  favorite.forEach((e) => {
    e.addEventListener('click', () => {
      e.classList.toggle('active');
    });
  });
}

// карта
(function () {
  if (!document.getElementById("map")) return;

  const map_wrapper = document.getElementById("map");
  const coords = map_wrapper.getAttribute('data-coordinates');
  const zoom = map_wrapper.getAttribute('data-zoom');
  const address = map_wrapper.getAttribute('data-address');
  const icon = map_wrapper.getAttribute('data-icon');

  const coordArray = coords.split(',').map(Number);

  ymaps.ready(function () {
    var map = new ymaps.Map("map", {
      center: coordArray,
      zoom: zoom,
      scroll: false
    });

    map.behaviors.disable('scrollZoom');
    var shop_2 = new ymaps.Placemark(
      coordArray,
      {
        hintContent: address
      },
      {
        iconLayout: 'default#image',
        iconImageHref: icon,
        iconImageSize: [48, 60],
        iconImageOffset: [-20, -50]
      }
    );
    map.geoObjects.add(shop_2);
  });
})();


// Number-box +/-
// const plus = document.querySelectorAll(".number-plus");
// const minus = document.querySelectorAll(".number-minus");

// for (let i = 0; i < plus.length; i++) {
//   plus[i].addEventListener("click", function() {
//     let box = this.parentNode;
//     let input = box.querySelector(".input-small");
//     input.stepUp();
//     input.dispatchEvent(new Event('input'));
//   });
// }

// for (let i = 0; i < minus.length; i++) {
//   minus[i].addEventListener("click", function() {
//     let box = this.parentNode;
//     let input = box.querySelector(".input-small");
//     input.stepDown();
//     input.dispatchEvent(new Event('input'));
//   });
// }

// кнопка "Выбрать всё" в корзине
// if (document.querySelector('.checkbox-cart-all')) {
//   var checkboxAll = document.querySelector(".checkbox-cart-all");
//   var checkbox = document.querySelectorAll(".checkbox-cart");

//   checkboxAll.addEventListener('click', () => {
//     checkFluency()
//   })

//   function checkFluency() {
//     if (checkboxAll.checked != true) {
//       checkbox.forEach((item) => {
//         item.checked = false;
//       })
//     } else {
//       checkbox.forEach((item) => {
//         item.checked = true;
//       })
//     }
//   }
// }

// анимация
if (document.querySelector('.wow')) {
  wow = new WOW(
    {
      boxClass: 'wow',      // default
      animateClass: 'animated', // default
      offset: 0,          // default
      mobile: false,       // default
      live: true        // default
    }
  )
  wow.init();
}

// сортировка
(function () {
  if (!document.querySelector('.b-header__currency')) return;

  const currencyNow = document.querySelector('.b-header__currency-now');
  const currencyMenu = document.querySelector('.b-header__currency-menu');

  const default_form_orderby = document.querySelector('.woocommerce-ordering');
  const selectElement = default_form_orderby.querySelector('.orderby');

  // Скрываем стандартную форму сортировки
  default_form_orderby.style.display = 'none';

  // Инициализация
  updateCurrencyMenu();

  // Обновление при изменении значения в форме
  selectElement.addEventListener('change', updateCurrencyMenu);

  // Функция для обновления содержимого b-header__currency-menu
  function updateCurrencyMenu() {
    currencyMenu.innerHTML = ''; // Очистка содержимого

    // Добавление элементов из формы
    Array.from(selectElement.options).forEach(function (option) {
      const currencyType = document.createElement('a');

      currencyType.classList.add('b-header__currency-type');
      currencyType.textContent = option.textContent;
      currencyType.setAttribute('data-value', option.value);
      currencyMenu.appendChild(currencyType);

      if (option.getAttribute('selected')) {
        currencyNow.textContent = option.textContent;
      }

      // Обработка клика на элементе в b-header__currency-menu
      currencyType.addEventListener('click', function () {
        // Установка выбранного значения в форме
        selectElement.value = option.value;
        // Обновление выбранного элемента в currencyNow
        currencyNow.textContent = option.textContent;
        default_form_orderby.submit();
      });
    });
  }
})();

// корзина
(function () {
  function dispatchQuantityChangeEvent() {
    const updateCartButton = document.querySelector('[name="update_cart"]');
    if (updateCartButton) {
      updateCartButton.removeAttribute('disabled');
      updateCartButton.dispatchEvent(new MouseEvent('click', { bubbles: true }));
    }
  }

  document.body.addEventListener('click', function (event) {
    const target = event.target;

    if (target.matches('button.number-plus, button.number-minus')) {
      const qty = target.parentElement.querySelector('input');
      const val = parseInt(qty.value);
      const min = parseInt(qty.getAttribute('min'));
      const max = parseInt(qty.getAttribute('max'));
      const step = parseInt(qty.getAttribute('step'));

      if (target.classList.contains('number-plus')) {
        qty.value = max && max <= val ? max : val + step;
      } else {
        qty.value = min && min >= val ? min : val > 1 ? val - step : 1;
      }

      dispatchQuantityChangeEvent();
    }

    if (target.classList.contains('number-plus') || target.classList.contains('number-minus')) {
      dispatchQuantityChangeEvent();
    }

    if (target.id === 'remove-selected-btn') {
      const checkedCheckboxes = document.querySelectorAll('.checkbox-cart:checked');

      checkedCheckboxes.forEach(function (checkbox) {
        const cartItem = checkbox.closest('.woocommerce-cart-form__cart-item');
        if (!cartItem) return;

        const qtys = cartItem.querySelectorAll('.qty');
        if (!qtys) return;

        qtys.forEach(function (qty) {
          qty.value = 0;
        })
      });

      setTimeout(() => {
        dispatchQuantityChangeEvent();
      }, 300);
    }
  });

  document.body.addEventListener('change', function (event) {
    const target = event.target;

    if (target.classList.contains('qty')) {
      dispatchQuantityChangeEvent();
    }

    if (target.classList.contains('checkbox-cart-all')) {
      const checkboxAll = document.querySelector(".checkbox-cart-all");
      const checkboxes = document.querySelectorAll(".checkbox-cart");

      if (checkboxAll.checked != true) {
        checkboxes.forEach((item) => {
          item.checked = false;
        })
      } else {
        checkboxes.forEach((item) => {
          item.checked = true;
        })
      }
    }
  });
})();