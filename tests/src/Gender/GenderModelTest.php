<?php

declare(strict_types=1);

namespace Movies\Tests\Gender;

use PHPUnit\Framework\TestCase;
use Movies\Gender\{ GenderDto, GenderModel };

class GenderModelTest extends TestCase
{
    private array $input;
    private GenderDto $dto;
    private GenderModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "gender_id" => 1570,
            "gender" => "he",
        ];
        $this->dto = new GenderDto($this->input);
        $this->model = new GenderModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new GenderModel(null);

        $this->assertInstanceOf(GenderModel::class, $model);
    }

    public function testGetGenderId(): void
    {
        $this->assertEquals($this->dto->genderId, $this->model->getGenderId());
    }

    public function testSetGenderId(): void
    {
        $expected = 2061;
        $model = $this->model;
        $model->setGenderId($expected);

        $this->assertEquals($expected, $model->getGenderId());
    }

    public function testGetGender(): void
    {
        $this->assertEquals($this->dto->gender, $this->model->getGender());
    }

    public function testSetGender(): void
    {
        $expected = "something";
        $model = $this->model;
        $model->setGender($expected);

        $this->assertEquals($expected, $model->getGender());
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