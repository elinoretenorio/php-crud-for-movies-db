<?php

declare(strict_types=1);

namespace Movies\Genre;

class GenreDto 
{
    public int $genreId;
    public string $genreName;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->genreId = (int) ($row["genre_id"] ?? 0);
        $this->genreName = $row["genre_name"] ?? "";
    }
}