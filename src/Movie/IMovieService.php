<?php

declare(strict_types=1);

namespace Movies\Movie;

interface IMovieService
{
    public function insert(MovieModel $model): int;

    public function update(MovieModel $model): int;

    public function get(int $movieId): ?MovieModel;

    public function getAll(): array;

    public function delete(int $movieId): int;

    public function createModel(array $row): ?MovieModel;
}