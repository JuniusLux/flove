<header>
    <h1 class="header__logo">FLOVE</h1>
    <div class="header__buttons">
        <?php if (isset($_SESSION['user'])): ?>
            <form action="/quit" method="post">
                <button type="submit" id="quit" style="background: none; border: none;">
                    <img src="/svg/quit.svg" alt="">
                </button>
            </form>
        <?php else: ?>
            <a href="/login">
                <img src="/svg/профиль11.svg" alt="">
            </a>
        <?php endif; ?>
        <a href="/cart" id="cartCount" name="cartCount"><img src="/svg/cart.svg" alt="">
            <span class="cart-count">0</span></a>
    </div>

    <style>
        .header__buttons {
            position: absolute;
            top: 60px;
            right: 130px;
            display: flex;
            gap: 45px;
        }

        header {
            box-sizing: border-box;
            background: url(/img/background.jpg) center no-repeat;
            background-size: 100% auto;
            height: 170px;
            display: flex;
            align-items: center;
            flex-direction: column;
            position: relative;

        }
    </style>
    <nav>
        <a href="/">Главная</a>
        <a href="/catalog">Каталог</a>
        <a href="/about">О нас</a>

        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'): ?>
            <a href="/admin">Админ. панель</a>
            <a href="/orderPage">Заказы</a>
        <?php endif; ?>
    </nav>
</header>