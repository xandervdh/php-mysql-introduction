<?php
declare(strict_types=1);

class OverviewController {
    public function render()
    {
        $connection = new Connection();
        $students = $connection->getAllData(); //get all data

        require $view;
    }
}