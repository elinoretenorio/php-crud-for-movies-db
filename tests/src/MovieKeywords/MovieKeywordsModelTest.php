<?php

declare(strict_types=1);

namespace Movies\Tests\MovieKeywords;

use PHPUnit\Framework\TestCase;
use Movies\MovieKeywords\{ MovieKeywordsDto, MovieKeywordsModel };

class MovieKeywordsModelTest extends TestCase
{
    private array $input;
    private MovieKeywordsDto $dto;
    private MovieKeywordsModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "movie_keywords_id" => 9342,
            "movie_id" => 5428,
            "keyword_id" => 3451,
        ];
        $this->dto = new MovieKeywordsDto($this->input);
        $this->model = new MovieKeywordsModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new MovieKeywordsModel(null);

        $this->assertInstanceOf(MovieKeywordsModel::class, $model);
    }

    public function testGetMovieKeywordsId(): void
    {
        $this->assertEquals($this->dto->movieKeywordsId, $this->model->getMovieKeywordsId());
    }

    public function testSetMovieKeywordsId(): void
    {
        $expected = 8618;
        $model = $this->model;
        $model->setMovieKeywordsId($expected);

        $this->assertEquals($expected, $model->getMovieKeywordsId());
    }

    public function testGetMovieId(): void
    {
        $this->assertEquals($this->dto->movieId, $this->model->getMovieId());
    }

    public function testSetMovieId(): void
    {
        $expected = 2889;
        $model = $this->model;
        $model->setMovieId($expected);

        $this->assertEquals($expected, $model->getMovieId());
    }

    public function testGetKeywordId(): void
    {
        $this->assertEquals($this->dto->keywordId, $this->model->getKeywordId());
    }

    public function testSetKeywordId(): void
    {
        $expected = 7895;
        $model = $this->model;
        $model->setKeywordId($expected);

        $this->assertEquals($expected, $model->getKeywordId());
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