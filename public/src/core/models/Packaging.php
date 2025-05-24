<?php

namespace src\core\models;

use src\services\Connect;

class Packaging
{
    public static function getPackaging()
    {
        $searchWord = $_GET['search'] ?? '';
        $db = Connect::getConnect();
         if (empty($searchWord)) {
        $packagings = $db->query('SELECT `packaging`.* FROM `packaging`');
         }else{
            $packagings = $db->query("SELECT `packaging`.* FROM `packaging` where `name` LIKE '%$searchWord%'");
         }
        $packagingList = [];

        while ($packaging = mysqli_fetch_assoc($packagings)) {
            $packagingList[] = $packaging;
        }
        return $packagingList;
    }

    public static function getPopularPackaging()
    {
        $db = Connect::getConnect();
        $packagings = $db->query('SELECT `packaging`.* FROM `packaging` WHERE `is_popular` = 1');
        $packagingList = [];

        while ($packaging = mysqli_fetch_assoc($packagings)) {
            $packagingList[] = $packaging;
        }
        return $packagingList;
    }

    public static function getSinglePackaging($id = Null)
    {
        $db = Connect::getConnect();
        if (!$id) {
            $id = $_GET['packaging'];
        }
        $query = $db->query("SELECT * FROM `packaging` WHERE `packaging`.`id`='$id'");
        $packaging = mysqli_fetch_assoc($query);
        return ($packaging);

    }


    public static function addPackaging()
    {
        $db = Connect::getConnect();
        $name = $_POST['name'];
        $price = $_POST['price'];
        $packaging = $db->query("INSERT INTO `packaging`(`name`, `price`) VALUES ('$name', '$price')");
        if ($packaging) {
            $message = "Товар успешно добавлен";
            header("Location: /admin?message={$message}");
            die();
        } else {
            $message = "Ошибка при добавлении товара";
            header("Location: /admin?message={$message}");
            die();
        }

    }

    public static function deletePackaging()
    {
        $db = Connect::getConnect();
        $id = $_POST['id'];
        $packaging = Packaging::getSinglePackaging($id);
        if (!empty($packaging['image'])) {
            if (unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $packaging['image'])) {
                $imgDelState = $packaging['image'] . ' deleted';
            } else {
                $imgDelState = 'deletent';
            }
        } else {
            $imgDelState = $packaging['name'] . ' не имеет картинок';
        }
        $query = $db->query("DELETE FROM `packaging` WHERE `packaging`.`id` = '$id'");
        if (mysqli_affected_rows($db) === 0) {
            $message = "Ошибка при удалении, " . $imgDelState;
            header("Location: /admin?message=$message");
            die();
        } else {
            $message = "Товар успешно удален, " . $imgDelState;
            header("Location: /admin?message=$message");
            die();
        }
    }

    public static function updatePackaging()
    {
        $db = Connect::getConnect();
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $currentImage = $db->real_escape_string($_POST['current_image']);
        $imagePath = $currentImage;
        $is_popular = isset($_POST['is_popular']) ? 1 : 0;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $fileMimeType = mime_content_type($_FILES['image']['tmp_name']);

            if (!in_array($fileMimeType, $allowedMimeTypes)) {
                die('Ошибка: Допустимы только изображения (JPEG, PNG, GIF, WEBP).');
            }

            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/img/';
            $uploadedFileName = date('Ymdhis') . basename($_FILES['image']['name']);
            $targetFilePath = $uploadDir . $uploadedFileName;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $imagePath = '/img/' . $uploadedFileName;

                if ($currentImage !== $imagePath && file_exists($_SERVER['DOCUMENT_ROOT'] . $currentImage)) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . $currentImage);
                }
            } else {
                die('Ошибка: Не удалось загрузить файл.');
            }
        }
        $updateName = $db->query("UPDATE `packaging` SET `name`='$name', `price`='$price', `image` = '$imagePath', `is_popular`='$is_popular' WHERE `packaging`.`id`='$id'");
        if (mysqli_affected_rows($db) === 0) {
            $message = "Ошибка при изменении данных товара";
            header("Location: /admin/packaging?packaging=$id&message=$message");
            die();
        } else {
            $message = "Данные товара успешно изменены";
            header("Location: /admin/packaging?packaging=$id&message=$message");
            die();
        }
    }

}