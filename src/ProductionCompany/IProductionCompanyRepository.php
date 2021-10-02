<?php

declare(strict_types=1);

namespace Movies\ProductionCompany;

interface IProductionCompanyRepository
{
    public function insert(ProductionCompanyDto $dto): int;

    public function update(ProductionCompanyDto $dto): int;

    public function get(int $productionCompanyId): ?ProductionCompanyDto;

    public function getAll(): array;

    public function delete(int $productionCompanyId): int;
}