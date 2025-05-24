// Менеджер корзины


const CartManager = {
  cart: JSON.parse(localStorage.getItem("cart")) || {
    bouquet: {},
    flower: {},
    package: {},
  },

  // Сохранение корзины
  updateCartStorage() {
    localStorage.setItem("cart", JSON.stringify(this.cart));
    console.log("Текущее состояние корзины:", this.cart);
  },

  // Обновление интерфейса всплывающих карточек
  updatePopupUI(item) {
    const productId = item.dataset.id; // Уникальный идентификатор товара
    const productType = item.dataset.type; // Тип товара: bouquet, flower, package
    const addButton = item.querySelector(".add-to-cart");
    const counter = item.querySelector(".counter");
    const counterNumber = counter.querySelector(".number");

    if (
      !productId ||
      !productType ||
      !addButton ||
      !counter ||
      !counterNumber
    ) {
      console.warn("Некорректная структура карточки товара:", item);
      return;
    }

    // Обновление текста кнопки и счетчика
    if (this.cart[productType] && this.cart[productType][productId]) {
      addButton.textContent = "Добавлено";
      counterNumber.textContent = this.cart[productType][productId];
    } else {
      addButton.textContent = "Добавить в корзину";
      counterNumber.textContent = 0;
    }

    // Счетчик всегда виден
    counter.style.display = "flex";
  },

  // Добавление товара в корзину
  addToCart(item) {
    console.log( 'mfcgfnb' + isAuthorized)

    const productId = item.dataset.id;
    const productType = item.dataset.type;

    if (!productId || !productType) {
      console.error("Не удалось определить ID или тип товара");
      return;
    }

    if (!this.cart[productType]) {
      console.error("Неизвестная категория товара:", productType);
      return;
    }

    this.cart[productType][productId] =
      (this.cart[productType][productId] || 0) + 1;
    this.updateCartStorage();
    this.updatePopupUI(item);
  },

  // Изменение количества товара
  changeQuantity(item, isIncrease) {
    const productId = item.dataset.id;
    const productType = item.dataset.type;

    if (!productId || !productType || !this.cart[productType]) {
      console.error("Не удалось определить ID или тип товара");
      return;
    }

    if (isIncrease) {
      this.cart[productType][productId] =
        (this.cart[productType][productId] || 0) + 1;
    } else {
      this.cart[productType][productId] = Math.max(
        (this.cart[productType][productId] || 1) - 1,
        0
      );
      if (this.cart[productType][productId] === 0) {
        delete this.cart[productType][productId];
      }
    }

    this.updateCartStorage();
    this.updatePopupUI(item);
  },

  // Добавление товара в корзину и переход на страницу корзины
  buyNow(item) {
    this.addToCart(item);
    window.location.href = "/cart";
  },
};

// Функции открытия и закрытия попапа
function openPopup() {
  document.getElementById("overlay").classList.remove("hidden");
}

function closePopup() {
  document.getElementById("overlay").classList.add("hidden");
}

