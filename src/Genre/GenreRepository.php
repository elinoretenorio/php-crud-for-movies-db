<?php

declare(strict_types=1);

namespace Movies\Genre;

use Movies\Database\IDatabase;
use Movies\Database\DatabaseException;

class GenreRepository implements IGenreRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(GenreDto $dto): int
    {
        $sql = "INSERT INTO `genre` (`genre_name`)
                VALUES (?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->genreName
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(GenreDto $dto): int
    {
        $sql = "UPDATE `genre` SET `genre_name` = ?
                WHERE `genre_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->genreName,
                $dto->genreId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $genreId): ?GenreDto
    {
        $sql = "SELECT `genre_id`, `genre_name`
                FROM `genre` WHERE `genre_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$genreId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new GenreDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `genre_id`, `genre_name`
                FROM `genre`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new GenreDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $genreId): int
    {
        $sql = "DELETE FROM `genre` WHERE `genre_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$genreId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}