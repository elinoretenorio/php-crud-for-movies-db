<?php

declare(strict_types=1);

namespace Movies\Movie;

use JsonSerializable;

class MovieModel implements JsonSerializable
{
    private int $movieId;
    private string $title;
    private int $budget;
    private string $homepage;
    private string $overview;
    private float $popularity;
    private string $releaseDate;
    private int $revenue;
    private int $runtime;
    private string $movieStatus;
    private string $tagline;
    private float $voteAverage;
    private int $voteCount;

    public function __construct(MovieDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->movieId = $dto->movieId;
        $this->title = $dto->title;
        $this->budget = $dto->budget;
        $this->homepage = $dto->homepage;
        $this->overview = $dto->overview;
        $this->popularity = $dto->popularity;
        $this->releaseDate = $dto->releaseDate;
        $this->revenue = $dto->revenue;
        $this->runtime = $dto->runtime;
        $this->movieStatus = $dto->movieStatus;
        $this->tagline = $dto->tagline;
        $this->voteAverage = $dto->voteAverage;
        $this->voteCount = $dto->voteCount;
    }

    public function getMovieId(): int
    {
        return $this->movieId;
    }

    public function setMovieId(int $movieId): void
    {
        $this->movieId = $movieId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getBudget(): int
    {
        return $this->budget;
    }

    public function setBudget(int $budget): void
    {
        $this->budget = $budget;
    }

    public function getHomepage(): string
    {
        return $this->homepage;
    }

    public function setHomepage(string $homepage): void
    {
        $this->homepage = $homepage;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): void
    {
        $this->overview = $overview;
    }

    public function getPopularity(): float
    {
        return $this->popularity;
    }

    public function setPopularity(float $popularity): void
    {
        $this->popularity = $popularity;
    }

    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(string $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    public function getRevenue(): int
    {
        return $this->revenue;
    }

    public function setRevenue(int $revenue): void
    {
        $this->revenue = $revenue;
    }

    public function getRuntime(): int
    {
        return $this->runtime;
    }

    public function setRuntime(int $runtime): void
    {
        $this->runtime = $runtime;
    }

    public function getMovieStatus(): string
    {
        return $this->movieStatus;
    }

    public function setMovieStatus(string $movieStatus): void
    {
        $this->movieStatus = $movieStatus;
    }

    public function getTagline(): string
    {
        return $this->tagline;
    }

    public function setTagline(string $tagline): void
    {
        $this->tagline = $tagline;
    }

    public function getVoteAverage(): float
    {
        return $this->voteAverage;
    }

    public function setVoteAverage(float $voteAverage): void
    {
        $this->voteAverage = $voteAverage;
    }

    public function getVoteCount(): int
    {
        return $this->voteCount;
    }

    public function setVoteCount(int $voteCount): void
    {
        $this->voteCount = $voteCount;
    }

    public function toDto(): MovieDto
    {
        $dto = new MovieDto();
        $dto->movieId = (int) ($this->movieId ?? 0);
        $dto->title = $this->title ?? "";
        $dto->budget = (int) ($this->budget ?? 0);
        $dto->homepage = $this->homepage ?? "";
        $dto->overview = $this->overview ?? "";
        $dto->popularity = (float) ($this->popularity ?? 0);
        $dto->releaseDate = $this->releaseDate ?? "";
        $dto->revenue = (int) ($this->revenue ?? 0);
        $dto->runtime = (int) ($this->runtime ?? 0);
        $dto->movieStatus = $this->movieStatus ?? "";
        $dto->tagline = $this->tagline ?? "";
        $dto->voteAverage = (float) ($this->voteAverage ?? 0);
        $dto->voteCount = (int) ($this->voteCount ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "movie_id" => $this->movieId,
            "title" => $this->title,
            "budget" => $this->budget,
            "homepage" => $this->homepage,
            "overview" => $this->overview,
            "popularity" => $this->popularity,
            "release_date" => $this->releaseDate,
            "revenue" => $this->revenue,
            "runtime" => $this->runtime,
            "movie_status" => $this->movieStatus,
            "tagline" => $this->tagline,
            "vote_average" => $this->voteAverage,
            "vote_count" => $this->voteCount,
        ];
    }
}