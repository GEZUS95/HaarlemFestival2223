<?php

namespace repositories;

use models\Content;
use models\ProgramItem;
use models\Restaurant;
use PDO;
use PDOException;

class ContentRepository extends Repository
{
    public function getAll(int $limit, int $offset)
    {
        {
            try {
                $stmt = $this->connection->prepare("SELECT * FROM content LIMIT :limit OFFSET :offset");
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
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

    public function getAllHighlightsNonFood(int $eventId)
    {
        try {
            $stmt = $this->connection->prepare("
                    SELECT
                        programitem.title,
                        programitem.start_time,
                        artist.name,
                        artist.description,
                        specialguest.name AS special_guest_name,
                        specialguest.description AS special_guest_description
                    FROM programitem
                    INNER JOIN program ON programitem.program_id = program.id
                    INNER JOIN artist ON programitem.artist_id = artist.id
                    LEFT JOIN artist AS specialguest ON programitem.special_guest_id = specialguest.id
                    WHERE highlight = 1 AND program.event_id = :event LIMIT 5
                    ");
            $stmt->bindParam(':event', $eventId);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getAllHighlightsFood()
    {
        try {
            $stmt = $this->connection->prepare("
                    SELECT * FROM restaurant WHERE highlight = 1 LIMIT 5");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Restaurant::class);
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getAllPagesNonDeletable()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM content WHERE deletable = 1");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, Content::class);
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            echo $e;
        }
    }
}
