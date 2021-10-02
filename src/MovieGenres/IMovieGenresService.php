<?php

declare(strict_types=1);

namespace Movies\MovieGenres;

interface IMovieGenresService
{
    public function insert(MovieGenresModel $model): int;

    public function update(MovieGenresModel $model): int;

    public function get(int $movieGenresId): ?MovieGenresModel;

    public function getAll(): array;

    public function delete(int $movieGenresId): int;

    public function createModel(array $row): ?MovieGenresModel;
}