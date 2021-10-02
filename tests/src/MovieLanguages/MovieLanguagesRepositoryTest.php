<?php

declare(strict_types=1);

namespace Movies\Tests\MovieLanguages;

use PHPUnit\Framework\TestCase;
use Movies\Database\DatabaseException;
use Movies\MovieLanguages\{ MovieLanguagesDto, IMovieLanguagesRepository, MovieLanguagesRepository };

class MovieLanguagesRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private MovieLanguagesDto $dto;
    private IMovieLanguagesRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Movies\Database\IDatabase");
        $this->result = $this->createMock("Movies\Database\IDatabaseResult");
        $this->input = [
            "movie_languages_id" => 4236,
            "movie_id" => 9878,
            "language_id" => 5035,
            "language_role_id" => 373,
        ];
        $this->dto = new MovieLanguagesDto($this->input);
        $this->repository = new MovieLanguagesRepository($this->db);
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
        $expected = 7342;

        $sql = "INSERT INTO `movie_languages` (`movie_id`, `language_id`, `language_role_id`)
                VALUES (?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->movieId,
                $this->dto->languageId,
                $this->dto->languageRoleId
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
        $expected = 4817;

        $sql = "UPDATE `movie_languages` SET `movie_id` = ?, `language_id` = ?, `language_role_id` = ?
                WHERE `movie_languages_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->movieId,
                $this->dto->languageId,
                $this->dto->languageRoleId,
                $this->dto->movieLanguagesId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $movieLanguagesId = 3116;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($movieLanguagesId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $movieLanguagesId = 1461;

        $sql = "SELECT `movie_languages_id`, `movie_id`, `language_id`, `language_role_id`
                FROM `movie_languages` WHERE `movie_languages_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$movieLanguagesId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($movieLanguagesId);
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
        $sql = "SELECT `movie_languages_id`, `movie_id`, `language_id`, `language_role_id`
                FROM `movie_languages`";

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
        $movieLanguagesId = 542;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($movieLanguagesId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $movieLanguagesId = 3733;
        $expected = 8198;

        $sql = "DELETE FROM `movie_languages` WHERE `movie_languages_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$movieLanguagesId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($movieLanguagesId);
        $this->assertEquals($expected, $actual);
    }
}