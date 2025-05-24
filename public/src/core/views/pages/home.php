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
$allBouquets = Bouquets::getBouquets();
$bouquets = Bouquets::getCategory('Тренды лета 2025');
$popularBouquets = Bouquets::getPopularBouquets();
?>

<body>
    <? require_once __DIR__ . '/components/header.php' ?>
    
    <section class="home__banner">
        <div class="home__banner__container">
            <h1>Вот и наступило лето...</h1>
            <div class="home__banner__links">
                <div class="home__banner__link">
                    <p>Откройте для себя яркие и свежие букеты, наполненные ароматами солнечных дней. Наши букеты лета
                        2025 сочетают в себе уникальные цветы и современные стили.</p>
                    <a href="/catalog/bouquets/category?category=Тренды лета 2025">Букеты лета 2025</a>
                </div>
                <div class="home__banner__link">
                    <p>Приобретите растения <br> растущие только летом, <br> которые порадуют глаз и создадут летнюю атмосферу
                        свежести и уюта в вашем <br> доме.</p>
                    <a href="/catalog/cut-flowers/category?category=Сезонные цветы">Сезонные цветы</a>
                </div>
            </div>
        </div>
    </section>
    <style> .home__banner {
    height: 60vh;
    min-height: 450px;
    background: url(../img/banner1.jpg) center no-repeat;
    background-size: 100% auto;
    display: flex;
    justify-content: center;
    align-items: center;
} 
.home__banner__container{
    background: #EBE8E480;
    width: 965px;
    height: 75%;
    border-radius: 50px;
    position: relative;
    backdrop-filter: blur(5.5px);}

    
</style>
    <h1>Тренды лета 2025</h1>

    <section class="home__list">
        <?php foreach ($bouquets['bouquets'] as $bouquet): ?>
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


    <? require_once __DIR__ . '/components/footer.php' ?>
</body>

<script>
    const itemsData = <?= json_encode($allBouquets['bouquets']) ?>;
    const flowersData = <?= json_encode($allBouquets['flowers']) ?>;
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


</html>