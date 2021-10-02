<?php

declare(strict_types=1);

namespace Movies\Tests\Movie;

use PHPUnit\Framework\TestCase;
use Movies\Database\DatabaseException;
use Movies\Movie\{ MovieDto, IMovieRepository, MovieRepository };

class MovieRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private MovieDto $dto;
    private IMovieRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Movies\Database\IDatabase");
        $this->result = $this->createMock("Movies\Database\IDatabaseResult");
        $this->input = [
            "movie_id" => 2122,
            "title" => "after",
            "budget" => 6828,
            "homepage" => "bring",
            "overview" => "continue",
            "popularity" => 641.00,
            "release_date" => "2021-09-23",
            "revenue" => 42,
            "runtime" => 2107,
            "movie_status" => "do",
            "tagline" => "talk",
            "vote_average" => 528.00,
            "vote_count" => 3395,
        ];
        $this->dto = new MovieDto($this->input);
        $this->repository = new MovieRepository($this->db);
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
        $expected = 756;

        $sql = "INSERT INTO `movie` (`title`, `budget`, `homepage`, `overview`, `popularity`, `release_date`, `revenue`, `runtime`, `movie_status`, `tagline`, `vote_average`, `vote_count`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->title,
                $this->dto->budget,
                $this->dto->homepage,
                $this->dto->overview,
                $this->dto->popularity,
                $this->dto->releaseDate,
                $this->dto->revenue,
                $this->dto->runtime,
                $this->dto->movieStatus,
                $this->dto->tagline,
                $this->dto->voteAverage,
                $this->dto->voteCount
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
        $expected = 3803;

        $sql = "UPDATE `movie` SET `title` = ?, `budget` = ?, `homepage` = ?, `overview` = ?, `popularity` = ?, `release_date` = ?, `revenue` = ?, `runtime` = ?, `movie_status` = ?, `tagline` = ?, `vote_average` = ?, `vote_count` = ?
                WHERE `movie_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->title,
                $this->dto->budget,
                $this->dto->homepage,
                $this->dto->overview,
                $this->dto->popularity,
                $this->dto->releaseDate,
                $this->dto->revenue,
                $this->dto->runtime,
                $this->dto->movieStatus,
                $this->dto->tagline,
                $this->dto->voteAverage,
                $this->dto->voteCount,
                $this->dto->movieId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $movieId = 1772;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($movieId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $movieId = 1763;

        $sql = "SELECT `movie_id`, `title`, `budget`, `homepage`, `overview`, `popularity`, `release_date`, `revenue`, `runtime`, `movie_status`, `tagline`, `vote_average`, `vote_count`
                FROM `movie` WHERE `movie_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$movieId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($movieId);
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
        $sql = "SELECT `movie_id`, `title`, `budget`, `homepage`, `overview`, `popularity`, `release_date`, `revenue`, `runtime`, `movie_status`, `tagline`, `vote_average`, `vote_count`
                FROM `movie`";

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
        $movieId = 4540;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($movieId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $movieId = 8366;
        $expected = 7965;

        $sql = "DELETE FROM `movie` WHERE `movie_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$movieId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($movieId);
        $this->assertEquals($expected, $actual);
    }
}