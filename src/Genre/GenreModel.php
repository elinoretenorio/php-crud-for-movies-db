<?php

declare(strict_types=1);

namespace Movies\Genre;

use JsonSerializable;

class GenreModel implements JsonSerializable
{
    private int $genreId;
    private string $genreName;

    public function __construct(GenreDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->genreId = $dto->genreId;
        $this->genreName = $dto->genreName;
    }

    public function getGenreId(): int
    {
        return $this->genreId;
    }

    public function setGenreId(int $genreId): void
    {
        $this->genreId = $genreId;
    }

    public function getGenreName(): string
    {
        return $this->genreName;
    }

    public function setGenreName(string $genreName): void
    {
        $this->genreName = $genreName;
    }

    public function toDto(): GenreDto
    {
        $dto = new GenreDto();
        $dto->genreId = (int) ($this->genreId ?? 0);
        $dto->genreName = $this->genreName ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "genre_id" => $this->genreId,
            "genre_name" => $this->genreName,
        ];
    }
}