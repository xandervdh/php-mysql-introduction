<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'model/Auth.php';
require 'model/Connection.php';

class LoginController {
    public function render()
    {
        $error = 'style="border-color: red"';
        $firstName = $lastName = $email = "";
        $firstNameError = $lastNameError = $emailError = "";
        $firstNameErrorMessage = $lastNameErrorMessage = $emailErrorMessage = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['email'])) {
                $emailErrorMessage = 'Email is required';
                $emailError = $error;
            } else {
                $email = $_POST['email'];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //check if input has a valid email
                    $emailError = $error; //give error style
                    $emailErrorMessage = "Invalid email format"; //give error message
                }
            }

            if (empty($_POST['password'])) {
                $passwordErrorMessage = 'password is required';
                $passwordError = $error;
            } else {
                $password = check_input($_POST['password']);
            }

            if (empty($firstNameErrorMessage && $lastNameErrorMessage && $emailErrorMessage)){

            }
        }

        function check_input($data)
        {
            $data = trim($data); //remove whitespace from beginning and end of input
            $data = stripslashes($data); //remove slashes
            $data = htmlspecialchars($data); //changes html elements to characters
            return $data;
        }
        require 'view/login.php';
    }
}
