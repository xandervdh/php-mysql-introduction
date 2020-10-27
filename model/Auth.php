<?php

class Auth {

    public function emailValidation(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return 'Invalid email adress!';
        }
        $connection = new Connection();

        if ($connection->checkEmail($email) == true){
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