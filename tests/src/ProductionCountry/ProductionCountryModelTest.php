<?php

declare(strict_types=1);

namespace Movies\Tests\ProductionCountry;

use PHPUnit\Framework\TestCase;
use Movies\ProductionCountry\{ ProductionCountryDto, ProductionCountryModel };

class ProductionCountryModelTest extends TestCase
{
    private array $input;
    private ProductionCountryDto $dto;
    private ProductionCountryModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "production_country_id" => 2607,
            "movie_id" => 538,
            "country_id" => 7434,
        ];
        $this->dto = new ProductionCountryDto($this->input);
        $this->model = new ProductionCountryModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new ProductionCountryModel(null);

        $this->assertInstanceOf(ProductionCountryModel::class, $model);
    }

    public function testGetProductionCountryId(): void
    {
        $this->assertEquals($this->dto->productionCountryId, $this->model->getProductionCountryId());
    }

    public function testSetProductionCountryId(): void
    {
        $expected = 3994;
        $model = $this->model;
        $model->setProductionCountryId($expected);

        $this->assertEquals($expected, $model->getProductionCountryId());
    }

    public function testGetMovieId(): void
    {
        $this->assertEquals($this->dto->movieId, $this->model->getMovieId());
    }

    public function testSetMovieId(): void
    {
        $expected = 2627;
        $model = $this->model;
        $model->setMovieId($expected);

        $this->assertEquals($expected, $model->getMovieId());
    }

    public function testGetCountryId(): void
    {
        $this->assertEquals($this->dto->countryId, $this->model->getCountryId());
    }

    public function testSetCountryId(): void
    {
        $expected = 5303;
        $model = $this->model;
        $model->setCountryId($expected);

        $this->assertEquals($expected, $model->getCountryId());
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