<?php

namespace src\core\models;

use src\services\Connect;

class Users
{

    public static function registration()
    {
        $db = Connect::getConnect();
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $password_ver = $_POST['password_ver'];
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $checkReg = $db->query("SELECT `phone` FROM `users` WHERE `phone`='$phone'");
        if (mysqli_num_rows($checkReg) === 0) {
            if ($password == $password_ver) {
                $reg = $db->query("INSERT INTO `users`(`name`,`phone`,`password`) VALUES ('$name','$phone','$pass_hash')");
                if ($reg) {
                    if (!$reg) {
                        $message = 'Ошибка при регистрации';
                        header("Location: /login?message=$message");
                        die();
                    } else {
                        $message = 'Вы успешно зарегестрировались';
                        $isAuthorized = isset($_SESSION['user']) ? 'true' : 'false';
                        ?>
                        <script>
                            const isAuthorized = <?= $isAuthorized ?>;
                        </script>
                        <?php
                        header("Location: /login?message=$message");
                        die();
                    }
                }
            } else {
                $message = 'Пароли не совпадают';
                header("Location: /registration?message=$message");
            }
        } else {
            $message = 'Этот номер телефона занят';
            header("Location: /registration?message=$message");
        }
    }

    public static function auth()
    {
        $db = Connect::getConnect();
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $sql = $db->query("SELECT * FROM `users` WHERE `users`.`phone` = '$phone'");
        if (mysqli_num_rows($sql) === 0) {
            $message = 'Такой пользователь не найден';
            header("Location: /login?message=$message");
        } else {
            $user = mysqli_fetch_assoc($sql);
            if ($phone === $user['phone'] && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'phone' => $user['phone'],
                    'role' => $user['role']
                ];
                $message = 'Дарова, ' . $user['phone'];
                header("Location: /?message=$message");
            } else {
                $message = 'Неправильный логин или пароль';
                header("Location: /login?message=$message");
            }
        }
    }

    public static function quit()
    {
        unset($_SESSION['user']);
        $message = 'Вышел из аккаунта';
        header("Location: /?message=$message");
    }
}
