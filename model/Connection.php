<?php
declare(strict_types=1);

class Connection {
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = $this->openDB();
    }

    //get database connection
    public function openDB()
    {
        $dbhost = "localhost";
        $dbuser = "becode";
        $dbpass = "Becode@123";
        $db = "becode";

        $driverOptions = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        return new PDO('mysql:host=' . $dbhost . ';dbname=' . $db, $dbuser, $dbpass, $driverOptions);
    }

    public function insertData(Student $student): void
    {
        $handler = $this->pdo->prepare('INSERT INTO students (first_name, last_name, email, password, image) VALUES (?, ?, ?, ?, ?)');
        $handler->execute([$student->getFirstName(), $student->getLastName(), $student->getEmail(), $student->getPassword(), $student->getImage()]);
    }

    public function getAllData(): array
    {
        $handler = $this->pdo->prepare('SELECT id, first_name, last_name, email, created_at, image FROM students');
        $handler->execute();
        $students = $handler->fetchAll();
        return $students;
    }

    public function getProfile(): array
    {
        $handler = $this->pdo->prepare('SELECT first_name, last_name, email, created_at, password, image FROM students WHERE id = :id');
        $handler->bindValue(':id', $_GET['user']);
        $handler->execute();
        $student = $handler->fetch();
        return $student;
    }

    public function checkEmail(string $email): bool
    {
        $handler = $this->pdo->prepare('SELECT email FROM students WHERE email = :email');
        $handler->bindValue(':email', $email);
        $handler->execute();
        if ($handler->fetch()){
            return true;
        } else {
            return false;
        }
    }

    public function getId(string $email)
    {
        $handler = $this->pdo->prepare('SELECT id FROM students WHERE email = :email');
        $handler->bindValue(':email', $email);
        $handler->execute();
        return $handler->fetch();
    }

    public function getHash(string $email)
    {
        $handler = $this->pdo->prepare('SELECT password FROM students WHERE email = :email');
        $handler->bindValue(':email', $email);
        $handler->execute();
        return $handler->fetch();
    }

    public function deleteProfile(int $id): void
    {
        $handler = $this->pdo->prepare('DELETE FROM students WHERE id = :id');
        $handler->bindValue(':id', $id);
        $handler->execute();
    }

    public function updateData(string $firstname, string $lastname, string $email): void
    {
        $handler = $this->pdo->prepare('UPDATE students SET first_name = :firstname, last_name = :lastname, email = :email WHERE email = :email');
        $handler->bindValue(':firstname', $firstname);
        $handler->bindValue(':lastname', $lastname);
        $handler->bindValue(':email', $email);
        $handler->execute();
    }

    public function updateDataPass(string $firstname, string $lastname, string $email, $password): void
    {
        $handler = $this->pdo->prepare('UPDATE students SET first_name = :firstname, last_name = :lastname, email = :email, password = :password WHERE email = :email');
        $handler->bindValue(':firstname', $firstname);
        $handler->bindValue(':lastname', $lastname);
        $handler->bindValue(':email', $email);
        $handler->bindValue(':password', $password);
        $handler->execute();
    }

    public function getProfileEdit(): array
    {
        $handler = $this->pdo->prepare('SELECT first_name, last_name, email, created_at, password FROM students WHERE id = :id');
        $handler->bindValue(':id', $_GET['edit']);
        $handler->execute();
        $student = $handler->fetch();
        return $student;
    }
}