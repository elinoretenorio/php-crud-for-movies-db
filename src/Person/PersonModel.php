<?php

declare(strict_types=1);

namespace Movies\Person;

use JsonSerializable;

class PersonModel implements JsonSerializable
{
    private int $personId;
    private string $personName;

    public function __construct(PersonDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->personId = $dto->personId;
        $this->personName = $dto->personName;
    }

    public function getPersonId(): int
    {
        return $this->personId;
    }

    public function setPersonId(int $personId): void
    {
        $this->personId = $personId;
    }

    public function getPersonName(): string
    {
        return $this->personName;
    }

    public function setPersonName(string $personName): void
    {
        $this->personName = $personName;
    }

    public function toDto(): PersonDto
    {
        $dto = new PersonDto();
        $dto->personId = (int) ($this->personId ?? 0);
        $dto->personName = $this->personName ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "person_id" => $this->personId,
            "person_name" => $this->personName,
        ];
    }
}