<?php

declare(strict_types=1);

namespace Movies\Language;

use JsonSerializable;

class LanguageModel implements JsonSerializable
{
    private int $languageId;
    private string $languageCode;
    private string $languageName;

    public function __construct(LanguageDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->languageId = $dto->languageId;
        $this->languageCode = $dto->languageCode;
        $this->languageName = $dto->languageName;
    }

    public function getLanguageId(): int
    {
        return $this->languageId;
    }

    public function setLanguageId(int $languageId): void
    {
        $this->languageId = $languageId;
    }

    public function getLanguageCode(): string
    {
        return $this->languageCode;
    }

    public function setLanguageCode(string $languageCode): void
    {
        $this->languageCode = $languageCode;
    }

    public function getLanguageName(): string
    {
        return $this->languageName;
    }

    public function setLanguageName(string $languageName): void
    {
        $this->languageName = $languageName;
    }

    public function toDto(): LanguageDto
    {
        $dto = new LanguageDto();
        $dto->languageId = (int) ($this->languageId ?? 0);
        $dto->languageCode = $this->languageCode ?? "";
        $dto->languageName = $this->languageName ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "language_id" => $this->languageId,
            "language_code" => $this->languageCode,
            "language_name" => $this->languageName,
        ];
    }
}