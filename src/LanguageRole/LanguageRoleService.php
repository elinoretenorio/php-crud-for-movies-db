<?php

declare(strict_types=1);

namespace Movies\LanguageRole;

class LanguageRoleService implements ILanguageRoleService
{
    private ILanguageRoleRepository $repository;

    public function __construct(ILanguageRoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(LanguageRoleModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(LanguageRoleModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $languageRoleId): ?LanguageRoleModel
    {
        $dto = $this->repository->get($languageRoleId);
        if ($dto === null) {
            return null;
        }

        return new LanguageRoleModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var LanguageRoleDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new LanguageRoleModel($dto);
        }

        return $result;
    }

    public function delete(int $languageRoleId): int
    {
        return $this->repository->delete($languageRoleId);
    }

    public function createModel(array $row): ?LanguageRoleModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new LanguageRoleDto($row);

        return new LanguageRoleModel($dto);
    }
}