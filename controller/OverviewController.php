<?php
declare(strict_types=1);

class OverviewController {
    public function render()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user'] === null){
            $view = 'view/error.php';
        } else {
            $view = 'view/overview.php';
        }

        $connection = new Connection();
        $students = $connection->getAllData();

        require $view;
    }
}