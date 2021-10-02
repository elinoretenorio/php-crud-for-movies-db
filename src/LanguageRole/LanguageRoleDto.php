<?php

declare(strict_types=1);

namespace Movies\LanguageRole;

class LanguageRoleDto 
{
    public int $languageRoleId;
    public int $roleId;
    public string $languageRole;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->languageRoleId = (int) ($row["language_role_id"] ?? 0);
        $this->roleId = (int) ($row["role_id"] ?? 0);
        $this->languageRole = $row["language_role"] ?? "";
    }
}