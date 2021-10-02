<?php

declare(strict_types=1);

namespace Movies\MovieCrew;

interface IMovieCrewRepository
{
    public function insert(MovieCrewDto $dto): int;

    public function update(MovieCrewDto $dto): int;

    public function get(int $movieCrewId): ?MovieCrewDto;

    public function getAll(): array;

    public function delete(int $movieCrewId): int;
}