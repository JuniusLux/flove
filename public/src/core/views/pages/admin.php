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
use src\core\models\Packaging;


$bouquets = Bouquets::getBouquets();
$flowers = Flowers::getFlowers();
$packagings = Packaging::getPackaging();
$flower_categories = Flowers::getFlowersCategories();
$bouquet_categories = Bouquets::getBouquetsCategories();
?>

<body>
    <? require_once __DIR__ . '/components/header.php' ?>

    <h1>Поиск</h1>
    <form method="get" action="/admin" class="admin__addForm">
        <input type="text" name="search" placeholder="Введите слово для поиска">
        <button type="submit" class="add-to-cart">Искать</button>
    </form>

    <style>
        input,
textarea,
select,
option {
    background: none;
    border: none;
    border-bottom: 2px solid #E4ABAA;
    font-size: 28px;
    color: #000000;
    padding: 0px 32px;
    box-sizing: border-box;
    font-family: "Inter";
    font-weight: 200;
}
</style>

    <h1><?php if (isset($_GET['message'])): ?>
            <?= $_GET['message'] ?>
        <?php endif; ?>
    </h1>

    <section class="admin">
        <h1>Цветы</h1>
        <form action="/addFlower" method="post" class="admin__addForm">
            <input type="text" name="name" id="" placeholder="Название">
            <input type="number" name="price" id="" placeholder="Цена">
            <select name="category" id="">
                <?php foreach ($flower_categories as $category): ?>
                    <option value="<?= $category['id'] ?>">
                        <?= $category['category_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="add-to-cart">Добавить цветок</button>
        </form>
        <div class="admin__flowers">
            <?php foreach ($flowers as $flower): ?>
                <form method="post" action="/deleteFlower" class="item-card"
                    onsubmit="return confirm('Вы уверены, что хотите удалить товар?');">
                    <a href="/admin/flower?flower=<?= $flower['id'] ?>" class="img-container item-card__image">
                        <img src="<?= $flower['image_1'] ?>" alt="<?= $flower['name'] ?>">
                    </a>
                    <a href="/admin/flower?flower=<?= $flower['id'] ?>" class="item-card__name">
                        <?= $flower['name'] ?>
                    </a>
                    <p class="item-card__price">
                        <?= $flower['price'] ?> руб.
                    </p>
                    <a href="/admin/flower?flower=<?= $flower['id'] ?>" class="item-card__details">
                    </a>

                    <input type="hidden" name="id" value="<?= $flower['id'] ?>">
                    <button class="add-to-cart" type="submit" style="background: red">
                        <p>Удалить товар</p>
                    </button>
                </form>
            <?php endforeach; ?>
        </div>
        <h1>Букеты</h1>
        <form action="/addBouquet" method="post" class="admin__addForm">
            <input type="text" name="name" id="" placeholder="Название">
            <input type="number" name="price" id="" placeholder="Цена">
            <select name="category" id="">
                <?php foreach ($bouquet_categories as $category): ?>
                    <option value="<?= $category['id'] ?>">
                        <?= $category['category_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="add-to-cart">Добавить цветок</button>
        </form>
        <div class="admin__bouquets">
            <?php foreach ($bouquets['bouquets'] as $bouquet): ?>
                <form method="post" action="/deleteBouquet" class="item-card"
                    onsubmit="return confirm('Вы уверены, что хотите удалить товар (id = <?= $bouquet['id'] ?>)?');">
                    <input type="hidden" name="id" value="<?= $bouquet['id'] ?>">
                    <a href="/admin/bouquet?bouquet=<?= $bouquet['id'] ?>" data-id="<?= $bouquet['id'] ?>" data-type="bouquet" class="img-container item-card__image">
                        <img src="<?= $bouquet['image'] ?>" alt="">
                    </a>
                    <a href="/admin/bouquet?bouquet=<?= $bouquet['id'] ?>" class="item-card__name">
                        <?= $bouquet['name'] ?>
                    </a>
                    <p class="item-card__price">
                        <?= $bouquet['price'] ?> руб.
                    </p>

                    <button class="add-to-cart" type="submit" style="background: red">
                        <p>Удалить товар</p>
                    </button>
                </form>
            <?php endforeach; ?>
        </div>

        <h1>Упаковка</h1>
        <form action="/addPackaging" method="post" class="admin__addForm">
            <input type="text" name="name" id="" placeholder="Название">
            <input type="number" name="price" id="" placeholder="Цена">
            <button type="submit" class="add-to-cart">Добавить цветок</button>
        </form>
        <div class="admin__bouquets">
            <?php foreach ($packagings as $packaging): ?>
                <form method="post" action="/deletePackaging" class="packaging-card item-card"
                    onsubmit="return confirm('Вы уверены, что хотите удалить товар (id = <?= $packaging['id'] ?>)?');">
                    <input type="hidden" name="id" value="<?= $packaging['id'] ?>">
                    <p><a href="/admin/packaging?packaging=<?= $packaging['id'] ?>">"<?= $packaging['name'] ?>"
                        </a></p>
                    <a href="/admin/packaging?packaging=<?= $packaging['id'] ?>" class="img-container">
                        <img src="<?= $packaging['image'] ?>" alt="" class="current-image">
                    </a>
                    <div class="item-card__details" data-id="<?= $packaging['id'] ?>"></div>
                    <button class="add-to-cart" type="submit" style="background: red">
                        Удалить товар
                    </button>
                </form>
            <?php endforeach; ?>
        </div>
    </section>

    <? require_once __DIR__ . '/components/footer.php' ?>
</body>


</html>