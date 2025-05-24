<!DOCTYPE html>
<html lang="en">

<head>
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
$popularBouquets = Bouquets::getPopularBouquets();
?>

<body>
    <? require_once __DIR__ . '/components/header.php' ?>

    <section class="catalog__banner">
        <p>самые добрые<br>
            флористы в городе<br>
            уже ждут твой заказ</p>
        <a href="/about">Узнать больше о нас</a>
    </section>
    <style>
    .catalog__banner {
    height: 60vh;
    background: url(../img/bouq_baner.png) center no-repeat;
    background-size: 100% auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    font-size: 30px;
    position: relative;
}

.catalog__banner p {
    position: absolute;
    bottom: 45%;
    margin-left: 10%;
    color: #D16E82;
    text-shadow: 4px 4px 14px #D16E82;
}

.catalog__banner a {
    position: absolute;
    font-size: 24px;
    border: 3px solid #FFFFFF;
    border-radius: 37px;
    background: #4E606099;
    padding: 1px 10px;
    bottom: 10%;
    margin-left: 10%;
}
</style>
    <section class="catalog__list">
        <a href="/catalog/bouquets/category?category=Популярные" class="category__card">
            <p>Популярные</p>
            <div class="img-container">
                <img src="/img/43d7671735ba12136b4f32e1ffb01721.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/bouquets/category?category=Тренды лета 2025" class="category__card">
            <p>Тренды лета 2025</p>
            <div class="img-container">
                <img src="/img/31fbe88aa162ebe6ec3d72eef606335b.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/bouquets/category?category=Свадебные" class="category__card">
            <p>Свадебные</p>
            <div class="img-container">
                <img src="/img/e013aaа95ec5d388eef9c8082b645a410.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/bouquets/category?category=Корзинки/композиции" class="category__card">
            <p>Корзинки/композиции</p>
            <div class="img-container">
                <img src="/img/3ad2f798a3a6fcbf19a1ea4a6d3c7697.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/bouquets/category?category=До 2.000 рублей" class="category__card">
            <p>До 2.000 рублей</p>
            <div class="img-container">
                <img src="/img/до 2.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/bouquets/category?category=До 3.500 рублей" class="category__card">
            <p>До 3.500 рублей</p>
            <div class="img-container">
                <img src="/img/до 35.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/bouquets/category?category=До 5.000 рублей" class="category__card">
            <p>До 5.000 рублей</p>
            <div class="img-container">
                <img src="/img/bee5d8c6bfdb8a672ada1b81befa294e.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/bouquets/category?category=От 5.000 рублей" class="category__card">
            <p>От 5.000 рублей</p>
            <div class="img-container">
                <img src="/img/от 5.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
    </section>

    <h1 class="align-right">Популярные товары</h1>

    <section class="home__list home__popular" style="margin-bottom: 40px;">
        <?php foreach ($popularBouquets['bouquets'] as $bouquet): ?>
            <div class="item-card" data-type="bouquet">
                <div data-id="<?= $bouquet['id'] ?>" data-type="bouquet" class="img-container item-card__image">
                    <img src="<?= $bouquet['image'] ?>" alt="">
                </div>
                <div class="item-card__name" data-id="<?= $bouquet['id'] ?>" data-type="bouquet">
                    <?= $bouquet['name'] ?>
                </div>
                <p class="item-card__price">
                    <?= $bouquet['price'] ?> руб.
                </p>
                <div class="item-card__details" data-id="<?= $bouquet['id'] ?>" data-type="bouquet">
                </div>
                <button class="add-to-cart">
                    <p>Добавить в корзину</p>
                </button>
                <div class="counterContainer counter" data-product-id="<?= $bouquet['id'] ?>" style="display: none;">
                    <button class="minus">-</button>
                    <div class="number">1</div>
                    <button class="plus">+</button>
                </div>
            </div>

        <?php endforeach; ?>
    </section>

    <section class="overlay hidden" id="overlay">
        <div id="popup-content" class="item-popup">
        </div>
    </section>

    <script>
        const itemsData = <?= json_encode($popularBouquets['bouquets']) ?>;
        const flowersData = <?= json_encode($popularBouquets['flowers']) ?>;
    </script>
    <script src="/js/cart.js"></script>
    <script src="/js/popupCart.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/slick/slick.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.home__popular').slick({
                slidesToShow: 4,
                slidesToScroll: 4
            });
        });
    </script>

    <? require_once __DIR__ . '/components/footer.php' ?>
</body>

</html>