<?php

declare(strict_types=1);

namespace Movies\MovieCast;

use Movies\Database\IDatabase;
use Movies\Database\DatabaseException;

class MovieCastRepository implements IMovieCastRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(MovieCastDto $dto): int
    {
        $sql = "INSERT INTO `movie_cast` (`movie_id`, `person_id`, `character_name`, `gender_id`, `cast_order`)
                VALUES (?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->movieId,
                $dto->personId,
                $dto->characterName,
                $dto->genderId,
                $dto->castOrder
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(MovieCastDto $dto): int
    {
        $sql = "UPDATE `movie_cast` SET `movie_id` = ?, `person_id` = ?, `character_name` = ?, `gender_id` = ?, `cast_order` = ?
                WHERE `movie_cast_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->movieId,
                $dto->personId,
                $dto->characterName,
                $dto->genderId,
                $dto->castOrder,
                $dto->movieCastId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $movieCastId): ?MovieCastDto
    {
        $sql = "SELECT `movie_cast_id`, `movie_id`, `person_id`, `character_name`, `gender_id`, `cast_order`
                FROM `movie_cast` WHERE `movie_cast_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$movieCastId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new MovieCastDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `movie_cast_id`, `movie_id`, `person_id`, `character_name`, `gender_id`, `cast_order`
                FROM `movie_cast`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new MovieCastDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $movieCastId): int
    {
        $sql = "DELETE FROM `movie_cast` WHERE `movie_cast_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$movieCastId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}