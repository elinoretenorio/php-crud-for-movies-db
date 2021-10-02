<?php

declare(strict_types=1);

namespace Movies\Language;

interface ILanguageRepository
{
    public function insert(LanguageDto $dto): int;

    public function update(LanguageDto $dto): int;

    public function get(int $languageId): ?LanguageDto;

    public function getAll(): array;

    public function delete(int $languageId): int;
}