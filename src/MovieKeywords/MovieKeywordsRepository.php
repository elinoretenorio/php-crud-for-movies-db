<?php

declare(strict_types=1);

namespace Movies\MovieKeywords;

use Movies\Database\IDatabase;
use Movies\Database\DatabaseException;

class MovieKeywordsRepository implements IMovieKeywordsRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(MovieKeywordsDto $dto): int
    {
        $sql = "INSERT INTO `movie_keywords` (`movie_id`, `keyword_id`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->movieId,
                $dto->keywordId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(MovieKeywordsDto $dto): int
    {
        $sql = "UPDATE `movie_keywords` SET `movie_id` = ?, `keyword_id` = ?
                WHERE `movie_keywords_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->movieId,
                $dto->keywordId,
                $dto->movieKeywordsId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $movieKeywordsId): ?MovieKeywordsDto
    {
        $sql = "SELECT `movie_keywords_id`, `movie_id`, `keyword_id`
                FROM `movie_keywords` WHERE `movie_keywords_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$movieKeywordsId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new MovieKeywordsDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `movie_keywords_id`, `movie_id`, `keyword_id`
                FROM `movie_keywords`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new MovieKeywordsDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $movieKeywordsId): int
    {
        $sql = "DELETE FROM `movie_keywords` WHERE `movie_keywords_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$movieKeywordsId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}