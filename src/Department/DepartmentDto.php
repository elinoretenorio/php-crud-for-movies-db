<?php

declare(strict_types=1);

namespace Movies\Department;

class DepartmentDto 
{
    public int $departmentId;
    public string $departmentName;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->departmentId = (int) ($row["department_id"] ?? 0);
        $this->departmentName = $row["department_name"] ?? "";
    }
}