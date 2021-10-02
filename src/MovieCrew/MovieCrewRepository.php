<?php

declare(strict_types=1);

namespace Movies\MovieCrew;

use Movies\Database\IDatabase;
use Movies\Database\DatabaseException;

class MovieCrewRepository implements IMovieCrewRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(MovieCrewDto $dto): int
    {
        $sql = "INSERT INTO `movie_crew` (`movie_id`, `person_id`, `department_id`, `job`)
                VALUES (?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->movieId,
                $dto->personId,
                $dto->departmentId,
                $dto->job
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(MovieCrewDto $dto): int
    {
        $sql = "UPDATE `movie_crew` SET `movie_id` = ?, `person_id` = ?, `department_id` = ?, `job` = ?
                WHERE `movie_crew_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->movieId,
                $dto->personId,
                $dto->departmentId,
                $dto->job,
                $dto->movieCrewId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $movieCrewId): ?MovieCrewDto
    {
        $sql = "SELECT `movie_crew_id`, `movie_id`, `person_id`, `department_id`, `job`
                FROM `movie_crew` WHERE `movie_crew_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$movieCrewId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new MovieCrewDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `movie_crew_id`, `movie_id`, `person_id`, `department_id`, `job`
                FROM `movie_crew`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new MovieCrewDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $movieCrewId): int
    {
        $sql = "DELETE FROM `movie_crew` WHERE `movie_crew_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$movieCrewId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}