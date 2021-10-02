<?php

declare(strict_types=1);

namespace Movies\ProductionCountry;

class ProductionCountryService implements IProductionCountryService
{
    private IProductionCountryRepository $repository;

    public function __construct(IProductionCountryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(ProductionCountryModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(ProductionCountryModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $productionCountryId): ?ProductionCountryModel
    {
        $dto = $this->repository->get($productionCountryId);
        if ($dto === null) {
            return null;
        }

        return new ProductionCountryModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var ProductionCountryDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new ProductionCountryModel($dto);
        }

        return $result;
    }

    public function delete(int $productionCountryId): int
    {
        return $this->repository->delete($productionCountryId);
    }

    public function createModel(array $row): ?ProductionCountryModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new ProductionCountryDto($row);

        return new ProductionCountryModel($dto);
    }
}