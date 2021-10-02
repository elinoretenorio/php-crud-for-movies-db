<?php

declare(strict_types=1);

namespace Movies\Tests\ProductionCompany;

use PHPUnit\Framework\TestCase;
use Movies\Database\DatabaseException;
use Movies\ProductionCompany\{ ProductionCompanyDto, IProductionCompanyRepository, ProductionCompanyRepository };

class ProductionCompanyRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private ProductionCompanyDto $dto;
    private IProductionCompanyRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Movies\Database\IDatabase");
        $this->result = $this->createMock("Movies\Database\IDatabaseResult");
        $this->input = [
            "production_company_id" => 8976,
            "company_id" => 8228,
            "company_name" => "memory",
        ];
        $this->dto = new ProductionCompanyDto($this->input);
        $this->repository = new ProductionCompanyRepository($this->db);
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
        $expected = 7237;

        $sql = "INSERT INTO `production_company` (`company_id`, `company_name`)
                VALUES (?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->companyId,
                $this->dto->companyName
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
        $expected = 8141;

        $sql = "UPDATE `production_company` SET `company_id` = ?, `company_name` = ?
                WHERE `production_company_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->companyId,
                $this->dto->companyName,
                $this->dto->productionCompanyId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $productionCompanyId = 8561;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($productionCompanyId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $productionCompanyId = 2700;

        $sql = "SELECT `production_company_id`, `company_id`, `company_name`
                FROM `production_company` WHERE `production_company_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$productionCompanyId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($productionCompanyId);
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
        $sql = "SELECT `production_company_id`, `company_id`, `company_name`
                FROM `production_company`";

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
        $productionCompanyId = 2867;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($productionCompanyId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $productionCompanyId = 7731;
        $expected = 2905;

        $sql = "DELETE FROM `production_company` WHERE `production_company_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$productionCompanyId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($productionCompanyId);
        $this->assertEquals($expected, $actual);
    }
}