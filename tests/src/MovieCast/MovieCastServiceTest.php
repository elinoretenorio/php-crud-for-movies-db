<?php

declare(strict_types=1);

namespace Movies\Tests\MovieCast;

use PHPUnit\Framework\TestCase;
use Movies\MovieCast\{ MovieCastDto, MovieCastModel, IMovieCastService, MovieCastService };

class MovieCastServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private MovieCastDto $dto;
    private MovieCastModel $model;
    private IMovieCastService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\MovieCast\IMovieCastRepository");
        $this->input = [
            "movie_cast_id" => 6458,
            "movie_id" => 4185,
            "person_id" => 8065,
            "character_name" => "question",
            "gender_id" => 8960,
            "cast_order" => 9890,
        ];
        $this->dto = new MovieCastDto($this->input);
        $this->model = new MovieCastModel($this->dto);
        $this->service = new MovieCastService($this->repository);
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
        $expected = 7275;

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
        $expected = 5124;

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
        $movieCastId = 3644;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($movieCastId)
            ->willReturn(null);

        $actual = $this->service->get($movieCastId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $movieCastId = 5319;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($movieCastId)
            ->willReturn($this->dto);

        $actual = $this->service->get($movieCastId);
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
        $movieCastId = 9100;
        $expected = 7678;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($movieCastId)
            ->willReturn($expected);

        $actual = $this->service->delete($movieCastId);
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