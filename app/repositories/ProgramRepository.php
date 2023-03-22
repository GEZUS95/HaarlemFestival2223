<?php

namespace repositories;
use models\Program;
use models\ProgramItem;

class ProgramRepository extends Repository
{
    //model class of program
    //private int $id;
    //private int $event_id;
    //private int $content_id;
    //private array $program_items;
    //private string $title;
    //private float $total_price_program;
    //private \DateTime $start_time;
    //private \DateTime $end_time;

    //model class of programitem
    //private int $id;
    //private int $location_id;
    //private int $artist_id;
    //private int $special_guest_id;
    //private int $content_id;
    //private \DateTime $start_time;
    //private \DateTime $end_time;
    //private float $price;

    public function getAll()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM program');
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Program::class);
            $programs = $stmt->fetchAll();
            foreach ($programs as $program) {
                $program->setProgramItems($this->getProgramItemsByProgramId($program->getId()));
            }
            return $programs;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getProgramItemsByProgramId(int $id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM programitem WHERE program_id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, ProgramItem::class);
            $programItems = $stmt->fetchAll();
            return $programItems;
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
            $program->setProgramItems($this->getProgramItemsByProgramId($id));
            return $program;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneByEventId(int $id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM program WHERE event_id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Program::class);
            $program = $stmt->fetch();
            $program->setProgramItems($this->getProgramItemsByProgramId($program->getId()));
            return $program;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneByContentId(int $id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM program WHERE content_id = ?');
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Program::class);
            $program = $stmt->fetch();
            $program->setProgramItems($this->getProgramItemsByProgramId($program->getId()));
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
            $program->setProgramItems($this->getProgramItemsByProgramId($program->getId()));
            return $program;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function getOneByTotalPriceProgram(float $totalPriceProgram)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM program WHERE total_price_program = ?');
            $stmt->bindParam(1, $totalPriceProgram);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, Program::class);
            $program = $stmt->fetch();
            $program->setProgramItems($this->getProgramItemsByProgramId($program->getId()));
            return $program;
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function insertOneProgramWithProgramItems(Program $program)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO program (event_id, content_id, title, total_price_program, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->bindParam(1, $program->getEventId());
            $stmt->bindParam(2, $program->getContentId());
            $stmt->bindParam(3, $program->getTitle());
            $stmt->bindParam(4, $program->getTotalPriceProgram());
            $stmt->bindParam(5, $program->getStartTime());
            $stmt->bindParam(6, $program->getEndTime());
            $stmt->execute();
            $program->setId($this->connection->lastInsertId());
            $this->insertProgramItems($program->getProgramItems(), $program->getId());
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function insertOneProgram(Program $program, array $programItems)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO program (event_id, content_id, title, total_price_program, start_time, end_time) VALUES (?, ?, ?, ?, ?, ?)');
            $stmt->bindParam(1, $program->getEventId());
            $stmt->bindParam(2, $program->getContentId());
            $stmt->bindParam(3, $program->getTitle());
            $stmt->bindParam(4, $program->getTotalPriceProgram());
            $stmt->bindParam(5, $program->getStartTime());
            $stmt->bindParam(6, $program->getEndTime());
            $stmt->execute();
            $this->insertProgramItems($programItems, $program->getId());
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function insertOneProgramItem(ProgramItem $programItem)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO programitem (program_id, location_id, artist_id, special_guest_id, content_id, start_time, end_time, price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->bindParam(1, $programItem->getProgramId());
            $stmt->bindParam(2, $programItem->getLocationId());
            $stmt->bindParam(3, $programItem->getArtistId());
            $stmt->bindParam(4, $programItem->getSpecialGuestId());
            $stmt->bindParam(5, $programItem->getContentId());
            $stmt->bindParam(6, $programItem->getStartTime());
            $stmt->bindParam(7, $programItem->getEndTime());
            $stmt->bindParam(8, $programItem->getPrice());
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function insertProgramItems(array $programItems, int $programId)
    {
        foreach ($programItems as $programItem) {
            $programItem->setProgramId($programId);
            $this->insertOneProgramItem($programItem);
        }
    }

    public function updateOneProgram(Program $program)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE program SET event_id = ?, content_id = ?, title = ?, total_price_program = ?, start_time = ?, end_time = ? WHERE id = ?');
            $stmt->bindParam(1, $program->getEventId());
            $stmt->bindParam(2, $program->getContentId());
            $stmt->bindParam(3, $program->getTitle());
            $stmt->bindParam(4, $program->getTotalPriceProgram());
            $stmt->bindParam(5, $program->getStartTime());
            $stmt->bindParam(6, $program->getEndTime());
            $stmt->bindParam(7, $program->getId());
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function updateOneProgramItem(ProgramItem $programItem)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE programitem SET program_id = ?, location_id = ?, artist_id = ?, special_guest_id = ?, content_id = ?, start_time = ?, end_time = ?, price = ? WHERE id = ?');
            $stmt->bindParam(1, $programItem->getProgramId());
            $stmt->bindParam(2, $programItem->getLocationId());
            $stmt->bindParam(3, $programItem->getArtistId());
            $stmt->bindParam(4, $programItem->getSpecialGuestId());
            $stmt->bindParam(5, $programItem->getContentId());
            $stmt->bindParam(6, $programItem->getStartTime());
            $stmt->bindParam(7, $programItem->getEndTime());
            $stmt->bindParam(8, $programItem->getPrice());
            $stmt->bindParam(9, $programItem->getId());
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function deleteOneProgram(Program $program)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM program WHERE id = ?');
            $stmt->bindParam(1, $program->getId());
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function deleteOneProgramItem(ProgramItem $programItem)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM programitem WHERE id = ?');
            $stmt->bindParam(1, $programItem->getId());
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }

    public function deleteProgramItemsByProgramId(int $programId)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM programitem WHERE program_id = ?');
            $stmt->bindParam(1, $programId);
            $stmt->execute();
        } catch (PDOException $e)
        {
            echo $e;
        }
    }
}
