<?php

declare(strict_types=1);

namespace Movies\Keyword;

interface IKeywordRepository
{
    public function insert(KeywordDto $dto): int;

    public function update(KeywordDto $dto): int;

    public function get(int $keywordId): ?KeywordDto;

    public function getAll(): array;

    public function delete(int $keywordId): int;
}