<?php

declare(strict_types=1);

namespace Movies\MovieCompany;

use JsonSerializable;

class MovieCompanyModel implements JsonSerializable
{
    private int $movieCompanyId;
    private int $movieId;
    private int $companyId;

    public function __construct(MovieCompanyDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->movieCompanyId = $dto->movieCompanyId;
        $this->movieId = $dto->movieId;
        $this->companyId = $dto->companyId;
    }

    public function getMovieCompanyId(): int
    {
        return $this->movieCompanyId;
    }

    public function setMovieCompanyId(int $movieCompanyId): void
    {
        $this->movieCompanyId = $movieCompanyId;
    }

    public function getMovieId(): int
    {
        return $this->movieId;
    }

    public function setMovieId(int $movieId): void
    {
        $this->movieId = $movieId;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function setCompanyId(int $companyId): void
    {
        $this->companyId = $companyId;
    }

    public function toDto(): MovieCompanyDto
    {
        $dto = new MovieCompanyDto();
        $dto->movieCompanyId = (int) ($this->movieCompanyId ?? 0);
        $dto->movieId = (int) ($this->movieId ?? 0);
        $dto->companyId = (int) ($this->companyId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "movie_company_id" => $this->movieCompanyId,
            "movie_id" => $this->movieId,
            "company_id" => $this->companyId,
        ];
    }
}