<?php

namespace src\services;
class Connect
{

    public static function getConnect()
    {
        $db = mysqli_connect('MySQL-8.4', 'root', '', 'flove');
        if(!$db)
        {
            echo 'connect error';
        }
        else
        {
            return $db; 
        }
    }
}

