<?php

class database
{
    private $dsn = "mysql:host=localhost;dbname=swib_jpo_2";
    private $username = "root";
    private $password = "";

    public function connect()
    {
        try {
            $pdo = new PDO($this->dsn, $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $error) {
            echo "Connection failed: " . $error->getMessage() . "<br>";
        }
    }
}
