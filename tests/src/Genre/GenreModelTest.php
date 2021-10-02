<?php

declare(strict_types=1);

namespace Movies\Tests\Genre;

use PHPUnit\Framework\TestCase;
use Movies\Genre\{ GenreDto, GenreModel };

class GenreModelTest extends TestCase
{
    private array $input;
    private GenreDto $dto;
    private GenreModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "genre_id" => 8117,
            "genre_name" => "all",
        ];
        $this->dto = new GenreDto($this->input);
        $this->model = new GenreModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new GenreModel(null);

        $this->assertInstanceOf(GenreModel::class, $model);
    }

    public function testGetGenreId(): void
    {
        $this->assertEquals($this->dto->genreId, $this->model->getGenreId());
    }

    public function testSetGenreId(): void
    {
        $expected = 2914;
        $model = $this->model;
        $model->setGenreId($expected);

        $this->assertEquals($expected, $model->getGenreId());
    }

    public function testGetGenreName(): void
    {
        $this->assertEquals($this->dto->genreName, $this->model->getGenreName());
    }

    public function testSetGenreName(): void
    {
        $expected = "alone";
        $model = $this->model;
        $model->setGenreName($expected);

        $this->assertEquals($expected, $model->getGenreName());
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