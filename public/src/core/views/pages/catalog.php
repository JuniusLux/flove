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

<body>
    <? require_once __DIR__ . '/components/header.php' ?>
    <a href="/catalog/bouquets">
        <section class="catalog__section">
            <div class="img-container">
                <img src="/img/catalog11.jpg" alt="" style="object-position: 0% 40%;">
            </div>
            <div class="catalog__section__info">
                <p>Готовые <br> букеты и корзины</p>
            </div>
        </section>
    </a>
    <a href="/catalog/cut-flowers">
    <section class="catalog__section">
        <div class="catalog__section__info">
            <p>Срезанные <br> цветы</p>
        </div>
        <div class="img-container">
            <img src="/img/catalog2.jpg" alt="" style="object-position: 0% 80%;">
        </div>
    </section>
    </a>
    <a href="/catalog/packaging">
        <section class="catalog__section">
            <div class="img-container">
                <img src="/img/catalog3.jpg" alt="" style="object-position: 0% 90%;">
            </div>
            <div class="catalog__section__info">
                <p style="margin-left: -200px">Упаковка <br> <span>и</span> <br> <span><span>ленточки</span></span>
                </p>
            </div>
        </section>
    </a>

    <style>
        .catalog__section .img-container {
            height: 100%;
            width: 675px;
            box-shadow: 7px 0px 20px 0px rgba(78, 96, 96, 0.5),
                -7px 0px 10px 0px rgba(78, 96, 96, 0.5);

            position: relative;
        }

        .catalog__section {
            width: 100%;
            background: linear-gradient(0deg, #4E6060 0%, rgba(78, 96, 96, 0.1) 100%);
            height: 550px;
            box-shadow: 0px 7px 10px 0px rgba(78, 96, 96, 0.5);
            display: flex;
            font-weight: 200;
        }
    </style>



    <? require_once __DIR__ . '/components/footer.php' ?>
    <script src="/js/cart.js"></script>
<script src="/js/popupCart.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="/slick/slick.min.js"></script>x
</body>

</html>