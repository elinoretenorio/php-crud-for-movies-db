<?php

declare(strict_types=1);

namespace Movies\Tests\MovieCompany;

use PHPUnit\Framework\TestCase;
use Movies\MovieCompany\{ MovieCompanyDto, MovieCompanyModel, IMovieCompanyService, MovieCompanyService };

class MovieCompanyServiceTest extends TestCase
{
    private $repository;
    private array $input;
    private MovieCompanyDto $dto;
    private MovieCompanyModel $model;
    private IMovieCompanyService $service;

    protected function setUp(): void
    {
        $this->repository = $this->createMock("Movies\MovieCompany\IMovieCompanyRepository");
        $this->input = [
            "movie_company_id" => 1931,
            "movie_id" => 386,
            "company_id" => 5083,
        ];
        $this->dto = new MovieCompanyDto($this->input);
        $this->model = new MovieCompanyModel($this->dto);
        $this->service = new MovieCompanyService($this->repository);
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
        $expected = 8045;

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
        $expected = 9122;

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
        $movieCompanyId = 4836;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($movieCompanyId)
            ->willReturn(null);

        $actual = $this->service->get($movieCompanyId);
        $this->assertNull($actual);
    }

    public function testGet_ReturnsModel(): void
    {
        $movieCompanyId = 1418;

        $this->repository->expects($this->once())
            ->method("get")
            ->with($movieCompanyId)
            ->willReturn($this->dto);

        $actual = $this->service->get($movieCompanyId);
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
        $movieCompanyId = 3941;
        $expected = 7227;

        $this->repository->expects($this->once())
            ->method("delete")
            ->with($movieCompanyId)
            ->willReturn($expected);

        $actual = $this->service->delete($movieCompanyId);
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