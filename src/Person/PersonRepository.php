<?php

declare(strict_types=1);

namespace Movies\Person;

use Movies\Database\IDatabase;
use Movies\Database\DatabaseException;

class PersonRepository implements IPersonRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(PersonDto $dto): int
    {
        $sql = "INSERT INTO `person` (`person_name`)
                VALUES (?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->personName
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(PersonDto $dto): int
    {
        $sql = "UPDATE `person` SET `person_name` = ?
                WHERE `person_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->personName,
                $dto->personId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $personId): ?PersonDto
    {
        $sql = "SELECT `person_id`, `person_name`
                FROM `person` WHERE `person_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$personId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new PersonDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `person_id`, `person_name`
                FROM `person`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new PersonDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $personId): int
    {
        $sql = "DELETE FROM `person` WHERE `person_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$personId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}