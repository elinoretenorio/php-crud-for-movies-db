<?php

declare(strict_types=1);

namespace Movies\Gender;

interface IGenderRepository
{
    public function insert(GenderDto $dto): int;

    public function update(GenderDto $dto): int;

    public function get(int $genderId): ?GenderDto;

    public function getAll(): array;

    public function delete(int $genderId): int;
}