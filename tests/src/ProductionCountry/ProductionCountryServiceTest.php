<?php

declare(strict_types=1);

namespace Movies\Tests\ProductionCountry;

use PHPUnit\Framework\TestCase;
use Movies\ProductionCountry\{ ProductionCountryDto, ProductionCountryModel, IProductionCountryService, ProductionCountryService };

class ProductionCountryServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private ProductionCountryDto $dto;
    private ProductionCountryModel $model;
    private IProductionCountryService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\ProductionCountry\IProductionCountryRepository");
        $this->input = [
            "production_country_id" => 523,
            "movie_id" => 5041,
            "country_id" => 7145,
        ];
        $this->dto = new ProductionCountryDto($this->input);
        $this->model = new ProductionCountryModel($this->dto);
        $this->service = new ProductionCountryService($this->repository);
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
        $expected = 7840;

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
        $expected = 7958;

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
        $productionCountryId = 373;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($productionCountryId)
            ->willReturn(null);

        $actual = $this->service->get($productionCountryId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $productionCountryId = 5745;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($productionCountryId)
            ->willReturn($this->dto);

        $actual = $this->service->get($productionCountryId);
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
        $productionCountryId = 1575;
        $expected = 5969;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($productionCountryId)
            ->willReturn($expected);

        $actual = $this->service->delete($productionCountryId);
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