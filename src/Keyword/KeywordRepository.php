<?php

declare(strict_types=1);

namespace Movies\Keyword;

use Movies\Database\IDatabase;
use Movies\Database\DatabaseException;

class KeywordRepository implements IKeywordRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(KeywordDto $dto): int
    {
        $sql = "INSERT INTO `keyword` (`keyword_name`)
                VALUES (?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->keywordName
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(KeywordDto $dto): int
    {
        $sql = "UPDATE `keyword` SET `keyword_name` = ?
                WHERE `keyword_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->keywordName,
                $dto->keywordId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $keywordId): ?KeywordDto
    {
        $sql = "SELECT `keyword_id`, `keyword_name`
                FROM `keyword` WHERE `keyword_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$keywordId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new KeywordDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `keyword_id`, `keyword_name`
                FROM `keyword`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new KeywordDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $keywordId): int
    {
        $sql = "DELETE FROM `keyword` WHERE `keyword_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$keywordId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}