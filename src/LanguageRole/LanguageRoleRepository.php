<?php

declare(strict_types=1);

namespace Movies\LanguageRole;

use Movies\Database\IDatabase;
use Movies\Database\DatabaseException;

class LanguageRoleRepository implements ILanguageRoleRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(LanguageRoleDto $dto): int
    {
        $sql = "INSERT INTO `language_role` (`role_id`, `language_role`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->roleId,
                $dto->languageRole
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(LanguageRoleDto $dto): int
    {
        $sql = "UPDATE `language_role` SET `role_id` = ?, `language_role` = ?
                WHERE `language_role_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->roleId,
                $dto->languageRole,
                $dto->languageRoleId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $languageRoleId): ?LanguageRoleDto
    {
        $sql = "SELECT `language_role_id`, `role_id`, `language_role`
                FROM `language_role` WHERE `language_role_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$languageRoleId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new LanguageRoleDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `language_role_id`, `role_id`, `language_role`
                FROM `language_role`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new LanguageRoleDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $languageRoleId): int
    {
        $sql = "DELETE FROM `language_role` WHERE `language_role_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$languageRoleId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}