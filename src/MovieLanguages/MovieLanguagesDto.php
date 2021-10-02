<?php

declare(strict_types=1);

namespace Movies\MovieLanguages;

class MovieLanguagesDto 
{
    public int $movieLanguagesId;
    public int $movieId;
    public int $languageId;
    public int $languageRoleId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->movieLanguagesId = (int) ($row["movie_languages_id"] ?? 0);
        $this->movieId = (int) ($row["movie_id"] ?? 0);
        $this->languageId = (int) ($row["language_id"] ?? 0);
        $this->languageRoleId = (int) ($row["language_role_id"] ?? 0);
    }
}