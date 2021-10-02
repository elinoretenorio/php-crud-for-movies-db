<?php

declare(strict_types=1);

namespace Movies\MovieGenres;

class MovieGenresDto 
{
    public int $movieGenresId;
    public int $movieId;
    public int $genreId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->movieGenresId = (int) ($row["movie_genres_id"] ?? 0);
        $this->movieId = (int) ($row["movie_id"] ?? 0);
        $this->genreId = (int) ($row["genre_id"] ?? 0);
    }
}