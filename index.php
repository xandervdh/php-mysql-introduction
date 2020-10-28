<?php
declare(strict_types=1);

if ($_GET['page'] == 'overview') {
    require 'controller/OverviewController.php';
    $controller = new OverviewController();
} elseif ($_GET['page'] == 'login') {
    require 'controller/LoginController.php';
    $controller = new LoginController();
} elseif (isset($_GET['user'])) {
    require 'controller/ProfileController.php';
    $controller = new ProfileController();
} elseif (isset($_GET['edit'])) {
    require 'controller/EditController.php';
    $controller = new EditController();
} else {
    require 'controller/RegisterController.php';
    $controller = new RegisterController();
}


//if you choose a client show the homepage

//render the view
$controller->render();