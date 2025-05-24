<?php

namespace src\core\models;

use src\services\Connect;

class Orders
{

    public static function order()
    {
        $user = $_SESSION['user'];

        if (empty($user)) {
            header("Location: /login?message=Для оформления заказа необходимо авторизоваться");
            return;
        }
        $order = $_POST['cart_data'];
        print_r($order);
        if($order == "{\"bouquet\":{},\"flower\":{},\"package\":{}}" or $order == "{}"){
            header("Location: /cart?message=В заказе должна быть хотя бы одна позиция");
            return;
        }

        $delivery = $_POST['delivery_method'];
        $pay = $_POST['pay'];
        $time = $_POST['time'];
        $day = $_POST['day'];
        $comment = $_POST['comment'];
        $user_id = $_SESSION['user']['id'];
        $number = $_SESSION['user']['phone'];

        print_r($order);

        $db = Connect::getConnect();
        $db->query("INSERT INTO `orders` (`id`, `user_id`, `order`, `number`, `given`, `pay`, `status`, `time`, `day`, `comment`) VALUES (NULL, '$user_id', '$order', '$number', '$delivery', '$pay', 'Новый', '$time', '$day', '$comment');");
        header("Location: /cart?message=Заказ был успешно отправлен");
    }

    public static function getOrders()
    {

        $db = Connect::getConnect();
        $query = $db->query("SELECT 
            o.id AS order_id,
            o.user_id,
            o.order AS order_details,
            o.number AS order_number,
            o.time,
            o.day,
            o.comment,
            o.given,
            o.pay,
            o.status AS order_status,
            u.id AS user_id,
            u.name AS user_name,
            u.phone AS user_phone,
            u.role AS user_role
        FROM 
            orders o
        INNER JOIN 
        users u ON o.user_id = u.id
        ORDER BY FIELD(o.status, 'Новый', 'Подтвержден', 'Завершен') ASC");
        $orderList = [];
        while ($item = mysqli_fetch_assoc($query)) {
            $orderList[] = $item;
        }
        return $orderList;
    }

    public static function deleteOrder(){
        $id = $_POST['order_id'];
        $db = Connect::getConnect();
        $query = $db->query("DELETE FROM orders WHERE `orders`.`id` = $id");
        header('Location: /orderPage?message=Вы удалили заказ');
    }

    public static function changeStatus(){
        $db = Connect::getConnect();
        $status = $_POST['status'];
        $id = $_POST['order_id'];
        $db->query("UPDATE `orders` SET `status` = '$status' WHERE `orders`.`id` = $id;");
        header('Location: /orderPage?message=Статус изменен');
    }

}
