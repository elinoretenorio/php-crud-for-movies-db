<?php

declare(strict_types=1);

namespace Movies\LanguageRole;

interface ILanguageRoleService
{
    public function insert(LanguageRoleModel $model): int;

    public function update(LanguageRoleModel $model): int;

    public function get(int $languageRoleId): ?LanguageRoleModel;

    public function getAll(): array;

    public function delete(int $languageRoleId): int;

    public function createModel(array $row): ?LanguageRoleModel;
}