<?php

class Auth {

    public function emailValidation(string $email, PDO $pdo)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return 'Invalid email adress!';
        }
        $handler = $pdo->prepare('SELECT email FROM students WHERE email = :email');
        $handler->bindValue(':email', $email);
        $handler->execute();
        $dbEmail = $handler->fetch();

        if ($dbEmail['email'] === $email){
            return 'Email is already in use!';
        }
        return "";
    }

    public function nameValidation(string $name)
    {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            return 'Only letters and white space allowed';
        }
        return "";
    }

}