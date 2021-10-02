<?php

declare(strict_types=1);

namespace Movies\MovieCrew;

class MovieCrewDto 
{
    public int $movieCrewId;
    public int $movieId;
    public int $personId;
    public int $departmentId;
    public string $job;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->movieCrewId = (int) ($row["movie_crew_id"] ?? 0);
        $this->movieId = (int) ($row["movie_id"] ?? 0);
        $this->personId = (int) ($row["person_id"] ?? 0);
        $this->departmentId = (int) ($row["department_id"] ?? 0);
        $this->job = $row["job"] ?? "";
    }
}