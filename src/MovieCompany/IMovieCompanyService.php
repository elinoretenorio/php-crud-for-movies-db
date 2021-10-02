<?php

declare(strict_types=1);

namespace Movies\MovieCompany;

interface IMovieCompanyService
{
    public function insert(MovieCompanyModel $model): int;

    public function update(MovieCompanyModel $model): int;

    public function get(int $movieCompanyId): ?MovieCompanyModel;

    public function getAll(): array;

    public function delete(int $movieCompanyId): int;

    public function createModel(array $row): ?MovieCompanyModel;
}