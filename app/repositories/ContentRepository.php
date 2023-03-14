<?php

namespace repositories;

use models\Content;
use PDO;
use PDOException;

class ContentRepository extends Repository
{
    public function getAll()
    {
        {
            try {
                $stmt = $this->connection->prepare("SELECT * FROM content");
                $stmt->execute();

                $stmt->setFetchMode(PDO::FETCH_CLASS, Content::class);
                return $stmt->fetchAll();

            } catch (PDOException $e) {
                echo $e;
            }
        }
    }

    public function getOneByTitle(string $title)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM content WHERE title = :title LIMIT 1");
            $stmt->bindParam(':title', $title);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Content::class);
            return $stmt->fetch();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getOneById(int $id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM content WHERE id = :id LIMIT 1");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Content::class);
            return $stmt->fetch();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function insertOne(string $title, string $body, string $image)
    {
        try {
            $stmt = $this->connection->prepare("
                    INSERT INTO `content` (`title`, `body`, `image_path`)
                    VALUES (:title, :body, :image)
                    ");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':body', $body);
            $stmt->bindParam(':image', $image);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function updateOne(int $id, string $title, string $body, string $image)
    {
        try {
            $stmt = $this->connection->prepare("
                UPDATE content
                SET title = :title, body = :body, image_path = :image
                WHERE id = :id");
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':body', $body);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function deleteOne(int $id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM content WHERE id = :id ");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
