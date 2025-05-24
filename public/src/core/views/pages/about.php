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


<body>
    <? require_once __DIR__ . '/components/header.php' ?>

    <section class="about__header">
        <div class="img-container"><img src="/img/about.png" alt=""></div>
        <div class="about__header__text">
            <img src="svg/FLOVE.svg" alt="">
            <p>Мы – ваш надежный цветочный магазин, где каждый букет создается с любовью и вниманием к деталям. Наша
                команда профессионалов стремится приносить радость и красоту в каждый дом, предлагая широкий ассортимент
                свежих цветов и уникальных композиций для любых событий. Мы заботимся о качестве и свежести наших
                растений, чтобы каждый ваш заказ стал настоящим произведением искусства.</p>
        </div>

       
       <style>
        .about__header{
    display: flex;
    justify-content: space-between;
    padding:  40px 250px;
    box-sizing: border-box;
    align-items: center;
}

.about__header .img-container{
    width: 635px;
    height: 450px;
    border-radius: 50px;
}

.about__header__text{
    width: 665px;
    font-size: 28px;
    line-height: 34px;
    color: #000000;
    text-shadow: 4px 4px 4px #00000050;
    font-weight: 200;
}

.about__header__text img{
    margin-bottom: 22px;
}


.about__why{
    display: flex;
    justify-content: space-between;
        padding: 20px 110px;
}

.why{
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #000000;
    gap: 20px;
}

.why p{
    width: 200px;
    text-align: center;
    font-size: 24px;
    text-shadow: 4px 4px 4px #00000050;
}

.packaging__price__container,
.cart__header__container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin-top: 0px;
    text-shadow: 4px 4px 4px #00000050;
}

.about__employees{
    display: flex;
    justify-content: space-between;
    padding: 0px 70px;
    box-sizing: border-box;
}

.employee{
    width: 300px;
    height: 430px;
    display: flex;
    flex-direction: column;
    align-items: center;
    font-size: 30px;
    color: #000000;
    text-shadow: 4px 4px 4px #00000050;
    gap: 15px;
    
}

.employee .img-container{
    border-radius: 35px;
}

.about__location{
    display: flex;
    justify-content: space-between;
    box-sizing: border-box;
    padding: 0px 250px;
    margin-top: 50px;
}

.about__location .img-container{
    width: 666px;
    height: 345px;
    border-radius: 50px;
}

.about__location__where{
    width: 550px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.about__locations{
    font-size: 24px;
    color: #000000;
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-left: 30px;
}
</style>


    </section>

    <div class="cart__header__container">
        <h1 class="cart__header" style="font-size: 41px">Почему именно мы?</h1>
    </div>

    <section class="about__why">
        <div class="why">
            <img src="/svg/about_flower.svg" alt="">
            <p>Поставка цветов 3 раза в неделю</p>
        </div>
        <div class="why">
            <img src="/svg/about_coins.svg" alt="">
            <p>Выгодные цены</p>
        </div>
        <div class="why">
            <img src="/svg/about_license.svg" alt="">
            <p>Сертифицированные флористы</p>
        </div>
        <div class="why">
            <img src="/svg/about_delivery.svg" alt="">
            <p>Доставка в течении часа</p>
        </div>
        <div class="why">
            <img src="/svg/about_sale.svg" alt="">
            <p>Новые акции каждую неделю</p>
        </div>
    </section>

    <h1>Наши флористы</h1>

    <section class="about__employees">
        <div class="employee">
            <div class="img-container"><img src="/img/f1.png" alt=""></div>
            <p>Сабина</p>
        </div>
        <div class="employee">
            <div class="img-container"><img src="/img/f4.png" alt=""></div>
            <p>Вероника</p>
        </div>
        <div class="employee">
            <div class="img-container"><img src="/img/v1.png" alt=""></div>
            <p>Роман</p>
        </div>
        <div class="employee">
            <div class="img-container"><img src="/img/k1.png" alt=""></div>
            <p>Екатерина</p>
        </div>
    </section>

    <section class="about__location">
        <div class="img-container"><img src="/img/a_location.png" alt=""></div>
        <div class="about__location__where">
            <h1>Где мы находимся?</h1>
            <div class="about__locations">
                <p>г.Красноярск, ул.Свердловская 141/1</p>
                <p>тел. +7 888 888 88 88</p>
                <p>Flovekrsk24@mail.ru</p>
            </div>
            <div class="maps">
                <a href="https://go.2gis.com/j0gq7"><img src="svg/2gis.svg" alt=""></a>
                <a href="https://maps.app.goo.gl/N3Ks2QVEvDvBDCMz5"><img src="svg/яндекс.svg" alt=""></a>
                <a href="https://yandex.ru/maps/-/CHENqUkr"><img src="svg/гугл марс.svg" alt=""></a>
            </div>
        </div>
    </section>

    <div class="about__map">
        <script type="text/javascript" charset="utf-8" async
            src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Af2b7738005a835fbec7fa8e2ad76099b4325bdc793d38175d4fba75e1631c588&amp;width=100%25&amp;height=462&amp;lang=ru_RU&amp;scroll=true"></script>
    </div>

    <? require_once __DIR__ . '/components/footer.php' ?>
    <script src="/js/cart.js"></script>
<script src="/js/popupCart.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="/slick/slick.min.js"></script>
</body>


</html>