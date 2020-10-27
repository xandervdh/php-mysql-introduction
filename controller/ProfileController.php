<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'model/Connection.php';

class ProfileController
{
    public function render()
    {
        session_start();

        $show = 'display: none';
        if ($_SESSION['user'] === $_GET['user']){
            $show = 'display: block';
        }

        $connection = new Connection();
        $student = $connection->getProfile();
        $id = $connection->getId($student['email']);

        require 'view/profile.php';
    }
}
