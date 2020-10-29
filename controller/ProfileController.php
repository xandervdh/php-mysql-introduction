<?php
declare(strict_types=1);

class ProfileController
{
    public function render()
    {   //check if the user has the same id as profile id
        if (isset($_SESSION['user'])) {
            $show = 'display: none';
            if ($_SESSION['user'] == $_GET['user']) {
                $show = 'display: block';
            }

            $connection = new Connection();
            $student = $connection->getProfile(); //get data for profile
            $id = $connection->getId($student['email']);

            if (isset($_POST['action'])) {
                //check again if user id is the same as profile id
                if ($id['id'] === $_SESSION['user']) {
                    //if delete
                    if ($_POST['action'] == 'Delete'){
                        $connection->deleteProfile(intval($id['id'])); //delete profile
                        session_destroy();
                        $view = 'view/delete.php';
                        //if edit
                    } elseif ($_POST['action'] == 'Edit'){
                        $view = 'view/profileEdit.php';
                    }
                }
            }
        }

        require $view;
    }
}
