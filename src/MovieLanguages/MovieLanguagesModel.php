<?php

declare(strict_types=1);

namespace Movies\MovieLanguages;

use JsonSerializable;

class MovieLanguagesModel implements JsonSerializable
{
    private int $movieLanguagesId;
    private int $movieId;
    private int $languageId;
    private int $languageRoleId;

    public function __construct(MovieLanguagesDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->movieLanguagesId = $dto->movieLanguagesId;
        $this->movieId = $dto->movieId;
        $this->languageId = $dto->languageId;
        $this->languageRoleId = $dto->languageRoleId;
    }

    public function getMovieLanguagesId(): int
    {
        return $this->movieLanguagesId;
    }

    public function setMovieLanguagesId(int $movieLanguagesId): void
    {
        $this->movieLanguagesId = $movieLanguagesId;
    }

    public function getMovieId(): int
    {
        return $this->movieId;
    }

    public function setMovieId(int $movieId): void
    {
        $this->movieId = $movieId;
    }

    public function getLanguageId(): int
    {
        return $this->languageId;
    }

    public function setLanguageId(int $languageId): void
    {
        $this->languageId = $languageId;
    }

    public function getLanguageRoleId(): int
    {
        return $this->languageRoleId;
    }

    public function setLanguageRoleId(int $languageRoleId): void
    {
        $this->languageRoleId = $languageRoleId;
    }

    public function toDto(): MovieLanguagesDto
    {
        $dto = new MovieLanguagesDto();
        $dto->movieLanguagesId = (int) ($this->movieLanguagesId ?? 0);
        $dto->movieId = (int) ($this->movieId ?? 0);
        $dto->languageId = (int) ($this->languageId ?? 0);
        $dto->languageRoleId = (int) ($this->languageRoleId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "movie_languages_id" => $this->movieLanguagesId,
            "movie_id" => $this->movieId,
            "language_id" => $this->languageId,
            "language_role_id" => $this->languageRoleId,
        ];
    }
}