<?php

declare(strict_types=1);

namespace Movies\LanguageRole;

use JsonSerializable;

class LanguageRoleModel implements JsonSerializable
{
    private int $languageRoleId;
    private int $roleId;
    private string $languageRole;

    public function __construct(LanguageRoleDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->languageRoleId = $dto->languageRoleId;
        $this->roleId = $dto->roleId;
        $this->languageRole = $dto->languageRole;
    }

    public function getLanguageRoleId(): int
    {
        return $this->languageRoleId;
    }

    public function setLanguageRoleId(int $languageRoleId): void
    {
        $this->languageRoleId = $languageRoleId;
    }

    public function getRoleId(): int
    {
        return $this->roleId;
    }

    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }

    public function getLanguageRole(): string
    {
        return $this->languageRole;
    }

    public function setLanguageRole(string $languageRole): void
    {
        $this->languageRole = $languageRole;
    }

    public function toDto(): LanguageRoleDto
    {
        $dto = new LanguageRoleDto();
        $dto->languageRoleId = (int) ($this->languageRoleId ?? 0);
        $dto->roleId = (int) ($this->roleId ?? 0);
        $dto->languageRole = $this->languageRole ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "language_role_id" => $this->languageRoleId,
            "role_id" => $this->roleId,
            "language_role" => $this->languageRole,
        ];
    }
}