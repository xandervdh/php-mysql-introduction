<?php
declare(strict_types=1);

class RegisterController {
    public function render()
    {
        $view = 'view/register.php';
        $authorization = new Auth();
        $error = 'style="border-color: red"';
        $firstName = $lastName = $email = $password = $passwordConfirm = "";
        $firstNameError = $lastNameError = $emailError = $passwordError = $passwordConfirmError = "";
        $firstNameErrorMessage = $lastNameErrorMessage = $emailErrorMessage = $passwordErrorMessage = $passwordConfirmErrorMessage = "";
        //if post request
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST['firstName'])) {
                $firstNameErrorMessage = 'First name is required';
                $firstNameError = $error;
            } else {
                $firstName = $this->check_input($_POST['firstName']);
                $firstNameErrorMessage = $authorization->nameValidation($firstName); //validate first name
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
                $lastNameErrorMessage = $authorization->nameValidation($lastName); //validate last name
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
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ //check if email is valid
                    $emailErrorMessage = 'Invalid email adress!';
                    $emailError = $error;
                } else {
                    $emailErrorMessage = $authorization->emailValidation($email); //check if email already exists in database
                    if (!empty($emailErrorMessage)) {
                        $emailError = $error;
                    }
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

            //if password and confirm are filled in
            if (empty($passwordConfirmErrorMessage) && empty($passwordErrorMessage)) {
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //hash password
                $passwordErrorMessage = $authorization->passwordValidation($password, $_POST['passwordConfirm']);
                //if password and confirm are the same
                if (!empty($passwordErrorMessage)) {
                    $passwordConfirmError = $error;
                    $passwordError = $error;
                    $passwordConfirmErrorMessage = $passwordErrorMessage;
                }
            }

            //if no errors
            if (empty($firstNameErrorMessage) && empty($lastNameErrorMessage) && empty($emailErrorMessage) && empty($passwordErrorMessage)) {
                $student = new Student($firstName, $lastName, $email, $password); //new student object
                $connection = new Connection();
                $connection->insertData($student); //insert data
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
