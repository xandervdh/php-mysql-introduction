<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'model/Auth.php';
require 'model/Connection.php';
require 'model/Student.php';
session_start();

$authConnection = new Connection();
$pdo = $authConnection->openDB();
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
        $firstName = check_input($_POST['firstName']);
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
        $lastName = check_input($_POST['lastName']);
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
    } /*else {
        $password = $_POST['password'];
        //$passwordErrorMessage = $authorization->passwordValidation($password, $_POST['passwordConfirm']);
        if (!empty($passwordErrorMessage)) { //check if input has a valid email
            $passwordError = $error; //give error style
        } else {$_SESSION['password'] = $password;}
    }*/

    if (empty($_POST['passwordConfirm'])) {
        $passwordConfirmErrorMessage = 'Password confirmation is required';
        $passwordConfirmError = $error;
    } /*else {
        $passwordConfirm = $_POST['passwordConfirm'];
        $passwordErrorMessage = $authorization->passwordValidation($password, $passwordConfirm);
        if (!empty($passwordErrorMessage)) { //check if input has a valid email
            $passwordConfirmError = $error; //give error style
            $passwordConfirmErrorMessage = "";
        } else {$_SESSION['passwordConfirm'] = $passwordConfirm;}
    }*/

    if (empty($passwordConfirmErrorMessage) && empty($passwordErrorMessage)) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $passwordConfirm = $_POST['passwordConfirm'];
        $passwordErrorMessage = $authorization->passwordValidation($password, $passwordConfirm);
        if (!empty($passwordErrorMessage)) {
            $passwordConfirmError = $error;
            $passwordError = $error;
            $passwordConfirmErrorMessage = $passwordErrorMessage;
        } else {
            $_SESSION['password'] = $password;
            $_SESSION['passwordConfirm'] = $passwordConfirm;
        }
    }

    if (empty($firstNameErrorMessage) && empty($lastNameErrorMessage) && empty($emailErrorMessage) && empty($passwordErrorMessage)) {
        $student = new Student($firstName, $lastName, $email);
        $connection = new Connection();
        $connection->insertData($student);
    }
}

function check_input($data)
{
    $data = trim($data); //remove whitespace from beginning and end of input
    $data = stripslashes($data); //remove slashes
    $data = htmlspecialchars($data); //changes html elements to characters
    return $data;
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="style/stylesheet.css">
    <title>Registration</title>
</head>
<body>

<div id="form">
    <span class="required">* = required</span>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="firstName">First name</label><br>
        <input type="text" name="firstName" id="firstName"
               value="<?php echo $firstName ?>" <?php echo $firstNameError; ?>><br>
        <span class="required">* <?php echo $firstNameErrorMessage; ?></span><br>

        <label for="lastName">Last name</label><br>
        <input type="text" name="lastName" id="lastName"
               value="<?php echo $lastName ?>" <?php echo $lastNameError; ?>><br>
        <span class="required">* <?php echo $lastNameErrorMessage; ?></span><br>

        <label for="email">Email</label><br>
        <input type="text" name="email" id="email" value="<?php echo $email ?>" <?php echo $emailError; ?>><br>
        <span class="required">* <?php echo $emailErrorMessage; ?></span><br>

        <label for="password">Password</label><br>
        <input type="password" name="password" id="password"
            <?php echo $passwordError; ?>><br>
        <span class="required">* <?php echo $passwordErrorMessage; ?></span><br>

        <label for="passwordConfirm">Confirm password</label><br>
        <input type="password" name="passwordConfirm" id="passwordConfirm"
            <?php echo $passwordConfirmError; ?>><br>
        <span class="required">* <?php echo $passwordConfirmErrorMessage; ?></span><br>

        <input type="submit" value="Submit">
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
        integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
        crossorigin="anonymous"></script>
</body>
</html>
