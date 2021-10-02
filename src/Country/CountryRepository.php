<?php

declare(strict_types=1);

namespace Movies\Country;

use Movies\Database\IDatabase;
use Movies\Database\DatabaseException;

class CountryRepository implements ICountryRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(CountryDto $dto): int
    {
        $sql = "INSERT INTO `country` (`country_iso_code`, `country_name`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->countryIsoCode,
                $dto->countryName
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(CountryDto $dto): int
    {
        $sql = "UPDATE `country` SET `country_iso_code` = ?, `country_name` = ?
                WHERE `country_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->countryIsoCode,
                $dto->countryName,
                $dto->countryId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $countryId): ?CountryDto
    {
        $sql = "SELECT `country_id`, `country_iso_code`, `country_name`
                FROM `country` WHERE `country_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$countryId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new CountryDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `country_id`, `country_iso_code`, `country_name`
                FROM `country`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new CountryDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $countryId): int
    {
        $sql = "DELETE FROM `country` WHERE `country_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$countryId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}