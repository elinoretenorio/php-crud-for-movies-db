<?php

declare(strict_types=1);

namespace Movies\Keyword;

interface IKeywordService
{
    public function insert(KeywordModel $model): int;

    public function update(KeywordModel $model): int;

    public function get(int $keywordId): ?KeywordModel;

    public function getAll(): array;

    public function delete(int $keywordId): int;

    public function createModel(array $row): ?KeywordModel;
}