// Обработчик кликов по карточкам
document.querySelectorAll(".item-card__name, .item-card__details, .item-card__image")
  .forEach((card) => {
    card.addEventListener("click", function () {
      const itemId = this.getAttribute("data-id");
      const itemType = this.getAttribute("data-type");

      console.log(`Clicked itemType: ${itemType}, itemId: ${itemId}`); // Лог для проверки

      const item = itemsData.find((i) => i.id == itemId);

      if (item) {
        let popupHTML = "";

        if (itemType === "bouquet") {
          // Попап для букета
          const bouquetId = item.id;

          // Создание HTML для списка цветов
          let flowersHTML = "";
          const sortedFlowers = flowersData
            .filter((flower) => flower.bouquet_id === bouquetId)
            .sort((a, b) => a.flower_name.localeCompare(b.flower_name));

          sortedFlowers.forEach((flower) => {
            flowersHTML += `<li>${flower.flower_name}</li>`;
          });
          popupHTML = `
                    <div class="item" data-id="${item.id}" data-type="bouquet">
                        <div class="img-container">
                            <img src="${item.image}" alt="">
                        </div>
                        <div class="item__info">
                            <p class="item__info__name">${item.name}</p>
                            <div class="item__info__buy">
                                <div class="horizontal">
                                    <p class="item__info__buy__price"><span>цена</span><b>${item.price} ₽</b></p>
                                    <div class="counter">
                                        <button class="minus">-</button>
                                        <div class="number">1</div>
                                        <button class="plus">+</button>
                                    </div>
                                </div>
                                <button class="add-to-cart">Добавить в корзину</button>
                                <button class="buy-now">Купить сейчас</button>
                            </div>
                            <div class="item__info__composition">
                                <p><b>В состав букета входят:</b></p>
                                <ul>${flowersHTML}</ul>
                            </div>
                        </div>
                    </div>`;
        } else if (itemType === "flower") {
          popupHTML = `
                    <div class="item" data-id="${item.id}" data-type="flower">
                        <div class="item__images">
                            <div class="img-container">
                                <img src="/${item.image_1}" alt="">
                            </div>
                            <div class="item__images__small">
                                <div class="img-container"><img src="/${item.image_1}" alt=""></div>
                                <div class="img-container"><img src="/${item.image_2}" alt=""></div>
                                <div class="img-container"><img src="/${item.image_3}" alt=""></div>
                                <div class="img-container"><img src="/${item.image_4}" alt=""></div>
                            </div>
                        </div>
                        <div class="item__info">
                            <p class="item__info__name">${item.name}</p>
                            <div class="item__info__buy">
                                <div class="horizontal">
                                    <p class="item__info__buy__price"><span>цена</span><b>${item.price} ₽</b></p>
                                    <div class="counter">
                                        <button class="minus">-</button>
                                        <div class="number">1</div>
                                        <button class="plus">+</button>
                                    </div>
                                </div>
                                <button class="add-to-cart">Добавить в корзину</button>
                                <button class="buy-now">Купить сейчас</button>
                            </div>
                            <div class="item__info__size">
                                <p><b>Размер:</b></p>
                                <ul>${item.size} см </ul>
                            </div>
                            <div class="item__info__country">
                                <p><b>Страна:</b></p>
                                <ul>${item.country}</ul>
                            </div>
                        </div>
                    </div>`;
        }

        document.getElementById("popup-content").innerHTML = popupHTML;
        openPopup();

        // Обновляем UI для попапа, показывая актуальное количество товара
        CartManager.updatePopupUI(
          document.querySelector(
            `.item[data-id="${item.id}"][data-type="${itemType}"]`
          )
        );
      }else if (itemType === "message"){
        alert('fsf')
      }
       else {
        console.log("Item not found in itemsData for itemId:", itemId); // Лог, если item не найден
      }
    });
  });

// Закрытие попапа при клике на overlay
document.getElementById("overlay").addEventListener("click", function (event) {
  if (event.target === this) {
    closePopup();
  }
});

// Закрытие попапа при нажатии на Escape
document.addEventListener("keydown", function (event) {
  if (event.key === "Escape") {
    closePopup();
  }
});

// Событие: добавление товара в корзину
document.addEventListener("click", (event) => {
  const addButton = event.target.closest(".add-to-cart");
  if (addButton) {
    const item = addButton.closest(".item");
    if (item) CartManager.addToCart(item);
  }
});

// Событие: покупка товара сейчас
document.addEventListener("click", (event) => {
  const buyNowButton = event.target.closest(".buy-now");
  if (buyNowButton) {
    const item = buyNowButton.closest(".item");
    if (item) CartManager.buyNow(item);
  }
});

// Событие: изменение количества товара
document.addEventListener("click", (event) => {
  const button = event.target.closest(".plus, .minus");
  if (button) {
    const counter = button.closest(".counter");
    const item = counter.closest(".item");
    if (item) {
      const isIncrease = button.classList.contains("plus");
      CartManager.changeQuantity(item, isIncrease);
    }
  }
});

