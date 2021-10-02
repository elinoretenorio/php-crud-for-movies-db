<?php

declare(strict_types=1);

namespace Movies\Movie;

interface IMovieRepository
{
    public function insert(MovieDto $dto): int;

    public function update(MovieDto $dto): int;

    public function get(int $movieId): ?MovieDto;

    public function getAll(): array;

    public function delete(int $movieId): int;
}