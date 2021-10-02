<?php

declare(strict_types=1);

namespace Movies\Tests\ProductionCompany;

use PHPUnit\Framework\TestCase;
use Movies\ProductionCompany\{ ProductionCompanyDto, ProductionCompanyModel, IProductionCompanyService, ProductionCompanyService };

class ProductionCompanyServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private ProductionCompanyDto $dto;
    private ProductionCompanyModel $model;
    private IProductionCompanyService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\ProductionCompany\IProductionCompanyRepository");
        $this->input = [
            "production_company_id" => 4384,
            "company_id" => 7167,
            "company_name" => "once",
        ];
        $this->dto = new ProductionCompanyDto($this->input);
        $this->model = new ProductionCompanyModel($this->dto);
        $this->service = new ProductionCompanyService($this->repository);
    }

    protected function tearDown(): void
    {
        unset($this->repository);
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 8046;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("insert")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->insert($this->model);
        $this->assertEmpty($actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 1569;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsEmpty(): void
    {
        $expected = 0;

        $this->repository->expects($this->once())
            ->method("update")
            ->with($this->dto)
            ->willReturn($expected);

        $actual = $this->service->update($this->model);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsNull(): void
    {
        $productionCompanyId = 1246;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($productionCompanyId)
            ->willReturn(null);

        $actual = $this->service->get($productionCompanyId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $productionCompanyId = 4398;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($productionCompanyId)
            ->willReturn($this->dto);

        $actual = $this->service->get($productionCompanyId);
        $this->assertEquals($this->model, $actual);
    }

    public function testGetAll_ReturnsEmpty(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([]);

        $actual = $this->service->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsModels(): void
    {
        $this->repository->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->dto]);

        $actual = $this->service->getAll();
        $this->assertEquals([$this->model], $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $productionCompanyId = 8484;
        $expected = 7417;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($productionCompanyId)
            ->willReturn($expected);

        $actual = $this->service->delete($productionCompanyId);
        $this->assertEquals($expected, $actual);
    }

    public function testCreateModel_ReturnsNullIfEmpty(): void
    {
        $actual = $this->service->createModel([]);
        $this->assertNull($actual);
    }

    public function testCreateModel_ReturnsModel(): void
    {
        $actual = $this->service->createModel($this->input);
        $this->assertEquals($this->model, $actual);
    }
}