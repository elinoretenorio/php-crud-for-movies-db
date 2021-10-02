<?php

declare(strict_types=1);

namespace Movies\ProductionCompany;

class ProductionCompanyDto 
{
    public int $productionCompanyId;
    public int $companyId;
    public string $companyName;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->productionCompanyId = (int) ($row["production_company_id"] ?? 0);
        $this->companyId = (int) ($row["company_id"] ?? 0);
        $this->companyName = $row["company_name"] ?? "";
    }
}