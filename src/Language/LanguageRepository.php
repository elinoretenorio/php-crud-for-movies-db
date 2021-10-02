<?php

declare(strict_types=1);

namespace Movies\Language;

use Movies\Database\IDatabase;
use Movies\Database\DatabaseException;

class LanguageRepository implements ILanguageRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(LanguageDto $dto): int
    {
        $sql = "INSERT INTO `language` (`language_code`, `language_name`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->languageCode,
                $dto->languageName
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(LanguageDto $dto): int
    {
        $sql = "UPDATE `language` SET `language_code` = ?, `language_name` = ?
                WHERE `language_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->languageCode,
                $dto->languageName,
                $dto->languageId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $languageId): ?LanguageDto
    {
        $sql = "SELECT `language_id`, `language_code`, `language_name`
                FROM `language` WHERE `language_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$languageId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new LanguageDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `language_id`, `language_code`, `language_name`
                FROM `language`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new LanguageDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $languageId): int
    {
        $sql = "DELETE FROM `language` WHERE `language_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$languageId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}