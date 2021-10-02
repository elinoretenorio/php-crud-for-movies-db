<?php

declare(strict_types=1);

namespace Movies\Movie;

class MovieService implements IMovieService
{
    private IMovieRepository $repository;

    public function __construct(IMovieRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(MovieModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(MovieModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $movieId): ?MovieModel
    {
        $dto = $this->repository->get($movieId);
        if ($dto === null) {
            return null;
        }

        return new MovieModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var MovieDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new MovieModel($dto);
        }

        return $result;
    }

    public function delete(int $movieId): int
    {
        return $this->repository->delete($movieId);
    }

    public function createModel(array $row): ?MovieModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new MovieDto($row);

        return new MovieModel($dto);
    }
}