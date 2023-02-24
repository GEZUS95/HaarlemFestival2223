<?php

namespace repositories;

use PDO;
use PDOException;
use models\Role;

class RoleRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM role");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Role::class);
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertOne(string $name, string $description)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO role ('name', 'description') VALUES (:name, :description)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function getOneById(int $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM role WHERE id = :id LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Role::class);
            return $stmt->fetch();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateOne(string $name, string $description, int $id)
    {
        try {
            $stmt = $this->connection->prepare("
                UPDATE role 
                SET name = :name, description = :description
                WHERE id = :role_id");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam('role_id', $id);
            return $stmt->execute();

        } catch (PDOException $e) {
            echo $e;
        }
    }
}