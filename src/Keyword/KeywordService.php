<?php

declare(strict_types=1);

namespace Movies\Keyword;

class KeywordService implements IKeywordService
{
    private IKeywordRepository $repository;

    public function __construct(IKeywordRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(KeywordModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(KeywordModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $keywordId): ?KeywordModel
    {
        $dto = $this->repository->get($keywordId);
        if ($dto === null) {
            return null;
        }

        return new KeywordModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var KeywordDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new KeywordModel($dto);
        }

        return $result;
    }

    public function delete(int $keywordId): int
    {
        return $this->repository->delete($keywordId);
    }

    public function createModel(array $row): ?KeywordModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new KeywordDto($row);

        return new KeywordModel($dto);
    }
}