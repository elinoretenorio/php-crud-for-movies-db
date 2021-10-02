<?php

declare(strict_types=1);

namespace Movies\Person;

interface IPersonRepository
{
    public function insert(PersonDto $dto): int;

    public function update(PersonDto $dto): int;

    public function get(int $personId): ?PersonDto;

    public function getAll(): array;

    public function delete(int $personId): int;
}