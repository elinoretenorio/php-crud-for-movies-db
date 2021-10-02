<?php

declare(strict_types=1);

namespace Movies\Tests\ProductionCompany;

use PHPUnit\Framework\TestCase;
use Movies\ProductionCompany\{ ProductionCompanyDto, ProductionCompanyModel };

class ProductionCompanyModelTest extends TestCase
{
    private array $input;
    private ProductionCompanyDto $dto;
    private ProductionCompanyModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "production_company_id" => 8037,
            "company_id" => 7364,
            "company_name" => "happy",
        ];
        $this->dto = new ProductionCompanyDto($this->input);
        $this->model = new ProductionCompanyModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new ProductionCompanyModel(null);

        $this->assertInstanceOf(ProductionCompanyModel::class, $model);
    }

    public function testGetProductionCompanyId(): void
    {
        $this->assertEquals($this->dto->productionCompanyId, $this->model->getProductionCompanyId());
    }

    public function testSetProductionCompanyId(): void
    {
        $expected = 9005;
        $model = $this->model;
        $model->setProductionCompanyId($expected);

        $this->assertEquals($expected, $model->getProductionCompanyId());
    }

    public function testGetCompanyId(): void
    {
        $this->assertEquals($this->dto->companyId, $this->model->getCompanyId());
    }

    public function testSetCompanyId(): void
    {
        $expected = 264;
        $model = $this->model;
        $model->setCompanyId($expected);

        $this->assertEquals($expected, $model->getCompanyId());
    }

    public function testGetCompanyName(): void
    {
        $this->assertEquals($this->dto->companyName, $this->model->getCompanyName());
    }

    public function testSetCompanyName(): void
    {
        $expected = "participant";
        $model = $this->model;
        $model->setCompanyName($expected);

        $this->assertEquals($expected, $model->getCompanyName());
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