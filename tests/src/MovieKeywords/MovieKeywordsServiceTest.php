<?php

declare(strict_types=1);

namespace Movies\Tests\MovieKeywords;

use PHPUnit\Framework\TestCase;
use Movies\MovieKeywords\{ MovieKeywordsDto, MovieKeywordsModel, IMovieKeywordsService, MovieKeywordsService };

class MovieKeywordsServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private MovieKeywordsDto $dto;
    private MovieKeywordsModel $model;
    private IMovieKeywordsService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\MovieKeywords\IMovieKeywordsRepository");
        $this->input = [
            "movie_keywords_id" => 5107,
            "movie_id" => 5257,
            "keyword_id" => 8473,
        ];
        $this->dto = new MovieKeywordsDto($this->input);
        $this->model = new MovieKeywordsModel($this->dto);
        $this->service = new MovieKeywordsService($this->repository);
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
        $expected = 3665;

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
        $expected = 3204;

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
        $movieKeywordsId = 1222;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($movieKeywordsId)
            ->willReturn(null);

        $actual = $this->service->get($movieKeywordsId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $movieKeywordsId = 1422;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($movieKeywordsId)
            ->willReturn($this->dto);

        $actual = $this->service->get($movieKeywordsId);
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
        $movieKeywordsId = 8538;
        $expected = 1975;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($movieKeywordsId)
            ->willReturn($expected);

        $actual = $this->service->delete($movieKeywordsId);
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