<?php

declare(strict_types=1);

namespace Movies\Tests\MovieGenres;

use PHPUnit\Framework\TestCase;
use Movies\MovieGenres\{ MovieGenresDto, MovieGenresModel, IMovieGenresService, MovieGenresService };

class MovieGenresServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private MovieGenresDto $dto;
    private MovieGenresModel $model;
    private IMovieGenresService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\MovieGenres\IMovieGenresRepository");
        $this->input = [
            "movie_genres_id" => 9743,
            "movie_id" => 2273,
            "genre_id" => 8344,
        ];
        $this->dto = new MovieGenresDto($this->input);
        $this->model = new MovieGenresModel($this->dto);
        $this->service = new MovieGenresService($this->repository);
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
        $expected = 6703;

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
        $expected = 9113;

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
        $movieGenresId = 2302;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($movieGenresId)
            ->willReturn(null);

        $actual = $this->service->get($movieGenresId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $movieGenresId = 7308;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($movieGenresId)
            ->willReturn($this->dto);

        $actual = $this->service->get($movieGenresId);
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
        $movieGenresId = 6063;
        $expected = 1809;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($movieGenresId)
            ->willReturn($expected);

        $actual = $this->service->delete($movieGenresId);
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