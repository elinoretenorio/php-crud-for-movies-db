<?php

declare(strict_types=1);

namespace Movies\Keyword;

class KeywordDto 
{
    public int $keywordId;
    public string $keywordName;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->keywordId = (int) ($row["keyword_id"] ?? 0);
        $this->keywordName = $row["keyword_name"] ?? "";
    }
}