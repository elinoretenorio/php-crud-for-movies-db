<?php

declare(strict_types=1);

namespace Movies\Tests\Language;

use PHPUnit\Framework\TestCase;
use Movies\Language\{ LanguageDto, LanguageModel, ILanguageService, LanguageService };

class LanguageServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private LanguageDto $dto;
    private LanguageModel $model;
    private ILanguageService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\Language\ILanguageRepository");
        $this->input = [
            "language_id" => 9469,
            "language_code" => "thus",
            "language_name" => "career",
        ];
        $this->dto = new LanguageDto($this->input);
        $this->model = new LanguageModel($this->dto);
        $this->service = new LanguageService($this->repository);
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
        $expected = 1254;

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
        $expected = 2795;

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
        $languageId = 6889;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($languageId)
            ->willReturn(null);

        $actual = $this->service->get($languageId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $languageId = 8543;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($languageId)
            ->willReturn($this->dto);

        $actual = $this->service->get($languageId);
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
        $languageId = 4453;
        $expected = 6110;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($languageId)
            ->willReturn($expected);

        $actual = $this->service->delete($languageId);
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