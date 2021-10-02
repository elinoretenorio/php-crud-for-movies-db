<?php

declare(strict_types=1);

namespace Movies\MovieCrew;

interface IMovieCrewService
{
    public function insert(MovieCrewModel $model): int;

    public function update(MovieCrewModel $model): int;

    public function get(int $movieCrewId): ?MovieCrewModel;

    public function getAll(): array;

    public function delete(int $movieCrewId): int;

    public function createModel(array $row): ?MovieCrewModel;
}