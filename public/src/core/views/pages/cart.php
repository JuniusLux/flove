<!DOCTYPE html>
<html lang="en">

<head>
    <script src="/js/cart.js"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Italiana&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/slick/slick.css" />
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>Document</title>
</head>

<?

use src\core\models\Bouquets;
use src\core\models\Flowers;
use src\core\models\Packaging;

$bouquets = Bouquets::getBouquets();
$flowers = Flowers::getFlowers();
$packagings = Packaging::getPackaging();
$popularPackagings = Packaging::getPopularPackaging();
function generateDeliveryTimeOptions($start = '08:00', $end = '20:00', $stepMinutes = 30)
{
    $options = [];

    // Преобразуем время в timestamp
    $startTime = strtotime($start);
    $endTime = strtotime($end);

    // Генерируем варианты
    for ($time = $startTime; $time <= $endTime; $time += $stepMinutes * 60) {
        $formattedTime = date('H:i', $time);
        $options[] = "<option value=\"$formattedTime\">$formattedTime</option>";
    }

    return implode("\n", $options);
}
?>

<body>
    <? require_once __DIR__ . '/components/header.php' ?>

    <div class="cart__header__container">
        <h1 class="cart__header" style="font-size: 41px">Корзина</h1>
    </div>

    <section class="cart">
        <div class="cart__items" id="cartItems">
        </div>

        <div class="cart__checkout">

            <form action="/order" method="post" class="cart__checkout__form" id="orderForm">
                <input type="hidden" id="cartDataInput" name="cart_data" value="" />
                <p class="cart__checkout__address">
                    г.Красноярск, ул.Свердловская 141/1
                </p>
                <div class="cart__checkout__group">
                    <p class="cart__checkout__header">Способ получения</p>
                    <div class="cart__checkout__input">
                        <input type="radio" name="delivery_method" id="self" value="self" checked><label
                            for="self">Самовывоз</label>
                    </div>
                    <div class="cart__checkout__input">
                        <input type="radio" name="delivery_method" id="delivery" value="delivery"><label
                            for="delivery">Доставка
                            (+300 рублей)</label>
                    </div>
                </div>
                <div class="cart__checkout__input" style="display: none;">
                    <input type="text" name="address" id="" placeholder="Ваш адрес" style="width: 100%;"><img
                        src="svg/home.svg" alt="">
                </div>
                <div class="cart__checkout__group">
                    <p class="cart__checkout__header">Способ оплаты:</p>
                    <div class="cart__checkout__input">
                        <input type="radio" name="pay" id="Cash" checked value="cash">
                        <label for="Cash">Наличными</label>
                        <input type="radio" name="pay" id="card" checked value="card" required>
                        <label for="Cash">Картой</label>
                    </div>
                </div>
                <div class="cart__checkout__group">
                    <label for="time">Выберите время доставки:</label>
                    <select name="time" id="time" required>
                        <option value="" class="cart__checkout__input">-- Выберите время --</option>
                        <?= generateDeliveryTimeOptions() ?>
                    </select>
                </div>
                <textarea name="comment" id="comment" placeholder="Оставьте комментарий к заказу"></textarea>
                <input type="hidden" name="order" id="order">
                <p id="totalItems">Товаров: 2 шт.</p>
                <p class="checkout__price__total" id="totalPrice" name="total">Итого: <b>7000 ₽</b></p>
                <h1><?php if (isset($_GET['message'])): ?>
                        <?= $_GET['message'] ?>
                    <?php endif; ?>
                </h1>
                <button type="submit" class="item-card__name"
                    data-type="message" id="cartButton">Оформить заказ</button>
            </form>
        </div>

    </section>

    <h1>Упаковка</h1>
    <section class="catalog__slider packaging" style="">
        <?php foreach ($popularPackagings as $packaging): ?>
            <div class="packaging-card item-card" data-type="package">
                <p>"<?= $packaging['name'] ?>"
                </p>
                <div class="img-container">
                    <img src="<?= $packaging['image'] ?>" alt="" class="current-image">
                </div>
                <div class="item-card__details" data-id="<?= $packaging['id'] ?>"></div>
                <button class="add-to-cart">
                    Добавить в корзину
                </button>
            </div>
        <?php endforeach; ?>

    </section>

    <div class="cart__header__container" style="margin-top: -20px; margin-bottom: 40px;">
        <h1 class="cart__header" style="font-size: 36px; margin: 0px;"><a href="/catalog/packaging" style="text-decoration: underline;">Перейти в каталог упаковки</a></h1>
    </div>

    <section class="overlay hidden" id="overlay">
        <div id="popup-content" class="item-popup">
        </div>
    </section>

     <script>
        const data = {
            bouquets: <?= json_encode($bouquets['bouquets']) ?>,
            flowers: <?= json_encode($flowers) ?>,
            packagings: <?= json_encode($packagings) ?>
        };
    </script>
    <script src="/js/cart.js"></script>
    <script src="/js/viewCart.js"></script>
    <script src="/js/popupCart.js"></script>

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/slick/slick.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.catalog__slider').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 4
            });
        });
    </script>


    <? require_once __DIR__ . '/components/footer.php' ?>
</body>

</html>