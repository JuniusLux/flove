<?php

namespace src\core\models;

use src\services\Connect;

class Items
{
    public static function getItems()
    {
        $db = Connect::getConnect();
        $items = $db->query('SELECT * FROM `items`');
        $itemList = [];

        while ($item = mysqli_fetch_assoc($items)) {
            $itemList[] = $item;
        }
        return ($itemList);
    }

    public static function addItem()
    {
        $db = Connect::getConnect();
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $item = $db->query("INSERT INTO `items`(`name`, `description`, `price`) VALUES ('$name','$description', '$price')");
        if ($item) {
           $message = "Товар успешно добавлен";
            header("Location: /?message={$message}");
            die();
        } else {
            $message = "Ошибка при добавлении товара";
            header("Location: /?message={$message}");
            die();
        }

    }

    public static function deleteItem()
    {
        $db = Connect::getConnect();
        $id = $_POST['id'];
        $item = Items::getItem($id);
        if (!empty($item['image'])) {
            if (unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $item['image'])) {
                $imgDelState = $item['image'] . ' deleted';
            } else {
                $imgDelState = 'deletent';
            }
        } else {
            $imgDelState = $item['name'] . ' не имеет картинок';
        }
        $query = $db->query("DELETE FROM `items` WHERE `items`.`id` = '$id'");
        if (mysqli_affected_rows($db) === 0) {
            $message = "Ошибка при удалении, " . $imgDelState;
            header("Location: /?message=$message");
            die();
        } else {
            $message = "Товар успешно удален, " . $imgDelState;
            header("Location: /?message=$message");
            die();
        }
    }

    public static function updateitem()
    {
        $db = Connect::getConnect();
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        if (!empty($name)) {
            $updateName = $db->query("UPDATE `items` SET `nickname`='$name' WHERE `items`.`id`='$id'");
        }
        if (!empty($description)) {
            $updateDesc = $db->query("UPDATE `items` SET `description`='$description' WHERE `items`.`id`='$id'");
        }
        if (!empty($price)) {
            $updatePrice = $db->query("UPDATE `items` SET `price`='$price' WHERE `items`.`id`='$id'");
        }
        if (mysqli_affected_rows($db) === 0) {
            $message = "Ошибка при изменении данных товара";
            header("Location: /getItem?id=$id&message=$message");
            die();
        } else {
            $message = "Данные товара успешно изменены";
            header("Location: /getItem?id=$id&message=$message");
            die();
        }
    }

    public static function getItem($id = Null)
    {
        $db = Connect::getConnect();
        if (!$id) {
            $id = $_GET['id'];
        }
        $query = $db->query("SELECT * FROM `items` WHERE `items`.`id`='$id'");
        $item = mysqli_fetch_assoc($query);
        return ($item);

    }

    public static function upload()
    {
        $file = 'uploads/' . date('Ymdhis') . basename($_FILES['uploadedFile']['name']);
        $uploadStatus = true;
        $id = $_POST['id'];
        $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if ($fileType != 'jpg' && $fileType != 'gif' && $fileType = 'png' && $fileType != 'jpeg') {
            $uploadStatus = false;
            $message = 'Недопустимый тип файла';
            header("Location: /getItem?id=$id&message=$message");
            return;
        }
        if ($_FILES['uploadedFile']['size'] > 5242880) {
            $uploadStatus = false;
            $message = 'Слишком большой размер файлв';
            header("Location: /getItem?id=$id&message=$message");
            return;
        }
        $item = Items::getItem($id);
        if (!empty($item['image']))
            $hasImage = true;
        if ($hasImage)
            unlink(($_SERVER['DOCUMENT_ROOT'] . '/' . $item['image']));
        if ($uploadStatus) {
            if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $file)) {
                $db = Connect::getConnect();
                $db->query("UPDATE `items` SET `image`='$file' WHERE `items`.`id`='$id'");
                header("Location: /getItem?id=$id");
            }
        } else {
            $message = 'Не удалось загрузить файл';
            header("Location: /getItem?id=$id&message=$message");
        }

    }

}