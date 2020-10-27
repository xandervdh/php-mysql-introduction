<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'model/Connection.php';

class OverviewController {
    public function render()
    {
        session_start();
        if (isset($_SESSION['user'])){
            $view = 'view/overview.php';
        } else {
            $view = 'view/error.php';
        }

        $connection = new Connection();
        $students = $connection->getAllData();

        require $view;
    }
}