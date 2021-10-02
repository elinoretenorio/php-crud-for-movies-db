<?php

declare(strict_types=1);

namespace Movies\Language;

class LanguageDto 
{
    public int $languageId;
    public string $languageCode;
    public string $languageName;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->languageId = (int) ($row["language_id"] ?? 0);
        $this->languageCode = $row["language_code"] ?? "";
        $this->languageName = $row["language_name"] ?? "";
    }
}