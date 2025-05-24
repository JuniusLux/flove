<?php
session_start();
require 'src/services/Connect.php';
require 'src/core/controllers/Router.php';
require 'src/core/models/Bouquets.php';
require 'src/core/models/Flowers.php';
require 'src/core/models/Packaging.php';
require 'src/core/models/Items.php';
require 'src/core/models/Users.php';
require 'src/core/models/Orders.php';
require 'src/exceptions/notFoundPage.php';
require 'src/exceptions/notFoundUrl.php';
require 'src/core/router.php';

