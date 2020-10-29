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

        if (!isset($_SESSION['user']) || $_SESSION['user'] === null){
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

            if (isset($_POST['action'])) {
                if ($id['id'] === $_SESSION['user']) {
                    if ($_POST['action'] == 'Delete'){
                        $connection->deleteProfile(intval($id['id']));
                        session_destroy();
                        $view = 'view/delete.php';
                    } elseif ($_POST['action'] == 'Edit'){
                        $view = 'view/profileEdit.php';
                    }
                }
            }
        }

        require $view;
    }
}
