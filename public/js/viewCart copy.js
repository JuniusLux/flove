const cart = JSON.parse(localStorage.getItem("cart")) || {
  bouquet: {},
  flower: {},
  package: {},
};

// Функция для поиска данных о товаре
function getProductData(type, id) {
  // Используем вложенные данные
  let dataset;
  switch (type) {
    case 'bouquet':
      dataset = data.bouquets; // Обращение к массиву внутри объекта
      break;
    case 'flower':
      dataset = data.flowers;
      break;
    case 'package':
      dataset = data.packagings;
      break;
    default:
      return null;
  }

  // Проверяем, что dataset — массив, и ищем товар
  if (Array.isArray(dataset)) {
    return dataset.find((item) => item.id == id) || null;
  }

  console.error(`Unexpected dataset structure for type: ${type}`);
  return null;
}

// Функция для рендера одного элемента корзины
function renderCartItem(type, id, quantity, name, price, imgSrc) {
  const cartItem = document.createElement("div");
  cartItem.className = "cart-item";
  cartItem.dataset.type = type;
  cartItem.dataset.id = id;

  cartItem.innerHTML = `
    <div class="img-container">
        <img src="${imgSrc}" alt="${name}">
    </div>
    <div class="cart-item__info">
        <p class="cart-item__info__name">${name}</p>
        <p class="cart-item__info__price">${price} ₽</p>
        <div class="cart-item__info__buttons">
            <div class="counterContainer counter">
                <button class="minus">-</button>
                <div class="number">${quantity}</div>
                <button class="plus">+</button>
            </div>
            <button class="cart-item__delete"><img src="svg/trash.svg" alt="Удалить"></button>
        </div>
    </div>
  `;

  cartItemsContainer.appendChild(cartItem);
}

// Функция для получения изображения
function getImageSrc(type, product) {
  switch (type) {
    case 'bouquet':
    case 'package':
      return product.image || "/img/placeholder.png"; // Для букетов и упаковки
    case 'flower':
      return product.image_1 || "/img/placeholder.png"; // Для цветов
    default:
      return "/img/placeholder.png"; // Заглушка по умолчанию
  }
}

// Функция для обновления корзины в DOM
function renderCart(items) {
  cartItemsContainer.innerHTML = ""; // Очистка текущего содержимого

  const categories = ["bouquet", "flower", "package"];
  categories.forEach((type) => {
    Object.entries(items[type]).forEach(([id, quantity]) => {
      const product = getProductData(type, id);
      if (product) {
        // Получаем изображение в зависимости от типа товара
        const imgSrc = getImageSrc(type, product);
        renderCartItem(type, id, quantity, product.name, product.price, imgSrc);
      }
    });
  });

  attachEventListeners();
}

// Обработка событий
function attachEventListeners() {
  document.querySelectorAll(".cart-item .plus").forEach((button) => {
    button.addEventListener("click", (e) => {
      const cartItem = e.target.closest(".cart-item");
      updateQuantity(cartItem, 1);
    });
  });

  document.querySelectorAll(".cart-item .minus").forEach((button) => {
    button.addEventListener("click", (e) => {
      const cartItem = e.target.closest(".cart-item");
      updateQuantity(cartItem, -1);
    });
  });

  document.querySelectorAll(".cart-item .cart-item__delete").forEach((button) => {
    button.addEventListener("click", (e) => {
      const cartItem = e.target.closest(".cart-item");
      removeItem(cartItem);
    });
  });
}

// Обновление количества товара
function updateQuantity(cartItem, delta) {
  const type = cartItem.dataset.type;
  const id = cartItem.dataset.id;

  cart[type][id] = (cart[type][id] || 0) + delta;

  if (cart[type][id] <= 0) {
    delete cart[type][id];
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart(cart);
}

// Удаление товара
function removeItem(cartItem) {
  const type = cartItem.dataset.type;
  const id = cartItem.dataset.id;

  delete cart[type][id];

  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart(cart);
}

// Инициализация корзины
const cartItemsContainer = document.getElementById("cartItems");
renderCart(cart);
