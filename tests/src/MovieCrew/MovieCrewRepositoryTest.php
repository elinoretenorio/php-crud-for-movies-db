<?php

declare(strict_types=1);

namespace Movies\Tests\MovieCrew;

use PHPUnit\Framework\TestCase;
use Movies\Database\DatabaseException;
use Movies\MovieCrew\{ MovieCrewDto, IMovieCrewRepository, MovieCrewRepository };

class MovieCrewRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private MovieCrewDto $dto;
    private IMovieCrewRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Movies\Database\IDatabase");
        $this->result = $this->createMock("Movies\Database\IDatabaseResult");
        $this->input = [
            "movie_crew_id" => 182,
            "movie_id" => 8329,
            "person_id" => 2509,
            "department_id" => 861,
            "job" => "term",
        ];
        $this->dto = new MovieCrewDto($this->input);
        $this->repository = new MovieCrewRepository($this->db);
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
        $expected = 7633;

        $sql = "INSERT INTO `movie_crew` (`movie_id`, `person_id`, `department_id`, `job`)
                VALUES (?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->movieId,
                $this->dto->personId,
                $this->dto->departmentId,
                $this->dto->job
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
        $expected = 1055;

        $sql = "UPDATE `movie_crew` SET `movie_id` = ?, `person_id` = ?, `department_id` = ?, `job` = ?
                WHERE `movie_crew_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->movieId,
                $this->dto->personId,
                $this->dto->departmentId,
                $this->dto->job,
                $this->dto->movieCrewId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $movieCrewId = 6110;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($movieCrewId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $movieCrewId = 3467;

        $sql = "SELECT `movie_crew_id`, `movie_id`, `person_id`, `department_id`, `job`
                FROM `movie_crew` WHERE `movie_crew_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$movieCrewId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($movieCrewId);
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
        $sql = "SELECT `movie_crew_id`, `movie_id`, `person_id`, `department_id`, `job`
                FROM `movie_crew`";

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
        $movieCrewId = 917;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($movieCrewId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $movieCrewId = 600;
        $expected = 375;

        $sql = "DELETE FROM `movie_crew` WHERE `movie_crew_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$movieCrewId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($movieCrewId);
        $this->assertEquals($expected, $actual);
    }
}