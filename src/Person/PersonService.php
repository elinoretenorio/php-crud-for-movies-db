<?php

declare(strict_types=1);

namespace Movies\Person;

class PersonService implements IPersonService
{
    private IPersonRepository $repository;

    public function __construct(IPersonRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(PersonModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(PersonModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $personId): ?PersonModel
    {
        $dto = $this->repository->get($personId);
        if ($dto === null) {
            return null;
        }

        return new PersonModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var PersonDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new PersonModel($dto);
        }

        return $result;
    }

    public function delete(int $personId): int
    {
        return $this->repository->delete($personId);
    }

    public function createModel(array $row): ?PersonModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new PersonDto($row);

        return new PersonModel($dto);
    }
}