<?php

declare(strict_types=1);

namespace Movies\Tests\ProductionCountry;

use PHPUnit\Framework\TestCase;
use Movies\Database\DatabaseException;
use Movies\ProductionCountry\{ ProductionCountryDto, IProductionCountryRepository, ProductionCountryRepository };

class ProductionCountryRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private ProductionCountryDto $dto;
    private IProductionCountryRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Movies\Database\IDatabase");
        $this->result = $this->createMock("Movies\Database\IDatabaseResult");
        $this->input = [
            "production_country_id" => 8009,
            "movie_id" => 2154,
            "country_id" => 9981,
        ];
        $this->dto = new ProductionCountryDto($this->input);
        $this->repository = new ProductionCountryRepository($this->db);
    }

    protected function tearDown(): void
    {
        unset($this->db);
        unset($this->result);
        unset($this->input);
        unset($this->dto);
        unset($this->repository);
    }

    public function testInsert_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testInsert_ReturnsId(): void
    {
        $expected = 2551;

        $sql = "INSERT INTO `production_country` (`movie_id`, `country_id`)
                VALUES (?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->movieId,
                $this->dto->countryId
            ]);
        $this->db->expects($this->once())
            ->method("lastInsertId")
            ->willReturn($expected);

        $actual = $this->repository->insert($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsFailedOnException(): void
    {
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testUpdate_ReturnsRowCount(): void
    {
        $expected = 1803;

        $sql = "UPDATE `production_country` SET `movie_id` = ?, `country_id` = ?
                WHERE `production_country_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->movieId,
                $this->dto->countryId,
                $this->dto->productionCountryId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $productionCountryId = 9590;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($productionCountryId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $productionCountryId = 205;

        $sql = "SELECT `production_country_id`, `movie_id`, `country_id`
                FROM `production_country` WHERE `production_country_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$productionCountryId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($productionCountryId);
        $this->assertEquals($this->dto, $actual);
    }

    public function testGetAll_ReturnsEmptyOnException(): void
    {
        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->getAll();
        $this->assertEmpty($actual);
    }

    public function testGetAll_ReturnsDtos(): void
    {
        $sql = "SELECT `production_country_id`, `movie_id`, `country_id`
                FROM `production_country`";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute");
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->getAll();
        $this->assertEquals([$this->dto], $actual);
    }

    public function testDelete_ReturnsFailedOnException(): void
    {
        $productionCountryId = 6612;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($productionCountryId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $productionCountryId = 3391;
        $expected = 8180;

        $sql = "DELETE FROM `production_country` WHERE `production_country_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$productionCountryId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($productionCountryId);
        $this->assertEquals($expected, $actual);
    }
}