<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'model/Connection.php';
require 'model/Student.php';

$error = 'style="border-color: red"';
$firstName = $lastName = $email = "";
$firstNameError = $lastNameError = $emailError = "";
$firstNameErrorMessage = $lastNameErrorMessage = $emailErrorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['firstName'])) {
        $firstNameErrorMessage = 'First name is required';
        $firstNameError = $error;
    } else {
        $firstName = check_input($_POST['firstName']);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $firstName)) {
            $firstNameError = $error;
            $firstNameErrorMessage = "Only letters and white space allowed";
        }
    }

    if (empty($_POST['lastName'])) {
        $lastNameErrorMessage = 'Last name is required';
        $lastNameError = $error;
    } else {
        $lastName = check_input($_POST['lastName']);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $lastName)) {
            $lastNameError = $error;
            $lastNameErrorMessage = "Only letters and white space allowed";
        }
    }

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

    if (empty($firstNameErrorMessage && $lastNameErrorMessage && $emailErrorMessage)){
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
        <input type="text" name="firstName" id="firstName" <?php echo $firstNameError; ?>><br>
        <span class="required">* <?php echo $firstNameErrorMessage; ?></span><br>
        <label for="lastName">Last name</label><br>
        <input type="text" name="lastName" id="lastName" <?php echo $lastNameError; ?>><br>
        <span class="required">* <?php echo $lastNameErrorMessage; ?></span><br>
        <label for="email">Email</label><br>
        <input type="text" name="email" id="email" <?php echo $emailError; ?>><br>
        <span class="required">* <?php echo $emailErrorMessage; ?></span><br>
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
