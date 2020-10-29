<?php
declare(strict_types=1);

class LoginController
{
    public function render()
    {
        //set variables
        $connection = new Connection();
        $view = 'view/login.php';
        $authorization = new Auth();
        $error = 'style="border-color: red"';
        $firstName = $lastName = $email = "";
        $firstNameError = $lastNameError = $emailError = $passwordError = "";
        $firstNameErrorMessage = $lastNameErrorMessage = $emailErrorMessage = $errorMessage = $passwordErrorMessage = "";

        //if post request
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['email'])) {
                $emailErrorMessage = 'Email is required';
                $emailError = $error;
            } else {
                $email = $_POST['email'];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ //check if valid email
                    $emailErrorMessage = 'Invalid email adress!';
                    $emailError = $error;
                } else {
                    $emailErrorMessage = $authorization->checkEmail($email); //check if email exists in database
                    if (!empty($emailErrorMessage)) {
                        $passwordErrorMessage = $emailErrorMessage;
                        $emailError = $error;
                        $passwordError = $error;
                    }
                }
            }

            if (empty($emailErrorMessage) && empty($errorMessage) && empty($passwordErrorMessage)){ //if no errors
                if (empty($_POST['password'])) {
                    $passwordErrorMessage = 'password is required';
                    $passwordError = $error;
                } else {
                    $password = $_POST['password'];
                    $errorMessage = $authorization->checkPassword($password, $email); //check if password is same as database
                    if (!empty($errorMessage)) {
                        $emailError = $error; //give error style
                        $passwordError = $error;
                    }
                }
            }
            //if no errors
            if (empty($firstNameErrorMessage) && empty($lastNameErrorMessage) && empty($emailErrorMessage) && empty($errorMessage) && empty($passwordErrorMessage)) {
                $view = 'view/login_succes.php';
                $id = $connection->getId($email);
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
