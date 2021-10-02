<?php

declare(strict_types=1);

namespace Movies\Tests\LanguageRole;

use PHPUnit\Framework\TestCase;
use Movies\LanguageRole\{ LanguageRoleDto, LanguageRoleModel, ILanguageRoleService, LanguageRoleService };

class LanguageRoleServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private LanguageRoleDto $dto;
    private LanguageRoleModel $model;
    private ILanguageRoleService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\LanguageRole\ILanguageRoleRepository");
        $this->input = [
            "language_role_id" => 46,
            "role_id" => 529,
            "language_role" => "design",
        ];
        $this->dto = new LanguageRoleDto($this->input);
        $this->model = new LanguageRoleModel($this->dto);
        $this->service = new LanguageRoleService($this->repository);
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
        $expected = 9471;

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
        $expected = 8241;

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
        $languageRoleId = 9357;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($languageRoleId)
            ->willReturn(null);

        $actual = $this->service->get($languageRoleId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $languageRoleId = 1355;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($languageRoleId)
            ->willReturn($this->dto);

        $actual = $this->service->get($languageRoleId);
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
        $languageRoleId = 9228;
        $expected = 1626;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($languageRoleId)
            ->willReturn($expected);

        $actual = $this->service->delete($languageRoleId);
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