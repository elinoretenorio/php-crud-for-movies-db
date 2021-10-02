<?php

declare(strict_types=1);

namespace Movies\Language;

interface ILanguageService
{
    public function insert(LanguageModel $model): int;

    public function update(LanguageModel $model): int;

    public function get(int $languageId): ?LanguageModel;

    public function getAll(): array;

    public function delete(int $languageId): int;

    public function createModel(array $row): ?LanguageModel;
}