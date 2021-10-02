<?php

declare(strict_types=1);

namespace Movies\Tests\Country;

use PHPUnit\Framework\TestCase;
use Movies\Database\DatabaseException;
use Movies\Country\{ CountryDto, ICountryRepository, CountryRepository };

class CountryRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private CountryDto $dto;
    private ICountryRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Movies\Database\IDatabase");
        $this->result = $this->createMock("Movies\Database\IDatabaseResult");
        $this->input = [
            "country_id" => 4149,
            "country_iso_code" => "agent",
            "country_name" => "small",
        ];
        $this->dto = new CountryDto($this->input);
        $this->repository = new CountryRepository($this->db);
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
        $expected = 8211;

        $sql = "INSERT INTO `country` (`country_iso_code`, `country_name`)
                VALUES (?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->countryIsoCode,
                $this->dto->countryName
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
        $expected = 5090;

        $sql = "UPDATE `country` SET `country_iso_code` = ?, `country_name` = ?
                WHERE `country_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->countryIsoCode,
                $this->dto->countryName,
                $this->dto->countryId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $countryId = 9472;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($countryId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $countryId = 8146;

        $sql = "SELECT `country_id`, `country_iso_code`, `country_name`
                FROM `country` WHERE `country_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$countryId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($countryId);
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
        $sql = "SELECT `country_id`, `country_iso_code`, `country_name`
                FROM `country`";

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
        $countryId = 5787;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($countryId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $countryId = 577;
        $expected = 763;

        $sql = "DELETE FROM `country` WHERE `country_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$countryId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($countryId);
        $this->assertEquals($expected, $actual);
    }
}