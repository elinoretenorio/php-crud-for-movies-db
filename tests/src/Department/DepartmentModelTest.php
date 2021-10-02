<?php

declare(strict_types=1);

namespace Movies\Tests\Department;

use PHPUnit\Framework\TestCase;
use Movies\Department\{ DepartmentDto, DepartmentModel };

class DepartmentModelTest extends TestCase
{
    private array $input;
    private DepartmentDto $dto;
    private DepartmentModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "department_id" => 5971,
            "department_name" => "article",
        ];
        $this->dto = new DepartmentDto($this->input);
        $this->model = new DepartmentModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new DepartmentModel(null);

        $this->assertInstanceOf(DepartmentModel::class, $model);
    }

    public function testGetDepartmentId(): void
    {
        $this->assertEquals($this->dto->departmentId, $this->model->getDepartmentId());
    }

    public function testSetDepartmentId(): void
    {
        $expected = 7334;
        $model = $this->model;
        $model->setDepartmentId($expected);

        $this->assertEquals($expected, $model->getDepartmentId());
    }

    public function testGetDepartmentName(): void
    {
        $this->assertEquals($this->dto->departmentName, $this->model->getDepartmentName());
    }

    public function testSetDepartmentName(): void
    {
        $expected = "building";
        $model = $this->model;
        $model->setDepartmentName($expected);

        $this->assertEquals($expected, $model->getDepartmentName());
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