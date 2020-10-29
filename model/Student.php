<?php
class Student {

    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private string $image;

    public function __construct(string $firstName, string $lastName, string $email, $password)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;

        $cat = file_get_contents("https://api.thecatapi.com/v1/images/search");
        $catPicture = json_decode($cat, true);
        $this->image = $catPicture[0]['url'];
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}