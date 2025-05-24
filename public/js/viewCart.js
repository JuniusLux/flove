const deliveryCost = 300; // Стоимость доставки
let isDelivery = false; // Флаг, выбран ли способ доставки

// Инициализация элементов формы
const cartItemsContainer = document.getElementById("cartItems");
const totalItemsElement = document.getElementById("totalItems"); // Товаров: X шт.
const totalPriceElement = document.getElementById("totalPrice"); // Итого: X ₽
const addressInputContainer = document.querySelector(".cart__checkout__input[style]"); // Блок с адресом
const deliveryRadios = document.querySelectorAll('input[name="delivery_method"]'); // Радио-кнопки для способа доставки

if (!cart) {
  cart = JSON.parse(localStorage.getItem("cart")) || {
    bouquet: {},
    flower: {},
    package: {},
  };
}

// Функция для поиска данных о товаре
function getProductData(type, id) {
  let dataset;
  switch (type) {
    case "bouquet":
      dataset = data.bouquets;
      break;
    case "flower":
      dataset = data.flowers;
      break;
    case "package":
      dataset = data.packagings;
      break;
    default:
      return null;
  }

  if (Array.isArray(dataset)) {
    return dataset.find((item) => item.id == id) || null;
  }

  console.error(`Unexpected dataset structure for type: ${type}`);
  return null;
}

// Функция для получения изображения
function getImageSrc(type, product) {
  switch (type) {
    case "bouquet":
    case "package":
      return product.image || "/img/placeholder.png";
    case "flower":
      return product.image_1 || "/img/placeholder.png";
    default:
      return "/img/placeholder.png";
  }
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
        <p class="cart-item__info__price">Цена: ${price} ₽</p>
        <p class="cart-item__info__price">Сумма: ${price * quantity} ₽</p>
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

// Функция для обновления отображения количества товаров и итоговой цены
function updateCartSummary() {
  let totalItems = 0;
  let totalPrice = 0;

  const categories = ["bouquet", "flower", "package"];
  categories.forEach((type) => {
    Object.entries(cart[type]).forEach(([id, quantity]) => {
      const product = getProductData(type, id);
      if (product) {
        totalItems += quantity;
        totalPrice += parseInt(product.price) * quantity; // Преобразуем цену в число
      }
    });
  });

  if (isDelivery) {
    totalPrice += deliveryCost;
  }

  totalItemsElement.textContent = `Товаров: ${totalItems} шт.`;
  totalPriceElement.innerHTML = `Итого: <b>${totalPrice} ₽</b>`;
}

// Функция для рендера корзины
function renderCart(items) {
  cartItemsContainer.innerHTML = ""; // Очистка текущего содержимого

  // Проверка, есть ли товары в корзине
  let hasItems = false;
  const categories = ["bouquet", "flower", "package"];
  categories.forEach((type) => {
    Object.entries(items[type]).forEach(([id, quantity]) => {
      const product = getProductData(type, id);
      if (product) {
        hasItems = true;
        const imgSrc = getImageSrc(type, product);
        renderCartItem(type, id, quantity, product.name, product.price, imgSrc);
      }
    });
  });

  // Если корзина пуста, выводим сообщение
  if (!hasItems) {
    cartItemsContainer.innerHTML = "<div class='cart__empty'><p>Ваша корзина пуста.</p><a href='/catalog'>Перейти в каталог</a></div>";
  } else {
    attachEventListeners();
  }
  updateCartSummary(); // Обновляем итоговые данные при рендере
}

// Обработка изменения количества товара
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

// Обработка удаления товара
function removeItem(cartItem) {
  const type = cartItem.dataset.type;
  const id = cartItem.dataset.id;

  delete cart[type][id];

  localStorage.setItem("cart", JSON.stringify(cart));
  renderCart(cart);
}

// Обработка изменения способа доставки
function handleDeliveryChange(event) {
  isDelivery = event.target.value === "delivery";
  addressInputContainer.style.display = isDelivery ? "block" : "none"; // Показываем/скрываем поле адреса
  updateCartSummary(); // Пересчитываем стоимость
}

// Привязываем события для доставки
deliveryRadios.forEach((radio) => radio.addEventListener("change", handleDeliveryChange));

// События для изменения количества и удаления
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

// Инициализация корзины
renderCart(cart);
