<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'model/Auth.php';
require 'model/Connection.php';
require 'model/Student.php';
class RegisterController {
    public function render()
    {
        session_start();

        $view = 'view/register.php';
        $authorization = new Auth();
        $error = 'style="border-color: red"';
        $firstName = $lastName = $email = $password = $passwordConfirm = "";
        $firstNameError = $lastNameError = $emailError = $passwordError = $passwordConfirmError = "";
        $firstNameErrorMessage = $lastNameErrorMessage = $emailErrorMessage = $passwordErrorMessage = $passwordConfirmErrorMessage = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['firstName'])) {
                $firstNameErrorMessage = 'First name is required';
                $firstNameError = $error;
            } else {
                $firstName = $this->check_input($_POST['firstName']);
                $firstNameErrorMessage = $authorization->nameValidation($firstName);
                if (!empty($firstNameErrorMessage)) {
                    $firstNameError = $error;
                } else {
                    $_SESSION['firstName'] = $firstName;
                }
            }

            if (empty($_POST['lastName'])) {
                $lastNameErrorMessage = 'Last name is required';
                $lastNameError = $error;
            } else {
                $lastName = $this->check_input($_POST['lastName']);
                $lastNameErrorMessage = $authorization->nameValidation($lastName);
                if (!empty($lastNameErrorMessage)) {
                    $lastNameError = $error;
                } else {
                    $_SESSION['lastName'] = $lastName;
                }
            }

            if (empty($_POST['email'])) {
                $emailErrorMessage = 'Email is required';
                $emailError = $error;
            } else {
                $email = $_POST['email'];
                $emailErrorMessage = $authorization->emailValidation($email);
                if (!empty($emailErrorMessage)) { //check if input has a valid email
                    $emailError = $error; //give error style
                } else {
                    $_SESSION['email'] = $email;
                }
            }

            if (empty($_POST['password'])) {
                $passwordErrorMessage = 'Password is required';
                $passwordError = $error;
            }

            if (empty($_POST['passwordConfirm'])) {
                $passwordConfirmErrorMessage = 'Password confirmation is required';
                $passwordConfirmError = $error;
            }

            if (empty($passwordConfirmErrorMessage) && empty($passwordErrorMessage)) {
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $passwordConfirm = $_POST['passwordConfirm'];
                $passwordErrorMessage = $authorization->passwordValidation($password, $passwordConfirm);
                if (!empty($passwordErrorMessage)) {
                    $passwordConfirmError = $error;
                    $passwordError = $error;
                    $passwordConfirmErrorMessage = $passwordErrorMessage;
                }
            }

            if (empty($firstNameErrorMessage) && empty($lastNameErrorMessage) && empty($emailErrorMessage) && empty($passwordErrorMessage)) {
                $student = new Student($firstName, $lastName, $email, $password);
                $connection = new Connection();
                $connection->insertData($student);
                $id = $connection->getId($email);
                $view = 'view/register_complete.php';
                $_SESSION['user'] = $id['id'];
            }
        }

        require $view;
    }

    public function check_input($data)
    {
        $data = trim($data); //remove whitespace from beginning and end of input
        $data = stripslashes($data); //remove slashes
        $data = htmlspecialchars($data); //changes html elements to characters
        return $data;
    }
}
