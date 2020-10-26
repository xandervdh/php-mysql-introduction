<?php

class Auth {

    public function emailValidation(string $email, PDO $pdo)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return 'Invalid email adress!';
        }
        $handler = $pdo->prepare('SELECT first_name FROM students WHERE email = :email');
        $handler->bindValue(':email', $email);

        if ($handler->execute()){
            return 'Email is already in use!';
        }
        return "";
    }

    public function nameValidation(string $name)
    {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            return 'Only letters and white space allowed';
        }
    }

}