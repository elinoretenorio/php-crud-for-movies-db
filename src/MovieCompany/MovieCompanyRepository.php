<?php

declare(strict_types=1);

namespace Movies\MovieCompany;

use Movies\Database\IDatabase;
use Movies\Database\DatabaseException;

class MovieCompanyRepository implements IMovieCompanyRepository
{
    private IDatabase $db;

    public function __construct(IDatabase $db)
    {
        $this->db = $db;
    }

    public function insert(MovieCompanyDto $dto): int
    {
        $sql = "INSERT INTO `movie_company` (`movie_id`, `company_id`)
                VALUES (?, ?)";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->movieId,
                $dto->companyId
            ]);

            return $this->db->lastInsertId();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function update(MovieCompanyDto $dto): int
    {
        $sql = "UPDATE `movie_company` SET `movie_id` = ?, `company_id` = ?
                WHERE `movie_company_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([
                $dto->movieId,
                $dto->companyId,
                $dto->movieCompanyId
            ]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }

    public function get(int $movieCompanyId): ?MovieCompanyDto
    {
        $sql = "SELECT `movie_company_id`, `movie_id`, `company_id`
                FROM `movie_company` WHERE `movie_company_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$movieCompanyId]);
            $row = $result->fetchAll();

            return (!empty($row)) ? new MovieCompanyDto($row[0]) : null;
        } catch (DatabaseException $exception) {
            return null;
        }
    }

    public function getAll(): array
    {
        $sql = "SELECT `movie_company_id`, `movie_id`, `company_id`
                FROM `movie_company`";

        try {
            $result = $this->db->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll();

            $result = [];
            foreach ($rows as $row) {
                $result[] = new MovieCompanyDto($row);
            }

            return $result;
        } catch (DatabaseException $exception) {
            return [];
        }
    }

    public function delete(int $movieCompanyId): int
    {
        $sql = "DELETE FROM `movie_company` WHERE `movie_company_id` = ?";

        try {
            $result = $this->db->prepare($sql);
            $result->execute([$movieCompanyId]);

            return $result->rowCount();
        } catch (DatabaseException $exception) {
            return -1;
        }
    }
}