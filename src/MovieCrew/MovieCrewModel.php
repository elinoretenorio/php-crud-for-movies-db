<?php

declare(strict_types=1);

namespace Movies\MovieCrew;

use JsonSerializable;

class MovieCrewModel implements JsonSerializable
{
    private int $movieCrewId;
    private int $movieId;
    private int $personId;
    private int $departmentId;
    private string $job;

    public function __construct(MovieCrewDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->movieCrewId = $dto->movieCrewId;
        $this->movieId = $dto->movieId;
        $this->personId = $dto->personId;
        $this->departmentId = $dto->departmentId;
        $this->job = $dto->job;
    }

    public function getMovieCrewId(): int
    {
        return $this->movieCrewId;
    }

    public function setMovieCrewId(int $movieCrewId): void
    {
        $this->movieCrewId = $movieCrewId;
    }

    public function getMovieId(): int
    {
        return $this->movieId;
    }

    public function setMovieId(int $movieId): void
    {
        $this->movieId = $movieId;
    }

    public function getPersonId(): int
    {
        return $this->personId;
    }

    public function setPersonId(int $personId): void
    {
        $this->personId = $personId;
    }

    public function getDepartmentId(): int
    {
        return $this->departmentId;
    }

    public function setDepartmentId(int $departmentId): void
    {
        $this->departmentId = $departmentId;
    }

    public function getJob(): string
    {
        return $this->job;
    }

    public function setJob(string $job): void
    {
        $this->job = $job;
    }

    public function toDto(): MovieCrewDto
    {
        $dto = new MovieCrewDto();
        $dto->movieCrewId = (int) ($this->movieCrewId ?? 0);
        $dto->movieId = (int) ($this->movieId ?? 0);
        $dto->personId = (int) ($this->personId ?? 0);
        $dto->departmentId = (int) ($this->departmentId ?? 0);
        $dto->job = $this->job ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "movie_crew_id" => $this->movieCrewId,
            "movie_id" => $this->movieId,
            "person_id" => $this->personId,
            "department_id" => $this->departmentId,
            "job" => $this->job,
        ];
    }
}