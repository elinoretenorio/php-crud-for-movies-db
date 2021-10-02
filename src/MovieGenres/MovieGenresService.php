<?php

declare(strict_types=1);

namespace Movies\MovieGenres;

class MovieGenresService implements IMovieGenresService
{
    private IMovieGenresRepository $repository;

    public function __construct(IMovieGenresRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(MovieGenresModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(MovieGenresModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $movieGenresId): ?MovieGenresModel
    {
        $dto = $this->repository->get($movieGenresId);
        if ($dto === null) {
            return null;
        }

        return new MovieGenresModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var MovieGenresDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new MovieGenresModel($dto);
        }

        return $result;
    }

    public function delete(int $movieGenresId): int
    {
        return $this->repository->delete($movieGenresId);
    }

    public function createModel(array $row): ?MovieGenresModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new MovieGenresDto($row);

        return new MovieGenresModel($dto);
    }
}