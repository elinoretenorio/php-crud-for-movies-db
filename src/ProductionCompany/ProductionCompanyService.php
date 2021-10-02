<?php

declare(strict_types=1);

namespace Movies\ProductionCompany;

class ProductionCompanyService implements IProductionCompanyService
{
    private IProductionCompanyRepository $repository;

    public function __construct(IProductionCompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(ProductionCompanyModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(ProductionCompanyModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $productionCompanyId): ?ProductionCompanyModel
    {
        $dto = $this->repository->get($productionCompanyId);
        if ($dto === null) {
            return null;
        }

        return new ProductionCompanyModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var ProductionCompanyDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new ProductionCompanyModel($dto);
        }

        return $result;
    }

    public function delete(int $productionCompanyId): int
    {
        return $this->repository->delete($productionCompanyId);
    }

    public function createModel(array $row): ?ProductionCompanyModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new ProductionCompanyDto($row);

        return new ProductionCompanyModel($dto);
    }
}