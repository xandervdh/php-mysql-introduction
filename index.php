<?php
declare(strict_types=1);
//set error handling
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
//start session
session_start();
//require all models
require 'model/Auth.php';
require 'model/Connection.php';
require 'model/Student.php';

//if logged in
if (!empty($_SESSION['user'])){
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
} elseif (!isset($_SESSION['user'])){ //else if not logged in
    if (isset($_GET['page']) && $_GET['page'] == 'login') {
        require 'controller/LoginController.php';
        $controller = new LoginController();
    }
}
if (isset($controller)) { //yeet to register if you are not logged in and try to go to a page where you need to be logged in
    require 'controller/RegisterController.php';
    $controller = new RegisterController();
}

//render the view
$controller->render();