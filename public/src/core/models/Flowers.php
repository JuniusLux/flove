<?php

namespace src\core\models;

use src\services\Connect;

class Flowers
{
    public static function getFlowers()
    {
        $searchWord = $_GET['search'] ?? '';
        $db = Connect::getConnect();

        if (empty($searchWord)) {
            $Flowers = $db->query("SELECT `flowers`.*, `flowers_pictures`.`image_1`, `flowers_pictures`.`image_2`, `flowers_pictures`.`image_3`, `flowers_pictures`.`image_4`  FROM `flowers`  LEFT JOIN `flowers_pictures` ON `flowers`.`id`=`flowers_pictures`.`flower_id`");
        } else {
            $Flowers = $db->query("SELECT `flowers`.*, `flowers_pictures`.`image_1`, `flowers_pictures`.`image_2`, `flowers_pictures`.`image_3`, `flowers_pictures`.`image_4`  FROM `flowers`  
            LEFT JOIN `flowers_pictures` ON `flowers`.`id`=`flowers_pictures`.`flower_id` 
            LEFT JOIN   `flowers_categories` ON `flowers`.`category` = `flowers_categories`.`id`
            WHERE name LIKE '%$searchWord%' 
            OR `flowers_categories`.`category_name` LIKE '%$searchWord%'");
        }

        $FlowerList = [];

        while ($Flower = mysqli_fetch_assoc($Flowers)) {
            $FlowerList[] = $Flower;
        }
        return ($FlowerList);
    }
    public static function getPopularFlowers()
    {
        $db = Connect::getConnect();
        $Flowers = $db->query('SELECT `flowers`.*, `flowers_pictures`.`image_1`, `flowers_pictures`.`image_2`, `flowers_pictures`.`image_3`, `flowers_pictures`.`image_4`  FROM `flowers`  LEFT JOIN `flowers_pictures` ON `flowers`.`id`=`flowers_pictures`.`flower_id` WHERE `flowers`.`is_popular` = 1');
        $FlowerList = [];

        while ($Flower = mysqli_fetch_assoc($Flowers)) {
            $FlowerList[] = $Flower;
        }
        return ($FlowerList);
    }

    public static function getFlower($id = Null)
    {
        $db = Connect::getConnect();
        if (!$id) {
            $id = $_GET['flower'];
        }
        $query = $db->query("SELECT `flowers`.*, `flowers_pictures`.`image_1`, `flowers_pictures`.`image_2`, `flowers_pictures`.`image_3`, `flowers_pictures`.`image_4`, `flowers_categories`.`category_name` FROM `flowers` LEFT JOIN `flowers_pictures` ON `flowers`.`id`=`flowers_pictures`.`flower_id` LEFT JOIN `flowers_categories` ON `flowers`.`category` = `flowers_categories`.`id` WHERE `flowers`.`id`='$id'");
        $Flower = mysqli_fetch_assoc($query);
        return $Flower;
    }

    public static function getFlowersCategories()
    {
        $db = Connect::getConnect();
        $Flowers = $db->query('SELECT * from `flowers_categories`');
        $FlowerList = [];

        while ($Flower = mysqli_fetch_assoc($Flowers)) {
            $FlowerList[] = $Flower;
        }
        return ($FlowerList);
    }

    public static function getCategory()
    {
        $db = Connect::getConnect();
        $category = $_GET['category'];
        $Flowers = $db->query("SELECT `flowers`.*, `flowers_pictures`.`image_1`, `flowers_pictures`.`image_2`, `flowers_pictures`.`image_3`, `flowers_pictures`.`image_4`, `flowers_categories`.`category_name` FROM `flowers` LEFT JOIN `flowers_pictures` ON `flowers`.`id` = `flowers_pictures`.`flower_id` LEFT JOIN `flowers_categories` ON `flowers`.`category` = `flowers_categories`.`id` WHERE `category_name`='$category'");
        $FlowerList = [];
        while ($Flower = mysqli_fetch_assoc($Flowers)) {
            $FlowerList[] = $Flower;
        }
        return $FlowerList;
    }

    public static function addFlower()
    {
        $msg = 'У вас недостаточно прав для этого действия';
        if ($_SESSION['user']['role'] = 'user') {
            header("Location: /?message=$msg");
        }

        $db = Connect::getConnect();
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $flower = $db->query("INSERT INTO `flowers`(`name`, `price`, `category`) VALUES ('$name','$price', '$category')");
        $flower_id = mysqli_insert_id($db);
        $flower_images = $db->query("INSERT INTO `flowers_pictures`(`flower_id`) VALUES ('$flower_id')");
        if ($flower && $flower_images) {
            $message = "Товар успешно добавлен";
            header("Location: /admin?message={$message}");
            die();
        } else {
            $message = "Ошибка при добавлении товара";
            header("Location: /admin?message={$message}");
            die();
        }
    }

    public static function deleteFlower()
    {
        $msg = 'У вас недостаточно прав для этого действия';
        if ($_SESSION['user']['role'] == 'user') {
            header("Location: /?message=$msg");
        }
        $db = Connect::getConnect();
        $id = $_POST['id'];
        $flower = self::getFlower($id);

        for ($i = 1; $i <= 4; $i++) {
            if (!empty($flower["image_$i"]) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $flower["image_$i"])) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $flower["image_$i"]);
            }
        }

        $deleteflowerpictures = $db->query("DELETE from `flowers_pictures` WHERE `flowers_pictures`.`flower_id` = '$id'");
        $deleteflower = $db->query("DELETE from `flowers` WHERE `flowers`.`id` = '$id'");
        $msg = 'Объявление удалено';
        header("Location: /admin?message=$msg");
    }

    public static function updateFlower()
    {
        $msg = 'У вас недостаточно прав для этого действия';
        if ($_SESSION['user']['role'] = 'user') {
            header("Location: /?message=$msg");
        }
        $db = Connect::getConnect();
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $size = $_POST['size'];
        $country = $_POST['country'];
        $category = $_POST['category'];
        $is_popular = isset($_POST['is_popular']) ? 1 : 0;

        $update = $db->query("UPDATE `flowers` SET 
        `name`='$name',
        `price`='$price',
        `size`='$size',
        `country`='$country',
        `category`='$category',
        `is_popular` = '$is_popular'
        WHERE `flowers`.`id`='$id'");

        if (!$update) {
            echo "Ошибка при обновлении таблицы `flowers`: " . $db->error . "<br>";
        }

        $uploadStatus = true;
        $message = '';

        for ($i = 1; $i <= 4; $i++) {
            $currentImage = $_POST['current_image_' . $i] ?? '';
            $newImagePath = $currentImage;

            if (isset($_FILES['image_' . $i]) && $_FILES['image_' . $i]['error'] === UPLOAD_ERR_OK) {
                $file = 'img/' . date('YmdHis') . '_' . basename($_FILES['image_' . $i]['name']);
                $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));

                if (!in_array($fileType, ['jpg', 'jpeg', 'png'])) {
                    $uploadStatus = false;
                    $message .= "Недопустимый тип файла для изображения $i.<br>";
                } else {
                    if (!move_uploaded_file($_FILES['image_' . $i]['tmp_name'], $file)) {
                        $uploadStatus = false;
                        $message .= "Не удалось загрузить файл для изображения $i.<br>";
                        $log .= "Ошибка загрузки файла: $file<br>";
                    } else {
                        if (!empty($currentImage) && file_exists($currentImage)) {
                            if (unlink($currentImage)) {
                                $log .= "Старое изображение удалено: $currentImage<br>";
                            } else {
                                $log .= "Не удалось удалить старое изображение: $currentImage<br>";
                            }
                        }
                        $newImagePath = $file;
                        $log .= "Новое изображение сохранено: $newImagePath<br>";
                    }
                }
            } else {
                if (!empty($_FILES['image_' . $i])) {
                    $log .= "Ошибка загрузки изображения $i: код ошибки " . $_FILES['image_' . $i]['error'] . "<br>";
                } else {
                    $log .= "Новое изображение не выбрано. Используется текущее: $currentImage<br>";
                }
            }

            $query = "UPDATE `flowers_pictures` SET `image_$i` = '$newImagePath' WHERE `flower_id` = '$id'";
            if (!$db->query($query)) {
                $log .= "Ошибка обновления изображения $i в таблице `flowers_pictures`: " . $db->error . "<br>";
            } else {
                $log .= "Путь изображения $i обновлен в БД.<br>";
            }
        }


        if ($uploadStatus) {
            $message .= "Изображения успешно обновлены.<br>";
        }

        echo $log;

        if (mysqli_affected_rows($db) === 0 && !$uploadStatus) {
            $message .= "Ошибка при обновлении объявления.<br>";
            header("Location: /admin/flower?flower=$id&message=$message");
            die();
        } else {
            $message .= "Объявление обновлено.<br>";
            header("Location: /admin/flower?flower=$id&message=$message");
            die();
        }
    }
}
