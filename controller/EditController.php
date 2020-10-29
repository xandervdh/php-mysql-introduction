<?php
declare(strict_types=1);

class EditController
{
    public function render()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user'] === null){
            $view = 'view/error.php';
        } else {
            $view = 'view/edit.php';
        }
        $connection = new Connection();
        $student = $connection->getProfileEdit();
        $authorization = new Auth();
        $error = 'style="border-color: red"';
        $firstName = $lastName = $email = $password = $passwordConfirm = $newPassword = "";
        $firstNameError = $lastNameError = $emailError = $passwordError = $passwordConfirmError = $newPasswordError = "";
        $firstNameErrorMessage = $lastNameErrorMessage = $emailErrorMessage = $passwordErrorMessage = $passwordConfirmErrorMessage = $newPasswordErrorMessage = "";

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
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $emailErrorMessage = 'Invalid email adress!';
                    $emailError = $error; //give error style
                } else {
                    $_SESSION['email'] = $email;
                }
            }

            if (empty($_POST['password'])) {
                $passwordErrorMessage = 'Password is required';
                $passwordError = $error;
            } else {
                $password = $_POST['password'];
                $passwordError = $authorization->checkPassword($password, $email);
                if (!empty($passwordError)){
                    $passwordError = "Password is incorrect!";
                }
            }

            if (!empty($_POST['newPassword'])) {
                if (empty($_POST['passwordConfirm'])){
                    $passwordConfirmErrorMessage = "Password confirm is required";
                    $passwordConfirmError = $error;
                } else {
                    $newPassword = password_hash($_POST['newPassword'], PASSWORD_BCRYPT);
                    $passwordConfirm = $_POST['passwordConfirm'];
                    $newPasswordErrorMessage = $authorization->passwordValidation($newPassword, $passwordConfirm);
                    if (!empty($newPasswordErrorMessage)) {
                        $passwordConfirmError = $error;
                        $newPasswordError = $error;
                        $passwordConfirmErrorMessage = $newPasswordErrorMessage;
                    } else {
                        if (empty($firstNameErrorMessage) && empty($lastNameErrorMessage) && empty($emailErrorMessage) && empty($passwordErrorMessage)) {
                            $connection = new Connection();
                            $connection->updateDataPass($firstName, $lastName, $email, $newPassword);
                            $view = 'view/pfileEdit.php';
                        }
                    }
                }
            }

            if (empty($firstNameErrorMessage) && empty($lastNameErrorMessage) && empty($emailErrorMessage) && empty($passwordErrorMessage)) {
                $connection = new Connection();
                $connection->updateData($firstName, $lastName, $email);
                $view = 'view/pfileEdit.php';
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