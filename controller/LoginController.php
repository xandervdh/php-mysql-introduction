<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'model/Auth.php';
require 'model/Connection.php';

class LoginController
{
    public function render()
    {
        session_start();

        $authorization = new Auth();
        $error = 'style="border-color: red"';
        $firstName = $lastName = $email = "";
        $firstNameError = $lastNameError = $emailError = $passwordError = "";
        $firstNameErrorMessage = $lastNameErrorMessage = $emailErrorMessage = $errorMessage = $passwordErrorMessage = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['email'])) {
                $emailErrorMessage = 'Email is required';
                $emailError = $error;
            } else {
                $email = $_POST['email'];
                $errorMessage = $authorization->checkEmail($email);
                if (!empty($errorMessage)) { //check if input has a valid email
                    $emailError = $error; //give error style
                    $passwordError = $error;
                } else {
                    $_SESSION['email'] = $email;
                }
            }

            if (empty($emailErrorMessage) && empty($errorMessage) && empty($passwordErrorMessage)){
                if (empty($_POST['password'])) {
                    $passwordErrorMessage = 'password is required';
                    $passwordError = $error;
                } else {
                    $password = $_POST['password'];
                    $errorMessage = $authorization->checkPassword($password, $email);
                    if (!empty($errorMessage)) {
                        $emailError = $error; //give error style
                        $passwordError = $error;
                    }
                }
            }

            if (empty($firstNameErrorMessage && $lastNameErrorMessage && $emailErrorMessage)) {

            }
        }

        require 'view/login.php';
    }

    public function check_input($data)
    {
        $data = trim($data); //remove whitespace from beginning and end of input
        $data = stripslashes($data); //remove slashes
        $data = htmlspecialchars($data); //changes html elements to characters
        return $data;
    }
}
