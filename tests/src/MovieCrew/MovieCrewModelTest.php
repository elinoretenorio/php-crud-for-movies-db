<?php

declare(strict_types=1);

namespace Movies\Tests\MovieCrew;

use PHPUnit\Framework\TestCase;
use Movies\MovieCrew\{ MovieCrewDto, MovieCrewModel };

class MovieCrewModelTest extends TestCase
{
    private array $input;
    private MovieCrewDto $dto;
    private MovieCrewModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "movie_crew_id" => 2155,
            "movie_id" => 4687,
            "person_id" => 1747,
            "department_id" => 8342,
            "job" => "author",
        ];
        $this->dto = new MovieCrewDto($this->input);
        $this->model = new MovieCrewModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new MovieCrewModel(null);

        $this->assertInstanceOf(MovieCrewModel::class, $model);
    }

    public function testGetMovieCrewId(): void
    {
        $this->assertEquals($this->dto->movieCrewId, $this->model->getMovieCrewId());
    }

    public function testSetMovieCrewId(): void
    {
        $expected = 8805;
        $model = $this->model;
        $model->setMovieCrewId($expected);

        $this->assertEquals($expected, $model->getMovieCrewId());
    }

    public function testGetMovieId(): void
    {
        $this->assertEquals($this->dto->movieId, $this->model->getMovieId());
    }

    public function testSetMovieId(): void
    {
        $expected = 4244;
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
        $expected = 8198;
        $model = $this->model;
        $model->setPersonId($expected);

        $this->assertEquals($expected, $model->getPersonId());
    }

    public function testGetDepartmentId(): void
    {
        $this->assertEquals($this->dto->departmentId, $this->model->getDepartmentId());
    }

    public function testSetDepartmentId(): void
    {
        $expected = 434;
        $model = $this->model;
        $model->setDepartmentId($expected);

        $this->assertEquals($expected, $model->getDepartmentId());
    }

    public function testGetJob(): void
    {
        $this->assertEquals($this->dto->job, $this->model->getJob());
    }

    public function testSetJob(): void
    {
        $expected = "race";
        $model = $this->model;
        $model->setJob($expected);

        $this->assertEquals($expected, $model->getJob());
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