<?php

use src\core\models\Bouquets;
use src\core\models\Items;
use src\core\models\Packaging;
use src\core\models\Users;
use src\core\models\Flowers;
use src\core\contollers\Router;
use src\core\models\Orders;
use src\exceptions\notFoundUrl;
use src\exceptions\notFoundPage;

try{
    Router::myGet('/', 'home');
    Router::myGet('/about', 'about');
    Router::myGet('/orderPage', 'order');
    
    Router::myGet('/cart', 'cart');
    Router::myGet('/catalog', 'catalog');
    Router::myGet('/catalog/bouquets', 'bouquets');
    Router::myGet('/catalog/bouquets/category', 'bouquets-category');
    Router::myGet('/catalog/cut-flowers', 'cut-flowers');
    Router::myGet('/catalog/cut-flowers/category', 'cut-flowers-category');
    Router::myGet('/catalog/packaging', 'packaging');
    Router::myGet('/registration', 'registration');
    Router::myGet('/login', 'login');

    Router::myGet('/admin', 'admin');
    Router::myGet('/admin/flower', 'admin-flower');
    Router::myGet('/admin/bouquet', 'admin-bouquet');
    Router::myGet('/admin/packaging', 'admin-packaging');

    Router::myPost('/addFlower', Flowers::class, 'addFlower');
    Router::myPost('/updateFlower', Flowers::class, 'updateFlower');
    Router::myPost('/deleteFlower', Flowers::class, 'deleteFlower');

    Router::myPost('/addBouquet', Bouquets::class, 'addBouquet');
    Router::myPost('/updateBouquet', Bouquets::class, 'updateBouquet');
    Router::myPost('/deleteBouquet', Bouquets::class, 'deleteBouquet');

    Router::myPost('/addPackaging', Packaging::class, 'addPackaging');
    Router::myPost('/updatePackaging', Packaging::class, 'updatePackaging');
    Router::myPost('/deletePackaging', Packaging::class, 'deletePackaging');

    
    Router::myPost('/reg', Users::class, 'registration');
    Router::myPost('/auth', Users::class, 'auth');
    Router::myPost('/quit', Users::class, 'quit');

    Router::myPost('/order', Orders::class, 'order');
    Router::myPost('/deleteOrder', Orders::class, 'deleteOrder');
    Router::myPost('/changeStatus', Orders::class, 'changeStatus');
    
    Router::getContent();
}
catch (notFoundPage $error){
    $error -> fileNotFound();
}
catch (notFoundUrl $e){
    $e -> notFoundUrl();
}

