<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

require 'model/Auth.php';
require 'model/Connection.php';
require 'model/Student.php';

/*if (isset($_GET['page']) && $_GET['page'] == 'login') {
    require 'controller/LoginController.php';
    $controller = new LoginController();
} else {
    require 'controller/RegisterController.php';
    $controller = new RegisterController();
}*/

if (isset($_SESSION['user']) && $_SESSION['user'] !== null){
    if (isset($_GET['page']) && $_GET['page'] == 'overview') {
        require 'controller/OverviewController.php';
        $controller = new OverviewController();
    } elseif (isset($_GET['user'])) {
        require 'controller/ProfileController.php';
        $controller = new ProfileController();
    } elseif (isset($_GET['edit'])) {
        require 'controller/EditController.php';
        $controller = new EditController();
    }
} elseif (!isset($_SESSION['user'])){
    if (isset($_GET['page']) && $_GET['page'] == 'login') {
        require 'controller/LoginController.php';
        $controller = new LoginController();
    } else {
        require 'controller/RegisterController.php';
        $controller = new RegisterController();
    }
} else {
    require 'controller/RegisterController.php';
    $controller = new RegisterController();
}

//render the view
$controller->render();