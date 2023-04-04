<?php

namespace repositories;
use models\Program;
use models\ProgramItem;
use PDO;
use PDOException;

class ProgramRepository extends Repository
{
    private ProgramItemRepository $programItemRepository;

    public function __construct()
    {
        parent::__construct();
        $this->programItemRepository = new ProgramItemRepository();
    }

    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM program');
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Program::class);
            $programs = $stmt->fetchAll();
            foreach ($programs as $program)
            {
                $program->setProgramItems($this->programItemRepository->getAllByProgramId($program->getId()));
            }
            return $programs;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getAllByEventId(int $eventId)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM program WHERE event_id = ?');
            $stmt->bindParam(1, $eventId);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Program::class);
            $programs = $stmt->fetchAll();
            foreach ($programs as $program)
            {
                $program->setProgramItems($this->programItemRepository->getAllByProgramId($program->getId()));
            }
            return $programs;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneById(int $id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM program WHERE id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Program::class);
            $program = $stmt->fetch();
            $program->setProgramItems($this->programItemRepository->getAllByProgramId($program->getId()));
            return $program;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneByEventId(int $event_id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM program WHERE event_id = ?');
            $stmt->bindParam(1, $event_id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Program::class);
            $program = $stmt->fetch();
            $program->setProgramItems($this->programItemRepository->getAllByProgramId($program->getId()));
            return $program;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneByContentId(int $content_id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM program WHERE content_id = ?');
            $stmt->bindParam(1, $content_id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Program::class);
            $program = $stmt->fetch();
            $program->setProgramItems($this->programItemRepository->getAllByProgramId($program->getId()));
            return $program;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneByTitle(string $title)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM program WHERE title = ?');
            $stmt->bindParam(1, $title);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Program::class);
            $program = $stmt->fetch();
            $program->setProgramItems($this->programItemRepository->getAllByProgramId($program->getId()));
            return $program;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function insertOne(int $event_id,string $title, float $price, \DateTime $start_time, \DateTime $end_time)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO program (event_id, title, price, start_time, end_time) VALUES (?, ?, ?, ?, ?)');
            $start_time = $start_time->format('Y-m-d H:i:s');
            $end_time = $end_time->format('Y-m-d H:i:s');
            $stmt->bindParam(1, $event_id);
            $stmt->bindParam(2, $title);
            $stmt->bindParam(3, $price);
            $stmt->bindParam(4, $start_time);
            $stmt->bindParam(5, $end_time);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Program::class);
            $program = $stmt->fetch();
            return $program;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }
    public function updateOne(int $id, int $event_id, string $title, float $price, \DateTime $start_time, \DateTime $end_time)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE program SET event_id = ?, title = ?, price = ?, start_time = ?, end_time = ? WHERE id = ?');
            $start_time = $start_time->format('Y-m-d H:i:s');
            $end_time = $end_time->format('Y-m-d H:i:s');
            $stmt->bindParam(1, $event_id);
            $stmt->bindParam(2, $title);
            $stmt->bindParam(3, $price);
            $stmt->bindParam(4, $start_time);
            $stmt->bindParam(5, $end_time);
            $stmt->bindParam(6, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Program::class);
            $program = $stmt->fetch();
            return $program;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function deleteOne(int $id)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM program WHERE id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Program::class);
            $program = $stmt->fetch();
            return $program;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
