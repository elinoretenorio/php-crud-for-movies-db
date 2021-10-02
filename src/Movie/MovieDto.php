<?php

declare(strict_types=1);

namespace Movies\Movie;

class MovieDto 
{
    public int $movieId;
    public string $title;
    public int $budget;
    public string $homepage;
    public string $overview;
    public float $popularity;
    public string $releaseDate;
    public int $revenue;
    public int $runtime;
    public string $movieStatus;
    public string $tagline;
    public float $voteAverage;
    public int $voteCount;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->movieId = (int) ($row["movie_id"] ?? 0);
        $this->title = $row["title"] ?? "";
        $this->budget = (int) ($row["budget"] ?? 0);
        $this->homepage = $row["homepage"] ?? "";
        $this->overview = $row["overview"] ?? "";
        $this->popularity = (float) ($row["popularity"] ?? 0);
        $this->releaseDate = $row["release_date"] ?? "";
        $this->revenue = (int) ($row["revenue"] ?? 0);
        $this->runtime = (int) ($row["runtime"] ?? 0);
        $this->movieStatus = $row["movie_status"] ?? "";
        $this->tagline = $row["tagline"] ?? "";
        $this->voteAverage = (float) ($row["vote_average"] ?? 0);
        $this->voteCount = (int) ($row["vote_count"] ?? 0);
    }
}