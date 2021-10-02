<?php

declare(strict_types=1);

namespace Movies\Tests\Person;

use PHPUnit\Framework\TestCase;
use Movies\Person\{ PersonDto, PersonModel, IPersonService, PersonService };

class PersonServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private PersonDto $dto;
    private PersonModel $model;
    private IPersonService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\Person\IPersonRepository");
        $this->input = [
            "person_id" => 1589,
            "person_name" => "policy",
        ];
        $this->dto = new PersonDto($this->input);
        $this->model = new PersonModel($this->dto);
        $this->service = new PersonService($this->repository);
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
        $expected = 1179;

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
        $expected = 3649;

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
        $personId = 275;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($personId)
            ->willReturn(null);

        $actual = $this->service->get($personId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $personId = 6803;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($personId)
            ->willReturn($this->dto);

        $actual = $this->service->get($personId);
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
        $personId = 9376;
        $expected = 336;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($personId)
            ->willReturn($expected);

        $actual = $this->service->delete($personId);
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