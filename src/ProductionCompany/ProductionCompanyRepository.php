<?php

declare(strict_types=1);

namespace Movies\ProductionCompany;

use Movies\Database\IDatabase;
use Movies\Database\DatabaseException;

class ProductionCompanyRepository implements IProductionCompanyRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(ProductionCompanyDto $dto): int
    {
        $sql = "INSERT INTO `production_company` (`company_id`, `company_name`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->companyId,
                $dto->companyName
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(ProductionCompanyDto $dto): int
    {
        $sql = "UPDATE `production_company` SET `company_id` = ?, `company_name` = ?
                WHERE `production_company_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->companyId,
                $dto->companyName,
                $dto->productionCompanyId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $productionCompanyId): ?ProductionCompanyDto
    {
        $sql = "SELECT `production_company_id`, `company_id`, `company_name`
                FROM `production_company` WHERE `production_company_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$productionCompanyId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new ProductionCompanyDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `production_company_id`, `company_id`, `company_name`
                FROM `production_company`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new ProductionCompanyDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $productionCompanyId): int
    {
        $sql = "DELETE FROM `production_company` WHERE `production_company_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$productionCompanyId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}