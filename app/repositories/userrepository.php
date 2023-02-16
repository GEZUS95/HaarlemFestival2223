<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/user.php';

class UserRepository extends Repository{
    function getAll() {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM user");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            return $stmt->fetchAll();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function insertOne(User $user)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO user ('name', 'email', 'passwordhash', 'description', 'role_id')");
            $name = $user->getName(); //todo: blijkbaar werkt het niet als deze statement direct in de bindparam zit
            $stmt->bindParam('ssssi', $name, $user->getEmail(), $user->getPasswordhash(), $user->getDescription(), $user->getRoleId());

            return $stmt->execute();
        }
        catch (PDOException $e){
            echo $e;
        }
    }

    public function getOneByEmail(string $email)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM user WHERE email=? LIMIT 1");
            $stmt->bindParam(1, $email);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            return $stmt->fetch();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }
    public function getOneByName(string $name)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM user WHERE name = ? LIMIT 1");
            $stmt->bindParam(1, $name);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            return $stmt->fetch();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }
    public function getOneById(int $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM user WHERE id = ? LIMIT 1");
            $stmt->bindParam(1, $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
            return $stmt->fetch();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function updateOne(User $user)
    {
        try {
            $stmt = $this->connection->prepare("
                UPDATE user 
                SET name = ?, email = ?,  passwordhash = ?, description = ?, role = ?
                WHERE id = ?");
            $name = $user->getName();
            $stmt->bindParam('ssssii', $name, $user->getEmail(), $user->getPasswordhash(), $user->getDescription(), $user->getRoleId(), $user->getId());
            return $stmt->execute();

        } catch (PDOException $e)
        {
            echo $e;
        }
    }
}