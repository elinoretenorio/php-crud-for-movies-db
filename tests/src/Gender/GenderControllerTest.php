<?php

declare(strict_types=1);

namespace Movies\Tests\Gender;

use PHPUnit\Framework\TestCase;
use Movies\Gender\{ GenderDto, GenderModel, GenderController };

class GenderControllerTest extends TestCase
{
    private array $input;
    private GenderDto $dto;
    private GenderModel $model;
    private $service;
    private $request;
    private $stream;
    private GenderController $controller;

    protected function setUp(): void
    {
        $this->input = [
            "gender_id" => 2071,
            "gender" => "scene",
        ];
        $this->dto = new GenderDto($this->input);
        $this->model = new GenderModel($this->dto);
        $this->service = $this->createMock("Movies\Gender\IGenderService");
        $this->request = $this->createMock("Psr\Http\Message\ServerRequestInterface");
        $this->stream = $this->createMock("Psr\Http\Message\StreamInterface");
        $this->controller = new GenderController(
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
        $id = 6568;
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
        $args = ["gender_id" => 0];

        $actual = $this->controller->update($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testUpdate_ReturnsResponse(): void
    {
        $id = 472;
        $expected = ["result" => $id];
        $args = ["gender_id" => 7742];

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
        $args = ["gender_id" => 0];

        $actual = $this->controller->get($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testGet_ReturnsResponse(): void
    {
        $expected = ["result" => $this->model->jsonSerialize()];
        $args = ["gender_id" => 5101];

        $this->service->expects($this->once())
            ->method("get")
            ->with($args["gender_id"])
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
        $args = ["gender_id" => 0];

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }

    public function testDelete_ReturnsResponse(): void
    {
        $id = 1989;
        $expected = ["result" => $id];
        $args = ["gender_id" => 3813];

        $this->service->expects($this->once())
            ->method("delete")
            ->with($args["gender_id"])
            ->willReturn($id);

        $actual = $this->controller->delete($this->request, $args);
        $this->assertEquals($expected, $actual->getPayload());
    }
}