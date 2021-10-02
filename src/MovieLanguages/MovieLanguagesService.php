<?php

declare(strict_types=1);

namespace Movies\MovieLanguages;

class MovieLanguagesService implements IMovieLanguagesService
{
    private IMovieLanguagesRepository $repository;

    public function __construct(IMovieLanguagesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(MovieLanguagesModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(MovieLanguagesModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $movieLanguagesId): ?MovieLanguagesModel
    {
        $dto = $this->repository->get($movieLanguagesId);
        if ($dto === null) {
            return null;
        }

        return new MovieLanguagesModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var MovieLanguagesDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new MovieLanguagesModel($dto);
        }

        return $result;
    }

    public function delete(int $movieLanguagesId): int
    {
        return $this->repository->delete($movieLanguagesId);
    }

    public function createModel(array $row): ?MovieLanguagesModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new MovieLanguagesDto($row);

        return new MovieLanguagesModel($dto);
    }
}