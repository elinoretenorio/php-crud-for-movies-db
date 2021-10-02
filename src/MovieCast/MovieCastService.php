<?php

declare(strict_types=1);

namespace Movies\MovieCast;

class MovieCastService implements IMovieCastService
{
    private IMovieCastRepository $repository;

    public function __construct(IMovieCastRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(MovieCastModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(MovieCastModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $movieCastId): ?MovieCastModel
    {
        $dto = $this->repository->get($movieCastId);
        if ($dto === null) {
            return null;
        }

        return new MovieCastModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var MovieCastDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new MovieCastModel($dto);
        }

        return $result;
    }

    public function delete(int $movieCastId): int
    {
        return $this->repository->delete($movieCastId);
    }

    public function createModel(array $row): ?MovieCastModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new MovieCastDto($row);

        return new MovieCastModel($dto);
    }
}