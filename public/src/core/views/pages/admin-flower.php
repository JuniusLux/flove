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
use src\core\models\Bouquets;
use src\core\models\Flowers;
$bouquets = Bouquets::getBouquets();
$flower = Flowers::getFlower();
$categories = Flowers::getFlowersCategories();
?>

<body  style="background: #F5F5F5 !important;">
    <? require_once __DIR__ . '/components/header.php' ?>
    <section class="admin">
        <h1><?php if(isset($_GET['message'])) : ?>
            <?=$_GET['message']?>
        <?php endif; ?></h1>
        <form class="item" method="post" action="/updateFlower" style="border-radius: 0px;" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$flower['id']?>">
            <div class="item__images">
                <div class="img-container">
                    <img src="/<?= $flower['image_1'] ?>" alt="">
                </div>
                <div class="item__images__small">
                    <div class="admin_images">
                        <div class="img-container"><img src="/<?= $flower['image_1'] ?>" alt=""></div>
                        <input type="file" name="image_1" id="">
                        <input type="hidden" name="current_image_1" value="<?= $flower['image_1'] ?>">
                    </div>
                    <div class="admin_images">
                        <div class="img-container"><img src="/<?= $flower['image_2'] ?>" alt=""></div>
                        <input type="file" name="image_2" id="">
                        <input type="hidden" name="current_image_2" value="<?= $flower['image_2'] ?>">
                    </div>
                    <div class="admin_images">
                        <div class="img-container"><img src="/<?= $flower['image_3'] ?>" alt=""></div>
                        <input type="file" name="image_3" id="">
                        <input type="hidden" name="current_image_3" value="<?= $flower['image_3'] ?>">
                    </div>
                    <div class="admin_images">
                        <div class="img-container"><img src="/<?= $flower['image_4'] ?>" alt=""></div>
                        <input type="file" name="image_4" id="">
                        <input type="hidden" name="current_image_4" value="<?= $flower['image_4'] ?>">
                    </div>
                </div>
            </div>
            <div class="item__info">
                <input type="text" name="name" class="item__info__name" value="<?= $flower['name'] ?>">
                <div class="item__info__buy">
                    <div class="horizontal">
                        <p class="item__info__buy__price"><span>цена</span><b>
                                <input type="number" step="10" name="price" value="<?= $flower['price'] ?>" id="" style="width: 200px;"> ₽
                            </b></p>
                    </div>
                    <button class="add-to-cart">Сохранить изменения</button>
                </div>
                <div class="item__info__country" style="margin-bottom: 20px;">
                    <p><b>Популярность:</b></p>
                    <input type="checkbox" name="is_popular" <?php if ($flower['is_popular'] == 1): ?>
                            checked
                        <?php endif; ?>>
                </div>
                <div class="item__info__size">
                    <p><b>Размер:</b></p>
                    <ul>
                        <input type="number" step="10" name="size" value="<?= $flower['size'] ?>" id="">
                    </ul>
                </div>
                <div class="item__info__country">
                    <p><b>Страна:</b></p>
                    <ul>
                        <input type="text" name="country" value="<?= $flower['country'] ?>" id="">
                    </ul>
                </div>
                <div class="item__info__country">
                    <p><b>Категория:</b></p>
                    <ul>
                        <select name="category" id="">
                            <?php foreach( $categories as $category) : ?>
                                <option <?php if ($flower['category_name'] === $category['category_name']): ?>
                                        selected
                                    <?php endif; ?> value="<?= $category['id'] ?>">
                                    <?= $category['category_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </ul>
                </div>
            </div>
        </form>
    </section>

    <? require_once __DIR__ . '/components/footer.php' ?>
</body>


</html>