<?php

declare(strict_types=1);

namespace Movies\MovieKeywords;

interface IMovieKeywordsRepository
{
    public function insert(MovieKeywordsDto $dto): int;

    public function update(MovieKeywordsDto $dto): int;

    public function get(int $movieKeywordsId): ?MovieKeywordsDto;

    public function getAll(): array;

    public function delete(int $movieKeywordsId): int;
}