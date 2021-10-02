<?php

declare(strict_types=1);

namespace Movies\MovieKeywords;

class MovieKeywordsDto 
{
    public int $movieKeywordsId;
    public int $movieId;
    public int $keywordId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->movieKeywordsId = (int) ($row["movie_keywords_id"] ?? 0);
        $this->movieId = (int) ($row["movie_id"] ?? 0);
        $this->keywordId = (int) ($row["keyword_id"] ?? 0);
    }
}