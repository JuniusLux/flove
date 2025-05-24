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

<?php

use src\core\models\Bouquets;
use src\core\models\Flowers;
use src\core\models\Orders;
use src\core\models\Packaging;

$orders = Orders::getOrders();
?>

<body>
    <? require_once __DIR__ . '/components/header.php' ?>

    <div class="cart__header__container">
        <h1 class="cart__header" style="font-size: 41px">Заказы</h1>
    </div>

    <h1><?php if (isset($_GET['message'])): ?>
            <?= $_GET['message'] ?>
        <?php endif; ?>
    </h1>

    <table class="order-table">  
        <thead>
            <tr>
                <th>ID</th>
                <th>Пользователь</th>
                <th>Номер телефона</th>
                <th>Статус</th>
                <th>Время</th>
                <th>Комментарий</th>
                <th>Способ оплаты</th>
                <th>Доставка</th>
                <th>Заказ</th>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <?php
                    if($order['order_status'] == 'Новый') 
                        $class = 'green';
                    elseif($order['order_status'] == 'Подтвержден')
                        $class = 'basic';
                    elseif($order['order_status'] == 'Завершен')
                        $class = 'red';
                ?>
                <tr class='<?=$class?>'>

                    <td><?= $order['user_id'] ?></td>
                    <td><?= $order['user_name'] ?></td>
                    <td><?= $order['order_number'] ?></td>
                    <td><?= $order['order_status'] ?></td>
                    <td><?= $order['time'] ?></td>
                    <td><?= $order['comment'] ?></td>
                    <td><?= $order['pay'] == 'cash' ? 'Наличными' : 'Картой'?></td>
                    <td><?= $order['given'] == 'self' ? 'Самовывоз' : 'Доставка' ?></td>
                    <?php
                    $cartArray = json_decode($order['order_details'], true);
                    ?>
                    <td>
                        <h3>Цветы</h3>
                        <?php
                        foreach ($cartArray['flower'] as $key => $value):
                            $flower = Flowers::getFlower($key);
                        ?>
                            <p>
                                <?= $flower['name'] ?> <?= $value ?> штуки
                            </p>
                        <?php
                        endforeach;
                        ?>
                        <h3>Букеты</h3>
                        <?php foreach ($cartArray['bouquet'] as $key => $value):
                            $bouquet = Bouquets::getBouquet($key); ?>
                            <p>
                                <?= $bouquet['bouquet']['name'] ?> <?= $value ?> штуки
                            </p>
                        <?php
                        endforeach;
                        ?>
                        <h3>Упаковка</h3>
                        <?php foreach ($cartArray['package'] as $key => $value):
                            $bouquet = Packaging::getSinglePackaging($key); ?>
                            <p>
                                <?= $bouquet['name'] ?> <?= $value ?> штуки
                            </p>
                        <?php
                        endforeach;
                        ?>
                    </td>
                    <td>
                        <form action="/changeStatus" method="post">
                            <input type="hidden" value="<?= $order['order_id'] ?>" name="order_id">
                            <input type="hidden" value="Подтвержден" name="status">
                            <button type="submit" class="btn btn-approve">Подтвердить</button>
                        </form>
                    </td>
                    <td>
                        <form action="/changeStatus" method="post">
                            <input type="hidden" value="<?= $order['order_id'] ?>" name="order_id">
                            <input type="hidden" value="Завершен" name="status">
                            <button type="submit" class="btn btn-complete">Завершен</button>
                        </form>
                    </td>
                    <td>
                        <form action="/deleteOrder" method="post">
                            <input type="hidden" value="<?= $order['order_id'] ?>" name="order_id">
                            <button class="btn btn-delete" type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <? require_once __DIR__ . '/components/footer.php' ?>

    <script src="/js/cart.js"></script>
    <script src="/js/popupCart.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="/slick/slick.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.catalog__slider').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 4
            });
        });
    </script>
</body>

</html>