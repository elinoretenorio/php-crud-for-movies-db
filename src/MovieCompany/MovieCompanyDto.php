<?php

declare(strict_types=1);

namespace Movies\MovieCompany;

class MovieCompanyDto 
{
    public int $movieCompanyId;
    public int $movieId;
    public int $companyId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->movieCompanyId = (int) ($row["movie_company_id"] ?? 0);
        $this->movieId = (int) ($row["movie_id"] ?? 0);
        $this->companyId = (int) ($row["company_id"] ?? 0);
    }
}