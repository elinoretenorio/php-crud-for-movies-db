<?php

declare(strict_types=1);

namespace Movies\ProductionCountry;

class ProductionCountryDto 
{
    public int $productionCountryId;
    public int $movieId;
    public int $countryId;

    public function __construct(array $row = null)
    {
        if ($row === null) {
            return;
        }

        $this->productionCountryId = (int) ($row["production_country_id"] ?? 0);
        $this->movieId = (int) ($row["movie_id"] ?? 0);
        $this->countryId = (int) ($row["country_id"] ?? 0);
    }
}