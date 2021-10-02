<?php

declare(strict_types=1);

namespace Movies\MovieLanguages;

interface IMovieLanguagesRepository
{
    public function insert(MovieLanguagesDto $dto): int;

    public function update(MovieLanguagesDto $dto): int;

    public function get(int $movieLanguagesId): ?MovieLanguagesDto;

    public function getAll(): array;

    public function delete(int $movieLanguagesId): int;
}