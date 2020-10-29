<?php

class Auth {
    private Connection $connection;

    public function __construct()
    {
        $this->connection = new Connection();
    }

    //check if email is in database
    public function emailValidation(string $email): string
    {
        if ($this->connection->checkEmail($email) == true){
            return 'Email is already in use!';
        }
        return "";
    }
    //validate name
    public function nameValidation(string $name): string
    {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            return 'Only letters and white space allowed';
        }
        return "";
    }
    //validate password
    public function passwordValidation(string $password, string $passwordConfirm): string
    {
        if (password_verify($passwordConfirm, $password)){
            return "";
        }
        return "Password and the password confirmation don't match";
    }
    //check if email is in database
    public function checkEmail(string $email)
    {
        if ($this->connection->checkEmail($email) != true){
            return 'Something went wrong!';
        }
        return "";
    }
    //check if password is same as in database
    public function checkPassword(string $password, string $email)
    {
        $hash = $this->connection->getHash($email);
        if (password_verify($password, $hash['password'])){
            return "";
        }
        return "Something went wrong!";
    }

}