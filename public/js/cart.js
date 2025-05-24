  document.addEventListener("DOMContentLoaded", () => {
  updateCartCount();
});

// Инициализация корзины

const cart = JSON.parse(localStorage.getItem("cart")) || {
  bouquet: {},
  flower: {},
  package: {},
};

function updateCartCount() {
  const cartCountElement = document.getElementById("cartCount");
  if (cartCountElement) {
    const countText = cartCountElement.querySelector(".cart-count");
    if (countText) {
      const cartData = localStorage.getItem("cart");
      let cart = {};
      if (cartData) {
        try {
          cart = JSON.parse(cartData);
        } catch (e) {
          console.error("Ошибка парсинга корзины:", e);
        }
      }

      let totalCount = 0;
      for (const type in cart) {
        const items = cart[type];
        for (const id in items) {
          totalCount += parseInt(items[id], 10);
        }
      }

      countText.textContent = totalCount > 0 ? `${totalCount}` : '(0)';
    } else {
      console.warn("Элемент .cart-count не найден");
    }
  } else {
    console.warn("Элемент #cartCount не найден");
  }
}

// Функции открытия и закрытия попапа
function openPopup() {
  document.getElementById("overlay").classList.remove("hidden");
}

function closePopup() {
  document.getElementById("overlay").classList.add("hidden");
}


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


document.addEventListener("DOMContentLoaded", function () {
  // Обработчик отправки формы
  document.getElementById("orderForm").addEventListener("submit", function (event) {
    // Получаем данные из localStorage
    const cartData = localStorage.getItem("cart");

    let cart = {};
    if (cartData) {
      try {
        cart = JSON.parse(cartData);
      } catch (e) {
        console.error("Ошибка парсинга корзины:", e);
        cart = {};
      }
    }

    const form = document.getElementById("orderForm");

form.addEventListener("submit", function (event) {

  if (localStorage.length !== 0) {
    popupHTML = ` <div class="item" data-type="bouquet">
                        <div class="item__info">
                            <div class="item__info__buy">
                                <div class="horizontal">
                                    <div class="counter">
                                        <h1>Ваш заказ успешно отправлен</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;

    document.getElementById("popup-content").innerHTML = popupHTML;
    openPopup();
      setTimeout(() => {
    }, 5000);
  }
});

    // Преобразуем в JSON строку и устанавливаем в hidden input
    const cartInput = document.getElementById("cartDataInput");
    if (cartInput) {
      cartInput.value = JSON.stringify(cart);
    } else {
      console.warn("Поле cartDataInput не найдено");
    }

    // Лог для отладки
    console.log("Корзина перед отправкой:", cart);
  });
});

function updateCartStorage() {
  localStorage.setItem("cart", JSON.stringify(cart));
  displayCartState();
  updateCartCount();
}

// Отображение текущего состояния корзины в консоли
function displayCartState() {
  console.log("Текущее состояние корзины:", cart);
}


// Обновление интерфейса
function updateUI() {
  document.querySelectorAll(".item-card").forEach((card) => {
    const productId = card.querySelector(".item-card__details")?.dataset.id;
    const productType = card.dataset.type;
    const addButton = card.querySelector(".add-to-cart");

    if (!productId || !productType || !addButton) {
      console.warn("Некорректная структура карточки товара", card);
      return;
    }

    if (card.classList.contains("packaging-card")) {
      // Логика для упаковок
      if (cart[productType] && cart[productType][productId]) {
        addButton.textContent = "Добавлено";
        addButton.classList.add("added");
      } else {
        addButton.textContent = "Добавить в корзину";
        addButton.classList.remove("added");
      }
      addButton.style.display = "block"; // Кнопка всегда видима для упаковок
    } else {
      // Логика для остальных типов
      const counter = card.querySelector(".counterContainer");
      if (!counter) {
        console.warn("Не найден счетчик для карточки товара:", card);
        return; // Пропускаем карточки без счетчика
      }

      if (cart[productType] && cart[productType][productId]) {
        addButton.style.display = "none";
        counter.style.display = "flex";
        counter.querySelector(".number").textContent =
          cart[productType][productId];
      } else {
        addButton.style.display = "block";
        counter.style.display = "none";
      }
    }
  });
}

// Добавление товара в корзину
document.addEventListener("click", (event) => {
  const addButton = event.target.closest(".add-to-cart");

  const user = document.getElementById('quit')
  if(!user){
    alert('Добавить в корзину товары можно после авторизации')
    return
  } 
  if (!addButton) return;

  const card = addButton.closest(".item-card");
  if (!card) return; // Проверка на наличие карточки товара

  const productId = card.querySelector(".item-card__details")?.dataset.id;
  const productType = card.dataset.type;

  if (!productId || !productType) {
    console.error("Не удалось определить ID или тип товара");
    return;
  }

  if (!cart[productType]) {
    console.error("Неизвестная категория товара:", productType);
    return;
  }

  if (card.classList.contains("packaging-card")) {
    // Для упаковок: добавляем только один раз
    if (!cart[productType][productId]) {
      cart[productType][productId] = 1;
    }
  } else {
    // Для остальных типов: увеличиваем количество
    cart[productType][productId] = (cart[productType][productId] || 0) + 1;
  }

  updateCartStorage();
  updateUI();
  updateCartCount();
});

// Изменение количества товара
document.addEventListener("click", (event) => {
  // Здесь надо будет !!!!!!!!!!!!!!!!
  const button = event.target.closest(".plus, .minus");
  if (!button) return;

  const counter = button.closest(".counterContainer");
  if (!counter) return; // Проверка на наличие счетчика

  const productId = counter?.dataset.productId;
  const card = counter.closest(".item-card");
  const productType = card?.dataset.type;

  if (!productId || !productType || !cart[productType]) {
    console.error("Не удалось определить ID или тип товара");
    return;
  }

  if (button.classList.contains("plus")) {
    cart[productType][productId] = (cart[productType][productId] || 0) + 1;
  } else if (button.classList.contains("minus")) {
    cart[productType][productId] = Math.max(
      (cart[productType][productId] || 1) - 1,
      0
    );
    if (cart[productType][productId] === 0) {
      delete cart[productType][productId];
    }
  }

  updateCartStorage();
  updateUI();
  updateCartCount();
});



// Синхронизация интерфейса при загрузке страницы
document.addEventListener("DOMContentLoaded", () => {
  updateUI();
  displayCartState();
  updateCartCount(); 

});

