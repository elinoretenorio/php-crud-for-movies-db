<?php

declare(strict_types=1);

namespace Movies\MovieGenres;

use JsonSerializable;

class MovieGenresModel implements JsonSerializable
{
    private int $movieGenresId;
    private int $movieId;
    private int $genreId;

    public function __construct(MovieGenresDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->movieGenresId = $dto->movieGenresId;
        $this->movieId = $dto->movieId;
        $this->genreId = $dto->genreId;
    }

    public function getMovieGenresId(): int
    {
        return $this->movieGenresId;
    }

    public function setMovieGenresId(int $movieGenresId): void
    {
        $this->movieGenresId = $movieGenresId;
    }

    public function getMovieId(): int
    {
        return $this->movieId;
    }

    public function setMovieId(int $movieId): void
    {
        $this->movieId = $movieId;
    }

    public function getGenreId(): int
    {
        return $this->genreId;
    }

    public function setGenreId(int $genreId): void
    {
        $this->genreId = $genreId;
    }

    public function toDto(): MovieGenresDto
    {
        $dto = new MovieGenresDto();
        $dto->movieGenresId = (int) ($this->movieGenresId ?? 0);
        $dto->movieId = (int) ($this->movieId ?? 0);
        $dto->genreId = (int) ($this->genreId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "movie_genres_id" => $this->movieGenresId,
            "movie_id" => $this->movieId,
            "genre_id" => $this->genreId,
        ];
    }
}