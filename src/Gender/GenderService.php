<?php

declare(strict_types=1);

namespace Movies\Gender;

class GenderService implements IGenderService
{
    private IGenderRepository $repository;

    public function __construct(IGenderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(GenderModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(GenderModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $genderId): ?GenderModel
    {
        $dto = $this->repository->get($genderId);
        if ($dto === null) {
            return null;
        }

        return new GenderModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var GenderDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new GenderModel($dto);
        }

        return $result;
    }

    public function delete(int $genderId): int
    {
        return $this->repository->delete($genderId);
    }

    public function createModel(array $row): ?GenderModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new GenderDto($row);

        return new GenderModel($dto);
    }
}