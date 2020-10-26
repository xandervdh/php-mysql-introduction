<?php
declare(strict_types=1);

class Connection {
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = $this->openDB();
    }


    private function openDB()
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

    public function insertData(Student $student)
    {
        $handler = $this->pdo->prepare('INSERT INTO students (first_name, last_name, email) VALUES (?, ?, ?)');
        $handler->execute([$student->getFirstName(), $student->getLastName(), $student->getEmail()]);
    }

    public function getAllData()
    {
        $handler = $this->pdo->prepare('SELECT id, first_name, last_name, email, created_at FROM students');
        $handler->execute();
        $students = $handler->fetchAll();
        return $students;
    }

    public function getProfile()
    {
        $handler = $this->pdo->prepare('SELECT first_name, last_name, email, created_at FROM students WHERE id = :id');
        $handler->bindValue(':id', $_GET['user']);
        $handler->execute();
        $student = $handler->fetch();
        return $student;
    }
}