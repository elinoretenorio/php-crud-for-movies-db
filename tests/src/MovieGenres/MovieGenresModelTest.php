<?php

declare(strict_types=1);

namespace Movies\Tests\MovieGenres;

use PHPUnit\Framework\TestCase;
use Movies\MovieGenres\{ MovieGenresDto, MovieGenresModel };

class MovieGenresModelTest extends TestCase
{
    private array $input;
    private MovieGenresDto $dto;
    private MovieGenresModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "movie_genres_id" => 8890,
            "movie_id" => 2876,
            "genre_id" => 4897,
        ];
        $this->dto = new MovieGenresDto($this->input);
        $this->model = new MovieGenresModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new MovieGenresModel(null);

        $this->assertInstanceOf(MovieGenresModel::class, $model);
    }

    public function testGetMovieGenresId(): void
    {
        $this->assertEquals($this->dto->movieGenresId, $this->model->getMovieGenresId());
    }

    public function testSetMovieGenresId(): void
    {
        $expected = 9919;
        $model = $this->model;
        $model->setMovieGenresId($expected);

        $this->assertEquals($expected, $model->getMovieGenresId());
    }

    public function testGetMovieId(): void
    {
        $this->assertEquals($this->dto->movieId, $this->model->getMovieId());
    }

    public function testSetMovieId(): void
    {
        $expected = 1425;
        $model = $this->model;
        $model->setMovieId($expected);

        $this->assertEquals($expected, $model->getMovieId());
    }

    public function testGetGenreId(): void
    {
        $this->assertEquals($this->dto->genreId, $this->model->getGenreId());
    }

    public function testSetGenreId(): void
    {
        $expected = 5942;
        $model = $this->model;
        $model->setGenreId($expected);

        $this->assertEquals($expected, $model->getGenreId());
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