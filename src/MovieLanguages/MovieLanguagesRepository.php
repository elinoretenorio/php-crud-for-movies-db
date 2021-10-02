<?php

declare(strict_types=1);

namespace Movies\MovieLanguages;

use Movies\Database\IDatabase;
use Movies\Database\DatabaseException;

class MovieLanguagesRepository implements IMovieLanguagesRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(MovieLanguagesDto $dto): int
    {
        $sql = "INSERT INTO `movie_languages` (`movie_id`, `language_id`, `language_role_id`)
                VALUES (?, ?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->movieId,
                $dto->languageId,
                $dto->languageRoleId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(MovieLanguagesDto $dto): int
    {
        $sql = "UPDATE `movie_languages` SET `movie_id` = ?, `language_id` = ?, `language_role_id` = ?
                WHERE `movie_languages_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->movieId,
                $dto->languageId,
                $dto->languageRoleId,
                $dto->movieLanguagesId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $movieLanguagesId): ?MovieLanguagesDto
    {
        $sql = "SELECT `movie_languages_id`, `movie_id`, `language_id`, `language_role_id`
                FROM `movie_languages` WHERE `movie_languages_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$movieLanguagesId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new MovieLanguagesDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `movie_languages_id`, `movie_id`, `language_id`, `language_role_id`
                FROM `movie_languages`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new MovieLanguagesDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $movieLanguagesId): int
    {
        $sql = "DELETE FROM `movie_languages` WHERE `movie_languages_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$movieLanguagesId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}