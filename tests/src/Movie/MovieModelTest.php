<?php

declare(strict_types=1);

namespace Movies\Tests\Movie;

use PHPUnit\Framework\TestCase;
use Movies\Movie\{ MovieDto, MovieModel };

class MovieModelTest extends TestCase
{
    private array $input;
    private MovieDto $dto;
    private MovieModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "movie_id" => 547,
            "title" => "activity",
            "budget" => 9201,
            "homepage" => "parent",
            "overview" => "nation",
            "popularity" => 766.44,
            "release_date" => "2021-10-14",
            "revenue" => 1658,
            "runtime" => 1409,
            "movie_status" => "bit",
            "tagline" => "room",
            "vote_average" => 827.21,
            "vote_count" => 1748,
        ];
        $this->dto = new MovieDto($this->input);
        $this->model = new MovieModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new MovieModel(null);

        $this->assertInstanceOf(MovieModel::class, $model);
    }

    public function testGetMovieId(): void
    {
        $this->assertEquals($this->dto->movieId, $this->model->getMovieId());
    }

    public function testSetMovieId(): void
    {
        $expected = 9987;
        $model = $this->model;
        $model->setMovieId($expected);

        $this->assertEquals($expected, $model->getMovieId());
    }

    public function testGetTitle(): void
    {
        $this->assertEquals($this->dto->title, $this->model->getTitle());
    }

    public function testSetTitle(): void
    {
        $expected = "response";
        $model = $this->model;
        $model->setTitle($expected);

        $this->assertEquals($expected, $model->getTitle());
    }

    public function testGetBudget(): void
    {
        $this->assertEquals($this->dto->budget, $this->model->getBudget());
    }

    public function testSetBudget(): void
    {
        $expected = 9184;
        $model = $this->model;
        $model->setBudget($expected);

        $this->assertEquals($expected, $model->getBudget());
    }

    public function testGetHomepage(): void
    {
        $this->assertEquals($this->dto->homepage, $this->model->getHomepage());
    }

    public function testSetHomepage(): void
    {
        $expected = "expect";
        $model = $this->model;
        $model->setHomepage($expected);

        $this->assertEquals($expected, $model->getHomepage());
    }

    public function testGetOverview(): void
    {
        $this->assertEquals($this->dto->overview, $this->model->getOverview());
    }

    public function testSetOverview(): void
    {
        $expected = "most";
        $model = $this->model;
        $model->setOverview($expected);

        $this->assertEquals($expected, $model->getOverview());
    }

    public function testGetPopularity(): void
    {
        $this->assertEquals($this->dto->popularity, $this->model->getPopularity());
    }

    public function testSetPopularity(): void
    {
        $expected = 559.20;
        $model = $this->model;
        $model->setPopularity($expected);

        $this->assertEquals($expected, $model->getPopularity());
    }

    public function testGetReleaseDate(): void
    {
        $this->assertEquals($this->dto->releaseDate, $this->model->getReleaseDate());
    }

    public function testSetReleaseDate(): void
    {
        $expected = "2021-10-08";
        $model = $this->model;
        $model->setReleaseDate($expected);

        $this->assertEquals($expected, $model->getReleaseDate());
    }

    public function testGetRevenue(): void
    {
        $this->assertEquals($this->dto->revenue, $this->model->getRevenue());
    }

    public function testSetRevenue(): void
    {
        $expected = 7981;
        $model = $this->model;
        $model->setRevenue($expected);

        $this->assertEquals($expected, $model->getRevenue());
    }

    public function testGetRuntime(): void
    {
        $this->assertEquals($this->dto->runtime, $this->model->getRuntime());
    }

    public function testSetRuntime(): void
    {
        $expected = 5758;
        $model = $this->model;
        $model->setRuntime($expected);

        $this->assertEquals($expected, $model->getRuntime());
    }

    public function testGetMovieStatus(): void
    {
        $this->assertEquals($this->dto->movieStatus, $this->model->getMovieStatus());
    }

    public function testSetMovieStatus(): void
    {
        $expected = "there";
        $model = $this->model;
        $model->setMovieStatus($expected);

        $this->assertEquals($expected, $model->getMovieStatus());
    }

    public function testGetTagline(): void
    {
        $this->assertEquals($this->dto->tagline, $this->model->getTagline());
    }

    public function testSetTagline(): void
    {
        $expected = "model";
        $model = $this->model;
        $model->setTagline($expected);

        $this->assertEquals($expected, $model->getTagline());
    }

    public function testGetVoteAverage(): void
    {
        $this->assertEquals($this->dto->voteAverage, $this->model->getVoteAverage());
    }

    public function testSetVoteAverage(): void
    {
        $expected = 174.12;
        $model = $this->model;
        $model->setVoteAverage($expected);

        $this->assertEquals($expected, $model->getVoteAverage());
    }

    public function testGetVoteCount(): void
    {
        $this->assertEquals($this->dto->voteCount, $this->model->getVoteCount());
    }

    public function testSetVoteCount(): void
    {
        $expected = 8523;
        $model = $this->model;
        $model->setVoteCount($expected);

        $this->assertEquals($expected, $model->getVoteCount());
    }

    public function testToDto(): void
    {
        $this->assertEquals($this->dto, $this->model->toDto());
    }

    public function testJsonSerialize(): void
    {
        $this->assertEquals($this->input, $this->model->jsonSerialize());
    }
}