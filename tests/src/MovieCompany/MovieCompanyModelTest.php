<?php

declare(strict_types=1);

namespace Movies\Tests\MovieCompany;

use PHPUnit\Framework\TestCase;
use Movies\MovieCompany\{ MovieCompanyDto, MovieCompanyModel };

class MovieCompanyModelTest extends TestCase
{
    private array $input;
    private MovieCompanyDto $dto;
    private MovieCompanyModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "movie_company_id" => 8668,
            "movie_id" => 2885,
            "company_id" => 6778,
        ];
        $this->dto = new MovieCompanyDto($this->input);
        $this->model = new MovieCompanyModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new MovieCompanyModel(null);

        $this->assertInstanceOf(MovieCompanyModel::class, $model);
    }

    public function testGetMovieCompanyId(): void
    {
        $this->assertEquals($this->dto->movieCompanyId, $this->model->getMovieCompanyId());
    }

    public function testSetMovieCompanyId(): void
    {
        $expected = 9205;
        $model = $this->model;
        $model->setMovieCompanyId($expected);

        $this->assertEquals($expected, $model->getMovieCompanyId());
    }

    public function testGetMovieId(): void
    {
        $this->assertEquals($this->dto->movieId, $this->model->getMovieId());
    }

    public function testSetMovieId(): void
    {
        $expected = 797;
        $model = $this->model;
        $model->setMovieId($expected);

        $this->assertEquals($expected, $model->getMovieId());
    }

    public function testGetCompanyId(): void
    {
        $this->assertEquals($this->dto->companyId, $this->model->getCompanyId());
    }

    public function testSetCompanyId(): void
    {
        $expected = 8821;
        $model = $this->model;
        $model->setCompanyId($expected);

        $this->assertEquals($expected, $model->getCompanyId());
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