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
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>Document</title>
</head>

<?
use src\core\models\Flowers;
$flowers = Flowers::getCategory();
?>

<body>
    <? require_once __DIR__ . '/components/header.php' ?>

   
    <style>
   
   .catalog__banner p {
    position: absolute;
    bottom: 25%;
    margin-left: 60%;
    color: #fff0f5;
    text-shadow: 4px 4px 14px #D16E82;
}


.catalog__banner {
    background: linear-gradient(#D98F9840, #D98F9840), url(/img/b1.jpg) center no-repeat;
    background-size: 100% auto;
    background-position: 50% 80%;
    height: 450px;
    font-weight: 200;
    font-size: 48px;
    line-height: 58px;
    text-align: center;
    text-shadow: 4px 4px 14px #D16E82;
    box-sizing: border-box;
    padding-left: 250px;
    padding-top: 10px;
}
</style>

    <section class="catalog__banner">
        <p>Здесь <br>
            вы найдете свой <br>
            идеальный подарок</p>
    </section>
    

    <h1>
        <?= $_GET['category'] ?>
    </h1>

    <section class="home__list" style="margin-bottom: 20px;">
        <?php foreach ($flowers as $flower): ?>
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

    <? require_once __DIR__ . '/components/footer.php' ?>

    
</body>

<script>
    const itemsData = <?= json_encode($flowers) ?>;
</script>
<script src="/js/cart.js"></script>
<script src="/js/popupCart.js"></script>

</html>