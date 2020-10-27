<?php
declare(strict_types=1);

if ($_GET['page'] == 'overview'){
    require 'controller/OverviewController.php';
    $controller = new OverviewController();
} elseif (isset($_GET['user'])){
    require 'controller/ProfileController.php';
    $controller = new ProfileController();
}else {
    require 'controller/RegisterController.php';
    $controller = new RegisterController();
}


//if you choose a client show the homepage

//render the view
$controller->render();