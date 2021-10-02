<?php

declare(strict_types=1);

namespace Movies\Person;

interface IPersonService
{
    public function insert(PersonModel $model): int;

    public function update(PersonModel $model): int;

    public function get(int $personId): ?PersonModel;

    public function getAll(): array;

    public function delete(int $personId): int;

    public function createModel(array $row): ?PersonModel;
}