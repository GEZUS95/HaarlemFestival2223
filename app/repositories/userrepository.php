<?php

namespace repositories;

use models\User;
use PDO;
use PDOException;

class UserRepository extends Repository
{
    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM user");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertOne(int $role, string $name, string $email, string $password)
    {
        try {
            $stmt = $this->connection->prepare("
                    INSERT INTO `user` (`role_id`, `name`, `email`, `passwordhash`, `created_at`)
                    VALUES (:role_id, :name, :email, :password, NOW())
                    ");
            $stmt->bindParam(':role_id', $role);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneByEmail(string $email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM user WHERE email= :email LIMIT 1");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
            return $stmt->fetch();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneByName(string $name)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM user WHERE name = :name LIMIT 1");
            $stmt->bindParam(':name', $name);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
            return $stmt->fetch();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneById(int $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM user WHERE id = :id LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
            return $stmt->fetch();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateOne($name, $email, $role, $id)
    {
        try {
            $stmt = $this->connection->prepare("
        UPDATE user
        SET name = :name, email = :email, role_id = :role_id
        WHERE id = :id");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':role_id', $role);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function deleteOne($userId)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM user WHERE id = :id ");
            $stmt->bindParam(':id', $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updatePassword(int $userId, string $password)
    {
        try {
            $stmt = $this->connection->prepare("
        UPDATE user
        SET passwordhash = :password
        WHERE id = :id");
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();

        } catch (PDOException $e) {
            echo $e;
        }
    }
}
