<?php

declare(strict_types=1);

namespace Movies\Tests\Country;

use PHPUnit\Framework\TestCase;
use Movies\Country\{ CountryDto, CountryModel, ICountryService, CountryService };

class CountryServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private CountryDto $dto;
    private CountryModel $model;
    private ICountryService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\Country\ICountryRepository");
        $this->input = [
            "country_id" => 3463,
            "country_iso_code" => "less",
            "country_name" => "eat",
        ];
        $this->dto = new CountryDto($this->input);
        $this->model = new CountryModel($this->dto);
        $this->service = new CountryService($this->repository);
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
        $expected = 5202;

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
        $expected = 681;

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
        $countryId = 8734;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($countryId)
            ->willReturn(null);

        $actual = $this->service->get($countryId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $countryId = 2147;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($countryId)
            ->willReturn($this->dto);

        $actual = $this->service->get($countryId);
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
        $countryId = 8648;
        $expected = 7086;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($countryId)
            ->willReturn($expected);

        $actual = $this->service->delete($countryId);
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