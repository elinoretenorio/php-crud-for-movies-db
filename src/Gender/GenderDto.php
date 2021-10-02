<?php

declare(strict_types=1);

namespace Movies\Gender;

class GenderDto 
{
    public int $genderId;
    public string $gender;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->genderId = (int) ($row["gender_id"] ?? 0);
        $this->gender = $row["gender"] ?? "";
    }
}