<?php

declare(strict_types=1);

namespace Movies\Department;

use JsonSerializable;

class DepartmentModel implements JsonSerializable
{
    private int $departmentId;
    private string $departmentName;

    public function __construct(DepartmentDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->departmentId = $dto->departmentId;
        $this->departmentName = $dto->departmentName;
    }

    public function getDepartmentId(): int
    {
        return $this->departmentId;
    }

    public function setDepartmentId(int $departmentId): void
    {
        $this->departmentId = $departmentId;
    }

    public function getDepartmentName(): string
    {
        return $this->departmentName;
    }

    public function setDepartmentName(string $departmentName): void
    {
        $this->departmentName = $departmentName;
    }

    public function toDto(): DepartmentDto
    {
        $dto = new DepartmentDto();
        $dto->departmentId = (int) ($this->departmentId ?? 0);
        $dto->departmentName = $this->departmentName ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "department_id" => $this->departmentId,
            "department_name" => $this->departmentName,
        ];
    }
}