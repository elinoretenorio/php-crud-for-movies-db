<?php

declare(strict_types=1);

namespace Movies\Movie;

use Movies\Database\IDatabase;
use Movies\Database\DatabaseException;

class MovieRepository implements IMovieRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(MovieDto $dto): int
    {
        $sql = "INSERT INTO `movie` (`title`, `budget`, `homepage`, `overview`, `popularity`, `release_date`, `revenue`, `runtime`, `movie_status`, `tagline`, `vote_average`, `vote_count`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->title,
                $dto->budget,
                $dto->homepage,
                $dto->overview,
                $dto->popularity,
                $dto->releaseDate,
                $dto->revenue,
                $dto->runtime,
                $dto->movieStatus,
                $dto->tagline,
                $dto->voteAverage,
                $dto->voteCount
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(MovieDto $dto): int
    {
        $sql = "UPDATE `movie` SET `title` = ?, `budget` = ?, `homepage` = ?, `overview` = ?, `popularity` = ?, `release_date` = ?, `revenue` = ?, `runtime` = ?, `movie_status` = ?, `tagline` = ?, `vote_average` = ?, `vote_count` = ?
                WHERE `movie_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->title,
                $dto->budget,
                $dto->homepage,
                $dto->overview,
                $dto->popularity,
                $dto->releaseDate,
                $dto->revenue,
                $dto->runtime,
                $dto->movieStatus,
                $dto->tagline,
                $dto->voteAverage,
                $dto->voteCount,
                $dto->movieId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $movieId): ?MovieDto
    {
        $sql = "SELECT `movie_id`, `title`, `budget`, `homepage`, `overview`, `popularity`, `release_date`, `revenue`, `runtime`, `movie_status`, `tagline`, `vote_average`, `vote_count`
                FROM `movie` WHERE `movie_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$movieId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new MovieDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `movie_id`, `title`, `budget`, `homepage`, `overview`, `popularity`, `release_date`, `revenue`, `runtime`, `movie_status`, `tagline`, `vote_average`, `vote_count`
                FROM `movie`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new MovieDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $movieId): int
    {
        $sql = "DELETE FROM `movie` WHERE `movie_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$movieId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}