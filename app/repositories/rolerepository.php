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

    public function insertOne(Role $role)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO role ('name', 'description')");
            $name = $role->getName(); //todo: blijkbaar werkt het niet als deze statement direct in de bindparam zit
            $stmt->bindParam('ss', $name, $role->getDescription());

            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function getOneById(int $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM role WHERE id = ? LIMIT 1");
            $stmt->bindParam(1, $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Role::class);
            return $stmt->fetch();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateOne(Role $role)
    {
        try {
            $stmt = $this->connection->prepare("
                UPDATE role 
                SET name = ?, description = ?
                WHERE id = ?");
            $name = $role->getName();
            $stmt->bindParam('ssi', $name, $role->getDescription(), $role->getId());
            return $stmt->execute();

        } catch (PDOException $e) {
            echo $e;
        }
    }
}