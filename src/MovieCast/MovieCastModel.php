<?php

declare(strict_types=1);

namespace Movies\MovieCast;

use JsonSerializable;

class MovieCastModel implements JsonSerializable
{
    private int $movieCastId;
    private int $movieId;
    private int $personId;
    private string $characterName;
    private int $genderId;
    private int $castOrder;

    public function __construct(MovieCastDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->movieCastId = $dto->movieCastId;
        $this->movieId = $dto->movieId;
        $this->personId = $dto->personId;
        $this->characterName = $dto->characterName;
        $this->genderId = $dto->genderId;
        $this->castOrder = $dto->castOrder;
    }

    public function getMovieCastId(): int
    {
        return $this->movieCastId;
    }

    public function setMovieCastId(int $movieCastId): void
    {
        $this->movieCastId = $movieCastId;
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

    public function getCharacterName(): string
    {
        return $this->characterName;
    }

    public function setCharacterName(string $characterName): void
    {
        $this->characterName = $characterName;
    }

    public function getGenderId(): int
    {
        return $this->genderId;
    }

    public function setGenderId(int $genderId): void
    {
        $this->genderId = $genderId;
    }

    public function getCastOrder(): int
    {
        return $this->castOrder;
    }

    public function setCastOrder(int $castOrder): void
    {
        $this->castOrder = $castOrder;
    }

    public function toDto(): MovieCastDto
    {
        $dto = new MovieCastDto();
        $dto->movieCastId = (int) ($this->movieCastId ?? 0);
        $dto->movieId = (int) ($this->movieId ?? 0);
        $dto->personId = (int) ($this->personId ?? 0);
        $dto->characterName = $this->characterName ?? "";
        $dto->genderId = (int) ($this->genderId ?? 0);
        $dto->castOrder = (int) ($this->castOrder ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "movie_cast_id" => $this->movieCastId,
            "movie_id" => $this->movieId,
            "person_id" => $this->personId,
            "character_name" => $this->characterName,
            "gender_id" => $this->genderId,
            "cast_order" => $this->castOrder,
        ];
    }
}