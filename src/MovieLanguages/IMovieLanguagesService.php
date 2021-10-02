<?php

declare(strict_types=1);

namespace Movies\MovieLanguages;

interface IMovieLanguagesService
{
    public function insert(MovieLanguagesModel $model): int;

    public function update(MovieLanguagesModel $model): int;

    public function get(int $movieLanguagesId): ?MovieLanguagesModel;

    public function getAll(): array;

    public function delete(int $movieLanguagesId): int;

    public function createModel(array $row): ?MovieLanguagesModel;
}