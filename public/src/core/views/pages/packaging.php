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
use src\core\models\Packaging;
$packagings = Packaging::getPackaging();
?>

<body>
    <? require_once __DIR__ . '/components/header.php' ?>

    <section class="catalog__banner">
        <p>Упаковка делает букет <br>
        еще более выразительным</p>
    </section>
    
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
    font-size: 42px;
    line-height: 58px;
    text-align: center;
    text-shadow: 4px 4px 14px #D16E82;
    box-sizing: border-box;
    padding-left: 250px;
    padding-top: 10px;
}
</style>
    <h1>Упаковка</h1>
    <div class="packaging__price__container">
        <h1 class="packaging__price">150 руб</h1>
    </div>
    <section class="catalog__slider packaging">
        <?php foreach ($packagings as $packaging): ?>
            <?php if ($packaging['price'] === '150'): ?>
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
            <?php endif; ?>
        <?php endforeach; ?>
    </section>

    <div class="packaging__price__container">
        <h1 class="packaging__price">250 руб</h1>
    </div>
    <section class="catalog__slider packaging">
        <?php foreach ($packagings as $packaging): ?>
            <?php if ($packaging['price'] === '250'): ?>
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

            <?php endif; ?>
        <?php endforeach; ?>
    </section>

    <h1>Ленты</h1>
    <div class="packaging__price__container">
        <h1 class="packaging__price">50 руб</h1>
    </div>
    <section class="catalog__slider packaging">
        <?php foreach ($packagings as $packaging): ?>
            <?php if ($packaging['price'] === '50'): ?>
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
            <?php endif; ?>
        <?php endforeach; ?>
    </section>

    <? require_once __DIR__ . '/components/footer.php' ?>

    <script src="/js/cart.js"></script>
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
</body>


</html>