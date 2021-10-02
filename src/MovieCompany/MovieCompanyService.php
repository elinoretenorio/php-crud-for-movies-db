<?php

declare(strict_types=1);

namespace Movies\MovieCompany;

class MovieCompanyService implements IMovieCompanyService
{
    private IMovieCompanyRepository $repository;

    public function __construct(IMovieCompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(MovieCompanyModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(MovieCompanyModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $movieCompanyId): ?MovieCompanyModel
    {
        $dto = $this->repository->get($movieCompanyId);
        if ($dto === null) {
            return null;
        }

        return new MovieCompanyModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var MovieCompanyDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new MovieCompanyModel($dto);
        }

        return $result;
    }

    public function delete(int $movieCompanyId): int
    {
        return $this->repository->delete($movieCompanyId);
    }

    public function createModel(array $row): ?MovieCompanyModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new MovieCompanyDto($row);

        return new MovieCompanyModel($dto);
    }
}