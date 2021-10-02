<?php

declare(strict_types=1);

namespace Movies\Language;

class LanguageService implements ILanguageService
{
    private ILanguageRepository $repository;

    public function __construct(ILanguageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(LanguageModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(LanguageModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $languageId): ?LanguageModel
    {
        $dto = $this->repository->get($languageId);
        if ($dto === null) {
            return null;
        }

        return new LanguageModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var LanguageDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new LanguageModel($dto);
        }

        return $result;
    }

    public function delete(int $languageId): int
    {
        return $this->repository->delete($languageId);
    }

    public function createModel(array $row): ?LanguageModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new LanguageDto($row);

        return new LanguageModel($dto);
    }
}