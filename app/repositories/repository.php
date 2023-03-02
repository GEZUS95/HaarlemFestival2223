<?php

namespace repositories;

use PDO;
use PDOException;

class Repository
{
    protected $connection;

    public function __construct()
    {
        require __DIR__ . '/../config/dbconfig.php';

        try {
            //$this->connection = new PDO("$type:host=$servername;dbname=$database", $username, $password);
            $this->connection = new PDO("mysql:host=mysql;dbname=developmentdb", 'root', 'secret123');
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
