<?php

declare(strict_types=1);

namespace Movies\Tests\MovieCrew;

use PHPUnit\Framework\TestCase;
use Movies\MovieCrew\{ MovieCrewDto, MovieCrewModel, IMovieCrewService, MovieCrewService };

class MovieCrewServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private MovieCrewDto $dto;
    private MovieCrewModel $model;
    private IMovieCrewService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\MovieCrew\IMovieCrewRepository");
        $this->input = [
            "movie_crew_id" => 3922,
            "movie_id" => 3702,
            "person_id" => 1361,
            "department_id" => 9759,
            "job" => "health",
        ];
        $this->dto = new MovieCrewDto($this->input);
        $this->model = new MovieCrewModel($this->dto);
        $this->service = new MovieCrewService($this->repository);
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
        $expected = 2565;

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
        $expected = 7275;

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
        $movieCrewId = 8240;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($movieCrewId)
            ->willReturn(null);

        $actual = $this->service->get($movieCrewId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $movieCrewId = 4981;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($movieCrewId)
            ->willReturn($this->dto);

        $actual = $this->service->get($movieCrewId);
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
        $movieCrewId = 6293;
        $expected = 8090;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($movieCrewId)
            ->willReturn($expected);

        $actual = $this->service->delete($movieCrewId);
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