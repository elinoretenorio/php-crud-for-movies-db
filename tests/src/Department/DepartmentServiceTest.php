<?php

declare(strict_types=1);

namespace Movies\Tests\Department;

use PHPUnit\Framework\TestCase;
use Movies\Department\{ DepartmentDto, DepartmentModel, IDepartmentService, DepartmentService };

class DepartmentServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private DepartmentDto $dto;
    private DepartmentModel $model;
    private IDepartmentService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\Department\IDepartmentRepository");
        $this->input = [
            "department_id" => 6056,
            "department_name" => "ask",
        ];
        $this->dto = new DepartmentDto($this->input);
        $this->model = new DepartmentModel($this->dto);
        $this->service = new DepartmentService($this->repository);
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
        $expected = 5354;

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
        $expected = 354;

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
        $departmentId = 7864;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($departmentId)
            ->willReturn(null);

        $actual = $this->service->get($departmentId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $departmentId = 6883;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($departmentId)
            ->willReturn($this->dto);

        $actual = $this->service->get($departmentId);
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
        $departmentId = 3850;
        $expected = 7583;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($departmentId)
            ->willReturn($expected);

        $actual = $this->service->delete($departmentId);
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