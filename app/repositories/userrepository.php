<?php

namespace repositories;

use models\User;
use PDO;
use PDOException;

class UserRepository extends Repository
{
    function getAll()
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
            $stmt->bindParam(':role_id', $role );
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
            $stmt = $this->connection->prepare("SELECT * FROM user WHERE email=? LIMIT 1");
            $stmt->bindParam(1, $email);
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
            $stmt = $this->connection->prepare("SELECT * FROM user WHERE name = ? LIMIT 1");
            $stmt->bindParam(1, $name);
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
            $stmt = $this->connection->prepare("SELECT * FROM user WHERE id = ? LIMIT 1");
            $stmt->bindParam(1, $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);
            return $stmt->fetch();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateOne(User $user)
    {
        try {
            $stmt = $this->connection->prepare("
                UPDATE user 
                SET name = ?, email = ?,  passwordhash = ?, role_id = ?
                WHERE id = ?");
            $name = $user->getName();
            $stmt->bindParam('sssii', $name, $user->getEmail(), $user->getPasswordhash(), $user->getRoleId(), $user->getId());
            return $stmt->execute();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function resetPasswordRequestAdd()
    {
        //DATE_ADD(NOW(), INTERVAL 15 MINUTE));
    }

    public function deleteOne($userId)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM user WHERE id = ? ");
            $stmt->bindParam(1, $userId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
