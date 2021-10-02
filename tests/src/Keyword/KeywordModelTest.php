<?php

declare(strict_types=1);

namespace Movies\Tests\Keyword;

use PHPUnit\Framework\TestCase;
use Movies\Keyword\{ KeywordDto, KeywordModel };

class KeywordModelTest extends TestCase
{
    private array $input;
    private KeywordDto $dto;
    private KeywordModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "keyword_id" => 4932,
            "keyword_name" => "different",
        ];
        $this->dto = new KeywordDto($this->input);
        $this->model = new KeywordModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new KeywordModel(null);

        $this->assertInstanceOf(KeywordModel::class, $model);
    }

    public function testGetKeywordId(): void
    {
        $this->assertEquals($this->dto->keywordId, $this->model->getKeywordId());
    }

    public function testSetKeywordId(): void
    {
        $expected = 5206;
        $model = $this->model;
        $model->setKeywordId($expected);

        $this->assertEquals($expected, $model->getKeywordId());
    }

    public function testGetKeywordName(): void
    {
        $this->assertEquals($this->dto->keywordName, $this->model->getKeywordName());
    }

    public function testSetKeywordName(): void
    {
        $expected = "appear";
        $model = $this->model;
        $model->setKeywordName($expected);

        $this->assertEquals($expected, $model->getKeywordName());
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