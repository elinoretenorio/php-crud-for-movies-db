<?php

declare(strict_types=1);

namespace Movies\Tests\Genre;

use PHPUnit\Framework\TestCase;
use Movies\Genre\{ GenreDto, GenreModel, IGenreService, GenreService };

class GenreServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private GenreDto $dto;
    private GenreModel $model;
    private IGenreService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\Genre\IGenreRepository");
        $this->input = [
            "genre_id" => 4008,
            "genre_name" => "alone",
        ];
        $this->dto = new GenreDto($this->input);
        $this->model = new GenreModel($this->dto);
        $this->service = new GenreService($this->repository);
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
        $expected = 9313;

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
        $expected = 1169;

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
        $genreId = 8329;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($genreId)
            ->willReturn(null);

        $actual = $this->service->get($genreId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $genreId = 7334;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($genreId)
            ->willReturn($this->dto);

        $actual = $this->service->get($genreId);
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
        $genreId = 2007;
        $expected = 800;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($genreId)
            ->willReturn($expected);

        $actual = $this->service->delete($genreId);
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