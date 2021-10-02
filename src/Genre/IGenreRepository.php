<?php

declare(strict_types=1);

namespace Movies\Genre;

interface IGenreRepository
{
    public function insert(GenreDto $dto): int;

    public function update(GenreDto $dto): int;

    public function get(int $genreId): ?GenreDto;

    public function getAll(): array;

    public function delete(int $genreId): int;
}