<?php

declare(strict_types=1);

namespace Movies\Tests\MovieCast;

use PHPUnit\Framework\TestCase;
use Movies\MovieCast\{ MovieCastDto, MovieCastModel };

class MovieCastModelTest extends TestCase
{
    private array $input;
    private MovieCastDto $dto;
    private MovieCastModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "movie_cast_id" => 1159,
            "movie_id" => 6112,
            "person_id" => 43,
            "character_name" => "future",
            "gender_id" => 2104,
            "cast_order" => 8169,
        ];
        $this->dto = new MovieCastDto($this->input);
        $this->model = new MovieCastModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new MovieCastModel(null);

        $this->assertInstanceOf(MovieCastModel::class, $model);
    }

    public function testGetMovieCastId(): void
    {
        $this->assertEquals($this->dto->movieCastId, $this->model->getMovieCastId());
    }

    public function testSetMovieCastId(): void
    {
        $expected = 8550;
        $model = $this->model;
        $model->setMovieCastId($expected);

        $this->assertEquals($expected, $model->getMovieCastId());
    }

    public function testGetMovieId(): void
    {
        $this->assertEquals($this->dto->movieId, $this->model->getMovieId());
    }

    public function testSetMovieId(): void
    {
        $expected = 9235;
        $model = $this->model;
        $model->setMovieId($expected);

        $this->assertEquals($expected, $model->getMovieId());
    }

    public function testGetPersonId(): void
    {
        $this->assertEquals($this->dto->personId, $this->model->getPersonId());
    }

    public function testSetPersonId(): void
    {
        $expected = 5032;
        $model = $this->model;
        $model->setPersonId($expected);

        $this->assertEquals($expected, $model->getPersonId());
    }

    public function testGetCharacterName(): void
    {
        $this->assertEquals($this->dto->characterName, $this->model->getCharacterName());
    }

    public function testSetCharacterName(): void
    {
        $expected = "allow";
        $model = $this->model;
        $model->setCharacterName($expected);

        $this->assertEquals($expected, $model->getCharacterName());
    }

    public function testGetGenderId(): void
    {
        $this->assertEquals($this->dto->genderId, $this->model->getGenderId());
    }

    public function testSetGenderId(): void
    {
        $expected = 1927;
        $model = $this->model;
        $model->setGenderId($expected);

        $this->assertEquals($expected, $model->getGenderId());
    }

    public function testGetCastOrder(): void
    {
        $this->assertEquals($this->dto->castOrder, $this->model->getCastOrder());
    }

    public function testSetCastOrder(): void
    {
        $expected = 1611;
        $model = $this->model;
        $model->setCastOrder($expected);

        $this->assertEquals($expected, $model->getCastOrder());
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