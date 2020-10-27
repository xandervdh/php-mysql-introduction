<?php
declare(strict_types=1);

require 'controller/RegisterController.php';
//if you choose a client show the homepage
$controller = new RegisterController();
//render the view
$controller->render();