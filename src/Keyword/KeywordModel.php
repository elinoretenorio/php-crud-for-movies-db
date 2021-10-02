<?php

declare(strict_types=1);

namespace Movies\Keyword;

use JsonSerializable;

class KeywordModel implements JsonSerializable
{
    private int $keywordId;
    private string $keywordName;

    public function __construct(KeywordDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->keywordId = $dto->keywordId;
        $this->keywordName = $dto->keywordName;
    }

    public function getKeywordId(): int
    {
        return $this->keywordId;
    }

    public function setKeywordId(int $keywordId): void
    {
        $this->keywordId = $keywordId;
    }

    public function getKeywordName(): string
    {
        return $this->keywordName;
    }

    public function setKeywordName(string $keywordName): void
    {
        $this->keywordName = $keywordName;
    }

    public function toDto(): KeywordDto
    {
        $dto = new KeywordDto();
        $dto->keywordId = (int) ($this->keywordId ?? 0);
        $dto->keywordName = $this->keywordName ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "keyword_id" => $this->keywordId,
            "keyword_name" => $this->keywordName,
        ];
    }
}