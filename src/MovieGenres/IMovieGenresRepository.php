<?php

declare(strict_types=1);

namespace Movies\MovieGenres;

interface IMovieGenresRepository
{
    public function insert(MovieGenresDto $dto): int;

    public function update(MovieGenresDto $dto): int;

    public function get(int $movieGenresId): ?MovieGenresDto;

    public function getAll(): array;

    public function delete(int $movieGenresId): int;
}