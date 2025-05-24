<?php

namespace src\core\models;

use src\services\Connect;

class Bouquets
{
    public static function getBouquets()
    {
        $searchWord = $_GET['search'] ?? '';
        $db = Connect::getConnect();

        if (strpos(strtolower($searchWord), 'буке') !== false) {
         $bouquets = $db->query("SELECT `bouquets`.* FROM `bouquets`  LEFT JOIN   `bouquets_categories` ON `bouquets`.`category` = `bouquets_categories`.`id`");
        } else {
               $bouquets = $db->query("SELECT `bouquets`.* FROM `bouquets`  
               LEFT JOIN   `bouquets_categories` ON `bouquets`.`category` = `bouquets_categories`.`id`
            WHERE name LIKE '%$searchWord%'
            OR `bouquets_categories`.`category_name` LIKE '%$searchWord%'");
        }

        $flowers = $db->query('SELECT `bouquets_flowers`.`bouquet_id`, `bouquets_flowers`.`flower_id`, `flowers`.`name` AS `flower_name` FROM `bouquets` LEFT JOIN `bouquets_flowers` ON `bouquets`.`id` = `bouquets_flowers`.`bouquet_id` LEFT JOIN `flowers` ON `bouquets_flowers`.`flower_id` = `flowers`.`id` ');



        $bouquetList = [];
        $flowerList = [];

        while ($item = mysqli_fetch_assoc($bouquets)) {
            $bouquetList[] = $item;
        }
        while ($item = mysqli_fetch_assoc($flowers)) {
            $flowerList[] = $item;
        }

        $result = [
            'bouquets' => $bouquetList,
            'flowers' => $flowerList
        ];
        return $result;
    }

    public static function getPopularBouquets()
    {
        $db = Connect::getConnect();
        $bouquets = $db->query('SELECT `bouquets`.* FROM `bouquets` WHERE `is_popular` = 1');
        $flowers = $db->query('SELECT `bouquets_flowers`.`bouquet_id`, `bouquets_flowers`.`flower_id`, `flowers`.`name` AS `flower_name` FROM `bouquets` LEFT JOIN `bouquets_flowers` ON `bouquets`.`id` = `bouquets_flowers`.`bouquet_id` LEFT JOIN `flowers` ON `bouquets_flowers`.`flower_id` = `flowers`.`id` WHERE `bouquets`.`is_popular` = 1');

        $bouquetList = [];
        $flowerList = [];

        while ($item = mysqli_fetch_assoc($bouquets)) {
            $bouquetList[] = $item;
        }
        while ($item = mysqli_fetch_assoc($flowers)) {
            $flowerList[] = $item;
        }

        $result = [
            'bouquets' => $bouquetList,
            'flowers' => $flowerList
        ];
        return $result;
    }

    public static function getCategory($category = null)
    {
        $db = Connect::getConnect();
        if (!isset($category)) {
            $category = $_GET['category'];
        }
        $bouquets = $db->query("SELECT `bouquets`.*, `bouquets_categories`.`category_name` FROM `bouquets` LEFT JOIN `bouquets_categories` ON `bouquets`.`category` = `bouquets_categories`.`id` WHERE `category_name` = '$category'");
        $flowers = $db->query("SELECT `bouquets_flowers`.`bouquet_id`, `bouquets_flowers`.`flower_id`, `flowers`.`name` AS `flower_name`, `bouquets_categories`.`category_name` FROM `bouquets` LEFT JOIN `bouquets_flowers` ON `bouquets`.`id` = `bouquets_flowers`.`bouquet_id` LEFT JOIN `flowers` ON `bouquets_flowers`.`flower_id` = `flowers`.`id` LEFT JOIN `bouquets_categories` ON `bouquets`.`category` = `bouquets_categories`.`id` WHERE `category_name` = '$category'");

        $bouquetList = [];
        $flowerList = [];

        while ($item = mysqli_fetch_assoc($bouquets)) {
            $bouquetList[] = $item;
        }
        while ($item = mysqli_fetch_assoc($flowers)) {
            $flowerList[] = $item;
        }

        $result = [
            'bouquets' => $bouquetList,
            'flowers' => $flowerList
        ];
        return $result;
    }

    public static function getBouquetsCategories()
    {
        $db = Connect::getConnect();
        $categories = $db->query('SELECT * from `bouquets_categories`');
        $categoriesList = [];

        while ($category = mysqli_fetch_assoc($categories)) {
            $categoriesList[] = $category;
        }
        return $categoriesList;
    }


    public static function getBouquet($id = Null)
    {
        $db = Connect::getConnect();
        if (!$id) {
            $id = $_GET['bouquet'];
        }
        $bouquet = $db->query("SELECT `bouquets`.*, `bouquets_categories`.`category_name`  FROM `bouquets` LEFT JOIN `bouquets_categories` ON `bouquets`.`category` = `bouquets_categories`.`id` WHERE `bouquets`.`id` = '$id'");
        $flowers = $db->query("SELECT `bouquets_flowers`.`bouquet_id`, `bouquets_flowers`.`flower_id`, `flowers`.`name` AS `flower_name` FROM `bouquets` LEFT JOIN `bouquets_flowers` ON `bouquets`.`id` = `bouquets_flowers`.`bouquet_id` LEFT JOIN `flowers` ON `bouquets_flowers`.`flower_id` = `flowers`.`id` WHERE `bouquets`.`id` = '$id'");

        $bouquetList = mysqli_fetch_assoc($bouquet);
        $flowerList = [];

        while ($item = mysqli_fetch_assoc($flowers)) {
            $flowerList[] = $item;
        }

        $result = [
            'bouquet' => $bouquetList,
            'flowers' => $flowerList
        ];
        return $result;
    }

    public static function addBouquet()
    {
        $msg = 'У вас недостаточно прав для этого действия';
        if ($_SESSION['user']['role'] = 'user') {
            header("Location: /?message=$msg");
        }

        $db = Connect::getConnect();
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $bouquet = $db->query("INSERT INTO `bouquets`(`name`, `price`, `category`) VALUES ('$name','$price', '$category')");
        if ($bouquet) {
            $message = "Товар успешно добавлен";
            header("Location: /admin?message={$message}");
            die();
        } else {
            $message = "Ошибка при добавлении товара";
            header("Location: /admin?message={$message}");
            die();
        }
    }

    public static function updateBouquet()
    {
        $msg = 'У вас недостаточно прав для этого действия';
        if ($_SESSION['user']['role'] = 'user') {
            header("Location: /?message=$msg");
        }

        $db = Connect::getConnect();
        $id = (int) $_POST['id'];
        $name = $db->real_escape_string($_POST['name']);
        $price = (int) $_POST['price'];
        $currentImage = $db->real_escape_string($_POST['current_image']);
        $category = $_POST['category'];
        $is_popular = isset($_POST['is_popular']) ? 1 : 0;

        $imagePath = $currentImage;
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

        $updateQuery = "
        UPDATE bouquets 
        SET name = '$name', price = $price, image = '$imagePath', category = '$category', is_popular = '$is_popular'
        WHERE id = $id
    ";
        $db->query($updateQuery);
        $count = mysqli_affected_rows($db);

        $existingFlowers = [];
        $newFlowers = [];
        $removedFlowers = [];

        foreach ($_POST as $key => $value) {
            if (strpos($key, 'existing_flower_') === 0) {
                $flowerId = str_replace('existing_flower_', '', $key);
                $existingFlowers[$flowerId] = $value;
            } elseif (strpos($key, 'new_flower_') === 0) {
                $newFlowers[] = $value;
            } elseif (strpos($key, 'remove_flower_') === 0) {
                $removedFlowers[] = $value;
            }
        }

        if (!empty($removedFlowers)) {
            $query = "DELETE FROM bouquets_flowers WHERE bouquet_id = ? AND flower_id = ?";
            $stmt = $db->prepare($query);
            foreach ($removedFlowers as $flowerId) {
                $stmt->bind_param("ii", $id, $flowerId);
                $stmt->execute();
            }
        }

        if (!empty($existingFlowers)) {
            foreach ($existingFlowers as $flowerId => $newFlowerId) {
                if ($newFlowerId !== $flowerId) {
                    $query = "UPDATE bouquets_flowers SET flower_id = ? WHERE bouquet_id = ? AND flower_id = ?";
                    $stmt = $db->prepare($query);
                    $stmt->bind_param("iii", $newFlowerId, $id, $flowerId);
                    $stmt->execute();
                }
            }
        }

        if (!empty($newFlowers)) {
            $query = "INSERT IGNORE INTO bouquets_flowers (bouquet_id, flower_id) VALUES (?, ?)";
            $stmt = $db->prepare($query);
            foreach ($newFlowers as $flowerId) {
                $stmt->bind_param("ii", $id, $flowerId);
                $stmt->execute();
            }
        }

        if ($count === 0) {
            $message = "Ошибка при обновлении букета.<br>";
            header("Location: /admin/bouquet?bouquet=$id&message=$message");
            die();
        } else {
            $message = "Букет обновлен.<br>";
            header("Location: /admin/bouquet?bouquet=$id&message=$message");
            die();
        }
    }



    public static function deleteBouquet()
    {
        $msg = 'У вас недостаточно прав для этого действия';
        if ($_SESSION['user']['role'] = 'user') {
            header("Location: /?message=$msg");
        }
        $db = Connect::getConnect();
        $id = $_POST['id'];
        $bouquet = self::getBouquet($id);
        print_r($bouquet);

        if (!empty($bouquet['bouquet']['image']))
            $hasImage = true;
        if ($hasImage)
            unlink(($_SERVER['DOCUMENT_ROOT'] . '/' . $bouquet['bouquet']['image']));

        $deleteflowerpictures = $db->query("DELETE from `bouquets_flowers` WHERE `bouquets_flowers`.`bouquet_id` = '$id'");
        $deleteflower = $db->query("DELETE from `bouquets` WHERE `bouquets`.`id` = '$id'");
        $msg = 'Объявление удалено';
        header("Location: /admin?message=$msg");
    }
}
