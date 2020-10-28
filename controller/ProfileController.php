<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'model/Connection.php';
require 'model/Auth.php';

class ProfileController
{
    public function render()
    {
        session_start();

        if (!isset($_SESSION['user'])){
            $view = 'view/error.php';
        } else {
            $view = 'view/profile.php';
        }

        if (isset($_SESSION['user'])) {
            $show = 'display: none';
            if ($_SESSION['user'] == $_GET['user']) {
                $show = 'display: block';
            }

            $connection = new Connection();
            $student = $connection->getProfile();
            $id = $connection->getId($student['email']);

            if (isset($_POST['action']) && $_POST['action'] == 'Delete') {
                if ($id['id'] === $_SESSION['user']) {
                    $connection->deleteProfile(intval($id['id']));
                    session_destroy();
                    $view = 'view/delete.php';
                }
            }
        }
        require $view;
    }
}
