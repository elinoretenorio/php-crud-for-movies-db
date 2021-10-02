<?php

declare(strict_types=1);

namespace Movies\MovieCast;

interface IMovieCastService
{
    public function insert(MovieCastModel $model): int;

    public function update(MovieCastModel $model): int;

    public function get(int $movieCastId): ?MovieCastModel;

    public function getAll(): array;

    public function delete(int $movieCastId): int;

    public function createModel(array $row): ?MovieCastModel;
}