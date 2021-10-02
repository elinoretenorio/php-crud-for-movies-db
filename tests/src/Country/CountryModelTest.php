<?php

declare(strict_types=1);

namespace Movies\Tests\Country;

use PHPUnit\Framework\TestCase;
use Movies\Country\{ CountryDto, CountryModel };

class CountryModelTest extends TestCase
{
    private array $input;
    private CountryDto $dto;
    private CountryModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "country_id" => 7802,
            "country_iso_code" => "move",
            "country_name" => "them",
        ];
        $this->dto = new CountryDto($this->input);
        $this->model = new CountryModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new CountryModel(null);

        $this->assertInstanceOf(CountryModel::class, $model);
    }

    public function testGetCountryId(): void
    {
        $this->assertEquals($this->dto->countryId, $this->model->getCountryId());
    }

    public function testSetCountryId(): void
    {
        $expected = 6982;
        $model = $this->model;
        $model->setCountryId($expected);

        $this->assertEquals($expected, $model->getCountryId());
    }

    public function testGetCountryIsoCode(): void
    {
        $this->assertEquals($this->dto->countryIsoCode, $this->model->getCountryIsoCode());
    }

    public function testSetCountryIsoCode(): void
    {
        $expected = "degree";
        $model = $this->model;
        $model->setCountryIsoCode($expected);

        $this->assertEquals($expected, $model->getCountryIsoCode());
    }

    public function testGetCountryName(): void
    {
        $this->assertEquals($this->dto->countryName, $this->model->getCountryName());
    }

    public function testSetCountryName(): void
    {
        $expected = "lot";
        $model = $this->model;
        $model->setCountryName($expected);

        $this->assertEquals($expected, $model->getCountryName());
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