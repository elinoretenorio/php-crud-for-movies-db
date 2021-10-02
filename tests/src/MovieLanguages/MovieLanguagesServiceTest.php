<?php

declare(strict_types=1);

namespace Movies\Tests\MovieLanguages;

use PHPUnit\Framework\TestCase;
use Movies\MovieLanguages\{ MovieLanguagesDto, MovieLanguagesModel, IMovieLanguagesService, MovieLanguagesService };

class MovieLanguagesServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private MovieLanguagesDto $dto;
    private MovieLanguagesModel $model;
    private IMovieLanguagesService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\MovieLanguages\IMovieLanguagesRepository");
        $this->input = [
            "movie_languages_id" => 8460,
            "movie_id" => 1971,
            "language_id" => 9976,
            "language_role_id" => 4778,
        ];
        $this->dto = new MovieLanguagesDto($this->input);
        $this->model = new MovieLanguagesModel($this->dto);
        $this->service = new MovieLanguagesService($this->repository);
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
        $expected = 335;

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
        $expected = 4772;

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
        $movieLanguagesId = 2050;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($movieLanguagesId)
            ->willReturn(null);

        $actual = $this->service->get($movieLanguagesId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $movieLanguagesId = 4850;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($movieLanguagesId)
            ->willReturn($this->dto);

        $actual = $this->service->get($movieLanguagesId);
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
        $movieLanguagesId = 2405;
        $expected = 1335;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($movieLanguagesId)
            ->willReturn($expected);

        $actual = $this->service->delete($movieLanguagesId);
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