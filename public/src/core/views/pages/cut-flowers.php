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
use src\core\models\Flowers;
$popularFlowers = Flowers::getPopularFlowers()
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
    <section class="catalog__list cut-flowers">
        <a href="/catalog/cut-flowers/category?category=Роза" class="category__card">
            <p>Роза</p>
            <div class="img-container">
                <img src="/img/3f07c10cee2203c3e6f9bad989ecbррdcc.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/cut-flowers/category?category=Хризантема" class="category__card">
            <p>Хризантема</p>
            <div class="img-container">
                <img src="/img/c4d5e9dad852ef4316497de99e63f551.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/cut-flowers/category?category=Гипсофила" class="category__card">
            <p>Гипсофила</p>
            <div class="img-container">
                <img src="/img/694c857321c07a4c92ea2315a80cfaa9.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/cut-flowers/category?category=Эустома" class="category__card">
            <p>Эустома</p>
            <div class="img-container">
                <img src="/img/249276b1e151424e7e563bb731c64b5b.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/cut-flowers/category?category=Лилия" class="category__card">
            <p>Лилия</p>
            <div class="img-container">
                <img src="/img/953bf5c5bbdb3c9028af2505feb2d1d2.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/cut-flowers/category?category=Альстромерия" class="category__card">
            <p>Альстромерия</p>
            <div class="img-container">
                <img src="/img/1ee40afc9dce00cd7f9d97251d810394.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/cut-flowers/category?category=Пионы" class="category__card">
            <p>Пионы</p>
            <div class="img-container">
                <img src="/img/64c42679ec146abb78a900878697c758.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/cut-flowers/category?category=Диантус" class="category__card">
            <p>Гвоздика/Диантус</p>
            <div class="img-container">
                <img src="/img/bf479a48a21715d05153d9b34aed9135.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/cut-flowers/category?category=Гербера" class="category__card">
            <p>Гербера</p>
            <div class="img-container">
                <img src="/img/c1005fcb98a5f9b03d2b0f3cd60ac177.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/cut-flowers/category?category=Гортензия" class="category__card">
            <p>Гортензия</p>
            <div class="img-container">
                <img src="/img/65dddfdfbafa8ce34d07f1221a1dc9fc.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/cut-flowers/category?category=Декоративная зелень" class="category__card">
            <p>Декоративная зелень</p>
            <div class="img-container">
                <img src="/img/e09ffe2450446342f61af8567040aee8.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/cut-flowers/category?category=Сезонные цветы" class="category__card">
            <p>Сезонные цветы</p>
            <div class="img-container">
                <img src="/img/9d551c0887cf063dee89a0ea9d2d3e2b.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
        <a href="/catalog/cut-flowers/category?category=Редкие цветы" class="category__card">
            <p>Редкие цветы</p>
            <div class="img-container">
                <img src="/img/3f07c10cee2203c3e6f9bad989ecbdcc.jpg" alt="">
                <div class="link">Перейти</div>
            </div>
        </a>
    </section>

    <h1 class="align-right">Популярные товары</h1>

    <section class="home__list home__popular" style="margin-bottom: 40px;">
        <?php foreach ($popularFlowers as $flower): ?>
            <div class="item-card" data-type="flower">
                <div data-id="<?= $flower['id'] ?>" data-type="flower" class="img-container item-card__image">
                    <img src="/<?= $flower['image_1'] ?>" alt="">
                </div>
                <div class="item-card__name" data-id="<?= $flower['id'] ?>" data-type="flower">
                    <?= $flower['name'] ?>
                </div>
                <p class="item-card__price">
                    <?= $flower['price'] ?> руб.
                </p>
                <div class="item-card__details" data-id="<?= $flower['id'] ?>" data-type="flower"></div>
                <button class="add-to-cart">
                    <p>Добавить в корзину</p>
                </button>
                <div class="counterContainer counter" data-product-id="<?= $flower['id'] ?>" style="display: none;">
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
        const itemsData = <?= json_encode($popularFlowers) ?>;
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