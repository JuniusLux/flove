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
use src\core\models\packagings;
use src\core\models\Flowers;
use src\core\models\Packaging;
$packaging = Packaging::getSinglePackaging();
?>

<body style="background: #F5F5F5 !important;">
    <? require_once __DIR__ . '/components/header.php' ?>
    <section class="admin">
        <h1>
            <?php if (isset($_GET['message'])): ?>
                <?= $_GET['message'] ?>
            <?php endif; ?>
        </h1>
        <form class="item" method="post" action="/updatePackaging" enctype="multipart/form-data"
            style="border-radius: 0px;">
            <input type="hidden" name="id" value="<?= $packaging['id'] ?>">
            <div class="admin__image">
                <div class="img-container">
                    <img src="<?= $packaging['image'] ?>" alt="">
                </div>
                <input type="file" name="image" id="">
                <input type="hidden" name="current_image" value="<?= $packaging['image'] ?>">
            </div>
            <div class="item__info">
                <p class="item__info__name">
                    <input type="text" name="name" value="<?= $packaging['name'] ?>">
                </p>
                <div class="item__info__buy">
                    <p class="item__info__buy__price">
                        <span>Цена:</span>
                        <b><input type="number" name="price" value="<?= $packaging['price'] ?>"> ₽</b>
                    </p>
                    <button type="submit" class="add-to-cart">Сохранить изменения</button>
                </div>
                <div class="item__info__country" style="margin-bottom: 20px;">
                    <p><b>Популярность:</b></p>
                    <input type="checkbox" name="is_popular" <?php if ($packaging['is_popular'] == 1): ?>
                            checked
                        <?php endif; ?>>
                </div>
            </div>
        </form>
    </section>

    <? require_once __DIR__ . '/components/footer.php' ?>

</body>


</html>