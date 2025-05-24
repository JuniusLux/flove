// Функции открытия и закрытия попапа
function openPopup() {
  document.getElementById("overlay").classList.remove("hidden");
}

function closePopup() {
  document.getElementById("overlay").classList.add("hidden");
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
