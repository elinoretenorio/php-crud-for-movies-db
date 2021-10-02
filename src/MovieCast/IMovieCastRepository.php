<?php

declare(strict_types=1);

namespace Movies\MovieCast;

interface IMovieCastRepository
{
    public function insert(MovieCastDto $dto): int;

    public function update(MovieCastDto $dto): int;

    public function get(int $movieCastId): ?MovieCastDto;

    public function getAll(): array;

    public function delete(int $movieCastId): int;
}