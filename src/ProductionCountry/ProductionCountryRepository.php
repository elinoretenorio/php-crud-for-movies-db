<?php

declare(strict_types=1);

namespace Movies\ProductionCountry;

use Movies\Database\IDatabase;
use Movies\Database\DatabaseException;

class ProductionCountryRepository implements IProductionCountryRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(ProductionCountryDto $dto): int
    {
        $sql = "INSERT INTO `production_country` (`movie_id`, `country_id`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->movieId,
                $dto->countryId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(ProductionCountryDto $dto): int
    {
        $sql = "UPDATE `production_country` SET `movie_id` = ?, `country_id` = ?
                WHERE `production_country_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->movieId,
                $dto->countryId,
                $dto->productionCountryId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $productionCountryId): ?ProductionCountryDto
    {
        $sql = "SELECT `production_country_id`, `movie_id`, `country_id`
                FROM `production_country` WHERE `production_country_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$productionCountryId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new ProductionCountryDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `production_country_id`, `movie_id`, `country_id`
                FROM `production_country`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new ProductionCountryDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $productionCountryId): int
    {
        $sql = "DELETE FROM `production_country` WHERE `production_country_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$productionCountryId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}