<?php

declare(strict_types=1);

namespace Movies\Tests\LanguageRole;

use PHPUnit\Framework\TestCase;
use Movies\Database\DatabaseException;
use Movies\LanguageRole\{ LanguageRoleDto, ILanguageRoleRepository, LanguageRoleRepository };

class LanguageRoleRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private LanguageRoleDto $dto;
    private ILanguageRoleRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Movies\Database\IDatabase");
        $this->result = $this->createMock("Movies\Database\IDatabaseResult");
        $this->input = [
            "language_role_id" => 3657,
            "role_id" => 7130,
            "language_role" => "recent",
        ];
        $this->dto = new LanguageRoleDto($this->input);
        $this->repository = new LanguageRoleRepository($this->db);
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
        $expected = 9148;

        $sql = "INSERT INTO `language_role` (`role_id`, `language_role`)
                VALUES (?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->roleId,
                $this->dto->languageRole
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
        $expected = 6769;

        $sql = "UPDATE `language_role` SET `role_id` = ?, `language_role` = ?
                WHERE `language_role_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->roleId,
                $this->dto->languageRole,
                $this->dto->languageRoleId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $languageRoleId = 1807;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($languageRoleId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $languageRoleId = 5781;

        $sql = "SELECT `language_role_id`, `role_id`, `language_role`
                FROM `language_role` WHERE `language_role_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$languageRoleId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($languageRoleId);
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
        $sql = "SELECT `language_role_id`, `role_id`, `language_role`
                FROM `language_role`";

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
        $languageRoleId = 7578;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($languageRoleId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $languageRoleId = 3443;
        $expected = 247;

        $sql = "DELETE FROM `language_role` WHERE `language_role_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$languageRoleId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($languageRoleId);
        $this->assertEquals($expected, $actual);
    }
}