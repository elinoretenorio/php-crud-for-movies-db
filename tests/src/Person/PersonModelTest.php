<?php

declare(strict_types=1);

namespace Movies\Tests\Person;

use PHPUnit\Framework\TestCase;
use Movies\Person\{ PersonDto, PersonModel };

class PersonModelTest extends TestCase
{
    private array $input;
    private PersonDto $dto;
    private PersonModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "person_id" => 9436,
            "person_name" => "month",
        ];
        $this->dto = new PersonDto($this->input);
        $this->model = new PersonModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new PersonModel(null);

        $this->assertInstanceOf(PersonModel::class, $model);
    }

    public function testGetPersonId(): void
    {
        $this->assertEquals($this->dto->personId, $this->model->getPersonId());
    }

    public function testSetPersonId(): void
    {
        $expected = 4294;
        $model = $this->model;
        $model->setPersonId($expected);

        $this->assertEquals($expected, $model->getPersonId());
    }

    public function testGetPersonName(): void
    {
        $this->assertEquals($this->dto->personName, $this->model->getPersonName());
    }

    public function testSetPersonName(): void
    {
        $expected = "guess";
        $model = $this->model;
        $model->setPersonName($expected);

        $this->assertEquals($expected, $model->getPersonName());
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