<?php

declare(strict_types=1);

namespace Movies\Tests\Gender;

use PHPUnit\Framework\TestCase;
use Movies\Gender\{ GenderDto, GenderModel, IGenderService, GenderService };

class GenderServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private GenderDto $dto;
    private GenderModel $model;
    private IGenderService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\Gender\IGenderRepository");
        $this->input = [
            "gender_id" => 5698,
            "gender" => "ago",
        ];
        $this->dto = new GenderDto($this->input);
        $this->model = new GenderModel($this->dto);
        $this->service = new GenderService($this->repository);
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
        $expected = 2621;

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
        $expected = 8521;

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
        $genderId = 3620;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($genderId)
            ->willReturn(null);

        $actual = $this->service->get($genderId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $genderId = 4570;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($genderId)
            ->willReturn($this->dto);

        $actual = $this->service->get($genderId);
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
        $genderId = 3586;
        $expected = 1112;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($genderId)
            ->willReturn($expected);

        $actual = $this->service->delete($genderId);
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