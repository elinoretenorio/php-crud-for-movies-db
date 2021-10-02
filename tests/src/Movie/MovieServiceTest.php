<?php

declare(strict_types=1);

namespace Movies\Tests\Movie;

use PHPUnit\Framework\TestCase;
use Movies\Movie\{ MovieDto, MovieModel, IMovieService, MovieService };

class MovieServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private MovieDto $dto;
    private MovieModel $model;
    private IMovieService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\Movie\IMovieRepository");
        $this->input = [
            "movie_id" => 1034,
            "title" => "work",
            "budget" => 1621,
            "homepage" => "student",
            "overview" => "mother",
            "popularity" => 577.68,
            "release_date" => "2021-09-24",
            "revenue" => 7709,
            "runtime" => 3579,
            "movie_status" => "loss",
            "tagline" => "upon",
            "vote_average" => 180.00,
            "vote_count" => 2988,
        ];
        $this->dto = new MovieDto($this->input);
        $this->model = new MovieModel($this->dto);
        $this->service = new MovieService($this->repository);
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
        $expected = 7958;

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
        $expected = 8434;

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
        $movieId = 3695;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($movieId)
            ->willReturn(null);

        $actual = $this->service->get($movieId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $movieId = 859;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($movieId)
            ->willReturn($this->dto);

        $actual = $this->service->get($movieId);
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
        $movieId = 3249;
        $expected = 2645;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($movieId)
            ->willReturn($expected);

        $actual = $this->service->delete($movieId);
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