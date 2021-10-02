<?php

declare(strict_types=1);

namespace Movies\Tests\MovieLanguages;

use PHPUnit\Framework\TestCase;
use Movies\MovieLanguages\{ MovieLanguagesDto, MovieLanguagesModel };

class MovieLanguagesModelTest extends TestCase
{
    private array $input;
    private MovieLanguagesDto $dto;
    private MovieLanguagesModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "movie_languages_id" => 8269,
            "movie_id" => 4170,
            "language_id" => 3272,
            "language_role_id" => 428,
        ];
        $this->dto = new MovieLanguagesDto($this->input);
        $this->model = new MovieLanguagesModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new MovieLanguagesModel(null);

        $this->assertInstanceOf(MovieLanguagesModel::class, $model);
    }

    public function testGetMovieLanguagesId(): void
    {
        $this->assertEquals($this->dto->movieLanguagesId, $this->model->getMovieLanguagesId());
    }

    public function testSetMovieLanguagesId(): void
    {
        $expected = 478;
        $model = $this->model;
        $model->setMovieLanguagesId($expected);

        $this->assertEquals($expected, $model->getMovieLanguagesId());
    }

    public function testGetMovieId(): void
    {
        $this->assertEquals($this->dto->movieId, $this->model->getMovieId());
    }

    public function testSetMovieId(): void
    {
        $expected = 1648;
        $model = $this->model;
        $model->setMovieId($expected);

        $this->assertEquals($expected, $model->getMovieId());
    }

    public function testGetLanguageId(): void
    {
        $this->assertEquals($this->dto->languageId, $this->model->getLanguageId());
    }

    public function testSetLanguageId(): void
    {
        $expected = 5756;
        $model = $this->model;
        $model->setLanguageId($expected);

        $this->assertEquals($expected, $model->getLanguageId());
    }

    public function testGetLanguageRoleId(): void
    {
        $this->assertEquals($this->dto->languageRoleId, $this->model->getLanguageRoleId());
    }

    public function testSetLanguageRoleId(): void
    {
        $expected = 2523;
        $model = $this->model;
        $model->setLanguageRoleId($expected);

        $this->assertEquals($expected, $model->getLanguageRoleId());
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