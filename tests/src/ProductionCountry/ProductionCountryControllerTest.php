<?php

declare(strict_types=1);

namespace Movies\Tests\ProductionCountry;

use PHPUnit\Framework\TestCase;
use Movies\ProductionCountry\{ ProductionCountryDto, ProductionCountryModel, ProductionCountryController };

class ProductionCountryControllerTest extends TestCase
{
    private array $input;
    private ProductionCountryDto $dto;
    private ProductionCountryModel $model;
    private $service;
    private $request;
    private $stream;
    private ProductionCountryController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "production_country_id" => 3389,
            "movie_id" => 1645,
            "country_id" => 8991,
        ];
        $this->dto = new ProductionCountryDto($this->input);
        $this->model = new ProductionCountryModel($this->dto);
        $this->service = $this->createMock("Movies\ProductionCountry\IProductionCountryService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new ProductionCountryController(
            $this->service
        );

        $this->stream->method("getContents")
            ->willReturn("[]");

        $this->request->method("getBody")
            ->willReturn($this->stream);

        $this->request->method("getParsedBody")
            ->willReturn($this->input);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
        unset($this->service);
        unset($this->request);
        unset($this->stream);
        unset($this->controller);
    }

    public function testInsert_ReturnsResponse(): void
    {
        $id = 8983;
        $expected = ["result" => $id];
        $args = [];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("insert")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->insert($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["production_country_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 8362;
        $expected = ["result" => $id];
        $args = ["production_country_id" => 1162];

        $this->service->expects($this->once())
            ->method("createModel")
            ->with($this->request->getParsedBody())
            ->willReturn($this->model);
        $this->service->expects($this->once())
            ->method("update")
            ->with($this->model)
            ->willReturn($id);

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["production_country_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["production_country_id" => 788];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["production_country_id"])
            ->willReturn($this->model);

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGetAll_ReturnsResponse(): void
    {
        $expected = ["result" => [$this->model->jsonSerialize()]];
        $args = [];

        $this->service->expects($this->once())
            ->method("getAll")
            ->willReturn([$this->model]);

        $actual = $this->controller->getAll($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsErrorResponse(): void
    {
        $expected = ["result" => 0, "message" => "Invalid input"];
        $args = ["production_country_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 9345;
        $expected = ["result" => $id];
        $args = ["production_country_id" => 4749];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["production_country_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}