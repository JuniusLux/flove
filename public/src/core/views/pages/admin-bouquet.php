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
$bouquet = Bouquets::getBouquet();
$flowers = Flowers::getFlowers();
$categories = Bouquets::getBouquetsCategories();
?>

<body style="background: #F5F5F5 !important;">
    <? require_once __DIR__ . '/components/header.php' ?>
    <section class="admin">
        <h1><?php if (isset($_GET['message'])): ?>
                <?= $_GET['message'] ?>
            <?php endif; ?>
        </h1>
        <form class="item" method="post" action="/updateBouquet" enctype="multipart/form-data"
            style="border-radius: 0px;">
            <input type="hidden" name="id" value="<?= $bouquet['bouquet']['id'] ?>">
            <div class="admin__image">
                <div class="img-container">
                    <img src="<?= $bouquet['bouquet']['image'] ?>" alt="">
                </div>
                <input type="file" name="image" id="">
                <input type="hidden" name="current_image" value="<?= $bouquet['bouquet']['image'] ?>">
            </div>
            <div class="item__info">
                <p class="item__info__name">
                    <input type="text" name="name" value="<?= $bouquet['bouquet']['name'] ?>">
                </p>
                <div class="item__info__buy">
                    <p class="item__info__buy__price">
                        <span>Цена:</span>
                        <b><input type="number" name="price" value="<?= $bouquet['bouquet']['price'] ?>"> ₽</b>
                    </p>
                    <button type="submit" class="add-to-cart">Сохранить изменения</button>
                </div>
                <div class="item__info__country">
                    <p><b>Популярность:</b></p>
                    <input type="checkbox" name="is_popular" <?php if ($bouquet['bouquet']['is_popular'] == 1): ?>
                            checked
                        <?php endif; ?>>
                </div>

                <div class="item__info__country">
                    <p><b>Категория:</b></p>
                    <ul>
                        <select name="category" id="">
                            <?php foreach ($categories as $category): ?>
                                <option <?php if ($bouquet['bouquet']['category_name'] === $category['category_name']): ?>
                                        selected
                                    <?php endif; ?> value="<?= $category['id'] ?>">
                                    <?= $category['category_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </ul>
                </div>
                <div class="item__info__composition" style="margin-top: 20px;">
                    <p><b>Состав букета:</b></p>
                    <?php if(empty($bouquet['flowers'][0]['flower_name'])) : ?>
                        <p>В букете нет цветов</p>
                    <?php endif; ?>
                    <ul>
                        <?php foreach ($bouquet['flowers'] as $flower): ?>
                            <li class="existing" data-flower-id="<?= $flower['flower_id'] ?>">
                                <select name="existing_flower_<?= $flower['flower_id'] ?>">
                                    <?php foreach ($flowers as $option): ?>
                                        <option value="<?= $option['id'] ?>" <?= $flower['flower_id'] == $option['id'] ? 'selected' : '' ?>>
                                            <?= $option['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="button" class="remove-flower">Удалить</button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" id="add-flower" class="add-to-cart" style="margin-top: 20px">Добавить
                        цветок</button>
                </div>
            </div>
        </form>
    </section>

    <? require_once __DIR__ . '/components/footer.php' ?>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const compositionContainer = document.querySelector('.item__info__composition ul');

            // Удаление существующих цветов
            compositionContainer.querySelectorAll('.remove-flower').forEach((button) => {
                button.addEventListener('click', () => {
                    const li = button.closest('li');
                    li.querySelector('select').setAttribute('name', `remove_flower_${li.dataset.flowerId}`);
                    li.style.display = 'none';
                });
            });

            // Добавление новых цветов
            document.getElementById('add-flower').addEventListener('click', () => {
                const li = document.createElement('li');
                const timestamp = Date.now();
                li.innerHTML = `
            <select name="new_flower_${timestamp}">
                <?php foreach ($flowers as $option): ?>
                <option value="<?= $option['id'] ?>"><?= $option['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <button type="button" class="remove-flower">Удалить</button>
        `;
                compositionContainer.appendChild(li);

                li.querySelector('.remove-flower').addEventListener('click', () => {
                    compositionContainer.removeChild(li);
                });
            });
        });

    </script>

</body>


</html>