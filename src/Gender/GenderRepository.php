<?php

declare(strict_types=1);

namespace Movies\Gender;

use Movies\Database\IDatabase;
use Movies\Database\DatabaseException;

class GenderRepository implements IGenderRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(GenderDto $dto): int
    {
        $sql = "INSERT INTO `gender` (`gender`)
                VALUES (?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->gender
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(GenderDto $dto): int
    {
        $sql = "UPDATE `gender` SET `gender` = ?
                WHERE `gender_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->gender,
                $dto->genderId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $genderId): ?GenderDto
    {
        $sql = "SELECT `gender_id`, `gender`
                FROM `gender` WHERE `gender_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$genderId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new GenderDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `gender_id`, `gender`
                FROM `gender`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new GenderDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $genderId): int
    {
        $sql = "DELETE FROM `gender` WHERE `gender_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$genderId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}