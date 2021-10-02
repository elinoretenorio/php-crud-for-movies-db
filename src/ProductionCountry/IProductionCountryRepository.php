<?php

declare(strict_types=1);

namespace Movies\ProductionCountry;

interface IProductionCountryRepository
{
    public function insert(ProductionCountryDto $dto): int;

    public function update(ProductionCountryDto $dto): int;

    public function get(int $productionCountryId): ?ProductionCountryDto;

    public function getAll(): array;

    public function delete(int $productionCountryId): int;
}