<?php

declare(strict_types=1);

namespace Movies\Tests\MovieCast;

use PHPUnit\Framework\TestCase;
use Movies\Database\DatabaseException;
use Movies\MovieCast\{ MovieCastDto, IMovieCastRepository, MovieCastRepository };

class MovieCastRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private MovieCastDto $dto;
    private IMovieCastRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Movies\Database\IDatabase");
        $this->result = $this->createMock("Movies\Database\IDatabaseResult");
        $this->input = [
            "movie_cast_id" => 8913,
            "movie_id" => 6654,
            "person_id" => 4694,
            "character_name" => "talk",
            "gender_id" => 7936,
            "cast_order" => 6237,
        ];
        $this->dto = new MovieCastDto($this->input);
        $this->repository = new MovieCastRepository($this->db);
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
        $expected = 1372;

        $sql = "INSERT INTO `movie_cast` (`movie_id`, `person_id`, `character_name`, `gender_id`, `cast_order`)
                VALUES (?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->movieId,
                $this->dto->personId,
                $this->dto->characterName,
                $this->dto->genderId,
                $this->dto->castOrder
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
        $expected = 3527;

        $sql = "UPDATE `movie_cast` SET `movie_id` = ?, `person_id` = ?, `character_name` = ?, `gender_id` = ?, `cast_order` = ?
                WHERE `movie_cast_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->movieId,
                $this->dto->personId,
                $this->dto->characterName,
                $this->dto->genderId,
                $this->dto->castOrder,
                $this->dto->movieCastId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $movieCastId = 3009;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($movieCastId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $movieCastId = 3967;

        $sql = "SELECT `movie_cast_id`, `movie_id`, `person_id`, `character_name`, `gender_id`, `cast_order`
                FROM `movie_cast` WHERE `movie_cast_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$movieCastId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($movieCastId);
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
        $sql = "SELECT `movie_cast_id`, `movie_id`, `person_id`, `character_name`, `gender_id`, `cast_order`
                FROM `movie_cast`";

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
        $movieCastId = 2965;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($movieCastId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $movieCastId = 4628;
        $expected = 6650;

        $sql = "DELETE FROM `movie_cast` WHERE `movie_cast_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$movieCastId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($movieCastId);
        $this->assertEquals($expected, $actual);
    }
}