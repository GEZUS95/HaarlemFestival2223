<?php

namespace repositories;

use PDO;
use PDOException;

class ApiKeyRepository extends Repository
{
    public function getAll(int $limit, int $offset)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM apikey LIMIT :limit OFFSET :offset");
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertOne(string $uuid, string $description)
    {
        try {
            $stmt = $this->connection->prepare("
                    INSERT INTO `apikey` (`uuid`, `description`, `created_at`)
                    VALUES (:uuid, :description, NOW())
                    ");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->bindParam(':description', $description);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function deleteOne(string $uuid)
    {
        try {
            $stmt = $this->connection->prepare("
                    DELETE FROM apikey WHERE uuid = :uuid
                    ");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneFromUuid(string $uuid)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM apikey WHERE uuid = :uuid LIMIT 1");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo $e;
        }
    }
}
