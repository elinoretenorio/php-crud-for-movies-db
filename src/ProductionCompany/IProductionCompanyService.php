<?php

declare(strict_types=1);

namespace Movies\ProductionCompany;

interface IProductionCompanyService
{
    public function insert(ProductionCompanyModel $model): int;

    public function update(ProductionCompanyModel $model): int;

    public function get(int $productionCompanyId): ?ProductionCompanyModel;

    public function getAll(): array;

    public function delete(int $productionCompanyId): int;

    public function createModel(array $row): ?ProductionCompanyModel;
}