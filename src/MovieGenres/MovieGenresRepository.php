<?php

declare(strict_types=1);

namespace Movies\MovieGenres;

use Movies\Database\IDatabase;
use Movies\Database\DatabaseException;

class MovieGenresRepository implements IMovieGenresRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(MovieGenresDto $dto): int
    {
        $sql = "INSERT INTO `movie_genres` (`movie_id`, `genre_id`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->movieId,
                $dto->genreId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(MovieGenresDto $dto): int
    {
        $sql = "UPDATE `movie_genres` SET `movie_id` = ?, `genre_id` = ?
                WHERE `movie_genres_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->movieId,
                $dto->genreId,
                $dto->movieGenresId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $movieGenresId): ?MovieGenresDto
    {
        $sql = "SELECT `movie_genres_id`, `movie_id`, `genre_id`
                FROM `movie_genres` WHERE `movie_genres_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$movieGenresId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new MovieGenresDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `movie_genres_id`, `movie_id`, `genre_id`
                FROM `movie_genres`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new MovieGenresDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $movieGenresId): int
    {
        $sql = "DELETE FROM `movie_genres` WHERE `movie_genres_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$movieGenresId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}