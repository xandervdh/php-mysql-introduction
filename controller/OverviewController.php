<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'model/Connection.php';

class OverviewController {
    public function render()
    {
        $connection = new Connection();
        $students = $connection->getAllData();

        require 'view/overview.php';
    }
}