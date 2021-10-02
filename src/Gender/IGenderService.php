<?php

declare(strict_types=1);

namespace Movies\Gender;

interface IGenderService
{
    public function insert(GenderModel $model): int;

    public function update(GenderModel $model): int;

    public function get(int $genderId): ?GenderModel;

    public function getAll(): array;

    public function delete(int $genderId): int;

    public function createModel(array $row): ?GenderModel;
}