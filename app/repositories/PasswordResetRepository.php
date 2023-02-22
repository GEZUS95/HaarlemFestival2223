<?php

namespace repositories;

use PDO;

class PasswordResetRepository extends Repository
{
    public function getOneFromUuid(string $uuid)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM passwordreset WHERE uuid = :uuid");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return $e;
        }
    }

    public function insertOne(string $uuid, int $userId, \DateTime $expires)
    {
        try {
            $stmt = $this->connection->prepare("
                INSERT INTO passwordreset (`uuid`, `user_id`, `expires_at`)
                VALUES (:uuid, :userid, :expires)
                ");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->bindParam(':userid', $userId);
            $stmt->bindParam(':expires', $expires);
            $stmt->execute();
        } catch (\PDOException $e) {
            return $e;
        }
    }

    public function deleteOne($uuid)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM passwordreset WHERE uuid = :uuid");
            $stmt->bindParam(':uuid', $uuid);
            $stmt->execute();
        } catch (\PDOException $e) {
            return $e;
        }
    }
}