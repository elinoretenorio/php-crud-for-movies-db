<?php

declare(strict_types=1);

namespace Movies\MovieCrew;

class MovieCrewService implements IMovieCrewService
{
    private IMovieCrewRepository $repository;

    public function __construct(IMovieCrewRepository $repository)
    {
        $this->repository = $repository;
    }

    public function insert(MovieCrewModel $model): int
    {
        return $this->repository->insert($model->toDto());
    }

    public function update(MovieCrewModel $model): int
    {
        return $this->repository->update($model->toDto());
    }

    public function get(int $movieCrewId): ?MovieCrewModel
    {
        $dto = $this->repository->get($movieCrewId);
        if ($dto === null) {
            return null;
        }

        return new MovieCrewModel($dto);
    }

    public function getAll(): array
    {
        $dtos = $this->repository->getAll();

        $result = [];
        /* @var MovieCrewDto $dto */
        foreach ($dtos as $dto) {
            $result[] = new MovieCrewModel($dto);
        }

        return $result;
    }

    public function delete(int $movieCrewId): int
    {
        return $this->repository->delete($movieCrewId);
    }

    public function createModel(array $row): ?MovieCrewModel
    {
        if (empty($row)) {
            return null;
        }

        $dto = new MovieCrewDto($row);

        return new MovieCrewModel($dto);
    }
}