<?php

declare(strict_types=1);

namespace Movies\ProductionCompany;

use JsonSerializable;

class ProductionCompanyModel implements JsonSerializable
{
    private int $productionCompanyId;
    private int $companyId;
    private string $companyName;

    public function __construct(ProductionCompanyDto $dto = null)
    {
        if ($dto === null) {
            return;
        }

        $this->productionCompanyId = $dto->productionCompanyId;
        $this->companyId = $dto->companyId;
        $this->companyName = $dto->companyName;
    }

    public function getProductionCompanyId(): int
    {
        return $this->productionCompanyId;
    }

    public function setProductionCompanyId(int $productionCompanyId): void
    {
        $this->productionCompanyId = $productionCompanyId;
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function setCompanyId(int $companyId): void
    {
        $this->companyId = $companyId;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): void
    {
        $this->companyName = $companyName;
    }

    public function toDto(): ProductionCompanyDto
    {
        $dto = new ProductionCompanyDto();
        $dto->productionCompanyId = (int) ($this->productionCompanyId ?? 0);
        $dto->companyId = (int) ($this->companyId ?? 0);
        $dto->companyName = $this->companyName ?? "";

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            "production_company_id" => $this->productionCompanyId,
            "company_id" => $this->companyId,
            "company_name" => $this->companyName,
        ];
    }
}