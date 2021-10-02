<?php

declare(strict_types=1);

namespace Movies\LanguageRole;

interface ILanguageRoleRepository
{
    public function insert(LanguageRoleDto $dto): int;

    public function update(LanguageRoleDto $dto): int;

    public function get(int $languageRoleId): ?LanguageRoleDto;

    public function getAll(): array;

    public function delete(int $languageRoleId): int;
}