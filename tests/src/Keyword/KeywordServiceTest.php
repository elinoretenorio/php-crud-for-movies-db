<?php

declare(strict_types=1);

namespace Movies\Tests\Keyword;

use PHPUnit\Framework\TestCase;
use Movies\Keyword\{ KeywordDto, KeywordModel, IKeywordService, KeywordService };

class KeywordServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private KeywordDto $dto;
    private KeywordModel $model;
    private IKeywordService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\Keyword\IKeywordRepository");
        $this->input = [
            "keyword_id" => 751,
            "keyword_name" => "little",
        ];
        $this->dto = new KeywordDto($this->input);
        $this->model = new KeywordModel($this->dto);
        $this->service = new KeywordService($this->repository);
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
        $expected = 3536;

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
        $expected = 5431;

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
        $keywordId = 8284;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($keywordId)
            ->willReturn(null);

        $actual = $this->service->get($keywordId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $keywordId = 1862;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($keywordId)
            ->willReturn($this->dto);

        $actual = $this->service->get($keywordId);
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
        $keywordId = 5841;
        $expected = 4895;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($keywordId)
            ->willReturn($expected);

        $actual = $this->service->delete($keywordId);
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