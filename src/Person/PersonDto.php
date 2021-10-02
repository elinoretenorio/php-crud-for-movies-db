<?php

declare(strict_types=1);

namespace Movies\Person;

class PersonDto 
{
    public int $personId;
    public string $personName;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->personId = (int) ($row["person_id"] ?? 0);
        $this->personName = $row["person_name"] ?? "";
    }
}