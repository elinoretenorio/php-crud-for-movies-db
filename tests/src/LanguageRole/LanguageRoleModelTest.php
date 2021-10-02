<?php

declare(strict_types=1);

namespace Movies\Tests\LanguageRole;

use PHPUnit\Framework\TestCase;
use Movies\LanguageRole\{ LanguageRoleDto, LanguageRoleModel };

class LanguageRoleModelTest extends TestCase
{
    private array $input;
    private LanguageRoleDto $dto;
    private LanguageRoleModel $model;

    protected function setUp(): void
    {
        $this->input = [
            "language_role_id" => 1323,
            "role_id" => 6766,
            "language_role" => "themselves",
        ];
        $this->dto = new LanguageRoleDto($this->input);
        $this->model = new LanguageRoleModel($this->dto);
    }

    protected function tearDown(): void
    {
        unset($this->input);
        unset($this->dto);
        unset($this->model);
    }

    public function testModel_ReturnsInstance(): void
    {
        $model = new LanguageRoleModel(null);

        $this->assertInstanceOf(LanguageRoleModel::class, $model);
    }

    public function testGetLanguageRoleId(): void
    {
        $this->assertEquals($this->dto->languageRoleId, $this->model->getLanguageRoleId());
    }

    public function testSetLanguageRoleId(): void
    {
        $expected = 6687;
        $model = $this->model;
        $model->setLanguageRoleId($expected);

        $this->assertEquals($expected, $model->getLanguageRoleId());
    }

    public function testGetRoleId(): void
    {
        $this->assertEquals($this->dto->roleId, $this->model->getRoleId());
    }

    public function testSetRoleId(): void
    {
        $expected = 9241;
        $model = $this->model;
        $model->setRoleId($expected);

        $this->assertEquals($expected, $model->getRoleId());
    }

    public function testGetLanguageRole(): void
    {
        $this->assertEquals($this->dto->languageRole, $this->model->getLanguageRole());
    }

    public function testSetLanguageRole(): void
    {
        $expected = "business";
        $model = $this->model;
        $model->setLanguageRole($expected);

        $this->assertEquals($expected, $model->getLanguageRole());
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