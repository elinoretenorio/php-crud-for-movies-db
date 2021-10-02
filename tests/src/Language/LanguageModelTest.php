<?php

declare(strict_types=1);

namespace Movies\Tests\Language;

use PHPUnit\Framework\TestCase;
use Movies\Language\{ LanguageDto, LanguageModel };

class LanguageModelTest extends TestCase
{
    private array $input;
    private LanguageDto $dto;
    private LanguageModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "language_id" => 6707,
            "language_code" => "call",
            "language_name" => "spring",
        ];
        $this->dto = new LanguageDto($this->input);
        $this->model = new LanguageModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new LanguageModel(null);

        $this->assertInstanceOf(LanguageModel::class, $model);
    }

    public function testGetLanguageId(): void
    {
        $this->assertEquals($this->dto->languageId, $this->model->getLanguageId());
    }

    public function testSetLanguageId(): void
    {
        $expected = 5732;
        $model = $this->model;
        $model->setLanguageId($expected);

        $this->assertEquals($expected, $model->getLanguageId());
    }

    public function testGetLanguageCode(): void
    {
        $this->assertEquals($this->dto->languageCode, $this->model->getLanguageCode());
    }

    public function testSetLanguageCode(): void
    {
        $expected = "ever";
        $model = $this->model;
        $model->setLanguageCode($expected);

        $this->assertEquals($expected, $model->getLanguageCode());
    }

    public function testGetLanguageName(): void
    {
        $this->assertEquals($this->dto->languageName, $this->model->getLanguageName());
    }

    public function testSetLanguageName(): void
    {
        $expected = "whether";
        $model = $this->model;
        $model->setLanguageName($expected);

        $this->assertEquals($expected, $model->getLanguageName());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}