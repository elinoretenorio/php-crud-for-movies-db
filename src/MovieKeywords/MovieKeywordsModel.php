<?php

declare(strict_types=1);

namespace Movies\MovieKeywords;

use JsonSerializable;

class MovieKeywordsModel implements JsonSerializable
{
    private int $movieKeywordsId;
    private int $movieId;
    private int $keywordId;

    public function __construct(MovieKeywordsDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->movieKeywordsId = $dto->movieKeywordsId;
        $this->movieId = $dto->movieId;
        $this->keywordId = $dto->keywordId;
    }

    public function getMovieKeywordsId(): int
    {
        return $this->movieKeywordsId;
    }

    public function setMovieKeywordsId(int $movieKeywordsId): void
    {
        $this->movieKeywordsId = $movieKeywordsId;
    }

    public function getMovieId(): int
    {
        return $this->movieId;
    }

    public function setMovieId(int $movieId): void
    {
        $this->movieId = $movieId;
    }

    public function getKeywordId(): int
    {
        return $this->keywordId;
    }

    public function setKeywordId(int $keywordId): void
    {
        $this->keywordId = $keywordId;
    }

    public function toDto(): MovieKeywordsDto
    {
        $dto = new MovieKeywordsDto();
        $dto->movieKeywordsId = (int) ($this->movieKeywordsId ?? 0);
        $dto->movieId = (int) ($this->movieId ?? 0);
        $dto->keywordId = (int) ($this->keywordId ?? 0);

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "movie_keywords_id" => $this->movieKeywordsId,
            "movie_id" => $this->movieId,
            "keyword_id" => $this->keywordId,
        ];
    }
}