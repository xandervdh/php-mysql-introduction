<?php
declare(strict_types=1);

class OverviewController {
    public function render()
    {
        $view = 'view/overview.php';
        $connection = new Connection();
        $students = $connection->getAllData(); //get all data

        require $view;
    }
}