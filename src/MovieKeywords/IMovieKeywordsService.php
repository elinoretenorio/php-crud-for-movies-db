<?php

declare(strict_types=1);

namespace Movies\MovieKeywords;

interface IMovieKeywordsService
{
    public function insert(MovieKeywordsModel $model): int;

    public function update(MovieKeywordsModel $model): int;

    public function get(int $movieKeywordsId): ?MovieKeywordsModel;

    public function getAll(): array;

    public function delete(int $movieKeywordsId): int;

    public function createModel(array $row): ?MovieKeywordsModel;
}