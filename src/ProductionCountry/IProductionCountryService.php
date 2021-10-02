<?php

declare(strict_types=1);

namespace Movies\ProductionCountry;

interface IProductionCountryService
{
    public function insert(ProductionCountryModel $model): int;

    public function update(ProductionCountryModel $model): int;

    public function get(int $productionCountryId): ?ProductionCountryModel;

    public function getAll(): array;

    public function delete(int $productionCountryId): int;

    public function createModel(array $row): ?ProductionCountryModel;
}