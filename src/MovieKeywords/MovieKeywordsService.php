<?php

declare(strict_types=1);

namespace Movies\MovieKeywords;

class MovieKeywordsService implements IMovieKeywordsService
{
    private IMovieKeywordsRepository $repository;

    public function __construct(IMovieKeywordsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(MovieKeywordsModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(MovieKeywordsModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $movieKeywordsId): ?MovieKeywordsModel
    {
        $dto = $this->repository->get($movieKeywordsId);
        if ($dto === null) {
            return null;
        }

        return new MovieKeywordsModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var MovieKeywordsDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new MovieKeywordsModel($dto);
        }

        return $result;
    }

    public function delete(int $movieKeywordsId): int
    {
        return $this->repository->delete($movieKeywordsId);
    }

    public function createModel(array $row): ?MovieKeywordsModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new MovieKeywordsDto($row);

        return new MovieKeywordsModel($dto);
    }
}