<?php

declare(strict_types=1);

namespace Movies\MovieCast;

class MovieCastDto 
{
    public int $movieCastId;
    public int $movieId;
    public int $personId;
    public string $characterName;
    public int $genderId;
    public int $castOrder;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->movieCastId = (int) ($row["movie_cast_id"] ?? 0);
        $this->movieId = (int) ($row["movie_id"] ?? 0);
        $this->personId = (int) ($row["person_id"] ?? 0);
        $this->characterName = $row["character_name"] ?? "";
        $this->genderId = (int) ($row["gender_id"] ?? 0);
        $this->castOrder = (int) ($row["cast_order"] ?? 0);
    }
}