<?php

declare(strict_types=1);

namespace Movies\Gender;

use JsonSerializable;

class GenderModel implements JsonSerializable
{
    private int $genderId;
    private string $gender;

    public function __construct(GenderDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->genderId = $dto->genderId;
        $this->gender = $dto->gender;
    }

    public function getGenderId(): int
    {
        return $this->genderId;
    }

    public function setGenderId(int $genderId): void
    {
        $this->genderId = $genderId;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    public function toDto(): GenderDto
    {
        $dto = new GenderDto();
        $dto->genderId = (int) ($this->genderId ?? 0);
        $dto->gender = $this->gender ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "gender_id" => $this->genderId,
            "gender" => $this->gender,
        ];
    }
}