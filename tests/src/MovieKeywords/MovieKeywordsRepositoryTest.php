<?php

declare(strict_types=1);

namespace Movies\Tests\MovieKeywords;

use PHPUnit\Framework\TestCase;
use Movies\Database\DatabaseException;
use Movies\MovieKeywords\{ MovieKeywordsDto, IMovieKeywordsRepository, MovieKeywordsRepository };

class MovieKeywordsRepositoryTest extends TestCase
{
    private $db;
    private $result;
    private array $input;
    private MovieKeywordsDto $dto;
    private IMovieKeywordsRepository $repository;

    protected function setUp(): void
    {
        $this->db = $this->createMock("Movies\Database\IDatabase");
        $this->result = $this->createMock("Movies\Database\IDatabaseResult");
        $this->input = [
            "movie_keywords_id" => 3502,
            "movie_id" => 4390,
            "keyword_id" => 4753,
        ];
        $this->dto = new MovieKeywordsDto($this->input);
        $this->repository = new MovieKeywordsRepository($this->db);
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
        $expected = 2782;

        $sql = "INSERT INTO `movie_keywords` (`movie_id`, `keyword_id`)
                VALUES (?, ?)";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->movieId,
                $this->dto->keywordId
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
        $expected = 4556;

        $sql = "UPDATE `movie_keywords` SET `movie_id` = ?, `keyword_id` = ?
                WHERE `movie_keywords_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([
                $this->dto->movieId,
                $this->dto->keywordId,
                $this->dto->movieKeywordsId
            ]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->update($this->dto);
        $this->assertEquals($expected, $actual);
    }

    public function testGet_ReturnsEmptyOnException(): void
    {
        $movieKeywordsId = 457;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->get($movieKeywordsId);
        $this->assertEmpty($actual);
    }

    public function testGet_ReturnsDto(): void
    {
        $movieKeywordsId = 4096;

        $sql = "SELECT `movie_keywords_id`, `movie_id`, `keyword_id`
                FROM `movie_keywords` WHERE `movie_keywords_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$movieKeywordsId]);
        $this->result->expects($this->once())
            ->method("fetchAll")
            ->willReturn([$this->input]);

        $actual = $this->repository->get($movieKeywordsId);
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
        $sql = "SELECT `movie_keywords_id`, `movie_id`, `keyword_id`
                FROM `movie_keywords`";

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
        $movieKeywordsId = 2615;
        $expected = -1;

        $this->db->method("prepare")
            ->will($this->throwException(new DatabaseException()));

        $actual = $this->repository->delete($movieKeywordsId);
        $this->assertEquals($expected, $actual);
    }

    public function testDelete_ReturnsRowCount(): void
    {
        $movieKeywordsId = 528;
        $expected = 7418;

        $sql = "DELETE FROM `movie_keywords` WHERE `movie_keywords_id` = ?";

        $this->db->expects($this->once())
            ->method("prepare")
            ->with($sql)
            ->willReturn($this->result);
        $this->result->expects($this->once())
            ->method("execute")
            ->with([$movieKeywordsId]);
        $this->result->expects($this->once())
            ->method("rowCount")
            ->willReturn($expected);

        $actual = $this->repository->delete($movieKeywordsId);
        $this->assertEquals($expected, $actual);
    }
}